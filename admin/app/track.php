<?php 
session_set_cookie_params(['SameSite' => 'None', 'Secure' => true]); session_start();

if(isset($_POST['user_check'])){
	include '../conn/conn.php';
	$user_check = $_POST['user_check'];
	$c = '';
	
	$users_get = "SELECT * FROM `deliveries` WHERE `waybill` LIKE '%$user_check%' ORDER BY `rec_state` DESC";
	
	$users_get_res = $conn->query($users_get);
	
	if(mysqli_num_rows($users_get_res) == 0){
		echo '<tr>
			<td>no deliveries found</td>
		</tr>';
	}else{
		while ($pendings_get_row = mysqli_fetch_assoc($users_get_res)){
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
				<td style="margin-right:20px;color:' . $c . '">' . $pendings_get_row['deliv_status'] . '</td>
				<td><a href = "deliv_details.html?u=' . urlencode($pendings_get_row['id']) . '">view</a></td>
			</tr>';
		}
	}
	
}else{
	include '../conn/conn.php';
	$c = '';
		
		$users_get = "SELECT * FROM `deliveries` ORDER BY `id` DESC LIMIT 10";
		
		$users_get_res = $conn->query ( $users_get );
		
		if(mysqli_num_rows($users_get_res) == 0){
			echo '<tr>
			<td>no user found</td>
		</tr>';
		}else{
			while ($pendings_get_row = mysqli_fetch_assoc($users_get_res)){
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
				<td style="margin-right:20px;color:' . $c . '">' . $pendings_get_row['deliv_status'] . '</td>
				<td><a href = "deliv_details.html?u=' . urlencode($pendings_get_row['id']) . '">view</a></td>
			</tr>';
			}
		}

}


?>