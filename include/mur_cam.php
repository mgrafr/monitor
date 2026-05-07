<!-- ================ -->
<div id="murcam" class="mur_cam">
  <div class="columns">
    <div class="column is-full">
      <p id="titre_mur" class="title">Mur<span> des caméras</span></p>
        <?php 
          if (SRC_MUR != "fr") {
            echo '<h4>'.NOMMUR.' - '.NBCAM.'<br> '; 
          } else {
            echo " ".NOMMUR."<br>";
          }
        ?>
      <div class="toggle-outer">
			  <div class="toggle-inner">
				  <input type="checkbox" id="toggle">
			  </div>
       
		  </div>
		  <div id="result"> </div>
   <label id="toggleLabel" for="toggle">Vidéo inactive</label>

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
<!-- Creates the modal where the image will appear -->
 <div class="modal" id="imagemodal">
  <div class="modal-background"></div>
  <div class="modal-card">
    <header class="modal-card-head">
      <p class="modal-card-title">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Caméra en direct</p>
      <button id="btn_confirm_close_cam" class = "delete" aria-label = "close" onclick="closeModal('imagemodal');arret_zoom=0;"></button>
   
    </header>
    <section class="modal-card-body">
      <img src="" id="imagepreview" style="width: 400px; height: 264px;">
    </section>
  </div>
 </div>
</div>