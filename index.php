<?php
echo 
'<html><body style="background-color: cornsilk;"><script>
var larg = screen.width;
if (larg<769 ){ window.location.href="http://192.168.1.7/monitor/index_loc.php";}
</script>';
echo '
<iframe id="inline_monitor"
    title="Inline Frame Example"
    style="width:768px;height:1024px;margin:0 30%;background-color: cornsilk;"
    src="http://192.168.1.7/monitor/index_loc.php">
</iframe></body></html>';
?>