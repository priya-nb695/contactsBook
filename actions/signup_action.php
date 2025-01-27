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
  
 //to check if email is alredy registred
 if(!empty($email)){
  //conect db
      $connection=db_connect();
      //snaitize the email, to avode sql injection
      $sanitizedEmail=mysqli_real_escape_string($connection,$email);
      //create a query to get the macthed email row
      $sqlQuery="SELECT id FROM `users` WHERE `email`='{$sanitizedEmail}'";
      $sqlResult=mysqli_query($connection,$sqlQuery);
      $emailRows=mysqli_num_rows($sqlResult);
     // print_arr( $emailRows);
      //check the number of rows with same email
      if($emailRows>0){
        $errors[]="Email Address already exists";
      }
      db_close($connection);


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