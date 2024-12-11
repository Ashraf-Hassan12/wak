<?php
require'conn.php';
if(isset($_POST['id'])){
    $read = mysqli_query($conn, "SELECT b.price FROM booking b
JOIN customers c ON c.id=b.customer_id WHERE c.id=$_POST[id]");
        $res = mysqli_fetch_assoc($read);
    
        echo implode(",", $res);
    }
?>