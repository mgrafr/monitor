<?php
//session_start();
$domaine=$_SESSION["domaine"];
if ($domaine==URLMONITOR) $lien_img="";
if ($domaine==IPMONITOR) $lien_img="/monitor";
if(DOMOTIC=='DZ') {$lien_dz= IPDOMOTIC; }
elseif(DOMOTIC1=='DZ') {$lien_dz= IPDOMOTIC1; }
elseif(DOMOTIC2=='DZ') {$lien_dz= IPDOMOTIC2; }
?>
<!-- section App diverses start -->
<!-- ================ -->
		<div id="app_diverses" class="app_div">
			<div class="container">
		<div class="col-md-12">
	  <h1 class="title_ext text-center">App<span>  diverses</span></h1><br>
	  <img src="<?php echo $lien_img;?>/images/dz.webp" style="width:50px;height:auto;margin:10px 0 10px 120px" alt="dz">
	  IP: <?php echo $lien_dz;?>
		<form2>
		<p class="txt_app"><input type="button" rel="1" style="margin-left: 60px;" class="btn_appd" value="afficher fichier log normal"></p>	
		<p class="txt_app"><input type="button" rel="2" style="margin-left: 60px;" class="btn_appd" value="afficher fichier log statut"></p>
		<p class="txt_app"><input type="button" rel="4" style="margin-left: 60px;" class="btn_appd" value="afficher fichier log erreur"></p>
		<img src="<?php echo $lien_img;?>/images/nagios.webp" style="width:100px;height:auto;margin:10px 0 10px 100px" alt="dz">
		<p class="txt_app"><input type="button" rel="hostlist" style="margin-left: 60px;" class="btn_appd" value="afficher hosts Nagios"></p>
		<img src="<?php echo $lien_img;?>/images/serveur-sql.svg" style="width:40px;height:auto;margin:0 0 10px 118px" alt="dz">
		<p class="txt_app"><input type="button" rel="sql" title="date_poub" style="margin-left: 60px;" class="btn_appd" value="afficher historique poubelles"></p>
		</form>
</div>
</div>

</div>
		