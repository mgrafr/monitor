#!/usr/bin/bash
#sur le serveur monitor actuel
pip list --format=json > /var/www/monitor/admin/connect/mod.json
ufw status > /var/www/monitor/admin/connect/ufw.txt
xxx=$(hostname -I)
echo $xxx | cut -d ' ' -f 1 > /var/www/monitor/admin/connect/ip.txt
echo "pour letsencrypt remplacement port 80 par 81"
sed  -i "s/80/81/g" /etc/nginx/conf.d/monitor.conf
