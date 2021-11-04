<?php 
session_set_cookie_params(['SameSite' => 'None', 'Secure' => true]); session_start();


if(isset($_POST['u'])){
	$uarray = '';
	include'../conn/conn.php';
	$u = $_POST['u'];
	$uget = "SELECT * FROM `deliveries` WHERE `id` = $u";
	$uget_res = $conn->query($uget);
	if(mysqli_num_rows($uget_res) !== 0){
		while($uget_row = mysqli_fetch_assoc($uget_res)){
			$did = $uget_row['disp_id'];
			$check = "SELECT * FROM `users` WHERE `id` = $did";
			$check_res = $conn->query($check);
			if(mysqli_num_rows($check_res) !== 0 ){
				while($check_row = mysqli_fetch_assoc($check_res)){
					$name = $check_row['name'];
					$phone = $check_row['phone'];
				}
				//echo $check;
			}else{
				$name = 'dispatch not yet assigned';
				$phone = '';
			}
			$uarray = $uget_row['pkg_descr'] . '_' . 
					$uget_row['sender_name'] . '_' . 
					$uget_row['sender_addr'] . '_' . 
					$uget_row['sender_num'] . '_' . 
					$uget_row['sender_email'] . '_' . 
					$uget_row['rec_name'] . '_' . 
					$uget_row['rec_addr'] . '_' . 
					$uget_row['rec_num'] . '_' . 
					$uget_row['rec_state'] . '_' . 
					$uget_row['pref_trans'] . '_' . 
					$uget_row['pkg_value'] . '_' . 
					$uget_row['pkg_qty'] . '_' . 
					$uget_row['pkg_weight'] . '_' . 
					$uget_row['deliv_type'] . '_' . 
					$uget_row['waybill'] . '_' . 
					$uget_row['amount'] . '_' . 
					$name . '_' . 
					$phone . '_' . 
					$uget_row['deliv_status'] . '_' . 
					$uget_row['update_time'];
					if($uget_row['deliv_status'] == 'delivered'){
						$_SESSION['status'] = 'delivered';
					}
		}
	}
	$_SESSION['u'] = $u;
	echo $uarray;
}




if(isset($_POST['deptget'])){
	$u = $_POST['deptget'];
	include '../conn/conn.php';
	$disp_get = "SELECT * FROM `users` WHERE `state` = '$u' AND `dept` = 'dispatch' ORDER BY `name` ASC";
	echo $disp_get;
	$disp_get_res = $conn->query($disp_get);
	if(mysqli_num_rows($disp_get_res)!==0){
		while($disp_get_row=mysqli_fetch_assoc($disp_get_res)){
			$name = $disp_get_row['name'];
			$sub = $disp_get_row['sub'];
			$id = $disp_get_row['id'];
			if(isset($_SESSION['status'])){
				unset($_SESSION['status']);
			}else{
				echo '<option value = "' . $id . '">' . $name . ' - ' . $sub . '</option>';
			}
			
			
		}
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
	$name = '';
	$phone = '';
	//echo $u;
	
	$id = mysqli_real_escape_string($conn, $_POST['id']);
	
	//check
	$check_error = false;
	if($check_error == false){
		$useradd  = "UPDATE `deliveries` SET `disp_id` = $id
										WHERE `id` = $u";
								
		$conn->query($useradd);
		//add to dispatch
		//echo $useradd;
		unset($_SESSION['u']);
		echo "pendinglist.html";
	}
}

if(isset($_POST['del'])){
	include '../conn/conn.php';
	$u = $_SESSION['u'];
	$del = "DELETE FROM `deliveries` WHERE `id` = $u";
	//echo $del;
	$conn->query($del);
	unset($_SESSION['u']);
	echo "pendinglist.html";
}


?>