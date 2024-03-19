<?php


if(isset($_POST['stripeToken'])){
session_start();
include 'init.php';
require('config.php');
	\Stripe\Stripe::setVerifySslCerts(false);
	$pay=$_SESSION['pay'];
	$seat=$_SESSION['seat'];
	$host=$_SESSION['host_id'];
	$time=$_SESSION['hours'];
	$user_id=$_SESSION['user_id'];
	$now =$_SESSION['time']; 
	$host_email=$_SESSION['host_email'];
	$host_name=$_SESSION['host_name'];
	
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

	

	echo '<div class="alert alert-info text-center center"> Seat number '. $seat . 
	 ' has been reserved successfully and we have send an email to your registered account <a href="home.php"> Click here to go home  </a> </div>';	

	 include('reservation-email.php');
	 
}
//if payment failed
else{   echo '<div class="alert alert-danger text-center center">Payment Failed</div>';  }

?>