#!/usr/bin/env bash

# Copyright (c) 2021-2023 tteck
# Author: tteck (tteckster)
# License: MIT
# https://github.com/tteck/Proxmox/raw/main/LICENSE
source <(curl -s https://raw.githubusercontent.com/mgrafr/monitor/main/install/ct/build.func)
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
echo -e "Loading..."
APP="Monitor"
var_disk="2"
var_cpu="2"
var_ram="1024"
var_os="debian"
var_version="11"
variables
color
catch_errors

function default_settings() {
  CT_TYPE="1"
  PW=$PASS
  CT_ID=$NEXTID
  HN=$NSAPP
  DISK_SIZE="$var_disk"
  CORE_COUNT="$var_cpu"
  RAM_SIZE="$var_ram"
  BRG="vmbr0"
  NET=dhcp
  GATE=$PASSERELLE
  DISABLEIP6="no"
  MTU=""
  SD=""
  NS=""
  MAC=""
  VLAN=""
  SSH="yes"
  VERB="no"
  echo_default
}

function update_script() {
apt-get update 
apt-get -y upgrade 

msg_ok "Updated $APP LXC"
exit
}

start
build_container
msg_info "Téléchargement de lemp_install"
pct exec $CTID -- bash -c "wget -P /root https://raw.githubusercontent.com/mgrafr/monitor/main/install/lemp_install.sh" 
msg_ok "Téléchargement de lemp_install dans /root"
pct exec  $CTID -- bash -c "chmod 777 /root/lemp_install.sh"
pct exec  $CTID -- bash -c "/root/./lemp_install.sh"
msg_info "Installation de LEMP"
msg_ok "Completed Successfully!\n"
