<!-- section Mur Cam -->
<!-- ================ -->
		<div id="murcam" class="mur_cam" >
			<div class="container">
		<div class="col-md-12 colmur">
	  <h4 id="titre_mur" class="title text-center">Mur<span> des caméras</span></h4>
	  <?php echo (NOMMUR . " - " . NBCAM );if (NBCAM==0) echo "<p style='color:red' >pour afficher des caméras<br>il faut utiliser Zoneminder</p>";?>
			<br><input id="onoffmur" type="checkbox" data-toggle="switchbutton"></div>
			<div id="message1" class="space">cliquer sur une image pour activer le zoom video de l'image</div><table class="cam">
               <tbody>
<?php
$scale=100;
$i=1;$j=1;
while ($i <= NBCAM) {
	$camImgId="cam".$i;
	if ($j==1) {echo "<tr>";}
  	echo '<td>
	<img id="'.$camImgId.'" src="include/mur_cameras.php?idx='.$i.'&url='.ZMURL.'&x=" rel="'.$i.'" class="dimcam" alt=""/></td>';
	if (($j==2) || ($i==NBCAM)){ echo "</tr>";$j=0;}
  $i++;$j++;}				

?>
</tbody>
      </table>		
		  
             
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
