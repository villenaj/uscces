<?php 
 
 if (session_status() !== PHP_SESSION_ACTIVE) {
    session_start();
  }
 $user_id = &$_SESSION['user_id']; //retrieve the session variable
 include("index.php");
 echo "<center>You have successfully Logged Out</center>";
 unset($_SESSION['user_id']); //to remove session variable
 session_destroy(); //destroy the session
 
 exit();

 if(!isset($_SESSION['user_id'])) //If user is not logged in then he cannot access the profile page
 {
 //echo 'You are not logged in. <a href="login.php">Click here</a> to log in.';
 header("location:index.php");
 }
         
?>