#!/usr/bin/env python3
# -*- coding: utf-8 -*-
import requests, sys
x= str(sys.argv[1])
ip= str(sys.argv[2])
rep="/opt/domoticz/www/modules_lua/"
addr="http://"+ip+"/monitor/admin/dz/temp.lua"
req = requests.get(addr)
with open(rep+x, "wb") as fp:
    fp.write(req.content)
