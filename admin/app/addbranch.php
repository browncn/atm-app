<?php 
session_set_cookie_params(['SameSite' => 'None', 'Secure' => true]); session_start();



if(isset($_POST['checknsave'])){
	include '../conn/conn.php';
	
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
		$city = mysqli_real_escape_string($conn, strtolower($_POST['city']));
		$state = mysqli_real_escape_string($conn, strtolower($_POST['state']));
		$addr = mysqli_real_escape_string($conn, strtolower($_POST['addr']));
		
			$useradd  = "INSERT INTO `branches` (`state`, `city`, `addr`, `email`, `phone`, `type`)
									VALUES ('$state', '$city', '$addr', '$email', '$phone', '$type')";
			$conn->query($useradd);
			//add to dispatch
			
			
			echo "branchlist.html";
			
	}	
	
}


?>