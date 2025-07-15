#!/bin/bash
jour=$(date +%H:%M:%S)

wget --user <Login> --password <Pwd>  http://$1/camsnapshot.jpg?idx=1 -O /opt/domoticz/userdata/camsnapshot.jpg

TITLE="image portier"
APP_TOKEN="asxxxxxxxxxxxxxxxxxxxxxxxa"
USER_TOKEN="uyyyyyyyyyyyyyyyyyyyyyyyi"
MESSAGE="on sonne au portail" 
curl -s -F "token=$APP_TOKEN" \
   -F "user=$USER_TOKEN" \
   -F "title=$TITLE" \
   -F "message=$MESSAGE" \
   -F "attachment=@userdata/camsnapshot.jpg" \
   https://api.pushover.net/1/messages.json
