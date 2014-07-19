<?php /*
Status : Incomplete;
Note : Skeleton is on progress, functionality not started yet;
*/
ob_start();
include('../ConnectMysql.php');
function parseNdo($action,$fromurl,$tid){
include('../link.php');
if($action=='select'){
 $values=explode('-',$fromurl);
 $colmns=explode(',',$values[0]);
 if($values[0]!='*' && $values[0]!='%2A'){
   $colmn='AND (';$totalColmns=count($colmns);
   for($i=0;$i<count($colmns);$i++){$colmn.="`name` = '$colmns[$i]' OR";}
    $colmns=rtrim($colmn,'OR').')';}else{$colmns='';}
  if(isset($_POST['where'])){
	include('where-parser.php');	
	}else{$where='';}
/*if(count($value)>2){if($value[2]==0 || $value[2]=='0' || $value[2]==''){$orderby='';}else{$order=explode(',',$value[2]);$limit="LIMIT $values[1]";}}*/
//Fetching ColmnIds
$query="SELECT * FROM `lc_$database`.`datable_structure` WHERE `childof`='$tid' $colmns;";
$q=mysqli_query($link,$query);
$totalColmn=mysqli_num_rows($q);
if($totalColmn>0){
//Parse & Define Limit if available
if(count($values)>1){if($values[1]=='0' || $values[1]==''){$limit='LIMIT 100';}
else{$limit="LIMIT $values[1]";}}else if(count($values)<2){$limit='LIMIT 100';}
$echo="{";
$col=array();$i=0;
while($r=mysqli_fetch_array($q,MYSQL_NUM)){
$col[$i]=array();
$col[$i]['id']=$r[0];$col[$i]['name']=$r[1];
$i++;}
$i=0;$echo.= "\"data\":[";
for($i=0;$i<count($col);$i++){
$id=$col[$i]['id'];
if($where=='' || !isset($where)){$query="SELECT * FROM `lc_$database`.`datable_content` WHERE `for`='$id' $limit;";}
else{$query="SELECT * FROM `lc_$database`.`datable_content` WHERE $where $limit;";}
$q=mysqli_query($link,$query);
$x='zero';$y='hero';$col[$i]['data']=array();
while($r=mysqli_fetch_array($q,MYSQL_NUM)){
if($x=='zero'){$x=$r[3];}if($y=='hero'){$y=$r[3];}
if($x>$r[3]){$x=$r[3];}if($y<$r[3]){$y=$r[3];}
$col[$i]['data'][$r[3]]=array();
$col[$i]['data'][$r[3]]['id']=$r[0];
$col[$i]['data'][$r[3]]['value']=$r[2];
}
} 
$i=0;
for($i=$x;$i<=$y;$i++){
$row= "{";$empty=true;
for($ii=0;$ii<count($col);$ii++){if(isset($col[$ii]['data'][$i])){$row.= '"'.$col[$ii]['name'].'":"'.urlencode($col[$ii]['data'][$i]['value']).'",';$empty=false;}else{$row.= '"'.$col[$ii]['name'].'":"",';}}
$row.= "\"rowcount\":\"$i\"},";
if(!$empty){$echo.=$row;}
}
$echo= rtrim($echo,',')."]}";
}else{$echo= "Table has no Colmns - There should be a Add Colmns UI";}
return $echo;
 }
else if($action=='insert'){
    $cols=$_POST['cols'];
    $values=$_POST['values'];
    $cols=explode(',lc$,',$cols);
    $values=explode(',lc$,',$values);
    $qrow=mysqli_query($link,"SELECT `rowcount` FROM `lc_$database`.`datable_structure` WHERE `id`='$tid' AND `layer`='A';");
    $row=mysqli_fetch_array($qrow,MYSQL_NUM);
    $row=($row[0]+1);
    $auto_increment=true;
    if(isset($_POST['row'])){
        if($_POST['row']<$row){
            $auto_increment=false;
            $qrow2=mysqli_query($link,"SELECT `id` FROM `lc_$database`.`datable_content` WHERE `row`='".$_POST['row']."';");
            if(mysqli_num_rows($qrow2)>0){echo "Row $_POST[row] already exists, Use UPDATE Command instead.";ob_flush();mysqli_close($link);exit();}
            else{$row=$_POST['row'];}
        }else{$row=$_POST['row'];}}
    for ($i=0;$i<count($cols);$i++){
        $colid=fetchColId($tid,$cols[$i]);
        $q=mysqli_query($link,"INSERT INTO `lc_$database`.`datable_content` (`id`,`for`,`value`,`row`) VALUES (NULL,'$colid','".$values[$i]."','$row');");
        if(!$q){echo mysqli_error($link);}
    }
    if($auto_increment){
        mysqli_query($link,"UPDATE `lc_$database`.`datable_structure` SET `rowcount`='$row' WHERE `id` = '$tid' AND `layer`='A'");}
}
else if($action=='update'){}
else if($action=='delete'){}
    header('HTTP/1.1 200 OK');
}
function fetchTableid($table){
include('../link.php');
$q=mysqli_query($link,"SELECT `id`,`rowcount`,`privacy` FROM `lc_$database`.`datable_structure` WHERE `name`='$table' AND `layer`='A' AND `childof`='0';");
if(mysqli_num_rows($q)==1){$r=mysqli_fetch_array($q,MYSQL_NUM);return $r;$GLOBALS['tid']=$r[0];}else{echo '1: No such table found';mysqli_close($link);ob_flush();exit();}
}
    function fetchColId($tid,$colname){
        include('../link.php');
        $q=mysqli_query($link,"SELECT `id` FROM `lc_$database`.`datable_structure` WHERE `layer`='B' AND `childof`='$tid' AND (`name`='$colname' OR `id`='$colname');");
        $r=mysqli_fetch_array($q,MYSQL_NUM);
        return $r[0];
    }

if(!isset($_POST['appid']) && !isset($_POST['appsecret'])){$_POST['appid']=0;$_POST['appsecret']='theqsecretwofeangrybirdsrandtspringygiraffey';}
include('../auth.php');
$uri=$_SERVER['REQUEST_URI'];
$uri=trim($uri,'/');
$uri=explode('/',$uri);
if(count($uri)==2){/*show table information UI if have permission*/
list($tid,$totalrow,$privacy)=fetchTableid($uri[1]);
if(!isset($_SESSION['uid'])){include('unloggedtable.php');}else{include('table.php');}
}
else if(count($uri)==4){
list($tid,$totalrow,$privacy)=fetchTableid($uri[1]);
if(strtolower($uri[2])=='insert'){
if($_CREDENTIAL==0){$permid=17;}else{$permid=23;}
auth($permid,$credid,$tid);}
else if(strtolower($uri[2])=='select'){/*loudcurtain.com/data/tablename/select/colname,colname2,...-0,30(limit)-(OrderBy)colname,ascORdesc */
if($_CREDENTIAL==0){$permid=18;}else{$permid=24;}
auth($permid,$credid,$tid);echo parseNdo('select',$uri[3],$tid);}
else if(strtolower($uri[2])=='update'){
if($_CREDENTIAL==0){$permid=19;}else{$permid=25;}
auth($permid,$credid,$tid);}
else if(strtolower($uri[2])=='delete'){
if($_CREDENTIAL==0){$permid=20;}else{$permid=26;}
auth($permid,$credid,$tid);}
else if(strtolower($uri[2])=='allot'){
if($_CREDENTIAL==0){$permid=22;}else{$permid=28;}
auth($permid,$credid,$tid);/* /data/table/allot/all/uid  should not allote the allotment power */}

}
else if(count($uri)==3){
list($tid,$totalrow,$privacy)=fetchTableid($uri[1]);
if(strtolower($uri[2])=='insert'){
    if(isset($_POST['cols']) && isset($_POST['values'])){
    if($_CREDENTIAL==0){$permid=17;}else{$permid=23;}
        auth($permid,$credid,$tid);echo parseNdo('insert','',$tid);}else{echo "Usage : loudcurtain.com/data/tablename/insert  --  with $_POST vars : cols & values";}}
else if(strtolower($uri[2])=='select'){echo "Usage : loudcurtain.com/data/tablename/select/colname,colname2,...-0,30(limit)";}
else if(strtolower($uri[2])=='update'){echo "Usage :";}
else if(strtolower($uri[2])=='delete'){echo "Usage :";}
else if(strtolower($uri[2])=='allot'){echo "Usage : /data/table/allot/all/uid  should not allote the allotment power";}
}
else{echo '0: Not Found';}
mysqli_close($link);
ob_flush();
?>