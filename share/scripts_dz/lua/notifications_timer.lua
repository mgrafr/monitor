-- notifications_timer
package.path = package.path..";www/modules_lua/?.lua"
JSON=require 'json'

local time = string.sub(os.date("%X"), 1, 5)

return {
    on = {
        timer = {
             'at 19:30',
             'at 15:55'
        }
    },
    execute = function(domoticz, item)
        domoticz.log('modif variables: ' .. item.trigger)
        
	    --médicaments
	  if (time=='19:30' and domoticz.variables('pilule_tension').value == '0') then
            domoticz.variables('pilule_tension').set('pilule_michel')
      --elseif time=='15:55' then
       -- print("truffiere1..."..tostring(domoticz.devices('truffiere - Linky').counter )) 
       -- print("truffiere2..."..tostring(domoticz.devices('truffiere - Linky').usage ))   
       
      end
	end
}