<?php
session_start();
$pagetitle=$_GET['hname'];
include 'init.php';
require('config.php');

//crating a host id  and name session
$_SESSION['host_id']=$_GET['hostid'];
$_SESSION['host_name']=$_GET['hname'];
?>

<div class="container">
<h1 class="text-center"><?php echo 'Welcome To  '.$_GET['hname'] .' Internet cafe'?> </h1>
</div>
<div class="row">
<?php







// -----------------------------------select seat start-------------------------------

$stmt=$con->prepare("SELECT all_seats FROM internetcafe WHERE HostID=? ");
$stmt->execute(array($_GET['hostid']));
$all=$stmt->fetch();
$seat=$all['all_seats'];
$seats=1;



//getting user id 
$stmt=$con->prepare("SELECT userID FROM seats WHERE host_id=? ");
$stmt->execute(array($_GET['hostid']));
$user_id=$stmt->fetchAll(PDO::FETCH_COLUMN);


while ($seats <= $seat ) {


  //------------------ start  get the time and check if it started or not------------------------------------------------
  for ($z = 3000; $z <= 4000; $z++) {
  if(in_array($z,$user_id)){
  date_default_timezone_set("Africa/Lagos");
  $stmt=$con->prepare("SELECT TIMESTAMPDIFF (SECOND, time, NOW()) AS tdif, seat_booked FROM seats WHERE userID=$z");
  $stmt->execute();
  $time2=$stmt->fetch();
  $start=$time2['tdif'];
  $seatz=$time2['seat_booked'];
    if($seatz==$seats &&$start>=0){ 
      ?>
        <div class="button">
        <input type="button" class="btn btn-danger"   value="<?=$seats?>"  />
        </div>
        <?php 
          $seats++; 
       }  
      }}
  //------------------ end get the time and check if it started or not------------------------------------------------
  ?>

  <form action="payment.php" method="POST">
  <div class="button">
    <input type="radio" id="a25<?=$seats?>"  value="<?=$seats?>" name="seats" />
    <label class="btn btn-default" for="a25<?=$seats?>"><?=$seats?></label>
  </div>
    <?php
  $seats++;
 
}

?>
<div class="reserve">
  <span>how many hours</span>
<input type="number" name="hours" />
<input type="datetime-local" name="time" />
 <input type="submit" value="reserve"  class="btn btn-warning" name="submit" />
 </div>
</form>

<?php


// -----------------------------------select seat end-------------------------------



// -----------------------------------delete user when his reserve timeout-------------------------------



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


// -----------------------------------delete user when his reserve timeout-------------------------------














//get internet cafe data
$stmt=$con->prepare("SELECT images , email FROM internetcafe WHERE HostID=? ");
$stmt->execute(array($_GET['hostid']));
$bun1=$stmt->fetchALL();

//to echo sign in to pay 1 time
$login=1;



//get table bundles data
foreach (getbun('bundles','ID','host_id',$_GET['hostid']) as $bun){
foreach ($bun1 as $bund){
  
  
  //get email 
        if(isset($_SESSION['user_id'])){
         $stmt=$con->prepare("SELECT email FROM users WHERE ID=? ");
         $stmt->execute(array($_SESSION['user_id']));
         $usremail1=$stmt->fetchALL();
         foreach ($usremail1 as $usremail){
        ?>
        <!-- payment form -->
        <!-- <form  action="submit.php?bunid=<?=$bun['ID']?>" method="POST">
<script
           src="https://checkout.stripe.com/checkout.js" class="stripe-button"
           data-key="<?php echo $publishableKey?>"
           data-amount="<?=$amout ?>"
           data-name="<?=$bun['name'] ?>"
           data-description="<?=$_GET['hname'] ?>"
           data-image="upload/<?=$_GET['hostid']?>/<?=$bund['images'] ?>"
           data-currency="EGP"
           data-email="<?=$usremail['email'] ?>">
  </script>
  </form> -->

      <?php } }
       // if user isnt logged in he gets an error message to log in
      // elseif($login===1) { echo '<div class=" alert alert-danger text-center"> Signin to Pay </div>';  $login++;   }
//       echo '<div class="col-3">';
//       echo '<div class="thumbnail">';
//       echo '<span class="price-tag">£'  . $bun['price'].'</span>';
//            echo '<div class="caption">';
//           echo '<h3>' . $bun['name'].'</h3>';
//           echo '<h2>' . $bun['bundle_hours']. ' Hours</h2>';
//          echo '<p>' . $bun['description'].'</p>';
//         echo '</div>';
//       echo '</div>'; 
//      echo "<img class='img-responsive' src='upload/".$_GET['hostid']."/".$bund['images']."'/>";
//    echo '</div>';    
// echo '</div>';  
}}

include  $tmp . 'footer.php';    //footer included
?>