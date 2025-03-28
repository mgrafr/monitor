5. L’ALARME
-----------
Pour l’activation ou l’arrêt par GSM voire ce paragraphe qui traite du script python avec les codes retenus pour l’alarme. :ref:`18.4 Commandes de l’alarme à partir d’un GSM`

|image408|

*Pour toutes les fonctions, entrer le mot de passe* 

Le script LUA dans Evènements de Domoticz : https://raw.githubusercontent.com/mgrafr/monitor/main/scripts_dz/lua/alarme_v3_0_5.lua

.. IMPORTANT::

   La détection par les caméras peut être utilisée avec FRIGATE et ZONEMINDER et MONITOR

5.1 Les interrupteurs réels, virtuels, les variables
^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^
**Pour Home Assistant**:

|image1370|

|image1371|

Voir ci dessous la description pour Domoticz, valable également pour Home Assistant

**Pour Domoticz**

*les interrupteurs virtuels*

Les boutons poussoir marche/arrêt pour les commandes :

- m/a alarme de nuit : :darkblue:`alarme_nuit`

- m/a alarme absence : :darkblue:`alarme_absence`

|image409|

- m/a al_nuit_auto :   :darkblue:`al_nuit_auto`

- m/a mode detect des caméras : :green:`Modect`

- poussoir « PUSH » après 2s pour tester la sirène : :green:`test_sirene` (création d'un scénario avec la sirène)

|image410|

|image1342|

- poussoir de reset des valeurs en cas d'alarme : :green:`raz_dz`

- activation/désactivation de la sirène : :darkblue:`activation-sirene` , permet de faire des essais sans nuisances sonores ; la sirène est toutefois indiquée ON ou OFF

*un interrupteur réel*

- celui inclus dans la sirène

**Options** : 

*allumages de lampes* :

Dans ce tuto : lampe_salon (lampe commandée par le 433MHz avec une interface Sonoff modifié, voir le site domo-site.fr

*test du modem GSM* , envoi d'un sms avec un bouton de sonnette

|image1343|

.. note::

   les images ci-dessus sont des copies d'écran de Domoticz , pour Home assistant copie d'écran de la sirene et des interrupteurs virtuels (fichier configuration.yaml)

   |image1344| |image1345|

   |image1346|


5.1.1 Pour utilisation avec Domoticz
====================================

On ajoute les dispositifs au plan ; 

.. note::
   le plan peut se résumer à un simple cadre ou être très simplifié, il ne sert qu’à regrouper les dispositifs pour récupérer les données avec un seul appel à l’API json

|image414|

|image417|

**Les variables, initialisée** à 0 (sauf pour activation-sir-txt)

-	**modect** : pour la mise en service de la détection par caméras (non utilisé actuellement, pour une notification en page d’accueil ou autre …)

-	**porte-ouverte**

-	**intrusion**

-	**alarme** : est utilisée pour un affichage sur la page d’accueil ; 

-	**activation-sir-txt**, texte activation de la sirène : activer ou désactiver

Tous les Items

|image423|

.. note::

   la notification se fait par modem GSM mais il est facile d'ajouter l'envoi de Push ou Email

|image424|

.. warning::

   **ATTENTION** :
   L’utilisation du modem 4G Ebyte n’autorise pas, pour les textes, les accents et les espaces, utiliser des Under scores(ou autre signe) pour séparer les mots

Partie du script concernant  :darkblue:`l'alarme`,

.. code-block::

   -- listes des dispositifs
	-- les capteurs d'ouverture et de présence DEVICE CHANGED
	-- {capteur,etat,modif variable,contenu variable,notification,alarme}   alarme 0=absence et nuit 1=absence seulement 
	local a1={'porte_entree','On','porte-ouverte','porte_ouverte_entree'};
	local a2={'porte ar cuisine','On','porte-ouverte','porte_ouverte_cuisine'};
	local a3={'porte_fenetre','On',':porte-ouverte','fenetre_ouverte_sejour'};
	local a4={'pir_entree_motion','On','intrusion','intrusion_entree'};
	local a5={'pir ar cuisine_motion','On','intrusion','intrusion_cuisine'};
	local A1={a1,a2,a3,a4,a5};local A2={a1,a2,a3};
   --
   local time = string.sub(os.date("%X"), 1, 5)
   sirene=0;lampe=0
   --
   return {
	on = {
	
		devices = {
		    'pir ar cuisine_motion',
		    'pir_entree_motion',
		    'porte_entree',
		    'porte ar cuisine',
		    'porte_fenetre',
		    	'alarme_nuit',
		    	'alarme_absence',
		    	'Modect',
		    	'raz_dz',
			'al_nuit_auto',
			'activation-sirene',
			'Test_GSM',
			'test_sirene'
		    },
		    timer = {
             'at 15:45',
             'at 06:00'}
		},
		execute = function(domoticz, item, triggerInfo)
	    --domoticz.log('Alarme ' .. item .. ' was changed', domoticz.LOG_INFO)
       --*********************variables***************************************	
	-- alarme absence - 
      if (item.name =='pir ar cuisine_motion' or item.name=='pir_entree_motion' or item.name=='porte_entree' or item.name=='porte ar cuisine' or item.name=='porte_fenetre') then
        if (domoticz.variables('ma-alarme').value == "1") then 
            for k, v in ipairs(A1) do 
                if (item.name == A1[k][1] and item.name ~= nil) then
                    if (item.state == A1[k][2] ) then 
        	        domoticz.variables(A1[k][3]).set(A1[k][4]);
    	            else print("erreur:"..A1[k][1])
    	            end
        	end
            end
        end
      -- alarme nuit
        if (domoticz.variables('ma-alarme').value == "2") then 
            for k, v in ipairs(A2) do 
               if (item.name == (A2[k][1]) and item.state == A2[k][2] ) then 
        	   domoticz.variables(A2[k][3]).set(A2[k][4]);lampe=1;sirene=1;
        	end
            end
           --allumer lampes
            if (lampes==1) then devices('lampe_salon').switchOn();lampes="2"
            end    
        --mise en service sirene
            if (sirene==1) then devices('sirene').switchOn();sirene="2"
            end 
            if (sirene==2 and domoticz.device('activation-sirene').state == 'On') then  devices('sirene').switchOn();sirene="3"
            end    
        end  
        -- fin alarme nuit   
        if (domoticz.variables('porte-ouverte').changed) then  
	             txt=tostring(domoticz.variables('porte-ouverte').value) 
	             print("porte-ouverte")
                 alerte_gsm('alarmeù'..txt)
        end
        if (domoticz.variables('intrusion').changed) then  
	             txt=tostring(domoticz.variables('intrusion').value) 
	             print('intrusion')
                 alerte_gsm('alarmeù'..txt)
        end

Partie du script concernant :darkblue:`les options : interrupteurs on/off` ,

.. code-block::

    else 
      --*******************devices virtuels************************************        
        
      --elseif (item.name =='alarme_nuit' or item.name=='alarme_absence' or item.name=='Modect' or item.name=='raz_dz' or item.name=='al_nuit_auto' or item.name=='activation-sirene' or item.name=='Test_GSM') then 
    elseif (find_string_in(virtuels, item.name)==true) then print("elseif:"..item.name)
        -- alarme nuit_activation
        if (item.name == 'alarme_nuit' and  item.state=='On' ) then 
        txt='alarmeùnuitùactivee';obj='alarme_nuit_activee';
        alerte_gsm(txt);domoticz.variables('alarme').set("alarme_nuit"); 	
	    elseif (item.name == 'alarme_nuit' and  item.state=='Off' ) then
        txt='alarmeùnuitùdesactivee';obj='alarme_nuit_desactivee';alerte_gsm(txt);
            if (domoticz.variables('alarme').value~='alarme_auto') then domoticz.variables('alarme').set("0");
            end
        end	
        -- alarme absence _activation
        if (item.name == 'alarme_absence' and  item.state=='On' ) then domoticz.variables('alarme').set("alarme_absence"); 
        txt='alarmeùabsenceùactivee';obj='alarme absence activee';alerte_gsm(txt) ; domoticz.email('Alarme',obj,adresse_mail)	
	    elseif (item.name == 'alarme_absence' and  item.state=='Off') then domoticz.variables('alarme').set("0");
        txt='alarmeùabsenceùdesactivee';obj='alarme absence desactivee';
        alerte_gsm(txt);alerte_gsm(txt) ; domoticz.email('Alarme',obj,adresse_mail)	
        end	
	    
        -- activation de la detection par les cameras
	    if (item.name == 'Modect' and item.state=='Off' and  domoticz.variables('ma-alarme').value=="1") then 
	    devices('Modect').switchOn();
	    end 
        -- activation manuelle Modect
	if (item.name == 'Modect' and  item.state=='On' ) then 
	    domoticz.variables('modect').set("modect");detect_frigate(1)   --modect_cam('Modect')  , pour zneminder
	    -- activation manuelle Monitor 	
	    elseif (item.name == 'Modect' and  item.state=='Off' ) then
	    domoticz.variables('modect').set("monitor");detect_frigate(2)  --modect_cam('Monitor')   , pour zneminder
        end 
       
        -- raz variables de notification intrusion et porte ouverte
        if (item.name == 'raz_dz' and item.state=='On') then domoticz.devices('raz_dz').switchOff();
        domoticz.variables('intrusion').set("0");domoticz.variables('porte-ouverte').set("0");
        end
        -- alarme auto
            if (item.name == 'al_nuit_auto' and  item.state=='On') then txt='alarme_nuit_auto_activee';alerte_gsm(txt); domoticz.variables('alarme').set("alarme_auto");
            elseif (item.name == 'al_nuit_auto' and  item.state=='Off') then txt='alarmeùnuitùautoùdesactivee';alerte_gsm(txt);domoticz.variables('alarme').set("0");
            end
         -- activation sirène
            if (item.name == 'activation-sirene' and  item.state=='On') then domoticz.variables('activation-sir-txt').set("désactiver");
            else domoticz.variables('activation-sir-txt').set("activer");
            end
         --
            if (item.name == 'Test_GSM') then print("test_gsm")
            txt='TestùGSMùOK';alerte_gsm(txt);send_sms(txt);
            obj='Test GSM OK';domoticz.email('Alarme',obj,adresse_mail) 
            --domoticz.devices('Test_GSM').switchOff()
            end 
        -- test sirene
        if (item.name == 'Test_tsirene') then print("test_sirene")
        end    
          print("sse="..item.name);send_sse(item.id,item.state);  
     else print("alarme nuit :"..time)
     end

Partie du script concernant :darkblue:`le timer` ,

|image426|

.. note::

   L’utilisation de :red:`timer { at hh:mm` , :red:`hh:mm` ne peut être utilisé ; 

   j’ai essayé isTimer mais ça ne fonctionne que pour ON ; else avec isTimer ne fonctionne pas.

.. admonition:: **des explications concrnant le script alarme_3.lua** 

   |image428|

   **Pour activer ou désactiver la sirène** :

      Pour les textes : notifications_devices.lua

   .. code-block::

      -- activation sirène
            if (device.name == 'activation-sirene' and  device.state=='On') then domoticz.variables('activation-sir-txt').set("désactiver");
            else domoticz.variables('activation-sir-txt').set("activer");
            end  

   *Pour l’activation ou la désactivation* :

    |image431|

   *Pour allumer des lampes* :

    |image432|

   *Pour ajouter des dispositifs* :

    |image433|

**Pour ajouter une notification PUSHOVER** , ajouter ces lignes:

|image429|

*le scripts bash *

 .. code-block::

   #!/bin/bash
   TITLE="Alerte"
   APP_TOKEN="xxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxx"
   USER_TOKEN="xxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxx"
   MESSAGE=$1
   echo $1
   curl -s -F "token=$APP_TOKEN" \
   -F "user=$USER_TOKEN" \
   -F "title=$TITLE" \
   -F "message=$MESSAGE" \
   https://api.pushover.net/1/messages.json

*Ou en Python* :

.. code-block::

   #!/bin/python
   import requests,sys
   x= str(sys.argv[1])
   r = requests.post("https://api.pushover.net/1/messages.json", data = {
   "token": "xxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxx",
   "user": "xxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxx",
   "message": x
   })
   print(r.text)

**Pour la mise à jour de monitor:**

.. code-block::

   send_sse(item.id,item.state);

|image1340|

|image1341|

Voir les pages web :

- http://domo-site.fr/accueil/dossiers/10 

- Et http://domo-site.fr/accueil/dossiers/8

.. admonition:: **Résumé des scripts Domoticz concernés**

   |image434|

5.1.2 Pour utilisation avec Home Assistant
==========================================
5.1.2.1 les interrupeurs virtuels (input_boolean) 
"""""""""""""""""""""""""""""""""""""""""""""""""
ils sont crées sous yaml:

.. code-block::

   input_boolean:
     mes_alarme_abs:
       name: mise en service alarm abs
       icon: mdi:alarm-light
     mes_alarme_nuit:
       name: mise en service alarm nuit
       icon: mdi:gesture-tap-hold
     mes_al_nuit_auto:
       name: mise en service al nuit auto
       icon: mdi:alarm-light
     activation_sirene_al:
       name: activation-sirene
       icon: mdi:music-off
     activation_modect:
       name: activation-modect
       icon: mdi:camera


|image1339|

.... des input_boolean aussi pour:  m/a sirène, m/a mode detect des caméras, activation/désactivation de la sirène, etc.. 

5.1.2.2 les poussoirs (input_button)
""""""""""""""""""""""""""""""""""""
pour le test GSM, test de la sirène,  reset des variables :

exemple pour le test GSM et test sirène:

.. code-block::

   input_button:
     poussoir_test_sirene:
       name: test_sirene
       icon: mdi:bell
     poussoir_gsm:
       name: test_gsm
       icon: mdi:bell

|image1347|

Les automatismes pour ces poussoirs:

.. code-block::

   - id: test_gsm_al
     alias: Test_GSM
     trigger:
     - platform: state
       entity_id: input_button.poussoir_gsm
     action:
     - service: shell_command.set_aldz
       data:
         msg: "test_GSM"
       response_variable: todo_response
     - if: "{{ todo_response['returncode'] == 0 }}"
       then:
         - service: persistent_notification.create
           data:
             title: "Shell_sms"
             message: "{{ todo_response['stdout'] }}"
   #
   - id: test sirene al
     alias: test_sirene
    trigger:
     - platform: state
        entity_id: input_button.poussoir_test_sirene
     action:
     - service: switch.turn_off
       data:
        entity_id: switch.sirene_switch

.. note:: shell_command se trouve dans configuration.yaml

   **pour set_aldz**

   on utilise importlib.reload de python et donc l'écriture d'une variable dans un fichier python et non d'une variable HA , voir ce §  :ref:`5.8.2.1 Version sans l'utilisation d'une variable` 

   Pourquoi est-ci difficile d'exécuter un commande BASH sur Home Assistant ??

   - La simple écriture dans un fichier avec printf ou echo + un data(jina2)  ne fonctionne pas 

   - en lançant un script bash pour le faire : ça fonctionne ??

   Voici donc 2 solutions, l'une en passant un data , l'autre sans passer de data mais un message fixe

   .. code-block::

      shell_command:     
          set_aldz:
      #      "./pyscript/aldz.bash '\"{{ message }}\"' "
             "printf '#!/usr/bin/env python3 -*- coding: utf-8 -*- \nx=\"TEST_GSM\"\npriority=1' >  pyscript/aldz.py"

   |image1349|

   **Pour set_modect**

   .. code-block::

      set_modect:
      "./pycscipt/modect.sh  '\"{{ mode }}\"' "

   |image1358|

   .. warning::

      JQ doit êrtre installé: |image1360| 

      |image1359|

5.1.2.3 les variables (input_select et input_text)
""""""""""""""""""""""""""""""""""""""""""""""""""
utilisées pour mémoriser certaines informations

.. code-block::

   input_select:
     var_alarme:
       name: alarme
       options:
         - 0
         - alarme_nuit
         - alarme_auto
   input_text:
     var_intrusion:
       name: intrusion
       initial: 0
     var_porte_ouverte:
       name: porte_ouverte
       initial: 0
     activation_sir_txt:
       name: statut_sirene
       initial: desactive
     notification_alarme:
       name: statut_alarme
       initial: pas en service

5.1.3 explications concernant MODECT
====================================

.. note::

   A partir de la base de données le fichier des caméras déclarées en mode détection est établit automatiquement; voir ce § :ref:`5.8.3- Affichage de la liste des caméras Modect`

   Depuis la version 3.01 , ce fichier contient les données en JSON ; le script Lua de l'alarme(V3.0.3) doit être modifié en conséquence (voir ci-après § :ref:`5.1.3.2 le script lua pour Domoticz` , les modifications à apporter) 

   |image1354|
   
Si l’alarme absence est activée les caméras autorisées passent en mode MODECT automatiquement.

Dans les autres cas Modect peut être activé manuellement.

|image435|

|image436|

.. warning::

   **Il faut avoir installé Zoneminder ou Frigate**

5.1.3.1 Jeton ZM
""""""""""""""""
Dans fonctions.php :

|image437|

|image438|

*Le format du fichier est json pour une exploitation facile avec Domoticz*

5.1.3.2 le script lua pour Domoticz
"""""""""""""""""""""""""""""""""""

*dans* :darkblue:`alarme_intrusion.lua` , partie du script lua de l'alarme concernant Modect:

   .. code-block::

      -- Alarme absence et nuit maison
	--
	-- alarme--alarme.lua
	-- version 3.0.6
	--
 	json = (loadfile "scripts/lua/JSON.lua")()
      function decode_json(fich_json)
    	local config = assert(io.popen('/usr/bin/curl '..fich_json))
    	local blocjson = config:read('*a')
        config:close()
        local jsonValeur = json:decode(blocjson)
        --print('succes='..jsonValeur.version)
        return jsonValeur
      end
      function modect_cam(mode) -- pour ZONEMINDER
       json_val=decode_json('curl -XPOST -d "user=michel&pass=Idem4546"  http://192.168.1.23/zm/api/host/login.json')
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

      function detect_frigate(t)   -- POUR FRIGATE
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
       
       -- activation de la detection par les cameras
	    if (item.name == 'Modect' and item.state=='Off' and  domoticz.variables('ma-alarme').value=="1") then 
	    devices('Modect').switchOn();
	    end 
        -- activation manuelle Modect
	    if (item.name == 'Modect' and  item.state=='On' and  domoticz.variables('ma-alarme').value=="0") then
	    domoticz.variables('modect').set("modect");modect_cam('Modect')  -- ou detect_frigate(1)
	    -- activation manuelle Monitor 	
	    elseif (item.name == 'Modect' and  item.state=='Off' and  domoticz.variables('ma-alarme').value=="0") then
	    domoticz.variables('modect').set("monitor");modect_cam('Monitor')  --  ou  detect_frigate(2)
          end 

|image439|

|image1628|

5.1.3.3 le script bash pour Home Assistant
""""""""""""""""""""""""""""""""""""""""""
Script Bash concernant le mode détection des caméras: :darkblue:`modect.sh`

.. ATTENTION:: pour ce script JQ doit être installé

.. code-block::

   curl -XPOST -d "user=USER&pass=MOT_PASSE" -s 'http://192.168.1.23/zm/api/host/login.json' | \
    python3 -c "import sys, json; file = open('token.txt', 'w'); file.write(json.load(sys.stdin)['access_token']); file.close()" 
   cle=`cat token.txt`
   mode=$1
   #wget http://192.168.1.9/monitor/admin/string_modect.json
   curl -s http://192.168.1.9/monitor/admin/string_modect.json |  XXX="$(jq  '.[] | .id_zm' string_modect.json)"
   #echo "$XXX"
   for i in $XXX; do 
   #echo "$i";
   curl -XPOST 'http://192.168.1.23/zm/api/monitors/'$i'.json?token='$cle -d "Monitor[Function]="$mode"&Monitor[Enabled]="$i
   done

|image1356|

5.1.3.4 le script Python pour Frigate
"""""""""""""""""""""""""""""""""""""
utilisable avec Domoticz, HomeAssistant ou Monitor

.. code-block::

   #!/usr/bin/env python3.9
   #-*- coding: utf-8 -*-
   import sys
   from connect import ip_mqtt  # adresse broker dans connect.py
   import paho.mqtt.client as mqtt #import the client1
   broker_address=ip_mqtt
   topic = str(sys.argv[1])
   payload = str(sys.argv[2])
   #broker_address="iot.eclipse.org" #use external broker
   client = mqtt.Client("P1") #create new instance
   client.username_pw_set(username='<login>',password='<pass>')
   client.connect(broker_address) #connect to broker
   client.publish(topic,payload) #publish

.. NOTE::

   ce script peut être utilisé directement depuis monitor ou à parir d'une console

5.1.3.5 copies d'écran concernant Modect
""""""""""""""""""""""""""""""""""""""""

Le fichier :darkblue:`string_modect.json` est écrit automatiquement à partir de la BD SQL , il est visible dans « administration »

|image440|

|image05|

*Capture d'écran de ZM* :

|image441|

Le choix des caméras se fait dans la BD :

|image442|

Le choix de l'appli de détection se fait dans admin/config.php

|image1629|

5.2 Construction de l’image
^^^^^^^^^^^^^^^^^^^^^^^^^^^
On ajoute les composants avec Inkscape, les ID pour les changements de couleur, *pas besoin de onclick, il n’y a que des dispositifs virtuels*.

La construction de la page est identique à celle du plan intérieur.

|image443|

|image444|

Les boutons M/A sont réalisés avec 2 cercles de grandeur et de couleur différentes, les poussoirs simples (les mains) sont des icones téléchargées ; 

l’icône png de Domoticz a été convertie en svg.

|image445| |image446| |image447|

On ajoute des zones de textes pour la date, les messages ,...

|image448|

.. code-block::

   <text xml:space="preserve"
   style="font-size:14.8002px;line-height:1.25;font-family:sans-serif;fill:#ffffff;stroke-width:1"
   x="295"
   y="93.74398"
   id="console1"
   transform="scale(1.0550891,0.94778725)"><tspan
     sodipodi:role="line"
     id="tspan1850"
     x="269.5726"
     y="93.74398"
     style="stroke-width:1">txt</tspan></text>

On enregistre l’image dans un fichier PHP, comme indiqué au paragraphe :ref:`2.2 Des exemples d’autres dispositifs`

On peut aussi ajouter les ID en s'aidant de l'outil de dévelopement  (F12 du navigateur)

|image450|

.. admonition:: **Vérifier qu’il n’y a pas de doublon d’ID**

   dans ce cas faire des remplacements : 

   exemple: **remplacer « pathxxxx »** par « pathyyy »

   ou avec Notepad tous les ’’path remplacé par ‘’patha

.. admonition:: **Un extrait concernant le bouton « activation/désactivation de la sirène »**

   |image451|

5.3 Base de données
===================
**Table « dispositifs »**

Après avoir ajouté les ID : enregistrement des dispositifs virtuels dans la base de données ; On ajoute au dispositif dans la colonne pass : « **pwdalarm** » pour limiter l’accès ;(:red:`cette valeur peut être modifiée dans config.php`)

|image452|

|image453|

Comme on peut le voir pour l’alarme absence il a été préféré l’ID du cercle à l’ID choisi avec Inkscape 

|image454|

|image455|

**Il est aussi possible de renommer l’ID du cercle.**

*les variables concernées*

|image456|

5.4- Le PHP
^^^^^^^^^^^
- **alarme.php** :

https://raw.githubusercontent.com/mgrafr/monitor/main/include/alarmes.php

|image457|

- **test_pass.php** : surligné en jaune, pour admin.php, voir le § :ref:`14.2 admin.php, info_admin.php, test_db.php et backup_bd`

|image449|

|image458|

|image459|

|image460|

.. code-block::

   <text xml:space="preserve"
   style="font-size:14.868px;line-height:1.25;font-family:sans-serif;fill:#000000;stroke-width:0.999996;"
   x="80.619217"
   y="282.70932"
   id="text6416"
   transform="scale(1.0628321,0.94088238)"><tspan
     sodipodi:role="line"
     id="not"
     x="80.619217"
     y="282.70932"
     style="stroke-width:0.999996;fill:white;" /></text>

- **Mot de Passe**

*Le fichier config.php gère les mots de passe de l’alarme et de la commande des dispositifs (on/off)*

.. code-block::

   // mot passe alarme et administation , la page administration est ON
   define('PWDALARM','004546');//mot passe alarme
   define('NOM_PASS_AL','pwdalarm');// nom du mot de passe dans la BD
   define('TIME_PASS_AL','3600');// temps de validité du mot de passe


*La fonction mdp() dans fonctions.php* :

.. code-block::

   // --------------MOT de PASSE-----------------------------
   function mdp($mdp,$page_pass){// 1=commandes , 2=alarmes
   //if ($_SESSION["pec"]=="admin"){echo "azerty";$page_pass=3;}
   switch	($page_pass) {
   case "1":
   if ($mdp==PWDCOMMAND) {$mp="OK";$_SESSION['passwordc']=$mdp;}
   else {$mp="entrer le mot de passe";}		
   break;
   case "2":
   if ($mdp==PWDALARM) {$mp="OK";$_SESSION['passworda']=$mdp;$_SESSION['time']=time()+TIME_PASS_AL;}
   else {$mp="pasword non valide";}			
   break;		
   default:
   $mp="erreur";
   }
   $info=['statut' => $mp];
   return $info;}

**Le script qui commande les poussoirs M/A**

|image464|

5.5 Le Javascript, dans footer.php et mes_js.js
^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^
- Les scripts pour les mots de passe, dans js/mes_js.js

|image465|

- Le script pour le clavier affiché dans administration et alarme

|image466|

- Et le HTML pour l'affichage du clavier (dans :green:`alarmes.php`):

.. code-block::

   <div class="modal" role="dialog" id="pwdalarm">


		    <form class="form_al"><span class="close_clavier">x</span>
        <input type="password" style="max-width: 140px;" id="password" /></br>
        <input type="button" value="1" id="1" class="pinButton calc"/>
        <input type="button" value="2" id="2" class="pinButton calc"/>
        <input type="button" value="3" id="3" class="pinButton calc"/><br>
        <input type="button" value="4" id="4" class="pinButton calc"/>
        <input type="button" value="5" id="5" class="pinButton calc"/>
        <input type="button" value="6" id="6" class="pinButton calc"/><br>
        <input type="button" value="7" id="7" class="pinButton calc"/>
        <input type="button" value="8" id="8" class="pinButton calc"/>
        <input type="button" value="9" id="9" class="pinButton calc"/><br>
        <input type="button" value="raz" id="clear" class="pinButton clear"/>
        <input type="button" value="0" id="0 " class="pinButton calc"/>
        <input type="button" value="envoi" id="enter" class="pinButton enter"/>
      </form>
   </div>       

.. warning::

   Sans mot de passe les commandes sont impossibles ; si le temps est dépassé pour l’utilisation du mot de passe, le bouton « Entrer votre mot de passe » apparait lors d’un click. 

|image467|

|image468|

*La fonction maj_services (footer.php) permet la mise à jour des textes « activer ou désactiver »*

- Le script pour afficher une modale « modalink »

|image469|

5.6 -Comme pour les autres pages
^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^
Il ne reste qu’à :

	- Ajouter cette page dans config.php

.. code-block::

   define('ON_ALARM',true);// affichage pour utilisation de l'alarme

- Ce qui ajoutera l’alarme dans le menu 
	 
|image471|

5.7- Affichage d’une icône sur la page d’accueil
^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^

|image472|

Pour l’alarme de nuit, pour ne pas oublier de l’annuler le matin si la fonction auto n’a pas été choisie

- **CSS**

.. code-block::

   #alarme_nuit{position:absolute;top:815px;left: 170px;width: 40px;}

.. code-block::

   /* Large devices (small desktops <535) */
   @media (max-width:534px) {#alarme_nuit{top:580px;}

- **accueil.php** :

.. code-block::

   <div class="aff_al" ><img id="alarme_nuit" src="images/alarme_auto.svg" alt="alarme" /></div>

Dans Domoticz : la variable a déjà été crée, quand l’alarme nuit est activée, son contenu :

|image476|

La table text_images : correspondance entre le texte et l’image

|image477|

|image479|

5.8 Améliorations utiles
^^^^^^^^^^^^^^^^^^^^^^^^
5.8.1- la mise en marche automatiquement de l’alarme de nuit
============================================================
 - à certaines heures 
	
.  On ajoute un bouton avec Inkscape ; pour cela :
.  On charge dans Inkscape le fichier PHP de l’image ; on accepte l’avertissement car ce n’est pas une extension svg.
.  On modifie l’image ; on ajoute un bouton
.  On sauvegarde l’image sous un autre nom, l’extension sera .svg; comme précédemment avec les images, on la copie dans le fichier avec l’extension PHP

|image480|

5.8.1.1 Dans Domoticz
"""""""""""""""""""""
- On ajoute un poussoir virtuel : al_nuit_auto

|image481| |image482|

- On ajout le switch au plan

|image483|

|image484|

- *Les scripts lua notification_timer.lua & notification_devices.lua* :

voir ce § :ref:`1.5.1.2 les scripts de notifications gérées par Domoticz`

**Log** :

|image485|

5.8.1.2 Dans Monitor
""""""""""""""""""""
Pour cela on met à jour la table « dispositifs »

|image486|

|image487|

Comme pour tous les switches la commande a été ajoutée automatiquement sur la page HTML :

|image488|

.. admonition:: **En page d’accueil de monitor**

   |image489|

   - La table text_image :

   |image490|

   - L’image :  L’image :

   |image491|

5.8.2 Alarme par sms GSM
========================
.. warning::

   si un modem GSM installé

5.8.2.1 Version sans l'utilisation d'une variable
"""""""""""""""""""""""""""""""""""""""""""""""""
**Avec un reload d’un module python**

On utilise un module python en import reload et on modifie ce module :

- Avec le serveur domotiqu (DZ ou HA) pour envoyer un message 

- Avec python pour une réinitialisation après l'envoi du message

**Création d’un fichier python** : :darkblue:`aldz.py`, il ne contient qu’une variable avec la valeur « 0 », pour « pas de message » ; il contiendra x= « texte du SMS » en cas l’alarme

.. code-block::

   #!/usr/bin/env python3.7 -*- coing: utf-8 -*-
   x='0'

On fait une copie de ce fichier : :darkblue:`aldz.bak.py` : ce fichier remplacera le fichier original pour remettre à 0 la variable et cesser d’envoyer des messages.

|image500|

**Dans Domoticz**, pas besoin de créer une variable, simplement modifier le fichier aldz.py pour inclure à la variable x, le texte du SMS

|image501|

**Dans Home Assistant**, il en est de même: 2 variantes possibles :

-	avec data: (en utilisant un fichier bash intermédiaire)

-	avec un texte pré-défini

|image1349|

.. warning::

   **Attention** :  comme déjà indiqué, si modem Ebyte, pas d’espaces et accents

Le fichier :darkblue:`sms_dz` est modifié (simplifié) : indiquer le bon port serie et les bons chemins.

|image502|

5.8.2.2 Option supplémentaire : le test de l’envoi de SMS
"""""""""""""""""""""""""""""""""""""""""""""""""""""""""

|image503|

- Dans l’image de l’alarme : on ajoute,

|image504|

- Dans Domoticz : on ajoute un poussoir de sonnette

- Dans Home Assistant : on ajoute un input_button

|image508|  |image1352|

.. admonition:: ** fonctionnement du bouton de sonnette dans Domoticz**

   Le bouton est toujours 'on' , lors d'un appuie la commande  'nvalue=group on' est envoyé à Domoticz qui renvoie un Data=off

   |image1306| 

   |image507|

   On ajoute le dispositif au plan :

   |image509|

   |image510|

   On ajoute qq lignes de script dans évènements dz , :darkblue:`notifications_devices.lua`

   .. code-block::

      return {
	on = {	devices = {'Test_GSM',

   .. code-block::

       if (device.name == 'Test_GSM' ) then print ("test_gsm")
            txt='TestùGSMùOK';alerte_gsm(txt);send_sms(txt)
            obj='Test GSM OK'domoticz.email('Alarme',obj,adresse_mail)    
       end

.. admonition:: ** fonctionnement de l' INPUT_BUTTON dans Home Assistant**

   |image1353|

Dans la BD :

|image512|

*L’exemple est intéressant car le clic s’effectue sur une partie de l’image transparente*

Dans le HTML, Le script est ajouté automatiquement à partir des données de la BD , voir le § :ref:`0.3.2 Les Dispositifs`

|image514|

.. note::

   **Affichage de l’alarme**
   une ellipse rouge est affichée sur l’icône ‘ smartphone’ ; elle reste affichée jusqu’à la prochaine mise à jour : 1 à 2 secondes avec le  serveur SSE-php

|image515|

5.8.3- Affichage de la liste des caméras Modect
===============================================
Cette liste est établie automatiquement avec une fonction dans « administration » , voir le § :ref:`5.1.1.2 le script lua`

.. admonition:: **ajout d'une icône pour afficher la liste depuis l'alarme**

   |image517|

   Dans alarmes.php :

   |image518|

   .. code-block::

      <svg version="1.1" id="zm" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px"
	 viewBox="0 0 326 18" style="width:500px" xml:space="preserve">
      <style type="text/css">
	.st208{fill:#03A8F3;}
	.st207{font-size:13.5px;}
      </style><a id="zm" href="#alarmes">
      <rect x="0.9" y="-0.7" class="st208" width="31.2" height="18.8"/>
      <text transform="matrix(1 0 0 1 5.4312 13.3434)" class="st203 st33 st207">Z M</text></a>
      </svg>

   Dans footer.php , on appelle la fonction php  sql_app() qui est déjà utilisé dans « administration »

   .. code-block::

      $("#zm").click(function () {
          $.ajax({
             url: "ajax.php",
             data: "app=sql&idx=3&variable=cameras&type=modect&command=1",
			 success: function(data) { 
             alert("liste de caméras enregistrées \nen modect dans SQL\n"+data);
            }
        });	});

   |image520|

   Affichage :

   |image521|

5.8.5- Copie écran de la dernière version
=========================================
Version 2.1.0 réécrite en DzVent avec :

- 1 script pour le timer

- 1 script pour les notifications à partir des dispositifs

- 1 script p pour les notifications à partir des variables

- Le script principal de l’alarme

|image522|

5.9- Résumé des dispositifs, des switches virtuels, des variables utilisés
^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^

|image1357|

voir le § :ref:`0.3.2 Les Dispositifs`



.. |image142| image:: ../media/image142.webp
   :width: 650px
.. |image143| image:: ../media/image143.webp
   :width: 500px
.. |image408| image:: ../media/image408.webp
   :width: 650px
.. |image409| image:: ../media/image409.webp
   :width: 427px
.. |image410| image:: ../media/image410.webp
   :width: 450px
.. |image414| image:: ../media/image414.webp
   :width: 626px
.. |image417| image:: ../media/image417.webp
   :width: 533px
.. |image423| image:: ../media/image423.webp
   :width: 333px
.. |image424| image:: ../media/image424.webp
   :width: 594px
.. |image426| image:: ../media/image426.webp
   :width: 543px
.. |image428| image:: ../media/image428.webp
   :width: 602px
.. |image429| image:: ../media/image429.webp
   :width: 700px
.. |image431| image:: ../media/image431.webp
   :width: 700px
.. |image432| image:: ../media/image432.webp
   :width: 520px
.. |image433| image:: ../media/image433.webp
   :width: 597px
.. |image434| image:: ../media/image434.webp
   :width: 690px
.. |image435| image:: ../media/image435.webp
   :width: 521px
.. |image436| image:: ../media/image436.webp
   :width: 452px
.. |image437| image:: ../media/image437.webp
   :width: 700px
.. |image438| image:: ../media/image438.webp
   :width: 644px
.. |image439| image:: ../media/image439.webp
   :width: 661px
.. |image440| image:: ../media/image440.webp
   :width: 443px
.. |image05| image:: ../media/image05.webp
   :width: 515px
.. |image441| image:: ../media/image441.webp
   :width: 595px
.. |image442| image:: ../media/image442.webp
   :width: 265px
.. |image443| image:: ../media/image443.webp
   :width: 601px
.. |image444| image:: ../media/image444.webp
   :width: 535px
.. |image445| image:: ../media/image445.webp
   :width: 148px
.. |image446| image:: ../media/image446.webp
   :width: 101px
.. |image447| image:: ../media/image447.webp
   :width: 81px
.. |image448| image:: ../media/image448.webp
   :width: 507px
.. |image449| image:: ../media/image449.webp
   :width: 700px
.. |image450| image:: ../media/image450.webp
   :width: 571px
.. |image451| image:: ../media/image451.webp
   :width: 602px
.. |image452| image:: ../media/image452.webp
   :width: 700px
.. |image453| image:: ../media/image453.webp
   :width: 700px
.. |image454| image:: ../media/image454.webp
   :width: 554px
.. |image455| image:: ../media/image455.webp
   :width: 700px
.. |image456| image:: ../media/image456.webp
   :width: 595px
.. |image457| image:: ../media/image457.webp
   :width: 557px
.. |image458| image:: ../media/image458.webp
   :width: 601px
.. |image459| image:: ../media/image459.webp
   :width: 661px
.. |image460| image:: ../media/image460.webp
   :width: 338px
.. |image464| image:: ../media/image464.webp
   :width: 601px
.. |image465| image:: ../media/image465.webp
   :width: 596px
.. |image466| image:: ../media/image466.webp
   :width: 440px
.. |image467| image:: ../media/image467.webp
   :width: 337px
.. |image468| image:: ../media/image468.webp
   :width: 535px
.. |image469| image:: ../media/image469.webp
   :width: 569px
.. |image471| image:: ../media/image471.webp
   :width: 108px
.. |image472| image:: ../media/image472.webp
   :width: 379px
.. |image476| image:: ../media/image476.webp
   :width: 617px
.. |image477| image:: ../media/image477.webp
   :width: 601px
.. |image479| image:: ../media/image479.webp
   :width: 535px
.. |image480| image:: ../media/image480.webp
   :width: 650px
.. |image481| image:: ../media/image481.webp
   :width: 200px
.. |image482| image:: ../media/image482.webp
   :width: 400px 
.. |image483| image:: ../media/image483.webp
   :width: 400px 
.. |image484| image:: ../media/image484.webp
   :width: 400px 
.. |image485| image:: ../media/image485.webp
   :width: 700px 
.. |image486| image:: ../media/image486.webp
   :width: 577px 
.. |image487| image:: ../media/image487.webp
   :width: 335px 
.. |image488| image:: ../media/image488.webp
   :width: 700px 
.. |image489| image:: ../media/image489.webp
   :width: 447px 
.. |image490| image:: ../media/image490.webp
   :width: 424px 
.. |image491| image:: ../media/image491.webp
   :width: 70px 
.. |image492| image:: ../media/image492.webp
   :width: 598px 
.. |image493| image:: ../media/image493.webp
   :width: 535px 
.. |image494| image:: ../media/image494.webp
   :width: 632px 
.. |image495| image:: ../media/image495.webp
   :width: 528px 
.. |image496| image:: ../media/image496.webp
   :width: 238px 
.. |image497| image:: ../media/image497.webp
   :width: 602px 
.. |image498| image:: ../media/image498.webp
   :width: 346px 
.. |image500| image:: ../media/image500.webp
   :width: 311px 
.. |image501| image:: ../media/image501.webp
   :width: 575px 
.. |image502| image:: ../media/image502.webp
   :width: 570px 
.. |image503| image:: ../media/image503.webp
   :width: 472px 
.. |image504| image:: ../media/image504.webp
   :width: 700px 
.. |image507| image:: ../media/image507.webp
   :width: 650px 
.. |image508| image:: ../media/image508.webp
   :width: 380px 
.. |image509| image:: ../media/image509.webp
   :width: 544px 
.. |image510| image:: ../media/image510.webp
   :width: 450px 
.. |image512| image:: ../media/image512.webp
   :width: 612px 
.. |image514| image:: ../media/image514.webp
   :width: 700px 
.. |image515| image:: ../media/image515.webp
   :width: 461px 
.. |image517| image:: ../media/image517.webp
   :width: 408px 
.. |image518| image:: ../media/image518.webp
   :width: 700px 
.. |image520| image:: ../media/image520.webp
   :width: 578px 
.. |image521| image:: ../media/image521.webp
   :width: 457px 
.. |image522| image:: ../media/image522.webp
   :width: 705px 
.. |image1306| image:: ../img/image1306.webp
   :width: 700px 
.. |image1339| image:: ../img/image1339.webp
   :width: 290px 
.. |image1340| image:: ../img/image1340.webp
   :width: 598px 
.. |image1341| image:: ../img/image1341.webp
   :width: 357px 
.. |image1342| image:: ../img/image1342.webp
   :width: 509px 
.. |image1343| image:: ../img/image1343.webp
   :width: 262px 
.. |image1344| image:: ../img/image1344.webp
   :width: 300px 
.. |image1345| image:: ../img/image1345.webp
   :width: 273px 
.. |image1346| image:: ../img/image1346.webp
   :width: 296px 
.. |image1347| image:: ../img/image1347.webp
   :width: 600px 
.. |image1349| image:: ../img/image1349.webp
   :width: 700px 
.. |image1352| image:: ../img/image1352.webp
   :width: 310px 
.. |image1353| image:: ../img/image1353.webp
   :width: 700px 
.. |image1354| image:: ../img/image1354.webp
   :width: 650px 
.. |image1356| image:: ../img/image1356.webp
   :width: 700px 
.. |image1357| image:: ../img/image1357.webp
   :width: 622px 
.. |image1358| image:: ../img/image1358.webp
   :width: 430px 
.. |image1359| image:: ../img/image1359.webp
   :width: 650px 
.. |image1360| image:: ../img/image1360.webp
   :width: 200px 
.. |image1370| image:: ../img/image1370.webp
   :width: 495px 
.. |image1371| image:: ../img/image1371.webp
   :width: 642px
.. |image1628| image:: ../img/image1628.webp
   :width: 700px
.. |image1629| image:: ../img/image1629.webp
   :width: 700px
