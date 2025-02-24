<?php
session_start();
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
$table = isset($_GET['table']) ? $_GET['table'] : '';


//
if ($app=="aff_th") {$retour= status_devices($device,'Temp','Humidity');echo json_encode($retour); }
else if ($app=="devices_plan") {if (DECOUVERTE==true) {include('include/json_demo/devices_plan_json.php');return;}
								else {$retour=devices_plan($variable);echo json_encode($retour); }}
else if ($app=="turn") {$retour=devices_id($device,$command,$type,$name);echo $retour; }
else if ($app=="OnOff") {$retour=switchOnOff_setpoint($device,$command,$type,$variable,$name);echo json_encode($retour); }
else if ($app=="put") {$retour=set_object($device,$type,$command,$name);echo json_encode($retour); }
else if ($app=="meteo_concept") {if (DECOUVERTE==true) {include('include/json_demo/meteo_concept_json.php');return;}
								else {echo $retour=meteo_concept($variable); }}
else if ($app=="upload_img") {$retour = upload_img($variable);echo json_encode($retour); }
else if ($app=="upload_conf_img") {cam_config($name,$command,$variable,$idx,$type); }
else if ($app=="graph") {graph($device,$variable);}	
else if ($app=="services") {if (DECOUVERTE==true) {include('include/json_demo/service_json.php');return;}
								else {$retour= status_variables('1');echo json_encode($retour); }}
else if ($app=="maj_var") {if ($idx=="msg") {require ("api/f_pour_api.php");echo message("",$name,0);}
						   else {$retour=maj_variable($idx,$name,$variable,$type);echo json_encode($retour);}}
else if ($app=="infos_met") {$retour=app_met($variable);echo json_encode($retour);}
else if ($app=="infos_nagios") {api_nagios($variable);}
else if ($app=="ecran_spa") {echo file_get_curl($variable);}
else if ($app=="data_var") {$retour= val_variable($variable);echo json_encode($retour);}
else if ($app=="dev_bd" || $app=="var_bd" || $app=="msg_bd"){echo mysql_app($_GET);}
else if ($app=="ha" || $appp=="ha" ) {$retour=devices_zone($device);echo json_encode($retour);}
else if ($app=="haid") {$retour=devices_id($device,$command);echo json_encode($retour);}
else if ($app=="iobid") {$retour=get_state_list($device);echo json_encode($retour);}
else if ($app=="shell") {$ip=$variable;$user_serv=$name;$pwd_serv=$table;include ('include/ssh_scp.php');}
else if ($app=="idxidm") {$retour=sql_variable(0,$command);echo json_encode($retour);}
else if ($app=="sql") {$retour=sql_app($idx,$variable,$type,$command,$name);echo $retour;}//$choix,$table,$valeur,$date,$icone
else if ($app=="log_dz") {log_dz($variable);}
else if ($app=="admin") {admin($variable,$command);}	//$command=fenetre(administration footer	
//  autres fonctions php-----------------------------------Z
else if ($appp=="mdp") {$retour=mdp($variablep,$commandp);echo json_encode($retour);}
else if ($appp=="adminp") {admin($variablep,$commandp);} // $command = content	(mes_js.js) & ("#adm1") fonctions.php
//
else echo "erreur ajax...".$app.$appp;
//

?>
