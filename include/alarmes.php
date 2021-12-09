<?php
session_start();
?>
<div class="modal" role="dialog" id="pwdalarm">
                        
		    
		    <form class="form_al"><span class="close_clavier">x</span>
        <input type="password" style="max-width: 140px;" id="password" /></br>
        <input type="button" value="1" id="1" class="pinButton calc"/>
        <input type="button" value="2" id="2" class="pinButton calc"/>
        <input type="button" value="3" id="3" class="pinButton calc"/><br>
        <input type="button" value="4" id="4" class="pinButton calc"/>
        <input type="button" value="5" id="5" class="pinButton calc"/>
        <input type="button" value="6" id="6" class="pinButton calc"/><br>
        <input type="button" value="7" id="7" class="pinButton calc"/>
        <input type="button" value="8" id="8" class="pinButton calc"/>
        <input type="button" value="9" id="9" class="pinButton calc"/><br>
        <input type="button" value="raz" id="clear" class="pinButton clear"/>
        <input type="button" value="0" id="0 " class="pinButton calc"/>
        <input type="button" value="envoi" id="enter" class="pinButton enter"/>
      </form>
  
</div>
<!-- section Alarmes start -->
<!-- ================ -->
		<div id="alarmes" class="alarmes" >
				<div class="container">
		<div class="col-md-12">
	  <h1 id="titre_alarme" class="title text-center">Alarme</span></h1>
		<div id="ecran">
		 <div id="d_btn_al" style="display:none;"><a style="background-color: #605b5dde;color:white;
border-color: #e0e3e6;border-radius: 0.55rem" class="btn btn-primary"  href="#admin">
Entrer votre mot de passe 
</a></div>		
			  <?php
					//include('test_pass.php');
					include ("alarmes_svg.php");
			  ?>
				</div>
				</div>
 </div><svg version="1.1" id="zm" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px"
	 viewBox="0 0 326 18" style="width:500px" xml:space="preserve">
<style type="text/css">
	.st208{fill:#03A8F3;}
	.st207{font-size:13.5px;}
</style><a id="zm" href="#alarmes">
<rect x="0.9" y="-0.7" class="st208" width="31.2" height="18.8"/>
<text transform="matrix(1 0 0 1 5.4312 13.3434)" class="st203 st33 st207">Z M</text></a>
</svg> <p class="zminder">Pour afficher la liste des caméras déclarées Modect<br>et pour demander un jeton pour Modect</p>
</div>
 
