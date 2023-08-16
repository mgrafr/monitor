8. MUR de COMMANDES ON/OFF
--------------------------

|image574|

|image575|

8.1 les fichiers de base 
^^^^^^^^^^^^^^^^^^^^^^^^
Index_loc.php en général ne pas modifier

.. code-block:: 

   if (ON_ONOFF==true) include ("include/mur_inter.php");

- **header.php**

.. code-block:: 

   <?php if (ON_ONOFF==true) echo '<li class="zz"><a href="#murinter">Mur On/Off</a></li>';?>

- **styles** : mes_css.css

.. code-block:: 

   #murinter{
    width: 100%;
    height: 1120px;padding: 80px 0;
    min-height: 100%;
    position: relative;
    color: #000;
    top: 350px;z-index:-20;overflow: auto;
   }
   #murinter{background-color: aquamarine;}

8.1.1 écriture automatique du javascript
========================================
Effectuée par une fonction PHP à partir de la base de données

Extrait de la page html pour des commandes pour Domoticz et Home Assistant:

|image580|

voir le §  :ref:`0.3.2 Les Dispositifs`  *exemple des scripts générés automatiquement*

8.2 mur_inter.php
^^^^^^^^^^^^^^^^^^

|image582|

8.2.1 Exemple pour éclairage jardin
===================================
L’interrupeur mécanique de l’éclairage extérieur de l’entrée commande également en zigbee l’éclairage du jardin.

|image583| |image584|

**Domoticz** , Les capteurs virtuels

|image585|

Les capteurs sont mis à jour par MQTT et node-red depuis zigbee2mqtt

.. admonition:: **Les scripts node-red** 

   *envoi vers domoticz/in*

   |image586|

   *La réponse de Domoticz* 

   |image587|

.. important:: **Ce script automatique de Domoticz ne suffit pas en cas de commande de 
l’interrupteur car le délai de réponse peut atteindre plus de 10 s, il faut donc envoyer un 
message MQTT à partir de l’interrupteur virtuel.**

.. admonition:: **Le script python lancé par la « lampe_ext_entree »**

   Ce script publie un message MQTT vers zigbee2mqtt pour allumer l’éclairage du jardin si 
   l’interrupteur « lampe_ext_entree » est actionné

   |image588|


8.2.4 Exemple volet roulant
=============================




.. |image574| image:: ../media/image574.webp
   :width: 528px
.. |image575| image:: ../media/image575.webp
   :width: 629px
.. |image580| image:: ../media/image580.webp
   :width: 700px
.. |image582| image:: ../media/image582.webp
   :width: 601px
.. |image583| image:: ../media/image583.webp
   :width: 300px
.. |image584| image:: ../media/image584.webp
   :width: 300px
.. |image585| image:: ../media/image585.webp
   :width: 612px
.. |image586| image:: ../media/image586.webp
   :width: 365px
.. |image587| image:: ../media/image587.webp
   :width: 398px
.. |image588| image:: ../media/image588.webp
   :width: 700px
