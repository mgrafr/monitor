14.  ADMINISTRATION
-------------------

|image788|

14.1 fichiers communs à toutes les pages
^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^
- **css**

voir le § 1.2.2.1 styles CSS communs à toutes les pages

- **Index_loc.php**  *chargement de la page impératif*

.. code-block::

   // administration
   include ("include/admin.php");

- **header.php**  *Affichage obligatoire dans le menu*

.. code-block::

   <li class="zz"><a href="#admin">Administration</a></li>

- **ajax.php**

.. code-block::

   if ($app=="admin") {admin($variable,$command);}	//$command=fenetre(administration footer

- **config.php** *emplacement du fichier* 

.. code-block::

   define('MONCONFIG', 'admin/config.php');//fichier config 

- **fonctions.php**    *admin()*

Extrait de la fonction:

|image794|

14.2 admin.php, test_db.php et backup_bd
^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^

|image795|

|image796|

|image797|

- **admin.php**

|image798|


14.7 Explications concernant l’importation distantes d’un tableau LUA
^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^

.. |image788| image:: ../media/image788.webp
   :width: 605px 
.. |image794| image:: ../media/image794.webp
   :width: 630px 
.. |image795| image:: ../media/image795.webp
   :width: 464px 
.. |image796| image:: ../media/image796.webp
   :width: 406px 
.. |image797| image:: ../media/image797.webp
   :width: 419px 
.. |image798| image:: ../media/image798.webp
   :width: 700px 


