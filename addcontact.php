<?php 
//session alredy started on header
   include_once 'common/header.php';
   //getting the erros from signup_action.php file
//    if(isset($_SESSION['errors'])){
//      print_arr($_SESSION['errors']);
//    }
?>

<main role="main" class="container"><div class="row justify-content-center wrapper">
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
	<h4 class="card-title mt-2">Add/Edit Contact</h4>
</header>
<article class="card-body">
<form method="POST" action="<?php  echo SITEURL."actions/addcontact_action.php";?>" enctype="multipart/form-data">
	<div class="form-row">
		<div class="col form-group">
			<label>First Name </label>   
		  	<input type="text" name="fname" value="" class="form-control" placeholder="First Name">
		</div>
		<div class="col form-group">
			<label>Last Name</label>
		  	<input type="text" name="lname" value="" class="form-control" placeholder="Last Name">
		</div>
	</div>
	<div class="form-group">
		<label>Email Address</label>
		<input type="email" name="email" value="" class="form-control" placeholder="Email">
	</div>
	<div class="form-group">
		<label>Phone No.</label>
		<input type="text" name="phone" value=""  class="form-control" placeholder="Contact">
	</div>
	<div class="form-group">
		<label>Address</label>
		<input type="text" name="address" value="" class="form-control" placeholder="Address">
	</div>
	<div class="form-group input-group">
        <div class="input-group-prepend">
            <span class="input-group-text" id="photo">Photo</span>
        </div>
    <div class="custom-file">
        <input type="file" name="photo" class="custom-file-input" id="contact_photo">
        <label class="custom-file-label" for="contact_photo">Choose file</label>
    </div>
	</div>
    <div class="form-group">
        <input type="hidden" name="contactid" value="" />
        <button type="submit" class="btn btn-primary btn-block">Submit</button>
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