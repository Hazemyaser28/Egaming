<?php
session_start();  
session_unset();    //unset usernaem anf password
session_destroy();   // destory session
header('location:login.php');     //redirect to login screen
exit();
?>