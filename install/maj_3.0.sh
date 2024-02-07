#!/usr/bin/bash

echo "-----------------------------------------------------------------"
echo "-----------Mise à jour vers la version 3.0.1  -------------------"
echo "-----------------------------------------------------------------"
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
rm .version
wget https://raw.githubusercontent.com/mgrafr/monitor/main/.version
echo "-----------------------------------------------------------------------"
echo "-----------Mises à jour vers la version 3.0.1   terminées--------------"
echo "-----------------------------------------------------------------------"