<?php 
if(isset($_SESSION['uid'])){
$uid = $_SESSION["uid"];
$q = "SELECT * FROM `lc_$database`.`apps_installed` WHERE `uid` = '$uid';";
$exe = mysqli_query($link , $q );
function fetchAppData($a){
include('link.php');
$nq = "SELECT * FROM `lc_$database`.`apps` WHERE `aid` = '$a';";
$exe_n = mysqli_query($link , $nq );
$nr = mysqli_fetch_array($exe_n , MYSQL_NUM);
return $nr;
}


//UI Functionality

$qui="SELECT * FROM `lc_$database`.`themes_sc` WHERE `id`=(SELECT `theme_id` FROM `lc_$database`.`users_theme_sc` WHERE `uid`='$uid');";
$exe_ui=mysqli_query($link,$qui);
$r_ui=mysqli_fetch_assoc($exe_ui);
if(mysqli_num_rows($exe_ui)>0){$fav_stream_bg=$r_ui['fav_stream_bgcolor'];}else{$fav_stream_bg='fav_stream_bg';}
    
//Favourite sources
    $fav=mysqli_query($link,"SELECT `favs` FROM `lc_$database`.`fav_sources` WHERE `uid` = '$uid';");
    $fav=mysqli_fetch_array($fav, MYSQL_NUM);
    $fav=$fav[0];$_SESSION['fav_sources']=$fav;
?>
<!DOCTYPE html >
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Cache-control" content="no-cache"/>
<link href="http://$domain/pic/favicon.ico" rel="shortcut icon" type="image/x-icon" />
<title>GTIS &#166; Spinal Cord</title>
<script src="http://$domain/store/lc/lc.js" type="text/javascript"></script>
<style type="text/css">
.inheritance{margin:0 auto;font-family: "Lucida Grande",  Helvetica, sans-serif, Verdana, Arial;background:#f2f2f2;min-width:900px;height:100%;}
#HeaderBar{background:#A6BEDF;border-top:1.5px solid #fff;width:100%;position:fixed;z-index:100001;color:#fff;font-size:8px;height:12px;overflow:hidden;border-bottom:1px solid white;}
.padding_4_10{padding:4px 0px 0px 10px;}
#Logout{float:right;color:#f2f2f2;background:#8D445E;border-left:1px solid #303066;height:24px;padding-left:10px;box-shadow:0 0 12pt 1pt #8D445E;width:50px;}
#Logout:hover{background:#AD3E3E;color:#fff;cursor:pointer;box-shadow:0 0 12pt 1pt #AD3E3E;}
#SideWindow{position:fixed;width:250px;z-index:100000;background:#f8f8f8;height:100%;padding:0px 0px 15px;border-left:1px solid #ababab;top:14px;}
#sideBarContent{height:100%;padding-bottom:200px;overflow:auto;}
.clearfloat{clear:both;height:0;line-height:0;}
.win{border:25px solid #fff;width:370px;height:453px;position:absolute;background:#e8e8e8;border-radius:12pt;box-shadow:0 0 3pt 1pt #666;}
.win:hover{box-shadow: 0px 0px 122px #fff;}
.topBar{top:-24px;height:0px;font-size:12px;z-index:-1;}
.winIframe{width:100%;height:100%;border:1px solid #e2e2e2;}
.v_align_top{vertical-align:top;}
#toolBar{background:#e0e0e0;border-bottom:2px solid #bababa;padding:25px 10px 10px;height:40px;z-index: 99998;position: fixed;width: 100%;}
#toolBar a.button{background:#e6e6e6;border:1px solid #ababab;padding:7px 9px;color:#2f2f2f;margin:0px 10px;position:relative;float:right;left:-350px;height:20px;}
#toolBar a.button:hover{background:#f2f2f2;}
#GS {margin:0px 12px 60px;width:300px;}
#input{width:300px;}
.GS_input{border:1px solid #cacaca;padding:5px 35px 3px 13px;width:280px;background:url('images/input_logo_bnw.png') center right no-repeat, #fff;font-size:16px;font-family:inherit;outline:none;border-radius:3pt;}
.dockpad{background:#fff;width:330px;max-height:300px;height:350px;position:absolute;z-index:3;overflow:hidden;display:none;border-radius:5pt;}
.left{float:left;}
.right{float:right;}
.padding_4_10{padding:4px 10px ;}
.height_98{height:98%;}
#parents{width:100px;font-size:14px;color:#666;padding:12px 0;}
#parents td{padding:3px 7px;}
#parents td:hover{color:#fff;background:#65b3e5;cursor:pointer;}
#parentsButtons{height:260px;overflow:auto;border-top:1px solid #ddd;}
#parentsTools{border-top:1px solid #ddd;padding:2px 7px;vertical-align:middle;}
#parentsTools span{margin-right:7px;cursor:pointer;}
#parentsTools img{position:relative;top:4px;}
#BirthPlace{width:229px;}
color:#cacaca;left:-10px;top:-3px;}
.shadow{-moz-box-shadow: 0 2px 4px #888888; -webkit-box-shadow: 0 2px 4px #888888; box-shadow: 0px 1px 3px #cacaca;}
#close_gs{position:relative;background:#fff;color:5b5b5b;display:none;font-size:12px;left:330px;cursor:pointer;width:60px;}
.search_title{background:#e3e3e3;padding:4px 10px;font-size:12px;width:100%;}
.border_right_only{border-width:0px 1px 0px 0px;border-style:solid;border-color:#cacaca;}
.minMiz{font-size:24px;color:#ababab;position:relative;top:-8px;height:0px;}
.circle{border:1px solid #ababab;border-radius:18px;height:18px;width:18px;margin-top:2px;}
.circle:hover{background:#f2f2f2;}
.circle:hover > .minMiz{color:#000;}
.abs{position:absolute;}
.rel{position:relative;}
.fix{position:fixed;}
.appIconS{width:16px;height:16px;}
.pointer{cursor:pointer;}
.winResizeIcon{position:relative;left:25px;float:right;cursor:se-resize;}
.v_resizeIcon{position:relative;left:15px;cursor:s-resize;display:none;}
.psuedoScreen{background:#000;opacity:0.3;height:390px;width:560px;z-index:10000;display:none;}
.sideBarResizer{position:absolute;width:6px;height:100%;background:#fff;cursor:w-resize;float:left;}
#CenterPsuedoScreen{display:none;width:10000px;height:10000px;position:fixed;z-index:9999;top:-120px;opacity:0.3;}
.profileMemo{background:#fafafa;padding:6px;margin-left:6px;color:#989898;border-bottom:2px solid #bababa;}
.username{font-size:18px;}
.netName{font-size:14px;vertical-align:top;}
.sideBarHidder{margin-left:-30px;background:#fff;border-width:1px 0px 1px 1px;border-style:solid;border-color:#ababab;padding:4px 8px;}
#sideBarNano{background:#fff;top:18px;right:0px;border:1px solid #ababab;z-index:99999;}
.sideBarAppTab{background:#E3EBF3;border-left:1px solid #CAD9E8;border-bottom:1px solid #CAD9E8;cursor:pointer;height:34px;text-align:center;}
.sideBarAppTab:hover{background:#CAD9E8;border-left:1px solid #B4CADF;border-bottom:1px solid #B4CADF;}
.notifCount{background:#fff;height:22px;color:red;padding:0px 2px;font-size:14px;margin-top:-5px;display:none;border:1px solid #B4CADF;}
#DockLaunchZone{position:fixed;left:0px;top:77px;height:30000px;background:#ababab;width:25px;z-index:9999;opacity:0.2;}
#DockBar{background:#fff;border-bottom:2px solid #454545;border-right:2px solid #454545;width:90px;min-height:580px;position:fixed;left:-90px;top:77px;z-index:10000;padding-left:12px;display:none;}
.DBD{background:#ababab;border:#bababa;height:8px;width:50px;position:relative;left:5px;}
tr.DB{height:70px;}
tr.DB:hover{background:#f2f2f2;border:1px solid #ababab;}
.border_down_only{border-width:0px 0px 1px 0px;border-style:solid;border-color:#cacaca;}
#searchPad div{border-bottom:1px solid #ccc;color:#fff;background:#999;}
#searchPad .serial{margin-right:7px;font-size:10pt;color:#666;padding:2px 5px;min-height:30px;float:left;background:#fff;}
#searchPad .serial:hover{background:#f2f2f2;cursor:pointer;}
.essential{background:url('http://$domain/pic/lc-essentials.png');}
    
    #newser{position:fixed;padding:0 25px 0;margin:55px 0 0 0;width: 67%;height: 100%;}
    #newser_title{background: #ccc; padding: 8px; color: white;font-size: 11px;}
    #newser_global{position:relative;float:left;width:50%;height:100%;}
    #ng_header{background: #B4B4B4;padding: 12px;color: white;text-align: center;}
    #ng_container{background:white;height:60%;padding:40px 0 340px;overflow:auto;}
    #newser_fav{position:relative;float:right;width:50%;height:100%;}
    #nf_header{background: rgba(255, 0, 0 ,0.33);padding: 12px 0;color: white;text-align: center; position:absolute;width:100%;z-index:100;}
    #nf_container{background:<?php echo $fav_stream_bg;?>;height:100%;padding: 80px 0;}
    
    .newsbox{width: 70%;margin-bottom: 20px;border: 1px solid rgb(238, 238, 238);position: relative;border-radius: 12px;overflow: hidden;text-align:left;}
    .newstime{background: #DBDBDB;color: rgb(107, 107, 107);font-size: 9px;padding: 3px 12px;border-radius:10px 10px 0 0;}
    .newsheadline{padding: 25px;color: #666;cursor: pointer;}
    .newsfoot{padding: 3px 12px;font-size: 11px;background: #eee;color: rgb(125, 180, 223);position: relative;border-radius:0 0 10px 10px;}
    .newsfoot a{position:relative;top:5px;cursor:pointer;margin-left:12px;}
    .small_round_pp{border-radius: 24px;height: 24px;width: 24px;background: white;display: inline-block;position: relative;float: right;}
</style>
<script type="text/javascript">
var sType=0;
function winSizeCircuit(X ,id){
var win = x(id);
if(X == 1){
new lc.win.ReOrderWins();
setTimeout("document.getElementById('"+id+"').style.zIndex="+(openDocs.length+1), 1);
hidee("SideWindow");
 win.style.top = "80px";
 win.style.left = "0";
 win.style.width = "97.4%";
 win.style.height = parseInt(parse(screen.height)- 225 )+'px';
 win.style.borderWidth = "25px 2px 25px 25px";
 hidee('wRI_'+id);
 showw('vRI_'+id);
 showw('sideBarNano');
 document.getElementById("AppAreaSizeSwitch"+id).src = "images/ContractIcon_twoArrow.png";
 document.getElementById("AppAreaSizeSwitch"+id).onclick = function(){winSizeCircuit('0' ,id);}
 
}
else{
 win.style.top = "";
 win.style.left = "";
 win.style.width = win.getAttribute('winWidth');
 win.style.height = win.getAttribute('winHeight');
 win.style.top = win.getAttribute('winTop');
 win.style.left = win.getAttribute('winLeft');
 win.style.borderWidth = "25px";
 document.getElementById("AppAreaSizeSwitch"+id).src = "images/ExpandIcon_twoArrow.png";
 document.getElementById("AppAreaSizeSwitch"+id).onclick = function(){winSizeCircuit('1' , id);}
 hidee('vRI_'+id);
 showw('wRI_'+id);
}
}

var openDocs = new Array();

function igniteWin(id,b){
if(typeof b == 'undefined'){b={};b.resize=1;}
try{var doc = document.getElementById('app'+id);}catch(e){}
if(typeof b.link == 'undefined'){var link=doc.getAttribute('data-link');}else{var link=b.link;}
if(typeof b.title == 'undefined'){var title=doc.getAttribute('data-title');}else{var title=b.title;}
if(typeof b.height == 'undefined'){b.height='453';}if(typeof b.width == 'undefined'){b.width='370';}
if(typeof b.logo == 'undefined' || b.logo===0){b.logo='/pic/noapplogo.png';}else{b.logo='/pic/'+b.logo+'-60';}
if( openDocs.indexOf(id) >= 0 ) {
var a=x('win_app'+id);
if(a.dataset.openDocId!=lc.win.focused){new lc.win.ReOrderWins();}
lc.win.focused=a.dataset.openDocId;
setTimeout("document.getElementById('win_app"+id+"').style.zIndex="+(openDocs.length+1) , 100);setTimeout("document.getElementById('win_app"+id+"').style.display=null" , 100);
if(typeof b.refresh!='undefined' && b.refresh=='1'){document.getElementById('iframe'+id).src=link;}
}else{
if(typeof b.resize==undefined){var resizable=true;}else if(b.resize=='0'){var resizable=false;}else{var resizable=true;}
var newDoc = document.createElement('div');
newDoc.setAttribute('id' , 'win_app'+id);
newDoc.setAttribute('class' , 'win');
newDoc.setAttribute('winWidth' , b.width+'px');
newDoc.setAttribute('winHeight' , b.height+'px');
newDoc.setAttribute('winTop' , '93px');
newDoc.setAttribute('winLeft' , '190px');
newDoc.setAttribute('style' , 'left:190px;top:93px;width:'+b.width+'px;height:'+b.height+'px;');
newDoc.style.zIndex=openDocs.length+2;
newDoc.dataset.openDocId=openDocs.length;
document.body.appendChild(newDoc);
if(resizable){document.getElementById('win_app'+id).innerHTML ='<div class="topBar rel" data-id="win_app'+id+'" align="right"><div class="pointer left abs circle" align="center" onclick="hidee(\'win_app'+id+'\')"><span class="minMiz"> - </span></div><div class="left rel" style="height:0px;left:45px;"><img src="images/ExpandIcon_twoArrow.png" class="pointer" id="AppAreaSizeSwitchwin_app'+id+'" style="margin-top:2px;" alt="Expand App Area" onclick="winSizeCircuit(\'1\' , \'win_app'+id+'\')"/></div><table><tr><td>'+title+'</td><td><img src="'+b.logo+'" class="appIconS"/></td></tr></table><br class="clearfloat"/></div><iframe src="'+link+'" class="winIframe"frameborder="0" id="iframe'+id+'"></iframe><img src="images/winResizeIcon.png" class="winResizeIcon" id="wRI_win_app'+id+'"/><img src="images/v_resizeIconLite.png" class="v_resizeIcon" id="vRI_win_app'+id+'"/>';}
else{document.getElementById('win_app'+id).innerHTML ='<div class="topBar rel" data-id="win_app'+id+'" align="right"><div class="pointer left abs circle" align="center" onclick="hidee(\'win_app'+id+'\')"><span class="minMiz"> - </span></div><table><tr><td>'+title+'</td><td><img src="'+b.logo+'" class="appIconS"/></td></tr></table><br class="clearfloat"/></div><iframe src="'+link+'" class="winIframe"frameborder="0" id="iframe'+id+'"></iframe>';}
openDocs[openDocs.length] = id;
lc.win.focused=newDoc.dataset.openDocId;
}
}
function MinWin(id){
var doc = document.getElementById('win_app'+id);
doc.style.display='none'; 
doc.style.zIndex=doc.dataset.openDocId; 
}

function showClass(x){
var y = document.getElementsByClassName(x), i;
for(i=0;i<y.length;i++){
y[i].style.display='block';
}
}
function hideClass(x){
var y = document.getElementsByClassName(x), i;
for(i=0;i<y.length;i++){
y[i].style.display='none';
}
}

function GSCR(){/*Generator System Curtain Raiser*/
document.getElementById("GS_Box").style.display = "block";
}

function link(l){
 window.location = l;
 }
 function showw(x){
 document.getElementById(x).style.display='block';
 } 
 function hidee(x){
 document.getElementById(x).style.display='none';
 }
 function slideRight(a , b ,c, y ,z , s){/*a = id of elem ;c=single frame displacement in pixels ;b=time duration of next frame; y= stoping point; z=code to exe after Stopping*/
 var asli = x(a);
 asli.style.right = (parseInt(asli.style.right.slice(0,-2))+c)+'px';
 if(parse(asli.style.right) >y){
 setTimeout("slideRight('"+a+"',"+b+","+c+","+y+",'"+z+"','"+s+"')",b);}
 else{eval(z);}
 }
 function slideLeft(a , b ,c, y ,z , s){/*a = id of elem ;c=single frame displacement in pixels ;b=time duration of next frame; y= stoping point; z=code to exe after Stopping*/
 var asli = x(a);
 asli.style.right = (parseInt(asli.style.right.slice(0,-2))+c)+'px';
 if(parse(asli.style.right) <y){
 setTimeout("slideLeft('"+a+"',"+b+","+c+","+y+",'"+z+"','"+s+"')",b);}
 else{eval(z);}
 }
 function dpm(e , z, a , b){
/*Dock Presence Manager*/
 if(e == null)
e = window.event;
window.eX=e.clientX;
 window.eY=e.clientY;
document.onmousemove = recordXY;
setTimeout(z+'('+b+')', a);

 }
 function recordXY(e){
 eX=e.clientX;
 eY=e.clientY;
 }
 function dpmx(){
 if(eX <= 25 && eY >= 77){
 showw('DockBar');
slideIN('DockBar', 20 , 10 , 0, '' );
}else{}
 }
 function dpmy(){
 if(eX > 92 || eY < 77){
slideOUT('DockBar', 20 , -10 , -90, 'hidee(a)' );

}else{}
 }
 function slideIN(a , b ,c, y ,z ){
 var asli = x(a);
 asli.style.left = (parseInt(asli.style.left.slice(0,-2))+c)+'px';
 if(parse(asli.style.left) <y){
 setTimeout("slideIN('"+a+"',"+b+","+c+","+y+",'"+z+"')",b);}
 else{eval(z);asli.style.left=y+'px';}
 }
 function slideOUT(a , b ,c, y ,z ){
 var asli = x(a);
 asli.style.left = (parseInt(asli.style.left.slice(0,-2))+c)+'px';
 if(parse(asli.style.left) >y){
 setTimeout("slideOUT('"+a+"',"+b+","+c+","+y+",'"+z+"')",b);}
 else{eval(z);asli.style.left=y+'px';}
 }
 function showHelpTxt(z){
 var hT=x('HelpTxt');
 if(eY>800 && eX>900){
 hT.style.left=(eX-150)+"px";
 hT.style.top=(eY-50)+"px";}
 else if(eX>900){
 hT.style.left=(eX-150)+"px";
 hT.style.top=(eY+25)+"px";}
 else if(eY>800){
 hT.style.left=(eX-50)+"px";
 hT.style.top=(eY-50)+"px";}
 
 else{
 hT.style.left=(eX-50)+"px";
 hT.style.top=(eY+25)+"px";}
 hT.innerHTML=z;
 showw('HelpTxt');
 }


var search={};
search.ini=function(){
var input=document.getElementById('theinput').value;
if(sType=='help'){var param='q='+input+'*&type=help';var afterEffects=function(){};}
else{var param='q='+input+'*';}
new ajax.request('search.php',{method:'GET',parameters:param,onSuccess:function(r){r=eval("("+r+")");new search.afterEffects(r);}});
}
search.afterEffects=function(a){var z=x('sPeople_content');z.innerHTML=a;}

var newsdata_new={"news":[
    <?php
    $news="SELECT `id`,`headline`, `timestamp`, `by`, (SELECT `name` FROM `lc_$database`.`avatar` WHERE `id` = `by`) AS `name`, (SELECT `pic` FROM `lc_$database`.`avatar` WHERE `id` = `by`) AS `userpic`, `attribute_one` FROM `lc_$database`.`stories` WHERE `type`='1' ORDER BY `timestamp` DESC LIMIT 25;";
     $newss=mysqli_query($link,$news);
    $newscount=mysqli_num_rows($newss);$i=1;$themes=array();$themes['h']=array();$themes['f']=array();
    while($news=mysqli_fetch_array($newss, MYSQL_NUM)){
        $pic=explode('-',$news[5]);
        $attris=explode(';', $news[6]);
        if(count($attris)<3){$attris[0]="white;#666";$attris[1]="#eee;rgb(125, 180, 223";$attris[2]="0";}
        else{
            if(!isset($themes['h'][$attris[0]])){
                $h=mysqli_query($link,"SELECT `value` FROM `lc_$database`.`theme_headline` WHERE `id`='$attris[0]' OR `id` = '$attris[1]' ORDER BY `property` ASC");
                $ii=0;while($ui=mysqli_fetch_array($h, MYSQL_NUM)){
                    if($ii == 0){$themes['h'][$attris[0]]=$ui[0];$attris[0]=$ui[0];$ii++;}
                    else{$themes['f'][$attris[1]]=$ui[0];$attris[1]=$ui[0];}
                }
            }else{$attris[0]=$themes['h'][$attris[0]];$attris[1]=$themes['f'][$attris[1]];}
        }
        echo "{\"id\":\"$news[0]\", \"title\":\"$news[1]\", \"time\":\"".$news[2]."\", \"username\":\"$news[4]\", \"userpic\":\"$pic[0]\", \"ui_headline\":\"$attris[0]\", \"ui_foot\":\"$attris[1]\", \"explicity\":\"$attris[2]\"}";
        if($i != $newscount){echo ',';}
        $i++;
    }
    ?>
        ]};

var renderNews=function(a){// a ={pad:'globalORfav', type:'newORold', data:data_variable}
    if(a.pad == 'global'){var pad=x('ng_container');}else{var pad=x('nf_container');}
    var i;
    if(a.type == 'new'){for(i=(a.data.news.length-1);i>=0;i--){new realsteel();}}
    else{for(i=0;i<a.data.news.length;i++){new realsteel();}}
    function realsteel(){
        var nb=document.createElement('div');nb.className='newsbox';nb.id='nbn_'+a.data.news[i].id;
        var nbt=document.createElement('div');nbt.className='newstime';nbt.id='nbnt_'+a.data.news[i].id;nbt.innerHTML=lc.timer(a.data.news[i].time);
        var nbh=document.createElement('div');nbh.className='newsheadline';nbh.id='nbnh_'+a.data.news[i].id;nbh.innerHTML=a.data.news[i].title;nbh.setAttribute("data-explicity",a.data.news[i].explicity);nbh.setAttribute('data-time', a.data.news[i].time);nbh.setAttribute('data-title', a.data.news[i].title);
        var nbf=document.createElement('div');nbf.className='newsfoot';nbf.id='nbnf_'+a.data.news[i].id;nbf.setAttribute('align','right');
        var nbfol=document.createElement('a');nbfol.id='nbnfol_'+a.data.news[i].id;nbfol.innerHTML='Open Later';nbfol.style.float='left';
        var nbfnm=document.createElement('a');nbfnm.id='nbnfnm_'+a.data.news[i].id;nbfnm.innerHTML=a.data.news[i].username;
        var nbfpp=document.createElement('a');nbfpp.id='nbnfpp_'+a.data.news[i].id;nbfpp.className='small_round_pp';nbfpp.style.float='right'; nbfpp.setAttribute("style","background:url(http://$domain/pic/"+a.data.news[i].userpic+"-0-30) center center no-repeat;top:0px;border:1px solid #ccc;background-color:white;");
        var nbfbr=document.createElement('br');nbfbr.className='clearfloat';
        if(a.type == 'new'){pad.insertBefore(nb , pad.firstChild);}else{pad.appendChild(nb);}
        nb.appendChild(nbt);nb.appendChild(nbh);nb.appendChild(nbf);
        nbf.appendChild(nbfol);nbf.appendChild(nbfnm);nbf.appendChild(nbfpp);nbf.appendChild(nbfbr);
        
        var hl_ui=a.data.news[i].ui_headline.split(';');nbh.style.background=hl_ui[0];nbh.style.color=hl_ui[1];
        var ft_ui=a.data.news[i].ui_foot.split(';');nbf.style.background=ft_ui[0];nbf.style.color=ft_ui[1];
    }
}
new lc.sensor.ini();
    lc.sensor.act.click=function(){
        if(tClick.id.slice(0,4) == 'nbnh'){
            if(parseInt(tClick.getAttribute('data-explicity')) == 1){
                var msg="<a style=\"border: 3px solid rgb(253, 215, 215);border-radius: 24px;padding: 5px;height: 24px;width: 24px;text-align: center;font-size: 24px;color: rgb(235, 183, 183);\">&nbsp;A&nbsp;</a><h1 style=\"color:#FF9999;\">Explicit content</h1><p style=\"color:lightgrey;\">Post may contain nudity, voilence or sexual content.</p><span>Do you want to open it?</span>";
                new lc.confirm(msg, function(){new lc.fullview.render({id:parseInt(tClick.id.slice(5)), type:'news', time: tClick.getAttribute('data-time'), title: tClick.getAttribute('data-title')});}, true);
            }
            else{new lc.fullview.render({id:parseInt(tClick.id.slice(5)), type:'news', time: tClick.getAttribute('time'), title: tClick.getAttribute('data-title')});}
        }
    }
    
    var fav="<?php echo $fav;?>";fav=fav.split(';');
    var favnewsdata_new={"news":[
    <?php
    if($fav != ''){
        $fav=explode(';', $fav);$search_param="AND (";
        for($i=0; $i<count($fav); $i++){
            if($i != 0){ $search_param.=" OR `by` = '$fav[$i]'";}
            else{$search_param.="`by` = '$fav[$i]'";}
        }
        $search_param.=")";
    
    }else{$search_param=" AND `id` = ''";}
    $news="SELECT `id`,`headline`, `timestamp`, `by`, (SELECT `name` FROM `lc_$database`.`avatar` WHERE `id` = `by`) AS `name`, (SELECT `pic` FROM `lc_$database`.`avatar` WHERE `id` = `by`) AS `userpic`, `attribute_one` FROM `lc_$database`.`stories` WHERE `type`='1' $search_param ORDER BY `timestamp` DESC LIMIT 25;";
     $newss=mysqli_query($link,$news);
    $newscount=mysqli_num_rows($newss);$i=1;$themes=array();$themes['h']=array();$themes['f']=array();
    while($news=mysqli_fetch_array($newss, MYSQL_NUM)){
        $pic=explode('-',$news[5]);
        $attris=explode(';', $news[6]);
        if(count($attris)<3){$attris[0]="white;#666";$attris[1]="#eee;rgb(125, 180, 223";$attris[2]="0";}
        else{
            if(!isset($themes['h'][$attris[0]])){
                $h=mysqli_query($link,"SELECT `value` FROM `lc_$database`.`theme_headline` WHERE `id`='$attris[0]' OR `id` = '$attris[1]' ORDER BY `property` ASC");
                $ii=0;while($ui=mysqli_fetch_array($h, MYSQL_NUM)){
                    if($ii == 0){$themes['h'][$attris[0]]=$ui[0];$attris[0]=$ui[0];$ii++;}
                    else{$themes['f'][$attris[1]]=$ui[0];$attris[1]=$ui[0];}
                }
            }else{$attris[0]=$themes['h'][$attris[0]];$attris[1]=$themes['f'][$attris[1]];}
        }
        echo "{\"id\":\"$news[0]\", \"title\":\"$news[1]\", \"time\":\"".$news[2]."\", \"username\":\"$news[4]\", \"userpic\":\"$pic[0]\", \"ui_headline\":\"$attris[0]\", \"ui_foot\":\"$attris[1]\", \"explicity\":\"$attris[2]\"}";
        if($i != $newscount){echo ',';}
        $i++;
    }
    ?>
        ]};
    
 window.onload = function(){var xyz=x('netName');
 if(xyz.innerHTML.length > 15){xyz.innerHTML=xyz.innerHTML.slice(0,10)+'...'+xyz.innerHTML.slice(-2); new renderNews({pad:'global', type:'new', data:newsdata_new}); new renderNews({pad:'fav', type:'new', data:favnewsdata_new});}}
</script>
</head>
<body class="inheritance" id="body">
<div style="width:45px;height:45px;border-radius:45px;background:url(http://$domain/pic/integrated_logo_40_dark.png) center center no-repeat;background-color:white;border:1px solid #ccc;position:fixed;bottom:55px;right:55px;"></div>
 
<div id="HelpTxt" class="abs" style="background:#cecece;border:1px solid #a6a6a6;color:#fff;font-size:14px;padding:4px 19px 4px 4px;margin:5px 0 0 60px;width:67px;display:none;z-index:100002;" onclick="hidee('HelpTxt')"></div><div id="HeaderBar"><div id="Logout" onclick="link('LogOut.php');">Logout</div><div class=""> &nbsp;&nbsp;&nbsp; GTIS &nbsp;&nbsp;&nbsp;&#166;&nbsp;&nbsp;&nbsp; Spinal Cord</div></div><div id="toolBar"><a id="app5" class="button pointer" data-title="Ed-it" data-link="apps/ed-it/" onclick="igniteWin(5);">Edit <img src="/pic/blank.gif" class="essential" style="background-position:-238px -22px;height:20px;width:20px;"/></a><a id="app4" class="button pointer" onclick="igniteWin(4);" data-title="The New" data-link="apps/new/">New <img src="/pic/blank.gif" class="essential" style="background-position:0 -18px;height:20px;width:20px;"/></a><div id="GS" ><div id="input"><input type="text" class="GS_input shadow" id="theinput" onfocus="showw('Dockpad');showw('close_gs');" onkeyup="search();"/></div><div id="Dockpad" class="dockpad shadow"><div id="parents" class="border_right_only left height_98"><div id="parentsButtons"><table border="0" cellspacing="0" width="100%" ><tr><td>Help</td></tr><tr><td>Tweet it</td></tr><tr><td>FB Share</td></tr></table></div><div id="parentsTools"><span style="color:#60c528;">+</span><span style="color:#f21b25;">-</span><span><img src="images/adjust-icon.png"/></span></div></div><div id="BirthPlace" class="left"><table cellspacing="0" width="100%" id="searchPad"><tr><td class="search_title border_down_only" id="s_page_title">Pages</td></tr><tr><td id="s_page_content"><div id="s_page_i"><span class="serial">1</span> Something found<br class="clearfloat"/></div></td></tr><tr><td id="s_people_title" class="search_title border_down_only">People</td></tr><tr><td id="s_people_content"><div id="s_people_i"><span class="serial">0</span> There is Nothing found<br class="clearfloat"/></div><div id="s_people_i"><span class="serial">1</span> Something Found<br class="clearfloat"/></div></td></tr></table></div><br class="clearfloat" /></div><a class="padding_4_10" id="close_gs" onclick="hidee('Dockpad');hidee('close_gs')">X Close</a></div></div><div id="DockLaunchZone" onmouseover="dpm(null , 'dpmx',1500,'');"onclick="dpm(null , 'dpmx',0,'');"></div><div id="DockBar" style="left:-90px;" onmouseout="dpm(null , 'dpmy',1500,'')"><table>
<?php 
 
$appDSaved=array();
while($r = mysqli_fetch_array($exe , MYSQL_NUM)){
$appData=fetchAppData($r[2]);$appDSaved[$r[2]]=array();$appDSaved[$r[2]]['name']=$appData[1];$appDSaved[$r[2]]['hostBase']=$appData[6];$appDSaved[$r[2]]['desc']=$appData[7];$appDSaved[$r[2]]['logo']=$appData[10];$appDSaved[$r[2]]['resize']=$appData[11];$appDSaved[$r[2]]['icon']=explode(';',$appData[12]);$dimension=explode(';',$appData[13]);if(count($dimension)!=2){$dimension[0]=370;$dimension[1]=453;} $appDSaved[$r[2]]['width']=$dimension[0];$appDSaved[$r[2]]['height']=$dimension[1];
if(count($appDSaved[$r[2]]['icon'])<2){$appDSaved[$r[2]]['icon']=array();$appDSaved[$r[2]]['icon'][0]='#666';$appDSaved[$r[2]]['icon'][1]='white';}
if($appData[10]!=''){$appLogo = "/pic/$appData[10]-60";$logo=$appData[10];}else{$appLogo = '/pic/noapplogo.png';$logo=0;} $appDSaved[$r[2]]['logo']=$logo;
echo "<tr id=\"app$r[2]\" class=\"DB pointer\" onclick=\"igniteWin('$r[2]',{resize:'$appData[11]',logo:'$logo',width:'$dimension[0]px',height:'$dimension[1]px'})\" onmouseover=\"dpm(null,'showHelpTxt',0,'\'".$appData[1]."\'')\" onmouseout=\"hidee('HelpTxt')\" data-title=\"".$appDSaved[$r[2]]['name']."\" data-link=\"".$appDSaved[$r[2]]['hostBase']."\"><td ><img src=\"$appLogo\" class=\"app_logo\"/><div id=\"DBD$r[2]\" class=\"DBD\"></div></td></tr>";
}
echo "<tr class=\"DB pointer\" onclick=\"link('apps/')\" onmouseover=\"dpm(null,'showHelpTxt',0,'\'App Showroom\'')\" onmouseout=\"hidee('HelpTxt')\"><td ><img src=\"images/apps/appLogo50.png\" class=\"app_logo\"/><div id=\"DBD0\" class=\"DBD\"></div></td></tr>";
?>
</table></div><div id="CenterPsuedoScreen" onclick="hidee('CenterPsuedoScreen')"></div><div id="sideBarNano" class="fix" onclick="showw('SideWindow'); slideLeft('SideWindow', 52, 20,0,'','');"><table><tr><td style="font-size:12px;padding:3px;cursor:pointer;" onmouseover="dpm(null,'showHelpTxt',0,'\'Show SideBar\'')"onmouseout="hidee('HelpTxt')"><img src="images/leftDiractorLight.png"/></td><td class="sideBarAppTab"><div class="notifCount abs">5000</div><img src="images/notificationIcon.png"/></td><td class="sideBarAppTab"><div class="notifCount abs">50</div><img src="images/newsroomIcon.png"/></td></tr></table></div><div id="SideWindow" style="right:0px;"><div class="sideBarResizer"></div><div class="profileMemo"><span class="username"><?php echo $_SESSION['userFname']." ".$_SESSION['userLname']; ?></span><br/><img src="<?php $pic='images/netpics/'.$_SESSION['netPic'].'_50.png'; if(file_exists($pic)){echo $pic;}else{echo "images/netpics/no_pp_50.png";} ?>" style="width:25px;height:25px;"/><span class="netName"id="netName"> <?php echo $_SESSION['networkName']; ?></span><img src="/pic/blank.gif" class="essential" style="background-position:-280px -22px;height:20px;width:20px;margin:0 12px 0 12px;" onmouseover="dpm(null,'showHelpTxt', 0,'\'Change Network\'');"onmouseout="hidee('HelpTxt');" onclick="window.location='NetworkSelect/'"/></div><div class="sideBarHidder abs pointer" id="sideBarHidder" onclick="slideRight('SideWindow', 20, -20,-250,'hidee(a);','');" onmouseover="dpm(null,'showHelpTxt', 0,'\'Hide Side Bar\'');"onmouseout="hidee('HelpTxt')"> <img src="images/rightDiractorLight.png"/></div><div id="sideBarAppTabs"><table style="width:100%;"cellspacing="0"><tr><td class="sideBarAppTab" onmouseover="dpm(null,'showHelpTxt', 0,'\'Notifications\'');"onmouseout="hidee('HelpTxt')"><div class="notifCount abs">50</div><img src="images/notificationicon.png"/></td><td class="sideBarAppTab" onmouseover="dpm(null,'showHelpTxt', 0,'\'Newsroom\'');"onmouseout="hidee('HelpTxt')"><div class="notifCount abs">150</div><img src="images/newsroomicon.png"/></td></tr></table></div><div id="sideBarContent"><input type="text" onchange="igniteWin(11,{link:'/avatar/?uname='+this.value, title:'Avatar',refresh:'1',resize:'0',height:543})" /></div></div><br class="clearfloat"/>
    <div id="newser">
        <div id="newser_title" align="left">Newser</div>
        <div id="newser_global">
            <div id="ng_header">Global</div>
            <div id="ng_container" align="center">
            </div>
        </div>
        <div id="newser_fav">
            <div id="nf_header">Favorite</div>
            <div id="nf_container" align="center">
                <div id="nfn_i"></div>
            </div>
        </div>
        <br class="clearfloat"/>
    </div>
<script type="text/javascript">
var eXini , eYini , winThis , offX , offY;
iniDD();
function iniDD(){
document.onmousedown=onMD;
document.onmouseup=onMU;
}
function onMD(e){
if(e == null)
e = window.event;
window.t = e.target != null ? e.target : e.srcElement;
if ((e.button == 1 && window.event != null || e.button == 0))
	{
	if(t.className == 'win'){
	
	winThis = x(t.id);
    if(winThis.dataset.openDocId!=lc.win.focused){new lc.win.ReOrderWins();
    setTimeout('winThis.style.zIndex="'+(openDocs.length+1)+'"', 1);}
	fetchInfo(e);
	showw('CenterPsuedoScreen');
	document.onmousemove = shift;
    lc.win.focused=winThis.dataset.openDocId;
    window.winIniX=parseInt(winThis.getAttribute('winleft').slice(0,-2));
    window.winIniY=parseInt(winThis.getAttribute('wintop').slice(0,-2));
	returnFalse();
	}
	if(t.className == 'winResizeIcon'){
	winThis = x(t.id.slice(4));
	fetchInfo(e);
	document.onmousemove = resize;
	showw('CenterPsuedoScreen');
	returnFalse();
	}
	if(t.className == 'v_resizeIcon'){
	winThis = x(t.id.slice(4));
	fetchInfo(e);
	document.onmousemove = resizeV;
	showw('CenterPsuedoScreen');
	returnFalse();
	}
	if(t.className == 'sideBarResizer'){
	winThis = x('SideWindow');
	eXini = e.clientX;
	eYini = e.clientY;
	document.body.style.cursor='e-resize';
	showw('CenterPsuedoScreen');
	if(winThis.style.right == '' || parseInt(winThis.style.right.slice(0 , -2))>=0){document.onmousemove = inimoveSideWin;}else{
	window.iniSideBarRight=parseInt(winThis.style.right.slice(0 , -2));
	document.onmousemove = moveSideWin;}
	
	returnFalse();
	}
	
	}
}
function shift(e){
document.body.style.cursor = 'move';
winThis.style.top = parseInt((offY - parseInt(eYini))+e.clientY) +'px';
winThis.style.left = parseInt((offX - parseInt(eXini))+e.clientX) +'px';
new lc.shake.sensor();
}
function resize(e){
document.body.style.cursor = 'se-resize';
winThis.style.width = parseInt((e.clientX - offX) - 25) +'px';
winThis.style.height = parseInt((e.clientY - offY) - 25) +'px';
}
function resizeV(e){
document.body.style.cursor = 's-resize';
winThis.style.height = parseInt((e.clientY - offY) - 25) +'px';
}
function inimoveSideWin(e){
if(e.clientX > eXini){
winThis.style.right =  -e.clientX + eXini+'px';
}}
function moveSideWin(e){
if(parseInt(winThis.style.right.slice(0 , -2)) < 0){
winThis.style.right = parseInt(iniSideBarRight - parseInt(e.clientX-eXini))+'px';

}}
function onMU(e){
if(winThis != null){

if(t.className == 'winResizeIcon'){hidee('CenterPsuedoScreen');winThis.setAttribute('winWidth' ,winThis.style.width );winThis.setAttribute('winHeight' ,winThis.style.height );}
if(t.className == 'v_resizeIcon'){hidee('CenterPsuedoScreen');}
if(t.className == 'win'){hidee('CenterPsuedoScreen');winThis.setAttribute('winTop' ,winThis.style.top );winThis.setAttribute('winLeft' ,winThis.style.left );lc.shake.frequency=0;lc.shake.Xgate=0;lc.shake.Ygate=0;}
if(t.className == 'sideBarResizer'){if(parseInt(winThis.style.right.slice(0,-2))>0){winThis.style.right='0px';} hidee('CenterPsuedoScreen');}
if(parseInt(winThis.style.left.slice(0,-2)) < -(parseInt(winThis.getAttribute('winwidth')+25)))
{winThis.style.left=-(winThis.getAttribute('winwidth').slice(0,-2)-30)+'px';winThis.setAttribute('winLeft' ,winThis.style.left );}
if(parseInt(winThis.style.top.slice(0,-2)) < -(parseInt(parseInt(winThis.getAttribute('winheight'))-50)))
{winThis.style.top=-(winThis.getAttribute('winheight').slice(0,-2)-80)+'px';winThis.setAttribute('winTop' ,winThis.style.top );}
        document.body.style.cursor = null;

        document.onmousemove = null;
		document.onselectstart = null;
		winThis.ondragstart = null;
		winThis = null;
}
}
function parse(value)
{
	var n = parseInt(value);
	
	return n == null || isNaN(n) ? 150 : n;
}
function x(y){
return document.getElementById(y);
}
function returnFalse(){
document.body.focus();
    document.onselectstart = function () { return false; };
    winThis.ondragstart = function() { return false; };
	}
	
	function fetchInfo(e){
	eXini = e.clientX;
	eYini = e.clientY;
	
	offX = parse(winThis.style.left);
	offY = parse(winThis.style.top);}
	

</script>
</body>
</html>
<?php }else{header("Location: http://$domain");}exit();?>