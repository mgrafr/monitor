#!/usr/bin/bash
# Copyright (c) 2021-2023 tteck
# Author: tteck (tteckster)
# License: MIT
# https://github.com/tteck/Proxmox/raw/main/LICENSE

color(){
  YW=$(echo "\033[33m")
  BL=$(echo "\033[36m")
  RD=$(echo "\033[01;31m")
  BGN=$(echo "\033[4;92m")
  GN=$(echo "\033[1;92m")
  DGN=$(echo "\033[32m")
  CL=$(echo "\033[m")
  RETRY_NUM=10
  RETRY_EVERY=3
  CM="${GN}✓${CL}"
  CROSS="${RD}✗${CL}"
  BFR="\\r\\033[K"
  HOLD="-"
}

verb_ip6(){ 
  if [ "$VERBOSE" = "yes" ]; then
    set -x
    STD=""
  else STD="silent"; fi
  silent() { "$@" >/dev/null 2>&1; }
  if [ "$DISABLEIPV6" == "yes" ]; then
    echo "net.ipv6.conf.all.disable_ipv6 = 1" >>/etc/sysctl.conf
    $STD sysctl -p
  fi
}
catch_errors(){
  set -Eeuo pipefail
  trap 'error_handler $LINENO "$BASH_COMMAND"' ERR
}
error_handler() {
  local exit_code="$?"
  local line_number="$1"
  local command="$2"
  local error_message="${RD}[ERROR]${CL} in line ${RD}$line_number${CL}: exit code ${RD}$exit_code${CL}: while executing command ${YW}$command${CL}"
  echo -e "\n$error_message"
  if [[ "$line_number" -eq 22 ]]; then
    echo -e "The silent function has suppressed the error, run the script with verbose mode enabled, which will provide more detailed output.\n"
  fi
}
setting_up_container() {
  msg_info "Setting up Container OS"
  sed -i "/$LANG/ s/\(^# \)//" /etc/locale.gen
  locale-gen >/dev/null
  echo $tz >/etc/timezone
  ln -sf /usr/share/zoneinfo/$tz /etc/localtime
  for ((i = RETRY_NUM; i > 0; i--)); do
    if [ "$(hostname -I)" != "" ]; then
      break
    fi
    echo 1>&2 -en "${CROSS}${RD} No Network! "
    sleep $RETRY_EVERY
  done
  if [ "$(hostname -I)" = "" ]; then
    echo 1>&2 -e "\n${CROSS}${RD} No Network After $RETRY_NUM Tries${CL}"
    echo -e " 🖧  Check Network Settings"
    exit 1
  fi
  msg_ok "Set up Container OS"
  msg_ok "Network Connected: ${BL}$(hostname -I)"
}
network_check() {
  set +e
  trap - ERR
  if ping -c 1 -W 1 1.1.1.1 &>/dev/null; then msg_ok "Internet Connected"; else
    msg_error "Internet NOT Connected"
    read -r -p "Would you like to continue anyway? <y/N> " prompt
    if [[ "${prompt,,}" =~ ^(y|yes)$ ]]; then
      echo -e " ⚠️  ${RD}Expect Issues Without Internet${CL}"
    else
      echo -e " 🖧  Check Network Settings"
      exit 1
    fi
  fi
  RESOLVEDIP=$(getent hosts github.com | awk '{ print $1 }')
  if [[ -z "$RESOLVEDIP" ]]; then msg_error "DNS Lookup Failure"; else msg_ok "DNS Resolved github.com to ${BL}$RESOLVEDIP${CL}"; fi
  set -e
  trap 'error_handler $LINENO "$BASH_COMMAND"' ERR
}

update_os() {
  msg_info "Updating Container OS"
  $STD apt-get update
  $STD apt-get -y upgrade
  msg_ok "Updated Container OS"
}
motd_ssh() {
  echo "export TERM='xterm-256color'" >>/root/.bashrc
  echo -e "$APPLICATION LXC provided by https://github.com/mgrafr/monitor\n" >/etc/motd
  chmod -x /etc/update-motd.d/*
  if [[ "${SSH_ROOT}" == "yes" ]]; then
    sed -i "s/#PermitRootLogin prohibit-password/PermitRootLogin yes/g" /etc/ssh/sshd_config
    systemctl restart sshd
  fi
}

msg_info() {
  local msg="$1"
  echo -ne " ${HOLD} ${YW}${msg}..."
}
msg_ok() {
  local msg="$1"
  echo -e "${BFR} ${CM} ${GN}${msg}${CL}"
}

msg_error() {
  local msg="$1"
  echo -e "${BFR} ${CROSS} ${RD}${msg}${CL}"
}

color
verb_ip6
catch_errors
setting_up_container
network_check
update_os

msg_info "Installing Dependencies"
$STD apt-get install -y curl
$STD apt-get install -y sudo
$STD apt-get install -y mc
msg_ok "Installed Dependencies"

msg_info "Téléchargement de lemp_install"
$STD pct exec  "$CTID" -- bash -c "wget https://raw.githubusercontent.com/mgrafr/monitor/main/install/lemp_install.sh"
msg_info "Installing monitor & LEMP"
$STD pct exec  "$CTID" -- bash -c "chmod 777 lemp_install.sh"
$STD pct exec  "$CTID" -- bash -c "./lemp_install.sh"
motd_ssh


msg_info "Cleaning up"
$STD apt-get autoremove
$STD apt-get autoclean
msg_ok "Cleaned"

