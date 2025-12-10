<?php require_once('admin/config.php');?>
<script>
     const clientId = 'mqttjs_' + Math.random().toString(16).substring(2, 8)
    const connectUrl = 'ws://<?php echo MQTT_IP.":".MQTT_PORT;?>'

    const options = {
      keepalive: 60,
      clientId: clientId,
      clean: true,
      connectTimeout: 30 * 1000,
      
      username: '<?php echo MQTT_USER;?>',
      password: '<?php echo MQTT_PASS;?>',
      reconnectPeriod: 1000,
    }
    const topic = 'zigbee2mqtt'
    const payload = ''
    const qos = 0

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
        if (error) {
          console.log('Subscribe error:', error)
          return
        }
        console.log(`Subscribe to topic ${topic}`)
      })

      // publish message
      client.publish(topic, payload, { qos }, (error) => {
        if (error) {
          console.error(error)
        }
      })
    })

    client.on('message', (topic, payload) => {
      console.log(
        'Received Message: ' + payload.toString() + '\nOn topic: ' + topic
      )
    })
</script>