<?php
function fetchTableInfo($id,$col){include('../link.php');$q="SELECT $col FROM `loudcurt_hh`.`datables` WHERE `id`='$id';";$exe=mysqli_query($link,$q);$r=mysqli_fetch_array($exe,MYSQL_NUM);return $r;}
if(!isset($_SESSION['uid'])){include('unloggedtable.php');}else{
if($privacy==1){
if($_CREDENTIAL==1){$permid=18;}else{$permid=24;}
auth($permid,$credid,$tid,"<div style='text-align:center;'>You dont have permission to view this table<br/><button>Ask Admin for Permission.</button> <button>Msg Admin</button></div>");

}
?><!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link href="/centralstyle.css" rel="stylesheet" type="text/css"/>
<link rel="icon" href="/pic/favicon-green.ico">
<style type="text/css">
body{margin:0 auto;font-family: "Lucida Grande",  Helvetica, sans-serif, Verdana, Arial;background:#c8ecff;color:#333;font-size:14px;padding-bottom:200px;}
table td{border:1px solid #bbb;padding:12px;font-size:11px;}
table{border:1px solid #ccc;background:#ddd;border-radius:12px;overflow:hidden;margin-top:25px;}
thead td{background:#fff;color:#5C8CCD;font-size:14px;}
#main{padding:75px 0 0 25px;}
#inline_editor{position:absolute;margin:50px auto;left:0;right:0;width:90%;border-color:#5d5d5d;}
#inline_editor textarea{display:inline-block;border:0;background:transparent;font-family:inherit;color:inherit;height:50px;width:95%;min-width:100px;}
#inline_editor td{padding:2px;}
#inline_editor thead td{color:#666;padding-left:5px;font-size:11px;border-bottom:0;}
#datable{}
#footpad{width:100%;height:150px;position:fixed;bottom:0;left:0;overflow:scroll;border-top:1px solid #ccc;background:#ffffd8;}
#headpad{position:fixed;background:#f8f8f8;width:100%;height:30px;top:0;left:0;border-bottom:2px solid white;padding-top:10px;}
#switchPadSwitch{border-radius:15px;border:0.09em solid #ccc;background:-webkit-linear-gradient(#BFDFEB,#94C9DD);display:inline-block;position:relative;height:15px;width:15px;top:-3px;margin:0 10px;box-shadow: 0 0 0.07em 0.02em #94C9DD;cursor:pointer;}
#sideSwitchPad{border: 1px solid #AAA;width: 294px;display:none;position: absolute;background: white;margin: -3px 37px !important;border-top: 1px solid #EEE;color:#7b7b7b;font-size:13px;}
#sideSwitchPad div{border-bottom:1px solid #d0d0d0;padding:5px 6px;cursor:pointer;}
#sideSwitchPad .header{background:#d4d4d4;color:#515151;padding:5px 6px 3px;font-size:9px;cursor:initial;}
#sideSwitchPad .footer{color:#c7c7c7;font-size:9px;padding-bottom:25px;cursor:initial;}
#sideSwitchPad .newBar{background:#369;color:white;font-size:9px;border:0;}

.row{background:white;font-size:18px;color:#5C8CCD;}
.null{color:#ccc;}
.editable{background:white;border:1px solid #ccc;font-size:13px;color:#666;padding:2px;resize:none;height:18px;width:290px;}
.item:hover{background:#666;color:white;}
.emptyrowcount{padding: 2px 12px;color: #AAA;border-top-color:#eee;border-bottom-color:#eee;border-width: 1px;}
.emptyrow{padding:2px 12px;font-size:12px;background:#ccc;color:#5C8CCD;cursor:pointer;}
</style>
<script src="/static/file/lc/lc.js"></script>
<script type="text/javascript">
var i={};
    i.data={};i.data.empty=true;
    i.data.insert=function(){
        var vals='';var colms='';
        for (n=0;n<i.data.totalCols;n++){
            if(x('val_'+n).value.replace(/^\s+|\s+$/g, '')!=''){i.data.empty=false;}
            vals += x('val_'+n).value;
            colms += x('val_'+n).getAttribute('data-name');
            if(n<(i.data.totalCols-1)){vals+=',lc$,';colms+=',lc$,';}
        }
        if(!i.data.empty){new lc.data.insert({table:i.data.tablename,values:vals,cols:colms,row:x('row_no').value,afx:function(r){i.data.insertafx(r);i.data.empty=true;}});}
        else{new lc.confirm("Do you want to add empty row",function(){new lc.data.insert({table:i.data.tablename,values:vals,cols:colms,row:x('row_no').value,afx:function(r){i.data.insertafx(r);i.data.empty=true;}});},true);}
        
        }
    i.data.insertafx=function(r){document.body.scrollTop=document.body.scrollHeight;
        var newtr=document.createElement('tr');newtr.id='row_'+x('row_no').value;
        x('datable').lastChild.lastChild.firstChild.style.borderRadius= x('datable').lastChild.lastChild.lastChild.style.borderRadius='0px';
         x('datable').lastChild.appendChild(newtr);
        var newrowtd=document.createElement('td');newrowtd.setAttribute('class','row');newrowtd.innerHTML=x('row_no').value;newrowtd.style.borderRadius='0 0 0 12px';
        newtr.appendChild(newrowtd);
        for (n=0;n<i.data.totalCols;n++){
            var newtd=document.createElement('td');
            if(x('val_'+n).value.replace(/^\s+|\s+$/g, '')==''){var val='NULL';newtd.className='null';}else{var val = x('val_'+n).value;}
            x('val_'+n).value='';
            newtd.innerHTML=val;
            newtr.appendChild(newtd);
            if(n<(i.data.totalCols-1)){}else{newtd.style.borderRadius='0 0 12px 0';}
        }
       new lc.slNotification('Row no: '+i.data.lastRow+' inserted.');
       i.data.lastRow+=1;x('row_no').value=i.data.lastRow+1;
}
    i.switchPadButEfx=function(r){if(r=='none'){x('switchPadSwitch').firstChild.style.backgroundPosition='-182px 0';}else{x('switchPadSwitch').firstChild.style.backgroundPosition='-182px -9px';}}
new lc.sensor.ini;
lc.sensor.act.click=function(){}
lc.sensor.act.longMPress=function(){}
lc.sensor.act.chng=function(){}
</script>
</head>
<body><div id="main"><div id="headpad">

<div id="switchPadSwitch"><img src="/static/pic/lc/blank.gif" class="essential" style="background-position:-182px 0;height:9px;width:15px;" onclick="lc.toggleDisplay('sideSwitchPad',function(s){new i.switchPadButEfx(s);})"/></div><textarea class="editable" id="titleEditor" title="Click to Change Name" onchange="p.edit({id:'changepagetitle',value:'<value;>'+this.value+'<value;>'});"><?php echo $uri[1]; ?></textarea><label for="titleEditor"><img src="/static/pic/lc/blank.gif" class="essential pencil" style="background-position:-178px -75px;height:23px;width:29px;position:relative;top:-3px;left:-33px;zoom:95%;"/></label><br style="height:0;"/><div id="sideSwitchPad" style="display:none;"><?php
$qq="SELECT `contentid` FROM `loudcurt_perms`.`permissions` WHERE `to`='$_SESSION[uid]' AND `permid`='18';";
$exeWS=mysqli_query($link,$qq);
$rs=mysqli_num_rows($exeWS);
if($rs>1){?>
<div class="header">
Select to switch another table.</div><?php while($rWS=mysqli_fetch_array($exeWS,MYSQL_NUM)){if($rWS[0]!=$tid){$rr=fetchTableInfo($rWS[0],'`name`');echo "<div class=\"item\" data-id=\"$rWS[0]\">".$rr[0]."</div>";}} } ?><div class="footer" align="center">You are Admin of <?php echo $rs;?> Table<?php if($rs >1){echo 's';} ?>.</div><div class="newBar" data-action="newtable">+ Create new Table.</div>
</div>

</div><?php $q=mysqli_query($link,"SELECT * FROM `loudcurt_hh`.`datables` WHERE `childof`='$tid';");
$totalColmn=mysqli_num_rows($q);
if($totalColmn>0){
    $col=array();$i=0;
    /**/
    echo "<table cellspacing=\"0px\" align=\"center\" id=\"datable\">";
while($r=mysqli_fetch_array($q,MYSQL_NUM)){
$col[$i]=array();
$col[$i]['id']=$r[0];$col[$i]['name']=$r[1];
$i++;}
$i=0;echo "<thead><tr><td style=\"border-radius:12px 0 0;\">RowNo.</td>";
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
}echo "</tr></thead>";
$i=0;
for($i=$x;$i<=$y;$i++){
$echo='';$empty=true;
if($i==$y){$style1="style=\"border-radius:0 0 0 12px;\"";$style2="style=\"border-radius:0 0 12px;\"";}else{$style1='';$style2='';}
for($ii=0;$ii<count($col);$ii++){if(isset($col[$ii]['data'][$i]) && $col[$ii]['data'][$i]['value']!=''){
if($ii==count($col)-1){$echo.="<td $style2>";}else{$echo.="<td>";}
$echo.=$col[$ii]['data'][$i]['value']."</td>";$empty=false;}else{$echo.= "<td class=\"null\">NULL</td>";}}
if(!$empty){$echo= "<tr><td class=\"row\" $style1>$i</td>".$echo."</tr>";}
else{$echo= "<tr><td class=\"row emptyrowcount\" $style1 >$i</td><td $style2 class=\"emptyrow\" colspan=\"".count($col)."\">Add data here.</td></tr>";}
echo $echo;
}
    echo "</table><div id=\"footpad\"><table id=\"inline_editor\" cellspacing=\"0\"><thead><tr><td style=\"border-radius:12px 0 0;\">RowNo.</td>";

for($i=0;$i<count($col);$i++){if($i==count($col)-1){echo "<td style=\"border-radius:0 12px 0 0;\">";}
else{echo "<td>";}
echo $col[$i]['name']."</td>";}

    echo "</tr></thead><tr><td class=\"row\" style=\"border-radius:0 0 0 12px;\"><textarea id=\"row_no\" style=\"width:45px;font-size:18px;color:#666;\">".($y+1)."</textarea></td>";
    $echo='';
    for($ii=0;$ii<count($col);$ii++){if($ii==(count($col)-1)){$echo.='<td style="border-radius:0 0 12px 0;">';}else{$echo.='<td>';}$echo.="<textarea id=\"val_$ii\" data-name=\"".$col[$ii]['name']."\"></textarea></td>";}
    echo $echo."</tr>";
echo "</table><div style=\"position: absolute; left: 0; width: 150px; height: 20px; padding: 5px 30px; background:url(/pic/add-new-row-titlestrip.jpg), #eee; border: 1px solid #ccc; top: 5px;border-left:0;border-radius:0 5px 5px 0;\"><button style=\" position:absolute;left:230px;width:80px;height:20px;top:0;\" class=\"whiteblue\" onclick=\"new i.data.insert\">Click to add</button></div></div>";
}else{echo "Table has no Colmns - There should be a Add Colmns UI";}
    ?></div><script>i.data.lastRow=<?php echo $y;?>;i.data.totalCols=<?php echo count($col);?>;i.data.tableid=<?php echo $tid;?>;i.data.tablename='<?php echo $uri[1];?>';</script></body></html><?php }?>