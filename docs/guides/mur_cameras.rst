7. MUR de CAMERAS
-----------------
.. warning::

   Zoneminder doit être installé

Pour éviter des problèmes de capacité mémoire, vider le cache périodiquement avec CRON : 

**crontab -e** |image555|

*Avec nano ou vim* :

.. code-block:: 

   0 12 * *  * sync; echo 3 > /proc/sys/vm/drop_caches

|image556|

Ici la mémoire sera libérée des données cache et tampon tous les jours à 12H ; plus d’ infos :

.. _a link: https://www.tomzone.fr/vider-la-memoire-cache-dun-serveur-linux/#:~:text=Par%20exemple%20pour%20vider%20tous%20les%20jours%20%C3%A0,%2A%20%2A%20%2A%20sync%3B%20echo%203%20%3E%20%2Fproc%2Fsys%2Fvm%2Fdrop_caches

|image557|

.. |image555| image:: ../media/image555.webp
   :width: 332px
.. |image556| image:: ../media/image556.webp
   :width: 700px
.. |image557| image:: ../media/image557.webp
   :width: 536px

