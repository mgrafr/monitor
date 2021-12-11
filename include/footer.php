<?php
require("fonctions.php");
?>	
<!-- footer start -->
		<!-- ces fonctions sont utilisées pour la page d' accueil , la page interieur ,la page météo 
		================ -->
		<footer id="footer">
			<div class="footer section">
				<div class="container">
				</div>
			</div>
		</footer>
<!-- footer end -->
<!-- JavaScript files placées à la fin du document-->	
<script src="js/jquery-1.12.4.min.js"></script><script src="bootstrap/js/bootstrap.min.js"></script>
		<script src="js/jquery.backstretch.min.js"></script>
<script src="js/big-Slide.js"></script>
<script src="bootstrap/bootstrap-switch-button.js?2"></script>
<script src="js/mes_js.js?94"></script>
<!-- fin des fichiers script -->
<!-- scripts-->	
<script>
/*-------affiche l'image de la page accueil---------------------------------------*/	
var text1="";var larg = (document.body.clientWidth);var rep=9;
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
/*----------------------------------------------------*/
$(document).ready(function(){	
/*commande onoff*/	

/*-----------------------------------*/
	$("#onoffmur").change(function() {
  if ($(this).prop("checked")==true) {arret_mur=1;updateImage(nbrCam);}
	else {arret_mur=0;}
	});	
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
    data: "app=services&variable="+index,
    success: function(html){service=html;var count = Object.keys(html).length;
		if (html){int_maj=html[0].interval_maj;
		var i, idw,img_serv ,txt_serv = "";
		for (i = 1; i < count; i++) {
	img_serv = html[i].image;
	idw = html[i].ID_img;idt = html[i].ID_txt;exist = html[i].exist_id;
	if (exist=="oui"){if (idw=="poubelle"){idx_idimg=html[i].Value;idx_ico=html[i].icone;}
	var myEle = document.getElementById(idt);	
	if ((myEle) && (idt!="")&&(idt!="0")&&(html[i].Value!="0")){document.getElementById(idt).innerHTML =html[i].Value;}
	if ((myEle) && (idt!="")&&(idt!="0")&&(html[i].Value=="0")){document.getElementById(idt).innerHTML ="";}
	/*if (((idt=="")||(idt=="0"))&&(html[i].Value!="0")){document.getElementById(idt).innerHTML ="";}*/
	if ((img_serv!="pas image")&&(img_serv!=null)){//console.log(img_serv);
		if (idw!=""){if (document.getElementById(idw)){
			if (img_serv=="none"){document.getElementById(idw).style.display = "none";} 
			else {$('#'+idw).attr('src', img_serv);document.getElementById(idw).style.display = "block";} 
					}
				else if(idt!="0") {document.getElementById(idt).innerHTML ="erreur : "+idw;}	
					}
					
	}						}
		
	
	} } }
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
    success: function(html){if (html.status=="OK"){alert(html.status);maj_services(0);}}
  });
	 };	
/*--------------------------------------------------------------*/	

/*-----meteo France prev 1 H-------------------------------------------------------*/
pluie("1");var echeance;var prev_pluie;var texte_pluie;//var tc=<?php echo $_SESSION["TC"];?>;
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
		var img_pluie = html.img_pluie;//if (tc==0) img_pluie="images/panne_web.jpg";
		if(test_pluie=="pas de pluie"){texte_pluie=titre; 
									   document.getElementById("pluie").style.display = "block";document.getElementById('pluie').innerHTML ='<img src="'+img_pluie+'" alt="pluie">';
									   document.getElementById("txt_pluie").style.display = "none";}
		else {document.getElementById("pluie").style.display = "block";
			  document.getElementById('pluie').innerHTML ='<img src="'+img_pluie+'" alt="pluie">';
			texte_pluie=titre; 
			document.getElementById('txt_pluie').innerHTML ='<a href="#accueil">'+maj+'</a>';
			document.getElementById("txt_pluie").style.display = "block";}
	}  } });
	 setTimeout(pluie, 3600000, 1);   
 };	
 /*------lecture des indfos de l'alerte pluie----------------------------------------*/
 $("#txt_pluie").click( function() { alert(texte_pluie); });
/*--------------------------------------------------------------------------*/
/*--------------mise a jour dispositifs PLAN domoticz------*/	
/*----------------------------------------------------*/	
var plan=<?php echo NUMPLAN;?>;// suivant le N° du plan qui contient tous les dispositifs
maj_devices(plan);pp=new Array();
function maj_devices(plan){
$.ajax({
    type: "GET",
    dataType: "json",
    url: "ajax.php",
    data: "app=devices_plan&variable="+plan,
    success: function(response){pp=response;var al_bat="";
		$.each( pp, function( key, val ) {
		if (val.idx=='0'){
			if (val.jour!=num_jour){aff_date();mc(1,"#meteo_concept");}}
		else {
			var myEle = document.getElementById("cercle_"+val.idm);	
			if (val.alarm_bat=="alarme" || val.alarm_bat=="alarme_low") {al_bat=al_bat+val.idx+" , ";
				if (myEle){
					if (val.alarm_bat=="alarme") {myEle.style = "fill-opacity: 1;fill: #b58585";}
					else {myEle.style = "fill-opacity: 1;fill: red";}}}
			else 
				if (myEle) {myEle.style = "fill-opacity: 0";}		
			if ((val.ID1)&&(val.ID1!="#")){if (document.getElementById(val.ID1)) {
				if (val.maj_js=="temp") document.getElementById(val.ID1).innerHTML=val.Data;
					if ((val.maj_js=="control" || val.maj_js=="onoff") && (val.Data=="On")) {
						if (val.ID1) {document.getElementById(val.ID1).style = val.coul_ON;}
						if (val.ID2) {document.getElementById(val.ID2).style = val.coul_ON;}
						if (val.class_lamp) { class_name(val.class_lamp,val.coullamp_ON);}}			
				if ((val.maj_js=="control" || val.maj_js=="onoff") && (val.Data=="Off")){//console.log(val.ID1,val.idm);
						if (val.ID1) {document.getElementById(val.ID1).style = val.coul_OFF;}
						if (val.ID2) {document.getElementById(val.ID2).style = val.coul_OFF;}
						if (val.class_lamp) { class_name(val.class_lamp,val.coullamp_OFF);}}	
				if ((val.maj_js=="etat") && (val.Data=="Open")){document.getElementById(val.ID1).style = val.coul_ON;}
				if ((val.maj_js=="etat") && (val.Data=="Closed")){document.getElementById(val.ID1).style = val.coul_OFF;}	
		}}
			else {document.getElementById('erreur').innerHTML ="erreur ID1_html   BD  idx="+val.idx +" nom:"+val.Name;}
		}});
		if (al_bat!=""){document.getElementById("erreur_interieur").innerHTML="batterie(s) faible(s) ou moyenne(s) : "+al_bat;}
					}
});

setTimeout(maj_devices, 180000, <?php echo NUMPLAN;?>); 
}
/*--------------------------------------*/
function class_name(cn,coul){
var elements = document.getElementsByClassName(cn);//console.log('eww',elements)
for (var i = 0; i < elements.length; i++) {
    var element = elements[i];//console.log(element);
    element.style=coul;
}
}
/* switchOnOff*  */

<?php if ($_SESSION["exeption_db"]!="pas de connexion à la BD") {sql_plan(0);}?>
	
  function switchOnOff_setpoint(idm,idx,command,pass="0"){
	/*pos : inter avec 1 position (poussoir On/OFF=1 , inter avec 2 positions=2*/ 
	  var type;
	  if ((command=="On")||(command=="Off")){type=2;}
	  else {type=1;}
	  if (pp[idm].Data == "On") {command="Off";}
	  $.ajax({
    	type: "GET",
    	dataType: "json",
    	url: "ajax.php",
    	data: "app=OnOff&device="+idx+"&command="+command+"&type="+type+"&name="+pass,
    	success: function(response){qq=response;
			if (qq['status']!="OK")alert(qq['status']);
			else maj_devices(<?php echo NUMPLAN;?>);
			}
      });  }
/*---------------------------------------------------------------------------------------------*/
//
/*PAGE METEO----Méteo Concept----------------------------------------------
maj manuelle-MC------------------*/
$(".maj_mconcept").click(function () {
mc(1,"#meteo_concept");mc(0,"#meteo_concept_am");});	
/*--------------------------------*/
mc(1,"#meteo_concept");
mc(0,"#meteo_concept_am");
function mc(variable,id){
  $.ajax({
    type: "GET",
    url: "ajax.php",
    data: "app=meteo_concept&variable="+variable,
    success: function(data){
            $(id).html(data);
}
});
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
$(".admin1").click(function() {var choix_admin =$(this).attr('rel');console.log(choix_admin);
var fenetre =$(this).attr('title');

$.ajax({ 
                        type: 'GET', 
                        url: 'ajax.php', 
                        dataType: 'text', 
						data: "app=admin&variable="+choix_admin+"&command="+fenetre,
                        success: function(data) { 
                        document.getElementById(fenetre).innerHTML = data;document.getElementById(fenetre).style.display = "block";}, 
                        error: function() { 
                          alert('La requête n\'a pas abouti'); 
                        } 
                      }); 
});	

/*------------------------------------------------------------------------*/	
/*graphiques---------------------------------------*/
$('#btn_graph').on('click', function() { 
var device = $('input[name=devices]:checked').val();
var variable = $('input[name=variables]:checked').val();
$("#btn_g").trigger("click");
graph(device,variable);
        });
/*--------------fin graphiques------------------------*/
/*zoom*/
<?php 
if (ON_MUR==false) echo "/*";?>
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
		camImg.src=URL[camIndex]+now.getTime();console.log('hh'+camImg.src);
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
/*app diverses log-----*/
$(".btn_appd").click(function () {
var logapp = $(this).attr('rel');
if ((logapp.length)<2){urllog="ajax.php?app=log_dz&variable="+logapp;titre="log domoticz";}
else if (logapp=="hostlist"){urllog="ajax.php?app=infos_nagios&variable="+logapp;titre="Hosts Nagios";}
else if (logapp=="sql"){var table_sql = $(this).attr('title');
	urllog="ajax.php?app=sql&idx=1&variable="+table_sql+"&type=&command=";titre="historique poubelles";}
else {urllog="erreur";}
  $.modalLink.open(urllog, {
  // options here
	   height: 500,
	  width: 400,
	  title:titre,
	  showTitle:true,
	  showClose:true

  }); 
});
/*---popup boite_lettres-----------------------------------*/
var bl=0;var modalContainer = document.createElement('div');
modalContainer.setAttribute('id', 'modal_bl');
var customBox = document.createElement('div');
customBox.className = 'custom-box';
// Affichage boîte de confirmation
document.getElementById('confirm-box').addEventListener('click', function() {
    customBox.innerHTML = '<p>Confirmation de la relève du courrier</p>';
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
           //console.log('Confirmé !');
		   bl=1; 
           modalClose(bl);
        });
    } else if (document.getElementById('modal-submit')) {
        document.getElementById('modal-submit').addEventListener('click', function () {
            console.log(document.getElementById('modal-prompt').value);
            bl=0;modalClose(bl);
        });
    }
}
function modalClose(bl) {
    while (modalContainer.hasChildNodes()) {
        modalContainer.removeChild(modalContainer.firstChild);
    }
    document.body.removeChild(modalContainer);
	 console.log(bl);if (bl==1) {maj_variable(19,"boite_lettres","0",2);maj_services(0);bl=0;}  
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
		
});
/*----------fin document-------------------------------*/
	

</script><script>
/*----------------script pour svg---*/
var nom;
	function popup_device(nom) {	
	if (nom < 10000){if (pp[nom]){
	var donnees="choixid :" +pp[nom].choixid+"<br>"+
	"idx :" +pp[nom].idx+"<br>"+
	"Nom :" +pp[nom].Name+"<br>"+
	"t° :"+pp[nom].temp+"<br>"+
	"ID :" +pp[nom].ID+"<br>"+
	"batterie :" +pp[nom].bat+"<br>"+
	"humidité :" +pp[nom].hum+"<br>"+
	"update :" +pp[nom].update+"<br>"+
	"Data :" +pp[nom].Data+"<br>"+
	"idm :" +pp[nom].idm	;	
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
		ip_cam=html['ip'];idx_cam=html['idx'];dahua_type=html['type'];console.log(dahua_type);
		if (nom<10010){$('#cam').attr('src',urlimg); $('#camera').modal('show');} 
		else {$('#cam_ext').attr('src',urlimg); $('#camera_ext').modal('show');} }
			});         
		} 
	}




	
</script> 