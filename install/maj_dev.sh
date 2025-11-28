#!/usr/bin/bash

cd /www/monitor
sed -i "s/.DOMAINE\" ));/DOMAINE\",/g" admin/config.php
sed -i "s/iobweb.DOMAINE",\iobweb.DOMAINE", 2 => \"false\"));/g" admin/config.php
#----------------------------------------
mkdir tmp
cd tmp
git clone https://github.com/mgrafr/monitor.git
cp -u ajax.php /www/monitor/ajax.php
cp -u fonctions.php /www/monitor/fonctions.php
cp -u index_loc.php /www/monitor/index_loc.php
cp -u -R include/* /www/monitor/include/
file=/www/monitor/custom/php/accueil.php
if [ -e $file ]; then mv /www/monitor/include/accueil.php /www/monitor/include/_accueil.bak; fi
cp -u css/* /www/monitor/css/
cp -u js/* /www/monitor/js/
cp -u api/* /www/monitor/api/
cp -u images/* /www/monitor/images/
cp -u -R install/* /www/monitor/install/
cp -u -R bd_sql/* /www/monitor/bd_sql/
cp -u -R share/* /www/monitor/share/
cp -u .version /www/monitor/.version
rm -R tmp
result()(mysql --user="root" --password="Idem4546" --database="monitor" --execute= -e "SHOW COLUMNS FROM dispositifs LIKE 'materiel';") 
res=${result} 
if [[ ${res:0:5} != 'Field' ]] 
then 
mysql --user="root" --password="Idem4546" --database="monitor" --execute= -e "ALTER TABLE dispositifs CHANGE materiel mat_json text;"
fi
