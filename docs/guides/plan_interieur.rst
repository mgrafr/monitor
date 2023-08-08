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
