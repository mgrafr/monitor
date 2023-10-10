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
<div class="confirm pression_chaud"><a href="#" id="annul_pression" rel="28" title="Annulation de l'\alerte pression"><img id="pression_chaud" src=""/></a></div>
<div class="confirm pilule"><a href="#" id="annul_pilule" rel="30" title="Annulation de l'\alerte pilule michel"><img id="pilule" src=""/></a></div>
<div class="confirm"><a href="#" id="annul_fosse" rel="2" title="Annulation de l'\alerte fosse septique"><img id="fosse" class="fosse_septique" src=""/></a></div>
<div class="poubelles"><img id="poubelle" onclick="info_poubelles(1)" src=""/></div>
<div class="aff_pluie" >
	<div id="pluie" ><img id="pl" src="" alt="pluie" /></div><div id="txt_pluie"></div>  </div>
<div class="aff_anni" ><img id="aff_anni" src="" alt="anni" /><div id="prenom"></div></div>
<div class="aff_al" ><img id="alarme_nuit" src="images/alarme_auto.svg" alt="alarme" /></div>
<div class="aff_bat" ><img id="batterie" src="images/batterie_faible.svg" alt="batterie" /></div>
<div class="confirm ping_rasp" ><a href="#" id="annul_ping" rel="21" title="effacement alerte pi"><img id="ping_rasp" style="width:40px;height:40px" src="" alt="ping" /></a></div>  
<div class="confirm bl" ><a href="#" id="confirm-box" rel="19" title="courrier récupéré"><img id="bl" src="images/boite_lettres.svg" alt="boite_lettres" /></a></div>

<div class="confirm lastseem"><a href="#" id="annul_lastseem" rel="34" title="Annulation de l'alerte lastseem"><img id="lastseem" src="images/icon_eye.svg"/></a></div>

<div class="confirm not1"><a href="#" id="annul_not1" rel="30" title="Annulation de l'alerte not1"><img id="affich_not1" src=""/></a></div>

<p id="erreur" ></p>
 <!-- accueil end -->

