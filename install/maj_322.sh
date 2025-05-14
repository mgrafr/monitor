#!/usr/bin/bash

cd /www/monitor

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
