-- maj temp hum battery
-- Humidity_status peut être l'un des suivants:
--0 = normal
--1 = confortable
--2 = sec
--3 = mouillé

local scriptVar = 'separation_valeurs'
return 
{
    on = 
    {
        customEvents = 
        {
            scriptVar,
        },
        httpResponses = 
        {
            scriptVar,
        },
    },
    logging =
    {
        level = domoticz.LOG_DEBUG, -- LOG_ERROR 
        marker = scriptVar,
    },
    execute = function(dz, item)
        lodash = dz.utils._
        
        local function sendURL(idx, temperature,batteryLevel) --CAPTEURS TEMPERATURE: svalue=temp    battery= volts battery
            local url = dz.settings['Domoticz url'] .. '/json.htm?type=command&param=udevice&idx=' .. idx .. '&nvalue=0&svalue=' .. temperature .. '&battery=' .. batteryLevel;
            dz.openURL(
            {   url = url,
                callback = scriptVar,
            })
        end
        local function sendURL1(idx, temperature,humidity,confort,batteryLevel) --CAPTEURS TEMPERATURE+HUMIDITE : svalue=temp;hum;Humidity_status   battery=volts battery
            local url = dz.settings['Domoticz url'] .. '/json.htm?type=command&param=udevice&idx=' .. idx .. '&nvalue=0&svalue=' .. temperature ..';'..  humidity ..';' .. confort .. '&battery=' .. batteryLevel;
            dz.openURL(
            {   url = url,
                callback = scriptVar,
            })
        end
            if item.isCustomEvent then 
            mqtt = item.data;print ("q:" .. mqtt)
            mqtt = dz.utils.fromJSON(mqtt) 
            local batteryLevel = mqtt.batteryLevel 
            local temperature = mqtt.temperature 
            local humidity = mqtt.humidity 
            local humidity_status=tonumber(humidity);print ("q:" .. humidity_status)
                if (humidity_status<30) then confort = "2" ;
                elseif (humidity_status>39 and humidity_status<60) then confort = "1" ;
                elseif (humidity_status>59 and humidity_status<80) then confort = "0" ;
                elseif (humidity_status>79) then confort = "3";
                else confort = "3"  
                end    
            local idx = mqtt.idx; 
            local type=dz.devices(idx).deviceType;print("type" .. tostring(type) .. ' ,  humidity_status : ' .. tostring(confort)); 
            if (type=='Temp')  then sendURL(idx, temperature, batteryLevel);
            elseif (type=='Temp + Humidity') then sendURL1(idx, temperature, humidity, confort, batteryLevel);
            else print("pas de dispositif trouvé");
            end
        elseif not item.ok then
            dz.log('Problèm avec l\'envoi de la temperature ou  batteryLevel' .. lodash.str(item), dz.LOG_ERROR)     
        else
            dz.log('All ok \n' .. lodash.str(item.data) .. '\n', dz.LOG_DEBUG)     
        end
    end
    
}
