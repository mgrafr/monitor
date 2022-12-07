#!/usr/bin/env python3.7
# -*- coding: utf-8 -*-

import paho.mqtt.client as mqtt
import json
import sys
# Define Variables
topic= str(sys.argv[1])
etat= str(sys.argv[2]) 
valeur= str(sys.argv[3]) 
MQTT_HOST = "192.168.1.42"
MQTT_PORT = 1883
MQTT_KEEPALIVE_INTERVAL = 45
MQTT_TOPIC = topic

MQTT_MSG=json.dumps({etat: valeur});
# Define on_publish event function
def on_publish(client, userdata, mid):
    print ("Message Published...")

def on_connect(client, userdata, flags, rc):
    client.subscribe(MQTT_TOPIC)
    client.publish(MQTT_TOPIC, MQTT_MSG)

def on_message(client, userdata, msg):
    print(msg.topic)
    print(msg.payload) # <- do you mean this payload = {...} ?
    payload = json.loads(msg.payload) # you can use json.loads to convert string to json
    #print(payload['state_l2']) # then you can check the value
    client.disconnect() # Got message then disconnect

# Initiate MQTT Client
mqttc = mqtt.Client()

# Register publish callback function
mqttc.on_publish = on_publish
mqttc.on_connect = on_connect
mqttc.on_message = on_message

# Connect with MQTT Broker
mqttc.connect(MQTT_HOST, MQTT_PORT, MQTT_KEEPALIVE_INTERVAL)

# Loop forever
mqttc.loop_forever()