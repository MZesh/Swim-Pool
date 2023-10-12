<?php 
$page = "Swim Report";
session_start(); include('../include/header.php');
include('../../config/database.php');
?>
<div class="w3-container w3-teal">
        <h3>Record View</h3>
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
        <div class="col-sm-1"></div>
        <div class="col-sm-10">
            <div class="card mt-3 ">
                <div class="card-body ">
                <div class="card-header"><h4 class="text-info text-center">Sport Gala Report </h4>
                   
                
                <table class="table">
                   
                    <tbody id="myTable">
                    <?php
                            $email = $_GET['user_email'];
                            $result = mysqli_query($conn,"SELECT users.username,users.email,swim_record.distance,swim_record.time
                            FROM users INNER JOIN swim_record ON users.email=swim_record.email WHERE users.email='$email'");
                            $i = 0;
                            while ($row = mysqli_fetch_assoc($result)) 
                            {
                                
                            ?>
                            <tr> 
                                <td>Username: <?php echo $row['username'];?></td>
                                <td>Email: <?php echo $row['email'];?></td> 
                            </tr>  
                            <tr> 
                                <td>Time: <?php echo $row['time'];?></td>
                                <td>Distance: <?php echo $row['distance'];?></td>
                                
                            </tr>
                             
                        <?php } ?>
                    </tbody>
                 </table> 
                </div>
            </div>
        </div>
    </div>

   
<?php  include('../include/footer.php'); ?>