#!/usr/bin/bash
#sur le nouveau serveur monitor 
mdir_maj=$(whiptail --title "Création d'un réperoire de travail " --inputbox "veuillez entrer le du répertoire \n\n Entrer répertoire" 10 60 3>&1 1>&2 2>&3)
exitstatus=$?
if [ $exitstatus = 0 ]; then
info "répertoire enregistré : "$mdir_maj
else
mdir_maj=/home/maj_monitor
echo "Par défaut, utlisateur enregistré : "$mdir_maj
fi 
mkdir -p /home/$mdir_maj/monitor/{admin,custom,DB_Backup}
mkdir -p /home/$mdir_maj/etc/{letsencrypt,ssl,nginx{conf.d,ssl},cron.d,}
read ip3 < /var/www/monitor/admin/connect/ip.txt
echo "adresse IP:" $ip3
domaine=`grep $choix'domaine=' /var/www/monitor/admin/connect/connect.py | cut -f 2 -d '='`
echo "domaine : " $domaine
xxx=$(hostname -I)
ip4=$(echo $xxx | cut -d ' ' -f 1)
sed -i "s/${ip3}/${ip4}/g" /var/www/monitor/admin/config.php 
sed  -i "s/{$domaine}/{$domaine}:444/g" /var/www/monitor/admin/config.php
sed  -i "s/${ip3}/${ip4}/g" /home/$mdir_maj/etc/nginx/conf.d/monitor.conf
#modifier monitor.conf
sed  -i "s/443/444/g" /home/$mdir_maj/etc/nginx/conf.d/monitor.conf
sed  -i "s/#/ }/g" /home/$mdir_maj/etc/nginx/conf.d/monitor.conf
sed -i "s/${ip3}/${ip4}/g" /var/www/monitor/admin/connect/connect.py

vv=$(pip list --format=json)
echo $vv
chmod -R 777 *
cd monitor
lets=$(whiptail --title "Certificat Letsencrypt" --radiolist \
"Comment voulez vous mettre à jour monitor ?\n avec les certificat SSL enregistrés\n sans les certificats SSL " 15 60 4 \
"Avec les certificats déjà enregistrés" "par defaut " ON \
"Sans certificats" "voir la doc" OFF 3>&1 1>&2 2>&3)
if [ $exitstatus = 0 ]; then
   echo "Vous avez choisi  : $lets"
else
echo "Vous avez annulé  "
fi
sftp $mdir_maj@192.168.1.9<<EOF
get index_loc.php
lcd admin
get -R /var/www/monitor/admin/* 
lcd ..
lcd custom
get -R /var/www/monitor/custom/*
lcd ..
lcd DB_Backup
get /var/www/monitor/DB_Backup/*
lcd ..
lcd ..
lcd etc/nginx/conf.d
get /etc/nginx/conf.d/*
exit
EOF
if [ "lets" = "Avec les certificats déjà enregistrés" ]
then
sftp $mdir_maj@192.168.1.9<<EOF
lcd /etc/nginx/ssl
get /etc/nginx/ssl/*
lcd /etc/letsencrypt
get -R /etc/letsencrypt/*
lcd ..
lcd ssl
get /etc/ssl/*
cd ..
cd cron.d/
get /etc/cron.d/*
exit
EOF
fi
cd /home/$mdir_maj/etc/letsencrypt
rm -R live
mkdir live
chmod - R 777 live
for f in * ; do  echo $f;  done > /home/$mdir_maj/a.txt;
while read l; do nb=$(ls /home/$mdir_maj/etc/letsencrypt/archive/$l | wc -
l) ; a=$((($nb)/4)); echo $a; mkdir /home/$mdir_maj/etc/letsencrypt/live/$l;chmod -R 777 /home/$mdir_maj/etc/letsencrypt/live/*; ln -s /home/$mdir_maj/etc/letsencrypt/archive/$l/*$a.pem /home/$mdir_maj/etc/letsencrypt/live/$l/ ;  done
 < /home$mdir_maj/a.txt
me/$mdir_maj/a.txt
cp monitor/index_loc.php /var/www/monitor/
cp -R /home/$mdir_maj/monitor/admin/* /var/www/monitor/admin/
chmod -R 777 /var/www/monitor/DB_Backup
cp /home/$mdir_maj/monitor/DB_Backup/monitor.sql /var/www/monitor/DB_Backup/
mysql -u root -p monitor < /var/www/html/monitor/DB_Backup/monitor.sql
ufw allow 444
systemctl restart ufw
sudo apt install certbot python3-certbot-nginx
cp  /home/$mdir_maj/etc/nginx/conf.d/* /etc/nginx/conf.d/
mkdir /etc/nginx/ssl
cp  /home/$mdir_maj/etc/nginx/ssl/* /etc/nginx/ssl/
chmod -R 777 /etc/letsencrypt
cp -R etc/letsencrypt/* /etc/letsencrypt/
cp etc/cron.d/* /etc/cron.d
chmod -R 777 /etc/cron.d
systemctl reload nginx
certbot update_symlinks
certbot renew --dry-run



