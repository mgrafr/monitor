9. Dispositifs Zigbee
---------------------
**Avec zigbee2mqtt**

9.1 Démarrage automatique
^^^^^^^^^^^^^^^^^^^^^^^^^
- **Pour une installation classique node.js**

Démarrage auto : avec PM2 , Voir la page domo-site : http://domo-site.fr/accueil/dossiers/74 

[image658|

|image659|

- **Pour une installation sous Docker**, le démarrage sera automatique.

9.2 Le fronted
^^^^^^^^^^^^^^
|image1143|

Affichage

|image653|

.. admonition:: **ajouter une fonction utile**: *vu pour la derière fois*

   |image1142|

   A parir du frontend:

   |image1141|

   .. note:: **ISO 8601** c'est la  représentation de la date, en format internationalement, exemple : 2023-10-06T17:13:26Z

   le payload MQTT:

      .. code::

         MQTT publish: topic 'zigbee2mqtt/lampe_jardin', payload '{"last_seen":"2023-10-05T20:52:34.706Z","linkquality":156,"state_l1":"OFF","state_l2":"OFF"}'

   La donnée "last_seen" peut être utilisé avec Node , HA (mais pas avec Dz) pour connaitre les dispositifs :red:`offline`

.. note:: Voir la page du site consacrée à frontend : http://domo-site.fr/accueil/dossiers/48

9.3 Ajouter le Fronted dans monitor
^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^

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

- **Les styles CSS**

En plus des css pour la page:

.. code-block::

   /*zigbee2mqtt zwavejs2mqtt & ngiosmobile   (----------------*/
   #zbmqtt,#zwmqtt {margin-top:-40px;width: 100%;height: 800px;}

- **zigbee.php**

on ajoute une iframe *(permet d'obtenir une page HTML intégrée dans la page courante)*

.. code-block::		         

   <iframe id="zbmqtt" src="<?php echo $lien_zigbee;?>" frameborder="0" ></iframe>

|image657|

9.4 accès distant HTTPS 
^^^^^^^^^^^^^^^^^^^^^^^
Il faut configurer NGINX : - :ref:`1.8 Accès distant HTTPS`

.. admonition:: **Exemple de fichier .conf avant de demander un certificat cerbot**

   .. code-block::

      server {
       listen       80;
       server_name  zigbee.<DOMAINE>;
       #return 301   https://zigbee<DOMAINE>$request_uri;
      }
       location / {
        proxy_pass http://<IP>:<PORT>/;
        proxy_set_header Host $host;
        proxy_set_header X-Real-IP $remote_addr;
        proxy_set_header X-Forwarded-For $proxy_add_x_forwarded_for;
       }
       location /api {
        proxy_pass         http://<IP>:<PORT>/api;
        proxy_set_header Host $host;

        proxy_http_version 1.1;
        proxy_set_header Upgrade $http_upgrade;
        proxy_set_header Connection "upgrade";
        }
       }

- **Demande de certificat Let's Encrypt** :

.. prereq::**Installer Cerbot**

   .. code-block::

      sudo apt install certbot python3-certbot-nginx

.. code-block::

   sudo cerbot --nginx

Le fichier modifié par cerbot lors de la demande de certificat

|image655|

.. attention:: ** Pour utiliser auth basic**
   *comme c'est le cas ici*

   Il faut créer un fichier de mot de passe et ajouter des utilisateurs

   https://docs.nginx.com/nginx/admin-guide/security-controls/configuring-http-basic-authentication/

9.5 utilisation directe avec monitor 
^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^
sans l'intermédiaire de Domoticz, Home Assistant ou Ipbroker

9.5.1 Installation de la lirairie libmosquitto-dev
""""""""""""""""""""""""""""""""""""""""""""""""""
.. code-block::

   apt install libmosquitto-dev

9.5.2 envoyer et recevoir les messages
""""""""""""""""""""""""""""""""""""""

en cours de développement


.. |image653| image:: ../media/image653.webp
   :width: 536px
.. |image654| image:: ../media/image654.webp
   :width: 625px
.. |image655| image:: ../media/image655.webp
   :width: 700px
.. |image657| image:: ../media/image657.webp
   :width: 700px
.. |image658| image:: ../media/image658.webp
   :width: 600px
.. |image659| image:: ../media/image659.webp
   :width: 647px
.. |image1141| image:: ../media/image1141.webp
   :width: 650px
.. |image1142| image:: ../media/image1142.webp
   :width: 700px
.. |image1143| image:: ../media/image1143.webp
   :width: 418px
