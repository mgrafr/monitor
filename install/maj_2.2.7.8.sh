#!/usr/bin/bash

echo "-----------------------------------------------------------------"
echo "-----------Mise à jour vers la version 3.0    -------------------"
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
mysql --user="root" --database="monitor"  -e "ALTER TABLE dispositifs ADD Actif varchar(1) NOT NULL DEFAULT '1' AFTER idm;"
rm fonctions.php
wget https://raw.githubusercontent.com/mgrafr/monitor/main/fonctions.php
wget https://raw.githubusercontent.com/mgrafr/monitor/main/include/footer.php
mv footer.php include/footer.php
wget https://raw.githubusercontent.com/mgrafr/monitor/main/include/fonctions_1.php
mv fonctions_1.php include/fonctions_1.php
sed -i "s/ idx : idx de Domoticz    idm : idm de monitor (dans ce cas la table \"dispositifs\" / UNIQUEMENT POUR LA VERSION DE MONITOR \<3.0 et pour les utlisateurs avec uniquement Domoticz/g" /var/www/html/monitor/admin/config.php
sed -i "s/ de la DB \"domoticz\" est obligatoire mais en cas de problème il faudra renommer tous les dispositifs /  -----------------------------------------/g" /var/www/html/monitor/admin/config.php
sed -i "s/ dans monitor au lieu de la DB/  -----------------------------------------/g" /var/www/html/monitor/admin/config.php
sed -i "s/define('CHOIXID','idm');\/\/ DZ:idm ou idx ; HA : idm uniquement/ define('CHOIXID','idm');\/\/ NE PAS MODIFIER -\n\/\/------------------------------------------/g" /var/www/html/monitor/admin/config.php
#
rm .version
wget https://raw.githubusercontent.com/mgrafr/monitor/main/.version
echo "-----------------------------------------------------------------------"
echo "-----------Mises à jour vers la version 3.0 terminées--------------"
echo "-----------------------------------------------------------------------"
echo "-----------------------------------------------------------------------"
echo "-----------------------------------------------------------------------"
echo "----------jpgraph peut être mis à jour vers la version 4.4.2-----------"
echo "       pour cela téléccharger le référentiel                           "
echo "     extraire le dossier jgraph pour remplacer la version 4.4.1        "
echo "-----------------------------------------------------------------------"
