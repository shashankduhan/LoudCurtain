<?php 
include('ConnectMysql.php');

if(isset($_SESSION['uid'])){
if(!isset($_SESSION['init']) && @$_SESSION['init']!=1){//init is set by spinal cord
	//Check for setup
	$qq=mysqli_query($link,"SELECT `setup` FROM `loudcurt_hh`.`user` WHERE `uid`='$_SESSION[uid]';");
	$r=mysqli_fetch_array($qq,MYSQL_NUM);
	if($r[0]!=1){include('setup.php');mysqli_close($link);exit();}
	//Check for setup
	}
if(isset($_SESSION['nid'])){
/*Spinal Cord*/
?>
<?php include('SpinalCord.php');?>
<?php
/*End of Spinal Cord*/}
else{
/*Network Selection*/
?>
<?php $exe = mysqli_query($link,"SELECT `nid` as `id` , (SELECT `network_name` FROM `loudcurt_hh`.`networks` WHERE `nid` = `id`) as `name`  FROM `loudcurt_hh`.`network_admins` WHERE `uid` = '$_SESSION[uid]';");
if(mysqli_num_rows($exe) == 0){$_SESSION['nid']='-'.$_SESSION['uid'];$_SESSION['netPic']='homeicon';$_SESSION['networkName']='Home'; echo '<!DOCTYPE html >
<head><link href="http://www.loudcurtain.com/pic/favicon-green.ico" rel="shortcut icon" type="image/x-icon" /><title>Redirecting &#166; Wait a moment</title><meta http-equiv="refresh" content="0"></head></html>'; }else{?>
<!DOCTYPE html >
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<link href="http://www.loudcurtain.com/pic/favicon-green.ico" rel="shortcut icon" type="image/x-icon" />
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link href="http://www.loudcurtain.com/CSSSC.css" rel="stylesheet" type="text/css"/>
<title>LC &#166; Select Network</title>
<style type="text/css">
.inheritance{overflow-x:hidden;}
.divider{background:url(images/three_tilted_line.png) repeat-x, #fff;height:17px; transform:rotate(2deg);
-moz-transform:rotate(2deg); -webkit-transform:rotate(2deg); -o-transform:rotate(2deg); margin-top:25px;}
.shadow{-moz-box-shadow: 0 2px 4px #888888; -webkit-box-shadow: 0 2px 4px #888888; box-shadow: 0px 1px 3px #cacaca;}
.border_down_only{border-width:0px 0px 1px 0px;border-style:solid;border-color:#cacaca;}
.border_up_only{border-width:1px 0px 0px 0px;border-style:solid;border-color:#cacaca;}
.border_left_only{border-width:0px 0px 0px 1px;border-style:solid;border-color:#cacaca;}
.border_right_only{border-width:0px 1px 0px 0px;border-style:solid;border-color:#cacaca;}
.padding_30px{padding:30px;}
.network_logo{border:1px solid #cacaca;outline:3px solid #fff;width:130px;}
.network_Logo2{border:1px solid #cacaca;outline:3px solid #fff;width:130px;background:url('images/TheLogo.png') top left no-repeat;height:125px;text-align:center;color:#000;}
#HeaderBar{position:relative;font-size:16px;}
.left{float:left;}
.right{float:right;}
.padding_4_10{padding:4px 10px ;}
.margin_left_60{margin-left:60px;}
#thisfoot{padding:12px;font-size:12px;margin-top:75px;valign:bottom;color:#ababab;}
.lc_logo{position:relative;top:-20px;}
.margin_top_12{margin-top:12px;}
#close_gs{position:relative;background:#fff;color:5b5b5b;display:none;font-size:12px;left:330px;cursor:pointer;}
.container{margin:0 auto;max-width:1200px;}
.borLRB5White{border-width:0 15px 15px;border-style:solid;border-color:#f8f8f8;}
.padTB15{padding:15px 0;}
.backLD{background:#f2f2f8;}
td{padding:3px 5px;max-width:133px;vertical-align:bottom;}
td:hover{cursor:pointer;background:#f8f8f8;outline:1px solid #ababab;}
a.SignOut{background:#2f2f2f;opacity:0.7;color:#fff;position:relative;top:-4px;height:25px;text-decoration:none;}
a.SignOut:hover{opacity:1;}

</style>
<script type="text/javascript" src="http://loudcurtain.com/store/lc/lc.js"></script>
<script type="text/javascript">

function showw(x){
document.getElementById(x).style.display = "inline";
}
function hidee(x){
document.getElementById(x).style.display ="none";
}

function SetNetwork(x ,y){
var url = 'login/setnetwork.php';
var p = 'id='+x+'&n='+y;
new ajax.request(url , {method : 'GET' , parameters : p , onSuccess : function(){window.location.reload();} , onCreate : function(){document.getElementById('p'+x).innerHTML='<img src="/pic/progress_blue120x20.gif"/>';}});
}
</script>
<body class="inheritance">
<div id="HeaderBar" class="padding_4_10"><div class="container"><a class="right SignOut padding_4_10" href="logout.php">Sign out</a>LC &#166; Select Network <a class="margin_left_60">...</a></div></div>
<div class="container borLRB5White padTB15 .backLD">

<div id="divider_up" class="divider border_up_only"></div>
<div id="networks" class="padding_30px t" align="center"><table cellspacing="30px" class="t"><tr>
<?php

echo'<td id="00'.$_SESSION['uid'].'" onclick="SetNetwork(\'-'.$_SESSION['uid'].'\' ,\'LChome%%\')">Home <br/>(Personal Acc.)<p class="network_Logo2" style="background:url(\'images/homeIcon_130.png\');" id="p-'.$_SESSION['uid'].'"></p></td>';
$i=1;
while($r = mysqli_fetch_array($exe , MYSQL_NUM)){
$background = "style=\"background:url('images/NL$r[0]_130.png');\"";
$td_back = "<td id=\"$r[0]\" onclick=\"SetNetwork('$r[0]' ,'".str_replace("'","\'",$r[1])."')\">$r[1]<p class=\"network_Logo2\" $background id=\"p$r[0]\"></p></td>";
$td_backless = "<td id=\"$r[0]\" onclick=\"SetNetwork('$r[0]','".str_replace("'","\'",$r[1])."')\">$r[1]<p class=\"network_Logo2\" id=\"p$r[0]\"></p></td>";
if($i <=2){$i += 1; if(file_exists('images/NL'.$r[0].'_130.png')){echo $td_back;}else{echo $td_backless;}}
else{$i = 1; if(file_exists('images/NL'.$r[0].'_130.png')){echo '</tr><tr>'.$td_back;}else{echo '</tr><tr>'.$td_backless;}}
}
?>
</tr></table></div>
<div id="divider_down" class="divider shadow border_down_only"></div>
<div id="thisfoot" valign="top">HailHumanity &nbsp; &bull; &nbsp; CC-BY &#166; Some Rights Reserved<img src="images/logo/lc-icon-circular-white-on-grey-50.png" class="right lc_logo"/></div>
</div>
</body>
</html><?php } ?>
<?php
/*End of Network Selection*/
}
}
else{
if(isset($_COOKIE['guptank'])){
$exe = mysqli_query($link,"SELECT `uid`,`firstname`,`lastname` FROM `loudcurt_hh`.`user` WHERE `email` = '$_COOKIE[naam_pta]' OR `username` = '$_COOKIE[naam_pta]';");
$r = mysqli_fetch_array($exe , MYSQL_NUM);
$_SESSION['uid'] = $r[0];
$_SESSION['userFname'] = $r[1];
$_SESSION['userLname'] = $r[2];
echo "<!DOCTYPE html><head><meta http-equiv=\"refresh\" content=\"1\"></head></html>";
}
else{
?>

<!-- The LoudCurtain -->  
<!DOCTYPE html>
<html>
<head>
<meta name="description" content="Loudcurtain is a tool that helps you to work together and manage your networks & apps better & for free." />
<link href="http://www.loudcurtain.com/pic/favicon-green.ico" rel="shortcut icon" type="image/x-icon" />
<link rel="stylesheet" href="http://www.loudcurtain.com/CSSSC.css" type="text/css"/>  
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>LoudCurtain &#166; Start or Manage Professional Networks</title>
<style type="text/css">
.inheritance{font: 100% "Lucida Grande", Verdana, Arial, Helvetica, sans-serif;padding:0;margin:0 auto;min-width:1050px; background: rgb(242,242,242); 
background: -moz-linear-gradient(left, rgba(242,242,242,1) 0%, rgba(255,255,255,1) 55%, rgba(255,255,255,1) 100%); 
background: -webkit-gradient(linear, left top, right top, color-stop(0%,rgba(242,242,242,1)), color-stop(55%,rgba(255,255,255,1)), color-stop(100%,rgba(255,255,255,1))); 
background: -webkit-linear-gradient(left, rgba(242,242,242,1) 0%,rgba(255,255,255,1) 55%,rgba(255,255,255,1) 100%); 
background: -o-linear-gradient(left, rgba(242,242,242,1) 0%,rgba(255,255,255,1) 55%,rgba(255,255,255,1) 100%); 
background: -ms-linear-gradient(left, rgba(242,242,242,1) 0%,rgba(255,255,255,1) 55%,rgba(255,255,255,1) 100%); 
background: linear-gradient(left, rgba(242,242,242,1) 0%,rgba(255,255,255,1) 55%,rgba(255,255,255,1) 100%); 
filter: progid:DXImageTransform.Microsoft.gradient( startColorstr='#f2f2f2', endColorstr='#ffffff',GradientType=1 ); }
.inheritance p {font:14px;color:#888;}
.inheritance h3{font:18px;}
.container {margin:0 auto; max-width:1280px; }

.descriptive_logo {background:url('/pic/descriptive_art.png') center no-repeat;width:400px;height:400px;}
.clear { clear:both;height:0;font-size: 1px;line-height: 0px; }
#about_box{margin:0 30px;text-align:left;color:#333;font-size:22px;width:430px;background:#fff;border:1px solid #CACAD6;}
.input_text_login{border:2px solid #303066;font:15px;color:#2f2f2f;padding:2px;width:140px;font-family:inherit;}
.blue_button {background:#336699 ;color: #fff;float: left;font: normal 10px;height: 25px;margin-right: 6px; /* sliding doors padding */text-decoration: none;cursor:pointer;border:1px solid #002674;padding: 3px 18px 3px 15px;font-family:inherit;font-size:16px;}
.blue_button:active {background-position: bottom right;color: whitesmoke;outline: none; }
.blue_button:active span {background-position: bottom left;padding: 4px 0 2px 15px; }
.blue_button:hover{text-decoration:none;color:#fff;}
.blue_button:hover span{text-decoration:none;color:#fff;}
#BotBluePad{padding:10px 30px;color:#C2CEE7;font-size:12px;}
#BotBluePad td{width:175px;padding:20px 0px;}
#helpingTools{margin-top:125px;margin-right: 205px;}

.padding_20{padding:20px;}
.padding_10_30{padding:10px 30px;}
.grey_background{background:#888;}
a:link{color:inherit;text-decoration:none;}
a:hover{color:inherit;text-decoration:underline;}
a:active{color:inherit;text-decoration:none;}
a:visited{color:inherit;text-decoration:none;}
#footer{padding:20px 10px 10px 30px;color:#C2CEE7;background:#4066B4;font-size:12px;}
td{width:110px;}
#footer_right{float:right;font-size:14px;margin-right:20px;}
/*#all_projects_icon{zoom:70%;}*/
.right{float:right;}
input:focus, textarea:focus {outline: none;}
td {width:200px;height:25px;}
.Error{background:#F9FFB5;padding:6px 25px;display:none;color:#6c6c6c;border-top:1px solid #D2381F;}
.arrow{color:#adadad;font-size:12px;display:none;}
.abs{position:absolute;}
.left{float:left;}
.right{float:right;}
.new_button{background:rgb(111, 197, 118);border:1px solid #303066;color:#fff;text-decoration:none;padding:3px 6px;}
.new_button:hover{color:#fff;text-decoration:none;}
.pointer{cursor:pointer;}
.new_butnPad{background:#e5e5e5;border:1px solid #303066;padding:10px 13px;width:240px;}
.block{display:block;}
.LiteDivFoot{border-top:1px solid #DCDAE1;background:#F4F2F2;padding:12px;color:#2f2f2f;font-size:14px;}
.pad_30px{padding:30px;}
.padBot0{padding-bottom:0px;}
.bluGlow{background:url('/pic/blue_glow_smallpatch.png') repeat-x; height:5px;width:100%;z-index:10000;}
.fixed{position:fixed;}
.hide{display:none;}
.rel{position:relative;}
.white{color:white;}
#loginTab td{vertical-align:top;}
.low35{top:35px;}
.low37{top:37px;}
.penBlue{color:#303066;}
label{cursor:pointer;}
</style>
<script type="text/javascript" src="http://loudcurtain.com/store/lc/lc.js"></script>
<script type="text/javascript">
<!--

 function Ignite(action){
	var format = /^([A-Za-z0-9_\-\.])+\@([A-Za-z0-9_\-\.])+\.([A-Za-z]{2,4})$/;
	if(action == "logFB"){window.location="http://loudcurtain.com/fb/login.php?next_url=http://loudcurtain.com";}
	else if(action == 'login'){
	var err = x('Error');
	err.innerHTML = '<img src="images/progress_blue120x20.gif"/>';
	showw('Error');
	 var email = x('Login_Email');
	 email = email.value.replace(/^\s+|\s+$/g, '');
	 var pass = x('Login_Password');
	 var SP = x('savePass');
	 if(SP.checked == true){SP = 1;}else{SP =0;}
	 var url = "login/index.php";
	 var p = 'email='+email+'&pass='+pass.value+'&savePass='+SP;
	 new ajax.request(url , {method : 'POST' , parameters : p , requestHeaders : {Accept : 'application/json'} , onSuccess : function(a){
	 var y = eval("("+a+")");
	 if(parseInt(y.r) == 1)
	 window.location.reload();
	 else
	 document.getElementById('Error').innerHTML = y.m;
	 }});
	 return false;
	}	}


function ExpandByClass(x ,y){
var clas = document.getElementsByClassName(x);
var i;
for(i=0;i<=clas.length;i++){
clas[i].style.height = y;
}
}

function Tips(z){
if(z == 'savePass'){var y = x('savePass'); if(y.checked ==true){var err = x('Error'); err.innerHTML = 'Never use \'<span class="penBlue">Keep logged in</span>\' in <span class="penBlue">Library , Internet Cafe</span> or while using Someone else\'s Computer.';showw('Error');}else{hidee('Error');}}
}

function logAFx(){window.location.reload();}
 window.onload=function(){
 if(window.innerHeight < 670){document.getElementById('d_art').style.height='300px';};
 }
//-->
</script>


</head>

<body class="inheritance" style="overflow-x:hidden;">
<div class="fixed bluGlow"></div><div class="container"><div id="helpingTools" class="right" align="center"><div class="new_butnPad block"><a class="new_button pointer" onclick="Ignite('logFB');"><span>Login with facebook</span></a></div><div id="locale"></div></div>

<div id="about_box" class="left"><div class="pad_30px padBot0">Work together and manage your apps & networks for free.<br/><div class="descriptive_logo" id="d_art"></div></div><div class="LiteDivFoot">Learn More &#166; Take a Tour</div></div><br class="clear"/></div><br class="clear"/><div class="abs" style="bottom:-35px;width:100%;background:#4066B4;"><div id="Error" class="Error" align="center" ><img src="images/progress_blue120x20.gif"/></div><div style="border-top:3px solid #002674;"><div class="container"><div id="BotBluePad" ><img src="/pic/lc-logo-midium-large-white-thin.png"/><table class="right" id="loginTab"><tr><form id="Ignite_login" method="post" onsubmit="return Ignite('login');"><td><input type="text" name="email" id="Login_Email" width="120px" class="input_text_login" placeholder="Email" <?php if(isset($_COOKIE['naam_pta'])){echo "value=\"$_COOKIE[naam_pta]\"";} ?> tabindex="1"/><br/><span class="rel low35" onclick="Tips('savePass')"><input type="checkbox" id="savePass"/> <label for="savePass" tabindex="3">Keep logged in</label></span></td><td><input type="password" id="Login_Password" name="password" width="120px" class="input_text_login" placeholder="Password" tabindex="2"/><br/><a class="rel low37 pointer" tabindex="5">Forgot Password ?</a></td><td><input type="submit" class="blue_button" value="Login" tabindex="4"/> </td></form></tr></table><br class="clear"/></div> <div id="footer"> <div id="footer_right">Help &bull; About &bull; Join In </div> HailHumanity &nbsp;&bull;&nbsp; CC BY &#166; Some rights reserved</div></div></div></div> 
 
 </body>
</html>
<?php }}?>