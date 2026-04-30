<body>
	
    <!-- header start -->
		<!-- ================ --> 
		<header id="header" class="header hero is-primary" >
         <!-- debut-navigation  -->
	<button popovertarget="mobile-navigation" popovertargetaction="show" class="menu-h"><img src="images/menu-alt.svg" style="width:30px;position:fixed" alt="menu"/></button>
	<nav popover id="mobile-navigation" style="font-size: large;background-color:black;">
	<button  popovertarget="mobile-navigation" popovertargetaction="hide"></button>	
        <button  popovertarget="mobile-navigation" style="color:white" id="mobile-menu">X</button>
		<ul id="zz">
			<li class="is-active"><a href="#header" >Accueil</a>
			<?php if (ON_MET==true) echo '<a href="#meteo">Météo</a></li>';?>
			<li><a href="#interieur">Intérieur</a></li>
			<?php if (ON_EXT==true) echo '<li><a href="#exterieur">Extérieur</a>';?>
									<a href="#alarmes" >Alarmes</a></li>
									<?php if (ON_GRAPH==true) echo '<li><a href="#graphiques">Graphiques</a>';?>
									<?php if (ON_ONOFF==true) echo '<a href="#murinter">Mur On/Off</a></li>';?>
									<?php if (ON_ZIGBEE==true) echo '<li><a href="#zigbee">Zigbee2mqtt</a>';?>
									<?php if (ON_ZWAVE==true) echo '<a href="#zwave">Zwavejs2mqtt</a></li>';?>
									<?php if (ON_MUR==true) echo '<li><a href="#murcam">Mur cameras</a></li>';?>
									<?php if (ON_DVR==true) echo '<li><a href="#dvr">Mur DVR</a></li>';?>
									<?php if (ON_NAGIOS==true) echo '<li><a href="#nagios">Monitoring</a>';?>
									<?php if (ON_APP==true) echo '<a href="#app_diverses">App</a></li>';?>
									<?php if (ON_SPA==true) echo '<li><a href="#spa">SPA</a>';?>
									<?php if (ON_RECETTES==true) echo '<a href="#recettes">Recettes Cuisine</a></li>';?>
									<?php if (ON_HABRIDGE==true) echo '<li><a href="#habridge">Pont HUE</a></li>';?>
									<?php if (URLIOB[2]==true)  echo '<li><a href="#iobroker">Io.broker</a></li>';?>
									<li><a href="#modes_emploi">Modes d'emploi </a></li><li><a href="#administration">Administration</a></li>
			 						<li><a href="#worx">Robot Worx</a></li> 
									<?php
									/* pour ajouter une page la mettre au dessus de ces commentaires*/
									$test=$_SESSION["exeption_db"];
									?>
		</ul></nav>   
    
        <div class="columns is-mobile">
            <div class="column">
                    <figure class="logo">
                        <img src="<?php echo IMGLOGO;?>" style="width:141px;height:auto" alt="">
                    </figure>
                
                    <h1 class="title"><?php echo NOMSITE;?></h1>
                    <h2 class="subtitle"><?php echo NOMSLOGAN;?></h2>
                    <?php echo '<p style="font-size: 21px;color:black">'.$test.'</p>';?>
                </div>
        
<!-- debut affichage date -->							
<div  class="text-center fond_date">
<p style="margin:4px 0 0 0" id="jj">jj</p>
<p style="margin: 10px 0 0 0;" id="numero">numero</p>
<p style="margin:0 0 0 0" id="mm">mm</p></div>
</div>
    <script type="text/javascript">
        aff_date();
        function aff_date() {
            var now=new Date();
            var days=new Array('Dimanche','Lundi','Mardi','Mercredi','Jeudi','Vendredi','Samedi');
            var months=new Array('Janvier','Février','Mars','Avril','Mai','Juin','Juillet','Aout','Septembre','Octobre','Novembre','Décembre');
            var date=((now.getDate()<10)?"0":"")+now.getDate();num_jour=date;
            var year=(now.getYear()<1000)?now.getYear()+1900:now.getYear();today=days[now.getDay()]+","+date+" "+months[now.getMonth()]+","+year;
            var numero=document.getElementById('numero');numero.innerHTML=date;
            var jj=document.getElementById('jj');jj.innerHTML=days[now.getDay()];
            var mm=document.getElementById('mm');mm.innerHTML=months[now.getMonth()];}
        jour=today;
        
    </script>
   
</header>			
<!-- header end -->
