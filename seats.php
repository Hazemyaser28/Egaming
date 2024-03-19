 <?php
session_start();
include 'init2.php';

// -----------------------------------select seat start-------------------------------

$stmt=$con->prepare("SELECT all_seats,hostuser,cybername FROM internetcafe WHERE HostID=? ");
$stmt->execute(array($_GET['host_id']));
$all=$stmt->fetch();
$seat=$all['all_seats'];
$seats=1;
$_SESSION['host_id']=$_GET['host_id'];
$_SESSION['host_name']=$all['hostuser'];
$_SESSION['cname']=$all['cybername'];


//---------------------------------------getting user id---------------------------------
$stmt=$con->prepare("SELECT userID FROM seats WHERE host_id=? ");
$stmt->execute(array($_GET['host_id']));
$user_id=$stmt->fetchAll(PDO::FETCH_COLUMN);


// -----------------------------------user id end-------------------------------


?> 






<!doctype html>
<html lang="en">
<html>
<head>
      <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <link href="https://fonts.googleapis.com/css?family=Open+Sans&display=swap" rel="stylesheet">

  <!--------style sheets--->
  
  <link rel="stylesheet" href="design/css/bootstrap.min.css"/>
      <link rel="stylesheet" href="design/css/pages/seats.css"/>
      <link rel="stylesheet" href="design/css/Animate.css"/>
    <link rel="stylesheet" href="design/icofont/icofont.min.css"/>
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.5.0/css/all.css" integrity="sha384-B4dIYHKNBt8Bc12p+WXckhzcICo0wtJAoU8YZTY5qE0Id1GSseTk6S+L3BlXeVIU" crossorigin="anonymous">
    
    <!--------end style sheets--->

    <link rel="shortcut icon" type="image/x-icon" href="design/images/game-controller-1400688-1189016.png">
      <title>Booking</title>
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
                <a class="nav-link active" aria-current="page" href="index.php">Home </a>
              </li>
              <li class="nav-item dropdown">
              <?php
              if(isset($_SESSION['user_id'])){   
                $stmt = $con->prepare("SELECT username FROM users WHERE ID=?"); 
                $stmt-> execute(array($_SESSION['user_id']));
                $usname=$stmt->fetch();?>
                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                <?=$usname['username']?>
                </a>
<?php } else{ ?>
                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                Profile
              </a>
<?php }?>
                <ul class="dropdown-menu bg-dark  " aria-labelledby="navbarDropdown">
                  <li><a class="dropdown-item bg-dark" href="profile.php">My profile</a></li>
                  <li><a class="dropdown-item bg-dark" href="logout.php">Logout</a></li>
                </ul>
              </li>
            </ul>
          </div>
        </div>
      </nav>
    <!--end navbar-->
<!-- seats -->

        <div class="container"> 
            <section id="seats">
                    <section class="vh-100" >
                        <div class="container h-100">
                          <div class="row d-flex justify-content-center align-items-center h-100">
                            <div class="col-lg-12 col-xl-11">
                              <div class="card text-black bg-light" style="border-radius: 25px;">
                                <div class="card-body p-md-5">
                                  <div class="row justify-content-center">
                                    <div class="col-md-10 col-lg-6 col-xl-5 order-2 order-lg-1">
                                        <p class="text-center h1 fw-bold mb-5 mx-1 mx-md-4 mt-4" style="color:darkred"><?=ucfirst($_SESSION['cname'])?> internet cafe</p>
                                    
                                      </div>
                                        </div>
                                        <div class="seat">


<?php
              //------------------ start  checking seat-----------------------------------------------
              
                            while ($seats <= $seat ) {  
                              for ($z = 3000; $z <= 4000; $z++) {
                              if(in_array($z,$user_id)){
                              date_default_timezone_set("Africa/Lagos");
                              $stmt=$con->prepare("SELECT TIMESTAMPDIFF (SECOND, time, NOW()) AS tdif, seat_booked FROM seats WHERE userID=$z");
                              $stmt->execute();
                              $time2=$stmt->fetch();
                              $start=$time2['tdif'];
                              $seatz=$time2['seat_booked'];
                                if($seatz==$seats &&$start>=0){ 
                                  ?>
                                    <div class="form-check form-check-inline mb-4">
                                       <div class="form-check button bg-transparent disabled ">
                                          <input class="form-check-input" type="radio" name="seats" value="<?=$seats?>"  id="flexRadioDefault1 a251<?=$seats?>" disabled>
                                            <label class="form-check-label" for="flexRadioDefault1 a251<?=$seats?>"><b>Reserved</b>
                                         </label>
                                      </div>
                                    </div>

                                    <?php 
                                      $seats++;   }}}
                              //---------------------------- end checking seat------------------------------------------------
                              ?>
                            
                              <form action="payment.php" method="POST">
                              <div class="form-check form-check-inline  mb-4">
                              <div class="form-check button bg-transparent">
                                <input class="form-check-input" type="radio" name="seats" value="<?=$seats?>"  id="flexRadioDefault1 a25<?=$seats?>">
                                <label class="form-check-label" for="flexRadioDefault1 a25<?=$seats?>"><b><?=$seats?></b>
                                </label>
                              </div>
                            </div>


                                <?php
                              $seats++;} ?>


                                             <div class="reserve">
                                           <div class="d-flex flex-row align-items-center mb-4">
                                           <i class="fas fa-hourglass fa-lg me-3 fa-fw"></i>
                                           <div class="form-outline flex-fill mb-0">
                                           <input type="number" id="form3Example4cd" class="form-control" name="hours" />
                                         <label class="form-label" for="form3Example4cd">How many hours?</label>
                                      </div>
                                    </div>
                                     <div class="d-flex flex-row align-items-center mb-4">
                                        <i class="fas fa-calendar fa-lg me-3 fa-fw"></i>
                                           <div class="form-outline flex-fill mb-0">
                                            <input type="datetime-local" id="form3Example3c" class="form-control" name="time" />
                                               <label class="form-label" for="form3Example3c">When?</label>
                                          </div>
                                        </div>
                                     <div class="d-flex justify-content-center mx-4 mb-3 mb-lg-4">
                                    <button type="submit" value="reserve" name="submit" class="btn btn-danger btn-lg">submit</button>
                            </form>
                        </div> 
                    </div>                 
                </div>
            </section>
         </div>
    </div>
  </section>





<?php


  // -----------------------------------delete user when his reserve timeout-------------------------------

$stmt=$con->prepare("SELECT userID FROM seats ");
$stmt->execute();
$id_user=$stmt->fetchAll(PDO::FETCH_COLUMN);

for ($x = 3000; $x <= 4000; $x++) {
    if(in_array($x,$id_user)){
date_default_timezone_set("Africa/Lagos");
$stmt=$con->prepare("SELECT TIMESTAMPDIFF (SECOND, time, NOW()) AS tdif, hours FROM seats WHERE userID=$x");
$stmt->execute();
$time1=$stmt->fetch();
$time=$time1['tdif'];
$hours=$time1['hours']*3600;

if ($time >= $hours) {

    $stmt = $con->prepare("DELETE FROM seats  WHERE userID=$x ");
    $stmt->execute();
}
}}
?>


 <!-- -----------------------------------delete user when his reserve timeout------------------------------- -->





  <!-- end seats-->
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