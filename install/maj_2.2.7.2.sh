#!/usr/bin/bash

echo "-----------------------------------------------------------------"
echo "-----------Mise à jour vers la version 3.0.2  -------------------"
echo "-----------------------------------------------------------------"
echo "-**********************************************************************-"
echo "     avec cette version 3 la table 'idm' est obligatoire               -"
echo "          pour ceux qui utilise uniquement idx de Domoticz             -"
echo "          exorter la table 'idx' , supprimer la table 'idm'            -"
echo " avec un éditeur de texte remplacer le nom de la table 'idx' par 'idm' -"
echo "          importer cette table renommer 'idm '                         -"
echo "-**********************************************************************-"
echo "appuyer sur une touche pour continuer"
read
sed -i '201d' /var//www/html/monitor/admin/config.php
echo "//DZ_PATH :ex dz docker /opt/domoticz/config/, ex autre dz /opt/domoticz, home/USER/domoticz" >> /www/admin/config.php
echo "define('DZ_PATH', '/opt/domoticz/config/');" >> /www/admin/config.php
echo "?>" >> /www/admin/config.php
wget https://raw.githubusercontent.com/mgrafr/monitor/main/api/f_pour_api.php
mv f_pour_api.php api/f_pour_api.php
sed -i "s/ pour SSE node/  pour SSE php \ndefine('SSE_SLEEP', 'php');\n\/\/pour SSE node/g" /var/www/html/monitor/admin/config.php
wget https://raw.githubusercontent.com/mgrafr/monitor/main/include/serveur_sse.php
mv serveur_sse.php include/serveur_sse.php
wget https://raw.githubusercontent.com/mgrafr/monitor/main/include/habridge.php
mv habridge.php include/habridge.php
wget https://raw.githubusercontent.com/mgrafr/monitor/main/include/entete.php
mv entete.php include/entete.php
wget https://raw.githubusercontent.com/mgrafr/monitor/main/images/lampe_suspendue.svg
mv lampe_suspendue.svg images/lampe_suspendue.svg
wget https://raw.githubusercontent.com/mgrafr/monitor/main/install/update.bash
mv update.bash install/update.bash
wget https://raw.githubusercontent.com/mgrafr/monitor/main/images/fenetre.svg
mv fenetre.svg images/fenetre.svg
mysql --user="root" --database="monitor"  -e "ALTER TABLE dispositifs ADD Actif varchar(1) NOT NULL DEFAULT '1' AFTER idm;"
wget https://raw.githubusercontent.com/mgrafr/monitor/main/include/fonctions_1.php
mv fonctions_1.php include/fonctions_1.php
sed -i "s/ idx : idx de Domoticz    idm : idm de monitor (dans ce cas la table \"dispositifs\" / UNIQUEMENT POUR LA VERSION DE MONITOR \<3.0 et pour les utlisateurs avec uniquement Domoticz/g" /var/www/html/monitor/admin/config.php
sed -i "s/ de la DB \"domoticz\" est obligatoire mais en cas de problème il faudra renommer tous les dispositifs /  -----------------------------------------/g" /var/www/html/monitor/admin/config.php
sed -i "s/ dans monitor au lieu de la DB/  -----------------------------------------/g" /var/www/html/monitor/admin/config.php
sed -i "s/define('CHOIXID','idm');\/\/ DZ:idm ou idx ; HA : idm uniquement/ define('CHOIXID','idm');\/\/ NE PAS MODIFIER -\n\/\/------------------------------------------/g" /var/www/html/monitor/admin/config.php
rm fonctions.php
wget https://raw.githubusercontent.com/mgrafr/monitor/main/fonctions.php
wget https://raw.githubusercontent.com/mgrafr/monitor/main/include/footer.php
mv footer.php include/footer.php
wget https://raw.githubusercontent.com/mgrafr/monitor/main/include/ajout_dev_bd.php
mv ajout_dev_bd.php include/ajout_dev_bd.php
wget https://raw.githubusercontent.com/mgrafr/monitor/main/include/ajout_var_bd.php
mv ajout_var_bd.php include/ajout_var_bd.php
wget https://raw.githubusercontent.com/mgrafr/monitor/main/include/admin.php
mv admin.php include/admin.php
wget https://raw.githubusercontent.com/mgrafr/monitor/main/include/info_admin.php
mv info_admin.php include/info_admin.php
wget https://raw.githubusercontent.com/mgrafr/monitor/main/images/info10.webp
mv info10.webp images/info10.webp
wget https://raw.githubusercontent.com/mgrafr/monitor/main/images/info12.webp
mv info10.webp images/info12.webp
wget https://raw.githubusercontent.com/mgrafr/monitor/main/css/mes_css.css
mv mes_css.css css/mes_css.css
#
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
#
rm .version
wget https://raw.githubusercontent.com/mgrafr/monitor/main/.version
echo "-----------------------------------------------------------------------"
echo "-----------Mises à jour vers la version 3.0.2   terminées--------------"
echo "-----------------------------------------------------------------------"
echo "-----------------------------------------------------------------------"
echo "----------jpgraph peut être mis à jour vers la version 4.4.2-----------"
echo "       pour cela téléccharger le référentiel                           "
echo "     extraire le dossier jgraph pour remplacer la version 4.4.1        "
echo "-----------------------------------------------------------------------"