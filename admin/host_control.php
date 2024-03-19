<?php
ob_start();
/*
////////////////////////////////////
///      Manage page            ///
/// [edit/delete/add/update]   ///
/////////////////////////////////
*/
session_start();
include 'init2.php';
if (isset($_SESSION['admin_id'])){
    
    if (isset($_GET['redirect'])){  $admin= $_GET['redirect'];}
     else{   $admin='admin';  }
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
      <title>Host control</title>
</head>
<body> 

    <div class="container-fluid">
        <div class="row flex-nowrap">
            <div class="col-auto col-md-3 col-xl-2 px-sm-2 px-0  bg-gradient navv">
                <div class="d-flex flex-column align-items-center align-items-sm-start px-3 pt-2  min-vh-100">
                    <a href="dashboard.php" class="d-flex align-items-center pb-3 mb-md-0 me-md-auto text-light text-decoration-none">
                        <span class="fs-5 d-none d-sm-inline">Egmaing</span>
                    </a>
                    <ul class="nav nav-pills flex-column mb-sm-auto mb-0 align-items-center align-items-sm-start" id="menu">
                        <li class="nav-item">
                            <a href="dashboard.php" class="nav-link align-middle px-0">
                                <i class="fs-4 fas fa-chart-area"></i> <span class="ms-1 d-none d-sm-inline ">Dashboard</span>
                            </a>
                        </li>
                        <li class="nav-item w-100">
                            <a href="host_control.php" class="nav-link px-0 align-middle acitve">
                                <i class="fs-4 fas fa-business-time"></i> <span class="ms-1 d-none d-sm-inline">Host control</span> </a>
                        </li>

                        <li>
                            <a href="admin_bundle.php" class="nav-link px-0 align-middle">
                                <i class="fs-4 fas fa-list"></i> <span class="ms-1 d-none d-sm-inline">Bundles</span> </a>
                        </li>
                        <li>
                            <a href="new_admin.php" class="nav-link px-0 align-middle">
                                <i class="fs-4 fas fa-user-lock"></i> <span class="ms-1 d-none d-sm-inline">Add new admin</span> </a>

                            </a>
                        </li>
                    </ul>
                    <hr>
                    
                    <div class="dropdown pb-4 ">
                        <a href="#" class=" d-flex align-items-center  text-decoration-none dropdown-toggle" id="dropdownUser1" data-bs-toggle="dropdown" aria-expanded="false">
                            <img src="design/images//game-controller-1400688-1189016.png" alt="hugenerd" width="30" height="30" class="rounded-circle">
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
    //if only request admin page
    if($admin== 'admin'){
// to only select pending members
$pending='';
if(isset($_GET['accept']) && $_GET['accept']=='pending')
{
$pending='WHERE activated=0';
}
if(isset($_GET['deactivated']) && $_GET['deactivated']=='de')
{
$pending='WHERE activated=2';
}
        //Getting data from database but not admin data
        $stmt=$con->prepare("SELECT * FROM internetcafe  $pending");
        $stmt->execute();
        $rows=$stmt->fetchALL();
        $count=$stmt->rowCount();
        $img=1;
        $del=100;
        if($count>0){
        ?>

<div class="container w-75 p-5" >
    <table class="table table-responsive table-borderless text-light  ">
        <thead>
          <tr>
            <th scope="col">ID </th>
            <th scope="col">Cybername</th>
            <th scope="col">Email </th>
            <th scope="col">Seats </th>
            <th scope="col">location</th>
            <th scope="col">Register Date </th>
            <th scope="col action2">Action</th>
        </thead>
        <tbody>
            <tr>
              <?php foreach($rows as $row){ ?>
                <th><?=$row['HostID']?></th>
                <td><?=$row['cybername']?></td>
                <td><?=$row['email']?></td>
                <td><?=$row['all_seats']?></td>
                <td><?=$row['location']?></td>
                <td ><?=$row['date']?></td>
                <td>
        <a href='host_control.php?redirect=edit&userid=<?=$row['HostID']?>' class='btn btn-outline-success Buttonedit '> Edit</a>
        <button  data-bs-toggle="modal" data-bs-target="#exampleModal<?=$del?>" type="button"
class="btn btn-outline-danger Buttonedit  ">delete </button>

                                    <!-- delete host Modal -->
 <div class="modal fade" id="exampleModal<?=$del?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
      <div class="modal-content">
        <div class="modal-header ">
          <h5 class="modal-title " id="exampleModalLabel" style="color:red;">Delete</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body" style="color:black;">
             Are you sure you want to delete this host?
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary " data-bs-dismiss="modal">Close</button>
          <a href='host_control.php?redirect=delete&userid=<?=$row['HostID']?>' class='btn btn-danger '> Delete </a>
        </div>
      </div>
    </div>
  </div>
                                                          <!-- end Modal -->




<button  data-bs-toggle="modal" data-bs-target="#exampleModal<?=$img?>" type="button"
class="btn btn-outline-warning Buttonedit">view cyber image </button>
                                                    <!-- view image Modal -->
    <div class="modal fade" id="exampleModal<?=$img?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
          <div class="modal-header ">
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body" style="color:black;">
          <img src="../upload/<?=$row['HostID']?>/<?=$row['images']?>" class="d-block w-100" alt="...">
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
          </div>
        </div>
      </div>
    </div>
                                                            <!-- end Modal -->

                <?php if($row['activated']== 0 || $row['activated']== 2){ 
              echo "<a href='host_control.php?redirect=activate&userid=". $row['HostID'] . "' class='btn btn-outline-primary Buttonedit'> Activate </a>";
                } ?>
              </td>
              </tr>


              <?php 
    $img++;  
    $del++; 
            } ?>


        </tbody>
      </table>
     <a href="host_control.php?redirect=add" class="btn btn-warning"> Add a new host </a>
  </div> 

    <?php
    }   else{
     
      if( $pending==''){
        echo '<div class="container w-50">';
        echo   '<div class="row d-flex justify-content-center align-items-center error">';
        echo  '<div class="justify-content-center row text-light" role="alert"><h1 class="text-center">we have 0 hosts</h1>  </div>'; 
        echo '<a href="host_control.php?redirect=add" class="btn btn-success"> Add a new host </a><br><br>';
       echo '<a href="dashboard.php" class="btn btn-warning"> click here to go back </a>';
        echo   '</div>';
        echo   '</div>';
      } 

      if($pending=='WHERE activated=0'){
        echo '<div class="container w-50">';
        echo   '<div class="row d-flex justify-content-center align-items-center error">';
        echo  '<div class="justify-content-center row text-light" role="alert"><h1 class="text-center">no new pending hosts</h1>  </div>'; 
       echo '<a href="dashboard.php" class="btn btn-warning"> click here to go back </a>';
        echo   '</div>';
        echo   '</div>';
      } 

    if($pending=='WHERE activated=2'){
      echo '<div class="container w-50">';
      echo   '<div class="row d-flex justify-content-center align-items-center error">';
      echo  '<div class="justify-content-center row text-light" role="alert"><h1 class="text-center">Empty</h1>  </div>'; 
     echo '<a href="dashboard.php" class="btn btn-warning"> click here to go back </a>';
      echo   '</div>';
      echo   '</div>';
    } 
  }}
  
                                        //  <!-- end table -->



// ****************************************************start add page********************************************************************
         elseif($admin =='add'){ ?>  

<div class="container w-50 p-5">
<form action="?redirect=insert" method="POST" enctype="multipart/form-data">
<div class="d-flex flex-row align-items-center mb-4">
        <i class="fas fa-user fa-lg me-3 fa-fw"></i>
            <div class="form-outline flex-fill mb-0">
             <input type="text" id="form3Example1c"  name="cname" placeholder="internetcafe name"  class="form-control" />
   <label class="form-label text-light" for="form3Example1c">Internet cafe name</label>
</div>
</div>

  
  <div class="d-flex flex-row align-items-center mb-4">
      <i class="fas fa-user-lock fa-lg me-3 fa-fw"></i>
      <div class="form-outline flex-fill mb-0">
        <input type="text" id="form3Example1c" name="username"  placeholder="username used for login"  class="form-control" />
        <label class="form-label text-light"  for="form3Example1c">Username</label>
      </div>
    </div>

    <div class="d-flex flex-row align-items-center mb-4">
      <i class="fas fa-envelope fa-lg me-3 fa-fw"></i>
      <div class="form-outline flex-fill mb-0">
        <input type="email" id="form3Example3c" name="email" placeholder="enter a valid email" class="form-control" />
        <label class="form-label text-light"  for="form3Example3c"> Email</label>
      </div>
    </div>

    <div class="d-flex flex-row align-items-center mb-4">
      <i class="fas fa-lock fa-lg me-3 fa-fw"></i>
      <div class="form-outline flex-fill mb-0">
        <input type="password" id="form3Example4c"  name="password" placeholder="password" class="form-control" />
        <label class="form-label text-light" for="form3Example4c">Password</label>
      </div>
    </div>

  
  <div class="d-flex flex-row align-items-center mb-4">
      <i class="fas fa-map fa-lg me-3 fa-fw"></i>
      <div class="form-outline flex-fill mb-0">
      <input list="location"  name="location" id="form3Example4cd" class="form-control" placeholder="if your location isn't listed type here" />
        <datalist id="location">
                          <option value="maadi">
                          <option value="zamalek">
                          <option value="5th settlement">
                          <option value="nasr city">
       </datalist>
        <label class="form-label text-light" for="form3Example4cd">Location</label>
      </div>
    </div>

    <div class="d-flex flex-row align-items-center mb-4">
      <i class="fas fa-calculator fa-lg me-3 fa-fw"></i>
      <div class="form-outline flex-fill mb-0">
        <input list="seats" class="form-control"  name="seats" id="formFileMultiple" placeholder="seats" type="number"> 
        <?php 
                          $list=1;
                          echo  '<datalist id="seats">';
                          while ($list<= 30){
                           echo '<option value="'. $list .'">';
                           $list++; }
                           echo '</datalist>'; ?>
      <label class="form-label text-light" for="form3Example4cd ">How many seats?</label>
      </div>
    </div>


    <div class="d-flex flex-row align-items-center mb-4">
      <i class="fas fa-file fa-lg me-3 fa-fw"></i>
      <div class="form-outline flex-fill mb-0">
          <div class="mb-3">
              <label for="formFileMultiple" class="form-label text-light">Upload an image of your internet café.</label>
              <input class="form-control" type="file" name="image" id="formFileMultiple" multiple>  
              <span style="color:red !important;">allowed file type is jpeg,png,jpg</span>                
            </div>
      </div>
    </div>

   <div class="d-flex justify-content-center mx-4 mb-3 mb-lg-4">
      <button type="submit"  style="margin:10px;" name="insert" class="btn btn-primary btn-lg">Add</button>
      <a href='host_control.php'  style="margin:10px;  font-size: 20px;"class='btn btn-danger'> cancel </a> 
      </div>
      </div>
    </div>
 </form> 
                  <?php 
                  }
              
              
                  //insert page
                  elseif($admin =='insert'){
                  if($_SERVER['REQUEST_METHOD'] =='POST'){
                    //Get Data From FORM
                    $username =        $_POST['username'];
                    $pass =           $_POST['password'];
                    $seats =           $_POST['seats'];
                    $cname =           $_POST['cname'];
                    $email =           $_POST['email'];
                    $location =        $_POST['location'];
                    $img_name=  $_FILES['image']['name'];
                    $img_size=  $_FILES['image']['size'];
                    $tmp_name=  $_FILES['image']['tmp_name'];
                    $img_error= $_FILES['image']['error'];
                    //Validation 
                    $formerror=array();
                    if(empty($username)){
                        $formerror[]='Username Cant be empty';
                    }
                    if(empty($pass)){
                        $formerror[]='password Cant be Empty';
                    }
                    if(empty($cname)){
                      $formerror[]='Cyber Name Cant Be Empty';
                  }
                  if(empty($seats)){
                    $formerror[]='Enter number of seats';
                }
                if(empty($email)){
                  $formerror[]='Email Cant Be Empty';
              }else{
                $stmt= $con->prepare("SELECT email FROM internetcafe WHERE email = ? ");
                $stmt->execute(array($email));
                $count1=$stmt->rowCount();
          
                $stmt= $con->prepare("SELECT email FROM users WHERE email = ?");
                $stmt->execute(array($email));
                $count2=$stmt->rowCount();
                $count=$count1+$count2;
                if ($count>0){
                  $formerror[]='Email already exsist';
                }
              }
                    if(empty($location)){
                      $formerror[]='Location Can\'t Be Empty';
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
                          //Check That Username is Unique
                          $check=checkitem("hostuser","internetcafe",$username);
                          $check2=checkitem("username","users",$username);
                          $check3=$check+$check2;
                          if($check3>0){ 
                            echo '<div class="container w-50">';
                            echo   '<div class="row d-flex justify-content-center align-items-center error">';
                              echo '<div class="alert alert-danger text-center"> Username Already Exsist</div>'; 
                              echo   '</div>';
                              echo   '</div>';
                          }
                      else{
                      //update database
                      $stmt = $con->prepare("INSERT INTO internetcafe (hostuser,hostpass,cybername,email,location,all_seats,images,date,activated)
                      VALUES(:zuser,:zpass,:zname,:zemail,:zlocation,:zseats,:zimages,now(),1)");     
                      //execute query
                      $stmt-> execute(array(
                      'zuser'=> $username,
                      'zpass'=> sha1($pass),
                      'zname'=> $cname,
                      'zemail'=> $email,
                      'zlocation'=> $location,
                      'zseats'=> $seats,
                      'zimages'=> $new_name)) ; 
                      //success message
                      // Get last ID entered database and create a folder for this image
            $lastid = $con->lastInsertId();
            if (!file_exists('../upload/'.$lastid.'/')){
            mkdir('../upload/'.$lastid.'/'); }
            //Put the image in the file
            $img_path ='../upload/'.$lastid.'/'.$new_name;
            move_uploaded_file($tmp_name,$img_path);

            echo '<div class="container w-50">';
            echo   '<div class="row d-flex justify-content-center align-items-center error">';
            $redimsg=  '<div class="alert alert-info justify-content-center row" role="alert">' . $cname . ' cafe added </div>'; 
            redirection($redimsg,'host',2);
            echo   '</div>';
            echo   '</div>';
                    }
                  }
                    }
                
                    else{
                      echo '<div class="container w-50">';
                      echo   '<div class="row d-flex justify-content-center align-items-center error">';
                      $redimsg=  '<div class="alert alert-danger justify-content-center row" role="alert"> Unauthorized Enter </div>'; 
                      redirection($redimsg,'host',2);
                      echo   '</div>';
                      echo   '</div>';
                     }}



// ****************************************************end add page********************************************************************



// ****************************************************start edit page********************************************************************

elseif($admin =='edit'){
  $usrID=isset($_GET['userid'])&& is_numeric($_GET['userid'])?intval($_GET['userid']):0;  
$_SESSION['hos_ID']=$usrID;

$stmt = $con->prepare("SELECT * FROM internetcafe WHERE HostID=? ");     
$stmt-> execute(array($usrID)); 
$row= $stmt->fetch();   
$member = $stmt->rowCount();  
$_SESSION['img_host']=$row['images'];
//if there is id show edit form
if($stmt->rowCount() > 0 ){ ?>
<div class="container w-50 p-5">
<form action="?redirect=update" method="POST"  enctype="multipart/form-data">
<div class="d-flex flex-row align-items-center mb-4">
        <i class="fas fa-user fa-lg me-3 fa-fw"></i>
            <div class="form-outline flex-fill mb-0">
             <input type="text" id="form3Example1c"  name="cname" placeholder="internetcafe name" value="<?=$row['cybername']?>" class="form-control" />
   <label class="form-label text-light" for="form3Example1c">Internet cafe name</label>
</div>
</div>

  
  <div class="d-flex flex-row align-items-center mb-4">
      <i class="fas fa-user-lock fa-lg me-3 fa-fw"></i>
      <div class="form-outline flex-fill mb-0">
        <input type="text" id="form3Example1c" name="username"  placeholder="username used for login" value="<?=$row['hostuser']?>" class="form-control" />
        <label class="form-label text-light"  for="form3Example1c">Username</label>
      </div>
    </div>

    <div class="d-flex flex-row align-items-center mb-4">
      <i class="fas fa-envelope fa-lg me-3 fa-fw"></i>
      <div class="form-outline flex-fill mb-0">
        <input type="email" id="form3Example3c" name="email" placeholder="enter a valid email"  value="<?=$row['email']?>" class="form-control" />
        <label class="form-label text-light"  for="form3Example3c"> Email</label>
      </div>
    </div>

    <div class="d-flex flex-row align-items-center mb-4">
      <i class="fas fa-lock fa-lg me-3 fa-fw"></i>
      <div class="form-outline flex-fill mb-0">
        <input type="password" id="form3Example4c"  name="password" placeholder="password" class="form-control" />
        <input type="hidden" name="oldpassword"  value="<?=$row['hostpass']?>">
        <label class="form-label text-light" for="form3Example4c">Password</label>
      </div>
    </div>

  
  <div class="d-flex flex-row align-items-center mb-4">
      <i class="fas fa-map fa-lg me-3 fa-fw"></i>
      <div class="form-outline flex-fill mb-0">
      <input list="location"  name="location" id="form3Example4cd" class="form-control" value="<?=$row['location']?>" placeholder="if your location isn't listed type here" />
        <datalist id="location">
                          <option value="maadi">
                          <option value="zamalek">
                          <option value="5th settlement">
                          <option value="nasr city">
       </datalist>
        <label class="form-label text-light" for="form3Example4cd">Location</label>
      </div>
    </div>

    <div class="d-flex flex-row align-items-center mb-4">
      <i class="fas fa-calculator fa-lg me-3 fa-fw"></i>
      <div class="form-outline flex-fill mb-0">
        <input list="seats" class="form-control" value="<?=$row['all_seats']?>"  name="seats" id="formFileMultiple" placeholder="seats" type="number"> 
        <?php 
                          $list=1;
                          echo  '<datalist id="seats">';
                          while ($list<= 30){
                           echo '<option value="'. $list .'">';
                           $list++; }
                           echo '</datalist>'; ?>
      <label class="form-label text-light" for="form3Example4cd ">How many seats?</label>
      </div>
    </div>


    <div class="d-flex flex-row align-items-center mb-4">
      <i class="fas fa-file fa-lg me-3 fa-fw"></i>
      <div class="form-outline flex-fill mb-0">
          <div class="mb-3">
              <label for="formFileMultiple" class="form-label text-light">Upload an image of your internet café.</label>
              <input class="form-control" type="file" name="image" id="formFileMultiple" multiple>
              <span>choosen image= <?=$row['images']?> </span><br>
              <span style="color:red !important;">allowed file type is jpeg,png,jpg</span>                
            </div>
      </div>
    </div>

   <div class="d-flex justify-content-center mx-4 mb-3 mb-lg-4" >
      <button type="submit" name="update" style="margin:10px ;"class="btn btn-primary btn-lg">Edit</button>
        <a href='host_control.php'  style="margin:10px;  font-size: 20px;"class='btn btn-danger'> cancel </a> 
      </div>
    </div>
 </form>


<?php }
//if there is no such ID 
else{
  echo '<div class="container w-50">';
  echo   '<div class="row d-flex justify-content-center align-items-center error">';
  $redimsg=  '<div class="alert alert-info justify-content-center row" role="alert"> ID not valid </div>'; 
  redirection($redimsg,'host',2);
  echo   '</div>';
  echo   '</div>';
}}

              //update page
elseif($admin =='update'){
  if($_SERVER['REQUEST_METHOD'] =='POST'){
    $id       =      $_SESSION['hos_ID'];
    $hostuser =      $_POST['username'];
    $hostname =      $_POST['cname'];
    $seats =      $_POST['seats'];
    $email    =      $_POST['email'];
    $location =      $_POST['location'];
    $img_name=  $_FILES['image']['name'];
    $img_size=  $_FILES['image']['size'];
    $tmp_name=  $_FILES['image']['tmp_name'];
    $img_error= $_FILES['image']['error'];
    //password change
    $pass = empty($_POST['Password']) ? $pass = $_POST['oldpassword']: $pass = sha1($_POST ['Password']);
    

    //Validation 
    $formerror=array();
    if(empty($hostuser)){
        $formerror[]='>Host Username Cant be empty';
    }
    if(empty($hostname)){
        $formerror[]='Cybername Cant be Empty';
    }
    if(empty($email)){
        $formerror[]='Email Cant Be Empty';
    }else{
      $stmt= $con->prepare("SELECT email FROM internetcafe WHERE email = ? AND HostID != ?");
      $stmt->execute(array($email,$id));
      $count1=$stmt->rowCount();

      $stmt= $con->prepare("SELECT email FROM users WHERE email = ? AND ID != ?");
      $stmt->execute(array($email,$id));
      $count2=$stmt->rowCount();
      $count=$count1+$count2;
      if ($count>0){
        $formerror[]='Email already exsist';
      }
    }
    if(empty($location)){
        $formerror[]='Location Cant Be Empty';
    }

    if ($_FILES['image']['size']==0){
$new_name=$_SESSION['img_host'];
                }
                  elseif(!empty($_FILES['image'])){  
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
    foreach($formerror as $error){
      echo  '<div class="alert alert-danger justify-content-center row" role="alert">'.$error.' </div>'; 
    }
    echo   '</div>';
     echo   '</div>';}
            $stmt= $con->prepare("SELECT hostuser FROM internetcafe WHERE hostuser = ? AND HostID != ?");
            $stmt->execute(array($hostuser,$id));
            $count1=$stmt->rowCount();

            $stmt= $con->prepare("SELECT username FROM users WHERE username = ? AND ID != ?");
            $stmt->execute(array($hostuser,$id));
            $count2=$stmt->rowCount();
            $count=$count1+$count2;
    if ($count>0){
      echo '<div class="container w-50">';
      echo   '<div class="row d-flex justify-content-center align-items-center error">';
      $redimsg=  '<div class="alert alert-danger justify-content-center row" role="alert"> Username already exsist </div>'; 
      redirection($redimsg,'back',2);
    echo   '</div>';
     echo   '</div>';
    }else {
    //if there is no error update database
    if(empty($formerror)){
     $stmt = $con->prepare("UPDATE internetcafe SET hostuser = ?, cybername = ?, email = ?, location = ? ,all_seats = ? ,images = ? ,hostpass = ? WHERE HostID = ?");
     $stmt-> execute(array($hostuser,$hostname,$email,$location,$seats,$new_name,$pass,$id)); 
     if (!file_exists('../upload/'.$id.'/')){
     mkdir('../upload/'.$id.'/'); }
     //Put the image in the file
     $img_path ='../upload/'.$id.'/'.$new_name;
     move_uploaded_file($tmp_name,$img_path);
     
if($stmt->rowCount()>0){
     echo '<div class="container w-50">';
     echo   '<div class="row d-flex justify-content-center align-items-center error">';
     $redimsg=  '<div class="alert alert-success justify-content-center row" role="alert"> Host has been updated successfully </div>'; 
     redirection($redimsg,'host',2);
   echo   '</div>';
    echo   '</div>';
}else{
echo '<div class="container w-50">';
echo   '<div class="row d-flex justify-content-center align-items-center error">';
$redimsg=  '<div class="alert alert-warning justify-content-center row" role="alert"> nothing changed </div>'; 
redirection($redimsg,'host',2);
echo   '</div>';
 echo   '</div>';
}
   }
}
    }

 else{
  echo '<div class="container w-50">';
  echo   '<div class="row d-flex justify-content-center align-items-center error">';
  $redimsg=  '<div class="alert alert-warning justify-content-center row" role="alert">access denied</div>'; 
  redirection($redimsg,'host',2);
  echo   '</div>';
   echo   '</div>';
 }
}


// ****************************************************end edit page page********************************************************************



// ****************************************************delete page********************************************************************
   elseif($admin =='delete'){

 $usrID=isset($_GET['userid'])&& is_numeric($_GET['userid'])?intval($_GET['userid']):0;   //check that the id is numeric 
 //using check item function to select users
$check=checkitem('HostID','internetcafe',$usrID);
//  if check item greater than 0 then it will delete user 
if($check> 0 ){

                     // ============send email=========
$stmt =$con->prepare("SELECT email,cybername FROM internetcafe WHERE HostID=?"); 
$stmt->execute(array($usrID));
$data=$stmt->fetch();
$cybername=$data['cybername'];
$email=$data['email'];
include('delete-email.php'); 
                             // ============end send email=========
           
     $stmt =$con->prepare("DELETE FROM internetcafe WHERE HostID=?"); 
     $stmt->execute(array($usrID));
     $stmt->execute();

                               //success message
     echo '<div class="container w-50">';
     echo   '<div class="row d-flex justify-content-center align-items-center error">';
     $redimsg=  '<div class="alert alert-danger justify-content-center row" role="alert"> Host deleted </div>'; 
     redirection($redimsg,'host',2);
     echo   '</div>';
     echo   '</div>';
 }}

// ****************************************************activation page********************************************************************

 elseif($admin =='activate'){
  $usrID=isset($_GET['userid'])&& is_numeric($_GET['userid'])?intval($_GET['userid']):0;   //check that the id is numeric 
  //using check item function to select users
 $check=checkitem('HostID','internetcafe',$usrID);
//  if check item greater than 0 then it will delete user 
  if($check> 0 ){
      $stmt =$con->prepare("UPDATE internetcafe SET activated=1 WHERE HostID=?"); 
      $stmt->execute(array($usrID));
                  // ============send email=========
      $stmt =$con->prepare("SELECT email,cybername FROM internetcafe WHERE HostID=?"); 
      $stmt->execute(array($usrID));
      $data=$stmt->fetch();
      $cybername=$data['cybername'];
      $email=$data['email'];
      include('activation-email.php'); 
                  // ============end send email=========

                  //success message
      echo '<div class="container w-50">';
      echo   '<div class="row d-flex justify-content-center align-items-center error">';
      $redimsg=  '<div class="alert alert-info justify-content-center row" role="alert"> Host activated </div>'; 
      redirection($redimsg,'back',2);
      echo   '</div>';
      echo   '</div>';
   
  }

} 



    }
else{
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