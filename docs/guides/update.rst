19. UPDATE
----------
Version Dev sous debian 13

19.1 Version de PHP
^^^^^^^^^^^^^^^^^^^
*La version actuelle est 8.4*

19.2 Version de SSH
^^^^^^^^^^^^^^^^^^^
version : php8.4-ssh2 pour Debian 13

19.3 Version de MariaDB
^^^^^^^^^^^^^^^^^^^^^^^
Server version: 11.8.2

19.4 UPDATE Monitor
^^^^^^^^^^^^^^^^^^^
**La version stable actuelle sous debian 13 est 4.0.0**

19.4.1 Releases
===============
Version en developpement 4.0.1
~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~

Version 4.0.0 (septembre 2025)
~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~
- passage sous debian 13 Trixie
- Les plans sont désormais en priorité dans le rep custom/php

Version 3.2.5 (juillet 2025)
~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~
- correction bug sur devices_plan pour ioBroker
- correction bug sur admin pour Domoticz
- dernière version sous debian 12

Version 3.2.4 (Mai 2025)
~~~~~~~~~~~~~~~~~~~~~~~~~~~
- correction bug sur mur_inter.php
- Ajout de la possibilité d'un fichier de configuration par écran de contrôle
- Ajout d'un lien symbolique de la configuration vers le répertoire de l'API
- modification  de fonctions.php pour intégrer 2 répertoires de io.broker (ex pour worx les repertoires  mover et calendar)
- Suppression de la maj_js "onoff_rgb" (modif des couleurs) et création pour toutes les lampes dimmables de "on_level"
- Ajout d'un cookie pour mémoriser la config en cours sur un écran (PC, Tablette, Smartphone)
- maj en temps réel avec mqtt websocket pour ioBroker

Version 3.2.3 (Févier 2025)
~~~~~~~~~~~~~~~~~~~~~~~~~~~
- correction de bugs dans sauvegarde_maj.sh & restore.sh
- finalisation de OTP 2fa avec l'envoi de sms par GSM et par l'api Free Mobile
- ajout du dossier "custom/python" , pour installer les scrips python perso, (pour faciliter les maj).

Version 3.2.2 (Févier 2025)
~~~~~~~~~~~~~~~~~~~~~~~~~~~
- ajout dans config.php choix pour modect : Zoneminder ou frigate ou false
- ajout dans la table cameras.sql nom de la caméra pour Frigate
- ajout dans l'api de monitor , l'envoi de sms (utilisé par frigate-notify)
- ajout de l'Authentification 2 étapes OTP 2fa

Version 3.2.1 (Décembre 2024)
~~~~~~~~~~~~~~~~~~~~~~~~~
- ajout de Frigate dans le Mur de Caméras
- Corrections mineures

Version 3.2.0 (Août 2024)
~~~~~~~~~~~~~~~~~~~~~~~~~
- ajout Panic Bouton en page d'accueil
- prise en compte de io.broker (début du développement)
- Changement de couleur des lampes sur le mur de commandes

cette version commence à intégrer io.broker ; pour cela l' idm de monitor doit indiquer :
1 ou 2 pour Domoticz (à terme seulement 2 sera utilisé, le 1 est conservé uniquement pour Domoticz provisoirement compte tenu de l'historique) 
3 pour Home Assistant
4 pour io.broker

cette version ne peut être mise à jour automatiquemnt, aussi la configuration doit être indiquée dans le nouveau fichier en s'inspirant du précédent.
Dans la base de données de monitor seul le champ Actif doit être si besoin mis à jour en tenant compte des infos ci-dessus.

Version  3.1.0 (mars 2024)
~~~~~~~~~~~~~~~~~~~~~~~~~~
- modification ou mise à jour des dispositifs sans utiliser PhpMyAdmin
- le fichier string_modect.lua (DZ) est remplacé par string_modect.json (compatible DZ et HA)
- version SSH : php8.3-ssh2 pour Debian 12
- avec la compatibilité pour Home Assistant, les fichier de configuration "connect.* sont stockés dans monitor et à chaque maj DZ et HA téléchargent , après notification, les nouveaux fichiers.
- utilisation d'un identifiant monitor 'idm' pour les dispositifs et les variables pour une compatibilité avec Home Assistant

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


19.5 Version de JPGRAPH
^^^^^^^^^^^^^^^^^^^^^^^
*La version actuelle est 4.4.2*

Recommendé:

-  >= PHP 5.2.0 

-  PHP Builtin GD library
