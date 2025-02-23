<?php
//session_start();
require_once(MONCONFIG);
?>
<!-- -->
<!-- section administration -->
<!-- ================ -->
<div id="admin">
  <div class="container">
    <div class="col-md-12">
      <h1 id="about_admin" class="title text-center">Administration</h1>
      <p id="info_admin" >Avant d'entrer un mot de passe, faire un RAZ </p>
      <div id="d_btn_a" >
        <button type="button" id="btn_a" class="btn btn-primary"  data-toggle="modal" data-target="#pwdalarm"> Entrer votre mot de passe </button>
      </div>
      <?php
      include( "include/test_pass.php" ); // verif du mot de passe
      ?>
      <p id="admin2" style="margin-top:100px;display:<?php echo $style1;//voir test_pass.php?>"> <img src="images/logo.webp" style="position:relative;top:-30px;left:-20px;width:50px" alt="logo"/></p>
      <p id="admin3"><a class="admin1" href="#admin" title="reponse1" rel="7">CHANGER de MOT de PASSE</a><br>
        <a class="admin1" href="#admin" rel="5" title="reponse1" >Configuation monitor</a> <a><img class="info_admin" src="images/icon-info.svg" data-toggle="modal" data-target="#info-admin1" rel=1 style="width:25px;display:inline;"></a></p>
      <p id="admin4">
		<?php  
		  if (ECRAN_ADMIN['connect_lua']=="enable")echo '<img src="images/dz.webp" style="position:relative;top:0px;left:-10px;width:35px" alt="logo"/> <a class="admin1" href="#admin" rel="15" style="margin-left:30px" title="reponse1" >Mots passe cryptés(Base64) et IP réseau</a> <a><img class="info_admin" src="images/icon-info.svg" data-toggle="modal" data-target="#info-admin1" rel=6 style="width:25px;display:inline;"></a><br>'; 
         if (ECRAN_ADMIN['string_tableaux']=="enable")echo '<a class="admin1" href="#admin" rel="3" title="reponse1" >Configuation variables dz maj_services</a> <a><img class="info_admin" src="images/icon-info.svg" data-toggle="modal" data-target="#info-admin1" rel=5 style="width:25px;display:inline;"></a><br>';
        if (ECRAN_ADMIN['modect']=="enable")echo '<a class="admin1" href="#admin" rel="10" title="reponse1" >Configuation modect pour l\'alarme</a> <a><img class="info_admin" src="images/icon-info.svg" data-toggle="modal" data-target="#info-admin1" rel=4 style="width:25px;display:inline;"></a><br>';
        if (ECRAN_ADMIN['idx_dz_list']=="enable")echo '<a class="admin1" href="#admin" rel="12" title="reponse1" >Créer fichier idx/nom Domoticz , LISTE</a> <a><img class="info_admin" src="images/icon-info.svg" data-toggle="modal" data-target="#info-admin1" rel=3 style="width:25px;display:inline;"></a><br>';
        if (ECRAN_ADMIN['var_list']=="enable")echo '<a class="admin1" href="#admin" rel="19" title="reponse1" >LISTE variables</a> <a><img class="info_admin" 
		src="images/icon-info.svg" data-toggle="modal" data-target="#info-admin1" rel=10 style="width:25px;display:inline;"></a>';
		if (ECRAN_ADMIN['mod_py_list']=="enable")echo '<a class="admin1" href="#admin" rel="28" title="reponse1" >LISTE module Python</a> <a><img class="info_admin" src="images/icon-info.svg" data-toggle="modal" data-target="#info-admin1" rel=11 style="width:25px;display:inline;"></a><br>';  
        if (ECRAN_ADMIN['idx_dz-zigbee']=="enable")echo '<a class="admin1" href="#admin" rel="13" title="reponse1" >Créer fichier lasteen zwave/zigbee</a> <a><img class="info_admin" src="images/icon-info.svg" data-toggle="modal" data-target="#info-admin1" rel=2 style="width:25px;display:inline;"></a><br>';
        if (ECRAN_ADMIN['reboot_pi']=="enable")echo '<img src="images/rpi.webp" style="width:30px" alt="rpi"> <a class="admin1" href="#admin" rel="20" style="margin-left:35px" title="reponse1" >Reboot Raspberry</a><br>';
        if (ECRAN_ADMIN['msmtprc']=="enable")echo '<a class="admin1" href="#admin" rel="21" style="margin-left:70px" title="reponse1" >msmtprc (config envoi mail)</a><br>';
        if (ECRAN_ADMIN['connect_py']=="enable")echo '<a class="admin1" href="#admin" rel="23" style="margin-left:70px" title="reponse1" >Maj connect.py du PI </a><br>';
        if (DOMOTIC=="IOB" || DOMOTIC1=="IOB" || DOMOTIC2=="IOB")echo '<img src="images/iobroker.svg" style="width:30px"><a class="admin1" href="#admin" rel="26" title="reponse1" >Test Adaptateur io.Broker</a><br>';?> 
        <img src="images/serveur-sql.svg" style="width:30px"><a class="admin1" href="#admin" rel="9" title="reponse1" >Test Base de données</a><br>
		<a class="admin1" href="#admin" rel="14" title="reponse1" >Sauvegarde Base de données</a><br><a class="admin1" href="#admin" rel="27" title="reponse1" >Restauratio Base de données</a><br>
        <a class="admin1" href="#admin" rel="17" title="reponse2" >Enregistrer ou modifier Variables (dz,ha,iob) dans SQL&nbsp;</a> <a><img class="info_admin" src="images/icon-info.svg" data-toggle="modal" data-target="#info-admin1" rel=0 style="width:25px;display:inline;"></a><br>
        <a class="admin1" href="#admin" rel="18" title="reponse2" >Enregistrer ou modifier Dispositifs (dz,ha,iob) dans SQL&nbsp;</a> <a><img class="info_admin" src="images/icon-info.svg" data-toggle="modal" data-target="#info-admin1" rel=7 style="width:25px;display:inline;"></a><br>
		<a class="admin1" href="#admin" rel="25" title="reponse2" >Enregistrer Message DZ( ou HA) dans SQL&nbsp;&nbsp;</a> <a><img class="info_admin" src="images/icon-info.svg" data-toggle="modal" data-target="#info-admin1" rel=9 style="width:25px;display:inline;"></a><br>  
        <br>
       <a href="http://<?php echo PHPMYADMIN;?>" target="_blank"><img src="images/PhpMyAdmin_logo.svg" style="width:80px" alt=""/></a><br>
        <br>
        <a id="about"><img class="info_admin" src="images/about.svg" data-toggle="modal" data-target="#info-admin1" rel=8 alt="a Propos"/></a></p>
		<?php
		 if (SSE==true){echo '<p id="sse"><img style="width:30px;" src="images/mqtt.webp" />
		<p id="status"></p> <p id="messages"></p>';}?>
		
		<div id="reponse1"></div>
      <div id="reponse2" style="height:auto"></div>
    </div>
  </div>
</div>
<!--pour essai home Assistant -->
<div id="liste_var_hadz" style="position: relative;top:-400px;left:200px; display:none">
	<input class="styled" type="button" id="ldz" value="Domoticz"  />
	<input class="styled" type="button" id="lha" value="Home Assistant" />
    
</div>	
<p id="notify" style="color:darkblue;display:none" href="#admin">inter</p>
<p id="yyyessai" style="color:darkblue;display:none" href="#admin">inter1</p>
<?php
include( 'info_admin.php' );
?>
<!-- section Titre de la  Page admin-->
<div  id="reponse" style="position:relative;top:-650px;display:none;width=450px;left:10px;height:auto;" ></div>
