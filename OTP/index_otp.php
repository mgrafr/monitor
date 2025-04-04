<?php
session_start();
if(!isset($_SESSION["config"])) {echo "accès interdit";exit;}
$conf=$_SESSION["config"];
require("../".$conf);
include ('phpqrcode/qrlib.php');
require_once("PragmaRX/Google2FA/Google2FA.php");
require_once('../fonctions.php');
use PragmaRX\Google2FA\Google2FA;
$data= [
    'command' => '14'];
$row=mysql_app($data);
$token=$row['token'];
$sms=$row['sms'];
$user_free=$row['user_free'];
$pass_free=$row['pass_free'];
// Start Session
if(!session_id())
{
    session_start();
}
$googleOTP = new Google2FA();
if ($token == ""){
 $maj_bd=true;   
// Generate a secret key
$user = [
    'google2fa_secret' => $googleOTP->generateSecretKey(), 
    'email' => 'monitor.la-Truffiere.ovh'
];
// Provide name of app
$app_name = 'OTP authenticator';
// Generate a custom URL from user data
$qrCodeUrl = $googleOTP->getQRCodeUrl($app_name, $user['email'], $user['google2fa_secret']);
// Generate QR Code image with GD
$name = urlencode($user['email']);
$issuer = urlencode($app_name);
ob_start();
QRCode::png($qrCodeUrl, null, QR_ECLEVEL_L, 3, 4);
$newpng = base64_encode( ob_get_contents() );
ob_end_clean();
$src = 'data: image/png; base64,'.$newpng;
echo "<p>SI VOUS N'UTILISEZ PAS LE QR CODE,<br>Veuillez saisir le code suivant dans votre application: <br>
<br><span style='font-size:20px;color:darkblue'>".$user['google2fa_secret'].'</span></p>';
// Get current OTP (for debugging)
$current_otp = $googleOTP->getCurrentOtp($user['google2fa_secret']); 
}
else {
$current_otp = $googleOTP->getCurrentOtp($token); 
$user = [
        'google2fa_secret' => $token, 
        'email' => 'monitor.la-Truffiere.ovh'
    ];
} 
//echo $current_otp;// pour debug  
 // Store user data in the session
 $_SESSION['user'] = $user;
 $_SESSION['current_otp'] = $current_otp;  
 if ($sms==1){
 $content="#!/usr/bin/env python3 -*- coding: utf-8 -*- \nx='Code:".$current_otp."' \npriority=0";
 file_put_contents('/var/www/monitor/python/aldz.py',$content);
 }
 if ($sms==2){
    $cmd='wget "https://smsapi.free-mobile.fr/sendmsg?user='.$user_free.'&pass='.$pass_free.'&msg="'.$current_otp;
    shell_exec( $cmd );
   }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>OTP - monitor</title>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
 </head>
<body>
    <h1>OTP - Monitor </h1>
    
    <div id="qrcode" style="margin-top: 20px;">
        <img src="<?php echo $src; ?>"/>
    </div>
    
    <h2>Verification  OTP</h2>
    <form id="verify-form">
        <input type="text" id="otp" placeholder="Entrer le code">
        <button type="submit">Verification</button>
    </form>

    <script>
//API for get requests
maj_bd="<?php echo  $maj_bd;?>";

        $(function() 
        {
            // Verify OTP
            $('#verify-form').on('submit', function(e) {
                e.preventDefault();
                var otp = $('#otp').val();
                if(!otp) {
                    alert('Please input your OTP code!');
                    return false;
                }
                 $.ajax({
                    url: 'verify_otp.php',
                    method: 'POST',
                    data: { otp: otp ,'maj_bd':maj_bd},
                    dataType: 'json',
                    success: function(data) {
                        if(data.result === true) {
                            //'<%Session["valid"] = "' + "123456"+ '"; %>';
                            alert('OTP code is OK'); 
                         //  HTTP redirect
                            window.location.replace("../index_loc.php");   
                        }
                        else {
                            alert('OTP code is wrong! Please input valid OTP code!');
                        }
                    }
                });
            });
        });
    </script>
</body>
</html>