#!/usr/bin/bash

cd /www/monitor
version=$(head -n 1 /var/www/html/monitor/.version)
echo $version
apt update
apt install dos2unix
apt install unzip
wget https://raw.githubusercontent.com/mgrafr/monitor/main/install/maj_$version.sh
dos2unix maj_$version.sh
chmod +x maj_$version.sh
rm  maj_$version.sh
cp -u ajax.php ajax.php
cp -u fonctions.php fonctions.php
cp -u index_loc.php index_loc.php
cp -u -R include/* include/
cp -u css/* css/
cp -u js/* js/
cp -u api/* api/
cp -u images/* images/
cp -u -R install/* install/
cp -u -R share/* share/


