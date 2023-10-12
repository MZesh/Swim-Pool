<?php 
$page = "Training";
session_start(); include('../include/header.php'); 
 include('../../config/database.php');
$email = $distance = $sport = $position =$updateMsg="";
if(isset($_POST['submit']))
{
    $email = $_POST['email'];
    $distance = $_POST['distance'];
    $performance = $_POST['performance'];
    $health = $_POST['health'];
    $speed = $_POST['speed'];
 
    if(!empty($email) && !empty($distance) && !empty($performance) && !empty($health) && !empty($speed))
    {
        $insertStmt = $conn->prepare("INSERT INTO training (email,health,performance,speed,distance) VALUES (?,?,?,?,?)");
        if($insertStmt)
        {
            mysqli_stmt_bind_param($insertStmt, "sssss",  $email,$health,$performance,$speed,$distance);
            mysqli_stmt_execute($insertStmt);

            
            header("location:/swim-club/dashboard/training/training-view.php");
        }else{
            $updateMsg= "ERROR: Could not prepare query: ";
        }
      
    }else{
        $updateMsg= "ERROR: Please fill all the fields: ";
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
                <div class="card-header"><h4 class="text-info text-center">Training Record Panel</h4></div>
                 <?php if(!empty($updateMsg)){ echo '<div class="card-header"><h5 class="text-danger text-center">'.$updateMsg.' </h5></div>'; }?>
                <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="POST">
                         <div class="mb-3 mt-3">
                         <label for="email" class="form-label">Email:</label>
                            <input type="email" class="form-control" id="email" placeholder="Enter Email" name="email">
                            
                         </div>
                         <div class="mb-3">
                            <label for="health" class="form-label">Health Condidition (in %):</label>
                            <input type="text" class="form-control" id="health" placeholder="Enter health" name="health">
                                 
                        </div>
                        <div class="mb-3">
                            <label for="performance" class="form-label">Performance:</label>
                            <input type="text" class="form-control" id="performance" placeholder="Enter performance" name="performance">
                                 
                        </div>
                         
                        <div class="mb-3 mt-3">
                            <label for="speed" class="form-label">Speed</label>
                            <input type="text" class="form-control" id="speed" placeholder="Enter Speed" value="" name="speed">
                        </div>

                        <div class="mb-3 mt-3">
                            <label for="distance" class="form-label">Distance (in meter)</label>
                            <input type="text" class="form-control" id="distance" placeholder="Enter distance" value="" name="distance">
                        </div>
                         
                        <div class="d-grid">
                            <button type="submit" name="submit" class="btn btn-primary btn-block">Add Training Record</button>
                        </div>
                        
                    </form>
                </div>
            </div>
        </div>
    </div>
<?php  include('../include/footer.php'); ?>