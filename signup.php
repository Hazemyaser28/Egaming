<?php
session_start();
include 'init2.php';
if(isset($_POST['submit'])){
   $username= $_POST['username'];
   $email= $_POST['email'];



   //error arrays
    $formerror1=array();
    $formerror2=array();
    $formerror3=array();
    $formerror4=array();
    $formerror5=array();
    $formerror6=array();
    $formerror7=array();
  
    //check for full name
    if (isset($_POST['fname'])){
        $filtername= filter_var($_POST['fname'], FILTER_SANITIZE_STRING);
        if (strlen($filtername)<10){
            $formerror1[]='Enter your full name';     
      }  }
  
    //validate username
  if (isset($_POST['username'])){
       $filteruser= filter_var($_POST['username'], FILTER_SANITIZE_STRING);
       if (strlen($filteruser)<4){
            $formerror2[]='Username must be more than 4 chars';
       }
  }

   //  validate email
   if (isset($_POST['email'])){
      $filteremail= filter_var($_POST['email'], FILTER_SANITIZE_EMAIL);
      if (filter_var($filteremail,FILTER_VALIDATE_EMAIL)!= true ){
           $formerror3[]='enter a valid email';
      }
  }
  if(empty($formerror3)){
      //Check That email is Unique
      $check1=checkitem("email","internetcafe",$email);
      $check2=checkitem("email","users",$email);
      if($check1+$check2>0){ 
          $formerror3[]  = ' email Already Exsist'; 
      }}
  
        // validate password 
    if (isset($_POST['pass1']) && isset($_POST['pass2']))
  
    {
     if (empty($_POST['pass1'])){
          $formerror4[]='password cant be empty';  
     }  
     $pass1= sha1($_POST['pass1']) ;
     $pass2= sha1($_POST['pass2']) ;
     if($pass1 !== $pass2){
          $formerror5[]= 'password dosen\'t match';
     }
    }
  //age
      if (empty($_POST['age'])){
           $formerror6[]='You must enter your age. ';
      }

//terms 
   if (empty($_POST['terms'])){
         $formerror7[]='You must read and agree on our terms and conditions. ';  
     }
    
    //if there is no error update database
    if(empty($formerror2)){
          //Check That Username is Unique
          $check=checkitem("hostuser","internetcafe",$username);
          $check3=checkitem("username","users",$username);
          if($check+$check3>0){ 
              $formerror2[]  = ' Username Already Exsist'; 
          }
          if(empty($formerror1)&&empty($formerror2)&&empty($formerror3)&&empty
          ($formerror4)&&empty($formerror5)&&empty($formerror6)&&empty($formerror7)){
                    //update database
                    $stmt = $con->prepare("INSERT INTO users (username,PW,fullname,email,age,date,activation)
                    VALUES(:zuser,:zpass,:zfullname,:zemail,:zage,now(),0)");     
                    //execute query
                    $stmt-> execute(array(
                    'zuser'=> $_POST['username'],
                    'zpass'=> sha1($_POST['pass1']),
                    'zfullname'=> $_POST['fname'],
                    'zemail'=> $_POST['email'],
                    'zage'=> $_POST['age'])) ; 
                    //success message
                    header('location:login.php'); 
 
}
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
      <link rel="stylesheet" href="design/css/pages/signup.css"/>
      <link rel="stylesheet" href="design/css/Animate.css"/>
    <link rel="stylesheet" href="design/icofont/icofont.min.css"/>
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.5.0/css/all.css" integrity="sha384-B4dIYHKNBt8Bc12p+WXckhzcICo0wtJAoU8YZTY5qE0Id1GSseTk6S+L3BlXeVIU" crossorigin="anonymous">
    
    <!--------end style sheets--->

    <link rel="shortcut icon" type="image/x-icon" href="design/images/game-controller-1400688-1189016.png">
      <title>Register </title>
</head>
<body  class="backg"> 

  <div > <!--background-->
    
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
            <li class="nav-item">
              <a class="nav-link" href="login.php">Sign in</a>
            </li>
          </ul>
        </div>
      </div>
    </nav>  
    <!--end navbar-->

  <!-- start register form -->
<section class="form">
  <div class="container">
    <!---start--------------------------------------------------------->

    <section class="vh-100" >
      <div class="container h-100">
        <div class="row d-flex justify-content-center align-items-center h-100">
          <div class="col-lg-12 col-xl-11">
            <div class="card text-black bg-light" style="border-radius: 25px;">
              <div class="card-body p-md-5">
                <div class="row justify-content-center">
                  <div class="col-md-10 col-lg-6 col-xl-5 order-2 order-lg-1">
    
                    <p class="text-center h1 fw-bold mb-5 mx-1 mx-md-4 mt-4" style="color:darkred">Sign up</p>
    
            
                    <form  class="mx-1 mx-md-4" action="" method="POST" > 
    
                      <div class="d-flex flex-row align-items-center mb-4">
                        <i class="fas fa-user fa-lg me-3 fa-fw"></i>
                        <div class="form-outline flex-fill mb-0">
                          <input type="text" name="fname" id="form3Example1c" class="form-control" />
                          <label class="form-label" for="form3Example1c">Your Name</label>
                          <label class="form-check-label RegisterError" for="form2Example3" style="color: red; font-size: smaller;">
                        <?php  if (!empty($formerror1)){ foreach($formerror1 as $errorz){ echo $errorz.'<br>'; }} ?>
                        </label>  
                        </div>
                      </div>

                      <div class="d-flex flex-row align-items-center mb-4">
                        <i class="fas fa-user-lock fa-lg me-3 fa-fw"></i>
                        <div class="form-outline flex-fill mb-0">
                          <input type="text" name="username" id="form3Example1c" class="form-control" />
                          <label class="form-label" for="form3Example1c">Username</label>
                          <label class="form-check-label RegisterError" for="form2Example3" style="color: red; font-size: smaller;">
                        <?php  if (!empty($formerror2)){ foreach($formerror2 as $errorz){ echo $errorz.'<br>'; }} ?>
                        </label>
                        </div>
                      </div>
    
                      <div class="d-flex flex-row align-items-center mb-4">
                        <i class="fas fa-envelope fa-lg me-3 fa-fw"></i>
                        <div class="form-outline flex-fill mb-0">
                          <input type="email" name="email" id="form3Example3c" class="form-control" />
                          <label class="form-label" for="form3Example3c">Your Email</label>
                          <label class="form-check-label RegisterError" for="form2Example3" style="color: red; font-size: smaller;">
                        <?php  if (!empty($formerror3)){ foreach($formerror3 as $errorz){ echo $errorz.'<br>'; }} ?>
                        </label>
                        </div>
                      </div>
    
                      <div class="d-flex flex-row align-items-center mb-4">
                        <i class="fas fa-lock fa-lg me-3 fa-fw"></i>
                        <div class="form-outline flex-fill mb-0">
                          <input type="password" name="pass1" id="form3Example4c" class="form-control" />
                          <label class="form-label" for="form3Example4c">Password</label>
                          <label class="form-check-label RegisterError" for="form2Example3" style="color: red; font-size: smaller;">
                        <?php  if (!empty($formerror4)){ foreach($formerror4 as $errorz){ echo $errorz.'<br>'; }} ?>
                        </label>
                        </div>
                      </div>
    
                      <div class="d-flex flex-row align-items-center mb-4">
                        <i class="fas fa-key fa-lg me-3 fa-fw"></i>
                        <div class="form-outline flex-fill mb-0">
                          <input type="password" name="pass2" id="form3Example4cd" class="form-control" />
                          <label class="form-label" for="form3Example4cd">Repeat your password</label>
                          <label class="form-check-label RegisterError" for="form2Example3" style="color: red; font-size: smaller;">
                        <?php  if (!empty($formerror5)){ foreach($formerror5 as $errorz){ echo $errorz.'<br>'; }} ?>
                        </label>

                        </div>
                      </div>

                      <div class="d-flex flex-row align-items-center mb-4">
                        <i class="fas fa-calendar fa-lg me-3 fa-fw"></i>
                        <div class="form-outline flex-fill mb-0">
                          <input type="number" name="age" id="form3Example4cd" class="form-control" />
                          <label class="form-label" for="form3Example4cd">Age</label>
                          <label class="form-check-label RegisterError" for="form2Example3" style="color: red; font-size: smaller;">
                        <?php  if (!empty($formerror6)){ foreach($formerror6 as $errorz){ echo $errorz.'<br>'; }} ?>
                        </label>
                        </div>
                      </div>

                      

                      <div class="form-check d-flex justify-content-center mb-5">
                        <input class="form-check-input  me-2"  name="terms" type="checkbox" value="terms" id="form2Example3c" />
                        <label class="form-check-label" for="form2Example3">
                          I agree all statements in <a href="https://en.wikipedia.org/wiki/Terms_of_service" style="color:black !important;">Terms of service</a>
                          <label class="form-check-label RegisterError" for="form2Example3" style="color: red; font-size: smaller;">
                        <?php  if (!empty($formerror7)){ foreach($formerror7 as $errorz){ echo $errorz.'<br>'; }} ?>
                        </label>
                        </label>
                      </div>

                      <div class="d-flex justify-content-center mx-4 mb-3 mb-lg-4">
                        <button type="submit" name="submit" class="btn btn-danger btn-lg">Register</button>
                      </div>


                    </form>
                  </div>
                  <div class="col-md-10 col-lg-6 col-xl-7 d-flex align-items-center order-1 order-lg-2">
                    <img src="design/images/—Pngtree—banner sign up for social_6787856.png" alt="Register"
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
<!-- end register form -->
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