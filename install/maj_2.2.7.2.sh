#!/usr/bin/bash

echo "-----------------------------------------------------------------"
echo "-----------Mise à jour vers la version 2.2.7.4-------------------"
echo "-----------------------------------------------------------------"
sed -i '201d' /var//www/html/monitor/admin/config.php
echo "//DZ_PATH :ex dz docker /opt/domoticz/config/, ex autre dz /opt/domoticz, home/USER/domoticz" >> /www/admin/config.php
echo "define('DZ_PATH', '/opt/domoticz/config/');" >> /www/admin/config.php
echo "?>" >> /www/admin/config.php
rm fonctions.php
wget https://raw.githubusercontent.com/mgrafr/monitor/main/fonctions.php
rm include/footer.php
wget https://raw.githubusercontent.com/mgrafr/monitor/main/include/footer.php
rm include/footer.php
wget https://raw.githubusercontent.com/mgrafr/monitor/main/include/footer.php
#
rm .version
wget https://raw.githubusercontent.com/mgrafr/monitor/main/.version
wget https://raw.githubusercontent.com/mgrafr/monitor/main/install/update.bash
mv update.bash install/update.bash
echo "-----------------------------------------------------------------------"
echo "-----------Mises à jour vers la version 2.2.7.4 terminées--------------"
echo "-----------------------------------------------------------------------"