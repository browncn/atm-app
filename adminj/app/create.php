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
		$gender = $_POST['gender'];
		$email = mysqli_real_escape_string($conn, $_POST['email']);
		$pass1 = mysqli_real_escape_string($conn, $_POST['pass1']);
		$pass2 = mysqli_real_escape_string($conn, $_POST['pass2']);
		$tel = (int)$_POST['tel'];
		
		$echeck = "SELECT * FROM `users` WHERE `email` = '$email'";
		$eres = $conn->query($echeck);
		if(mysqli_num_rows($eres) !== 0){
			//echo $echeck . '<br>';
			//var_dump ($eres);
			echo 'email already registered.';
		}else {
			if($pass1 !== $pass2){
				echo 'passwords do not match. Please review';
			}else {
				$insert = "INSERT INTO `users` (`fname`, `lname`, `gender`, `email`, `pass`, `phone`, `created`)
				VALUES ('$fname', '$lname', '$gender', '$email', '$pass1', $tel, NOW())";
				$ires = $conn->query($insert);
				if($ires == 1){
					$query = "SELECT * FROM `users` WHERE `email` = '$email' AND `pass` = '$pass1'";
					$qres = $conn->query($query);
					if(mysqli_num_rows($qres) !== 0){
						while($qrow = mysqli_fetch_assoc($qres)){
							$_SESSION['id'] = $qrow['id'];
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