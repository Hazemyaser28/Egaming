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
      <link rel="stylesheet" href="design/css/pages/location.css"/>
      <link rel="stylesheet" href="design/css/Animate.css"/>
    <link rel="stylesheet" href="design/icofont/icofont.min.css"/>
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.5.0/css/all.css" integrity="sha384-B4dIYHKNBt8Bc12p+WXckhzcICo0wtJAoU8YZTY5qE0Id1GSseTk6S+L3BlXeVIU" crossorigin="anonymous">
    
    <!--------end style sheets--->

    <link rel="shortcut icon" type="image/x-icon" href="design/images/game-controller-1400688-1189016.png">
      <title>locations</title>
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
if (isset($_GET['location'])){ $location= $_GET['location'];}
else{   $location='all';  }

// <!-- locations -->


             
if($location== 'all'){ ?>
<section id="home">
    <div id="home"> 
        <h1><span class="badge bg-gradient "><?=ucfirst($_GET['location'])?> Cybers </span></h1>

        <div class="container">
        <table class="table table-responsive table-borderless  text-bg-dark  " >
        </br>
            <thead>
              <tr>
                <th scope="col" class="textT">Internet cafe name</th>
                <th scope="col" class="textT">Location</th>
              </tr>
            </thead>
            <tbody>
              <?php
$stmt=$con->prepare("SELECT hostID,hostuser,cybername,location FROM internetcafe WHERE
 location!='maadi' 
AND location!='zamalek' 
AND location!='nasr city'
AND location!='5th settlement'
AND activated=1");
$stmt->execute();
$data=$stmt->fetchAll();
foreach($data as $loca){
$_SESSION['host_name']=$loca['hostuser'];
$_SESSION['hostID']=$loca['hostID'];
 ?>
        <tr>
            <th scope="row" class="textT"><?=$loca['cybername']?></th>
            <th scope="row" class="textT"><?=$loca['location']?></th>
            <td><a style='text-decoration:none' class='btn btn-danger btn-card text-align center' 
            href='seats.php?host_id=<?=$_SESSION['hostID']?>'>Enter </a>
            </td>
          </tr>
          
   <?php } ?>
   </tbody>
   </table>
  </div>
</div>
</div>
</div> 
</div>
</section>
<?php
   } 
   
   else{
?>


<section id="home">
    <div id="home"> 
        <h1><span class="badge bg-gradient "><?=ucfirst($_GET['location'])?> Cybers </span></h1>

        <div class="container">
        <table class="table table-responsive table-borderless  text-bg-dark  " >
        </br>
            <thead>
              <tr>
                <th scope="col" class="textT">Internet cafe name</th>
              </tr>
            </thead>
            <tbody>

            <?php

if($location== 'maadi'){
foreach(getlocat('cybername') as $loca){
$stmt=$con->prepare("SELECT hostID,hostuser FROM internetcafe WHERE activated=1 AND cybername=? AND location=?");
$stmt->execute(array($loca['cybername'], $_GET['location']));
$data=$stmt->fetch();
$_SESSION['host_name']=$data['hostuser'];
$_SESSION['hostID']=$data['hostID'];
?>

<tr>
<th scope="row" class="textT"><?=$loca['cybername']?></th>
<td><a style='text-decoration:none' class='btn btn-danger btn-card text-align center' 
href='seats.php?host_id=<?=$_SESSION['hostID']?>'>Enter </a>
</td>
</tr>
<?php }}
?>
              <?php              
              if($location== 'zamalek'){
              foreach(getlocat('cybername') as $loca){
                   $stmt=$con->prepare("SELECT hostID,hostuser FROM internetcafe WHERE  activated=1 AND cybername=? AND location=?");
                       $stmt->execute(array($loca['cybername'],$_GET['location']));
                         $data=$stmt->fetch();
                       $_SESSION['host_name']=$data['hostuser'];
                   $_SESSION['hostID']=$data['hostID'];  ?>
                <tr>
                    <th scope="row" class="textT"><?=$loca['cybername']?></th>
                    <td><a style='text-decoration:none' class='btn btn-danger btn-card text-align center' 
                    href='seats.php?host_id=<?=$_SESSION['hostID']?>'>Enter </a>
                    </td>
                  </tr>
          <?php }}
        ?>

                                            <?php              
                                            if($location== '5th settlement'){
                                            foreach(getlocat('cybername') as $loca){
                                            $stmt=$con->prepare("SELECT hostID,hostuser FROM internetcafe WHERE cybername=? AND location=? AND activated=1");
                                            $stmt->execute(array($loca['cybername'],$_GET['location']));
                                            $data=$stmt->fetch();
                                            $_SESSION['host_name']=$data['hostuser'];
                                            $_SESSION['hostID']=$data['hostID'];
                                            ?>

                                                    <tr>
                                                        <th scope="row" class="textT"><?=$loca['cybername']?></th>
                                                        <td><a style='text-decoration:none' class='btn btn-danger btn-card text-align center' 
                                                        href='seats.php?host_id=<?=$_SESSION['hostID']?>'>Enter </a>
                                                        </td>
                                                      </tr>
                                              <?php }}
                                            ?>


                        <?php              
                        if($location== 'nasr city'){
                        foreach(getlocat('cybername') as $loca){
                        $stmt=$con->prepare("SELECT hostID,hostuser FROM internetcafe WHERE  activated=1 AND cybername=? AND location=?");
                        $stmt->execute(array($loca['cybername'],$_GET['location']));
                        $data=$stmt->fetch();
                        $_SESSION['host_name']=$data['hostuser'];
                        $_SESSION['hostID']=$data['hostID'];
                        ?>

                                <tr>
                                    <th scope="row" class="textT"><?=$loca['cybername']?></th>
                                    <td><a style='text-decoration:none' class='btn btn-danger btn-card text-align center' 
                                    href='seats.php?host_id=<?=$_SESSION['hostID']?>'>Enter </a>
                                    </td>
                                  </tr>
                          <?php }}
                        ?>



             </tbody>
            </table>
           </div>
         </div>
        </div>
      </div> 
    </div>
  </section>
  <?php } ?>
  <!-- end location-->
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