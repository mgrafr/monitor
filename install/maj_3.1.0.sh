!/usr/bin/bash

echo "----------------------------------------------------------------------"
echo "-----------Mise à jour vers la version 3.1.1  ------------------------"
echo "----------------------------------------------------------------------"
echo "appuyer sur ENTER pour continuer"
read
mkdir tmp
wget -O tmp/maj.zip https://github.com/mgrafr/monitor/archive/refs/heads/miseajour.zip
unzip tmp/maj.zip
cp -RTu --update monitor-miseajour/include include
cp -RTu --update monitor-miseajour/css  css
cp -RTu --update monitor-miseajour/js  js
cp -u --update monitor-miseajour/fonctions.php  fonctions.php
#
sed -i "s/*************************Pour Domoticz/ modules complementaires dz/g" /var/www/html/monitor/admin/config.php
sed -i "s/URLDOMOTIC.'modules_lua\/string_t/'admin\/connect\/string_t/g" /var/www/html/monitor/admin/config.php
sed -i "s/URLDOMOTIC.'modules_lua\/c/'admin\/connect\/c/g" /var/www/html/monitor/admin/config.php
sed -i "s/URLDOMOTIC.'modules_lua\/string_modect.lua/'admin\/connect\/string_modect.json/g" /var/www/html/monitor/admin/config.php
#
rm -R tmp
rm .version
cp monitor-miseajour/.version .version
rm -R monitor-miseajour
echo "-----------------------------------------------------------------------"
echo "-----------Mises à jour vers la version 3.1.1  terminées---- ----------"
echo "-----------------------------------------------------------------------"
echo "----------jpgraph peut être mis à jour vers la version 4.4.2-----------"
echo "       pour cela téléccharger le référentiel                           "
echo "     extraire le dossier jgraph pour remplacer la version 4.4.1        "
echo "-----------------------------------------------------------------------"
echo "-----------------------------------------------------------------------"
echo "          le fichier python upload.py pour DZ a été modifié            "
echo "-----------------------------------------------------------------------"