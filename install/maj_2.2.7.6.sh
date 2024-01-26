#!/usr/bin/bash
echo "-----------------------------------------------------------------"
echo "-----------Mise à jour vers la version 2.2.7.8-------------------"
echo "-----------------------------------------------------------------"
wget https://raw.githubusercontent.com/mgrafr/monitor/main/include/entete.php
mv entete.php inculde/entete.php
wget https://raw.githubusercontent.com/mgrafr/monitor/main/images/fenetre.svg
mv fenetre.svg images/fenetre.svg
wget https://raw.githubusercontent.com/mgrafr/monitor/main/css/mes_css.css
mv mes_css.css css/mes_css.css
wget https://raw.githubusercontent.com/mgrafr/monitor/main/include/footer.php
mv footer.php /inculde/footer.php
wget https://raw.githubusercontent.com/mgrafr/monitor/main/install/update.bash
mv update.bash install/update.bash
wget https://raw.githubusercontent.com/mgrafr/monitor/main/images/lampe_suspendue.svg
mv lampe_suspendue.svg images/lampe_suspendue.svg
wget https://raw.githubusercontent.com/mgrafr/monitor/main/include/ajout_dev_bd.php
mv ajout_dev_bd.php include/ajout_dev_bd.php
rm fonctions.php
wget https://raw.githubusercontent.com/mgrafr/monitor/main/fonctions.php
wget https://raw.githubusercontent.com/mgrafr/monitor/main/images/fenetre.svg
mv fenetre.svg images/fenetre.svg
#
rm .version
wget https://raw.githubusercontent.com/mgrafr/monitor/main/.version
echo "-----------------------------------------------------------------------"
echo "-----------Mises à jour vers la version 2.2.7.8 terminées--------------"
echo "-----------------------------------------------------------------------"