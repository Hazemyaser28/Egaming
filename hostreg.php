<?php
session_start();


include 'init2.php';
if(isset($_POST['submit'])){

  //Get Data From FORM
  $username =         $_POST['username'];
  $pass1 =            $_POST['password1'];
  $pass2 =            $_POST['password2'];
  $cname =            $_POST['cname'];
  $email =            $_POST['email'];
  $location =         $_POST['location'];
  $seats =         $_POST['seats'];
  $img_name=  $_FILES['image']['name'];
  $img_size=  $_FILES['image']['size'];
  $tmp_name=  $_FILES['image']['tmp_name'];
  $img_error= $_FILES['image']['error'];



//  error  arrays 

  $formerror1=array();
  $formerror2=array();
  $formerror3=array();
  $formerror4=array();
  $formerror5=array();
  $formerror6=array();
  $formerror7=array();
  $formerror9=array();
  $formerror10=array();



  //validate username
if (isset($_POST['username'])){
     $filteruser= filter_var($_POST['username'], FILTER_SANITIZE_STRING);
     if (strlen($filteruser)<4){
          $formerror1[]='Username must be more than 4 chars';
     }
}


// validate password 
if (isset($_POST['password1']) && isset($_POST['password2']))

{
 if (empty($_POST['password1'])){
      $formerror2[]='password cant be empty';  
 }  
 $pass1= sha1($_POST['password1']) ;
 $pass2= sha1($_POST['password2']) ;
 if($pass1 !== $pass2){
      $formerror5[]= 'password dosen\'t match';
 }
}
if (isset($_POST['cname'])){
     $filteruser= filter_var($_POST['cname'], FILTER_SANITIZE_STRING);
     if (empty($filteruser)){
          $formerror3[]='You must enter cyber name';
     }
        
   }
 //  validate email
 if (isset($_POST['email'])){
    $filteremail= filter_var($_POST['email'], FILTER_SANITIZE_EMAIL);
    if (filter_var($filteremail,FILTER_VALIDATE_EMAIL)!= true ){
         $formerror4[]='enter a valid email';
    }
}
if(empty($formerror4)){
    //Check That email is Unique
    $check1=checkitem("email","internetcafe",$email);
    $check2=checkitem("email","users",$email);
    if($check1+$check2>0){ 
        $formerror4[]  = ' email Already Exsist'; 
    }}
//Location not empty  
 if (isset($_POST['location'])){
     $filteruser= filter_var($_POST['location'], FILTER_SANITIZE_STRING);
     if (empty($filteruser)){
          $formerror6[]='Enter The cyber Location !';
     }
        
   }
    if (empty($seats)){
         $formerror9[]=' You must tell how many seats you have.';
    }



 if (empty($_POST['terms'])){
       $formerror10[]='You must read and agree on our terms and conditions. ';  
   }
  
                    if (empty($_FILES['image'])){
                        $formerror7[]='Upload image';  
                                                }  
                                    if ($img_error===0){
                                    //max size
                                    if($img_size >12000000){
                                        $formerror7[] ="File is Too Large Max Limit is (12MB)";
                                    }
                                            else{
                                                $img_ext = pathinfo($img_name,PATHINFO_EXTENSION);   //get extension
                                                $img_lowercase=strtolower($img_ext);                 // make it lowercase
                                                $allowed=array("jpg","jpeg","png");
                                                if(in_array($img_lowercase,$allowed)){
                                                    $new_name = uniqid("IMG-",true). '.'. $img_lowercase;  //chaneg image name and encrypt it
                                                    
                                                }
                                else{
                                $formerror7[] ="Enter a Valid Type of Images <br> i.e png, jpeg, jpg ";
                                }
                            }
                            }
                    else{
                    $formerror7[] ="No File Uploaded";
                    }
                    
  //if there is no error update database
  if(empty($formerror1)){
        //Check That Username is Unique
        $check=checkitem("hostuser","internetcafe",$username);
        $check3=checkitem("username","users",$username);
        if($check+$check3>0){ 
            $formerror1[]  = ' Username Already Exsist'; 
        }
    }

    if(empty($formerror1)&&empty($formerror2)&&empty($formerror3)&&empty($formerror4)&&empty($formerror5)&&empty($formerror6)&&empty($formerror7)&&empty($formerror9)&&empty($formerror10)){
    //inset into  database
   $stmt = $con->prepare("INSERT INTO internetcafe (hostuser,hostpass,cybername,email,location,images,all_seats,date,activated)
   VALUES(:zuser,:zpass,:zname,:zemail,:zlocation,:zimages,:zseats,now(),0)");     
   //execute query
   $stmt-> execute(array(
   'zuser'=> $username,
   'zpass'=> $pass1,
   'zname'=> $cname,
   'zemail'=> $email,
   'zseats'=> $seats,
   'zlocation'=> $location,
   'zimages'=> $new_name)); 
// Get last ID entered database and create a folder for this image
     $lastid = $con->lastInsertId();
     $_SESSION['lastid'] = $lastid;

   if (!file_exists('upload/'.$lastid.'/')){
    mkdir('upload/'.$lastid.'/'); }
    //Put the image in the file
   $img_path ='upload/'.$lastid.'/'.$new_name;
   move_uploaded_file($tmp_name,$img_path);
   
   
   //IF successfuly registered.
   header('location: login.php');  

 }


  }
  ?>


                                                <!-- ------------------HTML----------------------- -->
<!doctype html>
<html lang="en">
<html>
<head>
      <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <link href="https://fonts.googleapis.com/css?family=Open+Sans&display=swap" rel="stylesheet">

  <!--------style sheets--->
  
      <link rel="stylesheet" href="design/css/bootstrap.min.css"/>
      <link rel="stylesheet" href="design/css/pages/hostsign.css"/>
      <link rel="stylesheet" href="design/css/Animate.css"/>
    <link rel="stylesheet" href="design/icofont/icofont.min.css"/>
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.5.0/css/all.css" integrity="sha384-B4dIYHKNBt8Bc12p+WXckhzcICo0wtJAoU8YZTY5qE0Id1GSseTk6S+L3BlXeVIU" crossorigin="anonymous">
    
    <!--------end style sheets--->

    <link rel="shortcut icon" type="image/x-icon" href="design/images/game-controller-1400688-1189016.png">
      <title>Join Us </title>
</head>
<body class="backg"> 

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

    <section class="vh-100" style=height:fit-content;>
      <div class="container h-100">
        <div class="row d-flex justify-content-center align-items-center h-100">
          <div class="col-lg-12 col-xl-11">
            <div class="card text-black bg-light" style="border-radius: 25px;">
              <div class="card-body p-md-5 ">
                <div class="row justify-content-center">
                  <div class="col-md-10 col-lg-6 col-xl-5 order-2 order-lg-1">
    
                    <p class="text-center h1 fw-bold mb-5 mx-1 mx-md-4 mt-4" style="color:darkred">Join us</p>

                    <form  class="mx-1 mx-md-4" action="" method="POST" enctype="multipart/form-data"> 


                      <div class="d-flex flex-row align-items-center mb-4">
                        <i class="fas fa-user fa-lg me-3 fa-fw"></i>
                        <div class="form-outline flex-fill mb-0">
                          <input type="text" placeholder="internet cafe name" name="cname" id="form3Example1c" class="form-control" />
                          <label class="form-label" for="form3Example1c">Internet cafe name</label>
                          <label class="form-check-label RegisterError" for="form2Example3" style="color: red; font-size: smaller;"> 
                          <?php  if (!empty($formerror3)){ foreach($formerror3 as $errorz){ echo $errorz.'<br>'; }} ?>
     


                        </label>
                        </div>
                      </div>

                      <div class="d-flex flex-row align-items-center mb-4">
                        <i class="fas fa-user-lock fa-lg me-3 fa-fw"></i>
                        <div class="form-outline flex-fill mb-0">
                          <input type="text" placeholder="your login username" name="username" id="form3Example1c" class="form-control" />
                          <label class="form-label" for="form3Example1c">Username</label>
                          <label class="form-check-label RegisterError" for="form2Example3" style="color: red; font-size: smaller;"> 
                          <?php  if (!empty($formerror1)){ foreach($formerror1 as $errorz){ echo $errorz.'<br>'; }} ?>
                        </label>
                        </div>
                      </div>
    
                      <div class="d-flex flex-row align-items-center mb-4">
                        <i class="fas fa-envelope fa-lg me-3 fa-fw"></i>
                        <div class="form-outline flex-fill mb-0">
                          <input type="email"  name="email"  placeholder="enter a valid e-mail" id="form3Example3c" class="form-control" />
                          <label class="form-label"  for="form3Example3c">Your Email</label>
                          <label class="form-check-label RegisterError" for="form2Example3" style="color: red; font-size: smaller;"> 
                          <?php  if (!empty($formerror4)){ foreach($formerror4 as $errorz){ echo $errorz.'<br>'; }} ?>
                        </label>
                        </div>
                      </div>
    
                      <div class="d-flex flex-row align-items-center mb-4">
                        <i class="fas fa-lock fa-lg me-3 fa-fw"></i>
                        <div class="form-outline flex-fill mb-0">
                          <input type="password" placeholder="enter ypur password"  name="password1" id="form3Example4c" class="form-control" />
                          <label class="form-label" for="form3Example4c">Password</label>
                          <label class="form-check-label RegisterError" for="form2Example3" style="color: red; font-size: smaller;"> 
                          <?php  if (!empty($formerror2)){ foreach($formerror2 as $errorz){ echo $errorz.'<br>'; }} ?>
                        </label>
                        </div>
                      </div>
    
                      <div class="d-flex flex-row align-items-center mb-4">
                        <i class="fas fa-key fa-lg me-3 fa-fw"></i>
                        <div class="form-outline flex-fill mb-0">
                          <input type="password"  placeholder="re-enter your password" name="password2" id="form3Example4cd" class="form-control" />
                          <label class="form-label" for="form3Example4cd">Repeat your password</label>
                          <label class="form-check-label RegisterError" for="form2Example3" style="color: red; font-size: smaller;"> "
                          <?php  if (!empty($formerror5)){ foreach($formerror5 as $errorz){ echo $errorz.'<br>'; }} ?>
                        </label>
                        </div>
                      </div>

                      <div class="d-flex flex-row align-items-center mb-4">
                        <i class="fas fa-map fa-lg me-3 fa-fw"></i>
                        <div class="form-outline flex-fill mb-0">
                          <input list="location"  name="location"id="form3Example4cd" class="form-control" placeholder="if your location isn't listed type here" />
                          <datalist id="location">
                          <option value="maadi">
                          <option value="zamalek">
                          <option value="5th settlement">
                          <option value="nasr city">
                          </datalist>
                          <label class="form-label" for="form3Example4cd">Location</label>
                          <label class="form-check-label RegisterError" for="form2Example3" style="color: red; font-size: smaller;">
                          <?php  if (!empty($formerror6)){ foreach($formerror6 as $errorz){ echo $errorz.'<br>'; }} ?>
                        </label>
                        </div>
                      </div>

                      <div class="d-flex flex-row align-items-center mb-4">
                        <i class="fas fa-calculator fa-lg me-3 fa-fw"></i>
                        <div class="form-outline flex-fill mb-0">
                          <input list="seats"  name="seats" class="form-control" id="formFileMultiple" placeholder="how many seats" type="number"> 
                          <?php 
                          $list=1;
                          echo  '<datalist id="seats">';
                          while ($list<= 30){
                           echo '<option value="'. $list .'">';
                           $list++; }
                           echo '</datalist>'; ?>
                        <label class="form-label" for="form3Example4cd">How many seats?</label>
                          <label class="form-check-label RegisterError" for="form2Example3" style="color: red; font-size: smaller;">
                          <?php  if (!empty($formerror9)){ foreach($formerror9 as $errorz){ echo $errorz.'<br>'; }} ?>
                        </label>
                        </div>
                      </div>

                      <div class="d-flex flex-row align-items-center mb-4">
                        <i class="fas fa-file fa-lg me-3 fa-fw"></i>
                        <div class="form-outline flex-fill mb-0">
                            <div class="mb-3">
                                <label for="formFileMultiple" class="form-label">Upload an image of your internet café.<br><span style="color:blue;">allowed extensions png, jpeg, jpg</span></label>
                                <input class="form-control" type="file" name="image" id="formFileMultiple" multiple>                  
                                <label class="form-check-label RegisterError" for="form2Example3" style="color: red; font-size: smaller;"> 
                                <?php  if (!empty($formerror7)){ foreach($formerror7 as $errorz){ echo $errorz.'<br>'; }} ?>
                            </label>  
                              </div>
                        </div>
                      </div>

                      
                      <div class="form-check d-flex justify-content-center mb-5">
                        <input class="form-check-input  me-2" name="terms" type="checkbox" value="agree" id="form2Example3c" />
                        <label class="form-check-label" for="form2Example3">
                          I agree all statements in <a href="https://en.wikipedia.org/wiki/Terms_of_service" style="color:black !important;">Terms of service</a>
                          <label class="form-check-label RegisterError" for="form2Example3" style="color: red; font-size: smaller;"> 
                          <?php  if (!empty($formerror10)){ foreach($formerror10 as $errorz){ echo $errorz.'<br>'; }} ?>
                            </label>  
                        </label>
                        </label>
                      </div>
                      


                      <div class="d-flex justify-content-center mx-4 mb-3 mb-lg-4">
                        <button type="submit" name="submit" class="btn btn-danger btn-lg">Register</button>
                      </div>
                    </form>
                  </div>
                  <div class="col-md-10 col-lg-6 col-xl-7 d-flex align-items-center order-1 order-lg-2">
                    <img src="design/images/—Pngtree—join us sign banner_6667400.png" alt="Register"
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