<?php
session_start();
/*fonctions pour la page ACCUEIL,INTERIEUR,METEO*/
$config=$_SESSION["config"];
require_once($config);
$L0=array();
if (DOMOTIC!=""){$L0[0]=DOMOTIC;$L0[1]=URLDOMOTIC;$L0[2]=IPDOMOTIC;$L0[3]=USERDOMOTIC;$L0[4]=PWDDOMOTIC;$L0[5]=TOKEN_DOMOTIC;$L0[6]=PORT_API_DOMO;$L0[7]=PORT_WEBUI_DOMO;}
if (DOMOTIC1!=""){$L0[8]=DOMOTIC1;$L0[9]=URLDOMOTIC1;$L0[10]=IPDOMOTIC1;$L0[11]=USERDOMOTIC1;$L0[12]=PWDDOMOTIC1;$L0[13]=TOKEN_DOMOTIC1;$L0[14]=PORT_API_DOMO1;$L0[15]=PORT_WEBUI_DOMO1;}
if (DOMOTIC2!=""){$L0[16]=DOMOTIC2;$L0[17]=URLDOMOTIC2;$L0[18]=IPDOMOTIC2;$L0[19]=USERDOMOTIC2;$L0[20]=PWDDOMOTIC2;$L0[21]=TOKEN_DOMOTIC2;$L0[22]=PORT_API_DOMO2;$L0[23]=PORT_WEBUI_DOMO2;}
$cle=array_search('DZ',$L0);if ($cle!==false) {$l_dz=$L0[$cle];$L_dz=$L0[$cle+1];$IP_dz=$L0[$cle+2];$USER_dz=$L0[$cle+3];$PWD_dz=$L0[$cle+4];$Token_dz=$L0[$cle+5];$port_api_dz=$L0[$cle+6];$port_webui_dz=$L0[$cle+7];}
$cle=array_search('HA',$L0);if ($cle!==false) {$l_ha=$L0[$cle];$L_ha=$L0[$cle+1];$IP_ha=$L0[$cle+2];$USER_ha=$L0[$cle+3];$PWD_ha=$L0[$cle+4];$Token_ha=$L0[$cle+5];$port_api_ha=$L0[$cle+6];$port_webui_ha=$L0[$cle+7];}
$cle=array_search('IOB',$L0);if ($cle!==false) {$l_iob=$L0[$cle];$L_iob=$L0[$cle+1];$IP_iob=$L0[$cle+2];$USER_iob=$L0[$cle+3];$PWD_iob=$L0[$cle+4];$Token_iob=$L0[$cle+5];$port_api_iob=$L0[$cle+6];$port_webui_iob=$L0[$cle+7];}		
include ("include/fonctions_1.php");//fonction sql_plan
//
function send_api_put_request($url, $parameters, $data) {
  // Add parameters to URL
  $url_parameters = "http_build_query($parameters)";
  $url .= '?' . $url_parameters;
  // Make request via cURL.
  $curl = curl_init();
  curl_setopt($curl, CURLOPT_URL, $url);

  // Handle authentication (you would need to implement this)
  //_api_authentication($curl);

  // Set options necessary for request.
  curl_setopt($curl, CURLOPT_RETURNTRANSFER, TRUE);
  curl_setopt($curl, CURLOPT_CUSTOMREQUEST, 'PUT');
  curl_setopt($curl, CURLOPT_HTTPHEADER, array('Content-Type: application/json', 'Content-Length: ' . strlen($data)));
  curl_setopt($curl, CURLOPT_CONNECTTIMEOUT, 10);

  curl_setopt($curl, CURLOPT_POSTFIELDS, $data);

  // Send request
  $response = curl_exec($curl);

  return array(
    'code' => curl_getinfo($curl, CURLINFO_HTTP_CODE),
    'data' => $response,
  );
}



//
function file_http_curl($L,$mode,$post,$token){  
/* set the content type json */
    $headers = [];
    $headers[] = 'Content-Type:application/json';
    //$token =TOKEN_DOMOTIC1; 
	$headers[] = 'Authorization: Bearer '.$token ;	
	
$ch = curl_init($L);	
curl_setopt($ch, CURLOPT_HTTPHEADER, $headers   );
if ($mode==1) {curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'GET');}
if ($mode==2) {curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'POST');}

curl_setopt($ch, CURLOPT_POSTFIELDS,$post); 	
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
//curl_setopt($ch, CURLOPT_POSTFIELDS,$post);
curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
$result = curl_exec($ch);
curl_close($ch);
return $result;
	
}
// remplace file_get_contents qui ne fonctionne pas toujours
function file_get_curl($L){	
$curl = curl_init($L);
curl_setopt($curl, CURLOPT_TIMEOUT, 30);
curl_setopt($curl, CURLOPT_CONNECTTIMEOUT, 30);
//curl_setopt($curl, CURLOPT_HEADER, 0);
curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($curl, CURLOPT_HTTPHEADER, array(
	 'accept: application/json',
  'authorization: Basic bWljaGVsOklkZW00NTQ2'
));
$retour=curl_exec($curl);
curl_close($curl);
return $retour;
}
// valeur d'une variable DZ
function val_variable($variable){$value2=0;global $L_dz;
$result=array();$lect_stat_msg=array();$m=0;
$L=$L_dz."json.htm?type=command&param=getuservariable&idx=".$variable;
$json_string = file_get_curl($L);
$result = json_decode($json_string, true);
$lect_var = $result['result'][0];
$value1 = $lect_var['Value'];
$lect_stat_msg=sql_variable($m,4);
while ($lect_stat_msg[$m]!=""	){
if ($lect_stat_msg[$m]['maj']==1) {$value2=$lect_stat_msg[$m]['Name'];break; };
$m++;}	
$msg=[
	'var_dz' => $value1,
	'message' => $value2
];								 
return $msg;
}
/*utilisée pour lire les variables de domoticz
cette fonction permet egalement suivant le contenu de la variable de
determiner une image qui peut être afficher (poubelles,fosse septique,...*/
function status_variables($xx){global $l_dz,$L_dz,$L_ha,$l_ha,$token_ha;
$p=0;$n=0;$L0=array();
if($l_dz != ""){
$L=$L_dz."json.htm?type=command&param=getuservariables";
$json_string = file_get_curl($L);
$resultat = json_decode($json_string, true);
$result=$resultat['result'];
$p=count($result);
}
if($l_ha != ""){
$M=$L_ha."api/states/sensor.liste_var";
$n=0;$mode=1;$post="";		
 $json_string1=file_http_curl($M,$mode,$post,$token_ha);
$parsed_json1 = json_decode($json_string1, true);//return $parsed_json1;
$json_string1 = $parsed_json1['state'];
$json_string1=str_replace("\n","",$json_string1);	
$json_string1=explode(',',$json_string1);
	while ($json_string1[$n]!=""	){
		$varha=explode('=',$json_string1[$n]);
		$varha[0]=str_replace(" ", "",$varha[0]);		
	    $ha=[
		'ID' => $varha[0],
		'Value'=> $varha[1],
		'Type'=> 'HA',
	];
	$result[$p]=$ha;
	$n++;$p++;}
  }
if (API=="true"){
$lect_msg=sql_variable($p,4);//return $lect_msg;
while ($lect_msg[$p]!=""	){
$result[$p]=$lect_msg[$p];
	$p++;	} 
}
//--------------	
$n=0;$vardz=array();$txtimg=array();$t_maj="0";$j=0;
while (isset($result[$n])) 
{
$lect_var = $result[$n];  
$idx = isset($lect_var["idx"]) ? $lect_var["idx"] : '';
$ID = isset($lect_var["ID"]) ? $lect_var["ID"] : '';
//$name = isset($lect_var["Name"]) ? $lect_var["Name"] : '';			
$value = $lect_var['Value'];$content="";
	if (str_contains($value, '#')) {$tab = explode("#", $value);
	$value = $tab[0];$content=$tab[1];}
if ($value=="msg") {$content=$result[$n]['contenu'];
$id_m_txt = $result[$n]['ID_txt'];$id_m_img="";}
 else {	
$type = $lect_var['Type'];
if ($type=="HA") {$a='ID';$vardz = sql_variable($$a,3);}
else {$a='idx';$vardz = sql_variable($$a,0);}
if ($vardz!=null){$name=$vardz['nom_objet'];$actif=$vardz['Actif'];$idm=$vardz['idm'];$num=$vardz['num'];$id_m_txt=$vardz['id2_html'];$id_m_img=$vardz['id1_html'];} 
else {$name="";$actif=$vardz;$num="num".$n;}
$exist_id="oui";	 
if ($actif=="2" & $type=="HA") {break;}
if ($actif=="3" & (int)$type<5) {break;}	 
 // 0 = Integer, e.g. -1, 1, 0, 2, 10  
// 1 = Float, e.g. -1.1, 1.2, 3.1
// 2 = String e.g. On, Off, Hello
// 3 = Date in format DD/MM/YYYY
// 4 = Time in 24 hr format HH:MM	 
$txtimg = sql_variable($value,1);
	$image = isset($txtimg['image']) ? $txtimg['image'] : '';
	$icone = isset($txtimg['icone']) ? $txtimg['icone'] : '';
 }
if ($id_m_img=="#" || $id_m_img=="" || $image=="none" || $image=="") {$image="pas image";$id_m_img=="";}
if ($name!=""){$j=$j+1;
$data[$j] = [	
		'idx' => $idx,
	    'idm' => $idm,
		'ID' => $ID,
		'Type' => $type,
	    'actif' => $actif,
		'Name' => $name,
		'Value' => $value,
		'contenu' => $content,
		'ID_img' => $id_m_img,
		'image' => $image,
		'icone' => $icone,
		'ID_txt' => $id_m_txt,
		'exist_id' => $exist_id
		];}
$n++;}	
$data[0] = [		
		'interval_maj' => $t_maj
];

 return $data;  
}
function maj_variable($idx,$name,$valeur,$type){global $L_dz; 
	$file=$L_dz.'json.htm?type=command&param=updateuservariable&idx='.$idx.'&vname='.$name.'&vtype='.$type.'&vvalue='.$valeur;
   $result = file_get_curl($file);
$json = json_decode($result, true);
$resultat['status']=$json['status'];
//$resultat['url']=$file;//pour test
return $resultat;
}
function sql_variable($t,$ind){
	if ($_SESSION["exeption_db"]=="pas de connexion à la BD") return ;
	$conn = new mysqli(SERVEUR,UTILISATEUR,MOTDEPASSE,DBASE);
	if ($ind==0){$sql="SELECT * FROM `dispositifs` WHERE (idx='".$t."' AND maj_js='variable') ;" ;}
	if ($ind==3){$sql="SELECT * FROM `dispositifs` WHERE (ID='".$t."' AND maj_js='variable') ;" ;}
	if ($ind==2){$sql="SELECT * FROM `dispositifs` WHERE maj_js='variable';" ;}
	//if ($ind==0){$sql="SELECT * FROM `variables` WHERE id_var='".$t."' ;" ;}
	if ($ind==1){$sql="SELECT * FROM `text_image` WHERE texte ='".$t."' ;" ;}
	if ($ind==4){$sql="SELECT * FROM `messages` ;" ;}
	if ($ind==5){$sql="SELECT * FROM `dispositifs` WHERE idm!='';" ;}
	if ($ind==6){$sql="SELECT * FROM `dispositifs` WHERE (nom_objet='".$t."' AND maj_js='variable');" ;}
	$result = $conn->query($sql);
	$row_cnt = $result->num_rows;
	if ($row_cnt==0) {return  null;}
	if 	($ind==2) {$n=0;
		while ($ligne = $result->fetch_assoc()) {
			$retour[$n]['num'] = $ligne['num'];
			$retour[$n]['idm'] = $ligne['idm'];
			$retour[$n]['idx'] = $ligne['idx'];
			$retour[$n]['ID'] = $ligne['ID'];
			$retour[$n]['nom_objet'] = $ligne['nom_objet'];
			$retour[$n]['id_img'] = $ligne['id1_html'];
			$retour[$n]['id_txt'] = $ligne['id2_html'];
			$n++;
		}return $retour;}
	if 	($ind==4) {//$n=1;
		while ($ligne = $result->fetch_assoc()) {
			$retour[$t]['Name'] = $ligne['nom'];
			$retour[$t]['ID_txt'] = $ligne['id1_html'];
			$retour[$t]['contenu'] = $ligne['contenu'];
			$retour[$t]['maj'] = $ligne['maj'];
			$retour[$t]['Value'] = "msg";
			$t++;
		}return $retour;}
	if 	($ind==5){ $i=0;
		while ($ligne = $result->fetch_assoc()) {$retour[$i]=new stdClass;
			
				if ($ligne['idx']!="" && $ligne['ID']=="") {$retour[$i]->id = $ligne['idx'];$retour[$i]->idm = $ligne['idm'];}
				elseif ($ligne['ID']!="" && $ligne['idx']=="") {$retour[$i]->id = $ligne['ID'];$retour[$i]->idm = $ligne['idm'];}
				elseif ($ligne['ID']!="" && $ligne['idx']!="" && $ligne['Actif']==2) {$retour[$i]->id = $ligne['idx'];$retour[$i]->idm = $ligne['idm'];}
				elseif ($ligne['ID']!="" && $ligne['idx']!="" && ($ligne['Actif']==3 || $ligne['Actif']==4)) {$retour[$i]->id = $ligne['ID'];$retour[$i]->idm = $ligne['idm'];}
				else {$retour[$i]->id = "err";$retour[$i]->idm = $ligne['idm'];}																 
			$i++;}
	return $retour;}
	if 	($ind==6) {//$n=1;
		$ligne = $result->fetch_assoc();
			$retour['Name'] = $ligne['nom_objet'];
			$retour['ID'] = $ligne['ID'];
			$retour['idx'] = $ligne['idx'];
			$retour['Actif'] = $ligne['Actif'];
			return $retour;}
	
	else {$row = $result->fetch_assoc();
		return $row;}
	}

//----POUR HA--------------------------------------
function devices_zone($zone){global $L_ha,$Token_ha; 
$mode=1;$L=$L_ha."api/states";$post="";
$json_string=file_http_curl($L,$mode,$post,$Token_ha);$n=0;$ha=array();//echo $json_string;
$lect_device = json_decode($json_string);
foreach ($lect_device as $xxx){
	if(isset($xxx->{'Name'}))  $ha[$n]['Name']="";
	if(!isset($xxx->{'BatteryLevel'}))  $ha[$n]['Bat']="";
	else $ha[$n]['Bat']=$xxx->{'BatteryLevel'};
	if(isset($xxx->{'attributes'}))  $ha[$n]['attributes']=$xxx;
	//if(isset($xxx->{'attributes'}->{'nodeName'}))  $ha[$n]['Name']=$xxx;
	if(isset($xxx->{'attributes'}->{'friendly_name'}))  $ha[$n]['Name']=$xxx->{'attributes'}->{'friendly_name'};
	else $ha[$n]['Name']="inconnu";
	$ha[$n]['Description'] = "HA";//$ha[$n]['idx'] =  $xxx->{'entity_id'};
	$ha[$n]['ID'] = $xxx->{'entity_id'};
	$ha[$n]['Data'] = $xxx->{'state'};//modif 1
	$ha[$n]['LastUpdate']  = substr($xxx->{'last_updated'},0, 19);  
	if(isset($xxx->{'attributes'}->{'unit_of_measurement'})) $ha[$n]['unite'] = $xxx;
	else $ha[$n]['unite'] ="";
	if(isset($xxx->{'attributes'}->{'node_Location'})) $ha[$n]['Description'] = $xxx;
	else $ha[$n]['Description'] ="";
	if(isset($xxx->{'attributes'}->{'value'})) {$ha[$n]['value'] = $xxx;}//$ha[$n]['Data'] = $tmp;}//modif 1
	else $ha[$n]['value'] = "";
	if(isset($xxx->{'attributes'}->{'temperature'}))$ha[$n]['temp'] = $xxx;
	else $ha[$n]['temp'] ="";
	if(isset($xxx->{'attributes'}->{'humidity'})) $ha[$n]['humidity'] = $xxx;
	else $ha[$n]['humidity'] ="";
	if(isset($xxx->{'attributes'}->{'pressure'})) $ha[$n]['pression'] = $xxx;
	//if(isset($xxx->{'attributes'}->{'forecast'}->{'friendly_name'})) $ha[$n]['Name'] = $tmp;
	if(isset($xxx->{'attributes'}->{'device_class'}->{'battery'})) $ha[$n]['BatteryLevel'] =$xxx->{'attributes'}->{'value'};
	else $ha[$n]['BatteryLevel'] =100;
		//$tmp=$xxx->{'attributes'}->{'device_class'};if ($tmp) $ha[$n]['device_class'] = $tmp;
	$ha[$n]['Type'] ="non défini";
	$ha[$n]['serveur'] ="HA";
	$n++;
}

return $ha;}
//
function devices_id($deviceid,$type,$value="",$pass=0){$post="";global $L_ha,$Token_ha; 
//$type=$command
$type= strtolower($type);
	$mat=explode('.',$deviceid);$mat=$mat[0];
switch ($type) {
case "etat" :		
	$api="api/states/".$deviceid;$mode=1;	
break;
case "service" :
	$api="api/services";$mode=1;	
break;
case "on" :
	$mode=2;	
	if ($mat=="input_boolean") {$api="api/services/input_boolean/turn_on";$post='{"entity_id": "'.$deviceid.'"}';}	
	if ($mat=="switch") {$api="api/services/switch/turn_on";$post='{"entity_id": "'.$deviceid.'"}';}
	if ($mat=="light") {$api="api/services/light/turn_on";$post='{"entity_id": "'.$deviceid.'"}';}	
break;
case "off" :
	$mode=2;	
	if ($mat=="input_boolean") {$api="api/services/input_boolean/turn_off";$post='{"entity_id": "'.$deviceid.'"}';}
	if ($mat=="switch") {$api="api/services/switch/turn_off";$post='{"entity_id": "'.$deviceid.'"}';}
	if ($mat=="light") {$api="api/services/light/turn_off";$post='{"entity_id": "'.$deviceid.'"}';}	
break;
case "4" ://"entity_id":"light.salon", "brightness": 255, "rgb_color": [20,30,20]
	$mode=2;$rgb=$value;//$value=str_replace('(','[',$value);$value=str_replace(')',']',$value);	
	$api="api/services/light/turn_on";$post='{"entity_id": "'.$deviceid.'", "brightness": 255, "rgb_color": '.json_encode($value).'}';
break;		
case "value" :
	$mode=2;	
	if ($mat=="input_text") {$api="api/services/input_text/set_value";$post='{"entity_id": "'.$deviceid.'" , "value" : "'.$value.'" }';}	
break;	
default:
}								
$L=$L_ha.$api;
$ha=file_http_curl($L,$mode,$post,$Token_ha);
$data = json_decode($ha, true);
$data['status']="OK";										
$data['address_api']=$post;										
return json_encode($data);}

function set_object($device,$type,$value,$pass=0){global $Token_iob,$port_api_iob,$IP_iob;
//http://192.168.1.104:8093/v1/state/zigbee2mqtt.0.0xa4c13878aa747f7e.state?value=false		
//http://192.168.1.162:8093/v1/command/setState?id=zigbee2mqtt.0.0xb40ecfd06e810000.color&state=%231BFF42											
//$mode=1;//$device=$device.".".$type;
switch ($type) {
	case "state" :	
if ($value=="On") {$value='true';}
if ($value=="Off") {$value='false';}
$L=$IP_iob.':'.$port_api_iob.'/v1/state/'.$device.'?value='.$value;
break;
	case "command" :
$L=$IP_iob.':'.$port_api_iob.'/v1/command/setState?id='.$device.'&state='.$value;	
//file_http_curl($L,$mode,$post,$token)
break;
default:
}		
$iob=file_get_curl($L);
$iob = json_decode($iob, true);
$data['status']="OK";			
$data['id']=$iob['id'];		
$data['valeur']=$iob['val'];	 
return $data;										
}

//-------POUR DZ- et HA -----------------------------------
// pour DZ specific IDX : /json.htm?type=command&param=getdevices&rid=IDX
//
function devices_plan($plan){global $L_dz, $l_dz, $L_ha, $l_ha,$L_iob, $l_iob,$IP_dz,$IP_ha,$IP_iob,$port_api_iob;
$n=0;$al_bat=0;$p=0;$t1000=1000;$serveur_dz_on = false;	
	if ($l_dz!=""){	$serveur_dz_on = true;
$L=$L_dz."json.htm?type=command&param=getdevices&plan=".$plan;
$json_string = file_get_curl($L);
$parsed_json = json_decode($json_string, true);
$parsed_json = $parsed_json['result'];
$p=count($parsed_json);
$j=0;while (isset($parsed_json[$j])==true) {
	$parsed_json[$j]['serveur']="DZ";
	$j++;
	}
 }
$serveur_ha_on = false;							 
if ($l_ha!=""){$serveur_ha_on = true;
	$result=devices_zone(0);$n=0;//
	while (isset($result[$n])==true){
		$parsed_json[$p]=$result[$n];
		$n++;$p++;}
			    };
$serveur_iob_on = false;
	$obj_iob=[]	;					 
if ($l_iob!=""){$q=$p;$serveur_iob_on = true;
				$iob=array();$values=array();$valu=array();
	if (str_contains(OBJ_IOBROKER, ",")) {$obj_iob=explode(',',OBJ_IOBROKER);$nbi=count($obj_iob);}			
	else {$obj_iob[0]=OBJ_IOBROKER;} 
$ii=0;$n=0;$id4[$ii]="";
while (isset($obj_iob[$ii])) {$serveur_iob_on=true;$jj=0;
$_id1=$obj_iob[$ii];	$id1=explode('.',$_id1);$nb_iob=count($id1);$id4[$ii+1]=$id1[0];
if ($id4[$ii+1] != $id4[$ii]) {$values=[];}
if ($nb_iob>2){
	if ($nb_iob==3){$_id2=$id1[0].".".$id1[1];$vq=$id1[1];}
	if ($nb_iob==4){$_id2=$id1[0].".".$id1[1].".".$id1[2];$vq=$id1[2];}
	if ($nb_iob==5){$_id2=$id1[0].".".$id1[1].".".$id1[2].".".$id1[3];$vq=$id1[3];}	 }									 
$L=$IP_iob.":".$port_api_iob."/v1/states?filter=".$_id1.".*";	
$json_string = file_get_curl($L);//return $json_string;
$iob_json = json_decode($json_string);$devi="";
foreach ($iob_json as $cle => $valeur){$d=$valeur -> {'val'};
		if ($d=="true") {$d="on";}
		if ($d=="false") {$d="off";}	
		$name=str_replace($_id1.".", "", $cle);	//$name=str_replace(".","_",$name);		   
		$device=explode('.',$cle);$devic=$device[0].".".$device[1].".".$device[2];
	    if ($devi==$devic) {$valu[$devic][$device[3]] = $valeur -> {'val'};}
		$iob[$n]=[
		'num' => $n,
		'ID' => $cle,
		'Device' => $devic,
		'Data' => $d,
		'serveur' => "IOB"
		];		
		if ($nb_iob>2){$values[$name] = $valeur -> {'val'};
	   }
	    
		$n++;$jj++;$devi=$devic;}					 
if ($nb_iob>2){
			$L2=$IP_iob.":".$port_api_iob."/v1/object/".$_id2;
			$json1_string = file_get_curl($L2);
			$iob_json1 = json_decode($json1_string,true);//return $iob_json1;			
			$iob[$n]=[
			'num' => $n,	
			'ID' =>	$iob_json1['_id'],
			'Name' =>$iob_json1['common']['name'],
			'Type' =>$iob_json1['type'],
			'Date' =>$iob_json1['ts'],
			'values' => $values,	
			'serveur' => 'IOB'
			];//return $iob;
	$n++;}
	$ii++; }
	//$plan=99;	
		$n=0;if ($plan==99){ $_SESSION['iob'] = json_encode($iob);return $iob;}// pour test iob 
	
while (isset($iob[$n])==true){
	$parsed_json[$q]=$iob[$n];
	$n++;$q++;}
	   }						 
$n=0;$s1="";$s2="";$nb_ha=0;$nb_iob=0;$nb_dz=0;

while (isset($parsed_json[$n])==true) {
$lect_device = $parsed_json[$n];
//$description = isset($lect_device["Description"]) ? $lect_device["Description"] : '';
$device = isset($lect_device["Device"]) ? $lect_device["Device"] : '';
$description = isset($lect_device["attributes"]) ? $lect_device["attributes"] : 'sans';
if ($lect_device["serveur"] == "DZ"){
//	if  (isset($lect_device["attributes"])) {
$lect_device["attributes"]["SubType"] = $lect_device["SubType"];
$lect_device["attributes"]["SwitchType"] = $lect_device["SwitchType"] ;			
$lect_device["attributes"]["SwitchTypeVal"] = $lect_device["SwitchTypeVal"];
$lect_device["attributes"]["Timers"] = $lect_device["Timers"];			
$lect_device["attributes"]["Type"] = $lect_device["Type"];	 
$lect_device["attributes"]["Color"] = $lect_device["Color"];	 }
//else {$lect_device["attributes"]="non défini";}
$periph=array();$periph['idm']=1000;
	if ($lect_device["serveur"]=='DZ') {$s=$lect_device["idx"];$t1="1";}
	if ($lect_device["serveur"]=='HA') {$s=$lect_device["ID"];$t1="2";}
	if ($lect_device["serveur"]=='IOB') {$s=$lect_device["ID"];$t1="2";$s1=$lect_device["Name"];}

$periph=sql_plan($t1,$s,$s1);
	if ($periph==null) {$choix_serveur="pas_ID";}
	else {$choix_Actif=$periph['Actif'];
		  
	  if (($choix_Actif=="1" || $choix_Actif=="2") && $lect_device["serveur"]=="DZ")  {$choix_serveur="dz";}
	  else if ($choix_Actif=="3" && $lect_device["serveur"]=="HA") {$choix_serveur="ha";}
	  else if ($choix_Actif=="4" && $lect_device["serveur"]=="IOB") {$choix_serveur="iob";}
		else $choix_serveur="2";  
		 }
//if ($periph) echo json_encode($periph);	
$bat="";
if ($choix_serveur!="pas_ID"){
if ($periph['idm']) {$t=$periph['idm'];}
else {$t=$t1000;$t1000++; $choix_serveur="0";}
if ($t=="") {$t=888;$choix_serveur="0";}}
//---------------------------------------------------------------
	switch ($choix_serveur) {
		case "iob" :	
$lect_device["Name"] = $periph['nom_objet'];

if (array_key_exists('values', $lect_device)) {
	$array=$lect_device['values'];
    if(array_key_exists('temperature', $array)) {$lect_device["Temp"]=$array["temperature"];$lect_device["Data"]=$array["temperature"];}//pour IOB
	if(array_key_exists('air_temperature', $array)) {$lect_device["Temp"]=$array["air_temperature"];}//pour IOB
	if(array_key_exists('humidity', $array)) {$lect_device["Humidity"]=$array["humidity"];}//pour IOB	
	if(array_key_exists('relative_humidity', $array)) {$lect_device["Humidity"]=$array["relative_humidity"];}//pour IOB	
	if(array_key_exists('battery', $array)) {$lect_device["BatteryLevel"]=$array["battery"];}//pour IOB		
	if(array_key_exists('emergency', $array)) {$lect_device["Data"]=$array["emergency"];}//pour IOB		
	if(array_key_exists('state', $array)) {$lect_device["Data"]=$array["state"];
										  if ($lect_device["Data"]==true) {$lect_device["Data"]="On";}
										  if ($lect_device["Data"]==false) {$lect_device["Data"]="Off";}
										  }//pour IOB	
	if(array_key_exists('color', $array)) {$lect_device["attributes"]["Color"] = $array["color"];}
	if(array_key_exists('brightness', $array)) {$lect_device["attributes"]["brightness"] = $array["brightness"];}
	if(array_key_exists('colortemp', $array)) {$lect_device["attributes"]["colortemp"] = $array["colortemp"];}
	if(array_key_exists('link_quality', $array)) {$lect_device["attributes"]["link_quality"] = $array["link_quality"];}
	//if(array_key_exists('pause', $array)) {$lect_device["Data"] = $array["pause"];}// pour WORX
}
else $lect_device['values'] = $valu[$device];	
		case "dz" :
		case "ha" :			
if(array_key_exists('Temp', $lect_device)==false) {$lect_device["Temp"]="non concerné";}
if(array_key_exists('description', $lect_device)) {$description=$lect_device["description"];}// pour IOB			
if(array_key_exists('Humidity', $lect_device)==false) {$lect_device["Humidity"]="non concerné";}
if (!$lect_device["BatteryLevel"]){ $lect_device["BatteryLevel"]=255;}			
	if(intval($lect_device["BatteryLevel"])<PILES[2]) {$bat="alarme";if ($al_bat==0) {$al_bat=1;} }
    if(intval($lect_device["BatteryLevel"])<PILES[3]) {$bat="alarme_low";if ($al_bat<2) {$al_bat=2;} }
if ($periph['F()']>0) {$nc=$periph['F()'];$lect_device["Data"]=pour_data($nc,$lect_device["Data"]);$lect_device["Fx"]=$periph['F()'];}
if ($periph['F()']==0) {$lect_device["Fx"]=$periph['F()'];}
if ($periph['F()']==-1) {$lect_device["Fx"]="lien_variable";}			
if ($periph['car_max_id1']<10) {$lect_device["Data"]=substr ($lect_device["Data"] , 0, $periph['car_max_id1']);}
if ($periph['ls']==1) {$periph['ls']="oui";}else {$periph['ls']="non";}	
if (!$lect_device['values']){$lect_device['values']="";}
//if (!$lect_device['attributes']){$lect_device['attributes']="";}
if (!$lect_device['Type']){$lect_device['Type']="inconnu";}			
	$data[$t] = ['serveur' => $lect_device["serveur"],			 
	'idx' => $periph["idx"],
	'deviceType' => $lect_device["Type"],	
	'emplacement' => $description,					 
	'temp' => $lect_device["Temp"],
	'hum'   => $lect_device["Humidity"],
	'bat' => $lect_device["BatteryLevel"],
	'ID' => $lect_device["ID"],
	'serveur' => $lect_device["serveur"],			 
	'Data' => $lect_device["Data"],
	'device' => $device,
	'attributs' => $lect_device["attributes"],			 
	'Name' => $lect_device["Name"],
   	'Update' => $lect_device["LastUpdate"],
	'fx' => $lect_device["Fx"],			 
	'idm' => $periph['idm'],
	'materiel' => $periph['materiel'],
	'lastseen' => $periph['ls'],			 
	'maj_js' => $periph['maj_js'],	
	'ID1' => $periph['id1_html'],
	'ID2' => $periph['id2_html'],
	'coul_ON' => $periph['coul_id1_id2_ON']	,
	'coul_OFF' => $periph['coul_id1_id2_OFF'],
	'class_lamp' => $periph['class_lamp'],
	'coullamp_ON' => $periph['coul_lamp_ON']	,
	'coullamp_OFF' => $periph['coul_lamp_OFF']	,
	'type_pass' => $periph['pass'],
	'actif' => $periph['Actif'],
	'values' => $lect_device['values'],			 
	'alarm_bat' => $bat
	];
/*if (str_contains($periph['idm'], "_")==false  && $lect_device["serveur"]=="IOB") {
	$data[$t] = [
		//'Name' => $lect_device["Name"],
		//'Data' => $lect_device["Data"],
		'value' => $value];}*/			
break;
case "1":
case "0" :$data[$t] = [
	'serveur' => $lect_device["serveur"],
	'Name' => $lect_device["Name"],
	'actif' => $periph['Actif'],
	'ID' => $lect_device["ID"],
	'idm' => $periph['idm']];
break;			
case "pas_ID" :
	if ($lect_device["serveur"]=="HA")  $nb_ha++;
	if ($lect_device["serveur"]=="IOB")  $nb_iob++;
	if ($lect_device["serveur"]=="DZ")  $nb_dz++;
	if(!isset($periph['idm'])) {$periph['idm']="non défini";}
	$data[2000] = [
	'nb_DZ' => $nb_dz,	
	'nb_HA' => $nb_ha,
	'nb_IOB' => $nb_iob,	
	'ID' => $lect_device["ID"],
	'idm' => $periph['idm']];		
break;

		
	}
$n=$n+1;}
$data[0] = [
'serveur_iob' => $serveur_iob_on,
'serveur_ha' => $serveur_ha_on,
'serveur_dz' => $serveur_dz_on,	
'jour' => date('d'),
'maj_date' => '0'];
$abat="0";
if ($al_bat==0) $abat="batterie_forte";
if ($al_bat==1) $abat="batterie_moyenne";
if ($al_bat==2) $abat="batterie_faible";
$val_albat=val_variable(PILES[0]);
if ($abat != $val_albat) maj_variable(PILES[0],PILES[1],$abat,2);
return $data;
						 
 }
function dimmable($idx,$valeur,$level){
$data_rgb = [
	'command' => "13",
	'ID1_html' => $idx
			];
	$rvb=mysql_app($data_rgb);
	$majjs=$rvb['maj_js'];$idx=$rvb['idx'];$serveur=$rvb['Actif'];$ID=$rvb['ID'];$objet=$rvb['nom_objet'];
// domoticz		
	if ($majjs == "on_level" && $serveur=="2") {$id=$idx;$type=4;$result=switchOnOff_setpoint($id,$valeur,$type,$level,$pass="0");}
// iobroker
//http://192.168.1.162:8093/v1/command/setState?id=zigbee2mqtt.0.0xb40ecfd06e810000.color&state=%231BFF42
	if ($majjs == "on_level" && $serveur=="4") {$type="command";$id=str_replace("state", "color", $ID);
		$valeur=str_replace("#", "%23", $value);set_object($id,$type,$valeur,$pass=0);}
// home assistant
	if ($majjs == "on_level" && $serveur=="3") {$id=$ID;$type="4";$rgb=hex2rgb($valeur);$result=devices_id($id,$type,$rgb,$pass=0);}
return $result;
		}

function switchOnOff_setpoint($idx,$valeur,$type,$level,$pass="0"){$auth=9;global $L_dz;
// exemple : http://192.168.1.75:8082/json.htm?type=command&param=udevice&idx=84&nvalue=Off&svalue=2
//  /json.htm?type=command&param=switchlight&idx=99&switchcmd=Set%20Level&level=6
//  /json.htm?type=command&param=setcolbrightnessvalue&idx=99&hex=RRGGBB&brightness=100&iswhite=false																   
if ($pass=="0") {$auth=0;}
if ((($pass==NOM_PASS_CM)&&($_SESSION['passwordc']==PWDCOMMAND))&&($_SESSION['timec']>time())) {$auth=1;}
if (($pass==NOM_PASS_AL)&&($_SESSION['passworda']==PWDALARM)&&($_SESSION['time']>time())) {$auth=2;}
if ($auth<3){$json2="json.htm?type=command&param=";
	// $type=1 .....
	if ($type==1){$json1='udevice&idx='.$idx.'&nvalue=group%20on&svalue=2';}
	// $type=2 .....ON/OFF
	if ($type==2){$json1='switchlight&idx='.$idx.'&switchcmd='.$valeur;}
	// $type=3 Réglez une lumière dimmable/stores/sélecteur à un certain niveau
	if ($type==3){$json1='switchlight&idx='.$idx.'&switchcmd=Set%20Level&level='.$level;}
	// $type=4 Réglez une lumière RVB dimmable
	if ($type==4){
	
								
	$hex=substr($valeur,1,6);$json1='setcolbrightnessvalue&idx='.$idx.'&hex='.$hex.'&brightness='.$level.'&iswhite=false';}		 
	$json= $L_dz.$json2.$json1;
	$json_string=file_get_curl($json);
	$result = json_decode($json_string, true);
	}
else {$result['status']="acces interdit";}
return $result ;
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
	5 => "met_5_1.svg",
	6 => "met_6_1.svg",
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
	71 => "met_23_1.svg",
	100 => "met_12.svg",
	101 => "met_12_0.svg",
	103 => "met_11_1.svg",
	105 => "met_11.svg",
	140 => "met_10_2.svg",
	210 => "met_6.svg",
	211 => "met_7_1.svg",
	212 => "met_8.svg",
	220 => "met_6.svg",
	222 => "met_8_2.svg",
	231 => "met_22_1.svg",
];
switch ($choix) {
// prev indice UV : https://api.meteo-concept.com/api/forecast/uv/daily/0		
// ephéméride : https://api.meteo-concept.com/api/ephemeride/1		
 case 3://prévision horaire
$url = 'https://api.meteo-concept.com/api/forecast/nextHours?&token='.TOKEN_MC.'&insee='.INSEE;
$prevam = file_get_curl($url);
$forecast = json_decode($prevam);$info=array();
		$forecasth=$forecast->forecast[0];
		$info['temp']=$forecasth->temp2m;
		$info['hum']=$forecasth->rh2m;
		$info['Data']=$info['temp'].'°  '.$info['hum'].'%';
return json_encode($info);
		break;		
	case 2:// relevé temps réel station la pus proche (40Km)
$url = 'https://api.meteo-concept.com/api/observations/around?param=temperature&radius=40&token='.TOKEN_MC.'&insee='.INSEE;
//$url2 = 'https://api.meteo-concept.com/api/forecast/nextHours?token='.TOKEN_MC.'&insee='.INSEE;		
$prevam = file_get_curl($url);//echo $prevam;return;
$forecastam = json_decode($prevam);$info=array();
		//$info['time']=$forecastam[0]->observation->time;
		$info['temp']=$forecastam[0]->observation->temperature->value;
		$info['hPa']=$forecastam[0]->observation->atmospheric_pressure->value;
return json_encode($info);
		break;		
    case 0:
$url1 = 'https://api.meteo-concept.com/api/forecast/daily/0/period/2?token='.TOKEN_MC.'&insee='.INSEE;
$prevam = file_get_curl($url1);
$forecastam = json_decode($prevam)->forecast;$info=$forecastam->weather;
if (isset($img_donnees[$info])){$imgtemps=$img_donnees[$info];}
else {$imgtemps="met_interdit_vert.svg";}
$resultat='<p>'.$info.'Le temps prévu pour cet après-midi  : '.$donnees[$info].'<img class="meteo_concept_am" src="images/'.$imgtemps.'" alt=""></p>';
break;
    case 1:		
$url = 'https://api.meteo-concept.com/api/forecast/daily?insee='.INSEE;
$result=file_http_curl($url,1,'',TOKEN_MC);	
	$decoded = json_decode($result);
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
$mp="erreur_mdp";
}
$info=[	
		'statut' => $mp,
		'type_pwd'=>$page_pass
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
		$info['titre']=$maj[0]; $txtimg = sql_variable($im,1);$info['img_pluie']=$txtimg['image'];
		$info['maj']=$date;$info['jour']=$jour;$info['pourcent']=$pourcent;$info['temp']=$temp;$info['mm']=$pluiemm;
	break;
    case "2":
		$url="https://rpcache-aa.meteofrance.com/internet2018client/2.0/nowcast/rain?lat=44.952602&lon=-0.107691&token=".TOKEN_MF;
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
		$txtimg = sql_variable($im,1);$info['img_pluie']=$txtimg['image'];
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
'adress' => $url,
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
echo $cam." ".$type."   ip:".$ip."<br>";
if ($marque==1){$user=DHUSER;  # username
				$pass=DHCAMPASS[$ip];  # password
if ($type=="VTO"){$user="admin";  # VTO
$pass=DHPASSVTO;}
//					
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
     $url="http://".$ip."/cgi-bin/".$e[$action];//echo $url;
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
   $options[CURLOPT_HTTPAUTH]=CURLAUTH_BASIC | CURLAUTH_DIGEST;
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
	//echo $status_code, $ip, $idx;
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

function admin($choix,$idrep){// idrep =ID affichage sauf pour 4 , 6 , 11 ,16 = contenu textarea
global $L_dz, $l_dz, $L_ha, $l_ha,$L_iob, $l_iob,$IP_dz,$IP_ha,$IP_iob,$USER_dz,$USER_ha,$USER_iob,$PWD_dz,$PWD_ha,$PWD_iob;	
$height="490";$pawd=0;$test_iob=0;
if ($choix==9){$height="200";include ("include/test_db.php");$pawd=1;}
$time = time();
if (($_SESSION['passworda']==PWDALARM)&&($_SESSION['time']>time())) {$pawd=1;}
if ($pawd==1){
if (($choix==3) || ($choix==4)) {$file = VARTAB;$rel="4";}
if (($choix==10) || ($choix==11)) {$file = CONF_MODECT;$rel="11";}
if (($choix==15) || ($choix==16)) {$file = BASE64;$rel="16";}	
if (($choix==5) || ($choix==6)) {$file = MONCONFIG;$rel="6";}
if (($choix==7) || ($choix==8)) {$file = MONCONFIG;$rel="8";}
if ($choix==26) {$rel="29";}	
if ($choix==21 ) {$ip=IPRPI;$mode="scp_r";$remote_file_name="/etc/msmtprc";$file_name="msmtprc";$local_path=MSMTPRC_LOC_PATH;
				  include ('include/ssh_scp.php');$file=$local_path.$file_name; echo "copy de  msmtprc";$rel="22";}
if ($choix==22 ) {$file= MSMTPRC_LOC_PATH."msmtprc"; }
if ($choix==23 ) {$file=TMPCONFIG."connect.py"; echo "copy de connect.py";$rel="24";}	
if ($choix==24 ) {$file=SSH_MONITOR_PATH."connect.py"; }
if ($choix==28 ) {$file=MOD_PYTHON_FILE;}	
if (($choix!=4) && ($choix!=6) && ($choix!=8) && ($choix!=10) && ($choix!=11) && ($choix!=15) && ($choix!=16) && ($choix!=22) && ($choix!=24) && ($choix!=29)) {echo '<p id="btclose"><img id="bouton_close" onclick="yajax('.$idrep.')"  
src="images/bouton-fermer.svg" style="width:30px;height:30px;"/></p>';}	
if ($choix==12){echo "//*******création fichier noms/idx******* <br>";}
if ($choix==13){echo "//*******création table LUA zigbee******* <br>";}
switch ($choix) {
    case "1":
// disponoible
return;		
break;
    case "2":
//disonible	
return ;	
break;
case "3" :
case "5" :
case "7" :
case "15" :
case "21" :	
case "23" :			
echo $file.'<br><em style="color:red">le fichier doit être autorisé en écriture (666)</em><br><div id="result"><form >';
     $content = file_get_contents($file);
	 if($choix==3){ file_put_contents(VARTAB.'.bak.'.$time, $content);}	 
	 else {file_put_contents($file.'.bak.'.$time, $content);}
	 if($choix==7){$_SESSION["contenu"]=$content; $find="PWDALARM','";$tab = explode($find, $content);$tab=$tab[1];$tab = explode("'", $tab);$content=$tab[0];
		$_SESSION["mdpass"]=$find.$content;$height="30";}
	$button_enr="enregistrer";
	if ($choix==23){$button_enr	= 'envoyer vers PI ';}
	 echo '<textarea id="adm1" style="height: auto;max-height: 200px;min-height: 400px;" name="command" >' . htmlspecialchars($content) . '</textarea><br>
	<input type="button" value="'.$button_enr.'" id="enr" onclick=\'wajax($("#adm1").val(),'.$rel.');\' /><input type="button" id="annuler" value="Annuler" onclick="yajax(`enr`)"> ';
	 echo '</form></div>';
return "sauvegarde OK";	 
break;
case "4" :
$content=$idrep;
echo '<p id="btclose"><img id="bouton_close" onclick="yajax(reponse1)" src="images/bouton-fermer.svg" style="width:30px;height:30px;"/></p>fichiers sauvegardés';		
file_put_contents($file,$content);
// mise à jour par domoticz
$retour=maj_variable("22","upload","1","2");echo "variable Dz à jour : ".$retour['status'];
break;
case "16" :
$content=$idrep;
file_put_contents(TMPCONFIG."connect.py", $content);$content=str_replace("#!/usr/bin/env python3 -*- coding: utf-8 -*-","/*JS*/",$content);file_put_contents(TMPCONFIG."connect.js", $content);$content1=$content;
	$content=str_replace("/*JS*/","--  lua",$content1);$content=str_replace("[","{",$content);$content=str_replace("]","}",$content);
	file_put_contents(TMPCONFIG."connect.lua", $content);$content=str_replace("/*JS*/","",$content1);$content=str_replace("=",": ",$content);
	file_put_contents(TMPCONFIG."connect.yaml", $content);	$t_maj= "";
	$upload=sql_variable('upload',6);
	if ($upload['idx']!='') {$retour=maj_variable($upload["idx"],"upload","connect","2");$t_maj=$upload["idx"].$t_maj."----->dz";}
	if ($upload['ID']!='') {$retour=devices_id($upload["ID"],"value","connect",0);$t_maj=$t_maj.$upload["ID"]."----->ha";}
	//if ($upload['ID']!='') {$t_maj="----->iob";}
	echo $t_maj."<br>  Logins , mots de passe ou IPs mis à jour <br>Les variables se nomment *****connect*****</p>";echo '<p id="btclose"><img id="bouton_close" onclick="yajax(\'#reponse1\')" src="images/bouton-fermer.svg" style="width:30px;height:30px;"/></p>';		
break;
case "6" :
$content=$idrep;
		file_put_contents($file, $content);echo '<p id="btclose"><img id="bouton_close" onclick="yajax(reponse1)" src="images/bouton-fermer.svg" style="width:30px;height:30px;"/></p>fichiers sauvegardés';
return;
 break;		
case "22":
case "24":		
 $content=$idrep;
 if ($choix==22){$mode="scp_s";$ip=IPRPI;$remote_file_name="/etc/msmtprc";$file_name="msmtprc";$local_path=MSMTPRC_LOC_PATH;
				include ('include/ssh_scp.php');echo '<p id="btclose"><img id="bouton_close" onclick="yajax(\'#reponse1\')" src="images/bouton-fermer.svg" style="width:30px;height:30px;"/>maj config msmtprc</p>';}	
if ($choix==24){$ip=IPRPI;$remote_file_name="/home/michel/connect.py";$file_name="connect.py";$local_path=$file;	
		$mode="scp_s";include ('include/ssh_scp.php'); echo '<p id="btclose"><img id="bouton_close" onclick="yajax(\'#reponse1\')" src="images/bouton-fermer.svg" style="width:30px;height:30px;"/></p>';echo "copy de  connect.py";}		
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
case "10" : $content=sql_app(2,"cameras","modect",1,$icone='');file_put_contents(CONF_MODECT.'.bak.'.$time, $content);echo CONF_MODECT.'<BR><textarea id="adm1" style="height:'.$height.'px;" name="command" >' . htmlspecialchars($content) . '</textarea><br>'.CONF_MODECT.'<br>
	<input type="button" value="enregistrer" id="enr" onclick=\'wajax($("#adm1").val(),'.$rel.');\' /><input type="button" id="annuler" value="Annuler" onclick="yajax('.$idrep.')"> ';
	 echo '</form></div>';return "sauvegarde ".CONF_MODECT."OK";	
case "11" :$content=$idrep;$height="100";echo $idrep.'<br><p id="btclose"><img id="bouton_close" onclick="yajax(reponse1)" src="images/bouton-fermer.svg" style="width:30px;height:30px;"/></p>';
file_put_contents(CONF_MODECT, $content);
// mise à jour par domoticz met à 2 upload
//$retour=maj_variable("22","upload","2","2");echo  '<textarea id="adm1" style="height:'.$height.'px;" name="command" >variable Dz à jour : '.$retour["status"].'</textarea>'; return;
break;
case "12" : $retour=devices_plan(2) ;
foreach($retour  as $R=>$D){
  foreach($D as $key=>$Value){
		if ($key=="idx" ) echo "  ".$key." = ".$Value."   ";
		if ($key=="Name" ) echo "  ".$key." = ".$Value."<br>";}
}
echo "fin";return;
break;
case "13" : $retour=devices_plan(2) ;$lastseen="liste_ls={}";$lastseen=$lastseen."\n";
$i=0;foreach($retour  as $R=>$D){
  foreach($D as $key=>$Value){
	if ($key=="idm" ) $val_idm=$Value;
  	if ($key=="idx" ) $val_idx=$Value;	
	if ($key=="Name" ) $val_name=$Value;
	if ($key=="materiel" ) $val_mat=$Value;
    if ($key=="lastseen" ) $val_ls=$Value;  }

if ($val_mat=="zigbee" || $val_mat=="zigbee3" || $val_mat=="zwave") {$i=$i+1;$lastseen=$lastseen."\n";$lastseen=$lastseen.'liste_ls['.$i.']={["idx"]=
"'.$val_idx.'",["name"]="'.$val_name.'",["idm"]="'.$val_idm.'",["lastseen"]="'.$val_ls.'"}';$lastseen=$lastseen."\n";}	
	}
$lastseen=$lastseen."\n";$lastseen=$lastseen.'nombre_enr='.$i;
//$lastseen=$lastseen."}";
		file_put_contents(TMPCONFIG, $lastseen);
$retour=maj_variable("22","upload","4","2");echo "Mise à jour Table Zigbee  : ".$retour['status'];		
break;
case "14" :
		include ('include/backup_bd.php');echo "sauvegarde effectuée";return;	
break;
case "27" :
		include ('include/backup_bd.php');echo "restauration effectuée";return;		
break;
case "27a":
$query=	' mysql --databases monit --user='.UTILISATEUR.' --password='.MOTDEPASSE.' < '.$_GET['textfield'].';';		
echo $query;
echo '<form name="form_backup1" method="get" action="">
    <input type="submit" name="button" id="button" value="Submit">
  </form>';	
//shell_exec($query);  
echo "Restauration réussie";return;		
break;			
case "17" :include ('include/ajout_var_bd.php');//echo "ajout variable effectué";
		return;	
break;	
case "18" :include ('include/ajout_dev_bd.php');//echo "ajout dispositifs effectué";
		return;	
break;	
case "18a" :include ('include/reponse_dev_bd.php');//echo "ajout dispositifs effectué";
		return;	
break;			
case "19" : $retour=sql_variable("",2) ;$n=0;
		while ($retour[$n]['num']){
	echo "<p style='font-size:12px;'>num : <span style='color:red'>".$retour[$n]['num']."</span>&nbsp; , idm : <span style='color:blue'>".$retour[$n]['idm']."</span>&nbsp; , idx : <span style='color:blue'>".$retour[$n]['idx']."</span>&nbsp; , ID : <span style='color:green'>".$retour[$n]['ID']."</span>&nbsp;<br>nom :<span style='color:purple'>".$retour[$n]['nom_objet']."</span>&nbsp; , id image :<span style='color:darkblue'> ".$retour[$n]['id_img']."</span>&nbsp; , id_texte :<span style='color:darkblue'>".$retour[$n]['id_txt']."</span></p>";		
					$n++;}
		return;	
break;
case "20" :$ip=IPRPI;$type=1;include ('include/ssh_scp.php');  echo '<p id="btclose"><img id="bouton_close" onclick="yajax(\'#reponse1\')" src="images/bouton-fermer.svg" style="width:30px;height:30px;"/></p>';echo "reboot Raspberry";
return;	
break;
case "25" :include ('include/ajout_msg_bd.php');
		return;	
break;		
case "26" :$l_dz="";$l_ha="";$retour=devices_plan(99);
echo '<textarea id="adm1" style="height: auto;max-height: 200px;min-height: 400px; width:460px" name="iob" >'.json_encode($retour).'</textarea><input type="button" value="enregistrer" id="enr" onclick="zajax('.$rel.')">'; 
break;
case "28" :$command = escapeshellcmd('pip list --format=json ');
$output=exec($command);
echo "enregistré dans :".$file."<br><br>".$output;
file_put_contents($file, $output);
return;
break;
case "29" :$file = "admin/iob.json";file_put_contents($file, $_SESSION['iob']);echo "enregistré dans :".$file.'<br><p id="btclose"><img id="bouton_close" onclick="yajax(reponse1)" src="images/bouton-fermer.svg" style="width:30px;height:30px;"/></p>';
return;	
break;	
case "40" :
break;					
		
default:
} }
else {	
 //echo '<script>document.getElementById(d_btn_a).style.display = "block";</script>
$retour="Entrer votre mot de passe";echo $retour;}//include ('include/test_pass.php');return;}
return ;

}
//----------------------------graph-------------------
function graph($device,$periode){$champ="valeur";
	if ($_SESSION["exeption_db"]=="pas de connexion à la BD") {echo "pas de tables enregistrées dans la bd";return ;}							 
	$devic=explode('-',$device);$device=$devic[0];$devic[1] = isset($devic[1]) ? $devic[1] : '';
	if ($devic[1] and $devic[1]!="") $champ=$devic[1];
require("include/export_tab_sqli.php") ;	
	if ($periode=="infos_bd"){	echo "liste : 20 dernieres valeurs ou 14 jours<br>";$k=0;
		$inumber=$number-20;if ($inumber<=0) {$inumber=0;}				  
		for ($i=$inumber; $i<$number; $i++)
		{
			echo $xdate[$i]." = ".$yvaleur[$i]."<br>";}return;}
	if ($periode=="text_svg"){	
		for ($i=$number-10; $i<$number; $i++)
		{$k=$k+1;$ccc=10*$k;echo '<text transform="matrix(1 0 0 1 0 '.$ccc.')" class="spa2 spa3">'.$xdate[$i].'='.$yvaleur[$i].'</text>';}return;}
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
$graph->SetMargin(60,70,30,60); 
$graph-> title->SetFont(FF_DV_SANSSERIF ,FS_BOLD);
$graph->title->Set('Table SQL : '.$device);
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
$L=URLDOMOTIC."json.htm?type=command&param=getlog&laztlogtime=0&loglevel=".$log;
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
function sql_app($choix,$table,$valeur,$date,$icone='',$val_bd1='',$val_bd2=''){
	// SERVEUR SQL connexion
$conn = new mysqli(SERVEUR,UTILISATEUR,MOTDEPASSE,DBASE);
if ($choix==0) {
$sql="INSERT INTO ".$table." (`num`, `date`, `valeur`, `icone`) 
VALUES (NULL, '".$date."', '".$valeur."', '".$icone."');";
$result = $conn->query($sql);	
;}
if ($choix==1) {
$sql="SELECT * FROM ".$table." ORDER BY num DESC LIMIT ".APP_NB_ENR;
$result = $conn->query($sql);
$number = $result->num_rows;
while($row = $result->fetch_array(MYSQLI_ASSOC)){
		echo $row['date'].'  '.$row['valeur'].' <img style="width:30px;vertical-align:middle" src="'.$row['icone'].'"/><br>';
		}
}
if ($choix==2 || $choix==3 ) {// modect pour dz ----- 2,"cameras","modect",1,$icone=''
if (table_ok($conn,"cameras")===TRUE){	
$sql="SELECT * FROM `cameras` WHERE `modect` = 1 ";
$result = $conn->query($sql);$i=0;
$number = $result->num_rows;
if ($number>0) {
	$content="Mode de détection: ".MODECT."\ncam_modect = ";
while($row = $result->fetch_array(MYSQLI_ASSOC)){
		//$content = $cont.$row['id_zm'];
if ($choix==2 && MODECT=="zoneminder"){$content_json[$i] = [
	"id_zm" =>  $row['id_zm'],
	"url" => $row['url']
				];
	}
if ($choix==2 && MODECT=="frigate"){$content_json[$i] = [
	"id_fr" =>  $row['id_fr'],
					];
	}	
if ($choix==3 && MODECT=="zoneminder"){	$content = $content.$row["id_zm"];}
if ($choix==3 && MODECT=="frigate"){	$content = $content.$row["id_fr"];}	
$i++;if ($number>$i) {$content=$content." , ";}
}
if ( $choix==3 && MODECT=="zoneminder") {$cle=token_zm();$content=$content."\nToken OK : ".substr($cle,0,15)."....";}
if ($choix==2) {$content= json_encode($content_json);}		
}
	
else {echo "pas de cameras modect";}
}
	
else {return "table cameras inexistante";}
}
if ($choix==4) {
$sql="SELECT * FROM ".$table." WHERE ".$valeur." = ".$date;
$result = $conn->query($sql);	
$number = $result->num_rows;if ($number>0) {
	while($row = $result->fetch_array(MYSQLI_ASSOC)){$content=$row['contenu'];
	$content = str_replace('$$','',$content);	}
}
}
$conn->close();

return $content;
}

function pour_data($nc,$l_device){
switch ($nc) {
    case 1:	
$l_dev= explode(";",$l_device);$l_device=$l_dev[4]/1000;
return $l_device;
break;
default:

}				
}
//----------------------------------------
function mysql_app($data){
	// SERVEUR SQL connexion
$choix=$data["command"];
$conn = new mysqli(SERVEUR,UTILISATEUR,MOTDEPASSE,DBASE);
if ($conn -> connect_errno) {
  echo "Failed to connect to MySQL: " . $conn -> connect_error;
  exit();}	
switch ($choix) {
	case "1":
$nom=$data['nom'];$nom_objet=$data['nom_objet'];$idm=$data['idm'];$idx=$data['idx'];$ID=$data["ID"];$id_img=$data['id_img'];$id_txt=$data['id_txt'];
//
$sql="INSERT INTO dispositifs (nom_objet, idm ,idx, ID, maj_js, id1_html, id2_html) VALUES ('$nom_objet',  '$idm', '$idx', '$ID', 'variable', '$id_img', '$id_txt');";
$result = $conn->query($sql);
echo '<em>valeurs enregistrées</em><br>idm : '.$data["idm"].'<br>idx : '.$data["idx"].'<br>nom_objet : '.$data["nom_objet"].'<br>id-image : '.$data["id_img"].'<br>id-texte : '.$data["id_txt"].'<br><br>';	
if ($data["texte_bd"] != " "  &&  $data["image_bd"] != " "){$sql="INSERT INTO `text_image` (`num`, `texte`, `image`, `icone`) VALUES (NULL, '".$data['texte_bd']."', '".$data['image_bd']."', '".$data['icone_bd']."');";
$retour=maj_query($conn,$sql);
echo '<em>texte à remplacer:'.$data["texte_bd"].'<br>image de remplacement:'.$data["image_bd"].'<br>icone : '.$data["image_bd"].'<br>';}			
break;
    case "2":if (strlen($data['nom'])>25) {echo "valeur nom appareil trop grande<br>pour modifier dans la table:<br><br>ALTER TABLE `dispositifs` CHANGE `nom_appareil` `nom_appareil` VARCHAR(30)";return;}
		if ($data["pass"]=="alarme"){$data["pass"]="pwdalarm";}
		elseif ($data["pass"]=="commandes"){$data["pass"]="pwdcommand";}
		else $data["pass"]="0";
$sql="INSERT INTO `dispositifs` (`num`, `nom_appareil`, `nom_objet`, `idx`, `ID`, `idm`, `Actif`,`materiel`, `ls`, `maj_js`, `id1_html`, `car_max_id1`, `F()`, `id2_html`, `coul_id1_id2_ON`, `coul_id1_id2_OFF`, `class_lamp`, `coul_lamp_ON`, `coul_lamp_OFF`, `pass`, `observations`) VALUES (NULL, '".$data['nom']."', '".$data['nom_objet']."', '".$data["idx"]."', '".$data["ID"]."', '".$data["idm"]."', '".$data["actif"]."','".$data["type_mat"]."' , '".$data["ls"]."' , '".$data["maj_js"]."', '".$data["id1_html"]."', '".$data["car"]."', '".$data["fx"]."', '".$data["id2_html"]."', '".$data["coula"]."', '".$data["coulb"]."', '".$data["class"]."', '".$data["coulc"]."', '".$data["could"]."', '".$data["pass"]."', '".$data["obs"]."');";		
		echo '<em>valeurs enregistrées</em><br>'.'nom appareil: '.$data["nom"].'<br>maj_js : '.$data["maj_js"].'<br>idx : '.$data["idx"].'<br>nom : '.$data["nom_objet"].'<br>idm : '.$data["idm"].'<br>Actif : '.$data["actif"].'<br>ID : '.$data["ID"].'<br>ID1_html : '.$data["id1_html"].'<br>ID2_html : '.$data["id2_html"].'<br>coul_id1_id2_ON : '.$data["coula"].'<br>coul_id1_id2_OFF : '.$data["coulb"].'<br>type_mat : '.$data["table"].'<br>lastseen : '.$data["ls"].'<br>class lampe : '.$data["class"].'<br>coul_lamp_ON : '.$data["coulc"].'<br>coul_lamp_OFF : '.$data["could"].'<br>mot_passe : '.$data["pass"].'<br>fx: '.$data["fx"].'<br>nb caractéres : '.$data["car"].'<br>Observations : '.$data["obs"].'<br><br>';
//
maj_query($conn,$sql);			
break;
case "3":
$nom=$data['nom'];$id1_html=$data['id_txt'];$id_txt=$data['id_txt'];
$sql="INSERT INTO messages (nom,  id1_html, contenu, maj ) VALUES ('$nom', '$id1_html', '', '0');";
$retour=maj_query($conn,$sql,"3");
echo $retour;		
break;
case "4":
//UPDATE `sse` SET `id`='418',`state`='Off',`date`='13:14:49' WHERE num=0		
$sql="UPDATE sse SET id='".$data['id']."',state='".$data['state']."',date='".$data['date']."' WHERE num=0;";
echo $sql;		
$retour=maj_query($conn,$sql,"4");	
break;
case "5":
$sql="SELECT * FROM sse WHERE num=0; ";
$result = $conn->query($sql);	
$row = mysqli_fetch_array($result);
return $row	;
break;	
case "6":
$sql="UPDATE `sse` SET `id`='".$data['id']."',`state`='".$data['state']."' WHERE num=0;";
$retour=maj_query($conn,$sql,"4");		
break;
case "7": 
		$sql="SELECT * FROM `".DISPOSITIFS."` WHERE idm = '".$data['majidm']."' ;";
$result = $conn->query($sql);//if ($result === FALSE) {echo "pas id";return "";}
$row = $result->fetch_assoc();
$data=$row;		
echo '<form2><input type="hidden"id="app" value="dev_bd"><input type="hidden" id="command"  value="8"><em>valeurs enregistrées</em><br>'.'nom appareil : <input type="text" style="width:250px;margin-left:10px;" id="nom" value="'.$data["nom_appareil"].'"><br>maj_js : <input type="text" style="width:70px;margin-left:5px;" id="maj_js" value="'.$data["maj_js"].'"><em style="font-size:12px;margin-left:4px;">control,etat,onoff,temp,data,onoff+stop,on,popup</em><br>idx : <input type="text" style="width:50px;margin-left:10px;" id="idx" value="'.$data["idx"].'"><br>nom_objet : <input type="text" style="width:250px;margin-left:10px;" id="nom_objet" value="'.$data["nom_objet"].'"><br>idm : <input type="text" style="width:50px;margin-left:10px;" id="idm" value="'.$data["idm"].'"><br>Actif : <input type="text" style="width:30px;margin-left:10px;" id="actif" value="'.$data["Actif"].'"><em style="font-size:12px;margin-left:4px;">actif: inactif=0,dz=1 ou 2,ha=3,iobroker=4,iobroker+=5</em><br>ID : <input type="text" style="width:250px;margin-left:10px;" id="ha_id" value="'.$data["ID"].'"><br>id1_html : <input type="text" style="width:250px;margin-left:10px;" id="id1_html" value="'.$data["id1_html"].'"><br>id2_html : <input type="text" style="width:250px;margin-left:10px;" id="id2_html" value="'.$data["id2_html"].'"><br>coul_id1_id2_ON : <input type="text" style="width:250px;margin-left:10px;" id="coula" value="'.$data["coul_id1_id2_ON"].'"><br>coul_id1_id2_OFF : <input type="text" style="width:250px;margin-left:10px;" id="coulb" value="'.$data["coul_id1_id2_OFF"].'"><br>materiel : <input type="text" style="width:100px;margin-left:10px;" id="type_mat" value="'.$data["materiel"].'"><em style="font-size:12px;margin-left:4px;">zwave, zigbee, autres</em><br>lastseen : <input type="text" style="width:20px;margin-left:10px;" id="ls" value="'.$data["ls"].'"><em style="font-size:12px;margin-left:4px;">lastseen=1 sinon=0</em><br>class lampe: <input type="text" style="width:250px;margin-left:10px;" id="class" value="'.$data["class_lamp"].'"><br>coul_lamp_ON : <input type="text" style="width:250px;margin-left:10px;" id="coulc" value="'.$data["coul_lamp_ON"].'"><br>coul_lamp_OFF : <input type="text" style="width:250px;margin-left:10px;" id="could" value="'.$data["coul_lamp_OFF"].'"><br>mot_passe : <input type="text" style="width:130px;margin-left:10px;" id="pass" value="'.$data["pass"].'"><em style="font-size:12px;margin-left:4px;">pwdalarme, pwdcommand ou 0</em><br>fx: <input type="text" style="width:30px;margin-left:10px;" id="fx" value="'.$data["F()"].'"><br>nb car_max_id1 : <input type="text" style="width:40px;margin-left:10px;" id="car" value="'.$data["car_max_id1"].'"><br>Observations : <input type="text" style="width:290px;margin-left:10px;" id="obs" value="'.$data["observations"].'"><br><br><button type="button" onclick="adby(5)" style="width:50px;height:30px">Envoi</button> <form2>';	
//return $row; 
break;
case "8": 
		if ($data['ls']=="oui") {$ls=1;}
		else {$ls=0;}
$sql="UPDATE ".DISPOSITIFS." SET 
nom_appareil = '".$data['nom']."',
nom_objet = '".$data['nom_objet']."',
idx = '".$data['idx']."',
ID= '".$data['ID'] ."',
Actif = '".$data['actif'] ."',
materiel = '".$data['type_mat'] ."',
ls= '".$ls ."',
maj_js = '".$data['maj_js'] ."',
id1_html = '".$data['id1_html']."',
car_max_id1 = '".$data['car'] ."',
`F()` = ".intval($data['fx']) .",
id2_html= '".$data['id2_html'] ."',
coul_id1_id2_ON = '".$data['coula'] ."',
coul_id1_id2_OFF= '".$data['coulb'] ."',
class_lamp = '".$data['class']."',
coul_lamp_ON = '".$data['coulc'] ."',
coul_lamp_OFF = '".$data['could'] ."',
pass = '".$data['pass'] ."',
observations = '".$data['obs'] ."' WHERE idm = '".$data['idm']."' ; ";	
//echo $sql;return;
		$retour=maj_query($conn,$sql,"8");		
break;
case "9": 
		$sql="SELECT * FROM `".DISPOSITIFS."` WHERE num = '".$data['num']."' ;";
$result = $conn->query($sql);//if ($result === FALSE) {echo "pas id";return "";}
$row = $result->fetch_assoc();
$data=$row;	
echo '<form3><input type="hidden"id="app" value="var_bd"><input type="hidden"id="num" value="'.$data["num"].'"><input type="hidden" id="command3"  value="10"><em>valeurs enregistrées</em><br>'.'idm : <input type="text" style="width:45px;margin-left:10px;" id="idm" value="'.$data["idm"].'"><br>'.'idx : <input type="text" style="width:45px;margin-left:15px;" id="idx" value="'.$data["idx"].'"><br>ID : <input type="text" style="width:315Zpx;margin-left:17px;" id="ha_id" value="'.$data["ID"].'"><br>id="nom_objet" <input type="text" style="width:250px;margin-left:5px;" id="nom_objet" value="'.$data["nom_objet"].'"><br>id_image : <input type="text" style="width:150px;margin-left:10px;" id="id_img" value="'.$data["id1_html"].'"><br>id_texte   : <input type="text" style="width:150px;margin-left:17px;" id="id_txt" value="'.$data["id2_html"].'"><br><br><button type="button" onclick="adby(7)" style="width:50px;height:30px">Envoi</button> <form3>';			
break;
case "10": 
$sql="UPDATE ".DISPOSITIFS." SET 
nom_objet = '".$data['nom_objet']."',
idm = '".$data['idm']."',
idx = '".$data['idx']."',
ID= '".$data['ha_id'] ."',
id1_html = '".$data['id_img']."',
id2_html= '".$data['id_txt'] ."' WHERE num = '".$data['num']."' ; ";	
//echo $sql;return;
		$retour=maj_query($conn,$sql,"8");		
break;	
case "11": 
		$sql="SELECT * FROM `text_image` WHERE texte = '".$data['texte']."' ;";
$result = $conn->query($sql);//if ($result === FALSE) {echo "pas id";return "";}
$row = $result->fetch_assoc();
$data=$row;	
echo '<form4><input type="hidden" id="app" value="var_bd"><input type="hidden" id="command5"  value="12"><em>valeurs enregistrées</em><br>num : <input type="text" style="width:30px;margin-left:10px;" id="num" value="'.$data["num"].'"><br>texte : <input type="text" style="width:300px;margin-left:10px;" id="texte" value="'.$data["texte"].'"><br>image : <input type="text" style="width:300px;margin-left:5px;" id="image" value="'.$data["image"].'"><br>Icone : <input type="text" style="width:300px;margin-left:5px;" id="icone" value="'.$data["icone"].'"><br><br><br><button type="button" onclick="adby(9)" style="width:50px;height:30px">Envoi</button> </form4>';			
break;
case "12": 
$sql="UPDATE text_image SET 
texte = '".$data['texte']."',
image = '".$data['image']."',
icone= '".$data['icone'] ."'  WHERE num = '".$data['num']."' ; ";	
		$retour=maj_query($conn,$sql,"8");		
break;			
case "13": 
case "14": 	
	if ($choix==13)	{$sql="SELECT * FROM `".DISPOSITIFS."` WHERE ID1_html ='".$data['ID1_html']."' ;";}
	if ($choix==14)	{$sql="SELECT * FROM 2fa_token WHERE user_id = '".USERMONITOR."';";}
$result = $conn->query($sql);
if ($result === FALSE) {$row=[];
	if ($choix==14) $row['token']=0;}
else $row = $result->fetch_assoc();
return $row;	
break;	
case "15":
	$sql="UPDATE 2fa_token SET token = '".$data['token']."' WHERE user_id = '".USERMONITOR."';";
	$retour=maj_query($conn,$sql,"6");
	//echo $retour;
break;	
}		
$conn->close();		
return;}
//----------------------------------------
function maj_query($conn,$sql,$ind="0"){
$result = $conn->query($sql);					   
if ($ind=="4" || $ind==6) {return;}
	if ($result !== FALSE) {
  echo "record created/modified successfully<br>";	
} else {
  echo "Error: " . $sql . "<br>" . $conn->error;
}
if ($ind=="8" || $ind=="3") {return;}	
$sql="UPDATE dispositifs set idx=trim(idx);";$res = $conn->query($sql);
$sql="UPDATE dispositifs set idm=trim(idm);";$res = $conn->query($sql);
$sql="UPDATE dispositifs set ID=trim(ID);";$res = $conn->query($sql);	
echo "suppression des espaces effectué." ;	
return;}
// verifier que la table existe
function table_ok($conn,$table){
        $query = "SHOW TABLES FROM ".DBASE;
        $runQuery = $conn->query($query);
        
        $tables = array();
        while($row = mysqli_fetch_row($runQuery)){
            $tables[] = $row[0];
        }
        
        if(in_array($table, $tables)){
            return TRUE;
        }
    }
function reboot(){
$output = shell_exec('ssh '.LOGIN_PASS_RPI.'@'.IPRPI.' -t bash "sudo reboot"  >> /home/michel/sms.log 2>&1');	
	
}
function hex2rgb($hex) {
	$hex = str_replace("#", "", $hex);
	if(strlen($hex) == 3) {
		$r = hexdec(substr($hex,0,1).substr($hex,0,1));
		$g = hexdec(substr($hex,1,1).substr($hex,1,1));
		$b = hexdec(substr($hex,2,1).substr($hex,2,1));
	} else {
		$r = hexdec(substr($hex,0,2));
		$g = hexdec(substr($hex,2,2));
		$b = hexdec(substr($hex,4,2));
	}
	$rgb = array($r, $g, $b);
	return $rgb;
}
?>