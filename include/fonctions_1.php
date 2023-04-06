<?php
function sql_plan($t){// SERVEUR SQL connexion
$conn = new mysqli(SERVEUR,UTILISATEUR,MOTDEPASSE,DBASE);
 if (($t!='0')  && (strlen($t) < 4)) {
	$sql="SELECT * FROM `".DISPOSITIFS."` WHERE idx = '$t' AND maj_js <> 'variable';";
	$result = $conn->query($sql);
	$row = $result->fetch_assoc();return $row;}
else if ($t!='0'  && strlen($t) > 3) {
	$sql="SELECT * FROM `".DISPOSITIFS."` WHERE ID = '$t' AND maj_js <> 'variable';";
		$result = $conn->query($sql);//if ($result === FALSE) {echo "pas id";return "";}
		$row = $result->fetch_assoc();
	return $row;}
else if ($t=='0') {//$commande="On";
				   
				   
if (IPDOMOTIC1 != ""){echo "<!-- ha -->";echo  "<!---------->";
	$sql="SELECT * FROM dispositifs WHERE (`maj_js` LIKE '%onoff%' AND `ID` <> '');";
	$result = $conn->query($sql);
	while($row = $result->fetch_array(MYSQLI_ASSOC)){sql_1($row,'turnonoff','ha');				  
	/*if($row['id1_html']!=''){$s='$("#'.$row["id1_html"];}
	if($row['id2_html']!=''){$s=$s.',#'.$row['id2_html'];}
	if ($row['maj_js']=="onoff+stop") {$sl='").on("click", function (){$("#popup_vr").fadeIn(300);document.getElementById("VR").setAttribute("title","'.$row['idm'].'");document.getElementById("VR").setAttribute("rel","'.$row['ID'].'");})';}
	else {$sl='").click(function(){turnonoff("'.$row['idm'].'","'.$row['ID'].'","'.$commande.'","'.$row['idm'].'");});';}		  
	$s=$s.$sl;
		echo $s."\r\n" ;*/}				  
					 }
if (IPDOMOTIC != ""){echo "<!-- dz -->";echo  "<!---------->";
	$sql="SELECT * FROM dispositifs WHERE (`maj_js` LIKE '%onoff%' AND `idx` <> '');";
	$result = $conn->query($sql);//echo "/*";
	while($row = $result->fetch_array(MYSQLI_ASSOC)){sql_1($row,'switchOnOff_setpoint','dz');
		/*if($row['id1_html']!=''){$s='$("#'.$row["id1_html"];}
		if($row['id2_html']!=''){$s=$s.',#'.$row['id2_html'];}
		if ($row['maj_js']=="onoff+stop") {$sl='").on("click", function (){$("#popup_vr").fadeIn(300);document.getElementById("VR").setAttribute("title","'.$row['idm'].'");document.getElementById("VR").setAttribute("rel","'.$row['idx'].'");})';}
       	else {$sl='").click(function(){switchOnOff_setpoint("'.$row['idm'].'","'.$row['idx'].'","'.$commande.'","'.$row['pass'].'");});';}		
		$s=$s.$sl;
		echo $s."\r\n" ;*/}
//echo "*/";}
	}
	
return;}
else echo "pas d'id_dz";
}
function sql_1($row,$f,$ser_dom){
$commande="On";
if($ser_dom="dz")$ser_dom=$row['idx'];
if($ser_dom="ha")$ser_dom=$row['ID'];	
if($row['id1_html']!=''){$s='$("#'.$row["id1_html"];}
		if($row['id2_html']!=''){$s=$s.',#'.$row['id2_html'];}
		if ($row['maj_js']=="onoff+stop") {$sl='").on("click", function (){$("#popup_vr").fadeIn(300);document.getElementById("VR").setAttribute("title","'.$row['idm'].'");document.getElementById("VR").setAttribute("rel","'.$row['idx'].'");})';}
       	else {$sl='").click(function(){'.$f.'("'.$row['idm'].'","'.$ser_dom.'","'.$commande.'","'.$row['pass'].'");});';}		
		$s=$s.$sl;
		echo $s."\r\n" ;	
return;	
}
?>