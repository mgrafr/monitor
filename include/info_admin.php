<?php

$info_admin=array();
$info_admin = [
	0 => '<p>Pour mettre à jour automatiquement la base de données SQL à partir :<br>des données de Domoticz et de Monitor<br><img src="images/info1.jpg" style="width:281px;height="auto";margin: 0 10px;" alt=""/></p>',
    1 => '<p>Pour configurer le programme :<br>- indiquer les IP,les Mots de passe,...<br>- Choisir le nom des variables utilisées,..<img src="images/info2.jpg" style="width:300px;height="auto";margin: 0 10px;" alt=""/></p>',
    2 => '<p>Pour afficher la liste des dispositifs Zigbee :<br>- idx<br>- nom dz <br>- idm<br><img src="images/info3.jpg" style="width:282px;height="auto";margin: 0 10px;" alt=""/></p>',
    3 => '<p>Pour afficher la liste des dispositifs de Domoticz<br>utilisés dans Monitor<img src="images/info4.jpg" style="width:276px;height="auto";margin: 0 10px;" alt=""/></p>',
    4 => '<p>Pour afficher les caméras qui passeront en mode détection<br>lors de la mise en service de l\'alarme absence<br>ces cameras sont déclarées "Modect" dans SQL:<img src="images/info5.jpg" style="width:276px;height="auto";margin: 0 10px;" alt=""/></p>',
    5 => '<p>Pour modifier la configuration des variables persistentes en fichier<br>package.path = package.path..";<br>www/modules_lua/?.lua"<br><img src="images/info6.jpg" style="width:276px;height="auto";margin: 0 10px;" alt=""/></p>',
    6 => '<p>enregistrement des mots de passe codés base64<br><br><img src="images/info9.jpg" style="width:349px;height="auto";margin: 0 10px;" alt=""/></p>'];

$js_info_admin = json_encode($info_admin);
?>

<div class="modal" id="info-admin1">
  <div class="modal-dialog" style="height:auto;width: 350px;">
    <div class="modal-content">
      <div class="modal-header">
        <h3 class="modal-title">Infos</h3>
		 </div>

<div id="affich_content_info"></div>
		
			 
    </div>
     
	 </div>
     </div>	
