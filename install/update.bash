#!/usr/bin/bash

cd /www/monitor
version=$(head -n 1 /var/www/html/monitor/.version)
echo $version
wget https://raw.githubusercontent.com/mgrafr/monitor/main/install/maj_$version.sh
chmod +x maj_$version.sh
./maj_$version.sh
rm  maj_$version.sh
echo " *************pas de maj**********************"

