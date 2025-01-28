
<?php 
//session alredy started on header
   include_once 'common/header.php';
   //getting the erros from signup_action.php file
//    if(isset($_SESSION['errors'])){
//      print_arr($_SESSION['errors']);
//    }
?>
<body>

<nav class="navbar navbar-expand-lg navbar-dark bg-primary">
<div class="container">
  <!-- <a class="navbar-brand" href="/contactbook/"><i class="fa fa-address-book"></i> ContactBook</a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>
  <div class="collapse navbar-collapse" id="navbarNavDropdown">
    <ul class="navbar-nav">
      <li class="nav-item  active">
        <a class="nav-link" href="/contactbook/">Home <span class="sr-only">(current)</span></a>
      </li>
            <li class="nav-item">
        <a class="nav-link" href="/contactbook/addcontact.php">Add Contact</a>
      </li> -->
      <!-- <li class="nav-item dropdown ">
        <a class="nav-link dropdown-toggle" href="/contactbook/profile.php" id="navbarDropdownMenuLink" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
        Pankaj        </a>
        <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
          <a class="dropdown-item" href="/contactbook/profile.php">Profile</a>
          <a class="dropdown-item" href="/contactbook/logout.php">Logout</a>
        </div>
      </li> -->
          </ul>
  </div>
  </div>
</nav>
<main role="main" class="container">


<table class="table text-center">
  <thead>
    <tr>
      <th scope="col"></th>
      <th scope="col">Name</th>
      <th scope="col">Action</th>
    </tr>
  </thead>
  <tbody>
      <tr>
      <td class="align-middle"><img src="https://via.placeholder.com/50.png/09f/666" class="img-thumbnail img-list" /></td>
      <td class="align-middle">Deepak Sharma</td>
      <td class="align-middle"> 
      <a href="/contactbook/view.php?id=9" class="btn btn-success">View</a>
      <a href="/contactbook/addcontact.php?id=9" class="btn btn-primary">Edit</a>
      <a href="/contactbook/delete.php?id=9" class="btn btn-danger" onclick="return confirm(`Are you sure want to delete this contact?`)">Delete</a>
      </td>
    </tr>
      <tr>
      <td class="align-middle"><img src="/contactbook/uploads/photos/2f053caaa84024ec6d12aaa5679b5417.jpg" class="img-thumbnail img-list" /></td>
      <td class="align-middle">Harish Rawat</td>
      <td class="align-middle"> 
      <a href="/contactbook/view.php?id=3" class="btn btn-success">View</a>
      <a href="/contactbook/addcontact.php?id=3" class="btn btn-primary">Edit</a>
      <a href="/contactbook/delete.php?id=3" class="btn btn-danger" onclick="return confirm(`Are you sure want to delete this contact?`)">Delete</a>
      </td>
    </tr>
      <tr>
      <td class="align-middle"><img src="https://via.placeholder.com/50.png/09f/666" class="img-thumbnail img-list" /></td>
      <td class="align-middle">john smith</td>
      <td class="align-middle"> 
      <a href="/contactbook/view.php?id=1" class="btn btn-success">View</a>
      <a href="/contactbook/addcontact.php?id=1" class="btn btn-primary">Edit</a>
      <a href="/contactbook/delete.php?id=1" class="btn btn-danger" onclick="return confirm(`Are you sure want to delete this contact?`)">Delete</a>
      </td>
    </tr>
      <tr>
      <td class="align-middle"><img src="/contactbook/uploads/photos/c266048c47fa99a363727728897ead4c.jpg" class="img-thumbnail img-list" /></td>
      <td class="align-middle">MS2 Dhoni</td>
      <td class="align-middle"> 
      <a href="/contactbook/view.php?id=8" class="btn btn-success">View</a>
      <a href="/contactbook/addcontact.php?id=8" class="btn btn-primary">Edit</a>
      <a href="/contactbook/delete.php?id=8" class="btn btn-danger" onclick="return confirm(`Are you sure want to delete this contact?`)">Delete</a>
      </td>
    </tr>
      <tr>
      <td class="align-middle"><img src="https://via.placeholder.com/50.png/09f/666" class="img-thumbnail img-list" /></td>
      <td class="align-middle">pawan singh</td>
      <td class="align-middle"> 
      <a href="/contactbook/view.php?id=2" class="btn btn-success">View</a>
      <a href="/contactbook/addcontact.php?id=2" class="btn btn-primary">Edit</a>
      <a href="/contactbook/delete.php?id=2" class="btn btn-danger" onclick="return confirm(`Are you sure want to delete this contact?`)">Delete</a>
      </td>
    </tr>
    </tbody>
</table>

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
