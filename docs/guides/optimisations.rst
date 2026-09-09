23. OPTIMISATION en cours
-------------------------
23.1 Reset à distance du modem GSM
^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^
*1 Bug  en 2 ans !!!* 

23.1.1 Simple programme de commande de relais USB LCUS_1
========================================================

**le script bash**
  
.. code-block::
  
   #!/usr/bin/bash

   echo "Entrer une commande : ON ou OFF "
   read COMMANDE
   if [ "$COMMANDE" = "ON" ] ; then cmd='\xA0\x01\x01\xA2'
   fi
   if [ "$COMMANDE" = "OFF" ] ; then cmd='\xA0\x01\x01\xA2';
   fi
   serdev="/dev/ttyUSB0"

   echo 'reset modem gsm'
   /bin/bash -c "echo -n -e '$cmd' > $serdev"

**Retour d’info avec GPIO du RPI**

|image1064|

23.2 Essai de Gladys Assistant dans un CT LXC
^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^
 |image1120|

exécution de l'image Docker de Gladys dans un CT LXC Proxmox(images OCI), version de proxmox minimum 9.1

23.2.1 Création du conteneur
============================
 - Récupérer le nom de l'image : ex: gladysassistant/gladys:v5
    https://github.com/gladysassistant/Gladys

 - Dans proxmox, indiquer le nom de l'image OCI dans le registre

  |image1112|

  Cliquez sur Télécharger pour extraire l'image
  
  |image1114|

  Le modèle est ajouté au stockage

  |image1113|

 - **Création du conteneur** 

    |image1122|

23.2.2 Démarrage du conteneur
=============================
la console affiche :

 |image1115|

Elle ne peut être utilisée, la solution pour contourner le problème:

- utiliser le shell du noeud

  .. code-block::

     pct enter <NUMERO DU CT>

 |image1116|

 - mettre à jour et installer des utiliaires:

  .. code-block::

     apt update & upgrade
     apt install sudo,nano,openssh-server

  |image1118|

 - Créer un utilisateur et lui donner des droits

  .. code-block::

     adduser <UTILISATER>
     usermod -G sudo <UTILISATEUR>

- Affichage du contenu du serveur dans filezilla en sftp et l'utilisateur crée

   |image1119|

.. note::

   Gladys Assistant utilise deux types de bases de données en local selon les infos stockées : 
   - SQLite : pour les données générales (utilisateurs, configuration, appareils et états de base).
   - DuckDB : une base de données analytique dédiée aux données temporelles (historique des capteurs)

23.2.2 Accés depuis le navigateur
=================================
http://gladysassistant.local ou <IP du SERVEUR>

 |image1121|


23.2.2.1 
"""""""""""""""""""""



.. |image1064| image:: ../media/image1064.webp
   :width: 696px
.. |image1112| image:: ../media/image1112.webp
   :width: 650px
.. |image1113| image:: ../media/image1113.webp
   :width: 500px
.. |image1114| image:: ../media/image1114.webp
   :width: 650px
.. |image1115| image:: ../media/image1115.webp
   :width: 650px
.. |image1116| image:: ../media/image1116.webp
   :width: 650px
.. |image1117| image:: ../media/image1117.webp
   :width: 500px
.. |image1118| image:: ../media/image1118.webp
   :width: 600px
.. |image1119| image:: ../media/image1119.webp
   :width: 600px
.. |image1120| image:: ../media/image1120.webp
   :width: 60px
.. |image1121| image:: ../media/image1121.webp
   :width: 350px
.. |image1122| image:: ../media/image1122.webp
   :width: 700px

.. |image1123| image:: ../media/image1123.webp
   :width: 600px
.. |image1124| image:: ../media/image1124.webp
   :width: 485px
.. |image1125| image:: ../media/image1125.webp
   :width: 700px
.. |image1126| image:: ../media/image1126.webp
   :width: 700px
.. |image1127| image:: ../media/image1127.webp
   :width: 358px
.. |image1128| image:: ../media/image1128.webp
   :width: 383px
.. |image1129| image:: ../media/image1129.webp
   :width: 600px
.. |image1130| image:: ../media/image1130.webp
   :width: 446px
.. |image1131| image:: ../media/image1131.webp
   :width: 600px
.. |image1132| image:: ../media/image1132.webp
   :width: 314px
.. |image1133| image:: ../media/image1133.webp
   :width: 295px
.. |image1134| image:: ../media/image1134.webp
   :width: 492px
.. |image1135| image:: ../media/image1135.webp
   :width: 492px
.. |image1136| image:: ../media/image1136.webp
   :width: 700px
.. |image1137| image:: ../media/image1137.webp
   :width: 533px
