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
					$_SESSION['waybill'] = $uget_row['waybill'];
					$_SESSION['status'] = $uget_row['deliv_status'];
					$_SESSION['s_email'] = $uget_row['sender_email'];
		}
	}
	$_SESSION['u'] = $u;
	
	echo $uarray;
}

if(isset($_POST['deptget'])){
	
}


if(isset($_POST['checknsave'])){
	

	require '../../PHPMailer/src/mailconfig.php';
	
	include '../conn/conn.php';
	$u = $_SESSION['u'];
	
	//echo $u;
	
	$deliv = mysqli_real_escape_string($conn, $_POST['deliv']);
	
	//check
	$check_error = false;
	
	if($check_error == false){
		$useradd  = "UPDATE `deliveries` SET `deliv_status` = '$deliv'
										WHERE `id` = $u";
								
		$conn->query($useradd);
		
		if(isset($_SESSION['did'])){
			include '../conn/conn.php';
			$id = $_SESSION['did'];
			$uget = "SELECT * FROM `users` WHERE `id` = $id";
			$ures = $conn->query($uget);
			$urow = mysqli_fetch_assoc($ures);
			$uname = $urow['lname'] . ' ' . $urow['fname'];
			$uname = strtoupper($uname);
			$phone = $urow['phone'];
			//echo $uname;
		}
		
		
		
		$mail->AddAddress("customercare@atmlogistic.com");
		$mail->AddAddress($_SESSION['s_email']);
		$mail->Subject = "DELIVERY STATUS CHANGED";
		$mail->Body = "Hello there.<br>Delivery status has been changed to <b>" . $deliv . "</b> from <b>" . $_SESSION['status'] . "</b> by assigned dispatch <b>" . $uname . 
				"</b> <a href=tel:" . $phone . ">" . $phone . "</a><br>Item Waybill No:" . $_SESSION['waybill'] . "<br><br>Have a wonderful day and thank you for using <B>ATM Logistics";
		
		
		$mail->send();
		//add to dispatch
		//echo $useradd;
		unset($_SESSION['u']);
		echo "pendinglist.html";
	}
}



?>