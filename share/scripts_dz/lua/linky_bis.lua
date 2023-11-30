local time = string.sub(os.date("%X"), 1, 5)
return {
on = {
	timer = {
		'at 08:32'					-- specific time
	}
},
logging = {
	level = domoticz.LOG_INFO,
	marker = 'template',
},
execute = function(domoticz, timer)
	domoticz.log('Timer event was triggered by ' .. timer.trigger, domoticz.LOG_INFO)
	 if time=='10:25' then 
	     print("Launch Linky")
    os.execute('python3 userdata/scripts/python/DomoticzLinky/linky.py >>  /opt/domoticz/userdata/linky.log 2>&1')
    end
end
}