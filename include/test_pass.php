<?php
session_start();
			if (!$_SESSION["pec"])$_SESSION["pec"]="";
			if ($_SESSION["pec"]=="admin") {$id_pec="d_btn_aa";$id_button="btn_aa";}
			else {$id_pec="d_btn_a";$id_button="btn_a";}
		 	  if (isset($_SESSION['time'])) {$tt=$_SESSION['time'];}
			  else {$tt=0;echo "<p id='mp1' style='float:left;'>entrer mot de passe - </p>";}
			  if (isset($_SESSION['passworda']) && (($_SESSION['passworda']) != PWDALARM)){$tt=0;echo "mot de passe non valide - ";}
			  else {echo "<script>text1='pwd:ok';</script>";$style1="block";}
			  if ($tt<time()) {$tt=0;echo "<p id='mp2' >temps pwd dépassé - </p><script>text1='pwd:renouveler';</script>";}
   			  if ($tt==0){	
				  echo '<div id='.$id_pec.'"><button type="button" id="'.$id_button.'" style="background-color: #4d4d4d;
border-color: #e0e3e6;border-radius: 0.55rem" class="btn btn-primary"  data-toggle="modal" data-target="#pwdalarm">
    					Entrer votre mot de passe
  						</button></div>';} 
										?>