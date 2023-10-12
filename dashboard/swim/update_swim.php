<?php
 include('../../config/database.php');
 $email = $distance = $updateemail = $time = $updateMsg=""; 
 if(isset($_POST['submit']))
 {  
     $email = $_POST['email']; 
     $distance_update = $_POST['distance'];
     $time_update = $_POST['time'];
     $updateStmt = "UPDATE swim_record SET  distance='$distance_update',time='$time_update' WHERE  email='$email'";
     if (mysqli_query($conn, $updateStmt)) {
        header("location:/swim-club/dashboard/swim/swim-record-view.php");
     } else {
       $updateMsg = "ERROR: Could not prepare query: ";
     } 
 }
?>