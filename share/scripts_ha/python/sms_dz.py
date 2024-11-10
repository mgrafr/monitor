#!/usr/bin/env python3.9 -*- coding: utf-8 -*-

import requests , time ,json, os, chardet, shutil
from periphery import Serial
import importlib
import aldz as b
import connect as num

ser = Serial("/dev/ttyUSB0",115200)

#ser = Serial("/dev/serial/by-id/usb-Silicon_Labs_CP2102_USB_to_UART_Bridge_Controller_0001-if00-port0", 115200)
if num.tel:
    num=num.tel
    #print(num)
else:
    num=""

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
    src=r'/var/lib/docker/volumes/hass_config/_data/python_script/aldz.bak.py'
    des=r'/var/lib/docker/volumes/hass_config/_data/python_script/aldz.py'
    shutil.copy(src, des)

print('start')
#url_gsm = 'http://127.0.0.1:8082/json.htm?type=command&param=getuservariable&idx=23'
#effacer le tampon série pour supprimer le courrier indésirable et le bruit
# url fournie par pi connecté au modem
ser.flush()
while True:
        #print('lect_buff')
        importlib.reload(b)
        message=b.x
        print(message)
        if b.priority:
            urgence=b.priority
            if urgence==0 or urgence > len(num):
                urgence=len(num)
             
        else:
            urgence="1"
        print(message)
        n=0
        if message != "0":
            print(urgence)
            while n < int(urgence):
                if num[n] and num[n]!="":
                    sms=message+" "+num[n]
                    print(num[n])
                    print(sms)
                    envoi_sms(sms)
                    n=n+1
                    time.sleep(5)
        raz_dz()
        #url = ser.read(128, 0.5).decode(errors='ignore')
        #print("read %d bytes: _%s_" % (len(url), url))
        #if url:
        #    print(url)
           # com_dz(url)
        time.sleep(10)


