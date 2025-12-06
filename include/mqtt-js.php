<?php
require ($_SESSION["config"]);
echo "
<script>
function mqtt_pub(msg,topic) {
  console.log('mqtt_pub');
    let pahoConfig = {
         hostname: '".MQTT_IP."', 
         port: '".MQTT_PORT."',
         clientId: 'monitor'   
    }
  client = new Paho.MQTT.Client(pahoConfig.hostname, Number(pahoConfig.port),pahoConfig.clientId + parseInt(Math.random() * 100, 10));

  // set callback handlers
  client.onConnectionLost = onConnectionLost;
  client.onMessageArrived = onMessageArrived;

  // connect the client
  client.connect({ onSuccess: onConnect });
}

// called when the client connects
function onConnect() {
  // Once a connection has been made, make a subscription and send a message.
  console.log('onConnect');
  client.subscribe(topic);
  var message = new Paho.MQTT.Message(msg);
  message.destinationName = topic;
  client.send(message);
}

// called when the client loses its connection
function onConnectionLost(responseObject) {
  if (responseObject.errorCode !== 0) {
    console.log('onConnectionLost:' + responseObject.errorMessage);
  }
}

// called when a message arrives
function onMessageArrived(message) {
  console.log('onMessageArrived:'+ message.payloadString);
}
</script>"
?>