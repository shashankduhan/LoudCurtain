<?php
session_start();
include('lclib.php');
if(!isset($_SESSION['uid'])){
	header("location: . ");}
	else{
$_SESSION = array();
session_destroy();
setcookie ('PHPSESSID' , '', time()-3600, '/', "$domain", 0, 0);
setcookie('guptank'  , '' , time()-3600 , '/' ,"$domain" , 0 ,0);
header("location: . ");}
?>