
<?php
// pour les variables de session----------------------
session_start();
include ("decouverte/config.php");$_SESSION["exeption_db"]="";
mysqli_report(MYSQLI_REPORT_OFF);
// Check connection DB
$conn = new mysqli(SERVEUR, UTILISATEUR, MOTDEPASSE, DBASE);
if ($conn->connect_error) { echo 'pas de connexion à la BD<br>vérifier SERVEUR, UTILISATEUR, MOTDEPASSE, DBASE <br>dans decouverte/config.php<br><br><img src="decouverte/images/decouv1.jpg" width="459" height="81" alt=""/>';exit;}
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
echo '<script>window.innerWidth="768";</script>';
include ("decouverte/header.php");// l' affichage du menu de la page d'accueil
include ("include/accueil.php");// l' affichage page accueil
if (ON_MET==true) include ("decouverte/meteo.php");	// une page de prévision météo
include ("decouverte/interieur.php");// plan intérieur
if (ON_ALARM==true) include ("decouverte/alarmes.php"); // alarmes absence et nuit
if (ON_GRAPH==true) include ("decouverte/graphiques.php");// édition de graphiques
// autre pages disponibles à décommenter pour les inclure
if (ON_EXT==true) include ("decouverte/exterieur.php");
if (ON_ONOFF==true) include ("decouverte/mur_inter.php");
if (ON_APP==true) include ("decouverte/app_diverses.php");
include ("include/admin.php");
include ("decouverte/footer.php");// fin de la page avec les scrpits JS
?>
</body>
</html>
