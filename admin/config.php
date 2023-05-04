<?php
// NE PAS MODIFIER LES VALEURS EN MAJUSCULES------
//general monitor
define('URLMONITOR', 'monitor.la-truffiere.ovh');//domaine si port autre 443 
#define('URLMONITOR', 'monitor.la-truffiere.ovh');//domaine
define('IPMONITOR', '192.168.1.9');//ip 
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
define('DECOUVERTE', false);
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
    '192.168.1.107' => 'IdemIdem4546',
    '192.168.1.108' => 'Idem4546',
    '192.168.1.114' => 'Idem004546'
));
define('DHUSER','michel');
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
define('MOTDEPASSE','Idem4546');
define('UTILISATEUR','michel');
define('DBASE','monitor');
//------Page  Alarmee & Administration------------
// page Alarme
define('ON_ALARM',true);// affichage pour utilisation de l'alarme
// mot passe alarme et administation , la page administration est ON
define('PWDALARM','004546');//mot passe alarme
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
// Domoticz ou HA
define('IPDOMOTIC', '192.168.1.76');//ip
define('URLDOMOTIC', 'http://192.168.1.76:8086/');//url
define('DOMDOMOTIC', 'https://domoticz.la-truffiere.ovh');//domaine
define('TOKENDOMOTIC1', '');//TOKEN ou BEARER
define('IPDOMOTIC1', '');//ip 2emme serveur Domotique
define('URLDOMOTIC1', 'http://192.168.1.5:8123/');//url ex:http://192.168.1.5:8123/
define('DOMDOMOTIC1', 'https://ha.la-truffiere.ovh');//domaine
define('TOKEN_DOM1',"eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9.eyJpc3MiOiI3NzE0ZGY2ZDRlZmU0ZWQzYmI4MmI5YTRmN2NlM2UxYSIsImlhdCI6MTY3ODg4ODc1MSwiZXhwIjoxOTk0MjQ4NzUxfQ.UvvrBR60YRqHGqeYZV76nChlWoS1pW-evPJTP4Fcg2k");   

//*************************Pour Domoticz
define('VARTAB', URLDOMOTIC.'modules_lua/string_tableaux.lua');//
define('BASE64', URLDOMOTIC.'modules_lua/connect.lua');//login et password en Base64
define('CONF_MODECT', URLDOMOTIC.'modules_lua/string_modect.lua');
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
define('TOKEN_MC','2fce16877b45b86ba110ef2cdbf8d0e437563395f7a8ab2961919a7065ea2cd0');
define('INSEE','24454');
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
define('NOMMUR','La Truffiere');// nom du mur
define('NBCAM','8');// nombre caméras
// Zoneminder
define('ZMURL','http://192.168.1.23/zm');//IP/zm
define('ZMURLTLS','https:zoneminder.la-truffiere.ovh');// sous domaine
define('ZMUSER','michel');// pour mur_cameras.php
define('ZMPASS','Idem4546');// pour mur_cameras.php
define('TIMEAPI','3400');//suivant la valeur indiquée dans zoneminder
//---------------------------------------------------------------------
// Page zigbee2mqtt
define('ON_ZIGBEE',true);// mise en service Zigbee
define('IPZIGBEE', 'http://192.168.1.92:8084');//ip:port
define('URLZIGBEE', 'https://zigbee.la-truffiere.ovh');//url
//Page zwavejs2mqtt
define('ON_ZWAVE',true);// mise en service Zwave
define('IPZWAVE', 'http://192.168.1.76:8091');
define('URLZWAVE', 'https://zwave.la-truffiere.ovh');//url');
// Page Monitoring
//Nagios
define('ON_NAGIOS',true);// mise en service Monitoring
define('IPNAGIOS', '192.168.1.8/nagios');//ip/dossier
define('URLNAGIOS', 'https://monitoring.la-truffiere.ovh/nagios/');
define('NAUSER', 'nagiosadmin');
define('NAPASS', 'Idem4546');
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
define('MSMTPRC_LOC_PATH', '/var/www/html/monitor/scripts/');//copie config serveur mail
?>



