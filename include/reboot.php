<?php
/* Notify the user if the server terminates the connection */
return;


$connection = ssh2_connect('192.168.1.8', 22);
if (ssh2_auth_password($connection, 'michel', 'Idem4546')) {
  echo "Authentication Successful!\n";
	
			//demarrage de la base de donnée	
			$stream = ssh2_exec($connection, 'bash "/var/www/html/./reboot.sh"  >> /home/michel/sms.log 2>&1');
			
} else {
  die('Authentication Failed...');
}



?>