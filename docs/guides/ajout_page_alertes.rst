16. Ajouter des pages ou des alertes
------------------------------------
*non incluses dans le programme*

16.1 Ajouter un plan (ex : 1er étage)
^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^
- **créer la page** avec le plan, voir le § :ref:`2. Une 1ere PAGE : LE PLAN INTERIEUR`
	
- **Ajouter la page à index_loc.php**

|image901|

**Ajouter la page au menu dans header.php** 

|image902|

16.2 Ajouter une page vierge
^^^^^^^^^^^^^^^^^^^^^^^^^^^^
*affichage d’un sous domaine distant*

.. code-block::

   <?php
   session_start();
   $domaine=$_SESSION["domaine"];
   if ($domaine==URLMONITOR) $lien_ID_MENU=NOM SOUS DOMAINE dans config.php;
   if ($domaine==IPMONITOR) $lien_ID MENU= NOM  IP dans config.php;;
   ?>
   <!-- section TITRE start -->
   <!-- ================ -->
   <div id="ID du MENU" >
	<div class="container">
		<div class="col-md-12">
	  <h1 id="about" class="title" style="position:relative;top:-30px;">TITRE1 : <span style="color:blue">TITRE2</span></h1>
		         <iframe id="ID de l’IFRAME" src="<?php echo $lien_IDMENU;?>" frameborder="0" ></iframe>
		</div>
	   </div>
		   </div> 		
   <!-- section TITRE fin-->

|image903|

16.3 Ajouter une alerte, une alarme, ...
^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^
16.3.1 Exemple avec un rappel pour la prise de médicaments sur la page d’accueil
================================================================================




.. |image901| image:: ../media/image901.webp
   :width: 534px
.. |image902| image:: ../media/image902.webp
   :width: 700px
.. |image903| image:: ../media/image903.webp
   :width: 700px


