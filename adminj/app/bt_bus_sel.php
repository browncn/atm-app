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
	$pass = (int)$_SESSION['pass'];
	if($trip == 'round'){
		$tripx = 'round trip';
	}else{
		$tripx = 'one way';
	}
	
	$placex = explode(' - ', $place1);
	$state1 = $placex[0];
	$city1 = $placex[1];
	
	$placex = explode(' - ', $place2);
	$state2 = $placex[0];
	$city2 = $placex[1];
	
	echo '<p>' . strtoupper($state1) . ' - ' . strtoupper($state2) . '<br>';
	echo 'PASSENGERS : ' . $pass . '<br>';
	echo 'TRIP TYPE : ' . strtoupper($tripx) . '</p>';
	
}

if(isset($_POST['err'])){
	include '../conn/conn.php';
	
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
	$pass = (int)$_SESSION['pass'];
	if($trip == 'round'){
		$tripx = 'round trip';
	}else{
		$tripx = 'one way';
	}
	
	$placex = explode(' - ', $place1);
	$state1 = $placex[0];
	$city1 = $placex[1];
	
	$placex = explode(' - ', $place2);
	$state2 = $placex[0];
	$city2 = $placex[1];
	
	$route = $city1 . ' - ' . $city2;
	
	$dep_date = '';
	$ret_date = '';
	$available = 'false';
	$booked_cars = 0;
	
	echo '<form>';
	//check if vehicle plies that route and seats available
	$car_check = "SELECT * FROM `rides` WHERE `route` = '$route' AND `seats` >= $pass";
	//echo $car_check;
	$car_res = $conn->query($car_check);
	if(mysqli_num_rows($car_res) == 0){
		echo '<p class = "bus_error">NO VEHICLES ARE PLYING THAT ROUTE AT THE MOMENT. PLEASE CONTACT OUR OFFICE </p>';
	}else{
		//if yes
		while($car_row = mysqli_fetch_assoc($car_res)){
			$vid = $car_row['id'];
			$vehicle = $car_row['vehicle'];
			$class = $car_row['class'];
			$class = $car_row['class'];
			$qty = $car_row['seats'];
			$seats = $car_row['seats'];
			$route = $car_row['route'];
			$price = (int)$car_row['price'];
			if($trip == 'round'){
				$price = $price * 2;
			}
			$total_price = $price * $pass;
			
			//check if vehicle available for selected date
			$bt_check = "SELECT * FROM `bt_booking` WHERE `dep` = '$place1' AND `ret` = '$place2' AND `date` = '$dd' AND `time` = '$dt' AND `vehicle` = '$vehicle'";
			//echo $bt_check;
			$bt_res = $conn->query($bt_check);
			if(mysqli_num_rows($bt_res) == 0){
				//if yes, check if vehicle is available on return trip for return trip
				if($trip == 'round'){
					$bt_check = "SELECT * FROM `bt_booking` WHERE `dep` = '$place2' AND `ret` = '$place1' AND `date` = '$rd' AND `time` = '$rt' AND `vehicle` = '$vehicle'";
					$bt_res = $conn->query($bt_check);
					if(mysqli_num_rows($bt_res) == 0){
						//if available
						$available = 'true';
						echo '<div class = "white_section carselect">
						<div class = "inner_white_section row">
							<div class = "vehicle p10">
								<div><span>' . $vehicle . ' ' . $class . '</span></div>
								<img src = "app/images/rides/' . $vid . '/' . $vehicle . '1.png">
							</div>
							<div class = "info_price p10">
								<div id = cpamount><span>' . $price . '</span></div>
								<div class = "amount" id = "camount"><p>'  . $total_price . '</p></div>
							</div>
							<div class = "select p10">
								<div><span>x1</span></div>
								<div class = "qty" id = "cqty">
									<span>x ' . $pass . '</span>
								</div>
							</div>
							<div class = "checkbox p10">
								<input type = "radio" name = "car_sel" id = "car_sel" value =' . $vid . ' onchange = "car_sel_get(' . $vid . ')">
							</div>
							</div>
						</div>';
						$booked_cars = $booked_cars +1;
					}else{
						$bt_row = mysqli_fetch_assoc($bt_res);
						if(($qty - $bt_row['qty']) < $pass){
							//if vehicle and seats not available
							
						}else{
							//if vehicle and seats available
							$available = 'true';
							echo '<div class = "white_section carselect">
						<div class = "inner_white_section row">
							<div class = "vehicle p10">
								<div><span>' . $vehicle . ' ' . $class . '</span></div>
								<img src = "app/images/rides/' . $vid . '/' . $vehicle . '1.png">
							</div>
							<div class = "info_price p10">
								<div id = cpamount><span>' . $price . '</span></div>
								<div class = "amount" id = "camount"><p>'  . $total_price . '</p></div>
							</div>
							<div class = "select p10">
								<div><span>x1</span></div>
								<div class = "qty" id = "cqty">
									<span>x ' . $pass . '</span>
								</div>
							</div>
							<div class = "checkbox p10">
								<input type = "radio" name = "car_sel" id = "car_sel" value =' . $vid . ' onchange = "car_sel_get(' . $vid . ')">
							</div>
							</div>
						</div>';
							$booked_cars = $booked_cars +1;
						}
					}
				}else{
					$available = 'true';
					echo '<div class = "white_section carselect">
						<div class = "inner_white_section row">
							<div class = "vehicle p10">
								<div><span>' . $vehicle . ' ' . $class . '</span></div>
								<img src = "app/images/rides/' . $vid . '/' . $vehicle . '1.png">
							</div>
							<div class = "info_price p10">
								<div id = cpamount><span>' . $price . '</span></div>
								<div class = "amount" id = "camount"><p>'  . $total_price . '</p></div>
							</div>
							<div class = "select p10">
								<div><span>x1</span></div>
								<div class = "qty" id = "cqty">
									<span>x ' . $pass . '</span>
								</div>
							</div>
							<div class = "checkbox p10">
								<input type = "radio" name = "car_sel" id ="' . $vid . '" value =' . $vid . ' onchange = "car_sel_get(' . $vid . ')">
							</div>
							</div>
						</div>';
					
					$booked_cars = $booked_cars +1;
				}
			}else{
				$bt_row = mysqli_fetch_assoc($bt_res);
				if(($qty - $bt_row['qty']) < $pass){
					
				}else{
					if($trip == 'round'){
						$bt_check = "SELECT * FROM `bt_booking` WHERE `dep` = '$place2' AND `ret` = '$place1' AND `date` = '$rd' AND `time` = '$rt' AND `vehicle` = '$vehicle'";
						$bt_res = $conn->query($bt_check);
						if(mysqli_num_rows($bt_res) == 0){
							$available = 'true';
							echo '<div class = "white_section carselect">
						<div class = "inner_white_section row">
							<div class = "vehicle p10">
								<div><span>' . $vehicle . ' ' . $class . '</span></div>
								<img src = "app/images/rides/' . $vid . '/' . $vehicle . '1.png">
							</div>
							<div class = "info_price p10">
								<div id = cpamount><span>' . $price . '</span></div>
								<div class = "amount" id = "camount"><p>'  . $total_price . '</p></div>
							</div>
							<div class = "select p10">
								<div><span>x1</span></div>
								<div class = "qty" id = "cqty">
									<span>x ' . $pass . '</span>
								</div>
							</div>
							<div class = "checkbox p10">
								<input type = "radio" name = "car_sel" id = "car_sel" value =' . $vid . ' onchange = "car_sel_get(' . $vid . ')">
							</div>
							</div>
						</div>';
							$booked_cars = $booked_cars +1;
						}else{
							$bt_row = mysqli_fetch_assoc($bt_res);
							if(($qty - $bt_row['qty']) < $pass){
								
							}else{
								$available = 'true';
								echo '<div class = "white_section carselect">
						<div class = "inner_white_section row">
							<div class = "vehicle p10">
								<div><span>' . $vehicle . ' ' . $class . '</span></div>
								<img src = "app/images/rides/' . $vid . '/' . $vehicle . '1.png">
							</div>
							<div class = "info_price p10">
								<div id = cpamount><span>' . $price . '</span></div>
								<div class = "amount" id = "camount"><p>'  . $total_price . '</p></div>
							</div>
							<div class = "select p10">
								<div><span>x1</span></div>
								<div class = "qty" id = "cqty">
									<span>x ' . $pass . '</span>
								</div>
							</div>
							<div class = "checkbox p10">
								<input type = "radio" name = "car_sel" id = "car_sel" value =' . $vid . ' onchange = "car_sel_get(' . $vid . ')">
							</div>
							</div>
						</div>';
								$booked_cars = $booked_cars +1;
							}
						}
					}else{
						$available = 'true';
						echo '<div class = "white_section carselect">
						<div class = "inner_white_section row">
							<div class = "vehicle p10">
								<div><span>' . $vehicle . ' ' . $class . '</span></div>
								<img src = "app/images/rides/' . $vid . '/' . $vehicle . '1.png">
							</div>
							<div class = "info_price p10">
								<div id = cpamount><span>' . $vid . '</span></div>
								<div class = "amount" id = "camount"><p>'  . $total_price . '</p></div>
							</div>
							<div class = "select p10">
								<div><span>x1</span></div>
								<div class = "qty" id = "cqty">
									<span>x ' . $pass . '</span>
								</div>
							</div>
							<div class = "checkbox p10">
								<input type = "radio" name = "car_sel" id = "car_sel" value =' . $vid . ' onchange = "car_sel_get(' . $vid . ')">
							</div>
							</div>
						</div>';
						$booked_cars = $booked_cars +1;
					}
				}
			}		
		}
	}
	if($available == 'true'){
		echo '<div id = "sel"></div>';
		echo '<div class = "search_button r_search">
			<button type = "submit" id = "bt_bus_sel_continue" value = "bt_bus_sel_continue" class = "" onclick = "return false" onmousedown = "bt_bus_sel_cont()">CONTINUE</button>
			</div>';
	}else{
		echo '<p>NO VEHICLE AVAILABLE ON THIS DATE FOR THE AMOUNT OF PASSENGERS. PLEASE CHANGE</p>';
	}
	
	echo '</form>';
	
}
if(isset($_POST['cont'])){
	$_SESSION['vid'] = $_POST['car_sel'];
	echo 'seat_sel.html';
}



?>