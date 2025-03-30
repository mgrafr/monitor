


<!-- section worx -->
<!-- ================ -->
<div id="worx">
  <div class="container">
    <div class="col-md-12">
      <h1 class="title_ext text-center">Robot&nbsp;<span>WORX</span></h1><br>
	
      <div class="row"><div><font><font >Etat batterie: </font><i class="fa fa-battery-full" style="font-size:24px;color:#cc5f28"></i></font><font  id="etat_bat" style="margin-left: 10px;">0</font>% 
        <span class="info"><b><font style="color:darkgreen" id="tension_bat">0</font><font>V</b>&nbsp;&nbsp;</font><b><font id="temp_bat" style="color:darkblue;vertical-align: inherit;">0</font>°</b>
		<span style="margin-right: 10px"><i class="fa fa-wifi" style="margin-left: 50px;font-size:2em;color:#cc5f28"></i></span>
        <span class="info"><font ><font id="wifi" >0 </font></font><font >dB</font></span><br><br>	
	 <div style="position: relative;text-align: center;"><b><font id="statut" style="font-size: 25px;margin-top: 50px"></font></b></div>
    	
	<div class="mt-3 text-center"><span class="info"><b><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">Prochaines heures de travail :&nbsp;</font></font></b> </span></div><br><br>
	<div style="background-color: #91a58457;width: 450px;height: 200px;">
			<div style="position: relative;text-align: center;"><b><font style="vertical-align: inherit;"><font id="name_worx" >0</font></font></b></div>
	<div><span style="margin-left:60px"></span>Pente:<span id="gradient" class="info">0</span>°<span style="margin-left:200px" >Direction:</span><span id="direction" class="info">0</span>°</div>	
	<div class="col col-sm-auto text-center landroid"><img id="img_worx" src="<?php echo $lien_img;?>/custom/images/worx.webp" height="auto" alt=""/></div>		
    <div class="inclinaison text-center" ><font>Inclinaison:<font id="inclinaison" class="info">0</font>°</font></div>
		<br><br></div></div></div>	
	 <div style="position: relative;top: 30px;" class="col-md-6 col-lg-3"><span><b><font style="vertical-align: inherit;">Temps de travail lames&nbsp;:&nbsp;<font id="lames">0</font></font></b></span><br><b><font>Distance: <span id="distance">0</span>m</font></b><br>
     <b><font>Temps de travail:&nbsp;<font id="temps_travail" >0</font></font></b></div>
	 <br>
		
	<div class="main-buttons" style="position: relative;top: 30px;left:10px">
	<button id="start_worx" class="btn btn-worx" ><i class="fa fa-play"></i> Start</button>
	<button id="home_worx" rel="3" style="margin-left: 10px;" class="worx_command btn btn-primary"><i class="fa fa-home"></i> Home</button>
	<button id="pause_worx" style="margin-left: 10px;" class="btn btn-secondary"><i class="fa fa-pause"></i> Pause</button>
    <button id="stop_worx" rel="2" style="margin-left: 10px;" class="worx_command btn btn-worx"><i class="fa fa-square"></i> Stop</button>
   
	<br>	
	<div style="position: relative;top: 30px;" >Last update:<span id="last_update" class="info">0</span><br>
   FW:<span id="FW" class="info">0</span></div>		
		
    </div>
  </div></div>


	<script>
	var custom=1;
	var states = new Array();	
	    states[0]= "STOP" ;
        states[1]= "Maison" ;
        states[2]= "Démarrer la séquence" ;
        states[3]= "Quitter la maison";
        states[4]= "Suivre la frontière" ;
        states[5]= "Recherche de domicile" ;
        states[6]= "Recherche de la frontière" ;
        states[7]= "Tonte" ;
        states[8]= "Levé" ;
        states[9]= "Piégé" ;
        states[10]= "Lame bloquée" ;
	    states[11]= "Débogage" ;
	    states[12]= "Conduite" ;
	    states[13]= " Évasion de la clôture numérique " ;
	    states[30]= "Rentrer à la maison";
	    states[31]= "Formation de zone" ;
	    states[32]= "Bordure coupée" ;
	    states[33]= "Zone de recherche";
	    states[34]= "Pause";
	    states[100]= "Entraînement de la carte (complétable)" ;
  	    states[101]= "Traitement de la carte" ;
	    states[102]= "Mise à niveau du micrologiciel" ;
	    states[103]= "Déplacement vers la zone";
	    states[104]= "Rentrer à la maison";
	    states[105]= "Prêt pour la formation" ;
	    states[106]= "Téléchargement de la carte en cours";
	    states[107]= "Téléchargement de la carte en cours";
		states[108]= "Entraînement de la carte interrompu" ;
		states[109]= "Formation de la carte (ne peut pas être complétée)" ;
		states[110]= "Passage de la frontière";
		states[111]= "Exploration de la pelouse";
		states[112]= "Déplacement vers le point de récupération" ;
		states[113]= "En attente de position";
		states[114]= "Entraînement à la carte (conduite)";
		states[115]= "Entraînement de la carte (restauration)" ;
		
	function mn_jj(minutes){
	var time_j=Math.trunc(minutes/(24*60));var time_x=minutes%(24*60);
	var time_h=Math.trunc(time_x/60); var time_m=time_x%60;	
	return time_j+"j "+time_h+"h "+time_m+"m";	
	}	

		
	function maj_worx(name,state){
	document.getElementById("etat_bat").innerHTML=worx['batteryState'];
	document.getElementById("tension_bat").innerHTML=worx['batteryVoltage'];
	document.getElementById("temp_bat").innerHTML=worx['batteryTemperature'];
	document.getElementById("wifi").innerHTML=worx['wifiQuality'];				
	document.getElementById("name_worx").innerHTML=name;
	document.getElementById("direction").innerHTML=worx['direction'];
	document.getElementById("gradient").innerHTML=worx['gradient'];
	document.getElementById("inclinaison").innerHTML=worx['inclination'];
	document.getElementById("FW").innerHTML=worx['firmware_available'];
	var date = new Date(worx['last_update']).toLocaleDateString("fr-FR")
    var time = new Date(worx['last_update']).toLocaleTimeString("fr-FR")
	document.getElementById("last_update").innerHTML=date+"  "+time;
	document.getElementById("temps_travail").innerHTML=mn_jj(worx['totalTime']);
	document.getElementById("distance").innerHTML=worx['totalDistance'];
	document.getElementById("lames").innerHTML=mn_jj(worx['totalBladeTime']);
	var status=worx['status'];var statut= states[status];
	document.getElementById("statut").innerHTML=statut;
	
    }
	function docReady(fn) {
    // see if DOM is already available
    if (document.readyState === "complete" || document.readyState === "interactive") {
        // call on next available tick
        setTimeout(fn, 1);
    } else {
        document.addEventListener("DOMContentLoaded", fn);
    }
}    	
		
docReady(function() {
 $("#start_worx,#home_worx,#pause_worx,#stop_worx").each(function(){
	 $(this).click(function(){maj_devices(plan);});});});
		
</script>
								