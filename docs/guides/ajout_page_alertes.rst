16. Ajouter des pages ou des alertes
------------------------------------
*non incluses dans le programme*

16.1 Ajouter un plan (ex : 1er étage)
^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^
- **créer la page** avec le plan, voir le § :ref:`2. Une 1ere PAGE : LE PLAN INTERIEUR`
	
- **Ajouter la page à index_loc.php**

|image901|

- **Ajouter la page au menu dans header.php** 

|image902|

- **Ajouter l'ID et les classes**  *si ellesexistent au fichier mes_css.css

ci-dessous les ID's des pages existantes

.. code-block::

   #interieur, #exterieur, #meteo, #alarmes,#commandes,#murcam ,#murinter,#app_diverses,#graphiques,#admin, #zigbee, #zwave, #dvr, #nagios,#spa,#recettes{


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
- *Télécharger une icones ou image svg*

|image904|

- **Dans Domoticz** : *Créer la variable*

|image905|

*Dans le script notifications_timer* :

.. code-block::

   --médicaments
   elseif (time=='20:00' and domoticz.variables('pilule_tension').value == '0') then
        domoticz.variables('pilule_tension').set('pilule_michel')
   end

*Dans le script notifications_variables (pour une alerte sms)*

.. code-block::

   return {
	on = {
		variables = { 'pilule_tension'	}
	},
	execute = function(domoticz, variable)
	    --domoticz.log('Variable ' .. variable.name .. ' was changed', domoticz.LOG_INFO)
	    if (domoticz.variables('pilule_tension').changed) then 
                 if (domoticz.variables('pilule_tension').value ~= "0") then 
	             txt=tostring(domoticz.variables('pilule_tension').value) 
	             print('médicaments')
                 alerte_gsm('alerteù'..txt)
                 end
            end

*Dans la base de données SQL* :

La table "dispositifs"

|image908|

La table "text_image" :

|image909|

- **Dans monitor** :  *Accueil.php*

.. code-block::

   <div class="confirm pilule"><a href="#" id="annul_pilule" rel="30" title="Annulation de l'\alerte pilule michel"><img id="pilule" src=""/></a></div>

*Les styles css* :

.. code-block::

   .pilule{position: relative;top: -300px;width: 50px;left: 220px;}

*Les scripts dans footer.php* :

|image912|

*Affichage sur la page d'accueil* :

|image913|

.. |image901| image:: ../media/image901.webp
   :width: 534px
.. |image902| image:: ../media/image902.webp
   :width: 700px
.. |image903| image:: ../media/image903.webp
   :width: 700px
.. |image904| image:: ../media/image904.webp
   :width: 416px
.. |image905| image:: ../media/image905.webp
   :width: 575px
.. |image908| image:: ../media/image908.webp
   :width: 502px
.. |image909| image:: ../media/image909.webp
   :width:432px
.. |image912| image:: ../media/image912.webp
   :width:700px
.. |image913| image:: ../media/image913.webp
   :width:503px

