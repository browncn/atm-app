<?php 
session_set_cookie_params(['SameSite' => 'None', 'Secure' => true]); session_start();
$seats = 'a';
$pass = '';
if(isset($_SESSION['vid'])){
	$seats = '';
	$pass = '';
	
		include '../conn/conn.php';
		
		$vid = $_SESSION['vid'];
		$vid = (int) $vid;
		$pass = (int) $_SESSION['pass'];
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
			$tripx = 'round trip';
		}else{
			$tripx = 'one way';
		}
		
		//get vehicle info
		$vquery = "SELECT * FROM `rides` WHERE `id` = $vid";
		$vres = $conn->query($vquery);
		$vrow = mysqli_fetch_assoc($vres);
		$vehicle = $vrow['vehicle'];
		$seats = $vrow['seats'];
		
		//get booked seats
		$check_array = '';
		$seat_check = "SELECT * FROM `bt_booking` WHERE `dep` = '$place1' AND `ret` = '$place2' AND `date` = '$dd' AND `time` = '$dt' AND `vehicle` = '$vehicle'";
		//echo $seat_check;
		$seat_res = $conn->query($seat_check);
		if(mysqli_num_rows($seat_res) !== 0){
			$seat_row = mysqli_fetch_assoc($seat_res);
			$seat_check = $seat_row['booked'];
			$_SESSION['seat_qty'] = (int)$seat_row['qty'];
			$_SESSION['bid'] = $seat_row['id'];
			$_SESSION['seat_check'] = $seat_check;
		}
		
		
		if(isset($_POST['vidget'])){
		if($vehicle == 'camry'){
			echo '<div class = "v1">
			<div class = "v2">
				<img class = "" src = "app/images/rides/' . $vid . '/camry290.png" width = 100%>
					
					<div class = "seats">
						<div class = "row0"></div>
						<div class = "row row1">
							<div class = "seat0" id = "0"></div>
							<div class = "seatmid" id = "mid"></div>
							<div id = "1" class = "seat1';	if(strstr($seat_check, ',1,') == true){echo ' seat_selected"';}else{echo '" onclick = "seatsel(this.id)"';} echo '></div>
						</div>
						<div class = "row row2">
							<div id = "2" class = "seat0';	if(strstr($seat_check, ',2,') == true){echo ' seat_selected"';}else{echo '" onclick = "seatsel(this.id)"';} echo '></div>
							<div class = "seatmid" id = "mid"></div>
							<div id = "3" class = "seat1';	if(strstr($seat_check, ',3,') == true){echo ' seat_selected"';}else{echo '" onclick = "seatsel(this.id)"';} echo '></div>
						</div>
					</div>
			</div>
			</div>';
			
		}
		if($vehicle == 'sienna'){
			echo '<div class = "sv1">
			<div class = "sv2">
				<img class = "" src = "app/images/rides/' . $vid . '/sienna290.png" width = 100%>
					
					<div class = "sseats">
						<div class = "srow0"></div>
						<div class = "row srow1">
							<div class = "sseat0" id = "0"></div>
							<div class = "sseatmid" id = "mid"></div>
							<div id = "1" class = "sseat1';	if(strstr($seat_check, ',1,') == true){echo ' seat_selected"';}else{echo '" onclick = "seatsel(this.id)"';} echo '></div>
						</div>
						<div class = "row srow2">
							<div id = "2" class = "sseat0';	if(strstr($seat_check, ',2,') == true){echo ' seat_selected"';}else{echo '" onclick = "seatsel(this.id)"';} echo '></div>
							<div class = "sseatmid" id = "mid"></div>
							<div id = "3" class = "sseat1';	if(strstr($seat_check, ',3,') == true){echo ' seat_selected"';}else{echo '" onclick = "seatsel(this.id)"';} echo '></div>
						</div>
						<div class = "row srow3">
							<div id = "4" class = "sseat0';	if(strstr($seat_check, ',4,') == true){echo ' seat_selected"';}else{echo '" onclick = "seatsel(this.id)"';} echo '></div>
							<div class = "sseatmid" id = "mid"></div>
							<div id = "5" class = "sseat1';	if(strstr($seat_check, ',5,') == true){echo ' seat_selected"';}else{echo '" onclick = "seatsel(this.id)"';} echo '></div>
						</div>
					</div>
			</div>
			</div>';
			
		}
				
	}
	
}

if(isset($_POST['seats'])){
	echo $seats;
}
if(isset($_POST['pass'])){
	echo $pass;
}

if(isset($_POST['continue'])){
	$seat_array = $_POST['seat_array'];
	$_SESSION['seat_array'] = ',' . $seat_array . ',';
	if ($trip == 'round'){
		echo 'r_seat_sel.html';
	}else{
		echo 'summary.html';
	}
}




?>