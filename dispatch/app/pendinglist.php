<?php 
session_set_cookie_params(['SameSite' => 'None', 'Secure' => true]); session_start();


	include '../conn/conn.php';
	$c = '';
	$uid = $_SESSION['did'];
	
	$pendings_get = "SELECT * FROM `deliveries` WHERE `deliv_status` != 'delivered' AND `disp_id` = $uid ORDER BY `id` DESC";
	
	$pendings_get_res = $conn->query($pendings_get);
	
	if(mysqli_num_rows($pendings_get_res) == 0){
		echo '<tr>
			<td>no pending found</td>
		</tr>';
	}else{
		while ($pendings_get_row = mysqli_fetch_assoc($pendings_get_res)){
			if($pendings_get_row['deliv_status'] == 'pending'){
				$c = 'blue';
			}
			if($pendings_get_row['deliv_status'] == 'in transit'){
				$c = 'orange';
			}
			if($pendings_get_row['deliv_status'] == 'delivered'){
				$c = 'green';
			}
			if($pendings_get_row['deliv_status'] == 'failed'){
				$c = 'red';
			}
			if($pendings_get_row['deliv_status'] == 'canceled'){
				$c = 'red';
			}
			echo '<tr>
				<td>' . $pendings_get_row['pkg_descr'] . '</td>
				<td style="margin-right:20px;color:' . $c . ';padding-bottom:10px;padding-top:10px;">' . $pendings_get_row['deliv_status'] . '</td>
				<td><a href = "pendingprofile.html?u=' . urlencode($pendings_get_row['id']) . '">view</a></td>
			</tr>';
		}
	}

	



?>