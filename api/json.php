<?php
require_once("f_pour_api.php");
// require_once('../admin/config.php');
//GET----------------------
$app = isset($_GET['app']) ? $_GET['app'] : '';
$name = isset($_GET['name']) ? $_GET['name'] : '';
$serveur = isset($_GET['serveur']) ? $_GET['serveur'] : '';
$variable = isset($_GET['variable']) ? $_GET['variable'] : '';
$command = isset($_GET['command']) ? $_GET['command'] : '';
$contenu= isset($_GET['contenu']) ? $_GET['contenu'] : '';
$id= isset($_GET['id']) ? $_GET['id'] : '';
$state = isset($_GET['state']) ? $_GET['state'] : '';
//POST-------------------
$appp = isset($_POST['appp']) ? $_POST['appp'] : '';
$idp = isset($_POST['id']) ? $_POST['id'] : '';
$statep = isset($_POST['state']) ? $_POST['state'] : '';
//
if ($app=="api_rest_ha") {$retour= envoi_data($essai);echo json_encode($retour); }
if ($app=="messages") {$retour= message($contenu,$name,$command);echo json_encode($retour); }
if ($app=="maj") {$retour= maj($id,$state);echo json_encode($retour); }
if ($app=="envoi_sms") {$retour= sms($contenu);echo json_encode($retour); }
return "erreur API";
?>

