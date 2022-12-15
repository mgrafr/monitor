--
-- alarme--alarme.lua
--
-- listes des dispositifs
-- les capteurs d'ouverture et de présence DEVICE CHANGED
-- {capteur,etat,modif variable,contenu variable,notification,alarme}   alarme 0=absence et nuit 1=absence seulement 
local a1={'porte entree','Open','Variable:porte-ouverte','porte ouverte entrée','1','0'};
local a2={'porte cuisine','Open','Variable:porte-ouverte','porte ouverte cuisine','1','0'};--AA[2]=a2;
local a3={'Porte fenetre sejour','Open','Variable:porte-ouverte','fenetre ouverte sejour','1','0'};--A[3]=a3;
local a4={'pir salon','On','Variable:intrusion','intrusion salon','2','1'};
local a5={'pir cuisine','On','Variable:intrusion','intrusion cuisine','2','1'};
local A={a1,a2,a3,a4,a5};
--
-- listes variables  et other devices 
-- {choix, voir  les alarmes 
local b1={'1','pression-chaudiere','pression_basse','','','Variable:pression-chaudiere','pression_basse','7'};-- pression
local b2={'2','Test_GSM','On','','','','','6'}; -- test GSM
local b3={'3','Ping_pi4','Off','pi-alarme','0','Variable:pi-alarme','pi_hs','3'}; -- alarme pi4 HS
local b4={'3','Ping_pi4','On','pi-alarme','pi_hs','Variable:pi-alarme','0','8'}; -- alarme pi4 ok
local b5={'3','alarme_absence','On','ma-alarme','0','Variable:ma-alarme','1','4'}; -- alarme absence activée
local b6={'3','alarme_absence','Off','ma-alarme','1','Variable:ma-alarme','0','5'}; -- alarme absence désactivée
local b6={'3','Modect','Off','ma-alarme','1','Modect','1','9'}; -- modect  activation de la detection par les cameras
local b7={'modect','Modect','On','ma-alarme','0','Variable:modect','1','9'}; -- modect  activation manuelle ON
local b8={'monitor','Modect','Off','ma-alarme','0','Variable:modect','0','10'}; -- modect  activation manuelle OFF
local B={b1,b2,b3,b4,b5,b6,b7,b8};
--
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

commandArray = {}

  --- txt="michel";os.execute("python3 scripts/python/pushover.py "..txt.." >> /home/michel/push.log 2>&1");
local time = string.sub(os.date("%X"), 1, 5)
local sirene=0
-- Alarme auto
if (otherdevices['al_nuit_auto'] == 'On') then commandArray['Variable:alarme'] = "alarme_auto";
    if (((time > "22:59" and time < "24:00") or (time >= "00:00" and time < "06:00")) and otherdevices['alarme_nuit'] == 'Off') then
        commandArray['alarme_nuit'] = "On"; commandArray['Variable:alarme'] = "alarme_nuit";
    elseif (time > "05:59" and time < "22:59" and otherdevices['alarme_nuit'] == 'On') then 
        commandArray['alarme_nuit'] = "Off";
    end
else commandArray['Variable:alarme'] = "0";    
end    
function alerte_gsm(txt)
f = io.open("userdata/scripts/python/aldz.py", "w")
env="#!/usr/bin/env python3"
f:write(env.." -*- coding: utf-8 -*-\nx='"..txt.."'")
f:close()
end

function notifications(txt)
        if (txt== "1") then txt="alarme_porte_ouverte"
        elseif  (txt== "2") then txt="alarme_presence_interieure"    
        elseif  (txt== "3") then txt="PI4_Hors_Service"
        elseif  (txt== "8") then txt="PI4_En_Service de nouveau"     
        elseif  (txt== "4") then txt="alarme_absence_activee" 
        elseif  (txt== "5") then txt="alarme_absence_desactivee" 
        elseif  (txt== "6") then txt="test_gsm_alarme"
        elseif  (txt== "7") then txt="alarme_manque_pression"    
        elseif  (txt== "9") then txt="modect activé"  
         elseif  (txt== "10") then txt="modect désactivé"   
        end
        os.execute("curl --insecure  'https://smsapi.free-mobile.fr/sendmsg?user=12812620&pass=2FQTMM7x42kspr&msg="..txt.."' >> /home/michel/OsExecute1.log 2>&1")
        os.execute("python3 /opt/domoticz/userdata/scripts/python/pushover.py "..txt.." >> /home/michel/push.log 2>&1");
       
        alerte_gsm(txt)
end
-- alarmes manque pression chaudière , test gsm, alarme ping PI4 , alarme absence ,detection par les cameras
        for k1, v in ipairs(B) do
                if (v[1]=='1') then 
                    if (uservariables[v[2]]==v[3]) then commandArray[v[6]] = v[7];notifications(v[8]);print(v[8]);    
                    end
                elseif (v[1]=='2') then 
                    if (otherdevices[v[2]]==v[3]) then notifications(v[8]);print(v[8]);         
                    end
                elseif ((v[1]=='3') or (v[1]=='modect') or (v[1]=='monitor ')) then 
                    if (otherdevices[v[2]]==v[3] and  uservariables[v[4]]==v[5]) then commandArray[v[6]] = v[7];
                      
                        if (v[1]=="4") then notifications(v[8]);print(v[8]);
                        elseif (v[1]=="modect") then modect_cam('Modect');notifications(v[8]);print(v[8]);
                        elseif (v[1]=="monitor") then modect_cam('Monitor'); notifications(v[8]);print(v[8]);   
                        end    
                    end  
                end
        end


        --if (uservariables['pression-chaudiere']=="manque_pression") then 
		--		notifications("7");print ("alarme manque pression déclenchée");
		--		commandArray['Variable:pression-chaudiere'] = "pression_basse"
		--end	
-- test GSM
        --if (otherdevices['Test_GSM'] == 'On') then commandArray['Test_GSM']='Off'
			--notifications("6");print ("Test GSM");
		--end	
-- alarme ping PI4
        --if ((otherdevices['Ping_pi4'] == 'Off') and  (uservariables['pi-alarme']=="0")) then commandArray['Variable:pi-alarme'] = "pi_hs"  
				--notifications("3");print ("PI4 hors service");
		--elseif ((otherdevices['Ping_pi4'] == 'On') and  (uservariables['pi-alarme']=="pi_hs")) then commandArray['Variable:pi-alarme'] = "0"		
		--end	
-- alarme absence _activation
		--if ((otherdevices['alarme_absence'] == 'On') and  (uservariables['ma-alarme']=="0")) then commandArray['Variable:ma-alarme'] = "1"  
			--	notifications("4");
			--	print ("alarme activée");
		--end	
	    --if ((otherdevices['alarme_absence'] == 'Off') and  (uservariables['ma-alarme']=="1")) then commandArray['Variable:ma-alarme'] = "0" 
		    --notifications("5");
				--print ("alarme désactivée");commandArray['Variable:porte-ouverte'] ="0";
		--end
-- activation de la detection par les cameras
	    --if ((otherdevices['Modect'] == 'Off') and  (uservariables['ma-alarme']=="1")) then
	        --modect_cam('Modect') -- si alarme absence activé : mode camera=Modect
	      	---commandArray['Modect']='On'
	    --end 
        -- activation manuelle Modect
	    --if (otherdevices['Modect'] == 'On' and  uservariables['ma-alarme']=="0" and  uservariables['modect']=="0") then  
	      	--modect_cam('Modect')
	      	--['Variable:modect'] = '1'
	     -- activation manuelle Monitor 	
	    --elseif (otherdevices['Modect'] == 'Off'  and uservariables['ma-alarme']=="0" and uservariables['modect']=="1") then 
	      -- modect_cam('Monitor')
	       --commandArray['Variable:modect'] = '0'
    --end 
    --
-- activation sirène
    if (otherdevices['activation-sirene'] == 'On') then print("aa")
        commandArray['Variable:activation-sir-txt']="désactiver";
    else commandArray['Variable:activation-sir-txt']="activer" 
    end 
-- test avant mise en service alarme 
function test_portes()
 if (otherdevices['porte entree'] == 'Open' or otherdevices['Porte fenetre sejour'] == 'Open' or otherdevices['porte cuisine'] == 'Open') then
     test=1
 else test=0; 
 end
print('test='..test);return test;
end
-- alarme absence - 
        if (uservariables['ma-alarme']=="1" and test_portes()==0)  then 
            for k1, v in ipairs(A) do
                if (devicechanged[v[1]] == v[2])  then 
        	    notifications(v[5]);commandArray[v[3]] = v[4] 
        	     end
             end
        end
-- fin alarme absence
--alarme nuit
        if ((otherdevices['alarme_nuit'] == 'On') and  (uservariables['ma-alarme']=="0") and test_portes()==0) then commandArray['Variable:ma-alarme'] = "2"  
			print ("alarme activée");commandArray['Variable:alarme'] = "alarme_nuit"; 
		end
		if ((otherdevices['alarme_nuit'] == 'Off') and  (uservariables['ma-alarme']=="2")) then commandArray['Variable:ma-alarme'] = "0" 
		  commandArray['Variable:alarme'] = "0";  
		 print ("alarme désactivée");commandArray['Variable:porte-ouverte'] ="0";
        end
        if (uservariables['ma-alarme']=="2")  then 
            for k1, v in ipairs(A) do
                if ((devicechanged[v[1]] == v[2]) and (v[6]==0)) then 
        	    notifications(v[5]);commandArray[v[3]] = v[4] ;local sirene=1
        	    end
            end
            --mise en service sirene
            if (sirene==1) then commandArray['ma_sirene']='On';
            end 
            if ((otherdevices['ma_sirene'] == 'On') and (otherdevices['activation-sirene'] == 'On')) then commandArray['Sirene-switch']='On';
            end    
        end
 -- fin alarme nuit 
 -- raz variables de notification intrusion et porte ouverte
       if (otherdevices['raz-dz'] == 'On') then 
           commandArray['Variable:intrusion'] = "0";
           commandArray['Variable:porte-ouverte'] = "0";
           
    end
return commandArray