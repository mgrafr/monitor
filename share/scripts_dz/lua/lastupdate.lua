-- Script dzVents destiné à détecter les périphériques morts ou offline.

-- chargement fichier contenant les variable de configuration
package.path = package.path..";/opt/domoticz/www/modules_lua/?.lua"
require 'string_tableaux' -- variable concernée : max_lastseen  max update et max_bat
require 'connect'
require 'table_zb_zw'

adresse_mail=mail_gmail -- mail_gmail dans connect.lua


local function split(s, delimiter)
	local result = {}
	for match in (s..delimiter):gmatch('(.-)'..delimiter) do
		table.insert(result, match)
	end
	return result
end

local ls=0
local scriptVar = 'lastSeen'
local test=0 
return {
    on = { timer =  {'at 15:43'}, httpResponses = { scriptVar }},
    logging = { level   = domoticz.LOG_ERROR, marker  = scriptVar },
    
    execute = function(dz, item) 
        
        if not (item.isHTTPResponse) then
            dz.openURL({ 
                url = dz.settings['Domoticz url'] .. '/json.htm?type=command&param=getdevices',
                callback = scriptVar })
        else
            local Time = require('Time');local lastup="";listidx="lastseen#"
            for i, node in pairs(item.json.result) do
               
			    for i=1,nombre_enr do
			        if liste_ls[i]['idx'] == node.idx and liste_ls[i]['lastseen'] =="non"  then test=1	 
				         print('-------------------------------essai','l=',liste_ls[i]['name'])
				    else test=0
				    end 
				end   
				     if node.HardwareName ~= "virtuels" and node.HardwareName ~= "surveillance réseau"  and node.HardwareType ~= "Linky"  and node.PlanID == "2" and test==0 then
				       
	                  if node.Type == "General" then 
			   	        local lastSeen = Time(node.LastUpdate).minutesAgo
			   	        if lastSeen >=max_lastseen then -- limite en heure pour considérer le dispositif on line
				        lastup = lastup..'idx:'..node.idx..','..node.Name..' lastseen:'..lastSeen..'<br>'
					    listidx=listidx..' '..node.idx..node.Name..'Lastseen:'..tostring(lastSeen)..' / '..node.LastUpdate..'<br>'    
		   	            ls=1
	   	                end 
	   	              
   	                  elseif string.find(node.ID, "zwavejs2mqtt") ~= nil then
		                local lastUpdated = Time(node.LastUpdate).hoursAgo
			            if lastUpdated > max_lastupdate and node.BatteryLevel <= 100 then 
			            print(node.ID)
		   	            lastup = lastup..'idx:'..node.idx..','..node.Name..',LastUpdate:'..node.LastUpdate..'bat:'..node.BatteryLevel..'<br>'
					    listidx=listidx..' '..node.idx..node.Name..'LastUpdate:'..node.LastUpdate..'bat:'..node.BatteryLevel..'<br>'
			            ls=3
			            end
				      end 
				    end
				     
					--dz.log('id '..  node.idx .. '('  ..node.Name .. ') lastSeen ' .. lastSeen ,dz.LOG_FORCE)
			end
		
	
           print("ls="..ls)
           if ls > 0 then
           dz.variables('lastseen').set(listidx)
           obj='alarme lastseen: '..listidx;dz.email('LastSeen',lastup,adresse_mail)
           ls=0
           end
      
        end
    
    end
}