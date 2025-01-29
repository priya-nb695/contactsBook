<?php
//get the form data
//validate form data
//currentpwd==db user pwd
//new pwd validations
//if successfull update the db data for pwd 

include_once "../includes/config.php"; 
include_once "../includes/db.php";
ob_start();
session_start();
$errors=[];
if(isset($_POST)  && !empty($_SESSION['user'])){
   // print_arr($_POST);

    $old_password=trim($_POST['old_password']);
    $new_password=trim($_POST['new_password']);
    $confirm_password=trim($_POST['confirm_password']);

    if(empty($old_password)){
        $errors[]="Old Password cannot be Empty";
    }
    if(empty($new_password)){
        $errors[]="New Password cannot be Empty";
    }
    if(empty($confirm_password)){
        $errors[]="Confirm Password cannot be Empty";
    }
    if(!empty($new_password) && !empty($confirm_password) && ($new_password!=$confirm_password)){
        $errors[]="New Password  didn't match with Confirm Password";
    }
     // If there are errors, redirect back
     if (!empty($errors)) {
        $_SESSION['errors'] = $errors;
        header("location:" . SITEURL . "change_password.php");
        exit();
    }
   // print_arr($_SESSION['user']);
    //establish db connection get the user pwd to match
    //user id123456
    $user_Id=$_SESSION['user']['id'];
    $connection=db_connect();
   
    if(!empty($user_Id)){
        $sql="SELECT * FROM `users` WHERE `id`='{$user_Id}'";
        $sqlResult=mysqli_query($connection, $sql);
        $userInfo=mysqli_fetch_assoc($sqlResult);
 
       
        //print_arr($userInfo);
        if(mysqli_num_rows($sqlResult) > 0){
            $userOldPasswordDb=$userInfo['password']; 
            if(password_verify($old_password,$userOldPasswordDb)){
                //creating pwd hash
                $new_passwordHash=password_hash($new_password, PASSWORD_DEFAULT);
                $sqlupdate="UPDATE `users` SET `password`='{$new_passwordHash}' 
                WHERE id={$user_Id} "; 
                $db_result=mysqli_query($connection,$sqlupdate);
                //print_arr($db_result);
                if($db_result){
                    $_SESSION['success'] ="password updated sucessfully";
                 
                    header("location:" . SITEURL . "change_password.php");
                }
              
               
            }
            else{
                $errors[]="Old password is Incorrect";
                $_SESSION['errors'] = $errors;
                header("location:" . SITEURL . "change_password.php");
                exit();
            }
            db_close( $connection);
               
        }


    }
}
?>