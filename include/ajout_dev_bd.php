




<div id="adb" style="line-height: normal;font-size: 14px;"><p><span style="margin-left: (10)px;"><strong>Nom de l' Appareil :</strong> </span><input type="text" style="width:200px;margin-left:10px;" id="nom" value=" "  ><br><span style="color:red">*</span>champ requis&nbsp;&nbsp;<span style="color:green">*</span>choisir 1 seul des 2 champs</p>	
<p style="font-size:14px"> <em>type de mise à jour JS</em><span style="color:red">&nbsp;&nbsp;* </span><br>
<input type="hidden"id="app" value="dev_bd">
<input type="radio" name="type" value="control"> control
<input type="radio" name="type"  value="onoff"> onoff
<input type="radio" name="type"  value="data"> data(temp)
<input type="radio" name="type"  value="onoff+stop"> onoff+stop
<input type="radio" name="type"  value="popup"> popup</p><p style="font-size:14px"> <strong>Domoticz</strong><br>
<input type="hidden" id="command"  value="2">
<span style="margin-left: 10px;">Idx : <input type="text" style="width:50px;margin-left:10px;" id="idx" value=" "  ><span style="color:green">&nbsp;&nbsp;* </span><br>
 <span style="margin-left: 10px;">Nom  :<input type="text" style="width:200px;margin-left: 3px;" id="name" value=" "></p>
 <p style="font-size:14px"> <strong>Home Assistant</strong><br>
<span style="margin-left: 10px;">device.ID : <input type="text" style="width:200px;margin-left:10px;" id="ha_id" value=" "  ><span style="color:green">&nbsp;&nbsp;* </span>	 
	 <p style="font-size:14px"> <strong>Monitor</strong><br>
  <span style="margin-left: 10px;">Idm  : <input type="text" style="width:50px;" id="idm" value=" " ><span style="color:red">&nbsp;&nbsp;* </span></span><br>
  <span style="margin-left: 10px;">Id1 html : <input type="text" style="width:120px;" id="var1" value="#"><span style="color:red">&nbsp;&nbsp;* </span></span><br>
   <span style="margin-left: 10px;">Id2 html :<input type="text" style="width:120px;margin-left: 10px;" id="var2" value=" " ><br>
    <span style="margin-left: 10px;">Couleur Id1-Id2 : ON = <input type="text" style="width:200px;margin-left: 10px;" id="coula" value=" " ><br>
   <span style="margin-left: 10px;">Couleur Id1-Id2 : OFF =<input type="text" style="width:200px;margin-left:9px;" id="coulb"  value=" " ><br>
 <span style="margin-left: 10px;">matériel : <input type="radio" name="type_mat" value="zwave"> zwave
<input type="radio" name="type_mat" value="zigbee"> zigbee
<input type="radio" name="type_mat" value="autres"> autres<br>
<span style="margin-left: 10px;">Class (lampes) : <input type="text" style="width:200px;margin-left:9px;" id="class"  value=" " ><br>
<span style="margin-left: 10px;">Couleur lampes : on <input type="text" style="width:100px;margin-left:9px;" id="coulc"  value=" " >
<span style="margin-left: 5px;">, off: <input type="text" style="width:100px;margin-left:9px;" id="could"  value=" " ><br>
<span style="margin-left: 10px;">mot de passe : <input type="radio" name="mot_pass" value="alarme"> alarme & admin
<input type="radio" name="mot_pass" value="commandes"> commandes
<input type="radio" name="mot_pass" value"non"> NON<br>
	<span style="margin-left: 10px;">f() : <input type="number" style="width:30px;margin-left:9px;" id="fx"  value="0" ><em style="color:red">&nbsp;&nbsp;max 2 car </em>, car max :
	<input type="text" style="width:30px;margin-left:9px;" id="car"  value="99"><br><br><br>
<button type="button" onclick="adby(2)" style="width:50px;height:30px">Envoi</button>  
</div>

<script>	 

</script>	 
	 