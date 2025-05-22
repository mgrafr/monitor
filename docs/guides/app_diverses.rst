12. - Autres Pages  Nagios, SQL, Vis2
-------------------------------------
12.1 Ajout d'une page Vis2 de IoBroker
^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^
|image1710| 

12.2 Ajout d'une page avec diverses App
^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^
Les scripts pour afficher des données sur d’autres pages peuvent être sur ce modèle, avec l’utilisation de modalink pour afficher ces données : https://github.com/dmhendricks/jquery-modallink

|image679| 

|image680| 

.. note:: 

   **Les fichiers header.php, config.php, les styles css, etc**

   voir les pages précédentes :

   - :ref:`7.1- les pages index_loc.php, header.php, entete_html.php`

   - :ref:`8.1 les fichiers de base`

- **Le fichier app_diverses.php**

.. code-block::

   <?php
   session_start();
   $domaine=$_SESSION["domaine"];
   if ($domaine==URLMONITOR) $lien_img="";
   if ($domaine==IPMONITOR) $lien_img="/monitor";
   ?><!-- section App diverses start -->
		<div id="app_diverses" class="app_div">
			<div class="container">
		<div class="col-md-12">
	   <h1 class="title_ext text-center">App<span>  diverses</span></h1><br>
	   <img src="<?php echo $lien_img;?>/images/dz.webp" style="width:50px;height:auto;margin:10px 0 10px 120px" alt="dz">
		<form2>
		<p class="txt_app"><input type="button" rel="1" style="margin-left: 60px;" class="btn_appd" value="afficher fichier log normal"></p>	
		<p class="txt_app"><input type="button" rel="2" style="margin-left: 60px;" class="btn_appd" value="afficher fichier log statut"></p>
		<p class="txt_app"><input type="button" rel="4" style="margin-left: 60px;" class="btn_appd" value="afficher fichier log erreur"></p>
		<img src="<?php echo $lien_img;?>/images/nagios.webp" style="width:100px;height:auto;margin:10px 0 10px 100px" alt="dz">
		<p class="txt_app"><input type="button" rel="hostlist" style="margin-left: 60px;" class="btn_appd" value="afficher hosts Nagios"></p>
		<img src="<?php echo $lien_img;?>/images/serveur-sql.svg" style="width:40px;height:auto;margin:0 0 10px 118px" alt="dz">
		<p class="txt_app"><input type="button" rel="sql" title="date_poub" style="margin-left: 60px;" class="btn_appd" value="afficher historique poubelles"></p>
		</form>   </div></div></div>

|image682|

- **footer.php**

|image683|

- **Fonctions.php**, *les fonctions log_dz()  et app_nagios()*

|image684|

|image685|

|image686|

12.3 Ajout de donnée MySQL
^^^^^^^^^^^^^^^^^^^^^^^^^^
12.3.1 Edition de l’historique du ramassage des poubelles
=========================================================

|image687|

.. admonition:: **ne nombre d'enregistrements affichés doit être défini dans admin/config.php**

   .. code-block::

      define('ON_APP',true);// mise en service page app diverses
      define('APP_NB_ENR',30); //nb d'enregistrements affichés , concene poubelles

|image688|

- **Le fichier app_diverses.php**

   Une icône est téléchargée ou celle du fichier image (celle-ci-dessus) est utilisée

|image689|

.. code-block::

   <img src="<?php echo $lien_img;?>/images/serveur-sql.svg" style="width:40px;height:auto;margin:0 0 10px 118px" alt="dz">
   <p class="txt_app"><input type="button" rel="sql1" style="margin-left: 60px;" class="btn_appd" value="afficher historique poubelles"></p>

- **La fonction php : sql_app()**  déjà vu au §  :ref:`1.6.1- exemple avec la date de ramassage des poubelles`

- **footer.php** 

   |image691|

Ligne de code concernée:

.. code-block::

   else if (logapp=="hostlist"){urllog="ajax.php?app=infos_nagios&variable="+logapp;titre="Hosts Nagios";}
   else if (logapp=="sql"){var table_sql = $(this).attr('title');
	urllog="ajax.php?app=sql&idx=1&variable="+table_sql+"&type=&command=";titre="historique poubelles";}
   else {urllog="erreur";}

12.3.2 Ajout d’une icône à l’historique des poubelles
=====================================================

- **Dans la BD** : une colonne est réservée pour l’icône

   . dans la table "date_poub"

   . dans la table "text_image

|image692|

- **footer.php** *maj_services() et $(#poubelles)*

|image694|

|image695|

- **fonctions.php**  *status_variables()* 

pour que maj_services (footer.php) récupère le chemin de l’icône la fonction sql_app doit envoyer la donnée

|image696|

Pour la restitution de l’historique :

|image697|

- **Affichage dans monitor**

|image698|





.. |image679| image:: ../media/image679.webp
   :width: 639px
.. |image680| image:: ../media/image680.webp
   :width: 533px
.. |image682| image:: ../media/image682.webp
   :width: 535px
.. |image683| image:: ../media/image683.webp
   :width: 567px
.. |image684| image:: ../media/image684.webp
   :width: 650px
.. |image685| image:: ../media/image685.webp
   :width: 585px
.. |image686| image:: ../media/image686.webp
   :width: 532px
.. |image687| image:: ../media/image687.webp
   :width: 411px
.. |image688| image:: ../media/image688.webp
   :width: 465px
.. |image689| image:: ../media/image689.webp
   :width: 601px
.. |image691| image:: ../media/image691.webp
   :width: 700px
.. |image692| image:: ../media/image692.webp
   :width: 500px
.. |image694| image:: ../media/image694.webp
   :width: 700px
.. |image695| image:: ../media/image695.webp
   :width: 650px
.. |image696| image:: ../media/image696.webp
   :width: 537px
.. |image697| image:: ../media/image697.webp
   :width: 649px
.. |image698| image:: ../media/image698.webp
   :width: 439px
.. |image1710| image:: ../media/image1710.webp
   :width: 700px




