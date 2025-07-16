
#!/usr/bin/env python3.7
# -*- coding: utf-8 -*-

import time,requests,serial
from periphery import Serial
ip_domoticz="http://192.168.1.76:8086/"
se_domoticz="http://<LOGIN>:<PASS>@localhost:8086/"
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
    print(x[0])
    tel=x[1]
    print(tel)
    message = ('AT+SMSSEND='+tel+','+x[0]+'\r\n').encode('utf-8')
    print(message)
    # passage en HSPEED du MODEM suite travaux et chgt sim de SFR
    #phone.write(b'+++')
    #time.sleep(2)
    #phone.write(b'AT+VER\r\n')
    #time.sleep(1)
    phone.write(message)
    #phone.write(b'AT+EXAT');
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
phone = serial.Serial(port="/dev/ttyAMA1",baudrate=115200,timeout=2)
serie = Serial("/dev/ttyAMA2", 115200)
phone.close() #Cloture du port pour le cas ou il serait déjà ouvert ailleurs
phone.open() #Ouverture du port
phone.write(b'AT+EXAT');
time.sleep(1);

while True:
    line = phone.readline() # copie d’une ligne entiere jusqu’a \n dans “line”
    print(line)
    buf_dz = serie.read(128, 0.5)
    #print(buf_dz)
    id="none"
    value="none"
    name="none"
    if buf_dz:
        buf_dz = convert_to_string(buf_dz)
        not_reception(buf_dz)
    if line:
        line = convert_to_string(line)
        #print(line) #pour essai
        params=line.split('#')
        if params[0] and (params[0]=='smsip' or params[0]=='smsse' or params[0]$
            if params[0]=="smsip":
                domoticz=ip_domoticz
                ip_se=1
            if params[0]=="smsse":
                domoticz=se_domoticz
                ip_se=2
            if params[0]=="Alon":
                domoticz=ip_domoticz
                ip_se=1
                params[1]= '41'
                params[2]='switch'
                params[3]='On'
            if params[0]=="Aloff":
                domoticz=ip_domoticz
                ip_se=1
                params[1]= '41'
                params[2]='switch'
                params[3]='Off'
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
                    url = domoticz+'json.htm?type=command&param=switchlight&idx$
                else :
                    url = domoticz+'json.htm?type=command&param=updateuservaria$
            else :
                ip_se=""

            ip_serie(ip_se,url)
