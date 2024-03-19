<?php 
/*"<div class='alert alert-danger alert-dismissible'>
   <a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>Email address can not be empty </div>";   
   */ 
  $result = '';
  if (isset($_POST['submit'])) {
    include("../admin/noPDO/nopdoconnect.php");
    $email = mysqli_real_escape_string($con, $_POST['email']);
    if ($email == "") {
      # code...
      $result = "<div class='alert alert-danger alert-dismissible'>
   <a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>Email address can not be empty </div>";
    }
  else{
$queryuser = $con->query("SELECT ID FROM users WHERE email = '$email'");
$cafequery = $con->query("SELECT HostID FROM internetcafe WHERE email = '$email'");
$count=$queryuser->num_rows;
$countcafe=$cafequery->num_rows;
$total =$count+$countcafe;
if (!$total > 0) {
  $user_query = $con->query("SELECT ID FROM users WHERE email = '$email'");
  $cafe_query = $con->query("SELECT HostID FROM internetcafe WHERE email = '$email'");
  $count_user=$user_query->num_rows;
  $count_cafe=$cafe_query->num_rows;
  $total2 =$count_user+$count_cafe;
  if (!$total2 > 0) {
  # code...
   $result = "<div class='alert alert-danger alert-dismissible'>
   <a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>Email Address does not exist in the database </div>";
  }
  else {
    $code = mt_rand(0,900000000);
 $query2 = mysqli_query($con, "INSERT INTO resetpasswords (code, email, date) VALUES ('$code', '$email', NOW())");
 if (!$query2) {
   # code...
  exit("Error Ocurred").mysqli_error($con);
 }
 include('forgot_mailer.php');

}
  }

else{
 $code = mt_rand(0,900000000);
 $query2 = mysqli_query($con, "INSERT INTO resetpasswords (code, email, date) VALUES ('$code', '$email', NOW())");
 if (!$query2) {
   # code...
  exit("Error Ocurred").mysqli_error($con);
 }
 include('forgot_mailer.php');

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
    <!-- Title -->
    <title>Forgot Password</title>
    <!-- <link rel="stylesheet" type="text/css" href="css/style.css"> -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.4.1/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="https://fonts.googleapis.com/css?family=Poppins" />

</head>
<body class="bg-gray">   

    <section style="margin-top: 40px;">
         <div class="container justify-content-center">
    <div class="row">
        <div class="col-md-4"></div>
          <div class="col-md-4">
               <p><!----><?php echo $result; ?></p>

<div class="admin-box-login">     
 <h5 style="margin-top: 20px; text-align: center;"><strong>RESET PASSWORD</strong></h5><br>
<form class="text-center border border-light p-4" action="" method="post">
    <input type="email" name="email" class="form-control mb-4" placeholder="Enter E-mail address..."> <br>     
    <!-- Sign up button -->
    <button class="btn admin-reg-btn btn-block" name="submit" type="submit">REQUEST RESET</button><br>
      <!-- Register -->
    <p>You want to visit home page?
        <a href="../index.php" class="loginHome">Home</a>
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
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.4.1/js/bootstrap.min.js"></script>
</html>