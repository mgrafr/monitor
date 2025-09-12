#!/usr/bin/bash
#variables
PHP_VERSION=$(php -r "echo PHP_VERSION;")
PHP_FPM=${PHP_VERSION:0:3} 
#sur le nouveau serveur monitor 
ip3=$(whiptail --title "IP de monitor à mettre à jour" --inputbox "ip de l'ancien CT TOUJOURS exécuté" 10 60 3>&1 1>&2 2>&3)
exitstatus=$?
user_sftp=$(whiptail --title "utilisateur sftp" --inputbox "nom de l'utilisateur autorisé SFTP" 10 60 3>&1 1>&2 2>&3)
exitstatus=$?
pass_sftp=$(whiptail --title "Mot de passe sftp" --inputbox "MOT DE PASSE POUR $user_sftp" 10 60 3>&1 1>&2 2>&3)
exitstatus=$?
mdir_maj=$(whiptail --title "Création d'un réperoire de travail dans 'home'" --inputbox "veuillez entrer le du répertoire \n\n Entrer répertoire" 10 60 3>&1 1>&2 2>&3)
exitstatus=$?
if [ $exitstatus = 0 ]; then
echo "répertoire enregistré : "$mdir_maj
else
mdir_maj=/maj_monitor
echo "Par défaut, répertoire : "$mdir_maj
fi
mkdir -p /home/$mdir_maj/monitor/{admin,custom,DB_Backup,include}
mkdir -p /home/$mdir_maj/monitor/custom/{php,python,js,css,images}
mkdir -p /home/$mdir_maj/etc/{letsencrypt,ssl,ssh,nginx,cron.d}
mkdir -p /home/$mdir_maj/etc/systemd/system
mkdir -p /home/$mdir_maj/root/.ssh
mkdir -p /home/$mdir_maj/etc/nginx/{conf.d,ssl}
#read ip3 < /var/www/monitor/admin/connect/ip.txt
echo "adresse IP old: $ip3"
xxx=$(hostname -I)
ip4=$(echo $xxx | cut -d ' ' -f 1)
echo "adresse IP new : $ip"
echo $ip4 > /home/$mdir_maj/monitor/ip.txt
lets=$(whiptail --title "Certificat Letsencrypt" --radiolist \
"Comment voulez vous mettre à jour monitor ?\n avec les certificat SSL enregistrés\n sans les certificats SSL " 15 60 4 \
"Avec les certificats déjà enregistrés" "par defaut " ON \
"Sans certificats" "voir la doc" OFF 3>&1 1>&2 2>&3)
if [ $exitstatus = 0 ]; then
   echo "Vous avez choisi  : $lets"
else
echo "Vous avez annulé  "
fi
sleep 1
lett=$(whiptail --title "clé SSH" --radiolist \
"Possédez-vous une ou plusieurs clés SSH ? ?\n voulez vous les copier ?" 15 60 4 \
"Copier les clés déjà enregistrées" "par defaut " ON \
"Ne pas copier les clés " "voir la doc" OFF  3>&1 1>&2 2>&3)
if [ $exitstatus = 0 ]; then
   echo "Vous avez choisi  : $lett"
else
echo "Vous avez annulé  "
fi
sleep 1
cle_ssh=$(whiptail --title "Ajout $ip3 sur  .ssh/known_hosts " ---radiolist \
"si $ip3 ne se trouve pas dans le fichier ~/.ssh/known_hosts" 15 60 4 \
"OUI" "par defaut " ON \
"NON"  "          " OFF  3>&1 1>&2 2>&3)
if [ $exitstatus = 0 ]; then
   echo "Vous avez choisi  : $cle_ssh"
   ssh-keyscan -H -t rsa $ip3 >> ~/.ssh/known_hosts  
else
echo "Vous avez annulé  "
fi
cd /home/$mdir_maj/monitor
sshpass -p $pass_sftp sftp $user_sftp@$ip3<<EOF
get /var/www/monitor/index_loc.php
get /var/www/monitor/c.txt
get /var/www/monitor/version_php.txt
lcd admin
get -R /var/www/monitor/admin/* 
lcd ..
lcd custom
get -R /var/www/monitor/custom/*
lcd ..
lcd DB_Backup
get /var/www/monitor/DB_Backup/*
lcd ..
lcd include
get /var/www/monitor/include/header.php
lcd ..
lcd ..
lcd etc/nginx
get /etc/nginx/.htpasswd 
lcd conf.d
get /etc/nginx/conf.d/*
lcd ..
lcd ..
lcd cron.d
get /etc/cron.d/*
lcd ..
lcd systemd/system
get /etc/systemd/system/*
exit
EOF
if [[ "$lets" == "Avec les certificats déjà enregistrés" ]];then
echo $lets
cd /home/$mdir_maj/etc/nginx/ssl
sshpass -p $pass_sftp sftp $user_sftp@$ip3<<EOF
get /etc/nginx/ssl/*
lcd ..
lcd ..
lcd letsencrypt
get -R /etc/letsencrypt/*
lcd ..
lcd ssl
get -R /etc/ssl/*
lcd ..
lcd ssh
get -R /etc/ssh/*
exit
EOF
fi
if [["$lett" == "Copier les clés déjà enregistrées" ]];then
echo $lett
cd /home/$mdir_maj/root/.ssh
pass_root=$(whiptail --title "Mot de passe root" --inputbox "MOT DE PASSE POUR root" 10 60 3>&1 1>&2 2>&3)
exitstatus=$?
sshpass -p $pass_root  sftp root@$ip3<<EOF
get -R /root/.ssl/*
exit
EOF
fi
domaine=`grep $choix'domaine=' /var/www/monitor/admin/connect/connect.py | cut -f 2 -d '='`
echo "domaine : " $domaine
VER_PHP=$(while read line; do echo $line; done < /home/$mdir_maj/monitor/version_php.txt)
sed -i "s/${ip3}/${ip4}/g" /home/$mdir_maj/monitor/admin/config.php 
sed -i "s/.\///g"  /home/$mdir_maj/monitor/systemd/c.txt
sed -i "s/${ip3}/${ip4}/g" /home/$mdir_maj/etc/nginx/conf.d/monitor.conf
sed -i "s/php${VER_PHP}/php${PHP_FPM}/g" /home/$mdir_maj/etc/nginx/conf.d/monitor.conf
sed -i "s/php${VER_PHP}/php${PHP_FPM}/g" /home/$mdir_maj/etc/nginx/conf.d/default.conf
sed -i "s/444/443/g" /home/$mdir_maj/etc/nginx/conf.d/monitor.conf
sed -i "s/${ip3}/${ip4}/g" /home/$mdir_maj/monitor/admin/connect/connect.py
sed -i "s/${ip3}/${ip4}/g" /home/$mdir_maj/monitor/admin/connect/connect.lua
sed -i "s/${ip3}/${ip4}/g" /home/$mdir_maj/monitor/admin/connect/connect.js
sed -i "s/${ip3}/${ip4}/g" /home/$mdir_maj/monitor/admin/connect/connect.yaml
cp /home/$mdir_maj/monitor/admin/connect/connect.py /home/$mdir_maj/monitor/custom/python/connect.py
cp /home/$mdir_maj/monitor/admin/connect/connect.js /home/$mdir_maj/monitor/custom/js/connect.js
nbconf=$(whiptail --title "Autre fichier de Config" --inputbox "si il existe sinon laisser vide" 10 60 3>&1 1>&2 2>&3)
exitstatus=$?
if [ -n "$nbconf" ]
then
sed -i "s/${ip3}/${ip4}/g" /home/$mdir_maj/monitor/admin/$nbconf 
fi
ipiob=$(whiptail --title "IP de ioBroker" --inputbox "si elle existe sinon laisser vide" 10 60 3>&1 1>&2 2>&3)
exitstatus=$?
if [ -n "$ipiob" ]
then
# iobrker pour script py
cd /home/$mdir_maj/monitor/admin/connect
sshpass -p $pass_sftp sftp $user_sftp@$ipiob<<EOF
put connect.py /opt/python/connect.py
exit
EOF
fi
vv=$(pip list --format=json)
echo $vv
cp  -R /home/$mdir_maj/etc/ssl/* /etc/ssl/
cp  -R /home/$mdir_maj/etc/ssh/* /etc/ssh/
mkdir /etc/letsencrypt
cp -R /home/$mdir_maj/etc/letsencrypt/* /etc/letsencrypt/
chmod -R 777 /etc/letsencrypt
rm -R /etc/letsencrypt/live
cd /etc/letsencrypt
mkdir live
chmod -R 777 live
cd archive
for f in * ; do  echo $f;  done > /home/$mdir_maj/a.txt;
while read l; do nb=$(ls /home/$mdir_maj/etc/letsencrypt/archive/$l | wc -l) ;
 a=$((($nb)/4)); echo $a; 
 mkdir /etc/letsencrypt/live/$l;
chmod -R 777 /etc/letsencrypt/live/*;
ln -s /etc/letsencrypt/archive/$l/privkey$a.pem /etc/letsencrypt/live/$l/privkey.pem; 
ln -s /etc/letsencrypt/archive/$l/fullchain$a.pem /etc/letsencrypt/live/$l/fullchain.pem; 
ln -s /etc/letsencrypt/archive/$l/cert$a.pem /etc/letsencrypt/live/$l/cert.pem; 
ln -s /etc/letsencrypt/archive/$l/chain$a.pem /etc/letsencrypt/live/$l/chain.pem; 
done  < /home/$mdir_maj/a.txt
if [ $a = 0 ]; then
echo "erreur  vérifier lles autorisations pour etc/letsencrypt/archive=644"
exit
fi
sleep 2
cp /home/$mdir_maj/monitor/include/header.php /var/www/monitor/include/header.php
cp /home/$mdir_maj/monitor/index_loc.php /var/www/monitor/index_loc.php
cp /home/$mdir_maj/monitor/c.txt /var/www/monitor/c.txt
cp -R /home/$mdir_maj/etc/systemd/system/* /etc/systemd/system/
cp -R /home/$mdir_maj/monitor/custom/python/* /var/www/monitor/custom/python/
cp -R /home/$mdir_maj/monitor/custom/php/* /var/www/monitor/custom/php/
cp -R /home/$mdir_maj/monitor/custom/images/* /var/www/monitor/custom/images/
cp -R /home/$mdir_maj/monitor/custom/js/* /var/www/monitor/custom/js/
cp -R /home/$mdir_maj/monitor/custom/css/* /var/www/monitor/custom/css/
cp -R /home/$mdir_maj/monitor/admin/* /var/www/monitor/admin/
cp /var/www/monitor/admin/connect/connect.py /var/www/monitor/custom/python/
chmod -R 777 /var/www/monitor/DB_Backup
cp /home/$mdir_maj/monitor/DB_Backup/dump.sql.gz /var/www/monitor/DB_Backup/
gunzip -c /var/www/monitor/DB_Backup/dump.sql.gz > dump.sql
mysql -u root -p < dump.sql
# ufw allow 444
# systemctl restart ufw
sudo apt install certbot python3-certbot-nginx -y
cp  /home/$mdir_maj/etc/nginx/conf.d/* /etc/nginx/conf.d/
cp  /home/$mdir_maj/etc/nginx/.htpasswd /etc/nginx/
mkdir /etc/nginx/ssl
cp  /home/$mdir_maj/etc/nginx/ssl/* /etc/nginx/ssl/
chmod -R 777 /etc/cron.d
cp /home/$mdir_maj/etc/cron.d/* /etc/cron.d
systemctl restart nginx
chmod -R 777 /root/.ssl
cp /home/$mdir_maj/root/.ssh/* /root/.ssh
certbot update_symlinks
certbot renew --dry-run
echo "fin de cerbot"
sleep 1
while read L; do
systemctl enable $L
systemctl start $L
done  < /etc/systemd/system/c.txt
sleep 5
mod_py=$(whiptail --title "Installation de module(s) python" --inputbox "Les Modules  doivent être séparés par un espace" 10 60 3>&1 1>&2 2>&3)
exitstatus=$?
if [ -n "$mod_py" ]
then
sudo apt update
sudo apt install $mod_py
fi
