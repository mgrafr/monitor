<?php 
session_start();
require_once (MONCONFIG);
error_reporting(-1);
date_default_timezone_set('UTC');
$today = new datetime();
$t=time();
echo(date("Y-m-d",$t))."<br>";
$period=$today->modify('-1 days')->format('Y-m-d H:i:s');// hier format datetime sql
if (($periode==48)|| ($periode=="infos_bd")){$period=$today->modify('-2 days')->format('Y-m-d H:i:s');echo $period;}
elseif ($periode==7) {$period=$today->modify('-7 days')->format('Y-m-d H:i:s');}//semaine derniere
elseif ($periode==31) {$period=$today->modify('-1 month')->format('Y-m-d H:i:s');}//mois précédent
elseif ($periode==365) {$period=$today->modify('-1 year')->format('Y-m-d H:i:s');}//année derniere
// SERVEUR SQL
// connexion
$conn = new mysqli(SERVEUR,UTILISATEUR,MOTDEPASSE,DBASE);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error . "<br>");
}
echo "Connected successfully<br>";
$sql="SELECT * FROM `".$device."` WHERE `date` >= '".$period."'" ;
$result = $conn->query($sql);
$number = $result->num_rows;
$xdate=array();
$yvaleur=array();
$hj=$periode;
if ($hj=="infos_bd") {$hj="";}
elseif (($hj=="24") || ($hj=="48")) {$hj=$hj." H";}
else {$hj=$hj." J";}
if ($result->num_rows > 0) {echo "table : ".$device." ".$hj."<br>";
    // output data of each row
    while($row = $result->fetch_assoc()) {
        if($periode=="infos_bd"){$xdate[]= $row["date"];}
		else {$xdate[]= strtotime($row["date"]);}
		$yvaleur[]=$row["valeur"];
    }
	} 
	else {echo "0 results";}
$conn->close();
?>
