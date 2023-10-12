-- Script dzVents destiné à détecter les périphériques morts ou offline.

-- chargement fichier contenant les variable de configuration
package.path = package.path..";www/modules_lua/?.lua"
require 'string_tableaux' -- variable concernée : max_lastseen
require 'connect'
adresse_mail=mail_gmail -- mail_gmail dans connect.lua

local scriptVar = 'lastSeen'

return {
    on = { timer =  {'at 16:53'}, httpResponses = { scriptVar }},
    logging = { level   = domoticz.LOG_ERROR, marker  = scriptVar },
    
    execute = function(dz, item) 
        
        if not (item.isHTTPResponse) then
            dz.openURL({ 
                url = dz.settings['Domoticz url'] .. '/json.htm?type=command&param=getdevices&used=true',
                callback = scriptVar })
        else
            local Time = require('Time');local lastup="";listidx="lastseen#"
            for _, node in pairs(item.json.result) do
				 if node.PlanID == "2" and node.HardwareName ~= "virtuels" and node.HardwareName ~= "surveillance réseau" and dz.devices(tonumber(node.idx)) then
				    --print(node.HardwareName)
				   	local lastSeen = Time(node.LastUpdate).hoursAgo
				   	local lastUpdated = dz.devices(tonumber(node.idx)).lastUpdate.hoursAgo
					local delta = lastSeen - lastUpdated
					if lastSeen > max_lastseen then -- limite en heure pour considérer le dispositif on line
					--print('idx:'..node.idx..','..node.Name..',LastUp:'..node.LastUpdate..' lastseen:'..lastSeen..'/'..delta)
					lastup = lastup..'idx:'..node.idx..','..node.Name..',LastUp:'..node.LastUpdate..' lastseen:'..lastSeen..'/'..delta..'<br>'
					listidx=listidx..' '..node.idx..node.Name..'LastUpdate:'..node.LastUpdate..'Lastseen:'..tostring(lastSeen)..'delta:'..tostring(delta)..'<br>'
				
					--dz.log('id '..  node.idx .. '('  ..node.Name .. ') lastSeen ' .. lastSeen ,dz.LOG_FORCE)
				end	
		    end
		
      end
      dz.variables('lastseen').set(listidx)
      obj='alarme lastseen: '..listidx;dz.email('LastSeen',lastup,adresse_mail)
    end
    
    end
}