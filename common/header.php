<?php

 ob_start();
 session_start();
 require_once 'includes/config.php';
//  if(isset($_SESSION['user'])){
//   print_arr($_SESSION['user']);
//  }
//get the active user if not empty
$user=!empty($_SESSION['user'])? $_SESSION['user']:[];
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Contact Book</title>
<!-- CSS -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous">
<link rel="stylesheet" href="<?php echo SITEURL."public/css/style.css" ?>">
</head>
<body>

<nav class="navbar navbar-expand-lg navbar-dark bg-primary">
<div class="container">
  <a class="navbar-brand" href="<?php echo SITEURL ?>"><i class="fa fa-address-book"></i> ContactBook</a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>
  <div class="collapse navbar-collapse" id="navbarNavDropdown">
    <ul class="navbar-nav">
      <li class="nav-item ">
        <a class="nav-link" href="<?php echo SITEURL ?>">Home <span class="sr-only">(current)</span></a>
      </li>
       <?php
            //if user not active then display signup and signin
          if(empty($user) ){
      ?>
          <li class="nav-item"  active>
           <a class="nav-link" href="<?php echo SITEURL."signup.php"?>">Signup</a>
          </li>
          <li class="nav-item" >
            <a class="nav-link" href="<?php echo SITEURL."login.php"?>">Login</a>
          </li>   
     <?php  
     }
       ?>
   
      <?php
        //if user  active then display user name and progile logout 
       if(!empty($user) ){
      ?>
      <li class="nav-item"  >
           <a class="nav-link" href="<?php echo SITEURL."addcontact.php"?>">Add Contact</a>
          </li>
           <li class="nav-item dropdown ">
           <a class="nav-link dropdown-toggle" href="/contactbook/profile.php" id="navbarDropdownMenuLink" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
        <?php echo !empty($user['first_name'] ) ? $user['first_name'] : 'Guest' ?>
          </a>
           <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
             <a class="dropdown-item" href="<?php echo SITEURL."profile.php"?>">Profile</a>
             <a class="dropdown-item" href="<?php echo SITEURL."logout.php"?>">Logout</a>
           </div>
         </li>
         <?php 
      }
       ?>
   
          </ul>
  </div>
  </div>
</nav>