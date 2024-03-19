<?php
session_start();
include 'init2.php';
require('config.php');

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
      <title>Bundles</title>
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
                  <li><a class="dropdown-item bg-dark" href="profile.php">My Profile</a></li>
                  <li><a class="dropdown-item bg-dark" href="logout.php">Logout</a></li>
                </ul>
              </li>
            </ul>
          </div>
        </div>
      </nav>
      
    <!--end navbar-->
    <?php
if(isset($_POST['delete'])){   
 

 $stmt =$con->prepare("DELETE FROM seats WHERE userID=?"); 
        $stmt->execute(array($_SESSION['user_id']));
        ?>

      <section id="home">
    <div class="container mt-4 mb-4 p-3 d-flex justify-content-center"> 
    
                        <div class="text mt-3"> <?php
            $redimsg= '<div class="alert alert-primary  text-center" ><b> Reservation has been deleted successfuly yur money may take up to 24 hours <br> 
            to be restored to your account </b></div>';
        redirection($redimsg,'profile',5);
                       
                        ?>
                      </div>
                     </div>
              </section>   
      <?php
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