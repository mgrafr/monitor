<?php
require_once("/www/monitor/api/f_pour_api.php");
require('vendor/autoload.php');
require('/www/monitor/admin/config.php');

use \PhpMqtt\Client\MqttClient;
use \PhpMqtt\Client\ConnectionSettings;

function publier($message){global $server,$port,$username,$password;
$topic="z2m";
$clientId = rand(6, 15);
$connectionSettings = (new ConnectionSettings)
  ->setUsername($username)
  ->setPassword($password);
$mqtt = new \PhpMqtt\Client\MqttClient($server, $port, $clientId);
$mqtt->connect($connectionSettings);
while (true) {
    $iterationStartedAt = microtime(true);
//foreach ($this->getMessagesToPublish() as $messageToPublish) {
        //$mqtt->publish($messageToPublish->topic, $messageToPublish->message, MqttClient::QOS_AT_MOST_ONCE);
    //}
    $mqtt->publish('z2m', $message, 1,true);
echo "envoi msg:".$message;
// You can set a third optional parameter as a timeout
$mqtt->loopOnce();
$iterationDuration = microtime(true) - $iterationStartedAt;
    if ($iterationDuration < 1) {
        usleep((1 - $iterationDuration) * 1_000_000);
    }
}
$mqtt->disconnect();
return;
}
function id_name($nom_objet) {
    if ($nom_objet=="") {return ['ID' => '0'];}
    $conn = new mysqli(SERVEUR,UTILISATEUR,MOTDEPASSE,DBASE);
	$sql="SELECT * FROM ".DISPOSITIFS." WHERE nom_objet = '".$nom_objet."' AND Actif = '6' AND maj_js <> 'variable';";
	$result = $conn->query($sql);$nb_rows=$result->num_rows;
         $row = $result->fetch_assoc();
         if ($row!=null) {$ro=explode(":",$row['param']) ;$rq=[];
            $rq=['ID' => $row['ID'],
				  'nom_objet' => $row['nom_objet'],
				  'json' => $ro[1]
         ];
         $rx=json_encode($rq);echo $rx;}
         else {$rq=['ID' => '0'];}
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
    $mqtt->subscribe('zigbee2mqtt/#', function ($topic, $message) use ($mqtt,$msg) {
if ($topic == "monitor") {sms($message);}
$str=explode("/",$topic);$name=$str[1];$search_id=[];
$search_id=id_name($name);$id=$search_id['ID'];
if ($id!="0") {$json=$search_id['json'];$obj = json_decode($message);
    if (isset($obj->state) && $obj->state=="offline"){$ob=$obj->state;$msg='{ "id" : "'.$id.'", "state" : "'.$ob.'" }';maj($id,$ob);}
    if (isset($obj->$json)) {$ob=$obj->$json;$msg='{ "id" : "'.$id.'", "state" : "'.$ob.'" }';echo '------------'.$msg;
      publier($msg);  
} }} );
    $mqtt->loop();
    $mqtt->disconnect();
}
catch (\Throwable $e) {
    echo 'An exception occured: ' . $e->getMessage() . PHP_EOL;
}





