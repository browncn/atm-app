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
	
	$distance = (int)$_SESSION['totdistance'];
	$total_time = $_SESSION['ETA'];
	
	
	$vid = (int)$_SESSION['vid'];
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
		
	}else{
		$tripx = 'ONE WAY';
	}
	$ref = $id . $vid . date('dmyhi');
	
	
	
	//get vehicl info
	$vquery = "SELECT * FROM `c_rides` WHERE `id` = $vid";
	$vres = $conn->query($vquery);
	$vrow = mysqli_fetch_assoc($vres);
	$vehicle = strtoupper($vrow['vehicle']);
	$class = $vrow['class'];
	$seats = $vrow['seats'];
	$price = (int) $vrow['ppk'];
	if($trip == 'round'){
		$journey = strtoupper($place1 . ' to ' . $place2 . ' to ' . $place1);
		$distance = $distance * 2;
	}else{
		$journey = strtoupper($place1 . ' to ' . $place2);
	}
	$total_price = $price *  $distance;
	
	$_SESSION['seats'] = $seats;
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
		<td>' . $seats . '</td>
		</tr>
		<tr>
		<td><span class = "summary_main">VEHICLE TYPE </span></td>
		<td class = "booked_colon"> : </td>
		<td>' . $vehicle . ' ' . $class . '</td>
		</tr>
		<tr>
		<td><span class = "summary_main">SEAT NOS </span></td>
		<td class = "booked_colon"> : </td>
		<td>' . $seats . '</td>
		</tr>';
	
	if($trip == 'round'){
		
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
		<td><span class = "summary_main">EST. TIME PER TRIP </span></td>
		<td class = "booked_colon"> : </td>
		<td>' . $total_time . '</td>
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
		
		$distance = (int)$_SESSION['totdistance'];
		$total_time = $_SESSION['ETA'];
		
		$id = $_SESSION['id'];
		$vid = (int)$_SESSION['vid'];
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
			$tripx = 'ROUND TRIP CHARTER';
		}else{
			$tripx = 'ONE WAY CHARTER';
		}
		
		$seats = $_SESSION['seats'];
		$price = $_SESSION['price'];
		$total_price = $_SESSION['total_price'];
		$journey = $_SESSION['journey'];
		$vehicle = $_SESSION['vehicle'];
		$ref = $_SESSION['ref'];
		
		$user_booking_add = "INSERT INTO `user_booking` (`uid`, `date`, `time`, `journey`, `trip_type`, `vehicle`, `seats`, `t_price`, `ref`, `booked_date`)
									VALUES ('$id', '$dd', '$dt', '$journey', '$tripx', '$vehicle', '$seats', '$total_price', '$ref', NOW())";
		
		$c_add = "INSERT INTO `c_booking` (`date`, `time`, `dep`, `ret`, `vehicle`)
		VALUES ('$dd', '$dt', '$place1', '$place2', '$vehicle')";
		
		if($trip == 'round'){
			$c_add_return = "INSERT INTO `c_booking` (`date`, `time`, `dep`, `ret`, `vehicle`)
			VALUES ('$rd', '$rt', '$place2', '$place1', '$vehicle')";
			
			$user_booking_add = "INSERT INTO `user_booking` (`uid`, `date`, `time`, `r_date`, `r_time`, `journey`, `trip_type`, `vehicle`, `seats`, `r_seats`, `t_price`, `ref`, `booked_date`)
			VALUES ('$id', '$dd', '$dt', '$rd', '$rt', '$journey', '$tripx', '$vehicle', '$seats', '$seats', '$total_price', '$ref', NOW())";
			
			
			$conn->query($c_add_return);
			
			//echo $user_booking_add;
			//echo $c_add_return;
		}
		
			
		
		$conn->query($user_booking_add);
		$conn->query($c_add);
		
		//echo $c_add;
		//echo $user_booking_add;
		
		echo 'success.html';	
		
		
	}
}