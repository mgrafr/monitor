#!/usr/bin/bash

### Pour SMS Free
CURL=/usr/bin/curl
URL=https://smsapi.free-mobile.fr/sendmsg
PASS=xxxxxxxxxxxx
USER=yyyyyyyyyyyyy
# notification
not="$*"
# envoi SMS Free
$CURL -k -X POST "https://smsapi.free-mobile.fr/sendmsg?user=$USER&pass=$PASS&msg=$not"
### envoi par modem GSM
python3 /home/michel/envoi_sms.py $not >> /home/michel/erreur 2>&1