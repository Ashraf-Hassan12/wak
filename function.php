<?php 

function get_company($col){
	require("conn.php");
	$sql = "select $col from xarun";
	$ress = $conn->query($sql);
	$r = $ress->fetch_array();

	return $r[0];
}