<?php
require ("fonctions.php");
$retour=array();
//POST-------------------
$appp = isset($_POST['appp']) ? $_POST['appp'] : '';
$variablep = isset($_POST['variable']) ? $_POST['variable'] : '';
$commandp = isset($_POST['command']) ? $_POST['command'] : '';
//GET----------------------
$app = isset($_GET['app']) ? $_GET['app'] : '';
$idx = isset($_GET['idx']) ? $_GET['idx'] : '';
$device = isset($_GET['device']) ? $_GET['device'] : '';
$name = isset($_GET['name']) ? $_GET['name'] : '';
$variable = isset($_GET['variable']) ? $_GET['variable'] : '';
$command = isset($_GET['command']) ? $_GET['command'] : '';
$type = isset($_GET['type']) ? $_GET['type'] : '';
//
if ($app=="aff_th") {$retour= status_devices($device,'Temp','Humidity');echo json_encode($retour); }
else if ($app=="devices_plan") {$retour=devices_plan($variable);echo json_encode($retour); }
else if ($app=="OnOff") {$retour=switchOnOff_setpoint($device,$command,$type,$variable,$name);echo json_encode($retour); }
else if ($app=="meteo_concept") {echo $retour=meteo_concept($variable); }
else if ($app=="upload_img") {$retour = upload_img($variable);echo json_encode($retour); }
else if ($app=="upload_conf_img") {cam_config($name,$command,$variable,$idx,$type); }
else if ($app=="graph") {graph($device,$variable);}	
else if ($app=="services") {$retour= status_variables($variable);echo json_encode($retour); }
else if ($app=="maj_var") {$retour=maj_variable($idx,$name,$variable,$type);echo json_encode($retour);}
else if ($app=="infos_met") {$retour=app_met($variable);echo json_encode($retour);}
else if ($app=="infos_nagios") {api_nagios($variable);}
else if ($app=="ecran_spa") {echo file_get_curl($variable);}
//else if ($app=="device_id") {$retour=status_devices($device);echo json_encode($retour);}
//else if ($app=="app_nagios") {app_nagios($variable);}
//else if ($app=="mur_zm") {mur_zm($variable,$command);}
else if ($app=="sql") {$retour=sql_app($idx,$variable,$type,$command,$name);echo $retour;}//$choix,$table,$valeur,$date,$icone
else if ($app=="log_dz") {log_dz($variable);}
else if ($app=="admin") {admin($variable,$command);}	//$command=fenetre(administration footer	
//  autres fonctions php-----------------------------------Z
else if ($appp=="mdp") {$retour=mdp($variablep,$commandp);echo $retour;}
else if ($appp=="adminp") {$retour=admin($variablep,$commandp);} // $command = content	(mes_js.js) & ("#adm1") fonctions.php
//
else echo "erreur ajax";

?>
