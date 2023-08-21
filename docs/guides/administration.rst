14.  ADMINISTRATION
-------------------

|image788|

14.1 fichiers communs à toutes les pages
^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^
- **css**

voir le § :ref:`1.2.2.1 styles CSS communs à toutes les pages`

- **Index_loc.php**  *chargement de la page impératif*

.. code-block::

   // administration
   include ("include/admin.php");

- **header.php**  *Affichage obligatoire dans le menu*

.. code-block::

   <li class="zz"><a href="#admin">Administration</a></li>

- **ajax.php**

.. code-block::

   if ($app=="admin") {admin($variable,$command);}	//$command=fenetre(administration footer

- **config.php** *emplacement du fichier* 

.. code-block::

   define('MONCONFIG', 'admin/config.php');//fichier config 

- **fonctions.php**    *admin()*

Extrait de la fonction:

|image794|

14.2 admin.php, info_admin.php, test_db.php et backup_bd
^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^

|image795|

|image796|

|image797|

- **admin.php**

|image798|

- **info_admin.php**

|image799|

- **test_db.php**

.. code-block::

   <?php
   echo '<textarea id="adm1" style="height:'.$height.'px;" name="command" >';
   echo "test....BD: ";
   // Create connection
   $con = new mysqli(SERVEUR, UTILISATEUR, MOTDEPASSE);
   // Check connection
   if ($con->connect_error) {   die("Pas de connexion au serveur: " . $con->connect_error);$_SESSION["exeption_db"]="pas de connexion à la BD";}
   else echo " connection au serveur OK , ..";
   $conn = new mysqli(SERVEUR, UTILISATEUR, MOTDEPASSE, DBASE);
   if ($conn->connect_error) { die("Verifier le nom de la BD: " . $conn->connect_error);$_SESSION["exeption_db"]="pas de connexion à la BD";}
   echo " connection à la BD OK , ..";$_SESSION["exeption_db"]="";
   echo "connexion terminée , ..";
   ?>
   </textarea>

- **backup_db.php** , *Pour la sauvegarde de la BD*

|image801|

|image802|

14.3 le javascript
^^^^^^^^^^^^^^^^^^
*Pour la fonction mdp() et le clavier(Minimal Virtual Keypad), voir le §  :ref:`5.5 Le Javascript, dans footer.php et mes_js.js`

- **appel de admin()**  *de fonctions.php*

|image804|

- **info_admin()**

.. code-block::

   $('.info_admin').click(function(){
   var rel=$(this).attr('rel');$('#affich_content_info').empty;var info_admin="";
   affich_info_admin(rel);
   });	
   function affich_info_admin(rel){	
   console.log(rel);
   <?php echo "var info_admin = ". $js_info_admin . ";\n";?>
   document.getElementById("affich_content_info").innerHTML = info_admin[rel];
   }

14.4 fonctions PHP
^^^^^^^^^^^^^^^^^^
- **admin()**

|image805|

|image806|

|image807|

|image808|

14.5 Téléchargement d’un fichier externe dans Domoticz
^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^
*Pour la mise à jour des fichiers "connect.lua, connect.py, connect.js, etc..." (variables pour les scripts Domoticz)* 

.. note::

   Plusieurs solutions étaient possibles mais avec l’installations de scripts et de modules supplémentaires.

   En http, on ne peut seulement télécharger un fichier depuis un site distant.
   
   La solution retenue :

      -	Avec l’API de Domoticz il est possible de mettre à jour des variables ; àprès la lecture distante et la  mise à jour d’un fichier de Domoticz, on enregistre le résultat dans un fichier temporaire et on met à 1 une variable (nommée ici "upload") dans Domoticz pour l’exécution d’un script qui va télécharger ce fichier temporaire ; la variable est mise à 0 jusqu’à une prochaine modification du fichier.

   |image811|

   .. code-block::

      maj_variable("22","upload","1","2")
   
   Pour la mise à jour de la liste des caméras dont la détection est activée, c’est le même script qui est utilisé, la variable « upload » est alors passé à 2 :

   |image812|

- **Les fonctions JS wajax() et yajax()** ,  *dans mes_js.js*

 |image813|

- **Les fichiers temporaires**,  *dans monitor pour Domoticz*

 |image814|

14.6 Copies d’écran et explications
^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^

|image815|

|image816|

|image817|

|image818|

|image819|

|image820|

14.6.1 Fichier connect.xxx (mots de passe et login en base64 ,ips réseau
=======================================================================
*pour utiliser ces données dans des scripts (lua, python, js ou autres)*

|image821|

14.6.1.1 connect.lua
""""""""""""""""""""

|image822|

.. important:: **L’ip de monitor dans ce fichier permet, en cas de changement de l’IP de ne pas avoir à modifier les scripts. C’est également valable pour tous les serveurs.**

14.6.1.2 connect.py
"""""""""""""""""""
*Un double de connect.lua est enregistré au format python pour les script écrit dans ce langage*

|image823|

.. important::

   Ce double peut aussi servir à un autre serveur (un PI par exemple) ce qui facilite les mises à jour.

   Une commande dans administration permet une mise à jour automatique du RPI; pour cela le fichier admin/config.php doit posséder l’IP du serveur :

   .. code-block:: 

      define('IPRPI', '192.168.1.8');//IP du Raspberry

   |image825|

- **admin.php**

 |image826|

- **admin()**  *fonctions.php*

|image827|

|image828|

|image829|

|image830|

.. warning:: **Cette commande utilise SSH2 et SCP** , voir le § :ref:`14.10  Commandes ssh2 PC distant`

14.6.1.3 connect.js
"""""""""""""""""""
*pour node-red*

|image831|

14.7 Explications concernant l’importation distantes d’un tableau LUA
^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^
*Compléments sur les fichiers de variables LUA*

Concerne :

. le tableau de variable string_tableau.lua

. la liste des caméras Modect pour l’alarme

. le fichier des Logins/mots de passe

- **string_tableau.lua**   *exemple*

|image832|

.. code-block::

   -- liste de variables
   -- string
   jour_poubelle_grise="Wednesday"
   jour_poubelle_jaune="Sunday"
   semaine_poub_jaune= 0  -- 0 pour pair 1 pour impair
   -- table anniversaires
   anniversaires = {["27-08"]="Damien",["18-05"]="Yoann",["14-09"]="Jonathan",["19-07"]="Alexandra",["25-08"]="Charlotte",["01-05"]="Guillaume",["07-11"]="Corentin",["22-08"]="Pauline",["14-03"]="Clémence",["31-10"]="Eric",["01-02"]="Nathalie",["14-04"]="Christèle",["25-04"]="Katy",["23-05"]="Eveline",["23-08"]="Jean Paul",["24-07"]="Arthur",["09-07"]="Jade",["27-03"]="Judith",["06-03"]="Annie",["02-11"]="Nicole",["22-12"]="Michel"};

_ **Dans admin/config.php de monitor**

.. code-block::

   define('VARTAB', URLDOMOTIC.'modules_lua/string_tableaux.lua');

  . Création d'un fichier temporaire dans monitor, le répertoire « dz » est à créer avec les autorisations pour écrire

.. code-block::

   define('DZCONFIG', 'admin/dz/temp.lua');//fichier temp

|image835|

|image836|

- **Dans fonctions.php** : *function admin()*

         |image837|

      .. code-block::

         case "3" :
         echo $file.'<div id="result"><form >';
           $content = file_get_contents($file);
	        if($choix==3){ file_put_contents(DZCONFIG.'.bak.'.$time, $content);}	          

- **upload et Maj par dz** :*on met à 1,2 ou 3  la variable,  dz se charge d’importer le fichier*

|image839|

Le script lua utilisé :

.. code-block:: 

   package.path = package.path..";www/modules_lua/?.lua"
   require 'string_tableaux'
   require 'connect'

|image842|

14.10  Commandes ssh2 PC distant
^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^
*ici un RPI depuis monitor*

.. admonition:: **SSH, ou Secure Shell**
*un protocole utilisé pour se connecter en toute sécurité à des systèmes distants*.

   .. note::

      Mon RAID1 étant alimenté en 230 Volts, le PI étant alimenté sur batterie, lors d’une coupure secteur, lors de la remise sous tension, le raid1 n’est pas reconnu ; Absent de la maison il faut donc faire un reboot du PI ou un « mount -a «  en bash d’où la commande ci-dessous.

      Autre application: mise à jour de la configuration pour l’envoi de notifications par mails lors d’un changement de mot de passe par exemple.

   Pour cela on utilise le paquet php8.2-ssh2

   .. code-block:: 

      sudo apt install php8.2-ssh2

14.10.1 reboot PC
=================
*ou RPI*


.. |image788| image:: ../media/image788.webp
   :width: 605px 
.. |image794| image:: ../media/image794.webp
   :width: 630px 
.. |image795| image:: ../media/image795.webp
   :width: 464px 
.. |image796| image:: ../media/image796.webp
   :width: 406px 
.. |image797| image:: ../media/image797.webp
   :width: 419px 
.. |image798| image:: ../media/image798.webp
   :width: 700px 
.. |image799| image:: ../media/image799.webp
   :width: 700px 
.. |image801| image:: ../media/image801.webp
   :width: 700px 
.. |image802| image:: ../media/image802.webp
   :width: 324px 
.. |image804| image:: ../media/image804.webp
   :width: 664px 
.. |image805| image:: ../media/image805.webp
   :width: 700px 
.. |image806| image:: ../media/image806.webp
   :width: 605px 
.. |image807| image:: ../media/image807.webp
   :width: 650px 
.. |image808| image:: ../media/image808.webp
   :width: 635px 
.. |image811| image:: ../media/image811.webp
   :width: 650px 
.. |image812| image:: ../media/image812.webp
   :width: 700px 
.. |image813| image:: ../media/image813.webp
   :width: 618px 
.. |image814| image:: ../media/image814.webp
   :width: 319px 
.. |image815| image:: ../media/image815.webp
   :width: 379px 
.. |image816| image:: ../media/image816.webp
   :width: 536px 
.. |image817| image:: ../media/image817.webp
   :width: 532px 
.. |image818| image:: ../media/image818.webp
   :width: 526px 
.. |image819| image:: ../media/image819.webp
   :width: 461px 
.. |image820| image:: ../media/image820.webp
   :width: 477px 
.. |image821| image:: ../media/image821.webp
   :width: 508px 
.. |image822| image:: ../media/image822.webp
   :width: 485px 
.. |image823| image:: ../media/image823.webp
   :width: 595px 
.. |image825| image:: ../media/image825.webp
   :width: 427px 
.. |image826| image:: ../media/image826.webp
   :width: 700px 
.. |image827| image:: ../media/image827.webp
   :width: 604px 
.. |image828| image:: ../media/image828.webp
   :width: 650px 
.. |image829| image:: ../media/image829.webp
   :width: 700px 
.. |image830| image:: ../media/image830.webp
   :width: 403px
.. |image831| image:: ../media/image831.webp
   :width: 324px
.. |image832| image:: ../media/image832.webp
   :width: 374px
.. |image835| image:: ../media/image835.webp
   :width: 324px
.. |image836| image:: ../media/image836.webp
   :width: 488px
.. |image837| image:: ../media/image837.webp
   :width: 629px
.. |image839| image:: ../media/image839.webp
   :width: 613px
.. |image842| image:: ../media/image842.webp
   :width: 605px




