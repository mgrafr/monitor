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
<script src="js/jquery-4.0.0.min.js"></script>
<script src="js/jquery-ui.min.js"></script>
<script src="js/mes_js.js"></script>
<script src="js/jscolor.min.js"></script>
<script src="custom/js/JS.js?2"></script>
<?php
if (MQTT==true) {echo '<script src="js/mqtt.min.js"></script>';}
if (ON_ZIGBEE==true) {echo '<script src="js/clipboard.min.js"></script>';}

?>

<script>
/*-------------mise a jour dispositifs PLAN domoticz ha iobroker z2m--------*/	
/*--------------------------------------------------------------------------*/	
var plan=<?php echo NUMPLAN;?>;// suivant le N° du plan qui contient tous les dispositifs
var tempo_dev=<?php echo TEMPO_DEVICES;?>;// temps entre 2 mises à jour
var pp=[];maj_devices(plan);
var worx=[];	
function maj_devices(plan){
$.ajax({
    type: "GET",
    dataType: "json",
    url: "ajax.php",
    data: "app=devices_plan&variable="+plan,
    success: function(response){pp=response;var al_bat="";
	<?php if (DECOUVERTE==false){echo "
		var err_dz_idm=pp[0].err_dz_idm; console.log('err_dz_idm:'+err_dz_idm);//0: pas erreur 1: erreur dz ou idm , idm >9000
   //console.log('custom='+custom);//custom défini dans worx.php
   if (err_dz_idm==1) {document.getElementById('erreur_dz').style.display='inline'}
    if (typeof custom != 'undefined') {
		if (custom==1 & pp[0]['serveur_iob'] === true){worx=pp[200].values;console.log(worx['batteryVoltage']);maj_worx(worx,pp[200].Data);}	
	     }
		// executé dans JS.js  worx=pp[200].values;maj_worx(pp[200].Name,pp[200].Data);}
		";} ?>
		$.each( pp, function( key, val ) {vol=0;pcent=0;
		if (val.maj_date=='0'){
			if (val.jour!=num_jour){aff_date();
			<?php if (DECOUVERTE==false){ echo "document.getElementById('tspan7024').innerHTML=jour;" ;}?>
			mc(1,"#meteo_concept");}}
		else {//console.log('ok_deb');
			var myEle = document.getElementById("cercle_"+val.idm);	
			if (val.alarm_bat=="alarme" || val.alarm_bat=="alarme_low") {al_bat=al_bat+val.idx+" , "+val.Name;
				if (myEle){
					if (val.alarm_bat=="alarme") {myEle.style = "fill-opacity: 1;fill: #b58585";}
					else {myEle.style = "fill-opacity: 1;fill: red";}}}
			else 
				if (myEle) {myEle.style = "fill-opacity: 0";}
			document.getElementById('erreur').innerHTML ="";
			if ((val.ID1)&&(val.ID1!="#")){if (document.getElementById(val.ID1)) {if (val.Data) {pos_m=(val.Data).toString().toLowerCase();}
				if ( val.maj_js=="data") {document.getElementById(val.ID1).innerHTML=val.Data;}
				if (val.maj_js=="data" && val.ID2!=""){document.getElementById(val.ID2).innerHTML=val.Data;}
				if (val.maj_js=="temp"){maj_html(val.maj_js,val.ID1,val.temperature);}
				if (val.maj_js=="temp" && val.ID2!=""){maj_html(val.maj_js,val.ID2,val.temperature);}
				if (val.actif=="6"  && (val.Data=="ON" || val.Data=="OFF")){publish_mqtt(val.ID,'state','','get');}	
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
							var h=document.getElementById(val.ID2).getAttribute("h");
							document.getElementById(val.ID2).setAttribute("height",parseInt((h*(pcent)/100)));}
							}}	
								
				if ((val.maj_js=="control" || val.maj_js=="onoff" || val.maj_js=="onoff+stop" || val.maj_js=="on_level" || val.maj_js=="on") && (pos_m=="off" || pos_m=="closed" )){//console.log(val.ID1,val.idm);
						if (val.ID1) {document.getElementById(val.ID1).style = val.coul_OFF;}
						if (val.ID2) {document.getElementById(val.ID2).style = val.coul_OFF;}
					 if (val.class_lamp) { maj_mqtt(val.class_lamp,val.coullamp_OFF,1,0);}}	
				if ((val.maj_js=="etat") && (val.Data=="Open")){document.getElementById(val.ID1).style = val.coul_ON;}
				if ((val.maj_js=="etat") && (val.Data=="Closed")){document.getElementById(val.ID1).style = val.coul_OFF;}	
				}
				if (val.actif=="6" && pp[val.idm]['param']!=null) {pp1=pp[val.idm]['param'][1];
					if (pp1 =="state") {//var msg='{ "state" : "" }';
					//var topic='zigbee2mqtt/'+pp[val.idm]['ID']+'/get';console.log('actif 6: '+topic+' -- '+msg);
					//client.publish(topic,msg);
					publish_mqtt(pp[val.idm]['ID'],'state',"","get")
				}}
			}	
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

$("#volet_bureau").attr("rel","Set Level: 0");	
$('ul#zz li').click(function(){
  $("#mobile-menu").trigger("click");
});		
new ClipboardJS('.btn');	
// cookies
function lire_cookie(name) {
  let matches = document.cookie.match(new RegExp(
    "(?:^|; )" + name.replace(/([\.$?*|{}\(\)\[\]\\\/\+^])/g, '\\$1') + "=([^;]*)"
  ));
  return matches ? decodeURIComponent(matches[1]) : undefined;
}
function popupCookie(page) {
  window.open(page);
}
function isInArray(array, search){return array.indexOf(search) >= 0;}	
function maj_html(majjs,id5,val5){
// if (val.maj_js=="temperature" ) {document.getElementById(val.ID1).innerHTML=val.temperature;;}
// maj temperature, humidity; data (autres que on/off)----- id5=idhtml,val5= val(device) 
switch (majjs) {
	case 'temperature':
val5 = val5+"°";
break;
 case 'homidity':
 case 'soil_moisture':	
val5 = val5+"%";	
break;
}
document.getElementById(id5).innerHTML=val5;
return;}
function maj_mqtt(id_x,state,ind,level,champ=''){
if (!state) {console.log("erreur-state");return;}
if (state=="true"){state="on";} //pour ioBroker
if (state=="false"){state="off";}	//pour ioBroke
console.log('ind='+ind);
switch (ind) {
	case 0: console.log('0:  id='+id_x+' state='+state);
var id_m=null;var json_m="";
for (attribute in maj_dev) {
	if (maj_dev[attribute]['id']==id_x){ id_m=maj_dev[attribute]['idm'];
	}}
case 2 :
	if (ind==2){ id_m=id_x;	
	if (state=="ON"){state="on";} //pour Z2M
	if (state=="OFF"){state="off";}	//pour Z2M	
	}
if (id_m==null || pp[id_m].Data==null) {out_msg= 'id_m='+id_m;console.log(out_msg);return;}
var command=state.toString();console.log(id_m);
var str=pp[id_m].Data;console.log('pp_idm avant='+str);
pp[id_m].Data=command;
console.log('command pp apres='+pp[id_m].Data);
var fx=pp[id_m].fx; console.log('fx='+fx);if (fx=="lien_variable"){maj_services(0);}
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
case 1: console.log('1: id='+id_x+' state='+state);
	scoull=state;c_lamp=id_x;console.log("c_lamp="+c_lamp);	
break;
case 3://id_x est egal à idm
var id1=pp[id_x].ID1;var id2=pp[id_x].ID2;		
console.log('case3:'+id_x+' '+id1+' '+id2);	
if (id1!='#'){maj_html(champ,id1,state);}
if (id2=""){maj_html(champ,id2,state);}
break;
default:
break;	
}
if (c_lamp!="" && scoull!="" && ind!=3) {
	var elements = document.getElementsByClassName(c_lamp);
	for (var i = 0; i < elements.length; i++) {
    var element = elements[i];
    element.style=scoull;}
	}
return;
}
/*-------affiche l'image de la page accueil---------------------------------------*/	
var text1="";var larg = (document.body.clientWidth);
var haut = (window.innerHeight );
document.getElementById('largeur').innerHTML =larg;	
document.getElementById('hauteur').innerHTML =haut;	
/* mot passe */

$('.close_clavier').click(function(){
  $("#btn_a").trigger("click");
});	
/*-----------------------------------*/
cookie_config=lire_cookie("userpref");
if (cookie_config!="admin/config.php"){var resp = window.prompt("conserver cette configuration:(O ou N)\n"+cookie_config);
	if (resp=="N"){
		document.cookie = "userpref=; expires=Thu, 01 Jan 1970 00:00:00 UTC; path=/;";console.log("..."+resp+"...");
		document.cookie = "userpref=";window.location.reload();
	}
	}
/*----------------------------------------------------*/	
var base_url=window.location.href;
var arret_mur;var arret_zoom;
notpiles="<?php echo NOTIFICATIONS_PILES;?>";if (notpiles==""){notpiles="interieur";}	
not_piles_reset="reset_erreur_"+notpiles;not_piles="erreur_"+notpiles;																	
/*----------------------------------------------------*/
/*commande toggle switch mur cameras*/	
$('.toggle-outer').click(function(){
	$(this).toggleClass('checked');
	const res = $('#result');
	if(res.css('display') === 'none'){
	$('#toggle').attr('checked', true);
	arret_mur=0;$('#toggleLabel').text('Vidéo inactive');}
	else{
	$('#toggle').attr('checked', false);
	arret_mur=1;updateImage(nbrCam);
	$('#toggleLabel').text('Vidéo active sur toutes les caméras')
				}
	res.toggle();				 
});
/*-----------------------------------*/
$("#onoffdvr").change(function() {
  if ($(this).prop("checked")==true) {$('#agent_dvr').attr('src',liendvr);}
	else {$('#agent_dvr').attr('src','');}
	});	
//----------------------------------------------
function setValue(object, keys, value) {
    var last = keys.pop();
    keys.reduce((o, k, i, a) =>
        o[k] = o[k] || (isFinite(i + 1 in a ? a[i + 1] : last) ? [] : {}),
        object
    )[last] = value;
    return object;
}
/*------------------------------------------------------------
PAGE ACCUEIL*/
/*-------------------------------------------------------------*/
/*NOTIFICATIONS POUBELLES Fosse septique,.....
----fonction en relation avec le script lua de dz----
-------concerne les poubelles , la fosse septique , la page météo ------*/	
var idx_idimg;
service=new Array();
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
	img_serv = html[i].image;actif_serv= html[i].actif;
		//img_serv ? img_serv : "http://192.168.1.9/monitor/"+html[i].image;		
	idw = html[i].ID_img;idt = html[i].ID_txt;exist = html[i].exist_id;name_var=html[i].Name;
	if (exist=="oui"){
		if (idw=="poubelle"){idx_idimg=html[i].Value;idx_ico=html[i].icone;}
		if (idw=="#shell")  {id_var=html[i].idx;v_var=html[i].Value;
			if (v_var!="0")  {	//concerne BASH------------------------				 
			var type=2;
			if (idt=="dz") {var ipserv="<?php echo $IP_dz;?>";var userserv="<?php echo $USER_dz;?>";var pwdserv="<?php echo $PWD_dz;?>";}
			if (idt=="ha") {var ipserv="<?php echo $IP_ha;?>";var userserv="<?php echo $USER_ha;?>";var pwdserv="<?php echo $PWD_ha;?>";}		
			else { var ipserv="<?php echo $IP_iob;?>";var userserv="<?php echo $USER_iob;?>";var pwdserv="<?php echo $PWD_iob;?>";}
		 					
			$.get( "ajax.php?app=shell&variable="+ipserv+"&name="+userserv+"&table="+pwdserv+"&type=2&command="+v_var, function(datas) {
  				alert(datas);
   			});maj_variable(id_var,"BASH",0,2);
			}//----------------------------------------------------------------
		}
			var myEle = document.getElementById(idt);	// ex uworx
	if (actif_serv=="7") {	var val=html[i].ID;data=['field', 'key'];result = {};setValue(result, data, val);
		 var res='return '+ result.field.key;result= new Function(res)();
	    console.log(result);
		myEle.innerHTML = result;
		//let val_var=pp[200].values.batteryVoltage;myEle.innerHTML = val_var+" Volts";
  	}
	else {
		if ((myEle) && (idt!="")&&(idt!="0")&&(html[i].Value!="0")){myEle.innerHTML =html[i].Value;}
		if ((myEle) && (idt!="")&&(idt!="0")&&(html[i].Value=="0")){myEle.innerHTML ="";}
		}
	/*if (((idt=="")||(idt=="0"))&&(html[i].Value!="0")){myEle.innerHTML ="";}*/
		if (idw!="" && idw!="#shell"){if (document.getElementById(idw)){
			if (img_serv=="pas image" || img_serv=="none") {document.getElementById(idw).style.display = "none";} 
			else {$('#'+idw).attr('src', img_serv);document.getElementById(idw).style.display = "block";} 
		}
	//else {document.getElementById(not_piles).innerHTML =("erreur : "+idt);
			  //document.getElementById(not_piles_reset).style.display="block";}	
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
function pluie(idx){
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
maj_services(0);
/*--------------------------------------*/
function class_name(cn,coul){
var elements = document.getElementsByClassName(cn);
for (var i = 0; i < elements.length; i++) {
    var element = elements[i];
    element.style=coul;
}
}
/* switchOnOff*  
	rgb :  "Color": "{\"b\":214,\"cw\":0,\"g\":86,\"m\":4,\"r\":254,\"t\":0,\"ww\":0}" */
qq=new Array();	
<?php if ($_SESSION["exeption_db"]=="" &&  DECOUVERTE==false)   {sql_plan('0',"","","");}	?>
rr=new Array();
function switches(server,idm,idx,command,pass="0"){
	if (command.includes(":")) {const myArray=command.split(":");
	command=myArray[0];level=myArray[1];}
	console.log("xxxx "+server);	
	switch (server) {
	case "1":
	case "2": var app="OnOff";var type=0;
	  if ((command=="On")||(command=="Off")){type=2;}
	  else if (command=="Set Level") {type=3;
				if (level=="") level=100;
	  }
	  else {type=1;}
	break;
	case "3": var app="turn";var type=0;var level=0;
		if (command=="On") command ="on";
		if (command=="Off") command ="off";
	break;
	case "4": var app="put";var type="state";var level=0;//console.log("relllll="+command);
			if (command!="On"){ type="on=";}
	break;
	case "5": var app="0";
	break;
     case "6": type=command;var level=0;
	   if (pp[idm].Data == "OFF" || pp[idm].Data == "off" ) {command="ON";}
	   else {command="OFF";}
	   console.log(pp[idm].Data);
	 publish_mqtt(idx,type,command,"set");maj_mqtt(idm,command,2,level,"Data");
	 return;
	break;
	default:
	break;
	}
	switchOnOff(app,idm,idx,command,type,level,pass="0");
		}
  function switchOnOff(app,idm,idx,command,type,level,pass){if (app=="0") {return "erreur dev en cours";}
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
			}
      }}); } 
  else alert("erreur_switchonoff");
  }
  <?php 
//--------------mqtt publish--receive-----------------
if (MQTT==true) {include('include/mqtt-js.php');} ?>
 // *****************************************************
 function publish_mqtt(idx,type,command,setget){
// Publish a Message
	var msg='{ "'+ type+'":"'+ command+'"}';
	var topic='zigbee2mqtt/'+idx+'/'+setget;console.log('pub message:'+topic+' : '+msg);
	client.publish(topic, msg);return;
 }
//------------------------------------------------------------
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
 function inf_cam() {
	var titre='info cam';modale_id="inf_cam";
	var donnees_img="idx :" +idx_cam+"<br>adresse :"+urlimg+"<br>id_zm :"+zoneminder+"<br>marque :"+dahua+"<br>type :"+dahua_type+"<br>ip :"+ip_cam;
	if ($('#visu_cam').length) document.getElementById('visu_cam').remove();if ($('#visu_cam').length) return;open_modale(modale_id,'info',donnees_img,'0','5');
}

/*graphiques---------------------------------------*/
$('#btn_graph').on('click', function() { 
var device = $('input[name=devices]:checked').val();
var variable = $('input[name=variables]:checked').val();
$("#btn_g_close").trigger("click");
graph(device,variable,"graphic");
        });
/*--------------fin graphiques------------------------*/
/*scenes---------------------------------------*/
/*$('#btn_scenes').on('click', function() { 
$("#btn_sc").trigger("click");
//scenes(device,variable,"scenes");
        });
/*--------------fin graphiques------------------------*/	
/*zoom*/
<?php 
if (ON_MUR==false || SRC_MUR=="fr") echo "/*";?>
$(".dimcam").on("click", function() {rel = $(this).attr('rel');
   $('#imagepreview').attr('src',this.src); // here asign the image to the modal when the user click the enlarge link
   openModal('imagemodal'); // imagemodal is the id attribute assigned to the bootstrap modal, then i use the show function
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
<?php echo "var info_admin = ". $js_info_admin . ";\n";?>
aff_clavier='<form class="form_al"><span style="margin-left: 30px;"><input type="radio" name="alco" value="1" /></span><span style="color:white;margin-left: 10px;">commande</span><br><input type="radio" name="alco" checked value="2" /><span style="color:white;margin-left: 10px;">alarme</span><br><input type="password" style="max-width: 140px;" id="password" /><br><input type="button" value="1" id="1" class="pinButton calc" /><input type="button" value="2" id="2" class="pinButton calc" /><input type="button" value="3" id="3" class="pinButton calc" /><br><input type="button" value="4" id="4" class="pinButton calc" /><input type="button" value="5" id="5" class="pinButton calc" /><input type="button" value="6" id="6" class="pinButton calc" /><br><input type="button" value="7" id="7" class="pinButton calc" /><input type="button" value="8" id="8" class="pinButton calc" /><input type="button" value="9" id="9" class="pinButton calc" /><br><input type="button" value="raz" id="clear" class="pinButton clear" /><input type="button" value="0" id="0 " class="pinButton calc" /><input type="button" value="envoi" id="enter" class="pinButton enter" />  </form>';
open_modale("pwdmo","clavier",aff_clavier,"0","4");// mod_ext=4 modal permanente
let $el = $("#confirm_content");$el.attr("id", "content_clavier");
let $el1 = $("#modal-card-title");$el1.attr("id", "modal-card-title-al");
let $el2 = $("#btn_confirm_close");$el2.attr("id", "btn_confirm_close-al");


$(".btn_appd").click(function () {var log_name="";var urllog="";
var logapp = $(this).attr('rel');classe="modal";
if (logapp=="passwd"){openModal("pwdmo");}
else if (logapp=="scenes"){var titre=$(this).attr('data-titre');modale_id="scenes";
	contenu='<a href="#murinter"><img id="sc1" src="<?php echo $lien_img;?>images/lampe_jardin.svg" width="40" height="auto" alt=""/>toutes les lampes</a>';open_modale(modale_id,titre,contenu,'0','3');}
else if (logapp=="admin"){var numero = $(this).attr('title');var titre=$(this).attr('data-titre');var classe=$(this).attr('data-class');
	urllog="ajax.php?app=admin&variable="+numero;modale_id="logapp";}
else if (logapp=="info_adm"){var numero = $(this).attr('title');var titre=$(this).attr('data-titre');if (title="7") {classe=$(this).attr('data-titre');}
	contenu = info_admin[numero];modale_id="adm";
	open_modale(modale_id,titre,contenu,'0','3');}
else if (logapp=="domoticz"){var numero=$(this).attr('title');
	if (numero=="1") {log_name=" normal";}
	else if (numero=="2") {log_name=" statut";}
	else if (numero=="4") {log_name=" erreur";}
	urllog="ajax.php?app=log_dz&variable="+numero;titre="log domoticz";modale_id="domoticz";}
else if (logapp=="sql"){var table_sql = $(this).attr('title');
	urllog="ajax.php?app=sql&idx=1&variable="+table_sql+"&type=&command=";titre="historique poubelles";modale_id="poubelles";}
else if (logapp=="cuisine"){var table_sql = logapp;var numrecette = $(this).attr('title');titre = $(this).attr('alt');modale_id="rec_cuis";
	urllog="ajax.php?app=sql&idx=4&variable="+table_sql+"&type=id&command="+numrecette;}	
else if (logapp=="modes_emploi"){var table_sql = logapp;var nummode_e = $(this).attr('title');titre = $(this).attr('alt');modale_id="manuel";
	urllog="ajax.php?app=sql&idx=4&variable="+table_sql+"&type=id&command="+nummode_e;}		
else if (logapp=="10"){var nummode_e = $(this).attr('title');titre = $(this).attr('alt');modale_id="erreurs_mo";
	var i=9000;errmon="";do {
		if (pp[i]) errmon=errmon+'<i style="color:red">'+nummode_e +'</i> :'+pp[i].ID+','+pp[i].values+'<br>';
		    i++;} while ( i >= 9000 && i< 9010 );open_modale(modale_id,nummode_e,errmon,'0','3');
}
else {alert("erreur");}
if (urllog!="") {$.get(urllog, function(response){
  	open_modale(modale_id,titre+log_name,response,'0','3',classe);});} 
});
/*---modale boite_lettres---pression chaudière--médicaments-fosse septique-----------------------------*/
// Affichage boîte de confirmation
function open_modale(id_modale,titre,Contenu,ch,mod_ext,classe="modal"){
var modalContainer = document.createElement('div');
modalContainer.setAttribute('id', id_modale);
modalContainer.setAttribute('class', classe);
document.body.appendChild(modalContainer);
modalA='<div class="modal-background">';
modalB='</div><div class = "modal-card"><header class = "modal-card-head"><p id="modal-card-title" class = "modal-card-title"></p><button id="btn_confirm_close" class = "delete" aria-label = "close"></button></header><section class = "modal-card-body"><div id="confirm_content" class = "content"></div></section>';
modalC='<input type="button" id="btn_bl"  value="OK" /></div></div>';
if (mod_ext!="3" && mod_ext!="4" && mod_ext!="5") {modalContainer.innerHTML = modalB+modalC+"</div></div>";
	document.getElementById('btn_bl').addEventListener('click', function() {modal_extensions(id_modale,mod_ext,ch);});				
}
else {modalContainer.innerHTML = modalB+"</div></div>";}
document.getElementById('modal-card-title').innerHTML=titre;
document.getElementById('confirm_content').innerHTML=Contenu;
if (mod_ext=="4") {document.getElementById('btn_confirm_close').addEventListener('click', function() {closeModal(id_modale);});}
else {document.getElementById('btn_confirm_close').addEventListener('click', function() {closeModal(id_modale);document.getElementById(id_modale).remove();});
openModal(id_modale);}
}
$(".confirm a").click(function(){ 
 var ch=0;
var title_confirm=$(this).attr('title');ch=$(this).attr('rel');var mod_nom=$("img",this).attr("id");
var nb = Object.keys(service).length;
	for (i = 1; i < nb; i++) {//console.log(ch+'...'+service[i].ID);
		if (service[i].idm==ch) {ch=i;i=nb;	}
	}
switch (mod_nom) {
	case "lastseen":
	Content=service[ch].contenu;mod_ext="1";
	break;
	case "poubelle":
	mod_ext="2";Content="cliquer sur OK pour enregistrer la date \n du ramassage dans la base de données";
	break;
	case "fosse":
	case "pression_chaud":
	case "pilule":
	case "ping_rasp":
	case "bl":			
	Content="confirmer la notification\nelle va être supprimée";mod_ext="1";	
	break;		
	default:
	break;
}
open_modale('confirm',title_confirm,Content,ch,mod_ext);		
});	   
function modal_extensions(id_modale,mod_ext,ch=0){
switch (mod_ext) {
case "2": //pour notification poubelles
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
            });$("#"+ch_ID_img).hide();
case "1": // pour notification depuis variable dz ha 
	var i=ch;
 ch_idx=service[i].idx;ch_ID=service[i].ID;ch_name=service[i].Name;ch_ID_img=service[i].ID_img;
			if (ch_idx.length >0) {//pour dz
				maj_variable(ch_idx,ch_name,"0",2);} 
			else{var substr = ch_ID.split('.');//pour ha
			ch_ID = "input_boolean."+substr[1];
				turnonoff("",ch_ID,"on",pass="0");} 
	maj_services(0);bl=0;ch_idx="0";ch_ID="0";ch_name="";	
break;
case "3": //pour notification sans réponse

break;	
}
document.getElementById(id_modale).remove();
}

/*----------------------------------------*/
$("#zm").click(function () {
          $.ajax({
             url: "ajax.php",
             data: "app=sql&idx=3&variable=cameras&type=modect&command=1",
			 success: function(data) { 
             alert("liste de caméras enregistrées \nen modect dans SQL\n"+data);
            }
        });
		});

/*----------fin document-------------------------------*/
/*----------------script pour svg---*/
var nom;
	function popup_device(nom) {
	if (nom < 10000){if (pp[nom]){
	var donnees="idm :" +pp[nom].idm+"<br>"+
	"idx :" +pp[nom].idx+"<br>"+
	"ID :" +(pp[nom].ID).substring(0, 32)+"<br>"+	
	"Nom :" +pp[nom].Name+"<br>"+
	"t° :"+pp[nom].temperature+"<br>"+
	"batterie :" +pp[nom].bat+"<br>"+
	"humidité :" +pp[nom].humidity+"<br>"+
	"update :" +pp[nom].update+"<br>"+
	"serveur :" +pp[nom].serveur+"<br>"+	
	"Data :" +pp[nom].Data+"<br>"+	
	"ID1_html :" +pp[nom].ID1+"<br>"+	
	"ID2_html :" +pp[nom].ID2+"<br>"+	
	"class_html :" +pp[nom].class_lamp;
 	open_modale('infos_devices','dispoitifs',donnees,'0','3');
	}
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
		ip_cam=html['ip'];idx_cam=html['idx'];dahua_type=html['type'];console.log(urlimg);
		open_modale('visu_cam','Image caméra<button onclick="inf_cam();" style="margin-left:100px" class="button is-blue" >Config</button>','<img src="'+urlimg+'" alt="cam">','0','3'); 
		 }
			} );        
		} 
	}
	
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
      $("#volet_bureau").attr("rel","Set Level: "+amount);
	 $("#level_vr").html("Set Level: "+amount+"%");
    }
  }
});
/*--------------------------------------------------*/
$('.info_admin').click(function(){
var rel=$(this).attr('rel');$('#affich_content_info').empty;var info_admin="";
affich_info_admin(rel);
});	
function affich_info_admin(rel){	
//console.log(rel);
<?php echo "var info_admin = ". $js_info_admin . ";\n";?>
document.getElementById("affich_content_info").innerHTML = info_admin[rel];
}
function adby(choix) {var formData=new Array();dType="html";
switch (choix) {
	case 1: $("#advf").css("display", "none");$("#adv_f").css("display", "none");
	var fenetre="avb";
	var formData = {
	app :  $("#app1").val(),		
 	idx : $("#idx").val(), 
	idm : $("#idm").val(), 	
  	nom_objet : $("#nom_objet").val(),
	ID : $("#ha_id").val(),	
	actif : $("input[name=actif]:checked").val(),
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
	param : $("input[name=type_mat]:checked").val()+':'+$("#json").val()+':'+$('#json1').val(),
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
	param :	$("#param").val(),
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
	app :  "var_bd",		
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
	case 10: // couleur lampes
	var lumin=get_brightness($("#val1").val());
	//document.getElementById('val2').value =lumin;
	$("#val2").val(lumin);
	var formData = {
	app : "dimm",
	command : $("#val1").val(),
	type : lumin,
	device : $("#idhtml").val(),
	name : "100"		
	};fenetre='color_lampes';dType="json";
	break;		 
	default:
	}
    $.ajax({
      type: "GET",
      url: "ajax.php",
      data: formData,
      dataType: dType,
	success:function (data) {
		$('#'+fenetre).empty();
		if (choix !=10) {document.getElementById(fenetre).innerHTML = data;document.getElementById(fenetre).style.display = "block";}
		else {
			if (data['serveur']==6){ const msg=data['payload'];const topic=data['topic'];
				client.publish(topic, msg);}  
			}
		},
		error: function() { 
                          alert('La requête n\'a pas abouti'); 
                        } 
    });
  }	
// Check color brightness
// returns brightness value from 0 to 255
// http://www.webmasterworld.com/forum88/9769.htm
function get_brightness(hexCode) {
// strip off any leading #
hexCode = hexCode.replace('#', '');
var c_r = parseInt(hexCode.substr(0, 2),16);
var c_g = parseInt(hexCode.substr(2, 2),16);
var c_b = parseInt(hexCode.substr(4, 2),16);
return Math.round(((c_r * 299) + (c_g * 587) + (c_b * 114)) / 1000);
}
/*--------------------------------------------------------*/
$('li.ww').click(function(){var ww1 = $(".www").attr('href');
$(ww1).attr('display','block');
});
</script>
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
	  maj_mqtt(id_x,state,0,0)
    };
  </script>";}

if (SSE=='php') {echo "
<script>

    window.onload = function() {
	
	// établir un flux et enregistrer les réponses sur la console
var source = new EventSource('include/serveur_sse.php');
 
source.addEventListener('message', function(e) {
var dmsg=document.getElementById('messages2').innerText;
document.getElementById('messages3').innerText = dmsg;
var dmsg=document.getElementById('messages1').innerText;
document.getElementById('messages2').innerText = dmsg;
var dmsg=document.getElementById('messages').innerText;
document.getElementById('messages1').innerText = dmsg;
document.getElementById('messages').innerHTML = e.data ;
donnees=JSON.parse(e.data);var id_x=donnees.id;var state=donnees.state;
maj_mqtt(id_x,state,0,0);
$.get('ajax.php', { app:'maj', id:'', state: 'Ok', command:'6'});
}, false);

source.addEventListener('open', function(e) {
document.getElementById('status').innerText='connecté ws dz,ha,iob';
}, false);

source.addEventListener('error', function(e) {
if (e.readyState == EventSource.CLOSED) {
document.getElementById('status').innerText='connexion fermée';
}
}, false);
};
</script>";}?>
