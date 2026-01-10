<?php
// NE PAS MODIFIER LES VALEURS EN MAJUSCULES------
// IMPORTANT Des modifications d' IP(s) peut entrainer une modification de connect.py
// voir la documentation --- si RPI faire maj Automatique
//general monitor
define('URLMONITOR', 'monitor.DOMAINE.ovh');//domaine si port autre 443 
define('IPMONITOR', 'ipmonitor');//ip 
define('PASSMONITOR', 'MON_PASS');//mot passe serveur et SSH2
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
     "mod_py_list" => "enable", //LISTE modules python dans monitor			    
     "idx_dz-zigbee" => "disable", //Créer fichier idx/nom Domoticz , TABLEAU zigbee
     "reboot_pi" => "disable", //Reboot Raspberry
     "msmtprc" => "disable", //msmtprc (config envoi mail)
     "connect_py" => "disable", // Maj automatique des IP depuis connect.py
	));
define('ON_SOS',true);// bouton sos page accueil, le disositif dit être enregistré dans SQL
define('BASE64', 'admin/connect/connect.py');//login et password en Base64 pour dz,ha,iobroker
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
define('MQTT_USER', "<user>");//user et mot passe dans Mosquitto
define('MQTT_PASS', "<mot de passe>");
define('MQTT_URL', 'mqtt.<DOMAINE>');//ex: mqtt.xxxxxx.ovh
define('MQTT_IP', '192.168.1.x');//adresse IP mosquitto
define('MQTT_PORT', 9001);// mqtt=1883 websockets: ws=9001 wss=9002 ou 9883
define('MQTT_TOPIC', "monitor/ha");// topic (destinataire) monitor/dz, monitor/ha,...
//--------------------------------------------------
define('SSE','false');//  'false',  'node' ou 'php' si serveur SSE utilisé par monitor
//pour SSE php
define('SSE_SLEEP', 2);//raffraichissement en secondes
// pour SSE node
define('SSE_USER', "michel");//user et mot passe dans MM
define('SSE_PASS', "<MOT PASSE>");
define('SSE_URL', '<sous domaine>.<DOMAINE>.ovh');
define('SSE_IP', '192.168.1.x');//adresse IP
define('SSE_PORT', 3000);// 
//
// interval de maj des fonctions JS maj_services() & maj_devices()
define('TEMPSMAJSERVICES', 1800000);//interval maj services en milli secondes
define('TEMPSMAJSERVICESAL', 180000);//interval maj services ALARME ABSENCE en milli secondes
define('TEMPO_DEVICES', 180000);// en milli secondes
define('TEMPO_DEVICES_D', 15000);// en milli secondes (>=5s <30s) maj déclenchée par Dz voir doc
// caméras et VTO DAHUA
define('DHPASSVTO','xxxxxxxxxxxxxx');
define('DHCAMPASS', array( //id var domoticz, nom var domoticz, %1 (moyen), %2 (faible) de l'energie restante  
    '192.168.1.107' => 'MOT PASSE',
    '192.168.1.108' => 'MOT PASSE',
    '192.168.1.114' => 'MOT PASSE'
));
define('DHUSER','USER');
//define('DHPASS','mot_de_passe');
// --------------------------------------------------------------------------------------------
// parametres serveur DBMaria
define('SERVEUR','localhost');
define('MOTDEPASSE','PASS_BD');
define('UTILISATEUR','USER_BD');
define('DBASE','monitor');
define('API','false'); // true ou false
define('PHPMYADMIN',IPMONITOR.'/phpmyadmin'); // adresse phpMyAdmin
define('BACKUP_DB','/var/www/html/monitor/DB_Backup');//chemin absolue sauvegarde de la BD
//------Page  Alarmee & Administration------------
// page Alarme
define('ON_ALARM',false);// affichage pour utilisation de l'alarme
// mot passe alarme et administation , la page administration est ON
define('PWDALARM','1234');//mot passe alarme
define('NOM_PASS_AL','pwdalarm');// nom du mot de passe dans la BD
define('TIME_PASS_AL','3600');// temps de validité du mot de passe
define('MODECT','false');// Mode détection caméras zoneminder, frigate ou false
// ------------------------------------------------------------------------------------------
//------Page  commandes Mur Inter------------------------------------
define('ON_ONOFF',false);// affichage pour utilisation des commandes
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
// Serveurs Domoticz ou HA ou iobroker ou zigbee2mqtt
define('DOMOTIC', '');//DZ ou HA ou IOB ou ZB ou ""  (non utlisé)
define('DOMOTIC1', '');//DZ ou HA ou IOB ou ZB ou ""
define('DOMOTIC2', '');//DZ ou HA ou IOB ou ZB ou ""
// URL HTTPS
define('URLDZ', 'https://domoticz.DOMAINE');
define('URLHA', 'https://ha.DOMAINE');
define('URLIOB', array(
    0 => "https://iobroker..DOMAINE",
    1 => "https://iobweb.DOMAINE",
    2 => false));// false ou true : page iobroker dans monitor
// les 3 serveurs
define('IPDOMOTIC', '');//ip 1er serveur Domotique ex:192.168.1.76
define('USERDOMOTIC', '<user>');//user du serveur,répertoire :home/user
define('PWDDOMOTIC', '<mot passe>');//mot passe serveur
define('URLDOMOTIC', 'http://192.168.1.76:8086/');//url
define('TOKEN_DOMOTIC', '');//TOKEN ou BEARER
define('PORT_API_DOMO','');//port de l'API éventuel
define('PORT_WEBUI_DOMO','');//port web UI et dossier éventuel
//
define('IPDOMOTIC1', '');//ip 2emme serveur Domotique ex:192.168.1.5
define('USERDOMOTIC1', '<user>');//user du serveur,répertoire :home/user
define('PWDDOMOTIC1', '<mot passe>');//mot passe serveur
define('URLDOMOTIC1', '');//url ex:http://192.168.1.5:8123/
define('TOKEN_DOMOTIC1', '');//TOKEN ou BEARER
define('PORT_API_DOMO1','');//port de l'API éventuel
define('PORT_WEBUI_DOMO1','');//port web UI ou vis 2 et dossier éventuel
//
define('IPDOMOTIC2', '');//ip 2emme serveur Domotique ex:192.168.1.5
define('USERDOMOTIC2', '<user>');//user du serveur,répertoire :home/user
define('PWDDOMOTIC2', '<mot passe>');//mot passe serveur
define('URLDOMOTIC2', '');//url ex:http://192.168.1.104:8081/
define('TOKEN_DOMOTIC2', '');//TOKEN ou BEARER
define('PORT_API_DOMO2','');//port de l'API éventuel
define('PORT_WEBUI_DOMO2','');//port web UI et dossier éventuel ex: 8082/vis-2/index.html
// ****modules et constantes  complémentaires pour Domoticz
define('NUMPLAN','2');//DZ uniquement: n° du plan regroupant tous les capteurs
define('VARTAB', 'admin/connect/string_tableaux.lua');//
define('CONF_MODECT', 'admin/string_modect.json');
// *********** pour Iobroker
define('OBJ_IOBROKER','zigbee2mqtt.0');// séparer les objets par une virgule
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
define('ON_APP',false);// mise en service page app diverses
define('APP_NB_ENR',30); //nb d'enregistrements affichés , concene poubelles
//-------------------------------------------------------
// Page exterieur jardin plan extérieur
define('ON_EXT',false);// mise en service page extérieur
// Page graphiques
define('ON_GRAPH',false);// mise en service page graphique
// Page MUR de Caméras-------------------------------------------
// utilisation du mur :true sinon false , Nom du mur , nb caméras
define('ON_MUR',false);// mise en service MUR
define('NOMMUR','');// nom du mur
define('NBCAM','0');// nombre caméras ,pour frigate = non concerné
define('SRC_MUR','mo');// zm=Zoneminder, mo=monitor,fr=Frigate
define('IP_FRIGATE','<IP>:5000');// pour Frigate
define('URL_FRIGATE','<DOMAINE>');// ""
// Zoneminder
define('ZMURL','http://192.168.1.23/zm');//IP/zm
define('ZMURLTLS','https:zoneminder.DOMAINE.ovh');// sous domaine
define('ZMUSER','');// pour mur_cameras.php
define('ZMPASS','MOT PASSE');// pour mur_cameras.php
define('TIMEAPI','3400');//suivant la valeur indiquée dans zoneminder
//---------------------------------------------------------------------
// Page zigbee2mqtt
define('ON_ZIGBEE',false);// mise en service Zigbee
define('IPZIGBEE', 'http://192.168.1.92:8084');//ip:port
define('URLZIGBEE', 'https://zigbee.DOMAINE.ovh');//url
//Page zwavejs2mqtt
define('ON_ZWAVE',false);// mise en service Zwave
define('IPZWAVE', 'http://192.168.1.76:8091');
define('URLZWAVE', 'https://zwave.DOMAINE.ovh');//url');
// Page Monitoring
//Nagios
define('ON_NAGIOS',false);// mise en service Monitoring
define('IPNAGIOS', 'http://192.168.1.8/nagios');//ip/dossier
define('URLNAGIOS', 'https://monitoring.DOMAINE.ovh/nagios/');
define('NAUSER', 'nagiosadmin');
define('NAPASS', '');
//Page Mur de Caméras avec Agent DVR
//Agent DVR
define('ON_DVR',false);// mise en service agent DVR
define('IPDVR', 'http://192.168.1.50:8090');
define('URLDVR', 'https://DOMAINE.ovh');
//SPA
define('ON_SPA',false);// mise en service SPA
define('NB_ECRAN_SPA',6);
define('ECRANSPA', array(
    0 => "ph",// si nb ecran >=2
    1 => "orp",// si nb ecran >=3 
    2 => "debit", //débit en M3 // si nb ecran >=4
	3 => "temp", //si nb ecran >=5
	4 => "temp_ext", //si nb ecran >=6
	));
//Assistant vocal
//Ha-bridge
define('ON_HABRIDGE',false);// mise en service Ha-bridge(Pont HUE)
define('IPHABRIDGE', 'http://192.168.1.14');// port 80 obligatoire ou ProxyPass
define('URLHABRIDGE', 'https://habridge.DOMAINE');
// Recettes Cuisine
define('ON_RECETTES',false);
//----------------------------------------------------------------
//fichiers divers
//Raspberry
define('IPRPI', '192.168.1.8');//IP du Raspberry
define('LOGIN_PASS_RPI', '<login:pass>');
define('MSMTPRC_LOC_PATH', '/var/www/html/monitor/scripts/');//copie config serveur mail
define('MOD_PYTHON_FILE', '/var/www/monitor/admin/connect/mod.json');//liste des modules Python
$file = '/var/www/monitor/admin/connect/connect.py';
$current = file_get_contents($file);
if (str_contains($current, 'domaine')===false ){
$current = $current."domaine='".URLMONITOR."'\n";
file_put_contents($file, $current);}
?>





