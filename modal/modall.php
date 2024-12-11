
<!-- Modal -->
<div class="modal fade" id="userModal_<?php echo $row[0];?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
<div class="modal-dialog">
    <div class="modal-content">
    <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
    </div>
    <div class="modal-body">
                                        <form action="user list.php" method="POST" enctype="multipart/form-data">
                                    <div class="row">
                                        <div class="col-sm-6 form-group">
                                            <label>ID</label>
                                            <input class="form-control" name="id" readonly type="text" value="<?php echo $row[0];?>" placeholder="ID">
                                        </div>

                                        <div class="col-sm-6 form-group">
                                            <label>First Name</label>
                                            <input class="form-control" name="fname" required="" type="text" placeholder="Full Name">
                                        </div>                                        

                                        <div class="col-sm-6 form-group">
                                            <label>User Name</label>
                                            <input class="form-control" name="uname" required="" type="text" placeholder="User Name">
                                        </div>

                                        <div class="col-sm-12 form-group">
                                            <label>Password</label>
                                            <input class="form-control" name="pass" required="" type="password" placeholder="Enter Password">
                                        </div>    

                                        <div class="col-sm-12 form-group">
                                            <label>Image</label>
                                            <input class="form-control" name="image" required="" type="file" placeholder="Enter Image">
                                        </div>                                         

                                        <div class="col-sm-12 form-group">
                                            <label>Tell</label>
                                            <input class="form-control" name="tell" required="" type="text" placeholder="Enter Tell">
                                        </div>

                                        
                                        

                                        

                                        
                                        <div class="col-sm-12 form-group">
                                            <label>Date</label>
                                            <input class="form-control" name="date" required="" type="date" value="<?php echo date("Y-m-d"); ?>" readonly  placeholder="First Name">
                                        </div>

                                    <div class="title-footer">
                                        <button class="btn btn-primary "  name="btn" type="submit"><i class="bi bi-check-circle-fill me-2"></i>Register</button>
                                    </div>

                                    </div>
                                    
                                    
                                    
                                </form>
    </div>
    
    </div>
</div>
</div>





