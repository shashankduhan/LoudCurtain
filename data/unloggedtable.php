<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link href="/centralstyle.css" rel="stylesheet" type="text/css"/>
<link rel="icon" href="/pic/favicon-green.ico">
<style type="text/css">
body{margin:0 auto;font-family: "Lucida Grande",  Helvetica, sans-serif, Verdana, Arial;background:#c8ecff;font-size:10px;}
table td{border:1px solid #bbb;padding:12px;}
table{border:1px solid #ccc;background:#ddd;border-radius:12px;overflow:hidden;margin-top:25px;}
thead td{background:#fff;font-size:14px;}
#main{padding:75px 0 0 25px;}
#inline_editor{position:absolute;margin:50px auto;left:0;right:0;width:90%;border-color:#5d5d5d;}
#inline_editor textarea{display:inline-block;border:0;background:transparent;font-family:inherit;color:inherit;height:50px;width:95%;min-width:75px;}
#inline_editor td{padding:2px;}
#datable{margin-bottom:75px;}
#footpad{width:100%;height:150px;position:fixed;bottom:0;left:0;overflow:scroll;border-top:1px solid #ccc;background:#ffffd8;}
#switchPadSwitch{border-radius:15px;border:0.09em solid #ccc;background:-webkit-linear-gradient(#BFDFEB,#94C9DD);display:inline-block;position:relative;height:15px;width:15px;top:-3px;margin:0 10px;box-shadow: 0 0 0.07em 0.02em #94C9DD;cursor:pointer;}
#sideSwitchPad{border: 1px solid #AAA;width: 294px;display:none;position: absolute;background: white;margin: -3px 37px !important;border-top: 1px solid #EEE;color:#7b7b7b;font-size:13px;}
#sideSwitchPad div{border-bottom:1px solid #d0d0d0;padding:5px 6px;cursor:pointer;}
#sideSwitchPad .header{background:#d4d4d4;color:#515151;padding:5px 6px 3px;font-size:9px;cursor:initial;}
#sideSwitchPad .footer{color:#c7c7c7;font-size:9px;padding-bottom:25px;cursor:initial;}
#sideSwitchPad .newBar{background:#369;color:white;font-size:9px;border:0;}

.row{background:white;font-size:18px;}
.null{color:#ccc;}
.editable{background:none;border:1px solid #ccc;font-size:13px;color:#666;padding:2px;resize:none;height:18px;width:290px;}
.item:hover{background:#666;color:white;}
.emptyrowcount{padding: 2px 12px;color: #AAA;border-top-color:#eee;border-bottom-color:#eee;border-width: 1px;}
.emptyrow{padding:2px 12px;font-size:12px;background:#ccc;color:#666;}
</style>
<script src="/static/file/lc/lc.js"></script>
<script type="text/javascript">
var i={};
    i.data={};
    i.data.insert=function(){
        var vals='';var colms='';
        for (n=0;n<i.data.totalCols;n++){
            vals += x('val_'+n).value;
            colms += x('val_'+n).getAttribute('data-name');
            if(n<(i.data.totalCols-1)){vals+=',lc$,';colms+=',lc$,';}
        }
        new lc.data.insert({table:i.data.tablename,values:vals,cols:colms,row:document.getElementById('row_no').value});
        
        }
    i.switchPadButEfx=function(r){if(r=='none'){x('switchPadSwitch').firstChild.style.backgroundPosition='-182px 0';}else{x('switchPadSwitch').firstChild.style.backgroundPosition='-182px -9px';}}
new lc.sensor.ini;
lc.sensor.act.click=function(){}
lc.sensor.act.longMPress=function(){}
lc.sensor.act.chng=function(){}
</script>
<?php $onlogin_button="Login to edit this table"; include('../unlogged-headbar.php'); ?>
<div id="main"><?php $q=mysqli_query($link,"SELECT * FROM `loudcurt_hh`.`datables` WHERE `childof`='$tid';");
$totalColmn=mysqli_num_rows($q);
if($totalColmn>0){
    $col=array();$i=0;
    /**/
    echo "<table cellspacing=\"0px\" align=\"center\" id=\"datable\">";
while($r=mysqli_fetch_array($q,MYSQL_NUM)){
$col[$i]=array();
$col[$i]['id']=$r[0];$col[$i]['name']=$r[1];
$i++;}
$i=0;echo "<thead><td style=\"border-radius:12px 0 0;\">RowNo.</td>";
for($i=0;$i<count($col);$i++){
if($i==count($col)-1){echo "<td style=\"border-radius:0 12px 0 0;\">";}
else{echo "<td>";}
echo $col[$i]['name']."</td>";
$id=$col[$i]['id'];
$q=mysqli_query($link,"SELECT * FROM `loudcurt_hh`.`data` WHERE `for`='$id';");
$x='zero';$y='hero';$col[$i]['data']=array();
while($r=mysqli_fetch_array($q,MYSQL_NUM)){
if($x=='zero'){$x=$r[3];}if($y=='hero'){$y=$r[3];}
if($x>$r[3]){$x=$r[3];}if($y<$r[3]){$y=$r[3];}
$col[$i]['data'][$r[3]]=array();
$col[$i]['data'][$r[3]]['id']=$r[0];
$col[$i]['data'][$r[3]]['value']=$r[2];
}
}echo "</thead>";
$i=0;
for($i=$x;$i<=$y;$i++){
$echo='';$empty=true;
if($i==$y){$style1="style=\"border-radius:0 0 0 12px;\"";$style2="style=\"border-radius:0 0 12px;\"";}else{$style1='';$style2='';}
for($ii=0;$ii<count($col);$ii++){if(isset($col[$ii]['data'][$i]) && $col[$ii]['data'][$i]['value']!=''){
if($ii==count($col)-1){$echo.="<td $style2>";}else{$echo.="<td>";}
$echo.=$col[$ii]['data'][$i]['value']."</td>";$empty=false;}else{$echo.= "<td class=\"null\">NULL</td>";}}
if(!$empty){$echo= "<tr><td class=\"row\" $style1>$i</td>".$echo."</tr>";}
else{$echo= "<tr><td class=\"row emptyrowcount\" $style1 >$i</td><td $style2 class=\"emptyrow\" colspan=\"".count($col)."\">Empty Row.</td></tr>";}
echo $echo;
}
    echo "</table>";
  
}else{echo "Table has no Colmns - There should be a Add Colmns UI";}
    ?></div><script>i.data.lastRow=<?php echo $y;?>;i.data.totalCols=<?php echo count($col);?>;i.data.tableid=<?php echo $tid;?>;i.data.tablename='<?php echo $uri[1];?>';</script></body></html>