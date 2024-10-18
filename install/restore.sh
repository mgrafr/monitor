#!/usr/bin/bash
sudo apt install certbot python3-certbot-nginx
mkdir /etc/nginx/ssl
chmod -R 777 /etc/nginx/ssl
mkdir /etc/letsencrypt
chmod -R 777 /etc/letsencrypt
chmod -R 777 /var/www/html/monitor

cp -R /home/michel/admin /var/www/html/monitor/admin

cp -R conf.d/* /etc/nginx/conf.d/
cp nginx.conf  /etc/nginx/
cp -R /home/michel/letsencrypt /etc/letsencrypt
//
rm /etc/letsencrypt/live/ha.la-truffiere.ovh/*
ln -s /etc/letsencrypt/archive/ha.la-truffiere.ovh/privkey1.pem /etc/letsencrypt/live/ha.la-truffiere.ovh/privkey.pem
ln -s /etc/letsencrypt/archive/ha.la-truffiere.ovh/fullchain1.pem /etc/letsencrypt/live/ha.la-truffiere.ovh/fullchain.pem
ln -s /etc/letsencrypt/archive/ha.la-truffiere.ovh/chain1.pem /etc/letsencrypt/live/ha.la-truffiere.ovh/chain.pem
ln -s /etc/letsencrypt/archive/ha.la-truffiere.ovh/cert1.pem /etc/letsencrypt/live/ha.la-truffiere.ovh/cert.pem
rm /etc/letsencrypt/live/iobroker.la-truffiere.ovh/*
ln -s /etc/letsencrypt/archive/iobroker.la-truffiere.ovh/privkey1.pem /etc/letsencrypt/live/iobroker.la-truffiere.ovh/privkey.pem
ln -s /etc/letsencrypt/archive/iobroker.la-truffiere.ovh/fullchain1.pem /etc/letsencrypt/live/iobroker.la-truffiere.ovh/fullchain.pem
ln -s /etc/letsencrypt/archive/iobroker.la-truffiere.ovh/chain1.pem /etc/letsencrypt/live/iobroker.la-truffiere.ovh/chain.pem
ln -s /etc/letsencrypt/archive/iobroker.la-truffiere.ovh/cert1.pem /etc/letsencrypt/live/iobroker.la-truffiere.ovh/cert.pem
rm /etc/letsencrypt/live/la-truffiere.ovh/*
ln -s /etc/letsencrypt/archive/la-truffiere.ovh/privkey1.pem /etc/letsencrypt/live/la-truffiere.ovh/privkey.pem
ln -s /etc/letsencrypt/archive/la-truffiere.ovh/fullchain1.pem /etc/letsencrypt/live/la-truffiere.ovh/fullchain.pem
ln -s /etc/letsencrypt/archive/la-truffiere.ovh/chain1.pem /etc/letsencrypt/live/la-truffiere.ovh/chain.pem
ln -s /etc/letsencrypt/archive/la-truffiere.ovh/cert1.pem /etc/letsencrypt/live/la-truffiere.ovh/cert.pem
rm /etc/letsencrypt/live/monitoring.la-truffiere.ovh/*
ln -s /etc/letsencrypt/archive/monitoring.la-truffiere.ovh/privkey1.pem /etc/letsencrypt/live/monitoring.la-truffiere.ovh/privkey.pem
ln -s /etc/letsencrypt/archive/monitoring.la-truffiere.ovh/fullchain1.pem /etc/letsencrypt/live/monitoring.la-truffiere.ovh/fullchain.pem
ln -s /etc/letsencrypt/archive/monitoring.la-truffiere.ovh/chain1.pem /etc/letsencrypt/live/monitoring.la-truffiere.ovh/chain.pem
ln -s /etc/letsencrypt/archive/monitoring.la-truffiere.ovh/cert1.pem /etc/letsencrypt/live/monitoring.la-truffiere.ovh/cert.pem
rm /etc/letsencrypt/live/mqtt.la-truffiere.ovh/*
ln -s /etc/letsencrypt/archive/mqtt.la-truffiere.ovh/privkey1.pem /etc/letsencrypt/live/mqtt.la-truffiere.ovh/privkey.pem
ln -s /etc/letsencrypt/archive/mqtt.la-truffiere.ovh/fullchain1.pem /etc/letsencrypt/live/mqtt.la-truffiere.ovh/fullchain.pem
ln -s /etc/letsencrypt/archive/mqtt.la-truffiere.ovh/chain1.pem /etc/letsencrypt/live/mqtt.la-truffiere.ovh/chain.pem
ln -s /etc/letsencrypt/archive/mqtt.la-truffiere.ovh/cert1.pem /etc/letsencrypt/live/mqtt.la-truffiere.ovh/cert.pem
rm /etc/letsencrypt/live/plex.la-truffiere.ovh/*
ln -s /etc/letsencrypt/archive/plex.la-truffiere.ovh/privkey1.pem /etc/letsencrypt/live/plex.la-truffiere.ovh/privkey.pem
ln -s /etc/letsencrypt/archive/plex.la-truffiere.ovh/fullchain1.pem /etc/letsencrypt/live/plex.la-truffiere.ovh/fullchain.pem
ln -s /etc/letsencrypt/archive/plex.la-truffiere.ovh/chain1.pem /etc/letsencrypt/live/plex.la-truffiere.ovh/chain.pem
ln -s /etc/letsencrypt/archive/plex.la-truffiere.ovh/cert1.pem /etc/letsencrypt/live/plex.la-truffiere.ovh/cert.pem
rm /etc/letsencrypt/live/pontha.la-truffiere.ovh/*
ln -s /etc/letsencrypt/archive/pontha.la-truffiere.ovh/privkey1.pem /etc/letsencrypt/live/pontha.la-truffiere.ovh/privkey.pem
ln -s /etc/letsencrypt/archive/pontha.la-truffiere.ovh/fullchain1.pem /etc/letsencrypt/live/pontha.la-truffiere.ovh/fullchain.pem
ln -s /etc/letsencrypt/archive/pontha.la-truffiere.ovh/chain1.pem /etc/letsencrypt/live/pontha.la-truffiere.ovh/chain.pem
ln -s /etc/letsencrypt/archive/pontha.la-truffiere.ovh/cert1.pem /etc/letsencrypt/live/pontha.la-truffiere.ovh/cert.pem
rm /etc/letsencrypt/live/socket.la-truffiere.ovh/*
ln -s /etc/letsencrypt/archive/socket.la-truffiere.ovh/privkey1.pem /etc/letsencrypt/live/socket.la-truffiere.ovh/privkey.pem
ln -s /etc/letsencrypt/archive/socket.la-truffiere.ovh/fullchain1.pem /etc/letsencrypt/live/socket.la-truffiere.ovh/fullchain.pem
ln -s /etc/letsencrypt/archive/socket.la-truffiere.ovh/chain1.pem /etc/letsencrypt/live/socket.la-truffiere.ovh/chain.pem
ln -s /etc/letsencrypt/archive/socket.la-truffiere.ovh/cert1.pem /etc/letsencrypt/live/socket.la-truffiere.ovh/cert.pem
rm /etc/letsencrypt/live/zigbee.la-truffiere.ovh/*
ln -s /etc/letsencrypt/archive/zigbee.la-truffiere.ovh/privkey1.pem /etc/letsencrypt/live/zigbee.la-truffiere.ovh/privkey.pem
ln -s /etc/letsencrypt/archive/zigbee.la-truffiere.ovh/fullchain1.pem /etc/letsencrypt/live/zigbee.la-truffiere.ovh/fullchain.pem
ln -s /etc/letsencrypt/archive/zigbee.la-truffiere.ovh/chain1.pem /etc/letsencrypt/live/zigbee.la-truffiere.ovh/chain.pem
ln -s /etc/letsencrypt/archive/zigbee.la-truffiere.ovh/cert1.pem /etc/letsencrypt/live/zigbee.la-truffiere.ovh/cert.pem
rm /etc/letsencrypt/live/zwave.la-truffiere.ovh/*
ln -s /etc/letsencrypt/archive/zwave.la-truffiere.ovh/privkey1.pem /etc/letsencrypt/live/zwave.la-truffiere.ovh/privkey.pem
ln -s /etc/letsencrypt/archive/zwave.la-truffiere.ovh/fullchain1.pem /etc/letsencrypt/live/zwave.la-truffiere.ovh/fullchain.pem
ln -s /etc/letsencrypt/archive/zwave.la-truffiere.ovh/chain1.pem /etc/letsencrypt/live/zwave.la-truffiere.ovh/chain.pem
ln -s /etc/letsencrypt/archive/zwave.la-truffiere.ovh/cert1.pem /etc/letsencrypt/live/zwave.la-truffiere.ovh/cert.pem
rm /etc/letsencrypt/live/iobweb.la-truffiere.ovh/*
ln -s /etc/letsencrypt/archive/iobweb.la-truffiere.ovh/privkey1.pem /etc/letsencrypt/live/iobweb.la-truffiere.ovh/privkey.pem
ln -s /etc/letsencrypt/archive/iobweb.la-truffiere.ovh/fullchain1.pem /etc/letsencrypt/live/iobweb.la-truffiere.ovh/fullchain.pem
ln -s /etc/letsencrypt/archive/iobweb.la-truffiere.ovh/chain1.pem /etc/letsencrypt/live/iobweb.la-truffiere.ovh/chain.pem
ln -s /etc/letsencrypt/archive/iobweb.la-truffiere.ovh/cert1.pem /etc/letsencrypt/live/iobweb.la-truffiere.ovh/cert.pem
// monitor.conf, supprimer le port 80 dans la précédente version
listen 444 ssl; # managed by Certbot
certbot update_symlinks

ufw allow 444

voir IP monitor dans domoticz