<?php
$idm_erreur=9000;
function sql_plan($t1,$s="",$s1=""){global $L_dz, $l_dz, $L_ha, $l_ha,$L_iob, $l_iob, $L_zb, $l_zb, $IP_dz,$IP_ha,$IP_iob,$IP_zb,$idm_erreur;
$n=0;$al_bat=0;$p=0;$l_mo="";//$l_mo , en attente de update
//$row['nom_objet']=$s;return $row;					 
	// SERVEUR SQL connexion
$conn = new mysqli(SERVEUR,UTILISATEUR,MOTDEPASSE,DBASE);
if ($t1=='4')  {
	$sql="SELECT * FROM ".DISPOSITIFS." WHERE ID = '".$s."' AND Actif = '".$s1."' AND maj_js <> 'variable';";
	$result = $conn->query($sql);$n=0;$nb_rows=$result->num_rows;
	    $ligne = $result->fetch_assoc();
		$ligne['zbplus']=$nb_rows;
        return $ligne;}
 else if ($t1=='3')  {
	$sql="SELECT * FROM ".DISPOSITIFS." WHERE ID = '".$s1."' AND nom_objet = '".$s."' AND maj_js <> 'variable';";
	$result = $conn->query($sql);
	$row = $result->fetch_assoc();
	  return $row;}
else if ($t1=='2') {
	$sql="SELECT * FROM `".DISPOSITIFS."` WHERE ID = '$s' AND maj_js <> 'variable';";
		$result = $conn->query($sql);//if ($result === FALSE) {echo "pas id";return "";}
		$row = $result->fetch_assoc();
	return $row;}
else if ($t1=='1')  {$error1=="";
	$sql="SELECT * FROM `".DISPOSITIFS."` WHERE idx = '$s' AND maj_js <> 'variable';";
		$result = $conn->query($sql);$nb_rows=$result->num_rows;
		if ($nb_rows<1) {$row =  ['idx' => $s,
								 'idm' => strval($idm_erreur),
								 'Actif' => '9',
								 'values' => 'non enregitré'
								];$idm_erreur++;}
		else {$row = $result->fetch_assoc();if ($row['idm']=="") {$row['idm']=NULL;}
			if ($row['idm']===NULL) {$error1='enregitré sans idm';}
			if ($row['car_max_id1']<1 || $row['car_max_id1']=='') {$error1='car_max_id1 qbsent';}
			if ($error1!="") {$row =  ['idx' => $s,
								 'idm' => strval($idm_erreur),
								 'Actif' => '9',
								 'values' => $error1
								];$idm_erreur++;}
		}
	return $row;}
else if ($t1=='5')  {
	$sql="SELECT * FROM ".DISPOSITIFS." WHERE idm= '".$s."'";
	$result = $conn->query($sql);$row = $result->fetch_assoc();return $row;
	}
else if ($t1=='0') {
	$sql1="SELECT * FROM dispositifs WHERE (`maj_js` LIKE '%on%' AND `Actif` = ";
	if ($l_dz != "") {$u=2;
	$sql=$sql1.$u.");";$result = $conn->query($sql);
	while($row = $result->fetch_array(MYSQLI_ASSOC)){sql_1($row,'switches','dz');				  
		}	
	}
    if ($l_ha != ""){$u=3;
	$sql=$sql1.$u.");";$result = $conn->query($sql);
	while($row = $result->fetch_array(MYSQLI_ASSOC)){sql_1($row,'switches','ha');
		}
	}
if ($l_iob != ""){$u=4;
	$sql=$sql1.$u.");";$result = $conn->query($sql);
	while($row = $result->fetch_array(MYSQLI_ASSOC)){sql_1($row,'switches','iob');
		}
	}
if ($l_mo != ""){$u=5;// en attente de mes
	$sql=$sql1.$u.");";$result = $conn->query($sql);
	while($row = $result->fetch_array(MYSQLI_ASSOC)){sql_1($row,'switches','mo');
		}
	}
if ($l_zb != ""){$u=6;
	$sql=$sql1.$u.");";$result = $conn->query($sql);
	while($row = $result->fetch_array(MYSQLI_ASSOC)){sql_1($row,'switches','zb');
		}
	}
return;}
else echo "pas de serveur";
}
function sql_1($row,$f1,$ser_dom){
$commande="On";$query="#";
if ($row['maj_js']=="on"  && $ser_dom=="dz"){$commande="group on";}
if ($row['maj_js']=="on_level" && $ser_dom=="dz"){$commande="Set Level";}
if ($row['maj_js']=="on="){$query=".";$f='var command=$(this).attr("rel");'.$f1;$commande="command";}
else $f=$f1;
if ($row['Actif']=="6"){$str=explode(':',$row['param']);$commande=$str[1];}
$id_dom=$row['ID'];$id_dom=str_replace("\r\n","",$id_dom);
if($ser_dom=="dz"){$id_dom=$row['idx'];}
if($row['id1_html']!='' && $row['id1_html']!='#' ){$s='$("'.$query.$row["id1_html"];
		if($row['id2_html']!=''){$s=$s.','.$query.$row['id2_html'];}
		if ($row['maj_js']=="onoff+stop") {$sl='").on("click", function (){$("#popup_vr").fadeIn(300);document.getElementById("VR").setAttribute("title","'.$row['idm'].'");document.getElementById("VR").setAttribute("rel","'.$row['idx'].'");})';}
       	if ($row['maj_js']=="on=") {$sl='").click(function(){'.$f.'("'.$row['Actif'].'","'.$row['idm'].'","'.$id_dom.'",command,"'.$row['pass'].'");});';}	
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
