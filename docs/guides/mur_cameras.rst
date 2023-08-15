7. MUR de CAMERAS
-----------------
.. warning::

   Zoneminder doit être installé

Pour éviter des problèmes de capacité mémoire, vider le cache périodiquement avec CRON : 

**crontab -e** |image555|

*Avec nano ou vim* :

.. code-block:: 

   0 12 * *  * sync; echo 3 > /proc/sys/vm/drop_caches

|image556|

Ici la mémoire sera libérée des données cache et tampon tous les jours à 12H ; 

**plus d’ infos** : https://www.tomzone.fr/vider-la-memoire-cache-dun-serveur-linux/#:~:text=Par%20exemple%20pour%20vider%20tous%20les%20jours%20%C3%A0,%2A%20%2A%20%2A%20sync%3B%20echo%203%20%3E%20%2Fproc%2Fsys%2Fvm%2Fdrop_caches

|image557|

.. warning:: 

   Il est important d’ajouter les caméras dans Zoneminder les unes après les autres sans en supprimer afin que ces cameras suivent un ordre chronologique (1,2,3,4,5, 6, ...)
   
   Voir la page : http://domo-site.fr/accueil/dossiers/44

   |image558|

7.1- les pages index_loc.php, header.php, entete_html.php
^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^

- **Index_loc.php** , en général, ne pas modifier 

.. code-block:: 

   if (ON_MUR==true) {include ("include/mur_cam.php");$_SESSION["zmuser"]=ZMUSER;

- **config.php**

.. code-block:: 

   // utilisation du mur :true sinon false , Nom du mur , nb caméras
   define('ON_MUR',true);// mise en service MUR
   define('NOMMUR','');// nom du mur
   define('NBCAM','0');// nombre caméras
   // Zoneminder
   define('ZMURL','http://192.168.1.23/zm');//IP/zm
   define('ZMURLTLS','https:zoneminder.DOMAINE.ovh');// sous domaine
   define('ZMUSER','michel');// pour mur_cameras.php
   define('ZMPASS','MOT_PASSE');// pour mur_cameras.php
   define('TIMEAPI','3400');//suivant la valeur indiquée dans zoneminder

- **header.php** , il n'y a rien à modifier

 |image561|

- **entete_html.php** , pour le switch ajouter cette ligne

.. code-block:: 

   <link href="bootstrap/bootstrap-switch-button.css" rel="stylesheet">

7.2- la page de monitor : mur_cam.php
^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^




.. |image555| image:: ../media/image555.webp
   :width: 332px
.. |image556| image:: ../media/image556.webp
   :width: 700px
.. |image557| image:: ../media/image557.webp
   :width: 536px
.. |image558| image:: ../media/image558.webp
   :width: 601px
.. |image561| image:: ../media/image561.webp
   :width: 570px
