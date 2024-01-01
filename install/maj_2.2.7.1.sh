#!/usr/bin/bash
wget https://raw.githubusercontent.com/mgrafr/monitor/main/api/f_pour_api.php
mv f_pour_api.php api/f_pour_api.php
wget https://raw.githubusercontent.com/mgrafr/monitor/main/api/json.php
mv json.php api/json.php
rm .version
rm install/maj_2.2.7.1.sh
wget https://raw.githubusercontent.com/mgrafr/monitor/main/.version
echo "-----------------------------------------------------------------"
echo "--------Mise à jour vers la version 2.2.7.1 terminée-------------"
echo "-----------------------------------------------------------------"

