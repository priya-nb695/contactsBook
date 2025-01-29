<?php
ob_start();
session_start();
require_once "../includes/config.php";
require_once "../includes/db.php";

$errors = [];

if (isset($_POST) && !empty($_SESSION['user'])) {
    $firstName = trim($_POST["fname"]);
    $lastName = trim($_POST["lname"]);
    $email = trim($_POST["email"]);
    $phone = trim($_POST["phone"]);
    $address = trim($_POST["address"]);
    $photofile = !empty($_FILES["photo"]) ? $_FILES["photo"] : [];
    $cId = !empty($_POST['cid']) ? $_POST['cid'] : '';

    // Validations
    if (empty($firstName)) {
        $errors[] = "First Name cannot be blank";
    }
    if (empty($email)) {
        $errors[] = "Email cannot be blank";
    }
    if (!empty($email) && !filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errors[] = "Invalid Email address";
    }
    if (empty($phone)) {
        $errors[] = "Phone cannot be blank";
    }
    if (!empty($phone) && !is_numeric($phone)) {
        $errors[] = "Phone number should be numeric";
    }
    if (!empty($phone) && (strlen($phone) != 10)) {
        $errors[] = "Invalid phone number";
    }
    if (empty($address)) {
        $errors[] = "Address cannot be blank";
    }

    // If there are errors, redirect back
    if (!empty($errors)) {
        $_SESSION['errors'] = $errors;
        header("location:" . SITEURL . "addcontact.php");
        exit;
    }

    // Uploading user photo
    $photoName = '';
    if (!empty($photofile['name'])) {
        $tempFilePath = $photofile['tmp_name'];
        $filename = $photofile['name'];
        $filenameCmp = explode('.', $filename);
        $fileExtension = strtolower(end($filenameCmp));
        $filenewName = md5(time() . $filename) . "." . $fileExtension;
        $photoName = $filenewName;

        // Allowed extensions
        $allowed_extensions = ['jpg', 'jpeg', 'png', 'gif'];
        $allowed_mimes = ['image/jpeg', 'image/png', 'image/gif'];

        if (in_array($fileExtension, $allowed_extensions) && in_array($photofile['type'], $allowed_mimes)) {
            $uploadFileDir = "../uploads/photos/";
            $destinationPath = $uploadFileDir . $photoName;

            if (!move_uploaded_file($tempFilePath, $destinationPath)) {
                $errors[] = "File couldn't be uploaded";
            }
        } else {
            $errors[] = "Invalid photo (file) type or extension";
        }
    }

    // If there are upload errors, redirect back
    if (!empty($errors)) {
        $_SESSION['errors'] = $errors;
        header("location:" . SITEURL . "addcontact.php");
        exit;
    }

    // Get owner ID from session
    $ownerId = (!empty($_SESSION['user']) && !empty($_SESSION['user']['id'])) ? $_SESSION['user']['id'] : 0;
    $connection = db_connect();

    // **UPDATE EXISTING RECORD**
    if (!empty($cId)) {
        if (!empty($photoName)) {
            // If a new photo is selected
            $sql = "UPDATE `contacts` 
                    SET first_name = ?, last_name = ?, email = ?, phone = ?, address = ?, photo = ? 
                    WHERE id = ? AND owner_id = ?";

            $stmt = $connection->prepare($sql);
            $stmt->bind_param("ssssssii", $firstName, $lastName, $email, $phone, $address, $photoName, $cId, $ownerId);
        } else {
            // If no new photo is selected
            $sql = "UPDATE `contacts` 
                    SET first_name = ?, last_name = ?, email = ?, phone = ?, address = ? 
                    WHERE id = ? AND owner_id = ?";

            $stmt = $connection->prepare($sql);
            $stmt->bind_param("ssssssi", $firstName, $lastName, $email, $phone, $address, $cId, $ownerId);
        }

        if ($stmt->execute()) {
            $message = "Contact has been edited successfully";
        } else {
            echo "Error: " . $stmt->error;
        }
    } 
    // **INSERT NEW RECORD**
    else {
        $sql = "INSERT INTO `contacts` (first_name, last_name, email, phone, address, photo, owner_id) VALUES (?, ?, ?, ?, ?, ?, ?)";

        $stmt = $connection->prepare($sql);
        $stmt->bind_param("ssssssi", $firstName, $lastName, $email, $phone, $address, $photoName, $ownerId);
        $message = "New Contact has been added successfully";
    }

    // Execute query and redirect
    if ($stmt->execute()) {
        $_SESSION['success'] = $message;
        db_close($connection);
        header("location:" . SITEURL);
        exit;
    } else {
        $errors[] = "Failed to add contact: " . $stmt->error;
    }
}
?>
