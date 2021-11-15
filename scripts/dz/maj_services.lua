--
--[[
-- time
name : maj_services.lua

ce script à pour but de déterminer si nous sommes en semaine pair ou impair
et fonction de cela, le jeudi en fin d'après midi,
de nous alerter par SMS , par notifiction TV de sortir la poubelle concernée,
de gérer la fosse septique et les anniversaires.
-- les variables  domoticz A CREER
-- variables 'chaine': poubelles="0" , fosse_septique="0" ,anniversaires ,not_tv_fosse="0" , not_tv_poubelle="0"
-- ---------------------------------------------------------------------------------------------
la 1ere semaine est celle ayant au moins 4 jours sur la nouvelle année
--]]
-- Get day of a week at year beginning 
--(tm can be any date and will be forced to 1st of january same year)
-- return 1=mon 7=sun
function getYearBeginDayOfWeek(tm)
  yearBegin = os.time{year=os.date("*t",tm).year,month=1,day=1}
  yearBeginDayOfWeek = tonumber(os.date("%w",yearBegin))
  -- sunday correct from 0 -> 7
  if(yearBeginDayOfWeek == 0) then yearBeginDayOfWeek = 7 end
  return yearBeginDayOfWeek
end
-- tm: date (as retruned from os.time)
-- returns basic correction to be add for counting number of week
--  weekNum = math.floor((dayOfYear + returnedNumber) / 7) + 1 
-- (does not consider correctin at begin and end of year) 
function getDayAdd(tm)
  yearBeginDayOfWeek = getYearBeginDayOfWeek(tm)
  if(yearBeginDayOfWeek < 5 ) then
    -- first day is week 1
    dayAdd = (yearBeginDayOfWeek - 2)
  else 
    -- first day is week 52 or 53
    dayAdd = (yearBeginDayOfWeek - 9)
  end  
  return dayAdd
end
-- tm is date as returned from os.time()
-- return week number in year based on ISO8601 
-- (week with 1st thursday since Jan 1st (including) is considered as Week 1)
-- (if Jan 1st is Fri,Sat,Sun then it is part of week number from last year -> 52 or 53)
function getWeekNumberOfYear(tm)
  dayOfYear = os.date("%j",tm)
  dayAdd = getDayAdd(tm)
  dayOfYearCorrected = dayOfYear + dayAdd
  if(dayOfYearCorrected < 0) then
    -- week of last year - decide if 52 or 53
    lastYearBegin = os.time{year=os.date("*t",tm).year-1,month=1,day=1}
    lastYearEnd = os.time{year=os.date("*t",tm).year-1,month=12,day=31}
    dayAdd = getDayAdd(lastYearBegin)
    dayOfYear = dayOfYear + os.date("%j",lastYearEnd)
    dayOfYearCorrected = dayOfYear + dayAdd
  end  
  weekNum = math.floor((dayOfYearCorrected) / 7) + 1
  if( (dayOfYearCorrected > 0) and weekNum == 53) then
    -- check if it is not considered as part of week 1 of next year
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
-- passage à 0 heure 
if (time == "00:05"  or time == "00:15") then 
    commandArray['Variable:anniversaires'] = "0";
    commandArray['Variable:fosse septique'] = "0";
end 
local jour_poubelle_grise="Wednesday"
local jour_poubelle_jaune="Sunday"
local semaine_poub_jaune= 0  -- 0 pour pair 1 pour impair
local jour_fosse="21"
-------------------------------------------------------------
if ((time == "00:10") and (uservariables['poubelles']=="poubelle_grise" )) then commandArray['Variable:poubelles'] = "poubelle_grise_vide"  
end
if ((time == "00:10") and (uservariables['fosse_septique']=="fosse septique" )) then commandArray['Variable:fosse_septique'] = "0"  
end
if ((time == "09:00") and (uservariables['poubelles']=="poubelle_grise_vide" )) then commandArray['Variable:poubelles'] = "0"  
end
if ((time == "00:10") and (uservariables['poubelles']=="poubelle_jaune" )) then commandArray['Variable:poubelles'] = "poubelle_jaune_vide"      
end  
if ((time == "09:10") and (uservariables['poubelles']=="poubelle_jaune_vide" )) then commandArray['Variable:poubelles'] = "0"  
end
--
if  (( day == jour_poubelle_grise ) and (time == "17:00")) then commandArray['Variable:poubelles'] = "poubelle_grise"
		-- poubelle  la variable passe à "poubelle_grise" .
	commandArray['Variable:not_tv_poubelle'] = "1"	
	 print (time,day, "mettre les poubelles ordures ménagères");
	 -- envoi notification via free
		os.execute("curl --insecure  'https://smsapi.free-mobile.fr/sendmsg?user=12812620&pass=2FQTMM7x42kspr&msg=poubelle' >> /home/michel/OsExecute.log 2>&1")
		end
--
if ( day == jour_poubelle_jaune and (time == "18:38")) then 
    print ("-----"..time,day);
	-- récupérer numéro de la semaine actuelle
	useDate = os.time()	-- os.time{year=2015,month=9,day=30} -- il est possible de préciser la date
	weekNum = getWeekNumberOfYear(useDate)
	-- semaine pair ou impair
	pair_impair_semaine = weekNum%2 -- resultat =0 ou 1
	-- L' %opérateur (modulo) produit le reste de la division du premier argument par le second 
	print(os.date("%A %d/%m/%Y",useDate)..": week number:"..tostring(weekNum))
	if (pair_impair_semaine==semaine_poub_jaune) then commandArray['Variable:poubelles'] = "poubelle_jaune"
			-- poubelle jaune la variable passe à  "poubelle_jaune"
	commandArray['Variable:not_tv_poubelle'] = "1"		
	 print (time,day, "mettre les poubelles recyclabes");
		-- envoi notification via free
		os.execute("curl --insecure  'https://smsapi.free-mobile.fr/sendmsg?user=12812620&pass=2FQTMM7x42kspr&msg=poubelle' >> /home/michel/OsExecute.log 2>&1")
		
		end
end
-- fosse septique jour de traitement , ici le 12 de chaque mois
 if  ((time == "00:50") and (jour ==jour_fosse)) then
        commandArray['Variable:fosse septique'] = "fosse septique"
        commandArray['Variable:not_tv_fosse'] = "1" -- notification télé
 end  
-- anniversaires ,
local anniv = {"27-08","18-05","14-09","19-07","25-08","01-05","07-11","22-08","14-03","31-10","01-02","14-04","25-04","23-05","23-08","24-07","09-07","27-03","06-03","02-11"};
local prenom = {"Damien","Yoann","Jonathan","Alexandra","Charlotte","Guillaume","Corentin","Pauline","Clémence","Eric","Nathalie","Christèle","Katy","Eveline","Jean Paul","Arthur","Jade","Judith","Annie","Nicole"};
local anni = jour.."-"..mois
if (time == "01:30")  then
for index, value in ipairs(anniv) do
        if (value == anni)  then
        commandArray['Variable:anniversaires'] = prenom[index];
        print(prenom[index])--pour essai
        end
end
end
 
return commandArray 