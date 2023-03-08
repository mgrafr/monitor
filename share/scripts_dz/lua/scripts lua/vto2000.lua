--vto2000 Dahua exploiter le changement de valeur d' une variable 
-- pour signaler l' appui sur le portier video vto2000
--

commandArray = {}
--
-- 
if (uservariables['sonnette']=="1") then 
--          envoi sms 
            os.execute("curl --insecure  'https://smsapi.free-mobile.fr/sendmsg?user=12812620&pass=2FQTMM7x42kspr&msg=on sonne au portier' >> /home/michel/OsExecute1.log 2>&1")
--          envoi image pushover ---------------
            os.execute("/bin/bash userdata/scripts/bash/pushover_img.sh >> /home/michel/push.log 2>&1");
            commandArray['Variable:sonnette'] = '0'
--        
--    
end

return commandArray