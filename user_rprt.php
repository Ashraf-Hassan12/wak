<?php
include "conn.php";
$id = $_GET["idd"]

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width initial-scale=1.0">
    <title>Dhubac Travel Agency</title>
    <!-- GLOBAL MAINLY STYLES-->
    <link href="./assets/vendors/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet" />
    <link href="./assets/vendors/font-awesome/css/font-awesome.min.css" rel="stylesheet" />
    <link href="./assets/vendors/themify-icons/css/themify-icons.css" rel="stylesheet" />
    <!-- PLUGINS STYLES-->
        <!-- PLUGINS STYLES-->
    <link href="./assets/vendors/DataTables/datatables.min.css" rel="stylesheet" />
    <!-- THEME STYLES-->
    <link href="./assets/vendors/jvectormap/jquery-jvectormap-2.0.3.css" rel="stylesheet" />
    <!-- THEME STYLES-->
    <link href="assets/css/main.min.css" rel="stylesheet" />
    <!-- PAGE LEVEL STYLES-->
</head>
<body>

    <div class="container">
        <div class="row">
            <div class="col-12">
                <img src="upload/daas.jpg" width=100% height=160px alt="">
                <br>
                <br>

            </div>

        

            <div class="col-12">
                <h3>INDIVIDUAL USER REPORT</h3>
            </div>
            
        
            <table class="table">
                            <thead>
                                
                                <tr>
                                    <th>Id</th>
                                    <th>Name</th>
                                    <th>User Name</th>
                                    <th>Password</th>
                                
                                    <th>Image</th>
                                    <th>Date</th>
                                    
                                </tr>
                            </thead>

                            <tbody>

                            <?php
                            $res = mysqli_query($conn, "SELECT u.id,e.name `Employee Name`,u.username,u.password,u.image,u.regdate FROM users u 
JOIN employees e on e.id=u.emp_id where u.id='$id' ");
                            while($row = mysqli_fetch_array($res)){
                                ?>
                                <tr>
                                    <td><?php echo $row[0]; ?></td>
                                    <td><?php echo $row[1]; ?></td>
                                    <td><?php echo $row[2]; ?></td>
                                    <td><?php echo $row[3]; ?></td>
                                
                                    
                                    <td><img src="upload/<?php echo $row[4]; ?>" width="50" height="50" alt=""></td>
                                    <td><?php echo $row[5]; ?></td>
                                    
                                    
                                </tr>

                                <?php
                            }

                            ?>
                            </tbody>
                        
                            
            </table>

            <button onclick="window.print()" class="fa fa-print"></button>

        </div>
    </div>
    
</body>
</html>

<style>
    h3{
        background-color: #e2e2e2;

        text-align: center;
        font-family:impact;
        font-weight: bold;

        

    }
    img{
        
        margin:20px 0 0 0;
    }
    table {
        border:1px solid #e3e8f8;
    }

    thead{
        background-color: #b4d4ff;
    }
    
    tbody{
        background-color: #eef5ff;
    }
    
</style>