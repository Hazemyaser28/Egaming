<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php getTitle() ?></title>
<link rel="stylesheet" href="<?php echo $css; ?>bootstrap.min.css"/>
<link rel="stylesheet" href="<?php echo $css; ?>backend.css"/>
<link rel="stylesheet" href="<?php echo $css; ?>all.min.css"/>
<link rel="stylesheet" href="<?php echo $css; ?>payment.css"/>
</head>
<body>
</nav>
<nav class="navbar navbar-expand-lg navbar-light bg-light">
  <div class="container-fluid">
    <a class="navbar-brand" href="#">EGaming</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNavDropdown">
      <ul class="navbar-nav">
   
        <li class="nav-item">
          <a class="nav-link active" aria-current="page" href="home.php">Home</a>
        </li>
      
        <li class="nav-item">
          <a class="nav-link" href="locations.php">Our Locations</a>
        </li>
       
        <li class="nav-item dropdown">
            <?php 
        if(isset($_SESSION['user'])){     
    echo "<a class='nav-link dropdown-toggle' href='#' id='navbarDropdownMenuLink' 
    role='button' data-bs-toggle='dropdown' aria-expanded='false'>" .$_SESSION['user']. "</a>";}
    elseif(isset($_SESSION['admin'])){
      echo "<a class='nav-link dropdown-toggle' href='#' id='navbarDropdownMenuLink' 
    role='button' data-bs-toggle='dropdown' aria-expanded='false'>" .$_SESSION['admin']. "</a>";
    }
 
else{
    ?>
          <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" role="button" data-bs-toggle="dropdown" aria-expanded="false">USERNAME
          </a>
          <?php } ?>
          <ul class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
          <a class="dropdown-item" href="profile.php"> My Profile </a>
            <a class="dropdown-item" href="#">edit my info</a>
          <a class="dropdown-item" href="logout.php">Log Out</a>
          </ul>
        </li>
       
      </ul>
    </div>
   
    <ul class="navbar-nav">
   
    <li class="nav-item">
          <span>not a member yet?</span>
          <a class="btn btn-warning" role="button"  href="signup.php">Register</a>
          <a class="btn btn-danger" href="hostreg.php">Become a host</a>
        </li>
</ul>
  </div>
</nav>