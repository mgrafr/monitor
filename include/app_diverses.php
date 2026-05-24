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
    <div class="columns is-centered">
      <div class="column is-12">
        <h1 class="title has-text-centered">App<span>  diverses</span></h1><br>
        <img src="images/dz.webp" style="width:50px;height:auto;margin:10px 0 10px 120px" alt="dz">
        IP: <?php echo $lien_dz;?>
        <form2>
            <p class="has-text-centered"><input type="button" rel="domoticz" title="1" style="margin-left: 60px;" class="button is-primary btn_appd" value="afficher fichier log normal"></p><br>
          <p class="has-text-centered"><input type="button"rel="domoticz" title="2" style="margin-left: 60px;" class="button is-primary btn_appd" value="afficher fichier log statut"></p><br>
          <p class="has-text-centered"><input type="button"rel="domoticz" title="4" style="margin-left: 60px;" class="button is-primary btn_appd" value="afficher fichier log erreur"></p><br>
           <img src="images/serveur-sql.svg" style="width:40px;height:auto;margin:0 0 10px 118px" alt="dz">
          <p class="has-text-centered"><input type="button" rel="sql" title="date_poub" style="margin-left: 60px;" class="button is-primary btn_appd" value="afficher historique poubelles"></p><br>
        </form2>
        <h1 class="title is-1 has-text-centered">Logs<span>  Monitor</span></h1><br>
        <p class="has-text-centered"><input type="button" rel="10" style="margin-left: 60px;" class="button is-primary btn_appd" title="idm manquant-idx Domoticz" value="idm  non enregistré">
          <span id="erreur_dz" style="display:none;margin-left:20px">&#10060;</span></p>
      </div>
    </div>
  </div>
</div>
		