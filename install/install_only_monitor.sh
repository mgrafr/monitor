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
serv=$(whiptail --title "installation de monitor" --checklist \
"Quel derveur utilisez-vous ?\n Apache2 ou Nginx" 15 60 4 \
"Nginx" "par defaut " ON \
"Apache2" "" OFF \
"autre" "installation dans /home"3>&1 1>&2 2>&3)
if [$serv="Nginx"] ; then
chemin="/usr/share/nginx/html"
if [$serv="Apache2"] ; then
chemin="/www/html";
if [$serv="autre"] ; then
chemin="/home";
fi
msg_txt "Téléchargement de monitor"
msg_txt "installation de Monitor:"
sleep 3
xxx=$(hostname -I)
ip4=$(echo $xxx | cut -d ' ' -f 1)
git clone https://github.com/mgrafr/monitor.git $chemin/monitor
# une base de dionnées Maria ou mysql doit être installé
# echo "importer les tables text_image et dispositifs"


echo -e "
    _______                 _
   / __  _ \___________ ( )/ /_ __________
  / / / / / / __  / ___\/ / __// __  / __|
 / / / / / / /_/ / / / / / /__/ /_/ / / 
/_/ /_/ /_/_____/_/ /_/_/____/_____/_/
...proposé par : https://github.com/mgrafr/monitor\n" >/etc/motd
          
header_info
msg_txt "ip du serveur = $ip4"

#sed -i "s/ipmonitor/${ip4}/g" $chemin/monitor/admin/config.php 

exit
msg_txt "Completed Successfully!\n"
