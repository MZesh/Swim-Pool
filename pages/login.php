<?php
//error_reporting(0);
//errors
session_start();
 $emailErr = $passErr = "";
 $email = $password ="";
 include('../config/database.php');
 if (isset($_POST['submit'])) 
 {
    //validation of fields
    if(empty($_POST['email']))
    {
        $emailErr = "Email is Required";
    }else{
        $email = $_POST['email'];
    }

    
    if(empty($_POST['password']))
    {
        $passErr = "Password is Required";
    }else{
        $password = $_POST['password'];
        
    }  
    $loginquery = mysqli_query($conn, "SELECT * from users WHERE email='$email' and password='$password'");
    $row = mysqli_fetch_array($loginquery,MYSQLI_ASSOC); 
    $count = mysqli_num_rows($loginquery);
    
    if($count == 1) { 
        $_SESSION['email'] = $row['email'];
        $_SESSION['username'] = $row['username']; 
        $_SESSION['role'] = $row['role']; 
         
        header("location:../dashboard/dashboard.php");
     }else {
        echo  "Your Login Name or Password is invalid";
     }
    
 }

  
?>
<?php include('../includes/header.php');
include('../includes/sub-header.php');
?>
<div class="container">
    <div class="row">
        <div class="col-sm-3"></div>
        <div class="col-sm-6">
            <div class="card mt-3 ">
                <div class="card-body ">
                <div class="card-header"><h4 class="text-info text-center">Login Form</h4></div>
                 <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="POST">
                       
                        <div class="mb-3 mt-3">
                            <label for="email" class="form-label">Email:</label>
                            <input type="email" class="form-control" id="email" placeholder="Enter Email" name="email" value="<?php echo $email;?>">
                            <?php if(!empty($emailErr)){echo '<span class="text-danger">'.$emailErr.'</span>';}?>
                        </div>
                     
                        <div class="mb-3 mt-3">
                            <label for="password" class="form-label">Password:</label>
                            <input type="password" class="form-control" id="password" placeholder="Enter password" name="password">
                            <?php if(!empty($passErr)){echo '<span class="text-danger">'.$passErr.'</span>';}?>
                        </div>
                        
                        <div class="d-grid">
                            <button type="submit" name="submit" class="btn btn-primary btn-block">Login</button>
                        </div>
                        
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<?php include('../includes/footer.php');?>
  

