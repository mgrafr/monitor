<?php
require_once("/www/monitor/api/f_pour_api.php");
require('vendor/autoload.php');
require('/www/monitor/admin/config.php');

function id_name($nom_objet) {
    if ($nom_objet=="") {return 0;}
    $conn = new mysqli(SERVEUR,UTILISATEUR,MOTDEPASSE,DBASE);
	$sql="SELECT * FROM ".DISPOSITIFS." WHERE nom_objet = '".$nom_objet."' AND Actif = '6' AND maj_js <> 'variable';";
	$result = $conn->query($sql);$nb_rows=$result->num_rows;
         $row = $result->fetch_assoc();
         if ($row!=null) {$ro=explode(":",$row['param']) ;$rq=[];
            $rq=['ID' => $row['ID'],
				  'nom_objet' => $row['nom_objet'],
				  'json' => $ro[1]
         ];
         $rx=json_encode($rq);echo $rx;return $rq;}
    return $nb_rows;}

use \PhpMqtt\Client\MqttClient;
use \PhpMqtt\Client\ConnectionSettings;

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

$mqtt = new MqttClient($server, $port, $clientId, $mqtt_version);

$mqtt->connect($connectionSettings, $clean_session);
printf("client connecté\n");

$mqtt->subscribe('zigbee2mqtt/#', function ($topic, $message) {
if ($topic == "monitor") {sms($message);}
$str=explode("/",$topic);$name=$str[1];$search_id=[];
$search_id=id_name($name);if ($search_id!=0) {$id=$search_id['ID'];$json=$search_id['json'];
if ($id!="") {$obj = json_decode($message);
    if (isset($obj->state) && $obj->state=="offline"){$ob=$obj->state;echo 'id='.$id.' state='.$ob."\n";maj($id,$ob);}
    if (isset($obj->$json)) {$ob=$obj->$json;echo 'id='.$id.' state='.$ob."\n";maj($id,$ob);}
} }
}, 0);
sleep(1);
$mqtt->loop(true);
