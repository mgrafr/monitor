<?php 
session_start();
require_once (MONCONFIG);
error_reporting(-1);
date_default_timezone_set('UTC');
$today = new datetime();
$t=time();
if ($periode!="text_svg") {echo(date("Y-m-d",$t))."<br>";}
$period=$today->modify('-14 days')->format('Y-m-d H:i:s');// hier format datetime sql
if ($periode==48){$period=$today->modify('-2 days')->format('Y-m-d H:i:s');}
elseif ($periode==7) {$period=$today->modify('-7 days')->format('Y-m-d H:i:s');}//semaine derniere
elseif ($periode==31) {$period=$today->modify('-1 month')->format('Y-m-d H:i:s');}//mois précédent
elseif ($periode==365) {$period=$today->modify('-1 year')->format('Y-m-d H:i:s');}//année derniere
echo $period;
// SERVEUR SQL
// connexion
$conn = new mysqli(SERVEUR,UTILISATEUR,MOTDEPASSE,DBASE);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error . "<br>");
}
if ($periode=="text_svg") {echo '<text transform="matrix(1 0 0 1 0 0)" class="spa2 spa3">Connected</text>';}
else {echo "Connected successfully<br>";}//modif 2022
if ($periode=="infos_bd") {$sql="SELECT * FROM `".$device."` WHERE `date` >= '".$period."' ORDER BY `date` ASC" ;}
else {$sql="SELECT * FROM `".$device."` WHERE `date` >= '".$period."'" ;}					   
$result = $conn->query($sql);
$number = $result->num_rows;
$xdate=array();
$yvaleur=array();
$hj=$periode;
if ($hj=="infos_bd" || $hj=="text_svg") {$hj="";}// modif nov 2022
elseif (($hj=="24") || ($hj=="48")) {$hj=$hj." H";}
else {$hj=$hj." J";}
if ($result->num_rows > 0) {if ($periode!="text_svg") {echo "table : ".$device." champ :".$champ." ".$hj."<br>";}
    // output data of each row
    while($row = $result->fetch_assoc()) {
        if($periode=="infos_bd" || $periode=="text_svg"){$xdate[]= $row["date"];}//modif 2022
		
		else {$xdate[]= strtotime($row["date"]);}
		$yvaleur[]=$row[$champ];
    }
	} 
	else {echo "0 results";}
$conn->close();
?>
