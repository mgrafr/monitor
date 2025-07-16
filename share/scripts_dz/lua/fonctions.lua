-- chargement fichier contenant les variable de configuration
package.path = package.path..";/opt/domoticz/www/modules_lua/?.lua"
require 'string_tableaux' 
require 'connect'
function alerte_gsm(txt) -- ATTENTION PAS ESPACES pour txt
f = io.open("/opt/domoticz/scripts/python/aldz.py", "w")
env="#!/usr/bin/env python3"
f:write(env.." -*- coding: utf-8 -*-\nx='"..txt.."'\npriority=1")
f:close()
print(txt)
end
function  tointeger(number)
    return math.floor(tonumber(number) or error("Could not cast '" .. tostring(number) .. "' to number.'"))
end
function round(num,numDecimal);
   ---num=tointeger(num)
    mult = 10^(numDecimal or 0)
  return math.floor(num * mult + 0.5) / mult
 end
function detect_frigate(t)
    json_val=decode_json('http://'..ip_monitor..'/monitor/admin/string_modect.json')
  for k,v in pairs(json_val) do 
   for key,value in pairs(v) do    
    print('t='..t)
    print(value)
      if (t==1) then 
      command = 'python3 scripts/python/fr_mqtt.py  frigate/'..value..'/detect/set ON >  /opt/domoticz/frigate.log 2>&1' 
      elseif (t==2) then 
      command = 'python3 scripts/python/fr_mqtt.py  frigate/'..value..'/detect/set OFF >  /opt/domoticz/frigate.log 2>&1' 
      end
    print(command) 
    os.execute(command)
    end
    end
end 
function modect_cam(mode)
       json_val=decode_json('curl -XPOST -d "user=xxxxx&pass=xxxxxxxx"  http://192.168.1.23/zm/api/host/login.json')
       print(json_val.access_token)
       cle=json_val.access_token
       json_val=decode_json('http://'..ip_monitor..'/monitor/admin/string_modect.json')
       for k,v in pairs(json_val) do --cam_modect dans string_modect
        print('essai='..k)--pour essai
        command='/usr/bin/curl -XPOST http://'..ip_zoneminder..'/zm/api/monitors/'..k..'.json?token='..cle..' -d "Monitor[Function]='..mode..'&Monitor[Enabled]='..k..'"'
        print(command)
            os.execute(command) 
            print ("camera "..tostring(k).."activée :"..tostring(mode));
        end
end
function decode_json(fich_json)
    local config = assert(io.popen('/usr/bin/curl '..fich_json))
    local blocjson = config:read('*a')
       config:close()
       local jsonValeur = json:decode(blocjson)
       --print('succes='..jsonValeur.version)
       return jsonValeur
end
function envoi_fab(libelle,valeur,valeur1)
 if (valeur1==nil )  then
    don=" "..libelle.."#"..valeur.."#"..datetime
 elseif (valeur1~=nil )  then
    don=" "..libelle.."#"..valeur.."#"..datetime..'#pmax#'..valeur1  
 end
 print("maj valeur:"..don);
 command = "/bin/bash /opt/domoticz/scripts/bash/./fabric.sh "..don.." > /home/michel/fab1.log 2>&1";
        os.execute(command);
end
-- -----------------------------------------------------------------------------------------------------
function send_topic(txt,txt1)
sse = 'python3 scripts/python/sse.py '..txt..' '..txt1..' >  /opt/domoticz/sse.log 2>&1' ;
print(sse);
os.execute(sse)
end
function send_sms(txt)
os.execute('/bin/bash scripts/bash/./pushover.sh '..txt..' >>  /opt/domoticz/push3.log 2>&1');
end
function send_sse(sxt,sxt1)
    print(sxt,sxt1)
 api_mon="curl -s 'http://"..ip_monitor.."/monitor/api/json.php?app=maj&id="..sxt.."&state="..sxt1.."' > ss.log"
print(api_mon)
os.execute(api_mon)
end
-- ---------------------------------------------------------------------------------------------------------
--local user_free = base64.decode(login_free);local passe_free = base64.decode(pass_free);
function envoi_sms_free(txt,fich_log)
-- local sms_free="curl --insecure  'https://smsapi.free-mobile.fr/sendmsg?user="..user_free.."&pass="..passe_free.."&msg="..txt.."' >> "..rep_log..fich_log.." 2>&1"  
-- os.execute(sms_free)
end

-- function write_datas(data0)
--f = io.open("www/modules_lua/datas.lua", "w")
--f:write('pression='..data0)
--f:close()
--end
--
