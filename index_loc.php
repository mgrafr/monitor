<?php
// pour les variables de session----------------------
session_start();
include ("admin/config.php");$_SESSION["exeption_db"]="";
// Check connection DB
$conn = new mysqli(SERVEUR, UTILISATEUR, MOTDEPASSE, DBASE);
if ($conn->connect_error) { $_SESSION["exeption_db"]="pas de connexion à la BD";}
//
// pour vérifier la connexion au net------------------
if (!$sock = @fsockopen('www.google.fr', 80, $num, $error, 5)) 
$_SESSION["TC"]="0";
else 
$_SESSION["TC"]="200";
// -variables----------------------------------------
$_SESSION["d_root"]=$_SERVER["DOCUMENT_ROOT"];
$_SESSION["d_admin"]=$_SERVER["DOCUMENT_ROOT"]."/admin/";
$_SESSION["d_include"]=$_SERVER["DOCUMENT_ROOT"]."/include/";
$_SESSION["domaine"]=$_SERVER['HTTP_HOST'];
// ----------------------------------------------------
// début du programme
include ("include/entete_html.php");// la partie <head de la page html
include ("include/header.php");// l' affichage du menu de la page d'accueil
include ("include/accueil.php");// l' affichage page accueil
if (ON_MET==true) include ("include/meteo.php");	// une page de prévision météo
include ("include/interieur.php");// plan intérieur
if (ON_ALARM==true) include ("include/alarmes.php"); // alarmes absence et nuit
if (ON_GRAPH==true) include ("include/graphiques.php");// édition de graphiques
// autre pages disponibles à décommenter pour les inclure
if (ON_EXT==true) include include ("include/exterieur.php");
// include ("include/commandes.php");
if (ON_ONOFF==true) include ("include/mur_inter.php");
if (ON_APP==true) include ("include/app_diverses.php");
include ("include/admin.php");// administration
if (ON_ZIGBEE==true) include ("include/zigbee.php");// fronted zigbee2mqtt
if (ON_ZWAVE==true) include ("include/zwave.php");// webUI zwavejs2mqtt
if (ON_MUR==true) {include ("include/mur_cam.php");$_SESSION["zmuser"]=ZMUSER;
$_SESSION["zmpass"]=ZMPASS;}
if (ON_DVR==true) include ("include/dvr.php");
if (ON_NAGIOS==true) include ("include/nagios.php");//monitoring
include ("include/test_pass.php");// verif du mot de passe
include ("include/footer.php");// fin de la page avec les scrpits JS
?>
</body></html>
