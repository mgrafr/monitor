#!/usr/bin/bash

echo "-**********************************************************************-"
echo "     avec cette version 3 la table 'idm' est obligatoire               -"
echo "          pour ceux qui utilise uniquement idx de Domoticz             -"
echo "          exporter la table 'dispositif' et la supprimer ,                             -"
echo " avec un éditeur de texte ,ajouter la valeur de idx à idm              -"
echo "          importer la table dispositifs                                -"
echo "-**********************************************************************-"
echo "-----------------------------------------------------------------"
echo "-----------Mise à jour vers la version 3.0.3  -------------------"
echo "-----------------------------------------------------------------"
echo "appuyer sur ENTER pour continuer"
read
mkdir tmp
wget -O tmp/maj.zip https://github.com/mgrafr/monitor/archive/refs/heads/miseajour.zip
unzip tmp/maj.zip
cp -RTu --update monitor-miseajour/include include
cp -RTu --update monitor-miseajour/css  css
cp -u --update monitor-miseajour/fonctions.php  fonctions.php
mysql --user="root" --database="monitor"  -e "DROP TABLE IF EXISTS dispositifs;"
mysql -root monitor < bd_sql/dispositifs.sql
#
mysql --user="root" --database="monitor"  -e "ALTER TABLE dispositifs ADD Actif varchar(1) NOT NULL DEFAULT '1' AFTER idm;"
sed -i "s/ idx : idx de Domoticz    idm : idm de monitor (dans ce cas la table \"dispositifs\" / UNIQUEMENT POUR LA VERSION DE MONITOR \<3.0 et pour les utlisateurs avec uniquement Domoticz/g" /var/www/html/monitor/admin/config.php
sed -i "s/ de la DB \"domoticz\" est obligatoire mais en cas de problème il faudra renommer tous les dispositifs /  -----------------------------------------/g" /var/www/html/monitor/admin/config.php
sed -i "s/ dans monitor au lieu de la DB/  -----------------------------------------/g" /var/www/html/monitor/admin/config.php
sed -i "s/define('CHOIXID','idm');\/\/ DZ:idm ou idx ; HA : idm uniquement/ define('CHOIXID','idm');\/\/ NE PAS MODIFIER -\n\/\/------------------------------------------/g" /var/www/html/monitor/admin/config.php
#
sed -i "s/Pour Domoticz/modules complementaires/g" /var/www/html/monitor/admin/config.php
sed -i "s/URLDOMOTIC.'modules_lua\/string_modect.lua/'admin\/string_modect.json/g" /var/www/html/monitor/admin/config.php
sed -i "s/URLDOMOTIC.'modules_lua\/connect.lua/'admin\/connect\/connect.py/g" /var/www/html/monitor/admin/config.php
sed -i "s/DZCONFIG/TMPCONFIG/g" /var/www/html/monitor/admin/config.php
sed -i "s/dz\/temp.lua/connect/\/g" /var/www/html/monitor/admin/config.php
sed -i "s/DZ_PATH/SSH_MONITOR_PATH/g" /var/www/html/monitor/admin/config.php
sed -i "s/opt\/domoticz\/config/var\/www\/html\/monitor\/admin\/connect/g" /var/www/html/monitor/admin/config.php
rm -R admin/dz
mkdir admin/connect
wget https://raw.githubusercontent.com/mgrafr/monitor/main/admin/connect/connect.js
mv connect.js admin/connect/connect.js 
wget https://raw.githubusercontent.com/mgrafr/monitor/main/admin/connect/connect.lua
mv connect.lua admin/connect/connect.lua
wget https://raw.githubusercontent.com/mgrafr/monitor/main/admin/connect/connect.py
mv connect.py admin/connect/connect.py 
#
rm -R tmp
rm .version
cp monitor-miseajour/.version .version
rm -R monitor-miseajour
echo "-----------------------------------------------------------------------"
echo "-----------Mises à jour vers la version 3.0.3   terminées--------------"
echo "-----------------------------------------------------------------------"
echo "----------jpgraph peut être mis à jour vers la version 4.4.2-----------"
echo "       pour cela téléccharger le référentiel                           "
echo "     extraire le dossier jgraph pour remplacer la version 4.4.1        "
echo "-----------------------------------------------------------------------"