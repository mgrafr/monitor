<?php
session_start();
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
		<p id="admin2" style="margin-top:100px;display:<?php echo $style1;//voir test_pass.php?>">
		<img src="images/logo.webp" style="position:relative;top:-30px;left:-20px;width:50px" alt="logo"/></p>
		<p id="admin3"><a class="admin1" href="#admin" title="reponse1" rel="7">CHANGER de MOT de PASSE</a><br>
		<a class="admin1" href="#admin" rel="5" title="reponse1" >Configuation monitor</a>
		<a><img class="info_admin" src="images/icon-info.svg" data-toggle="modal" data-target="#info-admin1" rel=1 style="width:25px;display:inline;"></a></p>
		<p id="admin4"><img src="images/dz.webp" style="position:relative;top:0px;left:-10px;width:35px" alt="logo"/>
		<a class="admin1" href="#admin" rel="15" style="margin-left:30px" title="reponse1" >Mots passe cryptés(Base64) et IP réseau</a>
		<a><img class="info_admin" src="images/icon-info.svg" data-toggle="modal" data-target="#info-admin1" rel=6 style="width:25px;display:inline;"></a><br>	
		<a class="admin1" href="#admin" rel="3" title="reponse1" >Configuation variables dz maj_services</a>
		<a><img class="info_admin" src="images/icon-info.svg" data-toggle="modal" data-target="#info-admin1" rel=5 style="width:25px;display:inline;"></a><br>
		<a class="admin1" href="#admin" rel="10" title="reponse1" >Configuation modect dz alarmes</a>
		<a><img class="info_admin" src="images/icon-info.svg" data-toggle="modal" data-target="#info-admin1" rel=4 style="width:25px;display:inline;"></a><br>
		<a class="admin1" href="#admin" rel="12" title="reponse1" >Créer fichier idx/nom Domoticz , LISTE</a>
		<a><img class="info_admin" src="images/icon-info.svg" data-toggle="modal" data-target="#info-admin1" rel=3 style="width:25px;display:inline;"></a><br>
		<a class="admin1" href="#admin" rel="19" title="reponse1" >LISTE variables</a>
		<a><img class="info_admin" src="images/icon-info.svg" data-toggle="modal" data-target="#info-admin1" rel=8 style="width:25px;display:inline;"></a><br>		
		<a class="admin1" href="#admin" rel="13" title="reponse1" >Créer fichier idx/nom Domoticz , TABLEAU zigbee</a>
		<a><img class="info_admin" src="images/icon-info.svg" data-toggle="modal" data-target="#info-admin1" rel=2 style="width:25px;display:inline;"></a><br>
		<img src="images/rpi.webp" style="width:30px" alt="rpi">
			<a class="admin1" href="#admin" rel="20" style="margin-left:35px" title="reponse1" >Reboot Raspberry</a><br>	
			<img src="images/serveur-sql.svg" style="width:30px"><br>
		<a class="admin1" href="#admin" rel="9" title="reponse1" >Test Base de données</a><br>
		<a class="admin1" href="#admin" rel="14" title="reponse1" >Sauvegarde Base de données</a><br>
		<a class="admin1" href="#admin" rel="17" title="reponse2" >Enregistrer Variable (DZ ou HA) dans SQL&nbsp;&nbsp;</a>
		<a><img class="info_admin" src="images/icon-info.svg" data-toggle="modal" data-target="#info-admin1" rel=0 style="width:25px;display:inline;"></a><br>
		<a class="admin1" href="#admin" rel="18" title="reponse2" >Enregistrer Dispositifs DZ( ou HA) dans SQL&nbsp;&nbsp;</a>
		<a><img class="info_admin" src="images/icon-info.svg" data-toggle="modal" data-target="#info-admin1" rel=7 style="width:25px;display:inline;"></a><br><br>
			<a href="http://<?php echo IPMONITOR;?>/phpmyadmin" target="_blank"><img src="images/PhpMyAdmin_logo.svg" style="width:80px" alt=""/></a></p>		
<div id="reponse1"></div>
<div id="reponse2" style="height:auto"></div>

</div>
	</div>
		</div> 
<p id="notify" style="color:darkblue" href="#admin">inter</p>
<p id="yyyessai" style="color:darkblue" href="#admin">inter1</p>
 <?php

include('info_admin.php');
?>
<!-- section Titre de la  Page admin-->
<div  id="reponse" style="position:relative;top:-650px;display:none;width=450px;left:10px;height:auto;" ></div>
