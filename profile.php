<?php
session_start();
include 'init2.php'; 
?>

<!doctype html>
<html lang="en">
<html>
<head>
      <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <link href="https://fonts.googleapis.com/css?family=Open+Sans&display=swap" rel="stylesheet">

  <!--------style sheets--->
  
  <link rel="stylesheet" href="design/css/bootstrap.min.css"/>
      <link rel="stylesheet" href="design/css/pages/profile.css"/>
      <link rel="stylesheet" href="design/css/Animate.css"/>
    <link rel="stylesheet" href="design/icofont/icofont.min.css"/>
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.5.0/css/all.css" integrity="sha384-B4dIYHKNBt8Bc12p+WXckhzcICo0wtJAoU8YZTY5qE0Id1GSseTk6S+L3BlXeVIU" crossorigin="anonymous">
    
    <!--------end style sheets--->

    <link rel="shortcut icon" type="image/x-icon" href="design/images/game-controller-1400688-1189016.png">
      <title>Profile</title>
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
            <?php
    if(isset($_SESSION['HOST_ID'])){ ?>
              <li class="nav-item d-flex">
                <a class="nav-link active" aria-current="page" href="cyberhome.php">Host Page </a>
              </li>
              <?php }else 
              { ?>
              <li class="nav-item d-flex">
                <a class="nav-link active text-light" aria-current="page" href="index.php">Home </a>
              </li>

          <?php    } ?>
          </div>
        </div>
      </nav>
      
    <!--end navbar-->
<?php
    if(isset($_SESSION['user_id'])){
    $stmt=$con->prepare("SELECT * FROM users WHERE ID=? ");
    $stmt->execute(array($_SESSION['user_id']));
    $info =$stmt->fetch(); 
    ?>
<!-- profile -->
<section id="home">

      
  <div class="container mt-4 mb-4 p-3 d-flex justify-content-center"> 
    <div class="card p-4"> 
     <div class=" image d-flex flex-column justify-content-center align-items-center">
        <button class="btnimg btn-secondary"> 
           <img src="design/images/game-controller-1400688-1189016.png" height="100" width="100" />
            </button> <span class="name mt-3" aria-placeholder="name"><?=$info['username']?></span> <span class="idd" 
            aria-placeholder="email"><?=$info['email']?></span>
            
              <div class="d-flex flex-row justify-content-center align-items-center gap-2"> 
                </i></span> </div> <div class="d-flex flex-row justify-content-center align-items-center mt-3"> 
                  <form action="editprofile.php" method="POST" class="d-flex d-md-block flex-column   align-item-center justify-content-center ">
                      <button name="edit" type="submit" class="btn1 btn-dark bg-dark btn">Edit Profile</button> 
                      <button name="password"  type="submit" class="btn1 mt-3 mt-md-0 btn-dark bg-danger btn">Change Password</button>
                    </div></form>
                      <div class="text mt-3">

                      </br>
                        <label for="exampleInputEmail1">Full Name:</label>
                        <label for="exampleInputEmail1"><?=$info['fullname']?></label>

                        </br>
                        <label for="exampleInputEmail1">Joined on:</label>
                        <label for="exampleInputEmail1"><?=$info['date']?></label>

                        </br>
                        <label for="exampleInputEmail1">Age:</label>
                       <label for="exampleInputEmail1"><?=$info['age']?></label>

                        </br>
                      <label style="color:red" for="exampleInputEmail1">Balance:</label>
                    <label style="color:red" for="exampleInputEmail1"><b><?=$info['hours']?> Hour</b></label><br>
                    <a style="text-decoration:none; width:100% "  class="btn btn-primary btn-card" href="bundles.php"> 
                    <span style="font-weight:bold; ">Get More Hours</span></a>
                    </div> <br>

                    <?php
$exsist=checkitem('userID','seats',$_SESSION['user_id']);
    if ($exsist>0){
      ?>




<div class="d-flex d-md-block flex-column   align-item-center justify-content-center"> 
<button  data-bs-toggle="modal" data-bs-target="#exampleModal1" type="button" style="margin:4px;"
class="btn btn-warning ">view Reservation details</button>
<button  data-bs-toggle="modal" data-bs-target="#exampleModal12" type="button"
class="btn btn-danger mt-3 mt-md-0 ">delete reservation</button> 
</div>                                       

                                            <!--details Modal -->
 <div class="modal fade" id="exampleModal1" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
      <div class="modal-content">
        <div class="modal-header ">
          <h5 class="modal-title " id="exampleModalLabel">reservation details</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <?php 
            $stmt=$con->prepare("SELECT  seats.*,internetcafe.cybername AS cname FROM  seats 
            INNER JOIN  internetcafe ON  seats.host_id = internetcafe.HostID WHERE userID=?"); 
            $stmt->execute(array($_SESSION['user_id']));
            $info =$stmt->fetch(); ?>
            you have reserves seat number <?=$info['seat_booked']?> at <?=$info['cname']?> internetcafe at <?=$info['time']?> see you there.
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
          
 
        </div>
      </div>
    </div>
  </div>
                                                          <!-- end details Modal -->

                                                        <!--start delete Modal -->
  <div class="modal fade" id="exampleModal12" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
      <div class="modal-content">
        <div class="modal-header ">
          <h5 class="modal-title " id="exampleModalLabel">delete reservation</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
             Are you sure you want to delete your reservation? your money may take up to 24 hour to be restored.
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
         <form action="delres.php" method="POST">
          <button type="submit" name="delete" class="btn btn-danger">Confirm</button>
          </form>
        </div>
      </div>
    </div>
  </div>
                                                          <!-- end delete Modal -->






                 
   <?php  
  } 
?>
                
           </div> </div> </div>





    </div>
  </section>
  <!-- end profile-->
  

  <?php
}
elseif(isset($_SESSION['HOST_ID'])){
  $stmt=$con->prepare("SELECT * FROM internetcafe WHERE HostID=? ");
  $stmt->execute(array($_SESSION['HOST_ID']));
  $info =$stmt->fetch(); 

  if(isset($_POST['deactivate'])){
    $count=checkitem('host_id','seats',$_SESSION['HOST_ID']);
    if($count>0){
    $info2[]='you cannot deactivate your account while there is reservations';
    }else{
    $stmt=$con->prepare("UPDATE internetcafe  SET activated=2 WHERE HostID=?");
    $stmt->execute(array($_SESSION['HOST_ID']));
    header('location:login.php');
    }}
  ?>
<!-- profile -->
<section id="home">

    
<div class="container mt-4 mb-4 p-3 d-flex justify-content-center"> 
  <div class="card p-4"> 
   <div class=" image d-flex flex-column justify-content-center align-items-center">
      <button class="btnimg btn-secondary"> 
         <img src="design/images/game-controller-1400688-1189016.png" height="100" width="100" />
          </button> <span class="name mt-3" aria-placeholder="name"><?=$info['hostuser']?></span> <span class="idd" 
          aria-placeholder="email"><?=$info['email']?></span>
          
            <div class="d-flex flex-row justify-content-center align-items-center gap-2"> 
              </i></span> </div> <div class="d-flex flex-row justify-content-center align-items-center mt-3"> 
                <form action="editprofile.php" method="POST">
                    <button name="edithost" type="submit" class="btn1 btn-dark bg-dark btn">Edit Profile</button> 
                    <button name="passwordhost" type="submit" class="btn1 btn-dark bg-danger btn">Change Password</button>
                  </div></form>
                    <div class="text mt-3">

                    </br>
                      <label for="exampleInputEmail1">Cyber name:</label>
                      <label for="exampleInputEmail1"><?=$info['cybername']?></label>

                      </br>
                      <label for="exampleInputEmail1">Joined on:</label>
                      <label for="exampleInputEmail1"><?=$info['date']?></label>

                      </br>
                      <label for="exampleInputEmail1">Location:</label>
                     <label for="exampleInputEmail1"><?=$info['location']?></label>

         
                  </div> <br>



                  
                  <button  data-bs-toggle="modal" data-bs-target="#exampleModal" type="button" style="min-height:70px;"
                  class="btn1 btn-dark bg-danger btn">DEACTIVATE ACCOUNT</button> 
                  <?php if (!empty($info2)) { 
                      foreach($info2 as $information)   {  echo  '<div class="text-center">'. $information .'</div>'; }} ?>

                                                            <!-- Modal -->
 <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
      <div class="modal-content">
        <div class="modal-header ">
          <h5 class="modal-title " id="exampleModalLabel">Deactivation</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
             Are you sure you want to Deactivate account.
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
          <form action="" method="POST">
          <button type="submit" name="deactivate" class="btn btn-danger">Confirm</button>
          </form>
        </div>
      </div>
    </div>
  </div>
                                                          <!-- end Modal -->



                  <div class="gap-3 mt-3 icons d-flex flex-row justify-content-center align-items-center">                                     
                <span><i class="fa fa-twitter"></i></span> <span><i class="fa fa-facebook-f"></i></span>
             <span><i class="fa fa-instagram"></i></span> <span><i class="fa fa-linkedin">
         </i></span> </div> <div class=" px-2 rounded mt-4 date ">
         </div> </div> </div>





  </div>
</section>
<!-- end profile-->



<?php
}


else{
  header('location:login.php');
}
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