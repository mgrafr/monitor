  -- script notifications_devices version  2.1.4
 -- le caractère ù est utilisé pour afficher un espace lors d'une notification SMS  ;le modem n'utilise pas UTF8
package.path = package.path..";www/modules_lua/?.lua"
require 'connect'
adresse_mail=mail_gmail -- mail_gmail dans connect.lua
local base64 = require'base64'
--local user_free = base64.decode(login_free);local passe_free = base64.decode(pass_free);

function send_topic(txt)
os.execute('/opt/domoticz/userdata/scripts/python/mqtt.py  monitor/dz value '..txt..'   >>  /opt/domoticz/userdata/push3.log 2>&1');
end
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

--
return {
	on = {
		devices = {
			'Ping_pi4',
			'Test_GSM',
			'lampe_terrasse',
			'lampe_jardin',
			'Chauffe-serviettes'}
	     },
 
 execute = function(domoticz, device)
        domoticz.log('device '..device.id..' was changed', domoticz.LOG_INFO)
            send_topic(device.id)
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
            if (device.name == 'lampe_terrasse' or  device.name=='lampe_jardin' or device.name == 'Chauffe-serviettes') then domoticz.variables('variable_sp').set("1") 
            end
            
        end  
    }