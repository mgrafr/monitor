<?php
// NE PAS MODIFIER LES VALEURS EN MAJUSCULES------
//general monitor
define('URLMONITOR', 'monitor.xxxxxxx.ovh');//domaine
define('IPMONITOR', '192.168.1.7');//ip 
define('MONCONFIG', 'admin/config.php');//fichier config 
define('DZCONFIG', 'admin/dz/temp.lua');//fichier temp 
define('FAVICON', '/favicon.ico');//fichier favicon  , icone du domaine dans barre url
// répertoire des images
$rep='images/';//ne pas changer
// images logo et titres
define('IMAGEACCUEIL', $rep.'maison.jpg');//image page accueil pour écrans >534 px
define('IMAGEACCUEILSMALL', $rep.'maison_small.jpg');//image page accueil pour écrans <535 px
define('IMGLOGO', $rep.'logo.png');//image logo
define('NOMSITE', 'Domoticz');//nom principal du site
define('NOMSLOGAN', 'Bonjour');//nom secondaire ou slogan
// affichage lexique
define('LEXIQUE', false);
// infos de découverte , à mettre à FALSE en production
define('DECOUVERTE', true);
//
define('TEMPSMAJSERVICES', 1800000);//interval maj services en milli secondes
define('TEMPSMAJSERVICESAL', 180000);//interval maj services ALARME ABSENCE en milli secondes
// caméras et VTO DAHUA
define('DHPASSVTO','xxxxxxxx');
define('DHUSER','michel');
define('DHPASS','xxxxxxx');
// --------------------------------------------------------------------------------------------
// choix ID pour l'affichage des infos des dispositifs
// idx : idx de Domoticz    idm : idm de monitor (dans ce cas la table "dispositifs" 
// de la DB "domoticz" est obligatoire mais en cas de problème il faudra renommer tous les dispositifs 
// dans monitor au lieu de la DB
define('CHOIXID','idm');// idm ou idx
define('NUMPLAN','2');// n° du plan regroupant tous les capteurs
// parametres serveur DBMaria
define('SERVEUR','localhost');
define('MOTDEPASSE','00000000');
define('UTILISATEUR','michel');
define('DBASE','domoticz');
//------Page  Alarmee & Administration------------
// page Alarme
define('ON_ALARM',false);// affichage pour utilisation de l'alarme
// mot passe alarme et administation , la page administration est ON
define('PWDALARM','000000');//mot passe alarme
define('NOM_PASS_AL','pwdalarm');// nom du mot de passe dans la BD
define('TIME_PASS_AL','3600');// temps de validité du mot de passe
// ------------------------------------------------------------------------------------------
//------Page  commandes Mur Inter------------------------------------
define('ON_ONOFF',false);// affichage pour utilisation des commandes
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
define('IPDOMOTICZ', '192.168.1.21');//ip
define('URLDOMOTICZ', 'http://192.168.1.21:8082/');//url
define('VARTAB', URLDOMOTICZ.'modules_lua/string_tableaux.lua');//url
//-----------------------------------------------------------
// Sauvegardes domoticz
define('FICVARDZ','var_dz');//fichier json sauvegarde des variables
//-----------------------------------------------------------
//**********************************************************
//**********************************************************
// AFFICHAGE DE PAGES Pré installées
// Page Météo  meteo concept
define('ON_MET',false);// affichage page TOKEN PBLIGATOIRE
// ---Token
define('TOKEN','YYYYYYYYYYYYYYYYYYYYYYYYYYYYYYYYYYYYYYYYYYYYYYYYYYYYYYYYYYYYYY');
//-----------------------------------------------------------------------------------------------
// Page App diverses , log dz , nagios , sql
define('ON_APP',false);// mise en service page extérieur
// Page exterieur jardin plan extérieur
define('ON_EXT',false);// mise en service page extérieur
// Page graphiques
define('ON_GRAPH',false);// mise en service page graphique
// Page MUR de Caméras-------------------------------------------
// utilisation du mur :true sinon false , Nom du mur , nb caméras
define('ON_MUR',false);// mise en service MUR
define('NOMMUR','Mon Mur');// nom du mur
define('NBCAM','1');// nombre caméras
// Zoneminder
define('ZMURL','http://192.168.1.9/zm');//IP/zm
define('ZMURLTLS','https:zoneminder.la-truffiere.ovh');// sous domaine
define('ZMUSER','moi');// pour mur_cameras.php
define('ZMPASS','000000');// pour mur_cameras.php
define('TIMEAPI','3400');//suivant la valeur indiquée dans zoneminder
//---------------------------------------------------------------------
// Page zigbee2mqtt
define('ON_ZIGBEE',false);// mise en service Zigbee
define('IPZIGBEE', 'http://192.168.1.76:8088');//ip:port
define('URLZIGBEE', 'https://zigbee.zzzzzzzzz.ovh');//url
//Page zwavejs2mqtt
define('ON_ZWAVE',true);// mise en service agent DVR
define('IPZWAVE', 'http://192.168.1.76:8091');
define('URLZWAVE', 'https://zwave.xxxxxxxxxxx.ovh');//url');
// Page Monitoring
//Nagios
define('ON_NAGIOS',false);// mise en service Monitoring
define('IPNAGIOS', '192.168.1.8/nagios');//ip/dossier
define('URLNAGIOS', 'https://monitoring.zzzzzzzzz.ovh/nagios/');
define('NAUSER', 'nagiosadmin');
define('NAPASS', '00000000');
//Page Mur de Caméras avec Agent DVR
//Agent DVR
define('ON_DVR',false);// mise en service agent DVR
define('IPDVR', 'http://192.168.1.50:8090');
define('URLDVR', 'https://DOMAINE.ovh');
//----------------------------------------------------------------
?>



