<?php
//session_start();
$domaine=$_SESSION["domaine"];
if ($domaine==URLMONITOR) $lien_habridge=URLHABRIDGE;//header("Access-Control-Allow-Origin: 'https://monitoring.la-truffiere.ovh'");
if ($domaine==IPMONITOR) $lien_habridge=IPHABRIDGE;



?>
<!-- section pont HUE start -->
<!-- ================ -->
<div id="habridge" >
	<div class="container">
		<div class="col-md-12">
	  <h1 id="about" class="title" style="position:relative;top:10px;">Pont HUE : <span style="color:blue">Ha-bridge</span></h1>
	  <iframe id="habridgeapp" src="<?php echo $lien_habridge;?>" frameborder="0" ></iframe>
		       
		<div class="modal" id="infos"></div>
</div>
	</div>
		</div> 	

<!-- section pont HUE fin-->

