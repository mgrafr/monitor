<?php
require_once (MONCONFIG);

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

if (IsDir_or_CreateIt(BACKUP_DB)==true){
// SERVEUR SQL connexion
$conn = new mysqli(SERVEUR,UTILISATEUR,MOTDEPASSE,DBASE);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error . "<br>");
}
	echo $choix;
switch($choix){
	case 14:	
shell_exec(' mysqldump  --databases '.DBASE.' --user='.UTILISATEUR.' --password='.MOTDEPASSE.' > '.BACKUP_DB.'/'.DBASE.'.sql');echo 'SUCCES:';
break;
	case 27:
shell_exec(' mysql --databases '.DBASE.' --user='.UTILISATEUR.' --password='.MOTDEPASSE.' < '.BACKUP_DB.'/'.DBASE.'.sql');echo 'SUCCES:';
break;
	default:
echo "break"	;
break;
}}
else echo "erreur";
?>