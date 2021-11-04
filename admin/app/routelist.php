<?php 
session_set_cookie_params(['SameSite' => 'None', 'Secure' => true]); session_start();

if(isset($_POST['user_check'])){
	include '../conn/conn.php';
	$user_check = $_POST['user_check'];
	
	$users_get = "SELECT * FROM `routes` WHERE `dep` LIKE '%$user_check%' ORDER BY `dep` ASC";
	
	$users_get_res = $conn->query($users_get);
	
	if(mysqli_num_rows($users_get_res) == 0){
		echo '<tr>
			<td>no routes found</td>
		</tr>';
	}else{
		while ($users_get_row = mysqli_fetch_assoc($users_get_res)){
			echo '<tr>
				<td>' . $users_get_row['dep'] . '</td>
				<td>-></td>
				<td style="margin-right:20px;">' . $users_get_row['dest'] . '</td>
				<td>' . $users_get_row['base_price'] . '</td>
			</tr>';
		}
	}
	
}
if(isset($_POST['router'])){
	include '../conn/conn.php';
	$dep = mysqli_real_escape_string($conn, $_POST['dep']);
	$dest = mysqli_real_escape_string($conn, $_POST['dest']);
	$price = mysqli_real_escape_string($conn, $_POST['price']);
	if($dep == '' || $dest == '' || $price == ''){
		
	}else{
		$check = "SELECT * FROM `routes` WHERE `dep` = '$dep' AND `dest` = '$dest'";
		$recheck = $conn->query($check);
		if(mysqli_num_rows($recheck) == 0){
			$ins = "INSERT INTO `routes` (`dep`, `dest`, `base_price`) VALUES ('$dep', '$dest', $price)";
			//echo $ins;
			$conn->query($ins);
		}else{
			$upd = "UPDATE `routes` SET `base_price` = $price WHERE `dep` = '$dep' AND `dest` = '$dest'";
			//echo $upd;
			$conn->query($upd);
		}
	}
}
if(isset($_POST['userlist'])){
	include '../conn/conn.php';
		
		$users_get = "SELECT * FROM `routes` ORDER BY `dep` ASC";
		
		$users_get_res = $conn->query ( $users_get );
		
		if(mysqli_num_rows($users_get_res) == 0){
			echo '<tr>
			<td>no routes found</td>
		</tr>';
		}else{
			while ($users_get_row = mysqli_fetch_assoc($users_get_res)){
				echo '<tr>
				<td>' . $users_get_row['dep'] . '</td>
				<td>-></td>
				<td style="margin-right:20px;">' . $users_get_row['dest'] . '</td>
				<td>' . $users_get_row['base_price'] . '</td>
			</tr>';
			}
		}

}

if(isset($_POST['groutes'])){
	include '../conn/conn.php';
	$desu = '';
	$all_r = '';
	$g = "SELECT `state` FROM `branches` ORDER BY `state` ASC";
	$re = $conn->query($g);
	if(mysqli_num_rows($re) !== 0){
		while($ro = mysqli_fetch_assoc($re)){
			$the_d = $ro['state'];
			if($desu !== $the_d){
				$desu = $the_d;
				if($all_r == ''){
					$all_r = $desu;
				}else{
					$all_r = $all_r . '_' . $desu;
				}				
			}
		}
	}
	echo $all_r;
}


?>