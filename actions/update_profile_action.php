<?php
ob_start();
session_start();
require_once "../includes/config.php";
require_once "../includes/db.php";

// Initialize errors array
$errors = [];

// Check if form is submitted
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Sanitize and trim input
    $firstName = sanitizeInput($_POST["fname"]);
    $lastName = sanitizeInput($_POST["lname"]);
    $email = sanitizeInput($_POST["email"]);
    $photofile = !empty($_FILES["photo"]) ? $_FILES["photo"] : [];

    // Validate inputs
    if (empty($firstName)) {
        $errors[] = "First Name cannot be blank";
    }

    if (empty($email)) {
        $errors[] = "Email cannot be blank";
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errors[] = "Invalid Email address";
    }

    // If there are errors, redirect back to edit profile page
    if (!empty($errors)) {
        $_SESSION['errors'] = $errors;
        header("Location: " . SITEURL . "edit_profile.php");
        exit();
    }

    // Check if the email is already registered
    if (isEmailExists($email)) {
        $errors[] = "Email Address already exists";
        $_SESSION['errors'] = $errors;
        header("Location: " . SITEURL . "edit_profile.php");
        exit();
    }

    // Handle photo upload
    $photoName = handlePhotoUpload($photofile, $errors);

    // Get the user ID from the session
    $userId = isset($_SESSION['user']['id']) ? $_SESSION['user']['id'] : 0;

    if ($userId > 0) {
        $connection = db_connect();
        
        // Prepare SQL query for updating user profile
        $sql = "UPDATE `users` SET first_name='{$firstName}', last_name='{$lastName}', email='{$email}'";
        if ($photoName) {
            $sql .= ", profile_img='{$photoName}'";
        }
        $sql .= " WHERE id={$userId}";

        // Execute the query and handle success/failure
        if (mysqli_query($connection, $sql)) {
            $_SESSION['success'] = "Profile has been updated successfully.";
            db_close($connection);
            header('Location: ' . SITEURL . "profile.php");
            exit();
        } else {
            $errors[] = "An error occurred while updating the profile. Please try again.";
            $_SESSION['errors'] = $errors;
            db_close($connection);
            header('Location: ' . SITEURL . "edit_profile.php");
            exit();
        }
    } else {
        $errors[] = "User not authenticated.";
        $_SESSION['errors'] = $errors;
        header('Location: ' . SITEURL . "login.php");
        exit();
    }
}

/**
 * Sanitize user input to prevent SQL injection
 */
function sanitizeInput($input) {
    global $connection; // Make sure $connection is defined globally
    return mysqli_real_escape_string($connection, trim($input));
}

/**
 * Check if email already exists in the database
 */
function isEmailExists($email) {
    $connection = db_connect();
    $sanitizedEmail = sanitizeInput($email);
    $sqlQuery = "SELECT id FROM `users` WHERE `email` = '{$sanitizedEmail}'";
    $sqlResult = mysqli_query($connection, $sqlQuery);
    $emailRows = mysqli_num_rows($sqlResult);
    db_close($connection);
    return $emailRows > 0;
}

/**
 * Handle photo upload and return the new file name
 */
function handlePhotoUpload($file, &$errors) {
    $photoName = '';
    if (!empty($file['name'])) {
        $tempFilePath = $file['tmp_name'];
        $filename = $file['name'];
        $filenameCmp = explode('.', $filename);
        $fileExtension = strtolower(end($filenameCmp));
        $newFileName = md5(time() . $filename) . "." . $fileExtension;
        $photoName = $newFileName;

        // Allowed extensions and MIME types
        $allowed_extensions = ['jpg', 'jpeg', 'png', 'gif'];
        $allowed_mimes = ['image/jpeg', 'image/png', 'image/gif'];

        // Validate file extension and MIME type
        if (in_array($fileExtension, $allowed_extensions) && in_array($file['type'], $allowed_mimes)) {
            // Check file size (max 5MB)
            if ($file['size'] > 5000000) {
                $errors[] = "File size exceeds the maximum limit of 5MB";
            } else {
                $uploadDir = "../uploads/profilephotos/";
                $destinationPath = $uploadDir . $photoName;

                // Move the uploaded file
                if (!move_uploaded_file($tempFilePath, $destinationPath)) {
                    $errors[] = "File couldn't be uploaded";
                }
            }
        } else {
            $errors[] = "Invalid photo (file) type or extension";
        }
    }
    return $photoName;
}
?>
