<?php

require "conn.php";
$id = $_GET['iddd'];
$sql = mysqli_query($conn, "select * from tuur where id = '$id'");
$res = mysqli_fetch_array($sql);
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
    <form action="receipt_list.php" method="POST" enctype="multipart/form-data">
        <div class="row">
            <div class="col-sm-6 form-group">
                <label for="id">ID</label>
                <input class="form-control" id="id" name="id" type="text" required placeholder="Full Name" value="<?php echo htmlspecialchars($res[0], ENT_QUOTES, 'UTF-8'); ?>" readonly>
            </div>

            <div class="col-sm-6 form-group">
                <label for="cname">Customer Name</label>
                <select name="cname" class="form-control" id="cname" required>
                    <option selected disabled value="<?php echo htmlspecialchars($res[1], ENT_QUOTES, 'UTF-8'); ?>">Select Customer</option>
                    <?php 
                        $ress = mysqli_query($conn, "SELECT id, name FROM customers");
                        while ($row = mysqli_fetch_array($ress)) {
                            echo "<option  value='{$row['id']}' <?php echo $res[0];?>".htmlspecialchars($row['name'], ENT_QUOTES, 'UTF-8')."</option>";
                        }
                    ?>                                            
                </select>                                            
            </div>

            <div class="col-sm-6 form-group">
                <label for="cbalanc">Current Balance</label>
                <input class="form-control" id="cbalanc" name="cbalance" type="text" required placeholder="Enter Current Balance" value="<?php echo htmlspecialchars($res[2], ENT_QUOTES, 'UTF-8'); ?>" readonly>
            </div>

            <div class="col-sm-6 form-group">
                <label for="paid">Paid</label>
                <input class="form-control" id="paid" name="paid" type="text" required placeholder="Enter Paid" value="<?php echo htmlspecialchars($res[3], ENT_QUOTES, 'UTF-8'); ?>" onkeyup="subt()">
            </div>

            <div class="col-sm-6 form-group">
                <label for="remained">Remained</label>
                <input class="form-control" id="remained" name="remained" type="text" required placeholder="Enter Remained" value="<?php echo htmlspecialchars($res[4], ENT_QUOTES, 'UTF-8'); ?>" readonly onkeyup="mult()">
            </div>

            <div class="col-sm-6 form-group">
                <label for="disc">Discount</label>
                <input class="form-control" id="disc" name="discount" type="text" required placeholder="Enter Discount" value="<?php echo htmlspecialchars($res[5], ENT_QUOTES, 'UTF-8'); ?>" onkeyup="subt2()">
            </div>

            <div class="col-sm-6 form-group">
                <label for="nbalan">New Balance</label>
                <input class="form-control" id="nbalan" name="nbalance" type="text" required placeholder="Enter New Balance" value="<?php echo htmlspecialchars($res[6], ENT_QUOTES, 'UTF-8'); ?>" readonly>
            </div>

            <div class="col-sm-12 form-group">
                <label for="date">Date</label>
                <input class="form-control" id="date" name="date" type="date" required value="<?php echo date('Y-m-d'); ?>" value="<?php echo htmlspecialchars($res[7], ENT_QUOTES, 'UTF-8'); ?>">
            </div>
        </div>
        
        <div class="form-group">
            <button class="btn btn-primary btn-block" name="btnedit" type="submit">Update</button>
        </div>
    </form>
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
</body>

</html>