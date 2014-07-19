<?php
include('../lclib.php');
session_start();
if(isset($_SESSION['uid'])){//Proceeds only if user is logged in
if(isset($_GET['table_name'])){$tablename=$_GET['table_name'];}else if(isset($_POST['table_name'])){$tablename=$_POST['table_name'];}else{echo errormsg('Name of table not provided (L5)');exit();}
if(isset($_GET['no_of_col'])){$no_of_col=$_GET['no_of_col'];}else if(isset($_POST['no_of_col'])){$no_of_col=$_POST['no_of_col'];}else{$no_of_col=1;}
/*HTML UI content starts*/?>
<!DOCTYPE html>
<html>
    <head>
        <link href="http://<?php echo $domain;?>/pic/favicon.ico" rel="shortcut icon" type="image/x-icon" />
        <title>Table Creator</title>
        <link href="http://<?php echo $domain;?>/store/lc/icons.css" rel="stylesheet" type="text/css"/>
        <script src="http://<?php echo $domain;?>/store/lc/lc.js" type="text/javascript"></script>
        <style type="text/css">
            body{font-size:12px;margin:0 auto;font-family: "Lucida Grande",  Helvetica, sans-serif, Verdana, Arial;height:100%;}
            #pagetitle{padding:5px 15px 3px;font-size:11px;border-bottom:3px solid lightblue;background:#293B55;color:#e6e6e6;}
            #tablename{border:1px solid #F0EEBF;padding:6px 12px;width:150px;color:#666;font-size:15px;border-radius:3px;}
            #headbar{padding:12px 15px;}
            #descbox{float: right;width: 245px;height: 32px;border: 1px solid #ccc;display: inline-block;border-radius: 3px;font-size: 11px;color: #666;padding: 12px;resize:none;}
            #cancelBut{cursor: pointer;color: #98A1BE;font-size: 9px;margin: 5px 75px 0;float: left;display:block;}
            #columnpad{margin: 15px 15px 0;padding: 0 0 12px;border-radius: 12px;border: 1px solid #ACB8A7;overflow: hidden;}
            #colPadTitle{font-size: 10px;padding: 3px 29px;background: #F1F1E4;color: rgb(105, 124, 184);}
            #createit{margin:4px auto;width:60px;border:1px solid #c2c2c2;color:#85B28B;padding:4px;position:relative;border-radius:3px;cursor:pointer;text-align:center;}
            #newColBut{margin:0px auto 45px;width:15px;border:1px solid #93B0CA;border-top:0;background:#A9DAB0;padding:4px 4px 8px;position:relative;border-radius:0 0 3px 3px;cursor:pointer;text-align:center;color:rgb(219, 124, 181);}
            
            .colbox{padding: 7px 0;background: #D8DAC9;margin-bottom: 1px;}
            .colserial{float: left;margin-right: 12px;background: rgb(108, 153, 155);color: white;padding: 4px;width: 15px;text-align: right;}
            .coldel{float: right;margin-right: 32px;background: rgb(230, 192, 192);color: white;padding: 3px 7px;border-radius: 55px;cursor: pointer;}
            .colname{border: 1px solid #74C07A;padding: 2px 15px 3px;font-size: 11px;color: #474747;}
        </style>
        <script type="text/javascript">
            window.onload=function(){
                var headbar = lc.newelement({type:'div', id:'headbar'});
                var tablename = lc.newelement({type:'input', id:'tablename', value:'<?php echo $tablename;?>', name:'tablename', inputtype:'text'});
                var descbox = lc.newelement({type:'textarea', id:'descbox'});descbox.placeholder = 'Tell something about this table';
                var cancelbut = lc.newelement({type:'a', id:'cancelBut'});cancelbut.innerHTML = 'Cancel';
                var columnpad = lc.newelement({type:'div', id:'columnpad'});
                var colpadtitle = lc.newelement({type:'div', id:'colPadTitle'});colpadtitle.innerHTML='Lets add some column to it:';
                var createbutton = lc.newelement({type:'div', id:'createit'});createbutton.innerHTML='Create';
                document.body.appendChild(headbar);
                headbar.appendChild(tablename);headbar.appendChild(descbox);headbar.appendChild(cancelbut);
                document.body.appendChild(columnpad);columnpad.appendChild(colpadtitle);columnpad.appendChild(createbutton);
                for(a=1;a<=<?php echo $no_of_col;?>;a++){new local.addcolumn();}
                var newcolbut = lc.newelement({type:'div', id:'newColBut'});newcolbut.innerHTML='+';
                document.body.appendChild(newcolbut);
            }
            var local=collist={};collist.colcount=0;
            local.addcolumn = function(){
                var colbox = lc.newelement({type:'div', id:'colbox_'+(collist.colcount+1), class:'colbox'});
                var colserial = lc.newelement({type:'div', id:'colserial_'+(collist.colcount+1), class:'colserial'});colserial.innerHTML=(collist.colcount+1);
                var coldel = lc.newelement({type:'div', id:'coldel_'+(collist.colcount+1), class:'coldel'});coldel.innerHTML='-';
                var colname = lc.newelement({type:'input', id:'colname_'+(collist.colcount+1), class:'colname', name:'Name of Column', inputtype:'text'});colname.placeholder='Name of Colunm';
                columnpad.appendChild(colbox);colbox.appendChild(colserial);colbox.appendChild(coldel);colbox.appendChild(colname);
                collist.colcount++;
            }
            local.delcolumn = function(a){
                x('colbox_'+a).parentNode.removeChild(x('colbox_'+a));
                for(c=a;c<collist.colcount;c++){
                    x('colbox_'+(parseInt(c)+1)).id='colbox_'+c;
                    x('colserial_'+(parseInt(c)+1)).id='colserial_'+c;x('colserial_'+c).innerHTML=c;
                    x('coldel_'+(parseInt(c)+1)).id='coldel_'+c;
                    x('colname_'+(parseInt(c)+1)).id='colname_'+c;
                }
                collist.colcount--;
            }
            local.updatecollist = function(a){//a = {action:add/del ; val:nof of column added OR id of column deleted}
                if(a.action == '++'){collist.colcount++;}
                if(a.action == '--'){collist.colcount--;}
            }
            local.createit = function(){
                alert('Rukja meri jaan ;)');
            }
            
            //initiate Sensors
            lc.sensor.ini();
            lc.sensor.act.click = function(){
                if(tClick.id == 'newColBut'){new local.addcolumn();}
                if(tClick.id.split('_')[0] == 'coldel'){new local.delcolumn(tClick.id.split('_')[1]);}
                if(tClick.id == 'createit'){new local.createit();}
            }
        </script>
    </head>
    <body>
        <div id="pagetitle"><span style="color: #8F8F8F;">Datable</span> <span style="color: #81ABE0;">|</span> Lets create new Table</div>
    </body>
</html>


<?php }else{echo errormsg('You are not logged in.');}?>