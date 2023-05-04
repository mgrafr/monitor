<?php

$connection = ssh2_connect('192.168.1.8', 22);
if (ssh2_auth_password($connection, 'michel', 'Idem4546')) {
  echo "Authentication Successful!\n";
  //envoi de la commande
switch ($mode) {
    case "ssh":
$stream = ssh2_exec($connection, 'bash "/var/www/html/./reboot.sh"  >> /home/michel/sms.log 2>&1');
break;
    case "scp_r":
$remote_file_name="/etc/msmtprc";$file_name="msmtprc";
$local_path=MSMTPRC_LOC_PATH;		
if (!@ssh2_scp_recv($connection,$remote_file_name, $local_path.$file_name));
{    $errors= error_get_last();if ($errors['message']=="")$errors['message']="pas d'erreur"; 
    echo "<br>TEST ERROR: ".$errors['type'];
    echo "<br />\n".$errors['message'].'<br>';} 
break;
case "scp_s" :
$stream=ssh2_scp_send($connection, '/local/filename', '/remote/filename', 0644);		
break;
default:
}		
  
//stream_set_blocking($stream, true);
		//if($output = stream_get_contents($stream)){echo $output."<br>";}
} 
else {die('Authentication Failed...');}



?>