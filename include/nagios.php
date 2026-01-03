<?php
//session_start();
$domaine=$_SESSION["domaine"];
if ($domaine==URLMONITOR) $lien_nagios=URLNAGIOS;//header("Access-Control-Allow-Origin: 'https://monitoring.la-truffiere.ovh'");
if ($domaine==IPMONITOR) $lien_nagios=IPNAGIOS;



?>
<!-- section monitoring start -->
<!-- ================ -->
<div id="nagios" >
	<div class="container">
		<div class="col-md-12">
	  <h1 id="about_p" class="title" >Monitoring : <span style="color:blue">NAGIOS</span></h1>
	  <div id="ping_pi4" title="Ping PI4"><?php include ("ping_pi4_svg.php");?></div>
	  <iframe id="nagiosapp" src="<?php echo $lien_nagios;?>" frameborder="0" ></iframe>
		       
		<div class="modal" id="infos"></div>
</div>
	</div>
		</div> 	

<!-- section monitoring fin-->

