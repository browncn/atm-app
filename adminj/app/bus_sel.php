<?php 

session_set_cookie_params(['SameSite' => 'None', 'Secure' => true]); session_start();

//get sessions and check reservations

$place1 = '';
$place2 = '';
$trip = '';
$dd = '';
$dt = '';
$rd = '';
$rt = '';
$pass = '';
$state1 = '';
$state2 = '';
$city1 = '';
$city2 = '';





if(isset($_POST['summary'])){
	include '../conn/conn.php';
	

	$distance = (int)$_SESSION['totdistance'];
	$total_time = $_SESSION['ETA'];

	
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
		$distance = $distance * 2;
	}else{
		$tripx = 'one way';
	}
	
	
	
	echo '<p>' . strtoupper($place1) . ' - ' . strtoupper($place2) . '<br>';
	echo 'TOTAL DISTANCE : ' . $distance . '<span> KM</span><br>';
	echo 'TRIP TYPE : ' . strtoupper($tripx) . '<br>';
	echo 'APPROXIMATE TOTAL TIME : ' . $total_time . '</p>';
	
}

if(isset($_POST['err'])){
	include '../conn/conn.php';
	
	$distance = (int)$_SESSION['totdistance'];
	$total_time = $_SESSION['ETA'];
	
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
		$distance = $distance * 2;
	}else{
		$tripx = 'one way';
	}
	

	
	$dep_date = '';
	$ret_date = '';
	$available = 'false';
	$booked_cars = 0;
	
	echo '<form>';
	//check if vehicle plies that route and seats available
	$car_check = "SELECT * FROM `c_rides`";
	//echo $car_check;
	$car_res = $conn->query($car_check);
	if(mysqli_num_rows($car_res) == 0){
		echo '<p class = "bus_error">NO VEHICLES AVAILABLE AT THE MOMENT. PLEASE CONTACT OUR OFFICE </p>';
	}else{
		//if yes
		while($car_row = mysqli_fetch_assoc($car_res)){
			$vid = $car_row['id'];
			$vehicle = $car_row['vehicle'];
			$class = $car_row['class'];
			$qty = $car_row['seats'];
			$seats = $car_row['seats'];
			$price = (int)$car_row['ppk'];
			if($trip == 'round'){
				$price = $price * 2;
			}
			$total_price = $price * $distance;
			
						$available = 'true';
						echo '<div class = "white_section carselect">
						<div class = "inner_white_section row">
							<div class = "vehicle p10">
								<div><span>' . $vehicle . ' ' . $class . '</span></div>
								<img src = "app/images/c_rides/' . $vid . '/' . $vehicle . '1.png">
							</div>
							<div class = "info_price p10">
								<div id = cpamount><span>' . $price . '</span></div>
								<div class = "amount" id = "camount"><p>'  . $total_price . '</p></div>
							</div>
							<div class = "select p10">
								<div><span>seats</span></div>
								<div class = "qty" id = "cqty">
									<span>x ' . $seats . '</span>
								</div>
							</div>
							<div class = "checkbox p10">
								<input type = "radio" name = "car_sel" id = "car_sel" value =' . $vid . ' onchange = "car_sel_get(' . $vid . ')">
							</div>
							</div>
						</div>';
						$booked_cars = $booked_cars +1;
			}		
		

	if($available == 'true'){
		echo '<div id = "sel"></div>';
		echo '<div class = "search_button r_search">
			<button type = "submit" id = "bus_sel_continue" value = "bus_sel_continue" class = "" onclick = "return false" onmousedown = "bus_sel_cont()">CONTINUE</button>
			</div>';
	}else{
		echo '<p>NO VEHICLE AVAILABLE ON THIS DATE FOR THE AMOUNT OF PASSENGERS. PLEASE CHANGE</p>';
	}
	
	echo '</form>';
	}
}

	

if(isset($_POST['cont'])){
	$_SESSION['vid'] = $_POST['car_sel'];
	echo 'c_summary.html';
}



?>