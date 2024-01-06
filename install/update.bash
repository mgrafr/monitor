#!/usr/bin/bash

cd /www/monitor
version=$(head -n 1 /var/www/html/monitor/.version)
echo $version
if [[ $version == 2.2.7 ]] 
then
wget https://raw.githubusercontent.com/mgrafr/monitor/main/install/maj_2.2.7.sh
chmod +x maj_2.2.7.sh
./maj_2.2.7.sh
rm  maj_2.2.7.sh
elif [[ $version == 2.2.7.1 ]] 
then
wget https://raw.githubusercontent.com/mgrafr/monitor/main/install/maj_2.2.7.1.sh
chmod +x maj_2.2.7.1.sh
./maj_2.2.7.1.sh
rm  maj_2.2.7.1.sh
elif [[ $version == 2.2.7.2 ]] 
then
wget https://raw.githubusercontent.com/mgrafr/monitor/main/install/maj_2.2.7.2.sh
chmod +x maj_2.2.7.2.sh
./maj_2.2.7.2.sh
rm  maj_2.2.7.2.sh
else 
echo " *************pas de maj**********************"
elif [[ $version == 2.2.7.3 ]] 
then
wget https://raw.githubusercontent.com/mgrafr/monitor/main/install/maj_2.2.7.3.sh
chmod +x maj_2.2.7.3.sh
./maj_2.2.7.3.sh
rm  maj_2.2.7.3.sh
elif [[ $version == 2.2.7.4 ]] 
then
wget https://raw.githubusercontent.com/mgrafr/monitor/main/install/maj_2.2.7.4.sh
chmod +x maj_2.2.7.4.sh
./maj_2.2.7.4.sh
rm  maj_2.2.7.4.sh

else 
echo " *************pas de maj**********************"
fi