<?php
//session_start();
$domaine=$_SESSION["domaine"];
if ($domaine==URLMONITOR) {$lien_iobroker=URLIOB.'/webui/';$lien_iobroker1=URLIOB;}//header("Access-Control-Allow-Origin: 'https://monitoring.la-truffiere.ovh'");
if ($domaine==IPMONITOR) {$lien_iobroker='http://'.$IP_iob.':'.$port_webui_iob;$lien_iobroker1='http://'.$IP_iob.':'.substr($port_webui_iob, 0, 4);}



?>
<!-- section io.broker start -->
<!-- ================ -->
<div id="iobroker" >
	<div class="container">
		<div class="col-md-12">
	  <h1 id="about" class="title" style="position:relative;top:10px;">IO BROKER : <span style="color:blue">io.broker</span></h1>
			<p><a href="<?php echo $lien_iobroker1;?>" target="_blank" title="io.broker"><?php echo $lien_iobroker1;?></a></p>
			<p><a href="<?php echo $lien_iobroker.'runtime.html';?>" target="_blank" title="io.broker"><?php echo $lien_iobroker.'runtime.html';?></a></p> 
	  <iframe id="iobrokerapp" src="<?php echo $lien_iobroker.'runtime.html';?>" frameborder="0" ></iframe>
		       
		<div class="modal" id="infos"></div>
</div>
	</div>
		</div> 	

<!-- section io.broker fin-->

