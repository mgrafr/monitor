--export_timer_sql

year 	= tonumber(os.date("%Y"));
month 	= os.date("%m");
day 	= os.date("%d");
day 	= os.date("%d");
time    = os.date("%X");

datetime = year.."-"..month.."-"..day.." "..time;
local function split(s, delimiter)
	local result = {}
	for match in (s..delimiter):gmatch('(.-)'..delimiter) do
		table.insert(result, match)
	end
	return result
end
--function tointeger( x )
--    num = tonumber( x )
--    return num < 0 and math.ceil( num ) or math.floor( num )
--end
function envoi_fab(don)
        local command = "/bin/bash userdata/scripts/bash/./fabric.sh"..don.." > /home/michel/fab.log 2>&1";
        os.execute(command);
end
function round(num,numDecimal)
   local mult = 10^(numDecimal or 0)
  return math.floor(num * mult + 0.5) / mult
 end
--
local scriptVar = 'linky_sql'
return {
    on = { 
        timer =  {'at 10:30'}, 
        httpResponses = { scriptVar }},
        logging = { level = domoticz.LOG_ERROR, marker  = scriptVar },
    
    execute = function(dz, item) 
        if (item.isTimer) then
            local url = 'http://127.0.0.1:8080/json.htm?type=command&param=getdevices&rid=427';
            print(url);
            dz.openURL({ 
                url = url, 
                method = 'GET',
                callback = scriptVar, })
        end
        if (item.isHTTPResponse ) then
            local results = item.json.result
            -- loop through the nodes and print some info
            for i, node in pairs(results) do
            print('Data'.. node.Data);m=split(node.Data, ';')
            local mCounter = m[1] ; print("compteur_kwh:"..mCounter);--mCounter=tointeger(mCounter)/1000;
            local mUsage = m[5] ;    print("compteur_kw:"..mUsage) ;
            
            libelle="energie#conso"
            don=" "..libelle.."#"..tostring(round(tonumber(mCounter)/1000,1)) .."#"..datetime.."#pmax#"..tostring(round(tonumber(mUsage)/1000,1)); print("energie"..don);
            envoi_fab(don)
            end
        end
end
}
