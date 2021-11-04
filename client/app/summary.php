<?php 
session_set_cookie_params(['SameSite' => 'None', 'Secure' => true]); session_start();


if(isset($_POST['summary'])){
	
	$descr = $_SESSION['descr'];
	$n_sen = $_SESSION['n_sen'];
	$addr_sen = $_SESSION['addr_sen'];
	$n_rec = $_SESSION['n_rec'];
	$addr_rec = $_SESSION['addr_rec'];
	$phone_sen = $_SESSION['phone_sen'];
	$phone_rec = $_SESSION['phone_rec'];
	$s_state = $_SESSION['s_state'];
	$r_state = $_SESSION['r_state'];
	$email = $_SESSION['email'];
	$value = $_SESSION['value'];
	$qty = $_SESSION['qty'];
	$weight = $_SESSION['weight'];
	$payment = $_SESSION['payment'];
	$deliv = $_SESSION['deliv'];
	$vehicle = $_SESSION['vehicle'];
	$actual = $_SESSION['actual'];
	
	if($payment == 'online'){
		$button = 'PROCESS PAYMENT';
	}else{
		$button = 'PROCEED';
	}
	
	echo '
		<table class = "booked_info unitable m-auto">
		<tr>
		<th CLASS = "booked_route" colspan = 3><p></p></th>
		</tr>
		<tr class = "uni">
		<td><span class = "summary_main">ITEM DESCRIPTION</span></td>
		<td class = "booked_colon"> : </td>
		<td><span class = "booked_data" id = "pkg_descr">' . $descr . '</span></td>
		</tr>
		<tr class = "uni">
		<td><span class = "summary_main">SENDER </span></td>
		<td class = "booked_colon"> : </td>
		<td id = "sender_name">' . $n_sen . '<br>' . $addr_sen . '<br>' . strtoupper($s_state) , '<br>' . $phone_sen . '<br>' . $email . '</td>
		</tr>
		<tr class = "uni">
		<td><span class = "summary_main">RECIEVER</span></td>
		<td class = "booked_colon"> : </td>
		<td id = "rec_name">' . $n_rec . '<br>' . $addr_rec . '<br>' . strtoupper($r_state) , '<br>' . $phone_rec . '</td>
		</tr>
		<tr class = "uni">
		<td><span class = "summary_main">PREFERRED TRANSPORT</span></td>
		<td class = "booked_colon"> : </td>
		<td id = "pref_trans">' . $vehicle . '</td>
		</tr>
		<tr class = "uni">
		<td><span class = "summary_main">ITEM VALUE</span></td>
		<td class = "booked_colon"> : </td>
		<td id = "pkg_value">' . number_format($value) . '</td>
		</tr>
		<tr class = "uni">
		<td><span class = "summary_main">ITEM QUANTITY</span></td>
		<td class = "booked_colon"> : </td>
		<td><span class = "booked_data" id = "pkg_qty">' . number_format($qty) . '</span></td>
		</tr>
		<tr class = "uni">
		<td><span class = "summary_main">ITEM WEIGHT(kg)</span></td>
		<td class = "booked_colon"> : </td>
		<td id = "pkg_weight">' . number_format($weight) . '</td>
		</tr>
		<tr class = "uni">
		<td><span class = "summary_main">DELIVERY TYPE</span></td>
		<td class = "booked_colon"> : </td>
		<td id = "deliv_type">' . $deliv . '</td>
		</tr>
		<tr class = "uni">
		<td><span class = "summary_main">TOTAL AMOUNT PAYABLE </span></td>
		<td class = "booked_colon"> : </td>
		<td id = "amount"><b>' . number_format($actual) . '</b></td>
		</tr>
		<tr class = "uni">
		<td><span class = "summary_main">PAYMENT METHOD </span></td>
		<td class = "booked_colon"> : </td>
		<td id = "payment">' . $payment . '</td>
		</tr>
		</table>

		<button class = "r_search bottom def_button" onclick = "return false;" onmousedown = "checknsave();">' . $button . '</button>';
}



if(isset($_POST['checknsave'])){
	require '../../PHPMailer/src/mailconfig.php';
	
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
		$pkg_descr = $_SESSION['descr'];
		$sender_name = $_SESSION['n_sen'];
		$sender_addr = $_SESSION['addr_sen'];
		$rec_name = $_SESSION['n_rec'];
		$rec_addr = $_SESSION['addr_rec'];
		$sender_num = $_SESSION['phone_sen'];
		$rec_num = $_SESSION['phone_rec'];
		$sender_state = $_SESSION['s_state'];
		$rec_state = $_SESSION['r_state'];
		$sender_email = $_SESSION['email'];
		$pkg_value = $_SESSION['value'];
		$pkg_qty = $_SESSION['qty'];
		$pkg_weight = $_SESSION['weight'];
		$pay_method = $_SESSION['payment'];
		$deliv_type = $_SESSION['deliv'];
		$pref_trans = $_SESSION['vehicle'];
		$amount = $_SESSION['actual'];
		$uid = $_SESSION['cid'];
		$deliv_status = 'pending';
		
		$descr = $_SESSION['descr'];
		$n_sen = $_SESSION['n_sen'];
		$addr_sen = $_SESSION['addr_sen'];
		$n_rec = $_SESSION['n_rec'];
		$addr_rec = $_SESSION['addr_rec'];
		$phone_sen = $_SESSION['phone_sen'];
		$phone_rec = $_SESSION['phone_rec'];
		$s_state = $_SESSION['s_state'];
		$r_state = $_SESSION['r_state'];
		$email = $_SESSION['email'];
		$value = $_SESSION['value'];
		$qty = $_SESSION['qty'];
		$weight = $_SESSION['weight'];
		$payment = $_SESSION['payment'];
		$deliv = $_SESSION['deliv'];
		$vehicle = $_SESSION['vehicle'];
		$actual = $_SESSION['actual'];
		
		
		$date = date('ymdHis');
		$waybill = rand(0000,9999) . $date;
		
		$query = "INSERT INTO `deliveries` (`uid`, `sender_name`, `sender_addr`, `sender_num`, `sender_email`, `sender_state`, `rec_name`, `rec_addr`, `rec_num`, `rec_state`, `pkg_value`, `pkg_qty`, `pkg_weight`, `pkg_descr`, `pref_trans`, `deliv_type`,`deliv_status`, `waybill`, `amount`,`pay_method`, `added`)
		VALUES ($uid, '$sender_name', '$sender_addr', '$sender_num', '$sender_email', '$sender_state', '$rec_name', '$rec_addr', '$rec_num', '$rec_state', $pkg_value, $pkg_qty, $pkg_weight, '$pkg_descr', '$pref_trans', '$deliv_type','$deliv_status', '$waybill', $amount, '$pay_method', NOW())";
		
		$conn->query($query);
		
		if(isset($_SESSION['cid'])){
			include '../conn/conn.php';
			$id = $_SESSION['cid'];
			$uget = "SELECT * FROM `users` WHERE `id` = $id";
			$ures = $conn->query($uget);
			$urow = mysqli_fetch_assoc($ures);
			$uname = $urow['lname'] . ' ' . $urow['fname'];
			$uname = strtoupper($uname);
			$phone = $urow['phone'];
			//echo $uname;
		}
		
		$mail->AddAddress("customercare@atmlogistic.com");
		$mail->AddAddress($_SESSION['email']);
		$mail->Subject = "DELIVERY REQUEST RECEIVED";
		$mail->Body = "Delivery request received from <b>" . $uname . "</b> with phone number </b> <a href=tel:" . $phone . ">" . $phone . "</a><br>
			Details :<br>" . "<table class = booked_info unitable m-auto>
		<tr>
		<th class = booked_route colspan = 3><p></p></th>
		</tr>
		<tr>
		<td><span class = summary_main>ITEM DESCRIPTION</span></td>
		<td class = booked_colon> : </td>
		<td><span class = booked_data id = pkg_descr>" . $descr . "</span></td>
		</tr>
		<tr>
		<td><span class = summary_main>SENDER </span></td>
		<td class = booked_colon> : </td>
		<td id = sender_name><b>" . $n_sen . "</b><br>" . $addr_sen . "<br>" . strtoupper($s_state) . "<br><a href=tel:" . $phone_sen . ">" . $phone_sen . "</a><br><a href=mailto:" . $email . ">" . $email . "</a></td>
		</tr>
		<tr>
		<td><span class = summary_main>RECIEVER</span></td>
		<td class = booked_colon> : </td>
		<td id = rec_name><b>" . $n_rec . "</b><br>" . $addr_rec . "<br>" . strtoupper($r_state) . "<br><a href=tel:" . $phone_rec . ">" . $phone_rec . "</a></td>
		</tr>
		<tr>
		<td><span class = summary_main>PREFERRED TRANSPORT</span></td>
		<td class = booked_colon> : </td>
		<td id = pref_trans>" . $vehicle . "</td>
		</tr>
		<tr>
		<td><span class = summary_main>ITEM VALUE</span></td>
		<td class = booked_colon> : </td>
		<td id = pkg_value>" . number_format($value) . "</td>
		</tr>
		<tr>
		<td><span class = summary_main>ITEM QUANTITY</span></td>
		<td class = booked_colon> : </td>
		<td><span class = booked_data id = pkg_qty>" . number_format($qty) . "</span></td>
		</tr>
		<tr>
		<td><span class = summary_main>ITEM WEIGHT(kg)</span></td>
		<td class = booked_colon> : </td>
		<td id = pkg_weight>" . number_format($weight) . "</td>
		</tr>
		<tr>
		<td><span class = summary_main>DELIVERY TYPE</span></td>
		<td class = booked_colon> : </td>
		<td id = deliv_type>" . $deliv . "</td>
		</tr>
		<tr>
		<td><span class = summary_main>TOTAL AMOUNT PAYABLE </span></td>
		<td class = booked_colon> : </td>
		<td id = amount><b>" . number_format($actual) . "</b></td>
		</tr>
		<tr>
		<td><span class = summary_main>PAYMENT METHOD </span></td>
		<td class = booked_colon> : </td>
		<td id = payment>" . $payment . "</td>
		</tr>
		<tr>
		<td><span class = summary_main>WAYBILL NUMBER </span></td>
		<td class = booked_colon> : </td>
		<td id = payment>" . $waybill . "</td>
		</tr>
		</table><br><br><br><br><br><br>
		Thank you for using ATMLogistics. Please call <br>
		<a href=tel:08103290865>08103290865</a> <br>
		or send a mail to: <br>
		<a href=mailto:customercare@atmlogistic.com>customercare@atmlogistic.com</a> 		
		for more info or inquiries.<br>
		Thank you for choosing <b>ATM Logistics</b>";
		
		
		$mail->send();
		
		echo 'success.html';
		
		
	}
}


?>