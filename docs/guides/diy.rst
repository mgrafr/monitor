17. DIY
-------
17.1 Domotiser un SPA (ou une piscine)
^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^
Ce paragraphe contient différentes parties qui peuvent être indépendantes ou liées suivant le choix de chacun :

-	La réalisation d’un boitier électronique de mesures de PH, Redox, Températures, Débit de la filtration, les mesures étant envoyées sur un serveur MQTT;Cette réalisation est décrite sur le site domo-site.fr

-	La création de capteurs virtuels dans Domoticz qui récupère les valeurs envoyées par le serveur MQTT et les envoie vers la base de données de Monitor ; il envoie également des alertes sur la TV comme pour les poubelles et la fosse septique. 

-	La création d’une page dans Monitor pour afficher les données sur une page dédiée, afficher des alertes et commander s’il y a lieu le chauffage, les pompes ,...

|image914|

17.1.1. Création de capteurs virtuels dans Domoticz
===================================================
*Pour mémoire*

|image915|

.. warning:: C’est Domoticz qui fournit l’IDX, il faut donc modifier cet IDX dans EasyEsp ;Pour le PH, le redox, le débit, les capteurs sont " Custom ".

   |image916|

**Dans EasyEsp**

|image917|

17.1.2. Création des tables PH, Redox, temp, ...
================================================
*dans la base de données*

.. note::

   Dans phpMyAdmin, il n’est pas possible de faire des copier/coller, aussi il faut enregistrer les lignes ci-dessous dans un fichier et l’importer pour éviter de taper toutes les lignes.
**4  ou 5 caractères** sont nécessaires pour la valeur (5 caractères reçus par Dz de MQTT , réduits à 4 avec :red:`round(deviceValue, 1)` dans le script lua).

- **La commande SQL** :

.. code-block::

   CREATE TABLE `ph_spa` (
  `num` int(5) NOT NULL,
  `date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `valeur` varchar(5) NOT NULL 
   ) ENGINE=InnoDB DEFAULT CHARSET=utf8;
   ALTER TABLE `debit_spa` CHANGE `num` `num` INT(5) NOT NULL AUTO_INCREMENT, add PRIMARY KEY (`num`);

|image918|

*Faire de même pour les autres tables , en remplaçant le nom de la table dans le fichier ; exemple : CREATE TABLE `orp_spa`*

|image919|

.. important:: :darkblue:`Si la création est manuelle , ne pas oublier Auto incrémenter « num »`

   |image920|

17.1.3 Envoi des données à la BD de monitor par Domoticz
========================================================
*Le paragraphe 6.2 traite de ce sujet (envoie de températures issues de capteurs réels ou virtuels)*.

Il suffit donc d’ajouter les données PH, Redox, etc... dans le script export_sql dans Evènements de Domoticz :


.. |image914| image:: ../media/image914.webp
   :width:534px
.. |image915| image:: ../media/image915.webp
   :width:700px
.. |image916| image:: ../media/image916.webp
   :width:605px
.. |image917| image:: ../media/image917.webp
   :width:700px
.. |image918| image:: ../media/image918.webp
   :width:549px
.. |image919| image:: ../media/image919.webp
   :width:610px
.. |image920| image:: ../media/image920.webp
   :width:601px


