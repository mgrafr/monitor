<textarea id="adm1" style="height:'.$height.'px;" name="command" >
<?php
echo "test....BD<br>";
// Create connection
$con = new mysqli(SERVEUR, UTILISATEUR, MOTDEPASSE);
// Check connection
if ($con->connect_error) {   die("Pas de connexion au serveur: " . $con->connect_error);}
else echo " connection au serveur OK , ..";
$conn = new mysqli(SERVEUR, UTILISATEUR, MOTDEPASSE, DBASE);
if ($conn->connect_error) { die("Verifier le nom de la BD: " . $conn->connect_error);}
echo " connection à la BD OK , ..";
echo "connexion terminée , ..";
?>
</textarea>
