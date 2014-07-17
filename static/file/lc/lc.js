//========+++++TheAjaxorama++++==========
window.ajax = new Object();
ajax.request = function (x, y) {
var param = y.parameters;
if(y.method != 'undefined'){if(y.method == 'post'){var method = 'POST';}else if(y.method == 'get'){var method = 'GET';}else{var method = y.method;}}else{var method ='GET';}
if(method == 'GET'){x = x + "?" + param;}

if(y.sync != 'undefined'){var sync=y.sync;}else{var sync="true";}
var c;
if (window.XMLHttpRequest){c=new XMLHttpRequest();}
else{c=new ActiveXObject("Microsoft.XMLHTTP");}
c.open(method, x , "true");
if(typeof y.contentType == 'undefined'){c.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
}else{if(y.contentType == false){}else if(y.contentType==true){c.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");}else{c.setRequestHeader("Content-Type", y.contentType);}
}
c.send(param);

c.onreadystatechange=function(){
  if (c.readyState==4 && (c.status==200 || c.status==404)){
      if(y.onSuccess=='undefined' || y.onSuccess==null){}else{new y.onSuccess(c.responseText);}}
    else if(c.readyState==2 && (c.status==200 || c.status==404)){try{new y.onCreate;}catch(e){}}}};

ajax.pulseFx=function(i,u,a){var Fx=new ajax.request(u,{method:a.method,parameters:a.parameters,onSuccess:function(r){new a.onSuccess(r);new ajax.updater(i,r,a.insertion);}});window['ex'+i]= setInterval(Fx,a.frequency*1000);}
ajax.updater=function(i,r,type){
    if(type==='top'){x(i).insertBefore(document.createTextNode(r),x(i).firstChild);}
    else if(type==='bottom'){x(i).appendChild(document.createTextNode(r));}
    else{x(i).innerHTML=r;}
}
ajax.stopPulseFx=function(i){clearInterval(window['ex'+i]);}
//=======++LC-aNewElement++==========

window.lc=new Object();

//----StandAlones---------

lc.debug=function(a){/*var debugPad=x(a.pad); debugPad.innerHTML=a.info;*/new lc.slNotification(a.info);}


//-------++WINDOWSYSTEM-TheWindowsFunctionality++----------
lc.win={};

lc.win.focused=null;

lc.win.ReOrderWins=function(x){
var i;
for(i=0;i<openDocs.length;i++){
var idthis = openDocs[i];
var thisdoc = document.getElementById('win_app'+idthis);
thisdoc.style.zIndex=i;}
}
lc.win.new=function(a){//a.link,a.name,a.type(optional)

}


//----------++ShakeSensor++---------------------

lc.shake={};
lc.shake.Xgate=lc.shake.Ygate=0;
lc.shake.frequency=0;
lc.shake.afterEffects={};
lc.shake.sensor=function(){
       
       window.curX= parseInt(winThis.style.left.slice(0,-2)); 
       window.curY= parseInt(winThis.style.top.slice(0,-2));
       if(curX<(winIniX-7)){if(lc.shake.Xgate==0){lc.shake.frequency+=1;lc.shake.Xgate=1;}}
       else if(curX>(winIniX+7)){if(lc.shake.Xgate==0){lc.shake.frequency+=1;lc.shake.Xgate=1;}}
       else if(curX>(winIniX-7)){lc.shake.Xgate=0;}
       if(curY<(winIniY-7)){if(lc.shake.Ygate==0){lc.shake.frequency+=1;lc.shake.Ygate=1;}}
       else if(curY>(winIniY+7)){if(lc.shake.Ygate==0){lc.shake.frequency+=1;lc.shake.Ygate=1;}}
       else if(curY>(winIniY-7)){lc.shake.Ygate=0;}
       if(lc.shake.frequency>4){new ajax.request('apps/shake/fetcher.php',{method:"POST",parameters:"aid="+winThis.id.slice(7),onSuccess:function(a){var r=eval("("+a+")");
if(parseInt(r['signal'])==1)
eval("new "+r['func']);
else
  new lc.shake.afterEffects.act;
}});lc.shake.frequency=0;}
       
        }

lc.shake.afterEffects.act=function(){try{eval("new lc.shake.afterEffects.id"+winThis.id.slice(7)+";");}catch(e){var f=x('iframe'+winThis.id.slice(7));f.src=f.src;}}

lc.shake.afterEffects.setter=function(a,b,c,d){new ajax.request(b,{method:'POST',parameters:'func='+a+'&state='+c+'&aid='+d});}

lc.shake.afterEffects.id2=function(z){var head=x('body');head.style.background='green';}

//------------------++Animation++------------------

lc.anim={};

lc.anim.fade=function(a)
{if(a.type=="in"){
    var o=x(a.id);if(o.style.display=='none' || o.style.opacity<0.2 || o.style.visibility=='hidden'){o.style.display='block';o.style.visibility='visible';o.style.opacity=0.2;}o.style.opacity=-(-(o.style.opacity)-(0.1));
    if(o.style.opacity>=1){new a.afterEffect;}else{setTimeout("new lc.anim.fade({type:'"+a.type+"',id:'"+a.id+"',afterEffect:"+a.afterEffect+"});",100);}}
    else if(a.type=="out"){var o=x(a.id);o.style.opacity=(o.style.opacity-0.1);
                             if(o.style.opacity<=0.2){new a.afterEffect();}
else{setTimeout("new lc.anim.fade({type:'"+a.type+"',id:'"+a.id+"',afterEffect:"+a.afterEffect+"});",100);}}}


lc.anim.vertical=function(v){/*attributes  {id,distance,type(^,v),time,limit,fx} /// USE lc.anim.slide instead*/
var aay = x(v.id);aay=aay.style.top;
var new_pos = parseInt(aay.slice(0 , -2));
new_pos = new_pos+parseInt(v.distance);
document.getElementById(v.id).style.top = new_pos+'px';
if(v.type=='^'){if(new_pos >= parseInt(v.limit)){setTimeout('new lc.anim.vertical({type:\''+v.type+'\',id:\''+v.id+'\',fx:'+v.fx+',distance:'+v.distance+',time:'+v.time+',limit:'+v.limit+'});' , parseInt(v.time));}else{eval(new v.fx(v));}}else{
if(new_pos <= parseInt(v.limit)){setTimeout('new lc.anim.vertical({type:\''+v.type+'\',id:\''+v.id+'\',fx:'+v.fx+',distance:'+v.distance+',time:'+v.time+',limit:'+v.limit+'});' , parseInt(v.time));}else{eval(new v.fx(v));}}
}
lc.anim.height={};/*Not Finished*/
lc.anim.height.inc=function(a){if(a.t != undefined || a.t != null){var t=a.t;a.id=null;}else{var t=x(a.id);}lc.alert(parseInt(t.style.height.slice(0,-2)));if(parseInt(t.style.height.slice(0,-2))<a.limit){t.style.height=parseInt(t.style.height.slice(0,-2))+a.sum;setTimeout("new lc.anim.height.inc({t:"+a.t+",sum:"+a.sum+",limit:"+a.limit+",fps:"+a.fps+"});",a.fps);}else{}}

lc.anim.scrolsoft=function(a){a.element.scrollTop=a.element.scrollTop;}

lc.anim.base=function(a){
if(a.t != undefined || a.t != null){var t=a.t;a.id=null;}else{var t=x(a.id);}
if(a.type=='+'){
/* On Hold */
}

function action(){

if(a.animate=='scroll'){
if(a.type==a){}
t.scrollTop=(t.scrollTop+parseInt(a.sum))+'px';

}
}
}

lc.anim.slide=function(a){
try{var asli = x(a.id);}catch(e){return false;}
var status=0;
if(a.dir==='left' || a.dir==='right' || a.dir==='<' || a.dir==='>'){
if(a.reference=='right'){
     if(a.dir=='left' || a.dir=='<'){
            asli.style.right = (parseInt(asli.style.right.slice(0,-2))+a.distance)+'px';
             if(parseInt(asli.style.right.slice(0,-2)) > a.stopAt){status=1;asli.style.right=a.stopAt+'px';}}
     if(a.dir=='right' || a.dir=='>'){
            asli.style.right = (parseInt(asli.style.right.slice(0,-2))-a.distance)+'px';
             if(parseInt(asli.style.right.slice(0,-2)) < a.stopAt){status=1;asli.style.right=a.stopAt+'px';}}}
else{if(a.dir=='left' || a.dir=='<'){
            asli.style.left = (parseInt(asli.style.left.slice(0,-2))-a.distance)+'px';
             if(parseInt(asli.style.left.slice(0,-2)) < a.stopAt){status=1;asli.style.left=a.stopAt+'px';}}
     if(a.dir=='right' || a.dir=='>'){
            asli.style.left = (parseInt(asli.style.left.slice(0,-2))+a.distance)+'px';
             if(parseInt(asli.style.left.slice(0,-2)) > a.stopAt){status=1;asli.style.left=a.stopAt+'px';}}}}
else{
if(a.reference=='top'){
     if(a.dir==='down' || a.dir==='v' || a.dir==='V'){
            asli.style.top = (parseInt(asli.style.top.slice(0,-2))+a.distance)+'px';
             if(parseInt(asli.style.top.slice(0,-2)) > a.stopAt){status=1;asli.style.top=a.stopAt+'px';}}
     if(a.dir==='up' || a.dir==='^'){
            asli.style.top = (parseInt(asli.style.top.slice(0,-2))-a.distance)+'px';
             if(parseInt(asli.style.top.slice(0,-2)) < a.stopAt){status=1;asli.style.top=a.stopAt+'px';}}}
else{if(a.dir==='down' || a.dir==='v' || a.dir==='V'){
            asli.style.bottom = (parseInt(asli.style.bottom.slice(0,-2))-a.distance)+'px';
             if(parseInt(asli.style.bottom.slice(0,-2)) < a.stopAt){status=1;asli.style.bottom=a.stopAt+'px';}}
     if(a.dir=='up' || a.dir=='^'){
            asli.style.bottom = (parseInt(asli.style.bottom.slice(0,-2))+a.distance)+'px';
             if(parseInt(asli.style.bottom.slice(0,-2)) > a.stopAt){status=1;asli.style.left=a.stopAt+'px';}}}
}
if(status==1){try{new a.AFx}catch(e){}}
else{setTimeout("new lc.anim.slide({id:'"+a.id+"',framegap:"+a.framegap+",distance:"+a.distance+",stopAt:"+a.stopAt+",AFx:"+a.AFx+",reference:'"+a.reference+"',dir:'"+a.dir+"'})",a.framegap);}

    /*//Important Terms :::  
    //      framegap = time between two consicutive frame.
    //      distance = Distance to be covered in one frame (loop).
    //      stopAt = The numeric value where function has to stop sliding the object. eg. If obj is to be stopped at -120px left then it should be -120
    //      reference = Left, right, top or bottom . It is the refernce that "distance" gonna use.
    //      dir = up or down , left or right . We can also use v V ^ > <  
    //      AFx = What to do when this task is done.*/
}

window.reFx=new Array();
lc.anim.prop = function(a){ //{ id:id of object,  type:+ or - , propname: name of property eg. margin, stopAt: Where to stop, framegap: Time between two frames, jump: jump of value to made in each frame, float:if values are in decimal(true if so; default is false), unit:measuring unit (eg. px, em etc.; default is px) AFx: After Effects }
    var o=x(a.id);var val=o.style[a.propname];
    if(typeof a.unit === 'undefined'){a.unit='px';}
    if(typeof a.float === 'undefined'){a.float=false;}
    window.reFx[a.propname]="new lc.anim.prop({id:'"+a.id+"', type:'"+a.type+"', propname:'"+a.propname+"', stopAt:"+a.stopAt+", framegap:"+a.framegap+", jump:"+a.jump+", float:"+a.float+", unit:'"+a.unit+"', AFx:"+a.AFx+"})";
    if(a.unit != ''){val=val.slice(0 , -(a.unit.length));}
    if(a.float == true){val=parseFloat(val);}else{val=parseInt(val);}
    if(a.type=="+" && val < a.stopAt){
        if(a.float == true){val=parseFloat(val+a.jump);}else{val=parseInt(val+a.jump);}
        o.style[a.propname]=val+a.unit;
        setTimeout(window.reFx[a.propname],a.framegap);
    }else if(a.type=="-" && val > a.stopAt){
        if(a.float == true){ val=parseFloat(val-a.jump);}else{val=parseInt(val-a.jump);}
        o.style[a.propname]=val+a.unit;
        setTimeout(window.reFx[a.propname],a.framegap);
    }else{o.style[a.propname]=a.stopAt+a.unit;new a.AFx;}
}
lc.anim.color = function(a){
    
}

//----------++Indicator++------------

lc.indicator={};window.indicDotIni=0;
lc.indicator.start=function(padid,theme,color){
if(theme=='horzDotLoop'){var pad=x(padid);window.dotFrame=0;
                  if(window.indicDotIni!=1){dot=document.createElement('div');
                  dot.setAttribute('style','background:'+color+';width:15px;height:15px;border-radius:15px;position:relative;');
                  dot.setAttribute('id','dot'+padid);pad.appendChild(dot);window.indicDotIni=1;x('dot'+padid).style.display='block';}
                  else{new lc.indicator.stop(padid);x('dot'+padid).style.display='block';}
                  var dot='dot'+padid;
                  window['indic'+padid]=setInterval('new lc.indicator.horzLoopAnim(\''+dot+'\');',500);
                  window['IndPack'+padid]=function(pid){hidee('dot'+padid);}
}
}
lc.indicator.horzLoopAnim=function(d){d=x(d);
                              if(window.dotFrame==0){d.style.left='20px';window.dotFrame=1;}
                              else if(window.dotFrame==1){d.style.left='40px';window.dotFrame=2;} 
                              else if(window.dotFrame==2){d.style.left='20px';window.dotFrame=3;}
                              else if(window.dotFrame==3){d.style.left='0px';window.dotFrame=0;} }
lc.indicator.stop=function(padid){clearInterval(window['indic'+padid]);try{new window['IndPack'+padid](padid);}catch(e){}}
/*---------++Alert -&&-  Confirm++-----------------*/
lc.createMsgBody=function(msg){
if(window.lcMsgBodyIni==1){showw('lcAlertPad');x('lcAlertBody').innerHTML=msg;}else{
var a=document.createElement('div');a.id='lcAlertPad';
var b=document.createElement('div');b.id='lcAlertBody';b.innerHTML=msg;
var c=document.createElement('div');c.id='lcAlertFoot';
a.setAttribute('style','z-index:1000000;position:fixed;font-size:15px;width:100%;height:100%;left:0;top:0;background:rgba(0, 0, 0,0.7);text-align:center;overflow:scroll;');
b.setAttribute('style','position:relative;margin:200px auto 0;width:300px;left:0;right:0;background:white;border:1px solid rgb(136, 136, 136);outline:1px solid white;color:#D2381F;padding:25px 10px;');
c.setAttribute('style','position:relative;left:0;right:0;width:150px;height:30px;background:#ccc;margin:auto;border-radius:0 0 6px 6px;padding:10px 0;border:2px solid white;border-top:0;');
if(document.body.appendChild(a)){a.appendChild(b);a.appendChild(c);window.lcMsgBodyIni=1;}else{alert(msg);}}}

lc.alert=function(c){new lc.createMsgBody(c);x('lcAlertFoot').innerHTML='';var d=document.createElement('button');d.onclick=function(){hidee('lcAlertPad');};d.setAttribute('style','');d.innerHTML='OK';x('lcAlertFoot').appendChild(d);d.focus();}

lc.confirm=function(msg,func,sensitive){new lc.createMsgBody(msg);x('lcAlertFoot').innerHTML='';
var d=document.createElement('button');d.onclick=function(){hidee('lcAlertPad');try{new func();}catch(e){new lc.alert('Sorry Something went wrong!<br/>We will fix it soon.');}};d.setAttribute('style','');d.innerHTML='Do it!';
var f=document.createElement('button');f.onclick=function(){hidee('lcAlertPad');new lc.slNotification('Last Action Cancelled.');}; f.innerHTML='Cancel';
x('lcAlertFoot').appendChild(d);x('lcAlertFoot').appendChild(f);
if(sensitive){f.focus();}else{d.focus();}
}

lc.slNotification=function(msg,onclick){
if(window.slNotifIni!=1){var a=document.createElement('div');a.id='slNotifPad';
a.setAttribute('style','position:fixed;overflow:scroll;top:0;left:0;z-index:10000000;');
document.body.appendChild(a);window.slNotifIni=1;}
var b=document.createElement('div');b.id='slNotif'+window.slNotifCount;b.innerHTML=msg;
b.setAttribute('style','position:relative;margin:12px;border-radius:7px;background:rgba(105, 105, 105, 0.7);color:#f2f2f2;border:1px solid dimGrey;font-size:10px;width:140px;padding:4px 4px 14px;opacity:1;');
x('slNotifPad').insertBefore(b,x('slNotifPad').firstChild);
window['slNFadeout'+window.slNotifCount]=setTimeout("new lc.anim.fade({id:'slNotif"+window.slNotifCount+"',type:'out',afterEffect:function(){hidee('slNotif"+window.slNotifCount+"');}})",7300);
    b.onmouseover=function(){clearTimeout(window['slNFadeout'+window.slNotifCount]);}
    b.onmouseout=function(){window['slNFadeout'+window.slNotifCount]=setTimeout("new lc.anim.fade({id:'slNotif"+window.slNotifCount+"',type:'out',afterEffect:function(){hidee('slNotif"+window.slNotifCount+"');}})",7300);}

window.slNotifCount+=1;
}
window.slNotifCount=0;
/*============++Sensors++================*/
lc.sensor={};
var tMD=tMU=tMM=eMD=eMU=eMM=tMOver=tMOut=tKU=tKD=tKP=eKU=eKD=eKP=tSS=eSS=tSel=eSel=eMW=tMW=eDS=tDS=tCHNG=eCHNG=eClick=eDClick=tClick=tDClick=eFocus=tFocus=eBlur=tBlur=null,mdn=0,longMPressDur=2000;
lc.sensor.act={}
lc.sensor.act.md=function(){}
lc.sensor.act.mu=function(){}
lc.sensor.act.mm=function(){}
lc.sensor.act.mover=function(){}
lc.sensor.act.mout=function(){}
lc.sensor.act.ku=function(){}
lc.sensor.act.kd=function(){}
lc.sensor.act.kp=function(){}
lc.sensor.act.ss=function(){}
lc.sensor.act.sel=function(){}
lc.sensor.act.mwd=function(){}
lc.sensor.act.mwu=function(){}
lc.sensor.act.ds=function(){}
lc.sensor.act.chng=function(){}
lc.sensor.act.click=function(){}
lc.sensor.act.dclick=function(){}
lc.sensor.act.longMPress=function(){}
lc.sensor.act.blur=function(){}
lc.sensor.act.focus=function(){}
/*----------++keyInSensor++-------------*/

lc.sensor.keyIn=function(e,v){
if(e == null)
  e = window.event;

if(v.type=='passon'){new v.fx({keyCode:e.keyCode,charCode:e.charCode});}else{
if(v.logic=='!'){if(e.keyCode!=v.for){new v.fx;}}else{if(e.keyCode==v.for){new v.fx;}}
}}
lc.sensor.longMPress=function(){if(window['mdn'+mdn]===1){try{new lc.sensor.act.longMPress;}catch(e){}}}
/*--------------------All Sensors-------------*/
lc.sensor.md=function(e){
if (e == null) 
		e = window.event; 
window.eMD=e;	
window.tMD = e.target != null ? e.target : e.srcElement;
window['mdn'+mdn]=1;window['lpact'+mdn]=setTimeout("new lc.sensor.longMPress;",longMPressDur);
new lc.sensor.act.md;
}
lc.sensor.mu=function(e){
if (e == null) 
		e = window.event; 
window.eMU=e;	
window.tMU = e.target != null ? e.target : e.srcElement;
window['mdn'+mdn]=0;clearTimeout(window['lpact'+mdn]);mdn+=1;
new lc.sensor.act.mu;
}
lc.sensor.mm=function(e){
if (e == null) 
		e = window.event; 
window.eMM=e;	
window.tMM = e.target != null ? e.target : e.srcElement;
new lc.sensor.act.mm;
}
lc.sensor.mover=function(e){
if (e == null) 
		e = window.event; 
	
window.tMOver = e.target != null ? e.target : e.srcElement;
new lc.sensor.act.mover;
}
lc.sensor.mout=function(e){
if (e == null) 
		e = window.event; 
	
window.tMOut = e.target != null ? e.target : e.srcElement;
new lc.sensor.act.mout;
}
lc.sensor.ku=function(e){
if (e == null) 
		e = window.event; 
window.eKU=e;	
window.tKU = e.target != null ? e.target : e.srcElement;
new lc.sensor.act.ku;
}
lc.sensor.kd=function(e){
if (e == null) 
		e = window.event; 
window.eKD=e.keyCode;	
window.tKD = e.target != null ? e.target : e.srcElement;
new lc.sensor.act.kd;
}
lc.sensor.kp=function(e){
if (e == null) 
		e = window.event; 
window.eKP=e;	
window.tKP = e.target != null ? e.target : e.srcElement;
new lc.sensor.act.kp;
}
lc.sensor.ss=function(e){
if (e == null) 
		e = window.event; 
window.eSS=e;	
window.tSS = e.target != null ? e.target : e.srcElement;
new lc.sensor.act.ss;
}
lc.sensor.sel=function(e){
if (e == null) 
		e = window.event; 
window.eSel=e;	
window.tSel = e.target != null ? e.target : e.srcElement;
new lc.sensor.act.sel;
}
lc.sensor.mw=function(e){
e = window.event; 
window.eMW=e;
window.tMW=e.target != null ? e.target : e.srcElement;
var wheelData = e.detail ? e.detail * -1 : e.wheelDelta / 40;
/*Bring Down*/  if(wheelData>0){new lc.sensor.act.mwd(wheelData);}
/*Take Up*/  if(wheelData<0){new lc.sensor.act.mwu(wheelData);}
}
lc.sensor.ds=function(e){
if (e == null) 
		e = window.event; 
window.eDS=e;	
window.tDS = e.target != null ? e.target : e.srcElement;
new lc.sensor.act.ds;
}
lc.sensor.chng=function(e){
if (e == null) 
		e = window.event; 
window.eCHNG=e;	
window.tCHNG = e.target != null ? e.target : e.srcElement;
new lc.sensor.act.chng;
}
lc.sensor.click=function(e){
if (e == null) 
		e = window.event; 
window.eClick=e;	
window.tClick = e.target != null ? e.target : e.srcElement;
new lc.cleaner(tClick);
new lc.sensor.act.click;
}
lc.sensor.dclick=function(e){
if (e == null) 
		e = window.event; 
window.eDClick=e;	
window.tDClick = e.target != null ? e.target : e.srcElement;
new lc.sensor.act.dclick;
}
lc.sensor.focus=function(e){
if (e == null) 
		e = window.event; 
window.eFocus=e;	
window.tFocus = e.target != null ? e.target : e.srcElement;
new lc.sensor.act.focus;
}
lc.sensor.blur=function(e){alert();
if (e == null) 
		e = window.event; 
window.eBlur=e;	
window.tBlur = e.target != null ? e.target : e.srcElement;
new lc.sensor.act.blur;
}
lc.sensor.ini=function(){
document.onmousedown=lc.sensor.md;
document.onmouseup=lc.sensor.mu;
document.onmousemove=lc.sensor.mm;
document.onmouseover=lc.sensor.mover;
document.onmouseout=lc.sensor.mout;
document.onkeyup=lc.sensor.ku;
document.onkeydown=lc.sensor.kd;
document.onkeypress=lc.sensor.kp;
document.onselectstart=lc.sensor.ss;
document.onselectionchange=lc.sensor.sel;
document.onmousewheel=lc.sensor.mw;
document.ondragstart=lc.sensor.ds;
document.onchange=lc.sensor.chng;
document.onclick=lc.sensor.click;
document.ondblclick=lc.sensor.dclick;
document.onfocus=lc.sensor.focus;
document.onblur=lc.sensor.blur;
}


/*============++Scrollers++===============*/

lc.scroll={};
lc.scroll.vert=function(e , i,l)
{
  e = e ? e : window.event;
  var wheelData = e.detail ? e.detail * -1 : e.wheelDelta / 40;
  var CNB=x(i);
  var CNB_height = window.getComputedStyle(CNB , null).getPropertyValue("height");

/*Bring Down*/  if(wheelData>0){if(parseInt(CNB.style.top.slice(0,-2))<0){if(wheelData>5){CNB.style.top=(parseInt(CNB.style.top.slice(0,-2))+17)+'px';}else{CNB.style.top=(parseInt(CNB.style.top.slice(0,-2))+3)+'px';}return lc.scroll.reset(e);}else{CNB.style.top='0px';} }

/*Take Up*/  if(wheelData<0){if(parseInt(CNB.style.top.slice(0,-2))>-(parseInt(CNB_height.slice(0,-2))-parseInt(l))){if(wheelData<-5){CNB.style.top=(parseInt(CNB.style.top.slice(0,-2))-17)+'px';}else{CNB.style.top=(parseInt(CNB.style.top.slice(0,-2))-3)+'px';}return lc.scroll.reset(e);}else{CNB.style.top='-'+(parseInt(CNB_height.slice(0,-2))-parseInt(l))+'px';}
}
  
}
lc.scroll.horz=function(e , i,l)
{
  e = e ? e : window.event;
  var wheelData = e.detail ? e.detail * -1 : e.wheelDelta / 40;
  var CNB=x(i);
  var CNB_width = window.getComputedStyle(CNB , null).getPropertyValue("width");

/*Take Left*/  if(wheelData>0){if(parseInt(CNB.style.left.slice(0,-2))<0){if(wheelData>5){CNB.style.left=(parseInt(CNB.style.left.slice(0,-2))+17)+'px';}else{CNB.style.left=(parseInt(CNB.style.left.slice(0,-2))+3)+'px';}return lc.scroll.reset(e);}else{CNB.style.top='0px';} }

/*Take right*/  if(wheelData<0){if(parseInt(CNB.style.left.slice(0,-2))>-(parseInt(CNB_width.slice(0,-2))-parseInt(l))){if(wheelData<-5){CNB.style.left=(parseInt(CNB.style.left.slice(0,-2))-17)+'px';}else{CNB.style.left=(parseInt(CNB.style.left.slice(0,-2))-3)+'px';}return lc.scroll.reset(e);}else{CNB.style.left='-'+(parseInt(CNB_width.slice(0,-2))-parseInt(l))+'px';}
}
 
}
lc.scroll.reset=function(e)
{
  e = e ? e : window.event;
  if(e.stopPropagation)
    e.stopPropagation();
  if(e.preventDefault)
    e.preventDefault();
  e.cancelBubble = true;
  e.cancel = true;
  e.returnValue = false;
  return false;
}

/*========================++LCTimer++=======================*/

lc.timer=function(pt){
var time = Math.round((new Date()).getTime() / 1000);
var rendertime;
if(time-pt <= 24){rendertime='just now';}
else if(time-pt <= 60-1){rendertime=Math.round((time-pt))+' seconds ago';}
else if(time-pt <= 120-1){rendertime=1+' minute ago';}
else if(time-pt <= 60*60-1){rendertime=Math.round((time-pt)/60)+' minutes ago';}
else if(time-pt <= (60*60*2)-(60*60*0.55)){rendertime=1+' hour ago';}
else if(time-pt <= 60*60*12-1){rendertime=Math.round((time-pt)/(60*60))+' hours ago';}
else{
var d = new Date(pt*1000);
var months = ['Jan','Feb','Mar','Apr','May','June','July','Aug','Sept','Oct','Nov','Dec'];
var days = ['Sunday','Monday','Tuesday','Wednesday','Thursday','Friday','Saturday'];
     var year = d.getFullYear();
     var month = months[d.getMonth()];
     var date = d.getDate();
     var hour = d.getHours();
     var min = d.getMinutes();
     var sec = d.getSeconds();
    var day = days[d.getDay()];
rendertime=day+' '+date+'-'+month+(year-2000)+' &nbsp; '+hour+':'+min;}
return rendertime;
}

/*--------------++FullView++----------------*/
lc.fullview={};
lc.fullview.initStatus=0;
lc.fullview.install=function(){var a=document.createElement('div'),b=document.createElement('div'),c=document.createElement('div'),d=document.createElement("div"),e=document.createElement("div"),f=document.createElement("div");
a.setAttribute('style',"width: 100%;height: 100%;background: rgba(255, 255, 255, 0.8);position: fixed;left: 0;right: 0;top:0;z-index: 999998;overflow:auto;");b.setAttribute("style","width: 50%;background: white;border: 1px solid black;outline: 1px solid white;margin:20px auto;box-shadow: 0 0 100px 5px dimgrey;text-align: center;padding: 7px;");d.setAttribute("style","color: white;background: #97B5C7;padding: 5px;font-size: 18px;border: 1px solid #748B98;border-radius:20px;max-width:270px;margin:auto auto 12px;text-align:center;");e.setAttribute("style","");f.setAttribute("style","");
a.id='fvContainer';b.id='fvHead';c.id='fvMain';d.id="fvRateMachine";e.id="fvCommentBox";f.id="fvUtilityBox";
a.setAttribute("onclick","new lc.fullview.hide;");
document.body.appendChild(a);a.appendChild(b);a.appendChild(c);a.appendChild(d);a.appendChild(e);a.appendChild(f);
	var g=document.createElement('span');g.id='fvTimer';g.setAttribute("style","color:#999;font-size:13px;");
	var h=document.createElement('span');h.id='fvTitle';
		b.appendChild(g);b.appendChild(document.createElement('br'));b.appendChild(h);
lc.fullview.initStatus=1;}
lc.fullview.render=function(a){if(lc.fullview.initStatus===0){new lc.fullview.install;}else{showw('fvContainer');}
var fvrm=x('fvRateMachine'),fvt=x('fvTitle'),fvtm=x('fvTimer');
if(a.type==='pic'){x('fvMain').setAttribute("style","width: 95%;background: black;border: 1px solid white;outline: 1px solid black;box-shadow: 0 0 200px 10px dimgrey;max-width: 77%;text-align: center;margin:50px auto;");fvMain.innerHTML="<img src=\"/pic/"+a.id+"-1100-0-max\" width=\"100%\"/>";fvtm.innerHTML=lc.timer(a.time);fvt.innerHTML=a.title;var sType=2;}
if(a.type==='news'){x('fvMain').setAttribute("style","width: 95%;background: white;border: 1px solid black;outline: 1px solid white;box-shadow: 0 0 200px 10px dimgrey;max-width: 70%;text-align: left;margin:50px auto;padding:125px;position:relative;height:400px;overflow:auto;");x('fvMain').innerHTML='';new lc.fetchnews({id:a.id});fvtm.innerHTML=lc.timer(a.time);fvt.innerHTML=a.title;var sType=3;}
if(window.LogStatus === 0){fvrm.innerHTML='<span id="minus7" style="margin: 0 3px;padding: 1px 3px;background: #8da8b9;border-radius: 7px;cursor: pointer;font-size: 12px;color: #fed6d6;" title="Click if you think it deserves -7" onclick="window.letsLogin(function(){new lc.rateit.ini({id:'+a.id+',rating:-7,type:'+sType+'});});">- 7</span><span id="minus5" style="margin: 0 3px;padding: 1px 3px;background: #8da8b9;border-radius: 7px;cursor: pointer;font-size: 12px;color: #fed6d6;" title="Click if you think it deserves -5" onclick="window.letsLogin(function(){new lc.rateit.ini({id:'+a.id+',rating:-5,type:'+sType+'});});">- 5</span><span id="minus3" style="margin: 0 3px;padding: 1px 3px;background: #8da8b9;border-radius: 7px;cursor: pointer;font-size: 12px;color: #fed6d6;" title="Click if you think it deserves -3" onclick="window.letsLogin(function(){new lc.rateit.ini({id:'+a.id+',rating:-3,type:'+sType+'});});">- 3</span> | <span id="plus3" style="margin: 0 3px;padding: 1px 3px;background: #8da8b9;border-radius: 7px;cursor: pointer;font-size: 12px;color: #d8fda9;" title="Click if you think it deserves +3" onclick="window.letsLogin(function(){new lc.rateit.ini({id:'+a.id+',rating:3,type:'+sType+'});});">+ 3</span><span id="plus5" style="margin: 0 3px;padding: 1px 3px;background: #8da8b9;border-radius: 7px;cursor: pointer;font-size: 12px;color: #d8fda9;" title="Click if you think it deserves +5" onclick="window.letsLogin(function(){new lc.rateit.ini({id:'+a.id+',rating:5,type:'+sType+'});});">+ 5</span><span id="plus7" style="margin: 0 3px;padding: 1px 3px;background: #8da8b9;border-radius: 7px;cursor: pointer;font-size: 12px;color: #d8fda9;" title="Click if you think it deserves +7" onclick="window.letsLogin(function(){new lc.rateit.ini({id:'+a.id+',rating:7,type:'+sType+'});});">+ 7</span>';}
	else if(a.interactive != false){showw('fvRateMachine');fvrm.innerHTML='<span id="minus7" style="margin: 0 3px;padding: 1px 3px;background: #8da8b9;border-radius: 7px;cursor: pointer;font-size: 12px;color: #fed6d6;" title="Click if you think it deserves -7" onclick="new lc.rateit.ini({id:'+a.id+',rating:-7,type:'+sType+'});">- 7</span><span id="minus5" style="margin: 0 3px;padding: 1px 3px;background: #8da8b9;border-radius: 7px;cursor: pointer;font-size: 12px;color: #fed6d6;" title="Click if you think it deserves -5" onclick="new lc.rateit.ini({id:'+a.id+',rating:-5,type:'+sType+'});">- 5</span><span id="minus3" style="margin: 0 3px;padding: 1px 3px;background: #8da8b9;border-radius: 7px;cursor: pointer;font-size: 12px;color: #fed6d6;" title="Click if you think it deserves -3" onclick="new lc.rateit.ini({id:'+a.id+',rating:-3,type:'+sType+'});">- 3</span> | <span id="plus3" style="margin: 0 3px;padding: 1px 3px;background: #8da8b9;border-radius: 7px;cursor: pointer;font-size: 12px;color: #d8fda9;" title="Click if you think it deserves +3" onclick="new lc.rateit.ini({id:'+a.id+',rating:3,type:'+sType+'});">+ 3</span><span id="plus5" style="margin: 0 3px;padding: 1px 3px;background: #8da8b9;border-radius: 7px;cursor: pointer;font-size: 12px;color: #d8fda9;" title="Click if you think it deserves +5" onclick="new lc.rateit.ini({id:'+a.id+',rating:5,type:'+sType+'});">+ 5</span><span id="plus7" style="margin: 0 3px;padding: 1px 3px;background: #8da8b9;border-radius: 7px;cursor: pointer;font-size: 12px;color: #d8fda9;" title="Click if you think it deserves +7" onclick="new lc.rateit.ini({id:'+a.id+',rating:7,type:'+sType+'});">+ 7</span>';}
    else{hidee('fvRateMachine');}
}

lc.fullview.hide=function(e){e=window.event;var t=e.target != null ? e.target : e.srcElement;if(t.id==='fvContainer'){hidee('fvContainer');}}
/*
Usage just put:
new lc.fullview.render({id:x, type:"pic/news/picfromnews", time:unix_timestamp, title:"small headline if available" });
*/
//---------------++Fetchnews++--------------
lc.fetchnews=function(a){
    if(typeof window['news'+a.id] == 'undefined' ){
        new lc.get({id:"news", value:"<value;>"+a.id+"<value;>", location:'', AFx:function(r){try{r=eval("("+r+")");window['news'+a.id]=r['news'];new lc.rendernews(a.id);}catch(e){alert(r);}}});
    }
    else{new lc.rendernews(a.id);}
}
lc.rendernews=function(id){
    var news=window['news'+id];
    news=news.split('[p;]');var i;
    for(i=1;i<(news.length-1);i++){
        var b=news[i].split('[o]');
        if(b.length>1){
            var style=b[0].split(';');
            if(style.length>2){
                var n=document.createElement('div');
                if(parseInt(style[2]) == 0){var horzPos="left:0;right:0;margin:0 auto;";}else{var horzPos="left:"+style[2]+"px;";}
                if(parseInt(style[5]) == 0){var width="";}else{var width="width:"+style[5]+"px;";}
                if(parseInt(style[6]) == 0){var height="";}else{var height="height:"+style[6]+"px;";}
                if(style[4] == 'l'){var txtaln="left";}else if(style[4] == 'c'){var txtaln="center";}else if(style[4] == 'r'){var txtaln='right';}else{var txtaln=style[4];}
                if(style[9] == ''){var border="";}else{var border=style[9]+"px solid "+style[10];}
                n.setAttribute("style","color:"+style[0]+";font-size:"+style[1]+"px;position:absolute;overflow:hidden;"+horzPos+"top:"+style[3]+"px;"+width+height+ "padding:"+style[8]+"px;border:"+border+";background:"+style[7]+";");}
            else{
                var n=document.createElement('span');
                n.setAttribute("style","color:"+style[0]+";font-size:"+style[1]+"px;text-align:"+txtaln+";");}
            n.innerHTML=b[1];
        }else{
            var b=news[i].split('[a]');
            if(b.length == 3){
                var style=b[0].split(';');
                var link=b[1];
                var n=document.createElement('a');
                n.innerHTML=b[2];
                n.setAttribute("style","color:"+style[0]+";font-size:"+style[1]+"px;");
                n.setAttribute("href",b[1]);
            }else{
                var b=news[i].split('[lcimg]');
                if(b.length > 1){
                    var n=document.createElement('img');
                    n.setAttribute("src","http://gtis.ac.in/pic/"+b[1]);
                    n.setAttribute("style","border:3px solid white;outline:1px solid black;");
                }else{
                    var b=news[i].split('[wwwimg]');
                    if(b.length > 1){
                    var n=document.createElement('img');
                    n.setAttribute("src", b[1]);
                    n.setAttribute("style","border:3px solid white;outline:1px solid black;");
                    }
                }
            }
        }
        x('fvMain').appendChild(n);
    }
}
//=================++Rate Stories+++---------------
lc.rateit={}
lc.rateit.ini=function(a){new lc.new({id:"rating",value:"<value;>"+a.id+";"+a.rating+";"+a.type+"<value;>",AFx:function(r){new lc.slNotification(r);}});}

//----------++Essentials++------------

function x(x){var elements = new Array();

	for (var i = 0; i < arguments.length; i++) {

		var element = arguments[i];

		if (typeof element == 'string')

			element = document.getElementById(element);

		if (arguments.length == 1)

			return element;

		elements.push(element);

	}

	return elements;
}
function hidee(x){document.getElementById(x).style.display='none';}
function showw(x){document.getElementById(x).style.display='inline-block';}
function showwb(x){document.getElementById(x).style.display='block';}
lc.hide=function(id){if(id.length>0){var i;for(i=0;i<id.length;i++){hidee(id[i]);}}else{hidee(id);}}/*be sure to use [] even for single elm*/
lc.new=function(a){if(typeof a.location == 'undefined'){a.location='';}new ajax.request('/s/checkpost.php',{method:'POST',parameters:'action=new&id='+a.id+'&value='+a.value+'&location='+a.location,onSuccess:function(r){alert(r);if(parseInt(r)===(-786)){new lc.verify.ini({fx:function(){new lc.new(a);},msg:"Please verify.."});}else{try{new window[a.id+'AFx'](r);}catch(e){};try{new a.AFx(r);}catch(e){}}},onCreate:function(r){try{new window[a.id+'BFx'];}catch(e){};try{new a.BFx;}catch(e){}}});}
lc.edit=function(a){if(a.location==='undefined'){a.location='';}new ajax.request('/s/checkpost.php',{method:'POST',parameters:'action=ed-it&id='+a.id+'&value='+a.value+'&location='+a.location,onSuccess:function(r){try{new window[a.id+'AFx'](r);}catch(e){};try{new a.AFx(r);}catch(e){}},onCreate:function(r){try{new window[a.id+'BFx'];}catch(e){};try{new a.BFx;}catch(e){}}});}
lc.get=function(a){//a.id=short_command_of_operation, a.value=edition_values, a.location=dir_of_script_to_be_used
    if(typeof a.location === 'undefined'){a.location='';}
    new ajax.request('/s/checkpost.php',{method:'POST', parameters:'action=get&id='+a.id+'&value='+a.value+'&location='+a.location,onSuccess:function(r){alert(r);if(parseInt(r)===(-786)){new lc.verify.ini({fx:function(){new lc.get(a);},msg:"Please verify.."});}else{try{new window[a.id+'AFx'](r);}catch(e){};try{new a.AFx(r);}catch(e){}}},onCreate:function(r){try{new window[a.id+'BFx'];}catch(e){};try{new a.BFx;}catch(e){}}});
}
function urldecode(url) {return decodeURIComponent(url.replace(/\+/g, ' '));}
function urlencode(url) {return encodeURIComponent(url.replace(/\+/g, ' '));}
lc.toggleDisplay=function(id,afx){var action;if(x(id).style.display!='none'){x(id).style.display=action='none';}else{x(id).style.display=action='inline-block';}try{new afx(action);}catch(e){}}
function thenew(a){return document.createElement(a);}
lc.each=function(a){for(i=0;i<a.array.length;i++){try{new a.fx(i);}catch(e){}}}
function is_array(input){return typeof(input)=='object'&&(input instanceof Array);}

lc.cleaner=function(a){
try{
	for(i=0;i<window.popup.length;i++){
		window.isInIt=false;
		if(window.popup[i][1]){
			if(a != document.getElementById(window.popup[i][2])){
				searchNode({look:a,in:document.getElementById(window.popup[i][0])});
				if(!window.isInIt){hidee(window.popup[i][0]);window.popup[i][1]=false;}}
		}
	}
}catch(e){}
}
function searchNode(a){
	if(window.tClick != a.in  && a.in.childNodes.length > 0){
		for(n=0;n<a.in.childNodes.length;n++){
				searchNode({look:a.look,in:a.in.childNodes[n]});
		}
	}else if(window.tClick === a.in){window.isInIt=true;}else{}
}
function round(val, precision) {power = Math.pow (10, precision);poweredVal = Math.ceil (val * power);result = poweredVal / power;return result;}

//===================++Verify-Human++=======================
lc.verify={};
lc.verify.ini=function(a){/*a={fx:'tobe initiated after verification',msg:'optional'}*/
	if(typeof a.msg == undefined){a.msg='';}
	function soso(res){
				var verifBody="<div>"+a.msg+"<br/><br/><img src=\"/pic/verify/"+res.id+"\"/><br/><br/><input type='text' id='verifEntry'/></div>"+res.code;
				new lc.confirm(verifBody,function(){new lc.verify.confirm({id:res.id,fx:a.fx});});
			}
	new ajax.request('/verify/tockenizer.php',{method:'POST',onSuccess:function(r){r=eval("("+r+")");new soso(r);}});
}
lc.verify.confirm=function(a){
	var param="id="+a.id+"&value="+x('verifEntry').value;
	new ajax.request('/verify/confirm.php',{method:"POST",parameters:param,onSuccess:function(r){dodo(r);}});
	function dodo(res){alert(res);
				if(parseInt(res) === 1){new a.fx();}
				else{new lc.verify.ini({fx:a.fx,msg:"Code don't match. Try Again."});}
			}
}
//=============++Data++=================
lc.data={};
lc.data.insert=function(a){
    if(typeof a.row == 'undefined'){var param ='';}else{var param='row='+a.row+'&';}
    param+="cols="+a.cols+"&values="+a.values+"&table="+a.table;
    var url = "/data/"+a.table+"/insert";
    new ajax.request(url,{method:'POST',parameters:param,onSuccess:function(r){try{new a.afx(r);}catch(e){}},onCreate:function(){try{new a.inifx(r);}catch(e){}}});}

/*===================LCTest-xtra=====================*/
lc.delSessionVar=function(v){new ajax.request('/deleteSessionVar.php',{method:'POST',parameters:'var='+v,onSuccess:function(r){lc.alert(r);}});}
lc.nextChar=function(a){var nxt;try{if((a.charCodeAt(a.length-1)>=65 && a.charCodeAt(a.length-1)<90) || (a.charCodeAt(a.length-1)>=97 && a.charCodeAt(a.length-1)<122)){
nxt=a.slice(0,-1)+String.fromCharCode(a.charCodeAt(a.length-1)+1);}
else{if(a.charCodeAt(a.length-1)===90){nxt=a+'A';}else if(a.charCodeAt(a.length-1)===122){nxt=a+'a';}else{nxt='A';}}}catch(e){nxt='A';}return nxt;}