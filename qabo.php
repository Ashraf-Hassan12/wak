<?php

require "conn.php";

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width initial-scale=1.0">
    <title>Admincast bootstrap 4 &amp; angular 5 admin template, Шаблон админки | Dashboard</title>
    <!-- GLOBAL MAINLY STYLES-->
    <link href="./assets/vendors/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet" />
    <link href="./assets/vendors/font-awesome/css/font-awesome.min.css" rel="stylesheet" />
    <link href="./assets/vendors/themify-icons/css/themify-icons.css" rel="stylesheet" />
    <!-- PLUGINS STYLES-->
    <link href="./assets/vendors/jvectormap/jquery-jvectormap-2.0.3.css" rel="stylesheet" />
    <!-- THEME STYLES-->
    <link href="assets/css/main.min.css" rel="stylesheet" />
    <!-- PAGE LEVEL STYLES-->

    
    <script src="assets/jquery.min.js"></script>
    <script>
        $(function(){
        $('#dropdown').on('change',function(){

        var id = $(this).val();
        $.post('get_cust_balance.php',{id:$(this).val()},function(res){
        var res1 = res.split(",");

        $("#cbalanc").val($.trim(res1[0]));
        
        
        });

        });
     });

    </script>
</head>

<body class="fixed-navbar">
    <div class="page-wrapper">
        <!-- START HEADER-->
        <?php require "tools/header.php" ?>
        <!-- END HEADER-->
        <!-- START SIDEBAR-->
        <?php require "tools/sidebar.php" ?>
        <!-- END SIDEBAR-->
        <div class="content-wrapper">
            <!-- START PAGE CONTENT-->
            <div class="page-content fade-in-up">
                
            <div class="row">

            <div class="col-2"></div>
            <div class="col-8">
                
                        <div class="ibox">
                            <div class="ibox-head">
                                <div class="ibox-title">Receipt</div>
                                <div class="ibox-tools">
                                    <a class="ibox-collapse"><i class="fa fa-minus"></i></a>
                                    
                                    
                                </div>
                            </div>
                            <div class="ibox-body">
                                <form action="" method="post">
                                    <div class="row">

                                        


                                        <div class="col-sm-6 form-group">
                                            <label>Customer Name</label>

                                            <select  name="cname" class="form-control" id="dropdown" required id="">

                                                <option selected disabled value="Select Sex">Select Customer</option>
                                                <?php 
                                                    $ress = mysqli_query($conn,"SELECT id,name  from customers");
                                                    while($row = mysqli_fetch_array($ress)){
                                                        echo "<option value=' $row[id]'>$row[name]</option>";
                                                    }
                                                    ?>                                            
                                            
                                            </select>                                            

                                        </div>

                                        <div class="col-sm-6 form-group">
                                            <label>Current Balance</label>
                                            <input class="form-control" id="cbalanc" required="" name="cbalance" type="text" readonly placeholder="Enter Current Balance">
                                        </div>


                                        <div class="col-sm-6 form-group">
                                            <label>Paid</label>
                                            <input class="form-control" id="paid" required="" onkeyup="subt()" name="paid" type="text" placeholder="Enter Paid">
                                        </div>

                                        <div class="col-sm-6 form-group">
                                            <label>Remained</label>
                                            <input class="form-control" required="" onkeyup="mult()" id="remained" name="remained" readonly type="text" placeholder="Enter Remained">
                                        </div>

                                        <div class="col-sm-6 form-group">
                                            <label>Discount</label>
                                            <input class="form-control" required="" onkeyup="subt2()" id="disc" name="discount" type="text" placeholder="Enter Discount">
                                        </div>

                                        <div class="col-sm-6 form-group">
                                            <label>New Balance</label>
                                            <input class="form-control" required="" id="nbalan" name="nbalance" type="text" readonly placeholder="Enter New Balance">
                                        </div>

                                        
                                        
                                        <div class="col-sm-12 form-group">
                                            <label>Date</label>
                                            <input class="form-control" required="" name="date" type="date" value="<?php echo date("Y-m-d"); ?>" placeholder="First Name">
                                        </div>
                                    </div>
                                    
                                    
                                    <div class="form-group">
                                        <button class="btn btn-primary btn-block" name="btn" type="submit">Submit</button>
                                    </div>
                                </form>
<?php
if (isset($_POST['btn'])) {
    $cname = $_POST['cname'];
    $cblance = $_POST['cbalance'];
    $paid = $_POST['paid'];
    $rem = $_POST['remained'];
    $dis = $_POST['discount'];
    $nbalan = $_POST['nbalance'];
    $date = $_POST['date'];

    // Assuming $conn is your connection variable
    $conn = new mysqli("localhost", "root", "", "gurhan");

    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Prepare the SQL statement
    $stmt = $conn->prepare("INSERT INTO tuur (cust_id, current_balance, paid, remained, discount, new_balance, regdate) VALUES (?, ?, ?, ?, ?, ?, ?)");
    
    // Bind the parameters to the SQL query
    $stmt->bind_param("sddddds", $cname, $cblance, $paid, $rem, $dis, $nbalan, $date);

    // Execute the statement
    if ($stmt->execute()) {
        echo "<button class='btn btn-success btn-block'>Insert Success</button>";
    } else {
        echo "Error: " . $stmt->error;
    }

    // Close the statement and connection
    $stmt->close();
    $conn->close();
}
?>


                            </div>
                        </div>
                    
            
                <style>
                    .visitors-table tbody tr td:last-child {
                        display: flex;
                        align-items: center;
                    }

                    .visitors-table .progress {
                        flex: 1;
                    }

                    .visitors-table .progress-parcent {
                        text-align: right;
                        margin-left: 10px;
                    }
                </style>
                
            </div>
            </div>
            <div class="col-2"></div>
            
            </div>
            
            <!-- END PAGE CONTENT-->
            <footer class="page-footer">
                <div class="font-13">2018 © <b>AdminCAST</b> - All rights reserved.</div>
                <a class="px-4" href="http://themeforest.net/item/adminca-responsive-bootstrap-4-3-angular-4-admin-dashboard-template/20912589" target="_blank">BUY PREMIUM</a>
                <div class="to-top"><i class="fa fa-angle-double-up"></i></div>
            </footer>
        </div>
    </div>
    <!-- BEGIN THEME CONFIG PANEL-->
    <div class="theme-config">
        <div class="theme-config-toggle"><i class="fa fa-cog theme-config-show"></i><i class="ti-close theme-config-close"></i></div>
        <div class="theme-config-box">
            <div class="text-center font-18 m-b-20">SETTINGS</div>
            <div class="font-strong">LAYOUT OPTIONS</div>
            <div class="check-list m-b-20 m-t-10">
                <label class="ui-checkbox ui-checkbox-gray">
                    <input id="_fixedNavbar" type="checkbox" checked>
                    <span class="input-span"></span>Fixed navbar</label>
                <label class="ui-checkbox ui-checkbox-gray">
                    <input id="_fixedlayout" type="checkbox">
                    <span class="input-span"></span>Fixed layout</label>
                <label class="ui-checkbox ui-checkbox-gray">
                    <input class="js-sidebar-toggler" type="checkbox">
                    <span class="input-span"></span>Collapse sidebar</label>
            </div>
            <div class="font-strong">LAYOUT STYLE</div>
            <div class="m-t-10">
                <label class="ui-radio ui-radio-gray m-r-10">
                    <input type="radio" name="layout-style" value="" checked="">
                    <span class="input-span"></span>Fluid</label>
                <label class="ui-radio ui-radio-gray">
                    <input type="radio" name="layout-style" value="1">
                    <span class="input-span"></span>Boxed</label>
            </div>
            <div class="m-t-10 m-b-10 font-strong">THEME COLORS</div>
            <div class="d-flex m-b-20">
                <div class="color-skin-box" data-toggle="tooltip" data-original-title="Default">
                    <label>
                        <input type="radio" name="setting-theme" value="default" checked="">
                        <span class="color-check-icon"><i class="fa fa-check"></i></span>
                        <div class="color bg-white"></div>
                        <div class="color-small bg-ebony"></div>
                    </label>
                </div>
                <div class="color-skin-box" data-toggle="tooltip" data-original-title="Blue">
                    <label>
                        <input type="radio" name="setting-theme" value="blue">
                        <span class="color-check-icon"><i class="fa fa-check"></i></span>
                        <div class="color bg-blue"></div>
                        <div class="color-small bg-ebony"></div>
                    </label>
                </div>
                <div class="color-skin-box" data-toggle="tooltip" data-original-title="Green">
                    <label>
                        <input type="radio" name="setting-theme" value="green">
                        <span class="color-check-icon"><i class="fa fa-check"></i></span>
                        <div class="color bg-green"></div>
                        <div class="color-small bg-ebony"></div>
                    </label>
                </div>
                <div class="color-skin-box" data-toggle="tooltip" data-original-title="Purple">
                    <label>
                        <input type="radio" name="setting-theme" value="purple">
                        <span class="color-check-icon"><i class="fa fa-check"></i></span>
                        <div class="color bg-purple"></div>
                        <div class="color-small bg-ebony"></div>
                    </label>
                </div>
                <div class="color-skin-box" data-toggle="tooltip" data-original-title="Orange">
                    <label>
                        <input type="radio" name="setting-theme" value="orange">
                        <span class="color-check-icon"><i class="fa fa-check"></i></span>
                        <div class="color bg-orange"></div>
                        <div class="color-small bg-ebony"></div>
                    </label>
                </div>
                <div class="color-skin-box" data-toggle="tooltip" data-original-title="Pink">
                    <label>
                        <input type="radio" name="setting-theme" value="pink">
                        <span class="color-check-icon"><i class="fa fa-check"></i></span>
                        <div class="color bg-pink"></div>
                        <div class="color-small bg-ebony"></div>
                    </label>
                </div>
            </div>
            <div class="d-flex">
                <div class="color-skin-box" data-toggle="tooltip" data-original-title="White">
                    <label>
                        <input type="radio" name="setting-theme" value="white">
                        <span class="color-check-icon"><i class="fa fa-check"></i></span>
                        <div class="color"></div>
                        <div class="color-small bg-silver-100"></div>
                    </label>
                </div>
                <div class="color-skin-box" data-toggle="tooltip" data-original-title="Blue light">
                    <label>
                        <input type="radio" name="setting-theme" value="blue-light">
                        <span class="color-check-icon"><i class="fa fa-check"></i></span>
                        <div class="color bg-blue"></div>
                        <div class="color-small bg-silver-100"></div>
                    </label>
                </div>
                <div class="color-skin-box" data-toggle="tooltip" data-original-title="Green light">
                    <label>
                        <input type="radio" name="setting-theme" value="green-light">
                        <span class="color-check-icon"><i class="fa fa-check"></i></span>
                        <div class="color bg-green"></div>
                        <div class="color-small bg-silver-100"></div>
                    </label>
                </div>
                <div class="color-skin-box" data-toggle="tooltip" data-original-title="Purple light">
                    <label>
                        <input type="radio" name="setting-theme" value="purple-light">
                        <span class="color-check-icon"><i class="fa fa-check"></i></span>
                        <div class="color bg-purple"></div>
                        <div class="color-small bg-silver-100"></div>
                    </label>
                </div>
                <div class="color-skin-box" data-toggle="tooltip" data-original-title="Orange light">
                    <label>
                        <input type="radio" name="setting-theme" value="orange-light">
                        <span class="color-check-icon"><i class="fa fa-check"></i></span>
                        <div class="color bg-orange"></div>
                        <div class="color-small bg-silver-100"></div>
                    </label>
                </div>
                <div class="color-skin-box" data-toggle="tooltip" data-original-title="Pink light">
                    <label>
                        <input type="radio" name="setting-theme" value="pink-light">
                        <span class="color-check-icon"><i class="fa fa-check"></i></span>
                        <div class="color bg-pink"></div>
                        <div class="color-small bg-silver-100"></div>
                    </label>
                </div>
            </div>
        </div>
    </div>
    <!-- END THEME CONFIG PANEL-->
    <!-- BEGIN PAGA BACKDROPS-->
    <div class="sidenav-backdrop backdrop"></div>
    <div class="preloader-backdrop">
        <div class="page-preloader">Loading</div>
    </div>
    <!-- END PAGA BACKDROPS-->
    <!-- CORE PLUGINS-->
    <script src="./assets/vendors/jquery/dist/jquery.min.js" type="text/javascript"></script>
    <script src="./assets/vendors/popper.js/dist/umd/popper.min.js" type="text/javascript"></script>
    <script src="./assets/vendors/bootstrap/dist/js/bootstrap.min.js" type="text/javascript"></script>
    <script src="./assets/vendors/metisMenu/dist/metisMenu.min.js" type="text/javascript"></script>
    <script src="./assets/vendors/jquery-slimscroll/jquery.slimscroll.min.js" type="text/javascript"></script>
    <!-- PAGE LEVEL PLUGINS-->
    <script src="./assets/vendors/chart.js/dist/Chart.min.js" type="text/javascript"></script>
    <script src="./assets/vendors/jvectormap/jquery-jvectormap-2.0.3.min.js" type="text/javascript"></script>
    <script src="./assets/vendors/jvectormap/jquery-jvectormap-world-mill-en.js" type="text/javascript"></script>
    <script src="./assets/vendors/jvectormap/jquery-jvectormap-us-aea-en.js" type="text/javascript"></script>
    <!-- CORE SCRIPTS-->
    <script src="assets/js/app.min.js" type="text/javascript"></script>
    <!-- PAGE LEVEL SCRIPTS-->
    <script src="./assets/js/scripts/dashboard_1_demo.js" type="text/javascript"></script>
    <script>
    function subt() {
        let oldbalance = parseFloat(document.querySelector("#cbalanc").value);
        let paid = parseFloat(document.querySelector("#paid").value);
        
        if (oldbalance < paid) {
            alert("Paid amount cannot be greater than the old balance.");
        } else {
            let remained = document.querySelector("#remained").value = oldbalance - paid;
        }
    }

function subt2() {
    let remained = parseFloat(document.querySelector("#remained").value);
    let discount = parseFloat(document.querySelector("#disc").value);

    if (isNaN(remained) || isNaN(discount)) {
        alert("Please enter valid numbers for remained balance and discount.");
        return;
    }

    let nbalance = remained - discount;

    if (nbalance < 0) {
        alert("New balance cannot be negative.");
    } else {
        document.querySelector("#nbalan").value = nbalance;
    }
}

    </script>
</body>

</html>