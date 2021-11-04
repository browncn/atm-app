<?php 

session_set_cookie_params(['SameSite' => 'None', 'Secure' => true]); session_start();

//resolve departure and destination

if(isset($_POST['depaget'])){
	include '../conn/conn.php';
	
	
	echo '<option value = "">--select departure location-- </option>';
	$depalist = "SELECT * FROM `branches`";
	$rdepaget = $conn->query($depalist);
	while ($rodepaget = mysqli_fetch_assoc($rdepaget)){
		$depa = $rodepaget['state'] . ' - ' . $rodepaget['city'];
		$depa1 = strtoupper($depa);
		$depaid = $rodepaget['id'];
		echo '<option value="' . $depa . '">' . $depa1 . '</option>';
	}
}
if(isset($_POST['destget'])){
	include '../conn/conn.php';
	
	$dest = $_POST['destget'];
	$dest = explode(' - ', $dest);
	
	$state = $dest[0];	
	
	$destlist = "SELECT * FROM `branches` WHERE `state` != '$state'";
	$rdestget = $conn->query($destlist);
	while ($rodestget = mysqli_fetch_assoc($rdestget)){
		$dest = $rodestget['state'] . ' - ' . $rodestget['city'];
		$dest1 = strtoupper($dest);
		$destid = $rodestget['id'];
		echo '<option value="' . $dest . '">' . $dest1 . '</option>';
	}
}
//resolve date and time

if(isset($_POST['bt_search'])){
	include '../conn/conn.php';
	
	$place1 = $_POST['bt_dep'];
	$place2 = $_POST['bt_dest'];
	$pass = $_POST['bt_pass'];
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
						$time = date('H', $ttime);
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
								$_SESSION['place1'] = $place1;
								$_SESSION['place2'] = $place2;
								$_SESSION['trip'] = $trip;
								$_SESSION['dd'] = $dd;
								$_SESSION['dt'] = $dt;
								$_SESSION['rd'] = $rd;
								$_SESSION['rt'] = $rt;
								$_SESSION['pass'] = $pass;
								echo 'bt_bus_sel.html';
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
				$time = date('H', $ttime);
				$dtime = strtotime("$dt");
				$datetime = date('Y-m-d H:i:s', strtotime("$today $time"));
				$ddatetime = date('Y-m-d H:i:s', strtotime("$dd $dt"));
				$utime = strtotime($datetime);
				$dutime = strtotime($ddatetime);
				if($utime > $dutime){
					echo 'departure time invalid. please check';
				}else{
					$_SESSION['place1'] = $place1;
					$_SESSION['place2'] = $place2;
					$_SESSION['trip'] = $trip;
					$_SESSION['dd'] = $dd;
					$_SESSION['dt'] = $dt;
					$_SESSION['pass'] = $pass;
					echo 'bt_bus_sel.html';
					
				}
				
			}
		}
	}
	
}else{
	echo '<script>window.location.href="../index.html"</script>';
}



?>