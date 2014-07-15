<?php 
ob_start();
include('../../lclib.php');
$uri=$_SERVER['REQUEST_URI'];
$uri=trim($uri,'/');
$uri=explode('/',$uri);
if(count($uri)==3){

$fileinfo=explode('.',$uri[2]);
if($fileinfo[1] == 'js'){$filetype='text/javascript';}
else if($fileinfo[1] == 'css'){$uri[2]=$fileinfo[0].'.php';$filetype='text/css';}
else{$filetype='';}

$path="http://$domain/static/file/lc/".$uri[2];
header('HTTP/1.1 200 OK');
echo viacurl($path,$filetype);
}
ob_flush();
?>