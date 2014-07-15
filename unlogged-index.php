<!DOCTYPE html>
<html>
    <head>
        <link href="http://<?php echo $domain;?>/pic/favicon.ico" rel="shortcut icon" type="image/x-icon" />
        <title><?php echo $network_name;?></title>
        <link href="http://<?php echo $domain;?>/store/lc/icons.css" rel="stylesheet" type="text/css"/>
		<meta name="description" content="<?php echo $network_desc;?>">
        <script src="http://<?php echo $domain;?>/store/lc/lc.js" type="text/javascript"></script>
        <style type="text/css">
            body{font-size:12px;margin:0 auto;font-family: "Lucida Grande",  Helvetica, sans-serif, Verdana, Arial;height:100%;}
            #mainbox{max-width:1280px;height:100%;margin:0 auto;position:relative;background:#fff;color:white;}
            header{margin:0 20px;background:#fff;width:83px;padding:29px 0px 15px 30px;display:inline-block;float:left;}
/*+++++++++++NoticeBoard-style++++++++++++++++*/            

			#noticeboard{width:357px;height:412px;position:relative;top:0;left:18%;float:center;display:inline-block;}
            #nb_titleplate{padding:11px 0 8px;text-align:center;background:#534e4e;border:1px solid white;border-top:0;font-size:14px;z-index:2;position:relative;}
            #nb_slidable{position:relative;top:0px;z-index:0;}
            #nb_noticebox{height:250px;background:#9b9b9b;border:1px solid white;border-width:0 1px;overflow:auto;padding-top:0;}
            #nb_noticebox span{font-size: 11px;color:#d7d6d6;}
            #nb_noticebox p{font-size: 14px;margin:5px;}
            #nb_noticebox i{width:20px;height:8px;background:#64a5d4;border:1px solid white;display:block;position:relative;left:-32px;top:12px;}
            #nb_moreButton{font-size:14px;color:#4e94ce;text-align:center;padding:13px;background:#dcdcdc;border:1px solid white;cursor:pointer;}
            #nb_moreButton:hover{background:#e8e8e8;}
            #nb_packupswitch{margin-top:7px;}
            #nb_packupswitch img,#log_switch img{cursor:pointer;}
 			.notice{background:#a8a8a8;border-bottom:1px solid white;padding:3px 22px 12px;cursor:pointer;}
            .notice:hover{background:#909090;}            
			.brownbox{background:#979797;border:1px solid white;color:white;display:inline-block;padding:1px 3px;}
            .whitedivider{width:5px;background:white;margin:0;}

/*+++++++++++Logbox-style++++++++++++++++*/

			#logbox{width:250px;float:right;margin:0 30px;position:relative;}
            #logbox_inner{background:#c9e4f9;border:1px solid #e6f4ff;border-top:0;}
            #fblogin{border:1px solid white;padding:5px 12px;width:145px;background:#ddf6ff;color:#7aacd6;cursor:pointer;}
            #emailbox input, #passbox input{border:0;width:170px;text-align:center;height:25px;}
            #login{cursor:pointer;border:1px solid #71b453;background:#f2f2f2;padding:3px 6px;margin-bottom:25px;color:#698fbc;width:55px;}
            #Error{background:rgb(255, 255, 182);color:#666;text-align:center;font-size:11px;padding: 3px 5px;border-top: 3px solid white;display:none;}
            .forminput_box{border:1px solid white;width:175px;padding:2px;line-height:18px;}          


/*+++++++++++Extra-style++++++++++++++++*/  

            .clear{clear:both;height:0;}
            
            
        </style>
        <script type="text/javascript">
            new lc.sensor.ini();window.indx = new Object();
            var nb_status=1,notice_count=<?php $newsCount=10; echo $newsCount;?>,lb_status=0;
            lc.sensor.act.click=function(r){
                if(tClick.id == 'nb_slider'){
                    if(window.nb_status == 1){
                        new lc.anim.slide({id:'nb_slidable',distance:12,dir:'^',framegap:7,reference:'top',stopAt:-300,AFx:function(r){x('nb_slider').className='down_arrow_blue';window.nb_status=0;}}); x('nb_titleplate').style.cursor='pointer';}
                    else{
                        new lc.anim.slide({id:'nb_slidable',distance:12,dir:'v',framegap:7,reference:'top',stopAt:0,AFx:function(r){x('nb_slider').className='up_arrow_blue';window.nb_status=1;}}); x('nb_titleplate').style.cursor='auto';
                   }
                }
                if(tClick.id == 'nb_titleplate'){
                    if(window.nb_status == 0){
                        new lc.anim.slide({id:'nb_slidable',distance:12,dir:'v',framegap:7,reference:'top',stopAt:0,AFx:function(r){x('nb_slider').className='up_arrow_blue';window.nb_status=1;}}); x('nb_titleplate').style.cursor='auto';}
                }
                if(tClick.id == 'log_slider'){
                    if(lb_status == 1){new indx.slidelogbox.up();lb_status=0;}
                    else{new indx.slidelogbox.down();lb_status=1;}
                }
                if(tClick.id == 'login'){
                    if(lb_status == 0){new indx.slidelogbox.down();lb_status=1;}
                    else{new logy.logy();}
                }
            }
            
            indx.slidelogbox={};
            indx.slidelogbox.up=function(){
                new lc.anim.slide({id:'logbox',distance:2,dir:'^',framegap:3,reference:'top',stopAt:-204,AFx:function(r){ x('log_slider').className='down_arrow_white';hidee('Error');}});
                new lc.anim.prop({id:'login', type:'-', propname:'marginBottom', stopAt:7, framegap:10, jump:1, AFx:function(){}});
            }
            indx.slidelogbox.down=function(){
                new lc.anim.slide({id:'logbox',distance:2,dir:'v',framegap:3,reference:'top',stopAt:0,AFx:function(r){x('log_slider').className='up_arrow_dimgrey';}});
                new lc.anim.prop({id:'login', type:'+', propname:'marginBottom', stopAt:25, framegap:10, jump:1, AFx:function(){x('email').focus();}});
				
            }
            var logy={};
            logy.logy=function(){
                var err = x('Error');showwb('Error');
                 var email = x('email');
                 email = email.value.replace(/^\s+|\s+$/g, '');
                 var pass = x('pass');
                if(email == ''){err.innerHTML='Please type-in your email address';}else{
                new lc.indicator.start('Error','horzDotLoop','rgb(156, 205, 209)');
                 var p = 'email='+email+'&password='+pass.value;
                 new ajax.request("in/login.php" , {method : 'POST' , parameters : p , requestHeaders : {Accept : 'application/json'} , onSuccess : function(a){
                 var y = eval("("+a+")");
                 if(parseInt(y.r) == 1)
                 new logy.packup();
                 else
                 setTimeout('new lc.indicator.stop(\'Error\');window.indicDotIni=0;', 100);err.innerHTML = y.m;
	             }});
                }
                return false;
            }
          logy.packup=function(){
				new lc.indicator.stop('Error');window.indicDotIni=0;
                new lc.anim.slide({id:'logbox',distance:4,dir:'^',framegap:3,reference:'top',stopAt:-280,AFx:function(r){}});
                new lc.anim.slide({id:'lc_logo',distance:3,dir:'^',framegap:30,reference:'top',stopAt:-180,AFx:function(r){}});
                new lc.anim.slide({id:'noticeboard',distance:3,dir:'^',framegap:3,reference:'top',stopAt:-580,AFx:function(r){window.location.reload();}});
				
            }
        </script>
    </head>
    <body>
        <div id="mainbox" style="background-size:1280px;background:url('http://loudc.com/pic/favicon.ico')center no-repeat;">
            <header id="lc_logo" style="top:0px;position:relative;"><img src="http://<?php echo $domain;?>/pic/favicon.ico"/></header>
            <div id="noticeboard" style="top:0px;position:relative;">
                <div id="nb_titleplate">Notice Board</div>
                <div id="nb_slidable" style="top:0px;">
                        <div id="nb_noticebox" align="left">
                            <?php echo "<br/><br/><div align=\"center\">Not working</div>"?>
                        </div>
                    <div id="nb_moreButton">See all previous Notices</div>
                    <div id="nb_packupswitch" align="center">
                        <img src="http://<?php echo $domain;?>/pic/blank.gif" class="up_arrow_blue" id="nb_slider" />
                    </div>
                </div>
            </div>
            <div id="logbox" align="center" style="top:-204px;">
                <div id="logbox_inner">
                    <p class="whitedivider"><br/></p>
                    <div id="fblogin">Login with facebook</div>
                    <p class="whitedivider"><br/><br/></p>
                    <label class="brownbox" for="email">OR</label>
                    <form id="loginform" onsubmit="return logy.logy();" action="in/login.php" method="post">
                        <p class="whitedivider"><br/></p>
                        <div id="emailbox" class="forminput_box"><input type="text" id="email" name="email" placeholder="Email"/></div>
                        <p class="whitedivider"><br/></p>
                        <div id="passbox" class="forminput_box"><input type="password" id="pass" name="password" placeholder="Password"/></div>
                        <p class="whitedivider"><br/></p>
                        <div id="login" style="background:#f2f2f2;margin-bottom:7px;">Login</div>
                        <input type="submit" style="visibility:hidden;position:fixed;left:100000px" value="Login"/>
                    </form>
                    <div id="Error"></div>
                </div>
                <div id="log_switch" align="center">
                    <img src="http://<?php echo $domain;?>/pic/blank.gif" class="down_arrow_white" id="log_slider" />
                </div>
            </div>
            <br class="clear"/>
           
        </div>
        
    </body></html>