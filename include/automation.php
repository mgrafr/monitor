<?php
echo "<script src='js/clipboard.min.js'></script>";
function select($f,$name,$tab,$ntab,$bgc,$ff=0){$choix=$name."1";
 echo '<div  style="background-color:'.$bgc.'"><br>'.$ntab.'<br><select name="'.$name.'" id="'.$name.'">';
 foreach($tab as $nomTime)  {
    // Affichage de la ligne
    echo '<option value="'.$nomTime .'">'. $nomTime .'</option>';
  }
  echo '</select><input type="text" style="width:200px;margin-left:10px;" id="'.$choix.'" value=""  >';
  $doc=$name;
   echo '<input type="button" value="Info" onClick="test('.$f.','.$doc.')"><input type="button" value="ok" onClick="adautomation(\''.$name.'\') "></div>';
if ($ff==1)echo '<br>';
   }
//
echo '<p style="position: relative;top: 5px;text-align: center;font-size: 20px;">AUTOMATIONS</p><p id="aide_aut"></p><textarea id="console"></textarea>
<button type="button" id="btn_console" class="btn btn-primary btn-sm" data-clipboard-action="copy" data-clipboard-target="#console">COPY</button><br>';
 $doc1=0;echo 'NOM Automation:<input type="text" style="width:400px;margin-left:10px;" id="nom_aut" value="" ><input type="button" value="info" onClick="test(0,'.$doc1.')">'; 
$arrayGeneral = array(
    'active',
    'execute_once'   
  );
  echo '<br><form name="auto_zb">';
select(1,'General',$arrayGeneral,'Général:<img src="images/poubelle.svg" onClick="reset_aut(\'General\')" style="margin-left:100px;width:20px;height:auto;" title="supprimer les données General">','cyan',1);

// Définition des tableaux time trigger
  $arrayTime = array(
    'time',
    'coord_gps'
   );
     // Parcours du tableau

  select(3,'trigger_time',$arrayTime,'Déclenchements:<img src="images/poubelle.svg" onClick="reset_aut(\'Trigger\')" style="margin-left:100px;width:20px;height:auto;" title="supprimer les données Déclenchements"><br>- horaire','#28a745;',0);
  //
$arrayEvent = array(
    'entity ',       
    'for', 
    'state',              
    'attribute ',         
    '=',
    '!=',
    '>',
    '<' ,
    'action'          
   );
 select(5,'trigger_event',$arrayEvent,'- évènement','#28a745',1);
$arrayEventCondition = array(
     'entity',        
    'state',              
    'attribute ',         
    '=',
    '!=',
    '>',
    '<'           
      );
 
select(14,'Eventcondition',$arrayEventCondition,'Conditions:<img src="images/poubelle.svg" onClick="reset_aut(\'Condition\')" style="margin-left:100px;width:20px;height:auto;" title="supprimer les données Conditions"><br>- évènement','#ffc107',0);
//
$arrayTimeCondition = array(
    'after',
    'before',
    'between', 
    'weekday'
  );
select(21,'Timecondition',$arrayTimeCondition,'- horaire','#ffc107',1);
//
$arrayAction = array(
    'entity', 
    'payload',
    'scene',
    'logger',
    'turn_off_after',
    'payload_off'
  );
 
select(25,'Action',$arrayAction,'Actions:<img src="images/poubelle.svg" onClick="reset_aut(\'Action\')" style="margin-left:100px;width:20px;height:auto;" title="supprimer les données Actions">','lavender',1);
//
echo '<br><input type="button" value="Envoyer" onclick="data_yaml(mData)"></form>';
   
?>
<script>
  var list_select=['General','Trigger','Condition','Action'];
function test(b,doc){a=document.forms["auto_zb"].General.selectedIndex;console.log(doc);
 let arrayHelp = [
     'Nom de l\'automatisation',
     'Valeurs : true(vrai) ou false(faux). Valeur par défaut : true (true : l\'automatisation est active)',
     'Valeurs : true(vrai) ou false(faux). Valeur par défaut : false (true : l\'automatisation n’est exécutée qu’une seule fois)',
     'Valeurs: time  hh:mm:ss ou suncalc ou sunrise ou sunset ...',
     'Numeric latitude,longitude,élévation en metes ex: 48.12,0.1234,18 defaut=0  pour elevation',
     'Nom de l\'entité (nom convivial de l\'appareil ou du groupe) à évaluer',
     'durée en secondes pendant laquelle l\'attribut spécifique reste dans l\'état déclenché',
     'Values: ON OFF',
     'Nom de l\'attribut  (example: state  brightness  illuminance_lux occupancy)',
     'Valeur de l\'attribut à évaluer avec = (equal)',
     'Valeur de l\'attribut à évaluer avec != (not_equal)',
     'Valeur numérique de l\'attribut à évaluer avec > (above)',
     'Valeur numérique de l\'attribut à évaluer avec < (below)',
     'Valeur de l\'action à évaluer, par ex. simple(single), double,(double), maintien(hold)...',
     'Nom de l\'entité (nom convivial de l\'appareil ou du groupe) à évaluer',
     'Values: ON OFF',
     'Nom de l\'attribut (exemple : état luminosité illuminance_lux occupation)',
     'Valeur de l\'attribut à évaluer avec = (equal)',
     'Valeur de l\'attribut à évaluer avec != (not_equal)',
     'Valeur numérique de l\'attribut à évaluer avec > (above)',
     'Valeur numérique de l\'attribut à évaluer avec < (below)',
     'Chaîne de temps hh\u003Amm\u003Ass',
     'Chaîne de temps hh\u003Amm\u003Ass',
     'Valeurs:  hh\u003Amm\u003Ass-hh\u003Amm\u003Ass',
     'Chaîne de jour ou tableau de chaînes de jours : dim lun mar mer jeu ven sam \u003A\n(sun mon tue wed thu fri sat) ',
     'Nom de l\'entité (nom convivial de l\'appareil ou du groupe) à laquelle envoyer la charge utile',
     'Valeurs : turn_on turn_off toggle ou tout attribut pris en charge dans un objet ou indenté sur les lignes suivantes',
     'Nom de la scène à exécuter',
     'Valeurs : debug info warning error. Par défaut : debug.\n L\'action sera enregistrée sur le journal z2m avec le niveau de journalisation spécifié',
      'Nombre : secondes à attendre avant d\'éteindre l\'entité. Enverra un turn_off à l\'entité.',
     'Valeurs : tout attribut pris en charge dans un objet. Utilisera payload_off au lieu de { state: "OFF" }.'
  ];
  let arrayEx = [
     'Exemple: Allumage lampes jardin 4mn  depuis contact lampe_ porche:',
     'Motion in the hallway:\n active: true',
     'Motion in the hallway:'+En+'execute_once: true (exécuté 1fois)',
     'Turn off at 23:\u000A \u00a0\u00a0\u00a0\u00a0trigger:\u000A \u00a0\u00a0\ud83d\udd3btime: 23:00:00',
     'Sunset\u003A\u000A  \u00a0\u00a0\u00a0\u00a0\u00a0trigger\u003A\u000A \u00a0\u00a0\u00a0\u00a0\u00a0\u00a0\u00a0\u00a0\u00a0time\u003Asunset\u000A \ud83d\udd3b\u00a0\u00a0\u00a0\u00a0latitude\u003A 48.858372\u000A \ud83d\udd3b\u00a0\u00a0\u00a0\u00a0longitude\u003A 2.294481\u000A \ud83d\udd3b\u00a0\u00a0\u00a0\u00a0elevation\u003A 330',
     'ex:lampe_entree ',
     'Contact sensor CLOSED:\u000A \u00a0\u00a0\u00a0\u00a0trigger:\u000A \u00a0\u00a0\u00a0\u00a0\u00a0\u00a0entity: Contact sensor\u000A \u00a0\u00a0\u00a0\u00a0\u00a0\u00a0attribute: contact\u000A \u00a0\u00a0\u00a0\u00a0\u00a0\u00a0state: true\u000A \u00a0\u00a0\ud83d\udd3b\u00a0\u00a0for: 5',
     'state: ON \nstate: true ',
     'Contact sensor OPENED:\n \u00a0\u00a0trigger:\n \u00a0\u00a0\u00a0\u00a0\u00a0entity: Contact sensor\n\ud83d\udd3battribute: contact',
     'Contact sensor OPENED:\u000A \u00a0\u00a0\u00a0\u00a0trigger:\u000A \u00a0\u00a0\u00a0\u00a0\u00a0\u00a0entity: Contact sensor\u000A \u00a0\u00a0\u00a0\u00a0\u00a0\u00a0attribute: contact\u000A \ud83d\udd3bequal: false',
     'Contact sensor OPENED:\u000A \u00a0\u00a0\u00a0\u00a0trigger:\u000A \u00a0\u00a0\u00a0\u00a0\u00a0\u00a0entity: Contact sensor\u000A \u00a0\u00a0\u00a0\u00a0\u00a0\u00a0attribute: contact\u000A \ud83d\udd3bnot_equal: true',
     '\u00a0trigger:\u000A \u00a0\u00a0\u00a0\u00a0entity: Light sensor\u000A \u00a0\u00a0\u00a0\u00a0attribute: illuminance_lux\u000A\u2731 above : 50',
     '\u00a0trigger:\u000A \u00a0\u00a0\u00a0\u00a0entity: Light sensor\u000A \u00a0\u00a0\u00a0\u00a0attribute: illuminance_lux\u000A\u2731 below : 60',
     'Guest room Scenes 1_double:\n\u00a0\u00a0\u00a0trigger:\n\u00a0\u00a0\u00a0\u00a0\u00a0entity: Guest room Scenes switchn \n\u00a0\u00a0\u00a0\u00a0\u00a0action: 1_double\n\u00a0\u00a0action:\n\u00a0\u00a0\u00a0\u00a0\u00a0scene: Guest room off',
     '\u00a0condition:\u000A\ud83d\udd3bentity: At home\n\u00a0\u00a0\u00a0\u00a0\u00a0state: ON',
     'state: ON \nstate: true ',
     '\u00a0condition:\u000A \u00a0\u00a0\u00a0\u00a0entity: Light sensor\u000A \u00a0\u2731attribute: illuminance_lux',
     'Contact sensor OPENED:\u000A \u00a0\u00a0\u00a0\u00a0condition:\u000A \u00a0\u00a0\u00a0\u00a0\u00a0\u00a0\u00a0entity: Contact sensor\u000A \u00a0\u00a0\u00a0\u00a0\u00a0\u00a0\u00a0attribute: contact\u000A \u00a0\ud83d\udd3bequal: false',
     'Contact sensor OPENED:\u000A \u00a0\u00a0\u00a0\u00a0condition:\u000A \u00a0\u00a0\u00a0\u00a0\u00a0\u00a0\u00a0entity: Contact sensor\u000A \u00a0\u00a0\u00a0\u00a0\u00a0\u00a0\u00a0attribute: contact\u000A \u00a0\ud83d\udd3bnot_equal: true',
     '\u00a0condition:\u000A \u00a0\u00a0\u00a0\u00a0\u00a0entity: Light sensor\u000A \u00a0\u00a0\u00a0\u00a0\u00a0attribute: illuminance_lux\u000A\u2731 above : 50',
     '\u00a0condition:\u000A \u00a0\u00a0\u00a0\u00a0\u00a0entity: Light sensor\u000A \u00a0\u00a0\u00a0\u00a0\u00a0attribute: illuminance_lux\u000A\u2731 below : 60',
     'condition:\n\u00a0\u00a0 after: 08:30:00\n\u00a0\u00a0  before: 22:30:00\n\u00a0\u00a0   weekday: ["mon", "tue", "fri"]',
     'condition:\n\u00a0\u00a0 after: 08:30:00\n\u00a0\u00a0  before: 22:30:00\n\u00a0\u00a0   weekday: ["mon", "tue", "fri"]',
     'between : 22:30:00-24:50:00',
     'condition:\n\u00a0\u00a0 after: 08:30:00\n\u00a0\u00a0  before: 22:30:00\n\u00a0\u00a0   weekday: ["mon", "tue", "fri"]',
     'exemple: lampe_entree ',
     'exemples:\n state_l2 : ON \nturn_on',
     'Guest room off:\n\u00a0\u00a0- entity: Guest room Floor leds\n\u00a0\u00a0\u00a0\u00a0payload: { state: "OFF" }\n\u00a0\u00a0- entity: Guest room Lights\n\u00a0\u00a0\u00a0\u00a0payload: { state: "OFF" }',
     'exemple : logger: info\nlogger: error',
     'action:\n\u00a0\u00a0\u00a0- entity: Aqara switch T1\n\u00a0\u00a0\u00a0\u00a0\u00a0payload: turn_on\n\u00a0\u00a0\u00a0\u00a0\u00a0turn_off_after: 10',
     'Exemples : remplace \n\u00a0\u00a0payload:\n\u00a0\u00a0\u00a0\u00a0\u00a0\u00a0\u00a0state_l2 : OFF (charge utile précédente state_l2:ON)'
  ];   
//var a=doc;
var c=a+b;console.log('a='+a+'c='+c);
document.getElementById("aide_aut").innerText=arrayHelp[c];
document.getElementById("console").textContent=arrayEx[c];
//document.getElementById("xz").innerText=arrayEx[c];
}
function data_yaml(mData) {var aa;
	aa=$("#nom_aut").val()+':\n';
	list_select.forEach((Id, index) =>  {//console.log(list_select[0]);
  selectElmt = mData[Id];
 if (!selectElmt) {
   if (Id=="General"){selectElmt=E+'active: true';}}
  if (selectElmt) { aa=aa+selectElmt+'\n';}
})
 console.log(aa);
 //alert(aa);
 document.getElementById("console").textContent=aa;
 }
 //
mData=new Array();mData["trigger"]=0;mData["condition"]=0;mData["action"]=0;E="\u0020\u0020";E2=E+E;En="\n"+E2;
function adautomation(choix) {ch=document.getElementById(choix).value;
ch1=choix+"1";ch5=" : ";ch2="";
c1=document.getElementById(ch1).value;
if (ch=="undefined") {ch=""};
    if (ch=="="){ch="equal";}
    else if (ch=="!="){ch="not_equal";}
    else if (ch=="<"){ch="below";}
    else if (ch==">"){ch="above";}
    else if (ch=="coord_gps"){ch="";ch5="";var words = c1.split(",");
      if (!words[2]) {words[2]=0;}
      c1="latitude:"+words[0]+"\n\u00a0\u00a0\u00a0\u00a0longitude:"+words[1]+"\n\u00a0\u00a0\u00a0\u00a0elevation:"+words[2];}
    else if (ch=="payload_off") {ch5="";c1=" : ";}
if (choix=="General") {
   if (c1==""){c1=true;}
   mData['General']="\u00a0\u00a0"+ch+" : "+c1;}  
 if ((choix=="trigger_time" || choix=="trigger_event") && c1!="") {mData['Trigger']=mData['Trigger']+En+ch+ch5+c1;ch2="Trigger";}
 if ((choix=="trigger_time" || choix=="trigger_event") && c1!="" && mData["trigger"]==0) {mData['Trigger']=E+"trigger:"+En+ch+ch5+c1;mData["trigger"]=1;ch2="Trigger";}
 if ((choix=="Eventcondition" || choix=="Timecondition") && c1!="") {mData['Condition']=mData['Condition']+En+ch+" : "+c1;ch2="Condition";}
 if ((choix=="Eventcondition" || choix=="Timecondition") && c1!="" && mData["condition"]==0)  {mData['Condition']=E+"condition:"+En+ch+" : "+c1;mData["condition"]=1;ch2="Condition";}
 if ((choix=="Action") && c1!="" && mData["action"]!=0) {
      if (ch=="payload") {mData['Action']=mData['Action']+En+ch+":"+En+E+c1;ch2="Action";}
      else {mData['Action']=mData['Action']+En+ch+ch5+c1;ch2="Action";}}
 if ((choix=="Action") && c1!="" && mData["action"]==0) {
      if (ch=="payload") {mData['Action']=E+"action:"+En+E2+ch+":"+En+c1;mData["action"]=1;ch2="Action";}
      else {mData['Action']=E+"action:"+En+ch+ch5+c1;mData["action"]=1;ch2="Action";}}

document.getElementById("console").textContent=mData[ch2];
 document.getElementById(ch1).value='';        
}
function reset_aut(ch3) {console.log(mData[ch3]);
mData[ch3]="";document.getElementById("console").textContent="";
}

     
</script>
