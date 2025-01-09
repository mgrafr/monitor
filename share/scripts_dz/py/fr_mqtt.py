#!/usr/bin/env python3.9
#-*- coding: utf-8 -*-
import sys
from connect import ip_mqtt
import paho.mqtt.client as mqtt #import the client1
broker_address=ip_mqtt
topic = str(sys.argv[1])
payload = str(sys.argv[2])
#broker_address="iot.eclipse.org" #use external broker
client = mqtt.Client("P1") #create new instance
client.username_pw_set(username='<LOGIN>',password='<MOT_PASSE>')
client.connect(broker_address) #connect to broker
client.publish(topic,payload) #publish
