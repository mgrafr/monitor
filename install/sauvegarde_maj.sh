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
echo "pour letsencrypt remplacement port 443 par 444"
sed  -i "s/443/444/g" /etc/nginx/conf.d/monitor.conf
systemctl restart nginx
cd /etc/systemd/system
find . -type f -prune > /www/monitor/c.txt
echo "------------------------------------------------------------------"
echo "NE PAS OUBLIER DE MODIFIER LA REDIRECTION DE PORTS DANS LE ROUTEUR"
echo "------------------------------------------------------------------"