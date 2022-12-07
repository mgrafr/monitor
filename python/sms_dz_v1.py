#!/usr/bin/env python3.7 -*- coding: utf-8 -*-

import requests , time ,json, os, chardet
from periphery import Serial

if os.path.exists("/dev/ttyUSB0"):
    ser = Serial("/dev/ttyUSB0", 115200)
else:
    ser = Serial("/dev/ttyUSB1", 115200)

url_gsm = 'http://127.0.0.1:8082/json.htm?type=command&param=getuservariable&idx=23'
url_dz = 'http://127.0.0.1:8082/json.htm?type=command&param=updateuservariable&idx=23&vname=alarme_gsm&vtype=2&vvalue=0'
ser.flush()
#effacer le tampon série pour supprimer le courrier indésirable et le bruit
while True:
        response = requests.get(url_gsm)
        result= json.loads(response.content.decode(chardet.detect(response.content)["encoding"]))
        statut = result['status']
        if(statut=="OK"):
            value= result['result'][0]['Value']
            print(value)
        if value != "0":
            print(value)
            bmessage = value.encode('utf-8')
            ser.write(bmessage)
            response = requests.get(url_dz)
        url = ser.read(128, 0.5).decode(errors='ignore')
        if url:
           response = requests.get(url)
           contenu = response.json()
           message = contenu['title']
           print(message)
           bmessage = message.encode('utf-8')
           ser.write(bmessage)
        time.sleep(4)

