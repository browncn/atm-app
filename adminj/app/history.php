<?php 
session_set_cookie_params(['SameSite' => 'None', 'Secure' => true]); session_start();


echo '<table>
			<tr>
				<th>date</th>
				<th>ref. no.</th>
			</tr>';

if(isset($_POST['bget'])){
	include '../conn/conn.php';
	$id = $_SESSION['id'];
	$bget = "SELECT * FROM `user_booking` ORDER BY `booked_date` DESC";
	$bget_res = $conn->query($bget);
	while ($bget_row = mysqli_fetch_assoc($bget_res)){
		$booked_date = $bget_row['booked_date'];
		$ref = $bget_row['ref'];
		
		$booked_date = str_replace('000000', '', $booked_date);
		
		echo '<tr>
				<td>' . $booked_date . '</td>
				<td><a href = "trans_info.html?ref=' . urlencode($ref) . '">' . $ref . '</a></td>
			</tr>';
	}

}

echo '</table>';

