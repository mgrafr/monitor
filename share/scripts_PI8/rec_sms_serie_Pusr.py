#!/usr/bin/env python3.7
# -*- coding: utf-8 -*-

import time,requests,serial
from periphery import Serial
ip_domoticz="http://192.168.1.192:8087/"
se_domoticz="http://michel:xxxxxxxxx@localhost:8087/"
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
    x = content.split(" ", 1)
    print("x:"+content)
    message = (x[0]+'\r\n').encode('utf-8')
    print(message)
    time.sleep(2)
    phone.write(message)
    time.sleep(1);

def ip_serie(ip_se,url):
    print(url)
    if ip_se == 1:
        response = requests.get(url)
        contenu = response.json()
        if contenu['status']=="OK":
            content=contenu['title']
        else :
            content="erreur"
        print(content)
        not_reception(content)
    elif ip_se == 2:
        print("Connexion série")
        url=url.encode('utf-8')
        serie.write(url)
        time.sleep(1)
    else:
        print("erreur")
        not_reception("mauvais formatage")
phone = serial.Serial(port="/dev/ttyAMA0",baudrate=115200,timeout=2)
serie = Serial("/dev/ttyAMA4", 115200)
phone.close() #Cloture du port pour le cas ou il serait déjà ouvert ailleurs
phone.open() #Ouverture du port
phone.write(b'+++a')
phone.write(b'AT+WKMOD=SMS')
phone.write(b'AT+S')
time.sleep(1);

while True:
    line = phone.readline() # copie d’une ligne entiere jusqu’a \n dans “line”
    print(line)
    buf_dz = serie.read(128, 0.5)
    print(buf_dz)
    id="none"
    value="none"
    name="none"
    if buf_dz:
        buf_dz = convert_to_string(buf_dz)
        not_reception(buf_dz)
    if line:
        line = convert_to_string(line)
        print("L="+line) #pour essai
        params=["0","0","0"]
        params=line.split('#')
        if params[0] and (params[0]=='smsip' or params[0]=='smsse' or params[0]=='Alon' or params[0]=='Aloff'):
            if params[0]=="smsip":
                domoticz=ip_domoticz
                ip_se=1
            if params[0]=="smsse":
                domoticz=se_domoticz
                ip_se=2
            if params[0]=="Alon":
                domoticz=ip_domoticz
                ip_se=1
                params=["Alon","41","switch","On"]
            if params[0]=="Aloff":
                domoticz=ip_domoticz
                ip_se=1
                params=["Aloff","41","switch","Off"]
            if params[1]:
                id = params[1]
                print('Id:'+id)
            if params[2]:
                name = params[2]
                print('name:'+name)
            if params[3]:
                value = params[3]
                print('valeur:'+value)
            if (id!="none" and name!="none" and value!="none"):
                if name == 'switch':
                    url = domoticz+'json.htm?type=command&param=switchlight&idx='+id+'&switchcmd='+value
                else :
                    url = domoticz+'json.htm?type=command&param=updateuservariable&vname='+name+'&vtype=2&vvalue='+value 
            else :
                ip_se=""

            ip_serie(ip_se,url)
