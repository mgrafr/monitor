<?php

echo '<div class="container is-fluid">
  <form>
    <p class="box has-background-info-light" style="width: 350px; margin-left: 10px;">
      <strong>Si mise à jour, num: :</strong>
      <input type="text" class="input is-small" style="width: 40px; margin-left: 10px;" id="num" value="">
      <input type="hidden" id="command2" value="9">
      <button class="button is-primary" id="bouton1_maj" onclick="adby(6)" style="width: 50px; margin-left: 10px; height: 30px;">Envoi</button>
    </p>
  </form>
</div>
<div class="container is-fluid">
  <form>
    <p class="box has-background-info-light" style="width: 350px; margin-left: 10px;">
      <strong>Si mise à jour de la table txt_image, recherche du <br> texte : </strong>
      <input type="text" class="input is-small" style="width: 230px; margin-left: 10px;" id="texte" value="">
      <input type="hidden" id="command4" value="11">
      <button class="button is-link" id="bouton2_maj" onclick="adby(8)" style="width: 50px; margin-left: 10px; height: 30px;">Envoi</button>
    </p>
  </form>
</div>
<div class="container is-fluid">
  <span class="has-text-danger">*</span>champ requis
  <p class="is-size-6">
    <strong>Monitor</strong>
    <input type="hidden" id="app1" value="var_bd">
    <input type="hidden" id="command" value="1">
    <span class="ml-3">Idm : <input type="text" class="input is-small" style="width: 50px; margin-left: 10px;" value="" id="idm"></span>
    <span class="has-text-danger">&nbsp;&nbsp;* </span>
    <strong>Domoticz</strong>
    <span class="ml-3">Idx : <input type="text" class="input is-small" style="width: 50px; margin-left: 10px;" value="" id="idx"></span>
    <span class="has-text-danger">&nbsp;&nbsp;* </span>
  </p>
  <p class="is-size-6">
    <strong>Home Assistant ioBroker Monitor</strong>
  </p>
  <span class="ml-3">ID : <input type="text" class="input is-small" style="width: 200px; margin-left: 10px;" value="" id="ha_id"></span>
  <span class="has-text-danger">&nbsp;&nbsp;* </span>
  <br>
  <p class="is-size-6">
    <strong>Domoticz, Home Assistant, IoBroker, Monitor</strong>
  </p>
  <span class="ml-3">nom_objet : <input type="text" class="input is-small" style="width: 200px; margin-left: 3px;" id="nom_objet" value=""></span>
  <span class="has-text-danger">&nbsp;&nbsp;* </span>
  <br>
  <br>
  <span class="has-text-danger">&nbsp;&nbsp;&nbsp;Actif </span>:&nbsp;&nbsp;
  <input type="radio" name="actif" value="0">
  <span class="has-text-black">Inactif</span>:
  <input type="radio" name="actif" value="2">
  <span class="has-text-info">Dz </span>&nbsp;&nbsp;
  <input type="radio" name="actif" value="3">
  <span class="has-text-success">Ha</span>&nbsp;&nbsp;
  <input type="radio" name="actif" value="4">
  <span class="has-text-purple">Iob</span>&nbsp;&nbsp;
  <input type="radio" name="actif" value="5">
  <span class="has-text-warning">Mon</span>
  <br>
  <br>
  <span class="ml-3">Id Image : <input type="text" class="input is-small" style="width: 120px;" id="id_img" value=""></span>
  <br>
  <span class="ml-3">Id Texte : <input type="text" class="input is-small" style="width: 120px; margin-left: 10px;" id="id_txt" value=""></span>
  <br>
  <p class="is-size-6">
    <strong>Table text_image</strong>&nbsp;&nbsp;
    <em>texte -> image</em>
  </p>
  <span class="ml-3">Texte : <input type="text" class="input is-small" style="width: 200px; margin-left: 10px;" id="texte_bd" value=""></span>
  <br>
  <span class="ml-3">Image : <input type="text" class="input is-small" style="width: 200px; margin-left: 9px;" id="image_bd" value=""></span>
  <br>
  <span class="ml-3">Icone : <input type="text" class="input is-small" style="width: 200px; margin-left: 9px;" id="icone_bd" value=""></span>
  <br>
  <br>
  <button class="button is-danger" onclick="adby(1)" id="bouton_avb" style="width: 100px; height: 30px;">Envoi</button>
</div>';


?>