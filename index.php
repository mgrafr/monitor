<?php
écho $_SERVER['HTTP_HOST'];
// indiquer l'adresse du repertoire  du site sur le serveur
$lien="http://192.168.1.7/monitor/monitor-main/index_loc.php";
echo 
'<html><body style="background-color: cornsilk;"><script>
var larg = screen.width;
if (larg<769 ){ window.location.href="'.$lien.';}
</script>';
echo '
<iframe id="inline_monitor"
    title="Inline Frame Example"
    style="width:768px;height:1024px;margin:0 30%;background-color: cornsilk;"
    src="'.$lien.'">
</iframe></body></html>';
?>
