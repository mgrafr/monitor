<?php
// NE PAS MODIFIER LES VALEURS EN MAJUSCULES------
//general monitor
define('URLMONITOR', 'monitor.la-truffiere.ovh');//domaine
define('IPMONITOR', '192.168.1.7');//ip 
define('MONCONFIG', 'decouverte/config.php');//fichier config 
define('DZCONFIG', 'decouverte/dz/temp.lua');//fichier temp 
define('FAVICON', 'favicon.ico');//fichier favicon  , icone du domaine dans barre url
// répertoire des images
$rep='images/';//ne pas changer
// images logo et titres
define('IMAGEACCUEIL', 'decouverte/images/maison_600.jpg');//image page accueil pour écrans >534 px
define('IMAGEACCUEILSMALL', $rep.'maison_small.jpg');//image page accueil pour écrans <535 px
define('IMGLOGO', $rep.'logo.png');//image logo
define('NOMSITE', 'Domoticz');//nom principal du site
define('NOMSLOGAN', 'nom site,maison,...');//nom secondaire ou slogan
// affichage lexique
define('LEXIQUE', true);
// infos de découverte , à mettre à FALSE en production
define('DECOUVERTE', true);
//
define('TEMPSMAJSERVICES', 1800000);//interval maj services en milli secondes
define('TEMPSMAJSERVICESAL', 180000);//interval maj services ALARME ABSENCE en milli secondes
// caméras et VTO DAHUA
define('DHPASSVTO','0000000');
define('DHUSER','michel');
define('DHPASS','000000');
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
define('ON_ALARM',true);// affichage pour utilisation de l'alarme
// mot passe alarme et administation , la page administration est ON
define('PWDALARM','000000');//mot passe alarme
define('NOM_PASS_AL','pwdalarm');// nom du mot de passe dans la BD
define('TIME_PASS_AL','3600');// temps de validité du mot de passe
//------Page  commandes Mur Inter------------------------------------
define('ON_ONOFF',TRUE);// affichage pour utilisation des commandes
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
// AFFICHAGE DE PAGES Pré installées
// Page Météo  meteo concept
// NE PAS MODIFIER le 3eme parametre TRUE si il existe
define('ON_MET',TRUE);// affichage page TOKEN PBLIGATOIRE
// ---Token
define('TOKEN','');
//-----------------------------------------------------------------------------------------------
// Page App diverses , log dz , nagios , sql
define('ON_APP',TRUE);// mise en service page extérieur
// Page exterieur jardin plan extérieur
define('ON_EXT',TRUE);// mise en service page extérieur
// Page graphiques
define('ON_GRAPH',TRUE);// mise en service page graphique
// Page MUR de Caméras-------------------------------------------
// utilisation du mur :true sinon false , Nom du mur , nb caméras
define('ON_MUR',TRUE);// mise en service MUR
define('NOMMUR','xxxx');// nom du mur
define('NBCAM','1');// nombre caméras
// Zoneminder
define('ZMURL','http://192.168.1.9/zm');//IP/zm
define('ZMURLTLS','https:xxxxxxxxxx.ovh');//// pour mur_cameras.php
define('ZMUSER','');// pour mur_cameras.php
define('ZMPASS','');// pour mur_cameras.php
define('TIMEAPI','3400');//suivant la valeur indiquée dans zoneminder
//---------------------------------------------------------------------
// Page zigbee2mqtt
define('ON_ZIGBEE',TRUE);// mise en service Zigbee
define('IPZIGBEE', 'http://192.168.1.42:8084');//ip:port
define('URLZIGBEE', 'https://zigbee.la-truffiere.ovh');//url
// Page Monitoring
//Nagios
define('ON_NAGIOS',TRUE);// mise en service Monitoring
define('IPNAGIOS', '192.168.1.8/nagios');//ip/dossier
define('URLNAGIOS', 'https://monitoring.la-truffiere.ovh/nagios/');
define('NAUSER', 'nagiosadmin');
define('NAPASS', '000000');
//Page Mur de Caméras avec Agent DVR
//Agent DVR
define('ON_DVR',false);// mise en service agent DVR
define('IPDVR', 'http://192.168.1.50:8090');
define('URLDVR', 'https://DOMAINE.ovh');
//----------------------------------------------------------------




