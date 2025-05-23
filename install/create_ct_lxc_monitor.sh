#!/usr/bin/env bash
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
 }
echo_config() {
 echo -e "${DGN}Distribution: ${BGN}$OSTYPE${CL}"
 echo -e "${DGN}Version de $OSTYPE : ${BGN}$OSVERSION${CL}"
 echo -e "${DGN}Type Container(1=privilégié): ${BGN}$privilegie${CL}"
 echo -e "${DGN}Mot de Passe ROOT: ${BGN}$PW${CL}"
 echo -e "${DGN}Using Hostname: ${BGN}$HOSTNAME${CL}"
 echo -e "${DGN}Capacité du disque: ${BGN}$DISK_SIZE${CL}${DGN}GB${CL}"
 echo -e "${DGN}Coeurs alloués ${BGN}$nb_cores${CL}"
 echo -e "${DGN}Mémoire allouée ${BGN}$var_cpu${CL}"
 echo -e "${DGN}Bridge: ${BGN}vmbr0${CL}"
 echo -e "${DGN}IP statique ou DHCP: ${BGN}DHCP${CL}"
} 
pve_check() {
  if [ $(pveversion | grep -c "pve-manager/8\.[0-9]") -eq 0 ]; then
    echo -e "${CROSS} This version of Proxmox Virtual Environment is not supported"
    echo -e "Requires PVE Version 8.0 or higher"
    echo -e "Exiting..."
    sleep 2
    exit
  fi
}
msg() {
  local msg="$1"
  echo -e "${BGN} ${CL} ${msg}${CL}"
}
function info() {
  local REASON="$1"
  local FLAG="\e[36m[INFO]\e[39m"
  msg "$FLAG $REASON"
}

color
header_info
pve_check
if ! (whiptail --title "${APP} LXC" --yesno "CE script va creer un nouveau conteneur ${APP} LXC. executer?" 10 58); then
      clear
      echo -e "⚠  User exited script \n"
      exit
 fi
while true; do
    NET=$(whiptail --backtitle "Proxmox CT Monitor" --inputbox "Définir une adresse IPv4 CIDR (/24)" 8 58 dhcp --title "IP ADDRESS" 3>&1 1>&2 2>&3)
    exit_status=$?
    if [ $exit_status -eq 0 ]; then
      if [ "$NET" = "dhcp" ]; then
        echo -e "${DGN}Adresse IP utilisée: ${BGN}$NET${CL}"
        break
      else
        if [[ "$NET" =~ ^([0-9]{1,3}\.){3}[0-9]{1,3}/([0-9]|[1-2][0-9]|3[0-2])$ ]]; then
          echo -e "${DGN}Adresse IP utilisée: ${BGN}$NET${CL}"
          break
        else
          whiptail --backtitle "Proxmox CT Monitor" --msgbox "$NET est une IPv4 CIDR invalide. SVP entrer une valide IPv4 CIDR address ou 'dhcp'" 8 58
        fi
      fi
    else
      exit-script
    fi
  done

  if [ "$NET" != "dhcp" ]; then
    while true; do
      GATE1=$(whiptail --backtitle "Proxmox CT Monitor" --inputbox "Entrer l'IP de la passerelle" 8 58 --title "Gateway IP" 3>&1 1>&2 2>&3)
      if [ -z "$GATE1" ]; then
        whiptail --backtitle "Proxmox CT Monitor" --msgbox "L'adresse IP de la passerellene peut être vide" 8 58
      elif [[ ! "$GATE1" =~ ^([0-9]{1,3}\.){3}[0-9]{1,3}$ ]]; then
        whiptail --backtitle "Proxmox CT Monitor" --msgbox "Invalide format adresse IP" 8 58
      else
        GATE=",gw=$GATE1"
        echo -e "${DGN}Passerelle IP Addresse: ${BGN}$GATE1${CL}"
        break
      fi
    done
  else
    GATE=""
    echo -e "${DGN}Passerelle  IP Addresse: ${BGN}Default${CL}"
  fi


PW=$(whiptail --title "Mot Passe ROOT" --passwordbox "Entrer le mot de passe ROOT" 10 60 3>&1 1>&2 2>&3)
exitstatus=$?
if [ $exitstatus = 0 ]; then
 info "Mot de passe enregistré"
fi

set -o errexit  
set -o errtrace
set -o nounset  
set -o pipefail 
shopt -s expand_aliases
alias die='EXIT=$? LINE=$LINENO error_exit'
trap die ERR
CHECKMARK='\033[0;32m\xE2\x9C\x94\033[0m'
trap cleanup EXIT

function error_exit() {
  trap - ERR
  local DEFAULT='Unknown failure occured.'
  local REASON="\e[97m${1:-$DEFAULT}\e[39m"
  local FLAG="\e[91m[ERROR] \e[93m$EXIT@$LINE"
  msg "$FLAG $REASON"
  [ ! -z ${CTID-} ] && cleanup_ctid
  exit $EXIT
}
function warn() {
  local REASON="\e[97m$1\e[39m"
  local FLAG="\e[93m[WARNING]\e[39m"
  msg "$FLAG $REASON"
}

function cleanup_ctid() {
  if [ ! -z ${MOUNT+x} ]; then
    pct unmount $CTID
  fi
  if $(pct status $CTID &>/dev/null); then
    if [ "$(pct status $CTID | awk '{print $2}')" == "running" ]; then
      pct stop $CTID
    fi
    pct destroy $CTID
  elif [ "$(pvesm list $STORAGE --vmid $CTID)" != "" ]; then
    pvesm free $ROOTFS
  fi
}
function cleanup() {
  popd >/dev/null
  rm -rf $TEMP_DIR
}
function load_module() {
  if ! $(lsmod | grep -Fq $1); then
    modprobe $1 &>/dev/null || \
      die "Failed to load '$1' module."
  fi
  MODULES_PATH=/etc/modules
  if ! $(grep -Fxq "$1" $MODULES_PATH); then
    echo "$1" >> $MODULES_PATH || \
      die "Failed to add '$1' module to load at boot."
  fi
}
TEMP_DIR=$(mktemp -d)
pushd $TEMP_DIR >/dev/null

wget -qL https://raw.githubusercontent.com/mgrafr/monitor/main/install/lemp_monitor_install.sh

load_module overlay

while read -r line; do
  TAG=$(echo $line | awk '{print $1}')
  TYPE=$(echo $line | awk '{printf "%-10s", $2}')
  FREE=$(echo $line | numfmt --field 4-6 --from-unit=K --to=iec --format %.2f | awk '{printf( "%9sB", $6)}')
  ITEM="  Type: $TYPE Free: $FREE "
  OFFSET=2
  if [[ $((${#ITEM} + $OFFSET)) -gt ${MSG_MAX_LENGTH:-} ]]; then
    MSG_MAX_LENGTH=$((${#ITEM} + $OFFSET))
  fi
  STORAGE_MENU+=( "$TAG" "$ITEM" "OFF" )
done < <(pvesm status -content rootdir | awk 'NR>1')
if [ $((${#STORAGE_MENU[@]}/3)) -eq 0 ]; then
  warn "'Container' needs to be selected for at least one storage location."
  die "Unable to detect valid storage location."
elif [ $((${#STORAGE_MENU[@]}/3)) -eq 1 ]; then
  STORAGE=${STORAGE_MENU[0]}
else
  while [ -z "${STORAGE:+x}" ]; do
    STORAGE=$(whiptail --title "Storage Pools" --radiolist \
    "Quel pool de stockage voulez-vous utiliser pour ce conteneur?\n\n" \
    16 $(($MSG_MAX_LENGTH + 23)) 6 \
    "${STORAGE_MENU[@]}" 3>&1 1>&2 2>&3) || exit
  done
fi
info "Utilisation de'$STORAGE' pour stocker le conteneur."

CTID=$(pvesh get /cluster/nextid)
info "ID du conteneur : $CTID."

echo -e "${CHECKMARK} \e[1;92m MAJ de la liste des Modèles LXC... \e[0m"
pveam update >/dev/null
echo -e "${CHECKMARK} \e[1;92m Téléchargement du Modèle Debian 12... \e[0m"
OSTYPE=debian
OSVERSION=${OSTYPE}-12
mapfile -t TEMPLATES < <(pveam available -section system | sed -n "s/.*\($OSVERSION.*\)/\1/p" | sort -t - -k 2 -V)
TEMPLATE="${TEMPLATES[-1]}"
pveam download local $TEMPLATE >/dev/null ||
  die "A problem occured while downloading the LXC template."

STORAGE_TYPE=$(pvesm status -storage $STORAGE | awk 'NR>1 {print $2}')
case $STORAGE_TYPE in
  dir|nfs)
    DISK_EXT=".raw"
    DISK_REF="$CTID/"
    ;;
  zfspool)
    DISK_PREFIX="subvol"
    DISK_FORMAT="subvol"
    ;;
esac
DISK=${DISK_PREFIX:-vm}-${CTID}-disk-0${DISK_EXT-}
ROOTFS=${STORAGE}:${DISK_REF-}${DISK}

echo -e "${CHECKMARK} \e[1;92m Création du Conteneur LXC ... \e[0m"
DISK_SIZE=16G
pvesm alloc $STORAGE $CTID $DISK $DISK_SIZE --format ${DISK_FORMAT:-raw} >/dev/null
if [ "$STORAGE_TYPE" == "zfspool" ]; then
  warn "Some containers may not work properly due to ZFS not supporting 'fallocate'."
else
  mkfs.ext4 $(pvesm path $ROOTFS) &>/dev/null
fi
ARCH=$(dpkg --print-architecture)
HOSTNAME=monitor
TEMPLATE_STRING="local:vztmpl/${TEMPLATE}"
var_cpu=2048
nb_cores=2
privilegie=1
pct create $CTID $TEMPLATE_STRING -arch $ARCH -features nesting=$privilegie -password $PW \
  -hostname $HOSTNAME -net0 name=eth0,bridge=vmbr0$GATE,ip=$NET -onboot 1 -cores $nb_cores -memory $var_cpu\
  -ostype $OSTYPE -rootfs $ROOTFS,size=$DISK_SIZE -storage $STORAGE >/dev/null

MOUNT=$(pct mount $CTID | cut -d"'" -f 2)
ln -fs $(readlink /etc/localtime) ${MOUNT}/etc/localtime
pct unmount $CTID && unset MOUNT

echo -e "${CHECKMARK} \e[1;92m Démarrage du conteneur LXC ... \e[0m"
pct start $CTID
echo -e "${CHECKMARK} \e[1;92m Installation de LEMP... \e[0m"
pct push $CTID lemp_monitor_install.sh /lemp_monitor_install.sh -perms 755
pct exec $CTID /lemp_monitor_install.sh 

IP=$(pct exec $CTID ip a s dev eth0 | sed -n '/inet / s/\// /p' | awk '{print $2}')
info "Le Conteneur LXC $CTID a été crée pour monitor"
echo_config
