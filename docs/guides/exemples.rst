15. EXEMPLES
------------
15.1 ajout d’un dispositif
^^^^^^^^^^^^^^^^^^^^^^^^^^^
- **Ajout d’un contact de porte supplémentaire**

|image878|

Dans Domoticz le dispositif est ajouté au plan :

|image879|

|image880|

15.1.1 Modifier l’image
=======================
-	*On effectue (avec Notepad par exemple) une sauvegarde de l’image* 

|image881|

-	*Avec Inkscape, ouvrir et modifier l’image*

|image882|

- *Faire un copier/coller d’un dispositif existant ou importer une icone*

|image883| |image884|

- *Placer l’icône et renseigner l’ID*

|image885|

- *Pour la couleur*

|image886|

- *Sauvegarder l’image dans le fichier PHP d’origine, en supprimant la ligne XML*

|image887|

15.1.2 Dans la Base de données SQL
==================================
*Insérer le dispositif dans la table « dispositifs »

|image888|

15.1.3 Dans le fichier PHP de l’image 
=====================================
*On ajoute un onclick pour l’affichage des propriétés*

.. note::

   avec Inkscape, il est possible de l’ajouter lors de la création de l’image si l’on a déjà choisi l’ID monitor.

   Ce n’est pas important, il faut ouvrir de toute façon cette image pour ajouter un cercle clignotant pour la gestion de la pile.

.. code-block::

   <g
   id="ouverture_porte_sejour"
   onclick="popup_device(7)"

|image890|

On peut vérifier que l’iD pour la couleur est bien présent

|image891|

Pour le cercle le plus simple c’est de faire un copier/coller d’un cercle existant avec des coordonnées facile à retrouver et avec une opacité à 1 

Voir paragraphe :ref:`2.1.1.b avec Adobe Illustrator`

|image892|

Avec F12 du navigateur ajuster la position

|image893| |image894|

15.2 Réinitialisation des dispositifs dans Domoticz
^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^
.. note:: **Exemple** 

   transfert de Domoticz linux vers Domoticz Docker avec Zwave et Zigbee sous docker également, avec la reconnaissance automatique MQTT

.. |image878| image:: ../media/image878.webp
   :width: 382px
.. |image879| image:: ../media/image879.webp
   :width: 348px
.. |image880| image:: ../media/image880.webp
   :width: 528px
.. |image881| image:: ../media/image881.webp
   :width: 665px
.. |image882| image:: ../media/image882.webp
   :width: 356px
.. |image883| image:: ../media/image883.webp
   :width: 306px
.. |image884| image:: ../media/image884.webp
   :width: 198px
.. |image885| image:: ../media/image885.webp
   :width: 502px
.. |image886| image:: ../media/image886.webp
   :width: 549px
.. |image887| image:: ../media/image887.webp
   :width: 604px
.. |image888| image:: ../media/image888.webp
   :width: 617px
.. |image890| image:: ../media/image890.webp
   :width: 291px
.. |image891| image:: ../media/image891.webp
   :width: 560px
.. |image892| image:: ../media/image892.webp
   :width: 656px
.. |image893| image:: ../media/image893.webp
   :width: 285px
.. |image894| image:: ../media/image894.webp
   :width: 268px
