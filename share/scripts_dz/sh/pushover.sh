#!/bin/bash
TITLE="Alerte"
APP_TOKEN="axxxxxxxxxxxxxxxxxxxxxa"
USER_TOKEN="uxxxxxxxxxxxxxxxxxxi"
MESSAGE=$1 
echo $1
curl -s \
  --form-string  "token=$APP_TOKEN" \
  --form-string  "user=$USER_TOKEN" \
  --form-string  "title=$TITLE" \
  --form-string  "message=$MESSAGE" \
   https://api.pushover.net/1/messages.json
