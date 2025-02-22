22. FRIGATE
-----------
22.1 Matériel
^^^^^^^^^^^^^
-**1 mini PC**  ou plutôt micro compte tenu de sa taille *raccordé au routeur par un cable ethernet*

|image1595| |image1597| 

- Processeur d'image (GPU):Carte graphique Intel ® Supercore (jusqu'à 750MHz)
- Mémoire en cours d'exécution (RAM):LPDDR5 4800 MT/s, montage à bord,
- Disque dur de stockage:Compatible M.2 2242 SATA, SATA/PCIE
- Construit dans l'expansion de stockage:M.2 2242 peut évoluer à 2 To;
- Sortie graphique:Double sortie HDMI + DP V1.4, prenant en charge une résolution maximale de 4096x2160
- Réseau sans fil:Realtek 8852BE 802.11a/b/g/n/ac/ax
- Interface de puissance:Interface TYPE-C, 12V/3A, 36W (charge uniquement) Prise en charge de l'alimentation PD
- USB-A:USB3.2 (Gen1 * 1) * 3
- Sortie vidéo:HDMI * 2 4096x2160 @ 60Hz , DP V1.4 * 1 4096x2160 @ 60Hz
- Interface audio:Å3.5mm, CTIA
- Port Ethernet:GLA Lan (RJ45) * 2 1000m/100m/10m
- Indicateur de lumière:Indicateur de puissance bleu clair
- Taille du corps:87*87*39.5MM
- Poids corporel:397 grammes
- Système d'exploitation:Windows 11 Pro Édition Professionnelle

22.1.1 Installation du module Pcie Coral
========================================

|image1596| 

Comme il n'y a qu'un seul emplacement Pcie occupé par une carte wifi-BT et comme le PC est raccordé par un cable ethernet:

- on remplace le module wifi (qui se trouve sous la carte M2) par le module Coral

|image1598| 

Le couvercle est clipsé, pour l'ouvrir il suffit de déclipser en soulevant avec un tournevis

22.2 Installation docker
^^^^^^^^^^^^^^^^^^^^^^^^
.. admonition::Pré-requis 

   Debian 12 (version légère avec uniquement SSH) est installé

   Le pare-feu UFW est installé :

   |image1610|

- **Ajouter la clé GPG officielle de Docker:**

.. code-block::

   sudo apt-get update
   sudo apt-get install ca-certificates curl
   sudo install -m 0755 -d /etc/apt/keyrings
   sudo curl -fsSL https://download.docker.com/linux/debian/gpg -o /etc/apt/keyrings/docker.asc
   sudo chmod a+r /etc/apt/keyrings/docker.asc

- **Ajoutez le dépôt aux sources Apt :**

.. code-block::

   echo \
  "deb [arch=$(dpkg --print-architecture) signed-by=/etc/apt/keyrings/docker.asc] https://download.docker.com/linux/debian \
  $(. /etc/os-release && echo "$VERSION_CODENAME") stable" | \
  sudo tee /etc/apt/sources.list.d/docker.list > /dev/null
  sudo apt-get update

- **Installez les packages Docker:**

.. code-block::

   sudo apt-get install docker-ce docker-ce-cli containerd.io docker-buildx-plugin docker-compose-plugin

- **1.	Vérifiez que l’installation a réussi en exécutant l’image :hello-world**

.. code-block::

   sudo docker run hello-world

|image1599|

- **créer le groupe docker et ajouter-vous comme utilisateur :**

.. code-block::

   sudo groupadd docker
   sudo usermod -aG docker $USER

- **Configurer Docker pour qu’il démarre au démarrage avec systemd:**

.. code-block::

   sudo systemctl enable docker.service
   sudo systemctl enable containerd.service

|image1600|

- **installer Docker-compose:**

.. code-block::

   sudo apt install docker.io docker-compose -y

22.3 Installation de Frigate
^^^^^^^^^^^^^^^^^^^^^^^^^^^^
https://github.com/blakeblackshear/frigate

- **créer 2 sous-répertoires pour la configuration et la vidéo dans un répertoire "frigate" :**

.. code-block::

   cd /opt
   mkdir frigate && cd frigate
   mkdir config
   mkdir media

|image1601|

22.3.1 Créer le fichier de configuration docker-compose.yml
===========================================================
|image1602|

.. code-block::

   sudo nano docker-compose.yml

.. code-block::

   version: "3.9"
   services:
     frigate:
       privileged: true # this may not be necessary for all setups
       restart: unless-stopped
       image: ghcr.io/blakeblackshear/frigate:stable
   #    devices:
   #     - /dev/bus/usb:/dev/bus/usb # Passe l’USB Coral, doit être
                                  # modifié pour d’autres versions
   #     - /dev/apex_0:/dev/apex_0 # Passe un PCIe Coral, suivez les
             # instructions du pilote ici
             # https://coral.ai/docs/m2/get-started/#2a-on-linux
       ports:
         - "5000:5000"
         - "1935:1935"
         - "554:8554" # Flux RTSP
       volumes:
         - /opt/frigate/config:/config
         - /opt/frigate/media:/media
         - type: tmpfs # En option:1 Go de memoire,réduit l
                       # usure de la carte SSD/SD
           target: /tmp/cache
        tmpfs:
          size: 100000000
       environment:
         - FRIGATE_RTSP_PASSWORD=<PASS>
         - FRIGATE_RTSP_USER=<USER>

22.3.2 Configurer une caméra, config.yml
========================================
.. code-block::

   sudo nano config/config.yml

|image1603|

.. code-block::

   mqtt:
     enabled: false
   cameras:
     jardin_cote_rue:
       ffmpeg:
         inputs:
           - path: rtsp://michel:IdemIdem4546@192.168.1.107:554/cam/realmonitor?channel=1&subtype=0
             roles:
               - record
           - path: rtsp://michel:IdemIdem4546@192.168.1.107:554/cam/realmonitor?channel=1&subtype=0
             roles:
               - detect
       detect:
         enabled: true
   version: 0.14
   camera_groups:
     cam:
       order: 1
       icon: LuAirplay
       cameras:
         - Jardin_cote_rue

22.3.3 Démarrer Frigate
=======================
.. code-block::

   sudo docker-compose up -d

- **Affichage dans le navigateur**

|image1604|

22.4 Installer le pilote du module Coral
^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^
.. code-block::

   sudo uname -r

|image1605|

.. important::

   - Si la version de votre noyau est 4.19 ou supérieure, vérifier si un pilote Apex pré-construit est installé 

   .. code-block::

      sudo lsmod | grep apex

   |image1606|

   S’il n’affiche rien, tout va bien , continuez à installer le pilote PCIe. Si il affiche un nom de module Apex, suivre la solution pour désactiver Apex et Gasket: https://coral.ai/docs/m2/get-started/#workaround-to-disable-apex-and-gasket

22.4.1 Installez le pilote PCIe et les packages d’exécution Edge TPU
====================================================================
Tout d’abord, ajouter le dépôt de paquets Debian au système:

.. code-block::

   echo "deb https://packages.cloud.google.com/apt coral-edgetpu-stable main" | sudo tee /etc/apt/sources.list.d/coral-edgetpu.list
   sudo curl https://packages.cloud.google.com/apt/doc/apt-key.gpg -o /etc/apt/trusted.gpg.d/coral.asc
   sudo apt-get update
  
- **Installez ensuite le pilote PCIe et les packages d’exécution Edge TPU**

.. code-block::

   sudo apt-get install gasket-dkms libedgetpu1-std   

.. note::

   le compte utilisateur doit disposer des autorisations root

- **Une fois *redémarré*, vérifier que le module d’accélération est détecté:**

.. code-block::

   lspci -nn | grep 089a

|image1607|

- **Vérifiez également que le pilote PCIe est chargé :**

.. code-block::

   ls /dev/apex_0

|image1608|

22.5 nouvelles configurations de docker-compose et config
^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^
22.5.1 docker-compose.yml
=========================

|image1609|

22.5.1 config/config.yml
========================
- Ajouter ces lignes:

.. code-block::

   # N'activez cette option que si vous utilisez les GPU Intel
   ffmpeg:
     hwaccel_args: preset-vaapi
   detectors:
     coral:
       type: edgetpu
       device: pci

22.5 prise en main de go2rtc
^^^^^^^^^^^^^^^^^^^^^^^^^^^^
.. IMPORTANT::

   Pour utiliser go2rtc dans Frigate, il n'est pas nécessaire de l'installer mais pour comprendre le fonctionnement, c'est préférable.

   Par contre pour l'utiliser dans Frigate il est important de stopper le conterneur go2rtc pour éviter des problèmes d'ouverture de ports.

   En mappant dans :darkblue:`docker-compose.yml` de Frigate le port **1984**, on peux accéder à go2rtc. Avec un certificat letsencrypt, l'accès distant est aussi possible.

   |image1675|


.. seealso::

   ports RTSP et ONVIF pour caméras de marque : https://www.camapp365.com/technical/rtsp-and-onvif-ports

   https://github.com/AlexxIT/go2rtc

- **création du répertoire /op/go2rtc**

.. code-block::

   mkdir /opt/go2rtc
   cd /opt/go2rtc

- **création de docker-compose.yml

.. code-block::

  services:
  go2rtc:
    image: alexxit/go2rtc:master-hardware
    network_mode: host       # important for WebRTC, HomeKit, UDP cameras
    privileged: true         # only for FFmpeg hardware transcoding
    restart: unless-stopped  # autorestart on fail or config change from WebUI
    environment:
      - TZ=Europe/Paris  # timezone in logs
    volumes:
      - "~/go2rtc:/config"   # folder for go2rtc.yaml file (edit from WebUI)
 
|image1611|

- **Démarrer le conteneur**

.. code-block::

   sudo docker-compose up -d

|image1612|

|image1613|

|image1614|

- **config.yml:**

|image1615|

22.6 le fichier config/config.yml avec go2rtc
^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^
|image1616|

22.7 Accès distant
^^^^^^^^^^^^^^^^^^
- **Autoriser le port 5000**

|image1617|

- **le fichier de configuration Nginx**

.. code-block::

   #auth_basic "Mot de Passe Obligatoire";
   #auth_basic_user_file /etc/nginx/.htpasswd;
       server_name <DOMAINE>;

       location / {
        proxy_pass http://192.168.1.2:5000/;
        proxy_set_header Host $host;
        proxy_set_header X-Real-IP $remote_addr;
        proxy_set_header X-Forwarded-For $proxy_add_x_forwarded_for;
    #WebSocket support
       proxy_set_header Upgrade $http_upgrade;
       proxy_set_header Connection "upgrade";
       proxy_http_version 1.1;
       }
       listen 443 ssl; # managed by Certbot
       ssl_certificate /etc/letsencrypt/live/<DOMAINE>/fullchain.pem; #>
       ssl_certificate_key /etc/letsencrypt/live/<DOMAINE>/privkey.pem;>
       include /etc/letsencrypt/options-ssl-nginx.conf; # managed by Certbot
       ssl_dhparam /etc/letsencrypt/ssl-dhparams.pem; # managed by Certbot
   }
   server {
    if ($host = <DOMAINE>) {
        return 301 https://$host$request_uri;
    } # managed by Certbot
    listen      80 ;
    server_name <DOMAINE>;
    return 404; # managed by Certbot

*voir cette exemple pour la configuration en http pour demander un certificat Let'sEncrypt*  :ref:`9.4 accès distant HTTPS`

22.8 Configuration onvif (caméras PTZ)
^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^
|image1619|

- **fichier /config/config.yml**

.. code-block::

   ptz_nord:
     ffmpeg:
       inputs:
         - path: rtsp://127.0.0.1:8554/ptz_nord
           input_args: preset-rtsp-restream
           roles:
             - detect
     onvif:
       host: 192.168.1.20
       port: 8899
       user: admin
       password: '' # si pas de password
     detect:
       enabled: true

- ** fichier docker-compose.yml**

|image1620|

.. note::

   ports ONVIF les plus utilisés: 80, 8000, 8080, 8899, 2000, 5000

|image1621|

22.9 Notifications (sans HomeAssistant)
^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^
https://github.com/0x2142/frigate-notify/tree/main

- **mon fichier config.yml**

.. code-block::

   frigate:
     server: http://192.168.1.2:5000
     ignoressl: true
     public_url: https://frigate.xxxxxxxxxxxxxx.ovh
     headers:
       - Authorization:  Basic bWxxxxxxxxxxxxNTQ2
     startup_check:
       attempts: 5
       interval: 30
     mqtt:
       enabled: true # Une seule méthode de surveillance peut être configurée
       server: 192.168.1.42
       port: 1883
       clientid: frigate-notify
       username: michel
       password: xxxxxxxxx
       topic_prefix: frigate
     webapi:
       enabled: false # Une seule méthode de surveillance peut être configurée
       interval: 60
     cameras:
       exclude:
         - PTZ_nord
   alerts:
     general:
       title: Alerte Frigate
       timeformat:
   # Spécifier ce qu’il faut faire avec les événements qui n’ont pas d’image d’instantané
       nosnap:        # Par défaut : allow
       snap_bbox:
   # Inclut l’horodatage sur l’instantané lorsqu’il est récupéré à partir de Frigate
      snap_timestamp:
      snap_crop:
   # Définissez cette option pour ne notifier qu’une seule fois par événementtrue
      notify_once: true
     quiet:
       start:
       end:
     zones:
       unzoned: allow
       allow:
         - jardin_cote_rue_z1
       block:
         - test_zone_02
     discord:
       enabled: false
       webhook:
       template:
     gotify:
       enabled: false
       server:
       token:
       ignoressl:
       template:
     pushover:
       enabled: true
       token: aszzzzzzzzzzzzzzzzzzzzzzka
       userkey: uoxxxxxxxxxxxxxxxxxxxji
       devices: honvvvvvvvvvvvvvv
       priority: 0
       retry:
       expire:
       ttl:
       template:
     smtp:
       enabled: false
       server: smtp.orange.fr
       port: 465
       tls: true
       user: michel.xxxxxxxr@orange.fr
       password: zzzzzzzzzzzzzzzzzzzzzzzz
       recipient: michel.zzzzzzzzzzzz@mailo.com
       template:
     webhook:
       enabled: true
       server: http://192.168.1.5/monitor/api/json.php?app=envoi_sms&contenu=essai
       ignoressl:
       method:
       params:
       headers:
       template:

   monitor:
     enabled: false
     url:
     interval:
     ignoressl:

- **monfichier docker-compose.yaml**

|image1622|

- **fichier journal**

.. code-block::

   docker logs --tail 50 --follow --timestamps frigate-notify_frigate-notify_1

|image1623| 

22.10 Frigate plus
^^^^^^^^^^^^^^^^^^
la documentation n'est pas très claire, il faut ajpouter la clé api dans la configuration docker

|image1630| 

22.11 Mise à jour de Frigate
^^^^^^^^^^^^^^^^^^^^^^^^^^^^
Pour faire cette mise à jour, 2 lignes de commandes à taper :

.. code-block::

   docker compose pull
   sudo docker compose up -d

|image1676| 

22.12 Caméras chinoises Vatilon
^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^
Caméras H42, H43, PA4, PB4, .....

Des problèmes existent avec :darkblue:`go2rst`, pour les résoudre l'update du firmware est souvent la solution; pour cela, télécharger IPCBatchTools sur Github :

https://github.com/mtrakal/ipc-vatilon

|image1677| 

.. admonition:: **ICBatchTools** , mode d'emploi

   |image1678| 

   les firmware sont à téléchage ici : https://www.vatilon.com/ipcrjxz


.. |image1595| image:: ../img/image1595.webp
   :width: 400px
.. |image1596| image:: ../img/image1596.webp
   :width: 200px
.. |image1597| image:: ../img/image1597.webp
   :width: 250px
.. |image1598| image:: ../img/image1598.webp
   :width: 300px
.. |image1599| image:: ../img/image1599.webp
   :width: 605px
.. |image1600| image:: ../img/image1600.webp
   :width: 605px
.. |image1601| image:: ../img/image1601.webp
   :width: 399px
.. |image1602| image:: ../img/image1602.webp
   :width: 535px
.. |image1603| image:: ../img/image1603.webp
   :width: 505px
.. |image1604| image:: ../img/image1604.webp
   :width: 559px
.. |image1605| image:: ../img/image1605.webp
   :width: 351px
.. |image1606| image:: ../img/image1606.webp
   :width: 460px
.. |image1607| image:: ../img/image1607.webp
   :width: 605px
.. |image1608| image:: ../img/image1608.webp
   :width: 419px
.. |image1609| image:: ../img/image1609.webp
   :width: 640px
.. |image1610| image:: ../img/image1610.webp
   :width: 433px
.. |image1611| image:: ../img/image1611.webp
   :width: 600px
.. |image1612| image:: ../img/image1612.webp
   :width: 605px
.. |image1613| image:: ../img/image1613.webp
   :width: 492px
.. |image1614| image:: ../img/image1614.webp
   :width: 605px
.. |image1615| image:: ../img/image1615.webp
   :width: 632px
.. |image1616| image:: ../img/image1616.webp
   :width: 700px
.. |image1617| image:: ../img/image1617.webp
   :width: 465px
.. |image1619| image:: ../img/image1619.webp
   :width: 498px
.. |image1620| image:: ../img/image1620.webp
   :width: 454px
.. |image1621| image:: ../img/image1621.webp
   :width: 550px
.. |image1622| image:: ../img/image1622.webp
   :width: 425px
.. |image1623| image:: ../img/image1623.webp
   :width: 644px
.. |image1630| image:: ../img/image1630.webp
   :width: 563px
.. |image1675| image:: ../img/image1675.webp
   :width: 621px
.. |image1676| image:: ../img/image1676.webp
   :width: 586px
.. |image1677| image:: ../img/image1677.webp
   :width: 383px
.. |image1678| image:: ../img/image1678.webp
   :width: 700px
