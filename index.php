<?php 
include('ConnectMysql.php');

if(isset($_SESSION['uid'])){
		if(@$_SESSION['init'] == 0){//init is set by login.php | Setup will start
			include('setup.php');mysqli_close($link);exit();
			//Script Halts.
        }
		
        /*If setup not required then initiate SpinalCord*/
        include('spinalcord.php');
        /*End of Spinal Cord*/
			
}
else{
		
		
        include('unlogged-index.php');
		
}

mysqli_close($link);?>