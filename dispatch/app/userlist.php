<?php 
session_set_cookie_params(['SameSite' => 'None', 'Secure' => true]); session_start();

if(isset($_POST['user_check'])){
	include '../conn/conn.php';
	$user_check = $_POST['user_check'];
	
	$users_get = "SELECT * FROM `users` WHERE `name` LIKE '%$user_check%' ORDER BY `dept` ASC";
	
	$users_get_res = $conn->query($users_get);
	
	if(mysqli_num_rows($users_get_res) == 0){
		echo '<tr>
			<td>no user found</td>
		</tr>';
	}else{
		while ($users_get_row = mysqli_fetch_assoc($users_get_res)){
			echo '<tr>
				<td>' . $users_get_row['fname'] . ' ' . $users_get_row['lname'] . '</td>
				<td style="margin-right:20px;">' . $users_get_row['dept'] . '</td>
				<td><a href = "userprofile.html?u=' . urlencode($users_get_row['id']) . '">view</a></td>
			</tr>';
		}
	}
	
}else{
	include '../conn/conn.php';
		
		$users_get = "SELECT * FROM `users` ORDER BY `dept` ASC LIMIT 10";
		
		$users_get_res = $conn->query ( $users_get );
		
		if(mysqli_num_rows($users_get_res) == 0){
			echo '<tr>
			<td>no user found</td>
		</tr>';
		}else{
			while ($users_get_row = mysqli_fetch_assoc($users_get_res)){
				echo '<tr>
				<td>' . $users_get_row['fname'] . ' ' . $users_get_row['lname'] . '</td>
				<td style="margin-right:20px;">' . $users_get_row['dept'] . '</td>
				<td><a href = "userprofile.html?u=' . urlencode($users_get_row['id']) . '">view</a></td>
			</tr>';
			}
		}

}


?>