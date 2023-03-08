#!/usr/bin/env bash

REPOSITORY=/pve/raid_usb/pi_nagios
LOG_PATH=/var/log/borg-backup.log
# fichier externe qui fournit la phrase secrète :
export BORG_PASSCOMMAND='/pve/raid_usb/borg'

# Sauvegarde des répertoires 

borg create -v --stats                  \
 $REPOSITORY::'rpi-{now:%Y-%m-%d}' \
	/bin  \
	/boot \
	/etc  \
	/home \
	/lib  \
	/opt  \
	/root \
	/sbin \
	/usr  \
	/var  \


# Nettoyage des sauvegardes
# seront conservées :
# - une archive par jour les 7 derniers jours,
# - une archive par semaine les 4 dernières semaines,
# - une archive par mois les 6 derniers mois.
 
borg prune -v  $REPOSITORY \
        --keep-daily=7 \
        --keep-weekly=4 \
        --keep-monthly=6 \
>> ${LOG_PATH} 2>&1


