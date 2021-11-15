--
--alarme--alarme.lua
--

--
--[[    function modect_cam(mode)
            for i = 1, 5 do
	      	os.execute('curl -XPOST http://192.168.1.90/zm/api/monitors/'..i..'.json -d "Monitor[Function]='..mode..'"') 
      	    print ("camera "..i.."mode activé :"..mode);
    	end
--]]
commandArray = {}

function notifications(txt)
        if (txt== "1") then txt="alarme porte ouverte"
        elseif  (txt== "2") then txt="alarme présence intérieure"    
        elseif  (txt== "3") then txt="PI4 Hors Service" 
        elseif  (txt== "4") then txt="alarme absence activée" 
        elseif  (txt== "5") then txt="alarme absence désactivée"    
        end
        os.execute("curl --insecure  'https://smsapi.free-mobile.fr/sendmsg?user=12812620&pass=2FQTMM7x42kspr&msg="..txt.."' >> /home/michel/OsExecute1.log 2>&1")
        os.execute("echo 'Idem4546' |sudo -S /home/michel/domoticz/scripts/pushover.py"..txt.." >> /home/michel/push.log 2>&1");
end
-- alarme ping PI4
        if ((otherdevices['Ping_pi4'] == 'Off') and  (uservariables['pi-alarme']=="0")) then commandArray['Variable:pi-alarme'] = "pi_hs"  
				notifications("3");print ("PI4 hors service");
		elseif ((otherdevices['Ping_pi4'] == 'On') and  (uservariables['pi-alarme']=="pi_hs")) then commandArray['Variable:pi-alarme'] = "0"		
		end	
-- alarme absence _activation
		if ((otherdevices['alarme_absence'] == 'On') and  (uservariables['ma-alarme']=="0")) then commandArray['Variable:ma-alarme'] = "1"  
				notifications("4");
				print ("alarme activée");
		end	
	    if ((otherdevices['alarme_absence'] == 'Off') and  (uservariables['ma-alarme']=="1")) then commandArray['Variable:ma-alarme'] = "0" 
		    notifications("5");
				print ("alarme désactivée");commandArray['Variable:porte-ouverte'] ="0";
		end
		-- activation de la detection par les cameras
--	    if ((otherdevices['MODECT'] == 'Off') and  (uservariables['ma-alarme']=="1")) then
--	        modect_cam('Modect') -- si alarme activé : mode camera=Modect
--	      	commandArray['MODECT']='On'
--	    elseif (devicechanged['MODECT'] == 'On')  then -- activation Modect avec inter
--	      	modect_cam('Modect')
--	    elseif (devicechanged['MODECT'] == 'Off')  then -- activation Monitor avec inter
--	      	modect_cam('Monitor')
--        end
-- alarme absence - 
        if (uservariables['ma-alarme']=="1")  then 
            if ((devicechanged['porte entree']) == 'Open')  then 
		     notifications("1");commandArray['Variable:porte-ouverte'] = "porte ouverte entrée" 
		    elseif ((devicechanged['porte cuisine']) == 'Open') then 
		    notifications("1");commandArray['Variable:porte-ouverte'] = "porte ouverte cuisine"
	        -- alarme absence -- autres dispositifs 
            elseif ((devicechanged['pir salon']) == 'On') then 
		     notifications("2")commandArray['Variable:intrusion'] = "intrusion salon"
            elseif ((devicechanged['pir cuisine']) == 'On') then 
		    notifications("2");commandArray['Variable:intrusion'] = "intrusion cuisine"
		    end
        
        end
		
		-- fin alarme absence
--alarme nuit
        if ((otherdevices['alarme_nuit'] == 'On') and  (uservariables['ma-alarme']=="0")) then commandArray['Variable:ma-alarme'] = "2"  
			print ("alarme activée");
		end
		if ((otherdevices['alarme_nuit'] == 'Off') and  (uservariables['ma-alarme']=="2")) then commandArray['Variable:ma-alarme'] = "0" 
		  commandArray['Variable:alarme'] = "0";  
		 print ("alarme désactivée");commandArray['Variable:porte-ouverte'] ="0";
        end
        if (uservariables['ma-alarme']=="2")  then 	commandArray['Variable:alarme'] = "alarme_nuit"; 
            if ((devicechanged['porte entree']) == 'Open')  then 
		        print ("porte ouverte");commandArray['Variable:porte-ouverte'] = "entrée" 
		        --mise en service sirene
                --commandArray['sirene_ma']='On'
		    elseif ((devicechanged['porte cuisine']) == 'Open') then 
		        print ("porte ouverte");commandArray['Variable:porte-ouverte'] = "cuisine" 
                --mise en service sirene
                --commandArray['sirene_ma']='On'
            end
        else commandArray['Variable:alarme'] = "0";
        end
 -- fin alarme nuit 
 -- raz variables de notification intrusion et porte ouverte
       if (otherdevices['raz-dz'] == 'On') then 
           commandArray['Variable:intrusion'] = "0";
           commandArray['Variable:porte-ouverte'] = "0";
           
    end
return commandArray