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
	  <h1 id="about_p" class="title" >Dispositifs : <span style="color:blue">Zigbee</span></h1>
	  <p><?php echo $lien_zigbee;?></p>
		         <iframe id="zbmqtt" src="<?php echo $lien_zigbee;?>" frameborder="0" ></iframe>
		<div class="modal" id="infos"></div>
</div>
	</div>
		</div> 		
<!-- section zigbee fin-->


