<?php

function sql_plan($t1,$s="",$s1=""){global $L_dz, $l_dz, $L_ha, $l_ha,$L_iob, $l_iob,$IP_dz,$IP_ha,$IP_iob;
$n=0;$al_bat=0;$p=0;$idm_erreur=9000;
//$row['nom_objet']=$s;return $row;					 
	// SERVEUR SQL connexion
$conn = new mysqli(SERVEUR,UTILISATEUR,MOTDEPASSE,DBASE);
 if ($t1=='3')  {
	$sql="SELECT * FROM ".DISPOSITIFS." WHERE ID = '".$s1."' AND nom_objet = '".$s."' AND maj_js <> 'variable';";
	$result = $conn->query($sql);
	$row = $result->fetch_assoc();
	  return $row;}
else if ($t1=='2') {
	$sql="SELECT * FROM `".DISPOSITIFS."` WHERE ID = '$s' AND maj_js <> 'variable';";
		$result = $conn->query($sql);//if ($result === FALSE) {echo "pas id";return "";}
		$row = $result->fetch_assoc();
	return $row;}
else if ($t1=='1')  {
	$sql="SELECT * FROM `".DISPOSITIFS."` WHERE idx = '$s' AND maj_js <> 'variable';";
		$result = $conn->query($sql);$nb_rows=$result->num_rows;
		if ($nb_rows<1) {$row =  ['idx' => $s,
								 'idm' => $idm_erreur,
								 'Actif' => '9'
								];$idm_erreur++;}
		else $row = $result->fetch_assoc();
	return $row;}
else if ($t1=='0') {//$commande="On";
if ($l_ha != ""){
	$sql="SELECT * FROM dispositifs WHERE (`maj_js` LIKE '%on%' AND `maj_js` <> 'control' AND `ID` <> '' AND `Actif` <> 1 AND `Actif` <> 2 AND `Actif` <> 4);";
	$result = $conn->query($sql);
	while($row = $result->fetch_array(MYSQLI_ASSOC)){sql_1($row,'switches','ha');				  
	}				  
					 }
if ($l_dz != ""){
	$sql="SELECT * FROM dispositifs WHERE (`maj_js` LIKE '%on%' AND `maj_js` <> 'control' AND `idx` <> '' AND `Actif` <> 3 AND `Actif` <> 4);";
	$result = $conn->query($sql);
	while($row = $result->fetch_array(MYSQLI_ASSOC)){sql_1($row,'switches','dz');
		}
	}
if ($l_iob != ""){
	$sql="SELECT * FROM dispositifs WHERE (`maj_js` LIKE '%on%' AND `maj_js` <> 'control' AND `nom_objet` <> '' AND `Actif` <> 1 AND `Actif` <> 2 AND `Actif` <> 3);";
	$result = $conn->query($sql);
	while($row = $result->fetch_array(MYSQLI_ASSOC)){sql_1($row,'switches','iob');
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

if($ser_dom=="dz")$ser_dom=$row['idx'];
if($ser_dom=="ha")$ser_dom=$row['ID'];
if($ser_dom=="iob")$ser_dom=$row['ID'];		
if($row['id1_html']!='' && $row['id1_html']!='#' ){$s='$("'.$query.$row["id1_html"];
		if($row['id2_html']!=''){$s=$s.','.$query.$row['id2_html'];}
		if ($row['maj_js']=="onoff+stop") {$sl='").on("click", function (){$("#popup_vr").fadeIn(300);document.getElementById("VR").setAttribute("title","'.$row['idm'].'");document.getElementById("VR").setAttribute("rel","'.$row['idx'].'");})';}
       	if ($row['maj_js']=="on=") {$sl='").click(function(){'.$f.'("'.$row['Actif'].'","'.$row['idm'].'","'.$ser_dom.'",command,"'.$row['pass'].'");});';}	
		else {$sl='").click(function(){'.$f.'("'.$row['Actif'].'","'.$row['idm'].'","'.$ser_dom.'","'.$commande.'","'.$row['pass'].'");});';}		
		$s=$s.$sl;
		echo $s."\r\n" ;}
return;	
}
?>