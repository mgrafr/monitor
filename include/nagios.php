<?php
//session_start();
$domaine=$_SESSION["domaine"];
if ($domaine==URLMONITOR) $lien_nagios=URLNAGIOS;//header("Access-Control-Allow-Origin: 'https://monitoring.la-truffiere.ovh'");
if ($domaine==IPMONITOR) $lien_nagios=IPNAGIOS;



?>
<!-- section monitoring start -->
<!-- ================ -->
<div id="nagios">
    <div class="container">
        <div class="columns is-centered">
            <div class="column is-12">
                <h1 class="title">Monitoring : <span style="color:blue">NAGIOS</span></h1>
                <div id="ping_pi4" title="Ping PI5"><img id="ping_pi" src="" alt="ping pi" /></div>
                <div id="ping_pi_txt" title="Ping txt"></div>
                <iframe id="nagiosapp" src="<?php echo $lien_nagios;?>" frameborder="0"></iframe>
               
            </div>
        </div>
    </div>
</div>

<!-- section monitoring fin-->

