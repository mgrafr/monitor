<!--accueil start -->
		<!-- image de la page d'accueuil déclarée dans admin/config.php -->
		<div id="accueil" class="text-white banner">
			<div class="banner-image"></div>
				<div class="banner-caption">
				<div class="container">
					<div class="row">
						<div class="txtcenter col-md-12" >
						<h2 class="text-centre">Température<span style="color:cyan"> Extérieure</span></h2>
						<p class="taille18 text-centre">En ce moment , il fait :<span id="temp_ext" ></span></p>
						<p class="text-centre">T° ressentie :<span id="temp_ressentie" style="color:#ffc107;"></span></p>
						</div>
					</div>
				</div>


						</div>


			</div>
<?php $domaine=$_SESSION["domaine"];
if ($domaine==URLMONITOR) $lien_img="/";
if ($domaine==IPMONITOR) $lien_img="/monitor/";
?>
<div class="confirm pression_chaud"><a href="#" id="annul_pression" rel="1002" title="Annulation de l'\alerte pression"><img id="pression_chaud" src=""/></a></div>
<div class="confirm pilule"><a href="#" id="annul_pilule" rel="1001" title="Annulation de l'\alerte pilule chat"><img id="pilule" style="display:none" src=""/></a></div>
<div class="confirm"><a href="#" id="annul_fosse" rel="1011" title="Annulation de l'\alerte fosse septique"><img id="fosse" style="display:none" class="fosse_septique" src=""/></a></div>
<div class="gd_portail"><img id="gd_portail" style="display:none" src="images/portail_ferme.svg"/></div>
<div class="poubelles"><img id="poubelle" style="display:none" src=""/></div>
<div class="aff_pluie" >
	<div id="pluie" style="display:none"><img id="pl" src="" alt="pluie" /></div><div id="txt_pluie"></div>  </div>
<div class="aff_anni" ><img id="aff_anni" src="" alt="anni" /><div id="prenom"></div></div>
<div class="aff_al" ><img id="alarme_nuit" src="images/alarme_auto.svg" alt="alarme" /></div>
<?php if (ON_SOS==true) echo '<div class="sos" ><img id="SOS" src="images/sos.svg" width="40" alt="" /></div>';?>
<div class="aff_bat" ><img id="batterie" src="images/batterie_faible.svg" alt="batterie" /></div>
<div class="confirm ping_rasp" ><a href="#" id="annul_ping" rel="1004" title="effacement alerte pi"><img id="ping_rasp"  src="" alt="ping" /></a></div>  
<div class="confirm bl" ><a href="#" id="confirm-box" rel="1018" title="courrier récupéré"><img id="bl" src="images/boite_lettres.svg" alt="boite_lettres" /></a></div>
<div class="confirm lastseen"><a href="#" id="annul_lastseen" rel="1014" title="Annulation de l'alerte lastseen"><img id="lastseen" src=""/></a></div>
<div class="confirm lastseen1"><a href="#" id="annul_lastseen1" rel="input_text.essai" title="Annulation de l'alerte lastseen"><img id="lastseen1" src=""/></a></div>

<!-- nofifications disponibles-->
<div class="confirm notif1"><a href="#" id="annul_notif1" rel="30" title="Annulation de l'alerte notif1"><img id="notif1" src=""/></a></div>
<div class="confirm notif2"><a href="#" id="annul_notif2" rel="30" title="Annulation de l'alerte notif2"><img id="notif2" src=""/></a></div>
<div class="confirm notif3"><a href="#" id="annul_notif3" rel="30" title="Annulation de l'alerte notif3"><img id="notif3" src=""/></a></div>
<div class="confirm notif4"><a href="#" id="annul_notif4" rel="30" title="Annulation de l'alerte notif3"><img id="notif4" src=""/></a></div>
<!-- fin notifications disponibles -->
<p id="erreur" ></p><p id="notify" ></p>
 <!-- accueil end -->

