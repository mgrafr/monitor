10. Dispositifs Zwave
---------------------
**Avec zwavejs2mqtt**, installé sous docker 

|image656|

- **La page zwave.php**

La structure est la même que pour la page zigbee.php, voir cette page :ref:`9. Dispositifs Zigbee`

- **Le fichier admin/config**

.. code-block::

   //Page zwavejs2mqtt
   define('ON_ZWAVE',true);// mise en service Zwave
   define('IPZWAVE', 'http://192.168.1.76:8091');
   define('URLZWAVE', 'https://zwave.<DOMAINE>');//url');

10.1 Accès distant
^^^^^^^^^^^^^^^^^^
Il faut configurer NGINX pour un accès https , voir les paragraphes 

- :ref:`9.1 accès distant HTTPS`

- :ref:`1.8 Accès distant HTTPS`

.. admonition:: **Exemple de fichier zwave.conf pout https**

   .. code-block::

      server {
       server_name zwave.DOMAINE.ovh;
       location / {
       proxy_pass http://192.168.1.76:8091/;
       proxy_set_header Host $host;
       proxy_set_header X-Real-IP $remote_addr;
       proxy_set_header X-Forwarded-For $proxy_add_x_forwarded_for;
       } 
       location /api {
       proxy_pass http://192.168.1.76:8091/api;
       proxy_set_header Host $host;
       proxy_http_version 1.1;
       proxy_set_header Upgrade $http_upgrade;
       proxy_set_header Connection "upgrade";
       } 
       server_name zwave.DOMAINE.ovh;
      #auth_basic "Mot de Passe Obligatoire";
      #auth_basic_user_file /etc/nginx/.htpasswd;
       listen 443 ssl; # managed by Certbot
       ssl_certificate /etc/letsencrypt/live/zwave. DOMAINE.ovh/fullchain.pem;$
       ssl_certificate_key /etc/letsencrypt/live/zwave. DOMAINE.ovh/privkey.pe$
       include /etc/letsencrypt/options-ssl-nginx.conf; # managed by Certbot
       ssl_dhparam /etc/letsencrypt/ssl-dhparams.pem; # managed by Certbot
      } 
      server {
       if ($host = zwave. DOMAINE.ovh) {
       return 301 https://$host$request_uri;
       } # managed by Certbot
       server_name zwave. DOMAINE.ovh;
      listen 80;
       server_name zwave DOMAINE.ovh;
       return 404; # managed by Certbot
      }


.. |image656| image:: ../media/image656.webp
   :width: 650px
