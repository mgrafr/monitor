<?php
function sql_plan($t){
// SERVEUR SQL connexion
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
else if ($t=='0') {$commande="On";
if (IPDOMOTIC1 == ""){echo "<!-- ha -->";}
if (IPDOMOTIC != ""){
	$sql="SELECT * FROM `".DISPOSITIFS."` WHERE `maj_js` LIKE '%onoff%' " ;
	$result = $conn->query($sql);//echo "/*";
	while($row = $result->fetch_array(MYSQLI_ASSOC)){
		if($row['id1_html']!=''){$s='$("#'.$row["id1_html"];}
		if($row['id2_html']!=''){$s=$s.',#'.$row['id2_html'];}
		if ($row['maj_js']=="onoff+stop") {$sl='").on("click", function (){$("#popup_vr").fadeIn(300);document.getElementById("VR").setAttribute("title","'.$row['idm'].'");document.getElementById("VR").setAttribute("rel","'.$row['idx'].'");})';}
       	else {$sl='").click(function(){switchOnOff_setpoint("'.$row['idm'].'","'.$row['idx'].'","'.$commande.'","'.$row['pass'].'");});';}
		$s=$s.$sl;
		echo $s."\r\n" ;}
//echo "*/";}
	}return;}
else echo "pas d'id_dz";
}
?>