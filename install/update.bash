#!/usr/bin/bash

cd /www/monitor
version=$(head -n 1 /var/www/html/monitor/.version)
echo $version
if [[ $version=2.2.7 ]] 
then
wget https://raw.githubusercontent.com/mgrafr/monitor/main/install/maj_2.2.7.sh
chmod +x maj_2.2.7.sh
./maj_2.2.7.sh
rm  maj_2.2.7.sh
else 
echo " *************pas de maj**********************"


