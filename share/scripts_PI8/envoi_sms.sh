#!/usr/bin/bash

### Pour SMS Free
CURL=/usr/bin/curl
URL=https://smsapi.free-mobile.fr/sendmsg
PASS=xxxxxxxxxx
USER=wwwwwwwwww
# notification exemple texte_notification num_tel1 num_tel2 num_tel3 ......
not="$*"
# envoi SMS Free
#$CURL -k -X POST "https://smsapi.free-mobile.fr/sendmsg?user=$USER&pass=$PASS&$
### envoi par modem GSM
#modem Ebyte
#python3 /home/michel/envoi_sms.py $not >> /home/michel/erreur 2>&1
#modem PUSR
python3 /home/michel/send_sms.py $not >> /home/michel/erreur 2>&1
