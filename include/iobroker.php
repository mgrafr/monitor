<?php
//session_start();
$domaine=$_SESSION["domaine"];
if ($domaine==URLMONITOR) {$lien_iobroker=URLIOB[1].'/vis-2/index.html#Page1';$lien_iobroker1=URLIOB[0];
						   $lien_iobroker2=URLIOB[1];}
if ($domaine==IPMONITOR) {$lien_iobroker='http://'.$IP_iob.':'.$port_webui_iob;
						  $lien_iobroker1='http://'.$IP_iob.':'.substr($port_webui_iob, 0, 4);}

?>
<!-- section io.broker start -->
<!-- ================ -->
<div id="iobroker" >
	<div class="container">
		<div class="col-md-12">
	  <h1 id="about" class="title" style="position:relative;top:10px;">IO BROKER :
		  <span style="color:blue">io.broker</span></h1>
			<p><a href="<?php echo $lien_iobroker1;?>" target="_blank" title="io.broker">
				<?php echo $lien_iobroker1;?></a><br>
			<a href="<?php echo $lien_iobroker2;?>" target="_blank" title="io.broker">
				<?php echo $lien_iobroker2;?></a><br>	
			<a href="<?php echo $lien_iobroker;?>" target="_blank" title="io.broker">
				<?php echo $lien_iobroker;?></a></p> 
<iframe id="iobrokerapp" src="<?php echo $lien_iobroker;?>" frameborder="0" ></iframe>
	
</div>
	</div>
		</div> 	

<!-- section io.broker fin-->

