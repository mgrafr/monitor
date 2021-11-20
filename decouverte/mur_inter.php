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
		<p class="txt_ext">Connecté à Domoticz (image à gauche),les couleurs indique une position ON<br>
le script pour assurer les commandes ON/OFF est automatique<br>
à partir de la base de données</p>
		
<p><img style="position:relative;top:70px;left50px;" src="decouverte/images/image6.jpg" style="width:400px" alt="img6"></p>
</div>
</div>

</div>