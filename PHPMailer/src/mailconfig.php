<?php 

require 'Exception.php';
require 'PHPMailer.php';
require 'SMTP.php';

use PHPMailer\PHPMailer\PHPMailer;
$mail = new PHPMailer();
$mail->IsSMTP();

$mail->CharSet="UTF-8";
$mail->Host = "n3plcpnl0014.prod.ams3.secureserver.net";
$mail->SMTPDebug = 0;
$mail->Port = 587 ; //465 or 587

$mail->SMTPSecure = 'tls';
$mail->SMTPAuth = false;
$mail->IsHTML(true);

//Authentication
$mail->Username = "customercare@atmlogistic.com";
$mail->Password = "Credo001!";

//Set Params
$mail->SetFrom("customercare@atmlogistic.com", "ATM Logistics");
$mail->AddAddress("brown.cnk@gmail.com");
$mail->Subject = "Test";
$mail->Body = "hello";

/*
if($mail->send()){
	echo 'Message has been sent';
}else{
	echo 'Message could not be sent.';
	echo 'Mailer Error: ' . $mail->ErrorInfo;
}
*/
//$mail->send();
//print_r($mail);
?>