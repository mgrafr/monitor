<?php
session_start();
echo '<script>text1="";</script>';
			  if (isset($_SESSION['time'])) {$tt=$_SESSION['time'];}
			  else {$tt=0;echo "<p id='mp1' style='float:left;'>entrer mot de passe - </p>";}
			  if (isset($_SESSION['passworda']) && (($_SESSION['passworda']) != PWDALARM)){$tt=0;echo "mot de passe non valide - ";}
			  else {echo "<script>text1='pwd:ok';document.getElementById('info_admin').innerHTML='';</script>";$style1="block";}
			  if ($tt<time()) {$tt=0;echo "<p id='mp2' >temps pwd dépassé - </p>";}
   			  if ($tt==0){
				  echo "<script>text1='pwd:absent';document.getElementById('d_btn_a').style.display = 'block';document.getElementById('d_btn_al').style.display = 'block';
			  </script>";}
				  echo "<script>
				document.getElementById('tspan7024').innerHTML=jour;
				document.getElementById('console1').innerHTML=text1;
				document.getElementById('not').innerHTML='';
							  </script>";
										?>