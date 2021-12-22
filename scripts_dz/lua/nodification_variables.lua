-- script notifications_autres
function alerte_gsm(txt)
f = io.open("/home/michel/domoticz/scripts/python/aldz.py", "w")
env="#!/usr/bin/env python3.7"
f:write(env.." -*- coding: utf-8 -*-\nx='"..txt.."'")
f:close()
end
-- repertoire du script python
rep='/home/michel/domoticz/scripts/python/'
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
		}
	},
	execute = function(domoticz, variable)
	    domoticz.log('Variable ' .. variable.name .. ' was changed', domoticz.LOG_INFO)
	        
	           if ((domoticz.variables('zm_cam').changed) and (domoticz.variables('zm_cam').value ~= "0")) then  
	             txt=tostring(domoticz.variables('zm_cam').value) 
	             domoticz.variables('zm_cam').set('0')
	 	         print("envoi SMS alarme zm")
                 alerte_gsm('alarme_zoneminder_'..txt)
               end
          
	 	    if (domoticz.variables('alarme_bat').changed) then    
	 	        if (domoticz.variables('alarme_bat').value == "batterie_faible") then 
	                if domoticz.variables('not_alarme_bat').value == "0" then 
	            os.execute("curl --insecure  'https://smsapi.free-mobile.fr/sendmsg?user=12812620&pass=2FQTMM7x42kspr&msg=pile faible' >> "..rep_log.."OsExecute1.log 2>&1")	      
                domoticz.variables('not_alarme_bat').set('1')
                    end
                end 
            end
            if (domoticz.variables('boite_lettres').changed) then
                if (domoticz.variables('boite_lettres').value == "0") then 
                print("topic envoyé : esp/in/boite_lettres")
                 local command = "/home/michel/domoticz/scripts/python/mqtt.py esp/in/boite_lettres valeur 0   >> "..rep_log.."esp.log 2>&1" ;
                 os.execute(command);    
                end 
           end 
            if ((domoticz.variables('upload').changed) and (domoticz.variables('upload').value ~= "0")) then
                if (domoticz.variables('upload').value == "1") then 
                print("upload string_tableaux");
               command = rep..'upload_fichier.py string_tableaux.lua  > '..rep_log..'string_tableaux.log 2>&1'
               elseif (domoticz.variables('upload').value == "2") then 
                print("upload string_modect")
               command = rep..'upload_fichier.py string_modect.lua  > '..rep_log..'string_modect.log 2>&1'
               end
                --print(command);
               os.execute(command);print('maj effectuée');
               domoticz.variables('upload').set('0')   
               
           end 
           
    end
}

