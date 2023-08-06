1. Configuration minimum : la page d’accueil
---------------------------------------------

Permet d’afficher 

-	La température extérieure, 

-	Le jour (changement à 0H pour une tablette connectée en permanence), 

- La sortie des poubelles,

-	 La gestion de la fosse septique,

-	La surveillance de la pression de la chaudière 

-	Les anniversaires 

-	Rappel pour la prise de médicaments

-	 La prévision de pluie à 1 heure de Météo France

-	L’arrivée du courrier

-	La mise en service de l’alarme de nuit

-	Le remplacement des piles pour les capteurs concernés

- .... 

|image117|
 
1.1	– Configuration :/admin.config.php
^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^
 :red:`Il faut fournir un minimum de renseignements` :

1.1.1 -Adresse IP , domaine, favicon de monitor 
=============================================== 
.. code-block:: 'fr'

   //general monitor
   -->define('URLMONITOR', '');//domaine (pour accès distant) et port si différent de 443 
   -->define('IPMONITOR', '192.168.1.9');//ip
   define('PASSMONITOR', '*******');//mot passe serveur et SSH2
   define('USERMONITOR', 'michel');//user serveur et SSH2 ;le répertoire perso sera /home/nom de USERMONITOR
   define('MONCONFIG', 'admin/config.php');//fichier config 
   define('DZCONFIG', 'admin/dz/temp.lua');//fichier temp 
   -->define('FAVICON', '/favicon.ico');//fichier favicon  , icone du domaine dans barre url
   define('DISPOSITIFS', 'dispositifs');

.. note::
  :red:`define('DISPOSITIFS', 'dispositifs');`
   Pour faciliter la réinitialisation des dispositifs dans Domoticz ou un transfert (ex, zwavejs2mqtt , zigbee2mqtt sous docker) ; 

   en créant une copie de la table dispositifs (« dispositifs » par défaut), il est 
   possible de préparer le transfert ; ici la table dispositifs a été renommée Dispositifs

   |image120|

   |image121|
 
 
1.1.1.a Pour l’image de fond suivant la résolution d’écran et le logo
"""""""""""""""""""""""""""""""""""""""""""""""""""""""""""""""""""""
.. code-block:: 'fr'

   // Monitor 
   define('IMAGEACCUEIL', 'images/maison.webp');//image page accueil pour écrans >534 px
   define('IMAGEACCUEILSMALL', 'images/maison_small.webp');//image page accueil pour écrans <535 px
   define('IMGLOGO', 'images/logo.png');//image logo

1.1.1.b Pour les titres, slogans et lexique
"""""""""""""""""""""""""""""""""""""""""""
Pour le lexique :

-	true = lexique par défaut
-	false = lexique à modifier /include/lexique_no.php

.. code-block:: 'fr'

   define('NOMSITE', 'Domoticz');//nom principal du site
   define('NOMSLOGAN', xxxxxxxxxxx);//nom secondaire ou slogan
   // affichage lexique
   define('LEXIQUE', true);

1.1.2 intervalles de maj, maj temps réel
========================================
L’intervalle de mise à jour pour les services (poubelles, anniversaires,...) : il est de ½ heure (1800000 milli secondes), il peut être changé
 
.. code-block:: 'fr'
   // interval de maj des fonctions JS maj_services() & maj_devices()
   define('TEMPSMAJSERVICES', 1800000);//interval maj services en milli secondes
   define('TEMPSMAJSERVICESAL', 180000);//interval maj services ALARME ABSENCE(si installée) en milli secondes
   define('TEMPO_DEVICES', 180000);// en milli secondes
   define('TEMPO_DEVICES_DZ', 30000);// en milli secondes (>= 15s) maj déclenchée par Dz voir doc

.. note::
   *TEMPO_DEVICES* pour tous les dispositifs 

   *TEMPO_DEVICES_DZ* : pour les dispositifs qui mettent à 1 une variable pour indiquer à monitor d’effectuer une mise à jour, ici toutes les 30 secondes rafraichissement des dispositifs si par exemple un PIR, un 
   contact de porte qui sont déclaré prioritaire dans DZ passent à ON 

   |image126|

La fonction JS :

.. code-block:: 'fr'

   tempo_devices=<?php echo TEMPO_DEVICES_DZ;?>;
   var idsp=1;if (tempo_devices>14999)	var_sp(idsp);
   function var_sp(idsp){
     $.get( "ajax.php?app=data_var&variable=29", function(datas) {
     var variable_sp = datas;
     if (variable_sp>0){maj_devices(plan);maj_services(0);maj_variable(29,"variable_sp",0,2);}
    });
   setTimeout(var_sp, tempo_devices, idsp); 	
   }
 
La fonction PHP qui récupère la valeur de la variable :

.. code-block:: 'fr'

   // valeur d'une variable
   function val_variable($variable){
   $result=array();	
   $L=URLDOMOTIC."json.htm?type=command&param=getuservariable&idx=".$variable;
   $json_string = file_get_curl($L);
   $result = json_decode($json_string, true);
   $lect_var = $result['result'][0];
   $value = $lect_var['Value'];	
   return 	$value;
   }

1.1.3 Autres données
====================
Choisir Idx de Domoticz ou idm de monitor ? 

.. note::
   Pour une première installation avec Domoticz, choisir idx ; pour une réinstallation de Domoticz, il sera alors préférable de choisir idm pour éviter de renommer tous les dispositifs dans les images svg

   Pour une installation avec HA , idm , il n'existe pas d' Idx, choisir idm et laisser vide 'NUMPLAN'. 

*La création d’un plan qui regroupe les dispositifs sur Domoticz est nécessaire : noter le N° du plan (NUMPLAN)*

.. code-block:: 'fr'

   // choix ID pour l'affichage des infos des dispositifs
   // idx : idx de Domoticz    (dans ce cas ,
   //     en cas de problème il faudra renommer tous les dispositifs 
   //     dans monitor au lieu de la DB)
   define('CHOIXID','idm');// DZ:idm ou idx ; HA : idm uniquement
   define('NUMPLAN','2');//DZ uniquement: n° du plan regroupant tous les capteurs
 
Paramètres de la base de données :
 
.. code-block:: 'fr'

   // parametres serveur DBMaria
   define('SERVEUR','localhost');
   define('MOTDEPASSE','<MOT PASSE>');
   define('UTILISATEUR','michel');
   define('DBASE','monitor');

Paramètres pour Domoticz ou HA :
 
.. code-block:: 'fr'

   //seveurs domotiques Domoticz ou HA
   define('IPDOMOTIC', '192.168.1.76');//ip
   //pour ssh2
   define('USERDOMOTIC', 'michel');//user du serveur,répertoire :home/user
   define('PWDDOMOTIC', '');//mot passe serveur
   define('URLDOMOTIC', 'http://192.168.1.76:8086/');//url
   define('DOMDOMOTIC', 'https://*************');//domaine
   define('TOKENDOMOTIC', '');//TOKEN ou BEARER
   define('IPDOMOTIC1', '');//ip 2emme serveur Domotique
   define('USERDOMOTIC1', 'michel');//user du serveur,répertoire :home/user
   define('PWDDOMOTIC1', '');//mot passe serveur
   define('URLDOMOTIC1', 'http://192.168.1.5:8123/');//url ex:http://192.168.1.5:8123/
   define('DOMDOMOTIC1', 'https://***********');//domaine
   define('TOKEN_DOMOTIC1',"eyJhb*****************************************************************2k");   
   //______________Pour Domoticz
   define('VARTAB', URLDOMOTIC.'modules_lua/string_tableaux.lua');//
   define('BASE64', URLDOMOTIC.'modules_lua/connect.lua');//login et password en Base64
   define('CONF_MODECT', URLDOMOTIC.'modules_lua/string_modect.lua');

.. warning::
  les variables ci-dessus , VARTAB, BASE64, CONF_MODECT sont à déclarer ici que si elles sont utilisées dans un fichier

Le programme démarre avec 11 pages :

-	Accueil

-	Plan intérieur

-	Page d’administration, pour afficher cette page, le mot de passe est obligatoire : par défaut :red:'« admin »'.
  
 il est toujours possible de modifier le fichier de configuration avec un éditeur

-	Les autres pages concernent l’alarme, un mur de caméras, ... 

1.2	- Les fichiers PHP, les styles, le javascript
^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^
1.2.1 - à la racine du site :
=============================

 voir ce paragraphe : :ref:`0.4 Le serveur http de NGINX`

**Complément d'informations concernant "fonctions.php":**

voir le fichier à jour sur Github : https://raw.githubusercontent.com/mgrafr/monitor/main/fonctions.php

Principales fonctions contenues dans ce fichier :

.. admonition:: **function file_http_curl**

   |image134|

.. admonition:: **function status_variables**

   Pour récupérer les valeurs des variables de Domoticz et HA

   |image135|

   |image136|

.. admonition:: **fonctions maj_variable et sql_variable** 

   |image138|

.. admonition:: **function devices_zone** 

   API HA pour récupérer les valeurs des dispositifs

   |image137|

.. admonition:: **function devices_plan** 

   API Domoticz pour les devices :

   |image139|

   |image140|

   Maj de la date dans cette fonction: si la tablette reste allumée en permanence,la date ne sera pas mise à jour en absence de rafraichissement
   

   On crée un idx=0 qui n'existe pas , aussi avec cet idx la maj sera forcée (voir la fonction maj_devices(plan) dans footer.php) 

   .. code-block:: 'fr'

      $data[0] = ['jour' => date('d'),
                  'idx' => '0'];






.. |image117| image:: ../media/image117.webp
   :width: 531px 
.. |image120| image:: ../media/image120.webp
   :width: 357px 
.. |image121| image:: ../media/image121.webp
   :width: 239px 
.. |image126| image:: ../media/image126.webp
   :width: 604px 
.. |image134| image:: ../media/image134.webp
   :width: 544px 
.. |image135| image:: ../media/image135.webp
   :width: 605px    
.. |image136| image:: ../media/image136.webp
   :width: 635px    
.. |image137| image:: ../media/image137.webp
   :width: 650px  
.. |image138| image:: ../media/image138.webp
   :width: 650px  
.. |image139| image:: ../media/image139.webp
   :width: 605px  
.. |image140| image:: ../media/image140.webp
   :width: 650px  
