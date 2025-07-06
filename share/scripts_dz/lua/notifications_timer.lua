-- notifications_timer
package.path = package.path..";/opt/domoticz/www/modules_lua/?.lua"
JSON=require 'json'
os.execute("python3 scripts/python/week.py")
require 'week'
require 'string_tableaux'
local semaine=sem
--print(semaine)
local day = os.date("%A");--print(day)
local time = string.sub(os.date("%X"), 1, 5)
--print(day..semaine..'  '..semaine_pilule_chat)
return { 
    on = {
        timer = {
             'at 07:45',
             'at 23:16'
        }
    },
    execute = function(domoticz, item)
        domoticz.log('modif variables: ' .. item.trigger)
         --print(day,sem)
	    --médicaments
	  if (day==jour_pilule_chat and semaine==semaine_pilule_chat ) then
            domoticz.variables('pilule_chat').set('pilule_chat')
           
      --elseif time=='23:16' then
        --domoticz.openURL('http://192.168.1.30/monitor/api/json.php?app=maj&id=123&state=Off')
       -- print("truffiere2..."..tostring(domoticz.devices('truffiere - Linky').usage ))   
       
      end
	end
}