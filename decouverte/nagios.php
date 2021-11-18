<?php
session_start();
$domaine=$_SESSION["domaine"];
if ($domaine==URLMONITOR) $lien_nagios=URLNAGIOS;//header("Access-Control-Allow-Origin: 'https://monitoring.la-truffiere.ovh'");
if ($domaine==IPMONITOR) $lien_nagios='http://'.IPNAGIOS;



?>
<!-- section monitoring start -->
<!-- ================ -->
<div id="nagios" >
	<div class="container">
		<div class="col-md-12">
	  <h1 id="about" class="title" style="position:relative;top:-30px;">Monitoring : <span style="color:blue">NAGIOS<span style="font-size:14px">à droite icone de survillance du PI</span></h1>
	  Affichage de la version standart , la version tablette peut être affichée</p>  
	  <div id="ping_pi4" title="Ping PI4"><?php include ("ping_pi4_svg.php");?></div>
	  <p><img  src="decouverte/images/image9.jpg" style="width:480px;position: relative;
top: -60px;" alt="img8"></p>
		       
		<div class="modal" id="infos"></div>
</div>
	</div>
		</div> 	

<!-- section monitoring fin-->

