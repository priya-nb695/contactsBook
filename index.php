
<?php 
//session alredy started on header
   include_once 'common/header.php';
   require_once "includes/db.php";
   //if user logged in then do the action 
   $userId = (!empty($_SESSION['user']) && !empty($_SESSION['user']['id'])) ? $_SESSION['user']['id'] : 0;

?>
<main role="main" class="container wrapper">
<?php
if(!empty($_SESSION["success"])){
	?>
	<div class="alert alert-success text-center">
		<?php  echo $_SESSION["success"];?>
	
	</div>
<?php
 //clear the errors for next submission
 unset($_SESSION['success']);
}
//get user contact 
if(!empty($userId)){
  //if id found we will fetch contacts
  $contactsSql="SELECT * FROM `contacts` WHERE `owner_id`=$userId  ORDER BY first_name ASC LIMIT 0,10";
  $connection=db_connect();
  $contactResult=mysqli_query($connection,$contactsSql);
  $contactNumRows=mysqli_num_rows($contactResult);
  if( $contactNumRows>0){

  
?>

<table class="table text-center">
  <thead>
    <tr>
      <th scope="col"></th>
      <th scope="col">Name</th>
      <th scope="col">Action</th>
    </tr>
  </thead>
  <tbody>
    <?php 
    while($row=mysqli_fetch_assoc($contactResult)){

    ?>
      <tr>
      <td class="align-middle"><img src="https://via.placeholder.com/50.png/09f/666" class="img-thumbnail img-list" /></td>
      <td class="align-middle"><?php  echo $row['first_name']." ".$row['last_name'];?></td>
      <td class="align-middle"> 
      <a href="/contactbook/view.php?id=9" class="btn btn-success">View</a>
      <a href="/contactbook/addcontact.php?id=9" class="btn btn-primary">Edit</a>
      <a href="/contactbook/delete.php?id=9" class="btn btn-danger" onclick="return confirm(`Are you sure want to delete this contact?`)">Delete</a>
      </td>
    </tr>
      
     
    <?php 
    }
    ?>
    </tbody>
</table>
<?php 
}
}
?>


<nav>
  <ul class="pagination justify-content-center">
      <li class="page-item  disabled">
      <a class="page-link" href="/contactbook/index.php?page=0" >Previous</a>
    </li>
        <li class="page-item active"><a class="page-link" href="/contactbook/index.php?page=1">1</a></li>
        <li class="page-item"><a class="page-link" href="/contactbook/index.php?page=2">2</a></li>
    
    <li class="page-item">
      <a class="page-link" href="/contactbook/index.php?page=2">Next</a>
    </li>
  </ul>
</nav>
</main>
<?php 
   include_once 'common/footer.php';
?>
</body>
