<?php
ob_start();
session_start();
include 'init2.php';
    if (isset($_SESSION['admin_id']))
    {
  $admin=isset($_GET['redirect'])? $_GET['redirect']:'manage';

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
      <title>Bundels</title>
</head>
<body> 

    <div class="container-fluid">
        <div class="row flex-nowrap">
            <div class="col-auto col-md-3 col-xl-2 px-sm-2 px-0  bg-gradient ">
                <div class="d-flex flex-column align-items-center align-items-sm-start px-3 pt-2  min-vh-100">
                    <a href="dashboard.php" class="d-flex align-items-center pb-3 mb-md-0 me-md-auto text-light text-decoration-none">
                    <span class="fs-5 d-none d-sm-inline">EGaming</span>
                    </a>


                    <ul class="nav nav-pills flex-column mb-sm-auto mb-0 align-items-center align-items-sm-start  " id="menu" >

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
                       
                        <li class="nav-item w-100">
                            <a href="admin_bundle.php" class="nav-link px-0 align-middle acitve" >
                                <i class="fs-4 fas fa-list"></i> <span class="ms-1 d-none d-sm-inline ">Bundles</span> </a>
                        </li>
                        <li class="nav-item w-100">
                            <a href="new_admin.php" class="nav-link px-0 align-middle  ">
                                <i class="fs-4 fas fa-user-lock"></i> <span class="ms-1 d-none d-sm-inline">Add new admin</span> </a>

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
                            <li><a class="dropdown-item" href="admin_profile.php">Profile</a></li>
                            <li>
                                <hr class="dropdown-divider">
                            </li>
                            <li><a class="dropdown-item" href="logout.php">Sign out</a></li>
                        </ul>
                    </div>
                </div>
            </div>
    <!-------- end side bar--->
    <?php

    if($admin =='manage'){
    $stmt=$con->prepare("SELECT * FROM bundles");
    $stmt->execute();
    $bun=$stmt->fetchALL();
    if (!empty($bun)){
      $numm=1; ?>


    <div class="container w-75 p-5 " >
    <table class="table table-responsive table-borderless text-light  ">
        <thead>
          <tr>
            <th scope="col">Bundle name </th>
            <th scope="col">Description</th>
            <th scope="col">Hours </th>
            <th scope="col">Price </th>
            <th scope="col">Created on</th>
            <th scope="col" class="action1" >Action </th>
        </thead>
        <tbody >
            <tr>
         <?php       
       foreach($bun as $bundle){
 echo "<tr>";
 echo "<td>" . $bundle['name'] . "</td>";
 echo "<td>" . $bundle['description'] . "</td>";
 echo "<td>" . $bundle['bundle_hours'] . "</td>";
 echo "<td>" . $bundle['price'] . "</td>";
 echo "<td>" . $bundle['date'] . "</td>";
 echo "<td>
 <a href='admin_bundle.php?redirect=edit&id=". $bundle['ID'] . "' class='btn btn-outline-success Buttonedit  '> Edit </a> ";
 
 echo '<button  data-bs-toggle="modal" data-bs-target="#exampleModal'.$numm.'" type="button"
 class="btn btn-outline-danger Buttonedit ">Delete</button></td>';
?>



  <!-- Modal -->
  <div class="modal fade" id="exampleModal<?=$numm?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
      <div class="modal-content">
        <div class="modal-header ">
          <h5 class="modal-title " id="exampleModalLabel" style="color:red;">Delete</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body" style="color:black;">
             Are you sure you want to delete this bundle?
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
          <a href='admin_bundle.php?redirect=delete&id=<?=$bundle['ID']?>' class='btn btn-danger'> Delete </a> </td>
        </div>
      </div>
    </div>
  </div>
  </tr>
                                                          <!-- end Modal -->






<?php
$numm++;     
}?>
        </tbody>
      </table>
      <a href="admin_bundle.php?redirect=add" class="btn btn-warning"> Add New Bundle </a> 
        </div> 
                    </div>
                </section>
        
                            <!-- end table -->

    </div>
    <?php
    }
    else{
       echo' <div class="container w-75 p-5" >';
    echo "<h1 class='text-center' style='color:purple;'>There is no bundles now click here to add 
    <br><br><a href='admin_bundle.php?redirect=add' class='btn btn-warning login'> Add New Bundle </a></h1>";
    echo'</div>';
}}





//////////////////////////////////////////////////////////////// add new bundle ///////////////////////////////////////////////////////////////



elseif($admin =='add'){ ?>
    <!-------- form--->
<div class="container w-75 p-5">
<form action="?redirect=insert" method="POST" enctype="multipart/form-data">
        <div class="mb-3">
          <label for="exampleInputEmail1" class="form-label text-light">Name</label>
          <input type="text" class="form-control" name="name" id="exampleInputEmail1" aria-describedby="emailHelp">
        </div>
        <div class="mb-3">
          <label for="exampleInputPassword1" class="form-label text-light">Price</label>
          <input type="number" class="form-control" name="price" id="exampleInputPassword1">
        </div>
        <div class="mb-3">
          <label for="exampleInputPassword1" class="form-label text-light">hours</label>
          <input type="number" class="form-control" name="hours" id="exampleInputPassword1">
        </div>
    </br>
        <div class="input-group">
            <span class="input-group-text text-dark bg-gradient">Description </span>
            <textarea class="form-control" name="description" aria-label="With textarea" placeholder="Write your description here. "></textarea>
          </div>
        </br>
          <div class="mb-3">
            <label for="formFileMultiple1" class="form-label text-light">Bundle image</label>
            <input class="form-control" type="file" name="image" id="formFileMultiple" multiple>
            <span>allowed extensions png, jpeg, jpg</span>
          </div>
        </br>
        <button type="submit" class="btn btn-primary">Add new bundle</button><br><br>
        <a href='admin_bundle.php'  style="  font-size: 20px;"class='btn btn-danger'> cancel </a> 
        
      </form>
</div>
<!--------End form--->

<?php }
    elseif($admin =='insert'){
        if($_SERVER['REQUEST_METHOD'] =='POST'){
          //Get Data From FORM
          $name =        $_POST['name'];
          $desc =  $_POST['description'];
          $price =     $_POST['price'];
          $hours =     $_POST['hours'];
          $img_name=  $_FILES['image']['name'];
          $img_size=  $_FILES['image']['size'];
          $tmp_name=  $_FILES['image']['tmp_name'];
          $img_error= $_FILES['image']['error'];
          //Validation 
          $formerror=array();
          if(empty($name)){
              $formerror[]='Enter Bundle Name';
          }
          if(empty($desc)){
              $formerror[]='Enter Bundle Descritpion';
          }
          if(empty($price)){
              $formerror[]='Enter Bundle Price';
            }
            if(empty($hours)){
                $formerror[]='Enter Bundle Hours';
              }
            if (empty($_FILES['image'])){
                $formerror[]='Upload image';  
                                        }  
                            if ($img_error===0){
                            //max size
                            if($img_size >12000000){
                                $formerror[] ="File is Too Large Max Limit is (12MB)";
                            }
                                    else{
                                        $img_ext = pathinfo($img_name,PATHINFO_EXTENSION);   //get extension
                                        $img_lowercase=strtolower($img_ext);                 // make it lowercase
                                        $allowed=array("jpg","jpeg","png");
                                        if(in_array($img_lowercase,$allowed)){
                                            $new_name = uniqid("IMG-",true). '.'. $img_lowercase;  //chaneg image name and encrypt it
                                            
                                        }
                        else{
                        $formerror[] ="Enter a Valid Type of Images <br> i.e png, jpeg, jpg ";
                        }
                    }
                    }
            else{
            $formerror[] ="No File Uploaded";
            }
            


          //loop error till fix
          if(!empty($formerror)){
        echo '<div class="container w-50">';
        echo   '<div class="row d-flex justify-content-center align-items-center error">';
          foreach($formerror as $error){ ?>
              
              <div class="alert alert-danger justify-content-center row" role="alert"> <?=$error?></div>

        <?php  }
               echo   '</div>';
               echo   '</div>';
          }
          //if there is no error update database
          if(empty($formerror)){
                //Check That bundle name  is Unique
                $check=checkitem("name","bundles",$name);
                
                if($check>0){ 
                    echo '<div class="container w-50">';
                    echo   '<div class="row d-flex justify-content-center align-items-center error">';
                    $redimsg=  '<div class="alert alert-info justify-content-center row" role="alert"> bundle name  Already Exsist</div>'; 
                    redirection($redimsg,'back');
                    echo   '</div>';
                    echo   '</div>';
                }

            else{
            //update database
           $stmt = $con->prepare("INSERT INTO bundles(name,description,price,bundle_hours,bun_img)VALUES(:aname,:adesc,:aprice,:zhours,:zimg)");     
           //execute query
           $stmt-> execute(array('aname'=> $name,'adesc'=> $desc,'aprice'=> $price,'zhours'=> $hours,'zimg'=> $new_name)); 
           //success message


            // Get last ID entered database and create a folder for this image
            $lastid = $con->lastInsertId();
            $_SESSION['lastid'] = $lastid;

            if (!file_exists('../bundles/'.$lastid.'/')){
            mkdir('../bundles/'.$lastid.'/'); }
            //Put the image in the file
            $img_path ='../bundles/'.$lastid.'/'.$new_name;
            move_uploaded_file($tmp_name,$img_path);

            echo '<div class="container w-50">';
            echo   '<div class="row d-flex justify-content-center align-items-center error">';
            $redimsg=  '<div class="alert alert-info justify-content-center row" role="alert">' . $name . ' Bundle Added </div>'; 
            redirection($redimsg,'manage',2);
            echo   '</div>';
            echo   '</div>';
         }
        } 
        }
        else{
            echo '<div class="container w-50">';
            echo   '<div class="row d-flex justify-content-center align-items-center error">';
            $redimsg=  '<div class="alert alert-danger justify-content-center row" role="alert"> Unauthorized Enter </div>'; 
            redirection($redimsg,'manage',2);
            echo   '</div>';
            echo   '</div>';
           }
    }

// <!-- ///////////////////////////////////////////////////////// end add new bundle ////////////////////////////////////////////////////////// -->




// <!-- ///////////////////////////////////////////////////////// edit bundle ////////////////////////////////////////////////////////// -->

elseif($admin =='edit'){ 
$_SESSION['bun_id']=isset($_GET['id'])&& is_numeric($_GET['id'])?intval($_GET['id']):0;   //check that the id is numeric 
$bun_id=$_SESSION['bun_id'];
    //select all data
   $stmt = $con->prepare("SELECT * FROM bundles WHERE ID=? ");       //prepare is used to clac before enter the site and reduced threats
   $stmt-> execute(array($bun_id)); 
  $row= $stmt ->fetch();    //fetch data and store it in row
  $_SESSION['bun_image']=$row['bun_img'];
  ?>
  <!-------- form--->
<div class="container w-75 p-5">
<form action="?redirect=update" method="POST" enctype="multipart/form-data">
        <div class="mb-3">
          <label for="exampleInputEmail1" class="form-label text-light">Name</label>
          <input type="text" class="form-control" name="name" value="<?= $row['name']?>" id="exampleInputEmail1" aria-describedby="emailHelp">
        </div>
        <div class="mb-3">
          <label for="exampleInputPassword1" class="form-label text-light">Price</label>
          <input type="number" class="form-control" name="price"  value="<?= $row['price']?>"  id="exampleInputPassword1">
        </div>
        <div class="mb-3">
          <label for="exampleInputPassword1" class="form-label text-light">Hours</label>
          <input type="number" class="form-control" name="hours"  value="<?= $row['bundle_hours']?>"  id="exampleInputPassword1">
        </div>
    </br>
        <div class="input-group">
            <span class="input-group-text text-dark bg-gradient">Description </span>
            <textarea class="form-control" name="description"  aria-label="With textarea"><?= $row['description']?></textarea>
          </div>
        </br>
          <div class="mb-3">
            <label for="formFileMultiple1" class="form-label text-light">Bundle image</label>
            <input class="form-control" type="file" name="image" id="formFileMultiple" multiple><span>allowed extensions png, jpeg, jpg</span>
          </div>
        </br>
        <button type="submit" class="btn btn-primary">Add new bundle</button><br><br>
        <a href='admin_bundle.php'  style="  font-size: 20px;"class='btn btn-danger'> cancel </a> 
      </form>
</div>
<!--------End form--->

<?php }


elseif($admin =='update'){
    if($_SERVER['REQUEST_METHOD'] =='POST'){

//Get Data From FORM
$name =        $_POST['name'];
$desc =  $_POST['description'];
$price =     $_POST['price'];
$hours =     $_POST['hours'];
$img_name=  $_FILES['image']['name'];
$img_size=  $_FILES['image']['size'];
$tmp_name=  $_FILES['image']['tmp_name'];
$img_error= $_FILES['image']['error'];
$BUN_ID=$_SESSION['bun_id'];
//Validation 
$formerror=array();
if(empty($name)){
    $formerror[]='Enter Bundle Name';
}
if(empty($desc)){
    $formerror[]='Enter Bundle Descritpion';
}
if(empty($price)){
    $formerror[]='Enter Bundle Price';
  }
  if(empty($hours)){
    $formerror[]='Enter Bundle hours';
  }
  if ($_FILES['image']['size']==0){
    $new_name=$_SESSION['bun_image'];
                    } else{
                  if ($img_error===0){
                  //max size
                  if($img_size >12000000){
                      $formerror[] ="File is Too Large Max Limit is (12MB)";
                  }
                          else{
                              $img_ext = pathinfo($img_name,PATHINFO_EXTENSION);   //get extension
                              $img_lowercase=strtolower($img_ext);                 // make it lowercase
                              $allowed=array("jpg","jpeg","png");
                              if(in_array($img_lowercase,$allowed)){
                                  $new_name = uniqid("IMG-",true). '.'. $img_lowercase;  //chaneg image name and encrypt it
                                  
                              }
              else{
              $formerror[] ="Enter a Valid Type of Images <br> i.e png, jpeg, jpg ";
              }
          }
          }
  else{
  $formerror[] ="No File Uploaded";
  }}
  


//loop error till fix
if(!empty($formerror)){
echo '<div class="container w-50">';
echo   '<div class="row d-flex justify-content-center align-items-center error">';
foreach($formerror as $error){ ?>
    
    <div class="alert alert-danger justify-content-center row" role="alert"> <?=$error?></div>

<?php  }
     echo   '</div>';
     echo   '</div>';
}
//if there is no error update database
if(empty($formerror)){
      //Check That bundle name  is Unique
      $stmt = $con->prepare("SELECT name FROM bundles WHERE name =?  AND ID != ?");
      $stmt->execute(array($name,$BUN_ID));
      $count = $stmt->rowCount();
      
      if($count>0){ 
          echo '<div class="container w-50">';
          echo   '<div class="row d-flex justify-content-center align-items-center error">';
          $redimsg=  '<div class="alert alert-info justify-content-center row" role="alert"> bundle name  Already Exsist</div>'; 
          redirection($redimsg,'back',2);
          echo   '</div>';
          echo   '</div>';
      } else {
        //update database
             $stmt = $con->prepare(" UPDATE bundles SET name = ?, description = ?, price = ? , bun_img = ?, bundle_hours = ? WHERE ID = ? ");
         //execute query
             $stmt->execute(array($name,$desc,$price,$new_name,$hours,$_SESSION['bun_id'])); 
           


            if (!file_exists('../bundles/'.$_SESSION['bun_id'].'/')){
            mkdir('../bundles/'.$_SESSION['bun_id'].'/'); }
            //Put the image in the file
            $img_path ='../bundles/'.$_SESSION['bun_id'].'/'.$new_name;
            move_uploaded_file($tmp_name,$img_path);

if( $stmt->rowCount()>0){
            echo '<div class="container w-50">';
            echo   '<div class="row d-flex justify-content-center align-items-center error">';
            $redimsg=  '<div class="alert alert-info justify-content-center row" role="alert">you have edited ' . $name . ' bundle </div>'; 
            redirection($redimsg,'manage',2);
            echo   '</div>';
            echo   '</div>';
         }
         else{
          echo '<div class="container w-50">';
          echo   '<div class="row d-flex justify-content-center align-items-center error">';
          $redimsg=  '<div class="alert alert-danger justify-content-center row" role="alert"> nothing changed </div>'; 
          redirection($redimsg,'manage',2);
          echo   '</div>';
          echo   '</div>';
         }}
       
        } 
        }
        else{
            echo '<div class="container w-50">';
            echo   '<div class="row d-flex justify-content-center align-items-center error">';
            $redimsg=  '<div class="alert alert-danger justify-content-center row" role="alert"> Unauthorized Enter </div>'; 
            redirection($redimsg,'manage',2);
            echo   '</div>';
            echo   '</div>';
           }
    }





    elseif($admin =='delete'){
        $usrID=isset($_GET['id'])&& is_numeric($_GET['id'])?intval($_GET['id']):0;   //check that the id is numeric 
        $stmt = $con->prepare("SELECT name FROM bundles WHERE ID =?");
        $stmt->execute(array($usrID));
        $name=$stmt->fetch();
        //using check item function to select bundle 
       $check=checkitem('ID','bundles',$usrID);
    // delete bundle if found
      if($check> 0 ){

            $stmt =$con->prepare("DELETE FROM bundles WHERE ID=?"); 
            $stmt->execute(array($usrID));
            echo '<div class="container w-50">';
            echo   '<div class="row d-flex justify-content-center align-items-center error">';
            $redimsg=  '<div class="alert alert-info justify-content-center row" role="alert">' . $name['name'] . ' bundle deleted </div>'; 
            redirection($redimsg,'manage',2);
            echo   '</div>';
            echo   '</div>';
    
        }}

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