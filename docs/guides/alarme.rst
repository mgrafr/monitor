5. L’ALARME
-----------
Pour l’activation ou l’arrêt par GSM voire ce paragraphe qui traite du script python avec les codes retenus pour l’alarme. :ref:`18.4 Commandes de l’alarme à partir d’un GSM`

|image408|

*Pour entrer le mot de passe : redirection vers la page administration* 

Le script LUA dans Evènements de Domoticz : https://raw.githubusercontent.com/mgrafr/monitor/main/scripts_dz/lua/alarme_v3.lua

5.1 Dans Domoticz, les interrupteurs virtuels, les variables
^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^
**les interrupteurs virtuels**

Les boutons poussoir marche/arrêt pour les commandes :

- m/a alarme de nuit

- m/a alarme absence

- m/a al_nuit_auto

- m/a sirène

- m/a mode detect des caméras

- poussoir de reset des valeurs de Domoticz,

- activation/désactivation de la sirène : permet de faire des essais sans nuisances sonores ; la sirène est toutefois indiquée ON ou OFF

**Option** : allumages de lampes :

Dans ce tuto : lampe_salon (lampe commandée par le 433MHz avec une interface Sonoff modifié, voir le site domo-site.fr

|image409|

Pour le test sirène : un interrupteur « PUSH »

|image410|

On ajoute les dispositifs au plan ; 

.. note::
   le plan peut se résumer à un simple cadre ou être très simplifié, il ne sert qu’à regrouper les dispositifs pour récupérer les données avec un seul appel à l’API json

|image414|

|image417|

**Les variables, initialisée** à 0

-	**ma-alarme** :

|image418|

o	0  =  alarme non activée,

o	1  = alarme absence activée, les capteurs PIR sont pris en compte

o	2  = alarme nuit activée, les capteurs PIR sont ignorés

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

Partie du script concernant  :darkblue:`les variables`,

.. code-block::

   --*********************variables***************************************	
	-- alarme absence - 
        if (domoticz.variables('ma-alarme').value == "1") then 
            for k, v in ipairs(A1) do 
                if (device.name == (A1[k][1]) and device.state == A1[k][2] ) then 
        	        domoticz.variables(A1[k][3]).set(A1[k][4]);
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
            if (sirene==1) then devices('ma_sirene').switchOn();sirene="2"
            end 
            if (sirene==2 and domoticz.device('activation-sirene').state == 'On') then  devices('sirene_switch').switchOn();sirene="3"
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

Voir les pages web :

- http://domo-site.fr/accueil/dossiers/10 

- Et http://domo-site.fr/accueil/dossiers/8

.. admonition:: **Résumé des scripts Domoticz concernés**

   |image434|

5.1.1 explications concernant MODECT
====================================
Si l’alarme absence est activée les caméras autorisées passent en mode MODECT automatiquement.

Dans les autres cas Modect peut être activé manuellement.

|image435|

|image436|

.. ATTENTION::

   La demande du jeton n'est pas automatique à partir du bouton :green:`Modect`; :darkblue:`IL FAUT APPUYER SUR LE BOUTON ZM`:

.. warning::

   **Il faut avoir installé Zoneminder**

5.1.1.1 Jeton ZM
""""""""""""""""
Dans fonctions.php :

|image437|

|image438|

*Le format du fichier est json pour une exploitation facile avec Domoticz*

5.1.1.2 le script lua
"""""""""""""""""""""

*dans :darkblue:`alarme_intrusion.lua`*

|image439|

Le fichier :darkblue:`string_modect` est écrit automatiquement à partir de Zoneminder, il est visible dans « administration »

|image440|

|image05|

*Capture d'écran de ZM* :

|image441|

Le choix des caméras se fait dans la BD :

|image442|

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

- Et le script pour le clavier affiché dans administration

|image466|

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

5.8.2.1 Version sans l'utilisation d'une variable Domoticz
""""""""""""""""""""""""""""""""""""""""""""""""""""""""""
**Avec un reload d’un module python**

On utilise un module python en import reload et on modifie ce module :

- Avec Domoticz pour envoyer un message 

- Avec python pour une réinitialisation après l'envoi du message

**Création d’un fichier python** : :darkblue:`aldz.py:darkblue:`, il ne contient qu’une variable avec la valeur « 0 », pour « pas de message » ; il contiendra x= « texte du SMS » en cas l’alarme

.. code-block::

   #!/usr/bin/env python3.7 -*- coing: utf-8 -*-
   x='0'

On fait une copie de ce fichier : :darkblue:`aldz.bak.py` : ce fichier remplacera le fichier original pour remettre à 0 la variable et cesser d’envoyer des messages.

|image500|

**Dans Domoticz**, pas besoin de créer une variable, simplement modifier le fichier aldz.py pour inclure à la variable x, le texte du SMS

|image501|

.. warning::

   **Attention** :  comme déjà indiqué, si modem Ebyte, pas d’espaces et accents

Le fichier :darkblue:`sms_dz` est modifié (simplifié) :

|image502|

5.8.2.2 Option supplémentaire : le test de l’envoi de SMS
"""""""""""""""""""""""""""""""""""""""""""""""""""""""""

|image503|

- Dans l’image de l’alarme : on ajoute,

|image504|

- Dans Domoticz : on ajoute un poussoir de sonnette

|image508|

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
.. |image418| image:: ../media/image418.webp
   :width: 434px
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
.. |image507| image:: ../media/image504.webp
   :width: 650px 
.. |image508| image:: ../media/image508.webp
   :width: 402px 
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




