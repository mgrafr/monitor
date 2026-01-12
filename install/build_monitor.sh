#!/usr/bin/env bash

color() {
  GN=$(echo "\033[1;92m")
  BL=$(echo "\033[36m")
  YW=$(echo "\033[33m")
  CL=$(echo "\033[m")
 }
 formatting() {
  CM="  ✔️  "
}
color
formatting

echo -e "${CM}${GN} Démarrage du conteneur LXC ...${CL} "
pct start $CTID
echo -e "${CM} ${BL} Configuration de la locale  ${GN}fr_FR${CL}"
dpkg-reconfigure locales
echo -e "${CM} ${BL} Installation de LEMP... ${CL}" 
whiptail --title "intallation de LEMP PMA et Monitor " --msgbox "Ce script installe automatiquement LEMP fonctionnelle.\nUn serveur SSE-PHP est aussi installé\nVous devrez indiquer\n
- un utilisateur et son mot de pase\n\
- le nom du domaine (par defaut monitor)\n\
- si vous voulez installer PHP-SSH2\n\
- le mot de passe ROOT pour Maria DB\n\
- si vous voulez créer un certificat auto-signé" 15 60
# version à maj ----------------
dosmon=monitor-v4.1.1
echo -e "${GN} version de monitor:${YW} ${dosmon}${CL}"
vermon=$(whiptail --title "version de monitor" --radiolist \
"Quelle version voulez vous installer ?\n la version en développement\n ou la version LATEST " 15 60 4 \
"Version 4.1.1" "par defaut " ON \
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
echo -e "${GN} Utlisateur enregistré :${YW} ${maria_name}${CL}"
else
maria_name=monitor
echo -e "${CM} ${GN} Par défaut, utlisateur enregistré : ${YW} ${maria_name}${CL}"
fi 
adduser $maria_name
usermod -aG sudo $maria_name
echo -e "${CM}${GN} Utilisateur ${YW}"$maria_name "enregistré et ajouté au groupe SUDO${CL}"
server=$(whiptail --title "Domaine du serveur domotique" --inputbox "indiquer le domaine ou simplement 'monitor'"  10 60 3>&1 1>&2 2>&3)
exitstatus=$?
if [ $exitstatus = 0 ]; then
 server_name=$server
 else server_name="monitor"
fi
echo -e "${CM} ${GN} serveur enregistré:${YW} ${server_name}${CL}"
#server_name = "monitor"
ssh2=$(whiptail --title "PHP-SSH2" --radiolist \
"Comment voulez vous installer PHP ?\n ssh2 pour la communication avec un serveur distant\n PHP3-SSH2 " 15 60 4 \
"PHP sans SSH2" "par defaut " ON \
"PHP avec SSH2" "voir la doc" OFF 3>&1 1>&2 2>&3)
if [ $exitstatus = 0 ]; then
echo -e "${CM} ${BL} Vous avez choisi  :${GN} ${ssh2}${CL}"
else
echo "Vous avez annulé  "
fi
echo -e "${BL} LEMP : Debut de l installation${CL}"
echo -e "${CM}${GN} mmaj debian ,installation de sudo curl git pip${CL}"
apt-get update 
apt-get upgrade
echo -e "${CM}${GN} \e[1;92m Debian a ete mis à jour.${CL}"
sleep 3
#echo "Python est normalement installe, pour installer des module , installation de PIP"
echo -e "${CM}${GN} Updating Python${CL}"
apt-get install sudo curl git python3-pip -y 
echo -e "${GN} Installation de maria db${CL}"
echo -e "${CM}${GN}  Debut installation de Maria DB.${CL}"
sleep 3
sudo apt install mariadb-server
sudo apt install mariadb-client-compat
echo -e "${CM}${GN} démarrage et activation du service${CL}"
systemctl start mariadb
systemctl enable mariadb
echo -e "${BL} Maria db création de la base monitor.${CL}"
mp=$(whiptail --title "MariaDB mot de passe Utilisateur" --passwordbox "Entrer le mot de passe MariaDB pour $maria_name" 10 60 3>&1 1>&2 2>&3)
exitstatus=$?
if [ $exitstatus = 0 ]; then
echo -e "${CM}${GN} Mot de passe enregistré${CL}"
fi
mysql -uroot  -e "CREATE DATABASE monitor CHARACTER SET UTF8;"
echo -e "${CM}${GN} Création de l'utilisateur : ${YW}${maria_name}${CL}"
mysql -uroot  -e "CREATE USER '${maria_name}'@'%' IDENTIFIED BY '${mp}'; "
echo -e "${CM}${GN} fournir tous les privilèges à  ${YW}${maria_name}"
mysql -uroot  -e "GRANT ALL PRIVILEGES ON *.* TO '${maria_name}'@'%';"
mysql -uroot  -e "flush privileges";
root_pwd=$(whiptail --title "securiser MariaDB" --passwordbox "Entrer le mot de passe ROOT" 10 60 3>&1 1>&2 2>&3)
exitstatus=$?
if [ $exitstatus = 0 ]; then
echo -e "${CM}${GN} Mot de passe root enregistré${CL}"
fi
echo -e "${BL} securisation de mariaDB${CL}"
#mysql --user="root" --password="$root_pwd" --database="monitor" --execute="ALTER USER 'root'@'localhost' IDENTIFIED BY '$root_pwd';"
mysql --user="root" --database="monitor" -e  "SET PASSWORD FOR 'root'@'localhost' = PASSWORD('$root_pwd');"
mysql --user="root" --database="monitor" -e "ALTER USER 'root'@'localhost' IDENTIFIED BY '$root_pwd';"
mysql --user="root" --password="$root_pwd"  -e "DELETE FROM mysql.user WHERE User='';"
echo "-- supprimer les fonctionnalités root distantes"
mysql --user="root" --password="$root_pwd"  -e "DELETE FROM mysql.user WHERE User='root' AND Host NOT IN ('localhost', '127.0.0.1', '::1');"
echo "-- supprimer le 'test' de la base de données"
mysql --user="root" --password="$root_pwd"  -e "DROP DATABASE IF EXISTS test;"
echo "-- s'assurer qu'il n'existe pas des autorisations persistantes"
mysql --user="root" --password="$root_pwd"  -e "DELETE FROM mysql.db WHERE Db='test' OR Db='test\\_%';"
mysql --user="root" --password="$root_pwd"  -e "FLUSH PRIVILEGES;"
echo "----------------------------------------------------"
echo -e "${CM}${GN} MariaDB est maintenant sécurisée${CL}"
echo -e "${BL} Installation de NGINX${CL}"
chemin="/var/www"
sleep 3
apt update
apt install nginx apache2-utils plocate  -y
echo -e "${CM}${GN} démarrage de Nginx NGINX ${CL}"
systemctl start nginx
# "Au cas ou apache2 serait actif sur le systeme:"
if [ -f "/etc/systemd/system/apache2.service" ]; then
systemctl disable --now apache2
fi
sleep 3
echo -e "${GN}Installation du pare-feu :${CL}"
sleep 3
apt-get install ufw
ufw default deny incoming
ufw default allow outgoing
ufw allow ssh
ufw allow http
ufw allow https
ufw enable
echo -e "${CM}${GN}  Le pare-feu a été installé.${CL}"
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
echo -e "${GN} installation de Fail2ban${CL}"
apt install fail2ban
systemctl enable fail2ban
cd /etc/fail2ban
wget ttps://raw.githubusercontent.com/mgrafr/monitor/refs/heads/main/share/fail2ban/fail2ban.local
cd  jail.d
wget https://raw.githubusercontent.com/mgrafr/monitor/refs/heads/main/share/fail2ban/jail.d/jail.local
systemctl start fail2ban
echo -e "${CM}${GN} installation terminée de Fail2ban${CL}"
fi
apt -y install sshpass
echo -e "${GN} \e[1;92m SSHPASS a été installé.${CL}"
sleep 2
echo -e "${BL} Installation de  php8.4${CL}"
sleep 3
# Add the packages.sury.org/php repository.
apt-get install -y lsb-release ca-certificates apt-transport-https curl
curl -sSLo /tmp/debsuryorg-archive-keyring.deb https://packages.sury.org/debsuryorg-archive-keyring.deb
dpkg -i /tmp/debsuryorg-archive-keyring.deb
sh -c 'echo "deb [signed-by=/usr/share/keyrings/debsuryorg-archive-keyring.gpg] https://packages.sury.org/php/ $(lsb_release -sc) main" > /etc/apt/sources.list.d/php.list'
apt-get update
echo -e "${CM}${GN}  Dépendances installées.${CL}"
echo -e "${CM}${GN} Installation de PHP 8.4${CL}"
# Install PHP.
apt-get install -y php8.4 php8.4-fpm php8.4-cli php8.4-mysql php8.4-curl
echo -e "${CM}${GN} Activer le demarrage de PHP ${CL}"
systemctl enable php8.4-fpm --now
echo -e "${CM}${GN}  PHP8.4 installé.${CL}"
sleep 3
echo -e "${BL} Installation de PHPMYADMIN${CL}"
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
echo -e "${CM}${GN} creer lien symbolique de phpMyAdmin vers /www${CL}"
mkdir /www
ln -s $chemin/phpmyadmin/  /www/phpmyadmin
echo -e "${CM}${GN} phpMyAdmin installé.${CL}"
echo -e "${CM}${GN} LEMP : redemarrage php${CL}"
cd /etc/nginx
nginx -t
sleep 3
systemctl restart php8.4-fpm 
systemctl restart nginx
if [ "$ssh2" = "PHP avec SSH2" ]
then
echo -e "${BL} installation de php-ssh2${CL}"
apt install php8.4-ssh2
echo -e "${CM}${GN} installation terminée de php8.4-ssh2${CL}"
fi
echo -e "${CM}${GN} installation de PHP-gd:${CL}"
apt install php8.4-gd
echo -e "${CM}${GN}  installation de dos2unix:${CL}"
apt install dos2unix
echo -e "${CM}${GN}  installation de Unzip:${CL}"
apt install unzip
echo -e "${BL}  installation de Monitor:${CL}"
sleep 3
xxx=$(hostname -I)
ip4=$(echo $xxx | cut -d ' ' -f 1)
if [ "$vermon" = "Version 4.1.1" ]
then
wget -O $chemin/monitor.zip https://github.com/mgrafr/monitor/archive/refs/tags/$dosmon.zip
unzip $chemin/monitor.zip -d $chemin
mv $chemin/monitor-$dosmon/ $chemin/monitor/
rm $chemin/monitor.zip
else
git clone https://github.com/mgrafr/monitor.git $chemin/monitor
fi
clientmqtt=$(whiptail --title "installer le client php-mqtt ?" --radiolist \
"voulez vous installer php-mqtt/client ?\n necessaire pour utiliser zigbee2mqtt directement\n
depuis monitor(sans utiliser Dz, Ha ou Iobroker)" 15 60 4 \
"non" "par defaut " ON \
"oui" "voir la doc" OFF 3>&1 1>&2 2>&3)
if [ $exitstatus = 0 ]; then
   echo "Vous avez choisi  : $clientmqtt"
else
echo "Vous avez annulé  "
fi
if [ "$clientmqtt" = "oui" ]
then
echo -e "${GN} installation de composer & php-mqtt/client${CL}"
cd $chemin/monitor
wget -O composer-setup.php https://getcomposer.org/installer
php composer-setup.php --install-dir=$chemin/monitor --filename=composer
php composer require php-mqtt/client
rm composer-setup.php
fi
echo -e "${CM}${GN} installation terminée de composer et PHP-MQTT${CL}"
echo -e "${CM}${GN} importer les tables text_image dispositifs 2fa_token messages et sse${CL}" 
sed -i "s/(1, 'user'/(1, '${maria_name}'/g" /var/www/monitor/bd_sql/2fa_token.sql
mysql --user=root --password=${root_pwd} monitor < $chemin/monitor/bd_sql/text_image.sql
mysql --user=root --password=${root_pwd} monitor < $chemin/monitor/bd_sql/dispositifs.sql
mysql --user=root --password=${root_pwd} monitor < $chemin/monitor/bd_sql/sse.sql
mysql --user=root --password=${root_pwd} monitor < $chemin/monitor/bd_sql/messages.sql
mysql --user=root --password=${root_pwd} monitor < $chemin/monitor/bd_sql/2fa_token.sql
echo "LEMP : Configurer NGINX"
echo "LEMP : Création de monitor.conf"
cp $chemin/monitor/share/nginx/default.conf /etc/nginx/conf.d/
sed -i "s/server_name/server_name ${ip4}/g" /etc/nginx/conf.d/default.conf
# sed -i "s/xxxipxxx/${ip4}/g" /etc/nginx/conf.d/monitor.conf
echo -e "${CM}${GN} LEMP : Creating a php-info page${CL}"
echo '<?php phpinfo(); ?>' > /www/info.php
echo "LEMP est installé${CL}"
echo -e "${GN} installation de mysql-connector-python${CL}" 
apt install python3.13-venv
sudo python3 -m venv /www/venv
/www/venv/bin/pip install mysql-connector-python
echo -e "${CM}${GN}  mysql-connector-python installé${CL}" 
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
#sed -i "s/###//g" /etc/nginx/conf.d/monitor.conf
fi
echo -e "${CM}${GN} creer lien symbolique de monitorvers /www${CL}"
ln -s $chemin/monitor/  /www/monitor
echo -e "${CM}${GN} Redemarrage NGINX une derniere fois...${CL}"
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
          
echo -e "${GN} ip du serveur = $ip4"
echo -e "${GN} nom de l'utilisateur mariadb & monitor = $maria_name"
echo -e "${GN} la clé BlowfishSecret : $randomBlowfishSecret"
echo -e "${GN} le chemin : $chemin"
echo -e "${GN} le lien symbolique : /www/monitor"
if [ "$clientmqtt" = "oui" ]
then
echo -e "${GN} php-mqtt/client a été installé dans ~/monitor/z2m${CL}"
fi
sed -i "s/ipmonitor/${ip4}/g" $chemin/monitor/admin/config.php 
sed -i "s/USER_BD/${maria_name}/g" $chemin/monitor/admin/config.php
sed -i "s/PASS_BD/${mp}/g" $chemin/monitor/admin/config.php
sed -i "s/MON_PASS/${mp}/g" $chemin/monitor/admin/config.php
sed -i "s/ip_monitor='/ip_monitor='${ip4}/g" $chemin/monitor/admin/connect/connect.lua
sed -i "s/ip_monitor='/ip_monitor='${ip4}/g" $chemin/monitor/admin/connect/connect.py
chmod 666 $chemin/monitor/admin/config.php
ln /var/www/monitor/admin/config.php /var/www/monitor/api/conf.php
