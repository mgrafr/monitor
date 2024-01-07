#!/usr/bin/bash
echo "-----------------------------------------------------------------"
echo "-----------Mise à jour vers la version 2.2.7.5-------------------"
echo "-----------------------------------------------------------------"
wget https://raw.githubusercontent.com/mgrafr/monitor/main/css/mes_css.css
mv mes_css.css css/mes_css.css
chown www-data:www-data /var/www/html/monitor/admin/config.php
wget https://raw.githubusercontent.com/mgrafr/monitor/main/api/f_pour_api.php
mv f_pour_api.php api/f_pour_api.php
wget https://raw.githubusercontent.com/mgrafr/monitor/main/api/json.php
mv json.php api/json.php
sed -i '201d' /var//www/html/monitor/admin/config.php
echo "//DZ_PATH :ex dz docker /opt/domoticz/config/, ex autre dz /opt/domoticz, home/USER/domoticz" >> /www/admin/config.php
echo "define('DZ_PATH', '/opt/domoticz/config/');" >> /www/admin/config.php
echo "?>" >> /www/admin/config.php
rm fonctions.php
wget https://raw.githubusercontent.com/mgrafr/monitor/main/fonctions.php
rm include/footer.php
wget https://raw.githubusercontent.com/mgrafr/monitor/main/include/footer.php
wget https://raw.githubusercontent.com/mgrafr/monitor/main/include/serveur_sse.php
mv serveur_sse.php include/serveur_sse.php
sed -i "s/ pour SSE node/  pour SSE php \ndefine('SSE_SLEEP', 'php');\n\/\/pour SSE node/g" /var/www/html/monitor/admin/config.php
#
rm .version
wget https://raw.githubusercontent.com/mgrafr/monitor/main/.version
echo "-----------------------------------------------------------------------"
echo "-----------Mises à jour vers la version 2.2.7.5 terminées--------------"
echo "-----------------------------------------------------------------------"