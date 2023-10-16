-- Alarme absence et nuit maison
--
-- alarme--alarme.lua
-- version 3.0.0
--
function modect_cam(mode)
    json = (loadfile "scripts/lua/JSON.lua")()
       local config = assert(io.popen('/usr/bin/curl http://'..ip_monitor..'/monitor/admin/token.json'))
       local blocjson = config:read('*a')
       config:close()
       local jsonValeur = json:decode(blocjson)
       cle = jsonValeur.token
       for k,v in pairs(cam_modect) do --cam_modect dans string_modect
            --print(k)--pour essai
            command='/usr/bin/curl -XPOST http://'..ip_zoneminder..'/zm/api/monitors/'..k..'.json?token='..cle..' -d "Monitor[Function]='..mode..'&Monitor[Enabled]='..k..'"'
            print(command)
            os.execute(command) 
            print ("camera "..tostring(k).."activée :"..tostring(mode));
        end
end
function alerte_gsm(txt) -- ATTENTION PAS ESPACES pout txt
f = io.open("userdata/scripts/python/aldz.py", "w")
env="#!/usr/bin/env python3"
f:write(env.." -*- coding: utf-8 -*-\nx='"..txt.."'\npriority=1")
--f:write(env.." -*- coding: utf-8 -*-\nx='"..txt.."'\ntel='"..tel1.."'")
f:close()
print(txt)
end
--
-- chargement fichier contenant les variable de configuration
package.path = package.path..";www/modules_lua/?.lua"
require 'string_modect'
require 'connect'
--
-- listes des dispositifs
-- les capteurs d'ouverture et de présence DEVICE CHANGED
-- {capteur,etat,modif variable,contenu variable,notification,alarme}   alarme 0=absence et nuit 1=absence seulement 
local a1={'porte entree','Open','porte-ouverte','porte_ouverte_entree'};
local a2={'porte ar cuisine','Open','porte-ouverte','porte_ouverte_cuisine'};
local a3={'Porte_fenetre','Open',':porte-ouverte','fenetre_ouverte_sejour'};
local a4={'pir_salon_motion','On','intrusion','intrusion_salon'};
local a5={'pir ar cuisine_motion','On','intrusion','intrusion_cuisine'};
local A1={a1,a2,a3,a4,a5};local A2={a1,a2,a3};
--

--
local time = string.sub(os.date("%X"), 1, 5)
sirene=0;lampe=0
--
return {
	on = {
	
		devices = {
			'pir ar cuisine_motion',
		    'pir_salon_motion',
		    'porte entree',
		    'porte ar cuisine',
		    'porte_fenetre',
		    'ma_sirene',
		    'activation-sirene',
		    'Modect',
		    'alarme_nuit',
		    'al_nuit_auto',
		    'alarme_absence',
		    'raz_dz'},
		variables = { 
		    'ma-alarme',
		    'porte-ouverte',
		    'intrusion'},
	    timer = {
             'at 23:00',
             'at 06:00'}
		},
	execute = function(domoticz, item)
	    domoticz.log('Item ' .. item.name .. ' was changed', domoticz.LOG_INFO)
	    domoticz.variables('variable_sp').set("1")
 --*********************variables***************************************	
	-- alarme absence - 
        if (domoticz.variables('ma-alarme').value == "1") then 
            for k, v in ipairs(A1) do 
                if (device.name == (A1[k][1]) and device.state == A1[k][2] ) then 
        	        domoticz.variables(A1[k][3]).set(A1[k][4]);
        	    end
            end
        end
--      -- alarme nuit
        if (domoticz.variables('ma-alarme').value == "2") then 
            for k, v in ipairs(A2) do 
               if (item.name == (A2[k][1]) and item.state == A2[k][2] ) then 
        	   domoticz.variables(A2[k][3]).set(A2[k][4]);lampe=1;sirene=1;
        	   end
            end
--            --allumer lampes
            if (lampes==1) then devices('lampe_salon').switchOn();lampes="2"
            end    
        --mise en service sirene
            if (sirene==1) then devices('ma_sirene').switchOn();sirene="2"
            end 
            if (sirene==2 and domoticz.device('activation-sirene').state == 'On') then  devices('sirene_switch').switchOn();sirene="3"
            end    
        end  
        -- fin alarme nuit   
        if (domoticz.variables('porte-ouverte').changed) then  
	             txt=tostring(domoticz.variables('porte-ouverte').value) 
	             print("porte-ouverte")
                 alerte_gsm('alarmeù'..txt)
        end
        if (domoticz.variables('intrusion').changed) then  
	             txt=tostring(domoticz.variables('intrusion').value) 
	             print('intrusion')
                 alerte_gsm('alarmeù'..txt)
        end
  --*******************devices*********************************************            
        -- alarme auto
        if (item.name == 'al_nuit_auto' and  item.state=='On') then txt='alarme_nuit_auto_activee';alerte_gsm(txt); domoticz.variables('alarme').set("alarme_auto");
        elseif (item.name == 'al_nuit_auto' and  item.state=='Off') then txt='alarmeùnuitùautoùdesactivee';alerte_gsm(txt);domoticz.variables('alarme').set("0");
        end
        -- alarme absence _activation
        if (item.name == 'alarme_absence' and  item.state=='On' and  domoticz.variables('ma-alarme').value=="0") then
        domoticz.variables('ma-alarme').set("1"); txt='alarmeùabsenceùactivee';obj='alarme absence activee';alerte_gsm(txt) ; domoticz.email('Alarme',obj,adresse_mail)	
	    elseif (item.name == 'alarme_absence' and  item.state=='Off' and  domoticz.variables('ma-alarme').value=="1") then
        domoticz.variables('ma-alarme').set("0"); txt='alarmeùabsenceùdesactivee';obj='alarme absence desactivee';
        alerte_gsm(txt);alerte_gsm(txt) ; domoticz.email('Alarme',obj,adresse_mail)	
        end	
	    -- alarme nuit_activation
        if (item.name == 'alarme_nuit' and  item.state=='On' and  domoticz.variables('ma-alarme').value=="0") then 
        domoticz.variables('ma-alarme').set("2"); txt='alarmeùnuitùactivee';obj='alarme_nuit_activee';
        alerte_gsm(txt);domoticz.variables('alarme').set("alarme_nuit"); 	
	    elseif (item.name == 'alarme_nuit' and  item.state=='Off' and  domoticz.variables('ma-alarme').value=="2") then
        domoticz.variables('ma-alarme').set("0"); txt='alarmeùnuitùdesactivee';obj='alarme_nuit_desactivee';alerte_gsm(txt);
            if (domoticz.variables('alarme').value~='alarme_auto') then domoticz.variables('alarme').set("0");
            end
        end	
        -- activation de la detection par les cameras
	    if (item.name == 'Modect' and  item.state=='Off' and  domoticz.variables('ma-alarme').value=="1") then 
	    devices('Modect').switchOn();
	    end 
        -- activation manuelle Modect
	    if (item.name == 'Modect' and  item.state=='On' and  domoticz.variables('ma-alarme').value=="0") then
	    domoticz.variables('modect').set("modect");modect_cam('Modect')
	    -- activation manuelle Monitor 	
	    elseif (item.name == 'Modect' and  item.state=='Off' and  domoticz.variables('ma-alarme').value=="0") then
	    domoticz.variables('modect').set("monitor");modect_cam('Monitor')
        end 
        -- activation sirène
        if (item.name == 'activation-sirene' and  item.state=='On') then domoticz.variables('activation-sir-txt').set("désactiver");
        else domoticz.variables('activation-sir-txt').set("activer");
        end           
        -- raz variables de notification intrusion et porte ouverte
        if (item.name == 'raz_dz' and item.state=='On') then domoticz.devices('raz_dz').switchOff();
        domoticz.variables('intrusion').set("0");domoticz.variables('porte-ouverte').set("0");
        end
 --******************************timer********************************************    
        if (time=='23:00') then
            if(domoticz.devices('al_nuit_auto').state == "On")  then 
                domoticz.devices('alarme_nuit').switchOn();print('al_nuit=ON')
            end
        elseif (time=='06:00') then    
            if(domoticz.devices('al_nuit_auto').state == "On")  then 
                domoticz.variables('alarme').set('alarme_auto');
                domoticz.devices('alarme_nuit').switchOff();print('al_nuit=OFF')    
            end
        end
end
}
		
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	