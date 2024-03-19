<?php
include 'admin/connect.php';


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