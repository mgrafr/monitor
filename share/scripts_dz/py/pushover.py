#!/bin/python3
import requests,sys
x= str(sys.argv[1])
r = requests.post("https://api.pushover.net/1/messages.json", data = {
"token": "xxxxxxxxxxxxxxxxxxx",
"user": "xxxxxxxxxxxxxxxxxxxxx",
"message": x
})
print(r.text) 
