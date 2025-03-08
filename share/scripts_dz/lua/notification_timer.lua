-- notifications_timer
package.path = package.path..";www/modules_lua/?.lua"
JSON=require 'json'
os.execute("python3 scripts/python/week.py")
require 'week'
local semaine=sem
local day = os.date("%A");print(day)
local time = string.sub(os.date("%X"), 1, 5)

return { 
    on = {
        timer = {
             'at 22:13',
             'at 23:16'
        }
    },
    execute = function(domoticz, item)
        domoticz.log('modif variables: ' .. item.trigger)
         --print(day,sem)
	    --médicaments
	  if (day=="Saturday" and semaine=="Semaine_paire" ) then
            domoticz.variables('pilule_chat').set('pilule_chat')
           
      --elseif time=='23:16' then
        --domoticz.openURL('http://192.168.1.30/monitor/api/json.php?app=maj&id=123&state=Off')
       -- print("truffiere2..."..tostring(domoticz.devices('truffiere - Linky').usage ))   
       
      end
	end
}