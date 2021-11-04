<?php 
session_set_cookie_params(['SameSite' => 'None', 'Secure' => true]); session_start();


if(isset($_POST['u'])){
	$uarray = '';
	include'../conn/conn.php';
	$u = $_POST['u'];
	$uget = "SELECT * FROM `branches` WHERE `id` = $u";
	$uget_res = $conn->query($uget);
	if(mysqli_num_rows($uget_res) !== 0){
		while($uget_row = mysqli_fetch_assoc($uget_res)){
			$uarray = $uget_row['state'] . '_' . 
					$uget_row['city'] . '_' . 
					$uget_row['addr'] . '_' . 
					$uget_row['email'] . '_' . 
					$uget_row['phone'] . '_' . 
					$uget_row['type'];
		}
	}
	$_SESSION['u'] = $u;
	echo $uarray;
}




if(isset($_POST['deptget'])){
	include '../conn/conn.php';
	$dept_get = "SELECT * FROM `dept` ORDER BY `dept` ASC";
	$dept_get_res = $conn->query($dept_get);
	while($dept_get_row = mysqli_fetch_assoc($dept_get_res)){
		echo '<option value = "' . $dept_get_row['dept'] . '">' . $dept_get_row['dept'] . '</option>';
	}
	
}

if(isset($_POST['checknsave'])){
	include '../conn/conn.php';
	$u = $_SESSION['u'];
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
		
		$email = mysqli_real_escape_string($conn, $_POST['email']);
		$phone = mysqli_real_escape_string($conn, (string)$_POST['phone']);
		$type = mysqli_real_escape_string($conn, $_POST['type']);
		$city = mysqli_real_escape_string($conn, $_POST['city']);
		$state = mysqli_real_escape_string($conn, $_POST['state']);
		$addr = mysqli_real_escape_string($conn, $_POST['addr']);
		
		//check
		$check_error = false;
		if($check_error == false){
			$useradd  = "UPDATE `branches` SET `type` = '$type', 
											`email` = '$email', 
											`phone` = '$phone',
											`state` = '$state', 
											`addr` = '$addr',
											`city` = '$city'
									WHERE `id` = $u";
									
			$conn->query($useradd);
			//add to dispatch
			//echo $useradd;
			unset($_SESSION['u']);
			echo "branchlist.html";
		}
	}
}

if(isset($_POST['del'])){
	include '../conn/conn.php';
	$u = $_SESSION['u'];
	$del = "DELETE FROM `branches` WHERE `id` = $u";
	//echo $del;
	$conn->query($del);
	unset($_SESSION['u']);
	echo "branchlist.html";
}


?>