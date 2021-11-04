<?php 
session_set_cookie_params(['SameSite' => 'None', 'Secure' => true]); session_start();

if(isset($_POST['branch_check'])){
	include '../conn/conn.php';
	$branch_check = $_POST['branch_check'];
	
	$branches_get = "SELECT * FROM `branches` WHERE `addr` LIKE '%$branch_check%' ORDER BY `state` ASC";
	
	$branches_get_res = $conn->query($branches_get);
	
	if(mysqli_num_rows($branches_get_res) == 0){
		echo '<tr>
			<td>no branch found</td>
		</tr>';
	}else{
		while ($branches_get_row = mysqli_fetch_assoc($branches_get_res)){
			echo '<a href="branchprofile.html?u=' . $branches_get_row['id'] . '"><div class = "div_main branch">
				<div class = "div_main branch_top">
					<span class = "m-auto">' . $branches_get_row['addr'] . '</span>
				</div>
				<div class = "div_main row branch_bottom">
					<span class = " mr-auto">' . $branches_get_row['state'] . ', ' . $branches_get_row['city'] . '</span>
					<span class = "ml-auto right">' . $branches_get_row['type'] . '</span>
				</div>		
			</div></a>';
		}
	}
	
}else{
	include '../conn/conn.php';
		
		$branches_get = "SELECT * FROM `branches` ORDER BY `state` ASC LIMIT 10";
		
		$branches_get_res = $conn->query ( $branches_get );
		
		if(mysqli_num_rows($branches_get_res) == 0){
			echo '<tr>
			<td>no branch found</td>
		</tr>';
		}else{
			while ($branches_get_row = mysqli_fetch_assoc($branches_get_res)){
				echo '<a href="branchprofile.html?u=' . $branches_get_row['id'] . '"><div class = "div_main branch">
				<div class = "div_main branch_top">
					<span class = "m-auto">' . strtoupper($branches_get_row['addr']) . '</span>
				</div>
				<div class = "div_main row branch_bottom">
					<span class = " mr-auto">' . strtoupper($branches_get_row['state']) . ', ' . $branches_get_row['city'] . '</span>
					<span class = "ml-auto right">' . $branches_get_row['type'] . '</span>
				</div>
			</div></a>';
			}
		}

}


?>