import paho.mqtt.client as mqtt
import json
import sys
from connect import ip_mqtt

@service
def mqtt_publish(topic=None, idx=None, state=None):
    log.info(f"mqtt: got topic {topic} idx {idx} state {state}")

    etat= idx 
    valeur= state 
    MQTT_HOST = ip_mqtt
    MQTT_PORT = 9001
    MQTT_KEEPALIVE_INTERVAL = 45
    MQTT_TOPIC = topic
    MQTT_MSG=json.dumps({'idx': etat,'state': valeur});
    
	# Initiate MQTT Client
    mqttc = mqtt.Client(transport="websockets")
    mqttc.connect(MQTT_HOST, MQTT_PORT, MQTT_KEEPALIVE_INTERVAL)
    mqttc.publish(MQTT_TOPIC, MQTT_MSG)
    mqttc.disconnect()