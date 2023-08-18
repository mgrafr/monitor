9. Dispositifs Zigbee
---------------------
**Avec zigbee2mqtt**

Affichage du Frontend

|image653|

.. note:: Voir la page du site consacrée à frontend : http://domo-site.fr/accueil/dossiers/48

- **la page zigbee.php**

|image654|

- **Le fichier admin/config.php**

.. code-block:: 

   // Page zigbee2mqtt
   define('ON_ZIGBEE',true);// mise en service Zigbee
   define('IPZIGBEE', 'http://192.168.1.92:8084');//ip:port
   define('URLZIGBEE', 'https://zigbee.<DOMAINE>');//url

- **Le fichier index_loc.php** : pour info, ne pas modifier

.. code-block::

   if (ON_ZIGBEE==true) include ("include/zigbee.php");// fronted zigbee2mqtt

.. note:: **Pour une installation classique node.js**

   Démarrage auto : avec PM2 , Voir la page domo-site : http://domo-site.fr/accueil/dossiers/74 

   |image658|

   |image659|

   Pour une installation sous Docker, le démarrage sera automatique.


9.1 accès distant
^^^^^^^^^^^^^^^^^
Il faut configurer NGINX :

Exemple de fichier .conf avant de demander un certificat cerbot :

.. |image653| image:: ../media/image653.webp
   :width: 536px
.. |image654| image:: ../media/image654.webp
   :width: 625px
.. |image658| image:: ../media/image658.webp
   :width: 600px
.. |image659| image:: ../media/image659.webp
   :width: 647px

