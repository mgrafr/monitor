#!/usr/bin/bash

cd /www/monitor
rm maj*
version=$(head -n 1 .version)
echo $version
vermon=$(whiptail --title "version de monitor" --radiolist \
"Vers quelle version voulez vous mettre à jour ?\n la version en développement\n ou la version LATEST " 15 60 4 \
"Version 4.1.1" "par defaut " ON \
"Version en dev" "voir la doc" OFF 3>&1 1>&2 2>&3)
exitstatus=$?
# ------------------------------
if [ $exitstatus = 0 ]; then
   echo "Vous avez choisi  : $vermon"
else
echo "Vous avez annulé  "
fi
answer=$(echo $version | tr -d .)
echo $answer
apt update
apt install dos2unix
apt install unzip
if [ "$vermon" = "Version 411" ] && [ "$answer" -gt 324 ] && [ "$answer" -ne 411 ]; then
    echo "mise a jour vers 4.1.1"
    wget https://raw.githubusercontent.com/mgrafr/monitor/main/install/maj_410.sh
    dos2unix maj_411.sh
    chmod +x maj_411.sh 
    ./maj_411.sh
    rm maj_411.sh
 elif [ "$vermon" =  "Version 4.1.1" ] && [ "$answer" -eq 324 ]; then 
    echo "mise a jour vers 4.1.1"
    wget https://raw.githubusercontent.com/mgrafr/monitor/main/install/maj_324.sh
    dos2unix maj_324.sh
    chmod +x maj_324.sh 
    ./maj_324.sh
    rm maj_324.sh
 elif [ "$vermon" =  "Version 4.1.1" ] && [ "$answer" -eq 411 ]; then  
     echo "deja a jour"
 elif [ "$vermon" = "Version 4.1.1" ] && [ "$answer" -lt 324 ] && [ "$answer" -gt 322 ]; then 
    echo "mise a jour vers 4.1.1"
    wget https://raw.githubusercontent.com/mgrafr/monitor/main/install/maj_324.sh
    dos2unix maj_324.sh
    chmod +x maj_324.sh 
    ./maj_324.sh
    rm maj_324.sh
 elif [ "$vermon" = "Version en dev" ] && [ "$answer" -lt 324 ] && [ "$answer" -gt 322 ]; then  
      echo "mettre à jour vers version 4.1.1" avant une mise à jour DEV     
 elif [ "$vermon" = "Version en dev" ] && [ "$answer" -gt 324 ] && [ "$answer" -lt 411 ] ; then  
      echo "mise à jour vers version dev"  
      wget https://raw.githubusercontent.com/mgrafr/monitor/main/install/maj_dev.sh
      dos2unix maj_dev.sh
      chmod +x maj_dev.sh 
      ./maj_dev.sh
      rm maj_dev.sh
 else  
    echo "faire maj complete"
 fi
  
 


