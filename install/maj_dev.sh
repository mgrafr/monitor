#!/usr/bin/bash

cd /www/monitor
mkdir -p tmp
cd tmp
git clone https://github.com/mgrafr/monitor.git
cd monitor
# maj 4.1.3
sed -i "s/: ws=9001 wss=9002 ou 9883/=9001   pour anciennes versions de Monitor***/" admin/config.php
sed -i "/pour anciennes versions de Monitor/a \define('MQTT_PORTS', array(\n'mqtt' => '1883', \n'ws' => '9001', \n'mqtts' => '8883',\n'wss' => '443'));" admin/config.php
sed -i "s/=> '1883',/=> '1883',\/\/ MQTT/" admin/config.php
sed -i "s/=> '9001',/=> '9001',\/\/ Websocket/" admin/config.php
sed -i "s/=> '8883',/=> '8883',\/\/ MQTTS/" admin/config.php
sed -i "s/=> '443'));/'443'));\/\/ WSS pour Letsencrypt laisser 443,/" admin/config.php
sed -i "/pour Letsencrypt laisser 443/a \ \/\/ COURTIER ET NGINX DOIVENT ECOUTER LE MEME PORT ex:9002" admin/config.php
# -----------------------------------
cp -u ajax.php /www/monitor/ajax.php
cp -u fonctions.php /www/monitor/fonctions.php
cp -u index_loc.php /www/monitor/index_loc.php
cp -u -R include/* /www/monitor/include/
cp -u css/* /www/monitor/css/
cp -u js/* /www/monitor/js/
cp -u api/* /www/monitor/api/
cp -u images/* /www/monitor/images/
cp -u -R install/* /www/monitor/install/
cp -u -R bd_sql/* /www/monitor/bd_sql/
cp -u -R share/* /www/monitor/share/
cp -u .version /www/monitor/.version
cd /www/monitor
rm -R tmp

