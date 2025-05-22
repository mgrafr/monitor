#!/usr/bin/bash

cd /www/monitor
sed -i "s/.DOMAINE\" ));/DOMAINE\",/g" admin/config.php
sed -i "s/iobweb.DOMAINE",\iobweb.DOMAINE", 2 => \"false\"));/g" admin/config.php
cp -u ajax.php ajax.php
cp -u fonctions.php fonctions.php
cp -u index_loc.php index_loc.php
cp -u -R include/* include/
cp -u css/* css/
cp -u js/* js/
cp -u api/* api/
cp -u images/* images/
cp -u -R install/* install/
cp -u -R bd_sql/* bd_sql/
cp -u -R share/* share/
