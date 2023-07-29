-- notifications_timer

local time = string.sub(os.date("%X"), 1, 5)
return {
    on = {
        timer = {
             'at 23:00',
             'at 06:00',
             'at 09:15',
        }
    },
    execute = function(domoticz, item)
        domoticz.log('modif variables: ' .. item.trigger)
        if (time=='23:00') then
            if(domoticz.devices('al_nuit_auto').state == "On")  then 
                domoticz.devices('alarme_nuit').switchOn();print('al_nuit=ON')
            end
        elseif (time=='06:00') then    
            if(domoticz.devices('al_nuit_auto').state == "On")  then 
                domoticz.variables('alarme').set('alarme_auto');
                domoticz.devices('alarme_nuit').switchOff();print('al_nuit=OFF')    
            end  
	    --médicaments
	   elseif (time=='09:15' and domoticz.variables('pilule_tension').value == '0') then
            domoticz.variables('pilule_tension').set('pilule_michel')
       end
	end
}