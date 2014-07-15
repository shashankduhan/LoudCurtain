<?php 
$link = @mysqli_connect('localhost','root',''); 
if (!$link) { 
	die('Could not connect to MySQL: ' . mysqli_error($link)); 
} else{session_start();}

include('lclib.php');


?> 