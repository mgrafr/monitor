#!/usr/bin/env python3.9 -*- coding: utf-8 -*-

import requests , time ,json, os, chardet, shutil
from periphery import Serial 
import importlib
import aldz as b

 
ser = Serial("/dev/ttyAMA0", 115200)

#ser = Serial("/dev/serial/by-id/usb-Silicon_Labs_CP2102_USB_to_UART_Bridge_Controller_0001-if00-port0", 115200)

def envoi_sms(message):
    bmessage = message.encode('utf-8')
    ser.write(bmessage) 

def com_dz(url):
    response = requests.get(url)
    if response.status_code == 200:
        contenu = response.json()
        message = contenu['title']
        envoi_sms(message)
    else:
        print('URL absente')
        envoi_sms('url_absente') 
def raz_dz():
    src=r'/opt/domoticz/config/scripts/python/aldz.bak.py'
    des=r'/opt/domoticz/config/scripts/python/aldz.py'
    shutil.copy(src, des)

print('start')
#url_gsm = 'http://127.0.0.1:8082/json.htm?type=command&param=getuservariable&idx=23'
#effacer le tampon série pour supprimer le courrier indésirable et le bruit
ser.flush()
while True:
        b = importlib.reload(b)
        message=b.x
        print(message)
        if message != "0" :
            envoi_sms(message)
            raz_dz()
        url = ser.read(128, 0.5).decode(errors='ignore')
        if url:
            print(url)
            com_dz(url)
        time.sleep(10)

