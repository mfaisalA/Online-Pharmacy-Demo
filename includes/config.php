<?php 
	$localhost = "localhost";
	$username = "root";
	$password = "";
	$database = "gulfmedical";
	$con=mysqli_connect($localhost,$username,$password) or die('Database not connected');
	mysqli_select_db($con,$database) or die('Database not selected');



	define("SYSTEM_NAME", "Gulf Pharmacy");
	define("COMPANY_NAME", "Gulf Pharmacy Co.");

?>
