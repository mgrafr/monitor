#!/usr/bin/bash
# Ce script installe LEMP sur Ubuntu Debian 11.
echo "Ce script installera automatiquement LEMP fonctionnelle . Vous devez être connecté à Internet "
#Comment this section out and jump down to the next section to set your own defaults for a truly unattended install...
echo "Avant de commencer l’installation, veuillez entrer un utlisateur et son MOT de PASSE  pour MYSQL:"
echo "indiquer le nom de l'utilisateur systeme : "
read maria_name
adduser $maria_name 
usermod -aG sudo $maria_name
echo "Utilisateur système enregistré et ajouté au groupe SUDO"
echo "Mot de passe de " $maria_name pour mariaDB et Monitor
read -s mp
echo "Veuillez confirmer le mot de passe :"
while [ $mp != $pq ]; do
read -s pq
       echo "Le mot de passe ne correspond pas, veuillez réessayer:"
       read -s pq
done
echo "Mot de passe MYSQL et Monitor enregistré "
echo "enregistrer nom du serveur"
echo "indiquer le domaine ou simplement 'monitor'"
read server_name
echo "Server name enregistré"
#server_name = "monitor"
echo "voulez vous installer ssh2 dans PHP ?"
echo "SSH2 est nécessaire pour effectuer des commandes bash sur des serveurs distants;"
echo "par exemple rebooter un PC distant ,.....repondre O(oui) ou N(non)"
read choix_ssh2
echo "LEMP : Debut de l installation"
echo "mise a jour "
apt-get update
echo "Python est normalement installe, pour installer des module , installation de PIP"
apt-get install sudo
apt-get install python3-pip
apt-get install curl
apt-get install git
echo "Installation de maria db"
apt-get install mariadb-server -y
echo "démarrage et activation du service"
systemctl start mariadb
systemctl enable mariadb
echo "----------------------------------------------------"
echo "Maria db création de la base monitor."
mysql -uroot  -e "CREATE DATABASE monitor CHARACTER SET UTF8;"
echo "Création de l'utilisateur : "$maria_name
mysql -uroot  -e "CREATE USER '${maria_name}'@'%' IDENTIFIED BY '${mp}'; "
echo "fournir tous les privilèges à " $maria_name
mysql -uroot  -e "GRANT ALL PRIVILEGES ON *.* TO '${maria_name}'@'%';"
mysql -uroot  -e "flush privileges";
echo "----------------------------------------------------"
echo "securiser MariaDB : Entrer Mot de passe ROOT"
read root_pwd
#mysql --user="root" --password="$root_pwd" --database="monitor" --execute="ALTER USER 'root'@'localhost' IDENTIFIED BY '$root_pwd';"
mysql --user="root" --database="monitor" -e  "SET PASSWORD FOR 'root'@'localhost' = PASSWORD('$root_pwd');"
mysql --user="root" --database="monitor" -e "UPDATE user SET plugin='mysql_native_password' WHERE User='root';"
mysql --user="root" --password="$root_pwd"  -e "DELETE FROM mysql.user WHERE User='';"
echo "-- supprimer les fonctionnalités root distantes"
mysql --user="root" --password="$root_pwd"  -e "DELETE FROM mysql.user WHERE User='root' AND Host NOT IN ('localhost', '127.0.0.1', '::1');"
echo "-- supprimer le 'test' de la base de données"
mysql --user="root" --password="$root_pwd"  -e "DROP DATABASE IF EXISTS test;"
echo "-- s'assurer qu'il n'existe pas des autorisations persistantes"
mysql --user="root" --password="$root_pwd"  -e "DELETE FROM mysql.db WHERE Db='test' OR Db='test\\_%';"
mysql --user="root" --password="$root_pwd"  -e "FLUSH PRIVILEGES;"
echo "----------------------------------------------------"
echo "MariaDB est maintenant sécurisée"
echo "----------------------------------------------------"
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
rm /etc/nginx/sites-available/*
rm /etc/nginx/sites-enabled/*
echo "LEMP : redemarrage php"
service php8.2-fpm restart
if [ "$choix_ssh2" = "Y" ]
then
echo "installation de php8.2-ssh2"
apt install php8.2-ssh2
echo "installation terminée de ssh2"
fi
echo "creer lien symbolique des pages PHP vers /www"
mkdir /www
ln -s /usr/share/nginx/html/  /www/
echo "installation de Monitor:"
xxx=$(hostname -I)
ip4=$(echo $xxx | cut -d ' ' -f 1)
git clone https://github.com/mgrafr/monitor.git /usr/share/nginx/html/monitor
echo "importer les tables text_image et dispositifs"
mysql -root monitor < /www/html/monitor/bd_sql/text_image.sql
mysql -root monitor < /www/html/monitor/bd_sql/dispositifs.sql
echo "LEMP : Configurer NGINX"
echo "LEMP : Création de monitor.conf"
cp /usr/share/nginx/html/monitor/share/nginx/monitor.conf /etc/nginx/conf.d
sed -i "s/server_name /server_name ${server_name}/g" /etc/nginx/conf.d/monitor.conf
echo "LEMP : Creating a php-info page"
echo '<?php phpinfo(); ?>' > /usr/share/nginx/html/info.php
echo "LEMP est installé" 
echo "Voulez vous créer un certificat auto-signé"
echo "pour utiliser monitor en local en https ? O ou N"
read choix_ssl
if [ "$choix_ssl" = "O" ]
then
sudo openssl req -x509 -nodes -days 365 -newkey rsa:2048 -keyout /etc/ssl/private/nginx-selfsigned.key -out /etc/ssl/certs/nginx-selfsigned.crt
sudo openssl dhparam -out /etc/ssl/certs/dhparam.pem 2048
wget https://github.com/mgrafr/monitor/tree/main/share/nginx/ssl
cp ssl/selfsigned.conf /etc/nginx/snippets/selfsigned.conf
cp ssl/ssl-params.conf /etc/nginx/snippets/ssl-params.conf
sed -i "s/###//g" /etc/nginx/conf.d/monitor.conf
fi
echo "Redemarrage NGINX une derniere fois..."
systemctl restart nginx
echo "ip du serveur = "$ip4
sed -i "s/define('IPMONITOR', 'ip/define('IPMONITOR', '${ip4}/g" /usr/share/nginx/html/monitor/admin/config.php 
sed -i "s/USER_BD/${maria_name}/g" /usr/share/nginx/html/monitor/admin/config.php
sed -i "s/PASS_BD/${mp}/g" /usr/share/nginx/html/monitor/admin/config.php
echo "LEMP :configuration complete"

exit