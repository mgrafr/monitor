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
 function msg() {
  local TEXT="$1"
  echo -e "$TEXT"
}
CHECKMARK='\033[0;32m\xE2\x9C\x94\033[0m' 
STD=""
function info() {
  local REASON="$1"
  local FLAG="\e[36m[INFO]\e[39m"
  msg "$FLAG $REASON"
} 
dpkg-reconfigure locales
whiptail --title "intallation de LEMP PMA et Monitor" --msgbox "Ce script installe automatiquement LEMP fonctionnelle.\nVous devrez indiquer\n
- un utilisateur et son mot de pase\n\
- le nom du domaine (par defaut monitor)\n\
- si vous voulez installer PHP-SSH2\n\
- le mot de passe ROOT pour Maria DB\n\
- si vous voulez créer un certificat auto-signé" 15 60
maria_name=$(whiptail --title "Création d'un utilisateur " --inputbox "veuillez entrer un utlisateur et son MOT de PASSE \n\n Entrer le nom de l'utilisateur" 10 60 3>&1 1>&2 2>&3)
exitstatus=$?
if [ $exitstatus = 0 ]; then
info "Utlisateur enregistré : "$maria_name
else
maria_name=monitor
info "Par défaut, utlisateur enregistré : "$maria_name
fi 
adduser $maria_name
usermod -aG sudo $maria_name
info "Utilisateur "$maria_name "enregistré et ajouté au groupe SUDO"
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
info "LEMP : Debut de l installation"
info "mmaj debian ,installation de sudo curl git pip"
$STD apt-get update 
$STD apt-get upgrade
echo -e "${CHECKMARK} \e[1;92m Debian a ete mis à jour.\e[0m"
sleep 3
#echo "Python est normalement installe, pour installer des module , installation de PIP"
msg_ok "Updating Python"
$STD apt-get install sudo curl git python3-pip -y 
msg_ok "Installation de maria db"
echo -e "${CHECKMARK} \e[1;92m Debut installation de Maria DB.\e[0m"
sleep 3
apt-get install mariadb-server -y
echo "démarrage et activation du service"
systemctl start mariadb
systemctl enable mariadb
echo "----------------------------------------------------"
msg_ok "Maria db création de la base monitor."
mp=$(whiptail --title "MariaDB mot de passe Utilisateur" --passwordbox "Entrer le mot de passe MariaDB pour $maria_name" 10 60 3>&1 1>&2 2>&3)
exitstatus=$?
if [ $exitstatus = 0 ]; then
 info "Mot de passe enregistré"
fi
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
 info "Mot de passe root pour $maria_name enregistré"
fi
info "securisation de mariaDB"
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
msg_ok "MariaDB est maintenant sécurisée"
echo "----------------------------------------------------"
msg_ok "Installation de NGINX"
echo "----------------------------------------------------"
chemin="/usr/share/nginx/html"
sleep 3
apt-get install nginx apache2-utils mlocate  -y
echo "demarrage de Nginx NGINX"
systemctl start nginx
echo "Au cas ou apache2 serait actif sur le systeme:"
if [ -f "/etc/systemd/system/apache2.service" ]; then
systemctl disable --now apache2
fi
echo -e "${CHECKMARK} \e[1;92m NGINX a été installé.\e[0m"
sleep 3
msg_ok "Installation du pare-feu :"
sleep 3
apt-get install ufw
ufw default deny incoming
ufw default allow outgoing
ufw allow ssh
ufw allow http
ufw allow https
ufw enable
echo -e "${CHECKMARK} \e[1;92m Le pare-feu a été installé.\e[0m"
msg_ok "Installation de  php8"
sleep 3
#echo "Installer les dependances "
apt-get install ca-certificates apt-transport-https software-properties-common 
echo "Ajouter le depot pour PHP 8.2 :"
apt-get update
echo -e "${CHECKMARK} \e[1;92m Dépendances installées.\e[0m"
echo "Installation de PHP 8.2"
apt-get install php8.2 php8.2-fpm php8.2-cli php-mysql php-zip php-curl php-xml php-gd php-json php-bcmath php-mbstring php-apcu -y
echo "Activer le demarrage"
systemctl enable php8.2-fpm
echo -e "${CHECKMARK} \e[1;92m PHP8.2 installé.\e[0m"
sleep 3
msg_ok "Installation de PHPMYADMIN"
sleep 3
DATA="$(wget https://www.phpmyadmin.net/home_page/version.txt -q -O-)"
URL="$(echo $DATA | cut -d ' ' -f 3)"
VERSION="$(echo $DATA | cut -d ' ' -f 1)"
wget https://files.phpmyadmin.net/phpMyAdmin/${VERSION}/phpMyAdmin-${VERSION}-all-languages.tar.gz
tar xvf phpMyAdmin-${VERSION}-all-languages.tar.gz
mv phpMyAdmin-*/ $chemin/phpmyadmin
mkdir -p $chemin/phpmyadmin/tmp
echo -e "${CHECKMARK} \e[1;92m phpMyAdmin installé.\e[0m"
#echo "LEMP : Adjustement php listen"
#sed -i 's/listen = 127.0.0.1:9000/listen=/var/run/php/php-fpm.sock/g' /etc/php/8.2/fpm/pool.d/www.conf
rm /etc/nginx/sites-available/*
rm /etc/nginx/sites-enabled/*
echo "LEMP : redemarrage php"
service php8.2-fpm restart
if [ "$ssh2" = "PHP avec SSH2" ]
then
msg_ok "installation de php8.2-ssh2"
apt install php8.2-ssh2
echo "installation terminée de ssh2"
fi
echo "creer lien symbolique des pages PHP vers /www"
mkdir /www
ln -s $chemin/  /www
msg_ok "installation de Monitor:"
sleep 3
xxx=$(hostname -I)
ip4=$(echo $xxx | cut -d ' ' -f 1)
git clone https://github.com/mgrafr/monitor.git $chemin/monitor

echo "importer les tables text_image et dispositifs"
mysql -root monitor < /www/html/monitor/bd_sql/text_image.sql
mysql -root monitor < /www/html/monitor/bd_sql/dispositifs.sql
echo "LEMP : Configurer NGINX"
echo "LEMP : Création de monitor.conf"
cp $chemin/monitor/share/nginx/monitor.conf /etc/nginx/conf.d/
sed -i "s/server_name /server_name ${server_name}/g" /etc/nginx/conf.d/monitor.conf
sed -i "s/xxxipxxx/${ip4}/g" /etc/nginx/conf.d/monitor.conf
echo "LEMP : Creating a php-info page"
echo '<?php phpinfo(); ?>' > $chemin/info.php
echo "LEMP est installé" 
echo "Voulez vous créer un certificat auto-signé"
echo "pour utiliser monitor en local en https ? O ou N"
choix_ssl=$(whiptail --title "certificat auto-signé" --checklist \
"voulez vous installer un certificat auto signé ?\n pour utiliser monitor en local en https" 15 60 4 \
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
chmod -R 777 /usr/share/nginx/html
echo -e "
    _______                 _
   / __  _ \___________ ( )/ /_ __________
  / / / / / / __  / ___\/ / __// __  / __|
 / / / / / / /_/ / / / / / /__/ /_/ / / 
/_/ /_/ /_/_____/_/ /_/_/____/_____/_/
...proposé par : https://github.com/mgrafr/monitor\n" >/etc/motd
          
header_info
msg_ok "ip du serveur = $ip4"
msg_ok "nom de l'utilisateur mariadb & monitor = $maria_name"
sed -i "s/ipmonitor/${ip4}/g" $chemin/monitor/admin/config.php 
sed -i "s/USER_BD/${maria_name}/g" $chemin/monitor/admin/config.php
sed -i "s/PASS_BD/${mp}/g" $chemin/monitor/admin/config.php
exit
