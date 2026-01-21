<?php // PHP-MQTT
require('/www/monitor/vendor/autoload.php');
require('/www/monitor/admin/config.php');

use \PhpMqtt\Client\MqttClient;
use \PhpMqtt\Client\ConnectionSettings;

function id_name($nom_objet) {$rq=[];
$zb_donnees=array();
$zb_donnees = [
	'state' => "Data",
    'state_l2' => "Data",
    'state_l1' => "Data",
	'temperature' => "temperature",
    'soil_moisture' => "Data",
    'humidity' => "humidity",
	"contact" => "Data"
    ];   
    if ($nom_objet!="") {
    $conn = new mysqli(SERVEUR,UTILISATEUR,MOTDEPASSE,DBASE);
	$sql="SELECT * FROM ".DISPOSITIFS." WHERE ( nom_objet = '".$nom_objet."' AND Actif = '6' AND maj_js <> 'variable');";
	$result = $conn->query($sql);$nb_rows=$result->num_rows;
        if ($nb_rows>0) {$i=0;//$row = $result->fetch_assoc();echo $row['ID'];
            while($row = $result->fetch_array(MYSQLI_ASSOC)){
        $ro=explode(":",$row['param']) ;
            $rq[$i]=['ID' => $row['ID'],
                 'idm' => $row['idm'],
                 'champ' => $zb_donnees[$ro[1]],
                 'nb' => $nb_rows,
				 'json' => $ro[1]
         ];}
         //$rx=json_encode($rq);echo $rx;
         }
        else { $rq[0]=['ID' => '0'];}}
    else { $rq[0]=['ID' => '0'];}    
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
$search_id=id_name($name);$id=$search_id[0]['ID'];
if ($id!="0") {$n=$search_id[0]['nb'];$i=0;while($i<$n){$search=$search_id[$i];echo "----->".$n."  ".$i;
    $id=$search['ID'];$idm=$search['idm'];$json=$search['json'];$champ=$search['champ'];$obj = json_decode($message);
    if (isset($obj->state) && $obj->state=="offline"){$ob=$obj->state;$msg='{ "id" : "'.$id.'", "objet" : "'.$name.'", "state" : "'.$ob.'" }';maj($id,$ob);}
    if (isset($obj->$json)) {$ob=$obj->$json;$msg='{ "id" : "'.$id.'", "objet" : "'.$name.'","state" : "'.$ob.'", "champ1" : "'.$champ.'", "champ2" : "'.$json.'", "idm" : "'.$idm.'"}';
       // echo '------------'.$msg;
     $mqtt->publish('z1m', $msg, 0,false);$id="0";$str=[];
    echo "envoi msg:".$msg; 
} $i++;}}} );
    $mqtt->loop();
    $mqtt->disconnect();
}
catch (\Throwable $e) {
    echo 'An exception occured: ' . $e->getMessage() . PHP_EOL;
}





