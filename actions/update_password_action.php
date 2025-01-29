<?php
include_once "../includes/config.php"; 
include_once "../includes/db.php";
ob_start();
session_start();

$errors = [];

if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_SESSION['user']['id'])) {
    $user_Id = $_SESSION['user']['id'];

    // Trim input
    $old_password = trim($_POST['old_password']);
    $new_password = trim($_POST['new_password']);
    $confirm_password = trim($_POST['confirm_password']);

    // Validations
    if (empty($old_password)) {
        $errors[] = "Old Password cannot be empty";
    }
    if (empty($new_password)) {
        $errors[] = "New Password cannot be empty";
    }
    if (empty($confirm_password)) {
        $errors[] = "Confirm Password cannot be empty";
    }
    if ($new_password !== $confirm_password) {
        $errors[] = "New Password didn't match with Confirm Password";
    }

    // Redirect back if there are errors
    if (!empty($errors)) {
        $_SESSION['errors'] = $errors;
        header("Location: " . SITEURL . "change_password.php");
        exit();
    }

    // Establish DB connection
    $connection = db_connect();

    // Fetch the user's current password
    $sql = "SELECT password FROM users WHERE id = ?";
    $stmt = mysqli_prepare($connection, $sql);

    if ($stmt) {
        mysqli_stmt_bind_param($stmt, "i", $user_Id);
        mysqli_stmt_execute($stmt);
        mysqli_stmt_bind_result($stmt, $userOldPasswordDb);
        mysqli_stmt_fetch($stmt);
        mysqli_stmt_close($stmt);

        if (!$userOldPasswordDb) {
            $errors[] = "User not found!";
        } elseif (!password_verify($old_password, $userOldPasswordDb)) {
            $errors[] = "Old password is incorrect";
        } elseif (password_verify($new_password, $userOldPasswordDb)) {
            $errors[] = "New password must be different from the old password";
        }
    } else {
        $errors[] = "Database error. Please try again.";
    }

    // If there are errors, redirect back
    if (!empty($errors)) {
        $_SESSION['errors'] = $errors;
        db_close($connection);
        header("Location: " . SITEURL . "change_password.php");
        exit();
    }

    // Update password with prepared statement
    $new_passwordHash = password_hash($new_password, PASSWORD_DEFAULT);
    $updateSql = "UPDATE users SET password = ? WHERE id = ?";
    $updateStmt = mysqli_prepare($connection, $updateSql);

    if ($updateStmt) {
        mysqli_stmt_bind_param($updateStmt, "si", $new_passwordHash, $user_Id);
        $updateSuccess = mysqli_stmt_execute($updateStmt);
        mysqli_stmt_close($updateStmt);
    } else {
        $updateSuccess = false;
    }

    db_close($connection);

    if ($updateSuccess) {
        $_SESSION['success'] = "Password updated successfully";
        header("Location: " . SITEURL . "change_password.php");
        exit();
    } else {
        $_SESSION['errors'] = ["Failed to update password. Please try again."];
        header("Location: " . SITEURL . "change_password.php");
        exit();
    }
} else {
    $_SESSION['errors'] = ["Unauthorized access!"];
    header("Location: " . SITEURL . "change_password.php");
    exit();
}
?>
