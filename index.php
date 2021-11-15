<?php
// pour les variables de session----------------------
session_start();
include ("admin/config.php");

try{
                $conn = new PDO("mysql:host=127.0.0.1", UTILISATEUR, MOTDEPASSE);
                //On définit le mode d'erreur de PDO sur Exception
                $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                $test = '';
            }
            
            /*On capture les exceptions si une exception est lancée et on affiche
             *les informations relatives à celle-ci*/
            catch(PDOException $e){
              $test= "Erreur : " . $e->getMessage();
            }
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
if ($test==''){

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
//
if (ON_MUR==true) include ("include/mur_cam.php");
if (ON_ZIGBEE==true) include("include/zigbee.php");// fronted zigbee2mqtt
if (ON_DVR==true) include ("include/dvr.php");
if (ON_NAGIOS==true) include ("include/nagios.php");//monitoring
include ("include/footer.php");// fin de la page avec les scrpits JS
}
?>
</body></html>