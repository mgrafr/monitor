<?php
//session_start();
$domaine=$_SESSION["domaine"];
if ($domaine==URLMONITOR) $lien_img="/";
if ($domaine==IPMONITOR) $lien_img="/monitor/";
require_once("fonctions.php");

//test_rgb('sw3');/json.htm?type=command&param=setcolbrightnessvalue&idx=130&color={"m":3,"t":0,"r":0,"g":0,"b":50,"cw":0,"ww":0}&brightness=100
?>
<!-- section Mur OnOff-->
<!-- ================ -->
		<div id="murinter" class="inter">
			<div class="container">
		<div class="column">
	  <h1 class="text-c">Mur de<span>  Commandes</span></h1><br>
		<p id="txt_cmd" style="display:none;color:red"></p>
    <button type="button" id="btn_c" style="display:none;margin-top:-10px" class="button is-primary">Entrer votre mot de passe<a onclick="openModal('pwdalarm');" >
    </a></button>	
		<p class="txt_inter">certaines commandes peuvent éxiger un mot de passe</p>
		
    <button type="button" id="btn_scenes" data-titre="choix des scènes" rel="scenes" class="button is-primary btn_appd"> 
      Commandes SCENES</button>
<form id="idhtml1"><input type="hidden" id="idhtml" value="">Couleur & luminosité en cours<input style="width:80px" id="val1" value="FFFFFF" onchange="adby(10)" >
<input style="width:40px;" id="val2" value="255"></form>
   <ul class="liste_inter">
  <li><a href="#murinter">
      <img id="sw5" src="<?php echo $lien_img;?>images/lampe_sejour.svg" width="60" height="auto" alt="" />
      <button onclick="document.querySelector('#idhtml').setAttribute('value','sw5');" data-jscolor="{valueElement:'#val1'}"></button>
      <img id="sw12" src="<?php echo $lien_img;?>images/seche-serviettes.svg" width="40" height="auto" alt="" />
      <img id="sw23" src="<?php echo $lien_img;?>images/vanne.svg" width="60" height="auto" alt="" />
      <img id="sw24" src="<?php echo $lien_img;?>images/th_cave.webp" width="60" height="auto" alt="" />
    </a>
  </li>
  <li><a href="#murinter">
      <img id="sw4" src="<?php echo $lien_img;?>images/lampe_entree.svg" width="60" height="40" alt="" />
    </a>
    <button onclick="document.querySelector('#idhtml').setAttribute('value','sw4');" data-jscolor="{valueElement:'#val1'}"></button>
  </li>
  <li><a href="#murinter">
      <img id="sw3" src="<?php echo $lien_img;?>images/lampe_salon.svg" width="60" height="40" alt="" />
    </a>
    <button onclick="document.querySelector('#idhtml').setAttribute('value','sw3');" data-jscolor="{valueElement:'#val1'}"></button>
  </li>
  <li><a href="#murinter">
      <img id="sw2" src="<?php echo $lien_img;?>images/lampe_bureau.svg" width="60" height="60" alt="" />
      <button onclick="document.querySelector('#idhtml').setAttribute('value','sw2');" data-jscolor="{valueElement:'#val1'}"></button>
      <img id="sw11" src="<?php echo $lien_img;?>images/cordon_prise_bureau.svg" width="60" height="auto" alt="" />
      <img id="sw10" src="<?php echo $lien_img;?>images/cordon_prise.svg" width="60" height="auto" alt="" />
    </a>
  </li>
  <li><a href="#murinter">
      <img id="sw1" src="<?php echo $lien_img;?>images/lampe_poele.svg" width="60" height="60" alt="" />
    </a>
    <button onclick="document.querySelector('#idhtml').setAttribute('value','sw1');" data-jscolor="{valueElement:'#val1'}"></button>
  </li>
  <li><?php include ("volet-roulant_svg.php");?>
<p id="clic_vr">ouvert 0................100 fermé<div id="slider"></div>
<span id="level_vr">Set Level:0</span>

</li>
  <li><a href="#murinter">
      <img id="sw6" src="<?php echo $lien_img;?>images/porte_garage.svg" width="60" height="auto" alt="" />
    </a>
  </li>
  <li><a href="#murinter">
      <img id="sw7" src="<?php echo $lien_img;?>images/portail.svg" width="60" height="60" alt="" />
    </a>
  </li>
  <li><a href="#murinter">
      <img id="sw8" src="<?php echo $lien_img;?>images/arrosage.svg" width="60" height="auto" alt="" />
    </a>
  </li>
  <li><a href="#murinter">
      <img id="sw9" src="<?php echo $lien_img;?>images/lampe_jardin.svg" width="60" height="auto" alt="" />
    </a>
    <a><img id="sw20" src="<?php echo $lien_img;?>images/lampe_terrasse.svg" width="60" height="auto" alt="" />
    </a>
    <a href="#murinter">
      <img id="sw21" src="<?php echo $lien_img;?>images/lampe_suspendue1.svg" width="60" height="60" alt="" />
    </a>
    <a href="#murinter">
      <img id="sw22" src="<?php echo $lien_img;?>images/lampe_suspendue2.svg" width="60" height="60" alt="" />
    </a>
  </li>
</ul>
</div>
</div></div>

<!-- div containing the popup 
   <div class="modal" id="popup_vr">
  <div class="modal-content" id="VR" rel="">
    <h6>Commande OUVERTURE-FERMETURE</h6>
    <p><a id="clic_vr">ouvert 0................100 fermé</a></p>
    <div id="slider"></div>
    <form>
      <label>commande:<span id="level_vr"></span></label><br>
      <button type="button" class="button is-primary" value="OK">
        <input type="button" id="amount" name="" value="">OK</button>
    </form>
    <a class="modal-close is-large" href="javascript:void(0)">X</a>
  </div>
</div>-->
 
<!-- couleur lampes-->
<p class="popup_rgb" id="color_lampes" ></p>

