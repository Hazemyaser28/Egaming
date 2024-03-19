<?php
session_start();
$pagetitle='Home';
include 'init.php';
if(isset($_SESSION['user_id']) || isset($_SESSION['admin'])){

echo '<div class=" login alert alert-warning text-center">Welcome <strong>  HOME </strong> </div>';
}
include  $tmp . 'footer.php'; 




?>



<div id="carouselExampleCaptions" class="carousel slide carousely " data-bs-ride="false">
            <div class="carousel-indicators">
            <?php
$stmt =$con->prepare( "SELECT COUNT(*) FROM bundles");
$stmt->execute();
$count = $stmt->fetchcolumn();
for ($x = 0; $x <$count; $x++) {
?>
    <button type="button"  class="login"data-bs-target="#carouselExampleCaptions" data-bs-slide-to="<?=$x ?>" aria-label="Slide <?=$x ?>"></button>
   
<?php


}

?>
            </div>



<!-- //  check activation
     $act = checkact($_SESSION['user']); 
if($act == 0){
    echo 'wait activation ape';
} -->


