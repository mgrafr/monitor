<?php
//session_start();
$domaine=$_SESSION["domaine"];
if ($domaine==URLMONITOR) $lien_zwave=URLZWAVE;
if ($domaine==IPMONITOR) $lien_zwave=IPZWAVE;

echo'
<section id="zwave">
  <div class="container">
    <div class="columns">
      <div class="column is-12">
        <h2 class="title">Dispositifs : <span style="color:blue">Zwave</span></h2>
        <a href="'.$lien_zwave.'#" target="_blank">'.$lien_zwave.'</a>
        <iframe id="zwmqtt" src="'.$lien_zwave.'" frameborder="0"></iframe>
       
      </div>
    </div>
  </div>
</section>';


