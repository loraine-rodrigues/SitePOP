<?php


// Enter your Host, username, password, database below.

$con = mysqli_connect("localhost","50526","azure","6#vWHD_$","motofrete");
	if (mysqli_connect_errno()){
		echo "Failed to connect to MySQL: " . mysqli_connect_error();
		die();
		}

date_default_timezone_set('America/Sao_Paulo');	
$error="";	
?>
