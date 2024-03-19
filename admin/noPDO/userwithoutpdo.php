<?php
/*
////////////////////////////////////
///      Manage page            ///
/// [edit/delete/add/update]   ///
/////////////////////////////////
*/
session_start();
$pagetitle='EDIT';
include 'connect2.php';
include 'connect.php';
include 'init.php';
if (isset($_SESSION['admin'])){
    if (isset($_GET['admin'])){  $redirect= $_GET['admin'];}
     else{   $redirect='home';  }

     if($redirect =='edit'){
        $usrID=isset($_GET['userid'])&& is_numeric($_GET['userid'])?intval($_GET['userid']):0;   //check that the id is numeric 
       //select all data
      $stmt = $con->prepare("SELECT * FROM users WHERE ID=? ");       //prepare is used to clac before enter the site and reduced threats
    //execute query
      $stmt-> execute(array($usrID)); 
     $row= $stmt ->fetch();    //fetch data and store it in row
     $member = $stmt->rowCount();   //row count to check if there is user or no
//if there is id show edit form
     if($stmt->rowCount() > 0 ){ ?>
     <form action="?admin=update" method="POST">
         <input type="hidden" name="userid" value="<?php echo $usrID ?>"/>
     <!-- username input -->
     <div class="mb-3 col-md-4">
     <label for="exampleInputEmail1" class="form-label">Username </label>
     <input type="text" class="form-control" name="Username" aria-describedby="emailHelp" autocomplete="off" value="<?php echo $row['username']?>">
     </div>
     <!-- password input -->
     <div class="mb-3 col-md-4">
     <label for="exampleInputPassword1" class="form-label">Password</label>
     <input type="password" class="form-control" name="Password" autocomplete="off" >
     </div>
     <!-- email input -->
     <div class="mb-3 col-md-4">
     <label for="exampleInputEmail1" class="form-label">  Email</label>
     <input type="email" class="form-control" name="Email" aria-describedby="emailHelp"  autocomplete="off" value="<?php echo $row['email']?>"> 
     </div>"
     <!-- name input -->
     <div class="mb-3 col-md-4">
     <label for="exampleInputEmail1" class="form-label">Full  Name</label>
      <input type="text" class="form-control" name="Fullname" aria-describedby="emailHelp"  autocomplete="off" value="<?php echo $row['fullname']?>">
     </div>
      <!-- submit input -->
       <input type="submit" value="EDIT "class="btn btn-primary">
       </form>
    
   
   <?php }
   //if there is no such ID 
   else{
       echo "NO ID";
   }
                         }
   elseif($redirect =='update'){
      echo "<h1 class 'text-center'>update page</h1>";
      if($_SERVER['REQUEST_METHOD'] =='POST'){

        //get form data
      
    //   //update database
    //   $stmt = $con->prepare("UPDATE users SET username=?, fullname=?,email=? WHERE ID=? ");     
    //   //execute query
    //     $stmt-> execute(array($id , $name , $username , $email)); 
    //     //success message
    //     echo $stmt->rowCount() . ' updated ';
        $id =        $_POST['userid'];
        $username =  $_POST['Username'];
        $email =     $_POST['Email'];
        $name =      $_POST['Fullname'];
        $query = mysqli_query($conn, "UPDATE users SET username = '$username', fullname = '$name', email = '$email' WHERE ID = '$id'");
        if ($query) {
          mysqli_close($conn);
          echo "success";
        }
        else {
          echo mysqli_error();
        }

   }
   else{
       echo "unauthorized";
   }
}
   elseif($redirect =='delete'){
       echo 'delete';
   }
   elseif($redirect =='add'){
       echo 'update';
   }
   else {
       echo 'go out';
   }
    include  $tmp . 'footer.php'; 
}
else{
    header('location: include.php');
    exit();
}
?>