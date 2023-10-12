<?php 
$page = "Sport Gala Update";
session_start(); include('../include/header.php'); 
 include('../../config/database.php');
$email = $distance = $updateemail = $sport = $position = $updateMsg=""; 
    if(isset($_POST['submit']))
    {  
       
        $updateemail = $_POST['emailvalue'];
         
        $distance_update = $_POST['distance'];
        $sport = $_POST['sport'];
        $position = $_POST['position'];
        $updateStmt = "UPDATE gala_record SET  distance='$distance_update',position='$position',sport='$sport' WHERE  email='$updateemail'";
        if (mysqli_query($conn, $updateStmt)) {
            header("location:/swim-club/dashboard/gala/gala-view.php");
        } else {
        $updateMsg = "ERROR: Could not prepare query: ";
        } 
    }

if(isset($_GET['user_email']))
{
    $email = $_GET['user_email'];
    $result = mysqli_query($conn, "SELECT * from gala_record WHERE email = '$email'");
    while ($row = mysqli_fetch_assoc($result)) {
        $distance = $row['distance'];
        $sport = $row['sport']; 
        $updateemail = $row['email'];
        $position = $row['position'];
    }
  
} 

?>
<div class="w3-container w3-teal">
        <h3>Record Update</h3>
        <a href="/swim-club/dashboard/dashboard.php" class="btn btn-success" style="position:absolute; top:8px;left:200px;">Dashboard</a> 
        <div class="w3-dropdown-hover d-grid" style="position:absolute; top:8px; right:20px;">
            <button class="btn btn-info">Welcome <?php echo $_SESSION['username'];?> <i class="fa fa-caret-down"></i></button>
            <div class="w3-dropdown-content w3-bar-block w3-card-4">
                <a href="/swim-club/pages/logout.php" class="w3-bar-item w3-button">Lougout</a> 
            </div>
        </div>
    </div> 
    <div class="container">
    <div class="row">
        <div class="col-sm-2"></div>
        <div class="col-sm-8">
            <div class="card mt-3 ">
                <div class="card-body ">
                <div class="card-header"><h4 class="text-info text-center">Sport Gala Record Update Panel</h4></div>
                 <?php if(!empty($updateMsg)){ echo '<div class="card-header"><h5 class="text-success text-center">'.$updateMsg.' </h5></div>'; }?>
                <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="POST">
                        <div class="mb-3 mt-3">
                         <label for="email" class="form-label">Email:</label>
                            <input type="email" readonly class="form-control" id="email" placeholder="Enter Email" value="<?php echo $email;?>" name="email">
                            <input type="hidden" name="emailvalue" value="<?php echo $updateemail; ?>" />
                         </div>
                        <div class="mb-3">
                            <label for="distance" class="form-label">Total Distance (in meter):</label>
                            <input type="text" class="form-control" id="distance" placeholder="Enter Distance" value="<?php echo $distance;?>" name="distance">
                                 
                        </div>
                         
                        <div class="mb-3 mt-3">
                            <label for="sport" class="form-label">Sport Name</label>
                            <input type="text" class="form-control" id="sport" placeholder="Enter Sport" value="<?php echo $sport;?>" name="sport">
                        </div>
                        <div class="mb-3 mt-3">
                            <label for="position" class="form-label">Position</label>
                            <input type="text" class="form-control" id="position" placeholder="Enter position" value="<?php echo $position;?>" name="position">
                        </div>
                        <div class="d-grid">
                            <button type="submit" name="submit" class="btn btn-primary btn-block">Update Gala Record</button>
                        </div>
                        
                    </form>
                </div>
            </div>
        </div>
    </div>
<?php  include('../include/footer.php'); ?>