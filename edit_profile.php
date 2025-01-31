<?php 
//session alredy started on header
   include_once 'common/header.php';
   require_once "includes/db.php";
   //if user logged in then do the action 
   if(empty($_SESSION['user'])) {
    $currentPage=!empty($_SERVER['REQUEST_URI'])? $_SERVER['REQUEST_URI']:'';
    $_SESSION['request_url']= $currentPage;
     //check if user not  active if not send back to login
    header("location:".SITEURL."login.php");
    exit();
   }
    //when user is loginned in
    $userId=$_SESSION['user']['id'];

    $connection=db_connect();
    $sql="SELECT * FROM `users` WHERE `id` =$userId";
    $sqlResult=mysqli_query($connection,$sql);
    if(mysqli_num_rows($sqlResult)>0){
        $userInfo=mysqli_fetch_assoc($sqlResult);
       // print_arr($userInfo);
    }
    else{
        echo "User not found.";
    }
    db_close($connection);
?>
<main role="main" class="container"><style>
.wrapper { padding-top:30px; }
</style> 
<div class="row justify-content-center wrapper">
<div class="col-md-6">
    <?php  include_once 'common/alert_message.php';?>
<div class="card">
<header class="card-header">
	<h4 class="card-title mt-2">Edit Profile</h4>
</header>
<article class="card-body">
<form method="POST" action="<?php echo SITEURL.'actions/update_profile_action.php' ;?>" enctype="multipart/form-data">
	<div class="form-row">
		<div class="col form-group">
			<label>First name </label>   
		  	<input type="text" name="fname" class="form-control" placeholder="First Name" value="<?php echo $userInfo['first_name'] ?>">
		</div> <!-- form-group end.// -->
		<div class="col form-group">
			<label>Last name</label>
		  	<input type="text" name="lname" class="form-control" placeholder="Last Name"  value="<?php echo $userInfo['last_name'] ?>">
		</div> <!-- form-group end.// -->
	</div> <!-- form-row end.// -->
	<div class="form-group">
		<label>Email address</label>
        <input type="text" name="email" class="form-control" placeholder="email"  value="<?php echo $userInfo['email'] ?>">
        <div class="form-group input-group">
        <div class="input-group-prepend">
            <span class="input-group-text" id="photo">Photo</span>
        </div>
    <div class="custom-file">
        <input type="file" name="photo" class="custom-file-input" id="profile_photo">
        <label class="custom-file-label" for="profile_photo">Choose file</label>
    </div>
	</div>
	
	
	</div>

    <div class="form-group">
        <button type="submit" name="update_profile" class="btn btn-success btn-block">Update</button>
    </div>   
                                         
</form>
</article> 
</div> 
</div> 

</div>

</main>
<?php 
   include_once 'common/footer.php';
?>