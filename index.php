<?php 
include('ConnectMysql.php');

if(isset($_SESSION['uid'])){
		if(!isset($_SESSION['init']) && @$_SESSION['init']!=1){//init is set by spinal cord
			//Check for setup
			$qq=mysqli_query($link,"SELECT `setup` FROM `lc_$database`.`userbase` WHERE `uid`='$_SESSION[uid]';");
			$r=mysqli_fetch_array($qq,MYSQL_NUM);
			if($r[0]!=1){include('setup.php');mysqli_close($link);exit();}
			//Check for setup
			}
		
			/*Spinal Cord*/
			include('spinalcord.php');
			/*End of Spinal Cord*/
}
else{
		if(isset($_COOKIE['guptank'])){//Checking if "remember password" option is on or not. (Auto logging) 
			$exe = mysqli_query($link,"SELECT (`uid`) AS uid,(SELECT `firstname` FROM `lc_$database`.`user_details` WHERE `uid` = uid) AS fname, (SELECT `lastname` FROM `lc_$database`.`user_details` WHERE `uid` = uid) AS lname FROM `lc_$database`.`userbase` WHERE `email` = '$_COOKIE[naam_pta]' OR `nickname` = '$_COOKIE[naam_pta]';");
			$r = mysqli_fetch_array($exe , MYSQL_NUM);
			$_SESSION['uid'] = $r[0];
			$_SESSION['userFname'] = $r[1];
			$_SESSION['userLname'] = $r[2];
			echo "<!DOCTYPE html><head><meta http-equiv=\"refresh\" content=\"1\"></head></html>";
		}
		else{
			include('unlogged-index.php');
		}
}

mysqli_close($link);?>