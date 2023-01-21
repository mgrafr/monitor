#!/bin/bash
TITLE="Alerte"
APP_TOKEN="xxxxxxxtokenxxxxxxxxxxxxxxx"
USER_TOKEN="xxxxxxxxxxxuserxxxxxxxxxxxxxx"
MESSAGE=$1 
echo $1
curl -s -F "token=$APP_TOKEN" \
   -F "user=$USER_TOKEN" \
   -F "title=$TITLE" \
   -F "message=$MESSAGE" \
   https://api.pushover.net/1/messages.json
