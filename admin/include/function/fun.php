<?php
//page title function
function getTitle(){
    global $pagetitle;     //to work on all pages
    if(isset($pagetitle)){
        echo $pagetitle;
    }
    else{
        echo 'EGaming';
    }
}
//redirect function
function redirection($redimsg ,$url=null, $seconds=4){
    if ($url ===null){
        $url = 'include.php';
        $link = 'Home Page';
    }
    elseif ($url === 'host'){
      $url='host_control.php';
      $link = 'host control Page';
    }
    elseif ($url === 'manage'){
        $url='admin_bundle.php?redirect=manage';
        $link = 'Bundles Page';
      }
      elseif ($url === 'dashboard'){
        $url='dashboard.php';
        $link = 'dashboard Page';
      }
      elseif ($url === 'login'){
        $url='../login.php';
        $link = 'Login Page';
      }
    else {
        $url= isset($_SERVER['HTTP_REFERER']) && $_SERVER['HTTP_REFERER']!==''?$_SERVER['HTTP_REFERER']:'include.php';
        $link='Previous Page';
    }
    echo $redimsg;
    echo "<div class='alert alert-warning text-center'>You Will be Redirected to $link After $seconds Seconds</div>";
    header("refresh:$seconds;url=$url");
    exit();
}

//check if item exsist in database and count it function 
function checkitem($select,$from,$value){
    global $con;
    $stmt = $con->prepare("SELECT $select FROM $from WHERE $select= ? ");
    $stmt->execute(array($value));
    $count = $stmt->rowCount();
    return $count;
}

//count items function
function countitems($item,$table)
{
    global $con;
    $stmt=$con->prepare("SELECT COUNT($item)FROM $table");
    $stmt->execute();
    return $stmt->fetchColumn();
}
// Get latest recored data Function
function getlatest($select,$table,$order,$limit=5){
 global $con;
 $stmt=$con->prepare("SELECT $select FROM $table ORDER BY $order DESC LIMIT $limit");
 $stmt->execute();
 $row =$stmt->fetchAll();
 return $row;

}