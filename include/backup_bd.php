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
$query=	' mysql --databases monit --user='.UTILISATEUR.' --password='.MOTDEPASSE.' < '.$_POST['textfield'].';';		
echo $query;
echo'<form name="form_backup" method="post" action="'.$_SERVER['PHP_SELF'].'"
  <label>Chemin du Backup :<br><input type="text" name="textfield" id="textfield" style="width:400px;margin-left:10px;" value="/var/www/html/monitor/DB_Backup/monitor.sql" >
  <input type="submit" name="button" id="button" value="Submit"></label>
  </form>';		
if (!empty($_POST['textfield'])) {
shell_exec($query);  
echo "Restauration réussie";		}
    
	
break;	
	default:
echo "break"	;
}
	
}
else echo "erreur";
?>