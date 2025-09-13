#!/usr/bin/bash
cd /www/monitor
mkdir -p tmp
cd tmp
wget https://github.com/mgrafr/monitor/archive/refs/tags/monitor-v4.0.0.tar.gz
tar -xzf monitor-v4.0.0.tar.gz
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
cd ..
rm -R tmp
