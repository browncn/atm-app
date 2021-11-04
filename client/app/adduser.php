<?php 
session_set_cookie_params(['SameSite' => 'None', 'Secure' => true]); session_start();


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
	
	$fname = mysqli_real_escape_string($conn, $_POST['fname']);
	$lname = mysqli_real_escape_string($conn, $_POST['lname']);
	$email = mysqli_real_escape_string($conn, $_POST['email']);
	$phone = mysqli_real_escape_string($conn, (string)$_POST['phone']);
	$pass = mysqli_real_escape_string($conn, sha1($_POST['pass']));
	$gender = mysqli_real_escape_string($conn, $_POST['gender']);
	$dept = mysqli_real_escape_string($conn, $_POST['dept']);
	$sub = mysqli_real_escape_string($conn, $_POST['sub']);
	$state = mysqli_real_escape_string($conn, $_POST['state']);
	$addr = mysqli_real_escape_string($conn, $_POST['addr']);
	$name = $fname . ' ' . $lname;
	
	//check
	$check = "SELECT * FROM `users` WHERE `email` = '$email' OR `phone` = '$phone' AND `dept` = '$dept'";
	$check_res = $conn->query($check);
	if(mysqli_num_rows($check_res) !== 0 ){
		echo '<span class = "red">user with same details exists.</span>';
	}else{
		$useradd  = "INSERT INTO `users` (`fname`, `lname`, `name`, `email`, `phone`, `pass`, `gender`, `dept`, `sub`, `state`, `addr`, `created`)
								VALUES ('$fname', '$lname', '$name', '$email', '$phone', '$pass', '$gender', '$dept', '$sub', '$state', '$addr', NOW())";
		$conn->query($useradd);
		//add to dispatch
		
		
		echo "userlist.html";
	}
	
	
}


?>