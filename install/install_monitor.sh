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
msg_ok "Updated $APP LXC"
exit
}


msg_info "Téléchargement de monitor"
pct exec $CTID -- bash -c "wget -P /root https://raw.githubusercontent.com/mgrafr/monitor/main/install/lemp_install.sh" 
msg_ok "Téléchargement de lemp_install dans /root"
pct exec  $CTID -- bash -c "chmod 777 /root/lemp_install.sh"
pct exec  $CTID -- bash -c "/root/./lemp_install.sh"
msg_info "Installation de LEMP"
msg_ok "Completed Successfully!\n"
