#!/bin/bash
jour=$(date +%H:%M:%S)
wget http://admin:a1234567@192.168.1.111/cgi-bin/snapshot.cgi?0.jpg 
mv snapshot.cgi?0.jpg image.jpg
TITLE="image portier"
APP_TOKEN="xxxxxxxxtokenxxxxx"
USER_TOKEN="xxxxxxuserxxxxxxxxxxxx"
MESSAGE="on sonne au portail" 
curl -s -F "token=$APP_TOKEN" \
   -F "user=$USER_TOKEN" \
   -F "title=$TITLE" \
   -F "message=$MESSAGE" \
   -F "attachment=@image.jpg" \
   https://api.pushover.net/1/messages.json
mv image.jpg /home/michel/image.jpg?$jour