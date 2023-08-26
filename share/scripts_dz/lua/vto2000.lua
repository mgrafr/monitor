--vto2000 Dahua exploiter le changement de valeur d' une variable 
-- pour signaler l' appui sur le portier video vto2000
--
package.path = package.path..";www/modules_lua/?.lua"
require 'connect'

commandArray = {}
--
-- 
if (uservariables['sonnette']=="1") then 
--          --envoi image pushover ---------------
            os.execute("/bin/bash userdata/scripts/bash/./pushover_img.sh "..ip_domoticz..">> /home/michel/push.log 2>&1");
            commandArray['Variable:sonnette'] = '0'
--        
--    
end

return commandArray