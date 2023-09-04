<?php
// NE PAS MODIFIER LES VALEURS EN MAJUSCULES------
// IMPORTANT Des modifications d' IP(s) peut entrainer une modification de connect.py
// voir la documentation --- si RPI faire maj Automatique
//general monitor
define('URLMONITOR', 'monitor.DOMAINE.ovh');//domaine si port autre 443 
define('IPMONITOR', 'ipmonitor');//ip 
define('PASSMONITOR', '********');//mot passe serveur et SSH2
define('USERMONITOR', 'nom_utilisateur');//user serveur et SSH2
define('MONCONFIG', 'admin/config.php');//fichier config 
define('DZCONFIG', 'admin/dz/temp.lua');//fichier temp 
define('FAVICON', '/favicon.ico');//fichier favicon  , icone du domaine dans barre url
define('DISPOSITIFS', 'dispositifs');
define('ECRAN_ADMIN', array( // disable ou disable
     "connect_lua" => "disable", // Mots passe cryptés(Base64) et IP réseau
     "string_tableaux" => "disable",//Configuation variables dz maj_services
     "modect" => "disable", //Configuation modect dz alarmes 
     "idx_dz_list" => "disable", //Créer fichier idx/nom Domoticz , LISTE
     "var_list" => "disable", //LISTE variables (HA et DZ)
     "idx_dz-zigbee" => "disable", //Créer fichier idx/nom Domoticz , TABLEAU zigbee
     "reboot_pi" => "disable", //Reboot Raspberry
     "msmtprc" => "disable", //msmtprc (config envoi mail)
     "connect_py" => "disable", // Maj automatique des IP depuis connect.py
	));
// répertoire des images
$rep='images/';//ne pas changer
// images logo et titres
define('IMAGEACCUEIL', $rep.'maison.webp');//image page accueil pour écrans >534 px
define('IMAGEACCUEILSMALL', $rep.'maison_small.webp');//image page accueil pour écrans <535 px
define('IMGLOGO', $rep.'logo.webp');//image logo
define('NOMSITE', 'nom du site');//nom principal du site
define('NOMSLOGAN', 'nom secondaire');//nom secondaire ou slogan
// affichage lexique
define('LEXIQUE', true);
// infos de découverte , à mettre à FALSE en production
define('DECOUVERTE', true);
// serveur MQTT utilisation d'un serveur (envoi topic depuis monitor)
define('MQTT', false);//  true si serveur MQTT utilisé par monitor
define('MQTT_IP', '192.168.1.24');//adresse IP
define('MQTT_PORT', 9001);// mqtt=1883 websockets=9001
define('MQTT_TOPIC', "domoticz/in");// topic (destinataire)
//--------------------------------------------------
// interval de maj des fonctions JS maj_services() & maj_devices()
define('TEMPSMAJSERVICES', 1800000);//interval maj services en milli secondes
define('TEMPSMAJSERVICESAL', 180000);//interval maj services ALARME ABSENCE en milli secondes
define('TEMPO_DEVICES', 180000);// en milli secondes
define('TEMPO_DEVICES_DZ', 30000);// en milli secondes (>= 15s) maj déclenchée par Dz voir doc
// caméras et VTO DAHUA
define('DHPASSVTO','xxxxxxxxxxxxxx');
define('DHCAMPASS', array( //id var domoticz, nom var domoticz, %1 (moyen), %2 (faible) de l'energie restante  
    '192.168.1.107' => 'MOT PASSE',
    '192.168.1.108' => 'MOT PASSE',
    '192.168.1.114' => 'MOT PASSE'
));
define('DHUSER','USER');
//define('DHPASS','Idem4546');
// --------------------------------------------------------------------------------------------
// choix ID pour l'affichage des infos des dispositifs
// idx : idx de Domoticz    idm : idm de monitor (dans ce cas la table "dispositifs" 
// de la DB "domoticz" est obligatoire mais en cas de problème il faudra renommer tous les dispositifs 
// dans monitor au lieu de la DB
define('CHOIXID','idm');// DZ:idm ou idx ; HA : idm uniquement
define('NUMPLAN','2');//DZ uniquement: n° du plan regroupant tous les capteurs
// parametres serveur DBMaria
define('SERVEUR','localhost');
define('MOTDEPASSE','PASS_BD');
define('UTILISATEUR','USER_BD');
define('DBASE','monitor');
//------Page  Alarmee & Administration------------
// page Alarme
define('ON_ALARM',true);// affichage pour utilisation de l'alarme
// mot passe alarme et administation , la page administration est ON
define('PWDALARM','1234');//mot passe alarme
define('NOM_PASS_AL','pwdalarm');// nom du mot de passe dans la BD
define('TIME_PASS_AL','3600');// temps de validité du mot de passe
// ------------------------------------------------------------------------------------------
//------Page  commandes Mur Inter------------------------------------
define('ON_ONOFF',true);// affichage pour utilisation des commandes
// mot passe commande de dispositifs sensibles
define('PWDCOMMAND','');//mot passe commandes
define('NOM_PASS_CM','pwdcommand');// nom du mot de passe dans la BD
define('TIME_PASS_CM','43200');// temps de validité du mot de passe
//-------------------Alarme piles-----------------------------
define('PILES', array( //id var domoticz, nom var domoticz, %1 (moyen), %2 (faible) de l'energie restante  
    '17',
    'alarme_bat',
    50,
	20
));
define('NOTIFICATIONS_PILES','');// nom de la page default: interieur
//---------------------------------------
// Serveurs Domoticz ou HA
define('IPDOMOTIC', 'ip');//ip 1er serveur Domotique
//pour ssh2
define('USERDOMOTIC', '<user>');//user du serveur,répertoire :home/user
define('PWDDOMOTIC', '<mot passe>');//mot passe serveur
//
define('URLDOMOTIC', 'http://192.168.1.76:8086/');//url
define('DOMDOMOTIC', 'https://domoticz.DOMAINE.ovh');//domaine
define('TOKENDOMOTIC', 'ENTRER LE TOKEN ICI');//TOKEN ou BEARER
define('IPDOMOTIC1', '192.168.1.5');//ip 2emme serveur Domotique
//pour ssh2
define('USERDOMOTIC1', '<user>');//user du serveur,répertoire :home/user
define('PWDDOMOTIC1', '<mot passe>');//mot passe serveur
//
define('URLDOMOTIC1', 'http://192.168.1.5:8123/');//url ex:http://192.168.1.5:8123/
define('DOMDOMOTIC1', 'https://ha.DOMAINE.ovh');//domaine
define('TOKENDOMOTIC1', "ENTRER LE TOKEN ICI");//TOKEN ou BEARER
//*************************Pour Domoticz
define('VARTAB', URLDOMOTIC.'modules_lua/string_tableaux.lua');//
define('BASE64', URLDOMOTIC.'modules_lua/connect.lua');//login et password en Base64
define('CONF_MODECT', URLDOMOTIC.'modules_lua/string_modect.lua');
//-----------------------------------------------------------
// Sauvegardes domoticz
define('FICVARDZ','var_dz');//fichier json sauvegarde des variables
//-----------------------------------------------------------
// AFFICHAGE DE PAGES Pré installées
// Page Météo  meteo concept
define('ON_MET',true);// affichage page TOKEN PBLIGATOIRE
// ---Token & code insee
define('TOKEN_MC','');
define('INSEE','');
// Alertes Pluie de  Météo France
// Token
define('TOKEN_MF','__Wj7dVSTjV9YGu1guveLyDq0g7S7TfTjaHBTPTpO0kj8__');
//-----------------------------------------------------------------------------------------------
// Page App diverses , log dz , nagios , sql
define('ON_APP',true);// mise en service page extérieur
// Page exterieur jardin plan extérieur
define('ON_EXT',true);// mise en service page extérieur
// Page graphiques
define('ON_GRAPH',true);// mise en service page graphique
// Page MUR de Caméras-------------------------------------------
// utilisation du mur :true sinon false , Nom du mur , nb caméras
define('ON_MUR',true);// mise en service MUR
define('NOMMUR','');// nom du mur
define('NBCAM','0');// nombre caméras
// Zoneminder
define('ZMURL','http://192.168.1.23/zm');//IP/zm
define('ZMURLTLS','https:zoneminder.DOMAINE.ovh');// sous domaine
define('ZMUSER','');// pour mur_cameras.php
define('ZMPASS','MOT PASSE');// pour mur_cameras.php
define('TIMEAPI','3400');//suivant la valeur indiquée dans zoneminder
//---------------------------------------------------------------------
// Page zigbee2mqtt
define('ON_ZIGBEE',true);// mise en service Zigbee
define('IPZIGBEE', 'http://192.168.1.92:8084');//ip:port
define('URLZIGBEE', 'https://zigbee.DOMAINE.ovh');//url
//Page zwavejs2mqtt
define('ON_ZWAVE',true);// mise en service Zwave
define('IPZWAVE', 'http://192.168.1.76:8091');
define('URLZWAVE', 'https://zwave.DOMAINE.ovh');//url');
// Page Monitoring
//Nagios
define('ON_NAGIOS',true);// mise en service Monitoring
define('IPNAGIOS', '192.168.1.8/nagios');//ip/dossier
define('URLNAGIOS', 'https://monitoring.DOMAINE.ovh/nagios/');
define('NAUSER', 'nagiosadmin');
define('NAPASS', '');
//Page Mur de Caméras avec Agent DVR
//Agent DVR
define('ON_DVR',false);// mise en service agent DVR
define('IPDVR', 'http://192.168.1.50:8090');
define('URLDVR', 'https://DOMAINE.ovh');
//SPA
define('ON_SPA',true);// mise en service SPA
define('NB_ECRAN_SPA',6);
define('ECRANSPA', array(
    0 => "ph",// si nb ecran >=2
    1 => "orp",// si nb ecran >=3 
    2 => "debit", //débit en M3 // si nb ecran >=4
	3 => "temp", //si nb ecran >=5
	4 => "temp_ext", //si nb ecran >=6
	));
// Recettes Cuisine
define('ON_RECETTES',true);
//----------------------------------------------------------------
//fichiers divers
define('IPRPI', '192.168.1.8');//IP du Raspberry
define('MSMTPRC_LOC_PATH', '/var/www/html/monitor/scripts/');//copie config serveur mail
?>

