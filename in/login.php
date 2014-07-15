<?php 
/*Login Script*/
ob_start();
include('../ConnectMysql.php');
$email= $_POST["email"];
$password = $_POST["password"];
//$SP = $_POST['savePass'];
/*Check if there is email present in the database */
$q = "SELECT * FROM `lc_$database`.`userbase` WHERE `email` = '$email' OR `nickname` = '$email'";
$exe = mysqli_query($link, $q);
if (mysqli_num_rows($exe) == 1)
{
while($r = mysqli_fetch_array($exe, MYSQL_BOTH))
    {



$passs = explode('&LCPassBreak;' , $r[3]);
$LastPass = sizeof($passs) - 1;
$CurntPass = $passs[$LastPass]; 
if($CurntPass == $password)
    {    
	     //if($SP =='1'){setcookie('naam_pta' ,$email , time() + 2592000, "/" , "$domain"  );
		             //setcookie('guptank' ,$password , time() + 2592000, "/" , "$domain" );}
		 	$exe = mysqli_query($link,"SELECT `firstname`, `lastname` FROM `lc_$database`.`user_details` WHERE `uid` = '$r[0]' ;");
			$r1 = mysqli_fetch_array($exe , MYSQL_NUM);
			$_SESSION['uid'] = $r[0];
			$_SESSION['userFname'] = $r1[0];
			$_SESSION['userLname'] = $r1[1];
           
		 echo "{\"m\" : \"\" , \"r\" : \"1\"}"; 
    }
else{
    if(in_array($password , $passs))
	   {  $pData = in_array($password , $passs); 
	      $pData = explode('LCpTime;' , $passs[$pData]); 
		  $pCTime = date("j , M Y" , $pData[1]);
		  echo "{\"m\" : \"$r[0] $r[1] , this password had changed on $pCTime , <a class=\\\"penBlue\\\">Click this if you Didn\'t Changed your Password ?</a>\" , \"r\" : \"0\"}"; 
	   }
    else{ echo "{\"m\" : \"You typed a wrong password.<br/> <span style='color:rgb(130, 147, 168)'>Try Again and check if CapsLock is ON or OFF</span>\" , \"r\" : \"0\"}"; }
	}



    } 
}
	else{ echo "{\"m\" : \"You typed a wrong email/username Or you haven't registered with us. <br/><span style='color:rgb(130, 147, 168)'>Contact - Administration</span>\" , \"r\" : \"0\"}"; 
}
ob_flush();
mysqli_close($link);

?>