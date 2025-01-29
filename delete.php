
<?php 
  ob_start();
  session_start();

   include_once "includes/config.php";
   require_once "includes/db.php";
   //if user logged in then do the action 
   if(empty($_SESSION['user'])){
    header("location:".SITEURL."login.php");
    exit();
    
   }
   if(!empty($_GET['id']) && is_numeric($_GET['id'])){
      //owner id
      $userId = $_SESSION['user']['id'] ;
      //get the contact id which added by respective owner
      $contactId=$_GET['id'];
      $connection=db_connect();
      $cID=mysqli_real_escape_string($connection,$contactId);
      $deleteSql="DELETE FROM `contacts` WHERE `id`={$cID} AND `owner_id`={$userId}";
      if(mysqli_query( $connection,$deleteSql)){
        db_close($connection);
        $_SESSION['success']="Contact has been deleted sucessfully";
        header("location:".SITEURL);
      }



   }
 else{
    echo "Invalid Contact Id.";
    exit();
 }
?>