--
--[[
****************]]
--

package.path = package.path..";www/modules_lua/?.lua"
require 'datas'
data0=pression;data1=d_linky
--xxx="michel"; os.execute("python3 scripts/python/pushover.py "..xxx.." > /home/michel/fab.log 2>&1");
year 	= tonumber(os.date("%Y"));
month 	= os.date("%m");
day 	= os.date("%d");
hour 	= os.date("%H");
min 	= os.date("%M");
sec     = os.date("%S");
weekday = tonumber(os.date("%w"));
time    = os.date("%X");
datetime = year.."-"..month.."-"..day.." "..time;

function write_datas(data0,data1)
f = io.open("www/modules_lua/datas.lua", "w")
f:write('pression='..data0..';d_linky='..data1)
f:close()
end
function envoi_fab(don)
	print ("maj valeur:"..don);
        local command = "/bin/bash userdata/scripts/bash/./fabric.sh"..don.." > /home/michel/fab.log 2>&1";
        os.execute(command);
        --txt="michel";os.execute("python3 scripts/python/pushover.py "..txt.." >> /home/michel/push.log 2>&1");
end
function round(num,numDecimal)
   local mult = 10^(numDecimal or 0)
  return math.floor(num * mult + 0.5) / mult
 end
function Split(s, delimiter)
    result = {};
    for match in (s..delimiter):gmatch("(.-)"..delimiter) do
        table.insert(result, match);
    end
    return result;
end 
 
commandArray = {}
t = {};
--donnees={['pression']='1.2'};write_datas('{["pression"]="'.."1.2"..';}')
-- libelle=table#champ
-- si 2 champs , ajouter ..'#champ2#"..split_str[2] après datetime.. 
-- exemple "don=" "..libelle.."#"..tostring(deviceValue).."#"..datetime.."#champ2#"..split_str[2]
for deviceName,deviceValue in pairs(devicechanged) do
    if (deviceName=='temp_pir_salon_temperature_air') then
        print ("temp_salon:"..deviceValue);
	    libelle="temp_salon#valeur";don=" "..libelle.."#"..tostring(deviceValue).."#"..datetime
        envoi_fab(don)
    elseif (deviceName=='pression_chaudière') then 
        pressionch=tonumber(deviceValue);
        print ("pression_chaudiere:"..pressionch.."--"..pression);
        if (pression~=pressionch) then 
            libelle="pression_chaudiere#valeur";don=" "..libelle.."#"..tostring(deviceValue).."#"..datetime
            envoi_fab(don)
            --donnees['pression']=tonumber(deviceValue)
            write_datas(tonumber(deviceValue),data1)
            if (pressionch<1 and uservariables['pression-chaudiere']=="ras") then 
                commandArray['Variable:pression-chaudiere'] = "manque_pression";  print("pression basse")
            elseif (pressionch<1 and uservariables['pression-chaudiere']~="pression_basse") then 
                commandArray['Variable:pression-chaudiere']="ras"    
            end
        end
     elseif (deviceName=='truffiere - Linky 16267727923561' and d_linky~=day) then print('linky'..tostring(deviceValue))
        split_str = Split(tostring(deviceValue), ";");write_datas(data0,day)
	    libelle="energie#conso";don=" "..libelle.."#"..tostring(round((tonumber(split_str[1])/1000),1)).."#"..datetime.."#pmax#"..tostring(round((tonumber(split_str[5])/1000),1)); print("energie"..don);
	    envoi_fab(don)    
    elseif (deviceName=='PH_Spa') then
        local mesure=round(deviceValue, 1)
	    libelle="ph_spa#valeur";don=" "..libelle.."#"..mesure.."#"..datetime
	    envoi_fab(don)
	 elseif (deviceName=='Redox_Spa') then
        local mesure=round(deviceValue, 1)
	    libelle="orp_spa#valeur";don=" "..libelle.."#"..mesure.."#"..datetime
	    envoi_fab(don)
	 elseif (deviceName=='Temp-eau_SPA') then
        local mesure=round(deviceValue, 1)
	    libelle="temp_spa#valeur";don=" "..libelle.."#"..mesure.."#"..datetime
	    envoi_fab(don)   
	 elseif (deviceName=='Debit_filtration_SPA') then
	    print ("debit:"..deviceValue);c=0;
	    for i in string.gmatch(deviceValue,"[^;]+") do
        t[c]=i;c=c+1;
        end
	    libelle="debit_spa#valeur";don=" "..libelle.."#"..t[0].."#"..datetime
	    envoi_fab(don)   
    elseif (deviceName=='temp pir ar cuisine') then 
	    libelle="temp_cuisine#valeur";don=" "..libelle.."#"..tostring(deviceValue).."#"..datetime
        envoi_fab(don)
    elseif (deviceName=='THB_Temperature') then 
        -- choix nb decimales apres la virgule = X (deviceValue, X)
         --local temp=round(deviceValue, 1)
        local temp=round(deviceValue, 0)
        if tostring(temp)~=uservariables['temp_meteo'] then
        commandArray['Variable:temp_meteo'] = tostring(temp)    
    	    libelle="temp_meteo#valeur";don=" "..libelle.."#"..temp.."#"..datetime
            envoi_fab(don)
        end
     elseif (deviceName=='temp_cave_Temperature') then 
        -- choix nb decimales apres la virgule = X (deviceValue, X)
         local temp=round(deviceValue, 1)
        --local temp=round(deviceValue, 0)
        if tostring(temp)~=uservariables['temp_cave'] then
        commandArray['Variable:temp_cave'] = tostring(temp)    
    	    libelle="temp_cave#valeur";don=" "..libelle.."#"..temp.."#"..datetime
            envoi_fab(don)
        end  
    elseif (deviceName=='temp_cellier_Temperature') then 
        -- choix nb decimales apres la virgule = X (deviceValue, X)
        -- local temp=round(deviceValue, 1)
        local temp=round(deviceValue, 0)
        if tostring(temp)~=uservariables['temp_cellier'] then
        commandArray['Variable:temp_cellier'] = tostring(temp)    
    	    libelle="temp_cellier#valeur";don=" "..libelle.."#"..temp.."#"..datetime
            envoi_fab(don)
        end   
    elseif (deviceName=='temp_cuisine_ete_Temperature') then 
        -- choix nb decimales apres la virgule = X (deviceValue, X)
        -- local temp=round(deviceValue, 1)
        local temp=round(deviceValue, 0)
        if tostring(temp)~=uservariables['temp_cuis_ete'] then
        commandArray['Variable:temp_cuis_ete'] = tostring(temp)    
    	    libelle="temp_cuis_ete#valeur";don=" "..libelle.."#"..temp.."#"..datetime
            envoi_fab(don)
        end       
    end
end

return commandArray