<?php
ob_start();
session_start();
require_once "../includes/config.php";
require_once "../includes/db.php";
$errors = [];

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    // Trim and sanitize input
    $email = filter_var(trim($_POST['email']), FILTER_SANITIZE_EMAIL);
    $password = trim($_POST['password']);

    // Validations
    if (empty($email)) {
        $errors[] = "Email cannot be blank";
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errors[] = "Invalid Email address";
    }

    if (empty($password)) {
        $errors[] = "Password cannot be blank";
    }

    // If there are validation errors, redirect back with errors
    if (!empty($errors)) {
        $_SESSION['errors'] = $errors;
        header("Location: " . SITEURL . "login.php");
        exit();
    }

    // If no errors, proceed with database check
    $connection = db_connect();
    $sanitizedEmail = mysqli_real_escape_string($connection, $email);

    // Query the user based on email
    $sql = "SELECT * FROM `users` WHERE `email` = ?";
    $stmt = mysqli_prepare($connection, $sql);
    
    if ($stmt) {
        // Bind parameters and execute the query
        mysqli_stmt_bind_param($stmt, "s", $sanitizedEmail);
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);

        if (mysqli_num_rows($result) > 0) {
            $userInfo = mysqli_fetch_assoc($result);

            // Verify password
            if (password_verify($password, $userInfo["password"])) {
                // Remove password before storing user info in session
                unset($userInfo["password"]);
                $_SESSION["user"] = $userInfo;

                // Redirect user to intended page or homepage
                $request_url = !empty($_SESSION['request_url']) ? $_SESSION['request_url'] : SITEURL;
                unset($_SESSION['request_url']);

                header("Location: " . $request_url);
                exit();
            } else {
                $errors[] = "Incorrect password";
            }
        } else {
            $errors[] = "Email address doesn't exist";
        }
        
        mysqli_stmt_close($stmt);
    } else {
        $errors[] = "Database error. Please try again later.";
    }

    // If errors occur, redirect back with error messages
    $_SESSION['errors'] = $errors;
    header("Location: " . SITEURL . "login.php");
    exit();
}
?>
