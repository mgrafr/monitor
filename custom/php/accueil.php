<!--accueil start -->
<!-- image principale de la page d'accueuil déclarée dans admin/config.php -->
<?php include("css/styles.php");?>
<section id="accueil" class="hero is-fullheight is-dark">
	<div class="banner-image"></div>
		<div class="columns temp_accueil">
				<div class="column is-11 has-text-centered" >
					<h3 class="text-c">Température<span style="color:cyan"> Extérieure</span></h3>
					<p class="text-c coultemp">En ce moment , il fait :<span id="temp_ext" ></span></p>
					<p class="text-center">T° ressentie :<span id="temp_ressentie" style="color:#ffc107;"></span></p>
				</div>
		</div>
<?php $domaine=$_SESSION["domaine"];
if ($domaine==URLMONITOR) $lien_img="/";
if ($domaine==IPMONITOR) $lien_img="/monitor/";
?>
<div class="icones_not">
 <button type="button"  class="aff_info">
        <a href="javascript:void(0);" onclick="openModal('lexique');" >
            <svg version="1.1" id="info" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 1417.3 1417.3" xml:space="preserve">
                <style type="text/css" id="style879">
                    .at0{fill:#339967;}
                    .at1{opacity:0.2;fill:#FBAE17;}
                </style>
                <path class="at0" d="M708.7,73C357.6,73,73,357.6,73,708.7c0,351.1,284.6,635.7,635.7,635.7c351.1,0,635.7-284.6,635.7-635.7
                    C1344.3,357.6,1059.7,73,708.7,73z M708.7,1236.8c-291.7,0-528.1-236.4-528.1-528.1c0-291.7,236.4-528.1,528.1-528.1
                    c291.7,0,528.1,236.4,528.1,528.1C1236.8,1000.3,1000.3,1236.8,708.7,1236.8z"/>
                <path class="at0" d="M584.6,618.4l8.3-23.6l194.2-30.9h42.3l-128.3,453.8c0,0-7.6,25.2,6,35.2c25.4,18.8,94.1-84.9,94.1-84.9
                    l17.9,11.7c0,0-64.7,91.2-99.5,119.7c-32.6,26.6-83.7,49.4-134.9,25.9C520.8,1096.2,552,1004,552,1004l94.5-322.8
                    c0,0,8.2-26.6-3.4-46.2c-9.1-15.3-35.5-15.4-35.5-15.4L584.6,618.4z"/>
                <circle id="lex" class="at0" cx="794.7" cy="374.2" r="87"/>
                <ellipse class="at1" cx="713" cy="716" rx="580" ry="590"/>
            </svg>
        </a>
</button>
<?php
if (LEXIQUE==true) include("include/lexique.php");
else include("include/lexique_no.php");
?>		
<div class="confirm pression_chaud"><a href="#" id="annul_pression" rel="1002" title="Annulation de l'\alerte pression"><img id="pression_chaud" src=""/></a></div>
<div class="confirm pilule"><a href="#" id="annul_pilule" rel="1001" title="Annulation de l'\alerte pilule chat"><img id="pilule" style="display:none" src=""/></a></div>
<div class="confirm"><a href="#" id="annul_fosse" rel="1011" title="Annulation de l'\alerte fosse septique"><img id="fosse" style="display:none" class="fosse_septique" src=""/></a></div>
<div class="porte_veranda_sud" style="display:none"/><img src="images/door_double.svg" alt="porte veranda"></div>
<div id="porte_ent_ver_sud_O" style="display:block"/></div>
<div id="gd_portail" style="display:block"/></div>
<div id="porte_gar" style="display:block"/></div>
<div class="confirm poubelles"><a href="#" id="annul_poubelle" rel="1012" title="Annulation de l'\alerte Poubelles"><img id="poubelle" style="display:none" src=""/></a></div>
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
<div id="brother" style="display:none"/><img src="images/tonner.svg" alt="tonner_imp"></div>
<!-- nofifications disponibles-->
<div class="confirm notif1"><a href="#" id="annul_notif1" rel="30" title="Annulation de l'alerte notif1"><img id="notif1" src=""/></a></div>
<div class="confirm notif2"><a href="#" id="annul_notif2" rel="30" title="Annulation de l'alerte notif2"><img id="notif2" src=""/></a></div>
<div class="confirm notif3"><a href="#" id="annul_notif3" rel="30" title="Annulation de l'alerte notif3"><img id="notif3" src=""/></a></div>
<div class="confirm notif4"><a href="#" id="annul_notif4" rel="30" title="Annulation de l'alerte notif3"><img id="notif4" src=""/></a></div>
</div>
<!-- fin notifications disponibles -->
<p id="erreur" ></p><p id="notify" ></p>
 <!-- accueil end -->
</section>
