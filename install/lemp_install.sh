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
- si vous voulez installer Nginx Proxy Manager\n\
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
nginx=$(whiptail --title "choix pour NGINX" --checklist \
"Comment voulez vous installer NGINX ?\n version classique ou Nginx Proxy Manager" 15 60 4 \
"NGINX" "par defaut " ON \
"Nginx Proxy Manager" " " OFF 3>&1 1>&2 2>&3)
info "LEMP : Debut de l installation"
info "mmaj debian ,installation de sudo curl git pip"
$STD apt-get update 
$STD apt-get upgrade
echo -e "${CHECKMARK} \e[1;92m Debian a ete mis à jour.\e[0m"
sleep 3
#echo "Python est normalement installe, pour installer des module , installation de PIP"
msg_info "Updating Python"
$STD apt-get install -y \
  sudo curl git \
  python3 \
  python3-dev \
  python3-pip \
  python3-venv \
  python3-cffi \
  python3-certbot \
  python3-certbot-dns-cloudflare
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
msg_ok "MariaDB est maintenant sécurisée"
echo "----------------------------------------------------"
msg_ok "Installation de NGINX ou Nginx Proxy Manager"
if [ $nginx="NGINX" ]; then
echo $nginx"----------------------------------------------------"
msg_ok "Installation de NGINX"
echo "----------------------------------------------------"
chemin="/usr/share/nginx/html/"
sleep 3
apt-get install nginx apache2-utils mlocate  -y
echo "demarrage de Nginx NGINX"
systemctl start nginx
echo "Au cas ou apache2 serait actif sur le systeme:"
systemctl disable --now apache2
else 
echo $nginx"----------------------------------------------------"
msg_ok "Installation de Nginx Proxy Manager"
echo "----------------------------------------------------"
chemin="/var/www/html/"
msg_info "Installing Dependencies"
apt-get -y install \
  gnupg \
  make \
  gcc \
  g++ \
  ca-certificates \
  apache2-utils \
  logrotate \
  build-essential
msg_ok "Installed Dependencies"
$STD python3 -m venv /opt/certbot/
msg_ok "Updated Python"
VERSION="$(awk -F'=' '/^VERSION_CODENAME=/{ print $NF }' /etc/os-release)"

msg_info "Installing Openresty"
wget -qO - https://openresty.org/package/pubkey.gpg | gpg --dearmor -o /etc/apt/trusted.gpg.d/openresty-archive-keyring.gpg
echo -e "deb http://openresty.org/package/debian bullseye openresty" >/etc/apt/sources.list.d/openresty.list
$STD apt-get update
$STD apt-get -y install openresty
msg_ok "Installed Openresty"

msg_info "Installing Node.js"
$STD bash <(curl -fsSL https://raw.githubusercontent.com/nvm-sh/nvm/v0.39.3/install.sh)
. ~/.bashrc
$STD nvm install 16.20.1
ln -sf /root/.nvm/versions/node/v16.20.1/bin/node /usr/bin/node
msg_ok "Installed Node.js"

msg_info "Installing Yarn"
$STD npm install --global yarn
msg_ok "Installed Yarn"

RELEASE=$(curl -s https://api.github.com/repos/NginxProxyManager/nginx-proxy-manager/releases/latest |
  grep "tag_name" |
  awk '{print substr($2, 3, length($2)-4) }')

msg_info "Downloading Nginx Proxy Manager v${RELEASE}"
wget -q https://codeload.github.com/NginxProxyManager/nginx-proxy-manager/tar.gz/v${RELEASE} -O - | tar -xz
cd ./nginx-proxy-manager-${RELEASE}
msg_ok "Downloaded Nginx Proxy Manager v${RELEASE}"

msg_info "Setting up Enviroment"
ln -sf /usr/bin/python3 /usr/bin/python
ln -sf /usr/bin/certbot /opt/certbot/bin/certbot
ln -sf /usr/local/openresty/nginx/sbin/nginx /usr/sbin/nginx
ln -sf /usr/local/openresty/nginx/ /etc/nginx

sed -i "s+0.0.0+${RELEASE}+g" backend/package.json
sed -i "s+0.0.0+${RELEASE}+g" frontend/package.json

sed -i 's+^daemon+#daemon+g' docker/rootfs/etc/nginx/nginx.conf
NGINX_CONFS=$(find "$(pwd)" -type f -name "*.conf")
for NGINX_CONF in $NGINX_CONFS; do
  sed -i 's+include conf.d+include /etc/nginx/conf.d+g' "$NGINX_CONF"
done
mkdir -p /var/www/html /etc/nginx/logs
cp -r docker/rootfs/var/www/html/* /var/www/html/
cp -r docker/rootfs/etc/nginx/* /etc/nginx/
cp docker/rootfs/etc/letsencrypt.ini /etc/letsencrypt.ini
cp docker/rootfs/etc/logrotate.d/nginx-proxy-manager /etc/logrotate.d/nginx-proxy-manager
ln -sf /etc/nginx/nginx.conf /etc/nginx/conf/nginx.conf
rm -f /etc/nginx/conf.d/dev.conf
mkdir -p /tmp/nginx/body \
  /run/nginx \
  /data/nginx \
  /data/custom_ssl \
  /data/logs \
  /data/access \
  /data/nginx/default_host \
  /data/nginx/default_www \
  /data/nginx/proxy_host \
  /data/nginx/redirection_host \
  /data/nginx/stream \
  /data/nginx/dead_host \
  /data/nginx/temp \
  /var/lib/nginx/cache/public \
  /var/lib/nginx/cache/private \
  /var/cache/nginx/proxy_temp

chmod -R 777 /var/cache/nginx
chown root /tmp/nginx

echo resolver "$(awk 'BEGIN{ORS=" "} $1=="nameserver" {print ($2 ~ ":")? "["$2"]": $2}' /etc/resolv.conf);" >/etc/nginx/conf.d/include/resolvers.conf

if [ ! -f /data/nginx/dummycert.pem ] || [ ! -f /data/nginx/dummykey.pem ]; then
  openssl req -new -newkey rsa:2048 -days 3650 -nodes -x509 -subj "/O=Nginx Proxy Manager/OU=Dummy Certificate/CN=localhost" -keyout /data/nginx/dummykey.pem -out /data/nginx/dummycert.pem &>/dev/null
fi

mkdir -p /app/global /app/frontend/images
cp -r backend/* /app
cp -r global/* /app/global
wget -q "https://github.com/just-containers/s6-overlay/releases/download/v3.1.5.0/s6-overlay-noarch.tar.xz"
wget -q "https://github.com/just-containers/s6-overlay/releases/download/v3.1.5.0/s6-overlay-x86_64.tar.xz"
tar -C / -Jxpf s6-overlay-noarch.tar.xz
tar -C / -Jxpf s6-overlay-x86_64.tar.xz
msg_ok "Set up Enviroment"

msg_info "Building Frontend"
cd ./frontend
export NODE_ENV=development
$STD yarn install --network-timeout=30000
$STD yarn build
cp -r dist/* /app/frontend
cp -r app-images/* /app/frontend/images
msg_ok "Built Frontend"

msg_info "Initializing Backend"
rm -rf /app/config/default.json
if [ ! -f /app/config/production.json ]; then
  cat <<'EOF' >/app/config/production.json
{
  "database": {
    "engine": "knex-native",
    "knex": {
      "client": "sqlite3",
      "connection": {
        "filename": "/data/database.sqlite"
      }
    }
  }
}
EOF
fi
cd /app
export NODE_ENV=development
$STD yarn install --network-timeout=30000
msg_ok "Initialized Backend"

msg_info "Creating Service"
cat <<'EOF' >/lib/systemd/system/npm.service
[Unit]
Description=Nginx Proxy Manager
After=network.target
Wants=openresty.service

[Service]
Type=simple
Environment=NODE_ENV=production
ExecStartPre=-mkdir -p /tmp/nginx/body /data/letsencrypt-acme-challenge
ExecStart=/usr/bin/node index.js --abort_on_uncaught_exception --max_old_space_size=250
WorkingDirectory=/app
Restart=on-failure

[Install]
WantedBy=multi-user.target
EOF
msg_ok "Created Service"

motd_ssh
customize

msg_info "Starting Services"
sed -i 's/user npm/user root/g; s/^pid/#pid/g' /usr/local/openresty/nginx/conf/nginx.conf
sed -i 's/include-system-site-packages = false/include-system-site-packages = true/g' /opt/certbot/pyvenv.cfg
$STD systemctl enable --now openresty
$STD systemctl enable --now npm
msg_ok "Started Services"

msg_info "Cleaning up"
rm -rf ../nginx-proxy-manager-* s6-overlay-noarch.tar.xz s6-overlay-x86_64.tar.xz
$STD apt-get autoremove
$STD apt-get autoclean
msg_ok "Cleaned"
fi

echo -e "${CHECKMARK} \e[1;92m NPM a été installé.\e[0m"
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
# apt-get install curl lsb-release
echo "Ajouter le depot pour PHP 8.2 :"
curl -sSL https://packages.sury.org/php/README.txt | bash -x
apt-get update
echo -e "${CHECKMARK} \e[1;92m Dépendances installeés.\e[0m"
echo "Installation de PHP 8.2"
apt-get install php8.2 php8.2-fpm php8.2-cli php-mysql php-zip php-curl php-xml php-gd php-json php-bcmath php-mbstring php-apcu -y
echo "Activer le demarrage"
systemctl enable php8.2-fpm
msg_ok "Installation de PHPMYADMIN"
sleep 3
DATA="$(wget https://www.phpmyadmin.net/home_page/version.txt -q -O-)"
URL="$(echo $DATA | cut -d ' ' -f 3)"
VERSION="$(echo $DATA | cut -d ' ' -f 1)"
wget https://files.phpmyadmin.net/phpMyAdmin/${VERSION}/phpMyAdmin-${VERSION}-all-languages.tar.gz
tar xvf phpMyAdmin-${VERSION}-all-languages.tar.gz
mv phpMyAdmin-*/ "$chemin"phpmyadmin
sudo mkdir -p /var/www/phpmyadmin/tmp
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
ln -s $chemin  /www/
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
cp $chemin/monitor/share/nginx/monitor.conf /etc/nginx/conf.d
sed -i "s/server_name /server_name ${server_name}/g" /etc/nginx/conf.d/monitor.conf
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
chmod -R 775 /usr/share/nginx/html
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
#sed -i "s/define('IPMONITOR', 'ip/define('IPMONITOR', '${ip4}/g" $chemin/monitor/admin/config.php 
#sed -i "s/USER_BD/${maria_name}/g" $chemin/monitor/admin/config.php
#sed -i "s/PASS_BD/${mp}/g" $chemin/monitor/admin/config.php
exit
