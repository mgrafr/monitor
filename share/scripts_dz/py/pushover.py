#!/bin/python3
import requests,sys
x= str(sys.argv[1])
r = requests.post("https://api.pushover.net/1/messages.json", data = {
"token": "asa28r7g15o8o28mgvufyc7ny4rxka",
"user": "uoj2ks6quy86rpn51bmuv6ageau6ji",
"message": x
})
print(r.text) 