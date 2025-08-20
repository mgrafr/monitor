#!/usr/bin/bash

# Ce script installe LEMP sur Ubuntu Debian 12.
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
export LANG=fr_FR.UTF-8
export LANGUAGE=fr_FR.UTF-8
export LC_CTYPE=fr_FR.UTF-8
export LC_ALL=fr_FR.UTF-8
export LC_MESSAGES=fr_FR.UTF-8
dpkg-reconfigure locales
whiptail --title "intallation de LEMP PMA et Monitor " --msgbox "Ce script installe automatiquement LEMP fonctionnelle.\nUn serveur SSE-PHP est aussi installé\nVous devrez indiquer\n
- un utilisateur et son mot de pase\n\
- le nom du domaine (par defaut monitor)\n\
- si vous voulez installer PHP-SSH2\n\
- le mot de passe ROOT pour Maria DB\n\
- si vous voulez créer un certificat auto-signé" 15 60
# version à maj ----------------
dosmon=monitor-v3.2.4
vermon=$(whiptail --title "version de monitor" --radiolist \
"Quelle version voulez vous installer ?\n la version en développement\n ou la version LATEST " 15 60 4 \
"Version 3.2.5" "par defaut " ON \
"Version en dev" "voir la doc" OFF 3>&1 1>&2 2>&3)
# ------------------------------
if [ $exitstatus = 0 ]; then
   echo "Vous avez choisi  : $vermon"
else
echo "Vous avez annulé  "
fi
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
server=$(whiptail --title "Domaine du serveur domotique" --inputbox "indiquer le domaine ou simplement 'monitor'"  10 60 3>&1 1>&2 2>&3)
exitstatus=$?
if [ $exitstatus = 0 ]; then
 server_name=$server
 else server_name="monitor"
fi
info "serveur enregistré:" $server_name
#server_name = "monitor"
ssh2=$(whiptail --title "PHP-SSH2" --radiolist \
"Comment voulez vous installer PHP ?\n ssh2 pour la communication avec un serveur distant\n PHP3-SSH2 " 15 60 4 \
"PHP sans SSH2" "par defaut " ON \
"PHP avec SSH2" "voir la doc" OFF 3>&1 1>&2 2>&3)
if [ $exitstatus = 0 ]; then
   echo "Vous avez choisi  : $ssh2"
else
echo "Vous avez annulé  "
fi
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
chemin="/var/www"
sleep 3
apt-get install nginx apache2-utils plocate  -y
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
fail2ban=$(whiptail --title "installer fail2ban ?" --radiolist \
"voulez vous installer Fail2ban ?\n C'est un service qui analyse les logs pour bannir les adresses IP \n ayant un comportement malveillants. " 15 60 4 \
"oui" "par defaut " ON \
"non" "voir la doc" OFF 3>&1 1>&2 2>&3)
if [ $exitstatus = 0 ]; then
   echo "Vous avez choisi  : $fail2ban"
else
echo "Vous avez annulé  "
fi
if [ "$fail2ban" = "oui" ]
then
msg_ok "installation de Fail2ban"
apt install fail2ban
systemctl enable fail2ban
cd /etc/fail2ban
wget ttps://raw.githubusercontent.com/mgrafr/monitor/refs/heads/main/share/fail2ban/fail2ban.local
cd  jail.d
wget https://raw.githubusercontent.com/mgrafr/monitor/refs/heads/main/share/fail2ban/jail.d/jail.local
systemctl start fail2ban
echo "installation terminée de Fail2ban"
fi
apt -y install sshpass
echo -e "${CHECKMARK} \e[1;92m SSHPASS a été installé.\e[0m"
sleep 2
msg_ok "Installation de  php8.3"
sleep 3
#echo "Installer les dependances "
apt install ca-certificates apt-transport-https software-properties-common lsb-release -y
echo "Ajouter le depot pour PHP 8.3 :"
curl -sSL https://packages.sury.org/php/README.txt | sudo bash -x
apt-get update
echo -e "${CHECKMARK} \e[1;92m Dépendances installées.\e[0m"
echo "Installation de PHP 8.3"
apt install php8.3 php8.3-fpm php8.3-cli php8.3-mysql php8.3-curl
echo "Activer le demarrage"
systemctl enable php8.3-fpm --now
echo -e "${CHECKMARK} \e[1;92m PHP8.3 installé.\e[0m"
sleep 3
msg_ok "Installation de PHPMYADMIN"
sleep 3
apt update && apt upgrade
DATA="$(wget https://www.phpmyadmin.net/home_page/version.txt -q -O-)"
URL="$(echo $DATA | cut -d ' ' -f 3)"
VERSION="$(echo $DATA | cut -d ' ' -f 1)"
wget https://files.phpmyadmin.net/phpMyAdmin/${VERSION}/phpMyAdmin-${VERSION}-all-languages.tar.gz
tar xvf phpMyAdmin-${VERSION}-all-languages.tar.gz
mv phpMyAdmin-*/ $chemin/phpmyadmin
cd $chemin/phpmyadmin
mkdir tmp
echo Copie de l exemple de fichier de configuration et ajout de randomBlowfishSecret
echo creation de la blowfish_secret key
randomBlowfishSecret=$(openssl rand -base64 32)
sed -e "s|cfg\['blowfish_secret'\] = ''|cfg['blowfish_secret'] = '$randomBlowfishSecret'|" config.sample.inc.php > config.inc.php
echo Changement de propriété de phpMyAdmin sur maria_name.
sudo chown -R www-data:www-data $chemin/phpmyadmin
echo "définir l’autorisation chmod :"
find $chemin/phpmyadmin/ -type d -exec chmod 755 {} \;
find $chemin/phpmyadmin/ -type f -exec chmod 644 {} \;
rm /etc/nginx/sites-available/*
rm /etc/nginx/sites-enabled/*
# wget https://raw.githubusercontent.com/mgrafr/monitor/main/share/nginx/phpmyadmin.conf
# mv phpmyadmin.conf /etc/nginx/conf.d/
echo "creer lien symbolique de phpMyAdmin vers /www"
mkdir /www
ln -s $chemin/phpmyadmin/  /www/phpmyadmin/
echo -e "${CHECKMARK} \e[1;92m phpMyAdmin installé.\e[0m"
echo "LEMP : redemarrage php"
cd /etc/nginx
nginx -t
sleep 3
systemctl restart php8.3-fpm 
systemctl restart nginx
if [ "$ssh2" = "PHP avec SSH2" ]
then
msg_ok "installation de php-ssh2"
apt install php8.3-ssh2
echo "installation terminée de php8.3-ssh2"
fi
msg_ok "installation de PHP-gd:"
apt install php8.3-gd
msg_ok "installation de dos2unix:"
apt install dos2unix
msg_ok "installation de Unzip:"
apt install unzip
msg_ok "installation de Monitor:"
sleep 3
xxx=$(hostname -I)
ip4=$(echo $xxx | cut -d ' ' -f 1)
if [ "$vermon" = "Version 3.2.4" ]
then
wget -O $chemin/monitor.zip https://github.com/mgrafr/monitor/archive/refs/tags/$dosmon.zip
unzip $chemin/monitor.zip -d $chemin
mv $chemin/monitor-$dosmon/ $chemin/monitor/
rm $chemin/monitor.zip
else
git clone https://github.com/mgrafr/monitor.git $chemin/monitor
fi
# rm $chemin/monitor/install/maj*
echo "importer les tables text_image dispositifs 2fa_token messages et sse" 
sed -i "s/(1, 'user'/(1, '${maria_name}'/g" /var/www/monitor/bd_sql/2fa_token.sql
mysql -root monitor < $chemin/monitor/bd_sql/text_image.sql
mysql -root monitor < $chemin/monitor/bd_sql/dispositifs.sql
mysql -root monitor < $chemin/monitor/bd_sql/sse.sql
mysql -root monitor < $chemin/monitor/bd_sql/messages.sql
mysql -root monitor < $chemin/monitor/bd_sql/2fa_token.sql
echo "LEMP : Configurer NGINX"
echo "LEMP : Création de monitor.conf"
cp $chemin/monitor/share/nginx/default.conf /etc/nginx/conf.d/
sed -i "s/server_name /server_name ${server_name}/g" /etc/nginx/conf.d/default.conf
# sed -i "s/xxxipxxx/${ip4}/g" /etc/nginx/conf.d/monitor.conf
echo "LEMP : Creating a php-info page"
echo '<?php phpinfo(); ?>' > /www/info.php
echo "LEMP est installé"
msg_ok "installation de mysql-connector-python" 
wget https://cdn.mysql.com//Downloads/Connector-Python/mysql-connector-python-9.1.0-src.tar.gz
gzip mysql-connector-python-9.1.0-src.tar.gz -d
tar -x -f mysql-connector-python-9.1.0-src.tar
cd mysql-connector-python-9.1.0-src
cd mysql-connector-python
python3 setup.py build
python3 setup.py install
msg_ok "mysql-connector-python installé" 
echo "Voulez vous créer un certificat auto-signé"
echo "pour utiliser monitor en local en https ? O ou N"
choix_ssl=$(whiptail --title "certificat auto-signé" --radiolist \
"voulez vous installer un certificat auto signé ?\n pour utiliser monitor en local en https" 15 60 4 \
"Pas de certificat  " "par defaut " ON \
"creer un certificat" "voir la doc" OFF 3>&1 1>&2 2>&3)
if [ $exitstatus = 0 ]; then
   echo "Vous avez choisi  : $choix_ssl"
else
echo "Vous avez annulé  "
fi
if [ "$choix_ssl" = "creer un certificat" ]
then
sudo openssl req -x509 -nodes -days 365 -newkey rsa:2048 -keyout /etc/ssl/private/nginx-selfsigned.key -out /etc/ssl/certs/nginx-selfsigned.crt
sudo openssl dhparam -out /etc/ssl/certs/dhparam.pem 2048
wget https://github.com/mgrafr/monitor/tree/main/share/nginx/ssl
cp ssl/selfsigned.conf /etc/nginx/snippets/selfsigned.conf
cp ssl/ssl-params.conf /etc/nginx/snippets/ssl-params.conf
sed -i "s/###//g" /etc/nginx/conf.d/monitor.conf
fi
echo "creer lien symbolique de phpMyAdmin vers /www"
ln -s $chemin/monitor  /www/monitor
echo "Redemarrage NGINX une derniere fois..."
systemctl restart nginx
chown -R $maria_name:$maria_name $chemin/monitor
# chown -R www-data:www-data $chemin/monitor/admin/config.php
chmod -R 775 $chemin/monitor
chmod -R 777 $chemin/monitor/images
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
msg_ok "la clé BlowfishSecret : $randomBlowfishSecret"
msg_ok "le chemin : $chemin"
msg_ok "le lien symbolique : /www/monitor"
sed -i "s/ipmonitor/${ip4}/g" $chemin/monitor/admin/config.php 
sed -i "s/USER_BD/${maria_name}/g" $chemin/monitor/admin/config.php
sed -i "s/PASS_BD/${mp}/g" $chemin/monitor/admin/config.php
sed -i "s/ip_monitor='/ip_monitor='${ip4}/g" $chemin/monitor/admin/connect/connect.lua
sed -i "s/ip_monitor='/ip_monitor='${ip4}/g" $chemin/monitor/admin/connect/connect.py
ln /var/www/monitor/admin/config.php /var/www/monitor/api/conf.php
exit
