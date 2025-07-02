-- script notifications_devices version  2.1.6
 -- le caractère ù est utilisé pour afficher un espace lors d'une notification SMS  ;le modem n'utilise pas UTF8
package.path = package.path..";/opt/domoticz/www/modules_lua/?.lua"
require 'connect'
adresse_mail=mail_gmail -- mail_gmail dans connect.lua
local base64 = require'base64'
--local user_free = base64.decode(login_free);local passe_free = base64.decode(pass_free);
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
			'lampe_poele',
			'lampe_entree',
			'grand_portail',
			'gd_portail',
			'porte_veranda_sud'
	      	}
	     },
 
 execute = function(domoticz, device)
        domoticz.log('device '..device.id..' was changed', domoticz.LOG_INFO)
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