<?php

echo '<div id="advf" style="line-height: normal;font-size: 13px;"><form><p style="width:350px;background-color: aquamarine; margin-left: 10px;"><strong>Si mise à jour, num: :</strong><input type="text" style="width:40px;margin-left:10px;" id="num" value=""  ><input type="hidden" id="command2"  value="9"><button id="bouton1_maj" type="button" onclick="adby(6)" style="width:50px;margin-left:10px;height:30px">Envoi</button></p></form></div>
<div id="adv_f" style="line-height: normal;font-size: 14px;"><form><p style="width:350px;background-color: aquamarine; margin-left: 10px;"><strong>Si mise à jour de la table txt_image, recherche du <br> texte : </strong><input type="text" style="width:230px;margin-left:10px;" id="texte" value=""  ><input type="hidden" id="command4"  value="11"><button id="bouton2_maj" type="button" onclick="adby(8)" style="width:50px;margin-left:10px;height:30px">Envoi</button></p></form></div>
<div id="avb" style="line-height: normal;"><span style="color:red">*</span>champ requis
<p style="font-size:14px"> <strong>Monitor</strong><p>
<input type="hidden" id="app1"  value="var_bd"><input type="hidden" id="command"  value="1">
 <span style="margin-left: 10px;">Idm : <input type="text" style="width:50px;margin-left:10px;" value="" id="idm" ></span><span style="color:red">&nbsp;&nbsp;* </span><br>
	<p style="font-size:14px"> <strong>Domoticz</strong><p>
 <span style="margin-left: 10px;">Idx : <input type="text" style="width:50px;margin-left:10px;" value="" id="idx" ></span><span style="color:red">&nbsp;&nbsp;* </span><br>
  <p style="font-size:14px"> <strong>Home Assistant</strong><p>
  <span style="margin-left: 10px;">entity_id : <input type="text" style="width:200px;margin-left:10px;" value="" id="ha_id" ></span><span style="color:red">&nbsp;&nbsp;* </span><br><p style="font-size:14px"> <strong>Domoticz, Home Assistant, IoBroker</strong><p>
 <span style="margin-left: 10px;">nom_objet  :<input type="text" style="width:200px;margin-left: 3px;" id="nom_objet" value="" ></span><span style="color:red">&nbsp;&nbsp;* </span><br>
 <p style="font-size:14px"> <strong>Base de données SQL</strong><p>
  <span style="margin-left: 10px;">Id Image : <input type="text" style="width:120px;"  id="id_img" value="" ></span><br>
   <span style="margin-left: 10px;">Id Texte :<input type="text" style="width:120px;margin-left: 10px;" id="id_txt" value="" ></span><br>
  <p style="font-size:14px"> <em>texte -> image</em><p><br>
  <span style="margin-left: 10px;">Texte : <input type="text" style="width:200px;margin-left: 10px;" id="texte_bd" value="" ></span><br>
   <span style="margin-left: 10px;">Image :<input type="text" style="width:200px;margin-left:9px;" id="image_bd" value="" ></span><br>
   <span style="margin-left: 10px;">Icone :<input type="text" style="width:200px;margin-left:9px;" id="icone_bd" value="" ></span><br>
 <button type="button" onclick="adby(1)" id="bouton_avb" style="width:100px;height:30px">Envoi</button>  
</div>';


?>