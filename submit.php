<?php
session_start();
include 'init2.php';
require('config.php');

if(isset($_SESSION['user_id'])){
if(isset($_POST['stripeToken'])){
 
	\Stripe\Stripe::setVerifySslCerts(false);
	
	$token=$_POST['stripeToken'];
	
//select from database bundles
	$stmt=$con->prepare("SELECT * FROM bundles WHERE ID=?");
    $stmt->execute(array($_GET['bunid']));
    $loc = $stmt->fetch();
//select from database bundles
	$stmt=$con->prepare("SELECT * FROM users WHERE ID=?");
    $stmt->execute(array( $_SESSION['user_id'] ));
    $data = $stmt->fetch();
	$newhours=$data['hours']+ $loc['bundle_hours'];
	$fname=$data['fullname'];
	$bought=$loc['bundle_hours'];
	$newbalance=$newhours;
  $bname=$loc['name'];
  $email=$data['email'];


//add hour balance into user's
	$stmt = $con->prepare(" UPDATE users SET hours = ? WHERE ID = ? ");
	$stmt->execute(array( $newhours, $_SESSION['user_id']));

//payment details
	$data=\Stripe\Charge::create(array(
		"amount"=> $loc['price']*100,
		"currency"=>"EGP",
		"description"=>  $loc['name'] ,
		"source"=>$token,
    
	)); 
  include('bundle-email.php');
  ?>



<!doctype html>
<html lang="en">
<html>
<head>
      <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <link href="https://fonts.googleapis.com/css?family=Open+Sans&display=swap" rel="stylesheet">

  <!--------style sheets--->
  <link rel="stylesheet" href="design/css/bootstrap.min.css"/>
      <link rel="stylesheet" href="design/css/pages/done.css"/>
      <link rel="stylesheet" href="design/css/Animate.css"/>
    <link rel="stylesheet" href="design/icofont/icofont.min.css"/>
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.5.0/css/all.css" integrity="sha384-B4dIYHKNBt8Bc12p+WXckhzcICo0wtJAoU8YZTY5qE0Id1GSseTk6S+L3BlXeVIU" crossorigin="anonymous">
    
    <!--------end style sheets--->

    <link rel="shortcut icon" type="image/x-icon" href="design/images/game-controller-1400688-1189016.png">
      <title>Success</title>
</head>
<body> 

  <div class="bg"> <!--background-->
    
    <!--navbar--->
    <nav class="navbar navbar-expand-lg bg-danger">
        <div class="container-fluid d-flex align-items-center justify-content-between">
          <a class="navbar-brand heartBeat progress-bar-animated" style="color: rgb(124, 19, 19)!important" href="#"><i class="icofont-game-controller" style="font-size:30px "></i></a>
          <button class="navbar-toggler  bg-danger" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
          </button>
          <div class="collapse navbar-collapse flex-grow-0" id="navbarSupportedContent">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0" > 
      
              <li class="nav-item d-flex">
                <a class="nav-link active" aria-current="page" href="index.html">Home </a>
              </li>
              <li class="nav-item dropdown">
              </li>
            </ul>
          </div>
        </div>
      </nav>
    <!--end navbar-->


	<section class="vh-100" style="opacity: 85% !important;">
    <div class="container h-100">
      <div class="row d-flex justify-content-center align-items-center h-100">
        <div class="col-lg-12 col-xl-11">
            <div class="card-body p-md-5">
              <div class="row justify-content-center">
                <div class="col-md-10 col-lg-6 col-xl-5 order-2 order-lg-1">
					<?php
					$redimsg=  '<div class="alert alert-primary  text-center" >Payment succeed the balance has been added to your account and you will
					 recive an email 
					<a href="index.php" style="color: rgb(165, 77, 77) !important; text-decoration:none;  "> Click here to go home  </a> </div>';	
                      redirection($redimsg,'home',15); 
                     
					  ?>
				</div>
              </div>
            </div>
        </div>
      </div>
    </div>
  </section>
  </footer>


    <!-- end Footer -->
      <!-------- scripts-->
	  <script src="design/js/jquery.min.js"></script>
      <script src="design/js/popper.min.js"></script>
      <script src="design/js/popper.js"></script>  
      <script src="design/js/bootstrap.bundle.min.js"></script>  
      <script src="design/js/index.js"></script> 
      <!-------- end scripts-------->
    </footer>
</body> 
</html> 

<?php
}

//if payment failed
else{   echo '<div class="alert alert-danger text-center center">Payment Failed</div>';  }
}else{
header('location:login.php'); 
}
?>