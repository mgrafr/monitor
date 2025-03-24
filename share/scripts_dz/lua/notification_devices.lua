 -- script notifications_devices version  2.1.5
 -- le caractère ù est utilisé pour afficher un espace lors d'une notification SMS  ;le modem n'utilise pas UTF8
package.path = package.path..";www/modules_lua/?.lua"
require 'connect'
adresse_mail=mail_gmail -- mail_gmail dans connect.lua
local base64 = require'base64'
--local user_free = base64.decode(login_free);local passe_free = base64.decode(pass_free);

function send_sse(sxt,sxt1)
    print(sxt,sxt1)
local api_mon="curl --insecure  'http://"..ip_monitor.."/monitor/api/json.php?app=maj&id="..sxt.."&state="..sxt1.."' > sse.log 2>&1" 
print(api_mon)
os.execute(api_mon)
end
function send_topic(txt,txt1)
local sse = 'python3 scripts/python/sse.py '..txt..' '..txt1..' >  /opt/domoticz/sse.log 2>&1' ;
print(sse);
os.execute(sse)
end
function send_sms(txt)
os.execute('/bin/bash scripts/bash/./pushover.sh '..txt..' >>  /opt/domoticz/push3.log 2>&1');
end
function alerte_gsm(txt) -- ATTENTION PAS ESPACES pout txt
f = io.open("scripts/python/aldz.py", "w")
env="#!/usr/bin/env python3"
f:write(env.." -*- coding: utf-8 -*-\nx='"..txt.."'\npriority=1")
--f:write(env.." -*- coding: utf-8 -*-\nx='"..txt.."'\ntel='"..tel1.."'")
f:close()
print(txt)
end
-- repertoire du script python
rep='scripts/python/'
-- repertoire log
rep_log='/home/michel/'

--
return {
	on = {
		devices = {
		    'SOS (Action)_emergency',
			'Ping_pi4',
			'lampe_terrasse',
			'lampe_jardin',
			'Chauffe-serviettes',
			'lampe_bureau',
			'lampe_entree',
			'grand_portail',
			'gd_portail'
	      	}
	     },
 
 execute = function(domoticz, device)
        domoticz.log('device '..device.name..' was changed', domoticz.LOG_INFO)
            --domoticz.variables('variable_sp').set("1")
            if (device.name ~= "SOS (Action)_emergency") then send_sse(device.id,device.state)
            end    
            if (device.name == 'Ping_pi4' and  device.state=='Off' and domoticz.variables('pi-alarme').value == "0") then 
            domoticz.variables('pi-alarme').set("pi_hs")
            --domoticz.variables('variable_sp').set("1")
            txt='alarmeùpiùhs';obj='alarme pi hs';alerte_gsm(txt);domoticz.email('Alarme',obj,adresse_mail) 
            elseif (device.name == 'Ping_pi4' and  device.state=='On' and domoticz.variables('pi-alarme').value == "pi_hs") then 
            domoticz.variables('pi-alarme').set("0")
            txt='alarmeùPIùdeùnouveauùOK';obj='alarme PI de nouveau OK';alerte_gsm(txt);domoticz.email('Alarme',obj,adresse_mail) 
            elseif (device.name == 'SOS (Action)_emergency') then 
            txt='alarmeùSOS';obj='alarme SOS';alerte_gsm(txt);domoticz.email('Alarme',obj,adresse_mail) 
             end
            --
            
            ----if (device.name == 'lampe_terrasse' or  device.name=='lampe_jardin' or device.name == 'Chauffe-serviettes') then domoticz.variables('variable_sp').set("1") 
            --end
        end  
    }