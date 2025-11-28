<?php
require_once("/www/monitor/api/f_pour_api.php");
require('vendor/autoload.php');
require('/www/monitor/admin/config.php');
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
    printf("Received message on topic [%s]: %s\n", $topic, $message);
if ($topic == "monitor") {sms($message);}
$str=explode("/",$topic);$id=$str[1];
$obj = json_decode($message);
    if (isset($obj->state) && $obj->state!="online"){$ob=$obj->state;echo 'id='.$id.' state='.$ob."\n";maj($id,$ob);}
    if (isset($obj->contact)) {$ob=$obj->contact;echo 'id='.$id.' state='.$ob."\n";maj($id,$ob);}
    if (isset($obj->occupancy)) {$ob=$obj->occupancy;echo 'id='.$id.' state='.$ob."\n";maj($id,$ob);}
 
}, 0);
  //printf("msg $i send\n");
  sleep(1);
$mqtt->loop(true);
