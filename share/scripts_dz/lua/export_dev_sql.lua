--[[
export_dev_sql]]
--
package.path = package.path..";www/modules_lua/?.lua"
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

function write_datas(data0)
f = io.open("www/modules_lua/datas.lua", "w")
f:write('pression='..data0)
f:close()
end

function round1(num,numDecimal)
  local mult = 10^(numDecimal or 0)
  return math.floor(num * mult + 0.5) / mult
 end

function envoi_fab1(libelle,valeur)
    don=" "..libelle.."#"..valeur.."#"..datetime
	print("maj valeur:"..don);
        command = "/bin/bash scripts/bash/./fabric.sh "..don.." > /home/michel/fab.log 2>&1";
        os.execute(command);
end
return {
	on = {
		devices = {
			'temp_cave',
			'temp_cuisine_ete',
			'temp_cellier',
			'forecast hourly',
			'pir_entree_temp',
			'pir ar cuisine_temp',
			'pression_chaudière',
			'PH_Spa',
			'Redox_Spa'
		}
	},

    execute = function(domoticz, item)
        domoticz.log('item '..item.name..' was changed', domoticz.LOG_INFO)
            
        if (item.name=='temp_cuisine_ete') then 
        -- choix nb decimales apres la virgule 
        -- local temp=round(deviceValue, 1)
           valeur=tostring(round(item.temperature, 0))
            if (domoticz.variables('temp_cuis_ete').value ~= valeur) then
            domoticz.variables('temp_cuis_ete').set(valeur) 
    	    libelle="temp_cuis_ete#valeur"
    	    envoi_fab1(libelle,valeur) 
            end       
        elseif (item.name=='temp_cave') then 
           --local valeur=round(item.temperature, 1)
          valeur=tostring(round(item.temperature, 0))
            if tostring(valeur)~=domoticz.variables('temp_cave').value then
            domoticz.variables('temp_cave').set(tostring(valeur))
    	    libelle="temp_cave#valeur"
    	   envoi_fab1(libelle,valeur) 
            end  
       elseif (item.name=='temp_cellier') then 
        -- local valeur=round(deviceValue, 1)
           valeur=tostring(round(item.temperature, 0))
            if tostring(valeur)~=domoticz.variables('temp_cellier').value then
            domoticz.variables('temp_cellier').set(tostring(valeur))    
    	    libelle="temp_cellier#valeur"
            envoi_fab1(libelle,valeur) 
            end
       elseif (item.name=='forecast hourly') then 
            valeur=tostring(round(item.temperature, 0))
            if valeur~=domoticz.variables('temp_meteo').value then
            domoticz.variables('temp_meteo').set(valeur)   
    	    libelle="temp_meteo#valeur"
    	    envoi_fab1(libelle,valeur) 
            end
       elseif (item.name=='pir_entree_temp') then
        valeur=tostring(round(item.temperature, 0))
        if tostring(valeur)~=domoticz.variables('temp_salon').value then
           domoticz.variables('temp_salon').set(tostring(valeur))    
            libelle="temp_salon#valeur"
           envoi_fab1(libelle,valeur)  
        end
       elseif (item.name=='pir ar cuisine_temp') then 
        valeur=tostring(round(item.temperature, 0))
        if tostring(valeur)~=domoticz.variables('temp_ar_cuisine').value then
            domoticz.variables('temp_ar_cuisine').set(tostring(valeur))    
	        libelle="temp_cuisine#valeur"
            envoi_fab1(libelle,valeur) 
        end
        
   
        elseif (item.name=='PH_Spa') then
        local valeur=tostring(round1(item.state, 1))
	    libelle="ph_spa#valeur";
	    envoi_fab1(libelle,valeur) 
	   elseif (item.name=='Redox_Spa') then
        local valeur=tostring(round1(item.state, 1))
	    libelle="orp_spa#valeur";
	    envoi_fab1(libelle,valeur) 
	   elseif (item.name=='Temp-eau_SPA') then
        local valeur=tostring(round1(item.temperature, 1))
	    libelle="temp_spa#valeur";
	    envoi_fab1(libelle,valeur) 
	    
	   elseif (item.name=='Debit_filtration_SPA') then
	    print ("debit:"..item.state);c=0;
	    for i in string.gmatch(item.value,"[^;]+") do
        t[c]=i;c=c+1;
        end
	    libelle="debit_spa#valeur";valeur=t[0]
	    envoi_fab1(libelle,valeur) 

       elseif (item.name=='pression_chaudière') then 
        pressionch=tonumber(item.pressure);
        print ("pression_chaudiere:"..pressionch.."--"..pression);
        if (pression~=pressionch) then 
            libelle="pression_chaudiere#valeur"
           envoi_fab1(libelle,tostring(pressionch)) 
            --donnees['pression']=tonumber(deviceValue)
            write_datas(tonumber(item.pressure),data1)
            --pression_chaudiere: variable du fichier 'string_tableaux'
            if (pressionch<pression_chaudiere and domoticz.variables('pression-chaudiere')=="ras") then 
               domoticz.variables('pression-chaudiere').set("manque_pression");  print("pression basse")
            elseif (pressionch<pression_chaudiere and domoticz.variables('pression-chaudiere')~="pression_basse") then 
               domoticz.variables('pression-chaudiere').set("erreur") 
            elseif (pressionch>=pression_chaudiere) then domoticz.variables('pression-chaudiere').set("ras")   
            end
        end 
      end 
    end       
   }