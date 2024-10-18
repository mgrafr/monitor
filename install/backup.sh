#!/usr/bin/bash

chmod -R 777 /etc/ssl
chmod -R 777 /etc/cron*
chmod -R 777 /home/michel/*
chmod -R 777 /etc/nginx/*
cp -R /etc/nginx/nginx.conf /home/michel/nginx/nginx.conf
cp -R /etc/nginx/conf.d/* /home/michel/nginx/conf.d/
cp -R /etc/nginx/ssl/* /home/michel/nginx/ssl/
cp -R /etc/letsencrypt/* /home/michel/letsencrypt
cp -R /etc/ssl/* /home/michel/ssl
cp -R /var/www/html/monitor/DB_Backup/* /home/michel/DB_Backup/
cp -R /var/www/html/monitor/admin/* /home/michel/admin/
cp -R /var/www/html/monitor/custom/* /home/michel/custom/
cp -R /etc/cron*/* /home/michel/
