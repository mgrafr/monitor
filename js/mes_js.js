   // Function to open the modal BULMA
   function openModal(modid) {
   
     // Add is-active class on the modal
     document.getElementById(modid).classList.add("is-active");
   }
   
   // Function to close the modal
   function closeModal(modid) {
  document.getElementById(modid).classList.remove("is-active");
  }
   
   // Add event listeners to close the modal
   // whenever user click outside modal
   document.querySelectorAll(
   ".modal-background, .modal-close,.modal-card-head .delete, .modal-card-foot .button"
   ).forEach(($el) => {
             const $modal = $el.closest(".modal");
             $el.addEventListener("click", () => {
             
             // Remove the is-active class from the modal
             $modal.classList.remove("is-active");
           });
         });
           
         // Adding keyboard event listeners to close the modal
         document.addEventListener("keydown", (event) => {
         const e = event || window.event;
             if (e.keyCode === 27) { 
             
              // Using escape key 
               closeModal(modid);
             }
          });
        
  // Add a keyboard event to close all modals
  document.addEventListener('keydown', (event) => {
    if(event.key === "Escape") {
      closeAllModals();
    }
  });







/*! skinny.js v0.1.0 | Copyright 2013 Vistaprint | vistaprint.github.io/SkinnyJS/LICENSE 
http://vistaprint.github.io/SkinnyJS/download-builder.html?modules=jquery.cookies*/

!function(e){e.cookies={};var o,n=function(e){return e?(e=e.toString(),e=(e=encodeURIComponent(e)).replace(/\+/gi,"%2B").replace(/\%20/gi,"+")):""},i=function(e){if(!e)return"";e=(e=e.toString()).replace(/\+/gi,"%20").replace(/\%2B/gi,"+");try{return decodeURIComponent(e)}catch(o){return e}},t={domain:null,path:"/",permanentDate:(o=new Date,o.setFullYear(o.getFullYear()+1),o.toUTCString()),watcher:e.noop},a=t;e.cookies.setDefaults=function(o){a=e.extend({},t,o)};var r=function(e,o){return o||a[e]};e.cookies.enabled=function(){return e.cookies.set("cookietest","value"),"value"==e.cookies.get("cookietest")&&(e.cookies.remove("cookietest"),!0)},e.cookies.get=function(e,o){var n=(new s)[e];return n?o?n.subCookies&&n.subCookies[o]||null:n.subCookies?n.subCookies:n.value||"":null},e.cookies.set=function(e,o,n,i,t){var a,l,c=e;"object"==typeof e&&(c=e.name,o=e.value,n=e.domain,i=e.permanent,a=e.path,t=e.clearExistingSubCookies||e.clearExisting),"object"==typeof o&&null!==o&&(l=o,o=null);var v=(new s)[c];if(v||((v=new u).name=c),v.value=o,l)if(t||!v.subCookies)v.subCookies=l;else for(var f in l)l.hasOwnProperty(f)&&(v.subCookies[f]=l[f]);v.domain=r("domain",n),v.path=r("path",a),v.isPermanent=!!i,v.save()},e.cookies.remove=function(e,o,i){var t=n(e)+"=a; path="+r("path",i)+"; expires=Wed, 17 Jan 1979 07:01:00 GMT";(o=r("domain",o))&&(t+="; domain="+o),a.watcher(t),document.cookie=t};var s=function(){for(var e=document.cookie.toString().split(";"),o=e.length,n=0;n<o;n++){var i=new u;i.parse(e[n]),i.name&&(this[i.name]=i)}},u=function(){var e=this;this.name=null,this.subCookies=null,this.value=null,this.domain=null,this.path=null,this.isPermanent=!1;var o=function(){if(!e.name)throw new Error("Cookie: Cookie name is null.")};this.serialize=function(){o();var i=n(e.name)+"="+t();i+="; path="+r("path",this.path);var a=r("domain",e.domain);return a&&(i+="; domain="+a),e.isPermanent&&(i+="; expires="+r("permanentDate")),i},this.save=function(){o();var n=e.serialize();a.watcher(n),document.cookie=n},this.parse=function(o){if(o){var n=(o=o.replace(/^\s*(.*?)\s*$/,"$1")).indexOf("=");if(!(n<=0)){e.name=i(o.substr(0,n));var t=o.substr(n+1);if(-1!=t.indexOf("=")){e.subCookies={};for(var a=t.split("&"),r=a.length,s=0;s<r;s++){var u=a[s].split("=");if(2!=u.length)return void(e.subCookies=null);e.subCookies[i(u[0])]=i(u[1])}}else e.value=i(t)}}};var t=function(){if(e.subCookies){var o=[];for(var i in e.subCookies)o.push(n(i)+"="+n(e.subCookies[i]));return o.join("&")}return n(e.value)}}}(jQuery);



/*----------------script pour admin---*/
function wajax(content,rel){alert(content+"   "+rel);
//$("#btclose").remove();//$("#reponse1").empty();
$("#enr").hide();   
$("#adm1").empty();
$.post('ajax.php', {appp:'adminp', variable:rel, command:content}).done(function(response){console.log(response);
       $("#reponse1").html(response);
});}
function yajax(id1){
$(id1).hide();}
function remplace(id2,content2){
$(id2).text(content2);
}
function zajax(rel){alert(rel);
$("#enr").hide();   
$("#adm1").empty();
$.get('ajax.php', {app:'admin', variable:rel, command:""}).done(function(response){console.log(response);
       $("#reponse1").html(response);
});}

/*Minimal Virtual Keypad
---------------------------*/

$(document).ready(function () {
  const input_value = $("#password");
  var pwd,nameid;
  //disable input from typing

  $("#password").keypress(function () {
    return false;
  });

  //add password
  $(".calc").click(function () {
    let value = $(this).val();
    field(value);
  });
  function field(value) {
    input_value.val(input_value.val() + value);
  }
  $("#clear").click(function () {
    input_value.val("");
  });
  $("#enter").click(function () {
    pwd = input_value.val();
	alco = $("input[name=alco]:checked").val(),
	  mdp(pwd,alco,'not');
	$('#info_admin').show();//affiche texte:"Avant d'entrer un mot de passe, faire un RAZ"
  });

  /*$('#enter').on('click', function() {$('pwdalarm').empty();*/
	/*
input_value:mot de passe
command:pages 1=commandes 2=alarmes 
nameid: id pour affichage texte
clique:bouton #btn_c ou #verif_mpa
vide :modal #d_btn_c ou #d_btn_a
*/	  
function maj_mdp(rep){	
if (rep==0){
	$('#pwdalarm').hide();$('#info_admin').hide();
	$('#mp1,#mp2').hide();
  $('#d_btn_a').hide();$('#d_btn_al').hide();
	closeModal('pwdmo')
	//$('#reponse').hide();$('#btn_c').hide();$('#txt_cmd').hide();
	//$('#admin1').show();
  $('#console1').text("pwd:OK");}

	else {$('#d_btn_a').show();
	$('#pwdalarm').hide();
	$('#console1').text("pwd:absent");
	/*document.getElementById("d_btn_al").style.display = "block";
	document.getElementById("d_btn_a").style.display = "block";*/
	$('#mp1,#mp2').show();}
console.log(rep);
}
 /*--------------------------------------------------------------*/	
function mdp(passw,command,nameid){
  $.ajax({
    method: "POST",
    url: "ajax.php",
	dataType: "json",
    data: {appp:"mdp",
	variable:passw,
	command:command
	},
    success: function(response){res=response.statut;document.getElementById(nameid).innerHTML = res;console.log(res);
			if (res!="OK") {rep=1;}
else {rep=0;} maj_mdp(rep);},
	error: function(){alert("erreur");}
	});
}
  });






