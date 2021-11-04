<?php 
session_set_cookie_params(['SameSite' => 'None', 'Secure' => true]); session_start();


if(isset($_POST['create'])){
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
		$fname = mysqli_real_escape_string($conn, $_POST['fname']);
		$lname = mysqli_real_escape_string($conn, $_POST['lname']);
		$state = mysqli_real_escape_string($conn, strtolower($_POST['state']));
		$addr = mysqli_real_escape_string($conn, $_POST['addr']);
		$dept = mysqli_real_escape_string($conn, $_POST['dept']);
		$gender = mysqli_real_escape_string($conn, $_POST['gender']);
		$email = mysqli_real_escape_string($conn, $_POST['email']);
		$pass1 = mysqli_real_escape_string($conn, $_POST['pass1']);
		$pass2 = mysqli_real_escape_string($conn, $_POST['pass2']);
		$tel = mysqli_real_escape_string($conn, (string)$_POST['tel']);
		$name = $fname . ' ' . $lname;
		
		$echeck = "SELECT * FROM `users` WHERE `email` = '$email' AND `dept` = '$dept'";
		$eres = $conn->query($echeck);
		if(mysqli_num_rows($eres) !== 0){
			//echo $echeck . '<br>';
			//var_dump ($eres);
			echo 'email already registered.';
		}else {
			if($pass1 !== $pass2){
				echo 'passwords do not match. Please review';
			}else {
				$pass1 = sha1($pass1);
				$insert = "INSERT INTO `users` (`fname`, `lname`, `state`, `addr`, `dept`, `gender`, `email`, `pass`, `phone`, `created`)
				VALUES ('$fname', '$lname', '$state', '$addr', '$dept', '$gender', '$email', '$pass1', '$tel', NOW())";
				$ires = $conn->query($insert);
				if($ires == 1){
					$query = "SELECT * FROM `users` WHERE `email` = '$email' AND `pass` = '$pass1' AND `dept` = '$dept'";
					$qres = $conn->query($query);
					if(mysqli_num_rows($qres) !== 0){
						while($qrow = mysqli_fetch_assoc($qres)){
							$_SESSION['cid'] = $qrow['id'];
						}
						echo 'home.html';
					}else{
						echo 'validation failed. please contact admin';
					}
				}else {
					echo 'there was an error. please try again';
				}
			}
		}
	}
}else{
	echo '<script>window.location.href="../create.html"</script>';
}

?>