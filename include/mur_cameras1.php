<?php
session_start();
require_once('../'.MONCONFIG);
$id_zm = isset($_GET['id_zm']) ? $_GET['id_zm'] : '';
if ($_SESSION["exeption_db"]=="pas de connexion à la BD") return ;
$conn = new mysqli(SERVEUR,UTILISATEUR,MOTDEPASSE,DBASE);
$sql="SELECT * FROM `cameras` WHERE id_zm='".$id_zm."' ;" ;

$result = $conn->query($sql);
	$row_cnt = $result->num_rows;
	if ($row_cnt==0) {return  null;}
$ligne = $result->fetch_assoc(); 
$imgURL = $ligne['url'];
header("Content-type: image/jpeg");
ob_clean();
	flush();
	readfile($imgURL);
	exit;

?>

