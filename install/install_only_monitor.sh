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




function update_script() {
apt-get update 
apt-get -y upgrade 
apt install git 
msg_ok "Updated conteneur LXC"
exit
}
echo réperoire pour installer monitor
read chemin

msg_info "Téléchargement de monitor"
msg_ok "installation de Monitor:"
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
msg_ok "ip du serveur = $ip4"

#sed -i "s/ipmonitor/${ip4}/g" $chemin/monitor/admin/config.php 

exit
msg_ok "Completed Successfully!\n"
