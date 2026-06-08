<?php
$idm_erreur=9000;
//ATTENTION aux arguments sql_plan est aussi lancé par footer.php
function sql_plan($t1,$s,$s1,$s2){global $L_dz, $l_dz, $L_ha, $l_ha,$L_iob, $l_iob, $L_zb, $l_zb, $IP_dz,$IP_ha,$IP_iob,$IP_zb,$idm_erreur;
$n=0;$al_bat=0;$p=0;$l_mo="";//$l_mo , en attente de update
//$row['nom_objet']=$s;return $row;					 
	// SERVEUR SQL connexion
$conn = new mysqli(SERVEUR,UTILISATEUR,MOTDEPASSE,DBASE);
switch ($t1) {
	case "zb" :
	$sql="SELECT * FROM `".DISPOSITIFS."` WHERE ID = '$s' AND Actif = '".$s1."' AND maj_js <> 'variable';";	
	$result = $conn->query($sql);$n=0;$nb_rows=$result->num_rows;
	    $row = $result->fetch_assoc();
		$row['zbplus']=$nb_rows;
        return $row;
	break;
	case "iob" :
	$sql="SELECT * FROM ".DISPOSITIFS." WHERE ID = '".$s."' AND Actif = '".$s1."' AND maj_js <> 'variable';";
	$result = $conn->query($sql);
	$row = $result->fetch_assoc();
	return $row;
	break; 
	case "ha" :
	$sql="SELECT * FROM `".DISPOSITIFS."` WHERE ID = '$s' AND Actif = '".$s1."' AND maj_js <> 'variable';";
		$result = $conn->query($sql);//if ($result === FALSE) {echo "pas id";return "";}
		$row = $result->fetch_assoc();
	return $row;
	break;
	case "dz" :$error1=="";
	$sql="SELECT * FROM `".DISPOSITIFS."` WHERE idx = '$s' AND Actif = '".$s1."' AND maj_js <> 'variable';";
		$result = $conn->query($sql);$nb_rows=$result->num_rows;
		if ($nb_rows>0) {$row = $result->fetch_assoc();
			if ($row['idm']=="") {$row['idm']=NULL;}
			if ($row['idm']===NULL) {$error1='enregitré sans idm';}
			if ($row['car_max_id1']<1 || $row['car_max_id1']=='') {$error1='car_max_id1 absent';}
			if ($row['idx'] != $s) {$error1='Les idx sont différents:'.$row['idx']." ".$s;}
			if ($error1!="") {$row =  ['idx' => $s,
								 'nom' => $row['nom_objet'],
								 'idm' => strval($idm_erreur),
								 'Actif' => '9',
								 'values' => $error1
								];$idm_erreur++;}
		}
	return $row;
	break;
	case "mo" :
	$sql="SELECT * FROM ".DISPOSITIFS." WHERE idm= '".$s."'";
	$result = $conn->query($sql);$row = $result->fetch_assoc();
	return $row;
	break;
	case "0" :
	$sql="SELECT * FROM dispositifs WHERE `maj_js` LIKE 'on%' ";
	$result = $conn->query($sql);
	while($row = $result->fetch_array(MYSQLI_ASSOC)){sql_1($row,'switches');}
	return;
	break;
	default :
	echo "pas de serveur";
	break;
} }
function sql_1($row,$f1){
$commande="On";$query="#";$u=$row['Actif'];
if ($row['maj_js']=="on"  && $u=="2"){$commande="group on";}
if ($row['maj_js']=="on_level" && $u=="2"){$commande="Set Level";}
if ($row['maj_js']=="on="){$query=".";$f='var command=$(this).attr("rel");'.$f1;$commande="command";}
else $f=$f1;
if ($u=="6"){$str=explode(':',$row['param']);$commande=$str[1];}
$id_dom=$row['ID'];$id_dom=str_replace("\r\n","",$id_dom);
if($ser_dom=="dz"){$id_dom=$row['idx'];}
if($row['id1_html']!='' && $row['id1_html']!='#' ){$s='$("'.$query.$row["id1_html"];
	if($row['id2_html']!=''){$s=$s.','.$query.$row['id2_html'];}
		if ($row['maj_js']=="onoff+stop") {$sl='").on("click", function (){let c_rel=$(this).attr("rel");switches("'.$row['Actif'].'","'.$row['idm'].'","'.$row['idx'].'",c_rel,pass="0")});';}
       	else if ($row['maj_js']=="on=") {$sl='").click(function(){'.$f.'("'.$row['Actif'].'","'.$row['idm'].'","'.$id_dom.'",command,"'.$row['pass'].'");});';}	
		else {$sl='").click(function(){'.$f.'("'.$row['Actif'].'","'.$row['idm'].'","'.$id_dom.'","'.$commande.'","'.$row['pass'].'");});';}		
		$s=$s.$sl;
		echo $s."\r\n" ;}
return;	
}
function zb_champ($champ){
$zb_d=array();
$zb_d = [
	'state' => "Data",
    'state_l2' => "Data",
    'state_l1' => "Data",
	'temperature' => "temperature",
	'humidity' => "humidity",
    'soil_moisture' => "Data",
	'battery_state' => "BatteryLevel",
	'contact' => "Data",
	'occupancy' => "occupancy"
    ];  
return $zb_d[$champ];
}
?>
