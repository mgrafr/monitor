#!/usr/bin/bash
# Ce script installe LEMP sur Ubuntu Debian 11.
echo "Ce script installera automatiquement LEMP fonctionnelle . Vous devez être connecté à Internet "
#Comment this section out and jump down to the next section to set your own defaults for a truly unattended install...
echo "Avant de commencer l’installation, veuillez entrer un utlisateur et son MOT de PASSE  pour MYSQL:"
echo "indiquer le nom de l'utilisateur de Maria db : "
read maria_name
echo "Utilisateur maria db  enregistré"
echo "Mot de passe pour "$maria_name
read -s mp
echo "Veuillez confirmer le mot de passe :"
while [ $mp != $pq ]; do
read -s pq
       echo "Le mot de passe ne correspond pas, veuillez réessayer:"
       read -s pq
done
echo "Mot de passe MYSQL ROOT enregistré"
echo "enregistrer nom du serveur"
echo "indiquer le domaine ou simplement 'monitor'"
read server_name
echo "Server name enregistré"
#server_name = "monitor"
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
echo "----------------------------------------------------"
echo "Maria db création de la base monitor."
mysql -uroot  -e "CREATE DATABASE monitor CHARACTER SET UTF8;"
echo "Création de l'utilisateur : "$maria_name
mysql -uroot  -e "CREATE USER '${maria_name}'@'%' IDENTIFIED BY '${mp}'; "
echo "fournir tous les privilèges à " $maria_name
mysql -uroot  -e "GRANT ALL PRIVILEGES ON *.* TO '${maria_name}'@'%';"
mysql -uroot  -e "flush privileges";
echo "----------------------------------------------------"
echo "securiser MariaDB : définir le Mot de passe pour Root"
read root_pwd
mysql -sfu --user='root' --password='$root_pwd' --database="$database" -e "UPDATE mysql.user SET Password=PASSWORD('${root_pwd}') WHERE User='root';"
echo "-- supprimer les utilisateurs anonymes"
mysql -sfu --user='root' --password='$root_pwd' -e "DELETE FROM mysql.user WHERE User='';"
echo "-- supprimer les fonctionnalités root distantes"
mysql -sfu --user='root' --password='$root_pwd' -e "DELETE FROM mysql.user WHERE User='root' AND Host NOT IN ('localhost', '127.0.0.1', '::1');"
echo "-- supprimer le 'test' de la base de données"
mysql -sfu --user='root' --password='$root_pwd' -e "DROP DATABASE IF EXISTS test;"
echo "-- s'assurer qu'il n'existe pas des autorisations persistantes"
mysql -sfu --user='root' --password='$root_pwd' -e "DELETE FROM mysql.db WHERE Db='test' OR Db='test\\_%';"
mysql -sfu --user='root' --password='$root_pwd' -e "FLUSH PRIVILEGES;"
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
echo "creer lien symbolique des pages PHP vers /www"
mkdir /www
ln -s /usr/share/nginx/html/  /www/
echo "installation de Monitor:"
git clone https://github.com/mgrafr/monitor.git /usr/share/nginx/html/monitor
echo "importer les tables text_image et dispositifs"
mysql -root monitor < /www/html/monitor/bd_sql/text_image.sql
mysql -root monitor < /www/html/monitor/bd_sql/dispositifs.sql
echo "LEMP : Configurer NGINX"
echo "LEMP : Création de default.conf"
cp /usr/share/nginx/html/monitor/share/nginx/default.conf /etc/nginx/conf.d
sed -i "s/server_name /server_name ${server_name}/g" /etc/nginx/conf.d/default.conf
echo "LEMP : Creating a php-info page"
echo '<?php phpinfo(); ?>' > /usr/share/nginx/html/info.php
echo "LEMP INSTALLER: Redemarrage NGINX une derniere fois..."
systemctl restart nginx
xxx=$(hostname -I)
ip4=$(echo $xxx | cut -d ' ' -f 1)
echo "ip="$ip4
sed -i "s/define('IPMONITOR', 'ip/define('IPMONITOR', '${ip4}/g" /usr/share/nginx/html/monitor/admin/config.php 
sed -i "s/USER_BD/${maria_name}/g" /usr/share/nginx/html/monitor/admin/config.php
sed -i "s/PASS_BD/${mp}/g" /usr/share/nginx/html/monitor/admin/config.php
echo "LEMP :configuration complete"


exit
