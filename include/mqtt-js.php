<?php require_once('admin/config.php');
$domaine=$_SESSION["domaine"];
if ($domaine==URLMONITOR) {$lien_mqtt=MQTT_URL.':'.MQTT_PORTS["wss"];$w='wss://';}
if ($domaine==IPMONITOR) {$lien_mqtt=MQTT_IP.':'.MQTT_PORTS["ws"];$w='ws://';}
?>

<script>
     const clientId = 'mqttjs_' + Math.random().toString(16).substring(2, 8)
    const connectUrl = '<?php echo $w.$lien_mqtt;?>'

    const options = {
      keepalive: 60,
      clientId: clientId,
      clean: true,
      connectTimeout: 30 * 1000,
      
      username: '<?php echo MQTT_USER;?>',
      password: '<?php echo MQTT_PASS;?>',
      reconnectPeriod: 1000,
      <?php
      if ($domaine==URLMONITOR) {echo "key: 'certs/client-key.pem',
      cert: 'certs/client.pem',";} ?>
    }
    const topic = 'z1m/#'
    const payload = ""
    const qos = 0
    var topic1="z1m"
    var state=""
    console.log('connecting mqtt client')
    const client = mqtt.connect(connectUrl, options)

    client.on('error', (err) => {
      console.log('Connection error: ', err)
      client.end()
    })

    client.on('reconnect', () => {
      console.log('Reconnecting...')
    })

    client.on('connect', () => {
      console.log('Client connected:' + clientId)

    client.subscribe(topic, { qos }, (error) => {
        if (error) {S
          console.log('Subscribe error:', error)
          return
        }
        console.log(`Subscribe to topic ${topic}`);
             })

      // publish message
      client.publish(topic1, payload, { qos }, (error) => {
        if (error) {
          console.error(error)
        }
      })
    })
    client.on('message', (topic, payload) => {if (payload!=""){
      console.log('Received Message: ' + payload.toString() + '\nOn topic: ' + topic);
      var emsg=document.getElementById('msg_zb').innerText;
      document.getElementById('msg_zb1').innerText = emsg;
      document.getElementById('msg_zb').innerText=payload;

     msg=JSON.parse(payload);var idm=msg.idm;var state=msg.state;var champ=msg.champ1;
     var ind=4;if (champ=="Data") {ind=2;}
     if (champ=="temperature" || champ=="humidity" || champ=="soil_moisture") {ind=3;}
      maj_mqtt(idm,state,ind,0,champ) ;// fonction ds footer.php
    }
  })
    
</script>