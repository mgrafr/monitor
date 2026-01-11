<?php
if(session_status() === PHP_SESSION_NONE) session_start();
// pour les variables de session----------------------
$_SESSION["id_session"] = session_id();
if (isset($_COOKIE["userpref"]) && $_COOKIE["userpref"]==""){$_SESSION["conf"]="";
    header('Location: '.$_SESSION["rep"].'index_loc.php');}
if ($_SESSION["conf"]=="") {$config="admin/config.php";}
else {$config="admin/config_".$_SESSION["conf"].".php";}
$_SESSION["config"]=$config;
//if (!file_exists($_SESSION["rep"]).$config) {echo $_SESSION["rep"]).$config."....le fichier de config n'exiqte pas";
    //$_SESSION["conf"]="";
    //header('Location: '.$_SESSION["rep"])
    //}
setcookie('userpref', $config, time()+3600*24*365, '/monitor', '');
$_SESSION["domaine"]=$_SERVER['HTTP_HOST'];$_SESSION["exeption_db"]=""; 
$http_host=substr($_SESSION["domaine"] ,0,7);
if ($http_host !="192.168" && $http_host !="172.25." && $http_host !="10.121.") {
    if (!isset($_SESSION["current_otp"]) || $_SESSION["current_otp"] != $_SESSION["otp"]) {
        header('Location: OTP/index_otp.php');
   exit();} 
    }

require ($config);require("fonctions.php");
// Check connection DB
mysqli_report(MYSQLI_REPORT_OFF);
$conn = @new mysqli(SERVEUR, UTILISATEUR, MOTDEPASSE, DBASE);
if (!$conn) {echo "pas de BD : ".DBASE	; $_SESSION["exeption_db"]="pas de connexion à la BD"; }
//
// pour vérifier la connexion au net------------------

if (!$sock = @fsockopen('www.google.fr', 80)) {$_SESSION["TC"]="0";}
else {$_SESSION["TC"]="200";}
// -variables----------------------------------------
$res = fopen('.version', 'rb');
$_SESSION["version"]=fgets($res, 10);
$_SESSION["d_root"]=$_SERVER["DOCUMENT_ROOT"];
$_SESSION["d_admin"]=$_SERVER["DOCUMENT_ROOT"]."/admin/";
$_SESSION["d_include"]=$_SERVER["DOCUMENT_ROOT"]."/include/";
//$_SESSION["domaine"]=$_SERVER['HTTP_HOST'];
// ----------------------------------------------------
// début du programme
include ("include/entete_html.php");// la partie <head de la page html
include ("include/header.php");// l' affichage du menu de la page d'accueil
$filename = 'custom/php/accueil.php';
if (file_exists($filename)) {include ($filename);}// l' affichage page accueil
 else {include ("include/accueil.php");}
if (ON_MET==true) include ("include/meteo.php");	// une page de prévision météo
include ("include/interieur.php");// plan intérieur
include ("include/clavier_code.php");
if (ON_ALARM==true) include ("include/alarmes.php"); // alarmes absence et nuit
if (ON_GRAPH==true) include ("include/graphiques.php");// édition de graphiques
// autre pages disponibles à décommenter pour les inclure
if (ON_EXT==true) include ("custom/php/exterieur.php");
if (ON_ONOFF==true) include ("include/mur_inter.php");
if (ON_APP==true) include ("include/app_diverses.php");
// administration
include ("include/admin.php");
if (ON_ZIGBEE==true) include ("include/zigbee.php");// fronted zigbee2mqtt
if (ON_ZWAVE==true) include ("include/zwave.php");// webUI zwavejs2mqtt
if (ON_MUR==true) {include ("include/mur_cam.php");$_SESSION["zmuser"]=ZMUSER;
$_SESSION["zmpass"]=ZMPASS;}
if (ON_DVR==true) include ("include/dvr.php");
if (ON_NAGIOS==true) include ("include/nagios.php");//monitoring
if (ON_SPA==true) include ("include/spa.php");//spa
if (ON_HABRIDGE==true) include ("include/habridge.php");//pont hue Alexa
if (ON_RECETTES==true) include ("include/recettes.php");//monitoring
if (URLIOB[2]==true) include ("include/iobroker.php");//iobroker
//include ("custom/php/modes_emploi.php");
include ("include/footer.php");// fin de la page avec les scrpits JS


?>
</body></html>



