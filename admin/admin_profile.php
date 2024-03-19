<?php
ob_start();
session_start();
include 'init2.php';
if (isset($_SESSION['admin_id'])){
?>
<!doctype html>
<html lang="en">
<html>
<head>
      <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <link href="https://fonts.googleapis.com/css?family=Open+Sans&display=swap" rel="stylesheet">

  <!--------style sheets--->
  
  <link rel="stylesheet" href="design/css/bootstrap.min.css"/>
      <link rel="stylesheet" href="design/css/pages/admin.css"/>
      <link rel="stylesheet" href="design/css/Animate.css"/>
    <link rel="stylesheet" href="design/icofont/icofont.min.css"/>
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.5.0/css/all.css" integrity="sha384-B4dIYHKNBt8Bc12p+WXckhzcICo0wtJAoU8YZTY5qE0Id1GSseTk6S+L3BlXeVIU" crossorigin="anonymous">
    
    <!--------end style sheets--->
    <!--------side bar--->

    <link rel="shortcut icon" type="image/x-icon" href="design/images/game-controller-1400688-1189016.png">
      <title>Edit profile</title>
</head>
<body> 

    <div class="container-fluid">
        <div class="row flex-nowrap">
            <div class="col-auto col-md-3 col-xl-2 px-sm-2 px-0  bg-gradient ">
                <div class="d-flex flex-column align-items-center align-items-sm-start px-3 pt-2  min-vh-100">
                    <a href="dashboard.php" class="d-flex align-items-center pb-3 mb-md-0 me-md-auto text-light text-decoration-none">
                    <span class="fs-5 d-none d-sm-inline">EGaming</span>
                    </a>


                    <ul class="nav nav-pills flex-column mb-sm-auto mb-0 align-items-center align-items-sm-start " id="menu" >

                    <li class="nav-item w-100">
                            <a href="dashboard.php" class="nav-link align-middle px-0  ">
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
                                <i class="fs-4 fas fa-user-lock"></i> <span class="ms-1 d-none d-sm-inline acitve">Add new admin</span> </a>

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
                            <li><a class="dropdown-item" href="logout.php">Sign out</a></li>
                        </ul>
                    </div>
                </div>
            </div>
    <!-------- end side bar--->

<?php
if(isset($_POST['add'])){
$name =        $_POST['fullname'];
$username =    $_POST['username'];
$age =         $_POST['age'];
$password =    $_POST['password'];
$oldpass =    $_POST['oldpassword'];
$email =       $_POST['email'];
$formerror1=array();
$formerror2=array();
$formerror3=array();
$formerror4=array();
$formerror5=array();
if(empty($name)){
  $formerror1[]='fullname can\'t be empty';
}
if(empty($username)){
  $formerror2[]='username can\'t be empty';
}else{
    $stmt= $con->prepare("SELECT hostuser FROM internetcafe WHERE hostuser = ? AND HostID!=? ");
    $stmt->execute(array($username,$_SESSION['admin_id']));
    $count4=$stmt->rowCount();

    $stmt= $con->prepare("SELECT username FROM users WHERE username = ? AND ID!=?");
    $stmt->execute(array($username,$_SESSION['admin_id']));
    $count5=$stmt->rowCount();
    $count6=$count4+$count5;
    if ($count6>0){
      $formerror2[]='Username already exsist';
    }
}
if(empty($age)){
  $formerror3[]='age can\'t be empty';
}
if(empty($password)){
    $pass=$oldpass;
}else{
    $pass=sha1($password);
}
if(empty($email)){
  $formerror5[]='email can\'t be empty';
}else{
    $stmt= $con->prepare("SELECT email FROM internetcafe WHERE email = ?  AND HostID!=?");
    $stmt->execute(array($email,$_SESSION['admin_id']));
    $count1=$stmt->rowCount();

    $stmt= $con->prepare("SELECT email FROM users WHERE email = ? AND ID!=?");
    $stmt->execute(array($email,$_SESSION['admin_id']));
    $count2=$stmt->rowCount();
    $count=$count1+$count2;
    if ($count>0){
      $formerror5[]='Email already exsist';
    }
}
if(empty($formerror1)&&empty($formerror2)&&empty($formerror3)&&empty($formerror4)&&empty($formerror5)){

  $stmt = $con->prepare("UPDATE users SET username=?, fullname=?, PW=?, age=?, email=? WHERE ID=?");
  $stmt-> execute(array($username,$name,$pass,$age,$email,$_SESSION['admin_id']));
  $success=array();
  $success[]= 'your profile has been edited successfully';
}}



// <!-------------------------------------- form----------------------------------------------------->

$stmt=$con->prepare("SELECT * FROM users WHERE ID=? AND activation=1 ");
$stmt->execute(array($_SESSION['admin_id']));
$row=$stmt->fetch();
?>


    
<div class="container w-50 p-5 " >
    <form action="" method="POST">
        <div class="d-flex flex-row align-items-center mb-4">
            <i class="fas fa-user fa-lg me-3 fa-fw"></i>
            <div class="form-outline flex-fill mb-0">
              <input type="text" id="form3Example1c" value="<?=$row['fullname']?>" placeholder="fullname" name="fullname" class="form-control" />
              <?php if (!empty($formerror1)){ foreach($formerror1 as $errorz){ echo '<p style="color:red;">'. $errorz.'<p>'; }}  else{ ?>
              <label class="form-label text-light"  for="form3Example1c">Name</label>
              <?php }?>
            </div>
          </div>


        <div class="d-flex flex-row align-items-center mb-4">
            <i class="fas fa-user-lock fa-lg me-3 fa-fw"></i>
            <div class="form-outline flex-fill mb-0">
              <input type="text" id="form3Example1c" value="<?=$row['username']?>" placeholder="username" name="username" class="form-control" />
              <?php if (!empty($formerror2)){ foreach($formerror2 as $errorz){ echo '<p style="color:red;">'. $errorz.'<p>'; }} else{
                ?>
              <label class="form-label text-light" for="form3Example1c">Username</label>
<?php }?>
            </div>
          </div>

          <div class="d-flex flex-row align-items-center mb-4">
            <i class="fas fa-envelope fa-lg me-3 fa-fw"></i>
            <div class="form-outline flex-fill mb-0">
              <input type="email" id="form3Example3c" value="<?=$row['email']?>" placeholder="email"  name="email"class="form-control" />
              <?php if (!empty($formerror5)){ foreach($formerror5 as $errorz){ echo '<p style="color:red;">'. $errorz.'<p>'; }}  else{ ?>
              <label class="form-label text-light" for="form3Example3c"> Email</label>
              <?php }?>
            </div>
          </div>



          <div class="d-flex flex-row align-items-center mb-4">
            <i class="fas fa-lock fa-lg me-3 fa-fw"></i>
            <div class="form-outline flex-fill mb-0">
            <input type="hidden" id="form3Example43c"  value="<?=$row['PW']?>" name="oldpassword" class="form-control" />
              <input type="password" id="form3Example4c" placeholder="password"  name="password" class="form-control" />
              <?php if (!empty($formerror4)){ foreach($formerror4 as $errorz){ echo '<p style="color:red;">'. $errorz.'<p>'; }} else{  ?>
              <label class="form-label text-light"for="form3Example4c">Password</label>
              <?php }?>
            </div>
          </div>


        <div class="d-flex flex-row align-items-center mb-4">
            <i class="fas fa-calculator fa-lg me-3 fa-fw"></i>
            <div class="form-outline flex-fill mb-0">
              <input list="seats" class="form-control" name="age" value="<?=$row['age']?>" placeholder="age" id="formFileMultiple" type="number"> 
              <?php if (!empty($formerror3)){ foreach($formerror3 as $errorz){ echo '<p style="color:red;">'. $errorz.'<p>'; }} else{ ?>
            <label class="form-label text-light" for="form3Example4cd ">Age</label>
            <?php }?>
            </div>
          </div>

          <div class="d-flex justify-content-center mx-4 mb-3 mb-lg-4">
            <button type="submit"  style="margin:10px;" name="add" class="btn btn-primary btn-lg">Add</button>
            <a href='dashboard.php'  style="margin:10px;  font-size: 20px;"class='btn btn-danger'> cancel </a> 
          </div>
          <div class="text-center">
         <?php if (!empty($success)){ foreach($success as $succ){ echo '<p style="color:purple;">'. $succ.'<p>'; }} ?>
         </div>
              </form>
</div>
<!--------End form--->
<?php
}   
else {
header('location:../login.php');
    exit();
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