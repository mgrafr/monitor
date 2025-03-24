<?php
define('SERVEUR','localhost');
define('MOTDEPASSE','Idem4546');
define('UTILISATEUR','michel');
define('DBASE','monitor');
//require_once('/admin/config.php)';
//echo "azerty";return;
//require_once('/fonctions.php');
function envoi_data($name){
$name[0] = ['data' => '998'];	
return $name;	
	
}
function message($contenu,$nom,$maj){
$conn = new mysqli(SERVEUR,UTILISATEUR,MOTDEPASSE,DBASE);
	
if ($conn -> connect_errno) {
  echo "Failed to connect to MySQL: " . $conn -> connect_error;
  exit();
}
if ($maj==1) {$sql="UPDATE messages SET contenu = '".$contenu."', `maj`=1  WHERE nom='".$nom."'";}
if ($maj==0) {$sql="UPDATE messages SET `maj`=0 WHERE nom='".$nom."'";}	
if ($conn->query($sql) === TRUE) {
  echo "Enregistrement mis à jour";
} else {
  echo "Erreur update: " . $conn->error;
}

$conn->close();
}


function maj($id,$state){
$donnees=array();	
$donnees=[
   'command'=> '4',
   'id' => $id,
   'state' => $state,
	'date' => date("H:i:s", time())
    ];
mysql_app1($donnees);
//return 'OK';
}
function sms($contenu){
  $file="/www/monitor/python/aldz.py";
  $content="#!/usr/bin/env python3 -*- coding: utf-8 -*-
x='".$contenu."'
priority=0";
file_put_contents($file,$content);
return "envoi_sms:".$contenu."    ".$content;  
}


function mysql_app1($data){
  $conn = new mysqli(SERVEUR,UTILISATEUR,MOTDEPASSE,DBASE);
if ($conn -> connect_errno) {
  echo "Failed to connect to MySQL: " . $conn -> connect_error;
  exit();}	
  //UPDATE `sse` SET `id`='418',`state`='Off',`date`='13:14:49' WHERE num=0		
  $sql="UPDATE sse SET id='".$data['id']."',state='".$data['state']."',date='".$data['date']."' WHERE num=0;";
  echo $sql;	
  $result = $conn->query($sql);	
}	
?>
