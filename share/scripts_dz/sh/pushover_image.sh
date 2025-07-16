#!/bin/bash
jour=$(date +%H:%M:%S)

wget --user michel --password xxxxxxxxxxxxxxxxx  http://$1/camsnapshot.jpg?idx=1 -O /opt/domoticz/camsnapshot.jpg

TITLE="image portier"
APP_TOKEN="asxxxxxxxxxxxxxxxxxxxxxxxxxxa"
USER_TOKEN="uoxxxxxxxxxxxxxxxxxxxxxxx6ji"
MESSAGE="on sonne au portail" 
curl -s \
  --form-string  "token=$APP_TOKEN" \
  --form-string  "user=$USER_TOKEN" \
  --form-string  "title=$TITLE" \
  --form-string  "message=$MESSAGE" \
  -F "attachment=@/opt/domoticz/camsnapshot.jpg" \
   https://api.pushover.net/1/messages.json
