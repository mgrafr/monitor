#!/usr/bin/bash
echo "-----------------------------------------------------------------"
echo "-----------Mise à jour vers la version 2.2.7.8-------------------"
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
rm fonctions.php
wget https://raw.githubusercontent.com/mgrafr/monitor/main/include/habridge.php
mv habridge.php inculde/habridge.php
wget https://raw.githubusercontent.com/mgrafr/monitor/main/include/ajout_dev_bd.php
mv ajout_dev_bd.php inculde/ajout_dev_bd.php
wget https://raw.githubusercontent.com/mgrafr/monitor/main/include/fonctions_1.php
mv fonctions_1.php inculde/fonctions_1.php
wget https://raw.githubusercontent.com/mgrafr/monitor/main/include/entete.php
mv entete.php include/entete.php
wget https://raw.githubusercontent.com/mgrafr/monitor/main/images/fenetre.svg
mv fenetre.svg images/fenetre.svg
wget https://raw.githubusercontent.com/mgrafr/monitor/main/install/update.bash
mv update.bash install/update.bash
wget https://raw.githubusercontent.com/mgrafr/monitor/main/images/lampe_suspendue.svg
mv lampe_suspendue.svg images/lampe_suspendue.svg
#
rm .version
wget https://raw.githubusercontent.com/mgrafr/monitor/main/.version
echo "-----------------------------------------------------------------------"
echo "-----------Mises à jour vers la version 2.2.7.8 terminées--------------"
echo "-----------------------------------------------------------------------"
echo "---------------ATTENTION-----------------------------------------------"
echo "-----------   Supprimer la table sse dans MySQL          --------------"
echo "-----------   Importer la nouvelle table sse             --------------"
echo "  https://raw.githubusercontent.com/mgrafr/monitor/main/bd_sql/sse.sql "
echo "-----------------------------------------------------------------------"