<?php

 ob_start();
 session_start();
 require_once 'includes/config.php';
if(isset($_SESSION['user'])){
    //remove the user
    unset($_SESSION['user']);
    session_destroy();
    //send back to homepage
    header('location:'.SITEURL);
}
?>