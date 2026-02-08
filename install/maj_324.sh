#!/usr/bin/bash
rm update.sh
rm maj*
cd /www/monitor
mkdir -p tmp
cd tmp
wget https://github.com/mgrafr/monitor/archive/refs/tags/monitor-v4.1.1.tar.gz
tar -xzf monitor-v4.1.1.tar.gz
cd monitor-monitor-v4.1.1
sed -i "s/.DOMAINE\" ));/DOMAINE\",/g" admin/config.php
sed -i "s/iobweb.DOMAINE",/iobweb.DOMAINE", 2 => \"false\"));/g" admin/config.php
result()(mysql --user="root" --password="Idem4546" --database="monitor" --execute= -e "SHOW COLUMNS FROM dispositifs LIKE 'materiel';") 
res=${result} 
if [[ ${res:0:5} != 'Field' ]] 
then 
mysql --user="root" --password="Idem4546" --database="monitor" --execute= -e "ALTER TABLE dispositifs CHANGE materiel param text;"
fi
cp -u ajax.php /www/monitor/ajax.php
cp -u fonctions.php /www/monitor/fonctions.php
cp -u index_loc.php /www/monitor/index_loc.php
echo "Entrer le nom du fichier php de l'image du plan si elle n'est pas installée dans custom/php:"
echo "ou cliquer sur enter"
read nom
echo "FICHIER, $nom!"
if  "$nom" != ""  then
mv /www/monitor/include/accueil.php /www/monitor/custom/php/accueil.php
mv /www/monitor/include/$nom /www/monitor/custom/php/$nom
fi
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
clientmqtt=$(whiptail --title "installer le client php-mqtt ?" --radiolist \
"voulez vous installer php-mqtt/client ?\n necessaire pour utiliser zigbee2mqtt directement\n
depuis monitor(sans utiliser Dz, Ha ou Iobroker)" 15 60 4 \
"non" "par defaut " ON \
"oui" "voir la doc" OFF 3>&1 1>&2 2>&3)
if [ $exitstatus = 0 ]; then
   echo "Vous avez choisi  : $clientmqtt"
else
echo "Vous avez annulé  "
fi
if [ "$clientmqtt" = "oui" ]
then
echo "installation de composer & php-mqtt/client$"
cd /www/monitor
apt install composer
composer require php-mqtt/client
if [ ! -d "vendor/php-mqtt" ]; then
mkdir ws_z2m
cp -u ws_z2m/* /www/monitor/ws_z2m/
fi
fi
