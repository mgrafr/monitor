<?php
//session_start();
$domaine=$_SESSION["domaine"];
if ($domaine==URLMONITOR) $lien_zigbee=URLZIGBEE;
if ($domaine==IPMONITOR) $lien_zigbee=IPZIGBEE;
?>
<!-- section zigbee2mqtt start -->
<!-- ================ -->
<div id="zigbee">
    <div class="container">
        <div class="columns is-centered">
            <div class="column is-12">
                <h1 class="title">Devices: <span style="color:blue">Zigbee</span></h1>
                <p><?php echo $lien_zigbee;?><span id="automation"><img src="images/automations.webp" onclick="$('#automat').show();" style="margin-left:100px;width:40px;height:auto;" title="automations"></span></p>
                <iframe id="zbmqtt" src="<?php echo $lien_zigbee;?>" frameborder="0"></iframe>
                <div class="modal" id="infos"></div>
            </div>
        </div>
    </div>
</div>		
<!-- section zigbee fin--><!-- section automations-->
 
<?php 
echo '<div id="automat">
<button id="fermer_aut" style="position: absolute;right: 10px;width:100px" onclick="$(\'#automat\').hide();">Fermer</button>';
include("automation.php");
echo '</div>'
?>
