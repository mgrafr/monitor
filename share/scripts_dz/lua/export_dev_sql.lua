--
--[[
export_dev_sql]]
--
package.path = package.path..";/opt/domoticz/www/modules_lua/?.lua"
require 'datas'
require 'string_tableaux'
data0=pression;
year 	= tonumber(os.date("%Y"));
month 	= os.date("%m");
day 	= os.date("%d");
hour 	= os.date("%H");
min 	= os.date("%M");
sec     = os.date("%S");
weekday = tonumber(os.date("%w"));
time    = os.date("%X");
datetime = year.."-"..month.."-"..day.." "..time;


return {
	on = {
		devices = {
			'temp_cave',
			'temp_cuis_ete',
			'temp_cellier',
			'THB',
			'temp_entree1',
			--'pir ar cuisine_temp',
			'temp_cuisine',
			--'pression_chaudière',
			'PH_Spa',
			'Redox_Spa',
			'Temp-eau_SPA',
			'Temp-air_SPA'
		}
	},

    execute = function(domoticz, item)
        domoticz.log('item '..item.name..' was changed', domoticz.LOG_INFO)
            
        if (item.name=='temp_cuis_ete') then 
         if item.temperature ~= nil then  
           valeur=tostring(round(item.temperature, 0))
            if (domoticz.variables('temp_cuis_ete').value ~= valeur) then
            domoticz.variables('temp_cuis_ete').set(valeur) 
    	    libelle="temp_cuis_ete#valeur"
    	    envoi_fab(libelle,valeur) 
          end  
         end 
        elseif (item.name=='temp_cave') then 
           --local valeur=round(item.temperature, 1)
          valeur=tostring(round(item.temperature, 0))
            if tostring(valeur)~=domoticz.variables('temp_cave').value then
            domoticz.variables('temp_cave').set(tostring(valeur))
    	    libelle="temp_cave#valeur"
    	   envoi_fab(libelle,valeur) 
            end  
       elseif (item.name=='temp_cellier') then 
          if item.temperature ~= nil then  
          valeur=tostring(round(item.temperature, 0))
            if tostring(valeur)~=domoticz.variables('temp_cellier').value then
                domoticz.variables('temp_cellier').set(tostring(valeur))    
    	        libelle="temp_cellier#valeur"
                envoi_fab(libelle,valeur) 
            end
          end  
       elseif (item.name=='THB') then 
            valeur=tostring(round(item.temperature, 0))
            if valeur~=domoticz.variables('temp_meteo').value then
            domoticz.variables('temp_meteo').set(valeur)   
    	    libelle="temp_meteo#valeur"
    	    envoi_fab(libelle,valeur) 
            end
       elseif (item.name=='temp_entree1') then
        if item.temperature ~= nil then     
        valeur=tostring(round(item.temperature, 0))
          if tostring(valeur)~=domoticz.variables('temp_salon').value then
           domoticz.variables('temp_salon').set(tostring(valeur))    
            libelle="temp_salon#valeur"
           envoi_fab(libelle,valeur)  
          end
         end 
      elseif (item.name=='temp_cuisine') then 
       if item.temperature ~= nil then   
        valeur=tostring(round(item.temperature, 0))
        if tostring(valeur)~=domoticz.variables('temp_cuisine').value then
            domoticz.variables('temp_cuisine').set(tostring(valeur))    
	        libelle="temp_cuisine#valeur"
            envoi_fab(libelle,valeur) 
         end
       end 
   
        elseif (item.name=='PH_Spa') then
        local valeur=tostring(round(item.state, 1))
	    libelle="ph_spa#valeur";
	    envoi_fab(libelle,valeur) 
	   elseif (item.name=='Redox_Spa') then
        local valeur=tostring(round(item.state, 1))
	    libelle="orp_spa#valeur";
	    envoi_fab(libelle,valeur) 
	   elseif (item.name=='Temp-eau_SPA') then
        local valeur=tostring(round(item.temperature, 1))
	    libelle="temp_spa#valeur";
	    envoi_fab(libelle,valeur) 
	    elseif (item.name=='Temp-air_SPA') then
        local valeur=tostring(round(item.temperature, 1))
	    libelle="temp_ext_spa#valeur";
	    envoi_fab(libelle,valeur) 
	   elseif (item.name=='Debit_filtration_SPA') then
	    print ("debit:"..item.state);c=0;
	    for i in string.gmatch(item.value,"[^;]+") do
        t[c]=i;c=c+1;
        end
	    libelle="debit_spa#valeur";valeur=t[0]
	    envoi_fab(libelle,valeur) 

       --elseif (item.name=='pression_chaudière') then 
       -- pressionch=tonumber(item.pressure);
        --print ("pression_chaudiere:"..pressionch.."--"..pression);
        --if (pression~=pressionch) then 
          --  libelle="pression_chaudiere#valeur"
        ----   envoi_fab(libelle,tostring(pressionch)) 
            --donnees['pression']=tonumber(deviceValue)
        --    write_datas(tonumber(item.pressure),data1)
       --     --pression_chaudiere: variable du fichier 'string_tableaux'
     --       if (pressionch<pression_chaudiere and domoticz.variables('pression-chaudiere')=="ras") then 
        --       domoticz.variables('pression-chaudiere').set("manque_pression");  print("pression basse")
       --     elseif (pressionch<pression_chaudiere and domoticz.variables('pression-chaudiere')~="pression_basse") then 
       --        domoticz.variables('pression-chaudiere').set("erreur") 
        --    elseif (pressionch>=pression_chaudiere) then domoticz.variables('pression-chaudiere').set("ras")   
        --    end
        --end 
      end 
    end       
   }