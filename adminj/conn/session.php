<?php 
if(session_id() == ''){
	session_set_cookie_params(['SameSite' => 'None', 'Secure' => true]); session_start();
}
if(isset($_SESSION['level'])){
	if($_SESSION['level'] == ''){
		$link = 'logout';
		$url = '<script type = "text/javascript" >window.location.href = "';
		$url .= $link . '"</script>';
		echo $url;
	}
	
}

if(isset($_GET['p'])){
	$active = $_GET['p'];
}else{
	$active = '';
}

?>