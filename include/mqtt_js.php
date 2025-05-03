<?php

require ($_SESSION["config"]);
?>
<script>
let pahoConfig = {
         hostname: '<?php echo MQTT_IP ; ?>',  //The hostname is the url, under which your FROST-Server resides.
         port: '<?php echo MQTT_PORT ; ?>',           //The port number is the WebSocket-Port,
                                 // not (!) the MQTT-Port. This is a Paho characteristic.
         clientId: "monitor"    //Should be unique for every of your client connections.
 }

 client = new Paho.MQTT.Client(pahoConfig.hostname, Number(pahoConfig.port),pahoConfig.clientId);
 client.onConnectionLost = onConnectionLost;
 client.onMessageArrived = onMessageArrived;
 // Connect the client, with a Username and Password
 client.connect({
	onSuccess: onConnect, 
	userName : '<?php echo MQTT_USER ; ?>',
	password : '<?php echo MQTT_PASS ; ?>'
});
// Appelé lorsque la connexion est établie
// Connectez le client, en fournissant un rappel onConnect
function onConnect() {
  // Once a connection has been made, make a subscription and send a message.
  console.log("Connected with Server");
  client.subscribe("ioBroker/#");
 // message = new Paho.MQTT.Message("Hello");
  //message.destinationName = "ioBroker";
  //client.send(message);
 }
 // called when the client loses its connection
 function onConnectionLost(responseObject) {
  if (responseObject.errorCode !== 0) {
    console.log("onConnectionLost:"+responseObject.errorMessage);
  }
 }
 // called when a message arrives
 function onMessageArrived(message) {
  console.log("onMessageArrived:"+(message.topic,message.payloadString));
  let j = JSON.parse(message.payloadString);
  handleMessage(j);
  }
 
function handleMessage(message) {
     if (message != null && message != undefined) {
            console.log(message)
     }
 }
</script>	
