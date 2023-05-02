<?php

$connection = ssh2_connect('192.168.1.8', 22);
if (ssh2_auth_password($connection, 'michel', 'Idem4546')) {
  echo "Authentication Successful!\n";
  //envoi de la commande	
  $stream = ssh2_exec($connection, 'bash "/var/www/html/./reboot.sh"  >> /home/michel/sms.log 2>&1');
  //stream_set_blocking($stream, true);
		//if($output = stream_get_contents($stream)){echo $output."<br>";}
} 
else {die('Authentication Failed...');}



?>