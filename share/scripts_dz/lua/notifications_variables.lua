-- script notifications_variables version 2.1.3
-- le caractère ù est utilisé pour afficher un espace lors d'une notification SMS  ;le modem n'utilise pas UTF8
package.path = package.path..";/opt/domoticz/www/modules_lua/?.lua"
-- pour upload (upload_fichier.py),mot passe et login base64, 
require 'connect'
adresse_mail=mail_gmail -- mail_gmail dans connect.lua
local base64 = require'base64'


-- repertoire du script python
rep='/opt/domoticz/scripts/python/'
-- repertoire log
rep_log='/home/michel/'
--
return {
	on = {
		variables = {
			'alarme_bat',
		    'boite_lettres',
		    'upload',
		    'zm_cam',
		    'pression-chaudiere',
		    'pilule_chat',
		    'BASH',
		    'variable_sp',
		    'activation-sir-txt'
		}
	},
	execute = function(domoticz, variable)
	    --domoticz.log('Variable ' .. variable.name .. ' was changed', domoticz.LOG_INFO)
	          
	            if (domoticz.variables('pression-chaudiere').value == "manque_pression") then  
	             txt=tostring(domoticz.variables('pression-chaudiere').value) 
	             domoticz.variables('pression-chaudiere').set('pression_basse')
	 	         print("envoi SMS pression-chaudiere")
                 alerte_gsm('alarme_'..txt);domoticz.email('Alarme pression chaudiere',txt,adresse_mail) 
               end
	        
	           if ((domoticz.variables('zm_cam').changed) and (domoticz.variables('zm_cam').value ~= "0")) then  
	             txt=tostring(domoticz.variables('zm_cam').value) 
	             domoticz.variables('zm_cam').set('0')
	 	         print("envoi SMS alarme zm")
                 alerte_gsm('alarme_zoneminder_'..txt)
               end
          
	 	    if (domoticz.variables('alarme_bat').changed) then 
	 	    print('alarme bat')
	 	        if (domoticz.variables('alarme_bat').value == "batterie_faible") then 
	                if domoticz.variables('not_alarme_bat').value == "0" then
	                 txt="pile faible" ; fich_log="bateries.log"  
	                 --envoi_email(txt,fich_log)
                     domoticz.email('Alarme_bat',txt,adresse_mail) 
	                 domoticz.variables('not_alarme_bat').set('1')
	            elseif (domoticz.variables('alarme_bat').value == "batterie_forte") then
	                 domoticz.variables('not_alarme_bat').set('0')
                    end
                 end 
            end
            if (domoticz.variables('boite_lettres').changed) then
                if (domoticz.variables('boite_lettres').value == "0") then 
                print("topic envoyé : esp/in/boite_lettres")
                 local command = "scripts/python/mqtt.py esp/in/boite_lettres valeur 0  >> "..rep_log.."esp.log 2>&1" ;
                 os.execute(command);    
                end 
            end 
            if ((domoticz.variables('upload').changed) and (domoticz.variables('upload').value ~= "0")) then
                if (domoticz.variables('upload').value == "4") then 
                print("upload table_zb_zw")
                command = rep..'upload_fichier.py table_zigbee.lua   > '..rep_log..'table_zigbee.log 2>&1'
                os.execute(command);print('maj effectuée_4');
                elseif (domoticz.variables('upload').value == "1") then 
                print("upload string_tableaux")
                command = rep..'upload_fichier.py string_tableaux.lua   > '..rep_log..'string_tableaux.log 2>&1'
                os.execute(command);print('maj effectuée_1');
                --elseif (domoticz.variables('upload').value == "2") then -----devenu string_modect.json dans admin/monitor
                --print("upload string_modect")
                --command = rep..'upload_fichier.py string_modect.json   > '..rep_log..'string_modect.log 2>&1'
                --os.execute(command);print('maj effectuée_2');
                elseif (domoticz.variables('upload').value == "connect") then 
                print("upload connect")
                command = rep..'upload_fichier.py connect.lua  > '..rep_log..'connect.log 2>&1';os.execute(command);
                command = rep..'upload_fichier.py connect.py  > '..rep_log..'connect.log 2>&1';os.execute(command);
                print('maj effectuée_3');
                
                domoticz.variables('BASH').set("restart_sms_dz")
                end
                domoticz.variables('upload').set('0')   
            end
               
            
            if (domoticz.variables('pilule_chat').changed) then 
                 if (domoticz.variables('pilule_chat').value ~= "0") then 
	             txt=tostring(domoticz.variables('pilule_chat').value) 
	             print('médicaments')
                 alerte_gsm('alerte_'..txt)
                 end
            end
            if (domoticz.variables('BASH').changed) then 
                 if (domoticz.variables('BASH').value ~= "0") then 
	             domoticz.variables('variable_sp').set('2')
	             print('variable_sp')
                 end
            end
    end
   
}
