<?php // PHP-MQTT
require('/www/monitor/vendor/autoload.php');
require('/www/monitor/admin/config.php');

use \PhpMqtt\Client\MqttClient;
use \PhpMqtt\Client\ConnectionSettings;

function id_name($nom_objet) {
$zb_donnees=array();
$zb_donnees = [
	'state' => "Data",
    'state_l2' => "Data",
    'state_l1' => "Data",
	'temperature' => "temp",
	"contact" => "Data"
    ];   
    if ($nom_objet!="") {
    $conn = new mysqli(SERVEUR,UTILISATEUR,MOTDEPASSE,DBASE);
	$sql="SELECT * FROM ".DISPOSITIFS." WHERE ( nom_objet = '".$nom_objet."' AND Actif = '6' AND maj_js <> 'variable');";
	$result = $conn->query($sql);$nb_rows=$result->num_rows;
        if ($nb_rows>0) {$row = $result->fetch_assoc();echo $row['ID'];
        $ro=explode(":",$row['param']) ;$rq=[];
            $rq=['ID' => $row['ID'],
                 'idm' => $row['idm'],
                 'champ' => $zb_donnees[$ro[1]],
				 'json' => $ro[1]
         ];
         $rx=json_encode($rq);echo $rx;}
        else { $rq=['ID' => '0'];}}
    else { $rq=['ID' => '0'];}    
    return $rq;}
 
$server   = MQTT_IP;
$port     = 1883;
$clientId = rand(5, 15);
$username = MQTT_USER;
$password = MQTT_PASS;
$clean_session = false;
$mqtt_version = MqttClient::MQTT_3_1_1;
$connectionSettings = (new ConnectionSettings)
  ->setUsername($username)
  ->setPassword($password)
  ->setKeepAliveInterval(60)
  ->setLastWillTopic('monitor/last-will')
  ->setLastWillMessage('client mqtt déconnecté')
  ->setLastWillQualityOfService(1);
try {
    $mqtt = new MqttClient($server, $port, $clientId, $mqtt_version);
    $mqtt->connect($connectionSettings, $clean_session);
    printf("client connecté\n");	
    $mqtt->subscribe('zigbee2mqtt/#', function ($topic, $message) use ($mqtt) {
//if ($topic == "monitor") {sms($message);}
$str=explode("/",$topic);$name=$str[1];$search_id=[];
$search_id=id_name($name);$id=$search_id['ID'];
if ($id!="0") {$idm=$search_id['idm'];$json=$search_id['json'];$champ=$search_id['champ'];$obj = json_decode($message);
    if (isset($obj->state) && $obj->state=="offline"){$ob=$obj->state;$msg='{ "id" : "'.$id.'", "objet" : "'.$name.'", "state" : "'.$ob.'" }';maj($id,$ob);}
    if (isset($obj->$json)) {$ob=$obj->$json;$msg='{ "id" : "'.$id.'", "objet" : "'.$name.'","state" : "'.$ob.'", "champ1" : "'.$champ.'", "champ2" : "'.$json.'", "idm" : '.$idm.'}';
        echo '------------'.$msg;
     $mqtt->publish('z1m', $msg, 0,false);$id="0";$str=[];
    echo "envoi msg:".$msg; 
} }} );
    $mqtt->loop();
    $mqtt->disconnect();
}
catch (\Throwable $e) {
    echo 'An exception occured: ' . $e->getMessage() . PHP_EOL;
}





