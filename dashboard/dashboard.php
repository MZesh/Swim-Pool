<?php session_start(); 
if(!isset($_SESSION['email'])){  header("location:../pages/login.php");}
?>
<?php 
$page = "Dashboard";
include('include/header.php'); 
include('../config/database.php');
    $email = $_SESSION['email'];
    $result = mysqli_query($conn,"SELECT * FROM users WHERE email='$email'");
    $row = mysqli_fetch_assoc($result);            
    $date = date('Y');
    $dob = strtotime($row['dob']);
    $dob = date('Y',$dob);
    $role = $row['role'];
    
    $diff = (int)$date-(int)$dob;    
             
?>
 
<!-- Page Content -->
 

    <div class="w3-container w3-teal">
        <h1>Dashboard</h1>
        </div> 
    <div class="w3-container">
         
    </div>
    <div class="container">
    <div class="row my-3">
            <div class="col-md-1"></div>
                <div class="col-md-3">
                <div class="card text-center h-100">
                    <div class="card-block">
                        <h4 class="card-title">Profile </h4>
                        <h2><i class="fa fa-person fa-3x"></i></h2>
                    </div>
                    <hr class="hr" />
                    
                    <div class="row px-2 no-gutters">
                        <div class="col-6">
                         <?php if($diff >= 18){?>   <a href="/swim-club/dashboard/profile/profile.php" style="position:absolute;   bottom:10px;" class="btn btn-info "><i class="fa-solid fa-edit"></i></a><?php } ?>
                        </div>
                        <div class="col-6">
                            <a href="/swim-club/dashboard/profile/profile-view.php" style="position:absolute;  bottom:10px;" class="btn btn-warning"><i class="fa-solid fa-eye"></i></a>
                    
                        </div>
                    </div>
                </div>
            </div>
        <?php if($diff >= 18){
            if($role === 'admin'){
                include('pages/page-admin.php'); 
                include('pages/page-bottom.php');
            } else  if($role === 'coach'){
                include('pages/page-coach.php'); 
                include('pages/page-bottom.php');
            } 
                
           
        }
        else{
            echo "<h4 class='text-danger'>You are Not adult please contact admin to update profile or any assistant</h4>";
        }
        ?>
        
            
       
   </div>
</div>
<?php  include('include/footer.php'); ?>