--export_timer_sql

year 	= tonumber(os.date("%Y"));
month 	= os.date("%m");
day 	= os.date("%d");
day 	= os.date("%d");
time    = os.date("%X");
datetime = year.."-"..month.."-"..day.." "..time;
--
function envoi_fab(don)
        local command = "/bin/bash userdata/scripts/bash/./fabric.sh"..don.." > /home/michel/fab.log 2>&1";
        os.execute(command);
end
function round(num,numDecimal)
   local mult = 10^(numDecimal or 0)
  return math.floor(num * mult + 0.5) / mult
 end
--
return {
	on = {
        timer = {
             'at 09:00'
        }
    },
 execute = function(domoticz, item)
    domoticz.log('export sql: ' .. item.trigger)
       local Counter = domoticz.devices('linky_bis').counter; print("compteur_kwh:"..Counter)
       local Usage = domoticz.devices('linky_bis').usage;    print("compteur_kw:"..Usage) 
       libelle="energie#conso"
       don=" "..libelle.."#"..tostring(round(Counter,1)).."#"..datetime.."#pmax#"..tostring(round(Usage/1000,1)); print("energie"..don);
       envoi_fab(don)--
end
}
