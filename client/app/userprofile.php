<?php 
session_set_cookie_params(['SameSite' => 'None', 'Secure' => true]); session_start();


if(isset($_POST['u'])){
	$uarray = '';
	include'../conn/conn.php';
	$u = $_SESSION['cid'];
	$uget = "SELECT * FROM `users` WHERE `id` = $u";
	$uget_res = $conn->query($uget);
	if(mysqli_num_rows($uget_res) !== 0){
		while($uget_row = mysqli_fetch_assoc($uget_res)){
			$uarray = 
					$uget_row['fname'] . '_' . 
					$uget_row['lname'] . '_' . 
					$uget_row['email'] . '_' . 
					$uget_row['phone'] . '_' . 
					$uget_row['pass'] . '_' . 
					$uget_row['gender'] . '_' . 
					strtolower($uget_row['state']) . '_' . 
					$uget_row['addr'];
			$_SESSION['paracheck'] = $uget_row['pass'];
		}
	}
	echo $uarray;
}


if(isset($_POST['checknsave'])){
	include '../conn/conn.php';
	$u = $_SESSION['cid'];
	//echo $u;
	$arraycheck = array();
	foreach($_POST as $x=>$y){
		$arraycheck[$x] = $y;
	}
	$report = 'true';
	foreach($arraycheck as $x=>$y){
		if( $y == ''){
			$arraycheck = '';
			$report = $x;
			break;
		}
	}
	if($report !== 'true'){
		echo 'divid' . $report;
	}else{
		
		$fname = mysqli_real_escape_string($conn, $_POST['fname']);
		$lname = mysqli_real_escape_string($conn, $_POST['lname']);
		$email = mysqli_real_escape_string($conn, $_POST['email']);
		$phone = mysqli_real_escape_string($conn, (string)$_POST['phone']);
		if($_POST['pass'] == $_SESSION['paracheck']){
			$pass = mysqli_real_escape_string($conn, $_POST['pass']);
		}else{
			$pass = mysqli_real_escape_string($conn, sha1($_POST['pass']));
		}		
		$gender = mysqli_real_escape_string($conn, $_POST['gender']);
		$state = mysqli_real_escape_string($conn, $_POST['state']);
		$addr = mysqli_real_escape_string($conn, $_POST['addr']);
		$name = $fname . ' ' . $lname;
		
		//check
		$check_error = false;
		
		if($check_error == false){
			$useradd  = "UPDATE `users` SET `fname` = '$fname',
											`lname` = '$lname',
											`name` = '$name',
											`email` = '$email', 
											`phone` = '$phone',
											`pass` = '$pass',
											`gender` = '$gender', 
											`state` = '$state', 
											`addr` = '$addr'
									WHERE `id` = $u";
									
			$conn->query($useradd);
			//add to dispatch
			//echo $useradd;
			echo "home.html";
		}
	}
}

if(isset($_POST['del'])){
	include '../conn/conn.php';
	$u = $_SESSION['u'];
	$del = "DELETE FROM `users` WHERE `id` = $u";
	//echo $del;
	$conn->query($del);
	unset($_SESSION['u']);
	echo "userlist.html";
}


?>