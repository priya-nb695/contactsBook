<?php
ob_start();
session_start();
require_once "../includes/config.php";
require_once "../includes/db.php";

$errors=[];
if(isset($_POST)){
  //print_arr($_POST);
  $firstName=trim($_POST["fname"]);
  $lastName=trim($_POST["lname"]);
  $email=trim($_POST["email"]);
  $photofile = !empty($_FILES["photo"]) ? $_FILES["photo"] : [];

  //validations
  // if(empty($firstName)){
  //   $errors[]="First Name cannot be blank";
  // }
  // if(empty($email)){
  //   $errors[]="Email cannot be blank";
  // }
  // if(!empty($email) && !filter_var($email, FILTER_VALIDATE_EMAIL)){
  //   $errors[]="Invalid Email address";
  // }
 
  
 //to check if email is alredy registred
//  if(!empty($email)){
//   //conect db
//       $connection=db_connect();
//       //snaitize the email, to avode sql injection
//       $sanitizedEmail=mysqli_real_escape_string($connection,$email);
//       //create a query to get the macthed email row
//       $sqlQuery="SELECT id FROM `users` WHERE `email`='{$sanitizedEmail}'";
//       $sqlResult=mysqli_query($connection,$sqlQuery);
//       $emailRows=mysqli_num_rows($sqlResult);
//      // print_arr( $emailRows);
//       //check the number of rows with same email
//       if($emailRows>0){
//         $errors[]="Email Address already exists";
//       }
//       db_close($connection);


//  }
 if(!empty($errors)){
  $_SESSION['errors']=$errors;
  //sending back the erros and location to signup.php
  header('location:'.SITEURL.'signup.php');
  exit();
}
//if no errors

 //proceding to add values to db
//  $sql = "INSERT INTO `users` (first_name, last_name, email) VALUES ('{$firstName}', '{$lastName}', '{$email}')";

// //connecting to db by using the function defined in db.php
//  $connection=db_connect();
//  if(mysqli_query($connection,$sql)){
//     db_close( $connection);
//     $message="you are regesterd successfully!";
//     $_SESSION["success"]=$message;
//     header("location:".SITEURL.'signup.php');
//  }
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
          $uploadFileDir = "../uploads/profilephotos/";
          $destinationPath = $uploadFileDir . $photoName;

          if (!move_uploaded_file($tempFilePath, $destinationPath)) {
              $errors[] = "File couldn't be uploaded";
          }
      } else {
          $errors[] = "Invalid photo (file) type or extension";
      }
  }

    // Get owner ID from session
    $userId = (!empty($_SESSION['user']) && !empty($_SESSION['user']['id'])) ? $_SESSION['user']['id'] :0;
   echo $userId;
    $connection = db_connect();
    if(!empty($userId)){
    if(!empty($photoName)){
        //echo $firstName;
        $sql=" UPDATE `users` SET first_name='{$firstName}',last_name='{$lastName}',email='{$email}',profile_img='{$photoName}'
        WHERE id={$userId}";
    }
    else{
       
        $sql=" UPDATE `users` SET first_name='{$firstName}',last_name='{$lastName}',email='{$email}'
        WHERE id={$userId}";
    }
 
    if(mysqli_query($connection,$sql)){
        $_SESSION['success']="Profile has been updated successfully.";
        db_close($connection);
        header('location:'.SITEURL."profile.php");
    }
    }
}
?>