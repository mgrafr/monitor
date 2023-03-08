--[[
****************]]
--

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

function envoi_fab(don)
	print ("maj temp:"..don);
        local command = "/bin/bash userdata/scripts/bash/./fabric.sh"..don.." > /home/michel/fab.log 2>&1";
        os.execute(command);
        --txt="michel";os.execute("python3 scripts/python/pushover.py "..txt.." >> /home/michel/push.log 2>&1");
end
function round(num,numDecimal)
   local mult = 10^(numDecimal or 0)
  return math.floor(num * mult + 0.5) / mult
 end
commandArray = {}

for deviceName,deviceValue in pairs(devicechanged) do
    if (deviceName=='temp pir salon') then 
	    libelle="salon";don=" "..libelle.."#"..tostring(deviceValue).."#"..datetime
        envoi_fab(don)
    elseif (deviceName=='temp pir ar cuisine') then 
	    libelle="cuisine";don=" "..libelle.."#"..tostring(deviceValue).."#"..datetime
        envoi_fab(don)
    elseif (deviceName=='THB_Temperature') then 
        -- choix nb decimales apres la virgule = X (deviceValue, X)
        -- local temp=round(deviceValue, 1)
        local temp=round(deviceValue, 0)
        if tostring(temp)~=uservariables['temp_meteo'] then
        commandArray['Variable:temp_meteo'] = tostring(temp)    
    	    libelle="meteo";don=" "..libelle.."#"..temp.."#"..datetime
            envoi_fab(don)
        end
     elseif (deviceName=='temp-hum_cave_Temperature') then 
        -- choix nb decimales apres la virgule = X (deviceValue, X)
        -- local temp=round(deviceValue, 1)
        local temp=round(deviceValue, 0)
        if tostring(temp)~=uservariables['temp_cave'] then
        commandArray['Variable:temp_cave'] = tostring(temp)    
    	    libelle="cave";don=" "..libelle.."#"..temp.."#"..datetime
            envoi_fab(don)
        end  
    elseif (deviceName=='temp_cellier_Temperature') then 
        -- choix nb decimales apres la virgule = X (deviceValue, X)
        -- local temp=round(deviceValue, 1)
        local temp=round(deviceValue, 0)
        if tostring(temp)~=uservariables['temp_cellier'] then
        commandArray['Variable:temp_cellier'] = tostring(temp)    
    	    libelle="cellier";don=" "..libelle.."#"..temp.."#"..datetime
            envoi_fab(don)
        end   
    elseif (deviceName=='temp_cuis_ete') then 
        -- choix nb decimales apres la virgule = X (deviceValue, X)
        -- local temp=round(deviceValue, 1)
        local temp=round(deviceValue, 0)
        if tostring(temp)~=uservariables['temp_cuis_ete'] then
        commandArray['Variable:temp_cuis_ete'] = tostring(temp)    
    	    libelle="cuis_ete";don=" "..libelle.."#"..temp.."#"..datetime
            envoi_fab(don)
        end       
    end
end

return commandArray