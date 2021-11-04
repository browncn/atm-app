<?php 
session_set_cookie_params(['SameSite' => 'None', 'Secure' => true]); session_start();
session_start();


if(isset($_POST['signin'])){
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
		$uinfo = mysqli_real_escape_string($conn, $_POST['uinfo']);
		$pass = mysqli_real_escape_string($conn, sha1($_POST['pass']));
		
		//check with tel
		$query = "SELECT * FROM `users` WHERE `phone` = '$uinfo' AND `pass` = '$pass' AND `dept` = '$dept'";
		$qres = $conn->query($query);
		if(mysqli_num_rows($qres) !== 0){
			while($qrow = mysqli_fetch_assoc($qres)){
				$_SESSION['cid'] = $qrow['id'];
			}
			echo 'home.html';
			
		}else{
			//check with email
			$query = "SELECT * FROM `users` WHERE `email` = '$uinfo' AND `pass` = '$pass' AND `dept` = '$dept'";
			$qres = $conn->query($query);
			if(mysqli_num_rows($qres) !== 0){
				while($qrow = mysqli_fetch_assoc($qres)){
					$_SESSION['cid'] = $qrow['id'];
				}
				echo 'home.html';
				
			}else{
				echo 'wrong login details';
			}
		}
	}
}else{
	echo '<script>window.location.href="../index.html"</script>';
}

?>