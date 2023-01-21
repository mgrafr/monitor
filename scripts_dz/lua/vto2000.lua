--vto2000 Dahua exploiter le changement de valeur d' une variable 
-- pour signaler l' appui sur le portier video vto2000
--

commandArray = {}
--
-- 
if (uservariables['sonnette']=="1") then 
--          envoi sms 
            os.execute("curl --insecure  'https://smsapi.free-mobile.fr/sendmsg?user=LOGIN&pass=MOT_PASSE&msg=on sonne au portier' >> /home/michel/OsExecute1.log 2>&1")
--          envoi image pushover ---------------
            os.execute("echo 'MOT_PASSE' |sudo -S /home/michel/domoticz/scripts/pushover_img.sh >> /home/michel/push.log 2>&1");
            commandArray['Variable:sonnette'] = '0'
--        
--    
end

return commandArray