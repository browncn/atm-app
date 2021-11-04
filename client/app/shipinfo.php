<?php 
session_set_cookie_params(['SameSite' => 'None', 'Secure' => true]); session_start();


if(isset($_POST['stateget'])){
	include '../conn/conn.php';
	
	$state = '';
	$dept_get = "SELECT * FROM `branches` ORDER BY `state` ASC";
	$dept_get_res = $conn->query($dept_get);
	while($dept_get_row = mysqli_fetch_assoc($dept_get_res)){
		if($state !== strtolower($dept_get_row['state'])){
			$state = strtolower($dept_get_row['state']);
			echo '<option value = "' . strtolower($dept_get_row['state']) . '">' . strtoupper($dept_get_row['state']) . '</option>';
		}
	}
}

if(isset($_POST['user_get'])){
	
	if(isset($_SESSION['cid'])){
		include '../conn/conn.php';
		$id = $_SESSION['cid'];
		$uget = "SELECT * FROM `users` WHERE `id` = $id";
		$ures = $conn->query($uget);
		$urow = mysqli_fetch_assoc($ures);
		$uinfo = strtoupper($urow['name']) . '||' . $urow['addr'] . '||' . $urow['phone'] . '||' . $urow['email'];
		echo $uinfo;
	}
}

if(isset($_POST['calc'])){
	include '../conn/conn.php';
	$s_state = $_POST['s_state'];
	$r_state = $_POST['r_state'];
	$qty = (int)$_POST['qty'];
	$weight = (int)$_POST['weight'];
	$deliv = (int)$_POST['deliv'];
	$base = '';
	$actual = 0;
	
	$route = "SELECT * FROM `routes` WHERE `dep` = '$s_state' AND `dest` = '$r_state'";
	$res = $conn->query($route);
	if(mysqli_num_rows($res) !== 0){
		$row = mysqli_fetch_assoc($res);
		$base = (int)$row['base_price'];
		$actual = $base * ($qty * $weight) + $deliv;
	}
	
	
	echo 'N' . $actual;
	$_SESSION['actual'] = $actual;
	//echo $route;
}

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
		$_SESSION['descr'] = $_POST['descr'];
		$_SESSION['n_sen'] = $_POST['n_sen'];
		$_SESSION['addr_sen'] = $_POST['addr_sen'];
		$_SESSION['n_rec'] = $_POST['n_rec'];
		$_SESSION['addr_rec'] = $_POST['addr_rec'];
		$_SESSION['phone_sen'] = $_POST['phone_sen'];
		$_SESSION['phone_rec'] = $_POST['phone_rec'];
		$_SESSION['s_state'] = $_POST['s_state'];
		$_SESSION['r_state'] = $_POST['r_state'];
		$_SESSION['email'] = $_POST['email'];
		$_SESSION['value'] = $_POST['value'];
		$_SESSION['qty'] = $_POST['qty'];
		$_SESSION['weight'] = $_POST['weight'];
		$_SESSION['payment'] = $_POST['payment'];
		$_SESSION['deliv'] = $_POST['deliv'];
		$_SESSION['vehicle'] = $_POST['vehicle'];
		
		echo 'summary.html';
		
		
	}
}


?>