2. Une 1ere PAGE : LE PLAN INTERIEUR
------------------------------------
2.1 l’image
^^^^^^^^^^^
Pour construire l’image du plan au format svg on utilise

- Adobe Illustrateur, payant mais (version hackée sur le net)
- Inskape gratuit open source :  https://inkscape.org/fr/release/inkscape-1.0.2/

Les avantages d’utiliser des images svg c’est de pouvoir manipuler le contenu avec javascript dans le DOM. Pour cela l’image doit faire partie complètement du HTML, l’url de l’image ne suffit pas.

Comme on ne peut pas charger uniquement cette url avec par exemple <img src= ’’image.svg ‘’>, il faut inclure cette image dans un fichier PHP et faire un include : < ?php include (‘image_svg.php’) ;?>

Il n’est pas facile au début d’utiliser ces logiciels pour construire complètement un plan ; une autre solution est de construire le plan au format jpg ou png avec un outil graphique plus facile à utiliser, Photofiltre, Paint ou Gimp et de convertir ensuite l’image ; un convertissur en ligne: https://www.autotracer.org/fr.html

C’est une bonne solution pour débuter mais quand tout fonctionne, il est alors temps de réaliser un plan directement avec AI, le poids du fichier sera réduit de beaucoup et la qualité sera excellente

Les deux solutions :

2.1.1 Avec un logiciel de conception graphique vectorielle
==========================================================
2.1.1.a avec Inkscape qui est gratuit
"""""""""""""""""""""""""""""""""""""
- On délimite le terrain en traçant un rectangle et en choisissant la couleur

|image222|

- On construit les murs extérieurs de la même façon ; on peut ajuster l’épaisseur en utilisant la barre supérieure

|image223|

- Pour modifier les objets :

|image224|

- Toujours avec un rectangle, on ajoute les pièces

|image225|

- On peut faire du copier/coller

|image226|

- Pour regrouper des objets de même couleur ou d’un même ensemble : GROUPER 

|image227|

- Pour dégrouper :

|image228|

- Pour les textes

|image229|

- Améliorer l’emplacement des ouvertures :

On reste dégroupé et on trace un rectangle autour des murs

|image230|

|image231|

|image232|

.. note::

   Contrairement à Adobe Illustrator , Inkscape ne gère pas les feuilles de style mais celles indiquées sont afficher dans les navigateurs.

- Pour ajouter des classes pour gérer les changements de couleur dans monitor, pour certains dispositifs  :

|image233|

- On donne un nom à cette classe :

|image234|

- L’objet avec la classe :

|image235|

- les CSS dans le fichier .svg 

|image236|

.. admonition:: **Remarque**

   |image237|  

   On ajoute aussi une class aux textes

   |image238|  

- La feuille de style complète pour le plan

 |image239| 

- L’image est centrée au milieu du calque , on la déplace à l’angle droit haut

|image240| 

- On fait correspondre l’image avec la page

|image241| 

On sauvegarde l l’image

On nettoie le code et on créer un fichier PHP qui contiendra l’image ; pour que cette image soit modifiable par le DOM, elle ne peut être appelée directement comme pour les formats classiques mais chargée entièrement dans le fichier HTML.

Avant nettoyage :

|image242| 

.. admonition:: **Nettoyage de l'image**

   on supprime la partie ci-dessus (jusqu’à « <style>) et on la remplace par : 

   .. code-block::

      <svg version="1.1" id="Calque_1" viewBox="0 0 150 150">

   |image243| 

   Pour comprendre viewbox : https://la-cascade.io/comprendre-svg-viewbox/

**Affichage dans monitor** (on peut ajouter une marge pour centrer l’image)

*534x720 : tablette chinoise*

|image244|

|image245|

*Affichage sur PC : 1200x612*

|image246|

2.1.1.b avec Adobe Illustrator
""""""""""""""""""""""""""""""
La construction est sensiblement la même, la différence pour notre sujet, réside dans la description des ID ; Inkscape ajoute des id partout, AI en ajoute aucun, sauf si on le spécifie, comme ci-dessous ;

 :red:`Il est impératif pour retrouver facilement les objets d’ajouter les id à la construction`.

|image247|

|image248|

.. note::

   Les cercles ici indiquent lorsqu’ils clignotent, un changement de piles à prévoir ; le N° qui suis « cercle » est l’id du dispositif.

   :red:`Dans Inkscape, lors de la construction, il est possible d’ajouter du javascript, avec AI, il faut l’ajouter avec un éditeur de texte ou dreamweaver.`

   .. code-block::

      <g
      id="ouverture_porte_sejour"
      onclick="popup_device(7)"

**Attention aux styles après construction** :

|image250|

.. warning::

   :red:`Un style qui existe alors qu’il n’est pas utilisé crée une erreur`

.. admonition:: **La construction de mon plan** 

   avec AI : 

   |image251|

2.1.1.c Vérification du code SVG
""""""""""""""""""""""""""""""""
https://www.svgviewer.dev/

|image1819|

2.1.2 – 2eme solution pour le plan, conversion en ligne
=======================================================

|image252|

- Mon fichier floorplan.png

|image253|

- **Conversion avec Autotracer** :

|image254|

|image255|

Les textes transformés ne sont pas toujours lisibles, il faut modifier le plan,

|image258|

2.1.3 – Les couleurs
====================
Choisir des couleurs web : 6 familles (#00xxxx, #33xxxx, #66xxxx, #99xxxx, #CCxxxx, #FFxxxx), 216 couleurs, ce qui limite ne nombre de class ; un seul fichier de class pour tout le site....

...la construction est plus longue et là aussi il faut le faire depuis le début

|image260|

2.1.4 - ajout d’un ou plusieurs dispositifs
===========================================
Sur le net on trouve des icones au format svg, sinon on transforme les png avec Autotracer
Les icones que j’ai choisies : *contact d’ouverture de porte et détecteur de présence*

|image261|

.. note::

   Pour les textes il suffit par exemple d’ajouter « tmp » qui sera en javascript remplacé par la température enregistrée par le dispositif

- **Importer l’icone**

|image262|

|image263|

|image264|

|image265|

- Redimensionner l’(les)objet(s) :

|image266|

Comme on peut le voir, avec les images svg le remplacement de couleur, de textes s’effectuent rapidement lors de la création ; il en est de même dans le HTML en utilisant javascript.
Ajouter un texte « temp » par exemple pour l’affichage de la température ; ce texte sera remplacé par la valeur de la température en utilisant Javascript; 

.. note::

   les détecteurs de présence peuvent souvent enregistrer la température.

|image267|

- Pour les dispositifs et les textes, ajouter un ID :

*Comme indiqué précédemment, Avec Inkscape, il est possible d’ajouter facilement un ID lors de la construction de l’image*

|image268|

- La couleur de l’objet :

*avec Inskcape*:

|image269|

*avec Adobe Illustrator*:

|image270|

Enregistrer le fichier, j’ai choisi « interieur.svg », le nom de ma page

Pour les textes c’est la même façon de procéder

|image272|

Aperçu d’une image avec de nombreux dispositifs

|image273|

2.2 Des exemples d’autres dispositifs
^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^
2.2.1 Ajout du détecteur de fumée :
===================================
Ajout de l’icône avec Inkscape :

|image274| |image275|

Un href, un id, un titre et un onclick avec un id (idm ou idx) ; option choisie dans /admin/config.php

.. code-block::

   define('CHOIXID','idm');// DZ:idm ou idx ; HA : idm uniquement

2.2.2 Ajout de caméras
======================
Comme il n’existe pas d’idx Domoticz pour les caméras , il n'y aura pas de confusion à utilser "idx" pour identifier les caméras; nous réserverons la plage >= 10 000 pour cela ; 

cette valeur peut être modifiée, voir :ref:`2.2.1 Ajout du détecteur de fumée :`

|image277|

*La base de données* :

|image02|

2.3 le fichier PHP de l’image
^^^^^^^^^^^^^^^^^^^^^^^^^^^^^
Avec Notepad, on supprime les premières lignes (Inkscape), comme indiqué au § :ref:`2.1.1.a avec Inkscape qui est gratuit` ou les 2 ou 3 premières lignes (AI) :

 |image279|

- Enregistrer l’image au format PHP dans le dossier /include:  interieur_svg.php (utilisé ici)

*le fichier PHP commence par <svg ....,  supprrimer la ligne <?xml version="1.0" encoding="utf-8"?>*

.. code-block::

   <svg
   version="1.1"
   id="Calque_1"

- Récupérer dans Domoticz les noms et les idx des dispositifs

|image280|

- Dans la table « dispositifs » de la base de données Maria DB Domoticz,

  enregistrer ces données ; si c’est une première installation de monitor, idm peut être le même qu’idx ; dans l’exemple ci-dessous idm est différent après une réinstallation de Domoticz.

|image281|

- Autres exemples :

|image282|

|image283|

- Que fait le script javascript qui gère les dispositifs :

|image284|

L’appel ajax : appelle la fonction PHP devices_plan($variable), la variable est le N° du Plan

.. code-block::

   if ($app=="devices_plan") {if (DECOUVERTE==true) {include('include/json_demo/devices_plan_json.php');return;}
   else {$retour=devices_plan($variable);echo json_encode($retour); }}

- La fonction PHP :darkblue:`devices_plan($variable)`:

|image286|

|image1178|

Le Json renvoyé :

|image287|

Monitor peut afficher un changement de couleur du dispositif, une température  mais à condition de retrouver l’ID du dispositif ou l’ID du texte dans le DOM.

C’est pourquoi nous avons ajouté des ID lors de la construction du plan.

Un aperçu du fichier interieur_svg.php :

|image288|

.. note::

   Pour une icône avec une seule couleur, l’ID de l’icône est suffisant mais avec une icône où une seule partie est colorée comme pour l’ouverture de porte, ii est facile, avec F12 d’inspecter la partie de 
   l’icône qui nous intéresse et de rajouter un ID dans le <path concerné

   C’est alors cet ID qu’il faudra entrer pour le dispositif dans la Base de données SQL.

   |image289|

Pour les textes, si l’ID n’a pas été spécifié à la construction de l’image, ils sont faciles à retrouver avec une recherche sur Notepad pour ajouter un ID ; 

Sur AI il faudra souvent modifier légèrement l’ID

 |image290|

2.3.1 Pour afficher le statut complet du dispositif
===================================================

|image291|

|image292|

|image293|

C’est la fonction javascript :darkblue:`popup_device` du fichier footer.php qui ouvre cette fenêtre.

.. admonition:: **Remarque**
   
   les caméras ne sont pas des dispositifs dans Domoticz, aussi des ID >= à 10000 leur sont attribués ; cette valeur peut être modifiée en modifiant le programme qui suit.

|image294|

Cette fonction est activée par un onclick que l’on ajoute dans l’image ; par contre la BD n’est pas nécessaire pour cet affichage, à condition que le onclick possède comme id l’idx de Domoticz.

.. code-block::

   id="temp_cuisine"
   onclick="popup_device(21)"
   inkscape:transform-center-x="-23.52"
   inkscape:transform-center-y="31.36"><tspan
     sodipodi:role="line"
     id="tspan4545-8"
     x="60.40955"
     y="281.74768">temp</tspan></text><g
   id="ouverture_porte_salon"
   transform="matrix(0.16425446,0,0,0.17058408,527.48825,763.57501)"
   onclick="popup_device(38)"><path
   ...

popup_device(:red:`21`) --> :red:`21` = idm

Avec Inkscape ce onclick peut être ajouter lors de la construction

|image296|

|image297|

avec AI il faut l’ajouter manuellement.

Pour indiquer que l’élément est cliquable, comme pour le HTML, on ajoute xlink:href="#interieur"  et une balise <a  (pour afficher la main ) non nécessaire surtout pour les tablettes.

|image298|

Ou lors de la construction avec Inkscape :

|image299|

2.3.2 Affichage des caméras
===========================
Pour les caméras génériques chinoises, pour les configurer : Internet explorer etait le seul navigateur qui permettait d’afficher Net Surveillance , Edge a pris la relève.

|image301|

La table « cameras » dans la base de données SQL a été remplie, voir le paragraphe concernant la base de données :  :ref:`0.3.3 caméras`

|image302|

**Seulement si Zoneminder est utilisé** :

.. admonition:: **Pour retrouver l’ID Zoneminder**

   pour toutes les cameras :

   Dans un navigateur : :darkblue:`IP DE ZONEMINDER`/zm/api/monitor.json

   |image303|

|image304|

Les icones, les onclick, les <a pour le lien (pour version PC) , ont été ajoutés sur le plan ; une fenêtre (modal) est ajoutée sur la page.
Voir les paragraphes   :ref:`2.2.2 Ajout de caméras`  et  :ref:`2.3.1 Pour afficher le statut complet du dispositif`

**La modale pour la fenêtre de l’image** :

|image305|

C’est la fonction PHP « :darkblue:`upload_img($idx)` » appelée par ajax qui renvoi l’image de la caméra

|image306|

Le script JS dans footer.php :

.. code-block::

	function popup_device(nom) {
	if (nom < 10000){if (pp[nom]){
	.....
	}
	else { // partie consacrée aux caméras
		$.ajax({
		type: "GET",
      url: 'ajax.php',
	   data: "app=upload_img&variable="+nom,
	   dataType: 'json',
      success: function(html) {
		urlimg=html['url']+"?"+Date.now()/1000;zoneminder=html['id_zm'];dahua=html['marque'];
		ip_cam=html['ip'];idx_cam=html['idx'];dahua_type=html['type'];console.log(dahua_type);
		if (nom<10010){//de 10000 à 10009: cam autour maison, >10009 : cam jardin garage 
        $('#cam').attr('src',urlimg); $('#camera').modal('show');} 
		  else {$('#cam_ext').attr('src',urlimg); $('#camera_ext').modal('show');} }
			});         
		} 
	}

**Affichage de la configuration des caméras**:

Pour les caméras Dahua, il existe un script spécifique ; pour les autres caméras, le script ne fonctionne que si Zoneminder est installé et la configuration effectuée :
Le fichier de configuration :darkblue:`admin/config.php` :

 |image308|

.. admonition:: **Configuration de Zoneminder**

   **accès aux données** : API 2.0 

   - le token :

        Dans options/système

        |image309|

   - Réponse avec opt_use_auth coché :

        |image310|

   - Réponse avec opt_use_auth décoché :

        |image311|

   *Ci-dessus c’est un exemple manuel, la demande se fera en PHP automatiquement*

L’affichage de cette config est géré par un script JS : :darkblue:`modalink` et non par une fenêtre modale qui est déjà ouverte pour l’image ; appel de ce script par le bouton dans la modale de l’image.

.. code-block::

   <!-- section intérieur start ---- fichier interieur.php-->
   <div id="interieur" >
	<div class="container">
	....
   ....
   <div class="modal" id="camera">
  <div class="modal-dialog" style="height:auto">
    <div class="modal-content">
      <div class="modal-header">
        <h3 class="modal-title">image camera</h3>
		   <button class="btn_cam">Config</button>

Plus d'infos sur modalink : https://github.com/dmhendricks/jquery-modallink

*Les script JS, dans footer.php et dans mes_js.js* :

**Dans footer.php** :

 |image313|

.. code-block::

   $(".btn_cam").click(function () {if (zoneminder==null && dahua=='generic'){alert("Zoneminder non installé");}
   else {$.modalLink.open("ajax.php?app=upload_conf_img&name="+dahua+"&command="+dahua_type+"&variable="+ip_cam+"&idx="+idx_cam+"&type="+zoneminder,{
   // options here
	  height: 400,
	  width: 400,
	  title:"configuration de la caméra",
	  showTitle:true,
	  showClose:true
   }); }
   });

**Dans mes_js.js** : 

.. code-block::

   (function ($) {
    $.modalLinkDefaults = {
            height: 600,
            width: 900,
            showTitle: true,
            showClose: true,
            overlayOpacity: 0.6,
            method: "GET", // GET, POST, REF, CLONE
            disableScroll: true,
            onHideScroll: function () { },
            onShowScroll: function () { }
    };

 |image316|

Le fichier ajax.php :appel function de la fonction :darkblue:`cam_config($marque,$type,$ip,$cam,$idzm)`, (dans fonctions.php)

Extrait de cette fonction

.. admonition:: **Pour caméras DAHUA**

    |image318|

   .. note::

      **Modification CURL pour les différents types d’Autorisation des caméras Dahua** 

      3.2Authentication
      The IP Camera supplies two authentication ways: basic authentication and digest authentication. Client can login through:
      http://<ip>/cgi-bin/global.login?userName=admin. The IP camera returns 401. Then the client inputs a username and password to authorize.
      For example:
      1. When basic authentication, the IP camera response:
      401 Unauthorized
      WWW-Authenticate: Basic realm=”XXXXXX”
      Then the client encode the username and password with base64, send the following request:
      Authorization: Basic VXZVXZ.
      2. When digest authentication, the IP camera response:
      WWW-Authenticate: Digest realm="DH_00408CA5EA04", nonce="000562fdY631973ef04f77a3ede7c1832ff48720ef95ad",
      stale=FALSE, qop="auth";
      The client calculates the digest using username, password, nonce, realm and URI with MD5, then send the following request:
      Authorization: Digest username="admin", realm="DH_00408CA5EA04", nc=00000001,cnonce="0a4f113b",qop="auth"
      nonce="000562fdY631973ef04f77a3ede7c1832ff48720ef95ad",uri="cgi-bin/global.login?userName=admin",
      response="65002de02df697e946b750590b44f8bf"

   https://github.com/mgrafr/monitor/raw/main/Dahua_doc/DAHUA_IPC_HTTP_API_V1.00x.pdf

   Dire à Curl d'accepter plusieurs méthodes comme ceci :

   .. code-block:: 

      curl_easy_setopt(curl, CURLOPT_HTTPAUTH, CURLAUTH_BASIC | CURLAUTH_DIGEST);

   |image319|

.. admonition:: **Pour caméras onvif autres** :

   |image320| 

   Comme le token peut être utile dans d’autres pages création d’une fonction pour cela :

   .. code-block::

      function token_zm(){
	if ($_SESSION['time_auth_zm']<=time() || ($_SESSION['auth_zm']=="")){
      $url=ZMURL.'/api/host/login.json';
      $post=[
      'user' => ZMUSER,
      'pass' => ZMPASS,
       ];
       $ckfile	= "cookies.txt";
      //$out=file_post_curl($url,$ckfile,$post);
      //solution batch   décocher les 2 lines suivantes et cocher celle ci-dessus
      $oot=' curl -XPOST -c cookies.txt -d "user='.ZMUSER.'&pass='.ZMPASS.'&stateful=1" '.$url;
      $out=exec($oot);
      //------------------
      $out = json_decode($out,true);//echo $out;
      $token = $out['access_token'];
      $_SESSION['time_auth_zm']=time()+TIMEAPI;
      $_SESSION['auth_zm']=$token;echo $token;
      }
      else {$token=$_SESSION['auth_zm'];}
      $zm_cle = array (
      'token' => $_SESSION['auth_zm']);
      $cle=json_encode($zm_cle);	
      file_put_contents('admin/token.json',$cle);
      return $token;
      }

2.3.3 La gestion des dispositifs à piles
========================================
Assurée par la fonction PHP :darkblue:`devices_plan()`, vue précédemment ; la variable dans la base de données SQL a aussi été décrite lors de la configuration minimale

*Table « dispositifs »* : **variables**

|image322| 

*Table « text_image »* 

|image323| 

La notification se fait :

- sur la page d'accueil 

|image332| 

.. code-block::

   <div class="aff_bat" ><img id="batterie" src="images/batterie_faible.svg" alt="batterie" /></div>

	css

.. code-block::

   /*aff batterie */
   .aff_bat{position: absolute;top: 810px;left: 120px;}
   #batterie{width: 30px;height: auto;}
   .cercle{animation-duration: .8s;animation-name: clignoter;
     animation-iteration-count: infinite;transition: none;}

- Sur les plans intérieur ou extérieur

.. admonition:: **IMPORTANT**

   par défaut la notification de piles faibles est affichée sur le plan intérieur (page interieur.php)

   pour l'afficher sur le plan extérieur (page exterieur.php , l'indiquer dans admin/config.php:

   .. code-block::
   
      define('NOTIFICATIONS_PILES','exterieur');// nom de la page default : interieur (sans extension .php)

   Si une nouvelle page est crée , il faut ajouter ces lignes de code dans la page:

   .. code-block::

      <div id="erreur_NOM_PAGE(SANS .PHP) ></div>
      <div id="reset_erreur_NOM_PAGE(SANS .PHP)" style="display:none"><svg version="1.1" id="reset_erreur" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="30px" y="30px" viewBox="0 0 16 16" xml:space="preserve">
      circle onclick="document.getElementById('reset_erreur_exterieur').style.display='none';document.getElementById('erreur_exterieur').innerHTML ='';"fill="#007DC6" cx="7.7" cy="7.9" r="7.7"/>
      <path class="st1" d="M8,3C5.2,3,3,5.2,3,8s2.2,5,5,5s5-2.2,5-5c0-0.7-0.2-1.4-0.5-2.1c-0.1-0.3,0-0.5,0.3-0.7c0.2-0.1,0.5,0,0.6,0.2 c1.4,3,0.1,6.6-2.9,8s-6.6,0.1-8-2.9s-0.1-6.6,2.9-8C6.3,2.2,7.1,2,8,2V3z"/>
      <path d="M8,4.5V0.5c0-0.1,0.1-0.2,0.3-0.2c0.1,0,0.1,0,0.2,0.1l2.4,2c0.1,0.1,0.1,0.3,0,0.4l-2.4,2c-0.1,0.1-0.3,0.1-0.4,0C8,4.6,8,4.5,8,4.5z"/></svg></div>
 
|image334| 

.. admonition:: **Pour une meilleure visualisation des dispositifs dont la pile est à remplacer**

   ajout d’un signe distinctif, un cercle clignotant :

   . sur les images des plans interieur et exterieur

   . sur l'image svg d'un dispositif s'il est séparé d'un plan (exemple de cercles, $  :ref:`2.1.1.b avec Adobe Illustrator`)

.. important::

   Pour annuler la notification, faire un RESET : |image62|

   Si les cercles clignotants ne sont pas utilisés, pour retrouver le nom du dispositif :

   |image49|

|image335| 

	voir le paragraphe :ref:`2.1.1.b avec Adobe Illustrator`

- par sms

effectué par Domoticz:

|image330| 

Le script dz : https://raw.githubusercontent.com/mgrafr/monitor/main/scripts_dz/lua/notification_variables.lua

.. admonition:: **Pour une meilleure compréhension de la gestion des piles**

   **Calcul du niveau des piles**

   |image326| 

   |image327| 

   |image328| 

   **Variables Domoticz** :

   |image329| 

   **l'image du plan**

   Un cercle visible selon l’état de la batterie est ajouté à l'image SVG du plan concerné  :

   |image336| 

   Il suffit d’ajouter en copier/coller des cercles à tous les dispositifs sur piles et d'en modifier le positionnement.

.. admonition:: **exemple pour un cercle**

   .. code-block::

      <ellipse style="fill-opacity: 1; fill: red;" class="cercle" id="cercle_23" cx="6" cy="6" rx="6" ry="6">
      <title id="temperaure-exterieure">cercle temp ext cuisine</title>
      </ellipse>

   l'image du code ci-dessus concernant un dispositif non inclu dans un plan.

   |image36|

*Les styles CSS*

|image337| 

   Les valeurs sont définies dans le fichier de configuration /admin/config.php :

   .. code-block::

      define('PILES', array( //id var domoticz, nom var domoticz, %1 (moyen), %2 (faible) de l'energie restante  
      '17',
      'alarme_bat',
      50,
      20
      ));

   **La fonction javascript : function maj_devices(plan)** :

   |image339| 

*l'annulation de la notification*

Effectuée par un onclick dans l'image svg (incluse dans interieur.php et exterieur.php):

Exemple pour interieur.php

.. code-block::

   <circle onclick="document.getElementById('reset_erreur_interieur').style.display='none';document.getElementById('erreur_interieur').innerHTML ='';" fill="#007DC6" cx="7.7" cy="7.9" r="7.7"/>

**Lors d'un clique sur l'image RESET** , le display (des <div du texte et de l'image 'reset') , passe à :red:`none`

2.3 4 Le contrôle de la tension d’alimentation
==============================================

 |image340| 

**Le fichier voltmetre_svg.php**

- Comme pour les dispositifs on télécharge une image svg ; 

- comme pour le plan, sur Inkscape ou AI on ajoute un texte (tmp ou autre) qui sera remplacé par la valeur de la tension.

- On enregistre cette image dans un fichier PHP (on supprime les lignes inutiles).

- On ajoute aussi un ID 

 |image341| 

**Le dispositif Domoticz** :

|image342| 

**La base de données SQL** :

|image343|

|image344|

Pour maj_js, au lieu de temp il est possible de remplacer le type par un autre texte ; pour cela il faut modifier le script JS

Le script JS dans le fichier footer.php, déjà vu précédemment :

|image345|

2.3 5 ajouter des lampes
========================
Voir un exemple dans le paragraphe :ref:`4.1.1 Ajouter des lampes`,  consacré à l’extérieur de la maison, les lampe de jardin

2.3 6 ajouter une prise
=======================
|image430|

Les prises sont commandées depuis le mur de commandes et la visualisation de la position (on off) est aussi visible sue le plan intérieur

**Extrait du script dans** :darkblue:`mur_inter.php`

|image461|

**L'image SVG enregistrées dans en PHP**

.. code-block::

   <svg version="1.1" id="sw11" width="70" height="70" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px"
	 viewBox="0 0 70 70">
   <a href="#murinter"	><path class="prise_bureau_imp" d="M33.7,5c-4.9,0.5-10.1,2.6-14.1,5.7c-1.5,1.2-3.8,3.5-5,5c-5.2,6.7-7.3,15.4-5.6,23.9
	c1.6,8,6.4,15,13.3,19.1c2.3,1.4,5.5,2.8,6.5,2.8c1.6,0,3-1.7,2.7-3.2c-0.2-1.3-0.8-1.8-2.6-2.5c-3.3-1.3-5.8-2.9-8.1-5.3
	c-3.4-3.4-5.4-7.2-6.4-11.8c-1.9-9.3,1.9-19,9.6-24.3c11.5-8,27.2-3.6,33.3,9.2C61.2,32,60,42,54,49c-2.6,3.1-7.2,5.9-9.6,5.9
	c-3,0-4.9-3.4-5.2-9.4l-0.1-1.7l1.2-0.2c1.9-0.4,3.3-1.1,4.7-2.6c0.9-0.9,1.3-1.5,1.7-2.3c0.9-1.8,0.9-2.3,0.9-7.9v-5H36.7H25.6
	v5c0,5.6,0,6.1,0.9,7.8c1.2,2.5,3.4,4.2,6.1,4.8l1.2,0.3l0.1,1.9c0.4,7.8,3.1,12.7,7.8,14.3c1.5,0.5,4,0.5,5.6,0.1
	c2.9-0.9,7.2-3.5,9.7-6.1c8.4-8.5,10.5-22.2,5.1-33.1C56.8,10.1,45.5,3.7,33.7,5z"/>
	<path class="st0" d="M30,16.4c-0.2,0.1-0.5,0.4-0.6,0.5c-0.1,0.2-0.1,1.5-0.1,3.7v3.4h2h2v-3.5c0-3.8,0-3.9-0.8-4.3
	C31.9,16,30.6,16.1,30,16.4z"/>
	<path class="st0" d="M40.8,16.4c-0.2,0.1-0.5,0.4-0.6,0.5c-0.1,0.2-0.1,1.5-0.1,3.7v3.4h2h2v-3.5c0-3.8,0-3.9-0.8-4.3C42.7,16,41.4,16.1,40.8,16.4z"/>
   <rect x="5" y="-0.2" class="st59" width="70" height="68"/>
	<text transform="matrix(0.8406 0 0 1 0 61.5324)" class="st50 st51a">Lampe Bureau</text></a>
   </svg>

|image462|

**Dans la BD SQL** :

|image463|

**Extrait de new_maison_svg.php** , image du plan intérieur:

|image470|

2.3.7 ajouter un capteur de T° extérieur Zigbee
===============================================

|image346|

2.3.7.1 Le capteur dans Domoticz
""""""""""""""""""""""""""""""""

|image347|

|image348|

*Dans le plan de Domoticz* :

|image349|

2.3.7.2 Le capteur dans la BD
=============================

|image350|

On a choisi de limiter le nb de caractère à 4, à l’origine : |image351|

2.3.7.3 Le capteur dans Monitor
===============================

**L’image** :

.. code-block::

   <svg version="1.1" id="th_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px"
	 viewBox="0 0 20 20" style="enable-background:new 0 0 20 20;" xml:space="preserve">
   <a xlink:href="#interieur" onclick="popup_device(23)"><path style="fill: #84bef1;" rel="23" d="M9,11.2V7h2v4.2c1.6,0.6,2.4,2.3,1.8,3.8c-0.6,1.6- 
  2.3,2.4-3.8,1.8S6.6,14.6,7.2,13C7.5,12.1,8.1,11.5,9,11.2z M8,10.5
	c-1.9,1.1-2.6,3.6-1.5,5.5s3.6,2.6,5.5,1.5c1.9-1.1,2.6-3.6,1.5-5.5c-0.4-0.6-0.9-1.1-1.5-1.5V4c0-1.1-0.9-2-2-2S8,2.9,8,4V10.5
	L8,10.5z M6,9.5V4c0-2.2,1.8-4,4-4s4,1.8,4,4v5.5c2.5,2.2,2.7,6,0.5,8.5c-1.1,1.3-2.8,2-4.5,2c-3.3,0-6-2.7-6-6
	C4,12.3,4.7,10.7,6,9.5z"/></a
   <text id="temp_ext_cuisine" transform="matrix(0.6725 0 0 1 7.4663 15.254)" class="st33 st36b">tmp</text>
   </svg>

|image352|

**Le fichier Json** 

|image353|

|image354|

2.4 le fichier PHP de la page 
^^^^^^^^^^^^^^^^^^^^^^^^^^^^^
Il faut maintenant ajouter la page sur le site 



.. list-table:: *Un modèle de page pour toutes les pages du site*
   :widths: 25 
   :header-rows: 1
  
   
   * - <!-- section TITRE start -->
    
   * - <!-- ================ -->
   * - <div id="ID DE LA PAGE" class="CLASS DE LA PAGE OPTIONNEL">
   * - <div class="container">
   * - <div class="col-md-12">
   * - 	 <h1 class="title_TITRE text-center"> exemple Prévisions<span>  météo</span></h1>
   * - 	 <div class="CLASS DU CONTENU" style="color:black;">
   * -     <div id="ID DE CETTE LIGNE" >LIGNE OPTIONNELLE</div>	
   * - 	   div id="CONTENU" class="table-responsive"></div>	
   * - 	   <div id="AUTRE CONTENU OPTIONNEL"></div>
   * -  </div></div></div></div>
   * - <!-- fin  de la section TITRE -->
		
En vert du contenu optionnel

|image355|
  
Sur cette page, des fenêtres(modal) peuvent être ajoutées si besoin, Bootstrap facilite la création ; sur la page décrite en suivant, 2 fenêtres sont ajoutées.

**Le menu** :
    
|image356|      

- **Le fichier include/interieur .php**

.. important::

   à partir de la version 4.0.0 l'image du plan peut être enregistrée dans le dossier custom/php; cette solution doit être privilégiée pour éviter des erreurs lors de la mise à jour de version.

   |image1879|

https://raw.githubusercontent.com/mgrafr/monitor/main/include/interieur.php

|image357|

Extrait du fichier index_loc.php : pour info, **en général ne pas modifier ce fichier** 

.. code-block::

   include ("include/accueil.php");// l' affichage page accueil
   if (ON_MET==true) include ("include/meteo.php");	// une page de prévision météo
   include ("include/interieur.php");// plan intérieur
   //ne pas modifier ce fichier 

Comme pour entete_html.php, header.php, accueil.php, config.php, interieur.php est chargée obligatoirement au démarrage de l'appli.

Extrait du fichier include/header.php :

.. code-block::

   <li class="zz active"><a href="#header">Accueil</a></li> 
   <?php if (ON_MET==true) echo '<li class="zz"><a href="#meteo">Météo</a></li>';?>
   <li class="zz"><a href="#interieur">Intérieur</a></li>

|image360|

**CSS** : css/mes_css.css

Le style existe déjà pour toutes les pages , pour les modifier :

.. code-block::

   #interieur, #exterieur,#alarmes,#commandes,#murcam ,#murinter,
      #app_diverses,#admin, #zigbee, #zwave, #dvr, #nagios,#spa,#recettes{
      background-color: aquamarine;}

|image362|

2.5 F12 des navigateurs pour faciliter la construction
^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^
Pour les PIR, les capteurs d’ouverture, pour le changement de couleur 

|image363|


2.6 Les dispositifs virtuels Domoticz et MQTT
^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^
Pour monitor ça n’a pas d’importance, il n’y a pas de notion « virtuel – réel » mais la mise à 
jour de ces dispositifs dans Domoticz n’est pas toujours facile surtout pour les dispositifs 
avec plusieurs valeurs tels que température+ Humidité température +batterie,...

**Un script dz : séparation_valeurs.lua**

https://raw.githubusercontent.com/mgrafr/monitor/main/scripts_dz/lua/s%C3%A9paration_valeurs.lua

.. code-block::

   local scriptVar = 'separation_valeurs'
   return 
   {
    on = { customEvents = { scriptVar, },
        httpResponses =   { scriptVar, },
    },
    logging =
    {  level = domoticz.LOG_DEBUG, -- LOG_ERROR 
       marker = scriptVar,
    },
    execute = function(dz, item)
        lodash = dz.utils._
        local function sendURL(idx, temperature,batteryLevel) --CAPTEURS TEMPERATURE: svalue=temp    battery= volts battery
        local url = dz.settings['Domoticz url'] .. '/json.htm?type=command&param=udevice&idx=' .. idx .. '&nvalue=0&svalue=' .. temperature .. '&battery=' .. batteryLevel;
        dz.openURL({   url = url,
                callback = scriptVar,})
        end
        local function sendURL1(idx, temperature,humidity,confort,batteryLevel) --CAPTEURS TEMPERATURE+HUMIDITE : svalue=temp;hum;Humidity_status   battery=volts battery
        local url = dz.settings['Domoticz url'] .. '/json.htm?type=command&param=udevice&idx=' .. idx .. '&nvalue=0&svalue=' .. temperature ..';'..  humidity ..';' .. confort .. '&battery=' .. batteryLevel;
        dz.openURL( { url = url,
                callback = scriptVar,})
        end
            if item.isCustomEvent then 
            mqtt = item.data;print ("q:" .. mqtt)
            mqtt = dz.utils.fromJSON(mqtt) 
            local batteryLevel = mqtt.batteryLevel
            local temperature = mqtt.temperature 
            local humidity = mqtt.humidity
            local humidity_status=tonumber(humidity);print ("q:" .. humidity_status)
                if (humidity_status<30) then confort = "2" ;
                elseif (humidity_status>39 and humidity_status<60) then confort = "1" ;
                elseif (humidity_status>59 and humidity_status<80) then confort = "0" ;
                elseif (humidity_status>79) then confort = "3";
                else confort = "3" 
                end
            local idx = mqtt.idx;
            local type=dz.devices(idx).deviceType;print("type" .. tostring(type) .. ' ,  humidity_status : ' .. tostring(confort));
            if (type=='Temp')  then sendURL(idx, temperature, batteryLevel);
            elseif (type=='Temp + Humidity') then sendURL1(idx, temperature, humidity, confort, batteryLevel);
            else print("pas de dispositif trouvé");
            end
        elseif not item.ok then
            dz.log('Problèm avec l\'envoi de la temperature ou  batteryLevel' .. lodash.str(item), dz.LOG_ERROR)
        else
            dz.log('All ok \n' .. lodash.str(item.data) .. '\n', dz.LOG_DEBUG) 
        end
    end
    }

**Depuis Domoticz 2021.1**

|image365|

.. |image36| image:: ../media/image36.webp
   :width: 350px 
.. |image49| image:: ../media/image49.webp
   :width: 400px 
.. |image62| image:: ../media/image62.webp
   :width: 80px 
.. |image222| image:: ../media/image222.webp
   :width: 480px 
.. |image223| image:: ../media/image223.webp
   :width: 445px 
.. |image224| image:: ../media/image224.webp
   :width: 521px 
.. |image225| image:: ../media/image225.webp
   :width: 700px 
.. |image226| image:: ../media/image226.webp
   :width: 433px 
.. |image227| image:: ../media/image227.webp
   :width: 451px 
.. |image228| image:: ../media/image228.webp
   :width: 350px 
.. |image229| image:: ../media/image229.webp
   :width: 491px 
.. |image230| image:: ../media/image230.webp
   :width: 580px 
.. |image231| image:: ../media/image231.webp
   :width: 608px 
.. |image232| image:: ../media/image232.webp
   :width: 596px 
.. |image233| image:: ../media/image233.webp
   :width: 565px 
.. |image234| image:: ../media/image234.webp
   :width: 650px 
.. |image235| image:: ../media/image235.webp
   :width: 491px 
.. |image236| image:: ../media/image236.webp
   :width: 319px 
.. |image237| image:: ../media/image237.webp
   :width: 660px 
.. |image238| image:: ../media/image238.webp
   :width: 478px 
.. |image239| image:: ../media/image239.webp
   :width: 211px 
.. |image240| image:: ../media/image240.webp
   :width: 531px 
.. |image241| image:: ../media/image241.webp
   :width: 517px 
.. |image242| image:: ../media/image242.webp
   :width: 566px 
.. |image243| image:: ../media/image243.webp
   :width: 521px 
.. |image244| image:: ../media/image244.webp
   :width: 542px 
.. |image245| image:: ../media/image245.webp
   :width: 435px 
.. |image246| image:: ../media/image246.webp
   :width: 601px 
.. |image247| image:: ../media/image247.webp
   :width: 537px 
.. |image248| image:: ../media/image248.webp
   :width: 700px 
.. |image250| image:: ../media/image250.webp
   :width: 568px
.. |image251| image:: ../media/image251.webp
   :width: 523px 
.. |image252| image:: ../media/image252.webp
   :width: 300px
.. |image253| image:: ../media/image253.webp
   :width: 531px 
.. |image254| image:: ../media/image254.webp
   :width: 632px 
.. |image255| image:: ../media/image255.webp
   :width: 480px 
.. |image258| image:: ../media/image258.webp
   :width: 700px 
.. |image260| image:: ../media/image260.webp
   :width: 239px 
.. |image261| image:: ../media/image261.webp
   :width: 171px 
.. |image262| image:: ../media/image262.webp
   :width: 300px 
.. |image263| image:: ../media/image263.webp
   :width: 700px 
.. |image264| image:: ../media/image264.webp
   :width: 514px 
.. |image265| image:: ../media/image265.webp
   :width: 503px 
.. |image266| image:: ../media/image266.webp
   :width: 294px 
.. |image267| image:: ../media/image267.webp
   :width: 492px 
.. |image268| image:: ../media/image268.webp
   :width: 545px 
.. |image269| image:: ../media/image269.webp
   :width: 700px 
.. |image270| image:: ../media/image270.webp
   :width: 579px 
.. |image272| image:: ../media/image272.webp
   :width: 504px 
.. |image273| image:: ../media/image273.webp
   :width: 500px 
.. |image274| image:: ../media/image274.webp
   :width: 190px 
.. |image275| image:: ../media/image275.webp
   :width: 300px 
.. |image277| image:: ../media/image277.webp
   :width: 665px 
.. |image02| image:: ../media/image02.webp
   :width: 602px 
.. |image279| image:: ../media/image277.webp
   :width: 595px 
.. |image280| image:: ../media/image280.webp
   :width: 700px 
.. |image281| image:: ../media/image281.webp
   :width: 700px 
.. |image282| image:: ../media/image282.webp
   :width: 700px 
.. |image283| image:: ../media/image283.webp
   :width: 601px 
.. |image284| image:: ../media/image284.webp
   :width: 700px 
.. |image286| image:: ../media/image286.webp
   :width: 700px 
.. |image287| image:: ../media/image287.webp
   :width: 362px 
.. |image288| image:: ../media/image288.webp
   :width: 700px 
.. |image289| image:: ../media/image289.webp
   :width: 597px 
.. |image290| image:: ../media/image290.webp
   :width: 643px 
.. |image291| image:: ../media/image291.webp
   :width: 406px 
.. |image292| image:: ../media/image292.webp
   :width: 301px 
.. |image293| image:: ../media/image293.webp
   :width: 299px 
.. |image294| image:: ../media/image294.webp
   :width: 531px 
.. |image296| image:: ../media/image296.webp
   :width: 426px 
.. |image297| image:: ../media/image297.webp
   :width: 393px 
.. |image298| image:: ../media/image298.webp
   :width: 650px 
.. |image299| image:: ../media/image299.webp
   :width: 700px 
.. |image301| image:: ../media/image301.webp
   :width: 641px 
.. |image302| image:: ../media/image302.webp
   :width: 700px 
.. |image303| image:: ../media/image303.webp
   :width: 391px 
.. |image304| image:: ../media/image304.webp
   :width: 516px 
.. |image305| image:: ../media/image305.webp
   :width: 605px 
.. |image306| image:: ../media/image306.webp
   :width: 561px 
.. |image307| image:: ../media/image307.webp
   :width: 700px 
.. |image308| image:: ../media/image308.webp
   :width: 596px 
.. |image309| image:: ../media/image309.webp
   :width: 650px 
.. |image310| image:: ../media/image310.webp
   :width: 629px 
.. |image311| image:: ../media/image311.webp
   :width: 700px 
.. |image313| image:: ../media/image313.webp
   :width: 700px 
.. |image316| image:: ../media/image316.webp
   :width: 470px 
.. |image318| image:: ../media/image318.webp
   :width: 502px 
.. |image319| image:: ../media/image319.webp
   :width: 583px 
.. |image320| image:: ../media/image320.webp
   :width: 650px 
.. |image322| image:: ../media/image322.webp
   :width: 507px 
.. |image323| image:: ../media/image323.webp
   :width: 605px 
.. |image326| image:: ../media/image326.webp
   :width: 650px 
.. |image327| image:: ../media/image327.webp
   :width: 408px 
.. |image328| image:: ../media/image328.webp
   :width: 522px 
.. |image329| image:: ../media/image329.webp
   :width: 700px 
.. |image330| image:: ../media/image330.webp
   :width: 700px 
.. |image332| image:: ../media/image332.webp
   :width: 178px 
.. |image334| image:: ../media/image334.webp
   :width: 559px 
.. |image335| image:: ../media/image335.webp
   :width: 379px 
.. |image336| image:: ../media/image336.webp
   :width: 605px 
.. |image337| image:: ../media/image337.webp
   :width: 363px 
.. |image339| image:: ../media/image339.webp
   :width: 650px 
.. |image340| image:: ../media/image340.webp
   :width: 527px 
.. |image341| image:: ../media/image341.webp
   :width: 700px
.. |image342| image:: ../media/image342.webp
   :width: 387px 
.. |image343| image:: ../media/image343.webp
   :width: 602px 
.. |image344| image:: ../media/image344.webp
   :width: 133px 
.. |image345| image:: ../media/image345.webp
   :width: 650px 
.. |image346| image:: ../media/image346.webp
   :width: 529px 
.. |image347| image:: ../media/image347.webp
   :width: 380px 
.. |image348| image:: ../media/image348.webp
   :width: 344px 
.. |image349| image:: ../media/image349.webp
   :width: 249px 
.. |image350| image:: ../media/image350.webp
   :width: 700px 
.. |image351| image:: ../media/image351.webp
   :width: 93px 
.. |image352| image:: ../media/image352.webp
   :width: 602px 
.. |image353| image:: ../media/image353.webp
   :width: 334px 
.. |image354| image:: ../media/image354.webp
   :width: 529px 
.. |image355| image:: ../media/image355.webp
   :width: 700px 
.. |image356| image:: ../media/image356.webp
   :width: 496px 
.. |image357| image:: ../media/image357.webp
   :width: 700px 
.. |image360| image:: ../media/image360.webp
   :width: 400px 
.. |image362| image:: ../media/image362.webp
   :width: 600px 
.. |image363| image:: ../media/image363.webp
   :width: 615px 
.. |image365| image:: ../media/image365.webp
   :width: 451px 
.. |image430| image:: ../media/image430.webp
   :width: 508px 
.. |image461| image:: ../media/image461.webp
   :width: 650px 
.. |image462| image:: ../media/image462.webp
   :width: 650px 
.. |image463| image:: ../media/image463.webp
   :width: 650px
.. |image470| image:: ../media/image470.webp
   :width: 700px 
.. |image1178| image:: ../media/image1178.webp
   :width: 548px 
.. |image1819| image:: ../img/image1819.webp
   :width: 700px 
.. |image1879| image:: ../img/image1879.webp
   :width: 700px 

