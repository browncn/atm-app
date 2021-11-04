<?php 
session_set_cookie_params(['SameSite' => 'None', 'Secure' => true]); session_start();

if(isset($_SESSION['id'])){
	include '../conn/conn.php';
	$id = $_SESSION['id'];
	$uget = "SELECT * FROM `users` WHERE `id` = $id";
	$ures = $conn->query($uget);
	$urow = mysqli_fetch_assoc($ures);
		$uname = $urow['lname'] . ' ' . $urow['fname'];
		$user = strtoupper($uname);
	
}
if(isset($_SESSION['vid'])){
	
	if(isset($_POST['summary'])){
		
	
	include '../conn/conn.php';
	
	
	
	$vid = (int)$_SESSION['vid'];
	$pass = (int) $_SESSION['pass'];
	$seat_array = $_SESSION['seat_array'];
	$place1 = $_SESSION['place1'];
	$place2 = $_SESSION['place2'];
	$trip = $_SESSION['trip'];
	$dd = $_SESSION['dd'];
	$dt = $_SESSION['dt'];
	
	if(isset($_SESSION['rd'])){
		$rd = $_SESSION['rd'];
	}
	if(isset($_SESSION['rt'])){
		$rt = $_SESSION['rt'];
	}
	if($trip == 'round'){
		$tripx = 'ROUND TRIP';
		$r_seat_array = $_SESSION['r_seat_array'];
	}else{
		$tripx = 'ONE WAY';
	}
	$ref = $id . $vid . $pass . date('dmyhi');
	
	
	
	//get vehicl info
	$vquery = "SELECT * FROM `rides` WHERE `id` = $vid";
	$vres = $conn->query($vquery);
	$vrow = mysqli_fetch_assoc($vres);
	$vehicle = strtoupper($vrow['vehicle']);
	$class = $vrow['class'];
	$price = (int) $vrow['price'];
	if($trip == 'round'){
		$price = $price * 2;
		$journey = strtoupper($place1 . ' to ' . $place2 . ' to ' . $place1);
	}else{
		$journey = strtoupper($place1 . ' to ' . $place2);
	}
	$total_price = $price *  $pass;
	
	$_SESSION['price'] = $price;
	$_SESSION['total_price'] = $total_price;
	$_SESSION['journey'] = $journey;
	$_SESSION['vehicle'] = $vehicle;
	$_SESSION['ref'] = $ref;
	
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
		<td><span class = "summary_main">PASSENGERS </span></td>
		<td class = "booked_colon"> : </td>
		<td>' . $pass . '</td>
		</tr>
		<tr>
		<td><span class = "summary_main">VEHICLE TYPE </span></td>
		<td class = "booked_colon"> : </td>
		<td>' . $vehicle . ' ' . $class . '</td>
		</tr>
		<tr>
		<td><span class = "summary_main">SEAT NOS </span></td>
		<td class = "booked_colon"> : </td>
		<td>' . $seat_array . '</td>
		</tr>';
	
	if($trip == 'round'){
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
		<td>' . $tripx . '</td>
		</tr>
		<tr>
		<td><span class = "summary_main">DEPARTURE </span></td>
		<td class = "booked_colon"> : </td>
		<td><span class = "booked_data">' . $dd . ', </span><span class = "booked_data">' . $dt . ' AM</span></td>
		</tr>';
	
	if($trip == 'round'){
		echo '<tr>
		<td><span class = "summary_main">RETURN </span></td>
		<td class = "booked_colon"> : </td>
		<td><span class = "booked_data">' . $rd . ', </span><span class = "booked_data">' . $rt . ' AM</span></td>
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
		<button type = "submit" id = "summary_cont" value = "summary_cont" class = "" onclick = "return false" onmousedown = "summary_cont()">PROCESS PAYMENT</button>
		</div>
		';
	}
	
	if(isset($_POST['summary_cont'])){
		include '../conn/conn.php';
		
		$id = $_SESSION['id'];
		$vid = (int)$_SESSION['vid'];
		$pass = (int) $_SESSION['pass'];
		$qty = $pass;
		$r_qty = $pass;
		$seat_array = $_SESSION['seat_array'];
		$seat_array2 = $_SESSION['seat_array'];
		$place1 = $_SESSION['place1'];
		$place2 = $_SESSION['place2'];
		$trip = $_SESSION['trip'];
		$dd = $_SESSION['dd'];
		$dt = $_SESSION['dt'];
		
		if(isset($_SESSION['rd'])){
			$rd = $_SESSION['rd'];
		}
		if(isset($_SESSION['rt'])){
			$rt = $_SESSION['rt'];
		}
		if($trip == 'round'){
			$tripx = 'ROUND TRIP TICKET';
			$r_seat_array = $_SESSION['r_seat_array'];
			$r_seat_array2 = $_SESSION['r_seat_array'];
			if(isset($_SESSION['r_seat_check'])){
				$r_seat_check = $_SESSION['r_seat_check'];
				$r_seat_qty = $_SESSION['r_seat_qty'];
				$r_qty = $r_seat_qty + $pass;
				$r_seat_array2 = $r_seat_check . $r_seat_array;
				$r_bid = $_SESSION['r_bid'];
			}
		}else{
			$tripx = 'ONE WAY TICKET';
		}
		
		$price = $_SESSION['price'];
		$total_price = $_SESSION['total_price'];
		$journey = $_SESSION['journey'];
		$vehicle = $_SESSION['vehicle'];
		$ref = $_SESSION['ref'];
		if(isset($_SESSION['seat_check'])){
			$seat_check = $_SESSION['seat_check'];
			$seat_qty = $_SESSION['seat_qty'];
			$qty = $seat_qty + $pass;
			$seat_array2 = $seat_check . $seat_array;
			$bid = $_SESSION['bid'];
		}
		
		$user_booking_add = "INSERT INTO `user_booking` (`uid`, `date`, `time`, `journey`, `trip_type`, `vehicle`, `pass`, `seats`, `t_price`, `ref`, `booked_date`)
									VALUES ('$id', '$dd', '$dt', '$journey', '$tripx', '$vehicle', '$pass', '$seat_array', '$total_price', '$ref', NOW())";
		
		$bt_add = "INSERT INTO `bt_booking` (`date`, `time`, `dep`, `ret`, `vehicle`, `booked`, `qty`)
		VALUES ('$dd', '$dt', '$place1', '$place2', '$vehicle', '$seat_array2', $qty)";
		
		if($trip == 'round'){
			$bt_add_return = "INSERT INTO `bt_booking` (`date`, `time`, `dep`, `ret`, `vehicle`, `booked`, `qty`)
			VALUES ('$rd', '$rt', '$place2', '$place1', '$vehicle', '$r_seat_array2', $r_qty)";
			
			$user_booking_add = "INSERT INTO `user_booking` (`id`, `date`, `time`, `r_date`, `r_time`, `journey`, `trip_type`, `vehicle`, `pass`, `seats`, `r_seats`, `t_price`, `ref`, `booked_date`)
			VALUES ('$id', '$dd', '$dt', '$rd', '$rt', '$journey', '$tripx', '$vehicle', '$pass', '$seat_array', '$r_seat_array', '$total_price', '$ref', NOW())";
			
			if(isset($_SESSION['r_seat_check'])){
				$bt_add_return = "UPDATE `bt_booking` SET `booked` = '$r_seat_array2', `qty` = $r_qty WHERE `id` = $r_bid";
			}
			
			$conn->query($bt_add_return);
			
			//echo $bt_add_return;
		}
		
		if(isset($_SESSION['seat_check'])){
			$bt_add = "UPDATE `bt_booking` SET `booked` = '$seat_array2', `qty` = $qty WHERE `id` = $bid";
		}
			
		
		$conn->query($user_booking_add);
		$conn->query($bt_add);
		
		//echo $bt_add;
		//echo $user_booking_add;
		if(isset($_SESSION['seat_check'])){
			unset($_SESSION['seat_check']);
		}
		if(isset($_SESSION['r_seat_check'])){
			unset($_SESSION['r_seat_check']);
		}
		
		echo 'success.html';	
		
		
	}
}