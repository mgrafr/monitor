19. UPDATE
----------
19.1 Version de PHP
^^^^^^^^^^^^^^^
*La version actuelle est 8.2*

19.2 UPDATE Monitor
^^^^^^^^^^^^^^^^^^^
**La version stable actuelle est 2.2.4**

19.2.1 Releases
===============
Version en développement 2.2.5
~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~
en cours script LastSeen pour HA

Version 2.2.4
~~~~~~~~~~~~~
- ajout d'une notification LastSeen (avec script pour domoticz)

- ajout bouton reset pour annuler la notification de piles faibles

- réécriture de export_sql en dzvent : export_timer_sql et export_dev_sql(concerne Linky et les températures

- Nb enregistrements affichés pour historique poubelles : remplacé 24 par choix dans config.php

- installation d'un assistant vocal Ha-bridge et Alexa ; intégration du pont Ha-bridge dans monitor

Version 2.2.3
~~~~~~~~~~~~~
- Ajout docomentation Readthedocs

Version 2.2.0
~~~~~~~~~~~~~
- suite à la modification de l’API Domoticz (devices remplacé par getdevices),   ……………………..mise à jour de fonctions.php

- accès shell Domoticz-Docker avec SSH2

Version 2.1.0
~~~~~~~~~~~~~
- début de l’adaptabilité à Home Assistant, l’affichages des valeurs des dispositifs, l’utilisation des variables et la commande de switches virtuels sont opérationnelles.

- ajout certificat auto-signé pour Nginx

- ajout reboot serveur distant et scp pour fichiers distants

- maj automatique des IP lors de changements de serveurs

- scripts automatiques d’installation

- 3 scripts différents d’installation et version 2.1 (update vers Debian 12)

- explication concernant l’envoi par Domoticz de SMS


19.3 Version de JPGRAPH
^^^^^^^^^^^^^^^
*La version actuelle est 4.4.1*

Recommendé:

-  >= PHP 5.2.0

-  PHP Builtin GD library
