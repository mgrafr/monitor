<?php
//require_once("fonctions.php");
?>

<!-- footer start -->
		<!-- ces fonctions sont utilisées pour la page d' accueil , la page interieur ,la page météo 
		================ -->
		<footer id="footer">
			<div classs="footer section">
				<div class="container">
				</div>
			</div>
		</footer>
<!-- footer end -->
<!-- JavaScript files placées à la fin du document-->	
<script src="js/jquery-3.6.3.min.js"></script><script src="bootstrap/js/bootstrap.min.js"></script>
<script src="js/jquery-ui-v1.13.2.js"></script>
<script src="js/jquery.backstretch.min.js"></script>  
<script src="js/big-Slide.js"></script> 
<script src="bootstrap/js/bootstrap4-toggle.min.js"></script>
<script src="js/mes_js.js"></script>
<script src="js/jscolor.min.js"></script>
<script src="custom/js/JS.js"></script>


<script>
function maj_mqtt(id_x,state,ind,level=0){console.log('id='+id_x+' state==='+state);
if (!state) {console.log("erreur-state");return;}										  
switch (ind) {
	case 0: 
var id_m=null;
for (attribute in maj_dev) {
	if (maj_dev[attribute]['id']==id_x){ id_m=maj_dev[attribute]['idm'];console.log('idm='+id_m);}
}
if (id_m==null) {out_msg= 'id_m='+id_m;return;}
		//var command=state.toString().toLowerCase();
		var command=state.toString();
pp[id_m].Data=command;console.log(pp[id_m].Data+command);
console.log('command='+state);
var fx=pp[id_m].fx; console.log(fx);if (fx=="lien_variable"){maj_services(0);}
var sid1=pp[id_m].ID1;;
var sid2=pp[id_m].ID2;
var scoul_on=pp[id_m].coul_ON;	
var scoul_off=pp[id_m].coul_OFF;
var c_l_on=pp[id_m].coullamp_ON
var c_l_off=pp[id_m].coullamp_OFF
var scoul="";var scoull="";	
if (command=="on" || command=="On" || command=="open")  {scoul=scoul_on;scoull=c_l_on;}
else if (command.substring(0, 9)=="set level")  {scoull=scoull=c_l_on;}
else if  (command=="off" || command=="Off" || command=="closed" ) {scoul=scoul_off;scoull=c_l_off;}
else if  (command=="group on" ) {scoul=scoul_on;scoull=c_l_on;}		
else return;	
console.log('sid1='+sid1+'..'+scoul);
		document.getElementById(sid1).style = scoul;
if (sid2) {document.getElementById(sid2).style = scoul;}
var c_lamp= pp[id_m].class_lamp	;console.log("c_lamp="+c_lamp);		
if (command.substring(0, 9)=="Set Level") {var h=document.getElementById(sid1).getAttribute("h");
	document.getElementById(sid1).setAttribute("height",parseInt((h*(level)/100)));
	console.log("h="+h+parseInt((h*(level)/100)));}
break;
case 1:scoull=state;c_lamp=id_x;console.log("c_lamp="+c_lamp);	
break;
default:
break;	
}
if (c_lamp!="" && scoull!="") {
	var elements = document.getElementsByClassName(c_lamp);
	for (var i = 0; i < elements.length; i++) {
    var element = elements[i];
    element.style=scoull;}
	}
return;
}

/*-------connexion au serveur SSE---------*/	
<?php
//if (SSE==true) echo 'SSEconnect()';?>	
/*-------affiche l'image de la page accueil---------------------------------------*/	
var text1="";var larg = (document.body.clientWidth);
var haut = (document.body.clientHeight);
document.getElementById('largeur').innerHTML =larg;	
document.getElementById('hauteur').innerHTML =haut;	
$(".banner-image").backstretch({ width: 768, url: "<?php echo IMAGEACCUEIL?>" },
            { width: 534, url: "<?php echo IMAGEACCUEILSMALL;?>" });
$('.close_clavier').click(function(){
  $("#btn_a").trigger("click");
});	
/*----------------------------------------------------*/	
var base_url=window.location.href;
var arret_mur;var arret_zoom;
notpiles="<?php echo NOTIFICATIONS_PILES;?>";if (notpiles==""){notpiles="interieur";}	
not_piles_reset="reset_erreur_"+notpiles;not_piles="erreur_"+notpiles;																	
/*----------------------------------------------------*/

/*commande onoff*/	
$("#onoffmur").change(function() {	
if (document.getElementById('onoffmur').checked==true) {arret_mur=1;updateImage(nbrCam);
														document.getElementById('aqw').innerHTML=" Vidéo active sur toutes les caméras";}
	else {arret_mur=0;document.getElementById('aqw').innerHTML="Vidéo inactive";}
});		
/*-----------------------------------*/
$("#onoffdvr").change(function() {
  if ($(this).prop("checked")==true) {$('#agent_dvr').attr('src',liendvr);}
	else {$('#agent_dvr').attr('src','');}
	});	
//---------------------------------------------------------------		
	/* on place ici l'exécution des scripts	*/			
$('.menu-link').bigSlide({'easyClose': true});
$(".zz").click(function(){
		$(".menu-link").trigger("click");});
/*------------------------------------------------------------
PAGE ACCUEIL*/
/*-------------------------------------------------------------*/
/*NOTIFICATIONS POUBELLES Fosse septique,.....
----fonction en relation avec le script lua de dz----
-------concerne les poubelles , la fosse septique , la page météo ------*/	
var idx_idimg;
service=new Array();
maj_services(0);
var time_maj=<?php echo TEMPSMAJSERVICES;?>;
var time_maj_al=<?php echo TEMPSMAJSERVICESAL;?>;
var int_maj=time_maj;
function maj_services(index){		
  $.ajax({
    type: "GET",
    dataType: "json",
    url: "ajax.php",
    data: "app=services&variable=0",
    success: function(html){service=html;var count = Object.keys(html).length;
		if (html){int_maj=html[0].interval_maj;
		var i, idw,idt,img_serv,txt_serv = "";
		for (i = 1; i < count; i++) {//console.log("idx="+html[i].idx);
	img_serv = html[i].image;
	//img_serv ? img_serv : "http://192.168.1.9/monitor/"+html[i].image;		
	idw = html[i].ID_img;idt = html[i].ID_txt;exist = html[i].exist_id;name_var=html[i].Name;
	if (exist=="oui"){
		if (idw=="poubelle"){idx_idimg=html[i].Value;idx_ico=html[i].icone;}
		if (idw=="#shell")  {id_var=html[i].idx;v_var=html[i].Value;
			if (v_var!="0")  {					 
		var type=2;
		if (idt="dz") {var ipserv="<?php echo $IP_dz;?>";var userserv="<?php echo $USER_dz;?>";var pwdserv="<?php echo $PWD_dz;?>";}
		if (idt="ha") {var ipserv="<?php echo $IP_ha;?>";var userserv="<?php echo $USER_ha;?>";var pwdserv="<?php echo $PWD_ha;?>";}		
		else { var ipserv="<?php echo $IP_iob;?>";var userserv="<?php echo $USER_iob;?>";var pwdserv="<?php echo $PWD_iob;?>";}
		 					
			$.get( "ajax.php?app=shell&variable="+ipserv+"&name="+userserv+"&table="+pwdserv+"&type=2&command="+v_var, function(datas) {
  				alert(datas);
  
  			});maj_variable(id_var,"BASH",0,2);
			
		
		}	}
	var myEle = document.getElementById(idt);	
	if ((myEle) && (idt!="")&&(idt!="0")&&(html[i].Value!="0")){document.getElementById(idt).innerHTML =html[i].Value;}
	if ((myEle) && (idt!="")&&(idt!="0")&&(html[i].Value=="0")){document.getElementById(idt).innerHTML ="";}
	/*if (((idt=="")||(idt=="0"))&&(html[i].Value!="0")){document.getElementById(idt).innerHTML ="";}*/
	
		if (idw!="" && idw!="#shell"){if (document.getElementById(idw)){
			if (img_serv=="pas image"){document.getElementById(idw).style.display = "none";} 
			else {$('#'+idw).attr('src', img_serv);document.getElementById(idw).style.display = "block";} 
					}
		else {document.getElementById(not_piles).innerHTML =("erreur : "+idt);
			  document.getElementById(not_piles_reset).style.display="block";}	
					}
					
	
	
	}
	
		} } },
error: function() {alert('La requête n\'a pas abouti');} 
  });if (int_maj>0){timemaj=time_maj_al;}	
		else {timemaj=time_maj}	 
  setTimeout(maj_services, timemaj, 0); 
 };	
/*-------------------------------------------*/
 //$("#fosse").bind("click", function(event){ maj_variable("6","fosse_septique","0","2")});
 /*-----maj variable de Domoticz--------------------*/ 
function maj_variable(idx,name,valeur,type){
  $.ajax({
    type: "GET",
    dataType: "json",
    url: "ajax.php",
    data: "app=maj_var&idx="+idx+"&name="+name+"&variable="+valeur+"&type="+type,
    success: function(html){if (html.status!="OK"){console.log("maj variable=OK")}}
  });
	 };	
/*--------------------------------------------------------------*/	
json_idx_idm(5);maj_dev=new Array();
function json_idx_idm(command){
  $.ajax({
    type: "GET",
    dataType: "json",
    url: "ajax.php",
    data: "app=idxidm&command="+command,
    success: function(html){maj_dev=html;}
  });
	 };	
/*-----meteo France prev 1 H-------------------------------------------------------*/
pluie("2");var echeance;var prev_pluie;var texte_pluie;//var tc=<?php echo $_SESSION["TC"];?>;
function pluie(idx){//var tc=TestConnection_js();
  $.ajax({
    type: "GET",
    dataType: "json",
    url: "ajax.php",
    data: "app=infos_met&variable="+idx,
    success: function(html){if (html){
		var maj = html.maj;
		var titre = html.titre; 
		prev_pluie= html.prev_pluie;
		test_pluie = html.test_pluie;
		if (html.img_pluie == null){ var img_pluie = "images/parapluie_ferme.svg";}
		else var img_pluie = html.img_pluie;
		//if (tc==0) img_pluie="images/panne_web.jpg";
		if(test_pluie=="pas de pluie"){texte_pluie=titre; 
									   document.getElementById("pluie").style.display = "block";document.getElementById('pluie').innerHTML ='<img src="'+img_pluie+'" alt="pluie">';
									   document.getElementById("txt_pluie").style.display = "none";}
		else {document.getElementById("pluie").style.display = "block";
			  document.getElementById('pluie').innerHTML ='<img src="'+img_pluie+'" alt="pluie">';
			texte_pluie=titre; 
			document.getElementById('txt_pluie').innerHTML ='<a href="#accueil">'+maj+':'+titre+'</a>';
			document.getElementById("txt_pluie").style.display = "block";}
	}  } });
	 setTimeout(pluie, 3600000, 2);   
 };	
 /*------lecture des indfos de l'alerte pluie----------------------------------------*/
 $("#txt_pluie").click( function() { alert(texte_pluie); });
/*--------------------------------------------------------------------------*/
/*--------------mise a jour dispositifs PLAN domoticz------*/	
/*----------------------------------------------------*/	
var plan=<?php echo NUMPLAN;?>;// suivant le N° du plan qui contient tous les dispositifs
var tempo_dev=<?php echo TEMPO_DEVICES;?>;// temps entre 2 mises à jour
pp=new Array();maj_devices(plan);
worx=new Array();	
function maj_devices(plan){
$.ajax({
    type: "GET",
    dataType: "json",
    url: "ajax.php",
    data: "app=devices_plan&variable="+plan,
    success: function(response){pp=response;var al_bat="";
   console.log('custom='+custom);
    if (typeof custom != 'undefined') {
		if (custom==1 & pp[0]['serveur_iob'] === true){custom_js(custom);}	
	     }
		//worx=pp[200].values;maj_worx(pp[200].Name,pp[200].Data);}
		
		$.each( pp, function( key, val ) {vol=0;pcent=0;
		if (val.maj_date=='0'){
			if (val.jour!=num_jour){aff_date();
			<?php if (DECOUVERTE==false){ echo "document.getElementById('tspan7024').innerHTML=jour;" ;}?>
			mc(1,"#meteo_concept");}}
		else {//console.log('ok_deb');
			var myEle = document.getElementById("cercle_"+val.idm);	
			if (val.alarm_bat=="alarme" || val.alarm_bat=="alarme_low") {al_bat=al_bat+val.idx+" , ";
				if (myEle){
					if (val.alarm_bat=="alarme") {myEle.style = "fill-opacity: 1;fill: #b58585";}
					else {myEle.style = "fill-opacity: 1;fill: red";}}}
			else 
				if (myEle) {myEle.style = "fill-opacity: 0";}
			document.getElementById('erreur').innerHTML ="";
			if ((val.ID1)&&(val.ID1!="#")){if (document.getElementById(val.ID1)) {if (val.Data) {pos_m=(val.Data).toString().toLowerCase();}
				if ( val.maj_js=="data") {document.getElementById(val.ID1).innerHTML=val.Data;}
				if (val.maj_js=="temp" ) {document.getElementById(val.ID1).innerHTML=val.temp;pos=val.temp;}
				//if ( val.maj_js=="onoff_rgb" && val.actif==2) {if (Number(pos_m.substring(12, 14))>0 ) { pos_m="on";}
											  // else {pos_m="off"; }}
				if ( val.maj_js=="on_level" && val.actif==2) {if (pos_m != "off") { pos_m="on";}
											   else {pos_m="off"; }}									   
				if ( val.maj_js=="on_level" && val.actif==2) {if (pos_m != "off") { pos_m="on";}
											   else {pos_m="off"; }}							   
				if ((val.maj_js=="onoff+stop") && ((pos_m.substring(0, 11)=="set level: ") || (pos_m=="open"))) {vol=1;pos_m="on";if ( (val.Data).substring(0, 11)=="Set Level: "){var pourcent = (val.Data).split(" ");pcent=pourcent[2];}}
				if ((val.maj_js=="control" || val.maj_js=="onoff" || val.maj_js=="onoff+stop" || val.maj_js=="on_level"  || val.maj_js=="on") && (pos_m=="on" || pos_m=="open" )){
						if (val.ID1) {document.getElementById(val.ID1).style = val.coul_ON; }
						if (val.ID2) {document.getElementById(val.ID2).style = val.coul_ON;}
						if (val.class_lamp) { maj_mqtt(val.class_lamp,val.coullamp_ON,1,0);if (vol==1){
							var h=document.getElementById(val.ID1).getAttribute("h");
							document.getElementById(val.ID1).setAttribute("height",parseInt((h*(pcent)/100)));}
							}}			
			if ((val.maj_js=="control" || val.maj_js=="onoff" || val.maj_js=="onoff+stop" || val.maj_js=="on_level" || val.maj_js=="on") && (pos_m=="off" || pos_m=="closed" )){//console.log(val.ID1,val.idm);
						if (val.ID1) {document.getElementById(val.ID1).style = val.coul_OFF;}
						if (val.ID2) {document.getElementById(val.ID2).style = val.coul_OFF;}
						if (val.class_lamp) { maj_mqtt(val.class_lamp,val.coullamp_OFF,1,0);}}	
				if ((val.maj_js=="etat") && (val.Data=="Open")){document.getElementById(val.ID1).style = val.coul_ON;}
				if ((val.maj_js=="etat") && (val.Data=="Closed")){document.getElementById(val.ID1).style = val.coul_OFF;}	
				}}
			
			else if (val.ID1!="#"){document.getElementById('erreur').innerHTML ="erreur ID1_html   BD  idm="+val.idm +" nom:"+val.Name;}
			//else if (val.idm!="NULL" ){document.getElementById('erreur').innerHTML ="erreur ID1_html   BD  idm="+val.idm +" nom:...."+val.Name;}
			else if (val.idx=="NULL" && val.ID=="NULL"){document.getElementById('erreur').innerHTML ="erreur ID1_html   BD  idm="+val.idm +" nom:"+val.Name;}
		}});
				if (al_bat!="" ){document.getElementById(not_piles).innerHTML="batterie(s) faible(s) ou moyenne(s) : "+al_bat;
				document.getElementById(not_piles_reset).style.display="block";}
					}
	
});

setTimeout(maj_devices, tempo_dev, plan); 
}
/*--------------------------------------*/
function class_name(cn,coul){
var elements = document.getElementsByClassName(cn);
for (var i = 0; i < elements.length; i++) {
    var element = elements[i];
    element.style=coul;
}
}
/* volets roulants*/

$('.closeBtn').on('click', function () {
      $('#popup_vr').hide();
    });
/* switchOnOff*  
	rgb :  "Color": "{\"b\":214,\"cw\":0,\"g\":86,\"m\":4,\"r\":254,\"t\":0,\"ww\":0}" */
qq=new Array();	
<?php if ($_SESSION["exeption_db"]=="" &&  DECOUVERTE==false)   {sql_plan('0');}	?>
rr=new Array();
 
	function switches(server,idm,idx,command,pass="0"){
	switch (server) {
	case "1":
	case "2": var app="OnOff";
	  var type;var level;
	  if ((command=="On")||(command=="Off")){type=2;}
	  else if (command=="Set Level") {type=3;level=100;//var pourcent = command.split(" ");level=pourcent[2];
				//if (level=="") level=100;

	  }
	  else {type=1;}
	break;				
	case "3": var app="turn";var type=0;var level=0;
		if (command=="On") command ="on";
		if (command=="Off") command ="off";	
	break;
	case "4": var app="put";var type="state";var level=0;console.log("relllll="+command);
			if (command!="On"){ type="on=";}
	break;
	default:
	break;
	}		
	switchOnOff(app,idm,idx,command,type,level,pass="0")		
		}
	
  function switchOnOff(app,idm,idx,command,type,level,pass){
	/*pos : inter avec 1 position (poussoir On/OFF=1 , inter avec 2 positions=2 , inter avec Set Level = 3*/ 
	  if (command=="On" || command=="on" || type=="on=" || command=="group on" || command=="Set Level") {
	 if ((pp[idm]) && type!="on="){	
	  if (pp[idm].Data == "off" ) {command="on";}
		if (pp[idm].Data == "on" ) {command="off";} 
		if (pp[idm].Data == "On" ) {command="Off";} 
		 if (pp[idm].Data == "Off" ) {command="On";} 
		 if (pp[idm].Data == "On" && pp[idm].maj_js != "on" ) {command="Off";}
		if (pp[idm].Data == "Off" && pp[idm].maj_js != "on" ) {command="Off";} 
	  if (pp[idm].Data == "on" && pp[idm].maj_js != "on"  ) {command="off";} 
		if (pp[idm].Data == "Off" && pp[idm].maj_js != "on" ) {command="On";} 
		if (pp[idm].Data != "Off" && pp[idm].maj_js == "on_level"  ) {level=0; command="Off";}
		if (pp[idm].Data == "Off" && pp[idm].maj_js == "on_level" ) {level=100;command="On";} 
		console.log("type"+type+"level"+level);
       	}
		 
	    $.ajax({
    	type: "GET",
    	dataType: "json",
    	url: "ajax.php",
    	data: "app="+app+"&device="+idx+"&command="+command+"&type="+type+"&variable="+level+"&name="+pass,
    	success: function(response){qq=response;
			if (qq!=null){
				if (qq['status']!="OK" ){
			if (pass=="pwdalarm") {document.getElementById("d_btn_a").style.display = "block";
			document.getElementById("d_btn_al").style.display = "block";}
			if (pass=="pwdcommand") {document.getElementById("btn_c").style.display = "block";document.getElementById('txt_cmd').innerHTML ="mot de passe incorrect ou dépassé";
			document.getElementById("txt_cmd").style.display = "block";}		
					
			}
				
			if (qq['status']=="OK" ) {maj_mqtt(idx,command,0,level);}
			//if (qq['status']="OK" && app!="turn") {maj_mqtt(idx,command,0,level);}			
			/*else {
				$.ajax({
    	type: "GET",
    	dataType: "json",
    	url: "ajax.php",
    	data: "app=turn&device="+idx+"&command=etat&name="+pass,
    	success: function(response){qq=response;
		var level=0;command=qq.state;
	    maj_mqtt(idx,state,0,level);									
		}
				
				});
			}*/}
      }}); } 
  else alert("erreur");
  }
	
/*-------NON UTILISE---------------------------*/
function maj_switch(idx,command,level,idm){
	pp[idm].Data=command;console.log(command);
	sid1=pp[idm].ID1;sid2=pp[idm].ID2;idm=pp[idm];
		if (command=="On" || command=="on")  {scoul=idm.coul_ON;if (scoull=idm.coullamp_ON!="") scoull=idm.coullamp_ON;}
		else if (command.substring(0, 9)=="Set Level")  {if (scoull=idm.coullamp_ON!="") scoul=idm.coul_ON;scoull=idm.coullamp_ON;}
		else if  (command=="Off"  || command=="off" ) {scoul=idm.coul_OFF;if (scoull=idm.coullamp_OFF!="") scoull=idm.coullamp_OFF;}
		else return;																			  
	document.getElementById(sid1).style = scoul;
	if (sid2) {document.getElementById(sid2).style = scoul;}
	if (idm.class_lamp!="") {class_name(idm.class_lamp,scoull);}
	if (command.substring(0, 9)=="Set Level") {var h=document.getElementById(sid1).getAttribute("h");
	document.getElementById(sid1).setAttribute("height",parseInt((h*(level)/100)));console.log("h="+h+parseInt((h*(level)/100)));}
	
	return; }
/*--------------------------------*/	
$("#amount").click(function () {
		var idx = $("#VR").attr('rel');
		var idm = $("#VR").attr('title');
	    var command=$("#amount").attr('name');//console.log(idx," ",idm,"",command);
		switchOnOff(idm,idx,command);
	});
//
/*PAGE METEO----Méteo Concept----------------------------------------------
maj manuelle-MC------------------*/
$(".maj_mconcept").click(function () {
mc(1,"#meteo_concept");mc(0,"#meteo_concept_am");});	
/*--------------------------------*/
mc(1,"#meteo_concept");
mc(0,"#meteo_concept_am");
//mc(3,"#temp_ext");	//pour la T° locale 
setTimeout(pluie, 3600000, 2);
function mc(variable,id){
  $.ajax({
    type: "GET",
    url: "ajax.php",
    data: "app=meteo_concept&variable="+variable,
    success: function(data){
        if (variable==3 || variable==2) $(id).html(data.data);
		else $(id).html(data);
}
});
//setTimeout(mc, 1800000, 3,"#temp_ext");//pour la T° locale tt 30mn	
 };
 /*-------------------------------------*/
$(".btn_cam").click(function () {if (zoneminder==null && dahua=='generic'){alert("Zoneminder non installé");}
  else {$.modalLink.open("ajax.php?app=upload_conf_img&name="+dahua+"&command="+dahua_type+"&variable="+ip_cam+"&idx="+idx_cam+"&type="+zoneminder,{
  // options here
	   height: 400,
	  width: 400,
	  title:"configuration de la caméra",
	  showTitle:true,
	  showClose:true

  }); }
});
/*-----administration-------------------------------- */
$(".admin1").click(function() {choix_admin =$(this).attr('rel');//console.log(choix_admin);
fenetre =$(this).attr('title');
appel_admin(choix_admin,fenetre);}) ;						   

function appel_admin(choix_admin,fenetre){
	$.ajax({ 
      type: 'GET', 
      url: 'ajax.php', 
      dataType: 'text', 
	  data: "app=admin&variable="+choix_admin+"&command="+fenetre,
      success: function(data) {$(fenetre).empty();
		document.getElementById(fenetre).innerHTML = data;document.getElementById(fenetre).style.display = "block";
		if (data.indexOf("Entrer votre mot de passe") >0) {document.getElementById("d_btn_a").style.display = "block";
		document.getElementById("d_btn_al").style.display = "block";}
							},
	  error: function() { 
                          alert('La requête n\'a pas abouti'); 
                        } 
}); 
} 

/*------------------------------------------------------------------------*/	
/*graphiques---------------------------------------*/
$('#btn_graph').on('click', function() { 
var device = $('input[name=devices]:checked').val();
var variable = $('input[name=variables]:checked').val();
$("#btn_g").trigger("click");
graph(device,variable,"graphic");
        });
/*--------------fin graphiques------------------------*/
/*scenes---------------------------------------*/
$('#btn_scenes').on('click', function() { 
$("#btn_sc").trigger("click");
//scenes(device,variable,"scenes");
        });
/*--------------fin graphiques------------------------*/	
	
/*zoom*/
<?php 
if (ON_MUR==false || SRC_MUR=="fr") echo "/*";?>
$(".dimcam").on("click", function() {rel = $(this).attr('rel');
   $('#imagepreview').attr('src',this.src); // here asign the image to the modal when the user click the enlarge link
   $('#imagemodal').modal('show'); // imagemodal is the id attribute assigned to the bootstrap modal, then i use the show function
	var zoomImg=document.getElementById('imagepreview');arret_zoom=1;updateZoom(rel);	
});

// total number of cams on the wall
nbrCam=<?php echo NBCAM;?>;i=1;
while (i <= nbrCam) {
	camImgId="cam" + i;
  	camImg=document.getElementById(camImgId);
	URL[i]=camImg.src;	
  i++;}	

$('.modal').on('hide.bs.modal', function(){
  arret_zoom=0;
});
function updateZoom(camIndex){
if (arret_zoom==0) return false;
if (document.getElementById('imagepreview').complete==true) 
	{now=new Date();
	// update cam 
		camImg=document.getElementById("imagepreview");
		camImg.src=URL[camIndex]+now.getTime();//console.log('hh'+camImg.src);
	}
	// call update for current camera in 100 ms
	setTimeout(function() { updateZoom(camIndex); }, 100);
}	


function updateImage(camIndex)
{if (arret_mur==0) return false;
	// get cam image ID
	camImgId="cam" + camIndex;
	
	// if cam image element is fully downloaded
	if (document.getElementById(camImgId).complete==true) 
	{	now=new Date();
	// update cam index to next cam
		camIndex++;
		if (camIndex > nbrCam) camIndex=1;
		// update next cam URL to force refresh
		camImgId="cam" + camIndex;
	 
		camImg=document.getElementById(camImgId);
		camImgURL=camImg.src;console.log('gg'+camImgURL);
		camImg.src=URL[camIndex]+now.getTime();
	}

// call update for current camera in 100 ms
	setTimeout(function() { updateImage(camIndex); }, 100);
}
<?php if (ON_MUR==false) echo "*/";?>
//--------------------------------------
/*app diverses log , recettes -----*/
$(".btn_appd").click(function () {
	if (larg<768) {lwidth=400;lheight=520;}
	else {lwidth=600;lheight=600;}
var logapp = $(this).attr('rel');
if ((logapp.length)<2){urllog="ajax.php?app=log_dz&variable="+logapp;titre="log domoticz";}
else if (logapp=="hostlist"){urllog="ajax.php?app=infos_nagios&variable="+logapp;titre="Hosts Nagios";}
else if (logapp=="sql"){var table_sql = $(this).attr('title');
	urllog="ajax.php?app=sql&idx=1&variable="+table_sql+"&type=&command=";titre="historique poubelles";}
else if (logapp=="cuisine"){var table_sql = logapp;var numrecette = $(this).attr('title');titre = $(this).attr('alt');
	urllog="ajax.php?app=sql&idx=4&variable="+table_sql+"&type=id&command="+numrecette;}	
else if (logapp=="modes_emploi"){var table_sql = logapp;var nummode_e = $(this).attr('title');titre = $(this).attr('alt');
	urllog="ajax.php?app=sql&idx=4&variable="+table_sql+"&type=id&command="+nummode_e;}		
else {urllog="erreur";}
  $.modalLink.open(urllog, {
  // options here
	   height: lheight,
	  width: lwidth,
	  title:titre,
	  showTitle:true,
	  showClose:true

  }); 
});
/*---popup boite_lettres---pression chaudière--médicaments-fosse septique-----------------------------*/
var bl=0;ch_idx="0";ch_ID="0";ch_name="";var modalContainer = document.createElement('div');
modalContainer.setAttribute('id', 'modal_bl');
var customBox = document.createElement('div');
customBox.className = 'custom-box';
// Affichage boîte de confirmation
	$(".confirm a").click(function(){ 
    var title_confirm=$(this).attr('title');ch=$(this).attr('rel');
	var nb = Object.keys(service).length;
		for (i = 1; i < nb; i++) {//console.log(ch+'...'+service[i].ID);
		if (service[i].idm==ch) {		
			var content_modal=service[i].contenu;ch_idx=service[i].idx;ch_ID=service[i].ID;ch_name=service[i].Name;
	}
		}
	customBox.innerHTML = '<p>'+title_confirm+'</p><p>'+content_modal+'</p>';
    customBox.innerHTML += '<button style="margin-right: 20px;" id="modal-confirm">Confirmer</button>';
    customBox.innerHTML += '<button id="modal-close">Annuler</button>';
   modalShow();
 //console.log(bl);
});		
function modalShow() {
    modalContainer.appendChild(customBox);
    document.body.appendChild(modalContainer);
    document.getElementById('modal-close').addEventListener('click', function() {
        modalClose();
    });
    if (document.getElementById('modal-confirm')) {
        document.getElementById('modal-confirm').addEventListener('click', function () {
           bl=1; 
           modalClose(bl);
        });
    } else if (document.getElementById('modal-submit')) {
        document.getElementById('modal-submit').addEventListener('click', function () {
            //console.log(document.getElementById('modal-prompt').value);
            bl=0;modalClose(bl);
        });
    }
}
function modalClose(bl) {
    while (modalContainer.hasChildNodes()) {
        modalContainer.removeChild(modalContainer.firstChild);
    }
    document.body.removeChild(modalContainer);
	 if (bl==1) {console.log("azerty="+ch_idx);
		 if (ch_idx.length >0) {
			maj_variable(ch_idx,ch_name,"0",2);} 
		 else{var substr = ch_ID.split('.');ch_ID = "input_boolean."+substr[1];//console.log(ch);
			 turnonoff("",ch_ID,"on",pass="0");} }  
	maj_services(0);bl=0;ch_idx="0";ch_ID="0";ch_name="";
}
/*------------------------------------------*/
/*nagios("","#nagiosapp");
function nagios(variable,id){
  $.ajax({
    type: "GET",
    url: "ajax.php",
    data: "app=app_nagios&variable="+variable,
    success: function(data){
            $(id).html(data);
}
});
 }	*/	
$("#poubelle").click(function () {
var date_poub=new Date();
var jour_poub=date_poub.getDate();
var an_poub=date_poub.getFullYear();
var months=new Array('Janvier','Février','Mars','Avril','Mai','Juin','Juillet','Aout','Septembre','Octobre','Novembre','Décembre');
var mois_poub=months[date_poub.getMonth()];
var date_poub=jour_poub+' '+mois_poub+" "+an_poub;
            $.ajax({
             url: "ajax.php",
             data: "app=sql&idx=0&variable=date_poub&type="+idx_idimg+"&command="+
			 date_poub+"&name="+idx_ico,
            }).done(function() {
             alert('date ramassage enregigistrée:'  +date_poub);
            });
        });
$("#zm").click(function () {
          $.ajax({
             url: "ajax.php",
             data: "app=sql&idx=3&variable=cameras&type=modect&command=1",
			 success: function(data) { 
             alert("liste de caméras enregistrées \nen modect dans SQL\n"+data);
            }
        });
		});
<?php
if (SSE==false) echo '
tempo_devices='.TEMPO_DEVICES_D.';
var idsp=1;if (tempo_devices>30000)	tempo_devices=30000;
var_sp(idsp);

	function var_sp(idsp){
  $.getJSON( "ajax.php?app=data_var&variable=29", function(data) {
  //console.log(data.var_dz);
  if (data.var_dz=="1"){maj_variable(29,"variable_sp",0,2);maj_devices(plan);maj_services(0);}
	 if (data.message!="0"){maj_variable("msg",data.message,0,0);maj_services(0);  }
  });
setTimeout(var_sp, tempo_devices, idsp); 	
}';?>


/*----------fin document-------------------------------*/
	

</script><script>
/*----------------script pour svg---*/
var nom;
	function popup_device(nom) {
	if (nom < 10000){if (pp[nom]){
	var donnees="idm :" +pp[nom].idm+"<br>"+
	"idx :" +pp[nom].idx+"<br>"+
	"ID :" +(pp[nom].ID).substring(0, 32)+"<br>"+	
	"Nom :" +pp[nom].Name+"<br>"+
	"t° :"+pp[nom].temp+"<br>"+
	"batterie :" +pp[nom].bat+"<br>"+
	"humidité :" +pp[nom].hum+"<br>"+
	"update :" +pp[nom].update+"<br>"+
	"serveur :" +pp[nom].serveur+"<br>"+	
	"Data :" +pp[nom].Data;
		
 $("#contenu").empty();$("#contenu").append(donnees);
	$('#infos').modal('show');}
		else {document.getElementById('erreur').innerHTML ="erreur BD";
								document.getElementById('erreur_interieur').innerHTML ="erreur pas d'enregistrement BD pour "+nom;}
	}
	else {
		$.ajax({
			type: "GET",
    url: 'ajax.php',
	data: "app=upload_img&variable="+nom,
	dataType: 'json',
    success: function(html) {
		urlimg=html['url']+"?"+Date.now()/1000;zoneminder=html['id_zm'];dahua=html['marque'];
		ip_cam=html['ip'];idx_cam=html['idx'];dahua_type=html['type'];//console.log(dahua_type);
		if (nom<10010){$('#cam').attr('src',urlimg); $('#camera').modal('show');} 
		else {$('#cam_ext').attr('src',urlimg); $('#camera_ext').modal('show');} }
			});         
		} 
	}


</script>

 <style>
  #custom-handle {
    width: 3em;
    height: 1.6em;
    top: 50%;
    margin-top: -.8em;
    text-align: center;
    line-height: 1.6em;
  }
  </style>
<script>
var sliderMin = 0,
  sliderMax = 100;

$('#slider').slider({
  step: 1,
  min: 0,
  max: 100,
  value: sliderMin,
  slide: function(event, ui) {
    var amount = ui.value;
    if (amount < sliderMin || amount > sliderMax) {
      return false;
    } else {
      $("#amount").attr("name","Set Level: "+amount);
	 $("#level_vr").html("Set Level: "+amount+"%");
    }
  }
});

$("#amount").val(sliderMin);
	


/*--------------------------------------------------*/
 
/*------------------------------------------*/
	
	
	
	
	
	</script>

<script>
$('.info_admin').click(function(){
var rel=$(this).attr('rel');$('#affich_content_info').empty;var info_admin="";
affich_info_admin(rel);
});	
function affich_info_admin(rel){	
//console.log(rel);
<?php echo "var info_admin = ". $js_info_admin . ";\n";?>
document.getElementById("affich_content_info").innerHTML = info_admin[rel];

}
	
	
	
function adby(choix) {var formData=new Array();
switch (choix) {
	case 1: $("#advf").css("display", "none");$("#adv_f").css("display", "none");
	var fenetre="avb";
	var formData = {
	app :  $("#app1").val(),		
 	idx : $("#idx").val(), 
	idm : $("#idm").val(), 	
  	nom_objet : $("#nom_objet").val(),
	ID : $("#ha_id").val(),	
	id_img : $("#id_img").val(),
	id_txt : $("#id_txt").val(),
	texte_bd : $("#texte_bd").val(),
	image_bd : $("#image_bd").val(),
	icone_bd : $("#icone_bd").val(),	
	 command : $("#command").val(),
	};
     break;			
  case 2:$("#adbf").css("display", "none");$("#bouton_maj").css("display", "none");
	var fenetre="adb";	
	var formData = {
	app:  $("#app").val(),
	command:  $("#command").val(),
	nom :  $("#nom").val(),	
	maj_js : $("input[name=maj_js]:checked").val(),	
	nom_objet :  $("#nom_objet").val(),
    idx: $("#idx").val(),
	ID : $("#ha_id").val(),
    idm: $("#idm").val(),
	actif : $("input[name=actif]:checked").val(),
	id1_html: $("#id1_html").val(),
	id2_html: $("#id2_html").val(),
	coula : $("#coula").val(),
	coulb : $("#coulb").val(),
	type_mat :	$("input[name=type_mat]:checked").val(),
	ls :	$("input[name=ls]:checked").val(),	
	class : $("#class").val(),
	coulc : $("#coulc").val(),
	could : $("#could").val(),		
	pass : $("input[name=mot_pass]:checked").val(),
	fx : $("#fx").val(),
	car : $("#car").val(),	
	obs : $("#obs").val(),			
    };
	break;	
case 3: 
	var fenetre="amb";
	var formData = {
	app :  $("#app3").val(),		
 	id_txt : $("#id_txt").val(),
  	nom : $("#nom").val(),	
	command : $("#command").val(),
	};
break;		
case 4: $("#bouton_maj").css("display", "none");
	var fenetre="adb";
	var formData = {
	app :  "dev_bd",		
 	majidm: $("#majidm").val(),	
  	command : $("#command1").val(),
	};
     break;
case 5:
	var fenetre="adb";	
	var formData = {
	app:  $("#app").val(),
	command:  $("#command").val(),
	nom :  $("#nom").val(),	
	maj_js : $("#maj_js").val(),	
	nom_objet :  $("#nom_objet").val(),
    idx: $("#idx").val(),
	ID : $("#ha_id").val(),
    idm: $("#idm").val(),
	actif : $("#actif").val(),
	id1_html: $("#id1_html").val(),
	id2_html: $("#id2_html").val(),
	coula : $("#coula").val(),
	coulb : $("#coulb").val(),
	type_mat :	$("#type_mat").val(),
	ls :	$("#ls").val(),	
	class : $("#class").val(),
	coulc : $("#coulc").val(),
	could : $("#could").val(),		
	pass : $("#pass").val(),
	fx : $("#fx").val(),
	car : $("#car").val(),	
	obs : $("#obs").val(),			
    };
	break;
	case 6: $("#bouton1_maj").css("display", "none");
	$("#adv_f").css("display", "none");	
	var fenetre="avb";
	var formData = {
	app :  $("#app").val(),		
 	num: $("#num").val(),	
  	command : $("#command2").val(),
	};
     break;	
	case 7: 
	var fenetre="avb";
	var formData = {
	app :  $("#app").val(),
	num : $("#num").val(), 	
 	idm : $("#idm").val(), 
	idx : $("#idx").val(), 	
  	nom_objet : $("#nom_objet").val(),
	ID : $("#ha_id").val(),	
	id_img : $("#id_img").val(),
	id_txt : $("#id_txt").val(),
	command : $("#command3").val(),
	};
     break;	
	case 8: $("#bouton2_maj").css("display", "none");
	$("#advf").css("display", "none");	
	var fenetre="avb";
	var formData = {
	app :  $("#app").val(),		
 	texte: $("#texte").val(),	
  	command : $("#command4").val(),
	};
     break;	
	case 9: 
	var fenetre="avb";
	var formData = {
	app : $("#app").val(),
	num : $("#num").val(), 	
 	texte : $("#texte").val(), 
  	image : $("#image").val(),	
	icone : $("#icone").val(),
	command : $("#command5").val(),
	};
     break;	
	case 10: 
	var formData = {
	app : $("#mapp").val(),
	type : Number($("#type").val()),	
	//variable : Number($("#level").val())*100,	
	command : $("#rgb").val(),
	device : $("#midx").val(),
	name : "0"		
	};fenetre='color_lampes';
     break;		 
	  default:
	}
    $.ajax({
      type: "GET",
      url: "ajax.php",
      data: formData,
      dataType: "html",
	success:function (data) {$('#'+fenetre).empty();
		document.getElementById(fenetre).innerHTML = data;document.getElementById(fenetre).style.display = "block";
      },
		error: function() { 
                          alert('La requête n\'a pas abouti'); 
                        } 
    });
  }	
</script><script>
$('li.ww').click(function(){var ww1 = $(".www").attr('href');
$(ww1).attr('display','block');
});	</script>
<?php
if (SSE=='node') {$domaine=$_SESSION["domaine"];
if ($domaine==URLMONITOR) $lien="https://".SSE_URL;
if ($domaine==IPMONITOR) $lien="http://".SSE_IP.":".SSE_PORT."/events";
	echo "
<script>
    const eventSource = new EventSource('".$lien."');
    eventSource.onopen = function() { document.getElementById('status').innerText='connecté';};
    eventSource.onmessage = function (currentEvent) {
      const listElement = document.getElementById('messages').innerText = currentEvent.data;;
      console.log(currentEvent.data);donnees=JSON.parse(currentEvent.data);
	  var id_x=donnees.id;var state=donnees.state;
	  maj_mqtt(id_x,state,0)
    };
  </script>";}
	  





if (SSE=='php') {echo "
<script>

    window.onload = function() {
	// établir un flux et enregistrer les réponses sur la console
var source = new EventSource('include/serveur_sse.php');
 
source.addEventListener('message', function(e) {
document.getElementById('messages').innerHTML = e.data ;
donnees=JSON.parse(e.data);var id_x=donnees.id;var state=donnees.state;console.log(id_x,state);
maj_mqtt(id_x,state,0);
$.get('ajax.php', { app:'maj', id:'', state: 'OK', command:'6'});
}, false);

source.addEventListener('open', function(e) {
document.getElementById('status').innerText='connecté';
}, false);

source.addEventListener('error', function(e) {
if (e.readyState == EventSource.CLOSED) {
document.getElementById('status').innerText='connexion fermée';
}
}, false);



 
};



</script>";}?>
