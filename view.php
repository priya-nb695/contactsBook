<?php 
//session alredy started on header
   include_once 'common/header.php';
   require_once "includes/db.php";
   //if user logged in then do the action 
  if(empty($_SESSION['user'])){
    header("location:".SITEURL."login.php");
    exit();

   }
    $userId = (!empty($_SESSION['user']) && !empty($_SESSION['user']['id'])) ? $_SESSION['user']['id'] : 0;
    //get the contact id
    $contactId=$_GET['id'];
    if(!empty( $contactId) && is_numeric($contactId)){
      $connection=db_connect();
      $contact_Id=mysqli_real_escape_string($connection,$contactId);
      $sql="SELECT * FROM `contacts` WHERE `id`={$contactId} AND `owner_id`={$userId} ";
      $mysqlResult=mysqli_query($connection,$sql);
      $rows=mysqli_num_rows($mysqlResult);
      if($rows>0){
        $contactResult=mysqli_fetch_assoc($mysqlResult);
        // print_arr($contactResult);
      }
      else{
        echo "Record doesnt Exist";
        exit();
      }
      db_close($connection);
    }
    else{
      echo "Invalid  Contact Id";
      exit();
    }
   //getting the erros from signup_action.php file
//    if(isset($_SESSION['errors'])){
//      print_arr($_SESSION['errors']);
//    }
?>
<main role="main" class="container">
  <div class="row justify-content-center wrapper">
<div class="col-md-6">
<div class="card">
<header class="card-header">
	<h4 class="card-title mt-2">Contact</h4>
</header>
<article class="card-body">
<div class="container" id="profile"> 
        <div class="row">
            <div class="col-sm-6 col-md-4">
                <img src="<?php echo !empty( $contactResult['photo'])? SITEURL."uploads/photos/".$contactResult['photo']:'https://via.placeholder.com/50.png/09f/666' ?>" width="150" class="img-thumbnail" />
            </div>
            <div class="col-sm-6 col-md-8">
                <h4 class="text-primary"><?php echo  $contactResult['first_name']." ". $contactResult['last_name']  ?></h4>
                <p class="text-secondary">
                <i class="fa fa-envelope-o" aria-hidden="true"></i><?php echo  $contactResult['email'] ?><br />
                <i class="fa fa-phone" aria-hidden="true"></i><?php echo  $contactResult['phone'] ?><br />
                <i class="fa fa-map-marker" aria-hidden="true"></i> <?php echo  $contactResult['address'] ?>
                </p>
                <!-- Split button -->
            </div>
        </div>

    </div>  
</article>

</div>
</div>

</div> 

</main>
<?php 
   include_once 'common/footer.php';
?>