<?php
session_start();$zmuser=$_SESSION["zmuser"];$zmpass=$_SESSION["zmpass"];
$idx = isset($_GET['idx']) ? $_GET['idx'] : '';
$url= isset($_GET['url']) ? $_GET['url'] : '';
$imgURL = $url."/cgi-bin/nph-zms?mode=single&monitor=".$idx."&scale=100&user=".$zmuser."&pass=".$zmpass;
header("Content-type: image/jpeg");
readfile($imgURL);
?>

