-- Alarme absence et nuit maison
--
-- alarme--alarme.lua
-- version 3.0.9
--
 json = (loadfile "/opt/domoticz/scripts/lua/JSON.lua")()

-- trouver un élément dans une table
local function find_string_in(tbl, str) 
    for _, element in ipairs(tbl) do
        if (element == str) then
            return true
        end
    end
    return false
end
-- chargement fichier contenant les variable de configuration
package.path = package.path..";/opt/domoticz/www/modules_lua/?.lua"
--require 'string_modect'
require 'connect'
--
-- listes des dispositifs
-- les capteurs d'ouverture et de présence DEVICE CHANGED
-- {capteur,etat,modif variable,contenu variable,notification,alarme}   alarme 0=absence et nuit 1=absence seulement 
local a1={'porte_entree','Open','porte-ouverte','porte_ouverte_entree'};
local a2={'porte ar cuisine','Open','porte-ouverte','porte_ouverte_cuisine'};
local a3={'porte_fenetre','Open','porte-ouverte','fenetre_ouverte_sejour'};
local a4={'fenetre_bureau','Open','fenetre-ouverte','fenetre_ouverte_bureau'};
local a5={'fenetre_salon','Open','fenetre-ouverte','fenetre_ouverte_salon'};
local a6={'fenetre_ch_amis','Open','fenetre-ouverte','fenetre_ouverte_ch_amis'};
local a7={'fenetre_ch_1','Open','fenetre-ouverte','fenetre_ouverte_chambre1'};
local a8={'porte_veranda_sud','Open','porte-ouverte','porte_ouverte_veranda-s'};
local a9={'pir_entree_pr','Open','intrusion','intrusion_entree'};
local a10={'pir ar cuisine_motion','Open','intrusion','intrusion_cuisine'};
local A1={a1,a2,a3,a4,a5,a6,a7,a8,a9,a10};local A2={a1,a2,a3,a4,a5,a6,a7,a8};
--liste des dispositifs réels de détection
local reels = {'pir ar cuisine_motion','pir_entree_pr','porte_entree','porte ar cuisine','porte_fenetre','fenetre_bureau','fenetre_salon','fenetre_ch_amis','fenetre_ch_1','porte_veranda_sud'}
--liste des dispositifs virtuels
local virtuels = {'alarme_nuit','alarme_absence','Modect','raz_dz','al_nuit_auto','activation-sirene','Test_GSM','test_sirene'}
--
local time = string.sub(os.date("%X"), 1, 5)
sirene=0;lampe=0
--
return {
	on = {
	
		devices = {
			'pir ar cuisine_motion',
		    'pir_entree_motion',
		    'porte_entree',
		    'porte ar cuisine',
		    'porte_fenetre',
		    'fenetre_bureau',
		    'fenetre_salon',
		    'fenetre_ch_amis',
		    'fenetre_ch_1',
		    'porte_veranda_sud',
		    'alarme_nuit',
		    'alarme_absence',
		    'Modect',
		    'raz_dz',
			'al_nuit_auto',
			'activation-sirene',
			'Test_GSM',
			'test_sirene'
		    },
		    timer = {
             'at 23:00',
             'at 06:00'}
	    
		},
		execute = function(domoticz, item, triggerInfo)
	    if (item.isTimer) then print("Alarme:"..time) 
	    else domoticz.log('Alarme '..item.name..' a changé', domoticz.LOG_INFO)
	    end
	    --domoticz.variables('variable_sp').set('1')
 --*********************variables***************************************	
	-- alarme absence - 
    if (find_string_in(reels, item.name)==true) then
      --if (item.name =='pir ar cuisine_motion' or item.name=='pir_entree_motion' or item.name=='porte_entree' or item.name=='porte ar cuisine' or item.name=='porte_fenetre' or item.name=='fenetre_bureau' or item.name=='fenetre_salon' or item.name=='fenetre_ch_amis' 
      --    or item.name=='fenetre_ch_1' or item.name=='porte_veranda_sud') then
        if (domoticz.devices('alarme_absence').state == "On") then 
            for k, v in ipairs(A1) do 
                if (item.name == A1[k][1] and item.name ~= nil) then
                    if (item.state == A1[k][2] ) then 
        	        domoticz.variables(A1[k][3]).set(A1[k][4]);
    	            else print("erreur:"..A1[k][1])
    	            end
        	    end
            end
        end
--      -- alarme nuit
        if (domoticz.devices('alarme_nuit').state == "On") then 
            for k, v in ipairs(A2) do 
             if (item.state~=  nil) then 
               if (item.name == (A2[k][1]) and item.state == A2[k][2] ) then 
        	   domoticz.variables(A2[k][3]).set(A2[k][4]);lampe=1;sirene=1;
    	       end
    	     end
            end
--            --allumer lampes
            if (lampes==1) then devices('lampe_salon').switchOn();lampes="2"
            end    
        --mise en service sirene
            if (sirene==1) then domoticz.devices('sirene').switchOn();sirene="2"
            end 
            if (sirene==2 and domoticz.device('activation-sirene').state == 'On') then  devices('sirene').switchOn();sirene="3"
            end    
        end  
        -- fin alarme nuit   
        if (domoticz.variables('porte-ouverte').changed) then  
	             txt=tostring(domoticz.variables('porte-ouverte').value) 
	             print("porte-ouverte")
                 alerte_gsm('alarme_'..txt)
        end
        if (domoticz.variables('intrusion').changed) then  
	             txt=tostring(domoticz.variables('intrusion').value) 
	             print('intrusion')
                 alerte_gsm('alarme_'..txt)
        end
        
      --*******************devices virtuels************************************        
        
      --elseif (item.name =='alarme_nuit' or item.name=='alarme_absence' or item.name=='Modect' or item.name=='raz_dz' or item.name=='al_nuit_auto' or item.name=='activation-sirene' or item.name=='Test_GSM') then 
    elseif (find_string_in(virtuels, item.name)==true) then print("elseif:"..item.name)
        -- alarme nuit_activation
        if (item.name == 'alarme_nuit' and  item.state=='On' ) then 
        txt='alarme_nuit_activée';obj='alarme_nuit_activée';
        alerte_gsm(txt);domoticz.variables('alarme').set("alarme_nuit"); 	
	    elseif (item.name == 'alarme_nuit' and  item.state=='Off' ) then
        txt='alarme_nuit_desactivee';obj='alarme_nuit_desactivee';alerte_gsm(txt);
            if (domoticz.variables('alarme').value~='alarme_auto') then domoticz.variables('alarme').set("0");
            end
        end	
        -- alarme absence _activation
        if (item.name == 'alarme_absence' and  item.state=='On' ) then domoticz.variables('alarme').set("alarme_absence"); 
        txt='alarme_absence_activee';obj='alarme absence activee';alerte_gsm(txt) ; domoticz.email('Alarme',obj,adresse_mail)	
	    elseif (item.name == 'alarme_absence' and  item.state=='Off') then domoticz.variables('alarme').set("0");domoticz.devices('Modect').switchOff();
	        
        txt='alarme_absence_desactivee';obj='alarme absence desactivee';
        alerte_gsm(txt);alerte_gsm(txt) ; domoticz.email('Alarme',obj,adresse_mail)	
        end	
	    
        -- activation de la detection par les cameras
	    if (item.name == 'Modect' and item.state=='Off' and  domoticz.variables('ma-alarme').value=="1") then 
	    devices('Modect').switchOn();
	    end 
        -- activation manuelle Modect
	    if (item.name == 'Modect' and  item.state=='On' ) then 
	    domoticz.variables('modect').set("modect");detect_frigate(1)   --modect_cam('Modect')
	    -- activation manuelle Monitor 	
	    elseif (item.name == 'Modect' and  item.state=='Off' ) then
	    domoticz.variables('modect').set("monitor");detect_frigate(2)  --modect_cam('Monitor')
        end 
        -- raz variables de notification intrusion et porte ouverte
        if (item.name == 'raz_dz' and item.state=='On') then domoticz.devices('raz_dz').switchOff();
        domoticz.variables('intrusion').set("0");domoticz.variables('porte-ouverte').set("0");
        end
        -- alarme auto
        if (item.name == 'al_nuit_auto' and  item.state=='On') then txt='alarme_nuit_auto_activee';alerte_gsm(txt); domoticz.variables('alarme').set("alarme_auto");
        elseif (item.name == 'al_nuit_auto' and  item.state=='Off') then txt='alarme_nuit_auto_desactivee';alerte_gsm(txt);domoticz.variables('alarme').set("0");
        end
         -- activation sirène
        if (item.name == 'activation-sirene' and  item.state=='On') then print("activ_siren");domoticz.variables('activation-sir-txt').set("desactiver");
        elseif (item.name == 'activation-sirene' and  item.state=='Off') then domoticz.variables('activation-sir-txt').set("activer");
        end 
        --
        if (item.name == 'Test_GSM') then print("test_gsm")
            txt='Test_GSM_OK';alerte_gsm(txt);send_sms(txt);
            obj='Test GSM OK';domoticz.email('Alarme',obj,adresse_mail) 
            --domoticz.devices('Test_GSM').switchOff()
        -- test sirene
        elseif (item.name == 'test_sirene') then print("test_sirene")
        end    
    print("alarme nuit :"..time)
    --print("sse="..item.name);
       if (item.id~= nil and item.state~= nil) then send_sse(item.id,item.state);  
       end
    end
 --******************************timer********************************************    
        if (time=='23:00') then
            if (domoticz.devices('al_nuit_auto').state == "On" and domoticz.devices('alarme_nuit').state=="Off")  then  domoticz.devices('alarme_nuit').switchOn()
                print('al_nuit=ON');send_sse(domoticz.devices('alarme_nuit').id,domoticz.devices('alarme_nuit').state)
            end
        elseif (time=='06:00') then    
            if (domoticz.devices('al_nuit_auto').state == "On" and domoticz.devices('alarme_nuit').state=="On")  then domoticz.variables('alarme').set('alarme_auto');
                -- domoticz.variables('variable_sp').set('1')
                domoticz.devices('alarme_nuit').switchOff()
                print('al_nuit=OFF')    
            end
        end
end
}
	
	
	
	
	
	
	
	
	
	