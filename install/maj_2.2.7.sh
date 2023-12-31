#!/usr/bin/bash
wget https://raw.githubusercontent.com/mgrafr/monitor/main/css/mes_css.css
mv mes_css.css css/mes_css.css
wget https://raw.githubusercontent.com/mgrafr/monitor/main/install/update.bash
mv update.bash install/update.bash
chown www-data:www-data /var/www/html/monitor/admin/config.php
echo "-----------------------------------------------------------------"
echo "-----------Mise à jour vers la version 2.2.7.1-------------------"
echo "-----------------------------------------------------------------"
