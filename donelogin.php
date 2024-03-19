<?php
session_start();
$pagetitle='Join';

include 'init.php';

// HTTP request not random request 
     if($_SERVER['REQUEST_METHOD']=='POST'){
     if(isset($_POST['login'])){
          $user=$_POST['user'];
          $pass=$_POST['pass'];
          $hashpw= sha1($pass);
        
     //check if the user is in database
     $stmt = $con->prepare("SELECT ID , username, PW , groupID FROM users WHERE username= ? AND PW=? ");       //prepare is used to clac before enter the site and reduced threats
     $stmt-> execute(array($user , $hashpw));
     $member = $stmt->rowCount();
     $group=$stmt->fetch();

     //if greater than 0 then he ia a member 
     if($member>0){
          $user_id=$group['ID'];
          //////IF HE IS ADMIN//////
          if($group['groupID']==1){
          $_SESSION['admin'] = $user; 
       
          header('location: admin/admin.php');   
          $_SESSION['id'] = $user_id;
          exit();}
             if($group['groupID']==0){
             //////IF HE IS ADMIN//////
             $_SESSION['user'] = $user; 
             header('location: home.php');   
             exit();  }}
             


     else {
     $stmt = $con->prepare("SELECT HostID,activated , hostuser, hostpass FROM internetcafe WHERE hostuser= ? AND hostpass=? "); 
     $stmt-> execute(array($user , $hashpw));
     $count = $stmt->rowCount();
     $cafedata=$stmt->fetch();
  
     if($count>0){
     $cafedata['activated'];
     //activated Host
               if($cafedata['activated']==1){
                 $_SESSION['host'] = $user; 
                 header('location: cyberhome.php');  
          exit();}
                           //not activated HOST
                         if($cafedata['activated']==0){
                         $_SESSION['host'] = $user; 
                         $redimsg= "<div class='alert alert-danger text-center'>  Account isn't activated yet! :( </div>"; 
                         redirection($redimsg ,'login', 3);
                         exit();  }}
     else {
          header('location:login.php'); 
     }}}
           //////// //sign up validations////////
            else{
           // if weird entries or scripts was entred will be filtred and check username more than 4
           $formerror = array();
         if (isset($_POST['username'])){
              $filteruser= filter_var($_POST['username'], FILTER_SANITIZE_STRING);
              if (strlen($filteruser)<4){
                   $formerror[]='username must be more than 4 chars';
              }
         }
         // validate password 
         if (isset($_POST['password']) && isset($_POST['password2']))
         
         {
          if (empty($_POST['password'])){
               $formerror[]='password cant be empty';  
          }  
          $pass1= sha1($_POST['password']) ;
          $pass2= sha1($_POST['password2']) ;
          if($pass1 !== $pass2){
               $formerror[]= 'password dosen\'t match';
          }
         }
          //  validate email
          if (isset($_POST['email'])){
               $filteremail= filter_var($_POST['email'], FILTER_SANITIZE_EMAIL);
               if (filter_var($filteremail,FILTER_VALIDATE_EMAIL)!= true ){
                    $formerror[]='enter a valid email';
               }
          }
     
          
      //if there is no error update database
      if(empty($formerror)){
            //Check That Username is Unique
            $check=checkitem("username","users",$_POST['username']);
            if($check>0){ 
                $formerror[]= '<div class="alert alert-danger text-center"> Username Already Exsist</div>'; 
            }
        else{
        //insert into  database
       $stmt = $con->prepare("INSERT INTO users (username,PW,fullname,email,age,date,activation)
       VALUES(:zuser,:zpass,:zfullname,:zemail,:zage,now(),0)");     
       //execute query
       $stmt-> execute(array(
       'zuser'=> $_POST['username'],
       'zpass'=> sha1($_POST['password']),
       'zfullname'=> $_POST['fullname'],
       'zemail'=> $_POST['email'],
       'zage'=> $_POST['age'])) ; 
       //success message
      $succes= '';
        
     }
    }
     
     }
     }
     
?>
<!-- login form -->
<form class = "login" action=" <?php echo$_SERVER ['PHP_SELF']?>"method="POST"> 
     <h4 class = "text-center">LOGIN</h4>
     <input class="form-control input-lg" type="text" name ="user" placeholder="Username" autocomplete="off"/>
     <input class="form-control input-lg" type="password" name ="pass" placeholder="Password" autocomplete="new-password"/>
     <input class="btn btn-primary" type= "submit" name="login" value="login"/>
     <a href="forgetpassword/forgotPassword.php">Forget Password</a>
    </div>
</form> 
 
<!-- end login form -->
<!-- start signup form -->
<form class = "signup" action=" <?php echo$_SERVER ['PHP_SELF']?>"method="POST"> 
     <h4 class = "text-center">SIGN UP</h4>
     <input class="form-control input-lg" type="text" name ="username" placeholder="Username" 
     autocomplete="off" pattern=".{3,10}" title="username must be betweeen 3 and 10 chars"/>        <!-- FORM  PATTERN  w title bytl3 error msg -->
     <input class="form-control input-lg" type="password" name ="password" placeholder="Password" autocomplete="new-password"/>
     <input class="form-control input-lg" type="password" name ="password2" placeholder="re enter pass" autocomplete="new-password"/>
     <input class="form-control input-lg" type="email" name ="email" placeholder="EMail"/>
     <input class="form-control input-lg" type="text" name ="age" placeholder="age"/>
     <input class="form-control input-lg" type="text" name ="fullname" placeholder="full name" />
     <input class="btn btn-success" type= "submit"  name="signup"value="Sign UP"/>
</form> 
<div class="text-center">
     <?php  
     if (!empty($formerror))
     {
          foreach($formerror as $error){
               echo $error . "<br>";
          }
     }
     if(isset($succes)){
          echo "<div class='alert alert-success text-center'>" . $succes . ' Registered Successfully </div>';
     }
     ?>
</div>
<!-- end signup form -->
<?php
include  $tmp . 'footer.php';    //footer included
?>