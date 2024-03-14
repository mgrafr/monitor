#!/usr/bin/bash


echo "-**********************************************************************-"
echo "     avec cette version 3 la table 'idm' est obligatoire               -"
echo "          pour ceux qui utilise uniquement idx de Domoticz             -"
echo "          exporter la table 'dispositif' et la supprimer ,                             -"
echo " avec un éditeur de texte ,ajouter la valeur de idx à idm              -"
echo "          importer la table dispositifs                                -"
echo "-**********************************************************************-"
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
sed -i '201d' /var//www/html/monitor/admin/config.php
echo "//DZ_PATH :ex dz docker /opt/domoticz/config/, ex autre dz /opt/domoticz, home/USER/domoticz" >> /www/admin/config.php
echo "define('DZ_PATH', '/opt/domoticz/config/');" >> /www/admin/config.php
echo "?>" >> /www/admin/config.php
wget https://raw.githubusercontent.com/mgrafr/monitor/main/api/f_pour_api.php
mv f_pour_api.php api/f_pour_api.php
sed -i "s/ pour SSE node/  pour SSE php \ndefine('SSE_SLEEP', 'php');\n\/\/pour SSE node/g" /var/www/html/monitor/admin/config.php
mysql --user="root" --database="monitor"  -e "ALTER TABLE dispositifs ADD Actif varchar(1) NOT NULL DEFAULT '1' AFTER idm;"
sed -i "s/ idx : idx de Domoticz    idm : idm de monitor (dans ce cas la table \"dispositifs\" / UNIQUEMENT POUR LA VERSION DE MONITOR \<3.0 et pour les utlisateurs avec uniquement Domoticz/g" /var/www/html/monitor/admin/config.php
sed -i "s/ de la DB \"domoticz\" est obligatoire mais en cas de problème il faudra renommer tous les dispositifs /  -----------------------------------------/g" /var/www/html/monitor/admin/config.php
sed -i "s/ dans monitor au lieu de la DB/  -----------------------------------------/g" /var/www/html/monitor/admin/config.php
sed -i "s/define('CHOIXID','idm');\/\/ DZ:idm ou idx ; HA : idm uniquement/ define('CHOIXID','idm');\/\/ NE PAS MODIFIER -\n\/\/------------------------------------------/g" /var/www/html/monitor/admin/config.php
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
sed -i "s/DZCONFIG/TMPCONFIG/g" /var/www/html/monitor/admin/config.php
sed -i "s/dz\/temp.lua/admin\/connect\//g" /var/www/html/monitor/admin/config.php
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
echo "          le fichier python upload.py pour DZ a été modifié            "
echo "-----------------------------------------------------------------------"
echo "-----------------------------------------------------------------------"
echo "          le fichier python upload.py pour DZ a été modifié            "
echo "-----------------------------------------------------------------------"