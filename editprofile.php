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
      <title>Edit profile</title>
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
          </div>
        </div>
      </nav>
      
    <!--end navbar-->
<!-- profile -->

<?php
if(isset($_SESSION['user_id'])){ 
if(isset($_POST['edit'])){
$stmt = $con->prepare("SELECT email,username,fullname FROM users WHERE ID=? ");
$stmt-> execute(array($_SESSION['user_id'])); 
$row=$stmt->fetch();  
 ?>
<section id="home">
  <div class="container mt-4 mb-4 p-3 d-flex justify-content-center"> 
      <div class="card p-4"> 
          <div class=" image d-flex flex-column justify-content-center align-items-center">
                <button class="btnimg btn-secondary"> 
                  <img src="design/images/game-controller-1400688-1189016.png" height="100" width="100" />
              </button> 
                <div class="d-flex flex-row justify-content-center align-items-center gap-2"> 
                  </i></span> </div> <div class="d-flex flex-row justify-content-center align-items-center mt-3"> 
                            </div> <div class="text mt-3">


                            <form action="<?=$_SERVER['PHP_SELF']?>" method="POST">
                              <div class="d-flex flex-row align-items-center mb-4">
                                  <i class="fas fa-user fa-lg me-3 fa-fw"></i>
                                  <div class="form-outline flex-fill mb-0">
                                    <input type="text" id="form3Example1c" name="username"class="form-control" placeholder="<?=$row['username']?>" />
                                    <label class="form-label" for="form3Example1c">Username</label>
                                  </div>
                                </div>

                                <div class="d-flex flex-row align-items-center mb-4">
                                  <i class="fas fa-user fa-lg me-3 fa-fw"></i>
                                  <div class="form-outline flex-fill mb-0">
                                    <input type="text" id="form3Example1c" name="fullname"class="form-control" placeholder="<?=$row['fullname']?>" />
                                    <label class="form-label" for="form3Example1c">Full name</label>
                                  </div>
                                </div>

                          <div class="d-flex flex-row align-items-center mb-4">
                            <i class="fas fa-envelope fa-lg me-3 fa-fw"></i>
                            <div class="form-outline flex-fill mb-0">
                              <input type="email" name="email" id="form3Example3c" class="form-control" placeholder="<?=$row['email']?>"/>
                              <label class="form-label" for="form3Example3c">Your Email</label>
                            </div>
                                </div>

                         </div>  <div class=" d-flex d-md-block justify-content-center align-items-center  flex-column ">
                
                       <button class="btn1 btn-dark bg-dark btn" type="submit" name="editprof" >Edit Profile</button> 
                       <a href='profile.php'  style="font-size: 20px; color:white !important;"class=' mt-3 mt-md-0   btn btn-danger '> cancel </a> 
                </div> 
               
                  <div class="text mt-3">
                
</form>
                                  </div>
                              </section>


<?php }
if(isset($_POST['editprof'])){ 
        $username =      $_POST['username'];
        $email    =      $_POST['email'];
        $fname   =         $_POST['fullname']

    
    ?>
  <section id="home">
        <div class="container mt-4 mb-4 p-3 d-flex justify-content-center"> 
            <div class="card p-4"> 
                <div class=" image d-flex flex-column justify-content-center align-items-center">
                     <button class="btnimg btn-secondary"> 
                        <img src="design/images/game-controller-1400688-1189016.png" height="100" width="100" />
                    </button> 
                     <div class="d-flex flex-row justify-content-center align-items-center gap-2"> 
                        </i></span> </div> <div class="d-flex flex-row justify-content-center align-items-center mt-3"> 
           
                                </div> <div class=" px-2 rounded mt-4 date ">
<?php

            //   ------------------checking if changer user name or email or full name or all-------------------------------
        if(!empty($username&&$email&&$fname)){
            $filteremail= filter_var($email, FILTER_SANITIZE_EMAIL);
            $filteruser= filter_var($username, FILTER_SANITIZE_STRING);
            $filtername= filter_var($fname, FILTER_SANITIZE_STRING);
            if (strlen($filteruser)<4){
                $redimsg=  '<div class="alert alert-primary  text-center" > Username Must be more than 4 letters</div>';	
                redirection($redimsg,'profile',3); 
            }else{
            $stmt=$con->prepare("UPDATE users SET email=?,  username=?,  fullname=? WHERE ID=?");
            $stmt->execute(array($email,$username,$fname,$_SESSION['user_id'] ));
            $redimsg=  '<div class="alert alert-primary  text-center" > Username and Email and Fullname Changed Successfully </div>';	
            redirection($redimsg,'profile',3); 
            }}

                    elseif(!empty($username&&$email)){
                        $filteremail= filter_var($email, FILTER_SANITIZE_EMAIL);
                        $filteruser= filter_var($username, FILTER_SANITIZE_STRING);
                        if (strlen($filteruser)<4){
                            $redimsg=  '<div class="alert alert-primary  text-center" > Username Must be more than 4 letters</div>';	
                            redirection($redimsg,'profile',3); 
                        }else{
                        $stmt=$con->prepare("UPDATE users SET email=?,  fullname=? WHERE ID=?");
                        $stmt->execute(array($email,$username,$_SESSION['user_id'] ));
                        $redimsg=  '<div class="alert alert-primary  text-center" > Username and Email  Changed Successfully </div>';	
                        redirection($redimsg,'profile',3); 
                        }}
                            elseif(!empty($email&&$fname)){
                                $filteremail= filter_var($email, FILTER_SANITIZE_EMAIL);
                                $filtername= filter_var($fname, FILTER_SANITIZE_STRING);
                                $stmt=$con->prepare("UPDATE users SET email=?,fullname=? WHERE ID=?");
                                $stmt->execute(array($email,$fname,$_SESSION['user_id'] ));
                                $redimsg=  '<div class="alert alert-primary  text-center" >  Email and Fullname Changed Successfully </div>';	
                                redirection($redimsg,'profile',3); 
                                }
                                    elseif(!empty($username&&$fname)){
                                        $filteruser= filter_var($username, FILTER_SANITIZE_STRING);
                                        $filtername= filter_var($fname, FILTER_SANITIZE_STRING);
                                        if (strlen($filteruser)<4){
                                            $redimsg=  '<div class="alert alert-primary  text-center" > Username Must be more than 4 letters</div>';	
                                            redirection($redimsg,'profile',3); 
                                        }else{
                                        $stmt=$con->prepare("UPDATE users SET username=?,fullname=? WHERE ID=?");
                                        $stmt->execute(array($username,$fname,$_SESSION['user_id'] ));
                                        $redimsg=  '<div class="alert alert-primary  text-center" >  username and Fullname Changed Successfully </div>';	
                                        redirection($redimsg,'profile',3); 
                                        }}
                            
                                        elseif(!empty($username)){
                                            $filteruser= filter_var($username, FILTER_SANITIZE_STRING);
                                            if (strlen($filteruser)<4){
                                                $redimsg=  '<div class="alert alert-primary  text-center" > Username Must be more than 4 letters</div>';	
                                                redirection($redimsg,'profile',3); 
                                            }else{
                                            $stmt=$con->prepare("UPDATE users SET   username=? WHERE ID=?");
                                            $stmt->execute(array($username,$_SESSION['user_id'] ));
                                            

                                            $redimsg=  '<div class="alert alert-primary  text-center" > Username has been Changed Successfully </div>';	
                                            redirection($redimsg,'profile',3); 
                                                        }}
                                  elseif(!empty($email)){
                                    $filteremail= filter_var($email, FILTER_SANITIZE_EMAIL);
                                $stmt=$con->prepare("UPDATE users SET   email=? WHERE ID=?");
                                $stmt->execute(array($email,$_SESSION['user_id'] ));

                            $redimsg=  '<div class="alert alert-primary  text-center" > Email has been Changed Successfully </div>';	
                            redirection($redimsg,'profile',3); 
                            }
                    elseif(!empty($fname)){
                    $filteruser= filter_var($username, FILTER_SANITIZE_STRING);
                    $stmt=$con->prepare("UPDATE users SET   fullname=? WHERE ID=?");
                    $stmt->execute(array($fname,$_SESSION['user_id'] ));

                $redimsg=  '<div class="alert alert-primary  text-center" > Fullname has been Changed Successfully </div>';	
                redirection($redimsg,'profile',3); 
                }
        elseif(empty($username&&$email&&$fname)){
        $redimsg=  '<div class="alert alert-primary  text-center" > Nothing Changed </div>';	
        redirection($redimsg,'profile',3); 
        }

?>

</div> 
  </section>

  <?php
  }?>
   <!-------------------checking if changer user name or email or full name or all------------------------------- -->
                                                   <!------end change profile---- -->


                                                  <!-----start change password---- -->

<?php
if(isset($_POST['password'])){
                                                         
    ?>
<section id="home">

        <div class="container mt-4 mb-4 p-3 d-flex justify-content-center"> 
            <div class="card p-4"> 
                <div class=" image d-flex flex-column justify-content-center align-items-center">
                     <button class="btnimg btn-secondary"> 
                        <img src="design/images/game-controller-1400688-1189016.png" height="100" width="100" />
                    </button> 
                     <div class="d-flex flex-row justify-content-center align-items-center gap-2"> 
                        </i></span> </div> <div class="d-flex flex-row justify-content-center align-items-center mt-3"> 
                                  </div> <div class="text mt-5">

                                  <form action="<?=$_SERVER['PHP_SELF']?>" method="POST">
                                  <div class="d-flex flex-row align-items-center mb-4">
                                        <i class="fas fa-lock fa-lg me-3 fa-fw"></i>
                                        <div class="form-outline flex-fill mb-0">
                                          <input type="password"  name="oldpassword" id="form3Example4c" class="form-control" />
                                          <label class="form-label" for="form3Example4c">Old Password</label>
                                        </div>
                                      </div>

                                      <div class="d-flex flex-row align-items-center mb-4">
                                        <i class="fas fa-lock fa-lg me-3 fa-fw"></i>
                                        <div class="form-outline flex-fill mb-0">
                                          <input type="password" name="newpassword" id="form3Example4c" class="form-control" />
                                          <label class="form-label" for="form3Example4c">New Password</label>
                                        </div>
                                      </div>

                                </div>  <div class="d-flex d-md-block justify-content-center align-items-center  flex-column ">
                                          <button class="btn1 btn-dark bg-dark btn" type="submit" name="editpass" >Change</button>
                                          <a href='profile.php'  style="font-size: 20px; color:white !important;"class='btn btn-danger  mt-3 mt-md-0'> cancel </a> 
                                        </div> <div class="text mt-3">
                                        </form>
    </div>
  </section>

  <?php }
if(isset($_POST['editpass'])){ 
    $oldpass =      $_POST['oldpassword'];
    $newpass    =      $_POST['newpassword'];

    
    ?>
  <section id="home">
        <div class="container mt-4 mb-4 p-3 d-flex justify-content-center"> 
            <div class="card p-4"> 
                <div class=" image d-flex flex-column justify-content-center align-items-center">
                     <button class="btnimg btn-secondary"> 
                        <img src="design/images/game-controller-1400688-1189016.png" height="100" width="100" />
                    </button> 
                     <div class="d-flex flex-row justify-content-center align-items-center gap-2"> 
                        </i></span> </div> <div class="d-flex flex-row justify-content-center align-items-center mt-3"> 
           
                                </div>  <div class=" px-2 rounded mt-4 date ">
<?php
if(!empty($oldpass&&$newpass)){
$stmt = $con->prepare("SELECT PW FROM users WHERE ID=? ");
$stmt-> execute(array($_SESSION['user_id'])); 
$row=$stmt->fetch();  

if($row['PW']==sha1($oldpass)){

 $stmt=$con->prepare("UPDATE users SET PW=? WHERE ID=?");
 $stmt->execute(array(sha1($newpass),$_SESSION['user_id'] ));
 $redimsg=  '<div class="alert alert-primary  text-center" >Password Changed Successfully </div>';	
 redirection($redimsg,'profile',3); 
}else{
$redimsg=  '<div class="alert alert-primary  text-center" >Wrong password </div>';	
redirection($redimsg,'profile',3); 
}







}
elseif(empty($oldpass&&$newpass)){
$redimsg=  '<div class="alert alert-primary  text-center" > Nothing Changed </div>';	
redirection($redimsg,'profile',3); 
}

?>

                                           </div> <div class="text mt-3">
    </div>
  </section>

  <?php }}


                            //    <!-- end password-->




                            // <!-- ---------------------------host edit----------------------------------------- -->


elseif(isset($_SESSION['HOST_ID'])){ 
if(isset($_POST['edithost'])){
$stmt = $con->prepare("SELECT email,cybername,hostuser FROM internetcafe WHERE HostID=? ");
$stmt-> execute(array($_SESSION['HOST_ID'])); 
$row=$stmt->fetch();  
 ?>
<section id="home">
        <div class="container mt-4 mb-4 p-3 d-flex justify-content-center"> 
            <div class="card p-4"> 
                <div class=" image d-flex flex-column justify-content-center align-items-center">
                     <button class="btnimg btn-secondary"> 
                        <img src="design/images/game-controller-1400688-1189016.png" height="100" width="100" />
                    </button> 
                     <div class="d-flex flex-row justify-content-center align-items-center gap-2"> 
                        </i></span> </div> <div class="d-flex flex-row justify-content-center align-items-center mt-3"> 
                                  </div> <div class="text mt-3">


                                  <form action="<?=$_SERVER['PHP_SELF']?>" method="POST">
                                    <div class="d-flex flex-row align-items-center mb-4">
                                        <i class="fas fa-user fa-lg me-3 fa-fw"></i>
                                        <div class="form-outline flex-fill mb-0">
                                          <input type="text" id="form3Example1c" name="hostuser"class="form-control" placeholder="<?=$row['hostuser']?>" />
                                          <label class="form-label" for="form3Example1c">Username</label>
                                        </div>
                                      </div>

                                      <div class="d-flex flex-row align-items-center mb-4">
                                        <i class="fas fa-user fa-lg me-3 fa-fw"></i>
                                        <div class="form-outline flex-fill mb-0">
                                          <input type="text" id="form3Example1c" name="cybername"class="form-control" placeholder="<?=$row['cybername']?>" />
                                          <label class="form-label" for="form3Example1c">cybername</label>
                                        </div>
                                      </div>

                                      <div class="d-flex flex-row align-items-center mb-4">
                                        <i class="fas fa-envelope fa-lg me-3 fa-fw"></i>
                                        <div class="form-outline flex-fill mb-0">
                                          <input type="email" name="email" id="form3Example3c" class="form-control" placeholder="<?=$row['email']?>"/>
                                          <label class="form-label" for="form3Example3c">Your Email</label>
                                        </div>
                                      </div>

                                </div>  <div class=" px-2 rounded mt-2 date ">
                                            <button class="btn1 btn-dark bg-dark btn" type="submit" name="editprofhost" >Edit Profile</button> 
                                            <a href='profile.php'  style="font-size: 20px; color:white !important;"class='btn btn-danger '> cancel </a> 
                                          </div> <div class="text mt-3">
</form>
                                     </div>
                                 </section>


<?php }
if(isset($_POST['editprofhost'])){ 
        $username =      $_POST['hostuser'];
        $email    =      $_POST['email'];
        $fname   =         $_POST['cybername']

    
    ?>
  <section id="home">
        <div class="container mt-4 mb-4 p-3 d-flex justify-content-center"> 
            <div class="card p-4"> 
                <div class=" image d-flex flex-column justify-content-center align-items-center">
                     <button class="btnimg btn-secondary"> 
                        <img src="design/images/game-controller-1400688-1189016.png" height="100" width="100" />
                    </button> 
                     <div class="d-flex flex-row justify-content-center align-items-center gap-2"> 
                        </i></span> </div> <div class="d-flex flex-row justify-content-center align-items-center mt-3"> 
           
                                </div>  <div class=" px-2 rounded mt-4 date ">
<?php

            //   ------------------checking if changer user name or email or full name or all-------------------------------
        if(!empty($username&&$email&&$fname)){
            $filteremail= filter_var($email, FILTER_SANITIZE_EMAIL);
            $filteruser= filter_var($username, FILTER_SANITIZE_STRING);
            $filtername= filter_var($fname, FILTER_SANITIZE_STRING);
            if (strlen($filteruser)<4){
                $redimsg=  '<div class="alert alert-primary  text-center" > Username Must be more than 4 letters</div>';	
                redirection($redimsg,'profile',3); 
            }else{
            $stmt=$con->prepare("UPDATE internetcafe SET email=?,  hostuser=?,  cybername=? WHERE HostID=?");
            $stmt->execute(array($email,$username,$fname,$_SESSION['HOST_ID'] ));
            $redimsg=  '<div class="alert alert-primary  text-center" > Username and Email and cybername Changed Successfully </div>';	
            redirection($redimsg,'profile',3); 
            }}

                    elseif(!empty($username&&$email)){
                        $filteremail= filter_var($email, FILTER_SANITIZE_EMAIL);
                        $filteruser= filter_var($username, FILTER_SANITIZE_STRING);
                        if (strlen($filteruser)<4){
                            $redimsg=  '<div class="alert alert-primary  text-center" > Username Must be more than 4 letters</div>';	
                            redirection($redimsg,'profile',3); 
                        }else{
                        $stmt=$con->prepare("UPDATE internetcafe SET email=?,  hostuser=? WHERE HostID=?");
                        $stmt->execute(array($email,$username,$_SESSION['HOST_ID'] ));
                        $redimsg=  '<div class="alert alert-primary  text-center" > Username and Email  Changed Successfully </div>';	
                        redirection($redimsg,'profile',3); 
                        }}
                            elseif(!empty($email&&$fname)){
                                $filteremail= filter_var($email, FILTER_SANITIZE_EMAIL);
                                $filtername= filter_var($fname, FILTER_SANITIZE_STRING);
                                $stmt=$con->prepare("UPDATE internetcafe SET email=?,cybername=? WHERE HostID=?");
                                $stmt->execute(array($email,$fname,$_SESSION['HOST_ID'] ));
                                $redimsg=  '<div class="alert alert-primary  text-center" >  Email and cybername Changed Successfully </div>';	
                                redirection($redimsg,'profile',3); 
                                }
                                    elseif(!empty($username&&$fname)){
                                        $filteruser= filter_var($username, FILTER_SANITIZE_STRING);
                                        $filtername= filter_var($fname, FILTER_SANITIZE_STRING);
                                        if (strlen($filteruser)<4){
                                            $redimsg=  '<div class="alert alert-primary  text-center" > Username Must be more than 4 letters</div>';	
                                            redirection($redimsg,'profile',3); 
                                        }else{
                                        $stmt=$con->prepare("UPDATE internetcafe SET hostuser=?,cybername=? WHERE HostID=?");
                                        $stmt->execute(array($username,$fname,$_SESSION['HOST_ID'] ));
                                        $redimsg=  '<div class="alert alert-primary  text-center" >  username and cybername Changed Successfully </div>';	
                                        redirection($redimsg,'profile',3); 
                                        }}
                            
                                        elseif(!empty($username)){
                                            $filteruser= filter_var($username, FILTER_SANITIZE_STRING);
                                            if (strlen($filteruser)<4){
                                                $redimsg=  '<div class="alert alert-primary  text-center" > Username Must be more than 4 letters</div>';	
                                                redirection($redimsg,'profile',3); 
                                            }else{
                                            $stmt=$con->prepare("UPDATE internetcafe SET   hostuser=? WHERE HostID=?");
                                            $stmt->execute(array($username,$_SESSION['HOST_ID'] ));
                                            

                                            $redimsg=  '<div class="alert alert-primary  text-center" > Username has been Changed Successfully </div>';	
                                            redirection($redimsg,'profile',3); 
                                                        }}
                                  elseif(!empty($email)){
                                    $filteremail= filter_var($email, FILTER_SANITIZE_EMAIL);
                                $stmt=$con->prepare("UPDATE internetcafe SET   email=? WHERE HostID=?");
                                $stmt->execute(array($email,$_SESSION['HOST_ID'] ));

                            $redimsg=  '<div class="alert alert-primary  text-center" > Email has been Changed Successfully </div>';	
                            redirection($redimsg,'profile',3); 
                            }
                    elseif(!empty($fname)){
                    $filteruser= filter_var($username, FILTER_SANITIZE_STRING);
                    $stmt=$con->prepare("UPDATE internetcafe SET  cybername=? WHERE HostID=?");
                    $stmt->execute(array($fname,$_SESSION['HOST_ID'] ));

                $redimsg=  '<div class="alert alert-primary  text-center" > cybername has been Changed Successfully </div>';	
                redirection($redimsg,'profile',3); 
                }
        elseif(empty($username&&$email&&$fname)){
        $redimsg=  '<div class="alert alert-primary  text-center" > Nothing Changed </div>';	
        redirection($redimsg,'profile',3); 
        }

?>

</div> 
  </section>

  <?php
  }?>
   <!-------------------checking if changer user name or email or full name or all------------------------------- -->
                                                   <!------end change profile---- -->


                                                  <!-----start change password---- -->

<?php
if(isset($_POST['passwordhost'])){
                                                         
    ?>
<section id="home">

        <div class="container mt-4 mb-4 p-3 d-flex justify-content-center"> 
            <div class="card p-4"> 
                <div class=" image d-flex flex-column justify-content-center align-items-center">
                     <button class="btnimg btn-secondary"> 
                        <img src="design/images/game-controller-1400688-1189016.png" height="100" width="100" />
                    </button> 
                     <div class="d-flex flex-row justify-content-center align-items-center gap-2"> 
                        </i></span> </div> <div class="d-flex flex-row justify-content-center align-items-center mt-3"> 
                                  </div> <div class="text mt-5">

                                  <form action="<?=$_SERVER['PHP_SELF']?>" method="POST">
                                  <div class="d-flex flex-row align-items-center mb-4">
                                        <i class="fas fa-lock fa-lg me-3 fa-fw"></i>
                                        <div class="form-outline flex-fill mb-0">
                                          <input type="password"  name="oldpassword" id="form3Example4c" class="form-control" />
                                          <label class="form-label" for="form3Example4c">Old Password</label>
                                        </div>
                                      </div>

                                      <div class="d-flex flex-row align-items-center mb-4">
                                        <i class="fas fa-lock fa-lg me-3 fa-fw"></i>
                                        <div class="form-outline flex-fill mb-0">
                                          <input type="password" name="newpassword" id="form3Example4c" class="form-control" />
                                          <label class="form-label" for="form3Example4c">New Password</label>
                                        </div>
                                      </div>

                                </div>  <div class=" d-flex d-md-block justify-content-center align-items-center  flex-column  ">
                                          <button class="btn1 btn-dark bg-dark btn" type="submit" name="editpasshost" >Change</button> 
                                          <a href='profile.php'  style="font-size: 20px; color:white !important;"class='mt-3 mt-md-0 btn btn-danger  '> cancel </a> 
                                        </div> <div class="text mt-3">
                                        </form>
    </div>
  </section>

  <?php }
if(isset($_POST['editpasshost'])){ 
    $oldpass =      $_POST['oldpassword'];
    $newpass    =      $_POST['newpassword'];

    
    ?>
  <section id="home">
        <div class="container mt-4 mb-4 p-3 d-flex justify-content-center"> 
            <div class="card p-4"> 
                <div class=" image d-flex flex-column justify-content-center align-items-center">
                     <button class="btnimg btn-secondary"> 
                        <img src="design/images/game-controller-1400688-1189016.png" height="100" width="100" />
                    </button> 
                     <div class="d-flex flex-row justify-content-center align-items-center gap-2"> 
                        </i></span> </div> <div class="d-flex flex-row justify-content-center align-items-center mt-3"> 
           
                                </div>  <div class=" px-2 rounded mt-4 date ">
<?php
if(!empty($oldpass&&$newpass)){
$stmt = $con->prepare("SELECT hostpass FROM internetcafe WHERE HostID=? ");
$stmt-> execute(array($_SESSION['HOST_ID'])); 
$row=$stmt->fetch();  

if($row['hostpass']==sha1($oldpass)){

 $stmt=$con->prepare("UPDATE internetcafe SET hostpass=? WHERE HostID=?");
 $stmt->execute(array(sha1($newpass),$_SESSION['HOST_ID'] ));
 $redimsg=  '<div class="alert alert-primary  text-center" >Password Changed Successfully </div>';	
 redirection($redimsg,'profile',3); 
}else{
$redimsg=  '<div class="alert alert-primary  text-center" >Wrong password </div>';	
redirection($redimsg,'profile',3); 
}


}
elseif(empty($oldpass&&$newpass)){
$redimsg=  '<div class="alert alert-primary  text-center" > Nothing Changed </div>';	
redirection($redimsg,'profile',3); 
}

?>
 </div> <div class="text mt-3">
    </div>
      </section>

  <?php }}
  else{
    header('location:login.php');
  }

?>
                         <!-- end password-->


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