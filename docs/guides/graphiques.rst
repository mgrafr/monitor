6. GRAHIQUES & BASE DE DONNEES
------------------------------
|image523|

Voir ces pages pour installer les scripts :
-	 http://domo-site.fr/accueil/dossiers/40
-	 http://domo-site.fr/accueil/dossiers/42

|image524|

|image525|

.. admonition:: **Prérequis**

   -	Jpgraph est installé avec le cache |image526|

   -	php-gd est installé |image527|

   -	la bibliothèque python fabric est importé

   -	le module python mysql.connector est importé

6.1 Les table SQL
^^^^^^^^^^^^^^^^^
.. warning::

   Pour le nom des tables concernant les graphiques, NE PAS UTILISER le CARACTERE –(moins)

   Ce caractère est utilisé comme séparateur pour l’indication de l’ensemble table-champ pour les graphiques

   |image528|

   **En absence de champ c’est le champ « valeur » qui est utilisé sinon** :

   Value= « <TABLE>-<CHAMP> »

|image529|

*Avec 2 champs ou 3 champs*

|image530| |image531|

**Création de la table avec phpMyAdmin** :*exemple*

.. code-block:: 'fr'

   CREATE TABLE `pression_chaudiere` (
  `num` int(5) NOT NULL,
  `date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `valeur` varchar(4) NOT NULL
   ) ENGINE=InnoDB DEFAULT CHARSET=utf8;
   ALTER TABLE `pression_chaudiere` CHANGE `num` `num` INT(4) NOT NULL AUTO_INCREMENT, add PRIMARY KEY (`num`);

6.2 Dans Domoticz
^^^^^^^^^^^^^^^^^

.. |image523| image:: ../media/image523.webp
   :width: 650px
.. |image524| image:: ../media/image524.webp
   :width: 601px
.. |image525| image:: ../media/image525.webp
   :width: 601px
.. |image526| image:: ../media/image526.webp
   :width: 210px
.. |image527| image:: ../media/image527.webp
   :width: 300px
.. |image528| image:: ../media/image528.webp
   :width: 602px
.. |image529| image:: ../media/image529.webp
   :width: 188px
.. |image530| image:: ../media/image530.webp
   :width: 244px
.. |image531| image:: ../media/image531.webp
   :width: 351px


