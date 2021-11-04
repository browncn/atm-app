<?php 
session_set_cookie_params(['SameSite' => 'None', 'Secure' => true]); session_start();


if(isset($_POST['con'])){
	include'../conn/conn.php';
	$state = '';
	$con = "SELECT * FROM `branches` ORDER BY `state` ASC";
	$con_res = $conn->query($con);
	while($con_row = mysqli_fetch_assoc($con_res)){
		if($state !== strtoupper($con_row['state'])){
			$state = strtoupper($con_row['state']);
			$city = $con_row['city'];
			$addr = $con_row['addr'];
			$email = $con_row['email'];
			$phone = $con_row['phone'];
			
			echo '<tr><th  style="color:#4b0082;"><br><br><b>' . $state . '</b><br></th></tr>' . 
			'<tr><td><span style="color:black;"><b>address: </b></span></td><td>' . $addr . '<br></td></tr>' . 
			'<tr><td><span style="color:black;"><b>city: </b></span></td><td>' . $city . '<br></td></tr>' . 
			'<tr><td><span style="color:black;"><b>email: </b></span></td><td><a href="mailto:' . $email . '">' . $email . '<a><br></td></tr>' . 
			'<tr><td><span style="color:black;"><b>phone: </b></span></td><td><a href="tel:' . $phone . '">' . $phone . '</a><br></td></tr>';
		}else{
			$city = $con_row['city'];
			$addr = $con_row['addr'];
			$email = $con_row['email'];
			$phone = $con_row['phone'];
			
			echo 	'<tr><td><br><span style="color:black;"><b>address: </b></span></td><td><br>' . $addr . '<br></td></tr>' .
					'<tr><td><span style="color:black;"><b>city: </b></span></td><td>' . $city . '<br></td></tr>' .
					'<tr><td><span style="color:black;"><b>email: </b></span></td><td><a href="mailto:' . $email . '">' . $email . '<a><br></td></tr>' .
					'<tr><td><span style="color:black;"><b>phone: </b></span></td><td><a href="tel:' . $phone . '">' . $phone . '</a><br></td></tr>';
		}
	}
	
}

