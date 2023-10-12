<?php
$page = "Squad View";
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
                <div class="card-header"><h4 class="text-info text-center">Squad Records <a href="/swim-club/dashboard/squad/squad-add.php"  class="btn btn-info mb-1 <?php $role = $_SESSION['role']; if($role === 'user'){echo "disabled";}else{echo "";}?>" style="float:right;"><i class="fa-solid fa-plus"></i></a> </h4>
                <form>
                    <div class="input-group">
                        <input type="text" id="myInput" class="form-control" placeholder="Search">
                        <div class="input-group-btn">
                        <button class="btn btn-default" type="submit">
                            <i class="glyphicon glyphicon-search"></i>
                        </button>
                        </div>
                    </div>
                    </form>
                </div>
                <table class="table">
                    <thead>
                        
                        <tr>
                        <th scope="col">S/NO</th>
                        <th scope="col">Username</th>
                        <th scope="col">Email</th>
                        <th scope="col">Category</th>
                        <th scope="col">Comments</th> 
                        <th scope="col">Action</th>
                        </tr>
                    </thead>
                    <tbody id="myTable">
                    <?php
                            $result = mysqli_query($conn,"SELECT users.username,users.email,squad.category,squad.comment
                            FROM users INNER JOIN squad ON users.email=squad.email ");
                            $i = 0;
                            while ($row = mysqli_fetch_assoc($result)) 
                            {
                                $i++;
                        ?>
                        <tr>
                            <td scope="row"><?php echo $i;?></td>
                            <td><?php echo $row['username'];?></td>
                            <td><?php echo $row['email'];?></td>
                            <td><?php echo $row['category'];?></td>
                            <td><?php echo $row['comment'];?></td> 
                            <td><a href="/swim-club/dashboard/squad/squad-update.php?user_email=<?php echo $row['email'];?>"  class="btn btn-success "><i class="fa-solid fa-edit"></i></a></td>
                            <td><a href="/swim-club/dashboard/squad/squad-delete.php?user_email=<?php echo $row['email'];?>"  class="btn btn-danger "><i class="fa-solid fa-trash"></i></a></td>
                         </tr>  
                        <?php } ?>
                    </tbody>
                 </table> 
                </div>
            </div>
        </div>
    </div>

   
<?php  include('../include/footer.php'); ?>