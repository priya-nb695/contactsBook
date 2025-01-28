<?php
ob_start();
session_start();
require_once "../includes/config.php";
require_once "../includes/db.php";
$errors=[];

if(isset($_POST)) {
    // print_arr($_POST);
    $email=trim($_POST['email']);
    $password=trim($_POST['password']);
}
//validtaions
if(empty($email)){
    $errors[]="Email cannot be blank";
  }
  if(!empty($email) && !filter_var($email, FILTER_VALIDATE_EMAIL)){
    $errors[]="Invalid Email address";
  }
  if(empty($password)){
    $errors[]="Password cannot be blank";
  }
  if(!empty($errors)){
    $_SESSION['errors']=$errors;
    header('location:'.SITEURL."login.php");
  }
  //if no errors
  if(!empty($email) && !empty($password) ){
    $connection=db_connect();
    //sanitize the email, to avoide sql injection
    $sanitizedEmail=mysqli_real_escape_string($connection,$email);
    $sql="SELECT * FROM `users` WHERE `email`='{$sanitizedEmail}'";

    $sqlResult=mysqli_query($connection,$sql);
    if(mysqli_num_rows($sqlResult) > 0){
        $userInfo=mysqli_fetch_assoc($sqlResult);
            // print_arr($userInfo);
            if(!empty($userInfo)){
                $userpwd=$userInfo["password"];
                if(password_verify($password,$userpwd)){
                    //if condition pass, the user is verified
                    //can be stored the details in session so it can be used in other page
                    //but we cannot store the password in session so first we need to unset the password
                    unset($userInfo["password"]);
                    $_SESSION["user"]=$userInfo;
                   // print_arr(  $_SESSION["user"]);
                   //sending the session info to home page
                   header("location:".SITEURL);

                }
                else{
                  $errors[]="Incorrect password";
                  $_SESSION['errors']=$errors;
                  //sending user again to login page
                  header("location:".SITEURL."login.php");
                  exit();
                }

            }
        
    }
    else{
      $errors[]="Email address doesn't exsist";
      $_SESSION['errors']=$errors;
      //sending user again to login page
      header("location:".SITEURL."login.php");
      exit();
    }


    print_arr($sqlResult);
  }
?>
