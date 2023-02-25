# monitor
affichage d'un serveur domotique<br>demo : <br>
<img src="readme_img/monitor.gif" alt="Monitor" style="max-width: 100%;"><br><br>
Ce programme est écrit en PHP 8 (jpgraph version 4.4.1) <br><br>
Prérequis :
-	Serveur Nginx avec Maria DB, PHP, phpMyAdmin, voir http://domo-site.fr/accueil/dossiers/3<br>
https://www.linuxtricks.fr/wiki/debian-installer-un-serveur-lamp-apache-mysql-php <br>
-	Certificats HTTPS<br>
-	Logiciel d’édition d’images svg : Adobe Illustrator ou Inkscape<br><br>
l'écran de ma tablette:<br>
<img src="readme_img/image1a.jpg" alt="Screenshot1" style="max-width: 100%;"><br>
l'écran avant d'insérer les données d'un serveur domotique,<br> avant la connexion à la base de données<br>
<img src="readme_img/image2.jpg" alt="Screenshot2" style="max-width: 100%;"><br>
Par défaut le programme propose 4 onglets mais après connection à un <br>serveur domotique ou après une demande de jeton ,d'autres onglets peuvent <br>être ajoutés en modifiant le fichier de configuration:<br>
<img src="readme_img/image3.jpg" alt="Screenshot1" style="max-width: 100%;"><br>
<img src="readme_img/image4.jpg" alt="Screenshot1" style="max-width: 100%;"><br>
En plus de la page d'accueil, les pages par défaut:<br>
<img src="readme_img/image6.jpg" alt="Screenshot1" style="max-width: 100%;"><br>
L'alarmes reçoit les informations de 2 PIR et 2 contacts de porte ; elle peut :<br>- mettre en service le mode DETECT dans Zoneminder pour des caméras<br>- tester le bon fonctionnement de l'envoi d'un SMS depuis un modem GSM <br>- envoyer en cas d'intrusion, un E_mail, un SMS par intrernet ou par GSM<br> 
<img src="readme_img/image7.jpg" alt="Screenshot1" style="max-width: 100%;"><br>
Le test de la BD se fait sans mot de passe ; password=000000<br>
<img src="readme_img/image8.jpg" alt="Screenshot1" style="max-width: 100%;"><br><br>
Les pages optionnelles:<br>
<img src="readme_img/image5.jpg" alt="Screenshot1" style="max-width: 100%;"><br>
<img src="readme_img/image9.jpg" alt="Screenshot1" style="max-width: 100%;"><br>
<br>
Une vidéo  est disponible sur le site web : domo-site.fr<br>
<video width="320" height="240" poster="placeholder.png" controls ><source src="http://domo-site.fr/assets/video/monitor.mp4" type=video/mp4></video>
Un pdf de 419 pages à télécharger sur ce dépôt<br>
<img src="readme_img/pdf_monitor.jpg" alt="Screenshot1" style="max-width: 100%;"><br>
