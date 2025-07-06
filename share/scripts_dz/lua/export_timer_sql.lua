--export_timer_sql
--json = (loadfile "/opt/domoticz/scripts/lua/JSON.lua")()

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

--
local scriptVar = 'linky_sql'
return {
    on = {
        timer =  {'at 09:02'}, 
        httpResponses = { scriptVar }},
        logging = { level = domoticz.LOG_ERROR, marker  = scriptVar },
    
    execute = function(dz, item) 
        if (item.isTimer) then
            local url = dz.settings['Domoticz url']..'/json.htm?type=command&param=getdevices&rid=770';
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
            valeur=tostring(round(tonumber(mCounter)/1000,1)) ;pmax=tostring(round(tonumber(mUsage)/1000,1)); print("energie"..valeur..pmax);
            envoi_fab(libelle,valeur,pmax)
            end
        end
end
}

   

        

 