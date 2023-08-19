11. MONITORING Nagios
---------------------
Avec Nagios ou Nagios mobile sur monitor

.. note::

   L’app Nagios PC est installée sur un Raspberry 4 8Go, celui qui gère également les sauvegardes et la com GSM

|image668|

|image669|

.. note::
   
   Nagios effectue le monitoring des VM Proxmox avec un plugin : voir le site domo-site.fr

   http://domo-site.fr/accueil/dossiers/71

   |image670|


11.1 accès distant 
^^^^^^^^^^^^^^^^^^
Il faut configurer Nginx et ensuite demander un certificat Letsencrypt,

Voir paragraphe :ref:`9.1 accès distant HTTPS` , *un exemple de configuration avant de faire une demande de certificat* ; 

11.2 Supprimer l’affichage YouTube
^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^


.. |image668| image:: ../media/image668.webp
   :width: 533px
.. |image669| image:: ../media/image669.webp
   :width: 537px
.. |image670| image:: ../media/image670.webp
   :width: 601px
