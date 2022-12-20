-- notifications_timer

local time = string.sub(os.date("%X"), 1, 5)
return {
    on = {
        timer = {
             'at 16:25',
             'at 16:30',
        }
    },
    execute = function(domoticz, item)
        domoticz.log('alarme nuit: ' .. item.trigger)
        if (time=='16:25') then
            if(domoticz.devices('al_nuit_auto').state == "On")  then 
                domoticz.devices('alarme_nuit').switchOn();print('al_nuit=ON')
            end
        elseif (time=='16:30') then    
            if(domoticz.devices('al_nuit_auto').state == "On")  then 
                domoticz.devices('alarme_nuit').switchOff();domoticz.variables('alarme').set("alarme_auto");print('al_nuit=OFF')    
            end  
	    end
	end
}