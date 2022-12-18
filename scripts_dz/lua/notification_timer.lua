-- notifications_timer
return {
    on = {
        timer = {
             'at 23:00-06:00',
        }
    },
    execute = function(domoticz, item)
        domoticz.log('The rule that triggered the event was: ' .. item.trigger)
        --if (domoticz.variables('boite_lettres').value ~= "0") then 
                --domoticz.variables('boite_lettres').set('0')
                 --local command = "/home/michel/domoticz/scripts/python/mqtt.py esp/in/boite_lettres valeur 0   >> /home/michel/esp.log 2>&1" ;
                 --os.execute(command);    
          --end 
        if(domoticz.devices('al_nuit_auto').state == "On" and item.isTimer ) then 
                domoticz.devices('alarme_nuit').switchOn();print('al_nuit=ON')
        else domoticz.devices('alarme_nuit').switchOff();print('al_nuit=OFF')   
        end  
	end
}