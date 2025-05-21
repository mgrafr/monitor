<body>
	<!-- debut-navigation  -->
		<!-- menu  menu-alt.svg = hamburger pour choix de la pageà afficher-->
		
		<nav id="menu" style="max-width:1200px;" class="panel" role="navigation">
		<a href="#menu" class="menu-link"><img src="images/menu-alt.svg" width="30" alt=""/></a>
    	<ul class="nav navbar-nav navbar-right" style="color: #adafb1;">
									<li class="zz active"><a href="#header">Accueil</a></li> 
									<?php if (ON_MET==true) echo '<li class="zz"><a href="#meteo">Météo</a></li>';?>
									<li class="zz"><a href="#interieur">Intérieur</a></li>
									<?php if (ON_EXT==true) echo '<li class="zz"><a href="#exterieur">Extérieur</a></li>';?>
									<?php if (ON_ALARM==true) echo '<li class="zz"><a href="#alarmes">Alarmes</a></li>';?>
									<?php if (ON_GRAPH==true) echo '<li class="zz"><a href="#graphiques">Graphiques</a></li>';?>
									<?php if (ON_ONOFF==true) echo '<li class="zz"><a href="#murinter">Mur On/Off</a></li>';?>
									<?php if (ON_ZIGBEE==true) echo '<li class="zz"><a href="#zigbee">Zigbee2mqtt</a></li>';?>
									<?php if (ON_ZWAVE==true) echo '<li class="zz"><a href="#zwave">Zwavejs2mqtt</a></li>';?>
									<?php if (ON_MUR==true) echo '<li class="zz"><a href="#murcam">Mur cameras</a></li>';?>
									<?php if (ON_DVR==true) echo '<li class="zz"><a href="#dvr">Mur DVR</a></li>';?>
									<?php if (ON_NAGIOS==true) echo '<li class="zz"><a href="#nagios">Monitoring</a></li>';?>
									<?php if (ON_APP==true) echo '<li class="zz"><a href="#app_diverses">App</a></li>';?>
									<?php if (ON_SPA==true) echo '<li class="zz"><a href="#spa">SPA</a></li>';?>
									<?php if (ON_RECETTES==true) echo '<li class="zz"><a href="#recettes">Recettes Cuisine</a></li>';?>
									<?php if (ON_HABRIDGE==true) echo '<li class="zz"><a href="#habridge">Pont HUE</a></li>';?>
									<?php if (URLIOB[2]==true) echo '<li class="zz"><a href="#iobroker">Io.broker</a></li>';?>
									<li class="zz"><a href="#modes_emploi">Modes d'emploi</a></li>
									<li class="zz"><a href="#admin">Administration</a></li>
			 						<li class="zz"><a href="#worx">Robot Worx</a></li> 
									<?php
									/*zz la class pour le script js menu_link*/
									/* pour ajouter une page la mettre au dessus de ces commentaires*/
									$test=$_SESSION["exeption_db"];
									?>
		</ul></nav>

    <!-- header start -->
		<!-- ================ --> 
		<header id="header" class="header ">
		<!-- logo -->
		<div class="logo"><img src="<?php echo IMGLOGO;?>" width="141" height="114" alt=""/></div>
		<!-- nom et slogan -->
		<div class="site-nom">
		<div class="site-nom"><?php echo NOMSITE;?></div>
		<div class="site-slogan"><?php echo NOMSLOGAN;?></div>
		<?php echo '<p style="font-size: 21px;color:black">'.$test.'</p>';?></div>
<!-- debut affichage date -->							
<div  class="text-center fond_date">
<p style="margin:4px 0 0 0" id="jj">jj</p>
<p style="margin: 10px 0 0 0;" id="numero">numero</p>
<p style="margin:0 0 0 0" id="mm">mm</p></div>
<!-- scrip date -->	
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
/*console.log('date:'+num_jour);*/
</script>
<!-- fin date -->
<!-- affichage d' un lexique : optionnel -->
<div class="aff_dim_ecran" width="50"><svg version="1.1" id="info" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px"
	 viewBox="0 0 1417.3 1417.3" xml:space="preserve"><a href="#header" data-toggle="modal" data-target="#lexique">
<style
   type="text/css"
   id="style879">
	.at0{fill:#339967;;}
	.at1{opacity:0.2;fill:#FBAE17;;}</style> 
<path  class="at0" d="M708.7,73C357.6,73,73,357.6,73,708.7c0,351.1,284.6,635.7,635.7,635.7c351.1,0,635.7-284.6,635.7-635.7
	C1344.3,357.6,1059.7,73,708.7,73z M708.7,1236.8c-291.7,0-528.1-236.4-528.1-528.1c0-291.7,236.4-528.1,528.1-528.1
	c291.7,0,528.1,236.4,528.1,528.1C1236.8,1000.3,1000.3,1236.8,708.7,1236.8z"/>
<path class="at0" d="M584.6,618.4l8.3-23.6l194.2-30.9h42.3l-128.3,453.8c0,0-7.6,25.2,6,35.2c25.4,18.8,94.1-84.9,94.1-84.9
	l17.9,11.7c0,0-64.7,91.2-99.5,119.7c-32.6,26.6-83.7,49.4-134.9,25.9C520.8,1096.2,552,1004,552,1004l94.5-322.8
	c0,0,8.2-26.6-3.4-46.2c-9.1-15.3-35.5-15.4-35.5-15.4L584.6,618.4z"/>
<circle id="lex" class="at0" cx="794.7" cy="374.2" r="87"/>
<ellipse class="at1" cx="713" cy="716" rx="580" ry="590"/></a>
</svg></div>						
				</header>
<?php
if (LEXIQUE==true) include("lexique.php");
else include("lexique_no.php");
?>				
				
				<!-- header end -->