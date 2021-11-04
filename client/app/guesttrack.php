<?php
if(isset($_POST['guest_check'])){
	
	include '../conn/conn.php';
	$guest_check = $_POST['guest_check'];
	$uarray = '';
	$disp_info = 'not set';
	$c = '';
	
	$guests_get = "SELECT * FROM `deliveries` WHERE `waybill` = '$guest_check'";
	
	$guests_get_res = $conn->query($guests_get);
	
	if(mysqli_num_rows($guests_get_res) == 0){
		echo '<tr>
			<td>no deliveries found</td>
		</tr>';
	}else{
		while($uget_row = mysqli_fetch_assoc($guests_get_res)){
			$did = $uget_row['disp_id'];
			$check = "SELECT * FROM `users` WHERE `id` = $did";
			$check_res = $conn->query($check);
			if(mysqli_num_rows($check_res) !== 0 ){
				while($check_row = mysqli_fetch_assoc($check_res)){
					$name = $check_row['name'];
					$phone = $check_row['phone'];
					$disp_info = $name . '<br>' . $phone;
				}
				//echo $check;
			}
			$uarray =					
					'<div class = "div_main">
					<table class = "booked_info unitable m-auto">
					<tr>
					<th CLASS = "booked_route" colspan = 3><p></p></th>
					</tr>
					<tr class = "uni">
					<td><span class = "summary_main">ITEM DESCRIPTION</span></td>
					<td class = "booked_colon"> : </td>
					<td><span class = "booked_data" id = "pkg_descr">' . $uget_row['pkg_descr'] . '</span></td>
					</tr>
					<tr class = "uni">
					<td><span class = "summary_main">SENDER </span></td>
					<td class = "booked_colon"> : </td>
					<td id = "sender_name">' . $uget_row['sender_name'] . '<br>' . $uget_row['sender_addr'] . '<br>' . $uget_row['sender_num'] . '<br>' . $uget_row['sender_email'] . '</td>
					</tr>
					<tr class = "uni">
					<td><span class = "summary_main">RECIEVER</span></td>
					<td class = "booked_colon"> : </td>
					<td id = "rec_name">' . $uget_row['rec_name'] . '<br>' . $uget_row['rec_addr'] . '<br>' . $uget_row['rec_num'] . '<br>' . $uget_row['rec_state'] . '</td>
					</tr>
					<tr class = "uni">
					<td><span class = "summary_main">PREFERRED TRANSPORT</span></td>
					<td class = "booked_colon"> : </td>
					<td id = "pref_trans">' . $uget_row['pref_trans'] . '</td>
					</tr>
					<tr class = "uni">
					<td><span class = "summary_main">ITEM VALUE</span></td>
					<td class = "booked_colon"> : </td>
					<td id = "pkg_value">' . $uget_row['pkg_value'] . '</td>
					</tr>
					<tr class = "uni">
					<td><span class = "summary_main">ITEM QUANTITY</span></td>
					<td class = "booked_colon"> : </td>
					<td><span class = "booked_data" id = "pkg_qty">' . $uget_row['pkg_qty'] . '</span></td>
					</tr>
					<tr class = "uni">
					<td><span class = "summary_main">ITEM WEIGHT(kg)</span></td>
					<td class = "booked_colon"> : </td>
					<td id = "pkg_weight">' . $uget_row['pkg_weight'] . '</td>
					</tr>
					<tr class = "uni">
					<td><span class = "summary_main">DELIVERY TYPE</span></td>
					<td class = "booked_colon"> : </td>
					<td id = "deliv_type">' . $uget_row['deliv_type'] . '</td>
					</tr>
					<tr class = "uni">
					<td><span class = "summary_main">WAYBILL NO. </span></td>
					<td class = "booked_colon"> : </td>
					<td id = "waybill">' . $uget_row['waybill'] . '</td>
					</tr>
					<tr class = "uni">
					<td><span class = "summary_main">TOTAL AMOUNT PAYABLE </span></td>
					<td class = "booked_colon"> : </td>
					<td id = "amount">' . $uget_row['amount'] . '</td>
					</tr>
					<tr class = "uni">
					<td><span class = "summary_main">DISPATCH ASSIGNED </span></td>
					<td class = "booked_colon"> : </td>
					<td id = "disp_assign">' . $disp_info . '</td>
					</tr>
					<tr class = "uni">
					<td><span class = "summary_main">STATUS </span></td>
					<td class = "booked_colon"> : </td>
					<td id = "deliv_status">' . $uget_row['deliv_status']. '</td>
					</tr>
					<tr class = "uni">
					<td><span class = "summary_main">LAST UPDATE TIME </span></td>
					<td class = "booked_colon"> : </td>
					<td id = "update_time">' . $uget_row['update_time'] . '</td>
					</tr>
					</table>
					
					</div>';
		
		}
	}
	echo $uarray;
	
	
}
?>