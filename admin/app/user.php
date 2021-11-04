<?php 
session_set_cookie_params(['SameSite' => 'None', 'Secure' => true]); session_start();



if(isset($_SESSION['aid'])){
	include '../conn/conn.php';
	$id = $_SESSION['aid'];
	$uget = "SELECT * FROM `users` WHERE `id` = $id";
	$ures = $conn->query($uget);
	$urow = mysqli_fetch_assoc($ures);
	$uname = $urow['lname'] . ' ' . $urow['fname'];
	$uname = strtoupper($uname);
	echo $uname;
}else{
	echo 'index.html';
	session_destroy();
}

?>