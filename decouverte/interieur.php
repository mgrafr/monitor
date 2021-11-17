<!-- section intérieur start -->
<!-- ================ -->
<div id="interieur" >
	<div class="container">
		<div class="col-md-12">
	  <h1 id="about" class="title text-center">Dispositifs<span> installés<br>à l'intérieur</span></h1><br><p>DEMO</p>
		<div class="space"></div>
<?php include ("include/maison_svg.php");echo '<p id="decouv_int"> Cette page est une page de démonstration , pour utiliser le mode normal , dans /admin/config passer la variable DECOUVERTE sur false<br>
		 pour créer ou modifier le plan : utliser Inkscape ou Adobe AI<br>Lien de l\'image dans la page normale :/include/maison_svg.svg<br>Voir le site <a href="http://domo-site.fr/accueil/dossiers/27" >domo-site.fr</a></p>';

		 echo '<div id="voltage">';
		 // décommenter cette ligne pour l'affichage du voltmètre
		 include ("include/voltmetre_svg.php");
		 echo '</div>';
		 ?>

</div>
	</div><p id="erreur_interieur" ></p>
		</div>
<!-- section interieur fin-->
