<?php
session_start();
$domaine=$_SESSION["domaine"];
if ($domaine==URLMONITOR) $lien_zwave=URLZWAVE;
if ($domaine==IPMONITOR) $lien_zwave=IPZWAVE;
?>
<!-- section zwavejs2mqtt start -->
<!-- ================ -->
<div id="zwave" >
	<div class="container">
		<div class="col-md-12">
	  <h1 id="about" class="title" style="position:relative;top:-30px;">Dispositifs : <span style="color:blue">Zwave</span></h1>
		         <iframe id="zwmqtt" src="<?php echo $lien_zwave;?>" frameborder="0"></iframe>
		<div class="modal" id="infos"></div>
</div>
	</div>
		</div> 		
<!-- section zigbee fin-->


