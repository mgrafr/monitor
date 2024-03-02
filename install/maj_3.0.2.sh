!/usr/bin/bash

echo "-----------------------------------------------------------------"
echo "-----------Mise à jour vers la version 3.0.3  -------------------"
echo "-----------------------------------------------------------------"
echo "appuyer sur une touche pour continuer"
read
mkdir tmp
wget - O tmp/maj.zip https://github.com/mgrafr/monitor/archive/refs/heads/miseajour.zip
unzip tmp/maj.zip
cp -RTu --update tmp/include include
cp -RTu --update tmp/css  css
cp -u --update tmp/fonctions.php  fonctions.php
mysql --user="root" --database="monitor"  -e "DROP TABLE IF EXISTS dispositifs;"
mysql -root monitor < bd_sql/dispositifs.sql
#
rm -R tmp
rm .version
cp tmp/.version .version
echo "-----------------------------------------------------------------------"
echo "-----------Mises à jour vers la version 3.0.3   terminées--------------"
echo "-----------------------------------------------------------------------"