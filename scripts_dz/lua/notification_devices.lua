 -- script notifications_devices
function envoi_mail(txt)
os.execute("curl --insecure  'https://smsapi.free-mobile.fr/sendmsg?user=12812620&pass=2FQTMM7x42kspr&msg="..txt.."' >> /home/michel/OsExecute1.log 2>&1")
os.execute("python3 /opt/domoticz/userdata/scripts/python/pushover.py "..txt.." >> /home/michel/push.log 2>&1");
end
function alerte_gsm(txt) -- ATTENTION PAS ESPACES pout txt
f = io.open("userdata/scripts/python/aldz.py", "w")
env="#!/usr/bin/env python3"
f:write(env.." -*- coding: utf-8 -*-\nx='"..txt.."'")
f:close()
print(txt)
end
-- repertoire du script python
rep='userdata/scripts/python/'
-- repertoire log
rep_log='/home/michel/'
-- fichiers des variables sur disque
--package.path = package.path..";www/modules_lua/?.lua"
--require 'string_alarmes'
--
return {
	on = {
		devices = {
			'Ping_pi4',
			'Test_GSM',
			'al_nuit_auto',
			'alarme_absence',
			'alarme_nuit',
			'Modect',
			'activation-sirene',
			'raz_dz'
		}
	},
 
 
 execute = function(domoticz, device)
        domoticz.log('device '..device.name..' was changed', domoticz.LOG_INFO)
            if (device.name == 'Ping_pi4' and  device.state=='Off' and domoticz.variables('pi-alarme').value == "0") then 
            domoticz.variables('pi-alarme').set("pi_hs")
            txt='alarme_pi_hs';alerte_gsm(txt)
            elseif (device.name == 'Ping_pi4' and  device.state=='On' and domoticz.variables('pi-alarme').value == "pi_hs") then 
            domoticz.variables('pi-alarme').set("0")
            txt='alarme_PI_de_nouveau_OK';alerte_gsm(txt);envoi_mail(txt)
            end
            --
            if (device.name == 'Test_GSM' and  device.state=='On') then
            txt='Test_GSM_OK';alerte_gsm(txt);envoi_mail(txt)
            end
            -- alarme auto
            if (device.name == 'al_nuit_auto' and  device.state=='On') then txt='alarme_nuit_auto_activee';alerte_gsm(txt); domoticz.variables('alarme').set("alarme_auto");
            elseif (device.name == 'al_nuit_auto' and  device.state=='Off') then txt='alarme_nuit_auto_desactivee';alerte_gsm(txt);domoticz.variables('alarme').set("0");
            end
            -- alarme absence _activation
             if (device.name == 'alarme_absence' and  device.state=='On' and  domoticz.variables('ma-alarme').value=="0") then
                domoticz.variables('ma-alarme').set("1"); txt='alarme_absence_activee';alerte_gsm(txt) 	
	         elseif (device.name == 'alarme_absence' and  device.state=='Off' and  domoticz.variables('ma-alarme').value=="1") then
                domoticz.variables('ma-alarme').set("0"); txt='alarme_absence_desactivee';alerte_gsm(txt)
          	end	
	        -- alarme nuit_activation
             if (device.name == 'alarme_nuit' and  device.state=='On' and  domoticz.variables('ma-alarme').value=="0") then 
                domoticz.variables('ma-alarme').set("2"); txt='alarme_nuit_activee';alerte_gsm(txt);domoticz.variables('alarme').set("alarme_nuit"); 	
	         elseif (device.name == 'alarme_nuit' and  device.state=='Off' and  domoticz.variables('ma-alarme').value=="2") then
                domoticz.variables('ma-alarme').set("0"); txt='alarme_nuit_desactivee';alerte_gsm(txt);domoticz.variables('alarme').set("0"); 
          	end	
            -- activation de la detection par les cameras
	        if (device.name == 'Modect' and  device.state=='Off' and  domoticz.variables('ma-alarme').value=="1") then 
	            devices('Modect').switchOff();
	        end 
            -- activation manuelle Modect
	        if (device.name == 'Modect' and  device.state=='On' and  domoticz.variables('ma-alarme').value=="0" and domoticz.variables('modect').value=="0") then
	            domoticz.variables('modect').set("modect");
	    	     -- activation manuelle Monitor 	
	        elseif (device.name == 'Modect' and  device.state=='Off' and  domoticz.variables('ma-alarme').value=="0" and domoticz.variables('modect').value=="1" ) then
	            domoticz.variables('modect').set("monitor");
            end 
            -- activation sirène
            if (device.name == 'activation-sirene' and  device.state=='On') then domoticz.variables('activation-sir-txt').set("désactiver");
            else domoticz.variables('activation-sir-txt').set("activer");
            end           
            -- raz variables de notification intrusion et porte ouverte
            if (device.name == 'raz_dz' and  device.state=='On') then domoticz.devices('raz_dz').switchOff();
                domoticz.variables('intrusion').set("0");domoticz.variables('porte-ouverte').set("0");
            end
       
           
        end  
    }