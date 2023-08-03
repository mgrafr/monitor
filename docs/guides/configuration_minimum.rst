1._ Configuration minimum : la page d’accueil
---------------------------------------------

Permet d’afficher 
|-	La température extérieure, 
|-	Le jour (changement à 0H pour une tablette connectée en permanence), 
|-	La sortie des poubelles,
-	 La gestion de la fosse septique,
-	La surveillance de la pression de la chaudière 
-	Les anniversaires 
-	Rappel pour la prise de médicaments
-	 La prévision de pluie à 1 heure de Météo France
-	L’arrivée du courrier
-	La mise en service de l’alarme de nuit
-	Le remplacement des piles pour les capteurs concernés

 
 
Pour afficher cette page, les fichiers nécessaires en jaune 

1.1	– Configuration :/admin.config.php
^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^
Il faut fournir un minimum de renseignements :

1.1.1 -Adresse IP , domaine, favicon de monitor 
================================================ 
Pour faciliter la réinitialisation des dispositifs dans Domoticz ou un transfert (ex, zwavejs2mqtt , zigbee2mqtt sous docker) ; en créant une copie de la table dispositifs (« dispositifs » par défaut), il est possible de préparer le transfert ; ici la table dispositifs a été renommer Dispositifs
 
 
1.1.1.a _Pour l’image de fond suivant la résolution d’écran et le logo :
""""""""""""""""""""""""""""""""""""""""""""""""""""""""""""""""""""""""

// Monitor 
define('IMAGEACCUEIL', 'images/maison.webp');//image page accueil pour écrans >534 px
define('IMAGEACCUEILSMALL', 'images/maison_small.webp');//image page accueil pour écrans <535 px
define('IMGLOGO', 'images/logo.png');//image logo


 

Pour les titres, slogans et lexique 
Pour le lexique : 
-	true = lexique par défaut
-	false= lexique à modifier /include/lexique_no.php
define('NOMSITE', 'Domoticz');//nom principal du site
define('NOMSLOGAN', xxxxxxxxxxx);//nom secondaire ou slogan
// affichage lexique
define('LEXIQUE', true);

 
1.1.2 intervalles de maj, maj temps réel
========================================
L’intervalle de mise à jour pour les services (poubelles, anniversaires, …) : il est de ½ heure (1800000 milli secondes), il peut être changé
 
 
TEMPO_DEVICES pour tous les dispositifs 
TEMPO_DEVICES_DZ : pour les dispositifs qui mettent à 1 une variable pour indiquer à monitor d’effectuer une mise à jour, ici toutes les 30 secondes rafraichissement des dispositifs si par exemple un PIR, un contact de porte qui sont déclaré prioritaire dans DZ passent à ON 
 
La fonction JS :
 
La fonction PHP qui récupère la valeur de la variable :
 

1.1.3 Autres données
====================

Idx de Domoticz ou idm de monitor :
Pour une première installation choisir idx ; pour une réinstallation de Domoticz, il sera alors préférable de choisir idm pour éviter de renommer tous les dispositifs dans les images svg
La création d’un plan qui regroupe les dispositifs sur Domoticz est nécessaire : noter le N° du plan
 
Paramètres de la base de données :
 

Paramètres pour Domoticz :
 

Le programme démarre avec 11 pages :
-	Accueil
-	1 Plan intérieur
-	Page d’administration, pour afficher cette page, le mot de passe est obligatoire ; il est toujours possible de modifier le fichier de configuration avec un éditeur.
Par défaut « admin »
 
-	Les autres pages concernent l’alarme, un mur de caméras, 
