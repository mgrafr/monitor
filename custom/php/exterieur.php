<!-- section exterieur start -->
<!-- ================ -->
		<div id="exterieur" class="exterieur">
			<div class="container">
		<div class="col-md-12">
	  <h1 class="title_ext text-center">coté<span>  jardin</span></h1>
		<p class="txt_ext">les caméras ne prennent que des instantannés ,<br>
				pour la capture en temps réel afficher le mur de caméras</p>	
			<p style="margin-top:100px"></p>
		   <?php include ("exterieur_svg.php");?>
</div>
</div>
			<div id="erreur_exterieur" ></div>
	   <div id="reset_erreur_exterieur" style="display:none"><svg version="1.1" id="reset_erreur" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="30px" y="30px"
	 viewBox="0 0 16 16" xml:space="preserve">
<circle onclick="document.getElementById('reset_erreur_exterieur').style.display='none';document.getElementById('erreur_exterieur').innerHTML ='';"fill="#007DC6" cx="7.7" cy="7.9" r="7.7"/>
<path class="st1" d="M8,3C5.2,3,3,5.2,3,8s2.2,5,5,5s5-2.2,5-5c0-0.7-0.2-1.4-0.5-2.1c-0.1-0.3,0-0.5,0.3-0.7c0.2-0.1,0.5,0,0.6,0.2
	c1.4,3,0.1,6.6-2.9,8s-6.6,0.1-8-2.9s-0.1-6.6,2.9-8C6.3,2.2,7.1,2,8,2V3z"/>
<path d="M8,4.5V0.5c0-0.1,0.1-0.2,0.3-0.2c0.1,0,0.1,0,0.2,0.1l2.4,2c0.1,0.1,0.1,0.3,0,0.4l-2.4,2c-0.1,0.1-0.3,0.1-0.4,0
	C8,4.6,8,4.5,8,4.5z"/>
</svg></div>

<div class="modal" id="camera_ext">
  <div class="modal-dialog" style="height:auto">
    <div class="modal-content">
      <div class="modal-header">
        <h3 class="modal-title">image camera</h3>
		<button class="btn_cam">Config</button></div>
		     <img id="cam_ext" style="max-width:100%" src="">
			 </div>
     
	 </div>
     </div>
  </div>

		

			

