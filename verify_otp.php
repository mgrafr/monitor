<?php

require_once("PragmaRX/Google2FA/Google2FA.php");
require_once('fonctions.php');
use PragmaRX\Google2FA\Google2FA;


// Start Session
if(!session_id())
{
    session_start();
}

// Validate incoming request

if(empty($_POST['otp']) || empty($_SESSION['user']['google2fa_secret'])) {
    die(json_encode(['result' => false]));
}

// Initialize
$googleOTP = new Google2FA();

// Retrieve One Time Password from payload
$otp = $_POST['otp'];
$_SESSION['otp'] = $otp; 
// Verify provided OTP
$isValid = $googleOTP->verifyKey($_SESSION['user']['google2fa_secret'], $otp);
//maj sql
if ($isValid ===true && $_POST['maj_bd'] == true){
$data= [
    'command' => '15',
    'token' => $_SESSION['user']['google2fa_secret'] ];
mysql_app($data);
}
// Generate and print JSON response
$retour=json_encode([
    'provided_otp' => $otp, 
    'result' => $isValid
 ]);
echo $retour;
?>