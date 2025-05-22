#!/usr/bin/bash

cd /www/monitor
version=$(head -n 1 .version)
echo $version
answer=$(echo $version | tr -d .)
echo $answer
if [ $answer -gt 323 ]; then
echo "mise à jour vers 3.2.5"
apt update
apt install dos2unix
apt install unzip
wget https://raw.githubusercontent.com/mgrafr/monitor/main/install/maj_324.sh
dos2unix maj_324.sh
chmod +x maj_324.sh
./324.sh
wget https://raw.githubusercontent.com/mgrafr/monitor/refs/heads/main/.version
echo "maj terminée"
else
echo "faire maj complète"
fi

