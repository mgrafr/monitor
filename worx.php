<?php
//session_start();
$domaine=$_SESSION["domaine"];
if ($domaine==URLMONITOR) $lien_img="/";
if ($domaine==IPMONITOR) $lien_img="/monitor/";
require_once(MONCONFIG);
?>
<!-- -->
<!-- section worx -->
<!-- ================ -->
<div id="worx">
  <div class="container">
    <div class="columns is-centered">
      <div class="column is-12">
        <h1 class="title is-1 has-text-centered">Robot&nbsp;<span>WORX</span></h1><br>
        <img id="mg_worx" src="<?php echo $lien_img;?>custom/images/worx.webp" height="auto" alt=""/>
      </div>
    </div>
  </div>
</div>
