<?php 
//db handle
$db = 'atmlogistics';
$usr = 'root';
$pwd = 'kenjixxx';
$hst = 'localhost';
$dept = 'admin';

$conn = new mysqli( $hst, $usr, $pwd, $db);

//cookie handle
/*
if(!isset($_COOKIE['dough'])){
    $unique = rand(0,99999999999);
    $unique = hash('sha256', $unique);
    $chekki = "SELECT * FROM `cart` WHERE `uid` = '$unique'";
    $resc = $conn->query($chekki);
    while($resc->num_rows!==0){
        $unique = rand(0,99999999999);
        $chekki = "SELECT * FROM `cart` WHERE `uid` = '$unique'";
        $resc = $conn->query($chekki);      
    }
    setcookie('dough', $unique, time()+86400*30);
    
}else{
    $cookie = $_COOKIE['dough'];
    setcookie('dough', $cookie, time()+86400*30);
    
    
}
*/
?>