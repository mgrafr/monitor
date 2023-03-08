#!/usr/bin/env python3.7
# -*- coding: utf-8 -*-
import sys
import urllib.request
import json    
total_arg = len(sys.argv)
if (total_arg>0) : arg= str(sys.argv[1])
data = '{"deviceid":"1000a0876c","data":{"switch":"'+arg+'"}}'
url = 'http://192.168.1.146:8081/zeroconf/switch'
req = urllib.request.Request(url)
dataasbytes = data.encode('utf-8')   # needs to be bytes
req.add_header('Content-Length', len(dataasbytes))
response = urllib.request.urlopen(req, dataasbytes)

  

