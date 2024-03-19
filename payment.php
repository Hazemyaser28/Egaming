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
      <link rel="stylesheet" href="design/css/pages/payment.css"/>
      <link rel="stylesheet" href="design/css/Animate.css"/>
    <link rel="stylesheet" href="design/icofont/icofont.min.css"/>
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.5.0/css/all.css" integrity="sha384-B4dIYHKNBt8Bc12p+WXckhzcICo0wtJAoU8YZTY5qE0Id1GSseTk6S+L3BlXeVIU" crossorigin="anonymous">
    
    <!--------end style sheets--->

    <link rel="shortcut icon" type="image/x-icon" href="design/images/game-controller-1400688-1189016.png">
      <title>Payment</title>
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



 <!-----------------------------------------------------------validations----------------------------------------------------------->

                    <?php
                  if(isset($_POST['submit'])){
    if(isset($_SESSION['user_id'])){
	$exsist=checkitem('userID','seats',$_SESSION['user_id']);
	if($exsist>0){ ?>

  
<section class="vh-100" style="opacity: 85% !important;">
    <div class="container h-100">
      <div class="row d-flex justify-content-center align-items-center h-100">
              <div class="row justify-content-center">
        <div class="alert alert-primary text-center " role="alert"> sorry, you can reserve 1 seat only. </div>
        </div>
      </div>
    </div>
  </section>
      <?php } 
      else{

        $errorz=array();

        if (empty($_POST['seats'])){
              $errorz[]=' you didnt choose any seat.';
         }
         if ($_POST['hours']>6){
            $errorz[]='you can\'t reserve more than 6 hours.';
       }
         if (empty($_POST['hours'])){
              $errorz[]=' your didnt declare hours.';
         }
         if (empty($_POST['time'])){
              $errorz[]=' your didnt choose the date.';
         }

   








if (!empty($errorz)){
echo'<section id="home">';
echo '<div class="container mt-4 mb-4 p-3 d-flex justify-content-center flex-column">'; 
    
  foreach($errorz as $errors) {  ?>


                        <div class="text mt-3">
                        <div class="alert alert-primary  text-center" > <?=$errors?></div>

                      </div>
                   
                     <?php }
                        redirect22('back',3);
                        echo '</div>';
                     echo '</section>'; 
                    } 
  
             
else{


  $res_seat=$_POST['seats'];
  $time=$_POST['hours'];
//how many hours reserved
  $pay=$time*10;
//the payment ammount
  $amount=$pay*100;
//puting requirments into sessions
  $_SESSION['pay']=$pay;
  $_SESSION['seat']=$res_seat; 
  $_SESSION['hours']=$time;
  $_SESSION['time']=$_POST['time'];
$host_idd= $_SESSION['host_id'];

      //----------------------------------start already reserved----------------------------------------------


 date_default_timezone_set("Africa/Lagos");
     $stmt=$con->prepare("SELECT seat_booked, time, hours FROM seats WHERE seat_booked = $res_seat AND host_id=$host_idd ");
        $stmt->execute();
            $time1=$stmt->fetch();
                $count = $stmt->rowCount();
         if($count>0){
                $time55=$time1['time'];
                 $hours=$time1['hours']*3600;
                $dteStart = new DateTime($time55);
                $dteEnd = new DateTime($_POST['time']);
                $new_hours=$time*3600;
                $start = $dteEnd->getTimestamp() +$new_hours;
                $start2 = $dteEnd->getTimestamp();
                $end=  $dteStart->getTimestamp() + $hours;
        if ($start>$dteStart->getTimestamp()  &&$start2<$end){ ?>

          <section class="vh-100" style="opacity: 85% !important;">
          <div class="container h-100">
            <div class="row d-flex justify-content-center align-items-center h-100">
                    <div class="row justify-content-center">
                    <div class="alert alert-primary" role="alert  text-center">sorry, it\'s already reserved at this time try another seat or time</div>
      </div>
              </div>
            </div>
          </div>
        </section>
  <?php
}else{

    //----------------------------------getting images----------------------------------------------
           $stmt=$con->prepare("SELECT images,email FROM internetcafe WHERE HostID= ? ");
             $stmt->execute(array($_SESSION['host_id']));
             $img =$stmt->fetch();
             $images=$img['images'];
             $_SESSION['host_email']=$img['email'];?>
     
            



                                                <!-- star payment afetr errors -->

<section class="vh-100" >
    <div class="container h-100">
      <div class="row d-flex justify-content-center align-items-center h-100">
        <div class="col-lg-12 col-xl-11">
          <div class="card text-black bg-light" style="border-radius: 25px;">
            <div class="card-body p-md-5">
              <div class="row justify-content-center">
                <div class="col-md-10 col-lg-6 col-xl-5 order-2 order-lg-1">
                  <p class="text-center h1 fw-bold mb-5 mx-1 mx-md-4 mt-4" style="color:darkred">Payment</p>
                </br>
            </br>
        </br>
     <div class="form-check-inline justify-content-center mx-4 mb-3 mb-lg-4">
                <form  class="reserve" action="" method="POST">
                <script
                            src="https://checkout.stripe.com/checkout.js" class="stripe-button"
                            data-key="<?php echo $publishableKey?>"
                            data-amount=" <?=$amount?>"
                            data-name="Seat number <?=$res_seat?>"
                            data-description="Price for <?php if($time>1){echo $time. ' Hours';} else{echo $time .' Hour ';} ?> is <?=$pay?> EGP"
                            data-image="upload/<?=$_SESSION['host_id']?>/<?=$images ?>"
                            data-currency="EGP">
                            
                    </script>
                    </form>

                        </div>
                         <div class="form-check-inline justify-content-center mx-4 mb-3 mb-lg-4 ">
                         <form  class="reserve" action="" method="POST">
                      <button type="submit" name="balance" class="btn btn-danger btn-lg">Pay with your balance</button>
                      <button type="submit" name="balance" class="btn btn-danger btn-lg back"> <script>   
  document.write('<a  class=" back" href="' + document.referrer + '">Go Back</a>');
</script></button>
                     </form>
                      </div>
                    </div>
                    <div class="col-md-10 col-lg-6 col-xl-7 d-flex align-items-center order-1 order-lg-2">
                  <img src="design/images/payment.png" alt="Register"class="img-fluid" style="border-radius: 600px;"  >
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>

                
       <?php }}

//----------------------------------end payment form after checking all errors----------------------------------------------


    
        //--------------------------------start payment form if steat isnt reserved and no error --------------------------------------------------- -->


  else{
                            //getting images
          $stmt=$con->prepare("SELECT images,email FROM internetcafe WHERE HostID= ? ");
            $stmt->execute(array($_SESSION['host_id']));
            $img =$stmt->fetch();
            $images=$img['images'];
            $_SESSION['host_email']=$img['email'];?>




<section class="vh-100" >
    <div class="container h-100">
      <div class="row d-flex justify-content-center align-items-center h-100">
        <div class="col-lg-12 col-xl-11">
          <div class="card text-black bg-light" style="border-radius: 25px;">
            <div class="card-body p-md-5">
              <div class="row justify-content-center">
                <div class="col-md-10 col-lg-6 col-xl-5 order-2 order-lg-1">
                  <p class="text-center h1 fw-bold mb-5 mx-1 mx-md-4 mt-4" style="color:darkred">Payment</p>
                </br>
            </br>
        </br>
<div class="form-check-inline justify-content-center mx-4 mb-3 mb-lg-4">
              <form  class="reserve" action="" method="POST">
              <script
                    src="https://checkout.stripe.com/checkout.js" class="stripe-button"
                    data-key="<?php echo $publishableKey?>"
                    data-amount=" <?=$amount?>"
                    data-name="Seat number <?=$res_seat?>"
                    data-description="Price for <?php if($time>1){echo $time. ' Hours';} else{echo $time .' Hour ';} ?> is <?=$pay?> EGP"
                    data-image="upload/<?=$_SESSION['host_id']?>/<?=$images ?>"
                    data-currency="EGP">     
              </script>
             </form>
            </div>
                <div class="form-check-inline justify-content-center mx-4 mb-3 mb-lg-4 ">
                <form  class="reserve" action="" method="POST">
                     <button type="submit" name="balance" class="btn btn-danger btn-lg">Pay with your balance</button>
                     <button type="submit" name="balance" class="btn btn-danger btn-lg back"> <script>   
  document.write('<a class=" back" href="' + document.referrer + '">Go Back</a>');
</script></button>


                    
                     </form>
                             </div>
                                </div>
                                 <div class="col-md-10 col-lg-6 col-xl-7 d-flex align-items-center order-1 order-lg-2">
                                <img src="design/images/payment.png" alt="Register"class="img-fluid" style="border-radius: 600px;"  >
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

                <!---------------------------- end payment form---------------------------- -->
 <?php
}}} }
             

               else{
                header('location:login.php');       }  }

            //----------------------------------- pay with balance---------------------------------------------------
         
  if(isset($_POST['balance'])){
    $stmt=$con->prepare("SELECT hours,email,fullname FROM users WHERE ID=?");
    $stmt->execute(array( $_SESSION['user_id'] ));
    $data = $stmt->fetch();
    $newhours=$data['hours'] - $_SESSION['hours'];
    $email=$data['email'];
    $user_name=$data['fullname'];
if($data['hours']== 0 || $newhours <0){
  ?>

  <section class="vh-100" style="opacity: 85% !important;">
  <div class="container h-100">
    <div class="row d-flex justify-content-center align-items-center h-100">
            <div class="row justify-content-center"> 
            <?php  
            $redimsg=  '<div class="alert alert-danger  text-center">
            you dont have enough hours in your balance you can charge your hour balance with our bundles
            <a href="bundles.php" style="color: rgb(0,100,0) !important; text-decoration:none;  "> Click here to go bundles  </a> </div>';	
            
            redirection($redimsg,'bundles',5);  ?>
      </div>
    </div>
  </div>
</section>

<?php  
}else{


    $pay=$_SESSION['pay'];
    $seat=$_SESSION['seat'];
    $host=$_SESSION['host_id'];
    $time=$_SESSION['hours'];
    $user_id=$_SESSION['user_id'];
    $now =$_SESSION['time']; 
    $host_email=$_SESSION['host_email'];
    $host_name=$_SESSION['host_name'];

    $stmt = $con->prepare("SELECT cybername FROM internetcafe WHERE hostuser=?"); 
    $stmt-> execute(array($host_name));
    $cybname=$stmt->fetch();
    $cname=$cybname['cybername'];
    
    $stmt=$con->prepare("UPDATE users SET hours=? WHERE ID=?");
    $stmt->execute(array($newhours, $_SESSION['user_id'] ));


    $stmt = $con->prepare("INSERT INTO seats (seat_booked,hours,time,userID,host_id) VALUES (:seat,:hour,:time,:user,:host)"); 
    $stmt-> execute(array(
    'seat'=> $seat,
    'hour'=> $time,
    'time'=> $now,
    'user'=> $user_id,
    'host'=> $host)); 

    include('reservation-email.php'); 
    echo'<section id="home">';
    echo '<div class="container mt-4 mb-4 p-3 d-flex justify-content-center flex-column">';  
 $redimsg=   '<div class="alert alert-primary  text-center" >you have reserved Seat number '. $seat . 
' at '.ucfirst($cname).' internet cafe successfully and we have send the ticket ID to your registered Email and you have  '.$newhours.' 
in your balance <a href="index.php" style="color: rgb(165, 77, 77) !important; text-decoration:none;  "> Click here to go home  </a> </div>';	
redirection($redimsg,'home',15); 
echo '</div>';
echo '</section>'; 
  }}
















           //--------------------------------if payment with credit card succed  ---------------------------------------------------
         
          if(isset($_POST['stripeToken'])){
         
         
                     \Stripe\Stripe::setVerifySslCerts(false);
                     $pay=$_SESSION['pay'];
                     $seat=$_SESSION['seat'];
                     $host=$_SESSION['host_id'];
                     $time=$_SESSION['hours'];
                     $user_id=$_SESSION['user_id'];
                     $now =$_SESSION['time']; 
                     $host_email=$_SESSION['host_email'];
                     $host_name=$_SESSION['host_name'];

                     $stmt = $con->prepare("SELECT cybername FROM internetcafe WHERE hostuser=?"); 
                     $stmt-> execute(array($host_name));
                     $cybname=$stmt->fetch();
                     $cname=$cybname['cybername'];
                     
                     $stmt = $con->prepare("SELECT email,fullname FROM users WHERE ID=?"); 
                     $stmt-> execute(array($_SESSION['user_id']));
                     $result=$stmt->fetch();
                     $email=$result['email'];
                     $user_name=$result['fullname'];
               
                     $token=$_POST['stripeToken'];
               $data=\Stripe\Charge::create(array(
                           "amount"=> $pay*100,
                           "currency"=>"EGP",
                           "description"=>"Reserved seat ".$seat ." for ". $hours = $time>1 ? $hours=$time. " Hours " : $hours= $time . " Hour ",
                           "source"=>$token,
                     ));
               
                                 $stmt = $con->prepare("INSERT INTO seats (seat_booked,hours,time,userID,host_id) VALUES (:seat,:hour,:time,:user,:host)"); 
                                 $stmt-> execute(array(
                                 'seat'=> $seat,
                                 'hour'=> $time,
                                 'time'=> $now,
                                 'user'=> $user_id,
                                 'host'=> $host)); 
               
                                 include('reservation-email.php'); 
                                 echo'<section id="home">';
                                 echo '<div class="container mt-4 mb-4 p-3 d-flex justify-content-center flex-column">'; 
                                 $redimsg=   '<div class="alert alert-primary  text-center" >you have reserved Seat number '. $seat . 
                      ' at '.ucfirst($cname).' internet cafe successfully and we have send the ticket ID to your registered Email <a href="index.php" style="color: rgb(165, 77, 77) !important; text-decoration:none;  "> Click here to go home  </a> </div>';	
                 
                      redirection($redimsg,'home',15); 
                      echo '</div>';
                      echo '</section>'; 
                       }?>


                <!-------------------------------------- end payment------------------------------------>





   <!-- start Footer -->
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