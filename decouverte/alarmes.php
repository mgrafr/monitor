<?php
session_start();
?>
<!-- section Alarmes start -->
<!-- ================ -->
		<div id="alarmes" class="alarmes" >
			<div class="container">
		<div class="col-md-12">
	  <h1 id="titre_alarme" class="title text-center">Alarme</span>..DEMO..</h1>
		<div id="message" class="space">
			  <?php
					include('test_pass.php');
					include ("alarmes_svg.php");
			  ?>
				</div>
				</div>
 </div></div>
 <div class="modal" role="dialog" id="pwdalarm">

		    <div id="verif_mpa" >
		    <form class="form_al">
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
</div>
<script>
document.getElementById('tspan7024').innerHTML=jour;
document.getElementById('console1').innerHTML=text1;
document.getElementById('not').innerHTML="";
</script>
