  -- script notifications_devices version  2.1.3
 -- le caractère ù est utilisé pour afficher un espace lors d'une notification SMS  ;le modem n'utilise pas UTF8
package.path = package.path..";www/modules_lua/?.lua"
require 'connect'
adresse_mail=mail_gmail -- mail_gmail dans connect.lua
local base64 = require'base64'
--local user_free = base64.decode(login_free);local passe_free = base64.decode(pass_free);


function send_sms(txt)
os.execute('/bin/bash userdata/scripts/bash/./pushover.sh '..txt..' >>  /opt/domoticz/userdata/push3.log 2>&1');
end
function alerte_gsm(txt) -- ATTENTION PAS ESPACES pout txt
f = io.open("userdata/scripts/python/aldz.py", "w")
env="#!/usr/bin/env python3"
f:write(env.." -*- coding: utf-8 -*-\nx='"..txt.."'\npriority=1")
--f:write(env.." -*- coding: utf-8 -*-\nx='"..txt.."'\ntel='"..tel1.."'")
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
            domoticz.variables('variable_sp').set("1")
            txt='alarmeùpiùhs';obj='alarme pi hs';alerte_gsm(txt);domoticz.email('Alarme',obj,adresse_mail) 
            elseif (device.name == 'Ping_pi4' and  device.state=='On' and domoticz.variables('pi-alarme').value == "pi_hs") then 
            domoticz.variables('pi-alarme').set("0")
            txt='alarmeùPIùdeùnouveauùOK';obj='alarme PI de nouveau OK';alerte_gsm(txt);domoticz.email('Alarme',obj,adresse_mail) 
            end
            --
            if (device.name == 'Test_GSM' and  device.state=='On') then print ("test_gsm")
            txt='TestùGSMùOK';alerte_gsm(txt);send_sms(txt)
            obj='Test GSM OK';domoticz.email('Alarme',obj,adresse_mail)    
            end
            -- alarme auto
            if (device.name == 'al_nuit_auto' and  device.state=='On') then txt='alarme_nuit_auto_activee';alerte_gsm(txt); domoticz.variables('alarme').set("alarme_auto");
            elseif (device.name == 'al_nuit_auto' and  device.state=='Off') then txt='alarmeùnuitùautoùdesactivee';alerte_gsm(txt);domoticz.variables('alarme').set("0");
            end
            -- alarme absence _activation
             if (device.name == 'alarme_absence' and  device.state=='On' and  domoticz.variables('ma-alarme').value=="0") then
                domoticz.variables('ma-alarme').set("1"); txt='alarmeùabsenceùactivee';obj='alarme absence activee';alerte_gsm(txt) ; domoticz.email('Alarme',obj,adresse_mail)	
	         elseif (device.name == 'alarme_absence' and  device.state=='Off' and  domoticz.variables('ma-alarme').value=="1") then
                domoticz.variables('ma-alarme').set("0"); txt='alarmeùabsenceùdesactivee';obj='alarme absence desactivee';
                alerte_gsm(txt);alerte_gsm(txt) ; domoticz.email('Alarme',obj,adresse_mail)	
          	end	
	        -- alarme nuit_activation
             if (device.name == 'alarme_nuit' and  device.state=='On' and  domoticz.variables('ma-alarme').value=="0") then 
                domoticz.variables('ma-alarme').set("2"); txt='alarmeùnuitùactivee';obj='alarme_nuit_activee';
                alerte_gsm(txt);domoticz.variables('alarme').set("alarme_nuit"); 	
	         elseif (device.name == 'alarme_nuit' and  device.state=='Off' and  domoticz.variables('ma-alarme').value=="2") then
                domoticz.variables('ma-alarme').set("0"); txt='alarmeùnuitùdesactivee';obj='alarme_nuit_desactivee';alerte_gsm(txt);
                    if (domoticz.variables('alarme').value~='alarme_auto') then domoticz.variables('alarme').set("0");
                    end
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