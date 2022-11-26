<!-- section SPA start -->
<!-- ================ -->
		<div id="spa" class="spa">
			<div class="container">
		<div class="col-md-12"><p>
	  <h1 class="title_ext text-center">SPA<span style="margin-left:20px;font-size: 20px;"> contrôle qualité</span></h1><br>
		</p>
			
		   <?php include ("ph-redox_svg.php");?>
</div>
</div>

  </div>

<script>
num_ecran=0;nb_ecran=<?php echo NB_ECRAN_SPA;?>;
function next_ecran(num_ec){
 num_actuel=num_ecran;num_ecran=num_ecran+num_ec;
 if (num_ecran>=nb_ecran || num_ecran<0) {num_ecran=0;}
 div_suiv="ecran"+num_ecran;div_prec="ecran"+num_actuel;
 document.getElementById(div_prec).style.display="none";document.getElementById(div_suiv).style.display="block";
 var ecranspa=<?php echo '["' . implode('", "', ECRANSPA) . '"]' ?>;
 nbec=0;
 while (nbec<=nb_ecran-2){//console.log(nbec+" .. "+ecranspa[nbec]);
	graph(ecranspa[nbec]+'_spa','text_svg','graphic_'+ecranspa[nbec]);
	nbec++;
 }	
}
</script>
		


