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
                <p><?php echo $lien_zigbee;?><span id="automation"><img src="images/automations.webp" onclick="openModal('automat');" style="margin-left:100px;width:40px;height:auto;" title="automations"></span></p>
                <iframe id="zbmqtt" src="<?php echo $lien_zigbee;?>" frameborder="0"></iframe>
                
            </div>
        </div>
    </div>
</div>		
<!-- section zigbee fin--><!-- section automations-->
 

<div id="automat" class="modal">
  <div class="modal-card">
    <header class="modal-card-head">
        <p id="modal-card-title-aut" class="modal-card-title">Automation Zigbee</p>
        <button id="btn_confirm_close-aut" class="delete" aria-label="close"></button>
    </header>
    <section class="modal-card-body">
        <div id="content_automat" class="content">  
        <?php include("automation.php"); ?>
        </div>
    </section>    
  </div>
</div>
?>
