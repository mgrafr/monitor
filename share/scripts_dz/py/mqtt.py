#!/usr/bin/python3.9
# -*- coding: utf-8 -*-

import  paho.mqtt.client as mqtt
import json
import sys
from connect import ip_mqtt
print (ip_mqtt)
# Define Variables
total_arg = len(sys.argv)
topic= str(sys.argv[1])
etat= str(sys.argv[2])
valeur= str(sys.argv[3])
MQTT_HOST = ip_mqtt
MQTT_PORT = 1883
MQTT_KEEPALIVE_INTERVAL = 45
MQTT_TOPIC = topic
print (topic)
MQTT_MSG=json.dumps({etat: valeur});
if total_arg >4 :
    etat1=str(sys.argv[4])
    valeur1=str(sys.argv[5])
    MQTT_MSG=json.dumps({etat: valeur,etat1: valeur1});
# Define on_publish event function
def on_publish(client,userdata,mid):   #create function for callback
    print("data published \n")
    pass
def on_disconnect(client, userdata, rc):
     print("client disconnected ok")
# Initiate MQTT Client
mqttc = mqtt.Client(clean_session=True)
mqttc.username_pw_set(username="michel",password="Idem4546")
# Register publish callback function
mqttc.on_publish = on_publish
#mqttc.on_connect = on_connect
mqttc.on_disconnect = on_disconnect

# Connect with MQTT Broker
mqttc.connect(MQTT_HOST, MQTT_PORT, MQTT_KEEPALIVE_INTERVAL)
mqttc.publish(MQTT_TOPIC, MQTT_MSG)
mqttc.disconnect()
# Loop forever
#mqttc.loop_forever()


