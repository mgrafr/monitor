<?php

echo '<div id="avb" style="line-height: normal;"><span style="color:red">*</span>champ requis
	<p style="font-size:14px"> <strong>Domoticz</strong><p>
<input type="hidden" id="app"  value="var_bd"><input type="hidden" id="command"  value="1">
 <span style="margin-left: 10px;">Idx : <input type="text" style="width:50px;margin-left:10px;" value="" id="idx" ></span><span style="color:red">&nbsp;&nbsp;* </span><br>
 <span style="margin-left: 10px;">Nom  :<input type="text" style="width:200px;margin-left: 3px;" id="name" value="" ></span><br>
 <p style="font-size:14px"> <strong>Home Assistant</strong><p>
 <input type="hidden" id="app"  value="var_bd"><input type="hidden" id="command"  value="1">
 <span style="margin-left: 10px;">device ID : <input type="text" style="width:200px;margin-left:10px;" value="" id="ha_id" ></span><span style="color:red">&nbsp;&nbsp;* </span><br>
 <span style="margin-left: 10px;">Nom usuel :<input type="text" style="width:200px;margin-left: 3px;" id="nom" value="" ></span><br>
  <p style="font-size:14px"> <strong>Base de données SQL</strong><p>
  <span style="margin-left: 10px;">Id Image : <input type="text" style="width:120px;"  id="id_img" value="" ></span><br>
   <span style="margin-left: 10px;">Id Texte :<input type="text" style="width:120px;margin-left: 10px;" id="id_txt" value="" ></span><br>
  <p style="font-size:14px"> <em>texte -> image</em><p><br>
  <span style="margin-left: 10px;">Texte : <input type="text" style="width:200px;margin-left: 10px;" id="texte_bd" value="" ></span><br>
   <span style="margin-left: 10px;">Image :<input type="text" style="width:200px;margin-left:9px;" id="image_bd" value="" ></span><br>
 <button type="button" onclick="adby(1)" id="bouton_avb" style="width:100px;height:30px">Envoi</button>  
</div>';


?>