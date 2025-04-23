<?php
//session_start();
$domaine=$_SESSION["domaine"];
if ($domaine==URLMONITOR) $lien_img="/";
if ($domaine==IPMONITOR) $lien_img="/monitor/";
require_once("fonctions.php");
function change_coul($rgb){
echo '<button data-jscolor="{valueElement:\'#val1\'}">
</button><form99><input type="hidden" id="idhtml" value="'.$rgb.'"><input type="hidden" id="type" value="4"><input type="hidden" id="mapp" value="OnOff"><input name="val1" type="hidden" id="val1" value="AB2567">
<button type="button" id="bouton_coul" onclick="adby(10);" style="width:38px;height:28px">OK</button></form99>';
}
//test_rgb('sw3');/json.htm?type=command&param=setcolbrightnessvalue&idx=130&color={"m":3,"t":0,"r":0,"g":0,"b":50,"cw":0,"ww":0}&brightness=100
?>
<!-- section Mur OnOff-->
<!-- ================ -->


		<div id="murinter" class="inter">
			<div class="container">
		<div class="col-md-12" >
	  <h1 class="title_ext text-center">Mur de<span>  Commandes</span></h1><br>
		<p id="txt_cmd" style="display:none;color:red"></p><button type="button" id="btn_c" style="display:none" class="btn btn-primary"  data-toggle="modal" data-target="#pwdalarm"> Entrer votre mot de passe </button>	
		<p class="txt_ext">certaines commandes peuvent éxiger un mot de passe</p>
		<div><button type="button" id="btn_sc" class="btn btn-primary" data-toggle="modal" data-target="#choix_scenes">
    Commandes SCENES
  </button></div>
		
			
    </p>
		<ul>
			<li style="margin-left:0;margin-top:10px"><a href="#murinter"><img id="sw5" src="<?php echo $lien_img;?>images/lampe_sejour.svg" width="60" height="auto" alt=""/>
			<?php change_coul("sw5");?>
			<img id="sw12" src="<?php echo $lien_img;?>images/seche-serviettes.svg" width="40" height="auto" alt=""/>
			<img id="sw23" src="<?php echo $lien_img;?>images/vanne.svg" width="60" height="auto" alt=""/>
			<img id="sw24" src="<?php echo $lien_img;?>images/th_cave.webp" width="60" height="auto" alt=""/></a></li>
			<li style="margin-left:0;margin-top:10px"><a href="#murinter"><img id="sw4" src="<?php echo $lien_img;?>images/lampe_entree.svg" width="60" height="40" alt=""/>
			</a><?php change_coul("sw4");?></li>
			<li style="margin-left:0;margin-top:10px"><a href="#murinter"><img id="sw3" src="<?php echo $lien_img;?>images/lampe_salon.svg" width="60" height="40" alt=""/>
			</a><?php change_coul("sw3");?></li>
			<li style="margin-left:0;margin-top:10px"><a href="#murinter"><img id="sw2" src="<?php echo $lien_img;?>images/lampe_bureau.svg" width="60" height="60" alt=""/>
			<?php change_coul("sw2");?>
			<img id="sw11" src="<?php echo $lien_img;?>images/cordon_prise_bureau.svg" width="60" height="auto" alt=""/>
			<img id="sw10" src="<?php echo $lien_img;?>images/cordon_prise.svg" width="60" height="auto" alt=""/></a></li>
			<li style="margin-left:0;margin-top:10px"><a href="#murinter"><img id="sw1" src="<?php echo $lien_img;?>images/lampe_poele.svg" width="60" height="60" alt=""/>
			<?php change_coul("sw1");?></a></li>
			<li style="margin-left:0;margin-top:10px"><?php include ("volet-roulant_svg.php");?></li>
			<li style="margin-left:0;margin-top:10px"><img id="sw6" src="<?php echo $lien_img;?>images/porte_garage.svg" width="60" height="auto" alt=""/></li>
			
			<li style="margin-left:0;margin-top:10px"><img id="sw7" src="<?php echo $lien_img;?>images/portail.svg" width="60" height="60" alt=""/></li>
			
			<li style="margin-left:0;margin-top:10px"><a href="#murinter"><img id="sw8" src="<?php echo $lien_img;?>images/arrosage.svg" width="60" height="auto" alt=""/></a></li>
			
			<li style="margin-left:0;margin-top:10px"><a href="#murinter"><img id="sw9" src="<?php echo $lien_img;?>images/lampe_jardin.svg" width="60" height="auto" alt=""/></a><a href="#murinter"><img id="sw20" src="<?php echo $lien_img;?>images/lampe_terrasse.svg" width="60" height="auto" alt=""/></a><a href="#murinter"><img id="sw21" src="<?php echo $lien_img;?>images/lampe_suspendue1.svg" width="60" height="60" alt=""/></a><a href="#murinter"><img id="sw22" src="<?php echo $lien_img;?>images/lampe_suspendue2.svg" width="60" height="60" alt=""/></a></li>




		</ul>
</div>
</div></div>

<!-- div containing the popup -->
    <div class="popup" id="popup_vr">
    <div class="popup-content" id="VR" rterrasseel="">
      <h6>Commande OUVERTURE-FERMETURE</h6>
      <!--<p><a onclick="MQTTconnect(mess1);">OUVRIR?></a> (ON).</p>-->
		<p><a id="clic_vr">ouvert 0................100 fermé</a></p>  
	  <div id="slider"></div>
<form>
<label>commande:<span id="level_vr"></span></label><br>
<button type="button" class="btn btn-primary" value="OK">
<input  type="button" id="amount" name="" value="">OK</button></form>
	
		<a class="closeBtn" href="javascript:void(0)">X</a>
    </div>
  </div>
 <!-- modal parametres-->
<div class="modal" id="choix_scenes">
  <div class="modal-dialog" style="height:auto">
    <div class="modal-content modal_param choix_scenes" >
      
        <h4 class="modal-title">choix des scènes</h4><button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
	<ul style="background-color: #b3e5d4;">
<li style="margin-left:0;margin-top:10px"><a href="#murinter"><img id="sc1" src="<?php echo $lien_img;?>images/lampe_jardin.svg" width="40" height="auto" alt=""/>toutes les lampes</a></li></ul>
     	 </div>
     </div>
  </div>  
<!-- couleur lampes-->
<div class="popup_rgb" id="color_lampes" onclick='$("#color_lampes").click(function(){
		$(".popup_rgb").hide;});'></div>

