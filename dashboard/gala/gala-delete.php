<?php session_start(); 
include('../../config/database.php');

if(isset($_GET['user_email']))
   {
        $email = $_GET['user_email']; 
        $deleteStmt = "DELETE FROM users WHERE  email='$email'";
        if (mysqli_query($conn, $deleteStmt)) {
           header("location:/swim-club/dashboard/gala/gala-view.php");
        } else {
         echo "ERROR: Could not prepare query: ";
        } 
   }
?>