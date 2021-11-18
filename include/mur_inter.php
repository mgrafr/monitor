<?php
session_start();
$domaine=$_SESSION["domaine"];
if ($domaine==URLMONITOR) $lien_img="";
if ($domaine==IPMONITOR) $lien_img="/monitor";
?>
<!-- section Mur OnOff-->
<!-- ================ -->
		<div id="murinter" class="inter">
			<div class="container">
		<div class="col-md-12" >
	  <h1 class="title_ext text-center">Mur<span>  Commandes M/A</span></h1>
		<p class="txt_ext">certaines commandes peuvent éxiger,<br>
				un mot de passe</p>	
		<ul>
			<li style="margin-left:0;margin-top:10px"><img id="sw1" src="<?php echo $lien_img;?>/images/sejour.svg" width="60" height="auto" alt=""/>
			
			<li style="margin-left:0;margin-top:10px"><a href="#murinter"><img id="sw2" src="<?php echo $lien_img;?>/images/canape.svg" width="60" height="auto" alt=""/></a>
			
			<li style="margin-left:0;margin-top:10px"><img id="sw3" src="<?php echo $lien_img;?>/images/bureau.svg" width="60" height="60" alt=""/>
		
			<li style="margin-left:0;margin-top:10px"><img id="sw4" src="<?php echo $lien_img;?>/images/porte_garage.svg" width="60" height="auto" alt=""/>
			
			<li style="margin-left:0;margin-top:10px"><img id="sw5" src="<?php echo $lien_img;?>/images/portail.svg" width="60" height="60" alt=""/>
			
			<li style="margin-left:0;margin-top:10px"><a href="#murinter"><img id="sw6" src="<?php echo $lien_img;?>/images/arrosage.svg" width="60" height="auto" alt=""/></a>
			
			<li style="margin-left:0;margin-top:10px"><a href="#murinter"><img id="sw7" src="<?php echo $lien_img;?>/images/lampe_jardin.svg" width="60" height="auto" alt=""/></a>
		</ul>
</div>
</div>

</div>