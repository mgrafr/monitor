#!/usr/bin/bash

cd /www/monitor
version=$(head -n 1 .version)
echo $version
answer=$(echo $version | tr -d .)
echo $answer
if [ $answer -gt 325 ]; then
echo "ok"
apt update
apt install dos2unix
apt install unzip
wget https://raw.githubusercontent.com/mgrafr/monitor/main/install/maj_322.sh
dos2unix maj_322.sh
chmod +x maj_322.sh
./322.sh
else
echo "faire maj complète"
fi

