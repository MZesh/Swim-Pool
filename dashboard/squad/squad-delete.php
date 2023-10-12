<?php session_start(); 
include('../../config/database.php');

if(isset($_GET['user_email']))
   {
        $email = $_GET['user_email']; 
        $deleteStmt = "DELETE FROM squad WHERE  email='$email'";
        if (mysqli_query($conn, $deleteStmt)) {
           header("location:/swim-club/dashboard/squad/squad-view.php");
        } else {
         echo "ERROR: Could not prepare query: ";
        } 
   }
?>