<?php 
$page = "Squad Data Update";
session_start(); include('../include/header.php'); 
 include('../../config/database.php');
$email = $category = $updateemail = $comment = $updateMsg=""; 
    if(isset($_POST['submit']))
    {  
       
        $updateemail = $_POST['emailvalue'];
         
        $category = $_POST['category'];
        $comment = $_POST['comment'];
        $updateStmt = "UPDATE squad SET  category='$category',comment='$comment' WHERE  email='$updateemail'";
        if (mysqli_query($conn, $updateStmt)) {
            header("location:/swim-club/dashboard/squad/squad-view.php");
        } else {
        $updateMsg = "ERROR: Could not prepare query: ";
        } 
    }

if(isset($_GET['user_email']))
{
    $email = $_GET['user_email'];
    $result = mysqli_query($conn, "SELECT * from squad WHERE email = '$email'");
    while ($row = mysqli_fetch_assoc($result)) {
        $category = $row['category'];
        $comment = $row['comment']; 
        $updateemail = $row['email'];
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
                            <input type="hidden" name="emailvalue" value="<?php echo $email?>">
                         </div>
                         <div class="mb-3 mt-3">
                            <label for="category" class="form-label">Category:</label>
                                <select class="form-select" name="category" aria-label="Default select example">
                                    
                                    <option value="bronze" <?php if($category ==="bronze"){echo "selected";}?>> Bronze</option>
                                    <option value="silver" <?php if($category ==="silver"){echo "selected";}?> > Silver</option> 
                                    <option value="gold" <?php if($category ==="gold"){echo "selected";}?>>Gold</option> 
                                     
                                </select>
                         </div>
                        
                         
                         <div class="mb-3">
                            <label for="comment" class="form-label">Comment:</label>
                            <textarea  class="form-control" id="comment"  name="comment"><?php echo $comment;?></textarea>
                                 
                        </div> 
                         
                         
                        <div class="d-grid">
                            <button type="submit" name="submit" class="btn btn-primary btn-block">Update Training Record</button>
                        </div>
                        
                    </form>

               
                </div>
            </div>
        </div>
    </div>
<?php  include('../include/footer.php'); ?>