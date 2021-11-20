<?php
// pour les variables de session----------------------
session_start();
include ("decouverte/config.php");$_SESSION["exeption_db"]="";
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
echo '<script>document.body.clientWidth="768";</script>';

include ("include/header.php");// l' affichage du menu de la page d'accueil
include ("include/accueil.php");// l' affichage page accueil
include ("decouverte/meteo.php");	// une page de prévision météo
include ("decouverte/interieur.php");// plan intérieur
include ("decouverte/alarmes.php"); // alarmes absence et nuit
include ("decouverte/graphiques.php");// édition de graphiques
// autre pages disponibles à décommenter pour les inclure
include ("decouverte/exterieur.php");
include ("decouverte/mur_inter.php");
include ("decouverte/app_diverses.php");
include ("decouverte/admin.php");// administration
include ("decouverte/zigbee.php");// fronted zigbee2mqtt
include ("decouverte/mur_cam.php");
if (ON_DVR==true) include ("include/dvr.php");
include ("decouverte/nagios.php");//monitoring
include ("include/footer.php");// fin de la page avec les scrpits JS
?>
</body>
</html>
