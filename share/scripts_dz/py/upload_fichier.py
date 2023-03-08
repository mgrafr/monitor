#!/usr/bin/env python3
# -*- coding: utf-8 -*-
import requests, sys
x= str(sys.argv[1])
rep="/opt/domoticz/www/modules_lua/"
req = requests.get('http://192.168.1.9/monitor/admin/dz/temp.lua')
with open(rep+x, "wb") as fp:
    fp.write(req.content)
