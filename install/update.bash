#!/usr/bin/bash

cd /tmp
mkdir monitor-update
wget https://github.com/mgrafr/monitor/archive/refs/heads/update.zip
unzip /tmp/update.zip 
cp -ru /tmp/monitor-update/* /www/monitor/


