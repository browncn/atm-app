<?php 
session_set_cookie_params(['SameSite' => 'None', 'Secure' => true]); session_start();

if(isset($_SESSION['id'])){
	include '../conn/conn.php';
	$id = $_SESSION['id'];
	$uget = "SELECT * FROM `users` WHERE `id` = $id";
	$ures = $conn->query($uget);
	$urow = mysqli_fetch_assoc($ures);
	$uname = $urow['lname'] . ' ' . $urow['fname'];
	$uname = strtoupper($uname);
	$user = $uname;
}


if(isset($_POST['trans'])){
	include '../conn/conn.php';
	$ref = $_POST['ref'];
	$tquery = "SELECT * FROM `user_booking` WHERE `ref` = '$ref'";
	$t_res = $conn->query($tquery);
	$t_row = mysqli_fetch_assoc($t_res);
	$date = $t_row['date'];
	$time = $t_row['time'];
	$r_date = $t_row['r_date'];
	$r_time = $t_row['r_time'];
	$journey = $t_row['journey'];
	$trip = $t_row['trip_type'];
	$vehicle = $t_row['vehicle'];
	$pass = $t_row['pass'];
	$seat_array = $t_row['seats'];
	$r_seat_array = $t_row['r_seats'];
	$total_price = $t_row['t_price'];
	$ref = $t_row['ref'];
	$booked_date = $t_row['booked_date'];
	
	echo '
		<table class = "booked_info">
		<tr>
		<th CLASS = "booked_route" colspan = 3><p> ' . $journey . ' </p></th>
		</tr>
		<tr>
		<td><span class = "summary_main">NAME </span></td>
		<td class = "booked_colon"> : </td>
		<td><span class = "booked_data">' . $user . '</span></td>
		</tr>
		<tr>
		
		</tr>
		<tr>
		<td><span class = "summary_main">VEHICLE </span></td>
		<td class = "booked_colon"> : </td>
		<td>' . $vehicle . '</td>
		</tr>
		<tr>
		<td><span class = "summary_main">SEAT(S) </span></td>
		<td class = "booked_colon"> : </td>
		<td>' . $seat_array . '</td>
		</tr>';
	
	if($trip == 'ROUND TRIP'){
		echo '
			<tr>
			<td><span class = "summary_main">RETURN SEAT NOS </span></td>
			<td class = "booked_colon"> : </td>
			<td>' . $r_seat_array . '</td>
			</tr>';
	}
	
	echo '
		<tr>
		<td><span class = "summary_main">TRIP TYPE </span></td>
		<td class = "booked_colon"> : </td>
		<td>' . $trip . '</td>
		</tr>
		<tr>
		<td><span class = "summary_main">DEPARTURE </span></td>
		<td class = "booked_colon"> : </td>
		<td><span class = "booked_data">' . $date . ', </span><span class = "booked_data">' . $time . ' AM</span></td>
		</tr>';
	
	if($trip == 'ROUND TRIP'){
		echo '<tr>
		<td><span class = "summary_main">RETURN </span></td>
		<td class = "booked_colon"> : </td>
		<td><span class = "booked_data">' . $r_date . ', </span><span class = "booked_data">' . $r_time . ' AM</span></td>
		</tr>';
	}
	echo '
		<tr>
		<td><span class = "summary_main">PRICE </span></td>
		<td class = "booked_colon"> : </td>
		<td>' . $total_price . '</td>
		</tr>
		<tr>
		<td><span class = "summary_main">REF NO. </span></td>
		<td class = "booked_colon"> : </td>
		<td>' . $ref . '</td>
		</tr>
				
		</table>
		<div class = "search_button r_search bottom">
		<a href = "history.html"><button type = "submit" id = "summary_cont" value = "summary_cont" class = "">go back</button></a>
		</div>
		';
}



