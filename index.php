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
		
		
			include('unlogged-index.php');
		
}

mysqli_close($link);?>