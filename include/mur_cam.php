<!-- ================ -->
<div id="murcam" class="mur_cam" >
  <div class="container">
		<div class="col-md-12 colmur">
	  <h4 id="titre_mur" class="title text-center">Mur<span> des caméras</span></h4>
	  <?php 
    if (SRC_MUR != "fr") {echo ' '.NOMMUR.' - '.NBCAM.'<br><input id="onoffmur" type="checkbox" data-toggle="toggle" ><div id="aqw">Vidéo inactive'; } 
    else {echo  " ".NOMMUR."<br>";}
	 ?> 
	  </div>
  </div>

<?php
if (SRC_MUR != "fr") {echo '<div id="message1" class="space">cliquer sur une image pour activer le zoom video de l\'image</div><table class="cam">
  <tbody>';
  $scale=100;
  $i=1;$j=1;
  while ($i <= NBCAM) {
	if (SRC_MUR=="mo") {$src_img='include/mur_cameras1.php?id_zm='.$i.'&x=';}
	if (SRC_MUR=="zm") {$src_img='include/mur_cameras.php?idx='.$i.'&url='.ZMURL.'&x=';}	
	$camImgId="cam".$i;
	if ($j==1) {echo "<tr>";}
  	echo '<td>
	<img id="'.$camImgId.'" src="'.$src_img.'" rel="'.$i.'" class="dimcam" alt=""/></td>';
	if (($j==2) || ($i==NBCAM)){ echo "</tr>";$j=0;}
  $i++;$j++;}				
  echo '</tbody></table>';}
if (SRC_MUR=="fr") {$domaine=$_SESSION["domaine"];
  if ($domaine==URLMONITOR) $lien_frigate=URL_FRIGATE;
  if ($domaine==IPMONITOR) $lien_frigate=IP_FRIGATE;
  echo '<iframe id="frigate" src="'.$lien_frigate.'" frameborder="0" ></iframe>';}
?>		
</div>
</div>
<!-- Creates the bootstrap modal where the image will appear -->
<div class="modal fade" id="imagemodal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
        <h4 class="modal-title" id="myModalLabel">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Caméra en direct</h4>
      </div>
      <div class="modal-body">
        <img src="" id="imagepreview" style="width: 400px; height: 264px;" >
      </div>
      <div class="modal-footer">
        <button type="button" id="close_cam" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>			
