#!/usr/bin/bash

echo "-----------------------------------------------------------------"
echo "-----------Mise à jour vers la version 3.0.2  -------------------"
echo "-----------------------------------------------------------------"
wget https://raw.githubusercontent.com/mgrafr/monitor/main/include/footer.php
mv footer.php include/footer.php
rm fonctions.php
wget https://raw.githubusercontent.com/mgrafr/monitor/main/fonctions.php
wget https://raw.githubusercontent.com/mgrafr/monitor/main/css/mes_css.css
mv mes_css.css css/mes_css.css
wget https://raw.githubusercontent.com/mgrafr/monitor/main/include/ajout_dev_bd.php
mv ajout_dev_bd.php include/ajout_dev_bd.php
wget https://raw.githubusercontent.com/mgrafr/monitor/main/include/alarmes_svg.php
mv alarmes_svg.php include/alarmes_svg.php
wget https://raw.githubusercontent.com/mgrafr/monitor/main/include/accueil.php
mv accueil.php include/accueil.php
wget https://raw.githubusercontent.com/mgrafr/monitor/main/images/vanne.svg
mv vanne.svg images/vanne.svg
wget https://raw.githubusercontent.com/mgrafr/monitor/main/include/vanne_eau_svg.php
mv vanne_eau_svg.php include/vanne_eau_svg.php
wget https://raw.githubusercontent.com/mgrafr/monitor/main/include/mur_inter.php
mv mur_inter.php include/mur_inter.php
wget https://raw.githubusercontent.com/mgrafr/monitor/main/include/interieur.php
mv interieur.php include/interieur.php
sed -i "s/Pour Domoticz/modules complementaires/g" /var/www/html/monitor/admin/config.php
sed -i "s/URLDOMOTIC.'modules_lua\/string_modect.lua/'admin\/string_modect.json/g" /var/www/html/monitor/admin/config.php
sed -i "s/URLDOMOTIC.'modules_lua\/connect.lua/'admin\/connect\/connect.py/g" /var/www/html/monitor/admin/config.php
sed -i "s/DZCONFIG/TMPCONFIG/g" /var/www/html/monitor/admin/config.php
sed -i "s/dz\/temp.lua/connect/\/g" /var/www/html/monitor/admin/config.php
sed -i "s/DZ_PATH/SSH_MONITOR_PATH/g" /var/www/html/monitor/admin/config.php
sed -i "s/opt\/domoticz\/config/var\/www\/html\/monitor\/admin\/connect/g" /var/www/html/monitor/admin/config.php
wget https://raw.githubusercontent.com/mgrafr/monitor/main/include/alarmes.php
mv alarmes.php include/alarmes.php 
wget https://raw.githubusercontent.com/mgrafr/monitor/main/include/modes_emploi.php
mv modes_emploi.php include/modes_emploi.php 
wget https://raw.githubusercontent.com/mgrafr/monitor/main/include/cam_dahua.php
mv cam_dahua.php include/cam_dahua.php 
rm -R admin/dz
mkdir admin/connect
wget https://raw.githubusercontent.com/mgrafr/monitor/main/admin/connect/connect.js
mv connect.js admin/connect/connect.js 
wget https://raw.githubusercontent.com/mgrafr/monitor/main/admin/connect/connect.lua
mv connect.lua admin/connect/connect.lua
wget https://raw.githubusercontent.com/mgrafr/monitor/main/admin/connect/connect.py
mv connect.py admin/connect/connect.py 
wget https://raw.githubusercontent.com/mgrafr/monitor/main/include/admin.php
mv admin.php include/admin.php 
#

rm .version
wget https://raw.githubusercontent.com/mgrafr/monitor/main/.version
echo "-----------------------------------------------------------------------"
echo "-----------Mises à jour vers la version 3.0.2   terminées--------------"
echo "-----------------------------------------------------------------------"