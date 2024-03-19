<?php 
  $msg = "";
  include("../admin/noPDO/nopdoconnect.php");
  if (!isset($_GET['code'])) {
    # code...
    exit(include("notFound.php"));
  }
  $code = $_GET['code'];
  $getEmail = mysqli_query($con, "SELECT email FROM resetpasswords WHERE code ='$code'");
   $row = mysqli_fetch_array($getEmail);

  if (mysqli_num_rows($getEmail) == 0) {
    # code...
   exit(include("notFound.php"));

  }
else {
  $emailGot = $row['email'];
}
  date_default_timezone_set("Africa/Lagos");
  $sql1 = "SELECT TIMESTAMPDIFF (SECOND, date, NOW()) AS tdif FROM resetpasswords WHERE code = '$code'";
  $result = $con->prepare($sql1);
  $result->execute();
  $result->store_result();
  $result->bind_result($tdif);
  $result->fetch();

  if ($tdif >= 180) {
    # code...
    $removeQuery = $con->query("DELETE FROM resetpasswords WHERE code = '$code'");
     exit(include("sessionTimeout.php"));
  }

  if (isset($_POST['submit'])) {
    # code...
    $password = mysqli_real_escape_string($con, $_POST['password']);
    $cpassword = mysqli_real_escape_string($con, $_POST['cpassword']);
     //validate paswword
    $lowercase = preg_match('@[a-z]@', $password);
    $number = preg_match('@[0-9]@', $password);

    if ($password == "" || $cpassword == "") {
      # code...
       $msg = "<div class='alert alert-danger alert-dismissible'>
   <a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>Password can not be empty! </div>";
    }
    else{
      if ($password != $cpassword) {
        # code...
         $msg = "<div class='alert alert-danger alert-dismissible'>
   <a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>Oops! Passwords did not match! Try aagin </div>";
      }
      elseif ( !$lowercase || !$number || strlen($password) < 8) {
        # code...
        $msg = "<div class='alert alert-danger alert-dismissible'>
   <a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>Password must be more than 8 characters in length with atleast one letter, one numeric <strong>e.g kuytgs826q <strong></div>";
      }
      else {
       
     $passwordhashed = sha1($password);
     $queryuser = $con->query("SELECT ID FROM users WHERE email = '$emailGot'");
     $count1=$queryuser->num_rows;


     $cafequery = $con->query("SELECT HostID FROM internetcafe WHERE email = '$emailGot'");
     $count2=$cafequery->num_rows;

     //check if he is a user
     if($count1>0){
      $query = mysqli_query($con, "UPDATE users SET PW = '$passwordhashed' WHERE email = '$emailGot'");
      if ($query) {
        # code...
           $query = $con->query("DELETE FROM resetpasswords WHERE code = '$code'");
           $msg = "<div class='alert alert-success alert-dismissible'>
    <a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>Password Updated! successfully <a class='loginHome' href='http://localhost/egaming/login.php'>Click to Login</a></div>";

      }}
      //check if  he is internetcafe
      elseif($count2>0){
        $query = mysqli_query($con, "UPDATE internetcafe SET hostpass = '$passwordhashed' WHERE email = '$emailGot'");
        if ($query) {
          # code...
             $query = $con->query("DELETE FROM resetpasswords WHERE code = '$code'");
             $msg = "<div class='alert alert-success alert-dismissible'>
      <a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>Password Updated! successfully <a class='loginHome' href='http://localhost/egaming/login.php'>Click to Login</a></div>";
      }}

     
     else{
 
    $msg = "<div class='alert alert-danger alert-dismissible'>
   <a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>Something went wrong! contact the admin!</div>";
  
     }

    }
  }

  }
  
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="description" content="">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">    
    <title>Password Reset</title> 
  <link rel="stylesheet" type="text/css" href="css/style.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.4.1/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="https://fonts.googleapis.com/css?family=Poppins" />
</head>
<body class="bg-gray">      

    <!-- ##### Newsletter Area Start ###### -->
    <section style="margin-top: 40px;">
         <div class="container">
    <div class="row">
        <div class="col-md-4"></div>
          <div class="col-md-4">
               <p><?php echo $msg; ?></p>

                   <div class="admin-box-login">
    <h5 style="margin-top: 20px; text-align: center;"><strong>PASSWORD RESET</strong></h5><br>
<form class="text-center border border-light p-4" action="" method="post">
  <input type="password" name="password" id="typepass" class="form-control mb-4" placeholder="New password..."><br>
  <input type="password" name="cpassword" id="typepass2" class="form-control mb-4" placeholder="Confirm password..."> <br> 
   <input type="checkbox" style="float: left;" onclick="Toggle()"> 
   <p style="float: left; margin-left: 5px;"> Show</p><br><br>   
    <button class="btn admin-reg-btn btn-block" name="submit" type="submit">RESET</button><br>

    <p>You want to login ?
        <a href="http://localhost/egaming/login.php" class="loginHome">Login</a>
    </p>
</form>
<br><br>
       </div>
         </div>

          <div class="col-md-4"></div>
    </div>  
       
   </div> 
      </section>    
</body>
 <script> 
    // Change the type of input to password or text
    function Toggle(){
var pass = document.getElementById("typepass");
var pass2 = document.getElementById("typepass2");
  if (pass.type === "password") {
    pass.type = "text";
  }
    if (pass2.type === "password") {
    pass2.type = "text";
  }
  else{
    pass.type = "password";
   pass2.type = "password";

  }


    } 
  
</script> 
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.4.1/js/bootstrap.min.js"></script>
</html>