<?php 
//session alredy started on header
   include_once 'common/header.php';
   //getting the erros from signup_action.php file
//    if(isset($_SESSION['errors'])){
//      print_arr($_SESSION['errors']);
//    }
?>
<main role="main" class="container"><style>
.wrapper { padding-top:30px; }
</style>

<div class="row justify-content-center wrapper">
<div class="col-md-6">
<?php
if(!empty($_SESSION['errors'])){
	?>
	<div class="alert alert-danger">
	<ul>
		<?php 
		 foreach($_SESSION['errors'] as $error){
			print '<li>'.$error.'</li>';
		 }
		
		?>
	</ul>
	</div>
<?php
 //clear the erros for next submission
 unset($_SESSION['errors']);
}
?>
<div class="card">
<header class="card-header">
	<h4 class="card-title mt-2">Sign In</h4>
</header>
<article class="card-body">
<form method="POST" action="<?php  echo SITEURL."actions/login_action.php";?>">
	<div class="form-group">
		<label>Email</label>
		<input type="email" name="email" class="form-control" placeholder="Email">
	</div> 
	<div class="form-group">
		<label>Password</label>
	    <input class="form-control" type="password" name="password" placeholder="password">
	</div>   
    <div class="form-group">
        <button type="submit" name="submit" class="btn btn-success btn-block"> Login  </button>
    </div>       
</form>
</article>
<div class="border-top card-body text-center">Haven't an account? <a href="<?php echo SITEURL."signup.php"?>">Sign Up</a></div>
</div>
</div>

</div>

</main>
<?php 
   include_once 'common/footer.php';
?>
