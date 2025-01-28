<?php 
//session alredy started on header
   include_once 'common/header.php';
   include_once 'includes/db.php';
   //check if user user active if not send back to login
  //  if(empty($_SESSION['user'])){
  //    header("location:".SITEURL."login.php");
  //    exit();//it will terminate the current script 
  //  }
   //when user is loginned in
   $userId=$_SESSION['user']['id'];
   //print_arr($_SESSION['user']);
  //  $userName=$_SESSION['user']['first_name'];
  //  $userEmail=$_SESSION['user']['email'];
  $connection=db_connect();
  $sql="SELECT * FROM `users` WHERE `id` =$userId";
  $sqlResult=mysqli_query($connection,$sql);
  if(mysqli_num_rows($sqlResult)>0){
    $userInfo=mysqli_fetch_assoc($sqlResult);
  }
  else{
    echo "User not found.";
  }
?>

<main role="main" class="container"><div class="row justify-content-center wrapper">
<div class="col-md-6">
<div class="card">
<header class="card-header">
	<h4 class="card-title mt-2">Profile</h4>
</header>
<article class="card-body">
<div class="container" id="profile"> 
        <div class="row">
            <div class="col-sm-6 col-md-4">
                <img src="http://placehold.it/100x100" alt="" class="rounded-circle" />
            </div>
            <div class="col-sm-6 col-md-8">
                <h4 class="text-primary">
                <?php  echo  $userInfo['first_name']." ". $userInfo['last_name'];?> 
                </h4>
                <p class="text-secondary">
                <i class="fa fa-envelope-o" aria-hidden="true"></i>
                  <?php  echo  $userInfo['email']; ?>
                <br />
                </p>
                <!-- Split button -->
            </div>
        </div>

    </div>  
</article>

</div>
</div>

</div> <!-- row.//-->

</main>
