<?php 
session_set_cookie_params(['SameSite' => 'None', 'Secure' => true]); session_start();

if(isset($_POST['pac_input'])){
	$place1 = $_POST['pac_input'];
	$place2 = $_POST['pac_input2'];
	$trip = $_POST['trip'];
	$dd = $_POST['dd'];
	$dt = $_POST['dt'];
	$rd = $_POST['rd'];
	$rt = $_POST['rt'];
	
	
	if($place1 == '' || $place2 == '' || $dd == '' || $dt == ''){
		echo 'please fill form correctly';		
	}else{
		if($trip == 'round'){
			if($rd == '' || $rt == ''){
				echo 'please enter return date and time';
			}else{
				$today = date('d-m-Y');
				$tdate = strtotime($today);
				$ddate = strtotime($dd);
				$rdate = strtotime($rd);
				if($tdate > $ddate){
					echo 'departure date invalid. please check';
				}else{
					if($tdate > $rdate){
						echo 'returning date invalid. please check';
					}else{
						$ttime = time();
						$time = date('H:i:s', $ttime);
						$dtime = strtotime("$dt");
						$datetime = date('Y-m-d H:i:s', strtotime("$today $time"));
						$ddatetime = date('Y-m-d H:i:s', strtotime("$dd $dt"));
						$utime = strtotime($datetime);
						$dutime = strtotime($ddatetime);
						if($utime > $dutime){
							echo 'departure time invalid. please check';
						}else{
							$rdatetime = date('Y-m-d H:i:s', strtotime("$rd $rt"));
							$rutime = strtotime($rdatetime);
							if($utime > $rutime || $dutime > $rutime){
								echo 'return time invalid. please check';
							}else{
								$origin = urlencode($place1); $destination = urlencode($place2);
								$api = file_get_contents("https://maps.googleapis.com/maps/api/distancematrix/json?units=metric&origins=".$origin."&destinations=".$destination."&key=AIzaSyDMxDTMmG1jzWglnweAtwnSogl7NsOeBx4");
								$data = json_decode($api);
								$distance = (int)$data->rows[0]->elements[0]->distance->text;
								$distance = round($distance);
								$total_time = $data->rows[0]->elements[0]->duration->text;
								
								$_SESSION['place1'] = $place1;
								$_SESSION['place2'] = $place2;
								$_SESSION['totdistance'] = $distance;
								$_SESSION['ETA'] = $total_time;
								$_SESSION['trip'] = $trip;
								$_SESSION['dd'] = $dd;
								$_SESSION['dt'] = $dt;
								$_SESSION['rd'] = $rd;
								$_SESSION['rt'] = $rt;
								echo 'bus_sel.html';
							}
						}
					}
						
				}
			}
		}else{
			$today = date('d-m-Y');
			$tdate = strtotime($today);
			$ddate = strtotime($dd);
			if($tdate > $ddate){
				echo 'departure date invalid. please check';
			}else{
				$ttime = time();
				$time = date('H:i:s', $ttime);
				$dtime = strtotime("$dt");
				$datetime = date('Y-m-d H:i:s', strtotime("$today $time"));
				$ddatetime = date('Y-m-d H:i:s', strtotime("$dd $dt"));
				$utime = strtotime($datetime);
				$dutime = strtotime($ddatetime);
				if($utime > $dutime){
					echo 'departure time invalid. please check';
				}else{
					$origin = urlencode($place1); $destination = urlencode($place2);
					$api = file_get_contents("https://maps.googleapis.com/maps/api/distancematrix/json?units=metric&origins=".$origin."&destinations=".$destination."&key=AIzaSyDMxDTMmG1jzWglnweAtwnSogl7NsOeBx4");
					$data = json_decode($api);
					$distance = (int)$data->rows[0]->elements[0]->distance->text;
					$total_time = $data->rows[0]->elements[0]->duration->text;
					$_SESSION['place1'] = $place1;
					$_SESSION['place2'] = $place2;
					$_SESSION['totdistance'] = $distance;
					$_SESSION['ETA'] = $total_time;
					$_SESSION['trip'] = $trip;
					$_SESSION['dd'] = $dd;
					$_SESSION['dt'] = $dt;
					echo 'bus_sel.html';
				}
				
			}
		}
	}
	
}

?>