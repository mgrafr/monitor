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

|image917|

.. |image914| image:: ../media/image914.webp
   :width:534px
.. |image915| image:: ../media/image915.webp
   :width:700px
.. |image916| image:: ../media/image916.webp
   :width:605px
.. |image917| image:: ../media/image917.webp
   :width:700px


