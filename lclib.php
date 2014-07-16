<?php
//++++Basic setup values

include('customizer.php');
//----Basic setup values

//++++Common Functions

function viacurl($location,$filetype){
		header("Content-Type: $filetype");
		$ch = curl_init();
	
		curl_setopt($ch, CURLOPT_URL, $location);
		curl_setopt($ch, CURLOPT_HEADER, false);
		curl_setopt ($ch, CURLOPT_RETURNTRANSFER, 1);
	
		$out = curl_exec($ch);
	
		curl_close($ch);
	
		return rtrim($out,1);
}

function trim_value(&$value) { 
    $value = trim($value); /*To make whole array trimmed use array_walk($thearray,'trim_value')*/
}

function lc_request($values,$default){
	$value = @$_REQUEST[$values[0]];
	for($i=1;$i<count($values);$i++){
		if(empty($value)){$value = @$_REQUEST[$values[$i]];}
	}
	if(empty($value)){$value=$default;}
	return $value;
}

function timer($t){
$tNow=time();
if($tNow-$t < 100){return 'just now';}
else if($tNow-$t<3600){return round(($tNow-$t)/60) .'mins ago';}
else if($tNow-$t<40000){return round(($tNow-$t)/(60*60))."hrs ago";}
else{return @date('l, dMy' , $t);}
}
//----Common Functions
?>