#!/usr/bin/bash
# Ce script installe LEMP sur Ubuntu Debian 11.
echo "Ce script installera automatiquement LEMP fonctionnelle . Vous devez être connecté à Internet "

# Comment this section out and jump down to the next section to set your own defaults for a truly unattended install...
#echo "Avant de commencer l’installation, veuillez entrer un MOT de PASSE ROOT pour MYSQL:"
#read -s mp
#echo "Veuillez confirmer le mot de passe :"
#read -s pq
#while [ $mp != $pq ]; do
 #       echo "Le mot de passe ne correspond pas, veuillez réessayer:"
#        read -s pq
#done
#echo "Mot de passe MYSQL ROOT enregistré"
echo "enregistrer nom du serveur"
echo "indiquer le domaine ou simplement 'monitor'"
read server_name
echo "Server name enregistré"
server_name = "monitor"
echo "LEMP : Debut de l installation"
echo "mise a jour "
apt-get update
echo "Python est normalement installe, pour installer des module , installation de PIP"
apt-get install python3-pip
apt-get install curl
apt-get install git
echo "Installation de maria db"
apt-get install mariadb-server -y
echo "démarrage et activation du service"
systemctl start mariadb
systemctl enable mariadb

echo "securiser MariaDB :"
spawn /usr/local/mysql/bin/mysql_secure_installation
expect "Enter current password for root (enter for none):"
send "$mp\r"
expect "Set root password?"
send "n\r"
#expect "New password:"
#send "\r"
#expect "Re-enter new password:"
#send "password\r"
expect "Remove anonymous users?"
send "y\r"
expect "Disallow root login remotely?"
send "y\r"
expect "Remove test database and access to it?"
send "y\r"
expect "Reload privilege tables now?"
send "y\r"
echo "LEMP INSTALLER: Done saving MySQL secure setup."

echo "Installer NGINX"
apt-get install nginx apache2-utils mlocate  -y
echo "demarrage de Nginx NGINX"
systemctl start nginx

echo "Installer le pare-feu :"
apt-get install ufw
ufw default deny incoming
ufw default allow outgoing
ufw allow ssh
ufw allow http
ufw allow https
ufw enable

echo "Installation de  php8"
echo "Au cas ou apache2 serait actif sur le systeme:"
systemctl disable --now apache2
echo "Installer les dependances "
apt-get install ca-certificates apt-transport-https software-properties-common 
wget curl lsb-release
echo "Ajouter le depot pour PHP 8.2 :"
curl -sSL https://packages.sury.org/php/README.txt | bash -x
apt-get update
echo "Installation de PHP 8.2"
apt-get install php8.2 php8.2-fpm php8.2-cli php-mysql php-zip php-curl php-xml php-gd php-json php-bcmath php-mbstring php-apcu -y
echo "Activer le demarrage"
systemctl enable php8.2-fpm
echo "Installer PHPMYADMIN"
echo "installation du référentiel"
echo "deb http://deb.debian.org/debian bullseye-backports main" > /etc/apt/sources.list.d/bullseye-backports.list
apt-get update && apt-get -t buster-backports install iptables
apt install php-bz2 php-tcpdf php-phpmyadmin-shapefile php-twig-i18n-extension
apt-get install -t bullseye-backports phpmyadmin
echo "Creer un lien symbolique depuis les fichiers d'installation vers le repertoire des pages PHP"
ln -s /usr/share/phpmyadmin /usr/share/nginx/html

echo "LEMP : Adjustement php listen"
#sed -i 's/listen = 127.0.0.1:9000/listen=/var/run/php/php-fpm.sock/g' /etc/php/8.2/fpm/pool.d/www.conf
cp * /etc/nginx/conf.d
rm /etc.nginx/sites-available/*
rm /etc.nginx/sites-enabled/*
echo "LEMP : redemarrage php"
service php8.2-fpm restart
echo "creer lien symbolique des pages PHP vers /www"
mkdir /www
ln -s /usr/share/nginx/html/  /www/
echo "installation de Monitor:"
git clone https://github.com/mgrafr/monitor.git /usr/share/nginx/html/monitor
echo "LEMP : Configurer NGINX"
echo "LEMP : Création de default.conf"
cp /usr/share/nginx/html/monitor/Nginx/default.conf /etc/nginx/conf.d
sed -i "s/server_name /server_name $server/g" /etc/nginx/conf.d/default.conf
#sed -i 's/index index.html index.htm/index index.php index.html index.htm/g' /etc/nginx/sites-available/default
echo "LEMP : Creating a php-info page"
echo '<?php phpinfo(); ?>' > /usr/share/nginx/html/info.php
echo "LEMP INSTALLER: Redemarrage NGINX une derniere fois..."
systemctl restart nginx
echo "LEMP :configuration complete"


exit
