<?php
header("Content-Type: text/event-stream");
header("Cache-Control: no-cache");
header('Connection: keep-alive');
header("Access-Control-Allow-Origin: *"); 
require_once('../fonctions.php');
ignore_user_abort(true); // Empêche PHP de vérifier la déconnexion de l'utilisateur
connection_aborted(); // Vérifie si l'utilisateur s'est déconnecté ou non
// en cas de reconnexion du client, il enverra Last_Event_ID dans les en-têtes
// ceci n'est évalué que lors de la première requête et de la reconnexion ultérieure du client
$lastEventId = floatval(isset($_SERVER["HTTP_LAST_EVENT_ID"]) ? $_SERVER["HTTP_LAST_EVENT_ID"] : 0);
        if ($lastEventId == 0) {
            $lastEventId = floatval(isset($_GET["lastEventId"]) ? $_GET["lastEventId"] : false);
        }
// conserve également notre propre dernier identifiant pour les mises à jour normales mais favorise last_event_id s'il existe
// puisqu'à chaque reconnexion, cette valeur sera perdue

// Get the current time on server
date_default_timezone_set('Europe/Paris');
$currentTime = date("H:i:s", time());
$event= 'message';

if(connection_aborted()){
exit();}
// importation des données si il en existent de nouvelles
$donnees=[
   'command'=> '5',
   'id' => "",
   'state' => ""
    ];
$retour=mysql_app($donnees);$d = array("heure"=>$currentTime, "id"=>$retour['id'], "state"=>$retour['state']);


$id=$retour['id'];
                if($id !="" ){
                    echo "event: " . $event . "\n";
                    echo "data: ".json_encode($d)." \n\n";
                    ob_flush();
                    flush();
$donnees1=[
   'command'=> '4',
   'id' => "",
   'state' => ""
    ];mysql_app($donnees1);
}
else 
           
            //sleep(2);
        
		   

?>






