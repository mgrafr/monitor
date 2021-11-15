#!/bin/bash
jour=$(date +%H:%M:%S)
wget http://admin:Idem4546@192.168.1.110/cgi-bin/snapshot.cgi?0.jpg 
mv snapshot.cgi?0.jpg image.jpg
TITLE="image portier"
APP_TOKEN="asa28r7g15o8o28mgvufyc7ny4rxka"
USER_TOKEN="uoj2ks6quy86rpn51bmuv6ageau6ji"
MESSAGE="on sonne au portail" 
curl -s -F "token=$APP_TOKEN" \
   -F "user=$USER_TOKEN" \
   -F "title=$TITLE" \
   -F "message=$MESSAGE" \
   -F "attachment=@image.jpg" \
   https://api.pushover.net/1/messages.json
mv image.jpg /home/michel/image.jpg?$jour