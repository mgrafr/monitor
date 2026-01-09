#!/usr/bin/bash

cd /www/monitor
mkdir -p tmp
cd tmp
git clone https://github.com/mgrafr/monitor.git
cd monitor
cp -u ajax.php /www/monitor/ajax.php
cp -u fonctions.php /www/monitor/fonctions.php
cp -u index_loc.php /www/monitor/index_loc.php
cp -u -R include/* /www/monitor/include/
cp -u css/* /www/monitor/css/
cp -u js/* /www/monitor/js/
cp -u api/* /www/monitor/api/
cp -u images/* /www/monitor/images/
cp -u -R install/* /www/monitor/install/
cp -u -R bd_sql/* /www/monitor/bd_sql/
cp -u -R share/* /www/monitor/share/
cp -u .version /www/monitor/.version
cd /www/monitor
rm -R tmp

