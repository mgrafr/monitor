
<div id="adbf" style="line-height: normal;font-size: 14px;"><form><p style="width:350px;background-color: aquamarine; margin-left: 10px;"><strong>Si mise à jour, idm: :</strong><input type="text" style="width:40px;margin-left:10px;" id="majidm" value=""  ><input type="hidden" id="command1"  value="7"><input type="hidden" id="appli"  value="dev_bd"><button id="bouton_maj" type="button" onclick="adby(4)" style="width:50px;margin-left:10px;height:30px">Envoi</button></p></form></div>
<div id="adb" style="line-height: normal;font-size: 14px;"><form>
	<p><span style="margin-left: 10px;"><strong>Nom de l' Appareil :</strong> </span><input type="text" style="width:200px;margin-left:10px;" id="nom" value=""  ><br><span style="margin-left: 10px;"><em>ou fiendly_name</em></span><br><span style="margin-left: 10px;color:red">*</span>champ requis&nbsp;&nbsp;<span style="color:green">*</span>choisir au moins 1 champ (si Actif coché)</p>	
<p style="margin-left: 10px;font-size:14px"> <em>type de mise à jour JS</em><span style="color:red">&nbsp;&nbsp;* </span><br>
<input type="hidden"id="app" value="dev_bd">
<input type="radio" name="maj_js" value="control">control
<input type="radio" name="maj_js" value="control">etat
<input type="radio" name="maj_js"  value="onoff">onoff
<input type="radio" name="maj_js"  value="data">data
<input type="radio" name="maj_js"  value="temp">temp	
<input type="radio" name="maj_js"  value="onoff+stop">onoff+stop
<input type="radio" name="maj_js"  value="on_level">on_level
<input type="radio" name="maj_js"  value="on">on
<input type="radio" name="maj_js"  value="on=">on=
<input type="radio" name="maj_js"  value="popup">popup<br>INFO:<em style="color:green">onoff:interrupteur</em>,<em style="color:darkblue">onoff+stop:volet</em>,<em style="color:purple">on:sonnette</em></p>
<p style="margin-left: 10px;font-size:14px"> <strong>Domoticz</strong><br>
<input type="hidden" id="command"  value="2">
<span style="margin-left: 10px;">Idx : <input type="text" style="width:50px;margin-left:10px;" id="idx" value=""  ><span style="color:green">&nbsp;&nbsp;* </span></p>
 <p style="margin-left: 10px;font-size:14px"> <strong>Home Assistant & IoBroker</strong><br>
<span style="margin-left: 10px;">ID ou entity_id : <input type="text" style="width:250px;margin-left:10px;" id="ha_id" value=""  ><span style="color:green">&nbsp;&nbsp;* </span></p>	<p style="margin-left: 10px;font-size:14px"> <strong>Domoticz , HA & io.Broker </strong>(nom ou object_id)<br> <span style="margin-left: 10px;">Nom_objet  :<input type="text" style="width:200px;margin-left: 3px;" id="nom_objet" value=""></p>
	<p style="margin-left: 10px;font-size:14px"> <strong>Monitor</strong><br>
  <span style="margin-left: 10px;">Idm  : <input type="text" style="width:50px;" id="idm" value="" ><span style="color:red">&nbsp;&nbsp;* </span><em style="font-size:13px">(1à999 Groupe:G1.. , Scene:S1..,iob+:xxx_n )</em></span><br>
  <span style="color:red">&nbsp;&nbsp;&nbsp;Actif </span>:&nbsp;&nbsp;<input type="radio" name="actif"  value="0"><span style="color:black">Inactif</span> : 
   <input type="radio" name="actif" value="2" ><span style="color:blue">Dz </span>&nbsp;&nbsp;<input type="radio" name="actif"  value="3"><span style="color:green">Ha</span>&nbsp;&nbsp;<input type="radio" name="actif"  value="4"><span style="color:purple">Iob</span>&nbsp;&nbsp;<input type="radio" name="actif"  value="5"><span style="color:darkgoldenrod">Mon</span><br>
  <span style="margin-left: 10px;">Id1 html : <input type="text" style="width:120px;" id="id1_html" value="#"><span style="color:red">&nbsp;&nbsp;* </span></span><br>
   <span style="margin-left: 10px;">Id2 html :<input type="text" style="width:120px;margin-left: 10px;" id="id2_html" value="" ><br>
    <span style="margin-left: 10px;">Couleur Id1-Id2 : ON = <input type="text" style="width:200px;height:20px;margin-left: 10px;" id="coula" value="" ><br>
   <span style="margin-left: 10px;">Couleur Id1-Id2 : OFF =<input type="text" style="width:200px;height:20px;margin-left:9px;" id="coulb"  value="" ><br>
 <span style="margin-left: 10px;">matériel : <input type="radio" name="type_mat" value="zwave"> zwave
  <input type="radio" name="type_mat" value="zigbee"> zigbee
  <input type="radio" name="type_mat" value="virtuel"> virtuel
<input type="radio" name="type_mat" value="autres"> autres<br>
<span style="margin-left: 10px;">lastseen : <input type="radio" name="ls" value="1"> oui	 
<input type="radio" name="ls" value="0"> non<br>	 
<span style="margin-left: 10px;">Class (lampes) : <input type="text" style="width:200px;margin-left:9px;" id="class"  value="" ><br>
<span style="margin-left: 10px;">Couleur lampes : on <input type="text" style="width:100px;margin-left:9px;" id="coulc"  value="" >
<span style="margin-left: 5px;">, off: <input type="text" style="width:100px;margin-left:9px;" id="could"  value="" ><br>
<span style="margin-left: 10px;">mot de passe : <input type="radio" name="mot_pass" value="alarme"> alarme & admin
<input type="radio" name="mot_pass" value="commandes"> commandes
<input type="radio" name="mot_pass" value"non" checked> NON<br>
	<span style="margin-left: 10px;">f() : <input type="number" style="width:30px;margin-left:9px;" id="fx"  value="0" ><em style="color:red">&nbsp;&nbsp;-1 réservé </em>, car max :	<input type="text" style="width:30px;margin-left:9px;" id="car"  value="99"><em style="color:red">&nbsp;&nbsp;max 2 car </em><br><span style="margin-left: 10px;">Observations :<input type="text" style="width:290px;margin-left:9px;" id="obs"  value="">
		<br><br>
<button type="button" onclick="adby(2)" style="width:50px;height:30px">Envoi</button>  
</form1>	</div>

<script>	 

	

</script>
	 
	 