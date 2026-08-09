<?php
// Pollution
// https://www.atmo-nouvelleaquitaine.org/widget-mon-air/widget/commune/24454
// <div id="widget-needle" class="c-gauge-needle" style="transform: rotate(-52deg);"></div>  moyen
// https://www.atmo-nouvelleaquitaine.org/air-commune/SaintMartindeGurson/24454/indice-atmo?adresse=Saint-Martin-de-Gurson+(24610)&date=2026-08-06
// https://www.atmo-nouvelleaquitaine.org/air-commune/SaintMartindeGurson/24454/pollen?adresse=Saint-Martin-de-Gurson+(24610)
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
	"value" => "atmo:".$encode
         ];
mysql_app($data);
return $encode;
}
function pollen(){
	$pol = [
	'00'=> "Non disponible",
	'01' => "Très faible",
	'02' => "Faible",
	'03' => "Modéré",
	'04' => "Élevé",
	'05' => "Très Élevé",
	'06' => "Extrêmement élevé"
	];
$L="https://www.atmo-nouvelleaquitaine.org/air-commune/SaintMartindeGurson/24454/pollen?adresse=Saint-Martin-de-Gurson+(24610)";
$chaine=file_get_curl($L);
$rec='indice-pollen-main">';$rec1='pollens/';$rec2='_';
$resultat = explode($rec, $chaine);
$resultat =explode($rec1,$resultat[1]);
$resultat =explode($rec2,$resultat[1]);
$resultat =explode($rec2,$resultat[0]);
$encode=$pol[$resultat[0]];
$data = [
	"command" => 16,
	"nom_objet" => "pollen",
	"value" => 'pollen:'.$encode
         ];
mysql_app($data);
return $encode;
}
?>