2. Une 1ere PAGE : LE PLAN INTERIEUR
------------------------------------
2.1 l’image
^^^^^^^^^^^
Pour construire l’image du plan au format svg on utilise

- Adobe Illustrateur, payant mais (version hackée sur le net)
- Inskape gratuit open source :  https://inkscape.org/fr/release/inkscape-1.0.2/

Les avantages d’utiliser des images svg c’est de pouvoir manipuler le contenu avec javascript dans le DOM. Pour cela l’image doit faire partie complètement du HTML, l’url de l’image ne suffit pas.

Comme on ne peut pas charger uniquement cette url avec par exemple <img src= ’’image.svg ‘’>, il faut inclure cette image dans un fichier PHP et faire un include : < ?php include (‘image_svg.php’) ;?>

Il n’est pas facile au début d’utiliser ces logiciels pour construire complètement un plan ; une autre solution est de construire le plan au format jpg ou png avec un outil graphique plus facile à utiliser, Photofiltre, Paint ou Gimp et de convertir ensuite l’image ; un convertissur en ligne: https://www.autotracer.org/fr.html

C’est une bonne solution pour débuter mais quand tout fonctionne, il est alors temps de réaliser un plan directement avec AI, le poids du fichier sera réduit de beaucoup et la qualité sera excellente

Les deux solutions :

2.1.1 Avec un logiciel de conception graphique vectorielle
==========================================================
2.1.1.a avec Inkscape qui est gratuit
"""""""""""""""""""""""""""""""""""""
- On délimite le terrain en traçant un rectangle et en choisissant la couleur

|image222|

- On construit les murs extérieurs de la même façon ; on peut ajuster l’épaisseur en utilisant la barre supérieure

|image223|

- Pour modifier les objets :

|image224|

- Toujours avec un rectangle, on ajoute les pièces

|image225|

- On peut faire du copier/coller

|image226|

- Pour regrouper des objets de même couleur ou d’un même ensemble : GROUPER 

|image227|

- Pour dégrouper :

|image228|

- Pour les textes

|image229|

- Améliorer l’emplacement des ouvertures :

On reste dégroupé et on trace un rectangle autour des murs

|image230|

|image231|

|image232|

.. note::

   Contrairement à Adobe Illustrator , Inkscape ne gère pas les feuilles de style mais celles indiquées sont afficher dans les navigateurs.

- Pour ajouter des classes pour gérer les changements de couleur dans monitor, pour certains dispositifs  :

|image233|

- On donne un nom à cette classe :

|image234|

- L’objet avec la classe :

|image235|

- les CSS dans le fichier .svg 

|image236|

.. admonition:: **Remarque**

   |image237|  

   On ajoute aussi une class aux textes

   |image238|  

- La feuille de style complète pour le plan

 |image239| 

- L’image est centrée au milieu du calque , on la déplace à l’angle droit haut

|image240| 

- On fait correspondre l’image avec la page

|image241| 

On sauvegarde l l’image

On nettoie le code et on créer un fichier PHP qui contiendra l’image ; pour que cette image soit modifiable par le DOM, elle ne peut être appelée directement comme pour les formats classiques mais chargée entièrement dans le fichier HTML.

Avant nettoyage :

|image242| 

.. admonition:: **Nettoyage de l'image**

   on supprime la partie ci-dessus (jusqu’à « <style>) et on la remplace par : 

   .. code-block:: 'fr'

      <svg version="1.1" id="Calque_1" viewBox="0 0 150 150">

   |image243| 

   Pour comprendre viewbox : https://la-cascade.io/comprendre-svg-viewbox/

**Affichage dans monitor** (on peut ajouter une marge pour centrer l’image)

*534x720 : tablette chinoise*

|image244|

|image245|

*Affichage sur PC : 1200x612*

|image246|

2.1.1.b avec Adobe Illustrator
""""""""""""""""""""""""""""""
La construction est sensiblement la même, la différence pour notre sujet, réside dans la description des ID ; Inkscape ajoute des id partout, AI en ajoute aucun, sauf si on le spécifie, comme ci-dessous ;

 :red:`Il est impératif pour retrouver facilement les objets d’ajouter les id à la construction`.

|image247|

|image248|

.. note::

Les cercles ici indiquent lorsqu’ils clignotent, un changement de piles à prévoir ; le N° qui suis « cercle » est l’id du dispositif.



 :red:`Dans Inkscape, lors de la construction, il est possible d’ajouter du javascript, avec AI, il faut l’ajouter avec un éditeur de texte ou dreamweaver.`

.. code-block:: 'fr'

   <g
      id="ouverture_porte_sejour"
      onclick="popup_device(7)"

**Attention aux styles après construction** :

|image250|

.. warning::

:red:`Un style qui existe alors qu’il n’est pas utilisé crée une erreur`

.. admonition:: **La construction de mon plan** 

   avec AI : 

   |image251|

2.1.2 – 2eme solution pour le plan, conversion en ligne
=======================================================

|image252|

- Mon fichier floorplan.png

|image253|

- **Conversion avec Autotracer** :

|image254|

|image255|

Les textes transformés ne sont pas toujours lisibles, il faut modifier le plan,

|image258|

2.1.3 – Les couleurs
====================
Choisir des couleurs web : 6 familles (#00xxxx, #33xxxx, #66xxxx, #99xxxx, #CCxxxx, #FFxxxx), 216 couleurs, ce qui limite ne nombre de class ; un seul fichier de class pour tout le site....

...la construction est plus longue et là aussi il faut le faire depuis le début

|image260|

2.1.4 - ajout d’un ou plusieurs dispositifs
===========================================
Sur le net on trouve des icones au format svg, sinon on transforme les png avec Autotracer
Les icones que j’ai choisies : *contact d’ouverture de porte et détecteur de présence*

|image261|

.. note::

Pour les textes il suffit par exemple d’ajouter « tmp » qui sera en javascript remplacé par la température enregistrée par le dispositif

- **Importer l’icone**

|image262|

|image263|

|image264|

|image265|

- Redimensionner l’(les)objet(s) :

|image266|

Comme on peut le voir, avec les images svg le remplacement de couleur, de textes s’effectuent rapidement lors de la création ; il en est de même dans le HTML en utilisant javascript.
Ajouter un texte « temp » par exemple pour l’affichage de la température ; ce texte sera remplacé par la valeur de la température en utilisant Javascript; 

.. note::

les détecteurs de présence peuvent souvent enregistrer la température.

|image267|

- Pour les dispositifs et les textes, ajouter un ID :

*Comme indiqué précédemment, Avec Inkscape, il est possible d’ajouter facilement un ID lors de la construction de l’image*

|image268|

- La couleur de l’objet :

*avec Inskcape*:

|image269|

*avec Adobe Illustrator*:

|image270|


2.2 Des exemples d’autres dispositifs
^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^
2.2.1 Ajout du détecteur de fumée :
===================================

2.3 le fichier PHP de l’image
^^^^^^^^^^^^^^^^^^^^^^^^^^^^^


2.4 le fichier PHP de la page 
^^^^^^^^^^^^^^^^^^^^^^^^^^^^^
Il faut maintenant ajouter la page sur le site 
Un modèle de page pour toutes les pages du site : 


2.5 F12 des navigateurs pour faciliter la construction
^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^
Pour les PIR, les capteurs d’ouverture, pour le changement de couleur 



2.6 Les dispositifs virtuels Domoticz et MQTT
^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^
Pour monitor ça n’a pas d’importance, il n’y a pas de notion « virtuel – réel » mais la mise à 
jour de ces dispositifs dans Domoticz n’est pas toujours facile surtout pour les dispositifs 
avec plusieurs valeurs tels que température+ Humidité température +batterie, …

Un script dz : séparation_valeurs.lua




.. |image222| image:: ../media/image222.webp
   :width: 480px 
.. |image223| image:: ../media/image223.webp
   :width: 445px 
.. |image224| image:: ../media/image224.webp
   :width: 521px 
.. |image225| image:: ../media/image225.webp
   :width: 700px 
.. |image226| image:: ../media/image226.webp
   :width: 433px 
.. |image227| image:: ../media/image227.webp
   :width: 451px 
.. |image228| image:: ../media/image228.webp
   :width: 350px 
.. |image229| image:: ../media/image229.webp
   :width: 491px 
.. |image230| image:: ../media/image230.webp
   :width: 580px 
.. |image231| image:: ../media/image231.webp
   :width: 608px 
.. |image232| image:: ../media/image232.webp
   :width: 596px 
.. |image233| image:: ../media/image233.webp
   :width: 565px 
.. |image234| image:: ../media/image234.webp
   :width: 650px 
.. |image235| image:: ../media/image235.webp
   :width: 491px 
.. |image236| image:: ../media/image236.webp
   :width: 319px 
.. |image237| image:: ../media/image237.webp
   :width: 660px 
.. |image238| image:: ../media/image238.webp
   :width: 478px 
.. |image239| image:: ../media/image239.webp
   :width: 211px 
.. |image240| image:: ../media/image240.webp
   :width: 531px 
.. |image241| image:: ../media/image241.webp
   :width: 517px 
.. |image242| image:: ../media/image242.webp
   :width: 566px 
.. |image243| image:: ../media/image243.webp
   :width: 521px 
.. |image244| image:: ../media/image244.webp
   :width: 542px 
.. |image245| image:: ../media/image245.webp
   :width: 435px 
.. |image246| image:: ../media/image246.webp
   :width: 601px 
.. |image247| image:: ../media/image247.webp
   :width: 537px 
.. |image248| image:: ../media/image248.webp
   :width: 700px 
.. |image250| image:: ../media/image250.webp
   :width: 568px
.. |image251| image:: ../media/image251.webp
   :width: 523px 
.. |image252| image:: ../media/image252.webp
   :width: 300px
.. |image253| image:: ../media/image253.webp
   :width: 531px 
.. |image254| image:: ../media/image254.webp
   :width: 632px 
.. |image255| image:: ../media/image255.webp
   :width: 480px 
.. |image258| image:: ../media/image258.webp
   :width: 700px 
.. |image260| image:: ../media/image260.webp
   :width: 239px 
.. |image261| image:: ../media/image261.webp
   :width: 171px 
.. |image262| image:: ../media/image262.webp
   :width: 300px 
.. |image263| image:: ../media/image263.webp
   :width: 700px 
.. |image264| image:: ../media/image264.webp
   :width: 514px 
.. |image265| image:: ../media/image265.webp
   :width: 503px 
.. |image266| image:: ../media/image266.webp
   :width: 294px 
.. |image267| image:: ../media/image267.webp
   :width: 492px 
.. |image268| image:: ../media/image268.webp
   :width: 545px 
.. |image269| image:: ../media/image269.webp
   :width: 700px 
.. |image270| image:: ../media/image270.webp
   :width: 579px 




