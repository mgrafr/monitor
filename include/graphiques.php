<?php
//session_start();
error_reporting(-1);
?>
<!-- section graphiques start -->
<!-- ================ -->
		<div id="graphiques" class="graphiques">
			<div class="dpb container">
				<div class="column title">
	  <h1> Graphiques<br><span>de températures, pression, ..</span></h1></div>
		
			<!-- Button to Open the Modal -->
  <div><button type="button" id="btn_g" class="button is-primary title" >
    <a onclick="openModal('choix_graph');" >
    Choisir paramètres
</a></button></div><div id="graphic" ></div>
	</div>	  
  </div>     
 </div>

 <!-- modal parametres-->
<div class="modal" id="choix_graph">
 	<div class="modal-background"></div>
    <div class = "modal-card">
    <header class = "modal-card-head">
      <p class = "modal-card-title">choix des paramètres</p>
            <button id="btn_g_close" class = "delete" aria-label = "close"></button>
    </header>
    <section class = "modal-card-body">
      <div class = "content">
  	
  
Merci de cocher vos préférences:<br><ul style="background-color: aquamarine;">
<li><input type="radio" checked="checked" name="devices" value="temp_salon"> temp salon</li>
<li><input type="radio" name="devices" value="temp_cuisine"> temp cuisine</li>
<li><input type="radio" name="devices" value="temp_meteo"> temp meteo</li>
<li><input type="radio" name="devices" value="temp_cave"> temp cave</li>
<li><input type="radio" name="devices" value="temp_cellier"> temp cellier</li>
<li><input type="radio" name="devices" value="temp_cuis_ete"> temp cuisine d'été</li>
<li><input type="radio" name="devices" value="pression_chaudiere"> pression eau chaudière</li>
<li><input type="radio" name="devices" value="energie-pmax"> puissance max électrique</li>
<li><input type="radio" name="devices" value="energie-conso"> consommation électrique</li><br>		
		
<li><input type="radio" checked="checked" name="variables" value="24"> dernieres 24H</li>
<li><input type="radio" name="variables" value="48"> dernieres 48H</li>
<li><input type="radio" name="variables" value="7"> derniere semaine</li>
<li><input type="radio" name="variables" value="31"> dernier mois</li>
<li><input type="radio" name="variables" value="365"> derniere année</li><br>
<li><input type="radio" name="variables" value="infos_bd">20 dernieres valeurs(ou 14 jours)</li><br>
<li><input type="button" id="btn_graph"  value="OK" /></li></ul>
     	 </div></section>
     </div>
    </div>
    </div>
   
<!-- section graphiquesfin-->
<script>
function graph(device,variable,idgraph){
  $.ajax({
    type: "GET",
    url: "ajax.php",
    data: "app=graph&device="+device+"&variable="+variable,
    success: function(html){$('#'+idgraph).empty();
	document.getElementById(idgraph).innerHTML =html;
	  
      } });
};</script>