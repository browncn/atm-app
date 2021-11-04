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
		$uid = $_SESSION['did'];
		$deliv_status = 'pending';
		
		
		$date = date('ymdHis');
		$waybill = rand(0000,9999) . $date;
		
		
		
		
		
		
		$query = "INSERT INTO `deliveries` (`uid`, `sender_name`, `sender_addr`, `sender_num`, `sender_email`, `sender_state`, `rec_name`, `rec_addr`, `rec_num`, `rec_state`, `pkg_value`, `pkg_qty`, `pkg_weight`, `pkg_descr`, `pref_trans`, `deliv_type`,`deliv_status`, `waybill`, `amount`,`pay_method`, `added`)
		VALUES ($uid, '$sender_name', '$sender_addr', '$sender_num', '$sender_email', '$sender_state', '$rec_name', '$rec_addr', '$rec_num', '$rec_state', $pkg_value, $pkg_qty, $pkg_weight, '$pkg_descr', '$pref_trans', '$deliv_type','$deliv_status', '$waybill', $amount, '$pay_method', NOW())";
		
		$conn->query($query);
		
		
		echo 'success.html';
		
		
	}
}


?>