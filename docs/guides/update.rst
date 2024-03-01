19. UPDATE
----------
19.1 Version de PHP
^^^^^^^^^^^^^^^
*La version actuelle est 8.3*

19.2 Version de SSH
^^^^^^^^^^^^^^^^^^^
version : php8.3-ssh2 pour Debian 12

19.3 UPDATE Monitor
^^^^^^^^^^^^^^^^^^^
**La version stable actuelle est 3.0.0**

19.2.1 Releases
===============
Version  en developpement 3.0.3
~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~
- modification ou mise à jour des dispositifs sans utiliser PhpMyAdmin
- le fichier string_modect.lua (DZ) est remplacé par string_modect.json (compatible DZ et HA)
- version SSH : php8.3-ssh2 pour Debian 12
- avec la compatibilité pour Home Assistant, les fichier de configuration "connect.* sont stockés dans monitor et à chaque maj DZ et HA téléchargent , après notification, les nouveaux fichiers.

Version  3.0
~~~~~~~~~~~~
- maj_js (fonction des dispositifs) s'enrichit de "on" poussoir momentané (bouton sonnette)

- test GSM de l'alarme: bouton PUSH ON remplacé par bouton de sonnette

- correction bug sur mise a jour lampes plan intérieur

- mise à jour de jpgraph vers la version 4.4.2

- pour une utilisation combinée de Domoticz et Home Assistant la table 'idm' n'est plus facultative mais obligatoire,(ne concerne que Domoticz); une copie de la table 'idx' vers 'idm' résout rapidement le problème
   dans la base de données idx de Domoticz et Id de Home Assistant peuvent être déclarés, il suffit d'indiquer celui des deux qui doit être actif pour monitor

Version 2.2.7
~~~~~~~~~~~~~

- séparation de temp et data pour l'affichage des températures

- Mise à jour temps réel avec SSE Node.js depuis Domoticz ou Home Assistant

- Alternative MAJ temps réel avec SSE PHP, installé lors de l'install de monitor

- ajout des groupes et scènes sur la page 'commandes ON/OFF"

- nom_objet remplace nom_dz ,(nom pour DZ et object_id pour HA)

- affichage clavier numérique dans alarme en plus d'administration 

- PHP 8.3

- PhpMyAdmin : 5.2.1

- Python 3.11

Version  2.2.6
~~~~~~~~~~~~~~
- ajout tableau messages, pour variables HA > 255 caractères ou autres appli

- ajout API monitor

Version  2.2.5
~~~~~~~~~~~~~~
- ajout script "lasteen pour home assistant

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


19.4 Version de JPGRAPH
^^^^^^^^^^^^^^^
*La version actuelle est 4.4.2*

Recommendé:

-  >= PHP 5.2.0 

-  PHP Builtin GD library
