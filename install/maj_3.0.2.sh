#!/usr/bin/bash

echo "----------------------------------------------------------------------"
echo "-----------Mise à jour vers la version 3.1.1  ------------------------"
echo "       cette version necessite d'attribuer aux variable un idm        "
echo " apres ma mise à jour la liste des variables concernées sera affichée "
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
mysql --user="root" --database="monitor"  -e "ALTER TABLE dispositifs ADD Actif varchar(1) NOT NULL DEFAULT '1' AFTER idm;"
echo "-------------------------------------------------------------------------"
echo "    VARIABLES A METTRE A JOUR : ajouter un ID ( numero max : 9999        "
echo "-------------------------------------------------------------------------"
mysql --user="root" --database="monitor"  -e "SELECT * FROM dispositifs WHERE maj_js='variable';"
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
echo "-----------Mises à jour vers la version 3.1.1   terminées--------------"
echo "-----------------------------------------------------------------------"
echo "----------jpgraph peut être mis à jour vers la version 4.4.2-----------"
echo "       pour cela téléccharger le référentiel                           "
echo "     extraire le dossier jgraph pour remplacer la version 4.4.1        "
echo "-----------------------------------------------------------------------"
echo "-----------------------------------------------------------------------"
echo "          le fichier python upload.py pour DZ a été modifié            "
echo "-----------------------------------------------------------------------"