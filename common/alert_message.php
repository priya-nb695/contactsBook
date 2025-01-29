<?php
if(!empty($_SESSION["success"])){
	?>
	<div class="alert alert-success text-center">
		<?php  echo $_SESSION["success"];?>
	
	</div>
<?php
 //clear the erros for next submission
 unset($_SESSION['success']);
}
?>
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