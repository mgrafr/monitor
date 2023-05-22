#!/usr/bin/bash

echo "Entrer une commande : ON ou OFF "
read COMMANDE
if [ "$COMMANDE" = "ON" ] ; then cmd='\xA0\x01\x01\xA2'
fi
if [ "$COMMANDE" = "OFF" ] ; then cmd='\xA0\x01\x01\xA2';
fi
serdev="/dev/ttyUSB0"

echo 'open door'
/bin/bash -c "echo -n -e '$cmd' > $serdev"
