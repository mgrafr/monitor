<?php
session_start();
$domaine=$_SESSION["domaine"];
if ($domaine==URLMONITOR) $lien_img="";
if ($domaine==IPMONITOR) $lien_img="/monitor";
?>
<!-- section App diverses start -->
<!-- ================ -->
		<div id="app_diverses" class="app_div">
			<div class="container">
		<div class="col-md-12">
	  <h1 class="title_ext text-center">App<span>  diverses</span></h1><br>
	  <img src="<?php echo $lien_img;?>/images/dz.png" style="width:50px;height:auto;margin:10px 0 10px 120px" alt="dz">
		<form>
		<p class="txt_app"><input type="button" rel="1" style="margin-left: 60px;" class="btn_appd" value="afficher fichier log normal"></p>	
		<p class="txt_app"><input type="button" rel="2" style="margin-left: 60px;" class="btn_appd" value="afficher fichier log statut"></p>
		<p class="txt_app"><input type="button" rel="4" style="margin-left: 60px;" class="btn_appd" value="afficher fichier log erreur"></p>
		<img src="<?php echo $lien_img;?>/images/nagios.png" style="width:100px;height:auto;margin:10px 0 10px 100px" alt="dz">
		<p class="txt_app"><input type="button" rel="hostlist" style="margin-left: 60px;" class="btn_appd" value="afficher hosts Nagios"></p>
		</form><br>
		
</div>
</div>
<p>D'autres APP peuvent être installées</p>  
</div>
		