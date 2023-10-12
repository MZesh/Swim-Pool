<?php
error_reporting(0);
session_start();
//errors
 $usernameErr = $exists = $emailErr = $passErr = $cpassErr = $postCodeErr = $addressErr = $telErr = $dobErr="";
 $username = $surname = $password = $cpass = $password = $email = $postCode = $address = $tel = $dob="";
 include('../config/database.php');
  if ($_SERVER['REQUEST_METHOD'] == 'POST') 
 {
    //validation of fields

    if(empty($_POST['username']))
    {
        $usernameErr = "Username is Required";
    }
    else{
        $username = $_POST['username'];
        if(empty($_POST['surname']))
        {
            $usernameErr = "Surname is Required";
        }else{
            $surname = $_POST['surname'];
            if(empty($_POST['email']))
            {
                $emailErr = "Email is Required";
            }else{
                $email = $_POST['email'];
                if(empty($_POST['dob']))
                {
                    $dobErr = "DOB is Required";
                }
                else{
                    //$dob = $_POST['dob'];
                    
                    $date = date('Y');
                    $dob = strtotime($_POST['dob']);
                    $dob = date('Y',$dob);
                    
                    $diff = (int)$date-(int)$dob;
                    if($diff < 18){
                        $dobErr = "Your age should be 18 or above to get membership";
                    }else{
                        $dob = $_POST['dob'];
                        if(empty($_POST['postcode']))
                        {
                            $postCodeErr = "PostCode is Required";
                        }else{
                            $postCode = $_POST['postcode'];
                            if(empty($_POST['telephone']))
                            {
                                $telErr = "Telephone is Required";
                            }else{
                                $tel = $_POST['telephone'];
                                if(empty($_POST['address']))
                                {
                                    $addressErr = "Address is Required";
                                }else{
                                    $address = $_POST['address'];
                                    if(empty($_POST['password']))
                                    {
                                        $passErr = "Password is Required";
                                    }else{
                                        $password = $_POST['password'];
                                        $cpass = $_POST['cpassword'];
                                        if($password != $cpass)
                                        {
                                            $cpassErr = "Password and Confirm Password did not match";
                                        }else
                                        {
                                            //store data into database
                                            $check = checkforUserNameAndEmail($username,$email,$conn);
                                            if(!empty($check))
                                            {
                                                $exists .= $check;
                                            }
                                            else{
                                                $insertStmt = $conn->prepare("INSERT INTO users (username, surname, email,dob,telephone,postcode,address,password) VALUES (?, ?, ?,?, ?, ?,?,?)");
                                                if($insertStmt)
                                                {
                                                    mysqli_stmt_bind_param($insertStmt, "ssssssss", $username, $surname, $email,$dob,$tel,$postCode,$address,$password);
                                                    mysqli_stmt_execute($insertStmt);
                                        
                                                    $_SESSION["email"] = $email;
                                                    $_SESSION["username"] = $username;
                                                    $_SESSION['role'] = "user"; 
                                                    echo "Records inserted successfully.";
                                                }else{
                                                    echo "ERROR: Could not prepare query: ";
                                                }
                                            }
                                        } 
                                    }
                                }
                            }
                        }
                    }
                
                }
            }
    }  }
 }

 //`email`, `dob`, `telephone`, `postcode`, `address`, `password`

 //remove extra spaces
 function checkforUserNameAndEmail($username,$email,$conn) {
    $user = mysqli_query($conn, "SELECT * from users WHERE username = '$username'");
      if (mysqli_num_rows($user) > 0) {
         return "Username already taken..";
      }else{
        $useremail = mysqli_query($conn, "SELECT * from users WHERE email = '$email'");
        if (mysqli_num_rows($useremail) > 0) {
            return "Email already exits or taken..";
         }
      }
      
  }
?>
<?php 
include('../includes/header.php');
include('../includes/sub-header.php');
?>

<div class="container">
    <div class="row">
        <div class="col-sm-3"></div>
        <div class="col-sm-6">
            <div class="card mt-3 ">
                <div class="card-body ">
                <div class="card-header"><h4 class="text-info text-center">Swim Club Membership Form</h4></div>
                <?php if(!empty($exists)){echo '<span class="text-danger">'.$exists.'</span>';}?>
                <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="POST">
                        <div class="mb-3 mt-3">
                            <label for="username" class="form-label">Username:</label>
                            <input type="text" class="form-control" id="username" placeholder="Enter Username" name="username" value="<?php echo $username;?>">
                            <?php if(!empty($usernameErr)){echo '<span class="text-danger">'.$usernameErr.'</span>';}?>
                            
                        </div>
                        <div class="mb-3 mt-3">
                            <label for="surname" class="form-label">Surname:</label>
                            <input type="text" class="form-control" id="surname" placeholder="Enter Surname" name="surname" value="<?php echo $surname;?>">
                        </div>
                        
                        <div class="mb-3 mt-3">
                            <label for="email" class="form-label">Email:</label>
                            <input type="email" class="form-control" id="email" placeholder="Enter Email" name="email" value="<?php echo $email;?>">
                            <?php if(!empty($email)){echo '<span class="text-danger">'.$emailErr.'</span>';}?>
                        </div>
                        <div class="mb-3 mt-3">
                            <label for="dob" class="form-label">DOB:</label>
                            <input type="date" class="form-control" id="dob" max="<?php echo date("Y-m-d");?>" min="1990-12-31"  name="dob">
                            <?php if(!empty($dobErr)){echo '<span class="text-danger">'.$dobErr.'</span>';}?>
                        </div>
                        <div class="mb-3">
                            <label for="telephone" class="form-label">Telephone:</label>
                            <input type="text" class="form-control" id="telephone" placeholder="Enter telephone" name="telephone" value="<?php echo $tel;?>">
                            <?php if(!empty($telErr)){echo '<span class="text-danger">'.$telErr.'</span>';}?>
                            <label id="lblErrortel" class="form-label text-danger"></label>
                        </div>
                        <div class="mb-3">
                            <label for="postcode" class="form-label">Postcode:</label>
                            <input type="text" class="form-control" id="postcode" placeholder="Enter postcode" name="postcode" value="<?php echo $postCode;?>">
                            <?php if(!empty($postCodeErr)){echo '<span class="text-danger">'.$postCodeErr.'</span>';}?>
                            <label id="lblError" class="form-label text-danger"></label>
                        </div>
                        <div class="mb-3">
                            <label for="address">Address:</label>
                            <textarea class="form-control" rows="5" id="address" name="address"><?php echo $address;?></textarea>
                            <?php if(!empty($addressErr)){echo '<span class="text-danger">'.$addressErr.'</span>';}?>
                        </div>
                        <div class="mb-3 mt-3">
                            <label for="password" class="form-label">Password:</label>
                            <input type="password" class="form-control" id="password" placeholder="Enter password" name="password">
                            <?php if(!empty($passErr)){echo '<span class="text-danger">'.$passErr.'</span>';}?>
                            <?php if(!empty($cpassErr)){echo '<span class="text-danger">'.$cpassErr.'</span>';}?>
                        </div>
                        <div class="mb-3 mt-3">
                            <label for="cpassword" class="form-label">Confirm Password:</label>
                            <input type="password" class="form-control" id="cpassword" placeholder="Enter password again" name="cpassword">
                        </div>
                        <div class="d-grid">
                            <button type="submit" name="submit" class="btn btn-primary btn-block">Register</button>
                        </div>
                        
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<?php include('../includes/footer.php');?>

