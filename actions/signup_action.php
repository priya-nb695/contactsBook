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
  $password=trim($_POST["password"]);
  $confirmpassword=trim($_POST["cpassword"]);

  //validations
  if(empty($firstName)){
    $errors[]="First Name cannot be blank";
  }
  if(empty($email)){
    $errors[]="Email cannot be blank";
  }
  if(!empty($email) && !filter_var($email, FILTER_VALIDATE_EMAIL)){
    $errors[]="Invalid Email address";
  }
  if(empty($password)){
    $errors[]="Password cannot be blank";
  }
  if(empty($confirmpassword)  ){
    $errors[]="Confirm password cannot be blank";
  }
  if(!empty($password) && !empty($confirmpassword) && $password!=$confirmpassword){
    $errors[]="Confirm Password did not match";
  }
  if(!empty($errors)){
    $_SESSION['errors']=$errors;
    //sending back the erros and location to signup.php
    header('location:'.SITEURL.'signup.php');
    exit();
  }
 
//if no errors
//creating pwd hash
 $passwordHash=password_hash($password, PASSWORD_DEFAULT);
 //proceding to add values to db
 $sql = "INSERT INTO `users` (first_name, last_name, email, password) VALUES ('{$firstName}', '{$lastName}', '{$email}', '{$passwordHash}')";

//connecting to db by using the function defined in db.php
 $connection=db_connect();
 if(mysqli_query($connection,$sql)){
    db_close( $connection);
    $message="you are regesterd successfully!";
    $_SESSION["success"]=$message;
    header("location:".SITEURL.'signup.php');
 }

}
?>