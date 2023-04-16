<?php
//session_start();
echo '<!DOCTYPE html><html><body style="background-color: cornsilk;">';

$rep="/"; $domaine=$_SERVER['HTTP_HOST'];$port=$_SERVER['SERVER_PORT'];

if (substr($domaine, 0, 7)=="192.168") $rep="/monitor/";
header('Location: '.$rep.'index_loc.php');
  exit();

?>