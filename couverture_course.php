 <!--- Couverture
	//$chemin= 'courses/'.$_GET['nom_course'].$_GET["annee_course"]."/info/images/couverture.jpg";
	//if (file_exists($chemin)) {
	//	echo '<img src="'.$chemin.'" alt=""  WIDTH=100% /></a>'; 
// }
 --->


 <!--- Couverture --->
	<?php
	$chemin= 'courses/'.$NOM_COURSE.$ANNEE_COURSE."/info/images/couverture.jpg";
	if (file_exists($chemin)) {
		echo '<img src="'.$chemin.'" alt=""  WIDTH=100% /></a>'; 
 }

 ?>
