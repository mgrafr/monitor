<?php
session_start();
$domaine=$_SESSION["domaine"];
if ($domaine==URLMONITOR) $lien_zigbee=URLZIGBEE;
if ($domaine==IPMONITOR) $lien_zigbee=IPZIGBEE;
?>
<!-- section zigbee2mqtt start -->
<!-- ================ -->
<div id="zigbee" >
	<div class="container">
		<div class="col-md-12">
	  <h1 id="about" class="title" style="position:relative;top:-30px;">Dispositifs : <span style="color:blue">Zigbee</span></h1>
		       <p><img  src="decouverte/images/image8.jpg" style="width:480px" alt="img8"><br>Affichage du Fronted de Zigbee2mqtt<br></p>  
		
</div>
	</div>
		</div> 		
<!-- section zigbee fin-->


