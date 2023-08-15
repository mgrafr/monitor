21. – Mon installation
---------------------- 

21.1 Proxmox
^^^^^^^^^^^^
C’est la base du système, il doit être installé en premier, ensuite :
-	Un conteneur, une VM ou une partition classique 
-	Ensuite LEMP 
-	En dernier et monitor

Installation de Proxmox : assurez-vous que la virtualisation UEFI est activée dans le BIOS
http://domo-site.fr/accueil/dossiers/1
Pour terminer le processus de post-installation de Proxmox VE 7(évite de modifier manuellement les fichiers sources.list  d’apt,) vous pouvez exécuter la commande suivante dans pve Shell.
bash -c "$(wget -qLO - https://github.com/tteck/Proxmox/raw/main/misc/post-pve-install.sh)"

voir sur Github : https://github.com/StevenSeifried/proxmox-scripts
-	https://github.com/tteck/Proxmox
-	https://github.com/StevenSeifried/proxmox-scripts

 


21.1.1 installation de VM ou CT par l’interface graphique : IP :8006
====================================================================
 


21.1.2 installation automatique de VM ou CT : https://github.com/tteck/Proxmox
==============================================================================
	choisir le fichier d’installation : ex Conteneur LXC Debian 11
	 
	Copier le lien :

                
Ici : https://github.com/tteck/Proxmox/raw/main/ct/debian.sh

Télécharger le script : wget LIEN

 

	Modifier les droits du fichier : 
	 

	Lancer le script et répondre aux questions :
	
 


21.1.3 installation automatique d’un conteneur LXC,LEMP & Monitor
=================================================================
Voir le § 0.1.1

            21.1.4 Aperçu des VM et CT installés :
 

Plex est installé sur un autre mini PC sous Proxmox également, en conteneur, voir le site domo-site.fr

21.2 Domoticz
^^^^^^^^^^^^^
Installation sous Docker :
http://domo-site.fr/accueil/dossiers/84
Installation VM :
http://domo-site.fr/accueil/dossiers/2

Mes scripts lua :
 

Mes scripts bash, python et Node js :
 

 

 
Les scripts sont disponibles sur Github : https://github.com/mgrafr/monitor/tree/main/share/scripts_dz

21.3 Zwave
^^^^^^^^^^
Installation de zwave-js-ui ,
-	dans un conteneur LXC : http://domo-site.fr/accueil/dossiers/99
-	sous Docker, avec Domoticz : http://domo-site.fr/accueil/dossiers/86
Affichage dans monitor :
 

Configuration de l’hôte virtuel Nginx pour affichage dans monitor :
 

 


21.4 Zigbee
^^^^^^^^^^^
Installation de zigbee2mqtt  :
-	sous Docker : http://domo-site.fr/accueil/dossiers/88
-	dans un conteneur LXC : http://domo-site.fr/accueil/dossiers/94

Affichage dans monitor :
 

Configuration de l’hôte virtuel Nginx pour affichage dans monitor :
 

Plus de commentaires dans le paragraphe précédent

21.5 Asterisk (sip)
^^^^^^^^^^^^^^^^^^^
Installation dans une VM :  http://domo-site.fr/accueil/dossiers/9

Il n’est pas utile de créer un hôte virtuel sur Nginx, les modifications, mises à jour,…peuvent se faire sur Proxmox.

21.6 MQTT (mosquito)
^^^^^^^^^^^^^^^^^^^^
Installation dans une VM :  http://domo-site.fr/accueil/dossiers/47

Comme pour Asterisk , il n’est pas utile de créer un hôte virtuel.


21.7 Zoneminder
^^^^^^^^^^^^^^^
Installation dans une VM :  http://domo-site.fr/accueil/dossiers/24
Ce serveur est nécessaire pour :
-	 L’affichage du mur de caméras
-	La détection (mode modect) de présence pour l’alarme


 

Configuration de l’hôte virtuel Nginx
 

21.8 Plex
^^^^^^^^^
Installation :
-	dans un conteneur LXC : http://domo-site.fr/accueil/dossiers/95
-	dans une VM  : http://domo-site.fr/accueil/dossiers/53

partage samba pour Plex (conteneur LXC) : http://domo-site.fr/accueil/dossiers/93

affichage dans un navigateur ou TV : IP :32400/web
 


Configuration de l’hôte virtuel Nginx pour accès distant
 

21.9 Raspberry PI4
^^^^^^^^^^^^^^^^^^
Alimenté en 12 Volts , comme le mini PC Proxmox, le PI4 couplé à un modem GSM assure l’envoi et la réception des sms même en cas de coupure d’alimentation électrique ENEDIS ; L’alarme ainsi que toute les commandes Domoticz restent opérationnelles.
Le serveur Domoticz et ce PI4 sont reliés par une liaison série ; à partir d’un smartphone l’envoi de sms permet de commander directement des switches par l’intermédiaire de l’API de Domoticz( http://localhost:PORT
Le système est sauvegardé par le logiciel Raspibackup :
 http://domo-site.fr/accueil/dossiers/81

Le PI4 assure aussi :
-	La sauvegarde RAID1, mais celle-ci n’est pas sauvegardée et un reboot du PI est nécessaire en cas de coupure de courant ; une fonction existe, pour cela, dans monitor….. http://domo-site.fr/accueil/dossiers/60

-	Le monitoring (Nagios) : http://domo-site.fr/accueil/dossiers/71

Conf Nginx :

Installation du système et du raid1 : http://domo-site.fr/accueil/dossiers/60

Scripts installés en plus de raspibackup et Nagios :
 
-	msmtp , pour envoyer des emails facilement 
config :
 


Affichage dans monitor :
 

21.9.1 Résolution de problèmes :
================================
21.9.1.1  cannot-open-access-to-console-the-root-account-is-locked

https://www.msn.com/fr-fr/feed
Si votre Raspberry Pi (RPI) ne démarre pas et affiche "Impossible d'ouvrir l'accès à la console, le compte root est verrouillé sur l'écran de démarrage : 

Mode d’emploi pour revenir à la situation normale

/etc/fstab  à certainement  une entrée non prise en charge. C’est ce qui se passe si un disque USB externe est déconnecté ou remplacé

Pour résoudre ce problème, sortez la carte SD ou la clé USB du PI et branchez-la sur votre ordinateur. Ignorez les demandes de formatage et explorer la partition « boot »  .
Ouvrir le fichier appelé cmdline.txt dans le Bloc-notes ou Notepad et ajouter init=/bin/sh à la fin de la première ligne .
 

Enregistrez le fichier et remettez la carte SD ou la clé USB dans le PI et bootez. Un clavier et un écran sont raccordés au PI ; sur l’écran on peut alors constater qu’une console en bash est alors disponible pour effectuer des modification sur le fichier /etc/fstab.

sudo nano /etc/fstab
 
Commenter ou supprimer la ligne défectueuse 
Enregistrer le fichier, CTRL O, ENTER, CTRL X
Eteindre le PI, retirer la carte SD ou la clé USB pour supprimer init=/bin/sh du fichier cmdline.txt
Redémarrer le Pi 

S’il n’est pas possible de modifier /etc/fstab (écriture non autorisée), il faut alors remonter la partition (/dev/sda2 pour une clé USB ou /dev/ mmcblk0p2 pour une SD Card).
La commande à effectuer :


mount -o remount,rw  /partition root  /
 

pour monter les partitions sans redémarrer :
 



21.10 Home Assistant
^^^^^^^^^^^^^^^^^^^^
Installation : http://domo-site.fr/accueil/dossiers/61

Script automatique :
bash -c "$(wget -qLO - https://github.com/tteck/Proxmox/raw/main/vm/haos-vm-v5.sh)"
 
 

 

 

 
 
 

