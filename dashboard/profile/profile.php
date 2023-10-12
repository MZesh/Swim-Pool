<?php
session_start(); 
if(!isset($_SESSION['email'])){  header("location:../pages/login.php");} 
error_reporting(0); 
//errors
 $updateMsg ="";
 $username = $surname = $password = $cpass = $password = $email = $postCode = $address = $tel = $dob="";
 include('../config/database.php');

 //fetch user details
   //fetch data
   $email = $_SESSION['email'];
   $username = $_SESSION['username'];
   $user = mysqli_query($conn, "SELECT * from users WHERE username = '$username' AND email = '$email'");
   if (mysqli_num_rows($user) > 0) {
    while($row = mysqli_fetch_assoc($user)) {
        $dob = $row['dob'];
        $postCode = $row['postcode'];
        $address = $row['address'];
        $tel = $row['telephone'];
        $surname = $row['surname']; 
        $password = $row['password']; 
    }
   }

  
 if (isset($_POST['submit'])) 
 {
    $surname = $_POST['surname'];
    $dob = $_POST['dob'];
    $tel = $_POST['telephone'];
    $postCode = $_POST['postcode'];
    $address = $_POST['address'];
    $password = $_POST['password'];
      //update data into database
      $updateStmt = "UPDATE users SET  surname='$surname',dob='$dob',telephone='$tel',postcode='$postCode',address='$address',password='$password'  WHERE  email='$email' AND username='$username'";
      if (mysqli_query($conn, $updateStmt)) {
        $updateMsg = "Records updated successfully.";
        echo $mysqli->error;
      } else {
        $updateMsg = "ERROR: Could not prepare query: ";
      }
       
 }

?>
<?php  
$page = "User Profile";
include('include/header.php'); ?>
<div >

    <div class="w3-container w3-teal">
        <h3>Profile Page</h3>
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
                    <div class="card-header"><h4 class="text-info text-center">User Profile</h4></div>
                    <?php if(!empty($updateMsg)){ echo '<div class="card-header"><h5 class="text-success text-center">'.$updateMsg.' </h5></div>'; }?>
                    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="POST">
                            <div class="mb-3 mt-3">
                                <label for="username" class="form-label">Username:</label>
                                <input type="text" readonly class="form-control" id="username" placeholder="Enter Username" name="username" value="<?php echo $username;?>">
                                    
                            </div>
                            <div class="mb-3 mt-3">
                                <label for="surname" class="form-label">Surname:</label>
                                <input type="text" class="form-control" id="surname" placeholder="Enter Surname" name="surname" value="<?php echo $surname;?>">
                            </div>
                            
                            <div class="mb-3 mt-3">
                                <label for="email" class="form-label">Email:</label>
                                <input type="email" readonly class="form-control" id="email" placeholder="Enter Email" name="email" value="<?php echo $email;?>">
                                </div>
                            <div class="mb-3 mt-3">
                                <label for="dob" class="form-label">DOB:</label>
                                <input type="date" class="form-control" id="dob" value="<?php echo $dob;?>" name="dob">
                                </div>
                            <div class="mb-3">
                                <label for="telephone" class="form-label">Telephone:</label>
                                <input type="text" class="form-control" id="telephone" placeholder="Enter telephone" name="telephone" value="<?php echo $tel;?>">
                                <label id="lblErrortel" class="form-label text-danger"></label>
                            </div>
                            <div class="mb-3">
                                <label for="postcode" class="form-label">Postcode:</label>
                                <input type="text" class="form-control" id="postcode" placeholder="Enter postcode" name="postcode" value="<?php echo $postCode;?>">
                                    <label id="lblError" class="form-label text-danger"></label>
                            </div>
                            <div class="mb-3">
                                <label for="address">Address:</label>
                                <textarea class="form-control" rows="5" id="address" name="address"><?php echo $address;?></textarea>
                                </div>
                            <div class="mb-3 mt-3">
                                <label for="password" class="form-label">Password:</label>
                                <input type="password" class="form-control" id="password" placeholder="Enter password" value="" name="password">
                                <?php if(!empty($passErr)){echo '<span class="text-danger">'.$passErr.'</span>';}?>
                                <?php if(!empty($cpassErr)){echo '<span class="text-danger">'.$cpassErr.'</span>';}?>
                            </div>
                            
                            <div class="d-grid">
                                <button type="submit" name="submit" class="btn btn-primary btn-block">Update</button>
                            </div>
                            
                        </form>
                    </div>
                </div>
            </div>
        </div>
</div>

</div>

<?php  include('include/footer.php'); ?>