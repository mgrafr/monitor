#!/usr/bin/env bash
whiptail --title "intallation de la locale " --msgbox "dpkg-reconfigure :\n
- Configuration de la locale pour PVE \n\
- Configuration de la locale pour monitor\n\
     ...quand le conteneur sera crée" 15 60
dpkg-reconfigure locales
locale-gen fr_FR.UTF-8
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

APP="Monitor"
 
var_cpu="${var_cpu:-1}"
var_ram="${var_ram:-512}"
var_disk="${var_disk:-4}"
var_os="${var_os:-debian}"
var_version="${var_version:-13}"
var_version_monitor="${var_version_m:-4.0.0}"
var_unprivileged="${var_unprivileged:-1}"

variables() {
  NSAPP=$(echo "${APP,,}" | tr -d ' ')             
  INTEGER='^[0-9]+([.][0-9]+)?$'                    
  PVEHOST_NAME=$(hostname)                         
  METHOD="default"                                 
  RANDOM_UUID="$(cat /proc/sys/kernel/random/uuid)" 
  CT_TYPE=${var_unprivileged:-$CT_TYPE}
  TEMPLATE_GYPTAZY="https://cdn.gyptazy.com/proxmox/debian-13-standard_13.x-beta_lxc_proxmox_amd64.tar.gz"
  }
formatting() {
  CM="  ✔️  "
  BFR="\\r\\033[K"
  BOLD=$(echo "\033[1m")
}
color_spinner() {
  CS_YWB=$'\033[93m'
  CS_CL=$'\033[m'
}
color() {
  YW=$(echo "\033[33m")
  YWB=$'\e[93m'
  BL=$(echo "\033[36m")
  RD=$(echo "\033[01;31m")
  BGN=$(echo "\033[4;92m")
  GN=$(echo "\033[1;92m")
  DGN=$(echo "\033[32m")
  CL=$(echo "\033[m")
  }
base_settings() {
  ARCH="amd64"
  CT_TYPE="1"
  DISK_SIZE="4"
  CORE_COUNT="2"
  RAM_SIZE="2048"
  PW=""
  CT_ID=$NEXTID
  HN=$NSAPP
  BRG="vmbr0"
  NET="dhcp"
  IPV6_METHOD="none"
  IPV6_STATIC=""
  GATE=""
  MTU=""
  SD=""
  NS=""
  MAC=""
  VLAN=""
  SSH="yes"
  SSH_AUTHORIZED_KEY=""
  # Remplacer les paramètres par défaut par des variables du script ct
  CT_TYPE=${var_unprivileged:-$CT_TYPE}
  DISK_SIZE=${var_disk:-$DISK_SIZE}
  CORE_COUNT=${var_cpu:-$CORE_COUNT}
  RAM_SIZE=${var_ram:-$RAM_SIZE}
 }
msg_info() {
  local msg="$1"
  [[ -z "$msg" ]] && return

  if ! declare -p MSG_INFO_SHOWN &>/dev/null || ! declare -A MSG_INFO_SHOWN &>/dev/null; then
    declare -gA MSG_INFO_SHOWN=()
  fi
  [[ -n "${MSG_INFO_SHOWN["$msg"]+x}" ]] && return
  MSG_INFO_SHOWN["$msg"]=1
  stop_spinner
  SPINNER_MSG="$msg"
  color_spinner
  spinner &
  SPINNER_PID=$!
  echo "$SPINNER_PID" >/tmp/.spinner.pid
  disown "$SPINNER_PID" 2>/dev/null || true
}
msg_ok() {
  local msg="$1"
  [[ -z "$msg" ]] && return
  stop_spinner
  tput cr 2>/dev/null || echo -en "\r"
  tput el 2>/dev/null || echo -en "\033[K"
  printf "%s %b\n" "$CM" "${GN}${msg}${CL}" >&2
  unset MSG_INFO_SHOWN["$msg"]
}
msg_error() {
  stop_spinner
  local msg="$1"
  echo -e "${BFR:-} :-✖️} ${RD}${msg}${CL}"
}
spinner() {
  local chars=(⠋ ⠙ ⠹ ⠸ ⠼ ⠴ ⠦ ⠧ ⠇ ⠏)
  local i=0
  while true; do
    local index=$((i++ % ${#chars[@]}))
    printf "\r\033[2K%s %b" "${CS_YWB}${chars[$index]}${CS_CL}" "${CS_YWB}${SPINNER_MSG:-}${CS_CL}"
    sleep 0.1
  done
}

stop_spinner() {
  local pid="${SPINNER_PID:-}"
  [[ -z "$pid" && -f /tmp/.spinner.pid ]] && pid=$(</tmp/.spinner.pid)

  if [[ -n "$pid" && "$pid" =~ ^[0-9]+$ ]]; then
    if kill "$pid" 2>/dev/null; then
      sleep 0.05
      kill -9 "$pid" 2>/dev/null || true
      wait "$pid" 2>/dev/null || true
    fi
    rm -f /tmp/.spinner.pid
  fi

  unset SPINNER_PID SPINNER_MSG
  stty sane 2>/dev/null || true
}

# Supporte: Proxmox VE  9.0 (NOT 9.1+)
pve_check() {
  if [ $(pveversion | grep -c "pve-manager/9\.[0-9]") -eq 0 ]; then
    echo -e "This version of Proxmox Virtual Environment is not supported"
    echo -e "Requires PVE Version 9.0 or higher"
    echo -e "Exiting..."
    sleep 2
    exit
  fi
}
shell_check() {
  if [[ "$(basename "$SHELL")" != "bash" ]]; then
    clear
    msg_error "Your default shell is currently not set to Bash. To use these scripts, please switch to the Bash shell."
    echo -e "\nExiting..."
    sleep 2
    exit
  fi
}
root_check() {
  if [[ "$(id -u)" -ne 0 || $(ps -o comm= -p $PPID) == "sudo" ]]; then
    clear
    msg_error "Please run this script as root."
    echo -e "\nExiting..."
    sleep 2
    exit
  fi
}
ssh_check() {
  if [ -n "${SSH_CLIENT:+x}" ]; then
    if whiptail --backtitle "Proxmox Monitor" --defaultno --title "SSH DETECTED" --yesno "It's advisable to utilize the Proxmox shell rather than SSH, as there may be potential complications with variable retrieval. Proceed using SSH?" 10 72; then
      whiptail --backtitle "Proxmox Monitor" --msgbox --title "Proceed using SSH" "You've chosen to proceed using SSH. If any issues arise, please run the script in the Proxmox shell before creating a repository issue." 10 72
    else
      clear
      echo "Exiting due to SSH usage. Please consider using the Proxmox shell."
      exit
    fi
  fi
}
maxkeys_check() {
  # Lire les paramètres du noyau
  per_user_maxkeys=$(cat /proc/sys/kernel/keys/maxkeys 2>/dev/null || echo 0)
  per_user_maxbytes=$(cat /proc/sys/kernel/keys/maxbytes 2>/dev/null || echo 0)

  # Quitter si les paramètres du noyau ne sont pas disponibles
  if [[ "$per_user_maxkeys" -eq 0 || "$per_user_maxbytes" -eq 0 ]]; then
    echo -e "${RD} Error: Unable to read kernel parameters. Ensure proper permissions.${CL}"
    exit 1
  fi

  # Récupérer l'utilisation des clés pour l'ID utilisateur 100000 (typique pour les conteneurs)
  used_lxc_keys=$(awk '/100000:/ {print $2}' /proc/key-users 2>/dev/null || echo 0)
  used_lxc_bytes=$(awk '/100000:/ {split($5, a, "/"); print a[1]}' /proc/key-users 2>/dev/null || echo 0)

  # Calculer les seuils et proposer de nouvelles limites
  threshold_keys=$((per_user_maxkeys - 100))
  threshold_bytes=$((per_user_maxbytes - 1000))
  new_limit_keys=$((per_user_maxkeys * 2))
  new_limit_bytes=$((per_user_maxbytes * 2))
  # Vérifier si l'utilisation de la clé ou des octets est proche des limites
  failure=0
  if [[ "$used_lxc_keys" -gt "$threshold_keys" ]]; then
    echo -e "${RD} Warning: Key usage is near the limit (${used_lxc_keys}/${per_user_maxkeys}).${CL}"
    echo -e "Suggested action: Set ${GN}kernel.keys.maxkeys=${new_limit_keys}${CL} in ${BOLD}/etc/sysctl.d/98-community-scripts.conf${CL}."
    failure=1
  fi
  if [[ "$used_lxc_bytes" -gt "$threshold_bytes" ]]; then
    echo -e "${RD} Avertissement : L'utilisation des octets de clé est proche de la limite (${used_lxc_bytes}/${per_user_maxbytes}).${CL}"
    echo -e "Suggested action: Set ${GN}kernel.keys.maxbytes=${new_limit_bytes}${CL} in ${BOLD}/etc/sysctl.d/98-community-scripts.conf${CL}."
    failure=1
  fi
  # Fournir les prochaines étapes si des problèmes sont détectés
  if [[ "$failure" -eq 1 ]]; then
    echo -e "Pour appliquer les modifications, exécutez: ${BOLD}service procps force-reload${CL}"
    exit 1
  fi
  echo -e "${GN} Toutes les limites de clé du noyau sont dans des seuils sûrs..${CL}"
}
echo_default() {
   CT_TYPE_DESC="Unprivileged"
  if [ "$CT_TYPE" -eq 0 ]; then
    CT_TYPE_DESC="Privileged"
  fi
}
advanced_settings() {
  whiptail --backtitle "Proxmox Monitor" --msgbox --title "Mode d'emploi:" "Pour faire une sélection, utilisez la barre d’espace.." 8 58
  CT_DEFAULT_TYPE="${CT_TYPE}"
  CT_TYPE=""
  while [ -z "$CT_TYPE" ]; do
    if [ "$CT_DEFAULT_TYPE" == "1" ]; then
      if CT_TYPE=$(whiptail --backtitle "Proxmox Monitor" --title "TYPE CONTENEUR" --radiolist "Choisir le Type" 10 58 2 \
        "1" "Unprivileged" ON \
        "0" "Privileged" OFF \
        3>&1 1>&2 2>&3); then
        if [ -n "$CT_TYPE" ]; then
          CT_TYPE_DESC="Unprivileged"
          if [ "$CT_TYPE" -eq 0 ]; then
            CT_TYPE_DESC="Privileged"
          fi
          echo -e "${BOLD}${DGN}Operating System: ${BGN}$var_os${CL}"
          echo -e "${BOLD}${DGN}Version: ${BGN}$var_version${CL}"
          echo -e "${BOLD}${DGN}Container Type: ${BGN}$CT_TYPE_DESC${CL}"
        fi
      else
        exit_script
      fi
    fi
    if [ "$CT_DEFAULT_TYPE" == "0" ]; then
      if CT_TYPE=$(whiptail --backtitle "Proxmox Monitor" --title "TYPE DE CONTCONTENEUR" --radiolist "Choisir le type de CT" 10 58 2 \
        "1" "Unprivileged" OFF \
        "0" "Privileged" ON \
        3>&1 1>&2 2>&3); then
        if [ -n "$CT_TYPE" ]; then
          CT_TYPE_DESC="Unprivileged"
          if [ "$CT_TYPE" -eq 0 ]; then
            CT_TYPE_DESC="Privileged"
          fi
          echo -e "${BOLD}${DGN}Operating System: ${BGN}$var_os${CL}"
          echo -e "${BOLD}${DGN}Version: ${BGN}$var_version${CL}"
          echo -e "${BOLD}${DGN}Container Type: ${BGN}$CT_TYPE_DESC${CL}"
        fi
      else
        exit_script
      fi
    fi
  done

  while true; do
    if PW1=$(whiptail --backtitle "Proxmox Monitor" --passwordbox "\nDéfinir le mot de passe root (nécessaire pour l'accès root ssh)" 9 58 --title "MOT de PASSE" 3>&1 1>&2 2>&3); then
      # Empty = Autologin
      if [[ -z "$PW1" ]]; then
        PW=""
        PW1="Automatic Login"
        echo -e "${BOLD}${DGN}Root Password: ${BGN}$PW1${CL}"
        break
      fi

      # Invalid: contains spaces
      if [[ "$PW1" == *" "* ]]; then
        whiptail --msgbox "Le mot de passe ne peut pas contenir d'espaces." 8 58
        continue
      fi

      # Invalid: too short
      if ((${#PW1} < 5)); then
        whiptail --msgbox "Le mot de passe doit comporter au moins 5 caractères." 8 58
        continue
      fi

      # Confirmation mot de passe
      if PW2=$(whiptail --backtitle "Proxmox Monitor" --passwordbox "\nVérifier le mot de passe root" 9 58 --title "VERIFICATION MOT PASSE" 3>&1 1>&2 2>&3); then
        if [[ "$PW1" == "$PW2" ]]; then
          PW="-password $PW1"
          echo -e "${BOLD}${DGN}Root Password: ${BGN}********${CL}"
          break
        else
          whiptail --msgbox "Les mots de passe ne correspondent pas. Veuillez réessayer." 8 58
        fi
      else
        exit_script
      fi
    else
      exit_script
    fi
  done

  if CT_ID=$(whiptail --backtitle "Proxmox Monitor" --inputbox "Définir l'ID du conteneur" 8 58 "$NEXTID" --title "ID CONTENEUR" 3>&1 1>&2 2>&3); then
    if [ -z "$CT_ID" ]; then
      CT_ID="$NEXTID"
      echo -e "${BOLD}${DGN}ID Conteneur: ${BGN}$CT_ID${CL}"
    else
      echo -e "${BOLD}${DGN}ID Conteneur: ${BGN}$CT_ID${CL}"
    fi
  else
    exit_script
  fi

  while true; do
    if CT_NAME=$(whiptail --backtitle "Proxmox Monitor" --inputbox "Définir le nom d'hôte" 8 58 "$NSAPP" --title "NOM HOTE" 3>&1 1>&2 2>&3); then
      if [ -z "$CT_NAME" ]; then
        HN="$NSAPP"
      else
        HN=$(echo "${CT_NAME,,}" | tr -d ' ')
      fi
      # Hostname validate (RFC 1123)
      if [[ "$HN" =~ ^[a-z0-9]([-a-z0-9]*[a-z0-9])?$ ]]; then
        echo -e "${BOLD}${DGN}Hostname: ${BGN}$HN${CL}"
        break
      else
        whiptail --backtitle "Proxmox Monitor" \
          --msgbox "❌ Nom d'hôte invalide : '$HN'\n\nSeules les lettres minuscules, les chiffres et les tirets (-) sont autorisés.Les underscores (_) ou d'autres caractères ne sont pas autorisés!" 10 70
      fi
    else
      exit_script
    fi
  done

  while true; do
    DISK_SIZE=$(whiptail --backtitle "Proxmox Monitor" --inputbox "Set Disk Size in GB" 8 58 "$var_disk" --title "DISK SIZE" 3>&1 1>&2 2>&3) || exit_script

    if [ -z "$DISK_SIZE" ]; then
      DISK_SIZE="$var_disk"
    fi

    if [[ "$DISK_SIZE" =~ ^[1-9][0-9]*$ ]]; then
      echo -e "${BOLD}${DGN}Disk Size: ${BGN}${DISK_SIZE} GB${CL}"
      break
    else
      whiptail --msgbox "Disk size must be a positive integer!" 8 58
    fi
  done

  while true; do
    CORE_COUNT=$(whiptail --backtitle "Proxmox Monitor" \
      --inputbox "Allouer le nombre de cœurs" 8 58 "$var_cpu" --title "NOMBRE DE COEURS" 3>&1 1>&2 2>&3) || exit_script

    if [ -z "$CORE_COUNT" ]; then
      CORE_COUNT="$var_cpu"
    fi

    if [[ "$CORE_COUNT" =~ ^[1-9][0-9]*$ ]]; then
      echo -e "${BOLD}${DGN}CPU Cores: ${BGN}$CORE_COUNT${CL}"
      break
    else
      whiptail --msgbox "Le nombre de cœurs du processeur doit être un entier positif!" 8 58
    fi
  done

  while true; do
    RAM_SIZE=$(whiptail --backtitle "Proxmox Monitor" \
      --inputbox "Allocation RAM in MiB" 8 58 "$var_ram" --title "RAM" 3>&1 1>&2 2>&3) || exit_script

    if [ -z "$RAM_SIZE" ]; then
      RAM_SIZE="$var_ram"
    fi

    if [[ "$RAM_SIZE" =~ ^[1-9][0-9]*$ ]]; then
      echo -e "${BOLD}${DGN}RAM Size: ${BGN}${RAM_SIZE} MiB${CL}"
      break
    else
      whiptail --msgbox "RAM size must be a positive integer!" 8 58
    fi
  done

  # Méthodes IPv4 : dhcp, statique, aucune
  while true; do
    IPV4_METHOD=$(whiptail --backtitle "Proxmox Monitor" \
      --title "Gestion des adresses IPv4" \
      --menu "Sélectionnez la méthode d'attribution d'adresse IPv4 :" 12 60 2 \
      "dhcp" "Automatique (DHCP)" \
      "static" "Statique (manuel)" \
      3>&1 1>&2 2>&3)

    exit_status=$?
    if [ $exit_status -ne 0 ]; then
      exit_script
    fi

    case "$IPV4_METHOD" in
    dhcp)
      NET="dhcp"
      GATE=""
      echo -e "${BOLD}${DGN}IPv4: DHCP${CL}"
      break
      ;;
    static)
      # Statique : appeler et valider l'adresse CIDR
      while true; do
        NET=$(whiptail --backtitle "Proxmox Monitor" \
          --inputbox "Enter Static IPv4 CIDR Address (e.g. 192.168.100.50/24)" 8 58 "" \
          --title "IPv4 ADDRESS" 3>&1 1>&2 2>&3)
        if [ -z "$NET" ]; then
          whiptail --msgbox "IPv4 address must not be empty." 8 58
          continue
        elif [[ "$NET" =~ ^([0-9]{1,3}\.){3}[0-9]{1,3}/([0-9]|[1-2][0-9]|3[0-2])$ ]]; then
          echo -e "${BOLD}${DGN}IPv4 Address: ${BGN}$NET${CL}"
          break
        else
          whiptail --msgbox "$NET is not a valid IPv4 CIDR address. Please enter a correct value!" 8 58
        fi
      done

      # appeler et valider la passerelle
      while true; do
        GATE1=$(whiptail --backtitle "Proxmox Monitor" \
          --inputbox "Enter Gateway IP address for static IPv4" 8 58 "" \
          --title "Gateway IP" 3>&1 1>&2 2>&3)
        if [ -z "$GATE1" ]; then
          whiptail --msgbox "Gateway IP address cannot be empty." 8 58
        elif [[ ! "$GATE1" =~ ^([0-9]{1,3}\.){3}[0-9]{1,3}$ ]]; then
          whiptail --msgbox "Invalid Gateway IP address format." 8 58
        else
          GATE=",gw=$GATE1"
          echo -e "${BOLD}${DGN}Gateway IP Address: ${BGN}$GATE1${CL}"
          break
        fi
      done
      break
      ;;
    esac
  done

  # Sélection de la gestion des adresses IPv6
  while true; do
    IPV6_METHOD=$(whiptail --backtitle "Proxmox Monitor" --menu \
      "Sélectionnez le type de gestion des adresses IPv6:" 15 58 4 \
      "auto" "SLAAC/AUTO (recommendé, defaut)" \
      "dhcp" "DHCPv6" \
      "static" "Static (manuel)" \
      "none" "Désactivé" \
      --default-item "auto" 3>&1 1>&2 2>&3)
    [ $? -ne 0 ] && exit_script

    case "$IPV6_METHOD" in
    auto)
      echo -e "${BOLD}${DGN}IPv6: ${BGN}SLAAC/AUTO${CL}"
      IPV6_ADDR=""
      IPV6_GATE=""
      break
      ;;
    dhcp)
      echo -e "${BOLD}${DGN}IPv6: ${BGN}DHCPv6${CL}"
      IPV6_ADDR="dhcp"
      IPV6_GATE=""
      break
      ;;
    static)
      # Demandez une adresse IPv6 statique (notation CIDR, par exemple, 2001:db8::1234/64)
      while true; do
        IPV6_ADDR=$(whiptail --backtitle "Proxmox Monitor" --inputbox \
          "Set a static IPv6 CIDR address (e.g., 2001:db8::1234/64)" 8 58 "" \
          --title "IPv6 STATIC ADDRESS" 3>&1 1>&2 2>&3) || exit_script
        if [[ "$IPV6_ADDR" =~ ^([0-9a-fA-F:]+:+)+[0-9a-fA-F]+(/[0-9]{1,3})$ ]]; then
          echo -e "${BOLD}${DGN}IPv6 Address: ${BGN}$IPV6_ADDR${CL}"
          break
        else
          whiptail --backtitle "Proxmox Monitor" --msgbox \
            "$IPV6_ADDR L'adresse CIDR IPv6 est invalide. Veuillez saisir une adresse CIDR IPv6 valide (par exemple, 2001:db8::1234/64)" 8 58
        fi
      done
      # Optionnel : demander la passerelle IPv6 pour la configuration statique
      while true; do
        IPV6_GATE=$(whiptail --backtitle "Proxmox Monitor" --inputbox \
          "Entrez l'adresse de la passerelle IPv6 (facultatif, laissez vide pour aucune)" 8 58 "" --title "IPv6 PASSERELLE" 3>&1 1>&2 2>&3)
        if [ -z "$IPV6_GATE" ]; then
          IPV6_GATE=""
          break
        elif [[ "$IPV6_GATE" =~ ^([0-9a-fA-F:]+:+)+[0-9a-fA-F]+$ ]]; then
          break
        else
          whiptail --backtitle "Proxmox Monitor" --msgbox \
            "Format de passerelle IPv6 non valide." 8 58

        fi
      done
      break
      ;;
    none)
      echo -e "${BOLD}${DGN}IPv6: ${BGN}Disabled${CL}"
      IPV6_ADDR="none"
      IPV6_GATE=""
      break
      ;;
    *)
      exit_script
      ;;
    esac
  done

  if MTU1=$(whiptail --backtitle "Proxmox Monitor" --inputbox "Définir la taille MTU de l'interface (laisser vide pour la valeur par défaut [La MTU de votre vmbr sélectionné, la valeur par défaut est 1500])" 8 58 --title "MTU SIZE" 3>&1 1>&2 2>&3); then
    if [ -z "$MTU1" ]; then
      MTU1="Default"
      MTU=""
    else
      MTU=",mtu=$MTU1"
    fi
    echo -e "${BOLD}${DGN}Interface MTU Size: ${BGN}$MTU1${CL}"
  else
    exit_script
  fi

  if SD=$(whiptail --backtitle "Proxmox Monitor" --inputbox "Définir un domaine de recherche DNS (laisser vide pour HOST)" 8 58 --title "DNS Search Domain" 3>&1 1>&2 2>&3); then
    if [ -z "$SD" ]; then
      SX=Host
      SD=""
    else
      SX=$SD
      SD="-searchdomain=$SD"
    fi
    echo -e "${BOLD}${DGN}DNS Search Domain: ${BGN}$SX${CL}"
  else
    exit_script
  fi

  if NX=$(whiptail --backtitle "Proxmox Monitor" --inputbox "Définir un domaine de recherche DNS (laisser vide pour HÔTE)" 8 58 --title "SERVEUR DNS , IP" 3>&1 1>&2 2>&3); then
    if [ -z "$NX" ]; then
      NX=Host
      NS=""
    else
      NS="-nameserver=$NX"
    fi
    echo -e "${BOLD}${DGN}Adresse IP du serveur DNS: ${BGN}$NX${CL}"
  else
    exit_script
  fi

  if MAC1=$(whiptail --backtitle "Proxmox Monitor" --inputbox "Définir une adresse MAC (laisser vide pour le MAC généré)" 8 58 --title "MAC ADDRESS" 3>&1 1>&2 2>&3); then
    if [ -z "$MAC1" ]; then
      MAC1="Default"
      MAC=""
    else
      MAC=",hwaddr=$MAC1"
      echo -e "${BOLD}${DGN}MAC Address: ${BGN}$MAC1${CL}"
    fi
  else
    exit_script
  fi
   
  SSH_AUTHORIZED_KEY="$(whiptail --backtitle "Proxmox Monitor" --inputbox "Clé autorisée SSH pour root (laisser vide pour aucun)" 8 58 --title "SSH Key" 3>&1 1>&2 2>&3)"

  if [[ -z "${SSH_AUTHORIZED_KEY}" ]]; then
    SSH_AUTHORIZED_KEY=""
  fi

  if [[ "$PW" == -password* || -n "$SSH_AUTHORIZED_KEY" ]]; then
    if (whiptail --backtitle "Proxmox Monitor" --defaultno --title "SSH ACCESS" --yesno "Activer l'accès SSH root?" 10 58); then
      SSH="yes"
    else
      SSH="no"
    fi
    echo -e "${BOLD}${DGN}Root SSH Access: ${BGN}$SSH${CL}"
  else
    SSH="no"
    echo -e "${BOLD}${DGN}Root SSH Access: ${BGN}$SSH${CL}"
  fi
  
    echo -e "${BOLD}${RD}Utilisation des paramètres avancés sur le nœud $PVEHOST_NAME${CL}"

}
install_script() {
  pve_check
  shell_check
  root_check
  ssh_check
  maxkeys_check
  rm -f /var/lib/vz/template/cache/debian*.gz
  msg_ok "suppression anciens modèles gyptazy.com"
  if systemctl is-active -q ping-instances.service; then
    systemctl -q stop ping-instances.service
  fi
  NEXTID=$(pvesh get /cluster/nextid)
  timezone=$(cat /etc/timezone)
  
  while true; do

    TMP_CHOICE=$(whiptail --backtitle "Proxmox VE " \
      --title "PARAMÈTRES" \
      --menu "Choisir une option:" 10 60 4 \
      "1" "Paramètres par défaut" \
      "2" "Paramètres avancés" \
      "3" "Sortie" 3>&1 1>&2 2>&3) 

    if [ -z "$TMP_CHOICE" ]; then
      echo -e "\n${RD}Menu QUITTER. Sortie du script.${CL}\n"
      exit 0
    fi

    CHOICE="$TMP_CHOICE"

    case $CHOICE in
    1)
  
      echo -e "${BOLD}${BL}Utilisation des paramètres par défaut sur le nœud ${GN}$PVEHOST_NAME${CL}"
      METHOD="default"
      base_settings 
      echo_default
      PW1="admin"
      PW="-password $PW1"
      break
      ;;
    2)
   
      echo -e "${BOLD}${RD}Utiliser les paramètres avancés sur un nœud $PVEHOST_NAME${CL}"
      METHOD="advanced"
      base_settings
      advanced_settings
      break
      ;;
    3)
      echo -e "${BOLD}${RD}Installer Lemp & Moniteur uniquement $PVEHOST_NAME${CL}"
      METHOD="monitor"
      ;;
    4)
      echo -e "\n${RD}Script terminé. Passez une bonne journée!${CL}\n"
      exit 0
      ;;
    esac
  done
}
function check_storage_support() {
  local CONTENT="$1"
  local -a VALID_STORAGES=()
  while IFS= read -r line; do
    local STORAGE_NAME
    STORAGE_NAME=$(awk '{print $1}' <<<"$line")
    [[ -z "$STORAGE_NAME" ]] && continue
    VALID_STORAGES+=("$STORAGE_NAME")
  done < <(pvesm status -content "$CONTENT" 2>/dev/null | awk 'NR>1')

  [[ ${#VALID_STORAGES[@]} -gt 0 ]]
}

# This function selects a storage pool for a given content type (e.g., rootdir, vztmpl).
function select_storage() {
  local CLASS=$1 CONTENT CONTENT_LABEL

  case $CLASS in
  container)
    CONTENT='rootdir'
    CONTENT_LABEL='Container'
    ;;
  template)
    CONTENT='vztmpl'
    CONTENT_LABEL='Container template'
    ;;
  iso)
    CONTENT='iso'
    CONTENT_LABEL='ISO image'
    ;;
  images)
    CONTENT='images'
    CONTENT_LABEL='VM Disk image'
    ;;
  backup)
    CONTENT='backup'
    CONTENT_LABEL='Backup'
    ;;
  snippets)
    CONTENT='snippets'
    CONTENT_LABEL='Snippets'
    ;;
  *)
    msg_error "Invalide Stockage class '$CLASS'"
    return 1
    ;;
  esac

  # Check for preset STORAGE variable
  if [ "$CONTENT" = "rootdir" ] && [ -n "${STORAGE:-}" ]; then
    if pvesm status -content "$CONTENT" | awk 'NR>1 {print $1}' | grep -qx "$STORAGE"; then
      STORAGE_RESULT="$STORAGE"
      msg_ok "Utilisation du stockage prédéfini: $STORAGE_RESULT for $CONTENT_LABEL"
      return 0
    else
      msg_error "Stockage prédéfini '$STORAGE' n'est pas valide pour le type de contenu '$CONTENT'."
      return 2
    fi
  fi

  local -A STORAGE_MAP
  local -a MENU
  local COL_WIDTH=0

  while read -r TAG TYPE _ TOTAL USED FREE _; do
    [[ -n "$TAG" && -n "$TYPE" ]] || continue
    local STORAGE_NAME="$TAG"
    local DISPLAY="${STORAGE_NAME} (${TYPE})"
    local USED_FMT=$(numfmt --to=iec --from-unit=K --format %.1f <<<"$USED")
    local FREE_FMT=$(numfmt --to=iec --from-unit=K --format %.1f <<<"$FREE")
    local INFO="Free: ${FREE_FMT}B  Used: ${USED_FMT}B"
    STORAGE_MAP["$DISPLAY"]="$STORAGE_NAME"
    MENU+=("$DISPLAY" "$INFO" "OFF")
    ((${#DISPLAY} > COL_WIDTH)) && COL_WIDTH=${#DISPLAY}
  done < <(pvesm status -content "$CONTENT" | awk 'NR>1')

  if [ ${#MENU[@]} -eq 0 ]; then
    msg_error "No storage found for content type '$CONTENT'."
    return 2
  fi

  if [ $((${#MENU[@]} / 3)) -eq 1 ]; then
    STORAGE_RESULT="${STORAGE_MAP[${MENU[0]}]}"
    STORAGE_INFO="${MENU[1]}"
    return 0
  fi

  local WIDTH=$((COL_WIDTH + 42))
  while true; do
    local DISPLAY_SELECTED
    DISPLAY_SELECTED=$(whiptail --backtitle "Proxmox Monitor" \
      --title "Storage Pools" \
      --radiolist "Which storage pool for ${CONTENT_LABEL,,}?\n(Spacebar to select)" \
      16 "$WIDTH" 6 "${MENU[@]}" 3>&1 1>&2 2>&3)

    # Annuler or ESC
    [[ $? -ne 0 ]] && exit_script

    # Strip trailing whitespace or newline (important for storages like "storage (dir)")
    DISPLAY_SELECTED=$(sed 's/[[:space:]]*$//' <<<"$DISPLAY_SELECTED")

    if [[ -z "$DISPLAY_SELECTED" || -z "${STORAGE_MAP[$DISPLAY_SELECTED]+_}" ]]; then
      whiptail --msgbox "No valid storage selected. Please try again." 8 58
      continue
    fi

    STORAGE_RESULT="${STORAGE_MAP[$DISPLAY_SELECTED]}"
    for ((i = 0; i < ${#MENU[@]}; i += 3)); do
      if [[ "${MENU[$i]}" == "$DISPLAY_SELECTED" ]]; then
        STORAGE_INFO="${MENU[$i + 1]}"
        break
      fi
    done
    return 0
  done
}

# This function collects user settings and integrates all the collected information.
build_container() {
  NET_STRING="-net0 name=eth0,bridge=$BRG$MAC,ip=$NET$GATE$VLAN$MTU"
  case "$IPV6_METHOD" in
  auto) NET_STRING="$NET_STRING,ip6=auto" ;;
  dhcp) NET_STRING="$NET_STRING,ip6=dhcp" ;;
  static)
    NET_STRING="$NET_STRING,ip6=$IPV6_ADDR"
    [ -n "$IPV6_GATE" ] && NET_STRING="$NET_STRING,gw6=$IPV6_GATE"
    ;;
  none) ;;
  esac
  if [ "$CT_TYPE" == "1" ]; then
    FEATURES="keyctl=1,nesting=1"
  else
    FEATURES="nesting=1"
  fi
  
  RANDOM_UUID="$RANDOM_UUID"
  SSH_AUTHORIZED_KEY=""
  CTID="$CT_ID"
  PCT_OSTYPE="$var_os"
  HOSTNAME="-hostname $HN"
  PCT_OSVERSION="$var_version"
# Cela exécute create_lxc.sh et crée le conteneur et le fichier .conf
#--------------------------------------------------------------------
# Vérifiez si les variables requises sont définies
[[ "${CTID:-}" ]] || {
  msg_error "Vous devez définir la variable 'CTID'.."
  exit 203
}
[[ "${PCT_OSTYPE:-}" ]] || {
  msg_error "Vous devez définir la variable 'PCT_OSTYPE'.."
  exit 204
}

# Vérifiez si l'ID est valide
[ "$CTID" -ge "100" ] || {
  msg_error "Vérifiez si l'ID est valide."
  exit 205
}

# Vérifiez si l'ID est en cours d'utilisation
if qm status "$CTID" &>/dev/null || pct status "$CTID" &>/dev/null; then
  echo -e "ID '$CTID' is already in use."
  unset CTID
  msg_error "Cannot use ID that is already in use."
  exit 206
fi

# Cela vérifie la présence d'emplacements de stockage de conteneurs et de stockage de modèles valides.
echo -e "${GN} Validation du stockage"
if ! check_storage_support "rootdir"; then
  msg_error "Aucun stockage valide trouvé pour 'rootdir' [Container]"
  exit 1
fi
if ! check_storage_support "vztmpl"; then
  msg_error "Aucun stockage valide trouvé pour 'vztmpl' [Template]"
  exit 1
fi

msg_info "Vérification du stockage des modèles"
while true; do
  if select_storage template; then
    TEMPLATE_STORAGE="$STORAGE_RESULT"
    TEMPLATE_STORAGE_INFO="$STORAGE_INFO"
    msg_ok "Storage ${BL}$TEMPLATE_STORAGE${CL} ($TEMPLATE_STORAGE_INFO) [Template]"
    break
  fi
done

while true; do
  if select_storage container; then
    CONTAINER_STORAGE="$STORAGE_RESULT"
    CONTAINER_STORAGE_INFO="$STORAGE_INFO"
    msg_ok "Storage ${BL}$CONTAINER_STORAGE${CL} ($CONTAINER_STORAGE_INFO) [Container]"
    break
  fi
done

# Vérifiez l'espace libre sur le stockage du conteneur sélectionné
STORAGE_FREE=$(pvesm status | awk -v s="$CONTAINER_STORAGE" '$1 == s { print $6 }')
REQUIRED_KB=$((${PCT_DISK_SIZE:-8} * 1024 * 1024))
if [ "$STORAGE_FREE" -lt "$REQUIRED_KB" ]; then
  msg_error "Not enough space on '$CONTAINER_STORAGE'. Needed: ${PCT_DISK_SIZE:-8}G."
  exit 214
fi

# Mettre à jour la liste des modèles LXC"
TEMPLATE_SEARCH=${PCT_OSTYPE}-${PCT_OSVERSION:-}
# Vérifiez d’abord les modèles locaux
msg_ok "Recherche du modèle '$TEMPLATE_SEARCH'"
mapfile -t TEMPLATES < <(
  pveam list "$TEMPLATE_STORAGE" |
    awk -v s="$TEMPLATE_SEARCH" -v p="$TEMPLATE_PATTERN" '$1 ~ s && $1 ~ p {print $1}' |
    sed 's/.*\///' | sort -t - -k 2 -V
)

if [ ${#TEMPLATES[@]} -gt 0 ]; then
  TEMPLATE_SOURCE="local"

else
  msg_info "No local template found, checking online repository"
  pveam update >/dev/null 2>&1
  mapfile -t TEMPLATES < <(
    pveam update >/dev/null 2>&1 &&
      pveam available -section system |
      sed -n "s/.*\($TEMPLATE_SEARCH.*$TEMPLATE_PATTERN.*\)/\1/p" |
        sort -t - -k 2 -V
  )
  TEMPLATE_SOURCE="online"
fi

TEMPLATE="${TEMPLATES[-1]}"
TEMPLATE_PATH="$(pvesm path $TEMPLATE_STORAGE:vztmpl/$TEMPLATE 2>/dev/null ||
  echo "/var/lib/vz/template/cache/$TEMPLATE")"
msg_ok "Template ${BL}$TEMPLATE${CL} [$TEMPLATE_SOURCE]"
  TEMPLATE_OK="/var/lib/vz/template/cache/${TEMPLATE}"
  ROOTFS=${CONTAINER_STORAGE}:$DISK_SIZE
# Valider le modèle (existe et n'est pas corrompu)
TEMPLATE_VALID=1
if [ ! -s "$TEMPLATE_PATH" ]; then
  TEMPLATE_VALID=0
elif ! tar --use-compress-program=zstdcat -tf "$TEMPLATE_PATH" >/dev/null 2>&1; then
  TEMPLATE_VALID=0
fi

if [ "$TEMPLATE_VALID" -eq 0 ]; then
  msg_ok "Template $TEMPLATE is missing or corrupted. Re-downloading."
  [[ -f "$TEMPLATE_PATH" ]] && rm -f "$TEMPLATE_PATH"
  for attempt in {1..3}; do
    msg_info "Attempt $attempt: Downloading LXC template..."
    if pveam download "$TEMPLATE_STORAGE" "$TEMPLATE" >/dev/null 2>&1; then
      msg_ok "Template download successful.${GN}${TEMPLATE}"
      TEMPLATE_OK="/var/lib/vz/template/cache/${TEMPLATE}"
      ROOTFS=${CONTAINER_STORAGE}:$DISK_SIZE
      break
    fi
    if [ $attempt -eq 3 ]; then
      msg_error "Failed after 3 attempts. Please check network access or manually run:\n  pveam download $TEMPLATE_STORAGE $TEMPLATE"
     msg_ok "Aucun modèle local trouvé, vérification du référentiel en ligne"
msg_ok "téléchargement depuis https://cdn.gyptazy.com"
wget -P /var/lib/vz/template/cache  ${TEMPLATE_GYPTAZY}
TEMP_GYP=${TEMPLATE_GYPTAZY:32} 
TEMPLATE=${TEMP_GYP/lxc_proxmox_/}  
mv /var/lib/vz/template/cache/${TEMP_GYP} /var/lib/vz/template/cache/${TEMPLATE}
TEMPLATE_OK="/var/lib/vz/template/cache/${TEMPLATE}"
ROOTFS=${CONTAINER_STORAGE}:$DISK_SIZE
echo -e "${BL}MOt de passe:${GN}{$PW1}${CL}"
echo -e "${BL}Template:${GN}${TEMPLATE_OK}${CL}" 
    fi
    sleep $((attempt * 5))
  done
fi

msg_ok "Creation du Container LXC"
# Vérifiez et corrigez subuid/subgid
grep -q "root:100000:65536" /etc/subuid || echo "root:100000:65536" >>/etc/subuid
grep -q "root:100000:65536" /etc/subgid || echo "root:100000:65536" >>/etc/subgid
msg_ok "ROOTFS:${ROOTFS}"
pct create $CTID $TEMPLATE_OK -arch $ARCH -features nesting=$CT_TYPE $PW \
  $HOSTNAME $NET_STRING -onboot 1 -cores $CORE_COUNT -memory $RAM_SIZE\
  -ostype $PCT_OSTYPE -rootfs $ROOTFS  -storage $CONTAINER_STORAGE >/dev/null
msg_ok "Le Container LXC ${BL}$CTID${CL} ${GN}a été créé avec succès."
}
color
choix=$(whiptail --title "installer CT monitor ou uniquement monitor ?" --radiolist \
"Que voulez-vous installer ?\n. " 15 60 4 \
"Conteneur-Lemp-monitor" "par defaut " ON \
"Lemp-monitor" "                     " OFF 3>&1 1>&2 2>&3)
echo "Vous avez choisi  : $choix"
if [ "$choix" = "Conteneur-Lemp-monitor" ];then
header_info
formatting
variables
base_settings
install_script
build_container
msg_ok "Démarrage du conteneur LXC ..."
pct start $CTID
fi
if [ "$choix" = "Lemp-monitor" ];then
CTID=$(whiptail --title "CTID " --inputbox "veuillez entrer l'ID du conteneur \n. " 10 60 3>&1 1>&2 2>&3)
msg_ok "${BL}CTID: "$CTID
fi
msg_ok "Installation de LEMP..."
wget -qL https://raw.githubusercontent.com/mgrafr/monitor/main/install/build_monitor.sh
pct push $CTID build_monitor.sh /build_monitor.sh -perms 755
pct exec $CTID /build_monitor.sh
msg_ok "Terminé avec succès!\n"
rm build_monitor.sh
echo -e "${GN} la configuration de ${APP} a été initialisée avec succès!${CL}"
