--
--alarme--alarme.lua
--

--
function modect_cam(mode)
    json = (loadfile "/home/michel/domoticz/scripts/lua/JSON.lua")()
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
package.path = package.path..";/home/michel/domoticz/www/modules_lua/?.lua"
require 'string_modect'

commandArray = {}
local time = string.sub(os.date("%X"), 1, 5)
local sirene=0
-- Alarme auto
if ((time == "23:00") and (otherdevices['al_nuit_auto'] == 'On')) then commandArray['alarme_nuit'] = "On" 
elseif ((time == "06:00") and (otherdevices['al_nuit_auto'] == 'On')) then commandArray['alarme_nuit'] = "Off"
end
function alerte_gsm(txt)
f = io.open("/home/michel/domoticz/scripts/python/aldz.py", "w")
env="#!/usr/bin/env python3.7"
f:write(env.." -*- coding: utf-8 -*-\nx='"..txt.."'")
f:close()
end

function notifications(txt)
        if (txt== "1") then txt="alarme_porte_ouverte"
        elseif  (txt== "2") then txt="alarme_presence_interieure"    
        elseif  (txt== "3") then txt="PI4_Hors_Service" 
        elseif  (txt== "4") then txt="alarme_absence_activee" 
        elseif  (txt== "5") then txt="alarme absence_désactivee" 
        elseif  (txt== "6") then txt="test_gsm_alarme"     
        end
        os.execute("curl --insecure  'https://smsapi.free-mobile.fr/sendmsg?user=12812620&pass=2FQTMM7x42kspr&msg="..txt.."' >> /home/michel/OsExecute1.log 2>&1")
        os.execute("python3 /home/michel/domoticz/scripts/pushover.py "..txt.." >> /home/michel/push.log 2>&1");
        -- commandArray['Variable:alarme_gsm'] =txt;
        alerte_gsm(txt)
        
end
-- test GSM
        if (otherdevices['Test_GSM'] == 'On') then commandArray['Test_GSM']='Off'
			notifications("6");print ("Test GSM");
		end	
-- alarme ping PI4
        if ((otherdevices['Ping_pi4'] == 'Off') and  (uservariables['pi-alarme']=="0")) then commandArray['Variable:pi-alarme'] = "pi_hs"  
				notifications("3");print ("PI4 hors service");
		elseif ((otherdevices['Ping_pi4'] == 'On') and  (uservariables['pi-alarme']=="pi_hs")) then commandArray['Variable:pi-alarme'] = "0"		
		end	
-- alarme absence _activation
		if ((otherdevices['alarme_absence'] == 'On') and  (uservariables['ma-alarme']=="0")) then commandArray['Variable:ma-alarme'] = "1"  
				notifications("4");
				print ("alarme activée");
		end	
	    if ((otherdevices['alarme_absence'] == 'Off') and  (uservariables['ma-alarme']=="1")) then commandArray['Variable:ma-alarme'] = "0" 
		    notifications("5");
				print ("alarme désactivée");commandArray['Variable:porte-ouverte'] ="0";
		end
-- activation de la detection par les cameras
	    if ((otherdevices['Modect'] == 'Off') and  (uservariables['ma-alarme']=="1")) then
	        modect_cam('Modect') -- si alarme activé : mode camera=Modect
	      	commandArray['Modect']='On'
	    end 
        -- activation manuelle Modect
	    if (otherdevices['Modect'] == 'On' and  uservariables['ma-alarme']=="0" and  uservariables['modect']=="0") then  
	      	modect_cam('Modect')
	      	commandArray['Variable:modect'] = '1'
	     -- activation manuelle Monitor 	
	    elseif (otherdevices['Modect'] == 'Off'  and uservariables['ma-alarme']=="0" and uservariables['modect']=="1") then 
	       modect_cam('Monitor')
	       commandArray['Variable:modect'] = '0'
    end 
    --
-- alarme absence - 
        if (uservariables['ma-alarme']=="1")  then 
            if ((devicechanged['porte entree']) == 'Open')  then 
		     notifications("1");commandArray['Variable:porte-ouverte'] = "porte ouverte entrée" 
		    elseif ((devicechanged['porte cuisine']) == 'Open') then 
		    notifications("1");commandArray['Variable:porte-ouverte'] = "porte ouverte cuisine"
		    elseif ((devicechanged['Porte fenetre sejour']) == 'Open') then 
		    notifications("1");commandArray['Variable:porte-ouverte'] = "fenetre ouverte sejour"
	        -- alarme absence -- autres dispositifs 
            elseif ((devicechanged['pir salon']) == 'On') then 
		     notifications("2")commandArray['Variable:intrusion'] = "intrusion salon"
            elseif ((devicechanged['pir cuisine']) == 'On') then 
		    notifications("2");commandArray['Variable:intrusion'] = "intrusion cuisine"
		    end
        
        end
		
		-- fin alarme absence
--alarme nuit
        if ((otherdevices['alarme_nuit'] == 'On') and  (uservariables['ma-alarme']=="0")) then commandArray['Variable:ma-alarme'] = "2"  
			print ("alarme activée");
		end
		if ((otherdevices['alarme_nuit'] == 'Off') and  (uservariables['ma-alarme']=="2")) then commandArray['Variable:ma-alarme'] = "0" 
		  commandArray['Variable:alarme'] = "0";  
		 print ("alarme désactivée");commandArray['Variable:porte-ouverte'] ="0";
        end
        if (uservariables['ma-alarme']=="2")  then 	commandArray['Variable:alarme'] = "alarme_nuit"; 
            if ((devicechanged['porte entree']) == 'Open')  then 
		        print ("porte ouverte");commandArray['Variable:porte-ouverte'] = "entrée" ;local sirene=1
		    elseif ((devicechanged['porte cuisine']) == 'Open') then 
		        print ("porte ouverte");commandArray['Variable:porte-ouverte'] = "cuisine" ;local sirene=1
		     -- alarme nuit-- autres dispositifs     
            elseif ((devicechanged['Porte fenetre sejour']) == 'Open') then 
		        print ("porte ouverte");commandArray['Variable:porte-ouverte'] = "sejour"; local sirene=1
            end
            --mise en service sirene
            if (sirene==1) then 
                --commandArray['sirene_ma']='On'
            end    
        else commandArray['Variable:alarme'] = "0";
        end
 -- fin alarme nuit 
 -- raz variables de notification intrusion et porte ouverte
       if (otherdevices['raz-dz'] == 'On') then 
           commandArray['Variable:intrusion'] = "0";
           commandArray['Variable:porte-ouverte'] = "0";
           
    end
return commandArray