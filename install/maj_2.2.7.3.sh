#!/usr/bin/bash

echo "-----------------------------------------------------------------"
echo "-----------Mise à jour vers la version 2.2.7.5-------------------"
echo "-----------------------------------------------------------------"
wget https://raw.githubusercontent.com/mgrafr/monitor/main/include/footer.php
mv footer.php /inculde/footer.php
rm fonctions.php
wget https://raw.githubusercontent.com/mgrafr/monitor/main/fonctions.php
wget https://raw.githubusercontent.com/mgrafr/monitor/main/api/f_pour_api.php
mv f_pour_api.php api/f_pour_api.php
sed -i "s/ pour SSE node/  pour SSE php \ndefine('SSE_SLEEP', 'php');\n\/\/pour SSE node/g" /var/www/html/monitor/admin/config.php
wget https://raw.githubusercontent.com/mgrafr/monitor/main/include/serveur_sse.php
mv serveur_sse.php include/serveur_sse.php
#
rm .version
wget https://raw.githubusercontent.com/mgrafr/monitor/main/.version
echo "-----------------------------------------------------------------------"
echo "-----------Mises à jour vers la version 2.2.7.5 terminées--------------"
echo "-----------------------------------------------------------------------"