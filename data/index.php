<?php include('../ConnectMysql.php'); ?>
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link href="/centralstyle.css" rel="stylesheet" type="text/css"/>
<style type="text/css">
body{margin:0 auto;font-family: "Lucida Grande",  Helvetica, sans-serif, Verdana, Arial;background:#666;color:white;font-size:25px;padding:25px;}
</style>
<script src="/static/file/lc/lc.js"></script>
<script type="text/javascript"></script>
</head>
<body><sub>loudcurtain.com</sub>/data <br/><?php
$q=mysqli_query($link,"SELECT * FROM `loudcurt_hh`.`datables`");
?></body></html>
