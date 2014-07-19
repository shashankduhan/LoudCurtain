<?php
function a($x){
	if(trim($x[0]) != ''){$GLOBALS['data'][$GLOBALS['layer']][$GLOBALS['y']]=$x[0];$GLOBALS['y']++;}
	for($i=1;$i<count($x);$i++){
		$a=explode(')',trim($x[$i]));
        if(trim($x[$i]) == ''){$GLOBALS['data'][$GLOBALS['layer']][$GLOBALS['y']]='&lcnewlayer';$GLOBALS['layer']++;$GLOBALS['y']=0;}
		else{b($a);}
	}
}
function b($x){
	if(trim($x[0]) != ''){
		$c=explode('AND',trim($x[0]));
		if(count($c)>1){$GLOBALS['data'][$GLOBALS['layer']][$GLOBALS['y']]='&lcnewlayer';$GLOBALS['y']++;
						$GLOBALS['data'][$GLOBALS['layer']+1][0]=$x[0];}
		else{$c=explode('OR',trim($x[0]));
			if(count($c)>1){$GLOBALS['data'][$GLOBALS['layer']][$GLOBALS['y']]='&lcnewlayer';$GLOBALS['y']++;
							$GLOBALS['data'][$GLOBALS['layer']+1][0]=$x[0];}
			else{$GLOBALS['data'][$GLOBALS['layer']][$GLOBALS['y']]=$x[0];$GLOBALS['y']++;}
		}
}
	for($i=1;$i<count($x);$i++){
        if(trim($x[$i]) == ''){$GLOBALS['layer']--;$GLOBALS['y']=(count($GLOBALS['data'][$GLOBALS['layer']]));}
		else{$GLOBALS['data'][$GLOBALS['layer']][$GLOBALS['y']]=$x[$i];$GLOBALS['y']++;}
 }
}
function c($x){/*it parse and convert given values to system recognized values*/
    $r='';
	$c=explode('AND',trim($x));
		for($i=0;$i<count($c);$i++){
			$d=explode('OR',trim($c[$i]));
			for($ii=0;$ii<count($d);$ii++){
				$e=explode('=',trim($d[$ii]));
				if(count($e)>1){$r.="(`for`='".fetchColId($GLOBALS['tid'],trim(trim($e[0]),"'\"`"))."' AND `value`='".trim(trim($e[1]),"'\"`")."')";}
				else{$e=explode('~',trim($d[$ii]));
					if(count($e)>1){$r.="(`for`='".fetchColId($GLOBALS['tid'],trim(trim($e[0]),"'\"`"))."' AND MATCH(`value`) AGAINST('".trim(trim($e[1]),"'\"`")."'))";}
				}
				if($ii!=(count($d)-1)){$r.=' OR ';}
			}
			if($i!=(count($c)-1)){$r.=' AND ';}
		}
	return $r;

}
 function  arrayecho($data,$y){
  $x=$data[$y];$echo='';
	for($i=0;$i<count($x);$i++){
	if($x[$i]=='&lcnewlayer'){
			$echo.= '(';
			for($ii=0;$ii<count($GLOBALS['data'][$y+1]);$ii++){
					if($GLOBALS['data'][$y+1][$ii] != '&lcnewlayer'){$echo.= "".c($GLOBALS['data'][$y+1][$ii]).' ';}
					else{$echo.= '('.arrayecho($data,$y+2).') ';}}
			$echo.= ') ';
		}else{$echo.= "".c($x[$i]).' ';}
	}
	return $echo;
}

if(isset($_POST['where'])){
	$where="";$incoming=trim($_POST['where']);
	$a=explode('(',$incoming);
	if(count($a)>1){
        $GLOBALS['layer']=0;$GLOBALS['y']=0;
        $GLOBALS['data']=array();
		a($a);
		$where = arrayecho($GLOBALS['data'],0);
	}
	else{$where = c(trim($a[0]));}
	if($where != ''){$where="(".$where.")";}
}else{$where='';}


?>