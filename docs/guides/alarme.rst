5. L’ALARME
-----------
Pour l’activation ou l’arrêt par GSM voire ce paragraphe qui traite du script python avec les codes retenus pour l’alarme. :ref:`18.4 Commandes de l’alarme à partir d’un GSM`

|image408|

*Pour entrer le mot de passe : redirection vers la page administration* 

Le script LUA dans Evènements de Domoticz : https://raw.githubusercontent.com/mgrafr/monitor/main/scripts_dz/lua/alarme_intrusion.lua

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

.. info::
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

-	**alarme* : est utilisée pour un affichage sur la page d’accueil ; 

-	**activation-sir-txt**, texte activation de la sirène : activer ou désactiver

- **Notifications** : notifications_devices.lua, notifications_timer.lua 

|image423|

https://raw.githubusercontent.com/mgrafr/monitor/main/scripts_dz/lua/notification_devices.lua

|image424|

.. warning::

   **ATTENTION** :
   L’utilisation du modem 4G Ebyte n’autorise pas, pour les textes, les accents et les espaces, utiliser des Under scores(ou autre signe) pour séparer les mots

Script :darkblue:`notifications_variables.lua`, lignes concernées 

.. code-block:: 'fr'

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

Script :darkblue:`notifications_timer.lua`, lignes concernées

voir ce paragraphe : :ref:`le script LUA pour les notifications concernant le temps: ‘notification-timer.lua>`_

|image426|

.. note::

   L’utilisation de :red:`timer= at hh :mm-hh` :mm ne peut être utilisé ; 

   j’ai essayé isTimer mais ça ne fonctionne que pour ON ; else avec isTimer ne fonctionne pas.

.. admonition:: **des explications concrnant le script alarme_intrusion.lua** 

   |image428|

   |image429|

   **Pour activer ou désactiver la sirène** :

      Pour les textes : notifications_devices.lua
   .. code-block:: 'fr'

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

**Le fichier pushover.sh** :

 .. code-block:: 'fr'

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

.. code-block:: 'fr'

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

.. warning

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

.. code-block:: 'fr'

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

   exemple: **remplacer « pathxxxx »** 

   ou avec Notepad tous les ’’path remplacé par ‘’patha

.. admonition:: **Un extrait concernant le bouton « activation/désactivation de la sirène »**

   |image450|

5.3 Base de données
===================

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
   :width: 379px
.. |image424| image:: ../media/image424.webp
   :width: 379px
.. |image426| image:: ../media/image426.webp
   :width: 633px
.. |image428| image:: ../media/image428.webp
   :width: 602px
.. |image429| image:: ../media/image429.webp
   :width: 602px
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
.. |image450| image:: ../media/image450.webp
   :width: 571px
