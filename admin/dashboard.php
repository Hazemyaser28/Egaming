<?php
ob_start();
session_start();
include 'init2.php';
if(isset($_SESSION['admin_id'])){




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
  

<!doctype html>
<html lang="en">
<html>
<head>
      <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <link href="https://fonts.googleapis.com/css?family=Open+Sans&display=swap" rel="stylesheet">

  <!--------style sheets--->
  
      <link rel="stylesheet" href="design/css/bootstrap.min.css"/>
      <link rel="stylesheet" href="design/css/pages/admin.css"/>
      <link rel="stylesheet" href="design/css/all.min.css"/>
      <link rel="stylesheet" href="design/css/Animate.css"/>
    <link rel="stylesheet" href="design/icofont/icofont.min.css"/>
    
    <!--------end style sheets--->

    <link rel="shortcut icon" type="image/x-icon" href="design/images/game-controller-1400688-1189016.png">
      <title>Admin</title>
</head>
<body> 
    <!--------side bar--->

    <div class="container-fluid  ">
        <div class="row flex-nowrap">
            <div class="col-auto col-md-3 col-xl-2 px-sm-2 px-0  bg-gradient sidebar ">
                <div class="d-flex flex-column align-items-center align-items-sm-start px-3 pt-2  min-vh-100">
                    <a href="dashboard.php" class="d-flex align-items-center pb-3 mb-md-0 me-md-auto text-light text-decoration-none">
                        <span class="fs-5 d-none d-sm-inline">EGaming</span>
                    </a>


                    <ul class="nav nav-pills flex-column mb-sm-auto mb-0 align-items-center align-items-sm-start " id="menu" >

                    <li class="nav-item w-100">
                            <a href="dashboard.php" class="nav-link align-middle px-0 acitve ">
                                <i class="fs-4 fas fa-chart-area"></i> <span class="ms-1 d-none d-sm-inline   ">Dashboard</span>
                            </a>
                        </li>

                        <li class="nav-item w-100">
                            <a href="host_control.php" class="nav-link align-middle px-0 ">
                                <i class="fs-4 fas fa-business-time"></i> <span class="ms-1 d-none d-sm-inline ">Host control</span>
                            </a>
                        </li>
                       
                        <li>
                            <a href="admin_bundle.php" class="nav-link px-0 align-middle">
                                <i class="fs-4 fas fa-list"></i> <span class="ms-1 d-none d-sm-inline ">Bundles</span> </a>
                        </li>
                        <li class="nav-item w-100">
                            <a href="new_admin.php" class="nav-link px-0 align-middle">
                                <i class="fs-4 fas fa-user-lock"></i> <span class="ms-1 d-none d-sm-inline">Add new admin</span> </a>

                            </a>
                        </li>
                    </ul>
                    <hr>
                    
                    <div class="dropdown pb-4 ">
                        <a href="#" class=" d-flex align-items-center  text-decoration-none dropdown-toggle" id="dropdownUser1" data-bs-toggle="dropdown" aria-expanded="false">
                            <img src="design/images/game-controller-1400688-1189016.png" alt="hugenerd" width="30" height="30" class="rounded-circle">
                            <span class="d-none d-sm-inline mx-1"><?php 
                            $stmt=$con->prepare("SELECT username FROM users WHERE ID=?");
                            $stmt->execute(array($_SESSION['admin_id']));
                            $user_of_host=$stmt->fetch();
                            echo ucfirst($user_of_host['username']);
                            ?></span>
                        </a>
                        <ul class="dropdown-menu dropdown-menu" aria-labelledby="dropdownUser1">
                            <li><a class="dropdown-item" href="admin_profile.php">Profile</a></li>
                            <li>
                                <hr class="dropdown-divider">
                            </li>
                            <li><a class="dropdown-item" href="logout.php">Sign out</a></li>
                        </ul>
                    </div>
                </div>

            </div>
                <!-------- end side bar--->

            <div class="col py-5 test">
                <section class="wow fadeIn animated" style="visibility: visible; animation-name: fadeIn;">
                    <div class="container ">
                        <div class="row ">
                            <!-- counter -->
                            <div class=" col-md-2 col-sm-6 bottom-margin text-center counter-section wow fadeInUp sm-margin-bottom-ten animated  " data-wow-duration="600ms" style="visibility: visible; animation-duration: 600ms; animation-name: fadeInUp;">
                                <i class="fa fa-user -end medium-icon"></i>
                                 <span class="timer counter alt-font appear" data-to="980" data-speed="7000"><a href="host_control.php"  style="text-decoration:none; color:red;"><?=countitems('HostID','internetcafe')?></a></span>
                                <span class="counter-title">Total Hosts</span>
                            </div>
                            <!-- end counter -->
                            <!-- counter -->
                            <div class=" col-md-2 col-sm-6 bottom-margin text-center counter-section wow fadeInUp sm-margin-bottom-ten animated  " data-wow-duration="600ms" style="visibility: visible; animation-duration: 600ms; animation-name: fadeInUp;">
                                <i class="fa fa-hourglass-end medium-icon"></i>
                                 <span class="timer counter alt-font appear" data-to="980" data-speed="7000"><a href="host_control.php?redirect=admin&accept=pending" style="text-decoration:none; color:red;"><?= checkitem('activated','internetcafe',0)?></a></span>
                                <span class="counter-title">Pending Host Request</span>
                            </div>
                            <!-- end counter -->
                            <!-- counter -->
                            <div class=" col-md-2 col-sm-6 bottom-margin-small text-center counter-section wow fadeInUp xs-margin-bottom-ten animated  " data-wow-duration="900ms" style="visibility: visible; animation-duration: 900ms; animation-name: fadeInUp;">
                                <i class="fa fa-user-lock medium-icon"></i>
                                 <span class="timer counter alt-font appear" data-to="810" data-speed="7000"><a href="#" style="text-decoration:none; color:red;"><?=  checkitem('groupID','users',1)?></a></span>
                                <span class="counter-title">Total Admins</span>
                            </div>
                            <!-- end counter -->
                                 <!-- counter -->
                                 <div class=" col-md-2 col-sm-6 bottom-margin-small text-center counter-section wow fadeInUp xs-margin-bottom-ten animated  " data-wow-duration="900ms" style="visibility: visible; animation-duration: 900ms; animation-name: fadeInUp;">
                                 <i class="fa-solid fa-handshake-simple-slash medium-icon"></i>

                                 <span class="timer counter alt-font appear" data-to="810" data-speed="7000"><a href="host_control.php?redirect=admin&deactivated=de" 
                                  style="text-decoration:none; color:red;"><?= checkitem('activated','internetcafe',2)?></a></span>
                                <span class="counter-title">Deactivated Hosts</span>
                            </div>
                            <!-- end counter -->
                            <!-- counter -->
                            <div class=" col-md-2 col-sm-6 text-center counter-section wow fadeInUp animated " data-wow-duration="1200ms" style="visibility: visible; animation-duration: 1200ms; animation-name: fadeInUp;">
                                <i class="fa fa-heart medium-icon"></i>
                                 <span class="timer counter alt-font appear" data-to="600" data-speed="7000"><a href="#"  style="text-decoration:none; color:red;"><?= countitems('ID','users')?></a></span>
                                <span class="counter-title">Total Site Members</span>
                    </div>

<div class="container latest middle " >
<div class="row">
<div class="col-sm-6 " style="margin:10px auto;">
    <ul class="list-group">
        <li class="list-group-item bg-gradient"> Latest booking </li>
            <?php

                $stmt=$con->prepare("SELECT  seats.*, users.fullname  AS  full_name ,internetcafe.cybername AS cname FROM  seats 
                INNER JOIN  users ON  seats.userID = users.ID 
                INNER JOIN  internetcafe ON  seats.host_id = internetcafe.HostID LIMIT 5 "); 
                $stmt->execute();
                $count_res = $stmt->rowCount();
                $data=$stmt->fetchAll();

            if($count_res>0){
             foreach ($data as $user) {
                 echo '<li class="list-group-item bg-dark text-light">'. $user['full_name']. ' has reserved a seat at '. $user['cname'].
                  ' internet cafe </li>';
              }}
              else{
                echo '<li class="list-group-item bg-dark text-light"> no new Booking </li>';
              }
            ?>
        </ul>
</div>
 <div class="col-sm-6" style="margin:10px auto;">
    <ul class="list-group">
        <li class="list-group-item bg-gradient"> Latest added bundles </li>
        
                                <?php
                    $lastbun=getlatest('*','bundles','ID',5);
                    if(countitems('ID','bundles')>0){
                        foreach ($lastbun as $bundle) {
                            echo '<li class="list-group-item bg-dark text-light">'. $bundle['name']. ' gives user '. $bundle['bundle_hours']. 
                            ' hour </li>';
                        }}
                        else{
                        echo '<li class="list-group-item bg-dark text-light"> no new Booking </li>';
                        }
                      ?>
             </ul>
         </div>
     </div>
</div>
                                     <!-- end counter -->

                            </section>       
    
    
    </div>
      <!-- end dashboard-->
<?php
 } 
else {
    header('location:../login.php');  
}
ob_end_flush();
?>

    
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