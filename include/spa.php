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
	function next_ecran(num_ec){
num_ecran=num_ecran+num_ec;
	if (num_ecran>2) {num_ecran=1;}
	if (num_ecran<0) {num_ecran=0;}
	console.log(num_ec);
	
	
if (num_ecran==0) {url_ec="http://192.168.1.7/monitor/include/ph-redox_svg.php";
				 
				  }							
 if (num_ecran==1) {url_ec="http://192.168.1.7/monitor/include/ph-redox1_svg.php";
				  valph=document.getElementById("ph").innerHTML;
				 valorp=document.getElementById("orp").innerHTML;
				 valtemp1spa=document.getElementById("temp_eau").innerHTML;
				  valtemp2spa=document.getElementById("temp_air").innerHTML;
					valm3=document.getElementById("debit").innerHTML; }
console.log("ec="+url_ec);	
 $.ajax({
	type: "GET",
    url: "ajax.php",
    data: "app=ecran_spa&variable="+url_ec,
    success: function(data){$("#ecran1").empty();
			if (num_ecran==0) {data = data.split("ph").join(valph);data = data.split("orp").join(valorp);
							   data = data.split("temp1spa").join(valtemp1spa);
							   data = data.split("temp2spa").join(valtemp2spa);
							   data = data.split("m3/h").join(valm3);}				
			$("#ecran1").html(data);
			}				
});
	console.log("num_ecran="+num_ecran+"  "+valph);
	
}	

</script>
		

			

