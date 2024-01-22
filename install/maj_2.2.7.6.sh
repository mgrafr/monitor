#!/usr/bin/bash
echo "-----------------------------------------------------------------"
echo "-----------Mise à jour vers la version 2.2.7.7-------------------"
echo "-----------------------------------------------------------------"
wget https://raw.githubusercontent.com/mgrafr/monitor/main/include/entete.php
mv entete.php inculde/entete.php
wget https://raw.githubusercontent.com/mgrafr/monitor/main/images/fenetre.svg
mv fenetre.svg images/fenetre.svg
wget https://raw.githubusercontent.com/mgrafr/monitor/main/css/mes_css.css
mv mes_css.css css/mes_css.css
wget https://raw.githubusercontent.com/mgrafr/monitor/main/include/footer.php
mv footer.php /inculde/footer.php
echo "-----------------------------------------------------------------------"
echo "-----------Mises à jour vers la version 2.2.7.7 terminées--------------"
echo "-----------------------------------------------------------------------"