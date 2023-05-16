#!/usr/bin/bash
# Ce script installe LEMP sur Ubuntu Debian 11.
function header_info {
clear
cat <<"EOF"
    _______                 _
   / __  _ \___________ ( )/ /_ __________
  / / / / / / __  / ___\/ / __// __  / __|
 / / / / / / /_/ / / / / / /__/ /_/ / / 
/_/ /_/ /_/_____/_/ /_/_/____/_____/_/
                                                   
EOF
}
color() {
 BL=$(echo "\033[36m")
 BGN=$(echo "\033[4;92m")
 DGN=$(echo "\033[32m")
 CL=$(echo "\033[m")
 BFR="\\r\\033[K"
 GN=$(echo "\033[1;92m")
 CM="${GN}✓${CL}"
 }
 msg_ok() {
  local msg="$1"
  echo -e "${BFR} ${CM} ${GN}${msg}${CL}"
}
 
CHECKMARK='\033[0;32m\xE2\x9C\x94\033[0m' 
function info() {
  local REASON="$1"
  local FLAG="\e[36m[INFO]\e[39m"
  msg "$FLAG $REASON"
} 
whiptail --title "intallation de LEMP et Monitor" --msgbox "Ce script installer automatiquement LEMP fonctionnelle.\nVous devrez indiquer\n
- un utilisateur et son mot de pase\n\
- le nom du domaine (par defaut monitor)\n\
- si vous voulez installer PHP-SSH2\n\
- le mot de passe ROOT pour Maria DB\n\
- si vous voulez créer un certificat auto-signé" 15 60
maria_name=$(whiptail --title "Utilisateur MariaDB et Monitor" --inputbox "veuillez entrer un utlisateur et son MOT de PASSE  pour MYSQL & Monitor\n\n Entrer le nom de l'utilisateur" 10 60 3>&1 1>&2 2>&3)
exitstatus=$?
if [ $exitstatus = 0 ]; then
echo "Utlisateur enregistré : "$maria_name
else
maria_name=monitor
echo "Par défaut, utlisateur enregistré : "$maria_name
fi 
adduser $maria_name
usermod -aG sudo $maria_name
echo "Utilisateur "$maria_name "enregistré et ajouté au groupe SUDO"
server=$(whiptail --title "nom du serveur domotique" --inputbox "indiquer le domaine ou simplement 'monitor'"  10 60 3>&1 1>&2 2>&3)
exitstatus=$?
if [ $exitstatus = 0 ]; then
 server_name=$server
 else server_name="monitor"
fi
info "serveur enregistré:" $server_name
#server_name = "monitor"
ssh2=$(whiptail --title "PHP-SSH2" --checklist \
"Comment voulez vous installer PHP ?\n ssh2 pour la communication avec un serveur distant" 15 60 4 \
"PHP sans SSH2" "par defaut " ON \
"PHP avec SSH2" "voir la doc" OFF 3>&1 1>&2 2>&3)
color
info "LEMP : Debut de l installation"
info "mmaj debian ,installation de sudo curl git pip"
apt-get update
apt-get upgrade
echo -e "${CHECKMARK} \e[1;92m Debian a ete mis à jour.\e[0m"
#echo "Python est normalement installe, pour installer des module , installation de PIP"
dpkg-reconfigure locales 
apt-get install sudo
apt-get install python3-pip
apt-get install curl
apt-get install git
info "Installation de maria db"
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
root_pwd=$(whiptail --title "securiser MariaDB" --passwordbox "Entrer le mot de passe ROOT" 10 60 3>&1 1>&2 2>&3)
exitstatus=$?
if [ $exitstatus = 0 ]; then
 info "Mot de passe enregistré"
fi
info "securisation de mariaDB effectuée"
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
if [ "$ssh2" = "PHP avec SSH2" ]
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
choix_ssl=$(whiptail --title "certificat auto-signé" --checklist \
"voulez vous installer un certificat ato signé ?\n pour utiliser monitor en local en https" 15 60 4 \
"Pas de certificat  " "par defaut " ON \
"creer un certificat" "voir la doc" OFF 3>&1 1>&2 2>&3)
if [ "$choix_ssl" = "creer un certificat" ]
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
header_info
msg_ok "ip du serveur = $ip4"
sed -i "s/define('IPMONITOR', 'ip/define('IPMONITOR', '${ip4}/g" /usr/share/nginx/html/monitor/admin/config.php 
sed -i "s/USER_BD/${maria_name}/g" /usr/share/nginx/html/monitor/admin/config.php
sed -i "s/PASS_BD/${mp}/g" /usr/share/nginx/html/monitor/admin/config.php
exit