--
--[[
-- time
name : maj_services.lua  version 2.0

ce script à pour but de déterminer si nous sommes en semaine pair ou impair
et fonction de cela, le jeudi en fin d'après midi,
de nous alerter par SMS , par notifiction TV de sortir la poubelle concernée,
de gérer la fosse septique et les anniversaires.
-- les variables  domoticz A CREER
-- variables 'chaine': poubelles="0" , fosse_septique="0" ,anniversaires ,not_tv_fosse="0" , not_tv_poubelle="0"
-- ---------------------------------------------------------------------------------------------
la 1ere semaine est celle ayant au moins 4 jours sur la nouvelle année
--]]
-- Obtenez le jour de la semaine au début de l'année
--(tm peut être n'importe quelle date et sera forcé au 1er janvier de la même année)
-- retour 1=lundi 7=dimanche...
-- chargement fichier contenant les variable de configuration
package.path = package.path..";www/modules_lua/?.lua"
require 'string_tableaux'
local jpg=jour_poubelle_grise;local jpj=jour_poubelle_jaune
require 'connect'
local base64 = require'base64'
-- local user_free = base64.decode(login_free);local passe_free = base64.decode(pass_free);
-- local sms_free="curl --insecure  'https://smsapi.free-mobile.fr/sendmsg?user="..user_free.."&pass="..passe_free.."&msg=poubelle' >> /home/michel/OsExecute.log 2>&1"
function getYearBeginDayOfWeek(tm)
  yearBegin = os.time{year=os.date("*t",tm).year,month=1,day=1}
  yearBeginDayOfWeek = tonumber(os.date("%w",yearBegin))
-- sunday correct from 0 -> 7
  if(yearBeginDayOfWeek == 0) then yearBeginDayOfWeek = 7 end
  return yearBeginDayOfWeek
end
-- tm : date (telle que récupérée de os.time)
-- renvoie la correction de base à ajouter pour compter le nombre de semaines
-- weekNum = math.floor((dayOfYear + returnNumber) / 7) + 1
-- (ne considère pas les corrections en début et en fin d'année)...
function getDayAdd(tm)
  yearBeginDayOfWeek = getYearBeginDayOfWeek(tm)
  if(yearBeginDayOfWeek < 5 ) then
-- le premier jour est la semaine 1...
    dayAdd = (yearBeginDayOfWeek - 2)
  else 
   -- le premier jour est la semaine 52 ou 53...
    dayAdd = (yearBeginDayOfWeek - 9)
  end  
  return dayAdd
end
-- tm est la date renvoyée par os.time()
-- renvoie le numéro de semaine dans l'année basé sur ISO8601
-- (la semaine avec le 1er jeudi depuis le 1er janvier (inclus) est considérée comme la semaine 1)
-- (si le 1er janvier est vendredi, samedi, dimanche, cela fait partie du numéro de semaine de l'année dernière -> 52 ou 53)...
function getWeekNumberOfYear(tm)
  dayOfYear = os.date("%j",tm)
  dayAdd = getDayAdd(tm)
  dayOfYearCorrected = dayOfYear + dayAdd
  if(dayOfYearCorrected < 0) then
    -- semaine de l'année dernière - décidez si 52 ou 53...
    lastYearBegin = os.time{year=os.date("*t",tm).year-1,month=1,day=1}
    lastYearEnd = os.time{year=os.date("*t",tm).year-1,month=12,day=31}
    dayAdd = getDayAdd(lastYearBegin)
    dayOfYear = dayOfYear + os.date("%j",lastYearEnd)
    dayOfYearCorrected = dayOfYear + dayAdd
  end  
  weekNum = math.floor((dayOfYearCorrected) / 7) + 1
  if( (dayOfYearCorrected > 0) and weekNum == 53) then
    -- vérifier si cela n'est pas pris en compte dans la semaine 1 de l'année prochaine...
    nextYearBegin = os.time{year=os.date("*t",tm).year+1,month=1,day=1}
    yearBeginDayOfWeek = getYearBeginDayOfWeek(nextYearBegin)
    if(yearBeginDayOfWeek < 5 ) then
      weekNum = 1
    end  
  end  
  return weekNum
end  

function url_encode(str)
  if (str) then
    str = string.gsub (str, "\n", "\r\n")
    str = string.gsub (str, "([^%w %-%_%.%~])",
        function (c) return string.format ("%%%02X", string.byte(c)) end)
    str = string.gsub (str, " ", "+")
  end
  return str	
end
----------------------------------------------------------------------
 
commandArray = {}
local time = string.sub(os.date("%X"), 1, 5)
local day = os.date("%A")
local jour = os.date("%d") --jour du mois [01-31]
local mois = os.date("%m") --mois en cours
local jour_mois = jour.."-"..mois
-- passage à 0 heure 
if (time == "00:05"  or time == "17:00") then 
    commandArray['Variable:anniversaires'] = "0";
    commandArray['Variable:fosse septique'] = "0";
end 
-- POUBELLES
if (time == "17:00") then jpg1=0;jpj1=0;
    -- exclusion ou ajout dates poubelles ,
    for k,v in pairs(e_poubelles) do 
      if (jour_mois==k) then 
        if (v == "g") then jpg = ""; 
		elseif (v == "j") then jpj = "";
		end
      end    
    end
	for k,v in pairs(a_poubelles) do 
      if (jour_mois==k) then print(k..' '..jour_mois..' '..v)
		if (v == "g") then jpg = day;jpg1=1;
		elseif (v == "j") then jpj = day; jpj1=1;
		end
	  end    
    end  
if  ( day ==  jpg )  then commandArray['Variable:poubelles'] = "ordures_ménagères"
		-- poubelle  la variable passe à "poubelle_grise" .
	commandArray['Variable:not_tv_poubelle'] = "1"
	--commandArray['Variable:not_poubelles'] = "1"
	 print (time,day, "mettre les poubelles ordures ménagères");
	 -- envoi notification via free
		--os.execute(sms_free) résilié
	commandArray['SendEmail']='poubelles#ménagères#gravier.michel@gmail.com'		
		end
--
if ( day == jpj ) then 
    print ("-----"..time..day..jpj);
	-- récupérer numéro de la semaine actuelle
	useDate = os.time()	-- os.time{year=2015,month=9,day=30} -- il est possible de préciser la date
	weekNum = getWeekNumberOfYear(useDate)
	-- semaine pair ou impair
	pair_impair_semaine = weekNum%2 -- resultat =0 ou 1
	-- L' %opérateur (modulo) produit le reste de la division du premier argument par le second 
	print(os.date("%A %d/%m/%Y",useDate)..": week number:"..tostring(weekNum))
	if ( jpj1==1 or pair_impair_semaine==semaine_poub_jaune) then print(pair_impair_semaine); commandArray['Variable:poubelles'] = "poubelle_recyclables"
			-- poubelle jaune la variable passe à  "poubelle_jaune"
	commandArray['Variable:not_tv_poubelle'] = "1"
    print (time,day, "mettre les poubelles recyclabes");
		-- envoi notification via free
		--os.execute(sms_free) résilié
	commandArray['SendEmail']='poubelles#recyclabes#gravier.michel@gmail.com'	
		
		end
else print(day..jpj..time)
end

end

--RAZ-----------------------------------------------------------
if ((time == "06:50") and (uservariables['poubelles']=="ordures_ménagères" )) then commandArray['Variable:poubelles'] = "poubelle_grise_vide"  
end
if ((time == "00:10") and (uservariables['fosse_septique']=="fosse septique" )) then commandArray['Variable:fosse_septique'] = "0"  
end
if ((time == "09:30") and (uservariables['poubelles']=="poubelle_grise_vide" )) then commandArray['Variable:poubelles'] = "0"  
end
if ((time == "00:10") and (uservariables['poubelles']=="poubelle_recyclables" )) then commandArray['Variable:poubelles'] = "poubelle_jaune_vide"      
end  
if ((time == "09:10") and (uservariables['poubelles']=="poubelle_jaune_vide" )) then commandArray['Variable:poubelles'] = "0"  
end
-----------------------------------------------------------------------------------------------------------------------------------------------

-- fosse septique jour de traitement , ici le 12 de chaque mois
 if  ((time == "00:50") and (jour ==jour_fosse)) then
        commandArray['Variable:fosse_septique'] = "fosse septique"
        commandArray['Variable:not_tv_fosse'] = "1" -- notification télé
 end  
-- anniversaires ,
if (time == "01:30")  then
local jour_mois = jour.."-"..mois
    for k,v in pairs(anniversaires) do 
     -- print(v)--pour essai     
        if (jour_mois==k) then  commandArray['Variable:anniversaires'] = v;
          print(v)  
        end
    end
end

return commandArray 