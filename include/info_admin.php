<?php
$info_admin=array();
$info_admin = [
	11 => '<p>Pour afficher la liste des modules Python , <br><img src="images/info14.webp" style="width:350px;height="auto";margin: 0 10px;" alt=""/></p>',
	10 => '<p>Pour afficher la liste des variales dans SQL , <br><img src="images/info12.webp" style="width:350px;height="auto";margin: 0 10px;" alt=""/></p>',
	9 => '<p>Pour mettre à jour automatiquement la base de données SQL , table messages:<br>pour DZ,HA,IOB ou autres app, 1 message=1 ID<br><img src="images/info11.webp" style="width:281px;height="auto";margin: 0 10px;" alt=""/></p>',
	8 => '<p>- Version monitor:  '.$_SESSION["version"].'<br>- Version PHP:      8.3<br>- Version Jpgraph:  4.4.1<br>
	        - Version Bootstrap: 4.5.2<br>- Version Mariadb Server: 10.11.6</p>',
	7 => '<p>Pour mettre à jour automatiquement la base de données SQL à partir :<br>des données de Domoticz ou HA et de Monitor<br><img src="images/info10.webp" style="width:281px;height="auto";margin: 0 10px;" alt=""/></p>',
	0 => '<p>Pour mettre à jour automatiquement la base de données SQL à partir :<br>des données de Domoticz ou HA et de Monitor<br><img src="images/info1.webp" style="width:281px;height="auto";margin: 0 10px;" alt=""/></p>',
    1 => '<p>Pour configurer le programme :<br>- indiquer les IP,les Mots de passe,...<br>- Choisir le nom des variables utilisées,..<img src="images/info2.webp" style="width:300px;height="auto";margin: 0 10px;" alt=""/></p>',
    2 => '<p>Pour afficher la liste des dispositifs Zigbee :<br>- idx<br>- nom dz <br>- lastseen<br><img src="images/info3.webp" style="width:282px;height="auto";margin: 0 10px;" alt=""/></p>',
    3 => '<p>Pour afficher la liste des dispositifs de Domoticz<br>utilisés dans Monitor<img src="images/info4.webp" style="width:276px;height="auto";margin: 0 10px;" alt=""/></p>',
    4 => '<p>Pour afficher les caméras qui passeront en mode détection<br>lors de la mise en service de l\'alarme absence<br>ces cameras sont déclarées "Modect" dans SQL:<img src="images/info5.webp" style="width:276px;height="auto";margin: 0 10px;" alt=""/></p>',
    5 => '<p>Pour modifier la configuration des variables persistentes en fichier<br>package.path = package.path..";<br>www/modules_lua/?.lua"<br><img src="images/info6.webp" style="width:276px;height="auto";margin: 0 10px;" alt=""/></p>',
    6 => '<p>enregistrement des mots de passe codés base64<br>ainsi que les IPs des différents serveurs utilisées<br>dans 3 formats différents LUA, PYTHON, NODEJS<br><br><img src="images/info9.webp" style="width:349px;height="auto";margin: 0 10px;" alt=""/></p>'];

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
