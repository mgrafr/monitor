#!/usr/bin/env python3.8
# -*- coding: utf-8 -*-

import time,serial,requests
from connect import ip_domoticz, port_domoticz
# voir la doc pour connect.py
ip_domoticz=ip_domoticz+":"+port_domoticz+"/"
se_domoticz="http:localhost:"+port_domoticz+"/"
def convert_to_string(buf):
    try:
        tt =  buf.decode('utf-8').strip()
        return tt
    except UnicodeError:
        tmp = bytearray(buf)
        for i in range(len(tmp)):
            if tmp[i]>127:
                tmp[i] = ord('?')
        return bytes(tmp).decode('utf-8').strip()

def not_reception(content):
    message = ('AT+SMSSEND=06xxxxxxxx,'+content+'\r\n').encode('utf-8')
    phone.write(b'+++')
    time.sleep(2)
    phone.write(b'AT+VER\r\n')
    time.sleep(1)
    phone.write(message)
    phone.write(b'AT+EXAT');
    time.sleep(1);

def ip_serie(ip_se):
    if ip_se == 1:
        response = requests.get(url)
        contenu = response.json()
        if contenu['status']=="OK":
            content=contenu['title']
        else :
            content="erreur"
        #print(content)
        not_reception(content)
    elif ip_se == 2:
        print("Connexion série non opérationnelle")
    else:
        print("erreur")

phone = serial.Serial(port="/dev/ttyAMA1",baudrate=115200,timeout=2)

phone.close() #Cloture du port pour le cas ou il serait déjà ouvert ailleurs
phone.open() #Ouverture du port
phone.write(b'AT+EXAT');
time.sleep(1);
while True:
    line = phone.readline() # copie d’une ligne entiere jusqu’a \n dans “line”
    #print(line)
    id="none"
    value="none"
    name="none"
    if line:
        line = convert_to_string(line)
        #print(line) #pour essai
        params=line.split('#')
        if params[0] and (params[0]=='smsip' or params[0]=='smsse'):
            if params[0]=="smsip":
                domoticz=ip_domoticz
                ip_se=1
            if params[0]=="smsse":
                domoticz=se_domoticz
                ip_se=2
            if params[1]:
                id = params[1]
            if params[1]:
                id = params[1]
                #print('Id:'+id)
            if params[2]:
                name = params[2]
                #print('name:'+name)
            if params[3]:
                value = params[3]
                #print('valeur:'+value)
            if (id!="none" and name!="none" and value!="none"):
                if name == 'switch':
                    url = domoticz+'json.htm?type=command&param=switchlight&idx='+id+'&switchcmd='+value
                else :
                    url = domoticz+'json.htm?type=command&param=updateuservariable&idx='+id+'&vname='+name+'&vtype=2&vvalue='+value           
			else :
                ip_se=""

            ip_serie(ip_se)				
