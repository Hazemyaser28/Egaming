<?php
session_start();
include 'admin/connect.php';
include 'init2.php';


  // -----------------------------------delete user when his reserve timeout---------------------------------------

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

  
  
  //  <!-------------------------------------delete user when his reserve timeout--------------------------------->
  


if(isset($_SESSION['user_id'])){
    header('location: index.php');       //redirect if he is logged in 
}




if($_SERVER['REQUEST_METHOD']=='POST'){
     if(isset($_POST['login'])){
          $user=$_POST['user'];
          $pass=$_POST['pass'];
          $hashpw= sha1($pass);
          $formerror = array();
     //check if the user is in database
     $stmt = $con->prepare("SELECT ID , username, PW , groupID FROM users WHERE username= ? AND PW=? ");       //prepare is used to clac before enter the site and reduced threats
     $stmt-> execute(array($user , $hashpw));
     $member = $stmt->rowCount();
     $group=$stmt->fetch();

     //if greater than 0 then he ia a member 
     if($member>0){
          $user_id=$group['ID'];
          //////IF HE IS ADMIN//////
          if($group['groupID']==1){
          $_SESSION['admin'] = $user; 
          $_SESSION['admin_id'] = $user_id;
          header('location: admin/dashboard.php');   
          exit();}
             if($group['groupID']==0){
             $_SESSION['user_id'] = $group['ID'];
             $_SESSION['user'] = $user; 
             header('location: index.php');   
             exit();  }}
             


     else {
     $stmt = $con->prepare("SELECT HostID,activated , hostuser, hostpass FROM internetcafe WHERE hostuser= ? AND hostpass=? "); 
     $stmt-> execute(array($user , $hashpw));
     $count = $stmt->rowCount();
     $cafedata=$stmt->fetch();
  
     if($count>0){
    $cafedata['activated'];
     //IF host is activated
                   if($cafedata['activated']==1){
                           $_SESSION['host'] = $user; 
                           $_SESSION['HOST_ID'] = $cafedata['HostID'];
                          header('location: cyberhome.php');  
                                                     exit();}
                                        //Host not activated 
                               if($cafedata['activated']==0){
                              $formerror[]='Account isn\'t activated yet! ☹';  }

                                      //host deactivated himself
                                    if($cafedata['activated']==2){
                                      $formerror[]='Account is deactivated sent and email to egymaing.egy@gmail.com to active it.';  }}
    //if wrong username or password
     else {
      $formerror[]='Check Username or Password';
     }}}}
    
    
     ?>





<!doctype html>
<html lang="en">
<html>
<head>
      <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <link href="https://fonts.googleapis.com/css?family=Open+Sans&display=swap" rel="stylesheet">

  <!--------style sheets--->
  
      <link rel="stylesheet" href="design/css/bootstrap.min.css"/>
      <link rel="stylesheet" href="design/css/pages/login.css"/>
      <link rel="stylesheet" href="design/css/Animate.css"/>
    <link rel="stylesheet" href="design/icofont/icofont.min.css"/>
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.5.0/css/all.css" integrity="sha384-B4dIYHKNBt8Bc12p+WXckhzcICo0wtJAoU8YZTY5qE0Id1GSseTk6S+L3BlXeVIU" crossorigin="anonymous">
    
    <!--------end style sheets--->

    <link rel="shortcut icon" type="image/x-icon" href="design/images/game-controller-1400688-1189016.png">
      <title>Sign in</title>
</head>
<body  class="backg"> 

  <div> <!--background-->
    
    <!--navbar-->

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
          </ul>
        </div>
      </div>
    </nav>
     
    <!--end navbar-->
    <!---start form--------------------------------------------------------->
<section class="form">
  <div class="container">


    <section class="vh-100" >
      <div class="container h-100">
        <div class="row d-flex justify-content-center align-items-center h-100">
          <div class="col-lg-12 col-xl-11">
            <div class="card text-black bg-light" style="border-radius: 25px;">
              <div class="card-body p-md-5">
                <div class="row justify-content-center">
                  <div class="col-md-10 col-lg-6 col-xl-5 order-2 order-lg-1">
    
                    <p class="text-center h1 fw-bold mb-5 mx-1 mx-md-4 mt-4" style="color:darkred">Sign in</p>


                    <form class="mx-1 mx-md-4" action=""  method="POST"> 
    
                  

                      <div class="d-flex flex-row align-items-center mb-4">
                        <i class="fas fa-user-lock fa-lg me-3 fa-fw"></i>
                        <div class="form-outline flex-fill mb-0">
                          <input type="text" id="form3Example1c" name="user" class="form-control" />
                          <label class="form-label" for="form3Example1c">Username</label>
                        </div>
                      </div>
    
                   
                      <div class="d-flex flex-row align-items-center mb-4">
                        <i class="fas fa-lock fa-lg me-3 fa-fw"></i>
                        <div class="form-outline flex-fill mb-0">
                          <input type="password" id="form3Example4c" name="pass" class="form-control" />
                          <label class="form-label" for="form3Example4c">Password</label>
                        </div>
                      </div>
    
                      

                      <div class="form-check d-flex justify-content-center mb-5">
                        <label class="form-check-label" for="form2Example3">
                          Forget  <a href="forgetpassword/forgotPassword.php" style="color:black !important;">Password?</a>
                        </label>

                      </div>
                    </br>
                    </br>
                  </br>

                      <div class="d-flex justify-content-center mx-4 mb-3 mb-lg-4">
                        <button type="submit" name="login" class="btn btn-danger btn-lg">log in</button>
                      </div>
                    </form>
                  </div>


                  <div class="form-check d-flex justify-content-center mb-5">
                    <label class="form-check-label" for="form2Example3" style="color: red;"> <?php if (!empty($formerror)) { 
                      foreach($formerror as $error)   {  echo $error . "<br>"; }} ?> </label>
                  </div>

                  <div class="col-md-10 col-lg-6 col-xl-7 d-flex align-items-center order-1 order-lg-2">
                    <img src="design/images/20944201.jpg" alt="Register"
                                              class="img-fluid" >
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>











    <!---end--------------------------------------------------------->
</div>
</section>
<!-- end Login form -->

<footer>
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