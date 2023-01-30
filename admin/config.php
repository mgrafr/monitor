<?php
// NE PAS MODIFIER LES VALEURS EN MAJUSCULES------
//general monitor
define('URLMONITOR', 'monitor.DOMAINE.ovh:444');//domaine si port autre 443 
#define('URLMONITOR', 'monitor.DOMAINE.ovh');//domaine
define('IPMONITOR', '192.168.1.9');//ip 
define('MONCONFIG', 'admin/config.php');//fichier config 
define('DZCONFIG', 'admin/dz/temp.lua');//fichier temp 
define('FAVICON', '/favicon.ico');//fichier favicon  , icone du domaine dans barre url
define('DISPOSITIFS', 'dispositifs');
// répertoire des images
$rep='images/';//ne pas changer
// images logo et titres
define('IMAGEACCUEIL', $rep.'maison.jpg');//image page accueil pour écrans >534 px
define('IMAGEACCUEILSMALL', $rep.'maison_small.jpg');//image page accueil pour écrans <535 px
define('IMGLOGO', $rep.'logo.png');//image logo
define('NOMSITE', 'Domoticz');//nom principal du site
define('NOMSLOGAN', 'XXXXXXXXXXXXX');//nom secondaire ou slogan
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
//interval de maj des fonctions JS maj_services() & maj_devices()
define('TEMPSMAJSERVICES', 1800000);//interval maj services en milli secondes
define('TEMPSMAJSERVICESAL', 180000);//interval maj services ALARME ABSENCE en milli secondes
define('TEMPO_DEVICES', 180000);// en milli secondes
// caméras et VTO DAHUA
define('DHPASSVTO','xxxxxxxxxxxx');
define('DHUSER','xxxxxxxxxxxxx');
define('DHPASS','xxxxxxxxxxxxx');
// --------------------------------------------------------------------------------------------
// choix ID pour l'affichage des infos des dispositifs
// idx : idx de Domoticz    idm : idm de monitor (dans ce cas la table "dispositifs" 
// de la DB "domoticz" est obligatoire mais en cas de problème il faudra renommer tous les dispositifs 
// dans monitor au lieu de la DB
define('CHOIXID','idm');// idm ou idx
define('NUMPLAN','2');// n° du plan regroupant tous les capteurs
// parametres serveur DBMaria
define('SERVEUR','localhost');
define('MOTDEPASSE','xxxxxxxxxxxx');
define('UTILISATEUR','xxxxxxxxxxxx');
define('DBASE','domoticz');
//------Page  Alarmee & Administration------------
// page Alarme
define('ON_ALARM',true);// affichage pour utilisation de l'alarme
// mot passe alarme et administation , la page administration est ON
define('PWDALARM','00000000');//mot passe alarme
define('NOM_PASS_AL','pwdalarm');// nom du mot de passe dans la BD
define('TIME_PASS_AL','3600');// temps de validité du mot de passe
// ------------------------------------------------------------------------------------------
//------Page  commandes Mur Inter------------------------------------
define('ON_ONOFF',true);// affichage pour utilisation des commandes
// mot passe commande de dispositifs sensibles
define('PWDCOMMAND','');//mot passe alarme
define('NOM_PASS_CM','pwdcommand');// nom du mot de passe dans la BD
define('TIME_PASS_CM','43200');// temps de validité du mot de passe
//-------------------Alarme piles-----------------------------
define('PILES', array( //id var domoticz, nom var domoticz, %1 (moyen), %2 (faible) de l'energie restante  
    '17',
    'alarme_bat',
    50,
	20
));
//---------------------------------------
// Domoticz
define('IPDOMOTICZ', '192.168.1.76');//ip
define('URLDOMOTICZ', 'http://192.168.1.76:8086/');//url
// pour les variables dans un fichier
define('VARTAB', URLDOMOTICZ.'modules_lua/string_tableaux.lua');// les services(poubelles,anniversaires,..) 
define('BASE64', URLDOMOTICZ.'modules_lua/connect.lua');//login et password en Base64
//-----------------------------------------------------------
// Sauvegardes domoticz
define('FICVARDZ','var_dz');//fichier json sauvegarde des variables
//-----------------------------------------------------------
//**********************************************************
//**********************************************************
// AFFICHAGE DE PAGES Pré installées
// Page Météo  meteo concept
define('ON_MET',true);// affichage page TOKEN PBLIGATOIRE
// ---Token & code insee
define('TOKEN_MC','xxxxxxxxxxxxxxxxxxxxxxxxTOKENxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxx');
define('INSEE','00000');
// Alertes Pluie de  Météo France
// Token
define('TOKEN_MF','__xxxxxxxxxxxxxxxxxTOKENxxxxx__');
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
define('NOMMUR','nom du mur');// nom du mur
define('NBCAM','8');// nombre caméras
// Zoneminder
define('ZMURL','http://192.168.1.23/zm');//IP/zm
define('ZMURLTLS','https:DOMAINE.ovh');// sous domaine
define('ZMUSER','xxxxxxxxxxx');// pour mur_cameras.php
define('ZMPASS','xxxxxxxxxxxxx');// pour mur_cameras.php
define('TIMEAPI','3400');//suivant la valeur indiquée dans zoneminder
//---------------------------------------------------------------------
// Page zigbee2mqtt
define('ON_ZIGBEE',true);// mise en service Zigbee
define('IPZIGBEE', 'http://192.168.1.76:8080');//ip:port
define('URLZIGBEE', 'https://zigbee.DOMAINE.ovh');//url
//Page zwavejs2mqtt
define('ON_ZWAVE',true);// mise en service Zwave
define('IPZWAVE', 'http://192.168.1.76:8091');
define('URLZWAVE', 'https://zwave.DOMAINE.ovh');//url');
// Page Monitoring
//Nagios
define('ON_NAGIOS',true);// mise en service Monitoring
define('IPNAGIOS', '192.168.1.8/nagios');//ip/dossier
define('URLNAGIOS', 'https://monitoring.DOMAINE.ovh:444/nagios/');
define('NAUSER', 'nagiosadmin');
define('NAPASS', 'xxxxxxxxxxxxxx');
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

?>



