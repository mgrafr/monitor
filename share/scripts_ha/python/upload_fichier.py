#!/usr/bin/env python3
# -*- coding: utf-8 -*-
import requests, sys
from connect import ip_monitor
x= str(sys.argv[1])
#ip= str(sys.argv[2])
ip=ip_monitor
def import_fichier(ip,z,rep):
    addr="http://"+ip+"/monitor/admin/connect/"+z
    print(addr)
    req = requests.get(addr)
    with open(rep+z, "wb") as fp:
        fp.write(req.content)      
rep="/config/python/"
z= x+".py"
import_fichier(ip,z,rep)
rep="/config/"
z= x+".yaml"
import_fichier(ip,z,rep)
rep="/config"
