#!/usr/bin/bash
#sur le serveur monitor actuel
chmod -R 777 /var/www/monitor/DB_Backup
chmod -R 777 /etc/letsencrypt/archive/*
nom_bd=$(whiptail --title "Bases de donnees a sauvegarder" --inputbox "Veuiller entrer les noms separes par un espace" 10 60 3>&1 1>&2 2>&3)
exitstatus=$?
if [ $exitstatus = 0 ]; then
echo "Base(s) de donnees : "$nom_bd
else
nom_bd=monitor
echo "Par defaut, base de donnees : "$nom_bd
fi
mysqldump -u root -p --databases $nom_bd  | gzip  > /var/www/monitor/DB_Backup/dump.sql.gz
pip list --format=json > /var/www/monitor/admin/connect/mod.json
ufw status > /var/www/monitor/admin/connect/ufw.txt
xxx=$(hostname -I)
echo $xxx | cut -d ' ' -f 1 > /var/www/monitor/admin/connect/ip.txt

choix_https=$(whiptail --title "accès distant" --radiolist \
"avez vous une adresse distante HTTPS ?" 15 60 4 \
"Pas de https  " "par defaut " ON \
"accès https" "voir la doc" OFF 3>&1 1>&2 2>&3)
if [ $exitstatus = 0 ]; then
   echo "Vous avez choisi  : $choix_https"
else
echo "Vous avez annulé  "
fi
if [ "$choix_https" = "accès https" ]
then
echo "pour letsencrypt remplacement port 443 par 444"
sed  -i "s/443/444/g" /etc/nginx/conf.d/monitor.conf
systemctl restart nginx
echo "------------------------------------------------------------------"
echo "NE PAS OUBLIER DE MODIFIER LA REDIRECTION DE PORTS DANS LE ROUTEUR"
echo "------------------------------------------------------------------"
fi
cd /etc/systemd/system
find . -type f -prune > /www/monitor/c.txt
