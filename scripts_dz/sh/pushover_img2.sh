#!/bin/bash

# envoi image portier à Pushover , version Capture par Domoticz
jour=$(date +%H:%M:%S)
wget http://LOGIN:PASSWORD@192.168.1.76:8086/camsnapshot.jpg?idx=1 -O 
/opt/domoticz/userdata/camsnapshot.jpg
TITLE="image portier"
APP_TOKEN="xxxxxxxxxxxxxxxxxxxxxxxxxxx"
USER_TOKEN="yyyyyyyyyyyyyyyyyyyyyyyy"
MESSAGE="on sonne au portail" 
curl -s -F "token=$APP_TOKEN" \
   -F "user=$USER_TOKEN" \
   -F "title=$TITLE" \
   -F "message=$MESSAGE" \
   -F "attachment=@userdata/camsnapshot.jpg" \
   https://api.pushover.net/1/messages.json
