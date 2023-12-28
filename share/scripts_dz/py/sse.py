#!/usr/bin/env python3 -*- coding: utf-8 -*-
import requests
import sys
from connect import ip_sse,port_sse 
id= str(sys.argv[1])
etat= str(sys.argv[2]) 
url = 'http://'+ip_sse+':'+port_sse+'/fact'
payload = '{"id": "'+id+'", "state": "'+etat+'"}'
headers = {'content-type': 'application/json', 'Accept-Charset': 'UTF-8'}
r = requests.post(url, data=payload, headers=headers)
 
 
