<!DOCTYPE html>
<html>

<head>
	<meta property="og:description" content="chronométrage, chrono, jura, franches-montagnes, Jura défi, course à pied, Sport, Jura défi chrono" />  
	<title>Défi Chrono</title>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, maximum-scale=1.0, user-scalable=yes">
	<metahttp-equiv = 'cache-control' content = 'no-cache'>
<metahttp-equiv = 'expires' content = '0'>
<metahttp-equiv = 'pragma' content = 'no-cache'>
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css">
	<link rel="stylesheet" title="defaut" media="screen" href="styleV6.css" type="text/css"/>
	<!-- Import Leaflet CSS Style Sheet -->
<link rel="stylesheet" href="https://unpkg.com/leaflet@1.0.3/dist/leaflet.css" />
<!-- Import Leaflet JS Library -->
<script src="https://unpkg.com/leaflet@1.0.3/dist/leaflet.js"></script>
<script src="../js/prototype.js" ></script>
<script src="../js/FonctionDefiChrono2.js?version = 1.0.0"></script>
<script>
	function ColorMenuParcours()
{
	for (var i = 0; i < ArrayParcours.length; i++) 
	{
		// Obtenir la position de chaque element 
		var mon_element = document.getElementById(ArrayParcours[i].nom);
		// Si dernière position du tableau on regarde quand cette valeur
		if (i == ArrayParcours.length-1)
		{
		
			if ( document.documentElement.scrollTop >= ArrayParcours[i].PositionTop ) {
				mon_element.classList.add("nav-colored");
				mon_element.classList.remove("nav-transparent");
			} 
			else {
				mon_element.classList.add("nav-transparent");
				mon_element.classList.remove("nav-colored");
			}
		}
		else // Couleur seulement le menu afficher le menu au dessus ne s'affiche plus en couleur
		{
			if ( document.documentElement.scrollTop >= ArrayParcours[i].PositionTop &&   document.documentElement.scrollTop < ArrayParcours[i+1].PositionTop) {
				mon_element.classList.add("nav-colored");
				mon_element.classList.remove("nav-transparent");
			} 
			else {
				mon_element.classList.add("nav-transparent");
				mon_element.classList.remove("nav-colored");
			}
		}
   }
}


</script>
<!--	<link rel="stylesheet" type="text/css" media="screen and (max-width: 480px)" href="style-mobilV2.css" /> -->
<style>


	</style>
</head>
<?php 
setlocale (LC_TIME, 'fr_FR.utf8','fra');?>

    <body >
<div id="Top1"></div>
        <a href="#Top1" id="GoToTop" class="GoToTop" style ="visibility :hidden ;z-index:3000;" >
    <i class="fa fa-arrow-up" style= "font-size: 50px;margin:2px;"></i>
</a>
	<?php
	  include("Header2023.php"); 
	  ?>

<?
	  include("HeaderInfo2023.php"); 
	  ?>


<center>

   <h3>
Inscriptions en ligne fermées </br></br> il est toujours possible de s'inscrire sur place 1 heure avant le départ
   </h3>
   <Fieldset>
 
   </br>
   Bonne course </br>
   
   </fieldset>
   </div>
    <?php
	
if ($NOM_COURSE =='Course des Quais  - Société de Gymnastique de Grandson' && $ANNEE_COURSE == 2024 )
	{
		header('Location: https://juradefichrono.ch/formulaire2023.php?NbrEtape=1&DateCourse=2025-07-04&Etape=1&NomCourse=Course+des+Quais++-+Soci%C3%A9t%C3%A9+de+Gymnastique+de+Grandson&ID=141'); 
	
	}
	
	include("sponsors.php"); ?>
    </body>
</html>

