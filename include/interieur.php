<!-- section interieur-->

  <div id="interieur" class="container">
    <div class="columns">
      <div class="column is-full">
        <h1 id="about_interieur" class="title has-text-centered">Dispositifs<span> installés<br>à l'intérieur</span></h1>
        <?php 
        $filePath = 'custom/php/new_maison_svg.php';
        if (file_exists($filePath)) {include ("custom/php/new_maison_svg.php");} 
        else {include ("include/new_maison_svg.php");}?>
        <div id="voltage"><?php include ("include/voltmetre_svg.php");?></div>
        <div id="bar_pression"><?php include ("include/chaudiere_svg.php");?></div>
        <div id="vanne_eau"><?php include ("include/vanne_eau_svg.php");?></div>
        <div id="th_ext_cuis"><?php include ("include/thermometre_svg.php");?></div>
        
      </div>
    </div>
    <div id="reset_erreur_interieur" href="#" >
      <svg version="1.1" id="reset_erreur" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="30px" y="30px"
         viewBox="0 0 16 16" xml:space="preserve">
        <circle onclick="document.getElementById('reset_erreur_interieur').style.display='none';document.getElementById('erreur_interieur').innerHTML ='';" fill="#007DC6" cx="7.7" cy="7.9" r="7.7"/>
        <path class="st1" d="M8,3C5.2,3,3,5.2,3,8s2.2,5,5,5s5-2.2,5-5c0-0.7-0.2-1.4-0.5-2.1c-0.1-0.3,0-0.5,0.3-0.7c0.2-0.1,0.5,0,0.6,0.2
          c1.4,3,0.1,6.6-2.9,8s-6.6,0.1-8-2.9s-0.1-6.6,2.9-8C6.3,2.2,7.1,2,8,2V3z"/>
        <path d="M8,4.5V0.5c0-0.1,0.1-0.2,0.3-0.2c0.1,0,0.1,0,0.2,0.1l2.4,2c0.1,0.1,0.1,0.3,0,0.4l-2.4,2c-0.1,0.1-0.3,0.1-0.4,0
          C8,4.6,8,4.5,8,4.5z"/>
      </svg>
    </div>
    <div id="erreur_interieur"></div>
    <div id="linky"><?php include ('linky_svg.php');?></div>
  </div>

<!-- fin section interieur-->

