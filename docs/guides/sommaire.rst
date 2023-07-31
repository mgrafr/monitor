Sommaire
----------------

| *0._Infos pour bien débuter*
| *0.1Prérequis, installation : différents choix*
| *0.1.1 Installation automatique d’un conteneur LXC + monitor* *0.1.2
  Installation manuelle de LEMP et Monitor*
| *0.1.3 – Installation de monitor uniquement*
| *0.1.3.1 mode « découverte »*
| *0.1.3.2 -Création d’un certificat SSL auto-signé pour Nginx*

| *0.2_La page d’accueil et connexion avec Domoticzou HA*
| *0.2.1 page d’accueil*
| *0.2.2 premier dispositif*
| *0.2.2.1 pour Domoticz*
| *0.2.2.2 pour Home Assistant*
| *0.2.2.3 Affichage sur la page d’accueil de Monitor*
| *0.3 \_ Base de données Maria DB*
| *0.3.1 Les variables*
| *0.3.2 Les Dispositifs*
| *0.3.3 Les caméras*
| *0.4\_ Le serveur http de NGINX*
| *0.5\_ Le Framework Bootstrap*
| *0.6\_ Les styles CSS*
| *0.7\_ Les images*
| *0.8\_ Les fichiers PHP*
| *0.9\_ Les fichiers javascript*
| *1.\_ Configuration minimum : la page d’accueil*
| *1.1 - Configuration : le fichier /admin/config.php*
| *1.1.1 -Adresse IP, domaine, favicon de monitor*
| *1.1.2 intervalles de maj, maj temps réel*
| *1.1.3 Autres données*
| *1.2 - Les fichiers à la racine du site, les styles, le javascript*
| *1.2.1 - à la racine du site*
| *1.2.2 - les styles css*
| *1.2.3 – Le javascript*
| *1.2.3 a- Les fichiers footer.php*
| *1.2.3 b- le fichier mes_js.js : scripts principaux*
| *1.2.3 b.1 fenêtre modale modallink*
| *1.3 -Les fichiers principaux dans le répertoire /include*
| *1.3.1 entete_html.php*
| *1.3.2 Test de la base de données, test_db.php*
| *1.3.3 le menu, header.php*
| *1.3.4 la page d’accueil avec les notifications, accueil.php*
| *1.3.5 les scripts javascript, dans la page footer.php*
| *1.3.5.1 rafraichissements de la page*
| *1.3.5.2 Quelques infos supplémentaires*
| *1.4 Le lexique et la température extérieure*
| *1.4.1 Le lexique*
| *1.4.2 La température extérieure (valable pour d’autres dispositifs)*
  *1.5 liens avec Domoticz ou Home Assistant*
| *1.5.1 Liens avec Domoticz*
| *1.5.1 1 les variables LUA de configuration dans un fichier externe*
  1.5.1.2 les scripts de notifications gérées par Domoticz
| *1.5.2 Liens avec Home Assistant*
| *1.5.2.1 Exemple d’un ON OFF sur un interrupteur virtuel*
| *1.6 – Lien avec la base de données SQL*
| *1.6.1- exemple avec la date de ramassage des poubelles*
| *1.7 – Ajuster le menu au nombre de pages*
| *2.\_ Une 1ere PAGE : LE PLAN INTERIEUR*
| *2.1 l’image*
| *2.1.1-avec un logiciel de conception graphique vectorielle*
| *2.1.1.a avec Inkscape qui est gratuit*

| *2.1.1.b avec Adobe Illustrator*
| *2.1.2 – 2eme solution pour le plan, conversion en ligne*
| *2.1.3 - Les Couleurs*
| *2.1.4 - ajout d’un ou plusieurs dispositifs*
| *2.2 Des exemples d’autres dispositifs*
| *2.2.1 Ajout du détecteur de fumée*
| *2.2.2 Ajout de caméras*
| *2.3 le fichier PHP de l’image*
| *2.3.1 Pour afficher le statut complet du dispositif*
| *2.3.2 Affichage des caméras*
| *2.3.3 La gestion des dispositifs à piles*
| *2.3 4 Le contrôle de la tension d’alimentation*
| *2.3 5 ajouter des lampes*
| *2.3.6 ajouter un capteur de T° extérieur Zigbee*
| *2.3.6.1 Le capteur dans Domoticz*
| *2.3.6.2 Le capteur dans la BD*
| *2.3.6.3 Le capteur dans Monitor*
| *2.4 le fichier PHP de la page*
| *2.5 F12 des navigateurs pour faciliter la construction*
| *2.6 Les dispositifs virtuels Domoticz et MQTT*
| *3.\_ Météo*
| *3.1\_ Page météo*
| *3.2\_ La Météo à 1 heure de Météo France*
| *3.3\_ Autres prévisions météo depuis météo Concept*
| *4.\_ La page du plan extérieur*
| *4.1 – La page PHP : exterieur.php*
| *4.1 .1– Ajouter des lampes*
| *4.2. – affichage*
| *5. – L’ALARME*
| *5.1 Dans Domoticz, les interrupteurs virtuels*
| *5.1.1 explications concernant MODECT*
| *5.1.1.1 Jeton ZM*
| *5.1.1.2 le script lu*\ a
| *5.2 Construction de l’image*
| *5.3- Base de données*
| *5.4- Le PHP*
| *5.5- Le Javascript, dans footer.php*
| *5.6 -Comme pour les autres pages*
| *5.7- Affichage d’une icône sur la page d’accueil*
| *5.8 - Améliorations utiles*
| *5.8.1- la mise en marche automatiquement de l’alarme de nuit*
| *5.8.1.1 Dans Domoticz*
| *5.8.1.2 Dans Monitor*
| *5.8.2 – Alarme par sms GSM (si un modem GSM installé)*
| *5.8.2.1 Version avec une variable Domoticz*
| *5.8.2.1.1 modification du script qui assure la liaison avec le modem*
  *5.8.2.1.2 aperçus*
| *5.8.2.2 Version sans variable Domoticz*
| *5.8.2.3- Option supplémentaire : bouton de test du modem GSM* *5.8.3-
  Affichage de la liste des caméras Modect*
| *5.8.5- Copie écran de la dernière version*
| *5.8.5.1 refontes du programme en utilisant des tables*

| *6. – GRAHIQUES & BASE DE DONNEES*
| *6.1 Les table SQL*
| *6.2 Dans Domoticz*
| *6.3 Sur le serveur de la base de données*
| *6.4 Dans Monitor*
| *6.4.1 la page graphique.php*
| *6.4.2 la fonction graph*
| *6.4.3 autres fichiers PHP*
| *6.4.4 copies d’écran*
| *7. – MUR de CAMERAS*
| *7.1- les pages index_loc.php, header.php, entete_html.php*
| *7.2- la page de monitor : mur_cam.php*
| *7.3- Les scripts Javascript pour la vidéo dans footer.php*
| *7.4- Ajouter une caméra*
| *8.- MUR de COMMANDES ON/OFF*
| *8.1 les fichiers de base*
| *8.1.1 écriture automatique du javascript*
| *8.2- mur_inter.php*
| *8.2.1 Exemple pour éclairage jardin*
| *8.2.2 Exemple pour arrosage jardin*
| *8.8.3 - Exemple éclairage simple, une lampe de salon*
| *8.2.4 - Exemple volet roulant*
| *8.2.4 .1 Affichage dans monitor*
| *8.2.4 .2 Dans le mur ON/OFF*
| *8.2.4.3 le script JS*
| *8.2.4.3.1 avec Ajax et PHP*
| *8.2.4.3.2 avec MQTT*
| *9. – Dispositifs Zigbee*
| *9.1 accès distant*
| *10. – Dispositifs Zwave*
| *10.1 Accès distant*
| *11.- MONITORING Nagios*
| *11.1 accès distant*
| *11.2 Supprimer affichage « YouTube »*
| *12. - FICHIERS LOG Domoticz, Nagios, SQL*
| *12.1 AJOUT SQL*
| *12.1.1 Edition de l’historique du ramassage des poubelles*
| *12.1.2 Ajout d’une icône à l’historique des poubelles*
| *13. – APPLICATIONS externes en lien avec Domoticz ou monitor*
| *13.1 Affichage des notifications sur un téléviseur LG*
| *13.2 Portier Dahua VTO 2000 et VTO 2022*
| *13.2.1 VTO 2000A*
| *13.3 -La boite aux lettres*
| *13.4 Surveillance du PI par Domoticz*
| *13.5- Capteur de pression -chaudière*
| *13.5.1 l’image SVG* :
| *13.5.2 Dans Domoticz, le capteur, le plan, les variables et les
  scripts* *13.5.3 Dans la Base de données SQL*
| *13.5.4 Styles CSS*
| *13.6- SMS réception et émission*
| *13.6.1 réception SMS*
| *13.6.2 émission SMS*

| *13.6.2.1 Enregistrement des n° de téléphone*
| *13.7- afficher les données du compteur Linky*
| *13.7.1 enregistrement dans la BD SQL*
| *14. - ADMINISTRATION*
| *14.1- fichiers communs à toutes les pages*
| *14.2- admin.php, test_db.php et backup_bd.php*
| *14.3- le javascript*
| *14.4- fonction PHP*
| *14.5 - Téléchargement d’un fichier externe dans Domoticz*
| *14.6 - Copies d’écran*
| *14.7 Explications concernant l’importation distantes d’un tableau
  LUA*
| *14.8 Explications concernant la mise à jour automatique SQL des
  variables et dispositifs* *14.9 Explications concernant l’affichage
  des infos de la page admin.php*
| *14.10 Commandes ssh2 PC distant (ici un RPI) depuis monitor*
| *14.10.1 reboot PC (ou RPI)*
| *14.10.2 commandes scp pour l’envoi ou la réception de fichiers
  distants 15. - EXEMPLES*
| *15.1- ajout d’un dispositif*
| *15.1.1- Modifier l’image*
| *15.1.2 Dans la Base de données SQL*
| *15.1.3 Dans le fichier PHP de l’image*
| *15.2- Réinitialisation des dispositifs dans Domoticz*
| *16. – Ajouter des pages ou des alertes non incluses dans le
  programme*
| *16.1 – Ajouter un plan (ex : 1*\ er *étage)*
| *16.2 - Une page vierge, affichage d’un sous domaine distant*
| *16. 3 – Ajouter une alerte, une alarme,….*

| *16.3.1 Exemple avec un rappel pour la prise de médicaments sur la
  page d’accueil 17.- DIY*
| *17. 1 – Domotiser un SPA (ou une piscine)*
| *17.1.1. – Création de capteurs virtuels dans Domoticz*
| *17.1.2. – Création des tables PH, Redox, temp, .. ; dans la base de
  données* *17.1.3. – Envoi des données à la BD de monitor par Domoticz*
| *17.1.4. – Affichage dans Monitor*
| *17.1.4.1 la première page spa.php*
| *17.1.4.2 mises à jour ajax pour le 2eme écran de la page spa.php*
  *17.1.4.3 ajouts d’un ID dans l’image svg pour 3eme écran*
| *17.1.4.4 ajouts d’autres pages*
| *18. - Divers*
| *18.1 Debian : Installer un serveur LAMP (Apache MySQL PHP)*
| *18.2 Installer Paho-mqtt*
| *18.2.1 Le script pour envoyer des messages (mqtt.py)*
| *18.3 Liaison série Domoticz-PI*

   *18.4 Commandes de l’alarme à partir d’un GSM*

   *18.5 Données compteur Linky*

   *18.6 Complément sur l’utilisation des Mots de Passe cryptés dans
   Domoticz* *18.7 pages sans rapport avec la domotique*

   *18.7.1 Les recettes de cuisines sur la tablette domotique*

   *18.8 migrations de Domoticz différentes étapes pour ne rien oublier*

*19. – UPDATE PHP 8.2*

*20. – Résolution de problèmes*

   *20.1 concernant les variables*

| *21. – Mon installation*
| *21.1 Proxmox*
| *21.1.1 installation de VM ou CT par l’interface graphique : IP :8006*
  *21.1.2 installation automatique de VM ou CT*
| *21.1.3 installation automatique d’un conteneur LXC, LEMP & Monitor*
  *21.1.4 Aperçu des VM et CT installés*
| *21.2 Domoticz*
| *21.3 Zwave*
| *21.4 Zigbee*
| *21.5 Asterisk (sip)*
| *21.6 MQTT (mosquito)*
| *21.7 Zoneminder*
| *21.8 Plex*
| *21.9 Raspberry PI4*
| *21.9.1 Résolution de problèmes*
| *21.9.1.1 cannot-open-access-to-console-the-root-account-is-locked*
  *21.10 Home Assistant*
