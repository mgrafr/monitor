#!/usr/bin/env bash

function header_info {
clear
cat <<"EOF"
    _______               __ 
   / __  _ \_________  (_)/ /_ __________
  / / / / / / __  / __ \/ / __// __  / __|
 / / / / / / /_/ / / / / / /__/ /_/ / / 
/_/ /_/ /_/_____/_/ /_/_/____/_____/_/
                                                   
EOF
}
header_info



 msg_txt() {
  local msg="$1"
  echo -e "${BFR} ${CM} ${GN}${msg}${CL}"
}
function update_script() {
apt-get update 
apt-get -y upgrade 
apt install git 
msg_txt "Updated conteneur LXC"
exit
}
echo réperoire pour installer monitor
chemin=$(whiptail --title "installation de monitor" --radiolist  \
"Quel chemin pour monitor ?\n Apache2 ou Nginx ou autre" 15 60 4 \
"/usr/share/nginx/html" "Nginx  " OFF \
"/var/www/html"         "Nginx  " ON \
"/www/html"              "Apache2" OFF \
"/www"                   "Apache2" OFF \
"/tmp"                   "autre" OFF  3>&1 1>&2 2>&3)
exitstatus=$?
if [ $exitstatus = 0 ]; then
   echo "Vous avez choisi le chemin : $chemin"
else
echo "Vous avez annulé  "
fi
echo "  chargement de monitor"
msg_txt "installation de Monitor dans : $chemin"
sleep 1
xxx=$(hostname -I)
ip4=$(echo "$xxx" | cut -d ' ' -f 1)
echo "$chemin"
sleep 3
msg_txt "Téléchargement de monitor"
msg_txt "installation de Monitor:"
sleep 3
xxx=$(hostname -I)
ip4=$(echo $xxx | cut -d ' ' -f 1)
git clone https://github.com/mgrafr/monitor.git $chemin/monitor
rm $chemin/monitor/install/maj*
chown -R $maria_name:$maria_name $chemin/monitor
chown -R www-data:www-data $chemin/monitor/admin/config.php
chmod -R 775 $chemin/monitor
echo "--------------------------------------------------------"
echo " une base de données Maria ou mysql doit être installé -"
echo "    importer les tables text_image et dispositifs      -"
echo "--------------------------------------------------------"
echo "appuyer sur une touche pour continuer"
read

echo -e "
    _______                 _
   / __  _ \___________ ( )/ /_ __________
  / / / / / / __  / ___\/ / __// __  / __|
 / / / / / / /_/ / / / / / /__/ /_/ / / 
/_/ /_/ /_/_____/_/ /_/_/____/_____/_/
...proposé par : https://github.com/mgrafr/monitor\n" >/etc/motd
          
header_info
msg_txt "ip du serveur = $ip4"

sed -i "s/ipmonitor/${ip4}/g" $chemin/monitor/admin/config.php 
sed -i "s/ip_monitor='/ip_monitor='${ip4}/g" $chemin/monitor/admin/connect/connect.lua
sed -i "s/ip_monitor='/ip_monitor='${ip4}/g" $chemin/monitor/admin/connect/connect.py
ln /var/www/monitor/admin/config.php /var/www/monitor/api/conf.php
exit
msg_txt "Completed Successfully!\n"
