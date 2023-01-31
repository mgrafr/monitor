<?php
session_start();
$domaine=$_SESSION["domaine"];
if ($domaine==URLMONITOR) $lien_img="";
if ($domaine==IPMONITOR) $lien_img="/monitor";
?>
<!-- section Mur OnOff-->
<!-- ================ -->


<script>
// Créer une instance client
var mess1={
	command: "switchlight", 
	idx: 177, 
	switchcmd: "Set Level",
	level: 100 
	};
var client;
var host='<?php echo MQTT_IP;?>';var port='<?php echo MQTT_PORT;?>';var topic = '<?php echo MQTT_TOPIC;?>';
function onConnect(){console.log("onConnect");
client.subscribe(topic);
var mesg = JSON.stringify(mess1);					 
message=new Paho.MQTT.Message(mesg);
message.destinationName=topic;
client.send(message);
maj_devices(<?php echo NUMPLAN;?>)	;				 
}
function MQTTconnect(){console.log("MQTT:"+host+"topic:"+topic);

client = new Paho.MQTT.Client(host, port, "clientjs");
var options={
	timeout:3,
	onSuccess:onConnect,
			};
client.connect(options);//connect
}

</script>
		<div id="murinter" class="inter">
			<div class="container">
		<div class="col-md-12" >
	  <h1 class="title_ext text-center">Mur<span>  Commandes M/A</span></h1>
		<p class="txt_ext">certaines commandes peuvent éxiger,<br>
				un mot de passe</p>	
		<ul>
			<li style="margin-left:0;margin-top:10px"><a href="#murinter"><img id="sw5" src="<?php echo $lien_img;?>/images/lampe_sejour.svg" width="60" height="auto" alt=""/></a></li>
			<li style="margin-left:0;margin-top:10px"><a href="#murinter"><img id="sw4" src="<?php echo $lien_img;?>/images/lampe_entree.svg" width="60" height="40" alt=""/></a></li>
			<li style="margin-left:0;margin-top:10px"><a href="#murinter"><img id="sw3" src="<?php echo $lien_img;?>/images/lampe_salon.svg" width="60" height="40" alt=""/></a></li>
			<li style="margin-left:0;margin-top:10px"><a href="#murinter"><img id="sw2" src="<?php echo $lien_img;?>/images/lampe_bureau.svg" width="60" height="60" alt=""/></a></li>
			<li style="margin-left:0;margin-top:10px"><a href="#murinter"><img id="sw1" src="<?php echo $lien_img;?>/images/lampe_poele.svg" width="60" height="60" alt=""/></a></li>
			<li style="margin-left:0;margin-top:10px"><?php include ("volet-roulant_svg.php");?></li>
			<li style="margin-left:0;margin-top:10px"><img id="sw6" src="<?php echo $lien_img;?>/images/porte_garage.svg" width="60" height="auto" alt=""/></li>
			
			<li style="margin-left:0;margin-top:10px"><img id="sw7" src="<?php echo $lien_img;?>/images/portail.svg" width="60" height="60" alt=""/></li>
			
			<li style="margin-left:0;margin-top:10px"><a href="#murinter"><img id="sw8" src="<?php echo $lien_img;?>/images/arrosage.svg" width="60" height="auto" alt=""/></a></li>
			
			<li style="margin-left:0;margin-top:10px"><a href="#murinter"><img id="sw9" src="<?php echo $lien_img;?>/images/lampe_jardin.svg" width="60" height="auto" alt=""/></a></li>
		</ul>
</div>
</div></div>

<!-- div containing the popup -->
    <div class="popup" id="popup_vr">
    <div class="popup-content" id="VR" rel="">
      <h6>Commande OUVERTURE-FERMETURE</h6>
      <!--<p><a onclick="MQTTconnect(mess1);">OUVRIR?></a> (ON).</p>-->
		<p><a id="clic_vr">ouvert 0................100 fermé</a></p>  
	  <div id="slider"></div>
<form>
<label>commande:<span id="level_vr"></span></label><br>
		<button type="button" class="btn btn-primary" value="OK"><input  type="button" id="amount" name="" value="">OK</button></form>
		      <a class="closeBtn" href="javascript:void(0)">X</a>
    </div>
  </div>
