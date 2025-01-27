
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Contact Book</title>
<!-- CSS -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous">
<link rel="stylesheet" href="css/style.css">
</head>
<body>

<nav class="navbar navbar-expand-lg navbar-dark bg-primary">
<div class="container">
  <a class="navbar-brand" href="/contactbook/"><i class="fa fa-address-book"></i> ContactBook</a>
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
      </li>
      <li class="nav-item dropdown ">
        <a class="nav-link dropdown-toggle" href="/contactbook/profile.php" id="navbarDropdownMenuLink" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
        Pankaj        </a>
        <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
          <a class="dropdown-item" href="/contactbook/profile.php">Profile</a>
          <a class="dropdown-item" href="/contactbook/logout.php">Logout</a>
        </div>
      </li>
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
<!-- jQuery and JS bundle w/ Popper.js -->
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ho+j7jyWK8fNQe+A12Hb8AhRq26LrZ/JpcUGGOn+Y7RsweNrtN/tE3MoK7ZeZDyx" crossorigin="anonymous"></script>
</body>
</html>