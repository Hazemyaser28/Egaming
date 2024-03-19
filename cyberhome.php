<?php
session_start();
$pagetitle='Home';
include 'init2.php';
if(isset($_SESSION['HOST_ID'])){ 



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

  
  //  <!-- -----------------------------------delete user when his reserve timeout------------------------------- -->
  



$hostID=$_SESSION['HOST_ID'];
$stmt=$con->prepare("SELECT  seats.*, users.fullname AS  full_name FROM  seats INNER JOIN  users ON  seats.userID = users.ID WHERE host_id=?"); 
$stmt->execute(array($_SESSION['HOST_ID']));
$count_res = $stmt->rowCount();
$data=$stmt->fetchAll();
if(isset($_POST['add'])){
  $stmt=$con->prepare("SELECT all_seats FROM internetcafe WHERE HostID=? ");
  $stmt->execute(array($_SESSION['HOST_ID']));
  $seats =$stmt->fetch(); 
$new_seats=$seats['all_seats']+1;
  $stmt=$con->prepare("UPDATE internetcafe  SET all_seats=? WHERE HostID=?");
  $stmt->execute(array($new_seats,$_SESSION['HOST_ID']));
$info[]='seat added you now have '.$new_seats.' seat';
}
if(isset($_POST['delete'])){
  $stmt=$con->prepare("SELECT host_id FROM seats WHERE host_id = ? ");
  $stmt->execute(array($_SESSION['HOST_ID']));
  $count1 = $stmt->rowCount();


  $stmt=$con->prepare("SELECT all_seats FROM internetcafe WHERE HostID=? ");
  $stmt->execute(array($_SESSION['HOST_ID']));
  $seats =$stmt->fetch(); 

if($count1==$seats['all_seats']){
  $info[]='all seats are reserved you cannot delete any right now.';
}else{
$new_seats=$seats['all_seats']-1;
  $stmt=$con->prepare("UPDATE internetcafe  SET all_seats=? WHERE HostID=?");
  $stmt->execute(array($new_seats,$_SESSION['HOST_ID']));
  $info[]='seat deleted you now have ' .$new_seats.' seat';
  }}

    ?>



<!doctype html>
<html lang="en">
<html>
<head>
      <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <link href="https://fonts.googleapis.com/css?family=Open+Sans&display=swap" rel="stylesheet">

  <!--------style sheets--->
  <link rel="stylesheet" href="design/css/bootstrap.min.css"/>
      <link rel="stylesheet" href="design/css/pages/bundles.css"/>
      <link rel="stylesheet" href="design/css/Animate.css"/>
    <link rel="stylesheet" href="design/icofont/icofont.min.css"/>
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.5.0/css/all.css" integrity="sha384-B4dIYHKNBt8Bc12p+WXckhzcICo0wtJAoU8YZTY5qE0Id1GSseTk6S+L3BlXeVIU" crossorigin="anonymous">

    <!--------end style sheets--->
    <link rel="shortcut icon" type="image/x-icon" href="design/images/game-controller-1400688-1189016.png">
      <title>Host</title>
</head>
<body> 
  <div class="bg"> <!--background-->
    <!--navbar--->
    <nav class="navbar navbar-expand-lg bg-danger">
        <div class="container-fluid d-flex align-items-center justify-content-between">
          <a class="navbar-brand heartBeat progress-bar-animated" style="color: rgb(124, 19, 19)!important" href="#"><i class="icofont-game-controller" style="font-size:30px "></i></a>
          <button class="navbar-toggler bg-danger" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
          </button>
          <div class="collapse navbar-collapse flex-grow-0" id="navbarSupportedContent">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0" > 

              <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                  <?=ucfirst($_SESSION['host'])?>
                </a>
                <ul class="dropdown-menu bg-dark  " aria-labelledby="navbarDropdown">
                  <li><a class="dropdown-item bg-dark" href="profile.php">My Profle</a></li>
                  <li><a class="dropdown-item bg-dark" href="logout.php">Logout</a></li>
                </ul>
              </li>
            </ul>
          </div>
        </div>
      </nav>
    <!--end navbar-->
<!-- seats host -->
<section id="home">
    <div id="home"> 
        <h1><span class="badge bg-transparent ">Welcome <?=ucfirst($_SESSION['host'])?> to host page</span></h1>

        <div class="container">
            <?php
            if($count_res>0){ ?>
 


        <table class="table table-responsive table-borderless  text-bg-dark  " >
        </br>
            <thead>

              <tr>
                <th scope="col" class="textT">Reserver name</th>
                <td scope="col" class="textT">            Seat number     </td>
                <td scope="col" class="textT">             Hours     </td>
                <td scope="col" style= "float: right;" class="textT">             Date     </td>
              </tr>
            </thead>
            <tbody>
            <?php
            foreach($data as $details){ 
    ?>
                <tr>

                    <th scope="row" class="textT"><?=$details['full_name']?></th>
                    <th scope="row" class="textT"><?=$details['seat_booked']?></th>
                    <th scope="row" class="textT"><?=$details['hours']?></th>
                    <th scope="row"  style= "float: right;"class="textT"><?=$details['time']?></th>
       
                    </td>
                  </tr> 
                  <?php
            } ?>
            </tbody>
          </table>
        </div>
        <?php }
        else {
            $nores[]= '<div> 0 seats reserved </div>';
        }
        ?>
    </div>
   
    <?php if (!empty($nores)) { 
                      foreach($nores as $no_res)   {  echo  '<div class="alert alert-warning  text-center"  >'. $no_res .    '</div>'; }} ?>
    <form action="" class="d-grid gap-5 d-md-block  h-25" method="POST">
        <button class="btn btn-success btn-lg h-100 gap-5" name="add" style="width: 200px !important;" type="submit">Add new seat</button>
        
        <button class="btn btn-danger btn-lg h-100" style="width: 200px !important;"  type="button" data-bs-toggle="modal"
         data-bs-target="#exampleModal">Delete a seat</button><br><br>

         <?php if (!empty($info)) { 
                      foreach($info as $information)   {  echo  '<div class="alert alert-secondary  text-center"  >'. $information .    '</div>'; }} ?>
    </form>
      
<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
      <div class="modal-content">
        <div class="modal-header ">
          <h5 class="modal-title " id="exampleModalLabel">Delete</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
             Are you sure you want to delete a seat?
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
          <form action="" method="POST">
          <button type="submit" name="delete" class="btn btn-danger">Confirm</button>
          </form>
        </div>
      </div>
    </div>
  </div>
<!-- end Modal -->
    </div>
   </div>
   </div>     
    </div>
  </section>
  <!-- end seats host-->
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
else{
    header('location:login.php');
}
?>
