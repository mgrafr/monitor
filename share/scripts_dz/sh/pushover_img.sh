#!/bin/bash
jour=$(date +%H:%M:%S)
xxx=$(hostname -I)
ip4=$(echo $xxx | cut -d ' ' -f 1)
wget  http://$ip4:8086/camsnapshot.jpg?idx=1 -O /opt/domoticz/config/camsnapshot.jpg

TITLE="image portier"
APP_TOKEN="asa28r7g15o8o28mgvufyc7ny4rxka"
USER_TOKEN="uoj2ks6quy86rpn51bmuv6ageau6ji"
MESSAGE="on sonne au portail" 
curl -s -F "token=$APP_TOKEN" \
   -F "user=$USER_TOKEN" \
   -F "title=$TITLE" \
   -F "message=$MESSAGE" \
   -F "attachment=@userdata/camsnapshot.jpg" \
   https://api.pushover.net/1/messages.json
