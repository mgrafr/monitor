<?php
//session_start();
require_once('admin/config.php');
?>
<!-- -->
<!-- section administration -->
<!-- ================ -->
<div id="administration">
  <div class="columns">
  <div class="column is-11" style="margin-left:7%">
      <h1 id="about_admin" class="text-c">Administration</h1>
		<p> <?php echo MONCONFIG;?></p>
      <p id="info_admin" >Avant d'entrer un mot de passe, faire un RAZ </p>
      <div id="d_btn_a" >
        <button class="button is-primary btn_appd" rel="passwd">
              Entrer votre mot de passe
            </button>
      </div>
      <?php
      include( "include/test_pass.php" ); // verif du mot de passe
      ?>
      <p id="admin2" style="display:<?php echo $style1;//voir test_pass.php?>"> <img src="images/logo.webp" style="position:relative;top:-30px;left:-20px;width:50px" alt="logo"/>
      <button type="button" id="admin1" class="button is-danger btn_appd" title="7" rel="admin" data-titre="Changer mot de passe" data-class="modal chang_mdp">CHANGER de MOT de PASSE</button><br>
      <P class="top-30"><button type="button" id="admin3" class="button is-link is-light btn_appd" rel="admin" title="5" data-titre="Configuration Monitor" >Configuation monitor</button><img class="btn_appd space5" src="images/icon-info.svg" rel="info_adm" title="1" data-titre="Configuration Monitor"">
      </p>
      <p id="admin4"><img  class="logo_dz" src="images/dz.webp" alt="logo"/>
      
		<?php  
		  if (ECRAN_ADMIN['connect_lua']=="enable")echo '<button type="button" class="button is-link is-light btn_appd but1" rel="admin" title="15" data-titre="Mots de passe & IP" style="
    margin-left:-15px;">Mots passe IP réseau</button><img class="btn_appd space5" src="images/icon-info.svg" rel="info_adm" title="6" data-titre="Mots de passe & IP""><br>'; 
         if (ECRAN_ADMIN['string_tableaux']=="enable")echo '<button type="button" class="button is-link is-light btn_appd but2" rel="admin" title="3" data-titre="Configuation variables dz" >Configuation variables dz </button><img class="btn_appd" src="images/icon-info.svg" data-titre="Configuation variables" rel="info_adm" title="5""><br>';
        if (ECRAN_ADMIN['modect']=="enable")echo '<button type="button" class="button is-link is-light btn_appd but3" rel="admin" title="10" data-titre="Configuation modect">Configuation modect pour l\'alarme</button><img class="btn_appd space5" src="images/icon-info.svg" rel="info_adm" title="4" data-titre="Configuation modect""><br>';
        if (ECRAN_ADMIN['idx_dz_list']=="enable")echo '<button type="button" class="button is-link is-light btn_appd but3" rel="admin" title="12" data-titre="fichier idx/nom Domoticz">Créer fichier idx/nom Domoticz , LISTE</button><img class="btn_appd space5" src="images/icon-info.svg" data-titre="Exemple idx/nom" rel="info_adm" title="3""><br>';
        if (ECRAN_ADMIN['var_list']=="enable")echo '<button type="button" class="button is-link is-light btn_appd but3" rel="admin" title="19" data-titre="LISTE variables">LISTE variables</button><img class="btn_appd space5" src="images/icon-info.svg" data-titre="LISTE variables" rel="info_adm" title="3""><br>';
		    if (ECRAN_ADMIN['idx_dz-zigbee']=="enable")echo '<button type="button" class="button is-link is-light btn_appd but3" rel="admin" title="13" data-titre="fichier lasteen zwave/zigbee">Créer fichier lasteen zwave/zigbee</button><img class="btn_appd space5" src="images/icon-info.svg" data-titre="fichier lasteen<br>zwave/zigbee" rel="info_adm" title="2""><br><br>';
        if (ECRAN_ADMIN['reboot_pi']=="enable")echo '<p id="admin5"><img  class="logo_rpi" src="images/rpi.webp" alt="logo"/>';
        if (ECRAN_ADMIN['reboot_pi']=="enable")echo '<button type="button" class="button is-link is-light btn_appd but7" rel="admin" title="20" data-titre="Reboot Raspberry">Reboot Raspberry</button><br>';
        if (ECRAN_ADMIN['msmtprc']=="enable")echo '<button type="button" class="button is-link is-light btn_appd but8" rel="admin" title="21" data-titre="msmtprc (config envoi mail)">msmtprc (config envoi mail)</button><br>';
        if (ECRAN_ADMIN['connect_py']=="enable")echo '<button type="button" class="button is-link is-light btn_appd but9" rel="admin" title="23" data-titre="Maj connect.py du PI" >Maj connect.py du PI </button><br>';
        if (DOMOTIC=="IOB" || DOMOTIC1=="IOB" || DOMOTIC2=="IOB")echo '<img class="logo_iob" src="images/iobroker.svg" alt="logo">';
        if (DOMOTIC=="IOB" || DOMOTIC1=="IOB" || DOMOTIC2=="IOB")echo '<button type="button" class="button is-link is-light btn_appd but6" rel="admin" title="26" data-titre="Test Adaptateur io.Broker">Test Adaptateur io.Broker</button><br>';?> 
        <p><img class="logo_sql" src="images/serveur-sql.svg" style="width:25px">
        <button type="button" class="button is-link is-light btn_appd but6" rel="admin" title="9" data-titre="Test Base de données">Test Base de données</button><br>
		    <button type="button" class="button is-link is-light btn_appd but5" rel="admin" title="14" data-titre="Sauvegarde Base de données">Sauvegarde Base de données</button><br>
        <button type="button" class="button is-link is-light btn_appd but12" rel="admin" title="17" data-titre="Enregistrer ou modifier Variables">Enregistrer ou modifier Variables dans SQL&nbsp;</button><img class="btn_appd space30" src="images/icon-info.svg" data-titre="Enregistrer ou modifier<br> Variables" rel="info_adm" title="0""><br>
        <button type="button" class="button is-link is-light btn_appd but11" rel="admin" title="18" data-titre="Enregistrer ou modifier Dispositifs">Enregistrer ou modifier Dispositifs dans SQL&nbsp;</button> <img class="btn_appd" src="images/icon-info.svg" rel="info_adm" data-titre="Enregistrer ou modifier<br> Dispositifs" title="7""><br>
        <button type="button" class="button is-link is-light btn_appd but10" rel="admin" title="25" data-titre="Enregistrer Message DZ ou HA dans SQL">Enregistrer Message DZ ou HA dans SQL</button> <img class="btn_appd" src="images/icon-info.svg" rel="info_adm" data-titre="Enregistrer Message <br>DZ ou HA dans SQL" title="9""></P>
        <p id="phpadmin"><a href="http://<?php echo PHPMYADMIN;?>" target="_blank"><img class="phpmyadmin" src="images/phpmyadmin.svg" alt="logo"/></a></p>
        <p id="about"><a><img class="btn_appd" src="images/about.svg" rel="info_adm" data-titre="A propos" title="8" alt="a Propos"/></a></p>
		<?php
		 if (SSE==true){echo '<div id="sse"><img class="logo_sse" style="width:30px;" src="images/mqtt.webp" />
		<p id="status"></p> 
    <p id="messages"></p><p id="messages1"></p><p id="messages2"></p><p id="messages3"></p></div>';}
    if (MQTT==true){echo '<div id="ws-zb"><img style="width:30px;" src="images/mqtt_ws.webp" />
    <p id="msg_zb"></p><p id="msg_zb1"></p></div>';}?>
		
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
<p id="notify" style="color:darkblue;display:none" href="#administration">inter</p>
<p id="yyyessai" style="color:darkblue;display:none" href="#administration">inter1</p>
<?php
include( 'info_admin.php' );
?>
<!-- section Titre de la  Page admin-->
<div  id="reponse" style="position:relative;top:-650px;display:none;width=450px;left:10px;height:auto;" ></div>
