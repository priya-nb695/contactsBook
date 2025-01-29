<?php 
//session alredy started on header
   include_once 'common/header.php';
   require_once "includes/db.php";
   //getting the erros from signup_action.php file
//    if(isset($_SESSION['errors'])){
//      print_arr($_SESSION['errors']);
//    }
if(empty($_SESSION['user'])){
    header("location:".SITEURL."login.php");
    exit();

   }
   $userId = (!empty($_SESSION['user']) && !empty($_SESSION['user']['id'])) ? $_SESSION['user']['id'] : 0;
    //get the contact id
    $contactId=!empty($_GET['id'])?$_GET['id']:'';
    if(!empty( $contactId) && is_numeric($contactId)){
      $connection=db_connect();
      $contact_Id=mysqli_real_escape_string($connection,$contactId);
      $sql="SELECT * FROM `contacts` WHERE `id`={$contactId} AND `owner_id`={$userId} ";
      $mysqlResult=mysqli_query($connection,$sql);
      $rows=mysqli_num_rows($mysqlResult);
      if($rows>0){
        $contactResult=mysqli_fetch_assoc($mysqlResult);
         //print_arr($contactResult);
      }
      else{
        echo "Record doesnt Exist";
        exit();
      }
	  db_close($connection);

    }
	//edit contact
	$first_name=!empty($contactResult) && !empty($contactResult['first_name'])?$contactResult['first_name']:'';
	$last_name=!empty($contactResult) && !empty($contactResult['last_name'])?$contactResult['last_name']:'';
	$email=!empty($contactResult) && !empty($contactResult['email'])?$contactResult['email']:'';
	$phone=!empty($contactResult) && !empty($contactResult['phone'])?$contactResult['phone']:'';
	$address=!empty($contactResult) && !empty($contactResult['address'])?$contactResult['address']:'';
	//$photo=!empty($contactResult) && !empty($contactResult['photo'])?$contactResult['photo']:'';
    
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
		  	<input type="text" name="fname" value="<?php  echo $first_name; ?>" class="form-control" placeholder="First Name">
		</div>
		<div class="col form-group">
			<label>Last Name</label>
		  	<input type="text" name="lname" value="<?php  echo $last_name; ?>" class="form-control" placeholder="Last Name">
		</div>
	</div>
	<div class="form-group">
		<label>Email Address</label>
		<input type="email" name="email" value="<?php  echo $email; ?>" class="form-control" placeholder="Email">
	</div>
	<div class="form-group">
		<label>Phone No.</label>
		<input type="text" name="phone" value="<?php  echo $phone; ?>"  class="form-control" placeholder="Contact">
	</div>
	<div class="form-group">
		<label>Address</label>
		<input type="text" name="address" value="<?php  echo $address; ?>" class="form-control" placeholder="Address">
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
	<!-- adding this input type="hidden for id when intial craete also we get id-->
        <input type="hidden" name="cid" value="<?php  echo $contactId; ?>" />
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