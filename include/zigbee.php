<?php
//session_start();
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
	  <p style="margin-top: -40px;"><?php echo $lien_zigbee;?></p>
		         <iframe id="zbmqtt" src="<?php echo $lien_zigbee;?>" frameborder="0" ></iframe>
		<div class="modal" id="infos"></div>
</div>
	</div>
		</div> 		
<!-- section zigbee fin-->


