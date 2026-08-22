#!/usr/bin/env python3 -*- coding: utf-8 -*-

import time ,json, os, shutil
import importlib
import aldz as b
import connect as rpi5
import paramiko
# variables de connect.py
hostname = rpi5.rpi5[0]
port = 22
username = rpi5.rpi5[1]
password = rpi5.rpi5[2]
#
def envoi_sms(message):
    bmessage = message.encode('utf-8')
    client = paramiko.SSHClient()
    # ajouter automatiquement les clés d'hôtes inconnues au magasin d'hôtes connus
    client.set_missing_host_key_policy(paramiko.AutoAddPolicy())
    client.connect(hostname, port, username, password, timeout=5)
    # ssh_client.connect(serveur, nom, motpasse)
    stdin, stdout, stderr = client.exec_command('python3 /home/michel/send_sms.py '+message)
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
    src=r'/opt/domoticz/scripts/python/aldz.bak.py'
    des=r'/opt/domoticz/scripts/python/aldz.py'
    shutil.copy(src, des)
#
while True:
        b = importlib.reload(b)
        message=b.x
        if message != "0":
            sms=message
            print(sms)
            envoi_sms(sms)
            time.sleep(2)
        raz_dz()
        time.sleep(10)