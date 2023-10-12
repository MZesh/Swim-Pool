           
            <div class="col-md-3">
                <div class="card text-center h-100">
                    <div class="card-block">
                        <h4 class="card-title">Swin Record </h4>
                        <h2><i class="fa-solid fa-record-vinyl fa-3x"></i></h2>
                    </div>
                    <div class="row px-2 no-gutters">
                        <div class="col-6">
                            <a href="/swim-club/dashboard/swim/swim-record.php" style="position:absolute;   bottom:10px;" class="btn btn-info <?php $role = $_SESSION['role']; if($role === 'user'){echo "disabled";}else{echo "";}?>"><i class="fa-solid fa-plus"></i></a>
                        </div>
                        <div class="col-6">
                            <a href="/swim-club/dashboard/swim/swim-record-view.php" style="position:absolute;  bottom:10px;" class="btn btn-warning"><i class="fa-solid fa-eye"></i></a>
                    
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card text-center h-100">
                    <div class="card-block">
                        <h4 class="card-title">Gala Record</h4>
                        <h2><i class="fa fa-trophy fa-3x"></i></h2>
                    </div>
                    <div class="row px-2 no-gutters">
                        <div class="col-6">
                        <a href="/swim-club/dashboard/gala/gala-add.php" style="position:absolute;   bottom:10px;" class="btn btn-info <?php $role = $_SESSION['role']; if($role === 'user'){echo "disabled";}else{echo "";}?>"><i class="fa-solid fa-plus"></i></a>
                    </div>
                        <div class="col-6">
                        <a href="/swim-club/dashboard/gala/gala-view.php" style="position:absolute;  bottom:10px;" class="btn btn-warning"><i class="fa-solid fa-eye"></i></a>
                    
                        </div>
                     
                    </div>
                </div>
            </div>
        </div>
        <div class="row my-3">
            <div class="col-md-1"></div>
                <div class="col-md-3">
                    <div class="card text-center h-100">
                            <div class="card-block">
                                <h4 class="card-title">Users</h4>
                                <h2><i class="fa fa-user fa-3x"></i></h2>
                            </div>
                            <hr class="hr" />
                            <div class="row px-2 no-gutters">
                                <a href="/swim-club/dashboard/users/users-view.php" class="btn btn-warning">View Users</a>
                            </div>
                    </div>
            </div>
            <div class="col-md-3">
                    <div class="card text-center h-100">
                            <div class="card-block">
                                <h4 class="card-title">Training</h4>
                                <h2><i class="fa-solid fa-person-swimming fa-3x"></i></h2>
                            </div>
                            <hr class="hr" />
                            <div class="row px-2 no-gutters">
                                <a href="/swim-club/dashboard/training/training-view.php" class="btn btn-warning">Go to Training</a>
                            </div>
                    </div>
            </div>
            <div class="col-md-3">
                    <div class="card text-center h-100">
                            <div class="card-block">
                                <h4 class="card-title">Squad</h4>
                                <h2><i class="fa-solid fa-people-line fa-3x" ></i></h2>
                            </div>
                            <hr class="hr" />
                            <div class="row px-2 no-gutters">
                                <a href="/swim-club/dashboard/squad/squad-view.php" class="btn btn-warning">View Squad</a>
                            </div>
                    </div>
            </div>
             
        </div>
         