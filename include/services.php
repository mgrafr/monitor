<?php
// ajout fonctions PHP concernant les services
function atmo(){
$L="https://www.atmo-nouvelleaquitaine.org/widget-mon-air/widget/commune/24454";
$chaine=file_get_curl($L);
$rec='<p class="text-center">';$rec1="</p>";
$resultat = explode($rec, $chaine);
$resultat =explode($rec1,$resultat[1]);
$encode=$resultat[0];
$data = [
	"command" => 16,
	"nom_objet" => "atmo",
	"value" => "atmo_".$encode
         ];
mysql_app($data);
return $encode;
}

?>