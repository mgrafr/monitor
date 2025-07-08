#!/usr/bin/env python3
# -*- coding: utf-8 -*-
import requests, sys
from connect import ip_monitor
x= str(sys.argv[1])
y = x.split(".")
z=y[1]
z1=y[0]
ip= ip_monitor
rep="/opt/domoticz/"
if z=="lua" :
    rep="/opt/domoticz/www/modules_lua/"
    addr="http://"+ip+"/monitor/admin/connect/"+z1+"."+z
if z=="json" :
    rep="/opt/domoticz/www/modules_lua/" 
    addr="http://"+ip+"/monitor/admin/"+z1+"."+z
if z=="py" :
    rep="/opt/domoticz/scripts/python/"
    addr="http://"+ip+"/monitor/admin/connect/"+z1+"."+z
req = requests.get(addr)
with open(rep+x, "wb") as fp:
    fp.write(req.content)
