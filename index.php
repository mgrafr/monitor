<?php
echo '<!DOCTYPE html><html><body style="background-color: cornsilk;">';
$domaine=$_SERVER['HTTP_HOST'];
echo '
<script>
var larg = screen.width;
if (larg<769 ){ window.location.href="'.$domaine.'/monitor/index_loc.php";}
</script>';
echo '
<iframe id="inline_monitor"
    style="width:768px;height:1024px;margin:0 30%;background-color: cornsilk;"
    src="index_loc.php">
</iframe></body></html>';
?>