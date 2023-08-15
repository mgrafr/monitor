6. GRAHIQUES & BASE DE DONNEES
------------------------------
|image523|

Voir ces pages pour installer les scripts :
-	 http://domo-site.fr/accueil/dossiers/40
-	 http://domo-site.fr/accueil/dossiers/42

|image524|

|image525|

.. admonition:: **Prérequis**

   -	Jpgraph est installé avec le cache |image526|

   -	php-gd est installé |image527|

   -	la bibliothèque python fabric est importé

   -	le module python mysql.connector est importé

6.1 Les table SQL
^^^^^^^^^^^^^^^^^
.. warning::

   Pour le nom des tables concernant les graphiques, NE PAS UTILISER le CARACTERE –(moins)

   Ce caractère est utilisé comme séparateur pour l’indication de l’ensemble table-champ pour les graphiques

   |image528|

   **En absence de champ c’est le champ « valeur » qui est utilisé sinon** :

   Value= « <TABLE>-<CHAMP> »

|image529|

*Avec 2 champs ou 3 champs*

|image530| |image531|

**Création de la table avec phpMyAdmin** :*exemple*

.. code-block:: 'fr'

   CREATE TABLE `pression_chaudiere` (
  `num` int(5) NOT NULL,
  `date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `valeur` varchar(4) NOT NULL
   ) ENGINE=InnoDB DEFAULT CHARSET=utf8;
   ALTER TABLE `pression_chaudiere` CHANGE `num` `num` INT(4) NOT NULL AUTO_INCREMENT, add PRIMARY KEY (`num`);

6.2 Dans Domoticz
^^^^^^^^^^^^^^^^^
Les données à enregistrer peuvent provenir de capteurs réels ou virtuels. Pour éviter un trop grand nombre de valeurs, il est utile pour certains dispositifs, de créer des variables pour comparer les valeurs et les limiter aux valeurs entières (c’est le cas de la météo Darsky, des capteurs de température Onoff).

Pour utiliser des données de la base SQL, il faut au préalable les avoir enregistrées depuis Domoticz : c’est le rôle de la bibliothèque Python :darkblue:`fabric` 

Pour l'installer (pip est déjà installé):

.. code-block:: 'fr'

   sudo pip3 install fabric

Une fois un premier enregistrement crée, pour une température, dans la base, il suffit pour un nouvel enregistrement d’une autre t° d’ajouter dans le script LUA « évènement /:darkblue:`export_sql` » cette T°

https://raw.githubusercontent.com/mgrafr/monitor/main/scripts_dz/lua/export_sql.lua

*Extrait de export_sql.lua*:

.. code-block:: 'fr'

   package.path = package.path..";www/modules_lua/?.lua"
   require 'datas'
   require 'string_tableaux'
   data0=pression;data1=d_linky
   year 	= tonumber(os.date("%Y"));
   month 	= os.date("%m");
   day 	= os.date("%d");
   hour 	= os.date("%H");
   min 	= os.date("%M");
   sec     = os.date("%S");
   weekday = tonumber(os.date("%w"));
   time    = os.date("%X");
   datetime = year.."-"..month.."-"..day.." "..time;
   --
    function write_datas(data0,data1)
   f = io.open("www/modules_lua/datas.lua", "w")
   f:write('pression='..data0..';d_linky='..data1)
   f:close()
   end
   function envoi_fab(don)
	print ("maj valeur:"..don);
        local command = "/bin/bash userdata/scripts/bash/./fabric.sh"..don.." > /home/michel/fab.log 2>&1";
        os.execute(command);
        os.execute("python3 scripts/python/pushover.py "..txt.." >> /home/michel/push.log 2>&1");
   end
   function round(num,numDecimal)
   local mult = 10^(numDecimal or 0)
   return math.floor(num * mult + 0.5) / mult
   end
   function Split(s, delimiter)
    result = {};
    for match in (s..delimiter):gmatch("(.-)"..delimiter) do
        table.insert(result, match);
    end
    return result;
  end 
  commandArray = {}
  t = {};
  --donnees={['pression']='1.2'};write_datas('{["pression"]="'.."1.2"..';}')
  -- libelle=table#champ
  -- si 2 champs , ajouter ..'#champ2#"..split_str[2] après datetime.. 
  -- exemple "don=" "..libelle.."#"..tostring(deviceValue).."#"..datetime.."#champ2#"..split_str[2]
  for deviceName,deviceValue in pairs(devicechanged) do
    if (deviceName=='pir_salon_temp') then
        print ("temp_salon:"..deviceValue);
	    libelle="temp_salon#valeur";don=" "..libelle.."#"..tostring(deviceValue).."#"..datetime
        envoi_fab(don)
   ...... 

|image534|

Pour limiter le nb d’enregistrements :

|image535|

Dans cet exemple, il a été créer 3 variables qui permettent des enregistrements dans la BD à chaque changement de valeurs limité au degré.:

|image536|

.. admonition:: **Le script fabric.sh**

   installé ici dans le répertoire « scripts » de Domoticz

   |image537|

   .. code-block:: 'fr'

      #!/bin/bash

      echo $1
      echo $2
      a="#"
      c=$1$a$2
      echo $c
      cd /home/michel/python
      fab maintask --don=$c  > /home/michel/fab.log 2>&1

   Pour tester le script, il est plus facile de travailler dans le répertoire USER, c’est l’objet de la création du lien symbolique vers le dossier python de Domoticz

   |image538|

   |image539|

.. admonition:: **Le script fabfile.py**

   |image540|

   .. code-block:: 'fr'

      #!/usr/bin/env python2.7
      # -*- coding: utf-8 -*-
      from fabric import Connection
      from fabric.tasks import task
      @task
      def subtask(ctx, donn):
        with ctx.cd("/www/monitor/python"):
          ctx.run(donn)
      @task( optional = ['don'])
      def maintask(ctx, don = None ):
        con = Connection(host = '192.168.1.7', user = 'michel', connect_kwargs = {'password':'PASS'})
        file = "python3 sqlite_mysql.py "
        donn = file+don
        print(subtask(con,donn))

   *Le script fabfile.py appelle sur le serveur qui héberge la BD le script sqlite_mysql.py*;

**sqlite_mysql.py n’est exécuté que lorsqu’il est appelé, il n’écoute pas en permanence si des données sont envoyées**

|image541|

**POUR RESUMER** : sur le serveur de Domoticz

- script LUA->MENU Domoticz évènements

- script fabric.sh-> ../domoticz/scripts/

- script fabfile.py->../domoticz/scripts/python/   avec ls /home/USER/python/

-  fab.log-> /home/USER

6.3 Sur le serveur de la base de données
^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^
Le serveur Nginx avec aussi Monitor,

réception des datas : Le script python :darkblue:`sqlite_mysql.py` :

.. code-block:: 'fr'

   #!/usr/bin/env python3
   # -*- coding: utf-8 -*-
   import sys
   import mysql.connector
   from mysql.connector import Error
   total_arg = len(sys.argv)
   if (total_arg>0) :
       x= str(sys.argv[1])
       temp = x.split('#')
       table=temp[0]
       champ=temp[1]
       val1=temp[2]
       val=temp[3]+" "+temp[4]
   if (len(temp)==7) :
       champ2=temp[5]
       val2=temp[6]
   try:
       connection = mysql.connector.connect(
             host = "127.0.0.1",
             user = "michel",
          password = xxxxxxxx",
          database = "domoticz")

       if connection.is_connected():
           db_Info = connection.get_server_info()
           print("Connected to MySQL Server version ", db_Info)
           cursor = connection.cursor()
           cursor.execute("select database();")
           record = cursor.fetchone()
           print("You're connected to database: ", record)
           if (len(temp)==7) :
               query = "INSERT INTO "+table+" (date,"+champ+","+champ2+") VALUES(%>
               values = (val, val1, val2)
           else :
               query = "INSERT INTO "+table+" (date,"+champ+") VALUES(%s, %s)"
               values = (val, val1)
           cursor.execute(query, values)
       connection.commit()
       print(cursor.rowcount, "Record inserted successfully into Laptop table")
   except Error as e:
       print("Error while connecting to MySQL", e)
   finally:
       if (connection.is_connected()):
           cursor.close()

|image542|

6.4 Dans Monitor
^^^^^^^^^^^^^^^^
Le cache pour jpgraph est présent :

|image543|

Jpgraph est installé à la racine de monitor

|image544|

6.4.1 la page graphique.php
===========================

|image545|

- *css*

.. code-block:: 'fr'
   #graphic{color:white;}
   graphique_img{max-width:700px;margin:0 1px 0 1px,;width:100%;}
   graphiques{background-color: green;}



.. |image523| image:: ../media/image523.webp
   :width: 650px
.. |image524| image:: ../media/image524.webp
   :width: 601px
.. |image525| image:: ../media/image525.webp
   :width: 601px
.. |image526| image:: ../media/image526.webp
   :width: 210px
.. |image527| image:: ../media/image527.webp
   :width: 300px
.. |image528| image:: ../media/image528.webp
   :width: 602px
.. |image529| image:: ../media/image529.webp
   :width: 188px
.. |image530| image:: ../media/image530.webp
   :width: 244px
.. |image531| image:: ../media/image531.webp
   :width: 351px
.. |image534| image:: ../media/image534.webp
   :width: 700px
.. |image535| image:: ../media/image535.webp
   :width: 570px
.. |image536| image:: ../media/image536.webp
   :width: 478px
.. |image537| image:: ../media/image537.webp
   :width: 256px
.. |image538| image:: ../media/image538.webp
   :width: 608px
.. |image539| image:: ../media/image539.webp
   :width: 548px
.. |image540| image:: ../media/image540.webp
   :width: 306px
.. |image541| image:: ../media/image541.webp
   :width: 543px
.. |image542| image:: ../media/image542.webp
   :width: 602px
.. |image543| image:: ../media/image543.webp
   :width: 205px
.. |image544| image:: ../media/image544.webp
   :width: 215px
.. |image545| image:: ../media/image545.webp
   :width: 602px
