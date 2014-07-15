var editing={},store={},cursor=true,renderedData;
editing.onblur=function(){}
store.grid={}
editing.state=false;
new lc.sensor.ini;
lc.sensor.act.kp=function(c){
if(editing.state){
if(c == null){var char=String.fromCharCode(eKP.charCode);var papi=true;} else{if(c==32){var char='&nbsp;';var papi=false;}else{var char=String.fromCharCode(c);var papi=true;}}
if(eKP.keyCode==13 && papi){
if((store.grid[editing.pad.id].pointer[0]+1)==store.grid[editing.pad.id].value.length){
//--------------
var newRow=document.createElement('div');newRow.setAttribute('id','r'+(store.grid[editing.pad.id].pointer[0]+2));newRow.setAttribute('class','row');
editing.pad.appendChild(newRow);
store.grid[editing.pad.id].value[store.grid[editing.pad.id].pointer[0]+1]=[];
//---------------
if(store.grid[editing.pad.id].pointer[1]<store.grid[editing.pad.id].value[store.grid[editing.pad.id].pointer[0]].length){	
editing.pad.childNodes[store.grid[editing.pad.id].pointer[0]+1].innerHTML='';
store.grid[editing.pad.id].value[store.grid[editing.pad.id].pointer[0]+1]=[];var i;var n=0;
for(i=store.grid[editing.pad.id].pointer[1];i<store.grid[editing.pad.id].value[store.grid[editing.pad.id].pointer[0]].length;i++){
var newCol=document.createElement('font');
newCol.setAttribute('id','r'+(store.grid[editing.pad.id].pointer[0]+2)+'c'+n);newCol.setAttribute('class','col');
newCol.innerHTML=store.grid[editing.pad.id].value[store.grid[editing.pad.id].pointer[0]+1][n]=store.grid[editing.pad.id].value[store.grid[editing.pad.id].pointer[0]][i];
editing.pad.childNodes[store.grid[editing.pad.id].pointer[0]+1].appendChild(newCol);
n++;
}
var pipo=store.grid[editing.pad.id].pointer[1];
for(i=store.grid[editing.pad.id].value[store.grid[editing.pad.id].pointer[0]].length;i>=store.grid[editing.pad.id].pointer[1];i--){
editing.pad.childNodes[store.grid[editing.pad.id].pointer[0]].removeChild(editing.pad.childNodes[store.grid[editing.pad.id].pointer[0]].childNodes[i]);
if(i>pipo){store.grid[editing.pad.id].value[store.grid[editing.pad.id].pointer[0]].splice(-1,1);}
}
var new_Col=document.createElement('font');new_Col.setAttribute('id','r'+(store.grid[editing.pad.id].pointer[0]+1)+'c'+(store.grid[editing.pad.id].value[store.grid[editing.pad.id].pointer[0]].length));new_Col.setAttribute('class','col');editing.pad.childNodes[store.grid[editing.pad.id].pointer[0]].appendChild(new_Col);
}
var newCol=document.createElement('font');newCol.setAttribute('id','r'+(store.grid[editing.pad.id].pointer[0]+2)+'c'+(store.grid[editing.pad.id].value[store.grid[editing.pad.id].pointer[0]+1].length));newCol.setAttribute('class','col');editing.pad.childNodes[store.grid[editing.pad.id].pointer[0]+1].appendChild(newCol);
store.grid[editing.pad.id].pointer[0]++;
store.grid[editing.pad.id].pointer[1]=0;
}
else{
var newRow=document.createElement('div');newRow.setAttribute('id','r'+(store.grid[editing.pad.id].value.length+1));newRow.setAttribute('class','row');editing.pad.appendChild(newRow);
var i;
for(i=(store.grid[editing.pad.id].value.length);i>store.grid[editing.pad.id].pointer[0]+1;i--){
if(store.grid[editing.pad.id].value[i-1].length>0){
editing.pad.childNodes[i].innerHTML='';
store.grid[editing.pad.id].value[i]=[];
var r;
for(r=0;r<store.grid[editing.pad.id].value[i-1].length;r++){
var newCol=document.createElement('font');newCol.setAttribute('id','r'+(i+1)+'c'+r);newCol.setAttribute('class','col');
newCol.innerHTML=store.grid[editing.pad.id].value[i-1][r];
editing.pad.childNodes[i].appendChild(newCol);
store.grid[editing.pad.id].value[i][r]=store.grid[editing.pad.id].value[i-1][r];}
var newCol=document.createElement('font');newCol.setAttribute('id','r'+(i+2)+'c'+(store.grid[editing.pad.id].value[i].length));newCol.setAttribute('class','col');editing.pad.childNodes[i].appendChild(newCol);
}else{
editing.pad.childNodes[i].innerHTML=editing.pad.childNodes[i-1].innerHTML;
store.grid[editing.pad.id].value[i]=[];
}}if(store.grid[editing.pad.id].pointer[1]<store.grid[editing.pad.id].value[store.grid[editing.pad.id].pointer[0]].length){	
editing.pad.childNodes[store.grid[editing.pad.id].pointer[0]+1].innerHTML='';
store.grid[editing.pad.id].value[store.grid[editing.pad.id].pointer[0]+1]=[];var i;var n=0;
for(i=store.grid[editing.pad.id].pointer[1];i<store.grid[editing.pad.id].value[store.grid[editing.pad.id].pointer[0]].length;i++){
var newCol=document.createElement('font');newCol.setAttribute('id','r'+(store.grid[editing.pad.id].pointer[0]+2)+'c'+n);newCol.setAttribute('class','col');
newCol.innerHTML=store.grid[editing.pad.id].value[store.grid[editing.pad.id].pointer[0]+1][n]=store.grid[editing.pad.id].value[store.grid[editing.pad.id].pointer[0]][i];
editing.pad.childNodes[store.grid[editing.pad.id].pointer[0]+1].appendChild(newCol);
n++;
}
var pipo=store.grid[editing.pad.id].pointer[1];
for(i=store.grid[editing.pad.id].value[store.grid[editing.pad.id].pointer[0]].length;i>=store.grid[editing.pad.id].pointer[1];i--){
editing.pad.childNodes[store.grid[editing.pad.id].pointer[0]].removeChild(editing.pad.childNodes[store.grid[editing.pad.id].pointer[0]].childNodes[i]);
if(i>pipo){store.grid[editing.pad.id].value[store.grid[editing.pad.id].pointer[0]].splice(-1,1);}}
var new_Col=document.createElement('font');new_Col.setAttribute('id','r'+(store.grid[editing.pad.id].pointer[0]+1)+'c'+(store.grid[editing.pad.id].value[store.grid[editing.pad.id].pointer[0]].length));new_Col.setAttribute('class','col');editing.pad.childNodes[store.grid[editing.pad.id].pointer[0]].appendChild(new_Col);
var newCol=document.createElement('font');newCol.setAttribute('id','r'+(store.grid[editing.pad.id].pointer[0]+2)+'c'+(store.grid[editing.pad.id].value[store.grid[editing.pad.id].pointer[0]+1].length));newCol.setAttribute('class','col');editing.pad.childNodes[store.grid[editing.pad.id].pointer[0]+1].appendChild(newCol);
store.grid[editing.pad.id].pointer[0]++;
store.grid[editing.pad.id].pointer[1]=0;
}else{
editing.pad.childNodes[store.grid[editing.pad.id].pointer[0]+1].innerHTML='';
var newCol=document.createElement('font');newCol.setAttribute('id','r'+(store.grid[editing.pad.id].pointer[0]+2)+'c0');newCol.setAttribute('class','col');
editing.pad.childNodes[store.grid[editing.pad.id].pointer[0]+1].appendChild(newCol);
store.grid[editing.pad.id].value[store.grid[editing.pad.id].pointer[0]+1]=[];
store.grid[editing.pad.id].pointer[1]=0;
store.grid[editing.pad.id].pointer[0]++;
}
}}
else{
if((store.grid[editing.pad.id].value[store.grid[editing.pad.id].pointer[0]].length)>(store.grid[editing.pad.id].pointer[1])){
var newCol=document.createElement('font');newCol.setAttribute('id','r'+(store.grid[editing.pad.id].pointer[0]+1)+'c'+(store.grid[editing.pad.id].value[store.grid[editing.pad.id].pointer[0]].length+1)); newCol.setAttribute('class','col');editing.pad.childNodes[store.grid[editing.pad.id].pointer[0]].appendChild(newCol);
store.grid[editing.pad.id].value[store.grid[editing.pad.id].pointer[0]][store.grid[editing.pad.id].value[store.grid[editing.pad.id].pointer[0]].length]=null;
for(i=(store.grid[editing.pad.id].value[store.grid[editing.pad.id].pointer[0]].length-1);i>store.grid[editing.pad.id].pointer[1];i--){
editing.pad.childNodes[store.grid[editing.pad.id].pointer[0]].childNodes[i].innerHTML=editing.pad.childNodes[store.grid[editing.pad.id].pointer[0]].childNodes[i-1].innerHTML;
store.grid[editing.pad.id].value[store.grid[editing.pad.id].pointer[0]][i]=store.grid[editing.pad.id].value[store.grid[editing.pad.id].pointer[0]][i-1];
}
editing.pad.childNodes[store.grid[editing.pad.id].pointer[0]].childNodes[store.grid[editing.pad.id].pointer[1]].innerHTML=char;
store.grid[editing.pad.id].value[store.grid[editing.pad.id].pointer[0]][store.grid[editing.pad.id].pointer[1]]=char;
store.grid[editing.pad.id].pointer[1]++;
}else{
store.grid[editing.pad.id].value[store.grid[editing.pad.id].pointer[0]][store.grid[editing.pad.id].pointer[1]]=char;
editing.pad.childNodes[store.grid[editing.pad.id].pointer[0]].childNodes[store.grid[editing.pad.id].pointer[1]].innerHTML=char;
var newCol=document.createElement('font');newCol.setAttribute('id','r'+(store.grid[editing.pad.id].pointer[0]+1)+'c'+(store.grid[editing.pad.id].pointer[1]+1));newCol.setAttribute('class','col');
editing.pad.childNodes[store.grid[editing.pad.id].pointer[0]].appendChild(newCol);
store.grid[editing.pad.id].pointer[1]++;}}
}

}
lc.sensor.act.md=function(){
if( tMD.getAttribute('editable')=='true' || (tMD.getAttribute('class')=='row') || (tMD.getAttribute('class')=='col')){
editing.state=true;
if(editing.cursor.pulse.timer){try{new editing.cursor.clean;new editing.cursor.stop;}catch(e){}}
if(tMD.getAttribute('editable')=='true'){editing.pad=tMD;}else if(tMD.getAttribute('class')=='row'){editing.pad=tMD.parentNode;}else{editing.pad=tMD.parentNode.parentNode;
var a=[];a=tMD.id.split('r');a=a[1].split('c');
store.grid[editing.pad.id].pointer=[(parseInt(a[0])-1),parseInt(a[1])];}
if(typeof store.grid[editing.pad.id] == 'undefined'){
if(editing.pad.innerHTML!=''){
var oc=[];oc=editing.pad.innerHTML.split(/\r\n|\r|\n/g);
store.grid[editing.pad.id]={};
store.grid[editing.pad.id].value=[];
store.grid[editing.pad.id].pointer=[];
editing.pad.innerHTML='';var i;
for(i=0;i<oc.length;i++){
store.grid[editing.pad.id].value[i]=[];
var newRow=document.createElement('div');newRow.setAttribute('id','r'+(i+1));newRow.setAttribute('class','row');var newCol=document.createElement('font');newCol.setAttribute('id','r'+(i+1)+'c0');newCol.setAttribute('class','col');newRow.appendChild(newCol); editing.pad.appendChild(newRow);
var oci=oc[i];
var r;
for(r=0;r<oci.length;r++){
editing.pad.lastChild.childNodes[r].innerHTML=oci[r];
store.grid[editing.pad.id].value[i][r]=oci[r];
var newCol=document.createElement('font');newCol.setAttribute('id','r'+(i+1)+'c'+(r+1));newCol.setAttribute('class','col');editing.pad.lastChild.appendChild(newCol);
}
}
store.grid[editing.pad.id].pointer[0]=(store.grid[editing.pad.id].value.length-1);
store.grid[editing.pad.id].pointer[1]=(store.grid[editing.pad.id].value[store.grid[editing.pad.id].pointer[0]].length);
}
else{
var newRow=document.createElement('div');newRow.setAttribute('id','r1');newRow.setAttribute('class','row');var newCol=document.createElement('font');newCol.setAttribute('id','r1c0');newCol.setAttribute('class','col');newRow.appendChild(newCol); editing.pad.appendChild(newRow);store.grid[editing.pad.id]={};store.grid[editing.pad.id].value=[];store.grid[editing.pad.id].value[0]=[];store.grid[editing.pad.id].pointer=[0,0];}}
var stl = document.styleSheets[0];
if( stl.cssRules ) {
    stl.insertRule('.col{border-left:1px solid transparent;cursor:text;}',0);
    stl.insertRule('.row{min-height:5px;}',0);
} else if ( myStyle.rules ) {
    stl.addRule('.col', 'border-left:1px solid transparent;cursor:t');
    stl.addRule('.row', 'min-height:5px;');
}

new editing.cursor.start;
}else{if(editing.state){new editing.data.render;new editing.onblur;new editing.cursor.clean;new editing.cursor.stop; editing.pad=null;editing.state=false;}}


}

lc.sensor.act.kd=function () {
    
            if(editing.state){
new editing.cursor.clean;
var doPrevent = false;
    if (event.keyCode === 8 || event.keyCode === 32 || event.keyCode==40 || event.keyCode==38) {

        var d = event.srcElement || event.target;
        if ((d.tagName.toUpperCase() === 'INPUT' && (d.type.toUpperCase() === 'TEXT' || d.type.toUpperCase() === 'PASSWORD')) 
             || d.tagName.toUpperCase() === 'TEXTAREA') {
            doPrevent = d.readOnly || d.disabled;
        }
        else {
            doPrevent = true;
        }

    }

    if (doPrevent) {
        event.preventDefault();
    }

if(event.keyCode === 32){new lc.sensor.act.kp(32);}

if(event.keyCode==8){
if(store.grid[editing.pad.id].pointer[1]!=0){
store.grid[editing.pad.id].pointer[1]-=1;
for(i=store.grid[editing.pad.id].pointer[1];i<store.grid[editing.pad.id].value[store.grid[editing.pad.id].pointer[0]].length;i++){
store.grid[editing.pad.id].value[store.grid[editing.pad.id].pointer[0]][i]=store.grid[editing.pad.id].value[store.grid[editing.pad.id].pointer[0]][i+1];
editing.pad.childNodes[store.grid[editing.pad.id].pointer[0]].childNodes[i].innerHTML=editing.pad.childNodes[store.grid[editing.pad.id].pointer[0]].childNodes[i+1].innerHTML;
}
editing.pad.childNodes[store.grid[editing.pad.id].pointer[0]].removeChild(editing.pad.childNodes[store.grid[editing.pad.id].pointer[0]].childNodes[(store.grid[editing.pad.id].value[store.grid[editing.pad.id].pointer[0]].length)]);
store.grid[editing.pad.id].value[store.grid[editing.pad.id].pointer[0]].splice(-1,1);
}else{if(store.grid[editing.pad.id].pointer[0]!=0){
var pipa=store.grid[editing.pad.id].pointer[0];
if(store.grid[editing.pad.id].value[store.grid[editing.pad.id].pointer[0]].length>0){
var i;
for(i=0;i<store.grid[editing.pad.id].value[store.grid[editing.pad.id].pointer[0]].length;i++){
editing.pad.childNodes[store.grid[editing.pad.id].pointer[0]-1].lastChild.innerHTML=store.grid[editing.pad.id].value[store.grid[editing.pad.id].pointer[0]-1][store.grid[editing.pad.id].value[store.grid[editing.pad.id].pointer[0]-1].length]=editing.pad.childNodes[store.grid[editing.pad.id].pointer[0]].childNodes[i].innerHTML;
var newCol=document.createElement('font');newCol.setAttribute('id','r'+(store.grid[editing.pad.id].pointer[0])+'c'+(store.grid[editing.pad.id].value[store.grid[editing.pad.id].pointer[0]-1].length)); newCol.setAttribute('class','col');editing.pad.childNodes[store.grid[editing.pad.id].pointer[0]-1].appendChild(newCol);
}
store.grid[editing.pad.id].pointer[1]=store.grid[editing.pad.id].value[pipa-1].length-store.grid[editing.pad.id].value[pipa].length;
store.grid[editing.pad.id].pointer[0]=pipa-1;
}
if((store.grid[editing.pad.id].pointer[0]+1)<store.grid[editing.pad.id].value.length){
for(i=pipa;i<(store.grid[editing.pad.id].value.length-1);i++){
if(store.grid[editing.pad.id].value[i+1].length>0){
editing.pad.childNodes[i].innerHTML='';
store.grid[editing.pad.id].value[i]=[];
var r;
for(r=0;r<store.grid[editing.pad.id].value[i+1].length;r++){
var newCol=document.createElement('font');newCol.setAttribute('id','r'+(i-1)+'c'+r);newCol.setAttribute('class','col');
newCol.innerHTML=store.grid[editing.pad.id].value[i+1][r];
editing.pad.childNodes[i].appendChild(newCol);
store.grid[editing.pad.id].value[i][r]=store.grid[editing.pad.id].value[i+1][r];}
var newCol=document.createElement('font');newCol.setAttribute('id','r'+(i+2)+'c'+(store.grid[editing.pad.id].value[i].length));newCol.setAttribute('class','col');editing.pad.childNodes[i].appendChild(newCol);
}else{
editing.pad.childNodes[i].innerHTML=editing.pad.childNodes[i+1].innerHTML;
store.grid[editing.pad.id].value[i]=[];
}
}
}
store.grid[editing.pad.id].pointer[1]=store.grid[editing.pad.id].value[pipa-1].length-store.grid[editing.pad.id].value[pipa].length;
store.grid[editing.pad.id].pointer[0]=pipa-1;
editing.pad.removeChild(editing.pad.lastChild);
store.grid[editing.pad.id].value.splice(-1,1);
}}

}
else if(event.keyCode==37){
if(store.grid[editing.pad.id].pointer[1]!=0){
store.grid[editing.pad.id].pointer[1]-=1;
}else{if(store.grid[editing.pad.id].pointer[0]!=0){
store.grid[editing.pad.id].pointer[0]-=1; store.grid[editing.pad.id].pointer[1]=store.grid[editing.pad.id].value[store.grid[editing.pad.id].pointer[0]].length;}}
}
else if(event.keyCode==38){
if(store.grid[editing.pad.id].pointer[0]!=0){
store.grid[editing.pad.id].pointer[0]-=1; 
if(store.grid[editing.pad.id].value[store.grid[editing.pad.id].pointer[0]].length<store.grid[editing.pad.id].pointer[1]){
store.grid[editing.pad.id].pointer[1]=store.grid[editing.pad.id].value[store.grid[editing.pad.id].pointer[0]].length;}
}
}
else if(event.keyCode==39){
if(store.grid[editing.pad.id].pointer[1]<store.grid[editing.pad.id].value[store.grid[editing.pad.id].pointer[0]].length){
store.grid[editing.pad.id].pointer[1]+=1;
}else{if(store.grid[editing.pad.id].pointer[0]<(store.grid[editing.pad.id].value.length-1)){
store.grid[editing.pad.id].pointer[0]+=1; store.grid[editing.pad.id].pointer[1]=0;}}
}
else if(event.keyCode==40){
if(store.grid[editing.pad.id].pointer[0]<(store.grid[editing.pad.id].value.length-1)){
store.grid[editing.pad.id].pointer[0]+=1; 
if(store.grid[editing.pad.id].value[store.grid[editing.pad.id].pointer[0]].length<store.grid[editing.pad.id].pointer[1]){
store.grid[editing.pad.id].pointer[1]=store.grid[editing.pad.id].value[store.grid[editing.pad.id].pointer[0]].length;}
}

}
}

}







editing.cursor={};
editing.cursor.pulse={}
editing.cursor.pulse.matter=function(){
var cur=editing.pad.childNodes[store.grid[editing.pad.id].pointer[0]].childNodes[store.grid[editing.pad.id].pointer[1]];
if(cursor){cur.style.borderLeft='1px solid black';cursor=false;}
else{new editing.cursor.clean;}
}
editing.cursor.stop=function(){clearInterval(editing.cursor.pulse.timer);cursor=false;}
editing.cursor.start=function(){cursor=true;editing.cursor.pulse.timer=setInterval('new editing.cursor.pulse.matter;',700);}
editing.cursor.clean=function(){
var cur=editing.pad.childNodes[store.grid[editing.pad.id].pointer[0]].childNodes[store.grid[editing.pad.id].pointer[1]];
cur.style.borderLeft=null;cursor=true;
}
editing.data={}
editing.data.render=function(){
editing.data.rendered='';var i;
for(i=0;i<store.grid[editing.pad.id].value.length;i++){
if(i>0){editing.data.rendered+='\r\n';}var r;
for(r=0;r<store.grid[editing.pad.id].value[i].length;r++){
editing.data.rendered+=store.grid[editing.pad.id].value[i][r];
}
}
return editing.data.rendered;
}
