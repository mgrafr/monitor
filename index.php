<?php
//session_start();
echo '<!DOCTYPE html><html><body style="background-color: cornsilk;">';

$rep="/"; $domaine=$_SERVER['HTTP_HOST'];$port=$_SERVER['SERVER_PORT'];

if (substr($domaine, 0, 7)=="192.168") $rep="/monitor/";
header('Location: '.$rep.'index_loc.php');
  exit();
/*echo '
<script>
var larg = screen.width;
if (larg<769 ){ window.location.href="'.$rep.'index_loc.php";}
else function loadPage(url){
				document.getElementById("inline_monitor").contentWindow.document.location.href=url;
			}
</script>';
echo '
<iframe id="inline_monitor"
    style="width:768px;height:1024px;margin:0 30%;background-color: cornsilk;"
    src="'.$rep.'index_loc.php">
</iframe></body></html>';*/
?>