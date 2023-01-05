<?php
echo '<!DOCTYPE html><html><body style="background-color: cornsilk;">';

$rep="/"; $domaine=$_SERVER['HTTP_HOST'];
if (substr($domaine, 0, -2)=="192.168.1" || substr($domaine, 0, -2)=="192.168.1.");
echo '
<script>
var larg = screen.width;
if (larg<769 ){ window.location.href="'.$rep.'index_loc.php";}
</script>';
echo '
<iframe id="inline_monitor"
    style="width:768px;height:1024px;margin:0 30%;background-color: cornsilk;"
    src="'.$rep.'index_loc.php">
</iframe></body></html>';
?>