<?php
session_start();
?>
<!-- section administration -->
<!-- ================ -->
<div id="admin">
	<div class="container">
		<div class="col-md-12">
	  <h1 id="about_admin" class="title text-center">Administration</h1>
		<p>Avant d'entrer un mot de passe, faire un RAZ </p>
		<div id="d_btn_admin" style="display:none;"><button type="button" id="btn_admin" style="background-color: #4d4d4d;
border-color: #e0e3e6;border-radius: 0.55rem" class="btn btn-primary"  data-toggle="modal" data-target="#pwdalarm">
Entrer votre mot de passe 
</button></div>
		 <?php
			$_SESSION["pec"]="admin";
			include('test_pass.php');
						?>
		<p id="admin1" style="margin-top:100px;display:<?php echo $style1;?>">
		<a class="admin1" href="#admin" title="reponse1" rel="7">CHANGER de MOT de PASSE</a><br>
		<a class="admin1" href="#admin" title="reponse1" rel="1">récupération variables domoticz dans fichier json(var_dz.json)</a><br>
		<a class="admin1" href="#admin" rel="2" title="reponse" >création variables domoticz depuis fichier json(var_dz.json)</a><br>
		<a class="admin1" href="#admin" rel="3" title="reponse" >Configuation variables dz maj_services</a><br>
		<a class="admin1" href="#admin" rel="10" title="reponse" >Configuation modect dz alarmes</a><br>
		<a class="admin1" href="#admin" rel="5" title="reponse" >Configuation monitor</a></p>
		<a class="admin1" href="#admin" rel="9" title="reponse" >Test Base de données</a></p>
<div id="reponse1" style="background-color: beige;position:relative;top:-230px;display:none;width=450px;left:0;height:auto;" ></div>


</div>
	</div>
		</div> 
 
<!-- section Titre de la  Page admin-->
<div  id="reponse" style="position:relative;top:-650px;display:none;width=450px;left:10px;height:auto;" ></div>
