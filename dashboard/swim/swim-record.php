<?php 
$page = "Swim Record Add";
session_start(); include('../include/header.php'); 
 include('../../config/database.php');
$email = $distance = $time = $updateMsg="";
if(isset($_POST['submit']))
{
    $email = $_POST['email'];
    $distance = $_POST['distance'];
    $time = $_POST['time'];

    $check = checkforUserNameAndEmail($email,$conn);
    if(!empty($check))
    {
        $updateMsg .= $check;
    }
    else{  

        $insertStmt = $conn->prepare("INSERT INTO swim_record (email, distance, time) VALUES (?, ?, ?)");
        if($insertStmt)
        {
            mysqli_stmt_bind_param($insertStmt, "sss",  $email,$distance,$time);
            mysqli_stmt_execute($insertStmt);

            
            $updateMsg= "Records inserted successfully.";
        }else{
            $updateMsg= "ERROR: Could not prepare query: ";
        }
    } 
            
         
      
}
function checkforUserNameAndEmail($email,$conn) { 
    $useremail = mysqli_query($conn, "SELECT * from swim_record WHERE email = '$email'");
    if (mysqli_num_rows($useremail) > 0) {
        return "Email already exits you can update the record..";
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
                <div class="card-header"><h4 class="text-info text-center">Swim Record Panel</h4></div>
                 <?php if(!empty($updateMsg)){ echo '<div class="card-header"><h5 class="text-success text-center">'.$updateMsg.' </h5></div>'; }?>
                <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="POST">
                         <div class="mb-3 mt-3">
                         <label for="email" class="form-label">Email:</label>
                            <input type="email" class="form-control" id="email" placeholder="Enter Email" name="email">
                            
                         </div>
                        <div class="mb-3">
                            <label for="distance" class="form-label">Total Distance (in meter):</label>
                            <input type="text" class="form-control" id="distance" placeholder="Enter Distance" name="distance">
                                 
                        </div>
                         
                        <div class="mb-3 mt-3">
                            <label for="time" class="form-label">Time Taken(min.sec):</label>
                            <input type="text" class="form-control" id="time" placeholder="Enter Time Taken" value="" name="time">
                        </div>
                         
                        <div class="d-grid">
                            <button type="submit" name="submit" class="btn btn-primary btn-block">Add Swim Record</button>
                        </div>
                        
                    </form>
                </div>
            </div>
        </div>
    </div>
<?php  include('../include/footer.php'); ?>