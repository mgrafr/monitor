15. EXEMPLES
------------
15.1 ajout d’un dispositif
^^^^^^^^^^^^^^^^^^^^^^^^^^
15.1.1 Ajout d’un contact de porte supplémentaire
=================================================
|image878|

Dans Domoticz le dispositif est ajouté au plan :

|image879|

|image880|

15.1.1.1 Modifier l’image
"""""""""""""""""""""""
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

15.1.2 Ajout d’un Panic bouton (SOS)
====================================
pour Domoticz : soit on utilise une icone disponible, soit on ajoute au fichier :darkblue:`www/switch_icons.txt` une icone perso.( voir ci dessous le mode d'emploi)

|image73|

.. admonition:: Icônes personnalisées pour Domoticz

   Les images téléversées dans le dossier "images" de DZ doivent être au format **png de 48x48 px**

   |image104|

   Ajouter les informations concernant l'icone dans le fichier :darkblue:`switch_icons.txt` comme indiqué ci-après:

   |image105|

Le script lua pour envoyer une alerte SMS et mail

.. code-block::

   if (device.name == 'SOS (Action)_emergency') then 
      txt='alarmeùSOS';obj='alarme SOS';alerte_gsm(txt);domoticz.email('Alarme',obj,adresse_mail) 
   end

LE script :darkblue:`notifications_devices.lua` :

|image109|

Voir le § :ref:`13.6 SMS réception et émission concernant l'envoi d'un sms`

15.1.1.2 Dans la Base de données SQL
==================================
*Insérer le dispositif dans la table « dispositifs »*

|image888|

15.1.1.3 Dans le fichier PHP de l’image 
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

15.2 Ajout d'une commande ON-OFF
^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^
A partir d'une prise ce courant Zigbee pour alimenter le seche-serviette de la SDB.

|image498|

La prise Zigbee dans Domoticz:

|image499|

La prise Zigbee dans Home Assistant

|image505|

L'image SVG du seche-serviette:

|image607|

On possède maintenant les élément pour enregistrer la prise dans la base SQL:

|image506|

On ajoute le dispositif sur le MUR de Commandes , entre les balises <ul> ...>/ul> :

.. code-block::

   <li style="margin-left:150px;margin-top:-660px"><a href="#murinter"><?php include ("seche-serviettes_svg.php");?></li>

Pour avoir un retour en temps réel d'un changement de position de la prise ( ajout temporisation, mise à jour lors de l'extinction,etc,...), on ajoute dans le script LUA concernant les devices:

|image608|



15.3 Réinitialisation des dispositifs dans Domoticz
^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^
.. note:: **Exemple** 

   transfert de Domoticz linux vers Domoticz Docker avec Zwave et Zigbee sous docker également, avec la reconnaissance automatique MQTT

   |image895|

Dans ce cas tous les dispositifs changent d’idx dans Domoticz, il faut mettre à jour la table de la base de données : « dispositifs »
.
Pour préparer le travail, faire une copie de la table « dispositifs en l’exportant

|image896|

Modifier le fichier exporté 

|image897|

Importer la nouvelle table  |image898|

**Faire correspondre les nouveaux « idx » de Domoticz avec les « idm « de monitor.**

Dans le fichier de configuration, modifier le nom de la table et la nouvelle IP de Domoticz :

.. code-block::

   define('DISPOSITIFS', 'Dispositifs');
   define('URLDOMOTIC', 'http://192.168.1.76:8086/');//url

.. |image73| image:: ../media/image73.webp
   :width: 400px
.. |image104| image:: ../media/image104.webp
   :width: 400px
.. |image105| image:: ../media/image105.webp
   :width: 400px
.. |image109| image:: ../media/image109.webp
   :width: 700px
.. |image498| image:: ../media/image498.webp
   :width: 400px
.. |image499| image:: ../media/image499.webp
   :width: 400px
.. |image505| image:: ../media/image505.webp
   :width: 400px
.. |image506| image:: ../media/image506.webp
   :width: 413px
.. |image607| image:: ../media/image607.webp
   :width: 700px
.. |image608| image:: ../media/image608.webp
   :width: 700px
.. |image878| image:: ../media/image878.webp
   :width: 350px
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
.. |image895| image:: ../media/image895.webp
   :width: 700px
.. |image896| image:: ../media/image896.webp
   :width: 563px
.. |image897| image:: ../media/image897.webp
   :width: 392px
.. |image898| image:: ../media/image898.webp
   :width: 180px
