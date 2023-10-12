<?php session_start(); 
include('../../config/database.php');

if(isset($_GET['user_email']))
   {
        $email = $_GET['user_email']; 
        $deleteStmt = "DELETE FROM training WHERE  email='$email'";
        if (mysqli_query($conn, $deleteStmt)) {
           header("location:/swim-club/dashboard/training/training-view.php");
        } else {
         echo "ERROR: Could not prepare query: ";
        } 
   }
?>