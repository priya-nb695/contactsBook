<?php
ob_start();
session_start();
require_once "../includes/config.php";
require_once "../includes/db.php";

$errors = [];

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    // Trim and sanitize input
    $firstName = trim($_POST["fname"]);
    $lastName = trim($_POST["lname"]);
    $email = filter_var(trim($_POST["email"]), FILTER_SANITIZE_EMAIL);
    $password = trim($_POST["password"]);
    $confirmPassword = trim($_POST["cpassword"]);

    // Validations
    if (empty($firstName)) {
        $errors[] = "First Name cannot be blank";
    }
    if (empty($email)) {
        $errors[] = "Email cannot be blank";
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errors[] = "Invalid Email address";
    }
    if (empty($password)) {
        $errors[] = "Password cannot be blank";
    }
    if (empty($confirmPassword)) {
        $errors[] = "Confirm password cannot be blank";
    }
    if (!empty($password) && $password !== $confirmPassword) {
        $errors[] = "Confirm Password did not match";
    }

    // Check if email is already registered
    if (empty($errors)) {
        $connection = db_connect();

        // Use prepared statement to prevent SQL injection
        $sqlQuery = "SELECT id FROM users WHERE email = ?";
        $stmt = mysqli_prepare($connection, $sqlQuery);

        if ($stmt) {
            mysqli_stmt_bind_param($stmt, "s", $email);
            mysqli_stmt_execute($stmt);
            mysqli_stmt_store_result($stmt);

            if (mysqli_stmt_num_rows($stmt) > 0) {
                $errors[] = "Email Address already exists";
            }
            mysqli_stmt_close($stmt);
        } else {
            $errors[] = "Database error. Please try again later.";
        }

        db_close($connection);
    }

    // If errors exist, redirect back with errors
    if (!empty($errors)) {
        $_SESSION['errors'] = $errors;
        header("Location: " . SITEURL . "signup.php");
        exit();
    }

    // If no errors, proceed with user registration
    $passwordHash = password_hash($password, PASSWORD_DEFAULT);
    $connection = db_connect();

    $sql = "INSERT INTO users (first_name, last_name, email, password) VALUES (?, ?, ?, ?)";
    $stmt = mysqli_prepare($connection, $sql);

    if ($stmt) {
        mysqli_stmt_bind_param($stmt, "ssss", $firstName, $lastName, $email, $passwordHash);
        
        if (mysqli_stmt_execute($stmt)) {
            db_close($connection);
            $_SESSION["success"] = "You are registered successfully!";
            header("Location: " . SITEURL . "signup.php");
            exit();
        } else {
            $errors[] = "Registration failed. Please try again.";
        }

        mysqli_stmt_close($stmt);
    } else {
        $errors[] = "Database error. Please try again later.";
    }

    db_close($connection);
}

// If errors exist, redirect back with errors
if (!empty($errors)) {
    $_SESSION['errors'] = $errors;
    header("Location: " . SITEURL . "signup.php");
    exit();
}
?>
