<?php
require_once (MONCONFIG);

if (IsDir_or_CreateIt(BACKUP_DB)==true){
// SERVEUR SQL connexion
$conn = new mysqli(SERVEUR,UTILISATEUR,MOTDEPASSE,DBASE);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error . "<br>");
}
// Génération du fichier de sauvegarde dans le répertoire DB_Backup
shell_exec(' mysqldump  --databases '.DBASE.' --user='.UTILISATEUR.' --password='.MOTDEPASSE.' > '.BACKUP_DB.'/'.DBASE.'.sql');echo 'SUCCES:';

}
function IsDir_or_CreateIt($path) {
      if(is_dir($path)) {
        return true;
      } else {
        if(mkdir($path)) {
          return true;
        } else {
          return false;
        }
      }
    }

?>