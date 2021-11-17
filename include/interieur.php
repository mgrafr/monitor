<!-- section intérieur start -->
<!-- ================ -->
<div id="interieur" >
	<div class="container">
		<div class="col-md-12">
	  <h1 id="about" class="title text-center">Dispositifs<span> installés<br>à l'intérieur</span></h1>
		<div class="space"></div>
         <?php include ("include/maison_svg.php");
		 echo '<div id="voltage">';
		 // décommenter cette ligne pour l'affichage du voltmètre
		 include ("include/voltmetre_svg.php");
		 echo '</div>';
		 ?>
		
<div class="modal" id="camera">
  <div class="modal-dialog" style="height:auto">
    <div class="modal-content">
      <div class="modal-header">
        <h3 class="modal-title">image camera</h3>
		   <button class="btn_cam">Config</button>

</div> 
		     <img id="cam" style="max-width: 100%;height:auto;" src="">
			 </div>
     
	 </div>
     </div>
</div>
	</div><p id="erreur_interieur" ></p>
		</div>       
<!-- section interieur fin-->
<!-- popup #interieur #exterieur-->
<div class="modal" id="infos">
  <div class="modal-dialog" style="width:300px">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title">Infos Dispositfs</h4>
      </div>
      <div id="contenu" class="modal-body">
        xxx
      </div>
     </div>
  </div>
</div><!-- FIN  popup #interieur #exterieur-->
