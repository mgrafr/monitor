#!/bin/bash
TITLE="Alerte"
APP_TOKEN="asa28r7g15o8o28mgvufyc7ny4rxka"
USER_TOKEN="uoj2ks6quy86rpn51bmuv6ageau6ji"
MESSAGE=$1 
echo $1
curl -s -F "token=$APP_TOKEN" \
   -F "user=$USER_TOKEN" \
   -F "title=$TITLE" \
   -F "message=$MESSAGE" \
   https://api.pushover.net/1/messages.json
