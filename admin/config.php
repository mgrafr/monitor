<?php
// NE PAS MODIFIER LES VALEURS EN MAJUSCULES------
//general monitor
define('URLMONITOR', 'DOMAINE');//domaine
define('IPMONITOR', '');//ip 
define('MONCONFIG', 'admin/config.php');//fichier config 
define('DZCONFIG', 'admin/dz/temp.lua');//fichier temp 
define('FAVICON', '/favicon.ico');//fichier favicon  , icone du domaine dans barre url
define('DISPOSITIFS', 'dispositifs');
// répertoire des images
$rep='images/';//ne pas changer
// images logo et titres
define('IMAGEACCUEIL', $rep.'maison.webp');//image page accueil pour écrans >534 px
define('IMAGEACCUEILSMALL', $rep.'maison_small.webp');//image page accueil pour écrans <535 px
define('IMGLOGO', $rep.'logo.webp');//image logo
define('NOMSITE', 'Domoticz');//nom principal du site
define('NOMSLOGAN', 'La Truffière');//nom secondaire ou slogan
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
define('DHPASSVTO','a1234567');
define('DHCAMPASS', array( //id var domoticz, nom var domoticz, %1 (moyen), %2 (faible) de l'energie restante  
    '192.168.1.107' => 'MOT_PASSE',
    '192.168.1.108' => 'MOT_PASSE',
    '192.168.1.114' => 'MOT_PASSE'
));
define('DHUSER','USER');
//define('DHPASS','MOT_PASSE');
// --------------------------------------------------------------------------------------------
// choix ID pour l'affichage des infos des dispositifs
// idx : idx de Domoticz    idm : idm de monitor (dans ce cas la table "dispositifs" 
// de la DB "domoticz" est obligatoire mais en cas de problème il faudra renommer tous les dispositifs 
// dans monitor au lieu de la DB
define('CHOIXID','idm');// idm ou idx
define('NUMPLAN','2');// n° du plan regroupant tous les capteurs
// parametres serveur DBMaria
define('SERVEUR','localhost');
define('MOTDEPASSE','MOT_PASSE');
define('UTILISATEUR','USER');
define('DBASE','monitor');
//------Page  Alarmee & Administration------------
// page Alarme
define('ON_ALARM',false);// affichage pour utilisation de l'alarme
// mot passe alarme et administation , la page administration est ON
define('PWDALARM','MOT_PASSE');//mot passe alarme
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
define('IPDOMOTICZ', '192.168.1.76');//ip
define('URLDOMOTICZ', 'http://192.168.1.76:8086/');//url
define('URL_DZ', 'https://domoticz.DOMAINE');//domaine
define('VARTAB', URLDOMOTICZ.'modules_lua/string_tableaux.lua');//
define('BASE64', URLDOMOTICZ.'modules_lua/connect.lua');//login et password en Base64
//-----------------------------------------------------------
// Sauvegardes domoticz
define('FICVARDZ','var_dz');//fichier json sauvegarde des variables
//-----------------------------------------------------------
//**********************************************************
//**********************************************************
// AFFICHAGE DE PAGES Pré installées
// Page Météo  meteo concept
define('ON_MET',true);// affichage page TOKEN OBLIGATOIRE
// ---Token & code insee
define('TOKEN_MC','TOKEN METEO CONCEPT');// s'inscrire et demander Token
define('INSEE','00000');//n° INSSEE commune
// Alertes Pluie de  Météo France
// Token
define('TOKEN_MF','__Wj7dVSTjV9YGu1guveLyDq0g7S7TfTjaHBTPTpO0kj8__');
//-----------------------------------------------------------------------------------------------
// Page App diverses , log dz , nagios , sql
define('ON_APP',true);// mise en service page extérieur
// Page exterieur jardin plan extérieur
define('ON_EXT',false);// mise en service page extérieur
// Page graphiques
define('ON_GRAPH',false);// mise en service page graphique
// Page MUR de Caméras-------------------------------------------
// utilisation du mur :true sinon false , Nom du mur , nb caméras
define('ON_MUR',false);// mise en service MUR
define('NOMMUR','NOM DU MUR');// nom du mur
define('NBCAM','0');// nombre caméras
// Zoneminder
define('ZMURL','http://192.168.1.23/zm');//IP/zm
define('ZMURLTLS','https:zoneminder.DOMAINE');// sous domaine
define('ZMUSER','USER');// pour mur_cameras.php
define('ZMPASS','MOT_PASSE');// pour mur_cameras.php
define('TIMEAPI','3400');//suivant la valeur indiquée dans zoneminder
//---------------------------------------------------------------------
// Page zigbee2mqtt
define('ON_ZIGBEE',false);// mise en service Zigbee
define('IPZIGBEE', 'http://192.168.1.92:8084');//ip:port
define('URLZIGBEE', 'https://zigbee.DOMAINE');//url
//Page zwavejs2mqtt
define('ON_ZWAVE',false);// mise en service Zwave
define('IPZWAVE', 'http://192.168.1.76:8091');
define('URLZWAVE', 'https://zwave.DOMAINE');//url');
// Page Monitoring
//Nagios
define('ON_NAGIOS',false);// mise en service Monitoring
define('IPNAGIOS', '192.168.1.8/nagios');//ip/dossier
define('URLNAGIOS', 'https://monitoring.DOMAINE/nagios/');
define('NAUSER', 'nagiosadmin');
define('NAPASS', 'MOT_PASSE');
//Page Mur de Caméras avec Agent DVR
//Agent DVR
define('ON_DVR',false);// mise en service agent DVR
define('IPDVR', 'http://192.168.1.50:8090');
define('URLDVR', 'https://DOMAINE.ovh');
//SPA
define('ON_SPA',false);// mise en service SPA
#define('NB_ECRAN_SPA',6);
#define('ECRANSPA', array(
#    0 => "ph",// si nb ecran >=2
#    1 => "orp",// si nb ecran >=3 
#    2 => "debit", //débit en M3 // si nb ecran >=4
#	3 => "temp", //si nb ecran >=5
#	4 => "temp_ext", //si nb ecran >=6
#	));
// Recettes Cuisine
define('ON_RECETTES',false);
//----------------------------------------------------------------

?>



