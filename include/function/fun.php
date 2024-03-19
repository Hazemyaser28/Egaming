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
function getbun($from,$order,$Host,$hostid){
    global $con;
    $stmt=$con->prepare("SELECT * FROM $from WHERE $Host= ?   ORDER BY $order DESC");
    $stmt->execute(array($hostid));
    $loc =$stmt->fetchAll();
    return $loc;
   
   }
   function getimages($hostid){
    global $con;
    $stmt=$con->prepare("SELECT images FROM internetcafe WHERE HostID= ? ");
    $stmt->execute(array($hostid));
    $img =$stmt->fetch();
    $images=$img['images'];
   
   }
// Get latest recored data Function
function getthing($from,$order){
    global $con;
    $stmt=$con->prepare("SELECT * FROM $from ORDER BY $order DESC");
    $stmt->execute();
    $loc =$stmt->fetchAll();
    return $loc;
   
   }
   function checkact($user){
        global $con;
        
        $stmt = $con->prepare("SELECT username, activation FROM users WHERE username= ? AND activation = 1 "); 
       
        $stmt-> execute(array($user));
        
        $member = $stmt->rowCount();
        
        return $member;
   }



   function getlocat($order){
    global $con;
    $stmt=$con->prepare("SELECT cybername,hostID,hostuser FROM internetcafe WHERE activated=1 AND location=? ORDER BY $order DESC");
    $stmt->execute(array($_GET['location']));
    $loc =$stmt->fetchAll();
    return $loc;
   
   }

//check if item exsist in database and count it function 
function checkitem($select,$from,$value){
    global $con;
    $stmt = $con->prepare("SELECT $select FROM $from WHERE $select= ? ");
    $stmt->execute(array($value));
    $count = $stmt->rowCount();
    return $count;
}

//redirect function
function redirection($redimsg ,$url=null, $seconds=3){
    if ($url ===null){
        $url = 'index.php';
        $link = 'Home Page';
    }
    elseif ($url === 'login'){
        $url='login.php';
        $link = 'login Page';
      }
      elseif ($url === 'home'){
        $url='index.php';
        $link = 'Home Page';
      }
      elseif ($url === 'bundles'){
        $url='bundles.php';
        $link = 'Bundles Page';
      }
      elseif ($url === 'profile'){
        $url='profile.php';
        $link = 'Profile Page';
      }
      
    else {
        $url= isset($_SERVER['HTTP_REFERER']) && $_SERVER['HTTP_REFERER']!==''?$_SERVER['HTTP_REFERER']:'login.php';
        $link='Previous Page';
    }
    echo $redimsg;
    echo "<div class='alert alert-info text-center'>You Will be Redirected to the $link After $seconds Seconds</div>";
    header("refresh:$seconds;url=$url");
    exit();
}

//redirect function
function redirect22($url=null, $seconds=4){
    if ($url === 'back'){
        $url= isset($_SERVER['HTTP_REFERER']) && $_SERVER['HTTP_REFERER']!==''?$_SERVER['HTTP_REFERER']:'dashboard.php';
        $link='Previous Page';
    echo "<div class='alert alert-danger text-center'>You Will be Redirected to $link After $seconds Seconds</div>";
    header("refresh:$seconds;url=$url");
    }
    exit();
}




//    <?php
// //page title function
// function getTitle(){
//     global $pagetitle;     //to work on all pages
//     if(isset($pagetitle)){
//         echo $pagetitle;
//     }
//     else{
//         echo 'EGaming';
//     }
// }



// //count items function
// function countitems($item,$table)
// {
//     global $con;
//     $stmt=$con->prepare("SELECT COUNT($item)FROM $table");
//     $stmt->execute();
//     return $stmt->fetchColumn();
// }
// // Get latest recored data Function
// function getlatest($select,$table,$order,$limit=5){
//  global $con;
//  $stmt=$con->prepare("SELECT $select FROM $table ORDER BY $order DESC LIMIT $limit");
//  $stmt->execute();
//  $row =$stmt->fetchAll();
//  return $row;

// }