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
function notifications(txt)
        if (txt== "1") then txt="alarme_porte_ouverte"
        elseif  (txt== "2") then txt="alarme_presence_interieure"    
        elseif  (txt== "4") then txt="alarme_absence_activee" 
        elseif  (txt== "5") then txt="alarme_absence_desactivee" 
        end

        os.execute("curl --insecure  'https://smsapi.free-mobile.fr/sendmsg?user=12812620&pass=2FQTMM7x42kspr&msg="..txt.."' >> /home/michel/OsExecute1.log 2>&1")
        os.execute("python3 /opt/domoticz/userdata/scripts/python/pushover.py "..txt.." >> /home/michel/push.log 2>&1");
       
        alerte_gsm(txt)
end
-- chargement fichier contenant les variable de configuration
package.path = package.path..";www/modules_lua/?.lua"
require 'string_modect'
--
-- listes des dispositifs
-- les capteurs d'ouverture et de présence DEVICE CHANGED
-- {capteur,etat,modif variable,contenu variable,notification,alarme}   alarme 0=absence et nuit 1=absence seulement 
local a1={'porte entree','Open','Variable:porte-ouverte','porte ouverte entrée','1','0'};
local a2={'porte cuisine','Open','Variable:porte-ouverte','porte ouverte cuisine','1','0'};
local a3={'Porte fenetre sejour','Open','Variable:porte-ouverte','fenetre ouverte sejour','1','0'};
local a4={'pir salon','On','Variable:intrusion','intrusion salon','2','1'};
local a5={'pir cuisine','On','Variable:intrusion','intrusion cuisine','2','1'};
local A1={a1,a2,a3,a4,a5};local A2={a1,a2,a3};
--

--
local time = string.sub(os.date("%X"), 1, 5)
sirene=0
--
return {
	on = {
		variables = {
			'modect',
		    'ma-alarme',
		}
	},
	execute = function(domoticz, variable)
	    domoticz.log('Variable ' .. variable.name .. ' was changed', domoticz.LOG_INFO)
	    if (variables('modect').changed)  then modect_cam(variables('modect').value);
        end
        -- alarme absence - 
        if (domoticz.variables('ma-alarme').value == "1") then 
            for k1, v in ipairs(a1) do
                if (domoticz.device(v[1]).changed == v[2])  then 
        	   domoticz.variables(v[3]).set(v[4]);
        	    end
            end
        end
        -- alarme nuit
        if (domoticz.variables('ma-alarme').value == "2") then
            for k1, v in ipairs(a2) do
                if (domoticz.device(v[1]).changed == v[2])  then 
        	    domoticz.variables(v[3]).set(v[4]);lampes=1;sirene=1
        	    end
            end
            --allumer lampes
                if (lampes==1) then devices('lampe_salon').switchOn();
                end    
            --mise en service sirene
                if (sirene==1) then devices('ma_sirene').switchOn();sirene="2"
                end 
                if (sirene==2 and domoticz.device('activation-sirene').state == 'On') then  devices('Sirene-switch').switchOn();sirene="3"
                end    
            
 -- fin alarme nuit         
        end       

end
}