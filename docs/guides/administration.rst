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

14.6 Copies d’écran
^^^^^^^^^^^^^^^^^^^

|image815|

|image816|

|image817|

|image818|

|image819|

|image820|

14.6.1 Fichier connect.xxx (mots de passe et login en base64 ,ips réseau
=======================================================================
*pour utiliser ces données dans des scripts (python ou autres)*

|image821|

- **connect.lua**

|image822|

.. important:: **L’ip de monitor dans ce fichier permet, en cas de changement de l’IP de ne pas avoir à modifier les scripts. C’est également valable pour tous les serveurs.**

- **connect.py**

Un double de connect.lua est enregistré au format python pour les script écrit dans ce langage

|image823|

14.7 Explications concernant l’importation distantes d’un tableau LUA
^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^

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
