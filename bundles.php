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













<!-- bundles -->


<section id="bundels"> 


        <div id="carouselExampleCaptions" class="carousel slide carousely " data-bs-ride="false">
            <div class="carousel-indicators">
            <?php
$stmt =$con->prepare( "SELECT COUNT(*) FROM bundles");
$stmt->execute();
$number=2;
$count = $stmt->fetchcolumn();
for ($x = 0; $x < $count; $x++) {
  if ($x==0){ ?>
<button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
<?php 
}else{
?>
    <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="<?=$x ?>" aria-label="Slide <?=$number ?>"></button>
   
<?php
$number++;
}}
?>
            </div>
            <?php 
//get table bundles data
$stmt=$con->prepare("SELECT * FROM bundles");
$stmt->execute();
$bun=$stmt->fetchAll();
$num=0;
foreach($bun as $bundle){ 
  if ($num==0){ ?>
        <div class="carousel-inner">
              <div class="carousel-item active">
                <img src="bundles/<?=$bundle['ID']?>/<?=$bundle['bun_img'] ?>" class="d-block w-100 " alt="...">
                <div class="carousel-caption d-block">
                   <h2><?=$bundle['name'] ?> </h2>
                  <h5><?=$bundle['bundle_hours'] ?> Hours</h5>
                    <p><?=$bundle['description'] ?></p
                </br>
                 <!-- payment form -->
        <form  action="submit.php?bunid=<?=$bundle['ID']?>" method="POST">
<script
           src="https://checkout.stripe.com/checkout.js" class="stripe-button"
           data-key="<?php echo $publishableKey?>"
           data-amount="<?=$bundle['price']*100?>"
           data-name="<?=$bundle['name'] ?>"
           data-description="<?=$bundle['bundle_hours'] ?> hours bundle "
           data-image="design/images/pay.png"
           data-currency="EGP">
  </script>
  </form>
                </div>
              </div>

<?php
$num++;} else{
?>
              
              <div class="carousel-item ">
                <img src="bundles/<?=$bundle['ID']?>/<?=$bundle['bun_img'] ?>"  class="d-block w-50" alt="..." style="width: 100% !important; ">
                <div class="carousel-caption  d-block">
                  <h3><?=$bundle['name'] ?></h3>
                  <h5><?=$bundle['bundle_hours'] ?> Hours</h5>
                  <p><?=$bundle['description'] ?></p>
                </br>
                   <!-- payment form -->
                   <form  action="submit.php?bunid=<?=$bundle['ID']?>" method="POST">
<script
           src="https://checkout.stripe.com/checkout.js" class="stripe-button"
           data-key="<?php echo $publishableKey?>"
           data-amount="<?=$bundle['price']*100?>"
           data-name="<?=$bundle['name'] ?>"
           data-description="<?=$bundle['bundle_hours'] ?> hours bundle "
           data-image="design/images/pay.png"
           data-currency="EGP">
  </script>
  </form>
                </div>
              </div>
              
<?php
}}

?>
           
                   <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
              <span class="visually-hidden">Previous</span>
                </button>
               <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide="next">
                 <span class="carousel-control-next-icon" aria-hidden="true"></span>
                  <span class="visually-hidden">Next</span>
                </button>
            </div>
          </div>
  </section>

                                                              <!-- end bundles-->
  
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