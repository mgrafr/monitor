<?php
require_once('../fonctions.php');

function envoi_fich($name){
$name[0] = ['idx' => '999'];	
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

function onoff($serveur,$nom,$state){	
return;
}
function maj($id,$state){
$donnees=array();	
$donnees=[
   'command'=> '4',
   'id' => $id,
   'state' => $state
    ];
mysql_app($donnees);	
return ;
}


?>
