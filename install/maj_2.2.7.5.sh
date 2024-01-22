#!/usr/bin/bash

echo "-----------------------------------------------------------------"
echo "-----------Mise à jour vers la version 2.2.7.7-------------------"
echo "-----------------------------------------------------------------"
rm fonctions.php
wget https://raw.githubusercontent.com/mgrafr/monitor/main/include/habridge.php
mv habridge.php include/habridge.php
wget https://raw.githubusercontent.com/mgrafr/monitor/main/include/ajout_dev_bd.php
mv ajout_dev_bd.php include/ajout_dev_bd.php
wget https://raw.githubusercontent.com/mgrafr/monitor/main/include/fonctions_1.php
mv fonctions_1.php include/fonctions_1.php
wget https://raw.githubusercontent.com/mgrafr/monitor/main/include/footer.php
mv footer.php include/footer.php
rm fonctions.php
wget https://raw.githubusercontent.com/mgrafr/monitor/main/fonctions.php
wget https://raw.githubusercontent.com/mgrafr/monitor/main/include/entete.php
mv entete.php include/entete.php
wget https://raw.githubusercontent.com/mgrafr/monitor/main/images/fenetre.svg
mv fenetre.svg images/fenetre.svg
wget https://raw.githubusercontent.com/mgrafr/monitor/main/css/mes_css.css
mv mes_css.css css/mes_css.css
#
rm .version
wget https://raw.githubusercontent.com/mgrafr/monitor/main/.version
echo "-----------------------------------------------------------------------"
echo "-----------Mises à jour vers la version 2.2.7.7 terminées--------------"
echo "-----------------------------------------------------------------------"