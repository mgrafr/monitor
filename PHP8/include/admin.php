<?php
//session_start();
?>
<!-- section administration -->
<!-- ================ -->
<div id="admin">
	<div class="container">
		<div class="col-md-12">
	  <h1 id="about_admin" class="title text-center">Administration</h1>
		<p id="info_admin" >Avant d'entrer un mot de passe, faire un RAZ </p>
		<div id="d_btn_a" ><button type="button" id="btn_a" class="btn btn-primary"  data-toggle="modal" data-target="#pwdalarm">
Entrer votre mot de passe 
</button></div>
		 <?php
			//$_SESSION["pec"]="admin";
			//include('test_pass.php');
						?>
		<p id="admin1" style="margin-top:100px;display:<?php echo $style1;?>">
		<a class="admin1" href="#admin" title="reponse1" rel="7">CHANGER de MOT de PASSE</a><br>
		<a class="admin1" href="#admin" title="reponse1" rel="1">récupération variables domoticz dans fichier json(var_dz.json)</a><br>
		<a class="admin1" href="#admin" rel="2" title="reponse1" >création variables domoticz depuis fichier json(var_dz.json)</a><br>
		<a class="admin1" href="#admin" rel="3" title="reponse1" >Configuation variables dz maj_services</a><br>
		<a class="admin1" href="#admin" rel="10" title="reponse1" >Configuation modect dz alarmes</a><br>
		<a class="admin1" href="#admin" rel="12" title="reponse1" >Créer fichier idx/nom Domoticz , LISTE</a><br>
		<a class="admin1" href="#admin" rel="13" title="reponse1" >Créer fichier idx/nom Domoticz , TABLEAU zigbee</a><br>
		<a class="admin1" href="#admin" rel="5" title="reponse1" >Configuation monitor</a><br><br>
		<a class="admin1" href="#admin" rel="9" title="reponse1" >Test Base de données</a><br>
		<a class="admin1" href="#admin" rel="14" title="reponse1" >Sauvegarde Base de données</a></p>
<div id="reponse1"></div>


</div>
	</div>
		</div> 
 
<!-- section Titre de la  Page admin-->
<div  id="reponse" style="position:relative;top:-650px;display:none;width=450px;left:10px;height:auto;" ></div>
