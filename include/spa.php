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
num_ecran=0;valph="";valorp="";valtemp1spa="";m3="";
	function next_ecran(num_ec){console.log(num_ec);
num_ecran=num_ecran+num_ec;
	if (num_ecran>=2) {num_ecran=1;}
	if (num_ecran<0) {num_ecran=0;}
	console.log(num_ecran);
	
	
if (num_ecran==0) {url_ec="http://192.168.1.7/monitor/include/ph-redox0_svg.php";
				  }							
 if (num_ecran==1) {url_ec="http://192.168.1.7/monitor/include/ph-redox1_svg.php";
				  }
console.log("ec="+url_ec);	
 $.ajax({
	type: "GET",
    url: "ajax.php",
    data: "app=ecran_spa&variable="+url_ec,
    success: function(data){$("#ecran1").empty();
			$("#ecran1").html(data);maj_dev(<?php echo NUMPLAN;?>);
			}				
});
	console.log("num_ecran="+num_ecran+"  "+valph);
	
}	
function maj_dev(plan){
$.ajax({
    type: "GET",
    dataType: "json",
    url: "ajax.php",
    data: "app=devices_plan&variable="+plan,
    success: function(response){pp=response;var al_bat="";
		$.each( pp, function( key, val ) {
		
		
			
			
			
					
			if ((val.ID1)&&(val.ID1!="#")){if (document.getElementById(val.ID1)) {
				if (val.maj_js=="temp" || val.maj_js=="data") document.getElementById(val.ID1).innerHTML=val.Data;pos=val.Data;
				}
					
			else if (val.idm!="NULL"){document.getElementById('erreur').innerHTML ="erreur ID1_html   BD  idx="+val.idx +" nom:"+val.Name;}
		
		
					
}});
}
});}
</script>
		

			

