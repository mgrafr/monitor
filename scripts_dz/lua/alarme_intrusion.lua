-- Alarme absence et nuit maison
--
-- alarme--alarme.lua
-- version 2.1.0
--
function modect_cam(mode)
    json = (loadfile "scripts/lua/JSON.lua")()
       local config = assert(io.popen('/usr/bin/curl http://192.168.1.7/monitor/admin/token.json'))
       local blocjson = config:read('*a')
       config:close()
       local jsonValeur = json:decode(blocjson)
       cle = jsonValeur.token
       for k,v in pairs(cam_modect) do 
            --print(k)--pour essai
            command='/usr/bin/curl -XPOST http://192.168.1.9/zm/api/monitors/'..k..'.json?token='..cle..' -d "Monitor[Function]='..mode..'&Monitor[Enabled]='..k..'"'
            print(command)
            os.execute(command) 
            print ("camera "..tostring(k).."activée :"..tostring(mode));
        end
end
--
-- chargement fichier contenant les variable de configuration
package.path = package.path..";www/modules_lua/?.lua"
require 'string_modect'
--
-- listes des dispositifs
-- les capteurs d'ouverture et de présence DEVICE CHANGED
-- {capteur,etat,modif variable,contenu variable,notification,alarme}   alarme 0=absence et nuit 1=absence seulement 
local a1={'porte entree','Open','porte-ouverte','porte_ouverte_entree'};
local a2={'porte ar cuisine','Open','porte-ouverte','porte_ouverte_cuisine'};
local a3={'Porte fenetre sejour','Open',':porte-ouverte','fenetre_ouverte_sejour'};
local a4={'temp_pir_salon_motion','On','intrusion','intrusion_salon'};
local a5={'temp_pir ar cuisine_motion','On','intrusion','intrusion_cuisine'};
local A1={a1,a2,a3,a4,a5};local A2={a1,a2};
--

--
local time = string.sub(os.date("%X"), 1, 5)
sirene=0
--
return {
	on = {
	
		devices = {
			'temp_pir ar cuisine_motion',
		    'temp_pir_salon_motion',
		    'porte entree',
		    'porte ar cuisine'
				}
	},
	execute = function(domoticz, device)
	   	    domoticz.log('Variable ' .. device.name .. ' was changed', domoticz.LOG_INFO)
	 
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
               if (device.name == (A2[k][1]) and device.state == A2[k][2] ) then 
        	   domoticz.variables(A2[k][3]).set(A2[k][4]);
        	   end
            end
--            --allumer lampes
          --      if (lampes==1) then devices('lampe_salon').switchOn();lampes="2"
      --          end    
        --mise en service sirene
            if (sirene==1) then devices('ma_sirene').switchOn();sirene="2"
            end 
            if (sirene==2 and domoticz.device('activation-sirene').state == 'On') then  devices('Sirene-switch').switchOn();sirene="3"
            end    
        end            
        -- fin alarme nuit         
         

end
}