<?php
session_start();
/*fonctions pour la page ACCUEIL,INTERIEUR,METEO*/
require('admin/config.php');
// remplace file_get_contents qui ne fonctionne pas toujours
function file_get_curl($L){	
$curl = curl_init($L);
curl_setopt($curl, CURLOPT_TIMEOUT, 30);
curl_setopt($curl, CURLOPT_CONNECTTIMEOUT, 30);
curl_setopt($curl, CURLOPT_HEADER, 0);
curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
return curl_exec($curl);
}
/*utilisée pour lire les variables de domoticz
cette fonction permet egalement suivant le contenu de la variable de
determiner une image qui peut être afficher (poubelles,fosse septique,...*/
function status_variables($xx){
$L=URLDOMOTICZ."json.htm?type=command&param=getuservariables";
$json_string = file_get_curl($L);
$result = json_decode($json_string, true);
$n=0;$vardz=array();$txtimg=array();$t_maj="0";
while (isset($result['result'][$n]))
{
$lect_var = $result['result'][$n];  
$idx=$lect_var["idx"];
$value = $lect_var['Value'];
$name = $lect_var['Name'];
$type = $lect_var['Type'];
$vardz = sql_variable(0,$idx);if ($vardz==null){$exist_id="non" ;}
else {$exist_id="oui" ;}
$temp_maj=$vardz['temps_maj'];
if ($exist_id=="oui") {
if(($temp_maj>$t_maj) && ($value!="0")) {$t_maj=$temp_maj;}
$txtimg = sql_variable(1,$value);
$id_m_img = $vardz['id_m_img'];
if ($vardz['id_m_txt']!=null) {$id_m_txt = $vardz['id_m_txt'];}
else {$id_m_txt = $value;}}
if (isset($id_m_img) || isset($id_m_txt)){
$data[$n+1] = [	
		'idx' => $idx,
		'Type' => $type,
		'Name' => $name,
		'Value' => $value,
		'ID_img' => $id_m_img,
		'image' => $txtimg['image'],
		'icone' => $txtimg['icone'],
		'ID_txt' => $id_m_txt,
		'exist_id' => $exist_id
		];}
else {$data[$n] = [		
		'image' => "pas image ni texte"
			];}
$n++;}
$data[0] = [		
		'interval_maj' => $t_maj
];
 return $data;  
}
function maj_variable($idx,$name,$valeur,$type){
	$file=URLDOMOTICZ.'json.htm?type=command&param=updateuservariable&idx='.$idx.'&vname='.$name.'&vtype='.$type.'&vvalue='.$valeur;
   $result = file_get_curl($file);
$json = json_decode($result, true);
$resultat['status']=$json['status'];
$resultat['url']=$file;//pour test
return $resultat;
}
function sql_variable($ind=0,$t){
	$conn = new mysqli(SERVEUR,UTILISATEUR,MOTDEPASSE,DBASE);
	if ($ind==0){$sql="SELECT * FROM `variables_dz` WHERE id_dz ='".$t."' ;" ;}
	if ($ind==1){$sql="SELECT * FROM `text_image` WHERE texte ='".$t."' ;" ;}
	if ($ind==2){$sql="SELECT * FROM `variables_dz` ORDER BY `id_dz` DESC;" ;}
	$result = $conn->query($sql);
	$row_cnt = $result->num_rows;
	if ($row_cnt==0) {return  null;}
	else {$row = $result->fetch_assoc();
	return $row;}
	}
///fonctions utilisées pour les dispositifs		
function status_devices($device, $info,$info1)
{$L=URLDOMOTICZ."json.htm?type=devices&rid=".$device;
$json_string = file_get_curl($L);
 $parsed_json = json_decode($json_string, true);
$test_link = "test".$device.".txt";
$test_data = fopen ($test_link, "w+");
fwrite ($test_data, print_R($parsed_json, TRUE));
fclose ($test_data);
$parsed_json = $parsed_json['result'][0];
// info
$resultat=array();
$resultat[$info] = $parsed_json[$info];
if (isset($parsed_json[$info1])) $resultat[$info1]= $parsed_json[$info1] ;
return $resultat;
}
//------------------------------------------
function devices_plan($plan)
{$L=URLDOMOTICZ."json.htm?type=devices&plan=".$plan;
 $json_string = file_get_curl($L);
$parsed_json = json_decode($json_string, true);
$n=0;$al_bat=0;
while (isset($parsed_json['result'][$n])==true)
{
$lect_device = $parsed_json['result'][$n];  
$t=$lect_device["idx"];$periph=array();
$periph=sql_plan($t);$bat="";
if (CHOIXID=='idm') {$t=$periph['idm'];}
if(array_key_exists('Temp', $lect_device)==false) {$lect_device["Temp"]="non concerné";}
if(array_key_exists('Humidity', $lect_device)==false) {$lect_device["Humidity"]="non concerné";}
if(intval($lect_device["BatteryLevel"])<PILES[2]) {$bat="alarme";if ($al_bat==0) {$al_bat=1;} }
if(intval($lect_device["BatteryLevel"])<PILES[3]) {$bat="alarme_low";if ($al_bat<2) {$al_bat=2;} }
	$data[$t] = ['choixid' => CHOIXID,
	'idx' => $lect_device["idx"],
	 'temp' => $lect_device["Temp"],
	'hum'   => $lect_device["Humidity"],
'bat' => $lect_device["BatteryLevel"],
	 'ID' => $lect_device["ID"],
	'Data' => $lect_device["Data"],
	'Name' => $lect_device["Name"],
   	'Update' => $lect_device["LastUpdate"],
	'idm' => $periph['idm'],
	'materiel' => $periph['materiel'],
	'maj_js' => $periph['maj_js'],	
	'ID1' => $periph['id1_html'],
	'ID2' => $periph['id2_html'],
	'coul_ON' => $periph['coul_id1_id2_ON']	,
	'coul_OFF' => $periph['coul_id1_id2_OFF'],
	'class_lamp' => $periph['class_lamp'],
	'coullamp_ON' => $periph['coul_lamp_ON']	,
	'coullamp_OFF' => $periph['coul_lamp_OFF']	,
	'type_pass' => $periph['pass'],
	'alarm_bat' => $bat
	];
$n=$n+1;}
$data[0] = ['jour' => date('d'),
'idx' => '0'];
$abat="0";
if ($al_bat==0) $abat="batterie_forte";
if ($al_bat==1) $abat="batterie_moyenne";
if ($al_bat==2) $abat="batterie_faible";
maj_variable(PILES[0],PILES[1],$abat,2);
 return $data;
 }
function sql_plan($t){
// SERVEUR SQL connexion
$conn = new mysqli(SERVEUR,UTILISATEUR,MOTDEPASSE,DBASE);
 if ($t!=0) {
	$sql="SELECT * FROM `".DISPOSITIFS."` WHERE `idx` = ".$t ;
	$result = $conn->query($sql);
	$row = $result->fetch_assoc();return $row;}
else if ($t==0) {$commande="On";
	$sql="SELECT * FROM `".DISPOSITIFS."` WHERE `maj_js` LIKE '%onoff%' " ;
	$result = $conn->query($sql);//echo "/*";
	while($row = $result->fetch_array(MYSQLI_ASSOC)){
		if($row['id1_html']!=''){$s='$("#'.$row["id1_html"];}
		if($row['id2_html']!=''){$s=$s.',#'.$row['id2_html'];}
		if ($row['maj_js']=="onoff+stop") {$commande="Open";}
		$s=$s.'").click(function(){switchOnOff_setpoint("'.$row['idm'].'","'.$row['idx'].'","'.$commande.'","'.$row['pass'].'");});';
		echo $s."\r\n" ;}
	//echo "*/";
	return;}
else echo "pas d'id_dz";
}
/* fonction qui permet de switcher un interrupteur dans Domoticz 
et de modifier une température de consigne
*/
function switchOnOff_setpoint($idx,$valeur,$type,$level,$pass="0"){$auth=9;
// exemple : http://192.168.1.75:8082/json.htm?type=command&param=udevice&idx=84&nvalue=Off&svalue=2
//                                   /json.htm?type=command&param=switchlight&idx=99&switchcmd=Set%20Level&level=6
if ($pass=="0") {$auth=0;}
if ((($pass==NOM_PASS_CM)&&($_SESSION['passwordc']==PWDCOMMAND))&&($_SESSION['timec']>time())) {$auth=1;}
if (($pass==NOM_PASS_AL)&&($_SESSION['passworda']==PWDALARM)&&($_SESSION['time']>time())) {$auth=2;}
if ($auth<3){
	// $type=1 .....
	if ($type==1){$json1='udevice&idx='.$idx.'&nvalue='.$valeur.'&svalue='.$type;}
	// $type=2 .....ON/OFF
	if ($type==2){$json1='switchlight&idx='.$idx.'&switchcmd='.$valeur;}
	$json=URLDOMOTICZ.'json.htm?type=command&param='.$json1;
	// $type=3 Réglez une lumière dimmable/stores/sélecteur à un certain niveau
	if ($type==3){$json1='switchlight&idx='.$idx.'&switchcmd='.$valeur.'&level='.$level;}
	$json_string=file_get_curl($json);
	$result = json_decode($json_string, true);
	}
else {$result['status']="acces interdit";}
return $result;
												 }
/*POUR METEO CONCEPT*/
//-----------------------------------
function meteo_concept($choix){
	$donnees=array();
$donnees = [
	0 => "Soleil",
	1 => "Peu nuageux",
	2 => "Ciel voilé",
	3 => "Nuageux",
	4 => "Très nuageux",
	5 => "Couvert",
	6 => "Brouillard",
	7 => "Brouillard givrant",
	10 => "Pluie faible",
	11 => "Pluie modérée",
	12 => "Pluie forte",
	13 => "Pluie faible verglaçante",
	14 => "Pluie modérée verglaçante",
	15 => "Pluie forte verglaçante",
	16 => "Bruine",
	20 => "Neige faible",
	21 => "Neige modérée",
	22 => "Neige forte",
	30 => "Pluie et neige mêlées faibles",
	31 => "Pluie et neige mêlées modérées",
	32 => "Pluie et neige mêlées fortes",
	40 => "Averses de pluie locales et faibles",
	41 => "Averses de pluie locales",
	42 => "Averses locales et fortes",
	43 => "Averses de pluie faibles",
	44 => "Averses de pluie",
	45 => "Averses de pluie fortes",
	46 => "Averses de pluie faibles et fréquentes",
	47 => "Averses de pluie fréquentes",
	48 => "Averses de pluie fortes et fréquentes",
	60 => "Averses de neige localisées et faibles",
	61 => "Averses de neige localisées",
	62 => "Averses de neige localisées et fortes",
	63 => "Averses de neige faibles",
	64 => "Averses de neige",
	65 => "Averses de neige fortes",
	66 => "Averses de neige faibles et fréquentes",
	67 => "Averses de neige fréquentes",
	68 => "Averses de neige fortes et fréquentes",
	70 => "Averses de pluie et neige mêlées localisées et faibles",
	71 => "Averses de pluie et neige mêlées localisées",
	72 => "Averses de pluie et neige mêlées localisées et fortes",
	73 => "Averses de pluie et neige mêlées faibles",
	74 => "Averses de pluie et neige mêlées",
	75 => "Averses de pluie et neige mêlées fortes",
	76 => "Averses de pluie et neige mêlées faibles et nombreuses",
	77 => "Averses de pluie et neige mêlées fréquentes",
	78 => "Averses de pluie et neige mêlées fortes et fréquentes",
	100 => "Orages faibles et locaux",
	101 => "Orages locaux",
	102 => "Orages fort et locaux",
	103 => "Orages faibles",
	104 => "Orages",
	105 => "Orages forts",
	106 => "Orages faibles et fréquents",
	107 => "Orages fréquents",
	108 => "Orages forts et fréquents",
	120 => "Orages faibles et locaux de neige ou grésil",
	121 => "Orages locaux de neige ou grésil",
	122 => "Orages locaux de neige ou grésil",
	123 => "Orages faibles de neige ou grésil",
	124 => "Orages de neige ou grésil",
	125 => "Orages de neige ou grésil",
	126 => "Orages faibles et fréquents de neige ou grésil",
	127 => "Orages fréquents de neige ou grésil",
	128 => "Orages fréquents de neige ou grésil",
	130 => "Orages faibles et locaux de pluie et neige mêlées ou grésil",
	131 => "Orages locaux de pluie et neige mêlées ou grésil",
	132 => "Orages fort et locaux de pluie et neige mêlées ou grésil",
	133 => "Orages faibles de pluie et neige mêlées ou grésil",
	134 => "Orages de pluie et neige mêlées ou grésil",
	135 => "Orages forts de pluie et neige mêlées ou grésil",
	136 => "Orages faibles et fréquents de pluie et neige mêlées ou grésil",
	137 => "Orages fréquents de pluie et neige mêlées ou grésil",
	138 => "Orages forts et fréquents de pluie et neige mêlées ou grésil",
	140 => "Pluies orageuses",
	141 => "Pluie et neige mêlées à caractère orageux",
	142 => "Neige à caractère orageux",
	210 => "Pluie faible intermittente",
	211 => "Pluie modérée intermittente",
	212 => "Pluie forte intermittente",
	220 => "Neige faible intermittente",
	221 => "Neige modérée intermittente",
	222 => "Neige forte intermittente",
	230 => "Pluie et neige mêlées",
	231 => "Pluie et neige mêlées",
	232 => "Pluie et neige mêlées",
	235 => "Averses de grêle",
];
$img_donnees=array();
$img_donnees = [
	0 => "met_0.svg",
	1 => "met_1_1.svg",
	2 => "met_2_1.svg",
	3 => "met_3_1.svg",
	4 => "met_4_1.svg",
	5 => "met_5.svg",
	6 => "met_6.svg",
	10 => "met_10_1.svg",
	11 => "met07.9e2639ff.svg",
	12 => "met_8_1.svg",
	21 => "met_12_1.svg",
	30 => "met_22_1.svg",
	31 => "met_22.svg",
	40 => "met_14_1.svg",
	41 => "met_15_1.svg",
	43 => "met_14.svg",
	46 => "met_14.svg",
	44 => "met_15.svg",
	45 => "met_16.svg",
	47 => "met_15.svg",
	48 => "met_16.svg",
	70 => "met_23.svg",
	100 => "met_12.svg",
	101 => "met_12.svg",
	101 => "met_12.svg",
	103 => "met_11_1.svg",
	105 => "met_11.svg",
	210 => "met_6.svg",
	211 => "met_7_1.svg",
	212 => "met_8.svg",
	220 => "met_6.svg",
	
];
switch ($choix) {
    case 0:
$url1 = 'https://api.meteo-concept.com/api/forecast/daily/0/period/2?token='.TOKEN;
$prevam = file_get_curl($url1);
$forecastam = json_decode($prevam)->forecast;$info=$forecastam->weather;
if (isset($img_donnees[$info])){$imgtemps=$img_donnees[$info];}
else {$imgtemps="met_interdit_vert.svg";}
$resultat='<p>'.$info.'Le temps prévu pour cet après-midi  : '.$donnees[$info].'<img class="meteo_concept_am" src="images/'.$imgtemps.'" alt=""></p>';
break;
    case 1:		
$url = 'https://api.meteo-concept.com/api/forecast/daily?insee=24454';
$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, $url);
curl_setopt($ch, CURLOPT_HTTPHEADER, array('Accept: application/json','X-AUTH-TOKEN:2fce16877b45b86ba110ef2cdbf8d0e437563395f7a8ab2961919a7065ea2cd0'));
curl_setopt($ch, CURLOPT_HEADER, false);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
$data = curl_exec($ch);
if ($data !== false)
	$status = curl_getinfo($ch, CURLINFO_RESPONSE_CODE);
curl_close($ch);

if ($data !== false && $status === 200) {
	$decoded = json_decode($data);
	$city = $decoded->city;
	$forecasts = $decoded->forecast;
	$resultats=array();//return $forecasts;//pour essai affichage json --->voir ajax.php
	$i=0;
	while ($i < 14)
{
	$forecasts[$i]->dateprev = substr(($forecasts[$i]->datetime),0,-14);$forecasts[$i]->jour_sem=substr(convertdate($forecasts[$i]->dateprev),0,3);
$temps=$forecasts[$i]->weather;$forecasts[$i]->temps=$donnees[$temps];
if (isset($img_donnees[$temps])){$forecasts[$i]->imgtemps=$img_donnees[$temps];}
else {$forecasts[$i]->imgtemps="met_interdit_vert.svg";}
 $i++;}

$resultat= '<table class="table"><tr>';
$info=array();

for ($j=0; $j<=1; $j++)
	{if ($j==0){$x=0;}
		else {$x=7;}
for ($k=1; $k<=5; $k++)
	{	for ($m=0; $m<=6; $m++) 
					{	$i=$m+$x;
						if ($k==1){$info=substr(($forecasts[$i]->dateprev),8,2);$resultat=$resultat.'<td class="jdate">'.$forecasts[$i]->jour_sem.' '.$info.'</td>';}
						else if ($k==2) {$info=$forecasts[$i]->imgtemps;$resultat=$resultat.'<td><img onclick="alert(\''.$forecasts[$i]->temps.'\')" class="image_met" src="images/'.$info.'" alt=""></td>';}
						else if ($k==3) {$info=$forecasts[$i]->dirwind10m;$resultat=$resultat.'<td><img class="icone_vent" style="transform: rotate('.$info.'deg)" src="images/vent.svg" alt=""></td>';}
						else if ($k==4) {$info=$forecasts[$i]->wind10m;$resultat=$resultat.'<td><span class="vvent">'.$info.'kwh</span></td>';}
						else if ($k==5) {$info=$forecasts[$i]->tmin.'-'.$forecasts[$i]->tmax;$resultat=$resultat.'<td><span class="vtemp">'.$info.'°C</span></td>';}
					}
$resultat=$resultat."</tr>";	
	}}
	}	
$resultat=$resultat."</table>";
break;
}
return $resultat;


}
function convertdate ($date)
{
$joursem = array("Dimanche", "Lundi", "Mardi", "Mercredi", "Jeudi", "Vendredi", "Samedi");
// extraction des jour, mois, an de la date
list($annee, $mois, $jour) = explode('-', $date);
// calcul du timestamp
$timestamp = mktime (0, 0, 0, $mois, $jour, $annee);
// affichage du jour de la semaine
return $joursem[date("w",$timestamp)];
}

// --------------MOT de PASSE-----------------------------
function mdp($mdp,$page_pass){// 1=commandes , 2=alarmes
//if ($_SESSION["pec"]=="admin"){echo "azerty";$page_pass=3;}
switch	($page_pass) {
case "1":
if ($mdp==PWDCOMMAND) {$mp="OK";$_SESSION['passwordc']=$mdp;}
else {$mp="entrer le mot de passe";}		
break;
case "2":
if ($mdp==PWDALARM) {$mp="OK";$_SESSION['passworda']=$mdp;$_SESSION['time']=time()+TIME_PASS_AL;}
else {$mp="pasword non valide";}			
break;		
default:
$mp="erreur";
}
$info=[	
		'statut' => $mp
	];
return $info;}

//METEO FRANCE PLUIE previsions 1 heure
function app_met($choix){
$test ="pas de pluie"; $info=array();	
switch ($choix) {
    case "1"://----ce n' est plus du Json mais du HTML-----------------------------------------------------
		$url="https://www.lameteoagricole.net/meteo-heure-par-heure/Saint-Martin-de-Gurson-24610.html";
		$strResult = implode("",file($url));
		$maj = explode('<div class="fond2"',$strResult);$t=$maj[1];$maj = explode('Dernière',$t);$t=$maj[1];$maj = explode('</i>',$t);
		$tab = explode('width="63">',$strResult);
		$t=$tab[193];$ta= explode('<span style="color:#000000">',$t);$t=$ta[1];$ta= explode('</span>',$t);$pluiemm=$ta[0];
		$t=$tab[73];$ta = explode('</td>',$t);$date=$ta[0];
		$t=$tab[1];$ta = explode('</td>',$t);$jour=$ta[0];
		$t=$tab[241];$ta = explode('</td>',$t);$pourcent=$ta[0];// test_pluie
		$t=$tab[145];$ta = explode('<br /><i>',$t);$temp=$ta[0];
		 if ($pourcent=="0%"){$info['test_pluie']=$test;$im="pas_pluie";}
		 else {$im="pluie";}
		$info['titre']=$maj[0]; $txtimg = sql_variable(1,$im);$info['img_pluie']=$txtimg['image'];
		$info['maj']=$date;$info['jour']=$jour;$info['pourcent']=$pourcent;$info['temp']=$temp;$info['mm']=$pluiemm;
	break;
    case "2":		
		$url="https://rpcache-aa.meteofrance.com/internet2018client/2.0/nowcast/rain?lat=44.952602&lon=-0.107691&token=__Wj7dVSTjV9YGu1guveLyDq0g7S7TfTjaHBTPTpO0kj8__";
		$json_string = file_get_curl($url);$result = json_decode($json_string,true);
		$info['maj']=substr($result['update_time'],11,8);
		$json=$result['properties']['forecast'];
		$n=0;	
		while (isset($json[$n]['time']))
		{$info[$n]['rain_intensity']=$json[$n]['rain_intensity'];
		if ($json[$n]['rain_intensity'] >1) {$test="pluie";$id_test_pluie=$n;}
		 $info[$n]['time']=$json[$n]['time'];
		 $info[$n]['rain_intensity_description']=$json[$n]['rain_intensity_description'];
		$n++;
		}
		if ($test=="pas de pluie") {$info['test_pluie']=$test;$info['titre']=$json[0]['rain_intensity_description'];$im="pas_pluie";}
		else {$info['test_pluie']=$test;$info['titre']="prévision : ".$json[$id_test_pluie]['rain_intensity_description'];$im="pluie";}
		$txtimg = sql_variable(1,$im);$info['img_pluie']=$txtimg['image'];
		break;
	default:
	$info['test_pluie']="pas d'infos";
}
return $info;
}
//fonction affichage images caméras
function upload_img($idx){
	//$domaine=$_SESSION["domaine"];
	// SERVEUR SQL connexion
$conn = new mysqli(SERVEUR,UTILISATEUR,MOTDEPASSE,DBASE);
 	$sql="SELECT * FROM `cameras` WHERE `idx` = ".$idx ;
	$result = $conn->query($sql);
	$row_cnt = $result->num_rows;
	if ($row_cnt==0) {return "null";}
	$row = $result->fetch_assoc();
	$url=$row['url'];
		$fichier="images/".$idx.".jpg";$w=file_get_curl($url);
		file_put_contents($fichier,$w);
		$octet=filesize($fichier);
if (($octet==0) && ($idx==10011)) {
shell_exec("wget '".$url."' -O /www/monitor/images/".$idx.".jpg");}
		$lien_cam=$fichier;
	
	
$datacam = array (
'idx' => $row['idx'],
'url' => $lien_cam,
'id_zm' => $row['id_zm'],
'marque' => $row['marque'],
'type' => $row['type'],
'ip' => $row['ip']
);
	return $datacam;
}

// récupération token zoneminder
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


//Infos cameras
function cam_config($marque,$type,$ip,$cam,$idzm){
# ====================================================
# ==== Ne changez pas en dessous de cette ligne! =====
# ====================================================
if ($marque=='dahua'){$marque=1;echo 'caméra dahua: ';}
else {$marque=2;echo 'caméra onvif: ';}
echo $cam." ".$type."<br>";
if ($marque==1){$user=DHUSER;  # username
				$pass=DHPASS; # password
if ($type=="VTO"){$user="admin";  # VTO
$pass=DHPASSVTO;}	 			
echo 'user: '.$user.'  ';
	$action='GetVideoInOptionsConfig';
# ====== Spécifiez les points de terminaison ======

# configManager
$configGet="configManager.cgi?action=getConfig&name=";
$configSet="configManager.cgi?action=setConfig&name=";
$e['GetVideoColorConfig']     =$configGet."VideoColor";
$e['GetVideoInOptionsConfig'] =$configGet."VideoInOptions";
$e['GetEncodeConfig']         =$configGet."Encode";
$e['GetChannelTitleConfig']   =$configGet."ChannelTitle";
$e['GetVideoStandardConfig']  =$configGet."VideoStandard";
$e['GetVideoWidgetConfig']    =$configGet."VideoWidget";
$e['GetBasicConfig']          =$configGet."Network";
$e['GetPPPoEConfig']          =$configGet."PPPoE";
$e['GetDDNSConfig']           =$configGet."DDNS";
$e['GetEmailConfig']          =$configGet."Email";
$e['GetWlanConfig']           =$configGet."WLan";
$e['GetUPnPConfig']           =$configGet."UPnP";
$e['GetNTPConfig']            =$configGet."NTP";
$e['GetAlarmServerConfig']    =$configGet."AlarmServer";
$e['GetAlarmConfig']          =$configGet."Alarm";
$e['GetAlarmOutConfig']       =$configGet."AlarmOut";
$e['GetMotionDetectConfig']   =$configGet."MotionDetect";
$e['GetBlindDetectConfig' ]   =$configGet."BlindDetect";
$e['GetLossDetectConfig']     =$configGet."LossDetect";
$e['GetPTZConfig']            =$configGet."Ptz";
$e['GetRecordConfig']         =$configGet."Record";
$e['GetRecordModeConfig']     =$configGet."RecordMode";
$e['GetSnapConfig']           =$configGet."Snap";
$e['GetGeneralConfig']        =$configGet."General";
$e['GetLocalsConfig']         =$configGet."Locales";
$e['GetLanguageConfig']       =$configGet."Language";
$e['GetAccessFilterConfig']   =$configGet."AccessFilter";
$e['GetAutoMaintainConfig']   =$configGet."AutoMaintain";


# ====  Main =====

   if(isset($e[$action])){
     $url="http://".$ip."/cgi-bin/".$e[$action];
   }else{
      $message="<p>liste des types de config disponibles:</p>".
         "<pre>". print_r(array_keys($e), true). "</pre>";    
die($message);
   }

$options=build_options($url,$user,$pass);
# exécuter l'appel curl
$response=curl_call($options);
$response=str_replace("table.VideoInOptions[0].","",$response);


# quitter l'appel
if ($marque==1) echo "<pre>$response</pre>";
   

}
// cam autres que DAHUA infos avec zoneminder
else {
	// Récupérer jeton
$token = token_zm();
$ncam=$idzm;
$url=ZMURL.'/api/monitors/'.$ncam.'.json?token='.$token;
$out=file_get_curl($url); 
//-------solution batch----décocher les 2 lines suivantes et cocher celle ci-dessus
//$oot='curl '.$url;
//$out=exec($oot);
//-----------------------------
$json = json_decode($out, true);
$infcam = $json['monitor']['Monitor'];
//echo "token:".$token;
//echo $out['monitor'][0];
foreach($infcam as $key => $value){
	if ($key=="Path") $value="---mot passe caché----";
 echo $key.' : '.$value.'<br>';
        };
}
}
# ===== Functions ====
function build_options($url,$user,$pass){
  $options = array(
          CURLOPT_URL            => $url,
          CURLOPT_USERPWD        => $user . ":" . $pass,
          CURLOPT_RETURNTRANSFER => true,
  );
   $options[CURLOPT_HTTPAUTH]=CURLAUTH_DIGEST;
   return $options;
}
function curl_call($options){
  $ch = curl_init();
  curl_setopt_array( $ch, $options);

  try {
    $raw_response  = curl_exec( $ch );
    // validate CURL status
    if(curl_errno($ch)){
        throw new Exception(curl_error($ch), 500);
    }
    // validate HTTP status code (user/password credential issues)
    $status_code = curl_getinfo($ch, CURLINFO_HTTP_CODE);
	echo $status_code, $ip, $idx;
    if ($status_code != 200)
        throw new Exception("Response with Status Code [" . $status_code . "].", 500);
  } catch(Exception $ex) {
      throw new Exception($ex);
  } finally {
      curl_close($ch);
      return $raw_response;
  }
}
//curl avec POST
function file_post_curl($L,$ckfile,$post){	
$curl = curl_init($L);
curl_setopt($curl, CURLOPT_TIMEOUT, 30);
curl_setopt($curl, CURLOPT_CONNECTTIMEOUT, 30);
curl_setopt($curl, CURLOPT_POST, 1);
curl_setopt($curl, CURLOPT_POSTFIELDS,$post);
curl_setopt($curl, CURLOPT_COOKIEFILE, $ckfile);
curl_setopt($curl, CURLOPT_HEADER, 0);
curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
$retour=curl_exec($curl);
curl_setopt($curl,CURLOPT_POST,0);
return $retour;
}
//pour sauvegardes recuperation des variables domoticz et configuration
function admin($choix,$idrep){// idrep =ID affichage sauf pour 4 et 6 = contenu textarea
$height="490";$pawd=0;
if ($choix==9){$height="200";include ("include/test_db.php");$pawd=1;}
$time = time();
if (($_SESSION['passworda']==PWDALARM)&&($_SESSION['time']>time())) {$pawd=1;}
if ($pawd==1){
if (($choix==3) || ($choix==4)) {$file = VARTAB;$rel="4";}
if (($choix==10) || ($choix==11)) {$file = VARTAB;$rel="11";}
if (($choix==5) || ($choix==6)) {$file = MONCONFIG;$rel="6";}
if (($choix==7) || ($choix==8)) {$file = MONCONFIG;$rel="8";}
if (($choix!=4) && ($choix!=6) && ($choix!=8) && ($choix!=10) && ($choix!=11)) {echo '<p id="btclose"><img id="bouton_close" onclick="yajax('.$idrep.')"  
src="images/bouton-fermer.svg" style="width:30px;height:30px;"/></p>';}	
if ($choix==12 || $choix==13){echo "//*******création fichier noms/idx******* <br>";}

switch ($choix) {
    case "1":
$L=URLDOMOTICZ."json.htm?type=command&param=getuservariables";
$json_string = file_get_curl($L);
$result = json_decode($json_string, true);$n=0;
while (isset($result['result'][$n]))
{$lect_var = $result['result'][$n];  
$idx=$lect_var["idx"];
$value = $lect_var['Value'];
$name = $lect_var['Name'];
$type = $lect_var['Type'];
$data[$n] = [	
		'idx' => $idx,
		'Type' => $type,
		'Name' => $name,
		'Value' => $value,
			];
$n++;}	
$fp = fopen(FICVARDZ.'.json', 'w+'); fwrite($fp, json_encode($data)); fclose($fp);		
return;
break;
    case "2":
	$filename = FICVARDZ.'.json';
	$handle = fopen($filename, "r");
	$contents = fread($handle, filesize($filename));
	$result = json_decode($contents, true);$n=0;
	while (isset($result[$n]))
{$lect_var = $result[$n];  
$idx=$lect_var["idx"];
$value = $lect_var['Value'];
$name = $lect_var['Name'];
$type = $lect_var['Type'];
$L=URLDOMOTICZ."json.htm?type=command&param=adduservariable&vname=az".$name."vtype=".$type."&vvalue=".$value;
$data[$n] =[	
			'xxx' => $idx,Z];
$n++;}
return ;	
break;
case "3" :
case "5" :
case "7" :
echo $file.'<div id="result"><form >';
     $content = file_get_contents($file);
	 if($choix==3){ file_put_contents(DZCONFIG.'.bak.'.$time, $content);}	 
	 else {file_put_contents($file.'.bak.'.$time, $content);}
	 if($choix==7){$_SESSION["contenu"]=$content; $find="PWDALARM','";$tab = explode($find, $content);$tab=$tab[1];$tab = explode("'", $tab);$content=$tab[0];
		$_SESSION["mdpass"]=$find.$content;$height="30";}
	 echo '<textarea id="adm1" style="height:'.$height.'px;" name="command" >' . htmlspecialchars($content) . '</textarea><br>
	<input type="button" value="enregistrer" id="enr" onclick=\'wajax($("#adm1").val(),'.$rel.');\' /><input type="button" id="annuler" value="Annuler" onclick="yajax('.$idrep.')"> ';
	 echo '</form></div>';
return "sauvegarde OK";	 
break;
case "4" :$content=$idrep;
file_put_contents(DZCONFIG, $content);
// mise à jour par domoticz
$retour=maj_variable("22","upload","1","2");echo "variable Dz à jour : ".$retour['status'];
break;
case "6" :
 $content=$idrep;
 file_put_contents($file, $content);
 return;
 break;
case "8" :
$newpass=$idrep;$oldpass=$_SESSION["mdpass"];$content=$_SESSION["contenu"];
$str = str_replace($oldpass, "PWDALARM','".$newpass,$content);
file_put_contents($file, $str);echo '<div id="reload" style="display:block;"><a style="background-color: #605b5dde;color:white;
border-color: #e0e3e6;border-radius: 0.55rem" class="btn btn-primary"  onclick="location.reload();
return false;">
redemarrer 
</a></div>';//echo file_get_contents($file);
return ;	 
break;
case "9" : echo "<img src='images/serveur-sql.svg' style='width:25px;height:auto;' alt='dz'>";return; 
break;
case "10" : $content=sql_app(2,"cameras","modect",1,$icone='');file_put_contents(DZCONFIG.'.bak.'.$time, $content);echo '<textarea id="adm1" style="height:'.$height.'px;" name="command" >' . htmlspecialchars($content) . '</textarea><br>
	<input type="button" value="enregistrer" id="enr" onclick=\'wajax($("#adm1").val(),'.$rel.');\' /><input type="button" id="annuler" value="Annuler" onclick="yajax('.$idrep.')"> ';
	 echo '</form></div>';return "sauvegarde ".DZCONFIG."OK";	
case "11" :$content=$idrep;$height="100";echo '<p id="btclose"><img id="bouton_close" onclick="yajax(reponse1)" src="images/bouton-fermer.svg" style="width:30px;height:30px;"/></p>';
file_put_contents(DZCONFIG, $content);
// mise à jour par domoticz met à 2 upload
$retour=maj_variable("22","upload","2","2");echo  '<textarea id="adm1" style="height:'.$height.'px;" name="command" >variable Dz à jour : '.$retour["status"].'</textarea>'; return;
break;
case "12" : $retour=devices_plan(2) ;
foreach($retour  as $R=>$D){
  foreach($D as $key=>$Value){
		if ($key=="idx" ) echo "  ".$key." = ".$Value."   ";
		if ($key=="Name" ) echo "  ".$key." = ".$Value."<br>";}
}
echo "fin";return;
break;
case "13" : $retour=devices_plan(2) ;echo "var idx=[];<br>";
foreach($retour  as $R=>$D){
  foreach($D as $key=>$Value){
	
  	if ($key=="idx" ) $val_idx=$Value;	
	if ($key=="Name" )$val_name=$Value;
	if ($key=="materiel" )$val_mat=$Value;  } 
if ($val_mat=="zigbee" || $val_mat=="zigbee3") echo 'idx["'.$val_name.'"]="'.$val_idx.'";<br>';	
	}
echo "//********************";return;
break;
 default:
} }
else {	
 //echo '<script>document.getElementById(d_btn_a).style.display = "block";</script>
echo "Entrer votre mot de passe";return;}
return ;

}
//----------------------------graph-------------------
function graph($device,$periode){
require("include/export_tab_sqli.php") ;	
	if ($periode=="infos_bd"){	echo "liste : 20 dernieres valeurs<br>";
		for ($i=$number-20; $i<$number; $i++)
		{echo $xdate[$i]." = ".$yvaleur[$i]."<br>";}return;}
	else {
	require_once ('jpgraph/jpgraph.php');
	require_once ('jpgraph/jpgraph_line.php');
	require_once ("jpgraph/jpgraph_date.php");
// Convertion timestamp en heure
function TimeCallback($aVal) {
    return Date('Y-m-d H:i:s',$aVal);
}
// Mon tableau d'ordonnée contient mes valeurs en euros
$datay=$yvaleur;
 
// Mon tableau d'abscisse contient les timestamps de mes valeurs en euros
$datax=$xdate;
 // Création du graphique
$graph = new Graph(700,500);
$graph->SetMargin(40,70,30,70); 
$graph-> title->SetFont(FF_DV_SANSSERIF ,FS_BOLD);
$graph->title->Set('températures : '.$device);
 $graph->SetScale("datlin");
// Use hour:minute format for the labels
// Mise de x-axis avec un format php sql
// choix des parametres suivant echelle des dates
switch ($periode) {
    case "24":
 $graph->xaxis->SetTextLabelInterval(1);	
$graph->xaxis->scale->SetDateFormat('H');
 $graph->SetAxisLabelBackground(LABELBKG_YAXISFULL,'orange','red','lightblue','red');       
        break;
	case "48":
$graph->xaxis->scale->SetDateFormat('d  H');	
 $graph->xaxis->SetTextLabelInterval(2);     
        break;
	case "7":
 $graph->xaxis->scale->SetDateFormat('m d  H');	
 $graph->xaxis->SetTextLabelInterval(6);     
        break;
	case "31":
 $graph->xaxis->scale->SetDateFormat('m  d ');	
 $graph->xaxis->SetTextLabelInterval(12);           
        break;
case "365":
  $graph->xaxis->scale->SetDateFormat('m  d ');	
 $graph->xaxis->SetTextLabelInterval(150);    
        break;
default:
//graph->xaxis->scale->SetDateFormat('H');
}		
//----------------------------------------------
//$graph->xaxis->scale->SetDateFormat('H');		
// inclinaison texte x
$graph->xaxis->SetLabelAngle(60);
$graph->yaxis->title->Set("valeur en °" );
$graph->xaxis->title->Set("date" );	
//
$p1 = new LinePlot($datay,$datax);
$p1->SetColor("blue"); 
$p1->SetFillColor("blue@0.4");
$graph->Add($p1);
// Display the graph
$graph->Stroke("images/essai.jpg");
echo ' <!--  Display the graph  -->
<img src="images/essai.jpg?'.rand().'" class="graphique_img" >';
}
echo 'fin';	
}
//
function log_dz($log){
$L=URLDOMOTICZ."json.htm?type=command&param=getlog&laztlogtime=0&loglevel=".$log;
$json_string = file_get_curl($L);
$parsed_json = json_decode($json_string, true);
$parsed_json = $parsed_json['result'];
$n=0;
while ($parsed_json[$n]!="")
{
$lect_device = $parsed_json[$n];
$lect_device = str_replace('Status: EventSystem: ','',$lect_device);  
echo '<p style="font-size:smaller">'.$lect_device["message"].'</p>';
$n=$n+1;}
return ;
}
//nagios
function api_nagios($choix){$n=0;
$URL="http://".NAUSER.":".NAPASS."@".IPNAGIOS."/cgi-bin/objectjson.cgi?query=".$choix;   

$json_string = file_get_curl($URL);
$parsed_json = json_decode($json_string, true);
$json=$parsed_json['data'][$choix];
$n=0;
while ($json[$n]!=""){
$host=$json[$n];
$URL_cam=$URL="http://".NAUSER.":".NAPASS."@".IPNAGIOS."/cgi-bin/statusjson.cgi?query=host&hostname=".$json[$n];
$json_string = file_get_curl($URL_cam);
$parsed_json = json_decode($json_string, true);
$result=$parsed_json['data']['host'];
echo $host." : ".$result['plugin_output']."<br>";
 $n=$n+1; }
return ;  
}
function app_nagios($app){
$URL="http://nagiosadmin:Idem4546@192.168.1.8/nagios/map.php?host=all";
$a= file_get_curl($URL);
echo $a;
return ; 
}
function sql_app($choix,$table,$valeur,$date,$icone=''){
	// SERVEUR SQL connexion
$conn = new mysqli(SERVEUR,UTILISATEUR,MOTDEPASSE,DBASE);
if ($choix==0) {
$sql="INSERT INTO ".$table." (`num`, `date`, `valeur`, `icone`) 
VALUES (NULL, '".$date."', '".$valeur."', '".$icone."');";
$result = $conn->query($sql);	
;}
if ($choix==1) {
$sql="SELECT * FROM ".$table." ORDER BY num DESC LIMIT 24";
$result = $conn->query($sql);
$number = $result->num_rows;
while($row = $result->fetch_array(MYSQLI_ASSOC)){
		echo $row['date'].'  '.$row['valeur'].' <img style="width:30px;vertical-align:middle" src="'.$row['icone'].'"/><br>';
		}
}
if ($choix==2 || $choix==3) {// modect pour dz ----- 2,"cameras","modect",1,$icone=''
$sql="SELECT * FROM `cameras` WHERE `modect` = 1 ";
$result = $conn->query($sql);$i=0;
$number = $result->num_rows;if ($number>0) {
	$content="cam_modect = {";
while($row = $result->fetch_array(MYSQLI_ASSOC)){
		//$content = $cont.$row['id_zm'];
if ($choix==2){	$content = $content.'['.$row["id_zm"].']="'.$row['url'].'"';}
if ($choix==3){	$content = $content.$row["id_zm"];}
		$i++;if ($number>$i) {$content=$content.",";}
}
$content = $content."}";if ($choix==3) token_zm();
}
else echo "pas de cameras modect";
}
$conn->close();

return $content;}


?>
