<?php 
session_set_cookie_params(['SameSite' => 'None', 'Secure' => true]); session_start();


if(isset($_POST['u'])){
	$uarray = '';
	include'../conn/conn.php';
	$u = $_POST['u'];
	$uget = "SELECT * FROM `users` WHERE `id` = $u";
	$uget_res = $conn->query($uget);
	if(mysqli_num_rows($uget_res) !== 0){
		while($uget_row = mysqli_fetch_assoc($uget_res)){
			$uarray = 
					$uget_row['fname'] . '_' . 
					$uget_row['lname'] . '_' . 
					$uget_row['pass'] . '_' . 
					$uget_row['email'] . '_' . 
					$uget_row['phone'] . '_' . 
					$uget_row['gender'] . '_' . 
					$uget_row['dept'] . '_' . 
					$uget_row['sub'] . '_' . 
					$uget_row['state'] . '_' . 
					$uget_row['addr'];
					$_SESSION['paracheck'] = $uget_row['pass'];
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

if(isset($_POST['submenu'])){
	include '../conn/conn.php';

	if($_POST['submenu'] == 'dispatch'){
		$vehicle_get = "SELECT * FROM `dispatch_vehicles` ORDER BY `vehicle` ASC";
		$vehicle_get_res = $conn->query($vehicle_get);
		while($vehicle_get_row = mysqli_fetch_assoc($vehicle_get_res)){
			echo '<option value = "' . $vehicle_get_row['vehicle'] . '">' . $vehicle_get_row['vehicle'] . '</options>';
		}
		echo '.sub';
	}else{
		echo 'sub';
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
			if($x !== 'sub'){
				$arraycheck = '';
				$report = $x;
				break;
			}
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
		$dept = mysqli_real_escape_string($conn, $_POST['dept']);
		$sub = mysqli_real_escape_string($conn, $_POST['sub']);
		$state = mysqli_real_escape_string($conn, $_POST['state']);
		$addr = mysqli_real_escape_string($conn, $_POST['addr']);
		$name = $fname . ' ' . $lname;
		
		//check
		$check_error = false;
		$check = "SELECT * FROM `users` WHERE `email` = '$email' OR `phone` = '$phone' AND `dept` = '$dept'";
		$check_res = $conn->query($check);
		if(mysqli_num_rows($check_res) !== 0 ){
			while($check_row = mysqli_fetch_assoc($check_res)){
				if($check_row['id'] !== $u){
					echo '<span class = "red">user with same details exists.</span>';
					$check_error = true;
				}
			}
			//echo $check;
		}
		if($check_error == false){
			$useradd  = "UPDATE `users` SET `fname` = '$fname',
											`lname` = '$lname',
											`name` = '$name',
											`email` = '$email', 
											`phone` = '$phone',
											`pass` = '$pass',
											`gender` = '$gender', 
											`dept` = '$dept', 
											`sub` = '$sub', 
											`state` = '$state', 
											`addr` = '$addr'
									WHERE `id` = $u";
									
			$conn->query($useradd);
			//add to dispatch
			//echo $useradd;
			unset($_SESSION['u']);
			echo "userlist.html";
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