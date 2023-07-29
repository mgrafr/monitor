| |image1| **Logiciel monitor version 2.2.0** *maj manuel 2.2.1 du
  27/07/2023*
| **Compatible Domoticz & Home assistant**

**Dernières modifications :**

| Version 2.1
| 31/03/2023 : début de l’adaptabilité à Home Assistant, l’affichages
  des valeurs des dispositifs, l’utilisation des variables et la
  commande de switches virtuels sont opérationnelles.

| 13/04/2023 : ajout certificat auto-signé pour Nginx
| 01/05/2023 : ajout reboot serveur distant et scp pour fichiers
  distants
| 05/05/2023 : maj automatique des IP lors de changements de serveurs
| 20/05/2023 : scripts automatiques d’installation
| 01/07/2023 : 3 scripts différents d’installation et version 2.1
  (update vers Debian 12) 20/07/2023 : explication concernant l’envoi
  par Domoticz de SMS
| Version 2.2
| 26/07/2023 : suite à la modification de l’API Domoticz (devices
  remplacé par getdevices), ……………………..mise à jour de fonctions.php
| 26/07/2023 : accès shell Domoticz-Docker avec SSH2

|image2| Tous les fichiers sont sur Github :

| **Sommaire :**
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

   **0._Infos pour bien débuter**

   **0.1Prérequis, installation :** différents choix

   - Après *l’installation de Proxmox :*

   Installation automatique : conteneur LXC, LEMP (Linux, Nginx, Maria
   DB, PHP),

   monitor :

   - installation automatique : LEMP + monitor (pour installation dans
   une VM ou une partition Linux) :

   - installation uniquement de monitor (pour une installation avec
   LAMP, MySQL,) :

   **0.1.1 installation automatique d’un conteneur LXC +LEMP+ monitor**
   - L’installation de Proxmox voir ce *paragraphe.*

   - Création d’un conteneur LXC

   - Debian 12, et les dépendances sudo, curl, ….

   | - Nginx, PHP 8.2, maria db, phpMyAdmin, monitor - Quelques
     programme python utiles : pip, Paho-mqtt - Un utilisateur système
     est crée
   | - Un utilisateur MySQL PMA et monitor est aussi crée

   | Télécharger depuis le Shell de PVE le fichier d’installation
     install.sh :
   | wget

   .. image:: vertopal_6e277aed43794de08da7229da055806a/media/image3.png
      :width: 6.3in
      :height: 1.83472in

   Donner des autorisations au fichier « create_ct_lxc_monitor.sh »
   chmod +x create_ct_lxc_monitor.sh

   .. image:: vertopal_6e277aed43794de08da7229da055806a/media/image4.png
      :width: 3.42778in
      :height: 0.30278in

+-----------------------------------------------------------------------+
|    | Si des problèmes de lecture existent, convertir le fichier en    |
|      UNIX – installer do2unix *: apt install dos2unix*                |
|    | ocommande : dos2unix NOM_FICHIER (*ex : dos2unix*                |
|      *lemp_install.sh)*                                               |
+=======================================================================+
+-----------------------------------------------------------------------+

..

   **Installation :** ./create_ct_lxc_monitor.sh

   .. image:: vertopal_6e277aed43794de08da7229da055806a/media/image5.png
      :width: 3.42778in
      :height: 0.3125in

   .. image:: vertopal_6e277aed43794de08da7229da055806a/media/image6.png
      :width: 4.21944in
      :height: 1.08333in

   .. image:: vertopal_6e277aed43794de08da7229da055806a/media/image7.png
      :width: 5.60556in
      :height: 2.02083in

.. image:: vertopal_6e277aed43794de08da7229da055806a/media/image8.png
   :width: 5.66806in
   :height: 1.77083in

.. image:: vertopal_6e277aed43794de08da7229da055806a/media/image9.png
   :width: 5.77222in
   :height: 2.875in

Choisir le langage UTF-8 : fr_FR.UTF-8

.. image:: vertopal_6e277aed43794de08da7229da055806a/media/image10.png
   :width: 6.30139in
   :height: 5.00694in

.. image:: vertopal_6e277aed43794de08da7229da055806a/media/image11.png
   :width: 5.78333in
   :height: 2.33333in

.. image:: vertopal_6e277aed43794de08da7229da055806a/media/image12.png
   :width: 5.80278in
   :height: 2.80278in

.. image:: vertopal_6e277aed43794de08da7229da055806a/media/image13.png
   :width: 5.75139in
   :height: 1.89583in

.. image:: vertopal_6e277aed43794de08da7229da055806a/media/image14.png
   :width: 6.30139in
   :height: 5.84583in

.. image:: vertopal_6e277aed43794de08da7229da055806a/media/image15.png
   :width: 5.63611in
   :height: 1.83333in

.. image:: vertopal_6e277aed43794de08da7229da055806a/media/image16.png
   :width: 5.69861in
   :height: 2.77083in

.. image:: vertopal_6e277aed43794de08da7229da055806a/media/image17.png
   :width: 5.82222in
   :height: 5.10417in

Sécuriser Maria DB, mot passe root

.. image:: vertopal_6e277aed43794de08da7229da055806a/media/image18.png
   :width: 5.86528in
   :height: 1.99028in

.. image:: vertopal_6e277aed43794de08da7229da055806a/media/image19.png
   :width: 6.05278in
   :height: 2.37083in

.. image:: vertopal_6e277aed43794de08da7229da055806a/media/image20.png
   :width: 6.05278in
   :height: 2.08333in

.. image:: vertopal_6e277aed43794de08da7229da055806a/media/image21.png
   :width: 6.07361in
   :height: 1.9375in

**créer un certificat SSL auto-signé pour Nginx**

Il suffit de répondre (O)ui pour créer ce certificat, sinon taper (N)on

| http reste disponible ce qui permet d’éviter les restrictions CORS
  pour afficher d’autres serveurs comme Zigbee, Zwave, Nagios, ……
| Pour une installation manuelle de ce certificat, *voir le paragraphe
  0.1.3*
| Pour l’utiliser avec HA, ajouter dans /config/configuration.yaml

.. image:: vertopal_6e277aed43794de08da7229da055806a/media/image22.png
   :width: 2.60555in
   :height: 1.25972in

.. image:: vertopal_6e277aed43794de08da7229da055806a/media/image23.png
   :width: 5.62639in
   :height: 2.75in

TAB, ENTER

.. image:: vertopal_6e277aed43794de08da7229da055806a/media/image24.png
   :width: 5.05278in
   :height: 3.8125in

**Vérifications en cas de problèmes :**

.. image:: vertopal_6e277aed43794de08da7229da055806a/media/image25.png
   :width: 2.42778in
   :height: 2.1625in

**Pour accéder en écriture aux fichiers dans /www/html/monitor, donner
des droits :**

chmod -R 777 /www/html/\*

.. image:: vertopal_6e277aed43794de08da7229da055806a/media/image26.png
   :width: 2.84444in
   :height: 0.29167in

MySQL :

mysql -u root

.. image:: vertopal_6e277aed43794de08da7229da055806a/media/image27.png
   :width: 5.80278in
   :height: 4.07361in

| phpMyAdmin :
| Accès par monitor :

.. image:: vertopal_6e277aed43794de08da7229da055806a/media/image28.png
   :width: 3.03194in
   :height: 4.30278in

Ou en ajoutant l’adresse dans le navigateur :

.. image:: vertopal_6e277aed43794de08da7229da055806a/media/image29.png
   :width: 3.13611in
   :height: 3.4in

.. image:: vertopal_6e277aed43794de08da7229da055806a/media/image30.png
   :width: 4.83333in
   :height: 2.5375in

Les tables installées lors de l’installation :

.. image:: vertopal_6e277aed43794de08da7229da055806a/media/image31.png
   :width: 2.14722in
   :height: 1.01111in

| La suite, mode découverte : *§ 0.1.3.1*
| **0.1.2 -Installation automatique de LEMP et Monitor :**
| **Installer auparavant un système Debian 12 ou supérieur**
| Télécharger le script : lemp_monitor_install.sh,

.. image:: vertopal_6e277aed43794de08da7229da055806a/media/image32.png
   :width: 6.30139in
   :height: 0.20555in

   | Donner des autorisations au fichier lemp_install.sh chmod +x
     lemp_monitor_install.sh
   | Lancer le script : ./lemp_monitor_install.sh

   .. image:: vertopal_6e277aed43794de08da7229da055806a/media/image33.png
      :width: 3.32361in
      :height: 0.42639in

**La suite : ICI**

| **0.1.3 – Installation de monitor uniquement**
| Après l’installation d’un OS (Debian, Ubuntu…et LEMP ou LAMP, Maria DB
  ou MySQL ...

| Quelques liens utiles :
| ophpMyAdmin, voir
| oLAMP :
| o LEMP : *voir ce paragraphe*
| Installation :
| - Soit télécharger et extraire le fichier :

   .. image:: vertopal_6e277aed43794de08da7229da055806a/media/image34.png
      :width: 3.3125in
      :height: 2.98333in

   | - Soit cloner le référentiel :
   | Commande : git clone <REPERTOIRE_DESTINATION> Git doit avoir été
     installé : sur Debian ou Ubuntu, apt install git
   | - soit télécharger en bash avec wget :

   Et apprès avoir rendu exécutable le fichier, le lancer :

   .. image:: vertopal_6e277aed43794de08da7229da055806a/media/image35.png
      :width: 6.3in
      :height: 1.87361in

   .. image:: vertopal_6e277aed43794de08da7229da055806a/media/image36.png
      :width: 2.85278in
      :height: 0.32222in

   Choisir le serveur web pour une installation de monitor dans le bon
   répertoire ;

   Choisir « autre » si Apache ou Nginx ne sont pas utilisé, monitor
   sera installé dans « /tmp » il suffira alors de créer un lien
   symbolique vers le serveur web.

   Si un répertoire « monitor » existe déjà sur le chemin choisi
   (précédente installation), le supprimer

   .. image:: vertopal_6e277aed43794de08da7229da055806a/media/image37.png
      :width: 5.70694in
      :height: 2.65694in

   .. image:: vertopal_6e277aed43794de08da7229da055806a/media/image38.png
      :width: 4.15556in
      :height: 1.3125in

**0.1.3.1 mode « découverte »**

**IMPORTANT** : après l’installation le programme est en mode «
découverte », pour utiliser Domoticz et toutes les fonctions nécessitant
des tables de la base de données, **désactiver le mode « découverte »
;**

En profiter pour changer le mot de passe actuel 1234

Pour cela soit :

   - Utiliser la fonction du programme

   .. image:: vertopal_6e277aed43794de08da7229da055806a/media/image39.png
      :width: 3.55139in
      :height: 4.39861in

   .. image:: vertopal_6e277aed43794de08da7229da055806a/media/image40.png
      :width: 3.58472in
      :height: 3.96806in

   - Modifier le fichier /admin/config.php

.. image:: vertopal_6e277aed43794de08da7229da055806a/media/image41.png
   :width: 5.41528in
   :height: 1.05278in

.. image:: vertopal_6e277aed43794de08da7229da055806a/media/image42.png
   :width: 5.41667in
   :height: 0.71944in

Pour utiliser Domoticz ou Home Assistant ou les 2 : Indiquer l‘ IP et le
port

.. image:: vertopal_6e277aed43794de08da7229da055806a/media/image43.png
   :width: 6.30139in
   :height: 1.37639in

| **Logiciels utiles :**
| - Logiciel d’édition d’images svg : Adobe Illustrator ou Inkscape
| - Pour les autres images webp, un convertisseur en ligne :

| **0.1.3.2 -Création d’un certificat SSL auto-signé pour Nginx** :
| Dans le cas où l’installation n’est pas automatique ; en automatique
  il suffit d’accepter la création du certificat.

| Avant de commencer, vous devez avoir un utilisateur non root configuré
  avec des privilèges ; si vous avez installé Monitor en suivant ce
  tuto, c’est déjà fait
| **Étape 1 : Créer le certificat SSL**
| sudo openssl req -x509 -nodes -days 365 -newkey rsa:2048 -keyout
  /etc/ssl/private/nginx-
| selfsigned.key -out /etc/ssl/certs/nginx-selfsigned.crt

.. image:: vertopal_6e277aed43794de08da7229da055806a/media/image44.png
   :width: 5.81528in
   :height: 3.61389in

| *Explications :*
| - openssl : l’outil en ligne de commande pour créer et gérer des
  certificats, clés ,….

- req : cette commande spécifie que nous voulons utiliser la gestion des
demandes de signature de certificat (CSR) X.509. (C’est une norme
d’infrastructure à clé publique à laquelle SSL et TLS adhèrent pour sa
gestion des clés et des certificats).

| -x509 : pour compléter la commande précédente en indiquant que nous
  voulons créer un -
| certificat auto-signé.

- -nodes: pour ignorer l’option de sécurisation de notre certificat avec
une phrase secrète. Une phrase secrète empêcherait Nginx de démarrer
normalement car il faudrait saisir la phrase secrète à chaque démarrage.

| - -days 365 : la durée en jours de validité du certificat
| - -newkey rsa:2048 : pour générer un nouveau certificat et une
  nouvelle clé en une seule fois.

| Il est indiqué de créer une clé RSA de 2048 bits
| - -keyout : emplacement du fichier de la clé privée généré.

- -out: emplacement du certificat créé.

Les deux fichiers créés sont placés dans les sous-répertoires appropriés
du répertoire /etc/ssl

.. image:: vertopal_6e277aed43794de08da7229da055806a/media/image45.png
   :width: 3.67778in
   :height: 0.54167in

| **Confidentialité persistante**
| sudo openssl dhparam -out /etc/ssl/certs/dhparam.pem 2048

.. image:: vertopal_6e277aed43794de08da7229da055806a/media/image46.png
   :width: 6.30139in
   :height: 3.40417in

C’est assez long

| **Étape 2 : Configurer Nginx pour utiliser SSL**
| Créer 2 lignes de configuration dans un fichier pointant vers la clé
  SSL et le certificat - Créer le fichier self-signed.conf dans
  /etc/nginx/snippets
| - cd /etc/nginx/snippets
| - sudo nano self-signed.conf
| Ajouter
| #certificat et clé privée
| ssl_certificate /etc/ssl/certs/nginx-selfsigned.crt;
| ssl_certificate_key /etc/ssl/private/nginx-selfsigned.key;

   .. image:: vertopal_6e277aed43794de08da7229da055806a/media/image47.png
      :width: 4.5in
      :height: 0.84306in

Ctrl X, Enter, ctrl X

| Créer un bloc de configuration avec des paramètres de chiffrement
  forts - Comme précédemment créer fichier ssl-params.conf
| - sudo nano ssl-params.conf
| Ajouter :

+-----------------------------------------------------------------------+
|    # from https://cipherli.st/                                        |
+=======================================================================+
+-----------------------------------------------------------------------+

+-----------------------------------------------------------------------+
|    # and                                                              |
|    https://raymii.org/s/tutorials/Strong_SSL_Security_On_nginx.html   |
|                                                                       |
|    | ssl_protocols TLSv1 TLSv1.1 TLSv1.2;                             |
|    | ssl_prefer_server_ciphers on;                                    |
|    | ssl_ciphers "EECDH+AESGCM:EDH+AESGCM:AES256+EECDH:AES256+EDH";   |
|      ssl_ecdh_curve secp384r1;                                        |
|    | ssl_session_cache shared:SSL:10m;                                |
|    | ssl_session_tickets off;                                         |
|    | ssl_stapling on;                                                 |
|    | ssl_stapling_verify on;                                          |
|    | resolver 8.8.8.8 8.8.4.4 valid=300s;                             |
|    | resolver_timeout 5s;                                             |
|    | # Disable preloading HSTS for now. You can use the commented out |
|      header line that includes                                        |
|    | # the "preload" directive if you understand the implications.    |
|                                                                       |
|    | #add_header Strict-Transport-Security "max-age=63072000;         |
|    | includeSubdomains; preload";                                     |
|    | add_header Strict-Transport-Security "max-age=63072000;          |
|      includeSubdomains"; add_header X-Frame-Options DENY;             |
|    | add_header X-Content-Type-Options nosniff;                       |
|                                                                       |
|    ssl_dhparam /etc/ssl/certs/dhparam.pem;                            |
+=======================================================================+
+-----------------------------------------------------------------------+

.. image:: vertopal_6e277aed43794de08da7229da055806a/media/image48.png
   :width: 6.30139in
   :height: 4.54861in

Ajustez la configuration Nginx pour utiliser SSL : extrait de
monitor.conf

+-----------------------------------------------------------------------+
|    server {                                                           |
|                                                                       |
|    | listen 80 ;                                                      |
|    | listen [::]:80 ;                                                 |
|    | server_name 192.168.1.127;                                       |
|                                                                       |
|    | # SSL configuration                                              |
|    | listen 443 ssl ;                                                 |
|    | listen [::]:443 ssl;                                             |
|    | include /etc/nginx/snippets/selfsigned.conf;                     |
|    | include /etc/nginx/snippets/ssl-params.conf;                     |
|                                                                       |
|    | root /www/html;                                                  |
|    | index index.php index.html index.htm;                            |
|                                                                       |
|    | location ~ \\.php$ {                                             |
|    | fastcgi_split_path_info ^(.+\\.php)(/.+)$;                       |
|    | fastcgi_pass unix:/var/run/php/php8.2-fpm.sock;                  |
|    | fastcgi_index index.php;                                         |
|    | fastcgi_param SCRIPT_FILENAME                                    |
|      $document_root$fastcgi_script_name; include fastcgi_params;      |
|    | ……                                                               |
+=======================================================================+
+-----------------------------------------------------------------------+

.. image:: vertopal_6e277aed43794de08da7229da055806a/media/image49.png
   :width: 6.30139in
   :height: 4.54028in

| Vérifier la config
| sudo nginx -t

.. image:: vertopal_6e277aed43794de08da7229da055806a/media/image50.png
   :width: 6.30139in
   :height: 0.9375in

| Vous devrez confirmer manuellement que vous faites confiance au
  serveur pour y accéder.= ; les navigateurs ne peuvent vérifier les
  certificats auto-signés
| sudo systemctl restart nginx

.. image:: vertopal_6e277aed43794de08da7229da055806a/media/image51.png
   :width: 2.59444in
   :height: 0.29167in

   | **0.2La page d’accueil et connexion avec Domoticz ou HA** :
   | **0.2.1 page d’accueil** :
   | Pour modifier l’image, les titres et slogan de la page d’accueil :
     **voir ce paragraphe**

   .. image:: vertopal_6e277aed43794de08da7229da055806a/media/image52.png
      :width: 4.64722in
      :height: 5.67778in

   | **0.2.2. Premier dispositif,**
   | **0.2.2.1 pour Domoticz**
   | **Température extérieure : le matériel**
   | **Depuis le 1 avril 2023 le service Darsky n’est assuré que pour
     des appareil Apple !!! J’ai donc provisoirement migré vers Météo
     Concept que j’utilise pour ma météo à 14 jours ; Je n’utilise pas
     ces valeurs dans Domoticz**

   **A la place OpenWeatherMap peut être utilisé :**

   .. image:: vertopal_6e277aed43794de08da7229da055806a/media/image53.png
      :width: 6.3in
      :height: 5.03056in

   | Pour la météo actuelle laisser les curseurs en rouge
   | **Le dispositif :**

   .. image:: vertopal_6e277aed43794de08da7229da055806a/media/image54.png
      :width: 4.09444in
      :height: 1.44861in

   **Création d’un plan :**

   .. image:: vertopal_6e277aed43794de08da7229da055806a/media/image55.png
      :width: 4.10417in
      :height: 4.44722in

   .. image:: vertopal_6e277aed43794de08da7229da055806a/media/image56.png
      :width: 4.77083in
      :height: 1.38056in

   .. image:: vertopal_6e277aed43794de08da7229da055806a/media/image57.png
      :width: 5.22222in
      :height: 4.92639in

| *Noter l’Idx du plan*
| *L’Idx (Domoticz) du dispositif 285*
| *Id , il est le premier dispositif : 1*
| **Ajoutons ces données qans la base SQL , soit avec phpmyadmin ou plus
  simplement avec l’appli :**

.. image:: vertopal_6e277aed43794de08da7229da055806a/media/image58.png
   :width: 3.11528in
   :height: 4.65139in

   .. image:: vertopal_6e277aed43794de08da7229da055806a/media/image59.png
      :width: 2.96389in
      :height: 2.9in

.. image:: vertopal_6e277aed43794de08da7229da055806a/media/image60.png
   :width: 4.78194in
   :height: 0.77083in

*Avec OpenWeather l’API fournit la température ressentie, pour l’ajouter
enregistrer le dispositif et*

*ajouter à accueil.php :*

+-----------------------------------------------------------------------+
|    *<p class="text-centre">T° ressentie :<span id="temp_ressentie"    |
|    style="color:#ffc107;"></span></p>*                                |
+=======================================================================+
+-----------------------------------------------------------------------+

.. image:: vertopal_6e277aed43794de08da7229da055806a/media/image61.png
   :width: 6.30139in
   :height: 1.06111in

   Domoticz : un répertoire devra être créer pour utiliser les variables
   stockées dans un fichier

**Script de remplacement**

*fonctions.php ->function meteo_concept($choix)*

.. image:: vertopal_6e277aed43794de08da7229da055806a/media/image62.png
   :width: 6.30139in
   :height: 1.27222in

*footer.php*

.. image:: vertopal_6e277aed43794de08da7229da055806a/media/image63.png
   :width: 4.20972in
   :height: 2.47917in

.. image:: vertopal_6e277aed43794de08da7229da055806a/media/image64.png
   :width: 5.05278in
   :height: 1.0625in

   **0.2.2.2 pour Home Assistant**

   La météo est installée lors de l’installation du programme :

   .. image:: vertopal_6e277aed43794de08da7229da055806a/media/image65.png
      :width: 2.41667in
      :height: 3.69861in

   Enregistrement du dispositif :

   .. image:: vertopal_6e277aed43794de08da7229da055806a/media/image66.png
      :width: 2.67917in
      :height: 3.6875in

   Affichage sue la page d’accueil :

   .. image:: vertopal_6e277aed43794de08da7229da055806a/media/image67.png
      :width: 2.44722in
      :height: 3.30833in

   .. image:: vertopal_6e277aed43794de08da7229da055806a/media/image68.png
      :width: 4.09444in
      :height: 1.38472in

   Les données json de ce dispositif :

   .. image:: vertopal_6e277aed43794de08da7229da055806a/media/image69.png
      :width: 3.28194in
      :height: 3.26667in

   **0.2.2.3 Affichage sur la page d’accueil de Monitor :**

   Extrait du fichier /inclue/accueil.php

   .. image:: vertopal_6e277aed43794de08da7229da055806a/media/image70.png
      :width: 6.3in
      :height: 1.73611in

   *L’ID html est ici « temp_ext »*

   .. image:: vertopal_6e277aed43794de08da7229da055806a/media/image71.png
      :width: 3.69306in
      :height: 3.81111in

**0.3 \_ Base de données Maria DB** ; La base de données a été créée
lors de l’installation du

serveur : nom=\ **monitor** (donnée lors de la création, il peut être
différent)

   Connexion en local : IP/phpMyAdmin

   .. image:: vertopal_6e277aed43794de08da7229da055806a/media/image72.png
      :width: 3.12361in
      :height: 3.39028in

Pour les autorisations d’accès, voir le paragraphe concernant la
configuration /admin/config.php

**Elles ont été créées lors de l’installation automatique, pour
l’installation manuelle :**

.. image:: vertopal_6e277aed43794de08da7229da055806a/media/image73.png
   :width: 3.325in
   :height: 1.04583in

En cas d ‘absence de base de données ou de mauvais paramétrages :

   .. image:: vertopal_6e277aed43794de08da7229da055806a/media/image74.png
      :width: 5.42639in
      :height: 2.07361in

Ajout à la base de données des données fournie par Domoticz

**0.3.1 Les variables**

La correspondance entre les variables Domoticz ou HA et l’affichage sur
les pages perso se fait par

l’intermédiaire de la BD « Domoticz » ; tables :

   - text-image

   - dispositifs (gère également les dispositifs

   - - …….

Ex :

.. image:: vertopal_6e277aed43794de08da7229da055806a/media/image75.png
   :width: 2.25139in
   :height: 2.47917in

| Table « text-image » :
| Pour un texte contenu dans une variable Domoticz correspond une image
  ou 0 ou « none »

.. image:: vertopal_6e277aed43794de08da7229da055806a/media/image76.png
   :width: 6.22917in
   :height: 4.39583in

Table « dispositifs», ne sont concernés que les champs :

.. image:: vertopal_6e277aed43794de08da7229da055806a/media/image77.png
   :width: 3.57361in
   :height: 3.58333in

.. image:: vertopal_6e277aed43794de08da7229da055806a/media/image78.png
   :width: 6.30139in
   :height: 3.35278in

| num : ne sert qu’à éditer plus facilement la BD
| *Pour modifier plus facilement la table, ajouter au début un
  enregistrement (num par exemple) afin de pouvoir éditer les
  enregistrements*

.. image:: vertopal_6e277aed43794de08da7229da055806a/media/image79.png
   :width: 6.49583in
   :height: 0.55833in

| Id1_html : ID de l’image dans la page ou #shell (voir ci-dessous)
| Id2_html : ID du texte dans la page, concerne surtout l’alarme mais
  peut afficher d’autres notifications ; commande Bash (voir image
  ci-dessous)

Accès au Shell par SSH2 depuis Domoticz sous Docker : sous Docker
l’accès au Shell du serveur n’est pas possible, la parade consiste à
passer par monitor.

Dans Domoticz, créer une variable avec les données ci-dessous :

.. image:: vertopal_6e277aed43794de08da7229da055806a/media/image80.png
   :width: 6.30139in
   :height: 0.41667in

Dans SQL :

.. image:: vertopal_6e277aed43794de08da7229da055806a/media/image81.png
   :width: 3.63611in
   :height: 1.89583in

Ou par Monitor : |image3|

   .. image:: vertopal_6e277aed43794de08da7229da055806a/media/image83.png
      :width: 3.3125in
      :height: 4.05556in

+-----------------------------------------------------------------------+
|    | **Exemple : redémarrer script après modifications**              |
|    | Ici systemctl restart sms_dz (script chargé de l’envoi des sms   |
|      et qui doit être redémarré si le fichier « connect.py » a été    |
|      modifié (ajout, remplacement de N° de tel)                       |
|                                                                       |
|    Dans Domoticz :                                                    |
+=======================================================================+
+-----------------------------------------------------------------------+

+-----------------------------------------------------------------------+
|    .                                                                  |
| . image:: vertopal_6e277aed43794de08da7229da055806a/media/image84.png |
|       :width: 5.78194in                                               |
|       :height: 2.09444in                                              |
|                                                                       |
|    | Dans monitor, PHP, SSH2                                          |
|    | Extrait du fichier :                                             |
|                                                                       |
|    .                                                                  |
| . image:: vertopal_6e277aed43794de08da7229da055806a/media/image85.png |
|       :width: 6.3in                                                   |
|       :height: 1.95139in                                              |
|                                                                       |
|    | Monitor surveille les modifications de variables, si une         |
|      variable avec une ID_img =#shell apparait, si la valeur est !=0  |
|      le nom du script indiqué dans Value est exécuté :                |
|    | Appel ajax depuis footer.php vers ajax.php->ssh_scp.php->serveur |
|      dz ou ha->exécution du fichier Bash                              |
|                                                                       |
|    .                                                                  |
| . image:: vertopal_6e277aed43794de08da7229da055806a/media/image86.png |
|       :width: 4.54167in                                               |
|       :height: 0.55278in                                              |
|                                                                       |
|    Le mot de passe peut être ajouté à connect.py                      |
+=======================================================================+
+-----------------------------------------------------------------------+

| Nom_idx : nom de la variable du serveur domotique (dz)
| IMPORTANT : le nom de la variable Domoticz ne doit pas comporter
  d’espace (le programme fonctionne mais l’API renvoie « NULL »)
| Idx : id de la variable du serveur domotique(dz)
| ex : idx de Domoticz

.. image:: vertopal_6e277aed43794de08da7229da055806a/media/image87.png
   :width: 4.23055in
   :height: 1.34444in

| Nom appareil : non obligatoire
| ID : id de la variable (ha)
| Ex : Home Assistant, nom essai, ID input_text.essai

.. image:: vertopal_6e277aed43794de08da7229da055806a/media/image88.png
   :width: 3.64583in
   :height: 1.81389in

| Pourquoi une correspondance ? : cela évite, lors d’une modification
  dans Domoticz ou HA, de modifier tous les ID (idm) dans monitor
| Installation des tables : lors de l’installation automatique, elles
  sont installées, sinon télécharger le référentiel :

.. image:: vertopal_6e277aed43794de08da7229da055806a/media/image89.png
   :width: 3.22917in
   :height: 2.93194in

| Les API de Domoticz et Home assistant pour les variables :
| - DZ : URL :PORT/json.htm?type=command&param=getuservariables ,(
  renvoie la liste de toutes les variables et leurs valeurs)

   - HA : *URL:8123/api/states/sensor.liste_var* (renvoie la liste des
   dispositifs enregistrés comme input text)

   Le template sensor : sensor.liste_var

+-----------------------------------------------------------------------+
|    | template:                                                        |
|    | - sensor:                                                        |
|    | - name: "liste_var"                                              |
|    | unique_id : 1234567890                                           |
|    | state: >                                                         |
|    | {% for input_text in states.input_text %}                        |
|    | {{input_text.entity_id ~ "=" ~ input_text.state ~ ", " }} {%     |
|      endfor %}                                                        |
+=======================================================================+
+-----------------------------------------------------------------------+

.. image:: vertopal_6e277aed43794de08da7229da055806a/media/image90.png
   :width: 5.31389in
   :height: 1.30278in

**0.3.2 Les Dispositifs**

Comme pour les variables, la table fournie une correspondance entre les
dispositifs dans Domoticz ou HA et Monitor et une info sur le matériel
(Zgbee, Zwave, et n° de nœud.) (Pour les dispositifs Domoticz
n’enregistre pas le type de matériel)

Table « dispositifs »

.. image:: vertopal_6e277aed43794de08da7229da055806a/media/image91.png
   :width: 5.04306in
   :height: 6.82361in

.. image:: vertopal_6e277aed43794de08da7229da055806a/media/image92.png
   :width: 6.30139in
   :height: 4.78611in

La table permet en plus de gérer et modifier si besoin l’affichage de
tous les dispositifs sans intervenir sur la page HTML ; pour les
switches, les scripts pour commander l’allumage ou l’extinction sont
générés automatiquement à partir des données de cette table.

| num : ne sert qu’à éditer plus facilement la BD
| *Pour modifier plus facilement la table , ajouter au début un
  enregistrement (num par exemple) afin de pouvoir éditer les
  enregistrements*

.. image:: vertopal_6e277aed43794de08da7229da055806a/media/image79.png
   :width: 6.49583in
   :height: 0.55833in

| Nom appareil : nom usuel
| nom_dz : nom du dispositif Domoticz
| idx : celui de Domoticz
| ID : celui de Home Assistant

idm : idm de monitor peut-être la même que idx ; c’est utile pour
l’affichage des infos concernant un dispositif ; de plus cela permet de
retrouver facilement un dispositif dans l’image svg du plan en faisant
une recherche ;dans l’image cet idm est indiqué par « rel=idm »

Voir le paragraphe concernant les images svg

Matériel : pour les types zwave ou Zigbee

maj_js : types de mise à jour java script

   | - control // détecteur présence(on/off)
   | - etat //porte, volet ,(closed/open)
   | - Temp ou data // température, humidité, ph, M3/h, orp,…. toutes
     données ; temp est utilisé pour une raison historique, à l’époque
     où seules des mesures de températures étaient exploitées….il est
     préférable d’utiliser « data »

.. image:: vertopal_6e277aed43794de08da7229da055806a/media/image93.png
   :width: 6.14583in
   :height: 0.56389in

.. image:: vertopal_6e277aed43794de08da7229da055806a/media/image94.png
   :width: 5.41806in
   :height: 0.34444in

   | - onoff commandes
   | - onoff+stop commandes (volets par exemple)
   | - popup //ouverture d’une fenêtre (commandes particulières)
     oexemple des scripts générés automatiquement

   .. image:: vertopal_6e277aed43794de08da7229da055806a/media/image95.png
      :width: 5.60833in
      :height: 2.56667in

   Dans footer.php

   .. image:: vertopal_6e277aed43794de08da7229da055806a/media/image96.png
      :width: 3.11528in
      :height: 1.09305in

   Voir chapitre1. \_ Configuration minimum

   *Il est possible d’ajouter des types*

| id1_html , Id2_html : id d’affichage pour un idx ou idm, souvent 1
  seul ID, le 2eme lorsque l’image comporte de nombreuses zones,
| car_max_id1 : nb de caractères maximum affichés (concerne Data avec
  plusieurs données (T°,%hum) F() N° case de la fonction «
  pour_data($nc,$l_device) » , fichier fonctions.php
| class_lamp : utilisé pour les lampes en plus de l’interrupteur associé
  ; c’est une class car il peut y avoir plusieurs lampes
| coul_id1_id2_ON, coul_id1_id2_OFF, coul_lamp_ON, coul_lamp_ON :
  couleur des ID ou de la class des dispositifs suivant leur position,
  (class_lamp pour les lampes des différents interrupteurs) pass : par
  défaut « 0 » pas de mot de passe , pwalarm pour mot de passe de
  l’alarme et pwcommand pour les commandes (on/off ,…)
| doc : pour associer un document au dispositif

| Pour créer cette table l’importer depuis le référentiel « monitor »
  API Domoticz et HA pour les dispositifs :
| DZ : URL :PORT/json.htm?type=devices&plan=NUMERO DU PLAN HA :
  URL:8123/api/states
| Dans les 2 cas, un fichier json de tous lis dispositifs et les valeurs
  ……………ha :

.. image:: vertopal_6e277aed43794de08da7229da055806a/media/image97.png
   :width: 5.60556in
   :height: 1.39583in

| **0.3.3 caméras**
| On crée une table dans la base de données : cameras
| Si l’on veut un accès extérieur il est utile d’indiquer également le
  domaine
| Si l’on utilise Zoneminder, il est nécessaire d’assurer la
  correspondance des Numéros de dispositifs

.. image:: vertopal_6e277aed43794de08da7229da055806a/media/image98.png
   :width: 6.26111in
   :height: 2.20833in

   | num : n° auto incrémenté pour faciliter les modifications
   | Idx : N° idx celui qui correspond au onclick du plan,
   | Id_zm : optionnel, utilisé avec Zoneminder, option à définir dans
     admin/config.php Ip : IP locale
   | url : url locale de la caméra
   | marque : dahua ou generic, option à définir dans admin/config.php
   | type : VTO ou vide concerne uniquement les portier VTO Dahua
   | localisation :

téléchargement : cameras.sql

Enregistrements de températures, tension ,…..

.. image:: vertopal_6e277aed43794de08da7229da055806a/media/image99.png
   :width: 5.89722in
   :height: 1.47917in

Exemple pour une table temp_meteo :

.. image:: vertopal_6e277aed43794de08da7229da055806a/media/image100.png
   :width: 5.17778in
   :height: 3.25in

| num : n° auto incrémenté pour faciliter les modifications date : la
  date et l’heure
| valeur : la température

Téléchargement de temp_meteo.sql

**0.4\_ Le serveur http de NGINX :**

.. image:: vertopal_6e277aed43794de08da7229da055806a/media/image101.png
   :width: 3.19861in
   :height: 2.15555in

**Configuration : /admin/config.php**

.. image:: vertopal_6e277aed43794de08da7229da055806a/media/image102.png
   :width: 2.10556in
   :height: 2.57361in

Extrait du fichier, fichier complet :

+-----------------------------------------------------------------------+
|    | <?php                                                            |
|    | // NE PAS MODIFIER LES VALEURS EN MAJUSCULES------               |
|    | //general monitor                                                |
|    | define('URLMONITOR', 'monitor.xxxxxxx.ovh');//domaine            |
|    | define('IPMONITOR', '192.168.1.7');//ip                          |
|    | define('MONCONFIG', 'admin/config.php');//fichier config         |
|    | define('DZCONFIG', 'admin/dz/temp.lua');//fichier temp           |
|    | define('FAVICON', 'favicon.ico');//fichier favicon , icone du    |
|      domaine dans barre url                                           |
|    | // répertoire des images                                         |
|    | $rep='images/';//ne pas changer                                  |
|    | // images logo et titres                                         |
|    | define('IMAGEACCUEIL', $rep.'maison.jpg');//image page accueil   |
|      pour écrans >534 px                                              |
|    | define('IMAGEACCUEILSMALL', $rep.'maison_small.jpg');//image     |
|      page accueil pour écrans <535 px define('IMGLOGO',               |
|      $rep.'logo.png');//image logo                                    |
|    | define('NOMSITE', 'Domoticz');//nom principal du site            |
|    | define('NOMSLOGAN', xxxxxx');//nom secondaire ou slogan          |
|    | //                                                               |
+=======================================================================+
+-----------------------------------------------------------------------+

**Les fichiers à la racine du site :**

.. image:: vertopal_6e277aed43794de08da7229da055806a/media/image103.png
   :width: 3.48055in
   :height: 1.66667in

   - ajax.php : appels ajax depuis javascript, explications dans les
   divers paragraphes

.. image:: vertopal_6e277aed43794de08da7229da055806a/media/image104.png
   :width: 6.26806in
   :height: 6.56667in

   | - Cookies.txt & cookie.txt : utilisés par Zoneminder suivant les
     versions de l’API
   | - favicon.ico : l’icône associée à la barre de l’url
   | - fonctions.php : toutes les fonctions PHP appelées au démarrage et
     lors des appels Ajax - Index.php : le ficher appelé lors du
     chargement du site ; pour les écrans > 768x1024 ce fichier gère un
     affichage de 768x1024 appelant la page dans une iframe ; sur cette
     page il faut indiquer l’adresse du répertoire du site sur le
     serveur
   | - Index_loc.php : la page d’accueil réelle du site ; sauf pour
     ajouter des pages non incluses dans le programme, ne pas modifier
     ce fichier.

   **Le fichier index.php**

.. image:: vertopal_6e277aed43794de08da7229da055806a/media/image105.png
   :width: 5.92639in
   :height: 1.9375in

   **Le fichier index_loc.php**

.. image:: vertopal_6e277aed43794de08da7229da055806a/media/image106.png
   :width: 5.95833in
   :height: 6.5625in

| **0.5\_ Le Framework Bootstrap**
| Pour des mises en page faciles, des fenêtres modales ,…..

.. image:: vertopal_6e277aed43794de08da7229da055806a/media/image107.png
   :width: 2.81389in
   :height: 3.70833in

**0.6\_ Les styles CSS**

.. image:: vertopal_6e277aed43794de08da7229da055806a/media/image108.png
   :width: 3.23055in
   :height: 2.38611in

Un extrait :

.. image:: vertopal_6e277aed43794de08da7229da055806a/media/image109.png
   :width: 4.36528in
   :height: 4.28194in

Les Media queries pour les différents écrans

.. image:: vertopal_6e277aed43794de08da7229da055806a/media/image110.png
   :width: 6.26806in
   :height: 5.34167in

| **0.7\_ Les images**
| Toutes sont au format svg ou webp sauf les caméras **Avantages du
  format SVG**

+-----------------------------------------------------------------------+
|    | Les images SVG peuvent être créées et modifiées un éditeur de    |
|      texte                                                            |
|    | Les images SVG peuvent contenir du javascript                    |
|    | Les images SVG sont zoomables                                    |
|    | Les graphiques SVG ne perdent aucune qualité s'ils sont zoomés   |
|      ou redimensionnés SVG est open source                            |
|    | Les fichiers SVG sont du pur XML                                 |
+=======================================================================+
+-----------------------------------------------------------------------+

.. image:: vertopal_6e277aed43794de08da7229da055806a/media/image111.png
   :width: 1.29306in
   :height: 0.45833in

WebP est un format d'image moderne qui offre une compression supérieure
avec perte et sans perte pour les images du Web

Les caméras sont au format jpg :

.. image:: vertopal_6e277aed43794de08da7229da055806a/media/image112.png
   :width: 3.07361in
   :height: 4.97917in

**0.8\_ Les fichiers PHP**

Ils sont regroupés dans le dossier « include », sauf

   - fonctions.php, ajax.php, à la racine de monitor

   - /admin/config. PHP

   - /jpgraph

.. image:: vertopal_6e277aed43794de08da7229da055806a/media/image113.png
   :width: 3.34444in
   :height: 4.09444in

**Affichage de graphique avec jpgraph**

.. image:: vertopal_6e277aed43794de08da7229da055806a/media/image114.png
   :width: 2.76111in
   :height: 4.05278in

| **0.9\_ Les fichiers javascript**
| Avec jQuery

.. image:: vertopal_6e277aed43794de08da7229da055806a/media/image115.png
   :width: 2.11528in
   :height: 3.25in

**Les scripts python**

.. image:: vertopal_6e277aed43794de08da7229da055806a/media/image116.png
   :width: 3.05278in
   :height: 2.69722in

| **1.\_ Configuration minimum : la page d’accueil** Permet d’afficher
| - La température extérieure,
| - Le jour (changement à 0H pour une tablette connectée en permanence),

   - La sortie des poubelles,

   - La gestion de la fosse septique,

   - La surveillance de la pression de la chaudière

   - Les anniversaires

   - Rappel pour la prise de médicaments

   - La prévision de pluie à 1 heure de Météo France

   - L’arrivée du courrier

   - La mise en service de l’alarme de nuit

   - Le remplacement des piles pour les capteurs concernés

.. image:: vertopal_6e277aed43794de08da7229da055806a/media/image117.png
   :width: 5.53194in
   :height: 7.46944in

.. image:: vertopal_6e277aed43794de08da7229da055806a/media/image118.png
   :width: 4.95972in
   :height: 1.67639in

Pour afficher cette page, les fichiers nécessaires en jaune

**1.1– Configuration :/admin.config.php Il faut fournir un minimum de
renseignements : 1.1.1 -Adresse IP , domaine, favicon de monitor,**

.. image:: vertopal_6e277aed43794de08da7229da055806a/media/image119.png
   :width: 5.00139in
   :height: 1.5625in

Pour faciliter la réinitialisation des dispositifs dans Domoticz ou un
transfert (ex, zwavejs2mqtt , zigbee2mqtt sous docker) ; en créant une
copie de la table dispositifs (« dispositifs » par défaut), il est
possible de préparer le transfert ; ici la table dispositifs a été
renommer Dispositifs

.. image:: vertopal_6e277aed43794de08da7229da055806a/media/image120.png
   :width: 3.71944in
   :height: 0.51111in

.. image:: vertopal_6e277aed43794de08da7229da055806a/media/image121.png
   :width: 2.49028in
   :height: 1.75in

1.1.1.a \_Pour l’image de fond suivant la résolution d’écran et le logo
:

+-----------------------------------------------------------------------+
|    | // Monitor                                                       |
|    | define('IMAGEACCUEIL', 'images/maison.webp');//image page        |
|      accueil pour écrans >534 px define('IMAGEACCUEILSMALL',          |
|      'images/maison_small.webp');//image page accueil pour écrans     |
|      <535 px                                                          |
|    | define('IMGLOGO', 'images/logo.png');//image logo                |
+=======================================================================+
+-----------------------------------------------------------------------+

.. image:: vertopal_6e277aed43794de08da7229da055806a/media/image122.png
   :width: 5.77222in
   :height: 0.64583in

| Pour les titres, slogans et lexique
| Pour le lexique :
| - true = lexique par défaut

+-----------------------------------+-----------------------------------+
| -                                 |    false= lexique à modifier      |
|                                   |    /include/lexique_no.php        |
+===================================+===================================+
+-----------------------------------+-----------------------------------+

+-----------------------------------------------------------------------+
|    | define('NOMSITE', 'Domoticz');//nom principal du site            |
|    | define('NOMSLOGAN', xxxxxxxxxxx);//nom secondaire ou slogan //   |
|      affichage lexique                                                |
|    | define('LEXIQUE', true);                                         |
+=======================================================================+
+-----------------------------------------------------------------------+

.. image:: vertopal_6e277aed43794de08da7229da055806a/media/image123.png
   :width: 5.55278in
   :height: 0.85417in

**1.1.2 intervalles de maj, maj temps réel**

L’intervalle de mise à jour pour les services (poubelles, anniversaires,
…) : il est de ½ heure (1800000 milli secondes), il peut être changé

.. image:: vertopal_6e277aed43794de08da7229da055806a/media/image124.png
   :width: 6.30139in
   :height: 0.87917in

.. image:: vertopal_6e277aed43794de08da7229da055806a/media/image125.png
   :width: 6.26806in
   :height: 0.625in

TEMPO_DEVICES pour tous les dispositifs

TEMPO_DEVICES_DZ : pour les dispositifs qui mettent à 1 une variable
pour indiquer à monitor d’effectuer une mise à jour, ici toutes les 30
secondes rafraichissement des dispositifs si par exemple un PIR, un
contact de porte qui sont déclaré prioritaire dans DZ passent à ON

.. image:: vertopal_6e277aed43794de08da7229da055806a/media/image126.png
   :width: 6.29167in
   :height: 1.82361in

La fonction JS :

.. image:: vertopal_6e277aed43794de08da7229da055806a/media/image127.png
   :width: 6.01111in
   :height: 1.51111in

La fonction PHP qui récupère la valeur de la variable :

.. image:: vertopal_6e277aed43794de08da7229da055806a/media/image128.png
   :width: 5.92778in
   :height: 1.41667in

| **1.1.3 Autres données**
| Idx de Domoticz ou idm de monitor :
| Pour une première installation choisir idx ; pour une réinstallation
  de Domoticz, il sera alors préférable de choisir idm pour éviter de
  renommer tous les dispositifs dans les images svg La création d’un
  plan qui regroupe les dispositifs sur Domoticz est nécessaire : noter
  le N° du plan

.. image:: vertopal_6e277aed43794de08da7229da055806a/media/image129.png
   :width: 5.43889in
   :height: 1.19861in

Paramètres de la base de données :

.. image:: vertopal_6e277aed43794de08da7229da055806a/media/image130.png
   :width: 2.79305in
   :height: 0.91667in

Paramètres pour Domoticz :

.. image:: vertopal_6e277aed43794de08da7229da055806a/media/image131.png
   :width: 6.26806in
   :height: 1.12639in

Le programme démarre avec 11 pages :

   - Accueil

   - 1 Plan intérieur

   - Page d’administration, pour afficher cette page, le mot de passe
   est obligatoire ; il est

   toujours possible de modifier le fichier de configuration avec un
   éditeur.

   Par défaut « admin »

.. image:: vertopal_6e277aed43794de08da7229da055806a/media/image132.png
   :width: 5.95972in
   :height: 1.375in

   - Les autres pages concernent l’alarme, un mur de caméras, …….

**1.2- Les fichiers à la racine du site, les styles, le javascript**

   **1.2.1 - à la racine du site :**

   o\ **Index.php**

+-----------------------------------------------------------------------+
|    | <?php                                                            |
|    | echo '<!DOCTYPE html><html><body style="background-color:        |
|      cornsilk;">';                                                    |
|                                                                       |
|    | $rep="/"; $domaine=$_SERVER['HTTP_HOST'];                        |
|    | if ($domaine=="192.168.1.7") $rep="/monitor/";                   |
|    | echo '                                                           |
|    | <script>                                                         |
|    | var larg = screen.width;                                         |
|    | if (larg<769 ){ window.location.href="'.$rep.'index_loc.php";}   |
|    | </script>';                                                      |
|    | echo '                                                           |
|    | <iframe id="inline_monitor"                                      |
|    | style="width:768px;height:1024px;margin:0 30%;background-color:  |
|      cornsilk;" src="'.$rep.'index_loc.php">                          |
|    | </iframe></body></html>';                                        |
|    | ?>                                                               |
+=======================================================================+
+-----------------------------------------------------------------------+

..

   o\ **index_loc.php**

   **extrait , le fichier complet :**

   .. image:: vertopal_6e277aed43794de08da7229da055806a/media/image133.png
      :width: 4.65694in
      :height: 4.77639in

   | **fonctions.php,**
   | *Extrait, voir le fichier à jour sur Github*
   | Principales fonctions :
   | - fonction status_variables($xx)

.. image:: vertopal_6e277aed43794de08da7229da055806a/media/image134.png
   :width: 4.6875in
   :height: 3.33333in

.. image:: vertopal_6e277aed43794de08da7229da055806a/media/image135.png
   :width: 6.30139in
   :height: 6.51944in

.. image:: vertopal_6e277aed43794de08da7229da055806a/media/image136.png
   :width: 6.30139in
   :height: 6.81667in

**API HA pour récupérer les valeurs des dispositifs**

.. image:: vertopal_6e277aed43794de08da7229da055806a/media/image137.png
   :width: 6.30139in
   :height: 3.18472in

Fonction maj_variable et sql_variable : pour mettre à jour une variable
et pour lire les tables

variables_dz et text_image SQL

.. image:: vertopal_6e277aed43794de08da7229da055806a/media/image138.png
   :width: 6.32222in
   :height: 3.85417in

API Domoticz pour les devices :

.. image:: vertopal_6e277aed43794de08da7229da055806a/media/image139.png
   :width: 6.30139in
   :height: 6.14444in

.. image:: vertopal_6e277aed43794de08da7229da055806a/media/image140.png
   :width: 6.30139in
   :height: 3.94583in

   Maj de la date dans la fonction devices_plan($plan)

   .. image:: vertopal_6e277aed43794de08da7229da055806a/media/image141.png
      :width: 5.08333in
      :height: 2.08333in

   **Extrait ajax.php , sur github le fichier complet :**

.. image:: vertopal_6e277aed43794de08da7229da055806a/media/image142.png
   :width: 5.57083in
   :height: 4.73472in

   **1.2.2 - les styles css :**

   **Fichier mes_css.css , extrait :**

+-----------------------------------------------------------------------+
|    ..                                                                 |
|  image:: vertopal_6e277aed43794de08da7229da055806a/media/image143.png |
|       :width: 5.08333in                                               |
|       :height: 6.83333in                                              |
+=======================================================================+
+-----------------------------------------------------------------------+

..

   | **1.2.3 – Le javascript :**
   | **1.2.3 a**- Les fichiers footer.php , *voir ce script*
   | **1.2.3 b**- le fichier mes_js.js : scripts principaux , fichier
     complet :

   .. image:: vertopal_6e277aed43794de08da7229da055806a/media/image144.png
      :width: 6.26806in
      :height: 4.65139in

   **1.2.3 b.1 fenêtre modale modallink**

   .. image:: vertopal_6e277aed43794de08da7229da055806a/media/image145.png
      :width: 4.99028in
      :height: 4.125in

**1.3-Les fichiers principaux dans /include**

   **1.3.1 entete_html.php**

   **p**

.. image:: vertopal_6e277aed43794de08da7229da055806a/media/image146.png
   :width: 6.26806in
   :height: 4.18056in

Le HTML du navigateur :

.. image:: vertopal_6e277aed43794de08da7229da055806a/media/image147.png
   :width: 5.62639in
   :height: 0.90694in

**1.3.2 Test de la base de données, test_db.php :**

.. image:: vertopal_6e277aed43794de08da7229da055806a/media/image148.png
   :width: 6.26806in
   :height: 2.55972in

**1.3.3 le menu, header.php :** les pages configurées avec config.php
sont ajoutées automatiquement au menu

| Extrait du fichier, le fichier
| complet :

.. image:: vertopal_6e277aed43794de08da7229da055806a/media/image149.png
   :width: 6.26806in
   :height: 2.59722in

Pour modifier la largeur, Du menu :

.. image:: vertopal_6e277aed43794de08da7229da055806a/media/image150.png
   :width: 5.19861in
   :height: 2.47917in

.. image:: vertopal_6e277aed43794de08da7229da055806a/media/image151.png
   :width: 6.26111in
   :height: 6.94861in

   **1.3.4 la page d’accueil avec les notifications , accueil.php :**

Le HTML:

.. image:: vertopal_6e277aed43794de08da7229da055806a/media/image152.png
   :width: 6.30139in
   :height: 4.14861in

.. image:: vertopal_6e277aed43794de08da7229da055806a/media/image153.png
   :width: 5.18889in
   :height: 5.04167in

   **1.3.5 les scripts JavaScript, dans la page footer.php :**

   .. image:: vertopal_6e277aed43794de08da7229da055806a/media/image154.png
      :width: 6.26806in
      :height: 5.74722in

   *1.3.5.1 rafraîchissements de la page*

La fonction pour le rafraichissement des données à partir d’un
changement d’état d’un dispositif dans Domoticz

.. image:: vertopal_6e277aed43794de08da7229da055806a/media/image155.png
   :width: 6.05278in
   :height: 1.625in

Dans les scripts lua :

.. image:: vertopal_6e277aed43794de08da7229da055806a/media/image156.png
   :width: 3.93889in
   :height: 1.02083in

.. image:: vertopal_6e277aed43794de08da7229da055806a/media/image157.png
   :width: 5.78194in
   :height: 0.5625in

.. image:: vertopal_6e277aed43794de08da7229da055806a/media/image158.png
   :width: 6.30139in
   :height: 0.50417in

La variable

   *1.3.5.2 Quelques infos supplémentaires :*

.. image:: vertopal_6e277aed43794de08da7229da055806a/media/image159.png
   :width: 5.58472in
   :height: 3.1875in

substring(0, 32) : modif du 11/05/2022 tronqué affichage ID ZWAVE très
long

.substring(0, 11)=="Set Level: ajouté le 15/5/2022

.. image:: vertopal_6e277aed43794de08da7229da055806a/media/image160.png
   :width: 6.26806in
   :height: 1.65278in

La fonction maj_services récupère les valeurs de toutes les variables.
La fonction maj_variable modifie la valeur d’une variable.

   La fonction maj_devices(plan) récupère les données des dispositifs Un
   exemple avec set ou get Attribute

.. image:: vertopal_6e277aed43794de08da7229da055806a/media/image161.png
   :width: 6.26806in
   :height: 5.30972in

Voir le *paragraphe concernant les volets*

| La fonction switchOnOff_setpoint() exécute des commandes
| La ligne en PHP « <?php if ($_SESSION["exeption_db"]!="pas de
  connexion à la BD") {sql_plan(0);}?> » crée pour chaque dispositif
  on/off le script correspondant à partir de la BD

.. image:: vertopal_6e277aed43794de08da7229da055806a/media/image162.png
   :width: 5.57361in
   :height: 2.19861in

Le HTML :

.. image:: vertopal_6e277aed43794de08da7229da055806a/media/image163.png
   :width: 6.26111in
   :height: 4.77083in

| maj_sevices()
| Copie d’écran le jour de l’entretien de la fosse septique

.. image:: vertopal_6e277aed43794de08da7229da055806a/media/image164.png
   :width: 5.36806in
   :height: 6.77778in

.. image:: vertopal_6e277aed43794de08da7229da055806a/media/image165.png
   :width: 6.27083in
   :height: 7.19861in

Maj_devices(plan) : pour l’installation minimale, ne concerne que la maj
de la température extérieure et de la date ; lorsqu’une tablette reste
connectée en permanence, donc sans rafraichissement , la date affichée
doit être rafraichie.

Une autre solution pour la maj de la date : un script qui tourne en
permanence sur la tablette : je n’ai pas retenu cette solution car un
script dans Domoticz gère très bien la gestion du temps.

Pour info cette autre solution :

+-----------------------------------------------------------------------+
|    | fonction date_heure(id)                                          |
|    | {                                                                |
|    | date = new Date;                                                 |
+=======================================================================+
+-----------------------------------------------------------------------+

+-----------------------------------------------------------------------+
|    | annee = date.getFullYear();                                      |
|    | moi = date.getMonth();                                           |
|    | mois = new Array('Janvier', 'F&eacute;vrier', 'Mars', 'Avril',   |
|      'Mai', 'Juin', 'Juillet', 'Ao&ucirc;t', 'Septembre', 'Octobre',  |
|      'Novembre', 'D&eacute;cembre');                                  |
|    | j = date.getDate();                                              |
|    | jour = date.getDay();                                            |
|    | jours = new Array('Dimanche', 'Lundi', 'Mardi', 'Mercredi',      |
|      'Jeudi', 'Vendredi', 'Samedi');                                  |
|    | h = date.getHours();                                             |
|    | if(h<10)                                                         |
|    | {                                                                |
|    | h = "0"+h;                                                       |
|    | }                                                                |
|    | m = date.getMinutes();                                           |
|    | if(m<10)                                                         |
|    | {                                                                |
|    | m = "0"+m;                                                       |
|    | }                                                                |
|    | s = date.getSeconds();                                           |
|    | if(s<10)                                                         |
|    | {                                                                |
|    | s = "0"+s;                                                       |
|    | }                                                                |
|    | resultat = 'Nous sommes le '+jours[jour]+' '+j+' '+mois[moi]+'   |
|      '+annee+' il est '+h+':'+m+':'+s;                                |
|    | document.getElementById(id).innerHTML = resultat;                |
|    | setTimeout('date_heure("'+id+'");','1000');                      |
|    | return true;                                                     |
|    | }                                                                |
+=======================================================================+
+-----------------------------------------------------------------------+

.. image:: vertopal_6e277aed43794de08da7229da055806a/media/image166.png
   :width: 6.26806in
   :height: 6.71528in

Pour que les icones sur la page d’accueil soient affichées, il faut
enregistrer les variables dans

la base de Données Maria DB,

La table dispositifs

.. image:: vertopal_6e277aed43794de08da7229da055806a/media/image167.png
   :width: 6.30139in
   :height: 2.1125in

La table d’équivalence texte ->images : text_image

.. image:: vertopal_6e277aed43794de08da7229da055806a/media/image168.png
   :width: 3.66805in
   :height: 6.63611in

.. image:: vertopal_6e277aed43794de08da7229da055806a/media/image169.png
   :width: 3.52222in
   :height: 0.90694in

Pour les Anniversaires, il faut entrer chaque prénom ou nom dans la base
de données, ces noms correspondent à ceux du script LUA décrit ci-après
:

.. image:: vertopal_6e277aed43794de08da7229da055806a/media/image170.png
   :width: 6.49583in
   :height: 0.72917in

.. image:: vertopal_6e277aed43794de08da7229da055806a/media/image171.png
   :width: 5.51111in
   :height: 2.25972in

| L’image peut être personnalisée pour chaque nom
| Sur la page d’accueil, il est possible d’ajouter d’autres icones, il
  suffit d’ajouter un ID dans accueil.php et de renseigner la base de
  données

.. image:: vertopal_6e277aed43794de08da7229da055806a/media/image172.png
   :width: 6.49583in
   :height: 4.1625in

**1.4 Le lexique et la température extérieure :**

**1.4.1 Le lexique :**

L’image est inline dans header.php

La fenêtre modale dans /include lexique .php ou lexique_no.php (le
fichier est choisi par la

configuration) :

.. image:: vertopal_6e277aed43794de08da7229da055806a/media/image173.png
   :width: 2.41806in
   :height: 0.32222in

.. image:: vertopal_6e277aed43794de08da7229da055806a/media/image174.png
   :width: 5.14583in
   :height: 2.59861in

| Les fenêtres qui affichent les infos :
| - Lexique.php

.. image:: vertopal_6e277aed43794de08da7229da055806a/media/image175.png
   :width: 4.84722in
   :height: 4.92639in

   - Lexique_no.php

.. image:: vertopal_6e277aed43794de08da7229da055806a/media/image176.png
   :width: 5.5625in
   :height: 3.59167in

Pour ne pas utiliser de lexique et donc de supprimer l’icône : |image4|

   - Supprimer ou mettre en commentaire

.. image:: vertopal_6e277aed43794de08da7229da055806a/media/image178.png
   :width: 4.24028in
   :height: 3.83889in

**1.4.2 La température extérieure (valable pour d’autres dispositifs)
:**

.. image:: vertopal_6e277aed43794de08da7229da055806a/media/image179.png
   :width: 4.56389in
   :height: 2.61528in

Le fichier Json reçu par monitor après une demande de la fonction
devices(plan):

.. image:: vertopal_6e277aed43794de08da7229da055806a/media/image180.png
   :width: 2.98055in
   :height: 3.70833in

**1.5 liens avec Domoticz ou Home Assistant**

**1.5.1 Liens avec Domoticz**

Le script maj_services : concerne :

   | - les poubelles
   | - la fosse septique
   | - les anniversaires
   | - la gestion des piles des dispositifs
   | - ….et plus encore

Affichage sur monitor, sur la TV et notifications SMS

Ce script met à jour, suivant l’horaire et la date, des variables
Domoticz ; quand javascript demande une mise à jour, il appelle, par
l’intermédiaire d’un fichier ajax.php, une fonction PHP
(status_variables), qui récupère toutes les infos (API Domoticz) et
renvoi un fichier Json

Variables Domoticz :

*les 2 variables not_tv_\* : pour le script notifications_tv.lua*

.. image:: vertopal_6e277aed43794de08da7229da055806a/media/image181.png
   :width: 6.5in
   :height: 1.56667in

.

.. image:: vertopal_6e277aed43794de08da7229da055806a/media/image182.png
   :width: 2.96944in
   :height: 4.22917in

Le fichier LUA

.. image:: vertopal_6e277aed43794de08da7229da055806a/media/image183.png
   :width: 3.19861in
   :height: 1.52083in

.. image:: vertopal_6e277aed43794de08da7229da055806a/media/image184.png
   :width: 5.88611in
   :height: 2.35417in

**Remarque :**

**D’une année à l’autre, certains jours de ramassage des poubelles
peuvent être modifiés :**

Pour en tenir compte dans Domoticz, voir ci-dessous (§1.5.1) les lignes
de code à ajouter :

Il est possible de mettre les variables (string et tableau dans un
fichier, voir ci-dessous 1.8.1

Dans Log :

.. image:: vertopal_6e277aed43794de08da7229da055806a/media/image185.png
   :width: 6.1625in
   :height: 0.68472in

**1.5.1.1 les variables lua de configuration dans un fichier externe**

Les jour de ramassage des poubelles peuvent changer, le nombre
d’anniversaires augmenter, toutes les variables correspondantes à ces
valeurs peuvent être inséré dans un fichier appelé dans le script lua ;
pour les anniversaires on utilise un tableau multidimensionnel, plus
facile à compléter que 2 tableaux, si les données sont importantes.

De plus ce fichier peut alors être modifié dans monitor sans intervenir
dans Domoticz, voir le paragraphe concernant l’administration

Dans ce cas il faut que le fichier soit accessible en http, il faut donc
créer un répertoire « modules_lua » dans « /home/USER/domoticz/www »

Exemple le fichier
/home/USER/domoticz/www/modules_lua/string_tableaux.lua, affichage dans
monitor

.. image:: vertopal_6e277aed43794de08da7229da055806a/media/image186.png
   :width: 4.32361in
   :height: 3.9375in

Utilisation dans dz event pour une maj depuis monitor, voir le
paragraphe « administration »

.. image:: vertopal_6e277aed43794de08da7229da055806a/media/image187.png
   :width: 5.96944in
   :height: 1.8125in

On place le fichier string_tableaux.lua dans ce répertoire

.. image:: vertopal_6e277aed43794de08da7229da055806a/media/image188.png
   :width: 4.18889in
   :height: 2.04167in

Dans le script LUA, on appelle ce fichier, en ayant indiqué le chemin :

+-----------------------------------------------------------------------+
|    -- chargement fichier contenant les variables de configuration     |
|    package.path..";/home/USER/domoticz/www/modules_lua/?.lua" require |
|    'string_tableaux'                                                  |
+=======================================================================+
+-----------------------------------------------------------------------+

Le script maj_services devient :

.. image:: vertopal_6e277aed43794de08da7229da055806a/media/image189.png
   :width: 5.60556in
   :height: 0.99028in

.. image:: vertopal_6e277aed43794de08da7229da055806a/media/image190.png
   :width: 4.80278in
   :height: 2.05139in

.. image:: vertopal_6e277aed43794de08da7229da055806a/media/image191.png
   :width: 6.26806in
   :height: 3.57361in

   - Le jour des poubelles est remplacé par le jour du tableau (ajout)
   ou par un vide (exclusion)

**Extrait du fichier maj_services modifié**

.. image:: vertopal_6e277aed43794de08da7229da055806a/media/image192.png
   :width: 6.26806in
   :height: 1.21806in

**1.5.1.2 les scripts de notifications gérées par Domoticz**

**Alarmes SMS ou Mail , le script LUA** : ‘notifications_variables’

https://raw.githubusercontent.com/mgrafr/monitor/main/scripts_dz/lua/notification_variables.lua

.. image:: vertopal_6e277aed43794de08da7229da055806a/media/image193.png
   :width: 6.26806in
   :height: 4.87222in

Le script DZEvent : notifications_devices :

.. image:: vertopal_6e277aed43794de08da7229da055806a/media/image194.png
   :width: 6.26806in
   :height: 4.60833in

notification-timer.lua :

+-----------------------------------------------------------------------+
|    -- notifications_timer                                             |
|                                                                       |
|    | local time = string.sub(os.date("%X"), 1, 5)                     |
|    | return {                                                         |
|    | on = {                                                           |
|    | timer = {                                                        |
|    | 'at 23:00',                                                      |
|    | 'at 06:00',                                                      |
|    | }                                                                |
|    | },                                                               |
|    | execute = function(domoticz, item)                               |
|    | domoticz.log('alarme nuit: ' .. item.trigger)                    |
|    | if (time=='23:00') then                                          |
|    | if(domoticz.devices('al_nuit_auto').state == "On") then          |
|    | domoticz.devices('alarme_nuit').switchOn();print('al_nuit=ON')   |
|      end                                                              |
|    | elseif (time=='06:00') then                                      |
|    | if(domoticz.devices('al_nuit_auto').state == "On") then          |
|    | domoticz.variables('alarme').set('alarme_auto');                 |
|    | domoticz.devices('alarme_nuit').switchOff();print('al_nuit=OFF') |
|      end                                                              |
|    | end                                                              |
|    | end                                                              |
|    | }                                                                |
+=======================================================================+
+-----------------------------------------------------------------------+

.. image:: vertopal_6e277aed43794de08da7229da055806a/media/image195.png
   :width: 5.75139in
   :height: 3.55278in

| **1.5.2 Liens avec Home Assistant**
| **1.5.2.1 Exemple d’un ON OFF sur un interrupteur virtuel**

   .. image:: vertopal_6e277aed43794de08da7229da055806a/media/image196.png
      :width: 4.58333in
      :height: 2.00972in

   .. image:: vertopal_6e277aed43794de08da7229da055806a/media/image197.png
      :width: 3.97083in
      :height: 2.72917in

   .. image:: vertopal_6e277aed43794de08da7229da055806a/media/image198.png
      :width: 4.06528in
      :height: 1.55278in

Réponse de l’API sur l’état :

.. image:: vertopal_6e277aed43794de08da7229da055806a/media/image199.png
   :width: 6.30139in
   :height: 0.68611in

.. image:: vertopal_6e277aed43794de08da7229da055806a/media/image200.png
   :width: 5.69861in
   :height: 2.88611in

.. image:: vertopal_6e277aed43794de08da7229da055806a/media/image201.png
   :width: 6.30139in
   :height: 0.86806in

**La fonction PHP**

.. image:: vertopal_6e277aed43794de08da7229da055806a/media/image202.png
   :width: 6.30139in
   :height: 3.42778in

Comme pour Domoticz une commande dans monitor appelle l’api qui exécute
la commande

footer.php : départ de la commande avec le script créé automatiquement
depuis la base de données

.. image:: vertopal_6e277aed43794de08da7229da055806a/media/image203.png
   :width: 6.30139in
   :height: 1.04861in

.. image:: vertopal_6e277aed43794de08da7229da055806a/media/image204.png
   :width: 5.84444in
   :height: 4.19861in

ajax.php :

.. image:: vertopal_6e277aed43794de08da7229da055806a/media/image205.png
   :width: 6.30139in
   :height: 0.4875in

La fonction PHP ci-dessus retourne pour les capteurs binaires :

.. image:: vertopal_6e277aed43794de08da7229da055806a/media/image206.png
   :width: 3.40694in
   :height: 2.27083in

En plus clair :

.. image:: vertopal_6e277aed43794de08da7229da055806a/media/image207.png
   :width: 4.73056in
   :height: 3.5625in

……………….Pour les interrupteurs réels : l’API retourne un tableau vide ,
d’où un appel de l’API/states pour avoir une confirmation du changement
d’état.

Pour faire des essais à partir d’un navigateur :

.. image:: vertopal_6e277aed43794de08da7229da055806a/media/image208.png
   :width: 6.30139in
   :height: 0.98611in

**1.6 – Lien avec la base de données SQL**

**1.6.1- exemple avec la date de ramassage des poubelles**

En Dordogne, les poubelles jaunes sont ramassées toutes les 2 semaines
mais les poubelles grises sont ramassées selon une procédure différente
:

| Le contrat annuel comprend 12 ramassages mais le ramassage est
  possible chaque semaine, il faut donc gérer au mieux le nombre de
  ramassages pour éviter des facturations
| supplémentaires…c’est le script décrit ici qui enregistre les dates
  des ramassages réels effectués.

Il faut au préalable ajouter une table dans la base de données

+-----------------------------------------------------------------------+
|    --                                                                 |
+=======================================================================+
+-----------------------------------------------------------------------+

+-----------------------------------------------------------------------+
|    -- Structure de la table \`date_poub\` --                          |
|                                                                       |
|    | CREATE TABLE \`date_poub\` (                                     |
|    | \`num\` int(11) NOT NULL,                                        |
|    | \`date\` text NOT NULL,                                          |
|    | \`valeur\` text NOT NULL,                                        |
|    | \`icone\` text NOT NULL                                          |
|    | ) ENGINE=InnoDB DEFAULT CHARSET=utf8;                            |
+=======================================================================+
+-----------------------------------------------------------------------+

+-----------------------------------+-----------------------------------+
| Les 2 icones svg                  |    .. im                          |
|                                   | age:: vertopal_6e277aed43794de08d |
|                                   | a7229da055806a/media/image209.png |
|                                   |       :width: 1.59306in           |
|                                   |       :height: 0.83333in          |
+===================================+===================================+
+-----------------------------------+-----------------------------------+

.. image:: vertopal_6e277aed43794de08da7229da055806a/media/image210.png
   :width: 6.26111in
   :height: 2.46806in

La page d’accueil :

.. image:: vertopal_6e277aed43794de08da7229da055806a/media/image211.png
   :width: 6.26806in
   :height: 3.86389in

| On ajoute un script dans **footer.php**
| Idx_idimg existe déjà dans footer.php , sa valeur est « poubelle_grise
  » ou
| « poubelle_jaune » suivant les valeurs choisies dans le script LUA de
  Domoticz ; on va ajouter une variable pour l’icône dans les données
  json

+-----------------------------------------------------------------------+
|    | $("#poubelle").click(function () {                               |
|    | var date_poub=new Date();                                        |
|    | var jour_poub=date_poub.getDate();                               |
|    | var an_poub=date_poub.getFullYear();                             |
|    | var months=new                                                   |
|    | Array('Janvier','Février','Ma                                    |
| rs','Avril','Mai','Juin','Juillet','Aout','Septembre','Octobre','Nove |
|      mbre','Décembre');                                               |
|    | var mois_poub=months[date_poub.getMonth()];                      |
|    | var date_poub=jour_poub+' '+mois_poub+" "+an_poub;               |
|    | $.ajax({                                                         |
|    | url: "ajax.php",                                                 |
|    | data:                                                            |
|    | "app=s                                                           |
| ql&idx=0&&variable=date_poub&type="+idx_idimg+"&command="+date_poub+" |
|      &name="+idx_ico,                                                 |
|    | }).done(function() {                                             |
|    | alert('date ramassage enregigistrée:' +date_poub);               |
|    | });                                                              |
|    | });                                                              |
|                                                                       |
|    });                                                                |
+=======================================================================+
+-----------------------------------------------------------------------+

.. image:: vertopal_6e277aed43794de08da7229da055806a/media/image212.png
   :width: 6.26111in
   :height: 6.40694in

   **Dans ajax.php :**

.. image:: vertopal_6e277aed43794de08da7229da055806a/media/image213.png
   :width: 6.26111in
   :height: 0.64583in

| **Dans fonctions .php**
| On ajoute la fonction :

.. image:: vertopal_6e277aed43794de08da7229da055806a/media/image214.png
   :width: 6.26806in
   :height: 3.20694in

+-----------------------------------------------------------------------+
|    | function sql_app($choix,$table,$valeur,$date,$icone=''){         |
|    | // SERVEUR SQL connexion                                         |
|    | $conn = new mysqli(SERVEUR,UTILISATEUR,MOTDEPASSE,DBASE);        |
|    | if ($choix==0) {                                                 |
|    | $sql="INSERT INTO ".$table." (`num`, \`date`, \`valeur`,         |
|      \`valeur`) VALUES (NULL, '".$date."', '".$valeur."',             |
|      '".$icone."');";                                                 |
|    | $result = $conn->query($sql);                                    |
|    | ;}                                                               |
|    | if ($choix==1) {                                                 |
|    | $sql="SELECT \* FROM ".$table." ORDER BY num DESC LIMIT 24";     |
|    | $result = $conn->query($sql);                                    |
|    | $number = $result->num_rows;                                     |
|    | while($row = $result->fetch_array(MYSQLI_ASSOC)){                |
|    | echo $row['date'].' '.$row['valeur'].' <img                      |
|      style="width:30px;vertical-align:middle"                         |
|      src="'.$row['icone'].'"/><br>';                                  |
|    | }                                                                |
|    | }                                                                |
|                                                                       |
|    | $conn->close();                                                  |
|    | return;}                                                         |
+=======================================================================+
+-----------------------------------------------------------------------+

Et pour ajouter l’icône au fichier json concernant les variables :

.. image:: vertopal_6e277aed43794de08da7229da055806a/media/image215.png
   :width: 5.54306in
   :height: 5.91667in

Le json :

   .. image:: vertopal_6e277aed43794de08da7229da055806a/media/image216.png
      :width: 3.84444in
      :height: 2.125in

Avec phpMyAdmin :

.. image:: vertopal_6e277aed43794de08da7229da055806a/media/image217.png
   :width: 5.50139in
   :height: 1.24028in

Les enregistrements sont sauvegardés, pour afficher l’historique des
dates, voir le *paragraphe 11* concernant les app diverses (l’affichage
log de dz et Nagios, …)

.. image:: vertopal_6e277aed43794de08da7229da055806a/media/image218.png
   :width: 5.48056in
   :height: 2.70833in

| **1.7 – Ajuster le menu au nombre de pages**
| Au-delà de 12 pages il faut étendre en largeur le menu ; il faut aussi
  le descendre de 50 px pour ne pas cacher le menu hamburger

.. image:: vertopal_6e277aed43794de08da7229da055806a/media/image219.png
   :width: 5.48056in
   :height: 2.67639in

Modification à apporter au fichier **: /js/big-Slide.js** :

.. image:: vertopal_6e277aed43794de08da7229da055806a/media/image220.png
   :width: 3.29305in
   :height: 3.59444in

Pour descendre le menu : modifier la class .nav dans **css/mes_css.css**

.. image:: vertopal_6e277aed43794de08da7229da055806a/media/image221.png
   :width: 3.52222in
   :height: 1.1875in

**2.\_ Une 1ere PAGE : LE PLAN INTERIEUR**

**2.1 l’image**

Pour construire l’image du plan au format svg on utilise

| 1 Adobe Illustrateur, payant mais (version hackée sur le net)
| 2 Inskape gratuit open source :

Les avantages d’utiliser des images svg c’est de pouvoir manipuler le
contenu avec javascript dans le DOM. Pour cela l’image doit faire partie
complètement du HTML, l’url de l’image ne suffit pas.

Comme on ne peut pas charger uniquement cette url avec par exemple <img
src= ’’image.svg ‘’>, il faut inclure cette image dans un fichier PHP et
faire un include : < ?php include (‘image_svg.php’) ;?>

Il n’est pas facile au début d’utiliser ces logiciels pour construire
complètement un plan ; une autre solution est de construire le plan au
format jpg ou png avec un outil graphique plus facile à utiliser,
Photofiltre, Paint ou Gimp et de convertir ensuite l’image au format svg
en ligne avec par exemple :

| C’est une bonne solution pour débuter mais quand tout fonctionne, il
  est alors temps de réaliser un plan directement avec AI, le poids du
  fichier sera réduit de beaucoup et la qualité sera excellente **Les
  deux solutions :**
| **2.1.1 Avec un logiciel de conception graphique vectorielle**
| **– 2.1.1.a avec Inkscape qui est gratuit**
| On délimite le terrain en traçant un rectangle et en choisissant la
  couleur

   .. image:: vertopal_6e277aed43794de08da7229da055806a/media/image222.png
      :width: 5in
      :height: 3.76111in

On construit les murs extérieurs de la même façon ; on peut ajuster
l’épaisseur en utilisant la barre supérieure

   .. image:: vertopal_6e277aed43794de08da7229da055806a/media/image223.png
      :width: 4.63889in
      :height: 4.50694in

   Pour modifier les objets :

   .. image:: vertopal_6e277aed43794de08da7229da055806a/media/image224.png
      :width: 5.84444in
      :height: 3.4875in

   Toujours avec un rectangle, on ajoute les pièces

   .. image:: vertopal_6e277aed43794de08da7229da055806a/media/image225.png
      :width: 6.02917in
      :height: 4.07361in

   On peut faire du copier/coller

   .. image:: vertopal_6e277aed43794de08da7229da055806a/media/image226.png
      :width: 4.25in
      :height: 4.29861in

Pour regrouper des objets de même couleur ou d’un même ensemble :
GROUPER

   .. image:: vertopal_6e277aed43794de08da7229da055806a/media/image227.png
      :width: 4.27222in
      :height: 4.89583in

   Pour dégrouper :

   .. image:: vertopal_6e277aed43794de08da7229da055806a/media/image228.png
      :width: 3.64583in
      :height: 4.52083in

   Pour les textes

   .. image:: vertopal_6e277aed43794de08da7229da055806a/media/image229.png
      :width: 4.02083in
      :height: 3.81667in

   | Améliorer l’emplacement des ouvertures :
   | On reste dégroupé et on trace un rectangle autour des murs

.. image:: vertopal_6e277aed43794de08da7229da055806a/media/image230.png
   :width: 5.36944in
   :height: 4.15556in

.. image:: vertopal_6e277aed43794de08da7229da055806a/media/image231.png
   :width: 5.31389in
   :height: 3.19722in

   .. image:: vertopal_6e277aed43794de08da7229da055806a/media/image232.png
      :width: 5.19028in
      :height: 2.86528in

Contrairement à Adobe Illustrator , Inkscape ne gère pas les feuilles de
style mais celles indiquées sont afficher dans les navigateurs.

Pour ajouter des class pour gérer les changements de couleur dans
monitor pour certains dispositifs :

   .. image:: vertopal_6e277aed43794de08da7229da055806a/media/image233.png
      :width: 5.5in
      :height: 5.53889in

   On donne un nom à cette classe :

   .. image:: vertopal_6e277aed43794de08da7229da055806a/media/image234.png
      :width: 5.38194in
      :height: 3.90556in

   L’objet avec la class :

   .. image:: vertopal_6e277aed43794de08da7229da055806a/media/image235.png
      :width: 3.69861in
      :height: 4.79167in

   Lans le fichier .svg

   .. image:: vertopal_6e277aed43794de08da7229da055806a/media/image236.png
      :width: 3.09306in
      :height: 3.45139in

   Remarque :

   .. image:: vertopal_6e277aed43794de08da7229da055806a/media/image237.png
      :width: 5.44861in
      :height: 3.72222in

   On ajoute aussi une class aux textes

   .. image:: vertopal_6e277aed43794de08da7229da055806a/media/image238.png
      :width: 4.28194in
      :height: 5.14861in

   La feuille de style complète pour le plan

   .. image:: vertopal_6e277aed43794de08da7229da055806a/media/image239.png
      :width: 2.19861in
      :height: 2.54167in

   L’image est centrée au milieu du calque , on la déplace à l’angle
   droit haut

   .. image:: vertopal_6e277aed43794de08da7229da055806a/media/image240.png
      :width: 5.54167in
      :height: 3.24028in

   On fait correspondre l’image avec la page

   .. image:: vertopal_6e277aed43794de08da7229da055806a/media/image241.png
      :width: 5.38611in
      :height: 3.69861in

   On sauvegarde l l’image

On nettoie le code et on créer un fichier PHP qui contiendra l’image ;
pour que cette image soit modifiable par le DOM, elle ne peut être
appelée directement comme pour les formats classiques mais chargée
entièrement dans le fichier HTML.

**Avant nettoyage :**

.. image:: vertopal_6e277aed43794de08da7229da055806a/media/image242.png
   :width: 4.99028in
   :height: 6.68194in

**Après nettoyage : on** supprime la partie ci-dessus (jusqu’à «
<style>) et on la remplace par :

+-----------------------------------------------------------------------+
| **<svg version="1.1" id="Calque_1" viewBox="0 0 150 150">**           |
+=======================================================================+
+-----------------------------------------------------------------------+

.. image:: vertopal_6e277aed43794de08da7229da055806a/media/image243.png
   :width: 5.46944in
   :height: 1.60417in

**Pour comprendre viewbox :**

Affichage dans monitor (on peut ajouter une marge pour centrer l’image)
534x720 : tablette chinoise

.. image:: vertopal_6e277aed43794de08da7229da055806a/media/image244.png
   :width: 4.49028in
   :height: 4.54722in

.. image:: vertopal_6e277aed43794de08da7229da055806a/media/image245.png
   :width: 4.53194in
   :height: 4.0625in

PC : 1200x612

.. image:: vertopal_6e277aed43794de08da7229da055806a/media/image246.png
   :width: 6.26806in
   :height: 4.6625in

   **2.1.1.b avec Adobe Illustrator**

La construction est sensiblement la même, la différence pour notre
sujet, réside dans la description

des ID ; Inkscape ajoute des id partout, AI en ajoute aucun, sauf si on
le spécifie, comme ci-dessous ;

Il est impératif pour retrouver facilement les objets d’ajouter les id à
la construction.

   .. image:: vertopal_6e277aed43794de08da7229da055806a/media/image247.png
      :width: 4.96944in
      :height: 5.68056in

   .. image:: vertopal_6e277aed43794de08da7229da055806a/media/image248.png
      :width: 6.3in
      :height: 1.78194in

Les cercles ici indiquent lorsqu’ils clignotent, un changement de piles
à prévoir ; le N° qui sui « cercle » est l’id du dispositif.

Dans Inkscape, lors de la construction, il est possible d’ajouter du
javascript, avec AI, il faut l’ajouter avec un éditeur de texte ou
dreamweaver.

   .. image:: vertopal_6e277aed43794de08da7229da055806a/media/image249.png
      :width: 6.3in
      :height: 2.60556in

   Attention aux styles après construction :

   .. image:: vertopal_6e277aed43794de08da7229da055806a/media/image250.png
      :width: 5.91667in
      :height: 1.83333in

   Un style qui existe alors qu’il n’est pas utilisé crée une erreur

   **Mon plan avec AI** : dans le paragraphe suivant la première version
   de ce plan faite

avec une conversion png->svg

   .. image:: vertopal_6e277aed43794de08da7229da055806a/media/image251.png
      :width: 5.44861in
      :height: 7.5125in

   **2.1.2 – 2eme solution pour le plan, conversion en ligne**

   .. image:: vertopal_6e277aed43794de08da7229da055806a/media/image252.png
      :width: 4.00972in
      :height: 3.5375in

**Mon fichier floorplan.png**

.. image:: vertopal_6e277aed43794de08da7229da055806a/media/image253.png
   :width: 5.53194in
   :height: 5.59306in

**Conversion avec Autotracer :**

.. image:: vertopal_6e277aed43794de08da7229da055806a/media/image254.png
   :width: 4.67778in
   :height: 4.1875in

.. image:: vertopal_6e277aed43794de08da7229da055806a/media/image255.png
   :width: 5.00139in
   :height: 4.9375in

**Avec Inkscape :**

Les textes transformés ne sont pas toujours lisibles, il faut modifier
le plan, on ajoute des rectangles de la même couleur :

.. image:: vertopal_6e277aed43794de08da7229da055806a/media/image256.png
   :width: 2.48056in
   :height: 1.3125in

   .. image:: vertopal_6e277aed43794de08da7229da055806a/media/image257.png
      :width: 2.00972in
      :height: 1.09444in

.. image:: vertopal_6e277aed43794de08da7229da055806a/media/image258.png
   :width: 6.26806in
   :height: 4.275in

**2.1.3 – Les couleurs**

Choisir des couleurs web : 6 familles (#00xxxx, #33xxxx, #66xxxx,
#99xxxx, #CCxxxx, #FFxxxx),

216 couleurs, ce qui limite ne nombre de class ; un seul fichier de
class pour tout le site… la

construction est plus longue et là aussi il faut le faire depuis le
début

   |image5|\ |image6|

   .. image:: vertopal_6e277aed43794de08da7229da055806a/media/image260.png
      :width: 2.19722in
      :height: 2.675in

| **2.1.4 - ajout d’un ou plusieurs dispositifs**
| Sur le net on trouve des icones au format svg, sinon on transforme les
  png avec Autotracer Les icones que j’ai choisies : contact d’ouverture
  de porte et détecteur de présence

**3** |image7|

| 4Pour les textes il suffit par exemple d’ajouter « tmp » qui sera en
  javascript remplacé par la température enregistrée par le dispositif
| Importer l’icone

.. image:: vertopal_6e277aed43794de08da7229da055806a/media/image262.png
   :width: 3.63611in
   :height: 2.94861in

.. image:: vertopal_6e277aed43794de08da7229da055806a/media/image263.png
   :width: 6.26806in
   :height: 4.49444in

.. image:: vertopal_6e277aed43794de08da7229da055806a/media/image264.png
   :width: 5.35556in
   :height: 5.23889in

.. image:: vertopal_6e277aed43794de08da7229da055806a/media/image265.png
   :width: 5.24028in
   :height: 3.53194in

Redimensionner l’(les)objet(s) :

.. image:: vertopal_6e277aed43794de08da7229da055806a/media/image266.png
   :width: 3.06389in
   :height: 2.08333in

Comme on peut le voir, avec les images svg le remplacement de couleur,
de textes s’effectuent rapidement lors de la création ; il en est de
même dans le HTML en utilisant javascript

Ajouter un texte « tmp » par exemple pour l’affichage de la température
; ce texte sera remplacé par la valeur de la température ; les
détecteurs de présence peuvent souvent enregistrer la température.

.. image:: vertopal_6e277aed43794de08da7229da055806a/media/image267.png
   :width: 5.12639in
   :height: 3.95833in

Pour les dispositifs et les textes, ajouter un ID :

Avec Inkscape, il est possible d’ajouter facilement un ID lors de la
construction de l’image

.. image:: vertopal_6e277aed43794de08da7229da055806a/media/image268.png
   :width: 5.67778in
   :height: 6.08333in

La couleur de l’objet :

.. image:: vertopal_6e277aed43794de08da7229da055806a/media/image269.png
   :width: 6.26806in
   :height: 4.41528in

Avec Adobe Illustrator :

.. image:: vertopal_6e277aed43794de08da7229da055806a/media/image270.png
   :width: 6.03194in
   :height: 3.84444in

Enregistrer le fichier, j’ai choisi « interieur.svg », le nom de ma page

.. image:: vertopal_6e277aed43794de08da7229da055806a/media/image271.png
   :width: 6.26806in
   :height: 1.17361in

Pour les textes c’est la même façon de procéder

.. image:: vertopal_6e277aed43794de08da7229da055806a/media/image272.png
   :width: 5.25139in
   :height: 4.16667in

Aperçu d’une image avec de nombreux dispositifs

.. image:: vertopal_6e277aed43794de08da7229da055806a/media/image273.png
   :width: 5.20972in
   :height: 5.125in

**2.2 Des exemples d’autres dispositifs :**

**2.2.1 Ajout du détecteur de fumée :**

   Ajout de l’icône avec Inkscape :

|image8|\ |image9|

Dans les paramètres de l’objet on a ajouté :

   Un href, un id, un titre et un onclick avec un id (idm ou idx) ;
   option choisie dans /admin/config.php

   .. image:: vertopal_6e277aed43794de08da7229da055806a/media/image276.png
      :width: 3.53194in
      :height: 0.35417in

**2.2.2 Ajout de caméras**

Comme il n’existe pas d’idx Domoticz, nous réserverons la plage >= 10
000 pour cela ; cette valeur peut être modifiée, voir le paragraphe
2.2.1

.. image:: vertopal_6e277aed43794de08da7229da055806a/media/image277.png
   :width: 6.26111in
   :height: 1.84305in

   La base de données :

   .. image:: vertopal_6e277aed43794de08da7229da055806a/media/image278.png
      :width: 6.26806in
      :height: 0.50972in

**2.3 le fichier PHP de l’image**

Avec Notepad, on supprime les premières lignes (Inkscape), comme indiqué
au *§2.1.1* ou les 2 ou 3 premières lignes (AI) :

.. image:: vertopal_6e277aed43794de08da7229da055806a/media/image279.png
   :width: 6.19861in
   :height: 0.61389in

Enregistrer l’image au format PHP dans le dossier /include:
interieur_svg.php (utilisé ici)

Récupérer dans Domoticz les noms et les idx des dispositifs

.. image:: vertopal_6e277aed43794de08da7229da055806a/media/image280.png
   :width: 6.26111in
   :height: 0.88472in

Dans la table « dispositifs » de la base de données Maria DB Domoticz,
enregistrer ces données ; si c’est une première installation de monitor,
idm peut être le même qu’idx ; dans l’exemple ci-dessous idm est
différent après une réinstallation de Domoticz.

.. image:: vertopal_6e277aed43794de08da7229da055806a/media/image281.png
   :width: 6.26111in
   :height: 1.01111in

Autre exemple :

.. image:: vertopal_6e277aed43794de08da7229da055806a/media/image282.png
   :width: 6.26806in
   :height: 3.53056in

.. image:: vertopal_6e277aed43794de08da7229da055806a/media/image283.png
   :width: 6.26111in
   :height: 3.42778in

Que fait le script javascript qui gère les dispositifs :

.. image:: vertopal_6e277aed43794de08da7229da055806a/media/image284.png
   :width: 6.26111in
   :height: 5.66667in

L’appel ajax : appelle la fonction PHP devices_plan($variable), la
variable est le N° du Plan

.. image:: vertopal_6e277aed43794de08da7229da055806a/media/image285.png
   :width: 6.26806in
   :height: 0.19444in

La fonction PHP :

.. image:: vertopal_6e277aed43794de08da7229da055806a/media/image286.png
   :width: 6.21944in
   :height: 6.8125in

Le Json renvoyé :

.. image:: vertopal_6e277aed43794de08da7229da055806a/media/image287.png
   :width: 3.77222in
   :height: 5.33333in

Monitor peut afficher un changement de couleur du dispositif, une
température mais à condition de retrouver l’ID du dispositif ou l’ID du
texte dans le DOM.

C’est pourquoi nous avons ajouté des ID lors de la construction du plan.

Un aperçu du fichier interieur_svg.php :

Pour une icône avec une seule couleur, l’ID de l’icône est suffisant
mais avec une icône où une seule partie est colorée comme pour
l’ouverture de porte, ii est facile, avec F12 d’inspecter la partie de
l’icône qui nous intéresse et de rajouter un ID dans le <path concerné :

.. image:: vertopal_6e277aed43794de08da7229da055806a/media/image288.png
   :width: 6.26806in
   :height: 3.91528in

C’est alors cet ID qu’il faudra entrer pour le dispositif dans la Base
de données SQL.

.. image:: vertopal_6e277aed43794de08da7229da055806a/media/image289.png
   :width: 6.21944in
   :height: 0.49028in

Pour les textes, si l’ID n’a pas été spécifié à la construction de
l’image, ils sont faciles à retrouver avec une recherche sur Notepad
pour ajouter un ID ;

Sur AI il faudra souvent modifier légèrement l’ID

.. image:: vertopal_6e277aed43794de08da7229da055806a/media/image290.png
   :width: 6.26111in
   :height: 2.20833in

**2.3.1 Pour afficher le statut complet du dispositif :**

.. image:: vertopal_6e277aed43794de08da7229da055806a/media/image291.png
   :width: 4.85556in
   :height: 5.35417in

   .. image:: vertopal_6e277aed43794de08da7229da055806a/media/image292.png
      :width: 3.59444in
      :height: 3.375in

   .. image:: vertopal_6e277aed43794de08da7229da055806a/media/image293.png
      :width: 3.11528in
      :height: 3.41667in

| C’est la fonction javascript du fichier footer.php qui ouvre cette
  fenêtre :
| Remarque : les caméras ne sont pas des dispositifs dans Domoticz,
  aussi des ID >= à 10000 leur sont attribués ; cette valeur peut être
  modifiée en modifiant le programme qui suit.

.. image:: vertopal_6e277aed43794de08da7229da055806a/media/image294.png
   :width: 5.53194in
   :height: 6.65694in

Cette fonction est activée par un onclick que l’on ajoute dans l’image ;
par contre la BD n’est pas nécessaire pour cet affichage, à condition
que le onclick possède comme id l’idx de Domoticz.

.. image:: vertopal_6e277aed43794de08da7229da055806a/media/image295.png
   :width: 6.00139in
   :height: 1.03194in

Avec Inkscape ce onclick peut être ajouter lors de la construction, avec
AI il faut l’ajouter manuellement comme ci-dessus :

.. image:: vertopal_6e277aed43794de08da7229da055806a/media/image296.png
   :width: 4.43889in
   :height: 4.11528in

.. image:: vertopal_6e277aed43794de08da7229da055806a/media/image297.png
   :width: 4.09167in
   :height: 4.18889in

Pour indiquer que l’élément est cliquable, comme pour le HTML, on ajoute
une balise <a ; non nécessaire surtout pour les tablettes.

.. image:: vertopal_6e277aed43794de08da7229da055806a/media/image298.png
   :width: 6.26111in
   :height: 1.95833in

Ou lors de la construction avec Inkscape :

.. image:: vertopal_6e277aed43794de08da7229da055806a/media/image299.png
   :width: 6.26806in
   :height: 3.68611in

Où :

.. image:: vertopal_6e277aed43794de08da7229da055806a/media/image300.png
   :width: 2.99028in
   :height: 2.30139in

**2.3.2 Affichage des caméras :**

Pour les caméras génériques chinoises, pour les configurer : Internet
explorer est le seul navigateur qui permet d’afficher Net Surveillance

.. image:: vertopal_6e277aed43794de08da7229da055806a/media/image301.png
   :width: 4.85417in
   :height: 3.70278in

La table « cameras » dans la base de données SQL a été remplie, voir le
paragraphe concernant la base de données au début de ce document

.. image:: vertopal_6e277aed43794de08da7229da055806a/media/image302.png
   :width: 6.26667in
   :height: 1.15555in

Seulement si Zoneminder est utilisé :

Pour retrouver l’ID Zoneminder pour toutes les cameras :

Dans un navigateur : IP DE ZONEMINDER/zm/api/monitor.json

   .. image:: vertopal_6e277aed43794de08da7229da055806a/media/image303.png
      :width: 4.07361in
      :height: 2.69861in

   .. image:: vertopal_6e277aed43794de08da7229da055806a/media/image304.png
      :width: 4.41528in
      :height: 4.86111in

Les icones, les onclick, les <a pour le lien, ont été ajoutés sur le
plan ; une fenêtre (modal) est ajoutée

sur la page.

Voir paragraphe 2.1.2 : ajout dans l’image du plan

Voir paragraphe 2.3 : fichier PHP de la page avec les fenêtres modales
**La modale pour la fenêtre de l’image :**

.. image:: vertopal_6e277aed43794de08da7229da055806a/media/image305.png
   :width: 5.4375in
   :height: 2.51389in

C’est la fonction PHP « upload_img($idx) » appelée par ajax qui renvoi
l’image de la caméra

.. image:: vertopal_6e277aed43794de08da7229da055806a/media/image306.png
   :width: 5.84444in
   :height: 5.16667in

Le script JS dans footer.php :

.. image:: vertopal_6e277aed43794de08da7229da055806a/media/image307.png
   :width: 6.26806in
   :height: 4.70556in

| **Affichage de la configuration des caméras**:
| Pour les caméras Dahua, il existe un script spécifique ; pour les
  autres caméras, le script ne fonctionne que si Zoneminder est installé
  et la configuration effectuée :
| Le fichier de configuration admin/config.php :
| Si Zoneminder est utilisé

.. image:: vertopal_6e277aed43794de08da7229da055806a/media/image308.png
   :width: 6.20833in
   :height: 2.54167in

+-----------------------------------------------------------------------+
|    | **Pour Zoneminder l’accès aux données :**                        |
|    | **API 2.0 le token :**                                           |
|                                                                       |
|    Dans options/système                                               |
|                                                                       |
| ..                                                                    |
|  image:: vertopal_6e277aed43794de08da7229da055806a/media/image309.png |
|    :width: 5.07222in                                                  |
|    :height: 1.30833in                                                 |
|                                                                       |
|    Réponse avec opt_use_auth coché :                                  |
|                                                                       |
| ..                                                                    |
|  image:: vertopal_6e277aed43794de08da7229da055806a/media/image310.png |
|    :width: 5.16528in                                                  |
|    :height: 1.71944in                                                 |
|                                                                       |
|    Réponse avec opt_use_auth décoché :                                |
|                                                                       |
| ..                                                                    |
|  image:: vertopal_6e277aed43794de08da7229da055806a/media/image311.png |
|    :width: 5.10417in                                                  |
|    :height: 1.86111in                                                 |
|                                                                       |
| Ci-dessus c’est un exemple manuel, la demande se fera en PHP          |
| automatiquement                                                       |
+=======================================================================+
+-----------------------------------------------------------------------+

L’affichage de cette config est géré par un script JS : modalink et non
par une fenêtre modale

qui est déjà ouverte pour l’image ; appel de ce script par le bouton
dans la modale de

l’image : voir également paragraphe 2.3

.. image:: vertopal_6e277aed43794de08da7229da055806a/media/image312.png
   :width: 4.10833in
   :height: 0.7125in

Les script JS, dans footer.php et dans mes_js.js : *Dans footer.php :*

.. image:: vertopal_6e277aed43794de08da7229da055806a/media/image313.png
   :width: 6.26806in
   :height: 2.55139in

.. image:: vertopal_6e277aed43794de08da7229da055806a/media/image314.png
   :width: 6.26806in
   :height: 1.54722in

*Dans mes_js.js :*

.. image:: vertopal_6e277aed43794de08da7229da055806a/media/image315.png
   :width: 5.83333in
   :height: 6.67083in

   .. image:: vertopal_6e277aed43794de08da7229da055806a/media/image316.png
      :width: 3.90556in
      :height: 4.89583in

Le fichier ajax.php et Le script PHP, function
cam_config($marque,$type,$ip,$cam,$idzm), (dans fonctions.php)

.. image:: vertopal_6e277aed43794de08da7229da055806a/media/image317.png
   :width: 6.26806in
   :height: 0.45833in

Extrait de la fonction cam_config du fichier :

Pour caméras DAHUA :

.. image:: vertopal_6e277aed43794de08da7229da055806a/media/image318.png
   :width: 5.13611in
   :height: 6.03472in

Modification CURL pour les différents types d’Autorisation des caméras
Dahua :

+-----------------------------------------------------------------------+
|    | 3.2Authentication                                                |
|    | The IP Camera supplies two authentication ways: basic            |
|      authentication and digest authentication. Client can login       |
|      through:                                                         |
|    | http://<ip>/cgi-bin/global.login?userName=admin. The IP camera   |
|      returns 401. Then the client inputs a username and password to   |
|      authorize.                                                       |
|                                                                       |
|    | For example:                                                     |
|    | 1. When basic authentication, the IP camera response:            |
|    | 401 Unauthorized                                                 |
|    | WWW-Authenticate: Basic realm=”XXXXXX”                           |
|    | Then the client encode the username and password with base64,    |
|      send the following request: Authorization: Basic VXZVXZ.         |
|                                                                       |
|    | 2. When digest authentication, the IP camera response:           |
|    | WWW-Authenticate: Digest realm="DH_00408CA5EA04",                |
|    | nonce="000562fdY631973ef04f77a3ede7c1832ff48720ef95ad",          |
|    | stale=FALSE, qop="auth";                                         |
|    | The client calculates the digest using username, password,       |
|      nonce, realm and URI with MD5, then send the following request:  |
|    | Authorization: Digest username="admin", realm="DH_00408CA5EA04", |
|      nc=00000001,cnonce="0a4f113b",qop="auth"                         |
|      nonce="000562fdY631973ef04f7                                     |
| 7a3ede7c1832ff48720ef95ad",uri="cgi-bin/global.login?userName=admin", |
|      response="65002de02df697e946b750590b44f8bf"                      |
+=======================================================================+
+-----------------------------------------------------------------------+

| Dire à Curl d'accepter plusieurs méthodes comme ceci :
| curl_easy_setopt(curl, CURLOPT_HTTPAUTH, CURLAUTH_BASIC \|
  CURLAUTH_DIGEST);

.. image:: vertopal_6e277aed43794de08da7229da055806a/media/image319.png
   :width: 6.07361in
   :height: 2.88472in

Pour caméras onvif autres :

.. image:: vertopal_6e277aed43794de08da7229da055806a/media/image320.png
   :width: 6.26806in
   :height: 5.13333in

   Comme le token peut être utile dans d’autres pages création d’une
   fonction pour cela :

.. image:: vertopal_6e277aed43794de08da7229da055806a/media/image321.png
   :width: 6.26806in
   :height: 3.50555in

   *Pour la fenêtre modale voir le paragraphe 2.3 concernant la page
   PHP*

   **2.3.3 La gestion des dispositifs à piles :**

Assurée par la fonction PHP devices_plan (), vue précédemment ; la
variable dans la base de

   données SQL a aussi été décrite lors de la configuration minimale

   Table « dispositifs » : variables

   .. image:: vertopal_6e277aed43794de08da7229da055806a/media/image322.png
      :width: 5.28194in
      :height: 2.13611in

   Table « text_image » :

   .. image:: vertopal_6e277aed43794de08da7229da055806a/media/image323.png
      :width: 6.26111in
      :height: 1.33333in

   **accueil.php**

.. image:: vertopal_6e277aed43794de08da7229da055806a/media/image324.png
   :width: 6.26806in
   :height: 1.20833in

+-----------------------------------------------------------------------+
|    **css** :                                                          |
+=======================================================================+
+-----------------------------------------------------------------------+

+-----------------------------------------------------------------------+
|    ..                                                                 |
|  image:: vertopal_6e277aed43794de08da7229da055806a/media/image325.png |
|       :width: 2.55in                                                  |
|       :height: 0.8375in                                               |
+=======================================================================+
+-----------------------------------------------------------------------+

Pour une meilleure visualisation des dispositifs dont la pile est à
remplacer, un ajout sur l’image du plan d’un signe distinctifs : un
cercle clignotant.

Pour une meilleure compréhension, toute la gestion des piles sera
décrite ici ;

Dans un cadre jaune, ce qui devra être ajouté, le reste ayant déjà été
créé (variables Domoticz et SQL, images svg, …

.. image:: vertopal_6e277aed43794de08da7229da055806a/media/image326.png
   :width: 6.26111in
   :height: 2.78056in

.. image:: vertopal_6e277aed43794de08da7229da055806a/media/image327.png
   :width: 4.25139in
   :height: 1.02083in

.. image:: vertopal_6e277aed43794de08da7229da055806a/media/image328.png
   :width: 4.63472in
   :height: 2.85in

Variables Domoticz :

   .. image:: vertopal_6e277aed43794de08da7229da055806a/media/image329.png
      :width: 6.01944in
      :height: 1.23611in

+-----------------------------------------------------------------------+
|    La notification de batterie faible, par SMS :                      |
|                                                                       |
| ..                                                                    |
|  image:: vertopal_6e277aed43794de08da7229da055806a/media/image330.png |
|    :width: 5.99028in                                                  |
|    :height: 3.6125in                                                  |
+=======================================================================+
+-----------------------------------------------------------------------+

..

   Le script dz :

+-----------------------------------------------------------------------+
| +------------------------------------------------------------------+  |
| +------------------------------------------------------------------+  |
|                                                                       |
| ..                                                                    |
|                                                                       |
|    ..                                                                 |
|  image:: vertopal_6e277aed43794de08da7229da055806a/media/image331.png |
|       :width: 4.24028in                                               |
|       :height: 5.15694in                                              |
+=======================================================================+
+-----------------------------------------------------------------------+

..

   Sur la page d’accueil

   .. image:: vertopal_6e277aed43794de08da7229da055806a/media/image332.png
      :width: 1.85694in
      :height: 1.12639in

   Sur la page des dispositifs

   |image10| |image11|

.. image:: vertopal_6e277aed43794de08da7229da055806a/media/image335.png
   :width: 3.94861in
   :height: 4.60417in

En plus d’une gestion globale, un cercle clignotant indique que la pile
devra être remplacée

sur le dispositif concerné.

Ce cercle visible selon l’état de la batterie est ajouté au plan :

+-----------------------------------------------------------------------+
| |image12|                                                             |
+=======================================================================+
+-----------------------------------------------------------------------+

..

   Il suffit d’ajouter en copier/coller des cercles à tous les
   dispositifs sur piles.

+-----------------------------------------------------------------------+
|    css :                                                              |
|                                                                       |
|    ..                                                                 |
|  image:: vertopal_6e277aed43794de08da7229da055806a/media/image337.png |
|       :width: 3.78472in                                               |
|       :height: 2.08194in                                              |
+=======================================================================+
+-----------------------------------------------------------------------+

..

   Les valeurs sont définies dans le fichier de configuration
   /admin/config.php :

.. image:: vertopal_6e277aed43794de08da7229da055806a/media/image338.png
   :width: 6.26806in
   :height: 1.07639in

   La fonction javascript : function maj_devices(plan) :

.. image:: vertopal_6e277aed43794de08da7229da055806a/media/image339.png
   :width: 6.26111in
   :height: 2.1875in

**2.3 4 Le contrôle de la tension d’alimentation :**

.. image:: vertopal_6e277aed43794de08da7229da055806a/media/image340.png
   :width: 5.49028in
   :height: 2.88472in

| Le fichier voltmetre_svg.php
| Comme pour les dispositifs on télécharge une image svg ; comme pour le
  plan, sur Inkscape ou AI on ajoute un texte (tmp ou autre) qui sera
  remplacé par la valeur de la tension.

On enregistre cette image dans un fichier PHP (on supprime les lignes
inutiles).

On ajoute aussi un ID

.. image:: vertopal_6e277aed43794de08da7229da055806a/media/image341.png
   :width: 6.26806in
   :height: 1.56528in

Le dispositif Domoticz :

.. image:: vertopal_6e277aed43794de08da7229da055806a/media/image342.png
   :width: 4.03194in
   :height: 1.21944in

La base de données SQL :

.. image:: vertopal_6e277aed43794de08da7229da055806a/media/image343.png
   :width: 6.26806in
   :height: 0.59444in

.. image:: vertopal_6e277aed43794de08da7229da055806a/media/image344.png
   :width: 1.38472in
   :height: 0.75in

| Pour maj_js, au lieu de temp il est possible de remplacer le type par
  un autre texte ; pour cela il faut modifier le script JS
| Le script JS dans le fichier footer.php, déjà vu précédemment :

.. image:: vertopal_6e277aed43794de08da7229da055806a/media/image345.png
   :width: 6.26806in
   :height: 1.07639in

| **2.3 5 ajouter des lampes :**
| Voir un exemple dans le paragraphe 4.1.1 consacré à l’extérieur de la
  maison, les lampe de jardin
| **2.3.6 ajouter un capteur de T° extérieur Zigbee**

.. image:: vertopal_6e277aed43794de08da7229da055806a/media/image346.png
   :width: 5.51111in
   :height: 3.36528in

**2.3.6.1 Le capteur dans Domoticz :**

.. image:: vertopal_6e277aed43794de08da7229da055806a/media/image347.png
   :width: 3.95972in
   :height: 1.28194in

.. image:: vertopal_6e277aed43794de08da7229da055806a/media/image348.png
   :width: 3.58472in
   :height: 0.69722in

*Dans le plan de Domoticz :*

.. image:: vertopal_6e277aed43794de08da7229da055806a/media/image349.png
   :width: 2.59444in
   :height: 1.60417in

**2.3.6.2 Le capteur dans la BD :**

.. image:: vertopal_6e277aed43794de08da7229da055806a/media/image350.png
   :width: 6.26806in
   :height: 0.3625in

On a choisi de limiter le nb de caractère à 4, à l’origine : |image13|

| **2.3.6.3 Le capteur dans Monitor :**
| **L’image :**

+-----------------------------------------------------------------------+
|    | <svg version="1.1" id="th_1" xmlns="http://www.w3.org/2000/svg"  |
|    | xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px"       |
|    | viewBox="0 0 20 20" style="enable-background:new 0 0 20 20;"     |
|      xml:space="preserve"> <a xlink:href="#interieur"                 |
|      onclick="popup_device(23)"><path style="fill: #84bef1;" rel="23" |
|      d="M9,11.2V7h2v4.2c1.6,0.6,2.4,2.3,1.8,3.8c-0.6,1.6-2.3,2.4-     |
|    | 3.8,1.8S6.6,14.6,7.2,13C7.5,12.1,8.1,11.5,9,11.2z M8,10.5        |
|    | c-1.9,1.1-2.6,3.6-1.5,5.5s3.6,2.6,5.5,1.5c1.9-1.1,2.6-           |
| 3.6,1.5-5.5c-0.4-0.6-0.9-1.1-1.5-1.5V4c0-1.1-0.9-2-2-2S8,2.9,8,4V10.5 |
|    | L8,10.5z                                                         |
|      M6,9.5V4c0-2.2,1.8-4,4-4s4,1.                                    |
| 8,4,4v5.5c2.5,2.2,2.7,6,0.5,8.5c-1.1,1.3-2.8,2-4.5,2c-3.3,0-6-2.7-6-6 |
|    | C4,12.3,4.7,10.7,6,9.5z"/></a>                                   |
|    | <text id="temp_ext_cuisine" transform="matrix(0.6725 0 0 1       |
|      7.4663 15.254)" class="st33 st36b">tmp</text>                    |
|    | </svg>                                                           |
+=======================================================================+
+-----------------------------------------------------------------------+

.. image:: vertopal_6e277aed43794de08da7229da055806a/media/image352.png
   :width: 6.26806in
   :height: 2.09305in

Le fichier Json

.. image:: vertopal_6e277aed43794de08da7229da055806a/media/image353.png
   :width: 3.48055in
   :height: 4.10417in

.. image:: vertopal_6e277aed43794de08da7229da055806a/media/image354.png
   :width: 3.94861in
   :height: 4.85833in

| **2.4 le fichier PHP de la page**
| Il faut maintenant ajouter la page sur le site
| Un modèle de page pour toutes les pages du site :

+-----------------------------------------------------------------------+
|    | <!-- section TITRE start -->                                     |
|    | <!-- ================ -->                                        |
|    | <div id="ID DE LA PAGE" class="CLASS DE LA PAGE OPTIONNEL"> <div |
|      class="container">                                               |
|    | <div class="col-md-12">                                          |
|    | <h1 class="title_TITRE text-center"> exemple Prévisions<span>    |
|      météo</span></h1>                                                |
|                                                                       |
|    | <div class="CLASS DU CONTENU" style="color:black;"> <div id="ID  |
|      DE CETTE LIGNE" >LIGNE OPTIONNELLE</div>                         |
|    | <div id="CONTENU" class="table-responsive"></div> <div id="AUTRE |
|      CONTENU OPTIONNEL"></div>                                        |
|    | </div> </div>                                                    |
|    | </div>                                                           |
|    | </div>                                                           |
|    | <!-- fin de la section TITRE -->                                 |
+=======================================================================+
+-----------------------------------------------------------------------+

En Bleu du contenu optionnel

.. image:: vertopal_6e277aed43794de08da7229da055806a/media/image355.png
   :width: 6.26111in
   :height: 2.66667in

Sur cette page, des fenêtres(modal) peuvent être ajoutées si besoin,
Bootstrap facilite la création ; sur la page décrite en suivant, 2
fenêtres sont ajoutées.

Le menu :

.. image:: vertopal_6e277aed43794de08da7229da055806a/media/image356.png
   :width: 5.16806in
   :height: 2.1875in

Le fichier interieur .php

.. image:: vertopal_6e277aed43794de08da7229da055806a/media/image357.png
   :width: 6.26111in
   :height: 5.21806in

Le fichier index_loc.php : pour info, en général ne pas modifier ce
fichier

.. image:: vertopal_6e277aed43794de08da7229da055806a/media/image358.png
   :width: 5.94861in
   :height: 4.03194in

Le fichier include/header.php :

.. image:: vertopal_6e277aed43794de08da7229da055806a/media/image359.png
   :width: 6.26111in
   :height: 1.24028in

.. image:: vertopal_6e277aed43794de08da7229da055806a/media/image360.png
   :width: 4.16805in
   :height: 4.85417in

| CSS : css/mes_css.css
| Le style existe déjà pour toutes les pages , pour les modifier :

.. image:: vertopal_6e277aed43794de08da7229da055806a/media/image361.png
   :width: 5.91806in
   :height: 2.1875in

.. image:: vertopal_6e277aed43794de08da7229da055806a/media/image362.png
   :width: 5.53194in
   :height: 7.49167in

**2.5 F12 des navigateurs pour faciliter la construction**

Pour les PIR, les capteurs d’ouverture, pour le changement de couleur :

.. image:: vertopal_6e277aed43794de08da7229da055806a/media/image363.png
   :width: 6.26806in
   :height: 8.17222in

**2.6 Les dispositifs virtuels Domoticz et MQTT**

Pour monitor ça n’a pas d’importance, il n’y a pas de notion « virtuel –
réel » mais la mise à

jour de ces dispositifs dans Domoticz n’est pas toujours facile surtout
pour les dispositifs

avec plusieurs valeurs tels que température+ Humidité température
+batterie, …

**Un script dz : séparation_valeurs.lua**

.. image:: vertopal_6e277aed43794de08da7229da055806a/media/image364.png
   :width: 6.26806in
   :height: 4.325in

Depuis Domoticz 2021.1

.. image:: vertopal_6e277aed43794de08da7229da055806a/media/image365.png
   :width: 4.69861in
   :height: 2.45833in

**3.\_ Météo**

| 2 affichages :
| 5Une page de prévision à 14 jours de Météo Concept 6Une alerte pluie
  imminent (à 1 h de météo France) **3.1\_ Page météo**
| Cette page n’a PAS DE LIAISON AVEC DOMOTICZ
| Voir également le site

.. image:: vertopal_6e277aed43794de08da7229da055806a/media/image366.png
   :width: 6.26806in
   :height: 2.70972in

L’API est gratuite chez Météo Concept mais il faut s’enregistrer pour
obtenir une clé Le PHP : dans fonctions.php

.. image:: vertopal_6e277aed43794de08da7229da055806a/media/image367.png
   :width: 5.91806in
   :height: 5.72917in

.. image:: vertopal_6e277aed43794de08da7229da055806a/media/image368.png
   :width: 6.26111in
   :height: 2.91667in

Le JS dans footer.php

.. image:: vertopal_6e277aed43794de08da7229da055806a/media/image369.png
   :width: 4.70972in
   :height: 3.125in

Pour la mise à jour auto chaque matin :

.. image:: vertopal_6e277aed43794de08da7229da055806a/media/image370.png
   :width: 6.16667in
   :height: 2.32222in

Le HTML : la page meteo.php

.. image:: vertopal_6e277aed43794de08da7229da055806a/media/image371.png
   :width: 5.46944in
   :height: 7.53333in

.. image:: vertopal_6e277aed43794de08da7229da055806a/media/image372.png
   :width: 6.25in
   :height: 3.72917in

Il faut ajouter la page au site ; la procédure est toujours la même : :
dans config.php, Mettre la variable à « true » ; **il faut au préalable
demander un token gratuit.**

.. image:: vertopal_6e277aed43794de08da7229da055806a/media/image373.png
   :width: 5.30278in
   :height: 0.85417in

Dans header.php, l’affichage dans le menu est alors automatique.

.. image:: vertopal_6e277aed43794de08da7229da055806a/media/image374.png
   :width: 6.24028in
   :height: 0.9375in

La page meteo.php :

.. image:: vertopal_6e277aed43794de08da7229da055806a/media/image375.png
   :width: 6.26111in
   :height: 5.3125in

Les css : en plus du style pour la page :

.. image:: vertopal_6e277aed43794de08da7229da055806a/media/image376.png
   :width: 4.04305in
   :height: 0.70833in

Les icones :

.. image:: vertopal_6e277aed43794de08da7229da055806a/media/image377.png
   :width: 5.63611in
   :height: 3.63611in

.. image:: vertopal_6e277aed43794de08da7229da055806a/media/image378.png
   :width: 5.52222in
   :height: 5.14583in

| **3.2\_ La Météo à 1 heure de Météo France :**
| Ne fait pas partie de la page météo : affichage sur la page d’accueil

.. image:: vertopal_6e277aed43794de08da7229da055806a/media/image379.png
   :width: 5.46944in
   :height: 3.625in

.. image:: vertopal_6e277aed43794de08da7229da055806a/media/image380.png
   :width: 6.17778in
   :height: 5.20833in

accueil.php :

.. image:: vertopal_6e277aed43794de08da7229da055806a/media/image381.png
   :width: 5.55278in
   :height: 1in

Les icones svg « pluie imminente » et « pas de pluie » :

+-----------------+-----------------+-----------------+-----------------+
| |image14|       | |image15|       | |image16|       |    .. image::   |
|                 |                 |                 | vertopal_6e277a |
|                 |                 |                 | ed43794de08da72 |
|                 |                 |                 | 29da055806a/med |
|                 |                 |                 | ia/image385.png |
|                 |                 |                 |                 |
|                 |                 |                 | :width: 0.625in |
|                 |                 |                 |       :he       |
|                 |                 |                 | ight: 1.04167in |
+=================+=================+=================+=================+
+-----------------+-----------------+-----------------+-----------------+

**Footer.php :**

.. image:: vertopal_6e277aed43794de08da7229da055806a/media/image386.png
   :width: 6.30139in
   :height: 4.01667in

PHP : ajax.php et fonction PHP « app_met($choix) » ajax.php :

.. image:: vertopal_6e277aed43794de08da7229da055806a/media/image387.png
   :width: 6.26806in
   :height: 0.36111in

Dans fonctions.php :

+-----------------------+-----------------------+-----------------------+
| 2                     | -                     |    Choix :            |
+=======================+=======================+=======================+
|                       |                       |    (1) en HTML sur le |
|                       |                       |    site               |
+-----------------------+-----------------------+-----------------------+

..

   | Indiquer Commune-Code postal
   | - (2) par météo France et son API avec un Token

.. image:: vertopal_6e277aed43794de08da7229da055806a/media/image388.png
   :width: 6.26806in
   :height: 5.23194in

La base de données : correspondance texte – image, la table
**text_image**

.. image:: vertopal_6e277aed43794de08da7229da055806a/media/image389.png
   :width: 6.26806in
   :height: 1.35417in

Voir le site

.. image:: vertopal_6e277aed43794de08da7229da055806a/media/image390.png
   :width: 6.26111in
   :height: 2.09444in

**3.3\_ Autres prévisions météo depuis météo Concept :**

- relevés temps réel depuis une station :

- prévision heure par heure : peut remplacer Darsky (devenu payant) ou
OpenWeatherMap,

c’est français et plus facile d’utilisation, nombreux exemple sur le
site web Méteoconcept

.. image:: vertopal_6e277aed43794de08da7229da055806a/media/image391.png
   :width: 6.30139in
   :height: 2.73333in

.. image:: vertopal_6e277aed43794de08da7229da055806a/media/image392.png
   :width: 5.77222in
   :height: 1.1875in

**4.\_ La page du plan extérieur**

.. image:: vertopal_6e277aed43794de08da7229da055806a/media/image393.png
   :width: 5.63611in
   :height: 7.49167in

La construction est la même que pour la page inteieur.php.

Le chargement des pages se faisant dès l’appel de l’url, pour éviter les
class similaires dans l’image svg, si **elle a été créée avec Adobe
Illustrateur)**, il est impératif de les renommer.

| Avec Inkscape, la feuille de style n’est pas gérée par le logiciel,
  mais insérer par l’utilisateur lors de la construction :
| UNIQUEMENT POUR AI

+-----------------------------------------------------------------------+
|    ..                                                                 |
|  image:: vertopal_6e277aed43794de08da7229da055806a/media/image394.png |
|       :width: 3.55139in                                               |
|       :height: 3.24444in                                              |
|                                                                       |
|    Quelques styles comme les textes utilisent plusieurs classes, ils  |
|    ne sont pas nombreux : les modifier manuellement.                  |
|                                                                       |
|    ..                                                                 |
|  image:: vertopal_6e277aed43794de08da7229da055806a/media/image395.png |
|       :width: 5.96111in                                               |
|       :height: 1.60417in                                              |
|                                                                       |
|    | Pour réduire le nombre de classes et éviter les doublons de      |
|      couleurs, de polices, …des solutions existent :                  |
|    | - Construire les 2 plans intérieur et extérieur dans la même     |
|      image et les exporter séparément ensuite ; il suffit alors de ne |
|      garder que l’ensemble des styles sans les doublons (même         |
|      classes) ; pas toujours facile car on commence souvent avec      |
|      quelques dispositifs sur un plan, ensuite il est trop tard       |
+=======================================================================+
+-----------------------------------------------------------------------+

Nettoyage : Ces lignes ne servent à rien : les enlever

   .. image:: vertopal_6e277aed43794de08da7229da055806a/media/image396.png
      :width: 2.51111in
      :height: 0.98056in

L’image est sauvegardée par exemple en « exterieur_svg.php » (un fichier
avec l’extension

.php) :

**4.1 – La page PHP : exterieur.php :**

| Les infos des dispositifs : la fenêtre modale est commune avec
  interieur.php Les dispositifs en plus des capteurs classiques déjà
  décrits :
| - Eclairage du jardin
| - Arrosage automatique
| - Portier vidéo
| - Boite aux lettres, ….

| Ils sont chargés avec un seul script, celui décrit dans footer.php
  (voir interieur.php)
| Pour les caméras une fenêtre modale, identique à celle de
  interieur.php, (aux ID près) est ajouter sur la page

.. image:: vertopal_6e277aed43794de08da7229da055806a/media/image397.png
   :width: 5.26111in
   :height: 5.52639in

.. image:: vertopal_6e277aed43794de08da7229da055806a/media/image398.png
   :width: 6.02222in
   :height: 3.55278in

.. image:: vertopal_6e277aed43794de08da7229da055806a/media/image399.png
   :width: 5.54306in
   :height: 5.46944in

**4.1 .1– Ajouter des lampes**

Apres avoir téléchargé une image svg ajouter les icones au plan

.. image:: vertopal_6e277aed43794de08da7229da055806a/media/image400.png
   :width: 4.27083in
   :height: 2.9875in

   .. image:: vertopal_6e277aed43794de08da7229da055806a/media/image401.png
      :width: 2.41667in
      :height: 1.85139in

Pour commander les lampes : un interrupteur virtuel dans Domoticz ou un
interrupteur réel (Zigbee ou Zwave) avec son double dans Domoticz

.. image:: vertopal_6e277aed43794de08da7229da055806a/media/image402.png
   :width: 4.15694in
   :height: 1.45833in

Un double de cet interrupteur sera aussi ajouté à Monitor, c’est l’objet
du chapitre « mur ON/OFF »

La table « dispositifs » SQL :

.. image:: vertopal_6e277aed43794de08da7229da055806a/media/image403.png
   :width: 4.77222in
   :height: 0.83333in

.. image:: vertopal_6e277aed43794de08da7229da055806a/media/image404.png
   :width: 6.26806in
   :height: 0.70833in

Pour chaque lampe, on indique la class dans l’image svg : avec le
navigateur et F12 c’est le plus simple car une class pour la couleur
existe déjà, il suffit d’ajouter la class choisie ; dans l’attribut
class, il faut séparer les class avec un espace.

.. image:: vertopal_6e277aed43794de08da7229da055806a/media/image405.png
   :width: 5.13611in
   :height: 1.99861in

La fonction maj_devices, déjà décrite pour les IDs des dispositifs, la
partie du script consacrée aux lampes :

.. image:: vertopal_6e277aed43794de08da7229da055806a/media/image406.png
   :width: 6.1875in
   :height: 4.34444in

Il n’existe pas de commande simple en javascript, comme pour les IDs,
pour effectuer des changements d’attribut ; les ID sont uniques alors
que les class peuvent être utilisées de nombreuses fois ; il faut donc
balayer tous les éléments pour les rechercher, c’est ce que fait la
fonction « class_name »

**4.2. – affichage :**

Il suffit, comme pour toutes les pages optionnelles ne mettre la
variable à « true » :

.. image:: vertopal_6e277aed43794de08da7229da055806a/media/image407.png
   :width: 5.48889in
   :height: 0.64444in

**5. – L’ALARME**

Pour l’activation ou l’arrêt par GSM voire ce paragraphe qui traite du
script python avec les codes retenus pour l’alarme. *$ 18.4*

.. image:: vertopal_6e277aed43794de08da7229da055806a/media/image408.png
   :width: 5.64444in
   :height: 5.56389in

Pour entrer le mot de passe : redirection vers la page administration

**5.1 Dans Domoticz, les interrupteurs virtuels**

Les boutons poussoir marche/arrêt pour les commandes :

   | - m/a alarme de nuit
   | - m/a alarme absence
   | - m/a al_nuit_auto
   | - m/a sirène
   | - m/a mode detect des caméras
   | - poussoir de reset des valeurs de Domoticz,
   | - activation/désactivation de la sirène : permet de faire des
     essais sans nuisances sonores ; la sirène est toutefois indiquée ON
     ou OFF

| Option : allumages de lampes :
| -Dans ce tuto : lampe_salon (lampe commandée par le 433MHz avec une
  interface Sonoff modifié, voir le site domo-site.fr

   .. image:: vertopal_6e277aed43794de08da7229da055806a/media/image409.png
      :width: 4.44861in
      :height: 2.625in

   Pour le test sirène : un interrupteur « PUSH »

   .. image:: vertopal_6e277aed43794de08da7229da055806a/media/image410.png
      :width: 4.68889in
      :height: 1.75in

   .. image:: vertopal_6e277aed43794de08da7229da055806a/media/image411.png
      :width: 6.5in
      :height: 0.51111in

   .. image:: vertopal_6e277aed43794de08da7229da055806a/media/image412.png
      :width: 6.26806in
      :height: 0.45in

   .. image:: vertopal_6e277aed43794de08da7229da055806a/media/image413.png
      :width: 6.26806in
      :height: 0.5in

   On ajoute les dispositifs au plan ; le plan peut se résumer à un
   simple cadre ou être très simplifié, il ne sert qu’à regrouper les
   dispositifs pour récupérer les données avec un seul appel à l’API
   json

   .. image:: vertopal_6e277aed43794de08da7229da055806a/media/image414.png
      :width: 5.26111in
      :height: 4.39444in

   .. image:: vertopal_6e277aed43794de08da7229da055806a/media/image415.png
      :width: 6.26806in
      :height: 0.21111in

   .. image:: vertopal_6e277aed43794de08da7229da055806a/media/image416.png
      :width: 4.05278in
      :height: 0.57222in

   .. image:: vertopal_6e277aed43794de08da7229da055806a/media/image417.png
      :width: 5.55278in
      :height: 4.65694in

**Création de variables, initialisée à 0**

   - ma-alarme :

   .. image:: vertopal_6e277aed43794de08da7229da055806a/media/image418.png
      :width: 4.51944in
      :height: 1.61389in

   o alarme non activée,

   o1 alarme absence activée, les capteurs PIR sont pris en compte

   o2 alarme nuit activée, les capteurs PIR sont ignorés

   - modect : pour la mise en service de la détection par caméras (non
   utilisé actuellement, pour

   une notification en page d’accueil ou autre …)

   .. image:: vertopal_6e277aed43794de08da7229da055806a/media/image419.png
      :width: 6.26667in
      :height: 0.77222in

   - porte-ouverte

   - intrusion

   | - alarme : sera utilisée pour un affichage sur la page d’accueil ;
     il est plus facile de créer une variable supplémentaire qui
     contiendra un texte pour pouvoir faire une équivalence texte- image
     dans la BD
   | - activation-sir-txt, texte activation de la sirène : *activer ou
     désactiver*

   .. image:: vertopal_6e277aed43794de08da7229da055806a/media/image420.png
      :width: 6.5in
      :height: 0.85694in

   .. image:: vertopal_6e277aed43794de08da7229da055806a/media/image421.png
      :width: 6.26806in
      :height: 0.2875in

   .. image:: vertopal_6e277aed43794de08da7229da055806a/media/image422.png
      :width: 6.26806in
      :height: 0.84306in

Notifications : notifications_devices.lua

.. image:: vertopal_6e277aed43794de08da7229da055806a/media/image423.png
   :width: 3.94861in
   :height: 2.88611in

.. image:: vertopal_6e277aed43794de08da7229da055806a/media/image424.png
   :width: 6.26806in
   :height: 5.11111in

| ATTENTION :
| L’utilisation du modem 4G Ebyte n’autorise pas, pour les textes, les
  accents et les espaces, utiliser des Under scores pour séparer les
  mots
| Script notifications_variables.lua, lignes concernées :

.. image:: vertopal_6e277aed43794de08da7229da055806a/media/image425.png
   :width: 6.05278in
   :height: 1.52083in

Script notifications_timer.lua, lignes concernées :

+-----------------------------------------------------------------------+
|    -- notifications_timer                                             |
|                                                                       |
|    | local time = string.sub(os.date("%X"), 1, 5)                     |
|    | return {                                                         |
|    | on = {                                                           |
|    | timer = {                                                        |
|    | 'at 23:00',                                                      |
|    | 'at 06:00',                                                      |
|    | }                                                                |
+=======================================================================+
+-----------------------------------------------------------------------+

+-----------------------------------------------------------------------+
|    | },                                                               |
|    | execute = function(domoticz, item)                               |
|    | domoticz.log('alarme nuit: ' .. item.trigger)                    |
|    | if (time=='23:00') then                                          |
|    | if(domoticz.devices('al_nuit_auto').state == "On") then          |
|    | domoticz.devices('alarme_nuit').switchOn();print('al_nuit=ON')   |
|      end                                                              |
|    | elseif (time=='06:00') then                                      |
|    | if(domoticz.devices('al_nuit_auto').state == "On") then          |
|    | domoticz.variables('alarme').set('alarme_auto');                 |
|    | domoticz.devices('alarme_nuit').switchOff();print('al_nuit=OFF') |
|      end                                                              |
|    | end                                                              |
|    | end                                                              |
|    | }                                                                |
+=======================================================================+
+-----------------------------------------------------------------------+

.. image:: vertopal_6e277aed43794de08da7229da055806a/media/image426.png
   :width: 6.26806in
   :height: 3.77361in

L’utilisation de timer= at hh :mm-hh :mm ne peut être utilisé ; j’ai
essayé isTimer mais ça ne

fonctionne que pour ON ; else avec isTimer ne fonctionne pas.

Ajout du script « alarme_intrusion.lua dans évènements de Domoticz :

.. image:: vertopal_6e277aed43794de08da7229da055806a/media/image427.png
   :width: 6.26806in
   :height: 5.37361in

.. image:: vertopal_6e277aed43794de08da7229da055806a/media/image428.png
   :width: 6.26806in
   :height: 4.22778in

.. image:: vertopal_6e277aed43794de08da7229da055806a/media/image429.png
   :width: 6.26806in
   :height: 6.00694in

| **Pour activer ou désactiver la sirène :**
| Pour les textes : notifications_devices.lua

.. image:: vertopal_6e277aed43794de08da7229da055806a/media/image430.png
   :width: 6.26806in
   :height: 0.69722in

Pour l’activation ou la désactivation :

.. image:: vertopal_6e277aed43794de08da7229da055806a/media/image431.png
   :width: 6.26806in
   :height: 1.48055in

Pour allumer des lampes :

.. image:: vertopal_6e277aed43794de08da7229da055806a/media/image432.png
   :width: 5.41806in
   :height: 1.625in

Pour ajouter des dispositifs :

.. image:: vertopal_6e277aed43794de08da7229da055806a/media/image433.png
   :width: 6.21944in
   :height: 2.91667in

Le fichier pushover.sh :

+-----------------------------------------------------------------------+
|    | #!/bin/bash                                                      |
|    | TITLE="Alerte"                                                   |
|    | APP_TOKEN="xxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxx"                   |
|      USER_TOKEN="xxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxx" MESSAGE=$1     |
|    | echo $1                                                          |
|    | curl -s -F "token=$APP_TOKEN" \\                                 |
|    | -F "user=$USER_TOKEN" \\                                         |
|    | -F "title=$TITLE" \\                                             |
|    | -F "message=$MESSAGE" \\                                         |
|    | https://api.pushover.net/1/messages.json                         |
+=======================================================================+
+-----------------------------------------------------------------------+

Ou en Python :

+-----------------------------------------------------------------------+
|    #!/bin/python                                                      |
+=======================================================================+
+-----------------------------------------------------------------------+

+-----------------------------------------------------------------------+
|    | import requests,sys                                              |
|    | x= str(sys.argv[1])                                              |
|    | r = requests.post("https://api.pushover.net/1/messages.json",    |
|      data = { "token": "xxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxx",         |
|    | "user": "xxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxx",             |
|    | "message": x                                                     |
|    | })                                                               |
|    | print(r.text)                                                    |
+=======================================================================+
+-----------------------------------------------------------------------+

Voir les pages du site ,

Et

Résumé des scripts Domoticz concernés :

.. image:: vertopal_6e277aed43794de08da7229da055806a/media/image434.png
   :width: 6.26806in
   :height: 4.45139in

**5.1.1 explications concernant MODECT**

Si l’alarme absence est activée les caméras autorisées passent en mode
MODECT

automatiquement.

Dans les autres cas Modect peut être activé manuellement.

.. image:: vertopal_6e277aed43794de08da7229da055806a/media/image435.png
   :width: 4.22917in
   :height: 3.63472in

.. image:: vertopal_6e277aed43794de08da7229da055806a/media/image436.png
   :width: 4.70972in
   :height: 4.47917in

**Il faut avoir installé Zoneminder**

   **5.1.1.1 Jeton ZM**

   Dans fonctions.php :

   .. image:: vertopal_6e277aed43794de08da7229da055806a/media/image437.png
      :width: 6.26806in
      :height: 3.91667in

   .. image:: vertopal_6e277aed43794de08da7229da055806a/media/image438.png
      :width: 6.26806in
      :height: 5.73333in

   Le format du fichier est json pour une exploitation facile avec
   Domoticz **5.1.1.2 le script lua :**

   .. image:: vertopal_6e277aed43794de08da7229da055806a/media/image439.png
      :width: 6.26806in
      :height: 3.18611in

   Le fichier string_modect est écrit automatiquement dans «
   administration »

   .. image:: vertopal_6e277aed43794de08da7229da055806a/media/image440.png
      :width: 3.3125in
      :height: 2.54861in

   .. image:: vertopal_6e277aed43794de08da7229da055806a/media/image441.png
      :width: 4.35694in
      :height: 2.75972in

   Le choix des caméras se fait dans la BD :

   .. image:: vertopal_6e277aed43794de08da7229da055806a/media/image442.png
      :width: 2.76111in
      :height: 2.8125in

**5.2 Construction de l’image**

On ajoute les composants avec Inkscape, les ID pour les changements de
couleur, pas besoin de onclick, il n’y a que des dispositifs virtuels.

La construction de la page est identique à celle du plan intérieur.

.. image:: vertopal_6e277aed43794de08da7229da055806a/media/image443.png
   :width: 6.26806in
   :height: 3.59583in

   .. image:: vertopal_6e277aed43794de08da7229da055806a/media/image444.png
      :width: 5.03194in
      :height: 4.1375in

Les boutons M/A sont réalisés avec 2 cercles de grandeur et de couleur
différentes, les poussoirs simples (les mains) sont des icones
téléchargées ; l’icône png de Domoticz a été convertie en svg.

+-----------------------+-----------------------+-----------------------+
| |image17|             |    .. image           |    .. image           |
|                       | :: vertopal_6e277aed4 | :: vertopal_6e277aed4 |
|                       | 3794de08da7229da05580 | 3794de08da7229da05580 |
|                       | 6a/media/image446.png | 6a/media/image447.png |
|                       |                       |                       |
|                       |     :width: 1.05278in |     :width: 0.84444in |
|                       |                       |                       |
|                       |    :height: 1.13472in |    :height: 1.17778in |
+=======================+=======================+=======================+
+-----------------------+-----------------------+-----------------------+

On ajoute des zones de textes pour la date, les messages ,….

.. image:: vertopal_6e277aed43794de08da7229da055806a/media/image448.png
   :width: 5.28194in
   :height: 6.25in

.. image:: vertopal_6e277aed43794de08da7229da055806a/media/image449.png
   :width: 4.50139in
   :height: 1.16667in

On enregistre l’image dans un fichier PHP, comme indiqué au paragraphe
2.2

On peut aussi ajouter les ID avec F12 du navigateur

.. image:: vertopal_6e277aed43794de08da7229da055806a/media/image450.png
   :width: 5.94861in
   :height: 1.4375in

| Vérifier avec un navigateur qu’il n’y a pas de doublon d’ID (F12) ;
  dans ce cas faire des
| remplacements : ex remplacer « pathxxxx » ou avec Notepad tous les
  ’’path remplacé par ‘’patha

Un extrait concernant le bouton « activation/désactivation de la sirène
»

.. image:: vertopal_6e277aed43794de08da7229da055806a/media/image451.png
   :width: 6.26806in
   :height: 4.91389in

| **5.3- Base de données,**
| **Table « dispositifs »**
| Après avoir ajouté les ID : enregistrement des dispositifs virtuels
  dans la base de données ; On ajoute au dispositif dans la colonne pass
  : « pwdalarm » pour limiter l’accès ;(cette valeur peut être modifiée
  dans config.php)

.. image:: vertopal_6e277aed43794de08da7229da055806a/media/image452.png
   :width: 6.26111in
   :height: 1.83333in

.. image:: vertopal_6e277aed43794de08da7229da055806a/media/image453.png
   :width: 6.26806in
   :height: 0.28611in

Comme on peut le voir pour l’alarme absence il a été préféré l’ID du
cercle à l’ID de Inkscape

.. image:: vertopal_6e277aed43794de08da7229da055806a/media/image454.png
   :width: 5.77222in
   :height: 1.01111in

.. image:: vertopal_6e277aed43794de08da7229da055806a/media/image455.png
   :width: 6.26806in
   :height: 3.03472in

Il est aussi possible de renommer l’ID du cercle. **Partie concernant
les variables**

.. image:: vertopal_6e277aed43794de08da7229da055806a/media/image456.png
   :width: 6.19861in
   :height: 4.25972in

**5.4- Le PHP**

**alarme.php :**

.. image:: vertopal_6e277aed43794de08da7229da055806a/media/image457.png
   :width: 5.10139in
   :height: 6.14583in

**test_pass.php :** surligné en jaune : pour admin.php, voir le *§ 13.2*

+-----------------------------------------------------------------------+
|    | <?php                                                            |
|    | session_start();                                                 |
|    | echo '<script>text1="";</script>';                               |
|    | if (isset($_SESSION['time'])) {$tt=$_SESSION['time'];}           |
|    | else {$tt=0;echo "<p id='mp1' style='float:left;'>entrer mot de  |
|      passe - </p>";} if (isset($_SESSION['passworda']) &&             |
|      (($_SESSION['passworda']) != PWDALARM)){$tt=0;echo "mot de passe |
|      non valide - ";}                                                 |
|    | else {echo "<script>text1='pwd:ok';</script>";$style1="block";}  |
|    | if ($tt<time()) {$tt=0;echo "<p id='mp2' >temps pwd dépassé -    |
|      </p>";} if ($tt==0){                                             |
|    | echo                                                             |
|    | "<scrip                                                          |
| t>text1='pwd:absent';document.getElementById('d_btn_a').style.display |
|      =                                                                |
|    | 'block';document.getElementById('d_btn_al').style.display =      |
|      'block';                                                         |
|    | </script>";}                                                     |
|    | else {echo                                                       |
|      "<script>document.getElementById('info_admin').style.display =   |
|      'none';</script>";}                                              |
+=======================================================================+
+-----------------------------------------------------------------------+

+-----------------------------------------------------------------------+
|    | echo "<script>                                                   |
|    | document.getElementById('tspan7024').innerHTML=jour;             |
|      document.getElementById('console1').innerHTML=text1;             |
|      document.getElementById('not').innerHTML='';                     |
|    | </script>";                                                      |
|    | ?>                                                               |
+=======================================================================+
+-----------------------------------------------------------------------+

.. image:: vertopal_6e277aed43794de08da7229da055806a/media/image458.png
   :width: 6.26806in
   :height: 1.87639in

.. image:: vertopal_6e277aed43794de08da7229da055806a/media/image459.png
   :width: 5.85417in
   :height: 6.00972in

.. image:: vertopal_6e277aed43794de08da7229da055806a/media/image460.png
   :width: 3.52083in
   :height: 2.07361in

   .. image:: vertopal_6e277aed43794de08da7229da055806a/media/image461.png
      :width: 4.77222in
      :height: 1.34444in

Le fichier config.php gère les mots de passe de l’alarme et de la
commande des dispositifs (on/off)

.. image:: vertopal_6e277aed43794de08da7229da055806a/media/image462.png
   :width: 5.78194in
   :height: 1.74028in

Dans fonctions.php :

.. image:: vertopal_6e277aed43794de08da7229da055806a/media/image463.png
   :width: 5.19861in
   :height: 2.77083in

Le script qui commande les poussoirs M/A

.. image:: vertopal_6e277aed43794de08da7229da055806a/media/image464.png
   :width: 6.26111in
   :height: 3.13611in

**5.5- Le Javascript, dans footer.php et mes_js.js** Les scripts pour
les mots de passe, dans mes_js.js

.. image:: vertopal_6e277aed43794de08da7229da055806a/media/image465.png
   :width: 6.20833in
   :height: 4.40556in

Et le script pour le clavier affiché dans administration

.. image:: vertopal_6e277aed43794de08da7229da055806a/media/image466.png
   :width: 4.58472in
   :height: 4.40694in

| Sans mot de passe les commandes sont impossibles ; si le temps est
  dépassé pour
| l’utilisation du mot de passe, le bouton « Entrer votre mot de passe »
  apparait lors d’un click.

   .. image:: vertopal_6e277aed43794de08da7229da055806a/media/image467.png
      :width: 3.51111in
      :height: 2.57361in

   .. image:: vertopal_6e277aed43794de08da7229da055806a/media/image468.png
      :width: 5.57361in
      :height: 3.4375in

   La fonction maj_services (footer.php) permet la mise à jour des
   textes « *activer ou désactiver* »

   Le script pour afficher une modale « modalink »

.. image:: vertopal_6e277aed43794de08da7229da055806a/media/image469.png
   :width: 5.92778in
   :height: 3.54167in

| **5.6 -Comme pour les autres pages**,
| Il ne reste qu’à :
| - Ajouter cette page dans config.php

.. image:: vertopal_6e277aed43794de08da7229da055806a/media/image470.png
   :width: 2.38472in
   :height: 0.42778in

   - Ce qui ajoutera l’alarme dans le menu

   - |image18|

**5.7- Affichage d’une icône sur la page d’accueil :**

   .. image:: vertopal_6e277aed43794de08da7229da055806a/media/image472.png
      :width: 3.94722in
      :height: 5.32222in

Pour l’alarme de nuit, pour ne pas oublier de l’annuler le matin si la
fonction auto n’a pas été choisie

**css**

.. image:: vertopal_6e277aed43794de08da7229da055806a/media/image473.png
   :width: 4.05278in
   :height: 0.59444in

.. image:: vertopal_6e277aed43794de08da7229da055806a/media/image474.png
   :width: 6.5in
   :height: 0.21528in

**accueil.php :**

.. image:: vertopal_6e277aed43794de08da7229da055806a/media/image475.png
   :width: 6.26806in
   :height: 1.43194in

**Dans Domoticz :** la variable a déjà été crée

Quand l’alarme nuit est activée, son contenu :

.. image:: vertopal_6e277aed43794de08da7229da055806a/media/image476.png
   :width: 6.26806in
   :height: 0.52083in

**La table text_images** : correspondance entre le texte et l’image

.. image:: vertopal_6e277aed43794de08da7229da055806a/media/image477.png
   :width: 6.26111in
   :height: 0.50972in

**La table variables_dz** : la variable existe déjà, vérifier l’ID pour
l’icone

.. image:: vertopal_6e277aed43794de08da7229da055806a/media/image478.png
   :width: 6.5in
   :height: 0.34306in

.. image:: vertopal_6e277aed43794de08da7229da055806a/media/image479.png
   :width: 5.57361in
   :height: 4.99028in

**5.8 - Améliorations utiles**

**5.8.1- la mise en marche automatiquement de l’alarme de nuit**\ à
certaines

heures ;

On ajoute un bouton avec Inkscape ; pour cela :

   - On charge dans Inkscape le fichier PHP de l’image ; on accepte
   l’avertissement car ce

   n’est pas une extension svg.

   - On modifie l’image ; on ajoute un bouton

   - On sauvegarde l’image sous un autre nom, l’extension sera .svg

   - Comme précédemment avec les images, on la copie dans le fichier
   avec l’extension

   PHP.

.. image:: vertopal_6e277aed43794de08da7229da055806a/media/image480.png
   :width: 6.26806in
   :height: 4.59167in

**5.8.1.1 Dans Domoticz**,

   - On ajoute un poussoir virtuel : al_nuit_auto

-

   |image19|\ |image20|

   On ajout le switch au plan

   .. image:: vertopal_6e277aed43794de08da7229da055806a/media/image483.png
      :width: 5.69722in
      :height: 1.9875in

   .. image:: vertopal_6e277aed43794de08da7229da055806a/media/image484.png
      :width: 5.06389in
      :height: 2.99028in

Le script lua notification_timer.lua :

+-----------------------------------------------------------------------+
|    | return {                                                         |
|    | on = {                                                           |
|    | timer = {                                                        |
|    | 'at 23:00-11:00',                                                |
|    | }                                                                |
|    | },                                                               |
|    | execute = function(domoticz, item)                               |
|    | domoticz.log('The rule that triggered the event was: ' ..        |
|      item.trigger)                                                    |
|                                                                       |
|    | if(domoticz.devices('al_nuit_auto').state == "On" and            |
|      item.isTimer ) then                                              |
|      domoticz.devices('alarme_nuit').switchOn();print('al_nuit=ON')   |
|      else                                                             |
|      domoticz.devices('alarme_nuit').switchOff();print('al_nuit=OFF') |
|      end                                                              |
|    | end                                                              |
|    | }                                                                |
+=======================================================================+
+-----------------------------------------------------------------------+

Le script lua notification_devices.lua :

+-----------------------------------------------------------------------+
|    | execute = function(domoticz, device)                             |
|    | domoticz.log('device '..device.name..' was changed',             |
|      domoticz.LOG_INFO)                                               |
|                                                                       |
|    | -- alarme auto                                                   |
|    | if (device.name == 'al_nuit_auto' and device.state=='On') then   |
|      txt='alarme_nuit_auto_activee';alerte_gsm(txt);                  |
|      domoticz.variables('alarme').set("alarme_auto");                 |
|    | elseif (device.name == 'al_nuit_auto' and device.state=='Off')   |
|      then                                                             |
|    | txt='alarme_nuit_au                                              |
| to_desactivee';alerte_gsm(txt);domoticz.variables('alarme').set("0"); |
|    | end                                                              |
+=======================================================================+
+-----------------------------------------------------------------------+

Log :

.. image:: vertopal_6e277aed43794de08da7229da055806a/media/image485.png
   :width: 6.26806in
   :height: 0.8125in

**5.8.1.2 Dans Monitor,**

Pour cela on met à jour la table « dispositifs »

   .. image:: vertopal_6e277aed43794de08da7229da055806a/media/image486.png
      :width: 6.00972in
      :height: 3.67778in

   .. image:: vertopal_6e277aed43794de08da7229da055806a/media/image487.png
      :width: 3.49028in
      :height: 2.10417in

Comme pour tous les switch la commande a été ajoutée automatiquement sur
la page HTML :

.. image:: vertopal_6e277aed43794de08da7229da055806a/media/image488.png
   :width: 6.26111in
   :height: 1.57222in

**En page d’accueil**

.. image:: vertopal_6e277aed43794de08da7229da055806a/media/image489.png
   :width: 4.65694in
   :height: 3.51111in

La table text_image :

.. image:: vertopal_6e277aed43794de08da7229da055806a/media/image490.png
   :width: 4.41805in
   :height: 0.46944in

   .. image:: vertopal_6e277aed43794de08da7229da055806a/media/image491.png
      :width: 0.58333in
      :height: 0.79167in

L’image : L’image :

| **5.8.2 – Alarme par sms GSM (si un modem GSM installé) 5.8.2.1
  Version avec une variable Domoticz,**
| **Dans Domoticz**
| - Création d’une variable

.. image:: vertopal_6e277aed43794de08da7229da055806a/media/image492.png
   :width: 6.22917in
   :height: 0.91667in

   - Modification légère du script dz pour modifier la valeur de la
   variable en cas d’intrusion :

.. image:: vertopal_6e277aed43794de08da7229da055806a/media/image493.png
   :width: 5.57361in
   :height: 1.65555in

   | **5.8.2.1.1 modification du script qui assure la liaison avec le
     modem,**
   | Voir pour le script non modifié et des infos sur le fonctionnement
     Pour récupérer les données de la variable Domoticz, on utilise
     l’API ;
   | Une fois le SMS envoyé, on utilise l’API pour remettre à Zéro la
     variable.

   .. image:: vertopal_6e277aed43794de08da7229da055806a/media/image494.png
      :width: 4.86528in
      :height: 4.61389in

   On simplifie le script avec 2 fonctions :

   .. image:: vertopal_6e277aed43794de08da7229da055806a/media/image495.png
      :width: 5.5in
      :height: 7.11528in

Emplacement du script :

   .. image:: vertopal_6e277aed43794de08da7229da055806a/media/image496.png
      :width: 2.47917in
      :height: 3.25in

   **5.8.2.1.2 aperçus**

   On simule un intru en modifiant manuellement la variable :

.. image:: vertopal_6e277aed43794de08da7229da055806a/media/image497.png
   :width: 6.26806in
   :height: 0.84305in

   .. image:: vertopal_6e277aed43794de08da7229da055806a/media/image498.png
      :width: 3.60417in
      :height: 2.60417in

   **5.8.2.2 Version sans variable Domoticz,**

   **Avec un reload d’un module python**

| C’est la version que j’ai retenue
| On utilise un module python en import reload et on modifie ce module :
| - Avec Domoticz pour envoyer un message
| - Avec python pour arrêter l’envoi du message
| Création d’un fichier python : aldz.py, il ne contient qu’une variable
  avec la valeur « 0 », pour « pas de message » ; il contiendra x= «
  texte du SMS » en cas l’alarme

+-----------------------------------------------------------------------+
|    #!/usr/bin/env python3.7 -*- coing: utf-8 -*- x='0'                |
+=======================================================================+
+-----------------------------------------------------------------------+

.. image:: vertopal_6e277aed43794de08da7229da055806a/media/image499.png
   :width: 4.06389in
   :height: 0.50972in

On fait une copie de ce fichier : aldz.bak.py : ce fichier remplacera le
fichier original pour remettre à 0 la variable et cesser d’envoyer des
messages.

.. image:: vertopal_6e277aed43794de08da7229da055806a/media/image500.png
   :width: 3.24028in
   :height: 1.875in

Dans Domoticz, pas besoin de créer une variable, simplement modifier le
fichier aldz.py pour inclure à la variable x, le texte du SMS

.. image:: vertopal_6e277aed43794de08da7229da055806a/media/image501.png
   :width: 5.99028in
   :height: 2.64583in

Attention : si modem Ebyte, pas d’espaces et accents Le fichier sms_dz
est modifié (simplifié) :

.. image:: vertopal_6e277aed43794de08da7229da055806a/media/image502.png
   :width: 6.26111in
   :height: 6.02083in

**5.8.2.3- Option supplémentaire : le test de l’envoi de SMS**

.. image:: vertopal_6e277aed43794de08da7229da055806a/media/image503.png
   :width: 5.10417in
   :height: 3.37361in

L’image de l’alarme : on ajoute,

.. image:: vertopal_6e277aed43794de08da7229da055806a/media/image504.png
   :width: 6.26111in
   :height: 2.51111in

.. image:: vertopal_6e277aed43794de08da7229da055806a/media/image505.png
   :width: 6.26806in
   :height: 1.66944in

Domoticz : on ajoute un interrupteur virtuel

.. image:: vertopal_6e277aed43794de08da7229da055806a/media/image506.png
   :width: 6.26806in
   :height: 0.45972in

.. image:: vertopal_6e277aed43794de08da7229da055806a/media/image507.png
   :width: 3.45972in
   :height: 1.1875in

.. image:: vertopal_6e277aed43794de08da7229da055806a/media/image508.png
   :width: 4.18889in
   :height: 1.5in

On ajoute le dispositif au plan :

.. image:: vertopal_6e277aed43794de08da7229da055806a/media/image509.png
   :width: 4.6875in
   :height: 4.06667in

.. image:: vertopal_6e277aed43794de08da7229da055806a/media/image510.png
   :width: 4.68889in
   :height: 3.79167in

On ajoute qq lignes de script dans évènements dz
**notifications_devices.lua**

.. image:: vertopal_6e277aed43794de08da7229da055806a/media/image511.png
   :width: 6.26806in
   :height: 3.29028in

| ATTENTION NOTIFICATIONS SANS ESPACES SI MODEM EBYTE (le modem Ebyte
  n’accepte pas les espaces texte)
| Dans la BD :

.. image:: vertopal_6e277aed43794de08da7229da055806a/media/image512.png
   :width: 6.26806in
   :height: 0.83333in

.. image:: vertopal_6e277aed43794de08da7229da055806a/media/image513.png
   :width: 1.96944in
   :height: 0.30278in

L’exemple est intéressant car le clic s’effectue sur une partie de
l’image transparente

footer.php

Le script est ajouté automatiquement à partir des données de la BD

.. image:: vertopal_6e277aed43794de08da7229da055806a/media/image514.png
   :width: 6.26111in
   :height: 1.96806in

Affichage de l’alarme, une ellipse rouge est affichée sur l’icône ‘
smartphone’ ; elle reste affichée jusqu’à la prochaine mise à jour de
devices_plan() au plus tard : 3minutes par défaut mais modifiable dans
config.php

.. image:: vertopal_6e277aed43794de08da7229da055806a/media/image515.png
   :width: 4.80278in
   :height: 3.17639in

**5.8.3- Affichage de la liste des caméras Modect**

Cette liste est établie automatiquement avec une fonction dans «
administration »

.. image:: vertopal_6e277aed43794de08da7229da055806a/media/image516.png
   :width: 3.86528in
   :height: 3.25in

**Ajout d’une icone**

.. image:: vertopal_6e277aed43794de08da7229da055806a/media/image517.png
   :width: 4.26111in
   :height: 3.38194in

alarmes.php :

.. image:: vertopal_6e277aed43794de08da7229da055806a/media/image518.png
   :width: 6.26111in
   :height: 3.33333in

+-----------------------------------------------------------------------+
|    | <svg version="1.1" id="zm" xmlns="http://www.w3.org/2000/svg"    |
|    | xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px"       |
|    | viewBox="0 0 326 18" style="width:500px" xml:space="preserve">   |
|    | <style type="text/css">                                          |
|    | .st208{fill:#03A8F3;}                                            |
|    | .st207{font-size:13.5px;}                                        |
|    | </style><a id="zm" href="#alarmes">                              |
|    | <rect x="0.9" y="-0.7" class="st208" width="31.2"                |
|      height="18.8"/>                                                  |
|    | <text transform="matrix(1 0 0 1 5.4312 13.3434)" class="st203    |
|      st33 st207">Z M</text></a> </svg>                                |
+=======================================================================+
+-----------------------------------------------------------------------+

Dans footer.php , on appelle la fonction php sql_app() qui est déjà
utilisé dans « administration »

.. image:: vertopal_6e277aed43794de08da7229da055806a/media/image519.png
   :width: 6.26806in
   :height: 1.60972in

.. image:: vertopal_6e277aed43794de08da7229da055806a/media/image520.png
   :width: 6.02222in
   :height: 5.9375in

Affichage :

.. image:: vertopal_6e277aed43794de08da7229da055806a/media/image521.png
   :width: 4.77083in
   :height: 4.19722in

**5.8.5- Copie écran de la dernière version**

Version 2.1.0 réécrite en DzVent avec :

   - 1 script pour le timer

   - 1 script pour les notifications à partir des dispositifs

   - 1 script ppour les notifications à partir des variables

   - Le script principal de l’alarme

.. image:: vertopal_6e277aed43794de08da7229da055806a/media/image522.png
   :width: 5.67639in
   :height: 5.88472in

**6. – GRAHIQUES & BASE DE DONNEES**

.. image:: vertopal_6e277aed43794de08da7229da055806a/media/image523.png
   :width: 6.26806in
   :height: 6.42778in

Voir ces pages pour installer les scripts :

   -

   -

.. image:: vertopal_6e277aed43794de08da7229da055806a/media/image524.png
   :width: 6.26806in
   :height: 1.80694in

.. image:: vertopal_6e277aed43794de08da7229da055806a/media/image525.png
   :width: 6.26806in
   :height: 2.29028in

   **Prérequis :**

+-----------------------------------+-----------------------------------+
|    | -                            |    Jpgraph est installé avec le   |
|    | -                            |    cache |image21|                |
|    | -                            |                                   |
|    | -                            |    php-gd est installé |image22|  |
|                                   |                                   |
|                                   |    la bibliothèque python fabric  |
|                                   |    est importé                    |
|                                   |                                   |
|                                   |    le module python               |
|                                   |    mysql.connector est importé    |
+===================================+===================================+
+-----------------------------------+-----------------------------------+

| **6.1 Les table SQL** ,
| **Pour le nom des tables concernant les graphiques, NE PAS UTILISER le
  CARACTERE –(moins)**
| Ce caractère est utilisé comme séparateur pour l’indication de
  l’ensemble table-champ pour les graphiques

.. image:: vertopal_6e277aed43794de08da7229da055806a/media/image528.png
   :width: 6.26806in
   :height: 0.54167in

En absence de champ c’est le champ « valeur » qui est utilisé sinon :
Value= « <TABLE>-<CHAMP> »

.. image:: vertopal_6e277aed43794de08da7229da055806a/media/image529.png
   :width: 1.95972in
   :height: 4.40694in

Avec 2 champs ou 3 champs

.. image:: vertopal_6e277aed43794de08da7229da055806a/media/image530.png
   :width: 2.33333in
   :height: 2.50417in

   .. image:: vertopal_6e277aed43794de08da7229da055806a/media/image531.png
      :width: 3.77083in
      :height: 1.97083in

**Création de la table avec phpMyAdmin :**

+-----------------------------------------------------------------------+
|    | CREATE TABLE \`pression_chaudiere\` (                            |
|    | \`num\` int(5) NOT NULL,                                         |
|    | \`date\` timestamp NOT NULL DEFAULT current_timestamp() ON       |
|      UPDATE current_timestamp(),                                      |
|    | \`valeur\` varchar(4) NOT NULL                                   |
|    | ) ENGINE=InnoDB DEFAULT CHARSET=utf8;                            |
|    | ALTER TABLE \`pression_chaudiere\` CHANGE \`num\` \`num\` INT(4) |
|      NOT NULL AUTO_INCREMENT, add PRIMARY KEY (`num`);                |
+=======================================================================+
+-----------------------------------------------------------------------+

**6.2 Dans Domoticz,**

Les données à enregistrer peuvent provenir de capteurs réels ou
virtuels. Pour éviter un trop grand nombre de valeurs, il est utile pour
certains dispositifs, de créer des variables pour comparer les valeurs
et les limiter aux valeurs entières (c’est le cas de la météo Darsky,
des capteurs de température Onoff).

Pour utiliser des données de la base SQL, il faut au préalable les avoir
enregistrées depuis Domoticz : c’est le rôle de la bibliothèque fabric

.. image:: vertopal_6e277aed43794de08da7229da055806a/media/image532.png
   :width: 6.19861in
   :height: 1.23889in

Une fois crée un premier enregistrement pour une température dans la
base, il suffira pour un nouvel enregistrement d’une autre t° d’ajouter
dans le script LUA « évènement /export_sql » cette T°

.. image:: vertopal_6e277aed43794de08da7229da055806a/media/image533.png
   :width: 6.26806in
   :height: 6.12917in

.. image:: vertopal_6e277aed43794de08da7229da055806a/media/image534.png
   :width: 6.26806in
   :height: 6.00278in

Pour limiter le nb d’enregistrements :

.. image:: vertopal_6e277aed43794de08da7229da055806a/media/image535.png
   :width: 5.93889in
   :height: 2.74028in

Dans cet exemple, il a été créer 3 variables qui permettent des
enregistrements dans la BD à chaque changement de valeurs limité au
degré.:

.. image:: vertopal_6e277aed43794de08da7229da055806a/media/image536.png
   :width: 4.98056in
   :height: 0.73889in

**Le script fabric.sh,** installé ici dans le répertoire « scripts » de
Domoticz

.. image:: vertopal_6e277aed43794de08da7229da055806a/media/image537.png
   :width: 2.66805in
   :height: 1.82361in

+-----------------------------------------------------------------------+
|    #!/bin/bash                                                        |
|                                                                       |
|    | echo $1                                                          |
|    | echo $2                                                          |
|    | a="#"                                                            |
|    | c=$1$a$2                                                         |
|                                                                       |
|    | echo $c                                                          |
|    | cd /home/michel/python                                           |
|    | fab maintask --don=$c > /home/michel/fab.log 2>&1                |
+=======================================================================+
+-----------------------------------------------------------------------+

Pour tester le script, il est plus facile de travailler dans le
répertoire USER, c’est l’objet de la création du lien symbolique vers le
dossier python de Domoticz

.. image:: vertopal_6e277aed43794de08da7229da055806a/media/image538.png
   :width: 6.26111in
   :height: 0.46944in

.. image:: vertopal_6e277aed43794de08da7229da055806a/media/image539.png
   :width: 5.70972in
   :height: 2.52083in

**Le script fabfile.py**

.. image:: vertopal_6e277aed43794de08da7229da055806a/media/image540.png
   :width: 3.18889in
   :height: 2.15694in

+-----------------------------------------------------------------------+
|    | #!/usr/bin/env python2.7                                         |
|    | # -*- coding: utf-8 -*-                                          |
|    | from fabric import Connection                                    |
|    | from fabric.tasks import task                                    |
|                                                                       |
|    | @task                                                            |
|    | def subtask(ctx, donn):                                          |
|    | with ctx.cd("/www/monitor/python"): ctx.run(donn)                |
|                                                                       |
|    | @task( optional = ['don'])                                       |
|    | def maintask(ctx, don = None ):                                  |
|    | con = Connection(host = '192.168.1.7', user = 'michel',          |
|      connect_kwargs = {'password':'PASS'})                            |
|    | file = "python3 sqlite_mysql.py "                                |
|    | donn = file+don                                                  |
|                                                                       |
|    print(subtask(con,donn))                                           |
+=======================================================================+
+-----------------------------------------------------------------------+

..

   Le script fabfile.py appelle sur le serveur qui héberge la BD le
   script sqlite_mysql.py; **sqlite_mysql.py n’est exécuté que lorsqu’il
   est appelé, il n’écoute pas en permanence si des données sont
   envoyées**

   .. image:: vertopal_6e277aed43794de08da7229da055806a/media/image541.png
      :width: 5.65694in
      :height: 3.32222in

   POUR RESUMER : sur le serveur de Domoticz

+-----------------------------------------------------------------------+
|    -script LUA→MENU Domoticz évènements                               |
+=======================================================================+
+-----------------------------------------------------------------------+

+-----------------------------------------------------------------------+
|    -script fabric.sh→ ../domoticz/scripts/                            |
+=======================================================================+
+-----------------------------------------------------------------------+

+-----------------------------------------------------------------------+
|    -script fabfile.py→../domoticz/scripts/python/ avec ls             |
|    /home/USER/python/                                                 |
+=======================================================================+
+-----------------------------------------------------------------------+

+-----------------------------------------------------------------------+
|    - fab.log→ /home/USER                                              |
+=======================================================================+
+-----------------------------------------------------------------------+

..

   | **6.3 Sur le serveur de la base de données,**
   | Le serveur Nginx avec aussi Monitor, réception des datas **Le
     script python sqlite_mysql.py** :

+-----------------------------------------------------------------------+
|    | #!/usr/bin/env python3                                           |
|    | # -*- coding: utf-8 -*-                                          |
|    | import sys                                                       |
|    | import mysql.connector                                           |
|    | from mysql.connector import Error                                |
|    | total_arg = len(sys.argv)                                        |
|    | if (total_arg>0) :                                               |
|    | x= str(sys.argv[1])                                              |
|    | temp = x.split('#')                                              |
+=======================================================================+
+-----------------------------------------------------------------------+

+-----------------------------------------------------------------------+
|    | table=temp[0]                                                    |
|    | champ=temp[1]                                                    |
|    | val1=temp[2]                                                     |
|    | val=temp[3]+" "+temp[4]                                          |
|    | if (len(temp)==7) :                                              |
|    | champ2=temp[5]                                                   |
|    | val2=temp[6]                                                     |
|    | try:                                                             |
|    | connection = mysql.connector.connect(                            |
|    | host = "127.0.0.1",                                              |
|    | user = "michel",                                                 |
|    | password = xxxxxxxx",                                            |
|    | database = "domoticz")                                           |
|                                                                       |
|    | if connection.is_connected():                                    |
|    | db_Info = connection.get_server_info()                           |
|    | print("Connected to MySQL Server version ", db_Info)             |
|    | cursor = connection.cursor()                                     |
|    | cursor.execute("select database();")                             |
|    | record = cursor.fetchone()                                       |
|    | print("You're connected to database: ", record)                  |
|    | if (len(temp)==7) :                                              |
|    | query = "INSERT INTO "+table+" (date,"+champ+","+champ2+")       |
|      VALUES(%> values = (val, val1, val2)                             |
|    | else :                                                           |
|    | query = "INSERT INTO "+table+" (date,"+champ+") VALUES(%s, %s)"  |
|      values = (val, val1)                                             |
|    | cursor.execute(query, values)                                    |
|                                                                       |
|    | connection.commit()                                              |
|    | print(cursor.rowcount, "Record inserted successfully into Laptop |
|      table")                                                          |
|                                                                       |
|    | except Error as e:                                               |
|    | print("Error while connecting to MySQL", e) finally:             |
|    | if (connection.is_connected()):                                  |
|    | cursor.close()                                                   |
+=======================================================================+
+-----------------------------------------------------------------------+

.. image:: vertopal_6e277aed43794de08da7229da055806a/media/image542.png
   :width: 6.26806in
   :height: 7.46528in

**6.4 Dans Monitor :**

Le cache pour jpgraph est présent :

.. image:: vertopal_6e277aed43794de08da7229da055806a/media/image543.png
   :width: 2.13611in
   :height: 2.02083in

Jpgraph est installé à la racine de monitor

.. image:: vertopal_6e277aed43794de08da7229da055806a/media/image544.png
   :width: 2.24028in
   :height: 2.20833in

**6.4.1 la page graphique.php**

.. image:: vertopal_6e277aed43794de08da7229da055806a/media/image545.png
   :width: 6.26806in
   :height: 7.61111in

- css

.. image:: vertopal_6e277aed43794de08da7229da055806a/media/image546.png
   :width: 5.44861in
   :height: 1.0625in

**6.4.2 la fonction graph,** dans fonctions.php et appelée par ajax.php
**ajax.php**

.. image:: vertopal_6e277aed43794de08da7229da055806a/media/image547.png
   :width: 4.62639in
   :height: 0.3125in

**fonctions.php**

.. image:: vertopal_6e277aed43794de08da7229da055806a/media/image548.png
   :width: 5.95833in
   :height: 3.19722in

Accès base de données :export_tab_sqli.php et traitement des données par
la BD

.. image:: vertopal_6e277aed43794de08da7229da055806a/media/image549.png
   :width: 6.17778in
   :height: 5.10417in

Suite de graph()

.. image:: vertopal_6e277aed43794de08da7229da055806a/media/image550.png
   :width: 6.26806in
   :height: 9.11111in

Voir la documentation sur jpgraph :

**6.4.3 autres fichiers PHP :**

   | - index_loc.php (en général ne pas modifier), config.php,
     header.php (en général ne pas modifier),
   | Mettre la variable à « true » dans config.php

.. image:: vertopal_6e277aed43794de08da7229da055806a/media/image551.png
   :width: 6.26111in
   :height: 2.00972in

**6.4.4 copies d’écran :**

   .. image:: vertopal_6e277aed43794de08da7229da055806a/media/image552.png
      :width: 4.23889in
      :height: 5.74167in

   .. image:: vertopal_6e277aed43794de08da7229da055806a/media/image553.png
      :width: 4.42639in
      :height: 3.63889in

.. image:: vertopal_6e277aed43794de08da7229da055806a/media/image554.png
   :width: 5.57361in
   :height: 5.02083in

| **7. – MUR de CAMERAS**
| Zoneminder doit être installé
| Pour éviter des problèmes de capacité mémoire, vider le cache
  périodiquement avec CRON : **crontab -e**

.. image:: vertopal_6e277aed43794de08da7229da055806a/media/image555.png
   :width: 3.45972in
   :height: 0.24028in

| Avec nano ou vim :
| **0 12 \* \* \* sync; echo 3 > /proc/sys/vm/drop_caches**

.. image:: vertopal_6e277aed43794de08da7229da055806a/media/image556.png
   :width: 6.30139in
   :height: 3.36389in

Ici la mémoire sera libérée des données cache et tampontous les jours à
12H ; plus d’ infos :

.. image:: vertopal_6e277aed43794de08da7229da055806a/media/image557.png
   :width: 5.58472in
   :height: 7.45972in

**Il est important d’ajouter les caméras dans Zoneminder les unes après
les autres sans en supprimer**

**afin que ces cameras suivent un ordre chronologique (1,2,3,4,5, 6,
……)**

**Voir la page :**

.. image:: vertopal_6e277aed43794de08da7229da055806a/media/image558.png
   :width: 6.26806in
   :height: 1.66667in

**7.1- les pages index_loc.php, header.php, entete_html.php**
Index_loc.php : en général, ne pas modifier

.. image:: vertopal_6e277aed43794de08da7229da055806a/media/image559.png
   :width: 5.60556in
   :height: 0.54167in

**config.php**

.. image:: vertopal_6e277aed43794de08da7229da055806a/media/image560.png
   :width: 5.94861in
   :height: 2.125in

**header.php**

.. image:: vertopal_6e277aed43794de08da7229da055806a/media/image561.png
   :width: 5.93889in
   :height: 2.30139in

**entete_html.php :** pour le switch

.. image:: vertopal_6e277aed43794de08da7229da055806a/media/image562.png
   :width: 6.26806in
   :height: 0.80139in

**7.2- la page de monitor : mur_cam.php**

.. image:: vertopal_6e277aed43794de08da7229da055806a/media/image563.png
   :width: 6.26111in
   :height: 6.3125in

Le script du bouton On/Off , dans footer :

.. image:: vertopal_6e277aed43794de08da7229da055806a/media/image564.png
   :width: 5.44861in
   :height: 0.72917in

.. image:: vertopal_6e277aed43794de08da7229da055806a/media/image565.png
   :width: 6.05278in
   :height: 0.9375in

**mur_cameras.php :**

.. image:: vertopal_6e277aed43794de08da7229da055806a/media/image566.png
   :width: 6.26111in
   :height: 0.99028in

**IMPORTANT** : le fichier include/mur_cameras.php est indépendant du
programme (‘est une image en retour) et de ce fait on ne peut utiliser
les constantes définies dans admin/config.php

On va donc pour remédier à ce problème :

+-----------------------------------+-----------------------------------+
| -                                 |    passer l’url en paramètre      |
|                                   |    ainsi que l’Idx                |
+===================================+===================================+
| -                                 |    utiliser les variables de      |
|                                   |    session pour le login et le    |
|                                   |    mot de passe car ces données   |
|                                   |    sont sensibles                 |
+-----------------------------------+-----------------------------------+

..

   -

.. image:: vertopal_6e277aed43794de08da7229da055806a/media/image567.png
   :width: 6.26111in
   :height: 0.40694in

**Les fichiers sont tous UTF-8 sans BOM et l’url des caméras doit se
trouver dans mur_cam.php**. (ZMURL dans mur_cam.php et non dans
mur_cameras.php)\ **;**

.. image:: vertopal_6e277aed43794de08da7229da055806a/media/image568.png
   :width: 6.26806in
   :height: 0.97639in

**7.3- Les scripts JS pour la vidéo dans footer.php :**

Le Zoom Bootstrap :

.. image:: vertopal_6e277aed43794de08da7229da055806a/media/image569.png
   :width: 6.26806in
   :height: 4.91528in

| Rafraichissement des images ; pour limiter l’utilisation de la bande
  passante, le
| rafraichissement des images n’a lieu que si le bouton est sur ON ; par
  contre même sur OFF le zoom d’une caméra est opérationnel

.. image:: vertopal_6e277aed43794de08da7229da055806a/media/image570.png
   :width: 4.67778in
   :height: 3.725in

.. image:: vertopal_6e277aed43794de08da7229da055806a/media/image571.png
   :width: 5.60556in
   :height: 5.33472in

Les caméras ne sont pas en https, pour éviter les certificats, mais
comme l’accès se fait en local (sur le réseau 192.168.1.x) et enregistre
une image, sur le serveur, chaque 100ms pour recréer une vidéo, l’accès
distant en https est assuré.

.. image:: vertopal_6e277aed43794de08da7229da055806a/media/image572.png
   :width: 5.89722in
   :height: 3.78056in

**7.4- Ajouter une caméra**

.. image:: vertopal_6e277aed43794de08da7229da055806a/media/image573.png
   :width: 5.00139in
   :height: 0.89583in

Il suffit d’indiquer dans /admin/config.php le nb de caméras

**8.- MUR de COMMANDES ON/OFF**

.. image:: vertopal_6e277aed43794de08da7229da055806a/media/image574.png
   :width: 5.50139in
   :height: 7.59306in

Les lampes :

.. image:: vertopal_6e277aed43794de08da7229da055806a/media/image575.png
   :width: 6.26806in
   :height: 5.30139in

**8.1 les fichiers de base :**

Index_loc.php en général ne pas modifier

.. image:: vertopal_6e277aed43794de08da7229da055806a/media/image576.png
   :width: 4.68889in
   :height: 0.5625in

header.php

.. image:: vertopal_6e277aed43794de08da7229da055806a/media/image577.png
   :width: 6.49583in
   :height: 2.47639in

mes_css.css

.. image:: vertopal_6e277aed43794de08da7229da055806a/media/image578.png
   :width: 5.34306in
   :height: 2.18056in

| **8.1.1 écriture automatique du javascript**
| Effectuée par une fonction PHP à partir de la base de données Dans le
  fichier footer.php :

.. image:: vertopal_6e277aed43794de08da7229da055806a/media/image579.png
   :width: 6.26806in
   :height: 0.6875in

Extrait de la page html pour des commandes pour Domoticz et Home
Assistant:

.. image:: vertopal_6e277aed43794de08da7229da055806a/media/image580.png
   :width: 6.30139in
   :height: 2.43056in

Le PHP :

.. image:: vertopal_6e277aed43794de08da7229da055806a/media/image581.png
   :width: 6.30139in
   :height: 6.40278in

**8.2- mur_inter.php**

.. image:: vertopal_6e277aed43794de08da7229da055806a/media/image582.png
   :width: 6.26806in
   :height: 3.19028in

| **8.2.1 Exemple pour éclairage jardin :**
| L’interrupeur mécanique de l’éclairage extérieur de l’entrée commande
  également en zigbee l’éclairage du jardin :

.. image:: vertopal_6e277aed43794de08da7229da055806a/media/image583.png
   :width: 3.76389in
   :height: 1.23194in

.. image:: vertopal_6e277aed43794de08da7229da055806a/media/image584.png
   :width: 3.84028in
   :height: 1.57639in

**Domoticz**

.. image:: vertopal_6e277aed43794de08da7229da055806a/media/image585.png
   :width: 6.37917in
   :height: 0.42361in

**Les capteurs virtuels sont mis à jour par MQTT et node-red depuis
zigbee2mqtt** Les script node-red : envoi vers domoticz/in

.. image:: vertopal_6e277aed43794de08da7229da055806a/media/image586.png
   :width: 3.80278in
   :height: 8.82083in

La réponse de Domoticz

.. image:: vertopal_6e277aed43794de08da7229da055806a/media/image587.png
   :width: 4.14444in
   :height: 2.225in

| **REMARQUE : ce script automatique de Domoticz ne suffit pas en cas de
  commande de l’interrupteur car le délai de réponse peut atteindre plus
  de 10 s, il faut donc envoyer un message MQTT à partir de
  l’interrupteur virtuel**
| Le script python lancé par la « lampe_ext_entree » :
| Ce script publie un message MQTT vers zigbee2mqtt pour allumer
  l’éclairage du jardin si l’interrupteur « lampe_ext_entree » est
  actionné

.. image:: vertopal_6e277aed43794de08da7229da055806a/media/image588.png
   :width: 6.5in
   :height: 2.30139in

…./domoticz/scripts/python/mqtt.py zigbee2mqtt/eclairage_ext/set
state_l2 ON …./domoticz/scripts/python/mqtt.py
zigbee2mqtt/eclairage_ext/set state_l2 OFF

+-----------------------------------------------------------------------+
|    | #!/usr/bin/env python3.7                                         |
|    | # -*- coding: utf-8 -*-                                          |
|                                                                       |
|    | import paho.mqtt.client as mqtt                                  |
|    | import json                                                      |
|    | import sys                                                       |
|    | # Variables et Arguments                                         |
|    | topic= str(sys.argv[1])                                          |
|    | etat= str(sys.argv[2])                                           |
|    | valeur= str(sys.argv[3])                                         |
|    | MQTT_HOST = "192.168.1.42"                                       |
+=======================================================================+
+-----------------------------------------------------------------------+

+-----------------------------------------------------------------------+
|    | MQTT_PORT = 1883                                                 |
|    | MQTT_KEEPALIVE_INTERVAL = 45                                     |
|    | MQTT_TOPIC = topic                                               |
|                                                                       |
|    | MQTT_MSG=json.dumps({etat: valeur});                             |
|    | #                                                                |
|    | def on_publish(client, userdata, mid):                           |
|    | print ("Message Publié...")                                      |
|                                                                       |
|    | def on_connect(client, userdata, flags, rc):                     |
|    | client.subscribe(MQTT_TOPIC)                                     |
|    | client.publish(MQTT_TOPIC, MQTT_MSG)                             |
|                                                                       |
|    | def on_message(client, userdata, msg):                           |
|    | print(msg.topic)                                                 |
|    | print(msg.payload)                                               |
|    | payload = json.loads(msg.payload) # convertion en json           |
|      print(payload['state_l2'])                                       |
|    | client.disconnect()                                              |
|                                                                       |
|    | # Initiatlisation MQTT Client                                    |
|    | mqttc = mqtt.Client()                                            |
|                                                                       |
|    | # callback funRction                                             |
|    | mqttc.on_publish = on_publish                                    |
|    | mqttc.on_connect = on_connect                                    |
|    | mqttc.on_message = on_message                                    |
|                                                                       |
|    | # Connection avec le serveur MQTT                                |
|    | mqttc.connect(MQTT_HOST, MQTT_PORT, MQTT_KEEPALIVE_INTERVAL)     |
|                                                                       |
|    | # Loop forever                                                   |
|    | mqttc.loop_forever()                                             |
+=======================================================================+
+-----------------------------------------------------------------------+

https://www.eclipse.org/paho/index.php?page=clients/python/docs/index.php

Pour éviter des erreurs (512, 256), penser à convertir le fichier python
en Unix s’il a été créé

avec **Notepad++**

.. image:: vertopal_6e277aed43794de08da7229da055806a/media/image589.png
   :width: 6.26806in
   :height: 3.16805in

Pour convertir le fichier en Unix : dos2unix CHEMIN/NOM DU FICHIER
Attention aussi aux autorisations

.. image:: vertopal_6e277aed43794de08da7229da055806a/media/image590.png
   :width: 3.26111in
   :height: 2.68611in

.. image:: vertopal_6e277aed43794de08da7229da055806a/media/image591.png
   :width: 4.65in
   :height: 6.79306in

Le plan : l’interrupteur est ajouté

.. image:: vertopal_6e277aed43794de08da7229da055806a/media/image592.png
   :width: 5.32361in
   :height: 4.47917in

| **exterieur.php**
| **css pour svg**

.. image:: vertopal_6e277aed43794de08da7229da055806a/media/image593.png
   :width: 5.08472in
   :height: 0.60417in

.. image:: vertopal_6e277aed43794de08da7229da055806a/media/image594.png
   :width: 5.80278in
   :height: 1.25139in

Les lampes concernées en gris

.. image:: vertopal_6e277aed43794de08da7229da055806a/media/image595.png
   :width: 5.47778in
   :height: 4.83611in

.. image:: vertopal_6e277aed43794de08da7229da055806a/media/image596.png
   :width: 4.81111in
   :height: 3.36111in

**La BD**

un idm est nécessaire pour le tableau json en retour de la fonction «
device_plan ». Pour afficher les propriétés de l’appareil

.. image:: vertopal_6e277aed43794de08da7229da055806a/media/image597.png
   :width: 6.26806in
   :height: 6.08611in

**footer.php : pour la mise à jour de tous les dispositifs, mais avec un
temps de réponse,**

**aussi pour la commande des interrupteurs un second script permet une
mise à jour**

**instantanée**

.. image:: vertopal_6e277aed43794de08da7229da055806a/media/image598.png
   :width: 6.26806in
   :height: 5.28472in

.. image:: vertopal_6e277aed43794de08da7229da055806a/media/image599.png
   :width: 6.30139in
   :height: 3.07222in

| **8.2.2 Exemple pour arrosage jardin :**
| Relais Sonoff wifi ip 192.168.1.146 :8081

DOMOTICZ :Capteur virtuel :

.. image:: vertopal_6e277aed43794de08da7229da055806a/media/image600.png
   :width: 6.5in
   :height: 0.42361in

.. image:: vertopal_6e277aed43794de08da7229da055806a/media/image601.png
   :width: 5.23056in
   :height: 3.09306in

.. image:: vertopal_6e277aed43794de08da7229da055806a/media/image602.png
   :width: 4.81111in
   :height: 4.19861in

Le script python :

.. image:: vertopal_6e277aed43794de08da7229da055806a/media/image603.png
   :width: 5.62639in
   :height: 2.49028in

.. image:: vertopal_6e277aed43794de08da7229da055806a/media/image604.png
   :width: 5.71944in
   :height: 1.60417in

**Mur_inter.php**

.. image:: vertopal_6e277aed43794de08da7229da055806a/media/image605.png
   :width: 6.26806in
   :height: 2.90417in

Base de données :

.. image:: vertopal_6e277aed43794de08da7229da055806a/media/image606.png
   :width: 6.49583in
   :height: 0.65833in

.. image:: vertopal_6e277aed43794de08da7229da055806a/media/image607.png
   :width: 2.78472in
   :height: 1.50417in

**8.2.3 - Exemple éclairage simple, une lampe de salon** :

*Dans Domoticz :*

.. image:: vertopal_6e277aed43794de08da7229da055806a/media/image608.png
   :width: 4.25972in
   :height: 1.41111in

On ajoute le matériel au plan qui regroupe tous les matériels

.. image:: vertopal_6e277aed43794de08da7229da055806a/media/image609.png
   :width: 5.70417in
   :height: 4.82222in

On le place sur le plan :

.. image:: vertopal_6e277aed43794de08da7229da055806a/media/image610.png
   :width: 5.1625in
   :height: 7.0625in

.. image:: vertopal_6e277aed43794de08da7229da055806a/media/image611.png
   :width: 2.80278in
   :height: 2.40139in

*Dans monitor :*

mur_inter.php

.. image:: vertopal_6e277aed43794de08da7229da055806a/media/image612.png
   :width: 6.26111in
   :height: 2.19722in

Exemple : Image lampe_bureau.svg

.. image:: vertopal_6e277aed43794de08da7229da055806a/media/image613.png
   :width: 0.85556in
   :height: 0.80278in

Image lampe: |image23|

.. image:: vertopal_6e277aed43794de08da7229da055806a/media/image615.png
   :width: 6.06389in
   :height: 8.10556in

.. image:: vertopal_6e277aed43794de08da7229da055806a/media/image616.png
   :width: 5.35556in
   :height: 6.58333in

La base de données « monitor » (aussi appelée domoticz), table
dispositifs

.. image:: vertopal_6e277aed43794de08da7229da055806a/media/image617.png
   :width: 6.26111in
   :height: 6.20833in

Résultat :

.. image:: vertopal_6e277aed43794de08da7229da055806a/media/image618.png
   :width: 2.82361in
   :height: 1.65694in

**8.2.4 - Exemple volet roulant** :

   .. image:: vertopal_6e277aed43794de08da7229da055806a/media/image619.png
      :width: 2.775in
      :height: 1.63611in

.. image:: vertopal_6e277aed43794de08da7229da055806a/media/image620.png
   :width: 4.86528in
   :height: 5.25in

*Le moteur est à 4 fils, piloté par une commande TUYA FT30F et
Zigbee2mqtt.*

**Remarque** : pour éviter que les commandes soient inversées dans
Domoticz, mettre à TRUE le paramètre spécifique concernant cet
interrupteur, dans le fronted de zigbee2mqtt

.. image:: vertopal_6e277aed43794de08da7229da055806a/media/image621.png
   :width: 6.26806in
   :height: 2.41528in

Pour utiliser le Javascript (comme pour le plan) il ne faut pas charger
l’image par son nom mais l’incorporer dans un fichier PHP.

.. image:: vertopal_6e277aed43794de08da7229da055806a/media/image622.png
   :width: 6.26806in
   :height: 1.26806in

L’image svg :

.. image:: vertopal_6e277aed43794de08da7229da055806a/media/image623.png
   :width: 6.30139in
   :height: 2.50139in

Cette image a déjà été ajoutée au plan avec cette CLASS les ID étant
uniques ;

ID « volet_bureau » (1er <rect ) pour indiquer le % d’ouverture

ID « volet_bureau1 » (2eme <rect ) pour pouvoir cliquer n’importe où sur
l’image.

**8.2.4 .1 Affichage sur le plan :**

Le plan :

.. image:: vertopal_6e277aed43794de08da7229da055806a/media/image624.png
   :width: 5.84444in
   :height: 2.51111in

Pour un clic qui fonctionne sans problème, on peut ajouter un rectangle
:

.. image:: vertopal_6e277aed43794de08da7229da055806a/media/image625.png
   :width: 5.44861in
   :height: 0.80278in

.. image:: vertopal_6e277aed43794de08da7229da055806a/media/image626.png
   :width: 4.56389in
   :height: 3.96944in

Ci-dessous le dispositif concerné dans Domoticz

.. image:: vertopal_6e277aed43794de08da7229da055806a/media/image627.png
   :width: 4.14722in
   :height: 3.05139in

Enregistrer dans la base SQL le dispositif avec l’ID pour le mur de
commande et une CLASS pour le plan (permet de visualiser, comme pour les
lampes l’ouverture ou la fermeture des volets :

Dans la BD

.. image:: vertopal_6e277aed43794de08da7229da055806a/media/image628.png
   :width: 6.26806in
   :height: 0.4in

Dans le plan on indique simplement si les volets sont fermés ou ouverts
(même partiellement :

.. image:: vertopal_6e277aed43794de08da7229da055806a/media/image629.png
   :width: 2.18889in
   :height: 1.63611in

Le fichier footer.php, la fonction maj_devices_plan () modifiée :

.. image:: vertopal_6e277aed43794de08da7229da055806a/media/image630.png
   :width: 6.26806in
   :height: 5.53611in

L’ouverture est Open ou les 12 premiers caractères sont « Set Level : »
La fermeture est Closed

.. image:: vertopal_6e277aed43794de08da7229da055806a/media/image631.png
   :width: 2.49028in
   :height: 1.47917in

| **8.2.4 .2 Dans le mur ON/OFF:**
| **Pour afficher le % d’ouverture :**
| Pour indiquer le % d’ouverture on ajoute un rectangle dans l’image, la
  hauteur sera fonction du % d’ouverture ; pour cela il faut indiquer
  dans l’image la hauteur de référence ; sinon un pourcentage
  s’appliquera à la hauteur déjà modifiée qui diminuera au fil des mises
  à jour

Height de l’image sera suivant le % d’ouverture sera modifiée dans le
Dom, c’est pourquoi on crée un attribut h qui est le reflet du height
d’origine

.. image:: vertopal_6e277aed43794de08da7229da055806a/media/image632.png
   :width: 6.30139in
   :height: 2.725in

Le volume d’ouverture est indiqué dans Data : Set Level : VALEUR en %

.. image:: vertopal_6e277aed43794de08da7229da055806a/media/image633.png
   :width: 3.84167in
   :height: 4.11528in

On applique ce pourcentage au rectangle de l’mage :

Dans footer.php :

*On récupère la valeur h de l’image*

| var h=document.getElementById(val.ID1).getAttribute("h");
| *On attribue à l’image la bonne hauteur qui tient compte du %
  d’ouverture*
| document.getElementById(val.ID1).setAttribute("height",parseInt((h*pourcent[2])/100));
  Ou suivant que les 100% soit pour l’ouverture ou la fermeture :
| document.getElementById(val.ID1).setAttribute("height",parseInt((h*(100-
| pourcent[2]))/100));
| Résultat :

.. image:: vertopal_6e277aed43794de08da7229da055806a/media/image634.png
   :width: 1.99028in
   :height: 1.63611in

La fonction complète maj_devices(plan) dans footer.php

.. image:: vertopal_6e277aed43794de08da7229da055806a/media/image635.png
   :width: 6.26806in
   :height: 3.90417in

| **Pour commander le volet :**
| Le rectangle indiquant le % d’ouverture peut être très petit, aussi
  pour pouvoir cliquer n’importe où sur l’image, il suffit d’ajouter un
  rectangle incolore comme déjà indiqué dans ce paragraphe :

.. image:: vertopal_6e277aed43794de08da7229da055806a/media/image636.png
   :width: 6.30139in
   :height: 1.05694in

On ajoute l’id de ce rectangle dans la base de données :

.. image:: vertopal_6e277aed43794de08da7229da055806a/media/image637.png
   :width: 6.26806in
   :height: 0.3375in

Comme pour les commandes onoff , les scripts des commandes onoff+stop
sont écrits automatiquement par la fonction **function sql_plan($t) ;**

.. image:: vertopal_6e277aed43794de08da7229da055806a/media/image638.png
   :width: 6.30139in
   :height: 1.04167in

Mais pour les volets, pour les commandes avec « level » un simple
interrupteur ne peut suffire, aussi le script écrit automatiquement est
fait afin d’ouvrir une fenêtre pour des données complémentaires

Le wiki de Domoticz concernant ces commandes :

.. image:: vertopal_6e277aed43794de08da7229da055806a/media/image639.png
   :width: 6.30139in
   :height: 1.73611in

**La fonction PHP :**

.. image:: vertopal_6e277aed43794de08da7229da055806a/media/image640.png
   :width: 6.26806in
   :height: 2.83333in

La fenêtre complémentaire :

.. image:: vertopal_6e277aed43794de08da7229da055806a/media/image641.png
   :width: 4.40694in
   :height: 4.78194in

.. image:: vertopal_6e277aed43794de08da7229da055806a/media/image642.png
   :width: 5.55278in
   :height: 2.36528in

| C’est cette fenêtre qui va envoyer les commandes d’ouverture,
  fermeture **8.2.4.3 le script JS**
| **8.2.4.3.1 avec Ajax et PHP, dans footer.php**

   .. image:: vertopal_6e277aed43794de08da7229da055806a/media/image643.png
      :width: 6.3in
      :height: 1.17222in

   Ci-dessus, on récupère idx idm et la commande

   .. image:: vertopal_6e277aed43794de08da7229da055806a/media/image644.png
      :width: 6.3in
      :height: 3.20278in

   Mise à jour instantanée :

   .. image:: vertopal_6e277aed43794de08da7229da055806a/media/image645.png
      :width: 5.45833in
      :height: 2.33333in

   | **8.2.4.3.2 avec MQTT**
   | *C’est une autre solution qui peut s’appliquer pour tout
     dispositifs non gérer par le programme. Il faut installer la
     bibliothèque ci-dessous paho-mqtt*
   | https://www.eclipse.org/paho/index.php?page=clients/js/index.php

.. image:: vertopal_6e277aed43794de08da7229da055806a/media/image646.png
   :width: 6.30139in
   :height: 2.54722in

   .. image:: vertopal_6e277aed43794de08da7229da055806a/media/image647.png
      :width: 6.3in
      :height: 4.74306in

   *Ce fichier est chargé automatiquement si MQTT est à true*

   .. image:: vertopal_6e277aed43794de08da7229da055806a/media/image648.png
      :width: 6.3in
      :height: 1.55in

   *Dans config :*

   .. image:: vertopal_6e277aed43794de08da7229da055806a/media/image649.png
      :width: 5.46944in
      :height: 0.90555in

   *Le mème commande par MQTT*

   .. image:: vertopal_6e277aed43794de08da7229da055806a/media/image650.png
      :width: 6.3in
      :height: 3.37639in

   .. image:: vertopal_6e277aed43794de08da7229da055806a/media/image651.png
      :width: 6.21944in
      :height: 2.96806in

   | Pour le volet :
   | Value= {idx : 177, switchcmd : ‘’ Set Level’’ , level : ‘’ On ‘’}
     Les données en json :

+-----------------------------------------------------------------------+
|    var result = JSON.stringify(value);                                |
+=======================================================================+
+-----------------------------------------------------------------------+

..

   **La commande :**

   .. image:: vertopal_6e277aed43794de08da7229da055806a/media/image652.png
      :width: 5.44861in
      :height: 1.20833in

| **9. – Dispositifs Zigbee**
| **Avec zigbee2mqtt**

.. image:: vertopal_6e277aed43794de08da7229da055806a/media/image653.png
   :width: 5.58472in
   :height: 7.58472in

Affichage du Frontend de Zigbee2mqtt

Voir la page du site consacrée à frontend : **la page zigbee.php**

.. image:: vertopal_6e277aed43794de08da7229da055806a/media/image654.png
   :width: 6.26806in
   :height: 3.70139in

   Le fichier admin/config.php :

   .. image:: vertopal_6e277aed43794de08da7229da055806a/media/image655.png
      :width: 6.325in
      :height: 1.9375in

   Le fichier index_loc.php : pour info, ne pas modifier

   .. image:: vertopal_6e277aed43794de08da7229da055806a/media/image656.png
      :width: 6.04583in
      :height: 1.18889in

   .. image:: vertopal_6e277aed43794de08da7229da055806a/media/image657.png
      :width: 6.26806in
      :height: 0.64583in

   **Pour une installation classique node.js**

   Démarrage auto : avec PM2

   Voir page domo-site :

.. image:: vertopal_6e277aed43794de08da7229da055806a/media/image658.png
   :width: 6.26806in
   :height: 1.6375in

.. image:: vertopal_6e277aed43794de08da7229da055806a/media/image659.png
   :width: 6.5in
   :height: 1.05556in

   **Pour une installation sous Docker, le démarrage sera automatique.**

| **9.1 accès distant :**
| Il faut configurer NGINX :

Exemple de fichier .conf avant de demander un certificat cerbot :

.. image:: vertopal_6e277aed43794de08da7229da055806a/media/image660.png
   :width: 6.01111in
   :height: 4.40694in

Demande de certificat :

   .. image:: vertopal_6e277aed43794de08da7229da055806a/media/image661.png
      :width: 4.76111in
      :height: 0.22917in

Le fichier modifié par cerbot lors de la demande de certificat

.. image:: vertopal_6e277aed43794de08da7229da055806a/media/image662.png
   :width: 6.26111in
   :height: 6.6875in

   **10. – Dispositifs Zwave**

   **Avec zwavejs2mqtt,** installé sous docker donc redémarrage
   automatique

   .. image:: vertopal_6e277aed43794de08da7229da055806a/media/image663.png
      :width: 5.75139in
      :height: 6.95833in

   **La page zwave.php**

   La structure est la même que pour la *page zigbee.php*, voir cette
   page pour plus

d’info

   .. image:: vertopal_6e277aed43794de08da7229da055806a/media/image664.png
      :width: 6.26806in
      :height: 2.47639in

   Le fichier admin/config.php :

   .. image:: vertopal_6e277aed43794de08da7229da055806a/media/image665.png
      :width: 5.52222in
      :height: 0.85417in

   Le fichier index_loc.php : pour info, ne pas modifier

.. image:: vertopal_6e277aed43794de08da7229da055806a/media/image666.png
   :width: 6.26806in
   :height: 0.31528in

   Les styles :

   .. image:: vertopal_6e277aed43794de08da7229da055806a/media/image667.png
      :width: 5.55278in
      :height: 0.85417in

   | **10.1 Accès distant**
   | Il faut configurer NGINX pour un accès https, voir le *paragraphe
     9.1* Exemple de fichier de configuration dans :/etc/nginx/conf.d

+-----------------------------------------------------------------------+
|    | server {                                                         |
|    | server_name zwave.DOMAINE.ovh;                                   |
|                                                                       |
|    | location / {                                                     |
|    | proxy_pass http://192.168.1.76:8091/;                            |
|    | proxy_set_header Host $host;                                     |
|    | proxy_set_header X-Real-IP $remote_addr;                         |
|    | proxy_set_header X-Forwarded-For $proxy_add_x_forwarded_for; }   |
|                                                                       |
|    | location /api {                                                  |
|    | proxy_pass http://192.168.1.76:8091/api;                         |
|    | proxy_set_header Host $host;                                     |
|                                                                       |
|    | proxy_http_version 1.1;                                          |
|    | proxy_set_header Upgrade $http_upgrade;                          |
+=======================================================================+
+-----------------------------------------------------------------------+

+-----------------------------------------------------------------------+
|    | proxy_set_header Connection "upgrade";                           |
|    | }                                                                |
|    | server_name zwave.DOMAINE.ovh;                                   |
|                                                                       |
|    | auth_basic "Mot de Passe Obligatoire";                           |
|    | auth_basic_user_file /etc/nginx/.htpasswd;                       |
|                                                                       |
|    | listen 443 ssl; # managed by Certbot                             |
|    | ssl_certificate                                                  |
|      /etc/letsencrypt/live/zwave.DOMAINE.ovh/fullchain.pem;$          |
|      ssl_certificate_key                                              |
|      /etc/letsencrypt/live/zwave.DOMAINE.ovh/privkey.pe$ include      |
|      /etc/letsencrypt/options-ssl-nginx.conf; # managed by Certbot    |
|      ssl_dhparam /etc/letsencrypt/ssl-dhparams.pem; # managed by      |
|      Certbot                                                          |
|                                                                       |
|    | }                                                                |
|    | server {                                                         |
|    | if ($host = zwave.DOMAINE.ovh) {                                 |
|    | return 301 https://$host$request_uri;                            |
|    | } # managed by Certbot                                           |
|                                                                       |
|    server_name zwave.DOMAINE.ovh;                                     |
|                                                                       |
|    | listen 80;                                                       |
|    | server_name zwaveDOMAINE.ovh;                                    |
|    | return 404; # managed by Certbot                                 |
|                                                                       |
|    }                                                                  |
+=======================================================================+
+-----------------------------------------------------------------------+

..

   **11.- MONITORING Nagios**

   | Avec Nagios ou Nagios mobile sur monitor,
   | L’app Nagios PC est installée sur un Raspberry 4 8Go, celui qui
     gère également les sauvegardes et la com GSM

   .. image:: vertopal_6e277aed43794de08da7229da055806a/media/image668.png
      :width: 5.375in
      :height: 7.24167in

.. image:: vertopal_6e277aed43794de08da7229da055806a/media/image669.png
   :width: 5.59444in
   :height: 7.56389in

Nagios effectue le monitoring des VM Proxmox avec un plugin : voir le
site domo-site.fr

.. image:: vertopal_6e277aed43794de08da7229da055806a/media/image670.png
   :width: 6.26806in
   :height: 1.6625in

La page a la même structure que zigbee2mqtt exceptés les ID (css) et
liens local et distant,

**config.php** :

.. image:: vertopal_6e277aed43794de08da7229da055806a/media/image671.png
   :width: 6.26806in
   :height: 0.76389in

**css** :

.. image:: vertopal_6e277aed43794de08da7229da055806a/media/image672.png
   :width: 5.91111in
   :height: 0.79306in

**Le html :**

Index_loc.php

.. image:: vertopal_6e277aed43794de08da7229da055806a/media/image673.png
   :width: 6.26806in
   :height: 1.06528in

header.php

.. image:: vertopal_6e277aed43794de08da7229da055806a/media/image674.png
   :width: 6.5in
   :height: 2.73333in

| **nagios.php**
| on ajoute une iframe :

.. image:: vertopal_6e277aed43794de08da7229da055806a/media/image675.png
   :width: 6.19861in
   :height: 3.46944in

| Surveillance par Domoticz du PI : voir scripts *paragraphe 13.4*
| Voir la page consacrée à ce sujet sur

| **11.1 accès distant**
| Il faut configurer Nginx et ensuite demander un certificat
  Letsencrypt,
| Voir paragraphe 9, un exemple de configuration avant de faire une
  demande de certificat ; le fichier.conf sera mis à jour par Cerbot

.. image:: vertopal_6e277aed43794de08da7229da055806a/media/image676.png
   :width: 2.05278in
   :height: 0.375in

.. image:: vertopal_6e277aed43794de08da7229da055806a/media/image677.png
   :width: 6.1875in
   :height: 8.84444in

**11.2 Supprimer l’affichage YouTube**

Dans le fichier , **/usr/local/nagios/share/main.php ,** supprimer les
lignes suivantes

.. image:: vertopal_6e277aed43794de08da7229da055806a/media/image678.png
   :width: 6.26806in
   :height: 6.00278in

   **12. - FICHIERS LOG Domoticz, Nagios, SQL**

   Les scripts pour afficher des données sur d’autres pages peuvent être
   sur ce modèle, avec l’utilisation de modalink pour afficher ces
   données :

.. image:: vertopal_6e277aed43794de08da7229da055806a/media/image679.png
   :width: 6.30139in
   :height: 5.15694in

.. image:: vertopal_6e277aed43794de08da7229da055806a/media/image680.png
   :width: 4.66667in
   :height: 3.975in

Les fichiers header.php ont été modifié , voir les exemples précédents.
Le fichier **app_diverses.php** :

.. image:: vertopal_6e277aed43794de08da7229da055806a/media/image681.png
   :width: 6.04167in
   :height: 3.63611in

.. image:: vertopal_6e277aed43794de08da7229da055806a/media/image682.png
   :width: 5.57361in
   :height: 7.52222in

+-----------------------------------------------------------------------+
|    | <?php                                                            |
|    | session_start();                                                 |
|    | $domaine=$_SESSION["domaine"];                                   |
|    | if ($domaine==URLMONITOR) $lien_img="";                          |
|    | if ($domaine==IPMONITOR) $lien_img="/monitor"; ?>                |
|    | <!-- section App diverses start -->                              |
|    | <!-- ================ -->                                        |
|    | <div id="app_diverses" class="app_div"> <div class="container">  |
+=======================================================================+
+-----------------------------------------------------------------------+

+-----------------------------------------------------------------------+
|    | <div class="col-md-12">                                          |
|    | <h1 class="title_ext text-center">App<span>                      |
|      diverses</span></h1><br> <img src="<?php echo                    |
|      $lien_img;?>/images/dz.png"                                      |
|    | style="width:50px;height:auto;margin:10px 0 10px 120px"          |
|      alt="dz">                                                        |
|    | <form2>                                                          |
|    | <p class="txt_app"><input type="button" rel="1"                  |
|      style="margin-left: 60px;" class="btn_appd" value="afficher      |
|      fichier log normal"></p>                                         |
|    | <p class="txt_app"><input type="button" rel="2"                  |
|      style="margin-left: 60px;" class="btn_appd" value="afficher      |
|      fichier log statut"></p>                                         |
|    | <p class="txt_app"><input type="button" rel="4"                  |
|      style="margin-left: 60px;" class="btn_appd" value="afficher      |
|      fichier log erreur"></p>                                         |
|    | <img src="<?php echo $lien_img;?>/images/nagios.png"             |
|    | style="width:100px;height:auto;margin:10px 0 10px 100px"         |
|      alt="dz">                                                        |
|    | <p class="txt_app"><input type="button" rel="hostlist"           |
|      style="margin-left: 60px;" class="btn_appd" value="afficher      |
|      hosts Nagios"></p>                                               |
|    | </form>                                                          |
|    | </div>                                                           |
|    | </div>                                                           |
|                                                                       |
|    </div>                                                             |
+=======================================================================+
+-----------------------------------------------------------------------+

**footer.php**

.. image:: vertopal_6e277aed43794de08da7229da055806a/media/image683.png
   :width: 5.90694in
   :height: 2.91667in

Fonctions.php , les fonctions log_dz() et app_nagios()

.. image:: vertopal_6e277aed43794de08da7229da055806a/media/image684.png
   :width: 5.78194in
   :height: 2.23333in

.. image:: vertopal_6e277aed43794de08da7229da055806a/media/image685.png
   :width: 5.75833in
   :height: 1.09305in

   .. image:: vertopal_6e277aed43794de08da7229da055806a/media/image686.png
      :width: 4.21806in
      :height: 5.68611in

| **12.1 AJOUT SQL**
| **12.1.1 Edition de l’historique du ramassage des poubelles**

   .. image:: vertopal_6e277aed43794de08da7229da055806a/media/image687.png
      :width: 4.28194in
      :height: 5.42639in

   .. image:: vertopal_6e277aed43794de08da7229da055806a/media/image688.png
      :width: 4.84444in
      :height: 7.23056in

Le fichier **app_diverses.php** :

Une icône est téléchargée ou celle du fichier image (celle-ci-dessus)
est utilisée

.. image:: vertopal_6e277aed43794de08da7229da055806a/media/image689.png
   :width: 6.26806in
   :height: 2.25972in

+-----------------------------------------------------------------------+
|    | <img src="<?php echo $lien_img;?>/images/serveur-sql.svg"        |
|    | style="width:40px;height:auto;margin:0 0 10px 118px" alt="dz">   |
|    | <p class="txt_app"><input type="button" rel="sql1"               |
|      style="margin-left: 60px;" class="btn_appd" value="afficher      |
|      historique poubelles"></p>                                       |
+=======================================================================+
+-----------------------------------------------------------------------+

Le fichier fonctions.php : la fonction déjà vu au §1.6.1

.. image:: vertopal_6e277aed43794de08da7229da055806a/media/image690.png
   :width: 5.94861in
   :height: 3.35417in

   **Dernière modification : le fichier footer.php**

.. image:: vertopal_6e277aed43794de08da7229da055806a/media/image691.png
   :width: 6.26111in
   :height: 2.38611in

Extrait modifié :

+-----------------------------------------------------------------------+
|    | else if                                                          |
|      (logapp=="hostli                                                 |
| st"){urllog="ajax.php?app=infos_nagios&variable="+logapp;titre="Hosts |
|      Nagios";}                                                        |
|    | else if (logapp=="sql"){var table_sql = $(this).attr('title');   |
|    | urllog="ajax.                                                    |
| php?app=sql&idx=1&variable="+table_sql+"&type=&command=";titre="histo |
|      rique poubelles";}                                               |
|    | else {urllog="erreur";}                                          |
+=======================================================================+
+-----------------------------------------------------------------------+

**12.1.2 Ajout d’une icône à l’historique des poubelles** Dans la BD :
on ajoute une colonne pour l’icône : - dans date_poub et dans text_img

.. image:: vertopal_6e277aed43794de08da7229da055806a/media/image692.png
   :width: 5.20972in
   :height: 1.61528in

.. image:: vertopal_6e277aed43794de08da7229da055806a/media/image693.png
   :width: 5.77222in
   :height: 3.29167in

footer.php ;

.. image:: vertopal_6e277aed43794de08da7229da055806a/media/image694.png
   :width: 6.26806in
   :height: 2.19722in

.. image:: vertopal_6e277aed43794de08da7229da055806a/media/image695.png
   :width: 5.31389in
   :height: 2.50972in

| fonctions.php
| pour que maj_services (footer.php) récupère le chemin de l’icône la
  fonction sql_app doit envoyer la donnée

.. image:: vertopal_6e277aed43794de08da7229da055806a/media/image696.png
   :width: 4.63611in
   :height: 6.11944in

Pour la restitution de l’historique :

.. image:: vertopal_6e277aed43794de08da7229da055806a/media/image697.png
   :width: 5.38611in
   :height: 3.49028in

Résultat

.. image:: vertopal_6e277aed43794de08da7229da055806a/media/image698.png
   :width: 4.57361in
   :height: 2.1875in

**13. – APPLICATIONS externes en lien avec Domoticz ou monitor**

| **13.1 Affichage des notifications sur un téléviseur LG** Le script
  optionnel pour la notification sur un téléviseur LG (web os) sudo et
  Node.js doit être installés
| lgtv et superagent doivent être installés

+-----------------------------------+-----------------------------------+
| -                                 |    npm install lgtv               |
+===================================+===================================+
| -                                 |    npm install superagent         |
+-----------------------------------+-----------------------------------+

.. image:: vertopal_6e277aed43794de08da7229da055806a/media/image699.png
   :width: 4.40694in
   :height: 2.8125in

Les variables à ajouter :

.. image:: vertopal_6e277aed43794de08da7229da055806a/media/image700.png
   :width: 5.46806in
   :height: 1.3875in

Le script : notifications_tv.lua à ajouter à Domoticz->Evènements :

.. image:: vertopal_6e277aed43794de08da7229da055806a/media/image701.png
   :width: 1.91806in
   :height: 0.6875in

.. image:: vertopal_6e277aed43794de08da7229da055806a/media/image702.png
   :width: 6.49583in
   :height: 5.90139in

Les valeurs transmises par dz au script dans l’ordre : texte, idx,
vtype, vvalue

.. image:: vertopal_6e277aed43794de08da7229da055806a/media/image703.png
   :width: 6.49583in
   :height: 1.29722in

| Script notification_lg.js à ajouter à Home/user/
| Script node_modules/lgtv/index.js à remplacer
| Voir le dossier
| Essai avec la console :

.. image:: vertopal_6e277aed43794de08da7229da055806a/media/image704.png
   :width: 6.08333in
   :height: 2.4125in

| **13.2 Portier Dahua VTO 2000 et VTO 2022 13.2.1 VTO 2000A**
| Voir les pages

.. image:: vertopal_6e277aed43794de08da7229da055806a/media/image705.png
   :width: 6.26806in
   :height: 1.63194in

Et :

.. image:: vertopal_6e277aed43794de08da7229da055806a/media/image706.png
   :width: 6.26806in
   :height: 2.03056in

Domoticz , on crée une variable « sonnette »

.. image:: vertopal_6e277aed43794de08da7229da055806a/media/image707.png
   :width: 6.5in
   :height: 0.41389in

**Le script LUA :**

.. image:: vertopal_6e277aed43794de08da7229da055806a/media/image708.png
   :width: 5.44861in
   :height: 2.07361in

| pushover_img.sh
| Après passage sous docker modification du script

.. image:: vertopal_6e277aed43794de08da7229da055806a/media/image709.png
   :width: 6.12639in
   :height: 2.75972in

.. image:: vertopal_6e277aed43794de08da7229da055806a/media/image710.png
   :width: 6.26806in
   :height: 2.03472in

**En utilisant connect.lua,** pour éviter une mise à jour si changement
d’IP : connect.lua :

.. image:: vertopal_6e277aed43794de08da7229da055806a/media/image711.png
   :width: 3.00139in
   :height: 1.4375in

Dans DZ :

+-----------------------------------------------------------------------+
|    package.path = package.path..";www/modules_lua/?.lua" require      |
|    'connect'                                                          |
|                                                                       |
|    | commandArray = {}                                                |
|    | if (uservariables['sonnette']=="1") then                         |
|    | -- --envoi image pushover ---------------                        |
|    | os.execute("/bin/bash userdata/scripts/bash/pushover_img.sh      |
|      "..ip_domoticz..">> /home/michel/push.log 2>&1");                |
|    | commandArray['Variable:sonnette'] = '0'                          |
|    | end                                                              |
|    | return commandArray                                              |
+=======================================================================+
+-----------------------------------------------------------------------+

| Et dans pushover_img.sh :
| wget http://$1:8086/camsnapshot.jpg?idx=1 -O
  /opt/domoticz/userdata/camsnapshot.jpg **asterisk**

.. image:: vertopal_6e277aed43794de08da7229da055806a/media/image712.png
   :width: 4.68889in
   :height: 5.78194in

**VTO2000A**

.. image:: vertopal_6e277aed43794de08da7229da055806a/media/image713.png
   :width: 3.01806in
   :height: 3.26944in

.. image:: vertopal_6e277aed43794de08da7229da055806a/media/image714.png
   :width: 6.26806in
   :height: 4.38333in

| **VTO2000A**
| **configTools** →\ **VDPConfig**

   .. image:: vertopal_6e277aed43794de08da7229da055806a/media/image715.png
      :width: 5.36389in
      :height: 3.90278in

   .. image:: vertopal_6e277aed43794de08da7229da055806a/media/image716.png
      :width: 2.91667in
      :height: 2.79028in

   .. image:: vertopal_6e277aed43794de08da7229da055806a/media/image717.png
      :width: 5.16528in
      :height: 2.0875in

   .. image:: vertopal_6e277aed43794de08da7229da055806a/media/image718.png
      :width: 5.24861in
      :height: 1.88472in

   .. image:: vertopal_6e277aed43794de08da7229da055806a/media/image719.png
      :width: 5.69722in
      :height: 4.01944in

   .. image:: vertopal_6e277aed43794de08da7229da055806a/media/image713.png
      :width: 2.84306in
      :height: 3.08194in

   **13.3 -La boite aux lettres,**

+-----------------------------------------------------------------------+
|    **Voir domo-site pour la programmation de l’esp8266 , de dzvent et |
|    Python**                                                           |
+=======================================================================+
+-----------------------------------------------------------------------+

+-----------------------------------------------------------------------+
|    ..                                                                 |
|  image:: vertopal_6e277aed43794de08da7229da055806a/media/image720.png |
|       :width: 4.33333in                                               |
|       :height: 5.75972in                                              |
+=======================================================================+
+-----------------------------------------------------------------------+

+-----------------------------------+-----------------------------------+
|    **Le matériel :**              |                                   |
+===================================+===================================+
|    | -                            |    2 ILS (pour le volet , pour la |
|    | -                            |    porte 1 esp 01 et une alim     |
|                                   |    12V/3,3 Volts                  |
+-----------------------------------+-----------------------------------+

+-----------------------------------------------------------------------+
|    Voir la page consacrée à la réalisation et la programmation de     |
|    l’ESP pour une communication MQTT                                  |
+=======================================================================+
+-----------------------------------------------------------------------+

+-----------------------------------------------------------------------+
|    **Les images svg :**                                               |
+=======================================================================+
+-----------------------------------------------------------------------+

|image24|\ |image25|\ |image26|\ |image27|

+-----------------------+-----------------------+-----------------------+
| lettres               | colis                 | lettre & colis        |
+=======================+=======================+=======================+
+-----------------------+-----------------------+-----------------------+

Le fichier accueil.php :

| Le fichier footer.php, le script pour afficher une demande de
  confirmation de la relève du courrier
| /*---popup boite_lettres-----------------------------------*/
| var bl=0;var modalContainer = document.createElement('div');
| modalContainer.setAttribute('id', 'modal_bl');
| var customBox = document.createElement('div');
| customBox.className = 'custom-box';
| // Affichage boîte de confirmation
| document.getElementById('confirm-box').addEventListener('click',
  function() {
| customBox.innerHTML = '<p>Confirmation de la relève du courrier</p>';
| customBox.innerHTML += '<button style="margin-right: 20px;" id="modal-
| confirm">Confirmer</button>';
| customBox.innerHTML += '<button id="modal-close">Annuler</button>';
| modalShow();
| console.log(bl);
| });
| function modalShow() {
| modalContainer.appendChild(customBox);
| document.body.appendChild(modalContainer);
| document.getElementById('modal-close').addEventListener('click',
  function() {
| modalClose();
| });
| if (document.getElementById('modal-confirm')) {
| document.getElementById('modal-confirm').addEventListener('click',
  function () {
| console.log('Confirmé !');bl=1;
| modalClose(bl);
| });
| } else if (document.getElementById('modal-submit')) {
| document.getElementById('modal-submit').addEventListener('click',
  function () {
| console.log(document.getElementById('modal-prompt').value);
| bl=0;modalClose(bl);
| });
| }
| }
| function modalClose(bl) {
| while (modalContainer.hasChildNodes()) {
| modalContainer.removeChild(modalContainer.firstChild);
| }
| document.body.removeChild(modalContainer);
| console.log(bl);if (bl==1)
  {maj_variable(19,"boite_lettres","0",2);maj_services(0);bl=0;} }
| /*------------------------------------------*/

+-----------------------------------------------------------------------+
| |image28|                                                             |
+=======================================================================+
+-----------------------------------------------------------------------+

..

   Un clique sur la BL fait apparaitre le popup de confirmation

+-----------------------------------------------------------------------+
|    ..                                                                 |
|  image:: vertopal_6e277aed43794de08da7229da055806a/media/image726.png |
|       :width: 4.08055in                                               |
|       :height: 3.86528in                                              |
+=======================================================================+
+-----------------------------------------------------------------------+

..

   Les css :

+-----------------------------------------------------------------------+
|    ..                                                                 |
|  image:: vertopal_6e277aed43794de08da7229da055806a/media/image727.png |
|       :width: 2.94722in                                               |
|       :height: 2.95556in                                              |
+=======================================================================+
+-----------------------------------------------------------------------+

+-----------------------------------------------------------------------+
|    La variable Domoticz                                               |
+=======================================================================+
+-----------------------------------------------------------------------+

.. image:: vertopal_6e277aed43794de08da7229da055806a/media/image728.png
   :width: 6.5in
   :height: 0.41944in

+-----------------------------------+-----------------------------------+
|    Les tables sql :               |                                   |
+===================================+===================================+
| -                                 |    Variables dans la table «      |
|                                   |    dispositifs » :                |
+-----------------------------------+-----------------------------------+

+-----------------------------------+-----------------------------------+
| |image29|                         |                                   |
+===================================+===================================+
| -                                 |    La table « text_image »        |
+-----------------------------------+-----------------------------------+

+-----------------------------------------------------------------------+
| |image30|                                                             |
+=======================================================================+
+-----------------------------------------------------------------------+

..

   Après confirmation de la relève, la confirmation de la maj de la
   variable Domoticz

+-----------------------------------------------------------------------+
|    ..                                                                 |
|  image:: vertopal_6e277aed43794de08da7229da055806a/media/image731.png |
|       :width: 4.12639in                                               |
|       :height: 5.58333in                                              |
+=======================================================================+
+-----------------------------------------------------------------------+

..

   Domoticz envoi par MQTT la confirmation de la mise à zéro de la
   variable boite lettres

+-----------------------------------------------------------------------+
|    Le script dzvents :                                                |
+=======================================================================+
+-----------------------------------------------------------------------+

+-----------------------------------------------------------------------+
|    | -- script notifications_autres                                   |
|    | return {                                                         |
|    | on = {                                                           |
|    | variables = {                                                    |
|    | 'alarme_bat',                                                    |
|    | 'boite_lettres',                                                 |
+=======================================================================+
+-----------------------------------------------------------------------+

+-----------------------------------------------------------------------+
|    | }                                                                |
|    | },                                                               |
|    | execute = function(domoticz, variable)                           |
|    | domoticz.log('Variable ' .. variable.name .. ' was changed',     |
|      domoticz.LOG_INFO) if (domoticz.variables('alarme_bat').changed) |
|      then                                                             |
|    | if (domoticz.variables('alarme_bat').value == "batterie_faible") |
|      then if domoticz.variables('not_alarme_bat').value == "0" then   |
|    | os.execute("curl --insecure 'https://smsapi.free-                |
|    | mobile.fr/sendmsg?user=xxxxxxx&pass=xxxxxxxxxx&msg=pile faible'  |
|      >>                                                               |
|    | /home/michel/OsExecute1.log 2>&1")                               |
|    | domoticz.variables('not_alarme_bat').set('1')                    |
|    | end                                                              |
|    | end                                                              |
|    | end                                                              |
|    | if (domoticz.variables('boite_lettres').changed) then            |
|    | if (domoticz.variables('boite_lettres').value == "0") then       |
|    | print("topic envoyé : esp/in/boite_lettres")                     |
|    | local command = "/home/michel/domoticz/scripts/python/mqtt.py    |
|    | esp/in/boite_lettres valeur 0 >> /home/michel/esp.log 2>&1" ;    |
|    | os.execute(command);                                             |
|    | end                                                              |
|    | end                                                              |
|    | end                                                              |
|    | }                                                                |
+=======================================================================+
+-----------------------------------------------------------------------+

.. image:: vertopal_6e277aed43794de08da7229da055806a/media/image732.png
   :width: 6.5in
   :height: 3.24306in

   **13.4 Surveillance du PI par Domoticz**

+-----------------------------------------------------------------------+
|    ..                                                                 |
|  image:: vertopal_6e277aed43794de08da7229da055806a/media/image733.png |
|       :width: 4.175in                                                 |
|       :height: 4.04028in                                              |
+=======================================================================+
+-----------------------------------------------------------------------+

+-----------------------------------------------------------------------+
|    Voir cette page : *http://domo-site.fr/accueil/dossiers/44*        |
+=======================================================================+
+-----------------------------------------------------------------------+

+-----------------------------------------------------------------------+
|    Les tables SQL text_image et variables_dz :                        |
+=======================================================================+
+-----------------------------------------------------------------------+

+-----------------------------------------------------------------------+
|    ..                                                                 |
|  image:: vertopal_6e277aed43794de08da7229da055806a/media/image734.png |
|       :width: 3.49028in                                               |
|       :height: 0.625in                                                |
+=======================================================================+
+-----------------------------------------------------------------------+

+-----------------------------------------------------------------------+
|    ..                                                                 |
|  image:: vertopal_6e277aed43794de08da7229da055806a/media/image735.png |
|       :width: 4.48055in                                               |
|       :height: 0.6875in                                               |
+=======================================================================+
+-----------------------------------------------------------------------+

+-----------------------------------+-----------------------------------+
|    Ce sont les scripts :          |                                   |
+===================================+===================================+
| -                                 |    js « maj_services » qui gère   |
|                                   |    l’affichage de la page         |
|                                   |    d’accueil                      |
+-----------------------------------+-----------------------------------+

+-----------------------------------+-----------------------------------+
|    -                              |    .. im                          |
|                                   | age:: vertopal_6e277aed43794de08d |
|                                   | a7229da055806a/media/image736.png |
|                                   |       :width: 5.28056in           |
|                                   |       :height: 4.25278in          |
|                                   |                                   |
|                                   |    DZEvent «                      |
|                                   |    notifications_devices » qui à  |
|                                   |    partir de l’info du matériel « |
|                                   |    System                         |
|                                   |                                   |
|                                   |    Alive Checker » modifie le     |
|                                   |    contenu de la variable «       |
|                                   |    pi-alarme »                    |
|                                   |                                   |
|                                   |    .. im                          |
|                                   | age:: vertopal_6e277aed43794de08d |
|                                   | a7229da055806a/media/image737.png |
|                                   |       :width: 6.26667in           |
|                                   |       :height: 1.96389in          |
+===================================+===================================+
+-----------------------------------+-----------------------------------+

+-----------------------------------------------------------------------+
| |image31|                                                             |
+=======================================================================+
+-----------------------------------------------------------------------+

+-----------------------------------+-----------------------------------+
|    .. im                          |                                   |
| age:: vertopal_6e277aed43794de08d |                                   |
| a7229da055806a/media/image739.png |                                   |
|       :width: 5.71944in           |                                   |
|       :height: 2.09305in          |                                   |
+===================================+===================================+
| -                                 | Sur la page « nagios » c’est le   |
|                                   | script JS « maj_devices(plan) »   |
|                                   | qui gère le changement            |
+-----------------------------------+-----------------------------------+

+-----------------------------------------------------------------------+
|    de couleur de l’icône, à partir du dispositif dans Domoticz        |
+=======================================================================+
+-----------------------------------------------------------------------+

+-----------------------------------------------------------------------+
|    ..                                                                 |
|  image:: vertopal_6e277aed43794de08da7229da055806a/media/image740.png |
|       :width: 6.09444in                                               |
|       :height: 4.30972in                                              |
+=======================================================================+
+-----------------------------------------------------------------------+

+-----------------------------------------------------------------------+
|    **13.5- Capteur de pression -chaudière**                           |
+=======================================================================+
+-----------------------------------------------------------------------+

+-----------------------------------------------------------------------+
|    ..                                                                 |
|  image:: vertopal_6e277aed43794de08da7229da055806a/media/image741.png |
|       :width: 1.48889in                                               |
|       :height: 2.13194in                                              |
+=======================================================================+
+-----------------------------------------------------------------------+

+-----------------------------------+-----------------------------------+
|    Réalisé avec un                |                                   |
|    microcontrôleur Wemos D1 :     |                                   |
|    pour la partie réalisation du  |                                   |
|    capteur, voir le site web :    |                                   |
|    domo-site.fr                   |                                   |
+===================================+===================================+
|    | -                            |    | Envoie les données de        |
|    | -                            |      pression sur le serveur MQTT |
|    | -                            |    | Domoticz récupère et traites |
|                                   |      les données                  |
|                                   |    | Monitor affiche en temps     |
|                                   |      réel les données,            |
|                                   |      l’historique des données, un |
|                                   |      graphique ,….                |
+-----------------------------------+-----------------------------------+

+-----------------------------------------------------------------------+
|    ..                                                                 |
|  image:: vertopal_6e277aed43794de08da7229da055806a/media/image742.png |
|       :width: 4.98056in                                               |
|       :height: 6.63611in                                              |
+=======================================================================+
+-----------------------------------------------------------------------+

+-----------------------------------------------------------------------+
|    **13.5.1 l’image SVG :**                                           |
+=======================================================================+
+-----------------------------------------------------------------------+

..

   Elle est ajoutée à interieur.php(ci-dessous) et accueil.php
   (ci-dessus)

+-----------------------------------------------------------------------+
|    ..                                                                 |
|  image:: vertopal_6e277aed43794de08da7229da055806a/media/image743.png |
|       :width: 5.20972in                                               |
|       :height: 2.11528in                                              |
+=======================================================================+
+-----------------------------------------------------------------------+

+-----------------------------------------------------------------------+
|    **Accueil.php :**                                                  |
+=======================================================================+
+-----------------------------------------------------------------------+

+-----------------------------------------------------------------------+
| |image32|                                                             |
+=======================================================================+
+-----------------------------------------------------------------------+

+-----------------------------------------------------------------------+
|    Pour annuler l’alarme, le fichier **footer.php**: la fenêtre       |
|    modale est déjà utilisée pour la boite aux lettres, ajout d’une    |
|    variable « ch » 0 pour la BL et 1 pour la pression                 |
+=======================================================================+
+-----------------------------------------------------------------------+

..

   Une variable doit être créée dans Domoticz, voir le paragraphe
   suivant

+-----------------------------------------------------------------------+
| |image33|                                                             |
+=======================================================================+
+-----------------------------------------------------------------------+

+-----------------------------------------------------------------------+
|    L’image :                                                          |
+=======================================================================+
+-----------------------------------------------------------------------+

+-----------------------------------------------------------------------+
|    | <svg version="1.1" id="svgpression"                              |
|      xmlns="http://www.w3.org/2000/svg"                               |
|    | xmlns:xlink="http://www.w3.org/1999/xlink" x="0px"               |
|    | y="0px" viewBox="0 0 111.7 136.9" style="enable-background:new 0 |
|      0 111.7 136.9;" xml:space="preserve">                            |
|                                                                       |
|    | <g id="chaudiere">                                               |
|    | <path id="path14834" class="st1"                                 |
|      d="M25.1,15.8v-4                                                 |
| .2c2.1,0,3.2,2,5.4,1.8c4-0.4,5.2-5.3,1.4-6.9c-1.1-0.5-2.6-0.4-3.6,0.1 |
|    | c-1.2,0.6-1.8,1.4-3.2,1.4c0-0.9,0.3-2.2-0.4-3c-                  |
| 0.9-1.1-2.7-1-3.3,0.3c-0.4,0.8-0.2,1.9-0.2,2.8c-1.5,0-2.1-0.7-3.2-1.4 |
|    | c-1.1-0.5-2.6-0.6-3.8-0.1c-3.6,1.6-2.4,6.5,1.6,6.9c2.2           |
| ,0.2,3.3-1.8,5.4-1.8v4.5c-1.6,0-3.2,0.3-4.8,0.5c-4,0.5-8.2,1.3-12,2.7 |
|    | c-1.2,0.5-2.6,1-3.6,1.8c-0.6,0.5-0.9,1-                          |
|    | 0.5,1.8c0.                                                       |
| 6,0.9,2,1.5,3.1,1.9c2.1,0.8,4.3,1.5,6.6,1.9c9.5,2.1,19.7,2.5,29.5,2.3 |
|    | c7.5-0.2,15.5-0.8,22.7-2.9c1.9-0.5,3.8-1,5.5-1.9c0.7             |
| -0.3,1.5-0.8,1.9-1.4c0.4-0.6,0.1-1.2-0.4-1.6c-0.9-0.8-2.1-1.3-3.2-1.7 |
|    | c-2.8-1-5.6-1.6-8.5-2.3c-2.1-0.5-4.5-0.9-6.                      |
| 7-1c0.5-1.9,1.6-3.8,3.1-5.1c1.9-1.9,4.2-3.3,7-4c6.2-1.6,13.1,1,16.5,6 |
|    | c1.4,2.1,2,4.4,2,6.9h7.6c0-3.2-0.8-6.4-2.3-9.2c-1.               |
| 1-2.1-2.7-4-4.6-5.6c-7.4-6.2-19-7.1-27.3-2.1c-3.2,1.9-5.8,4.6-7.6,7.7 |
|    | c-0.6,1-1.1,2.2-1.5,3.4c-0.1,0.4-0.1,1.1-0.6,1.3c-0.6,0          |
| .2-1.3,0-1.9-0.1c-1.5-0.1-2.9,0-4.4-0.1C32.7,15.3,28.9,15.8,25.1,15.8 |
+=======================================================================+
+-----------------------------------------------------------------------+

+-----------------------------------------------------------------------+
|                                                                       |
|   | M76.5,21.6c-0.4,0.1-0.7,0.5-0.9,0.8c-0.1,0.4-0.1,0.8-0.1,1.2c0,1- |
|    | 0.4,2.9,0.8,3.5c0.8,0.4,2.2,0.1,3.1,0.1h6.8                      |
|    | c0.9,0,2.2,0.2,3-0.1c1.2-0.6,0.9-2.2,0.9-3.2c0-0.5,0             |
| .1-0.8-0.1-1.3c-0.1-0.4-0.4-0.7-0.8-0.9c-0.9-0.4-2.3-0.1-3.2-0.1h-6.6 |
|    | C78.7,21.5,77.4,21.3,76.5,21.6 M0,27.1v64.6v16.8v4.3c0,0.6-      |
|    | 0.1,1.4,0.3,2c0.9,1.2,2.9,1.8,4.3,2.3c3.6,1.2,7.2,1.9,10.9,2.5   |
|    | c5.5,0.9,11,1.1,16.5,1.2c7.8,0.2,15.6-0.3,23.4-1.4c3.4-          |
| 0.5,6.9-1.3,10.1-2.4c1.3-0.5,3-1.1,4-2.1c0.9-0.9,0.4-2.7,0.4-3.8v-9.9 |
|    | h9.4c0,2.5-0.1,5.1,0.3,7.6c1.1,5.9,5.1,11,10.8,14c1.             |
| 9,1,4.5,2.2,6.8,2.3v-5c0-0.5,0.2-1.5-0.1-1.9c-0.3-0.3-1.1-0.5-1.6-0.6 |
|    | c-1-0.4-1.8-0.9-2.7-1.4c-3.4-2.3-5.5-5.7-5.9-9.5c-0.             |
| 3-2.8,0-5.8,0-8.6V80.8v-52h-7.6v8.6c-1.2-0.2-2.4-0.1-3.6-0.1h-5.8v-10 |
|    | c-2.1,0.8-4.1,1.8-6.3,2.3c-9.4,2.5-19.5,3-29.3,3c-8.             |
| 7,0-17.8-0.5-26.2-2.6c-1.6-0.4-3.3-0.8-4.9-1.5C2.1,28,1.1,27.5,0,27.1 |
|    | M79.3,42.2v53.9C76.3,95.8,73,96,69.9,96V42.2H79.3                |
|      M17,71c1.2-0.1,2.6-0.1,3.8,0.3c5.5,1.4,7.5,7.5,4.2,11.6          |
|    | c-0.6,0.8-1.4,1.5-2.4,1.9c-1,0.5-2.1,0.9-3.2,1c-1.1,             |
| 0.1-2.2,0.1-3.2-0.2c-5.5-1.2-7.8-7.3-4.8-11.4c0.6-0.8,1.5-1.6,2.4-2.1 |
|    | C14.7,71.5,15.8,71.2,17,71                                       |
|      M17.3,74.4c                                                      |
| -0.6,0.1-1.3,0.4-1.8,0.7c-3.1,2.1-1.9,6.7,1.9,7.3c0.5,0.1,1,0.1,1.6,0 |
|    | c0.7-                                                            |
| 0.1,1.4-0.4,1.9-0.8c1.1-0.8,1.8-2,1.8-3.3C22.6,75.9,20,73.9,17.3,74.4 |
|      M17.8,91.1c4.9-0.5,9.1,4,8.7,8.1                                 |
|    | c                                                                |
| -0.4,3.8-3.6,6.5-7.7,6.9c-0.7,0.1-1.5,0-2.2-0.1c-5.5-0.9-8.2-6.5-5.7- |
|    | 10.9C12.3,92.6,14.9,91.3,17.8,91.1 M17.3,94.6                    |
|                                                                       |
|  | c-3.6,0.6-4.8,4.7-2.3,6.9c1.1,1,2.7,1.3,4.3,1c2.9-0.5,4.2-3.7,2.9- |
|    | 5.9C21.2,95,19.2,94.2,17.3,94.6 M99.8,115.2                      |
|    | c-0.5,0.1-0.9,0.5-1.1,1c-0.4,1.1-0.1,2.7-0.1,3.8v5.6c0,0.8-      |
|    | 0.1,1.7,0.6,2.3s2.1,0.4,3,0.4c0.6,0,1.3,0.1,1.8-0.1              |
|    | c0.6-0.2,1-0.6,1.1-1.2c0.2-                                      |
| 1.2,0.1-2.5,0.1-3.7v-5.1c0-0.7,0.2-1.7-0.3-2.3c-0.7-1-2.5-0.7-3.6-0.7 |
|    | C100.8,115.1,100.3,115.1,99.8,115.2                              |
|      M106.5,118.6v6.9h5.2v-6.9H106.5                                  |
|      M6.6,121.2v7.9c0,1-0.3,2.3,0.6,3.1c0.9,0.8,2.2,1.4,3.3,1.7       |
|    | c2.3,0.8,4.7,1.2,7.1,1.8c4.2,0.8,8.6,1,12.9,1.2c6.               |
| 6,0.3,13.2-0.1,19.7-0.9c3.1-0.4,6.3-1,9.3-2.1c1.1-0.4,2.6-0.9,3.4-1.8 |
|    | c0.6-0.8,0.4-2.2,0.4-3.1v-7.8c-2                                 |
| .8,0.5-5.6,1.3-8.5,1.7c-11,1.6-22.4,1.7-33.4,0.7c-3-0.3-6.1-0.6-9-1.2 |
|    | C10.4,122,8.5,121.4,6.6,121.2L6.6,121.2z"/>                      |
|    | <rect x="6.5" y="37" class="st185" width="56.9" height="25"/>    |
|    | </g>                                                             |
|    | <text id="text_chaudiere" transform="matrix(1 0 0 1 7 55)"       |
|      class="st33 st36a">tmp</text> </svg>                             |
+=======================================================================+
+-----------------------------------------------------------------------+

+-----------------------------------------------------------------------+
|    *Pour la notification (chaudière rouge en page d’accueil)          |
|    supprimer les dernières lignes <rect et <text et modifier les ID   |
|    (les id doivent être uniques)*                                     |
+=======================================================================+
+-----------------------------------------------------------------------+

+-----------------------------------------------------------------------+
|    ..                                                                 |
|  image:: vertopal_6e277aed43794de08da7229da055806a/media/image746.png |
|       :width: 3.66805in                                               |
|       :height: 1.11528in                                              |
+=======================================================================+
+-----------------------------------------------------------------------+

+-----------------------------------------------------------------------+
|    Annulation de l’alarme                                             |
+=======================================================================+
+-----------------------------------------------------------------------+

+-----------------------------------------------------------------------+
|    ..                                                                 |
|  image:: vertopal_6e277aed43794de08da7229da055806a/media/image747.png |
|       :width: 4.30278in                                               |
|       :height: 3.72917in                                              |
+=======================================================================+
+-----------------------------------------------------------------------+

+-----------------------------------------------------------------------+
|    **interieur.php**                                                  |
+=======================================================================+
+-----------------------------------------------------------------------+

+-----------------------------------------------------------------------+
| |image34|                                                             |
+=======================================================================+
+-----------------------------------------------------------------------+

+-----------------------------------------------------------------------+
|    ..                                                                 |
|  image:: vertopal_6e277aed43794de08da7229da055806a/media/image749.png |
|       :width: 3.08333in                                               |
|       :height: 3.025in                                                |
+=======================================================================+
+-----------------------------------------------------------------------+

+-----------------------------------------------------------------------+
| |image35|                                                             |
+=======================================================================+
+-----------------------------------------------------------------------+

+-----------------------------------------------------------------------+
|    **13.5.2 Dans Domoticz, le capteur, le plan, les variables et les  |
|    scripts**                                                          |
+=======================================================================+
+-----------------------------------------------------------------------+

..

   **- le capteur**

+-----------------------------------------------------------------------+
|    ..                                                                 |
|  image:: vertopal_6e277aed43794de08da7229da055806a/media/image751.png |
|       :width: 2.57361in                                               |
|       :height: 1.54861in                                              |
+=======================================================================+
+-----------------------------------------------------------------------+

+-----------------------------------------------------------------------+
|    ..                                                                 |
|  image:: vertopal_6e277aed43794de08da7229da055806a/media/image752.png |
|       :width: 3.93611in                                               |
|       :height: 1.34167in                                              |
+=======================================================================+
+-----------------------------------------------------------------------+

..

   Pour éviter des erreurs comme celles-ci :

+-----------------------------------------------------------------------+
| |image36|                                                             |
+=======================================================================+
+-----------------------------------------------------------------------+

..

   L’envoie des données doivent être un tableau json de cette forme :

+-----------------------------------------------------------------------+
|    ..                                                                 |
|  image:: vertopal_6e277aed43794de08da7229da055806a/media/image754.png |
|       :width: 4.86528in                                               |
|       :height: 1.57222in                                              |
+=======================================================================+
+-----------------------------------------------------------------------+

..

   Le topic étant « **domoticz/in** » , voir la page de domo-site.fr
   consacré à ce sujet

   L’affichage après réception des données :

+-----------------------------------------------------------------------+
|    ..                                                                 |
|  image:: vertopal_6e277aed43794de08da7229da055806a/media/image755.png |
|       :width: 4.34444in                                               |
|       :height: 1.58333in                                              |
+=======================================================================+
+-----------------------------------------------------------------------+

+-----------------------------------------------------------------------+
|    **Le plan**                                                        |
+=======================================================================+
+-----------------------------------------------------------------------+

+-----------------------------------------------------------------------+
|    Le capteur est ajouté au plan pour une communication automatique   |
|    avec Monitor ou toute autre application, les données sont          |
|    récupérées dans un fichier json                                    |
+=======================================================================+
+-----------------------------------------------------------------------+

+-----------------------------------------------------------------------+
|    |image37|\ |image38|                                               |
+=======================================================================+
+-----------------------------------------------------------------------+

..

   Le fichier json appelé par la fonction « devices_plan » , voir le *§
   1.3*

+-----------------------------------------------------------------------+
| |image39|                                                             |
+=======================================================================+
+-----------------------------------------------------------------------+

+-----------------------------------------------------------------------+
|    **Le script export_sql.lua**                                       |
|                                                                       |
|    | Les modifications à apporter :                                   |
|    | Pour n’envoyer à la BD que les changements de pression (pour     |
|      limiter le nombre d’enregistrements) , il faut :                 |
|    | - Soit créer une user variable                                   |
|    | - Soit utiliser une donnée persistante, solution retenue ici     |
+=======================================================================+
+-----------------------------------------------------------------------+

+-----------------------------------------------------------------------+
|    ..                                                                 |
|  image:: vertopal_6e277aed43794de08da7229da055806a/media/image759.png |
|       :width: 3.83194in                                               |
|       :height: 2.57778in                                              |
+=======================================================================+
+-----------------------------------------------------------------------+

+-----------------------------------------------------------------------+
|    Avec LUA, il faut enregistrer la valeur dans un fichier            |
+=======================================================================+
+-----------------------------------------------------------------------+

+-----------------------------------------------------------------------+
|    Le script : les lignes à ajouter pour l’enregistrement dans la BD  |
|    et le déclenchement d’une alarme                                   |
+=======================================================================+
+-----------------------------------------------------------------------+

+-----------------------------------------------------------------------+
|    | package.path = package.path..";www/modules_lua/?.lua" require    |
|      'datas'                                                          |
|    | require 'string_tableaux'                                        |
|                                                                       |
|    | function write_datas(data)                                       |
|    | f = io.open("www/modules_lua/datas.lua", "w")                    |
|      f:write("pression="..data)                                       |
|    | f:close()                                                        |
|    | end                                                              |
|                                                                       |
|    | elseif (deviceName=='pression_chaudière') then                   |
|    | pressionch=tonumber(deviceValue);                                |
|    | print ("pression_chaudiere:"..pressionch.."--"..pression); if    |
|      (pression~=pressionch) then                                      |
|    | libelle="pression_chaudiere#valeur";don="                        |
|    | "..libelle.."#"..tostring(deviceValue).."#"..datetime            |
|    | envoi_fab(don)                                                   |
|    | --donnees['pression']=tonumber(deviceValue)                      |
|    | write_datas(tonumber(deviceValue),data1)                         |
|    | --pression_chaudiere: variable du fichier 'string_tableaux'      |
+=======================================================================+
+-----------------------------------------------------------------------+

+-----------------------------------------------------------------------+
|    | if (pressionch<pression_chaudiere and                            |
|      uservariables['pression-chaudiere']=="ras") then                 |
|    | commandArray['Variable:pression-chaudiere'] = "manque_pression"; |
|    | print("pression basse")                                          |
|    | elseif (pressionch<pression_chaudiere and                        |
|      uservariables['pression-                                         |
|    | chaudiere']~="pression_basse") then                              |
|    | commandArray['Variable:pression-chaudiere']="ras"                |
|    | end                                                              |
|    | end                                                              |
+=======================================================================+
+-----------------------------------------------------------------------+

+-----------------------------------------------------------------------+
| |image40|                                                             |
+=======================================================================+
+-----------------------------------------------------------------------+

+-----------------------------------------------------------------------+
|    Pour l’alarme « pression basse », il faut créer une variable, qui  |
|    associée à un id affichera ce manque de pression sur une tablette  |
|    et enverra une notification par mail et sms                        |
+=======================================================================+
+-----------------------------------------------------------------------+

+-----------------------------------------------------------------------+
|    ..                                                                 |
|  image:: vertopal_6e277aed43794de08da7229da055806a/media/image761.png |
|       :width: 5.29306in                                               |
|       :height: 2.20833in                                              |
+=======================================================================+
+-----------------------------------------------------------------------+

+-----------------------------------------------------------------------+
| |image41|                                                             |
+=======================================================================+
+-----------------------------------------------------------------------+

+-----------------------------------------------------------------------+
|    **Le script notifications_variables.lua: les lignes à ajouter**    |
+=======================================================================+
+-----------------------------------------------------------------------+

+-----------------------------------------------------------------------+
|    | return {                                                         |
|    | on = {                                                           |
|    | variables = {                                                    |
|    | 'alarme_bat',                                                    |
|    | 'boite_lettres',                                                 |
|    | 'upload',                                                        |
|    | 'zm_cam',                                                        |
|    | 'pression-chaudiere',                                            |
|    | }                                                                |
|    | },                                                               |
|    | execute = function(domoticz, variable)                           |
|    | domoticz.log('Variable ' .. variable.name .. ' was changed',     |
|      domoticz.LOG_INFO) if                                            |
|      (domoticz.variables('pression-chaudiere').value ==               |
|      "manque_pression") then                                          |
|      txt=tostring(domoticz.variables('pression-chaudiere').value)     |
|    | domoticz.variables('pression-chaudiere').set('pression_basse')   |
|    | print("envoi SMS pression-chaudiere")                            |
|    | alerte_gsm('alarme_'..txt)                                       |
|    | end                                                              |
+=======================================================================+
+-----------------------------------------------------------------------+

+-----------------------------------------------------------------------+
|    **13.5.3 Dans la Base de données SQL**                             |
+=======================================================================+
+-----------------------------------------------------------------------+

+-----------------------------------------------------------------------+
|    - **Créer une nouvelle table**:                                    |
+=======================================================================+
+-----------------------------------------------------------------------+

+-----------------------------------------------------------------------+
|    | CREATE TABLE \`pression_chaudiere\` (                            |
|    | \`num\` int(5) NOT NULL,                                         |
|    | \`date\` timestamp NOT NULL DEFAULT current_timestamp() ON       |
|      UPDATE current_timestamp(),                                      |
|    | \`valeur\` varchar(4) NOT NULL                                   |
|    | ) ENGINE=InnoDB DEFAULT CHARSET=utf8;                            |
|    | ALTER TABLE \`pression_chaudiere\` CHANGE \`num\` \`num\` INT(4) |
|      NOT NULL AUTO_INCREMENT, add PRIMARY KEY (`num`);                |
+=======================================================================+
+-----------------------------------------------------------------------+

+-----------------------------------+-----------------------------------+
|    .. im                          |                                   |
| age:: vertopal_6e277aed43794de08d |                                   |
| a7229da055806a/media/image763.png |                                   |
|       :width: 5.26111in           |                                   |
|       :height: 2.64583in          |                                   |
+===================================+===================================+
| -                                 |    **Mettre à jour la table des   |
|                                   |    dispositifs :**                |
+-----------------------------------+-----------------------------------+

..

   .. image:: vertopal_6e277aed43794de08da7229da055806a/media/image764.png
      :width: 6.26667in
      :height: 4.30972in

+-----------------------------------+-----------------------------------+
|    -                              |    .. im                          |
|                                   | age:: vertopal_6e277aed43794de08d |
|                                   | a7229da055806a/media/image765.png |
|                                   |       :width: 5.35278in           |
|                                   |       :height: 5.4875in           |
|                                   |                                   |
|                                   |    **Mettre à jour la table des   |
|                                   |    variables DZ pour l’affichage  |
|                                   |    d’une notification sur l’app   |
|                                   |    donc la tablette ou le         |
|                                   |    smartphone**                   |
+===================================+===================================+
+-----------------------------------+-----------------------------------+

+-----------------------------------------------------------------------+
|    ..                                                                 |
|  image:: vertopal_6e277aed43794de08da7229da055806a/media/image766.png |
|       :width: 4.62917in                                               |
|       :height: 3.29722in                                              |
+=======================================================================+
+-----------------------------------------------------------------------+

..

   On a choisi d’afficher une image

+-----------------------------------------------------------------------+
| |image42|                                                             |
+=======================================================================+
+-----------------------------------------------------------------------+

..

   **Mise à jour de la table txt-image**:

   Pour afficher comme ci-dessus une image plutôt qu’un texte,

.. image:: vertopal_6e277aed43794de08da7229da055806a/media/image768.png
   :width: 6.26806in
   :height: 0.68333in

+-----------------------------------------------------------------------+
|    **13.5.4 Styles CSS**                                              |
+=======================================================================+
+-----------------------------------------------------------------------+

..

   Ajuster l’emplacement les couleurs pour les différents écrans

+-----------------------------------------------------------------------+
|    ..                                                                 |
|  image:: vertopal_6e277aed43794de08da7229da055806a/media/image769.png |
|       :width: 3.12639in                                               |
|       :height: 1.76111in                                              |
+=======================================================================+
+-----------------------------------------------------------------------+

+-----------------------------------------------------------------------+
| |image43|                                                             |
+=======================================================================+
+-----------------------------------------------------------------------+

..

   **13.6- SMS réception et émission**

   **13.6.1 réception SMS**

+-----------------------------------------------------------------------+
|    Voir les pages consacrées au modem GSM et la communication série   |
|    entre Domoticz et un RPI                                           |
+=======================================================================+
+-----------------------------------------------------------------------+

..

   Les fichiers sont sauvegardés dans le RAID1 :

   sudo cp rec_sms.py
   /pve/raid_usb/scripts_python_sh/SMS_ebyte/rec_sms.py

+-----------------------------------------------------------------------+
|    sudo cp /pve/raid_usb/scripts_python_sh/SMS_ebyte/envoi_sms.py     |
|    /home/michel                                                       |
+=======================================================================+
+-----------------------------------------------------------------------+

+-----------------------------------------------------------------------+
|    Variable Domoticz :                                                |
+=======================================================================+
+-----------------------------------------------------------------------+

.. image:: vertopal_6e277aed43794de08da7229da055806a/media/image771.png
   :width: 6.5in
   :height: 0.63472in

+-----------------------------------------------------------------------+
|    : **Le script et les variables**                                   |
+=======================================================================+
+-----------------------------------------------------------------------+

+-----------------------------------------------------------------------+
|    Le script export_sql fait déjà ce travail d’exporter les données   |
|    vers la base de données                                            |
+=======================================================================+
+-----------------------------------------------------------------------+

+-----------------------------------------------------------------------+
|    **13.6.2 émission SMS**                                            |
+=======================================================================+
+-----------------------------------------------------------------------+

+-----------------------------------------------------------------------+
|    **Explications :**                                                 |
+=======================================================================+
+-----------------------------------------------------------------------+

+-----------------------------------+-----------------------------------+
|    Un fichier python : sms_dz.py  |                                   |
|    surveille en permanence la     |                                   |
|    variable x de aldz.py et       |                                   |
|    déclenche l’envoi d’un sms si  |                                   |
|    celle-ci est différente de « 0 |                                   |
|    » ; priority indique la        |                                   |
|    priorité pour l’envoi des SMS  |                                   |
|    :                              |                                   |
+===================================+===================================+
|    | -                            |    | 0 envoi à tous les numéros   |
|    | -                            |    | 1 envoi au 1er numéro        |
|    | -                            |    | 2 envoi au 2eme numéro       |
|    | -                            |    | 3 ………….3eme ……….             |
+-----------------------------------+-----------------------------------+

+-----------------------------------------------------------------------+
|    Si ces numéros existent                                            |
+=======================================================================+
+-----------------------------------------------------------------------+

+-----------------------------------------------------------------------+
|    ..                                                                 |
|  image:: vertopal_6e277aed43794de08da7229da055806a/media/image772.png |
|       :width: 4.62639in                                               |
|       :height: 0.75in                                                 |
+=======================================================================+
+-----------------------------------------------------------------------+

+-----------------------------------------------------------------------+
|    Cela est possible avec l’utilisation du module « importlib »       |
+=======================================================================+
+-----------------------------------------------------------------------+

+-----------------------------------------------------------------------+
|    ..                                                                 |
|  image:: vertopal_6e277aed43794de08da7229da055806a/media/image773.png |
|       :width: 4.31389in                                               |
|       :height: 1.15694in                                              |
+=======================================================================+
+-----------------------------------------------------------------------+

..

   On import aussi aldz (b) et la variable lue est donc b.x

+-----------------------------------------------------------------------+
|    ..                                                                 |
|  image:: vertopal_6e277aed43794de08da7229da055806a/media/image774.png |
|       :width: 5.03194in                                               |
|       :height: 5.1875in                                               |
+=======================================================================+
+-----------------------------------------------------------------------+

+-----------------------------------------------------------------------+
|    Le fichier aldz.py est modifié par Domoticz (scripts LUA           |
|    notifications_devices et notifications_variables)                  |
+=======================================================================+
+-----------------------------------------------------------------------+

+-----------------------------------------------------------------------+
|    ..                                                                 |
|  image:: vertopal_6e277aed43794de08da7229da055806a/media/image775.png |
|       :width: 4.05278in                                               |
|       :height: 1.26111in                                              |
+=======================================================================+
+-----------------------------------------------------------------------+

+-----------------------------------------------------------------------+
| |image44|                                                             |
+=======================================================================+
+-----------------------------------------------------------------------+

+-----------------------------------------------------------------------+
|    **13.6.2.1 Enregistrement des n° de téléphone**                    |
+=======================================================================+
+-----------------------------------------------------------------------+

+-----------------------------------------------------------------------+
|    Depuis la version 2.1.3 il est possible d’envoyé plusieurs SMS à   |
|    des numéros différents ; pour cela, il faut ajouter les numéros à  |
|    connect.lua (la maj est automatique vers connec.py)                |
+=======================================================================+
+-----------------------------------------------------------------------+

+-----------------------------------------------------------------------+
|    ..                                                                 |
|  image:: vertopal_6e277aed43794de08da7229da055806a/media/image777.png |
|       :width: 4.5in                                                   |
|       :height: 5.86528in                                              |
+=======================================================================+
+-----------------------------------------------------------------------+

..

   Le nombre de numéros n’est pas limité :
   tel={‘xxxxxxxxxx’,’yyyyyyyyyy’,’zzzzzzzzzz’,…)

   Le tableau est LUA avec des {}, remplacés par des crochets dans
   connect.py et connect.js

+-----------------------------------------------------------------------+
|    | Importer sur Github le fichier complet :                         |
|    | *https://raw.git                                                 |
| hubusercontent.com/mgrafr/monitor/main/share/scripts_dz/py/sms_dz.py* |
+=======================================================================+
+-----------------------------------------------------------------------+

+-----------------------------------------------------------------------+
|    Pour un démarrage automatique du fichier après installation de     |
|    Domoticz, utiliser systemd de Debian ; le fichier à créer :        |
|    sms_dz.service                                                     |
+=======================================================================+
+-----------------------------------------------------------------------+

+-----------------------------------------------------------------------+
|    *https://raw.github                                                |
| usercontent.com/mgrafr/monitor/main/share/debian/systemd/system/sms_d |
|    z.service*                                                         |
+=======================================================================+
+-----------------------------------------------------------------------+

+-----------------------------------------------------------------------+
|    Ne pas oublier d’activer le script avant de le démarrer :          |
+=======================================================================+
+-----------------------------------------------------------------------+

+-----------------------------------------------------------------------+
|    systemctl enable sms_dz systemctl start sms_dz                     |
+=======================================================================+
+-----------------------------------------------------------------------+

+-----------------------------------------------------------------------+
|    **13.7- afficher les données du compteur Linky**                   |
+=======================================================================+
+-----------------------------------------------------------------------+

+-----------------------------------------------------------------------+
|    A partir des données reçues par Domoticz par le plugin             |
|    domoticz-linky                                                     |
+=======================================================================+
+-----------------------------------------------------------------------+

+-----------------------------------------------------------------------+
|    *https://github.com/guillaumezin/DomoticzLinky*                    |
+=======================================================================+
+-----------------------------------------------------------------------+

+-----------------------------------------------------------------------+
|    ..                                                                 |
|  image:: vertopal_6e277aed43794de08da7229da055806a/media/image778.png |
|       :width: 5.46944in                                               |
|       :height: 7.39722in                                              |
+=======================================================================+
+-----------------------------------------------------------------------+

..

   L’image svg :

+-----------------------------------------------------------------------+
|    | <svg version="1.1" id="Calque_1"                                 |
|      xmlns="http://www.w3.org/2000/svg"                               |
|      xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px"       |
|    | viewBox="0 0 162.2 321.9" style="enable-background:new 0 0 162.2 |
|      321.9;" xml:space="preserve"> <style type="text/css">            |
|    | .linky0{fill:#BAC174;}                                           |
|    | .linky1{fill:#CDCDA6;}                                           |
|    | .linky2{fill:#D3D860;}                                           |
|    | .linky3{fill:#E2E2E3;}                                           |
|    | .linky4{fill#96CD32;}                                            |
|    | .linky5{fill:#3B3F00;}                                           |
+=======================================================================+
+-----------------------------------------------------------------------+

+-----------------------------------------------------------------------+
|    | .linky6{fill:#FCFFBF;}                                           |
|    | .linky7{fill:#FFE42A;}                                           |
|    | .linky8{fill:#FFDA15;}                                           |
|    | .linky10{font-size:48px;}                                        |
|    | .linky11{fill:#FFFFFF;}                                          |
|    | .linky12{font-size:60px;}                                        |
|    | </style><a xlink:href="#interieur" onclick="popup_device(71)">   |
|    | <path class="linky0"                                             |
|                                                                       |
|    d="M3.5,56.5c-0.1,0.1-0.1,1.1,0.3,0.7C3.9,57.1,4,56.1,3.5,56.5z"/> |
|    | <path class="linky1"                                             |
|      d="M84.2,250.9c0                                                 |
| ,2.5,0.2,4-1,6l-1-1c2.3,1.7,3.2,1.7,6,1c-2.3-1.8-1.7-3.2-1-6H84.2z"/> |
|      <path class="linky2" d="M82.2,251.9l1,1L82.2,251.9z"/>           |
|    | <path class="linky3"                                             |
|      d="M83.2,251.9c-0.5,2.2-0.5,2.8,0,5C84,254.8,84,253.9,83.2,251.9 |
|    | M86.2,251.9v5C87.7,254.7,87.7,254,86.2,251.9z                    |
|    | "/>                                                              |
|    | <path class="linky2" d="M87.2,251.9l1,1L87.2,251.9z"/>           |
|    | <path class="linky3" d="M3.2,308.9c0.7,3.6,1.8,5.3,5,7L3.2,308.9 |
|      M163.2,309.9c-2,2.8-3.9,4.4-7,6                                  |
|    | C160.3,317.2,164.4,314.2,163.2,309.9z"/>                         |
|    | <path class="linky0" d="M5.2,310.9l1,0.5L5.2,310.9               |
|      M162.2,310.9c-0.1,0.2,1-5,1-5S162.3,310.6,162.2,310.9z"/> <rect  |
|      y="0" class="linky4" width="162.2" height="321.9"/>              |
|    | <rect x="338" y="0" class="linky4" width="0" height="0"/>        |
|    | <rect x="15" y="103" class="linky5" width="130" height="76"/>    |
|    | <circle class="linky5" cx="76.6" cy="74.6" r="5.6"/>             |
|    | <circle class="linky6" cx="73.8" cy="17.8" r="2.8"/>             |
|    | <circle class="linky7" cx="76.1" cy="22.8" r="5"/>               |
|    | <circle class="linky8" cx="77.4" cy="270.5" r="6.4"/>            |
|    | <text transform="matrix(1 0 0 1 15 57)" class="st33 linky10">P   |
|      Max</text>                                                       |
|    | <text id="txtlinky" transform="matrix(1 0 0 1 8 156)"            |
|      class="linky11 linky9 linky12">0</text>                          |
|    | <text transform="matrix(1 0 0 1 40 230)" class="linky9           |
|      linky10">kW</text></a>                                           |
|    | </svg>                                                           |
+=======================================================================+
+-----------------------------------------------------------------------+

La BD :

.. image:: vertopal_6e277aed43794de08da7229da055806a/media/image779.png
   :width: 6.26806in
   :height: 0.4875in

**Explications pour explode(concerne le PHP) :**

Data concerne 6 éléments

.. image:: vertopal_6e277aed43794de08da7229da055806a/media/image780.png
   :width: 4.55278in
   :height: 4.15694in

| Pour n’afficher que le 5eme élément on utilise dans une fonction PHP «
  explode »
| Explode renvoie un tableau de chaînes, chacune étant une sous-chaîne
  limitée par un séparateur, ici un point-virgule.

.. image:: vertopal_6e277aed43794de08da7229da055806a/media/image781.png
   :width: 6.26806in
   :height: 1.83611in

*Contrairement à LUA, en PHP les tables commencent à 0 : 4 = table[4 ]=
5eme champ*

**13.7.1 enregistrement dans la BD SQL**

Créer la table :

+-----------------------------------------------------------------------+
|    | CREATE TABLE \`energie\` (                                       |
|    | \`num\` int(4) NOT NULL,                                         |
|    | \`date\` timestamp NOT NULL DEFAULT current_timestamp() ON       |
|      UPDATE current_timestamp(), \`conso\` varchar(10) NOT NULL,      |
|    | \`pmax\` varchar(10) NOT NULL                                    |
+=======================================================================+
+-----------------------------------------------------------------------+

+-----------------------------------------------------------------------+
|    | ) ENGINE=InnoDB DEFAULT CHARSET=utf8;                            |
|    | ALTER TABLE \`energie\` CHANGE \`num\` \`num\` INT(4) NOT NULL   |
|      AUTO_INCREMENT, add PRIMARY KEY (`num`);                         |
+=======================================================================+
+-----------------------------------------------------------------------+

La table possède 2 valeurs aussi le champ « valeur » ne peut être
utilisé , 2 champs distincts sont créés

Dans Domoticz :

Comme pour le capteur de pression, on enregistre, dans une variable une
info pour éviter d’enregistrer un grand nombre de fois la même valeur ;
on se sert du jour (day) et on modifie la fonction write_datas ()
utilisée pour le capteur de pression (fichier avec 2 valeurs au lieu
d’une)

.. image:: vertopal_6e277aed43794de08da7229da055806a/media/image782.png
   :width: 6.26806in
   :height: 5.06806in

.. image:: vertopal_6e277aed43794de08da7229da055806a/media/image783.png
   :width: 2.48056in
   :height: 0.95833in

Dans Monitor :

.. image:: vertopal_6e277aed43794de08da7229da055806a/media/image784.png
   :width: 6.26806in
   :height: 5.58333in

.. image:: vertopal_6e277aed43794de08da7229da055806a/media/image785.png
   :width: 5.10556in
   :height: 5.96944in

.. image:: vertopal_6e277aed43794de08da7229da055806a/media/image786.png
   :width: 5.52222in
   :height: 6.47917in

Pour ajouter un historique de la consommation :

.. image:: vertopal_6e277aed43794de08da7229da055806a/media/image787.png
   :width: 6.26806in
   :height: 1.49861in

**14 ADMINISTRATION**

.. image:: vertopal_6e277aed43794de08da7229da055806a/media/image788.png
   :width: 6.30139in
   :height: 6.9875in

**14.1- fichiers communs à toutes les pages : css**

.. image:: vertopal_6e277aed43794de08da7229da055806a/media/image789.png
   :width: 5.86389in
   :height: 1.45in

**Index_loc.php**

.. image:: vertopal_6e277aed43794de08da7229da055806a/media/image790.png
   :width: 6.26806in
   :height: 1.39167in

**header.php**

.. image:: vertopal_6e277aed43794de08da7229da055806a/media/image791.png
   :width: 4.35417in
   :height: 2.29028in

Affichage obligatoire dans le menu

**ajax.php :**

.. image:: vertopal_6e277aed43794de08da7229da055806a/media/image792.png
   :width: 6.26806in
   :height: 0.46805in

**admin/config.php :**

.. image:: vertopal_6e277aed43794de08da7229da055806a/media/image793.png
   :width: 4.67778in
   :height: 1.39583in

.. image:: vertopal_6e277aed43794de08da7229da055806a/media/image131.png
   :width: 6.26806in
   :height: 1.12639in

**Extrait de la fonction admin de fonctions.php**

.. image:: vertopal_6e277aed43794de08da7229da055806a/media/image794.png
   :width: 6.07917in
   :height: 5.22917in

**14.2- admin.php, test_db.php et backup_bd**

   .. image:: vertopal_6e277aed43794de08da7229da055806a/media/image795.png
      :width: 4.68611in
      :height: 3.97917in

   .. image:: vertopal_6e277aed43794de08da7229da055806a/media/image796.png
      :width: 4.22917in
      :height: 0.60417in

   .. image:: vertopal_6e277aed43794de08da7229da055806a/media/image797.png
      :width: 4.36389in
      :height: 2.88611in

**admin.php**

.. image:: vertopal_6e277aed43794de08da7229da055806a/media/image798.png
   :width: 6.30139in
   :height: 5.11667in

**Sauvegardes Domoticz, rappel :**

Variables :

Types :

| 0 = Entier, par exemple -1, 1, 0, 2, 10
| 1 = Flottant, par exemple -1,1, 1,2, 3,1
| 2 = chaîne
| 3 = Date au format JJ / MM / AAAA
| 4 = Heure au format 24 h HH: MM

**Le fichier info_admin.php**

.. image:: vertopal_6e277aed43794de08da7229da055806a/media/image799.png
   :width: 6.30139in
   :height: 4.57222in

**Le fichier test_db.php**

.. image:: vertopal_6e277aed43794de08da7229da055806a/media/image800.png
   :width: 6.26806in
   :height: 2.1125in

| **Le fichier backup_db.php**
| Pour la sauvegarde de la BD :

.. image:: vertopal_6e277aed43794de08da7229da055806a/media/image801.png
   :width: 6.30139in
   :height: 6.28472in

Résultat :

.. image:: vertopal_6e277aed43794de08da7229da055806a/media/image802.png
   :width: 4.21944in
   :height: 3.25in

**14.3- le javascript :**

Pour la fonction mdp() et le clavier(*Minimal Virtual Keypad*), voir le
*§5.5*

.. image:: vertopal_6e277aed43794de08da7229da055806a/media/image803.png
   :width: 3.43889in
   :height: 0.89583in

.. image:: vertopal_6e277aed43794de08da7229da055806a/media/image804.png
   :width: 6.26806in
   :height: 3.00417in

**14.4- fonctions PHP :**

.. image:: vertopal_6e277aed43794de08da7229da055806a/media/image805.png
   :width: 6.30139in
   :height: 2.34167in

.. image:: vertopal_6e277aed43794de08da7229da055806a/media/image806.png
   :width: 6.30139in
   :height: 7.39444in

.. image:: vertopal_6e277aed43794de08da7229da055806a/media/image807.png
   :width: 6.30139in
   :height: 6.02778in

.. image:: vertopal_6e277aed43794de08da7229da055806a/media/image808.png
   :width: 6.30139in
   :height: 0.49583in

**Tableau JS :**

*il suffit d’ajouter ces lignes au script node-red pour récupérer l’idx
de Domoticz à partir du nom*

.. image:: vertopal_6e277aed43794de08da7229da055806a/media/image809.png
   :width: 6.26806in
   :height: 3.15417in

**14.5 - Téléchargement d’un fichier externe dans Domoticz**

| Pour la mise à jour du fichier avec les variables pour les scripts
  Domoticz : plusieurs solutions étaient possibles mais avec
  l’installations de modules supplémentaires ainsi que de
| scripts (sftp dérivé de ssh étant la plus facile à installer et
  utiliser).

En http, on ne peut seulement télécharger un fichier depuis un site
distant.

| La solution retenue :
| - Avec l’API de Domoticz il est possible de maj des variables ; à la
  lecture puis mise à jour d’un fichier de Domoticz distant, on
  enregistre un fichier temporaire et on met à 1 une variable pour
  l’exécution d’un script qui va télécharger le fichier modifié ; la
  variable est mise à 0 jusqu’à une prochaine modification du fichier.

   Pour la mise à jour de la liste des caméras dont la détection est
   activée, c’est le même script qui est utilisé, la variable « upload »
   est alors passé à 2

La variable |image45|

.. image:: vertopal_6e277aed43794de08da7229da055806a/media/image811.png
   :width: 6.26806in
   :height: 0.72083in

Le script :|image46|

.. image:: vertopal_6e277aed43794de08da7229da055806a/media/image812.png
   :width: 6.26806in
   :height: 5.79306in

Les fonctions wajax() et yajax() dans mes_js.js

+-----------------------------------+-----------------------------------+
|    | function                     |                                   |
|      w                            |                                   |
| ajax(content,rel){alert(content+" |                                   |
|      "+rel);                      |                                   |
|    | $("btclose"                  |                                   |
| ).remove();$("reponse1").empty(); |                                   |
|    | $("#adm1").empty();          |                                   |
|    | $.post('ajax.php',           |                                   |
|      {appp:'adminp',              |                                   |
|      variable:rel,                |                                   |
|                                   |                                   |
| | command:content}).done(function |                                   |
| (response){console.log(response); |                                   |
|                                   |                                   |
|    $("#reponse1").html(response); |                                   |
|    | });}                         |                                   |
|    | function yajax(id1){         |                                   |
|    | $(id1).hide();}              |                                   |
|    | function                     |                                   |
|      remplace(id2,content2){      |                                   |
|    | $(id2).text(content2);       |                                   |
|    | }                            |                                   |
+===================================+===================================+
+-----------------------------------+-----------------------------------+

.. image:: vertopal_6e277aed43794de08da7229da055806a/media/image813.png
   :width: 6.26806in
   :height: 2.05833in

Le fichier temporaire dans monitor pour Domoticz :

.. image:: vertopal_6e277aed43794de08da7229da055806a/media/image814.png
   :width: 3.32361in
   :height: 3.35417in

**14.6 - Copies d’écran :**

   .. image:: vertopal_6e277aed43794de08da7229da055806a/media/image815.png
      :width: 3.94861in
      :height: 5.32361in

   .. image:: vertopal_6e277aed43794de08da7229da055806a/media/image816.png
      :width: 3.65694in
      :height: 3.95833in

   .. image:: vertopal_6e277aed43794de08da7229da055806a/media/image817.png
      :width: 3.6875in
      :height: 5.025in

.. image:: vertopal_6e277aed43794de08da7229da055806a/media/image818.png
   :width: 5.48056in
   :height: 3.5625in

   .. image:: vertopal_6e277aed43794de08da7229da055806a/media/image819.png
      :width: 4.80278in
      :height: 3.99028in

   .. image:: vertopal_6e277aed43794de08da7229da055806a/media/image820.png
      :width: 4.96944in
      :height: 6.67778in

   **Fichier des mots de passe et login en base64 , des ip réseau**

.. image:: vertopal_6e277aed43794de08da7229da055806a/media/image821.png
   :width: 5.29306in
   :height: 2.61528in

   **Comme celle de monitor pour l’utiliser dans des scripts (python ou
   autres).**

   **: connect.lua**

L’ip de monitor dans ce fichier permet, en cas de changement de l’IP de
ne pas avoir à modifier les scripts. C’est également valable pour tous
les serveurs

.. image:: vertopal_6e277aed43794de08da7229da055806a/media/image822.png
   :width: 5.05139in
   :height: 2in

   **: connect.py**

Un double de connect.lua est enregistré au format python pour les script
écrit dans ce langage

.. image:: vertopal_6e277aed43794de08da7229da055806a/media/image823.png
   :width: 6.19861in
   :height: 3.63472in

Ce double peut aussi servir à un autre serveur (un PI par exemple) ce
qui facilite les mises à jour.

Une commande dans administration permet une mise à jour automatique du
RPI

Pour cela le fichier admin/config.php doit posséder l’IP du serveur :

.. image:: vertopal_6e277aed43794de08da7229da055806a/media/image824.png
   :width: 4.89722in
   :height: 0.95833in

.. image:: vertopal_6e277aed43794de08da7229da055806a/media/image825.png
   :width: 4.44861in
   :height: 1.11528in

La page admin.php :

.. image:: vertopal_6e277aed43794de08da7229da055806a/media/image826.png
   :width: 6.30139in
   :height: 0.65in

fonctions.php :

.. image:: vertopal_6e277aed43794de08da7229da055806a/media/image827.png
   :width: 6.30139in
   :height: 0.59722in

.. image:: vertopal_6e277aed43794de08da7229da055806a/media/image828.png
   :width: 6.30139in
   :height: 2.56111in

.. image:: vertopal_6e277aed43794de08da7229da055806a/media/image829.png
   :width: 6.30139in
   :height: 1.95139in

.. image:: vertopal_6e277aed43794de08da7229da055806a/media/image830.png
   :width: 4.19861in
   :height: 1.625in

Cette commande utilise SSH2 et SCP , voir le *§ 14.10*

   **:connect.js**

   .. image:: vertopal_6e277aed43794de08da7229da055806a/media/image831.png
      :width: 2.59444in
      :height: 2.49722in

**14.7 Explications concernant l’importation distantes d’un tableau
LUA**

Compléments sur l’affichage ci-dessus : fichier de variables LUA

Concerne :

   - le tableau de variable string_tableau.lua

   - la liste des caméras Modect pour l’alarme

   - le fichier des Logins/mots de passe

   **string_tableau.lua**

.. image:: vertopal_6e277aed43794de08da7229da055806a/media/image832.png
   :width: 3.89722in
   :height: 2.77083in

Dans config.php de monitor :

.. image:: vertopal_6e277aed43794de08da7229da055806a/media/image833.png
   :width: 5.53333in
   :height: 0.85417in

Le fichier temporaire dans monitor, le répertoire « dz » est à créer
avec les autorisations pour écrire

.. image:: vertopal_6e277aed43794de08da7229da055806a/media/image834.png
   :width: 5.29722in
   :height: 0.54861in

.. image:: vertopal_6e277aed43794de08da7229da055806a/media/image835.png
   :width: 3.37639in
   :height: 2.91667in

.. image:: vertopal_6e277aed43794de08da7229da055806a/media/image836.png
   :width: 3.59444in
   :height: 3.19583in

Dans fonctions.php :

function admin($choix,$idrep) :

.. image:: vertopal_6e277aed43794de08da7229da055806a/media/image837.png
   :width: 6.30139in
   :height: 3.24583in

.. image:: vertopal_6e277aed43794de08da7229da055806a/media/image838.png
   :width: 6.26111in
   :height: 2.00972in

Maj par dz : on met à 1,2 ou 3 la variable upload et dz se charge
d’importer le fichier

.. image:: vertopal_6e277aed43794de08da7229da055806a/media/image839.png
   :width: 6.30139in
   :height: 1.30556in

.. image:: vertopal_6e277aed43794de08da7229da055806a/media/image840.png
   :width: 4.86528in
   :height: 2.6875in

Le script *lua utilisé* :

.. image:: vertopal_6e277aed43794de08da7229da055806a/media/image841.png
   :width: 5.55278in
   :height: 0.66667in

.. image:: vertopal_6e277aed43794de08da7229da055806a/media/image842.png
   :width: 6.30139in
   :height: 5.08194in

+-----------------------------------------------------------------------+
|    | if ((domoticz.variables('upload').changed) and                   |
|      (domoticz.variables('upload').value ~= "0")) then                |
|    | if (domoticz.variables('upload').value == "1") then              |
|    | print("upload string_tableaux");                                 |
|    | command = rep..'upload_fichier.py string_tableaux.lua            |
|      '..ip_mon..' > '..rep_log..'string_tableaux.log 2>&1'            |
|    | elseif (domoticz.variables('upload').value == "2") then          |
|    | print("upload string_modect")                                    |
|    | command = rep..'upload_fichier.py string_modect.lua '..ip_mon..' |
|      > '..rep_log..'string_modect.log 2>&1'                           |
|    | elseif (domoticz.variables('upload').value == "3") then          |
|    | print("upload connect")                                          |
|    | command = rep..'upload_fichier.py connect.lua >                  |
|      '..rep_log..'connect.log 2>&1'                                   |
|    | fich=""                                                          |
|    | for line in io.lines(                                            |
|      "/opt/domoticz/www/modules_lua/connect.lua" ) do                 |
|    | fich=fich..tostring(line).."\\n"                                 |
|    | end                                                              |
|    | f = io.open("userdata/scripts/python/connect.py", "w")           |
|    | env="#!/usr/bin/env python3"                                     |
|    | f:write(env.." -*- coding: utf-8 -*-".."\\n"..fich)              |
|    | f:close()                                                        |
|    | end                                                              |
|    | --print(command);                                                |
|    | os.execute(command);print('maj effectuée');                      |
|    | domoticz.variables('upload').set('0')                            |
|    | end                                                              |
+=======================================================================+
+-----------------------------------------------------------------------+

Le script python : upload_fichier.py

C’est pour la raison ci-dessous que l’adresse ip de monitor se trouve
dans le fichier « connect.lua »

.. image:: vertopal_6e277aed43794de08da7229da055806a/media/image843.png
   :width: 5.83333in
   :height: 1.58333in

La fonction actuelle :

.. image:: vertopal_6e277aed43794de08da7229da055806a/media/image844.png
   :width: 4.81389in
   :height: 2.13611in

**REMARQUE** : pour que python trouve le fichier connect **et donc la
variable ip_monitor,** il faut ajouter le répertoire vide
**\__INIT__.py**

.. image:: vertopal_6e277aed43794de08da7229da055806a/media/image845.png
   :width: 5.39722in
   :height: 0.89583in

**string_modect.lua**

.. image:: vertopal_6e277aed43794de08da7229da055806a/media/image846.png
   :width: 4.66667in
   :height: 6.0875in

| Pour cette fonction le script LUA est similaire à celui pour les
  poubelles, la fosse septique, les anniversaires, …
| La variable est mise à 2, voir le script lua :

.. image:: vertopal_6e277aed43794de08da7229da055806a/media/image847.png
   :width: 4.17778in
   :height: 2.23889in

**admin.php :**

.. image:: vertopal_6e277aed43794de08da7229da055806a/media/image848.png
   :width: 6.26806in
   :height: 1.42222in

Affichage :

.. image:: vertopal_6e277aed43794de08da7229da055806a/media/image849.png
   :width: 3.83333in
   :height: 5.10833in

**fonctions.php**

.. image:: vertopal_6e277aed43794de08da7229da055806a/media/image850.png
   :width: 6.26806in
   :height: 2.675in

.. image:: vertopal_6e277aed43794de08da7229da055806a/media/image851.png
   :width: 6.26806in
   :height: 2.975in

MODECT Affichage dans admin.php mais aussi dans alarmes.php

.. image:: vertopal_6e277aed43794de08da7229da055806a/media/image852.png
   :width: 5.54306in
   :height: 3.125in

.. image:: vertopal_6e277aed43794de08da7229da055806a/media/image853.png
   :width: 5.17778in
   :height: 4.53194in

**alarm.php**

.. image:: vertopal_6e277aed43794de08da7229da055806a/media/image854.png
   :width: 6.26806in
   :height: 1.60694in

**fonctions.php**

+-----------------------------------------------------------------------+
|    | function sql_app($choix,$table,$valeur,$date,$icone=''){         |
|    | // SERVEUR SQL connexion                                         |
|    | $conn = new mysqli(SERVEUR,UTILISATEUR,MOTDEPASSE,DBASE);        |
|    | if ($choix==0) {                                                 |
|    | $sql="INSERT INTO ".$table." (`num`, \`date`, \`valeur`,         |
|      \`icone`)                                                        |
|    | VALUES (NULL, '".$date."', '".$valeur."', '".$icone."');";       |
|    | $result = $conn->query($sql);                                    |
|    | ;}                                                               |
|    | if ($choix==1) {                                                 |
|    | $sql="SELECT \* FROM ".$table." ORDER BY num DESC LIMIT 24";     |
|    | $result = $conn->query($sql);                                    |
|    | $number = $result->num_rows;                                     |
|    | while($row = $result->fetch_array(MYSQLI_ASSOC)){                |
|    | echo $row['date'].' '.$row['valeur'].' <img                      |
|      style="width:30px;vertical-align:middle"                         |
|      src="'.$row['icone'].'"/><br>';                                  |
|    | }                                                                |
|    | }                                                                |
|    | if ($choix==2 \|\| $choix==3) {// modect pour dz -----           |
|      2,"cameras","modect",1,$icone=''                                 |
|    | $sql="SELECT \* FROM \`cameras\` WHERE \`modect\` = 1 ";         |
|    | $result = $conn->query($sql);$i=0;                               |
|    | $number = $result->num_rows;if ($number>0) {                     |
|    | $content="cam_modect = {";                                       |
|    | while($row = $result->fetch_array(MYSQLI_ASSOC)){                |
|    | //$content = $cont.$row['id_zm'];                                |
|    | if ($choix==2){ $content =                                       |
|      $content.'['.$row["id_zm"].']="'.$row['url'].'"';}               |
|    | if ($choix==3){ $content = $content.$row["id_zm"];}              |
|    | $i++;if ($number>$i) {$content=$content.",";}                    |
|    | }                                                                |
|    | $content = $content."}";if ($choix==3) token_zm();               |
|    | }                                                                |
|    | else echo "pas de cameras modect";                               |
|    | }                                                                |
|    | $conn->close();                                                  |
|                                                                       |
|    return $content;}                                                  |
+=======================================================================+
+-----------------------------------------------------------------------+

**footer.php**

.. image:: vertopal_6e277aed43794de08da7229da055806a/media/image855.png
   :width: 6.26806in
   :height: 1.64028in

**14.8 Explications concernant la mise à jour automatique SQL des
variables et dispositifs**

admin.php

.. image:: vertopal_6e277aed43794de08da7229da055806a/media/image856.png
   :width: 6.30139in
   :height: 0.39583in

footer.php

.. image:: vertopal_6e277aed43794de08da7229da055806a/media/image857.png
   :width: 6.30139in
   :height: 2.48889in

fonction.php : admin()

.. image:: vertopal_6e277aed43794de08da7229da055806a/media/image858.png
   :width: 6.30139in
   :height: 4.62361in

Affichage monitor :

.. image:: vertopal_6e277aed43794de08da7229da055806a/media/image859.png
   :width: 4.30278in
   :height: 5.94861in

footer.php

.. image:: vertopal_6e277aed43794de08da7229da055806a/media/image860.png
   :width: 6.14583in
   :height: 7.69861in

.. image:: vertopal_6e277aed43794de08da7229da055806a/media/image861.png
   :width: 6.30139in
   :height: 2.78472in

ajax.php puis fonctions.php : mysql_app()

.. image:: vertopal_6e277aed43794de08da7229da055806a/media/image862.png
   :width: 6.19583in
   :height: 4.58333in

Monitor :

.. image:: vertopal_6e277aed43794de08da7229da055806a/media/image863.png
   :width: 5.00139in
   :height: 3.77083in

**14.9 Explications concernant l’affichage des infos de la page
admin.php**

.. image:: vertopal_6e277aed43794de08da7229da055806a/media/image864.png
   :width: 4.03194in
   :height: 3.39583in

admin.php

on ajoute pour les lignes concernées :

+-----------------------------------------------------------------------+
|    | <a><img class="info_admin" src="images/icon-info.svg"            |
|      data-toggle="modal" data-target="#info-admin1" rel=6             |
|    | style="width:25px;display:inline;"></a><br>                      |
+=======================================================================+
+-----------------------------------------------------------------------+

rel correspond au n° de l’élément dans la table du
fichier:info_admin.php

.. image:: vertopal_6e277aed43794de08da7229da055806a/media/image865.png
   :width: 6.30139in
   :height: 5.25139in

**14.10 Commandes ssh2 PC distant ( ici un RPI ) depuis monitor**

SSH, ou Secure Shell, est un protocole utilisé pour se connecter en
toute sécurité à des systèmes distants.

Mon RAID1 étant alimenté en 230 Volts, le PI étant alimenté sur
batterie, lors d’une coupure secteur, lors de la remise sous tension, le
raid1 n’est pas reconnu ; Absent de la maison il faut donc faire un
reboot du PI ou un « mount -a « en bash d’où la commande ci-dessous.

Autre application, mise à jour de la configuration pour l’envoi de
notifications par mails lors d’un changement de mot de passe par
exemple.

Pour cela on utilise le paquet php8.2-ssh2

sudo apt install php8.2-ssh2

.. image:: vertopal_6e277aed43794de08da7229da055806a/media/image866.png
   :width: 6.30139in
   :height: 0.85833in

**14.10.1 reboot PC (ou RPI)**

Sur le pi, soit une commande sudo reboot, soit un script qui effectue la
commande ; j’ai choisi cette dernière solution car il suffit de modifier
ce fichier pour faire d’autres commandes.:

.. image:: vertopal_6e277aed43794de08da7229da055806a/media/image867.png
   :width: 2.36528in
   :height: 0.69861in

La fonction PHP (ssh_scp.php) :

.. image:: vertopal_6e277aed43794de08da7229da055806a/media/image868.png
   :width: 6.30139in
   :height: 3.99306in

Comme pour toutes les autres commandes « Administration » les scripts JS
et ajax existent déjà, il suffit d’ajouter l’appel de la fonction
ci-dessus dans admin.php :

.. image:: vertopal_6e277aed43794de08da7229da055806a/media/image869.png
   :width: 6.30139in
   :height: 1.00139in

La fonction PHP admin() appelle la fonction ssh_scp.php

.. image:: vertopal_6e277aed43794de08da7229da055806a/media/image870.png
   :width: 6.30139in
   :height: 1.73333in

**14.10.2 commandes scp pour l’envoi ou la réception de fichiers
distants**

SCP veut dire Secure Copy et il est utilisé pour copier en toute
sécurité des fichiers d’un ordinateur local vers des serveurs distants
ou inversement, à l'aide du protocole SSH, SSH2 avec PHP

Comme pour le reboot ci-dessus, le processus est le même mais plusieurs
étapes sont nécessaires :

   | - télécharger le fichier distant /etc/mcmtprc, par exemple , celui
     de la commande affichée dans « Administration »
   | - le modifier
   | - le renvoyer au pc distant

   fonctions.php , admin()

   .. image:: vertopal_6e277aed43794de08da7229da055806a/media/image871.png
      :width: 5.95694in
      :height: 2.1875in

   .. image:: vertopal_6e277aed43794de08da7229da055806a/media/image872.png
      :width: 6.3in
      :height: 3.84444in

**Exemple de fichier /etc/msmtprc**

.. image:: vertopal_6e277aed43794de08da7229da055806a/media/image873.png
   :width: 4.68889in
   :height: 7.02083in

**SSH2 et SCP concerne aussi la commande de maj du fichier python
connect.py si il est utilisé par**

**plusieurs serveurs.**

**La commande ci-dessous met à jour connect.py dans Domoticz, Monitor,
et un autre serveur (le PI)**

**REMARQUE** : pour que python trouve le fichier connect **et donc les
variables,**\ il faut ajouter

le répertoire vide **\__INIT__.py**

.. image:: vertopal_6e277aed43794de08da7229da055806a/media/image874.png
   :width: 3.71944in
   :height: 1.0625in

**Ce fichier permet de ne pas avoir à modifier les scripts python lors
d’un changement de serveur**

**Exemple ( fichier rec_sms_serie.py)**

.. image:: vertopal_6e277aed43794de08da7229da055806a/media/image875.png
   :width: 6.00139in
   :height: 2.48889in

.. image:: vertopal_6e277aed43794de08da7229da055806a/media/image876.png
   :width: 5.59444in
   :height: 4.84444in

connect.py

.. image:: vertopal_6e277aed43794de08da7229da055806a/media/image877.png
   :width: 4.42778in
   :height: 1.59444in

**15. - EXEMPLES**

| **15.1- ajout d’un dispositif**
| **Ajout d’un contact de porte supplémentaire**

.. image:: vertopal_6e277aed43794de08da7229da055806a/media/image878.png
   :width: 3.98055in
   :height: 1.35417in

Dans Domoticz le dispositif est ajouté au plan :

.. image:: vertopal_6e277aed43794de08da7229da055806a/media/image879.png
   :width: 3.62639in
   :height: 2.125in

.. image:: vertopal_6e277aed43794de08da7229da055806a/media/image880.png
   :width: 5.50139in
   :height: 6.16667in

| **15.1.1- Modifier l’image :**
| - On effectue (avec Notepad par exemple) une sauvegarde de l’image :

   .. image:: vertopal_6e277aed43794de08da7229da055806a/media/image881.png
      :width: 6.26111in
      :height: 3.74028in

   - Avec Inkscape, ouvrir l’image

   .. image:: vertopal_6e277aed43794de08da7229da055806a/media/image882.png
      :width: 3.70972in
      :height: 1.61528in

   Faire un copier/coller d’un dispositif existant ou importer une icone

   .. image:: vertopal_6e277aed43794de08da7229da055806a/media/image883.png
      :width: 3.18889in
      :height: 1.84306in

Placer l’icône et renseigner l’ID

   .. image:: vertopal_6e277aed43794de08da7229da055806a/media/image884.png
      :width: 1.40694in
      :height: 1.67639in

   .. image:: vertopal_6e277aed43794de08da7229da055806a/media/image885.png
      :width: 5.23056in
      :height: 5.75in

   Pour la couleur :

   .. image:: vertopal_6e277aed43794de08da7229da055806a/media/image886.png
      :width: 5.71944in
      :height: 4.26111in

   Sauvegarder l’image dans le fichier PHP d’origine, en supprimant la
   ligne XML

   .. image:: vertopal_6e277aed43794de08da7229da055806a/media/image887.png
      :width: 6.26806in
      :height: 3.85in

   **15.1.2 Dans la Base de données SQL :**

   Insérer le dispositif dans la table « dispositifs_dz »

   .. image:: vertopal_6e277aed43794de08da7229da055806a/media/image888.png
      :width: 6.26806in
      :height: 0.60417in

   | **15.1.3 Dans le fichier PHP de l’image**
   | On ajoute un onclick pour l’affichage des propriétés ; avec
     Inkscape, il est possible de l’ajouter lors de la création de
     l’image si l’on a déjà choisi l’ID monitor.

   Ce n’est pas important, il faut ouvrir de toute façon cette image
   pour ajouter un cercle clignotant pour la gestion de la pile.

   .. image:: vertopal_6e277aed43794de08da7229da055806a/media/image889.png
      :width: 4.11528in
      :height: 1.77083in

   .. image:: vertopal_6e277aed43794de08da7229da055806a/media/image890.png
      :width: 3.03056in
      :height: 3.39583in

   On peut vérifier que l’iD pour la couleur est bien présent

.. image:: vertopal_6e277aed43794de08da7229da055806a/media/image891.png
   :width: 5.83333in
   :height: 0.78194in

   Pour le cercle le plus simple c’est de faire un copier/coller d’un
   cercle existant avec des coordonnées facile à retrouver et avec une
   opacité à 1 :

   Voir paragraphe 2.2.3

   .. image:: vertopal_6e277aed43794de08da7229da055806a/media/image892.png
      :width: 6.26806in
      :height: 3.95556in

   Avec F12 du navigateur ajuster la position :

   .. image:: vertopal_6e277aed43794de08da7229da055806a/media/image893.png
      :width: 2.96944in
      :height: 1.625in

   .. image:: vertopal_6e277aed43794de08da7229da055806a/media/image894.png
      :width: 2.79305in
      :height: 1.17639in

**15.2- Réinitialisation des dispositifs dans Domoticz**

**Exemple** : transfert de Domoticz linux vers Domoticz Docker avec
Zwave et Zigbee sous docker également, avec la reconnaissance
automatique MQTT

.. image:: vertopal_6e277aed43794de08da7229da055806a/media/image895.png
   :width: 6.26806in
   :height: 2.37639in

Dans ce cas tous les dispositifs changent d’idx dans Domoticz, il faut
mettre à jour la table de

la base de données : « dispositifs ».

Pour préparer le travail, faire une copie de la table « dispositifs en
l’exportant

.. image:: vertopal_6e277aed43794de08da7229da055806a/media/image896.png
   :width: 6.08472in
   :height: 2.05278in

Modifier le fichier exporté :

.. image:: vertopal_6e277aed43794de08da7229da055806a/media/image897.png
   :width: 4.08472in
   :height: 4.32361in

Importer la nouvelle table

.. image:: vertopal_6e277aed43794de08da7229da055806a/media/image898.png
   :width: 6.26806in
   :height: 2.54306in

Faire correspondre les nouveaux « idx » de Domoticz avec les « idm « de
monitor.

Dans le fichier de configuration, modifier le nom de la table et la
nouvelle IP de Domoticz :

.. image:: vertopal_6e277aed43794de08da7229da055806a/media/image899.png
   :width: 5.54306in
   :height: 1.5625in

.. image:: vertopal_6e277aed43794de08da7229da055806a/media/image900.png
   :width: 5.95972in
   :height: 1.10417in

**16. – Ajouter des pages ou des alertes non incluses dans le
programme**

   **16.1 – Ajouter un plan (ex : 1er étage)**

   - créer la page avec le plan, voir le *§ 2*

   - Ajouter la page à index_loc.php

   .. image:: vertopal_6e277aed43794de08da7229da055806a/media/image901.png
      :width: 5.56389in
      :height: 1.72917in

   Ajouter la page au menu dans header.php :

   .. image:: vertopal_6e277aed43794de08da7229da055806a/media/image902.png
      :width: 6.26111in
      :height: 2.46944in

   **16.2 – Ajouter une page vierge,** affichage d’un sous domaine
   distant **:**

   Comme précédemment, ajouter la page à index_loc.php et jouter la page
   au menu

+-----------------------------------------------------------------------+
|    | <?php                                                            |
|    | session_start();                                                 |
|    | $domaine=$_SESSION["domaine"];                                   |
|    | if ($domaine==URLMONITOR) $lien_ID_MENU=NOM SOUS DOMAINE dans    |
|      config.php; if ($domaine==IPMONITOR) $lien_ID MENU=NOM IP dans   |
|      config.php;;                                                     |
|    | ?>                                                               |
|    | <!-- section TITRE start -->                                     |
|    | <!-- ================ -->                                        |
|    | <div id="ID du MENU" >                                           |
|    | <div class="container">                                          |
|    | <div class="col-md-12">                                          |
|    | <h1 id="about" class="title"                                     |
|      style="position:relative;top:-30px;">TITRE1 : <span              |
|      style="color:blue">TITRE2</span></h1>                            |
|    | <iframe id="ID de l’IFRAME" src="<?php echo $lien_IDMENU;?>"     |
|      frameborder="0" ></iframe>                                       |
|                                                                       |
|    | </div>                                                           |
|    | </div>                                                           |
|    | </div>                                                           |
|    | <!-- section TITRE fin-->                                        |
+=======================================================================+
+-----------------------------------------------------------------------+

.. image:: vertopal_6e277aed43794de08da7229da055806a/media/image903.png
   :width: 6.26806in
   :height: 3.40417in

   **16. 3 – Ajouter une alerte, une alarme,….**

**16.3.1 Exemple avec un rappel pour la prise de médicaments sur la page
d’accueil** - Télécharger une icones ou image svg

   .. image:: vertopal_6e277aed43794de08da7229da055806a/media/image904.png
      :width: 4.33333in
      :height: 2.75in

   | - Copies d’écran des pages concernées :
   | **Dans Domoticz :**
   | *Créer la variable*

   .. image:: vertopal_6e277aed43794de08da7229da055806a/media/image905.png
      :width: 5.99028in
      :height: 0.69861in

   *Dans le script maj_services :*

   .. image:: vertopal_6e277aed43794de08da7229da055806a/media/image906.png
      :width: 4.70833in
      :height: 0.74028in

   *Dans le script notifications_variables (pour une alerte sms)*

   .. image:: vertopal_6e277aed43794de08da7229da055806a/media/image907.png
      :width: 5.31389in
      :height: 1.6875in

   **Dans la base de données SQL :**

   *La table dispositifs et variables*

   .. image:: vertopal_6e277aed43794de08da7229da055806a/media/image908.png
      :width: 5.23056in
      :height: 2.02083in

   *La table text_image :*

   .. image:: vertopal_6e277aed43794de08da7229da055806a/media/image909.png
      :width: 4.5in
      :height: 0.50972in

   **Dans monitor :**

   *Accueil.php*

.. image:: vertopal_6e277aed43794de08da7229da055806a/media/image910.png
   :width: 6.30139in
   :height: 1.63889in

   *Les css :*

   .. image:: vertopal_6e277aed43794de08da7229da055806a/media/image911.png
      :width: 3.21944in
      :height: 0.9375in

   *Les scripts dans footer.php :*

   .. image:: vertopal_6e277aed43794de08da7229da055806a/media/image912.png
      :width: 6.3in
      :height: 4.35555in

   *Affichage :*

   .. image:: vertopal_6e277aed43794de08da7229da055806a/media/image913.png
      :width: 5.36944in
      :height: 3.97778in

**17. – DIY**

   **17. 1 – Domotiser un SPA (ou une piscine)**

| Ce paragraphe contient différentes parties qui peuvent être
  indépendantes ou liées suivant le choix de chacun :
| - La réalisation d’un boitier électronique de mesures de PH, Redox,
| Températures, Débit de la filtration, les mesures étant envoyées sur
  un serveur MQTT.

Cette réalisation est décrite sur le **site domo-site.fr**

- Création de capteurs virtuels dans Domoticz qui récupère les valeurs
envoyées par le serveur MQTT et les envoie vers la base de données de
Monitor ; il envoie également des alertes sur la TV comme pour les
poubelles et la fosse septique.

- Création d’une page dans Monitor pour afficher les données sur une
page dédiée, afficher des alertes et commander s’il y a lieu le
chauffage, les pompes ,….

   .. image:: vertopal_6e277aed43794de08da7229da055806a/media/image914.png
      :width: 3.95417in
      :height: 3.30139in

   **17.1.1. – Création de capteurs virtuels dans Domoticz** Pour
   mémoire, :

.. image:: vertopal_6e277aed43794de08da7229da055806a/media/image915.png
   :width: 5.90278in
   :height: 3.61667in

C’est Domoticz qui fournit l’IDX, il faut donc modifier cet IDX dans
EasyEsp ; Pour le PH, le redox, le débit, les capteurs sont « Custom.

.. image:: vertopal_6e277aed43794de08da7229da055806a/media/image916.png
   :width: 4.92639in
   :height: 2.74305in

Dans EasyEsp

.. image:: vertopal_6e277aed43794de08da7229da055806a/media/image917.png
   :width: 5.96806in
   :height: 0.89444in

   **17.1.2. – Création des tables PH, Redox, temp, .. ; dans la base de
   données** La commande SQL :

   Dans phpMyAdmin, il n’est pas possible de faire des copier/coller,
   aussi il faut enregistrer les lignes ci-dessous dans un fichier et
   l’importer pour éviter de taper toutes les lignes.

   **4 ou 5 caractères sont nécessaires pour la valeur (**\ *\ 5
   caractères reçu par Dz de MQTT , réduits à 4 avec round(deviceValue,
   1) dans le script lua\ *\ **).**

+-----------------------------------------------------------------------+
|    | CREATE TABLE \`ph_spa\` (                                        |
|    | \`num\` int(5) NOT NULL,                                         |
|    | \`date\` timestamp NOT NULL DEFAULT current_timestamp() ON       |
|      UPDATE                                                           |
|    | current_timestamp(),                                             |
|    | \`valeur\` varchar(5) NOT NULL                                   |
|    | ) ENGINE=InnoDB DEFAULT CHARSET=utf8;                            |
|    | ALTER TABLE \`debit_spa\` CHANGE \`num\` \`num\` INT(5) NOT NULL |
|      AUTO_INCREMENT, add PRIMARY KEY (`num`);                         |
+=======================================================================+
+-----------------------------------------------------------------------+

.. image:: vertopal_6e277aed43794de08da7229da055806a/media/image918.png
   :width: 5.71944in
   :height: 1.61528in

   Faire de même pour les autres tables , en remplaçant le nom de la
   table dans le fichier ; exemple : CREATE TABLE \`orp_spa\`

   .. image:: vertopal_6e277aed43794de08da7229da055806a/media/image919.png
      :width: 6.26806in
      :height: 2.08611in

   Si création manuelle , ne pas oublier Auto incrémenter « num » :

   .. image:: vertopal_6e277aed43794de08da7229da055806a/media/image920.png
      :width: 6.26806in
      :height: 1.01806in

   **17.1.3. – Envoi des données à la BD de monitor par Domoticz**

Le paragraphe 6.2 traite de ce sujet (envoie de températures issues de
capteurs réels ou virtuels).

Il suffit donc d’ajouter les données PH, Redox, etc…dans le script
export_sql dans Evènements de Domoticz :

   .. image:: vertopal_6e277aed43794de08da7229da055806a/media/image921.png
      :width: 6.26806in
      :height: 3.23611in

   *Pour rappel fabric appelle le script python sqlite_mysql.py de
   monitor* Les valeurs si dessous ne sont pas réelles, la sonde PH
   n’est pas branchée.

   .. image:: vertopal_6e277aed43794de08da7229da055806a/media/image922.png
      :width: 6.26806in
      :height: 3.71667in

   | **17.1.4. – Affichage dans Monitor**
   | Pour que Monitor reçoive les données, il faut enregistrer les
     capteurs dans la BD et les ajouter dans un plan dans Domoticz plan,
     voir les paragraphes *Prérequis* et *2.3* **17.1.4.1 la page
     spa.php**

+-----------------------------------------------------------------------+
|    | <!-- section SPA start -->                                       |
|    | <!-- ================ -->                                        |
|    | <div id="spa" class="spa">                                       |
|    | <div class="container">                                          |
|    | <div class="col-md-12"><p>                                       |
|    | <h1 class="title_ext text-center">SPA<span                       |
|      style="margin-left:20px;font-size: 20px;"> contrôle              |
|      qualité</span></h1><br>                                          |
|    | </p>                                                             |
|                                                                       |
|    | <?php include ("ph-redox_svg.php");?> </div>                     |
|    | </div>                                                           |
|                                                                       |
|    </div>                                                             |
|                                                                       |
|    | <script>                                                         |
|    | num_ecran=0;nb_ecran=<?php echo NB_ECRAN_SPA;?>; function        |
|      next_ecran(num_ec){                                              |
|    | num_actuel=num_ecran;num_ecran=num_ecran+num_ec; if              |
|      (num_ecran>=nb_ecran \|\| num_ecran<0) {num_ecran=0;}            |
|      div_suiv="ecran"+num_ecran;div_prec="ecran"+num_actuel;          |
|                                                                       |
|    | document.getElementById                                          |
| (div_prec).style.display="none";document.getElementById(div_suiv).sty |
|      le.display="block";                                              |
|    | var ecranspa=<?php echo '["' . implode('", "', ECRANSPA) . '"]'  |
|      ?>;                                                              |
|    | nbec=0;                                                          |
|    | while (nbec<=nb_ecran-2){//console.log(nbec+" ..                 |
|      "+ecranspa[nbec]);                                               |
|                                                                       |
|  | graph(ecranspa[nbec]+'_spa','text_svg','graphic_'+ecranspa[nbec]); |
|    | nbec++;                                                          |
|    | }                                                                |
|    | }                                                                |
|    | </script>                                                        |
+=======================================================================+
+-----------------------------------------------------------------------+

..

   .. image:: vertopal_6e277aed43794de08da7229da055806a/media/image923.png
      :width: 6.20833in
      :height: 4.69861in

   Explication de cette ligne :

+-----------------------------------------------------------------------+
|    var ecranspa=<?php echo '["' . implode('", "', ECRANSPA) . '"]'    |
|    ?>;                                                                |
+=======================================================================+
+-----------------------------------------------------------------------+

..

   *C’est la façon de passer un array PHP à une fonction JavaScript, une
   autre façon de faire : var ecranspa = <?php echo '["' . implode('",
   "', ECRANSPA) . '"]' ?>;*

   | La fonction graph de la page graphique est utilisée
   | Dans config.php : permet d’ajouter facilement une autre page ;

.. image:: vertopal_6e277aed43794de08da7229da055806a/media/image924.png
   :width: 5.32361in
   :height: 1.64583in

   Il suffira alors simplement d’ajouter cette page à l’image svg, voir
   le § *17.1.4.2* ajouter la page au menu et à index_loc.php, voir le
   paragraphe

   *16. – Ajouter des pages non incluses dans le programme*

   Dans header.php

   .. image:: vertopal_6e277aed43794de08da7229da055806a/media/image925.png
      :width: 6.26806in
      :height: 2.67639in

   Dans index_loc.php :

   .. image:: vertopal_6e277aed43794de08da7229da055806a/media/image926.png
      :width: 6.17778in
      :height: 0.97917in

   Ajout de l’ID « spa » dans le fichier des styles css :

   .. image:: vertopal_6e277aed43794de08da7229da055806a/media/image927.png
      :width: 6.26806in
      :height: 1.88611in

   L’image svg support de l’affichage :

+-----------------------------------------------------------------------+
|    | <svg version="1.1" id="mesures_spa"                              |
|      xmlns="http://www.w3.org/2000/svg"                               |
|    | xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px"       |
|    | viewBox="0 0 337 252" style="enable-background:new 0 0 337 252;" |
|      xml:space="preserve"> <style type="text/css">                    |
|    | .spa0{fill:#0000BF;}                                             |
|    | .spa1{fill:#00FFFF;}                                             |
|    | .spa2{font-family:'ArialMT';}                                    |
|    | .spa3{font-size:12px;}                                           |
|    | .spa4{letter-spacing:33;}                                        |
|    | .spa5{fill:#FFFF00;stroke:#000000;stroke-miterlimit:10;}         |
|    | .spa6{fill:#00FF00;}                                             |
|    | .spa7{fill:#3FA9F5;}                                             |
|    | .spa8{fill:#94FFFD;stroke:#000000;stroke-miterlimit:10;}         |
|    | .spa9{fill:#FEC9FF;}                                             |
+=======================================================================+
+-----------------------------------------------------------------------+

+-----------------------------------------------------------------------+
|    | .spa10{fill:#355CFF;}                                            |
|    | .spa11{fill:#FFFFFF;}                                            |
|    | .spa12{font-size:9px;}                                           |
|    | .spa13{font-size:15px;}                                          |
|    | .spa14{fill:#FFFB00;}                                            |
|                                                                       |
|    | </style>                                                         |
|    | <g>                                                              |
|    | <path class="spa0"                                               |
|      d="M10,247c-2.8,0-5-2.2-                                         |
| 5-5V10c0-2.8,2.2-5,5-5h317c2.8,0,5,2.2,5,5v232c0,2.8-2.2,5-5,5H10z"/> |
|    | <path class="spa0" d="M327,10v232H10V10H327                      |
|    | M327,0                                                           |
| H10C4.5,0,0,4.5,0,10v232c0,5.5,4.5,10,10,10h317c5.5,0,10-4.5,10-10V10 |
|    | C337,4.5,332.5,0,327,0L327,0z"/>                                 |
|    | </g>                                                             |
|    | <g id="ecran0">                                                  |
|    | <g>                                                              |
|    | <rect x="43" y="36.5" class="spa1" width="256.7"                 |
|      height="145.9"/>                                                 |
|    | <path d="M299,37.1V182H43.6V37.1H299                             |
|      M300.3,36h-258v147h258V36L300.3,36z"/>                           |
|    | </g>                                                             |
|    | <text transform="matrix(1 0 0 1 57 63)" class="spa2              |
|      spa3">PH</text>                                                  |
|    | <text transform="matrix(1 0 0 1 167 63)" class="spa2 spa3">      |
|      ORP</text>                                                       |
|    | <text transform="matrix(1 0 0 1 132.2758 83.6919)" class="spa2   |
|      spa3">Températures : </text>                                     |
|    | <text transform="matrix(1 0 0 1 83.5654 130.1042)" class="spa2   |
|      spa3 spa4"> </text>                                              |
|    | <text transform="matrix(1 0 0 1 172 104)" class="spa2 spa3">     |
|      Air</text>                                                       |
|    | <text transform="matrix(1 0 0 1 63.7774 150.1797)" class="spa2   |
|      spa3">Débit Filtration :</text>                                  |
|    | <rect x="80" y="47" class="spa5" width="72.2" height="21"/>      |
|    | <g>                                                              |
|    | <rect x="198.7" y="47.5" class="spa6" width="66.7" height="20"/> |
|    | <path d="M264.7,48v19h-65.4V48H264.7                             |
|      M266,47h-68v21h68V47L266,47z"/>                                  |
|    | </g>                                                             |
|    | <g>                                                              |
|    | <rect x="80.8" y="94" class="spa7" width="71" height="20"/>      |
|    | <path d="M151.1,94.5v19H81.3v-19H151.1                           |
|      M152.3,93.5H80.1v21h72.2L152.3,93.5L152.3,93.5z"/> </g>          |
|    | <rect x="198.2" y="91.5" class="spa8" width="67.8" height="21"/> |
|    | <g>                                                              |
|    | <rect x="155.6" y="136.6" class="spa9" width="61" height="20"/>  |
|    | <path d="M216.1,137.1v19h-60v-19H216.1                           |
|      M217.1,136.1h-62v21h62V136.1L217.1,136.1z"/> </g>                |
|    | <text id="acide" transform="matrix(1 0 0 1 84 62)" class="spa2   |
|      spa13">ph</text>                                                 |
|    | <text id="redox" transform="matrix(1 0 0 1 203 62)" class="spa2  |
|      spa13">orp</text>                                                |
|    | <text id="temp_eau" transform="matrix(1 0 0 1 90 107)"           |
|      class="spa2 spa13">temp1spa</text>                               |
|    | <text id="temp_air" transform="matrix(1 0 0 1 205 107)"          |
|      class="spa2 spa13">temp2spa</text>                               |
|    | <text id="debit" transform="matrix(1 0 0 1 160 150.1799)"        |
|      class="spa2 spa13">m3/h</text>                                   |
|    | <text transform="matrix(1.0326 0 0 1 54 107)" class="spa2        |
|      spa3">Eau </text>                                                |
|    | </g>                                                             |
|    | <g id="ecran1" style="display:none">                             |
|    | <rect x="43" y="36.5" class="spa14" width="256.7"                |
|      height="145.9"/>                                                 |
|                                                                       |
|    | <text transform="matrix(1 0 0 1 70 55)" class="spa2              |
|      spa3">Dernières Mesures de PH :</text> <g id="graphic_ph"        |
|      transform="matrix(1 0 0 1 70 65)" class="spa2 spa3"></g> </g>    |
|    | <g id="ecran2" style="display:none">                             |
|    | <rect x="43" y="36.5" class="spa6" width="256.7"                 |
|      height="145.9"/>                                                 |
|                                                                       |
|    | <text transform="matrix(1 0 0 1 70 55)" class="spa2              |
|      spa3">Dernières Mesures de Redox :</text> <g id="graphic_orp"    |
|      transform="matrix(1 0 0 1 70 65)" class="spa2 spa3"></g>         |
|    | </g>                                                             |
|    | <g id="ecran3" style="display:none">                             |
|    | <rect x="43" y="36.5" class="spa9" width="256.7"                 |
|      height="145.9"/>                                                 |
|                                                                       |
|    | <text transform="matrix(1 0 0 1 70 55)" class="spa2              |
|      spa3">Dernières Mesures de Débit :</text> <g id="graphic_debit"  |
|      transform="matrix(1 0 0 1 70 65)" class="spa2 spa3"></g>         |
|    | </g>                                                             |
|    | <g>                                                              |
+=======================================================================+
+-----------------------------------------------------------------------+

+-----------------------------------------------------------------------+
|    | <ellipse class="spa10" cx="169" cy="207" rx="49.5" ry="23.5"/>   |
|    | <path                                                            |
|      d="M169,184c13.2,0,25.6,2.5,34.9,6.9C2                           |
| 13,195.3,218,201,218,207s-5,11.7-14.1,16.1c-9.3,4.5-21.7,6.9-34.9,6.9 |
|    | s-25.6-2.5-34.9-6.9C125,218.7,120,213,120,207s5-11.7,14.1-       |
|    | 16.1C143.4,186.5,155.8,184,169,184                               |
|      M169,183c-27.6,0-50,10.7-50,24                                   |
|    | s22.4,24,50,24s50-10.7,50-24S196.6,183,169,183L169,183z"/>       |
|    | </g>                                                             |
|    | <g>                                                              |
|    | <g id="ecran_suivant_" xlink:href="#spa" onclick="next_ecran(1)" |
|      transform="matrix(0,-                                            |
|    | 1,1,0,28.57143,680.00001)">                                      |
|    | <path id="e_suiv"                                                |
|      d="M493,147.5c0,0.1-19.                                          |
| 5,39-19.5,39c-0.1-0.1-19.5-39-19.5-39s4.4,1.9,9.8,4.2l9.7,4.2l9.7-4.2 |
|    |                                                                  |
|  C488.5,149.3,492.9,147.4,493,147.5C493,147.4,493,147.4,493,147.5z"/> |
|      </g>                                                             |
|    | </g>                                                             |
|    | <g>                                                              |
|    | <g id="ecran_precedent_" xlink:href="#spa"                       |
|      onclick="next_ecran(-1)"                                         |
|      transform="matrix(0,-1,1,0,28.57143,680.00001)">                 |
|    | <path id="e_prec"                                                |
|      d="M493.4,134.2c0-0.1-19.                                        |
| 5-39-19.5-39c-0.1,0.1-19.5,39-19.5,39s4.4-1.9,9.8-4.2l9.7-4.2l9.7,4.2 |
|    | C489,                                                            |
| 132.4,493.4,134.3,493.4,134.2C493.4,134.3,493.4,134.2,493.4,134.2z"/> |
|      </g>                                                             |
|    | </g>                                                             |
|    | <text transform="matrix(1 0 0 1 41.4414 27.3308)" class="spa11   |
|      spa2 spa3">MESURE PH-REDOX-TEMPERATURES-DEBIT</text>             |
|    | <text transform="matrix(1 0 0 1 19.522 221.5869)" class="spa11   |
|      spa2 spa12">NodeMcu esp8266</text>                               |
|                                                                       |
|    </svg>                                                             |
+=======================================================================+
+-----------------------------------------------------------------------+

.. image:: vertopal_6e277aed43794de08da7229da055806a/media/image928.png
   :width: 6.26806in
   :height: 6.31944in

.. image:: vertopal_6e277aed43794de08da7229da055806a/media/image929.png
   :width: 6.26806in
   :height: 6.21667in

   .. image:: vertopal_6e277aed43794de08da7229da055806a/media/image930.png
      :width: 3.41667in
      :height: 3.125in

   Enregistrer les capteurs dans la table « dispositifs » :

   .. image:: vertopal_6e277aed43794de08da7229da055806a/media/image931.png
      :width: 5.96944in
      :height: 1.69861in

   Monitor reçoit :

   .. image:: vertopal_6e277aed43794de08da7229da055806a/media/image932.png
      :width: 5.74306in
      :height: 3.33333in

   La 1ère page :

   .. image:: vertopal_6e277aed43794de08da7229da055806a/media/image933.png
      :width: 5.05278in
      :height: 3.82361in

   **17.1.4.2 ajout d’un ID dans l’image svg pour le 2eme écran qui
   affichera les données de la BD**

   .. image:: vertopal_6e277aed43794de08da7229da055806a/media/image934.png
      :width: 5.04167in
      :height: 3.86528in

+-----------------------------------------------------------------------+
|    <g id="graphic_ph" transform="matrix(1 0 0 1 70 65)" class="spa2   |
|    spa3"></g>                                                         |
+=======================================================================+
+-----------------------------------------------------------------------+

..

   .. image:: vertopal_6e277aed43794de08da7229da055806a/media/image935.png
      :width: 6.26806in
      :height: 0.90278in

   **Les autres fichiers concernés :**

   - fonctions.php

   - export_tab_sqli.php

   .. image:: vertopal_6e277aed43794de08da7229da055806a/media/image936.png
      :width: 6.26806in
      :height: 2.70139in

   L’écran de mesure est petit , l’affichage est limité à 10 analyses ;
   pour un historique

   plus long , utiliser page graphique et « infos_bd »

L’image svg n’accepte pas les retours à la ligne <br> , pour chaque
ligne il faut définir

   un <text>…</text> ; le fichier fonctions.php est donc modifié en
   conséquence :

+-----------------------------------------------------------------------+
|    <text transform="matrix(1 0 0 1 0 '.$ccc.')" class="spa2           |
|    spa3">'.$xdate[$i].'='.$yvaleur[$i].'</text>                       |
+=======================================================================+
+-----------------------------------------------------------------------+

..

   .. image:: vertopal_6e277aed43794de08da7229da055806a/media/image937.png
      :width: 6.26806in
      :height: 0.88055in

   .. image:: vertopal_6e277aed43794de08da7229da055806a/media/image938.png
      :width: 6.26806in
      :height: 3.77778in

   - Les lignes non indispensables sont supprimées pour $periode= «
   text_svg »

   - Affichage de « connected : echo '<text transform="matrix(1 0 0 1 0
   0)"

class="spa2 spa3">Connected</text>';}

   **17.1.4.3 ajout d’un ID dans l’image svg pour 3eme écran**

   qui affichera les données Redox de la même façon que pour le PH
   ci-dessus

   .. image:: vertopal_6e277aed43794de08da7229da055806a/media/image939.png
      :width: 6.26806in
      :height: 0.39167in

   .. image:: vertopal_6e277aed43794de08da7229da055806a/media/image940.png
      :width: 4.12083in
      :height: 3.65972in

   | **17.1.4.4 ajout d’autres pages**
   | Mesure de la température de l’eau, de l’air, le débit de la
     filtration, ….

   | **Débit de la filtration :**
   | *Impulsion de débit : F(Hz)=(0.20xQ)-3%* *, Q=L/min F= 0,2 L/mn*
   | *dans EasyEsp les données envoyées sont :*

   .. image:: vertopal_6e277aed43794de08da7229da055806a/media/image941.png
      :width: 5.31389in
      :height: 1.14583in

   *Domoticz reçoit donc :*

   .. image:: vertopal_6e277aed43794de08da7229da055806a/media/image942.png
      :width: 4.25in
      :height: 0.53055in

   Pour envoyer à la BD uniquement le débit :

   .. image:: vertopal_6e277aed43794de08da7229da055806a/media/image943.png
      :width: 6.09444in
      :height: 3.75972in

   .. image:: vertopal_6e277aed43794de08da7229da055806a/media/image944.png
      :width: 6.26806in
      :height: 0.75278in

**Dans monitor**,

- ajout de la page à l’image svg :

.. image:: vertopal_6e277aed43794de08da7229da055806a/media/image945.png
   :width: 6.26806in
   :height: 1.90833in

   - Dans config.php

   .. image:: vertopal_6e277aed43794de08da7229da055806a/media/image946.png
      :width: 4.86389in
      :height: 1.46667in

   .. image:: vertopal_6e277aed43794de08da7229da055806a/media/image947.png
      :width: 3.85417in
      :height: 4.30556in

   Pour ajouter des températures :

   .. image:: vertopal_6e277aed43794de08da7229da055806a/media/image948.png
      :width: 5.03194in
      :height: 1.77083in

   .. image:: vertopal_6e277aed43794de08da7229da055806a/media/image949.png
      :width: 6.26806in
      :height: 1.51944in

+-----------------------------------------------------------------------+
|    Récupérer l'adresse du pool NTP de votre pays..                    |
+=======================================================================+
+-----------------------------------------------------------------------+

+-----------------------------------------------------------------------+
|    Pour cela nous allons nous rendre sur le site                      |
+=======================================================================+
+-----------------------------------------------------------------------+

..

   .. image:: vertopal_6e277aed43794de08da7229da055806a/media/image950.png
      :width: 5.52222in
      :height: 1.76111in

   .. image:: vertopal_6e277aed43794de08da7229da055806a/media/image951.png
      :width: 6.3in
      :height: 1.75139in

   Extension Pompes perisaltiques pour réguler PH et REDOX : Schéma de
   la partie « pompes »:

   .. image:: vertopal_6e277aed43794de08da7229da055806a/media/image952.png
      :width: 6.3in
      :height: 3.96944in

   .. image:: vertopal_6e277aed43794de08da7229da055806a/media/image953.png
      :width: 4.17778in
      :height: 4.29167in

   Flasher l’ESP avec ESP easy mega :

   .. image:: vertopal_6e277aed43794de08da7229da055806a/media/image954.png
      :width: 6.3in
      :height: 3.90972in

   .. image:: vertopal_6e277aed43794de08da7229da055806a/media/image955.png
      :width: 4.43889in
      :height: 7.04167in

Sur l’ESP qui assure les mesures , seul le GPIO 13 (D7) peut être
utilisé , d’où l’utilisation d’un 2eme ESP pour commander les 2 pompes
et plus …….

| Utilisation du plugin : le contrôleur - ESPEasy P2P Networking
| Ce protocole est spécifiquement destiné à être utilisé par les nœuds
  ESPeasy pour communiquer les uns avec les autres .

| Activer le contrôleur réseau p2p sur le nœud émetteur ; un contrôleur
  MQTT ne peut plus être utilisé sur ce nœud,
| Activer le contrôleur réseau p2p sur le nœud de réception, c’est à
  partir de ce nœud que les données MQTT pourront être envoyées.

| Concernant cette extension, il faut dupliquer l’envoi vers le serveur
  MQTT des données concernées (ESP « mesures » vers l’ESP « pompes »
| Exemple :

   .. image:: vertopal_6e277aed43794de08da7229da055806a/media/image956.png
      :width: 4.84444in
      :height: 5.72917in

**Calibration**

| Mesure Du PH
| Les bibliothèques Phidget peuvent convertir automatiquement la tension
  du capteur en pH en sélectionnant le type de capteur approprié.
  Consultez l’API Phidget22 pour plus de détails. Pour déterminer le pH
  d’une solution, assurez-vous que l’interrupteur DIP de la carte est
  retourné du côté du pH. Compte tenu de la tension du capteur, la
  formule suivante peut être appliquée :

   | pH
   | =
   | 3.56
   | ×
   | Tension
   | −
   | 1.889

   \\text{pH} = 3.56 \\times \\text{Voltage} - 1.889

   Cette formule (et la formule Phidget Library Sensor Value) suppose
   que la solution est à 25°C. En fonction de la température de la
   solution et du niveau de pH réel, la tension de sortie peut changer
   considérablement. Pour incorporer la température (en °C) pour plus de
   précision, la formule suivante peut être utilisée:

   | pH = 7
   | −
   | 2.5
   | −
   | Tension
   | 0.257179
   | +
   | 0.000941468
   | ×
   | Température

   \\text{pH = 7 }- \\frac{2.5 - \\text{Voltage}}{0.257179 + 0.000941468
   \\times \\text{Temperature}}

+-----------------------------------------------------------------------+
|    On plonge la sonde dans 2 solutions étalons.                       |
|                                                                       |
|    On obtient une valeur de l’espeasy exprimé en bits.                |
|                                                                       |
|    | Et la suite en essayant d’être simple :                          |
|    | Je vérifie le ph de ma solution étalon avec un petit ph de poche |
|      qui me donne un ph de 7. L'espeasy m'affiche une valeur de 822   |
|      bits.                                                            |
|                                                                       |
|    Je vérifie le ph de ma solution étalon avec un petit ph de poche   |
|    qui me donne un ph de 4. L'espeasy m'affiche une valeur de         |
|    580bits.                                                           |
+=======================================================================+
+-----------------------------------------------------------------------+

+-----------------------------------------------------------------------+
|    | Calcul:                                                          |
|    | y=ax+b y =ax a= y/x                                              |
|    | soit                                                             |
|    | y1=4                                                             |
|    | y2=7                                                             |
|    | x1=882                                                           |
|    | x2=580                                                           |
|    | a=(y2-y1)/(x2-x1)                                                |
|    | b=y-ax                                                           |
|    | soit                                                             |
|    | a=(7-4)/(882-580)=0,00993377(on arrondi car ca ne rentre pas     |
|      dans la formule espeasy)                                         |
|    | b=4-0,00993377*580=-1,7615866                                    |
|    | Voilà donc la formula que j’intègre dans espeasy pour avoir la   |
|      valeur du ph déjà convertie:                                     |
|    | %value%*0,00993377-1,7615866                                     |
+=======================================================================+
+-----------------------------------------------------------------------+

..

   .. image:: vertopal_6e277aed43794de08da7229da055806a/media/image957.png
      :width: 5.08889in
      :height: 4.22361in

   .. image:: vertopal_6e277aed43794de08da7229da055806a/media/image958.png
      :width: 4.96944in
      :height: 1.51111in

Tuto concernant le P2P

   Config pour l’ESP qui mesures le PH et le Redox :

   .. image:: vertopal_6e277aed43794de08da7229da055806a/media/image959.png
      :width: 4.65972in
      :height: 2.9375in

   Config pour l’ESP qui gère les pompes

   .. image:: vertopal_6e277aed43794de08da7229da055806a/media/image960.png
      :width: 5.04167in
      :height: 1.68056in

   | Port pour l’ UDP :
   | Sur les 2ESP,

   .. image:: vertopal_6e277aed43794de08da7229da055806a/media/image961.png
      :width: 4.84444in
      :height: 4.49028in

   .. image:: vertopal_6e277aed43794de08da7229da055806a/media/image962.png
      :width: 4.73056in
      :height: 1.05278in

L’ ESP « mesures_SPA » est l’esclave, il transmet les données et l’ESP «
Pompes » sera le maître , il reçoit les valeurs de PH et Redox , les
transmet par MQTT à Domoticz et avec ces données gère les pompes.

Dans l’esp « mesures_spa », et aussi dans «l’ESP « pompes » on ajoute un
contrôleur :

   .. image:: vertopal_6e277aed43794de08da7229da055806a/media/image963.png
      :width: 5.44861in
      :height: 2.41667in

   .. image:: vertopal_6e277aed43794de08da7229da055806a/media/image964.png
      :width: 6.3in
      :height: 2.99583in

   .. image:: vertopal_6e277aed43794de08da7229da055806a/media/image965.png
      :width: 6.3in
      :height: 3.10833in

   Dans l’ESP « mesures_spa » une ligne a été ajoutée, cocher la case
   concernant P2P

networking et décocher la case concernant MQTT

   .. image:: vertopal_6e277aed43794de08da7229da055806a/media/image966.png
      :width: 4.71944in
      :height: 3.78194in

   Rebooter les 2 contrôleurs :

   Dans « pompes, activer les capteurs Redox, PH, temp

   .. image:: vertopal_6e277aed43794de08da7229da055806a/media/image967.png
      :width: 6.33333in
      :height: 2.32222in

   .. image:: vertopal_6e277aed43794de08da7229da055806a/media/image968.png
      :width: 4.45972in
      :height: 4.82222in

   .. image:: vertopal_6e277aed43794de08da7229da055806a/media/image969.png
      :width: 6.3in
      :height: 2.28472in

   Les valeurs PH et Redox sont erronées, les sondes n’étant pas
   raccordées

| Jusqu’à présent nous ne mesurions que des valeurs, désormais nous
  allons gérer le PH, le Redox et la température.
| - 1 pompe pour PH+, réglé à 7.1
| - 1 pompe pour PH minus à 7.5

Le pH de l’eau de votre piscine doit se situer aux alentours de 7 pour
être correct. Le taux idéal admis est de 7,4.

| - pH trop élevé : acide sulfurique, acide chlorhydrique
| 1 centilitre d’acide à 20/22°C pour 1m3 fait descendre le pH de 0.3
  unités
| Débit pompe mini 90ml/mn soit 9cl/60 /s-→ 0.15cl/s ->2s de
  fonctionnement= 0.1 de PH , à vérifier
| Durée vie tube silicone : 200H

| - pH trop bas : Ajoutez du pH plus, contenant du carbonate et du
  bicarbonate de sodium ou de calcium. On le trouve sous forme liquide
| - 1 Une pompe pour ORP

   Le 1er relais 5V est raccordé au GPIO 12 (D6)

   .. image:: vertopal_6e277aed43794de08da7229da055806a/media/image970.png
      :width: 6.3in
      :height: 5.74722in

   .. image:: vertopal_6e277aed43794de08da7229da055806a/media/image971.png
      :width: 6.3in
      :height: 1.53611in

   Dans Domoticz :

   |image47| idx = 285

   Le 2eme relais pour PH moins :

   .. image:: vertopal_6e277aed43794de08da7229da055806a/media/image973.png
      :width: 5.35694in
      :height: 5.25833in

   .. image:: vertopal_6e277aed43794de08da7229da055806a/media/image974.png
      :width: 5.82361in
      :height: 1.58333in

   On créer également un switch virtuel dans Domoticz, ; cela permet de
   commander la pompe en manuel

   .. image:: vertopal_6e277aed43794de08da7229da055806a/media/image975.png
      :width: 4.01111in
      :height: 1.53055in

   | Le 3eme relais commande la pompe Redox
   | Pour régler le redox, on doit stabiliser le pH sur sa valeur idéale
     qui doit être comprise entre 7,2 et 7,4. Ensuite il faut régler le
     redox sur une valeur optimale entre 650 et 750mV environ. Cette
     valeur redox va permettre d’avoir une eau de piscine désinfectée et
     désinfectante.

+-----------------------------------+-----------------------------------+
| -                                 | Pour augmenter le redox : ajoutez |
|                                   | du chlore dans le bassin          |
+===================================+===================================+
| +------------------------------+  | Pour baisser le redox : Le        |
| | -                            |  | potentiel redox et le pH sont     |
| +==============================+  | très liés. Augmenter le pH        |
| +------------------------------+  |                                   |
+-----------------------------------+-----------------------------------+

..

   piscine fera diminuer le pouvoir désinfectant du chlore et ainsi
   baisser le redox de la piscine…. Une seule pompe pour le chlore
   suffit

   .. image:: vertopal_6e277aed43794de08da7229da055806a/media/image976.png
      :width: 5.14583in
      :height: 5.15278in

   .. image:: vertopal_6e277aed43794de08da7229da055806a/media/image977.png
      :width: 5.44861in
      :height: 1.52083in

   Dans Domoticz

   .. image:: vertopal_6e277aed43794de08da7229da055806a/media/image978.png
      :width: 4.20833in
      :height: 1.42778in

   On active les règles :

   .. image:: vertopal_6e277aed43794de08da7229da055806a/media/image979.png
      :width: 4.19861in
      :height: 2.57361in

   La règle :

   | on System#Boot do
   | gpio,12,0 // Prevent relay turning on during boot gpio,13,0
   | endon

   | On PH#Valeur Do
   | If [PH#Valeur] >7.5
   | GPIO,12,1
   | Else
   | gpio,12,0
   | Endif
   | If [PH#Valeur] <7.1
   | GPIO,14,1
   | Else
   | gpio,14,0
   | Endif
   | Endon

   | On ORP#Valeur Do
   | If [ORP#Valeur] <1
   | GPIO,13,1
   | Else
   | gpio,13,0
   | Endif
   | Endon

   Après création ou modification des Règles : REBOOT

   .. image:: vertopal_6e277aed43794de08da7229da055806a/media/image980.png
      :width: 4.01944in
      :height: 3.24028in

   .. image:: vertopal_6e277aed43794de08da7229da055806a/media/image981.png
      :width: 6.3in
      :height: 3.56528in

   | // ACQUISITION VALEUR pH
   | SondePH = analogRead(A0); // Enregistre la valeur de l'entrée
     analogique A0 dans la variable

   | // Calcul moyenne de la variable pH
   | totalpH = totalpH + SondePH; // Additionne la valeur à chaque cycle
     comptpH++; // Compte le nombre de cycles

   | if(comptpH == 300){ // Dès que la qté de cycle est atteinte (300
     afin de lisser les entrées hors normes)
   | moyennepH = totalpH / comptpH; // Calcul la moyenne
   | totalpH = SondePH; // Remet à zéro le compteur
   | comptpH = 1;
   | }

   | // Conversion pH
   | // pH = moyennepH / 73.07143; // converti la variable (Gain pour pH
     0 à 14) pH = 4 + moyennepH / 169.000; // converti la variable (Gain
     pour pH 4 à 10)

   a sonde ORP genere un signal -2V / +2V

   L'adaptateur le transforme en 0/5V.

   Pour avoir l'ORP il faut :

   ORP (V)=(2.5−Voltage)/1.037

   Ensuite je fais la convention ORP vers Cl (j'ai une regulation PH
   donc toujours à 7.4)

.. image:: vertopal_6e277aed43794de08da7229da055806a/media/image982.png
   :width: 6.46944in
   :height: 3.97361in

   ORPfreeclORPvpH.jpg (255.61 Kio) Consulté 18892 fois

   **18. - Divers**

   **18.1 Debian : Installer un serveur LAMP (Apache MySQL PHP)**

.. image:: vertopal_6e277aed43794de08da7229da055806a/media/image983.png
   :width: 1.73611in
   :height: 0.91667in

   **18.2 Installer Paho-mqtt**

.. image:: vertopal_6e277aed43794de08da7229da055806a/media/image984.png
   :width: 6.26806in
   :height: 2.20972in

   **18.2.1 Le script pour envoyer des messages (mqtt.py)**

+-----------------------------------------------------------------------+
|    | #!/usr/bin/env python3.7                                         |
|    | # -*- coding: utf-8 -*-                                          |
|                                                                       |
|    | import paho.mqtt.client as mqtt                                  |
|    | import json                                                      |
|    | import sys                                                       |
|    | # Variables et Arguments                                         |
|    | topic= str(sys.argv[1])                                          |
|    | etat= str(sys.argv[2])                                           |
|    | valeur= str(sys.argv[3])                                         |
|    | MQTT_HOST = "192.168.1.42"                                       |
|    | MQTT_PORT = 1883                                                 |
|    | MQTT_KEEPALIVE_INTERVAL = 45                                     |
|    | MQTT_TOPIC = topic                                               |
|                                                                       |
|    | MQTT_MSG=json.dumps({etat: valeur});                             |
|    | #                                                                |
|    | def on_publish(client, userdata, mid):                           |
|    | print ("Message Publié...")                                      |
|                                                                       |
|    | def on_connect(client, userdata, flags, rc):                     |
|    | client.subscribe(MQTT_TOPIC)                                     |
|    | client.publish(MQTT_TOPIC, MQTT_MSG)                             |
|                                                                       |
|    | def on_message(client, userdata, msg):                           |
|    | print(msg.topic)                                                 |
|    | print(msg.payload)                                               |
|    | payload = json.loads(msg.payload) # convertion en json           |
+=======================================================================+
+-----------------------------------------------------------------------+

+-----------------------------------------------------------------------+
|    | print(payload['state_l2'])                                       |
|    | client.disconnect()                                              |
|                                                                       |
|    | # Initialisation MQTT Client                                     |
|    | mqttc = mqtt.Client()                                            |
|                                                                       |
|    | # callback funRction                                             |
|    | mqttc.on_publish = on_publish                                    |
|    | mqttc.on_connect = on_connect                                    |
|    | mqttc.on_message = on_message                                    |
|                                                                       |
|    | # Connection avec le serveur MQTT                                |
|    | mqttc.connect(MQTT_HOST, MQTT_PORT, MQTT_KEEPALIVE_INTERVAL)     |
|                                                                       |
|    | # Loop forever                                                   |
|    | mqttc.loop_forever()                                             |
+=======================================================================+
+-----------------------------------------------------------------------+

..

   Pour être sûr que le fichier est au bon format (Unix) :

   .. image:: vertopal_6e277aed43794de08da7229da055806a/media/image985.png
      :width: 4.79306in
      :height: 0.41667in

**18.3 Liaison série Domoticz-PI**

   **Scripts dans Domoticz**

   Ils sont exécutés en dehors du conteneur si Domoticz est sous Docker.

   **ATTENTION** :La passerelle Zigbee 3.0 SonOff utilise le même driver
   série CP2102 -

   →donc pour /dev/serial/by-id = IDENTIQUE

   .. image:: vertopal_6e277aed43794de08da7229da055806a/media/image986.png
      :width: 6.26806in
      :height: 0.85972in

   **Script sms_dz.py**

+-----------------------------------------------------------------------+
|    | #!/usr/bin/env python3.9 -*- coding: utf-8 -*-                   |
|    | import requests , time ,json, os, chardet, shutil                |
|    | from periphery import Serial                                     |
|    | import importlib                                                 |
|    | import aldz as b                                                 |
|                                                                       |
|    | ser = Serial("/dev/ttyUSB1", 115200)                             |
|    | #ser = Serial("/dev/serial/by-id/usb-                            |
|                                                                       |
| | Silicon_Labs_CP2102_USB_to_UART_Bridge_Controller_0001-if00-port0", |
|      115200) def envoi_sms(message):                                  |
+=======================================================================+
+-----------------------------------------------------------------------+

+-----------------------------------------------------------------------+
|    | bmessage = message.encode('utf-8')                               |
|    | ser.write(bmessage)                                              |
|                                                                       |
|    | def com_dz(url):                                                 |
|    | response = requests.get(url)                                     |
|    | if response.status_code == 200:                                  |
|    | contenu = response.json()                                        |
|    | message = contenu['title']                                       |
|    | envoi_sms(message)                                               |
|    | else:                                                            |
|    | print('URL absente')                                             |
|    | envoi_sms('url_absente')                                         |
|    | def raz_dz():                                                    |
|    | src=r'/opt/domoticz/config/scripts/python/aldz.bak.py'           |
|      des=r'/opt/domoticz/config/scripts/python/aldz.py'               |
|      shutil.copy(src, des)                                            |
|                                                                       |
|    | print('start')                                                   |
|    | #effacer le tampon série pour supprimer le courrier indésirable  |
|      et le bruit ser.flush()                                          |
|    | while True:                                                      |
|    | b = importlib.reload(b)                                          |
|    | message=b.x                                                      |
|    | print(message)                                                   |
|    | if message != "0" :                                              |
|    | envoi_sms(message)                                               |
|    | raz_dz()                                                         |
|    | url = ser.read(128, 0.5).decode(errors='ignore')                 |
|    | if url:                                                          |
|    | print(url)                                                       |
|    | com_dz(url)                                                      |
|    | time.sleep(10)                                                   |
+=======================================================================+
+-----------------------------------------------------------------------+

..

   .. image:: vertopal_6e277aed43794de08da7229da055806a/media/image987.png
      :width: 6.26806in
      :height: 5.59167in

   Modifier si besoin le numéro de la variable et le port de domoticz

Le démarrage automatique est assuré par systemd , voir domo-site.fr page
70 (liaison

   série):

   aldz.py

   .. image:: vertopal_6e277aed43794de08da7229da055806a/media/image988.png
      :width: 4.87639in
      :height: 0.89583in

   aldz.bak.dz

   .. image:: vertopal_6e277aed43794de08da7229da055806a/media/image989.png
      :width: 4.29305in
      :height: 0.61528in

   **Scripts PI**

   rec_sms_serie.py

+-----------------------------------------------------------------------+
|    | *!/usr/bin/env python3.8*                                        |
|    | *# -*- coding: utf-8 -*-*                                        |
|                                                                       |
|    | *import time,serial,requests*                                    |
|    | *from periphery import Serial*                                   |
|    | *ip_domoticz="http://192.168.1.76:8086/"*                        |
|    | *se_domoticz=# voir IMPORTANT def convert_to_string(buf):*       |
|    | *try:*                                                           |
|    | *tt = buf.decode('utf-8').strip()*                               |
|    | *return tt*                                                      |
|    | *except UnicodeError:*                                           |
|    | *tmp = bytearray(buf)*                                           |
|    | *for i in range(len(tmp)):*                                      |
|    | *if tmp[i]>127:*                                                 |
|    | *tmp[i] = ord('?')*                                              |
|    | *return bytes(tmp).decode('utf-8').strip()*                      |
|                                                                       |
|    | *def not_reception(content):*                                    |
|    | *message =                                                       |
|      ('AT+SMSSEND=0670065886,'+content+'\\r\\n').encode('utf-8')      |
|      phone.write(b'+++')*                                             |
|    | *time.sleep(2)*                                                  |
|    | *phone.write(b'AT+VER\\r\\n')*                                   |
|    | *time.sleep(1)*                                                  |
|    | *phone.write(message)*                                           |
|    | *phone.write(b'AT+EXAT');*                                       |
|    | *time.sleep(1);*                                                 |
|                                                                       |
|    | *def ip_serie(ip_se,url):*                                       |
|    | *if ip_se == 1:*                                                 |
|    | *response = requests.get(url)*                                   |
|    | *contenu = response.json()*                                      |
|    | *if contenu['status']=="OK":*                                    |
|    | *content=contenu['title']*                                       |
|    | *else :*                                                         |
|    | *content="erreur"*                                               |
|    | *#print(content)*                                                |
|    | *not_reception(content)*                                         |
|    | *elif ip_se == 2:*                                               |
|    | *print("Connexion série")*                                       |
|    | *url=url.encode('utf-8')*                                        |
|    | *serie.write(url)*                                               |
|    | *time.sleep(1)*                                                  |
|    | *else:*                                                          |
|    | *print("erreur")*                                                |
|    | *not_reception("mauvais formatage")*                             |
|    | *phone =                                                         |
|      serial.Serial(port="/dev/ttyAMA1",baudrate=115200,timeout=2)     |
|      serie = Serial("/dev/ttyAMA2", 115200)*                          |
|    | *phone.close() #Cloture du port pour le cas ou il serait déjà    |
|      ouvert ailleurs phone.open() #Ouverture du port*                 |
|    | *phone.write(b'AT+EXAT');*                                       |
|    | *time.sleep(1);*                                                 |
|    | *while True:*                                                    |
|    | *line = phone.readline() # copie d’une ligne entiere jusqu’a \\n |
|      dans “line”* *print(line)*                                       |
+=======================================================================+
+-----------------------------------------------------------------------+

+-----------------------------------------------------------------------+
|    | *buf_dz = serie.read(128, 0.5)*                                  |
|    | *#print(buf_dz)*                                                 |
|    | *id="none"*                                                      |
|    | *value="none"*                                                   |
|    | *name="none"*                                                    |
|    | *if buf_dz:*                                                     |
|    | *buf_dz = convert_to_string(buf_dz)*                             |
|    | *not_reception(buf_dz)*                                          |
|    | *if line:*                                                       |
|    | *line = convert_to_string(line)*                                 |
|    | *#print(line) #pour essai*                                       |
|    | *params=line.split('#')*                                         |
|    | *if params[0] and (params[0]=='smsip' or params[0]=='smsse'):*   |
|    | *if params[0]=="smsip":*                                         |
|    | *domoticz=ip_domoticz*                                           |
|    | *ip_se=1*                                                        |
|    | *if params[0]=="smsse":*                                         |
|    | *domoticz=se_domoticz*                                           |
|    | *ip_se=2*                                                        |
|    | *if params[1]:*                                                  |
|    | *id = params[1]*                                                 |
|    | *if params[1]:*                                                  |
|    | *id = params[1]*                                                 |
|    | *#print('Id:'+id)*                                               |
|    | *if params[2]:*                                                  |
|    | *name = params[2]*                                               |
|    | *#print('name:'+name)*                                           |
|    | *if params[3]:*                                                  |
|    | *value = params[3]*                                              |
|    | *#print('valeur:'+value)*                                        |
|    | *if (id!="none" and name!="none" and value!="none"):*            |
|    | *if name == 'switch':*                                           |
|    | *url = domoticz+'json.htm?type=command&param=switchlight&idx$*   |
|      *else :*                                                         |
|    | *url = domoticz+'json.htm?type=command&param=updateuservaria$*   |
|      *else :*                                                         |
|    | *ip_se=""*                                                       |
|                                                                       |
|    *ip_serie(ip_se,url)*                                              |
+=======================================================================+
+-----------------------------------------------------------------------+

..

   .. image:: vertopal_6e277aed43794de08da7229da055806a/media/image990.png
      :width: 6.26806in
      :height: 6.21944in

   Utiliser localhost et non 127.0.0.1

   **IMPORTANT**

   Si ce massage en bash :

   .. image:: vertopal_6e277aed43794de08da7229da055806a/media/image991.png
      :width: 6.26806in
      :height: 1.91806in

   Ajouter login et mot de passe :

   .. image:: vertopal_6e277aed43794de08da7229da055806a/media/image992.png
      :width: 4.30278in
      :height: 0.94861in

   .. image:: vertopal_6e277aed43794de08da7229da055806a/media/image993.png
      :width: 6.26806in
      :height: 1.58889in

   start_rec_sms.sh

   .. image:: vertopal_6e277aed43794de08da7229da055806a/media/image994.png
      :width: 4.27222in
      :height: 0.66667in

   Démarrage auto avec systemd :

+-----------------------------------------------------------------------+
|    | [Unit]                                                           |
|    | Description=start rec sms pour Domoticz                          |
|                                                                       |
|    | [Service]                                                        |
|    | Type=simple                                                      |
|    | ExecStart=/home/michel/start_rec_sms.sh Restart=on-failure       |
|    | RestartSec=10                                                    |
|    | KillMode=process                                                 |
|                                                                       |
|    | [Install]                                                        |
|    | WantedBy=multi-user.target                                       |
+=======================================================================+
+-----------------------------------------------------------------------+

..

   .. image:: vertopal_6e277aed43794de08da7229da055806a/media/image995.png
      :width: 6.26806in
      :height: 2.91111in

   **18.4 Commandes de l’alarme à partir d’un GSM**

   Pour faciliter l’activation ou l’arrêt de l’alarme , il est facile
   d’ajouter des codes au

   script du paragraphe précédent 18.2

   Extrait de rec_sms_serie.py installé sur le PI qui assure le
   monitoring , les

   notifications GSM et les sauvegardes

+-----------------------------------------------------------------------+
|    | params=line.split('#')                                           |
|    | if params[0] and (params[0]=='smsip' or params[0]=='smsse' or    |
|      params[0]=='Alon' or params[0]=='Aloff'):                        |
|    | if params[0]=="smsip":                                           |
|    | domoticz=ip_domoticz                                             |
|    | ip_se=1                                                          |
|    | if params[0]=="smsse":                                           |
|    | domoticz=se_domoticz                                             |
|    | ip_se=2                                                          |
|    | if params[0]=="Alon":                                            |
|    | domoticz=ip_domoticz                                             |
|    | ip_se=1                                                          |
|    | params[1]= '41'                                                  |
|    | params[2]='switch'                                               |
|    | params[3]='On'                                                   |
|    | if params[0]=="Aloff":                                           |
|    | domoticz=ip_domoticz                                             |
|    | ip_se=1                                                          |
|    | params[1]= '41'                                                  |
|    | params[2]='switch'                                               |
|    | params[3]='Off'                                                  |
|    | if params[1]:                                                    |
|    | id = params[1]                                                   |
|    | print('Id:'+id)                                                  |
|    | if params[2]:                                                    |
+=======================================================================+
+-----------------------------------------------------------------------+

+-----------------------------------------------------------------------+
|    | name = params[2]                                                 |
|    | print('name:'+name)                                              |
|    | if params[3]:                                                    |
|    | value = params[3]                                                |
|    | print('valeur:'+value)                                           |
|    | if (id!="none" and name!="none" and value!="none"):              |
|    | if name == 'switch':                                             |
|    | url =                                                            |
|    | domoticz+                                                        |
| 'json.htm?type=command&param=switchlight&idx='+id+'&switchcmd='+value |
|      else :                                                           |
|    | url =                                                            |
|    | domoticz+                                                        |
| 'json.htm?type=command&param=updateuservariable&idx='+id+'&vname='+na |
|      me+'&vtype=2$                                                    |
|    | else :                                                           |
|    | ip_se=""                                                         |
|                                                                       |
|    ip_serie(ip_se,url)                                                |
+=======================================================================+
+-----------------------------------------------------------------------+

..

   .. image:: vertopal_6e277aed43794de08da7229da055806a/media/image996.png
      :width: 6.26806in
      :height: 4.33055in

   Le switch domoticz :

.. image:: vertopal_6e277aed43794de08da7229da055806a/media/image997.png
   :width: 5.29306in
   :height: 2.57361in

   **18.5 Données compteur Linky**

   Configuration après installation du plugin:

   .. image:: vertopal_6e277aed43794de08da7229da055806a/media/image998.png
      :width: 4.75833in
      :height: 5.21806in

   .. image:: vertopal_6e277aed43794de08da7229da055806a/media/image999.png
      :width: 6.26806in
      :height: 0.87917in

   Ne copier pas toute la ligne s’arrêter après le code

   ENEDIS

   .. image:: vertopal_6e277aed43794de08da7229da055806a/media/image1000.png
      :width: 6.20833in
      :height: 4.20833in

   .. image:: vertopal_6e277aed43794de08da7229da055806a/media/image1001.png
      :width: 6.26806in
      :height: 2.78194in

   Dans monitor :

   .. image:: vertopal_6e277aed43794de08da7229da055806a/media/image1002.png
      :width: 4.63611in
      :height: 5.71667in

   .. image:: vertopal_6e277aed43794de08da7229da055806a/media/image1003.png
      :width: 4.28194in
      :height: 5.29444in

   Les modifications dans Domoticz :

   .. image:: vertopal_6e277aed43794de08da7229da055806a/media/image1004.png
      :width: 6.20833in
      :height: 5.63611in

   .. image:: vertopal_6e277aed43794de08da7229da055806a/media/image1005.png
      :width: 4.00139in
      :height: 1.41667in

   Le compteur est ajouté au plan , les données sont disponibles pour
   monitor :

   Table dispositifs :création du dispositif

   .. image:: vertopal_6e277aed43794de08da7229da055806a/media/image1006.png
      :width: 6.26806in
      :height: 0.53889in

   Table energie : création de la table

   .. image:: vertopal_6e277aed43794de08da7229da055806a/media/image1007.png
      :width: 6.26806in
      :height: 1.68056in

   Fichier json reçu par domoticz :

   .. image:: vertopal_6e277aed43794de08da7229da055806a/media/image1008.png
      :width: 4.23055in
      :height: 4.78194in

   Les fichiers modifiés dans monitor :

   Interieur.php : création de l’image svg

   .. image:: vertopal_6e277aed43794de08da7229da055806a/media/image1009.png
      :width: 6.26806in
      :height: 3.57361in

   graphiques.php

   .. image:: vertopal_6e277aed43794de08da7229da055806a/media/image1010.png
      :width: 6.26806in
      :height: 1.15417in

**18.6 Complément sur l’utilisation des Mots de Passe cryptés dans
Domoticz** Une des solutions pour crypter et décrypter les mots de passe

*Codage* : https://www.base64encode.org/

.. image:: vertopal_6e277aed43794de08da7229da055806a/media/image1011.png
   :width: 6.17778in
   :height: 6.14583in

| **Décodage**
| *Extrait du script maj-services.lua*

+-----------------------------------------------------------------------+
|    | --                                                               |
|    | --[[                                                             |
|    | -- time                                                          |
|    | name : maj_services.lua                                          |
|                                                                       |
|    | ce script à pour but de déterminer si nous sommes en semaine     |
|      pair ou impair et fonction de cela, le jeudi en fin d'après      |
|      midi,                                                            |
|    | de nous alerter par SMS , par notifiction TV de sortir la        |
|      poubelle concernée, de gérer la fosse septique et les            |
|      anniversaires.                                                   |
|                                                                       |
|    | -- les variables Domoticz A CREER                                |
|    | -- variables 'chaine': poubelles="0" , fosse_septique="0"        |
|      ,anniversaires ,not_tv_fosse="0" , not_tv_poubelle="0"           |
|    | --                                                               |
|      ------------------------                                         |
| --------------------------------------------------------------------- |
+=======================================================================+
+-----------------------------------------------------------------------+

+-----------------------------------------------------------------------+
|    | la 1ere semaine est celle ayant au moins 4 jours sur la nouvelle |
|      année                                                            |
|    | --]]                                                             |
|    | -- Get day of a week at year beginning                           |
|    | --(tm can be any date and will be forced to 1st of january same  |
|      year)                                                            |
|    | -- return 1=mon 7=sun                                            |
|    | --                                                               |
|    | -- chargement fichier contenant les variables de configuration   |
|    | package.path = package.path..";www/modules_lua/?.lua"            |
|    | require 'string_tableaux'                                        |
|    | require 'connect'                                                |
|    | local base64 = require'base64'                                   |
|    | local user_free = base64.decode(login_free);local passe_free =   |
|      base64.decode(pass_free); local sms_free="curl --insecure        |
|      'https://smsapi.free-                                            |
|    | mobil                                                            |
| e.fr/sendmsg?user="..user_free.."&pass="..passe_free.."&msg=poubelle' |
|      >> /home/michel/OsExecute.log 2>&1"                              |
+=======================================================================+
+-----------------------------------------------------------------------+

.. image:: vertopal_6e277aed43794de08da7229da055806a/media/image1012.png
   :width: 7.20833in
   :height: 1.46111in

Le fichier connect.lua :

.. image:: vertopal_6e277aed43794de08da7229da055806a/media/image1013.png
   :width: 3.45972in
   :height: 0.69861in

notification_devices : base64 pour login et mot de passe

.. image:: vertopal_6e277aed43794de08da7229da055806a/media/image1014.png
   :width: 6.26806in
   :height: 2.44306in

**18.7 pages sans rapport avec la domotique**

   **18.7.1 Les recettes de cuisines sur la tablette domotique**

.. image:: vertopal_6e277aed43794de08da7229da055806a/media/image1015.png
   :width: 4.8125in
   :height: 5.34167in

   Comme pour chaque ajout de page , il faut modifier les fichiers :

+-----------------------------------+-----------------------------------+
|    | -                            |    | mes.css.css                  |
|    | -                            |    | config.php                   |
|    | -                            |    | index_loc.php                |
|    | -                            |    | header.php                   |
+===================================+===================================+
+-----------------------------------+-----------------------------------+

..

   et parfois le fichierbib-Slide.js , si l’on doit modifier la largeur
   du menu

   .. image:: vertopal_6e277aed43794de08da7229da055806a/media/image1016.png
      :width: 2.90556in
      :height: 2.49028in

   le fichier recettes.php :

   .. image:: vertopal_6e277aed43794de08da7229da055806a/media/image1017.png
      :width: 6.3in
      :height: 2.56944in

   .. image:: vertopal_6e277aed43794de08da7229da055806a/media/image1018.png
      :width: 6.3in
      :height: 2.28055in

   Dans fonctions.php :

   .. image:: vertopal_6e277aed43794de08da7229da055806a/media/image1019.png
      :width: 6.3in
      :height: 6.575in

   La page avec 2 recettes :

   .. image:: vertopal_6e277aed43794de08da7229da055806a/media/image1020.png
      :width: 5.56111in
      :height: 3.57361in

   Exemple de page recette

   .. image:: vertopal_6e277aed43794de08da7229da055806a/media/image1021.png
      :width: 6.3in
      :height: 2.01944in

   **18.8 migration de Domoticz différentes étapes pour ne rien
   oublier**

   Exemple migration vers Docker.

   - **Modifier les IP/PORT** de Domoticz, Zwavejs2mqtt,
   Zigbee2mqtt,…dans le fichier de configuration de monitor.

   | - **Pour les scripts externes non gérés dans le conteneur
     Domoticz** ,installer les versions de python, node, … nécessaires,
     et les dépendances nécessaires ;par exemple pour la
   | communication série de Domoticz , l’installation de
     python-periphery , le démarrage auto sur systemd ,…. Si l’API de
     Domoticz est utilisée dans ces scripts , modifier le Port de
     Domoticz

   **Pour VOIP asterisk,** modifier ip de domoticz pour la capture
   d’image (portier) ; pour appeler json de Domoticz depuis Docker,
   autoriser dans les paramètres de Domoticz le réseau 172.*.*.\*

   - **Pour le monitoring Nagios**, il faut indiquer les IP/PORT qui
   sont modifiés et les noms des VM

   Proxmox si Proxmox est utilisé.

   - **Si une nouvelle page doit être ajoutée à monitor**, par exemple
   pour Zwave (OZW n’étant plus

   maintenu) : créer le sous-domaine pour l’accès distant et le
   certificat pour HTTPS

   (Letsencrypt-cerbot)

   - **Les dispositifs sont souvent difficiles à réveiller**, s’ils sont
   réinstallés, modifier l’ID de

   Domoticz dans la base de données de monitor

**19. – UPDATE PHP 8.2**

Fichiers concernés:

.. image:: vertopal_6e277aed43794de08da7229da055806a/media/image1022.png
   :width: 1.92778in
   :height: 1.96944in

Changement de version jpgraph

Dossier include :

.. image:: vertopal_6e277aed43794de08da7229da055806a/media/image1023.png
   :width: 2.27222in
   :height: 5.02083in

Principale modification : concerne les sessions

**20. – Résolution de problèmes**

| **20.1 concernant les variables :**
| L’idx ou l’ID indiqué dans MySQL (table dispositifs) ne correspond pas
  avec celui de Domoticz HA

.. image:: vertopal_6e277aed43794de08da7229da055806a/media/image1024.png
   :width: 3.71944in
   :height: 2.57361in

Vérifier avec F12 du navigateur ->réseau le json renvoyé : exist_id doit
être « oui »

.. image:: vertopal_6e277aed43794de08da7229da055806a/media/image1025.png
   :width: 3.32361in
   :height: 1.97917in

**21. – Mon installation**

.. image:: vertopal_6e277aed43794de08da7229da055806a/media/image1026.png
   :width: 6.30139in
   :height: 7.875in

   **21.1 Proxmox**

   C’est la base du système, il doit être installé en premier, ensuite :

+-----------------------------------+-----------------------------------+
|    | -                            |    | Un conteneur, une VM ou une  |
|    | -                            |      partition classique Ensuite  |
|    | -                            |      LEMP                         |
|                                   |    | En dernier et monitor        |
+===================================+===================================+
+-----------------------------------+-----------------------------------+

..

   Installation de Proxmox : assurez-vous que la virtualisation UEFI est
   activée dans le BIOS

+-----------------------------------------------------------------------+
|    Pour terminer le processus de post-installation de Proxmox VE      |
|    7(évite de modifier manuellement les fichiers sources.list d’apt,) |
|    vous pouvez exécuter la commande suivante dans pve Shell.          |
+=======================================================================+
+-----------------------------------------------------------------------+

+-----------------------------------------------------------------------+
|    bash -c "$(wget -qLO -                                             |
+=======================================================================+
+-----------------------------------------------------------------------+

+-----------------------------------------------------------------------+
|                                                                       |
|  https://github.com/tteck/Proxmox/raw/main/misc/post-pve-install.sh)" |
+=======================================================================+
+-----------------------------------------------------------------------+

..

   voir sur Github : https://github.com/StevenSeifried/proxmox-scripts

+-----------------------------------+-----------------------------------+
|    | -                            |    *https://github.co             |
|    | -                            | m/StevenSeifried/proxmox-scripts* |
+===================================+===================================+
+-----------------------------------+-----------------------------------+

..

   .. image:: vertopal_6e277aed43794de08da7229da055806a/media/image1027.png
      :width: 4.42639in
      :height: 2.52083in

   **21.1.1 installation de VM ou CT par l’interface graphique : IP
   :8006**

.. image:: vertopal_6e277aed43794de08da7229da055806a/media/image1028.png
   :width: 6.30139in
   :height: 2.05417in

   **21.1.2 installation automatique de VM ou CT** :

   choisir le fichier d’installation : ex Conteneur LXC Debian 11

   .. image:: vertopal_6e277aed43794de08da7229da055806a/media/image1029.png
      :width: 2.77222in
      :height: 1.76111in

   Copier le lien :

   .. image:: vertopal_6e277aed43794de08da7229da055806a/media/image1030.png
      :width: 3.16667in
      :height: 2.07361in

   Ici :

   Télécharger le script : wget LIEN

   .. image:: vertopal_6e277aed43794de08da7229da055806a/media/image1031.png
      :width: 6.3in
      :height: 0.34444in

   Modifier les droits du fichier :

   .. image:: vertopal_6e277aed43794de08da7229da055806a/media/image1032.png
      :width: 3.27222in
      :height: 0.35417in

   Lancer le script et répondre aux questions :

   .. image:: vertopal_6e277aed43794de08da7229da055806a/media/image1033.png
      :width: 4.86944in
      :height: 6.25in

   | **21.1.3 installation automatique d’un conteneur LXC,LEMP &
     Monitor** Voir le *§ 0.1.1*
   | **21.1.4 Aperçu des VM et CT installés** :

.. image:: vertopal_6e277aed43794de08da7229da055806a/media/image1034.png
   :width: 3.19861in
   :height: 3.59444in

Plex est installé sur un autre mini PC sous Proxmox également, en
conteneur, voir le site domo-site.fr

| **21.2 Domoticz**
| Installation sous Docker :
| Installation VM :

Mes scripts lua :

.. image:: vertopal_6e277aed43794de08da7229da055806a/media/image1035.png
   :width: 3.19861in
   :height: 3.07222in

Mes scripts bash, python et Node js :

.. image:: vertopal_6e277aed43794de08da7229da055806a/media/image1036.png
   :width: 4.18889in
   :height: 3.63611in

.. image:: vertopal_6e277aed43794de08da7229da055806a/media/image1037.png
   :width: 4.27222in
   :height: 3.19722in

.. image:: vertopal_6e277aed43794de08da7229da055806a/media/image1038.png
   :width: 4.34444in
   :height: 1.76111in

Les scripts sont disponibles sur Github :

   | **21.3 Zwave**
   | Installation de zwave-js-ui ,

+-----------------------------------+-----------------------------------+
| -                                 |    dans un conteneur LXC :        |
+===================================+===================================+
| -                                 |    sous Docker, avec Domoticz :   |
|                                   |    *http://                       |
|                                   | domo-site.fr/accueil/dossiers/86* |
+-----------------------------------+-----------------------------------+

..

   Affichage dans monitor :

   .. image:: vertopal_6e277aed43794de08da7229da055806a/media/image1039.png
      :width: 4.85139in
      :height: 5.58056in

   Configuration de l’hôte virtuel Nginx pour affichage dans monitor :

.. image:: vertopal_6e277aed43794de08da7229da055806a/media/image1040.png
   :width: 4.02222in
   :height: 3.03194in

   .. image:: vertopal_6e277aed43794de08da7229da055806a/media/image1041.png
      :width: 5.55556in
      :height: 6.70694in

   | **21.4 Zigbee**
   | Installation de zigbee2mqtt :

+-----------------------------------+-----------------------------------+
|    | -                            |    | sous Docker :                |
|    | -                            |    | dans un conteneur LXC :      |
+===================================+===================================+
+-----------------------------------+-----------------------------------+

..

   Affichage dans monitor :

.. image:: vertopal_6e277aed43794de08da7229da055806a/media/image1042.png
   :width: 4.93889in
   :height: 4.97778in

Configuration de l’hôte virtuel Nginx pour affichage dans monitor :

.. image:: vertopal_6e277aed43794de08da7229da055806a/media/image1043.png
   :width: 5.36806in
   :height: 6in

Plus de commentaires dans le paragraphe précédent

| **21.5 Asterisk (sip)**
| Installation dans une VM :

Il n’est pas utile de créer un hôte virtuel sur Nginx, les
modifications, mises à jour,…peuvent se faire sur Proxmox.

| **21.6 MQTT (mosquito)**
| Installation dans une VM :

Comme pour Asterisk , il n’est pas utile de créer un hôte virtuel.

| **21.7 Zoneminder**
| Installation dans une VM :

   Ce serveur est nécessaire pour :

+-----------------------------------+-----------------------------------+
|    | -                            |    | L’affichage du mur de        |
|    | -                            |      caméras                      |
|                                   |    | La détection (mode modect)   |
|                                   |      de présence pour l’alarme    |
+===================================+===================================+
+-----------------------------------+-----------------------------------+

..

   .. image:: vertopal_6e277aed43794de08da7229da055806a/media/image1044.png
      :width: 4.84861in
      :height: 6.13472in

   Configuration de l’hôte virtuel Nginx

   .. image:: vertopal_6e277aed43794de08da7229da055806a/media/image1045.png
      :width: 4.98194in
      :height: 5.14583in

| **21.8 Plex**
| Installation :

+-----------------------------------+-----------------------------------+
| -                                 |    dans un conteneur LXC :        |
+===================================+===================================+
| -                                 |    dans une VM :                  |
+-----------------------------------+-----------------------------------+

..

   partage samba pour Plex (conteneur LXC) :

   affichage dans un navigateur ou TV **: IP :32400/web**

.. image:: vertopal_6e277aed43794de08da7229da055806a/media/image1046.png
   :width: 6.30139in
   :height: 4.77917in

Configuration de l’hôte virtuel Nginx pour accès distant

.. image:: vertopal_6e277aed43794de08da7229da055806a/media/image1047.png
   :width: 5.21806in
   :height: 4.62361in

| **21.9 Raspberry PI4**
| Alimenté en 12 Volts , comme le mini PC Proxmox, le PI4 couplé à un
  modem GSM assure l’envoi et la réception des sms même en cas de
  coupure d’alimentation électrique ENEDIS ; L’alarme ainsi que toute
  les commandes Domoticz restent opérationnelles.

| Le serveur Domoticz et ce PI4 sont reliés par une liaison série ; à
  partir d’un smartphone l’envoi de sms permet de commander directement
  des switches par l’intermédiaire de l’API de Domoticz(
| Le système est sauvegardé par le logiciel Raspibackup :

   .. image:: vertopal_6e277aed43794de08da7229da055806a/media/image1048.png
      :width: 6.25in
      :height: 4.01111in

   Le PI4 assure aussi :

+-----------------------------------+-----------------------------------+
| -                                 |    La sauvegarde RAID1, mais      |
|                                   |    celle-ci n’est pas sauvegardée |
|                                   |    et un reboot du PI est         |
+===================================+===================================+
+-----------------------------------+-----------------------------------+

..

   nécessaire en cas de coupure de courant ; une fonction existe, pour
   cela, dans

   monitor…..

+-----------------------------------+-----------------------------------+
|    -                              |    Le monitoring (Nagios) :       |
|                                   |    *http://                       |
|                                   | domo-site.fr/accueil/dossiers/71* |
+===================================+===================================+
+-----------------------------------+-----------------------------------+

..

   Conf Nginx :

   .. image:: vertopal_6e277aed43794de08da7229da055806a/media/image1049.png
      :width: 4.70694in
      :height: 5.54028in

Installation du système et du raid1 :

Scripts installés en plus de raspibackup et Nagios :

   .. image:: vertopal_6e277aed43794de08da7229da055806a/media/image1050.png
      :width: 4.11528in
      :height: 4.07361in

+-----------------------------------+-----------------------------------+
| -                                 |    msmtp , pour envoyer des       |
|                                   |    emails facilement              |
+===================================+===================================+
+-----------------------------------+-----------------------------------+

..

   config :

   .. image:: vertopal_6e277aed43794de08da7229da055806a/media/image1051.png
      :width: 2.88472in
      :height: 4.07222in

   Affichage dans monitor :

.. image:: vertopal_6e277aed43794de08da7229da055806a/media/image1052.png
   :width: 4.40694in
   :height: 4.54861in

   **21.9.1 Résolution de problèmes :**

**21.9.1.1 cannot-open-access-to-console-the-root-account-is-locked**

Si votre Raspberry Pi (RPI) ne démarre pas et affiche "Impossible
d'ouvrir l'accès à la console, le compte root est verrouillé sur l'écran
de démarrage :

**Mode d’emploi pour revenir à la situation normale**

/etc/fstab à certainement une entrée non prise en charge. C’est ce qui
se passe si un disque USB externe est déconnecté ou remplacé

Pour résoudre ce problème, sortez la carte SD ou la clé USB du PI et
branchez-la sur votre ordinateur. Ignorez les demandes de formatage et
explorer la partition « boot » .

Ouvrir le fichier appelé cmdline.txt dans le Bloc-notes ou Notepad et
ajouter **init=/bin/sh**\ à la fin de la première ligne .

.. image:: vertopal_6e277aed43794de08da7229da055806a/media/image1053.png
   :width: 5.58472in
   :height: 0.38472in

Enregistrez le fichier et remettez la carte SD ou la clé USB dans le PI
et bootez. Un clavier et un écran sont raccordés au PI ; sur l’écran on
peut alors constater qu’une console en bash est alors disponible pour
effectuer des modification sur le fichier /etc/fstab.

sudo nano /etc/fstab

.. image:: vertopal_6e277aed43794de08da7229da055806a/media/image1054.png
   :width: 6.30139in
   :height: 1.50417in

   | Commenter ou supprimer la ligne défectueuse
   | Enregistrer le fichier, CTRL O, ENTER, CTRL X
   | Eteindre le PI, retirer la carte SD ou la clé USB pour supprimer
     init=/bin/sh du fichier cmdline.txt Redémarrer le Pi

   S’il n’est pas possible de modifier /etc/fstab (écriture non
   autorisée), il faut alors remonter la partition (/dev/sda2 pour une
   clé USB ou /dev/ mmcblk0p2 pour une SD Card).

   La commande à effectuer :

   mount -o remount,rw /partition root /

   .. image:: vertopal_6e277aed43794de08da7229da055806a/media/image1055.png
      :width: 4.85556in
      :height: 0.29167in

   pour monter les partitions sans redémarrer :

   .. image:: vertopal_6e277aed43794de08da7229da055806a/media/image1056.png
      :width: 2.94861in
      :height: 0.32222in

   **21.10 Home Assistant**

   Installation :

   Script automatique :

   bash -c "$(wget -qLO -
   https://github.com/tteck/Proxmox/raw/main/vm/haos-vm-v5.sh)"

.. image:: vertopal_6e277aed43794de08da7229da055806a/media/image1057.png
   :width: 6.30139in
   :height: 2.78611in

.. image:: vertopal_6e277aed43794de08da7229da055806a/media/image1058.png
   :width: 6.16667in
   :height: 2.34444in

.. image:: vertopal_6e277aed43794de08da7229da055806a/media/image1059.png
   :width: 6.30139in
   :height: 3.22222in

.. image:: vertopal_6e277aed43794de08da7229da055806a/media/image1060.png
   :width: 3.09444in
   :height: 2.15556in

.. image:: vertopal_6e277aed43794de08da7229da055806a/media/image1061.png
   :width: 6.30139in
   :height: 3.64167in

.. image:: vertopal_6e277aed43794de08da7229da055806a/media/image1062.png
   :width: 2.59444in
   :height: 2.1875in

.. image:: vertopal_6e277aed43794de08da7229da055806a/media/image1063.png
   :width: 5.37639in
   :height: 2.78056in

   **22. – OPTIMISATION à réaliser**

+-----------------------------------+-----------------------------------+
| -                                 |    Reset à distance du modem GSM  |
|                                   |    ( 1 Bug en 2 ans !!!)          |
+===================================+===================================+
+-----------------------------------+-----------------------------------+

..

   **Simple programme de commande de relais USB LCUS_1**

   #!/usr/bin/bash

   | echo "Entrer une commande : ON ou OFF "
   | read COMMANDE
   | if [ "$COMMANDE" = "ON" ] ; then cmd='\\xA0\\x01\\x01\\xA2' fi
   | if [ "$COMMANDE" = "OFF" ] ; then cmd='\\xA0\\x01\\x01\\xA2'; fi
   | serdev="/dev/ttyUSB0"

   | echo 'open door'
   | /bin/bash -c "echo -n -e '$cmd' > $serdev"

   Retour d’info avec GPIO du RPI

.. image:: vertopal_6e277aed43794de08da7229da055806a/media/image1064.png
   :width: 6.30139in
   :height: 3.11389in

   programme python

   pip install RPi.GPIO

+-----------------------------------------------------------------------+
|    | # Import des modules                                             |
|    | import RPi.GPIO as GPIO                                          |
|    | import time                                                      |
+=======================================================================+
+-----------------------------------------------------------------------+

..

   import envoi_sms.py

+-----------------------------------------------------------------------+
|    | # Initialisation de la numerotation et des E/S                   |
|      GPIO.setmode(GPIO.BCM)                                           |
|    | # numerotation de la sérigraphie : (GPIO.BOARD)                  |
+=======================================================================+
+-----------------------------------------------------------------------+

..

   GPIO.setup(19, GPIO.IN)

+-----------------------------------------------------------------------+
|    | # Si on detecte un appui sur le bouton, on allume la LED # et on |
|      attend que le bouton soit relache                                |
|    | whileTrue:                                                       |
+=======================================================================+
+-----------------------------------------------------------------------+

..

   | state = GPIO.(19)
   | ifnot state:

+-----------------------------------------------------------------------+
|    | # on a appuye sur le bouton connecte sur la broche 19            |
|      exec(open("envoi_sms.py 0Volts").read())                         |
|    | whilenot state:                                                  |
+=======================================================================+
+-----------------------------------------------------------------------+

..

   | state = GPIO.(19)
   | time.sleep(0.02) # Pause pour ne pas saturer le processeur

+-----------------------------------------------------------------------+
|    | exec(open("envoi_sms.py 12Volts").read())                        |
|    | time.sleep(0.02) # Pause pour ne pas saturer le processeur       |
+=======================================================================+
+-----------------------------------------------------------------------+

.. |image1| image:: media/image1.png
   :width: 0.27917in
   :height: 0.27917in
.. |image2| image:: media/image2.png
   :width: 0.64583in
   :height: 0.61389in
.. |image3| image:: media/image82.png
   :width: 3.08333in
   :height: 0.30139in
.. |image4| image:: media/image177.png
   :width: 0.6875in
   :height: 0.61389in
.. |image5| image:: media/image259.png
   :width: 0.54306in
   :height: 0.11389in
.. |image6| image:: media/image259.png
   :width: 0.54167in
   :height: 0.11389in
.. |image7| image:: media/image261.png
   :width: 1.78194in
   :height: 1.75972in
.. |image8| image:: media/image274.png
   :width: 1.98056in
   :height: 2.36389in
.. |image9| image:: media/image275.png
   :width: 3.88194in
   :height: 1.72083in
.. |image10| image:: media/image333.png
   :width: 1.84444in
   :height: 1.59306in
.. |image11| image:: media/image334.png
   :width: 3.28056in
   :height: 0.82222in
.. |image12| image:: media/image336.png
   :width: 6.26111in
   :height: 4.0625in
.. |image13| image:: media/image351.png
   :width: 0.96805in
   :height: 0.375in
.. |image14| image:: media/image382.png
   :width: 0.97361in
   :height: 0.81111in
.. |image15| image:: media/image383.png
   :width: 0.97083in
   :height: 0.91528in
.. |image16| image:: media/image384.png
   :width: 0.96805in
   :height: 1.29167in
.. |image17| image:: media/image445.png
   :width: 1.54306in
   :height: 1.6875in
.. |image18| image:: media/image471.png
   :width: 1.125in
   :height: 1.53055in
.. |image19| image:: media/image481.png
   :width: 2.46389in
   :height: 1.41528in
.. |image20| image:: media/image482.png
   :width: 3.24028in
   :height: 1.19861in
.. |image21| image:: media/image526.png
   :width: 2.1875in
   :height: 0.24028in
.. |image22| image:: media/image527.png
   :width: 3.50972in
   :height: 0.27083in
.. |image23| image:: media/image614.png
   :width: 0.52083in
   :height: 0.67778in
.. |image24| image:: media/image721.png
   :width: 0.89306in
   :height: 0.9666in
.. |image25| image:: media/image722.png
   :width: 0.89583in
   :height: 0.96875in
.. |image26| image:: media/image723.png
   :width: 6.5in
   :height: 0.29081in
.. |image27| image:: media/image724.png
   :width: 6.34722in
   :height: 9.5in
.. |image28| image:: media/image725.png
   :width: 6.49583in
   :height: 4.36944in
.. |image29| image:: media/image729.png
   :width: 6.30139in
   :height: 2.82222in
.. |image30| image:: media/image730.png
   :width: 6.49583in
   :height: 1.27917in
.. |image31| image:: media/image738.png
   :width: 6.26806in
   :height: 3.55556in
.. |image32| image:: media/image744.png
   :width: 6.26806in
   :height: 1.80694in
.. |image33| image:: media/image745.png
   :width: 6.26806in
   :height: 5.675in
.. |image34| image:: media/image748.png
   :width: 6.26806in
   :height: 1.95694in
.. |image35| image:: media/image750.png
   :width: 6.26806in
   :height: 2.40417in
.. |image36| image:: media/image753.png
   :width: 6.26528in
   :height: 0.99861in
.. |image37| image:: media/image756.png
   :width: 3.04444in
   :height: 2.61528in
.. |image38| image:: media/image757.png
   :width: 2.90694in
   :height: 2.08333in
.. |image39| image:: media/image758.png
   :width: 6.26806in
   :height: 5.58194in
.. |image40| image:: media/image760.png
   :width: 6.30139in
   :height: 4.30694in
.. |image41| image:: media/image762.png
   :width: 6.26806in
   :height: 0.82917in
.. |image42| image:: media/image767.png
   :width: 5.94722in
   :height: 7.52083in
.. |image43| image:: media/image770.png
   :width: 6.26806in
   :height: 2.62639in
.. |image44| image:: media/image776.png
   :width: 6.30139in
   :height: 2.99306in
.. |image45| image:: media/image810.png
   :width: 0.47917in
   :height: 0.45833in
.. |image46| image:: media/image810.png
   :width: 0.47917in
   :height: 0.45833in
.. |image47| image:: media/image972.png
   :width: 4.11528in
   :height: 1.47778in
