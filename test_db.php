<?php
// ------------------------------------------------------------------------- //
// Test de connection à MySQL                                                //
// ------------------------------------------------------------------------- //
echo "test....BD<br>";
//Paramètres
$sql_host = "localhost";
$sql_user = "root";
$sql_pwd = "Idem4546";
//$sql_port = "3306";
$sql_db = "domoticz";

if($id = mysqli_connect($sql_host,$sql_user,$sql_pwd))//Si j'arrive à me connecter avec ses paramêtres
{ if($id_db = mysqli_select_db($sql_db))//Puis à cette base de données
 { echo "Succès !";//Ça roule !
 }else{
 die("Echec .....vérifier user et pass");//Ou impossible de se connecter à la base :( (vous êtes connectez au serveur mais impossible //de sélectionner la base $sql_db)
 }
 
mysqli_close($id);
}else{
die("Echec total......vérifier host, user");//
}
?>
