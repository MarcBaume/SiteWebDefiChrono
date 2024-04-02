 <!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="fr" >

<?php include("head.php"); ?>
   <body>
        		
<?php include("en_tete.php"); ?> 
<?php include("menu_vertical.php"); ?>

<!---  ***************************** Affichage des catégorie  *************************** ------->

<script>
var ArrayCoureurs = [];
var ArrayParcours = [];
var ICounterCoureurs = 0;
</script>

		<!--- Liste des parcours !---->
		<?php
		$DateCourse =  date_parse("2021-06-18");
		$NOM_COURSE = 'Course des Franches';
		$ANNEE_COURSE = '2021';
		// Afficher la liste des Parcours  Dossier dans la course ;
		$pathfolder = 'defichrono/courses/'.$NOM_COURSE.$ANNEE_COURSE;

 ?>
     
<Div id="corps">


	<?php include("news2.php"); ?> 
	 	<Div id="main">



<i></i>
</center>

</fieldset>
<p class="titleCenter">MERCI !!!! Pour cette magnifique édition 2021</p>
<fieldset>

<p style="fontsize:36px">
Par ici vous trouverez notre gallerie photo </br></p>
<center>
<a href="https://photos.app.goo.gl/Vn7uG6s8bwwXAae96"><img  width=50%  src="images/CF21.jpg"  alt="" title="Cliquez pour atteindre plus de photo" ></img></a>
</br>
<a style="font-size:24px" href="https://photos.app.goo.gl/Vn7uG6s8bwwXAae96" target="_blank">---> Pour voir les photos Cliquez ici <--</a> </br> 
	
</center>
</fieldset>






<Div id="Javascript">

</Div >
 <p class="titleCenter">Résultats des éditions précédentes</p>
<fieldset>
<p >
	<li ><a style="font-size:36px" href="https://www.juradefichrono.ch/ResultatV3.php?NbrEtape=1&DateCourse=2021-06-18&Etape=0&NomCourse=Course+des+Franches&ID=73" target="_blank">2021</a></li> </br> 
	<li ><a style="font-size:36px" href="https://www.juradefichrono.ch/ResultatV3.php?NbrEtape=1&DateCourse=2019-06-28&Etape=0&NomCourse=Course+des+Franches&ID=48" target="_blank">2019</a></li> </br> 
	<li ><a style="font-size:36px" href="https://www.juradefichrono.ch/ResultatV3.php?NbrEtape=1&DateCourse=2018-06-08&Etape=0&NomCourse=Course+des+Franches&ID=39" target="_blank">2018</a></li> </br> 
    <li ><a style="font-size:36px" href="https://www.juradefichrono.ch/ResultatV3.php?NbrEtape=1&DateCourse=2017-06-09&Etape=0&NomCourse=Course+des+Franches&ID=9" target="_blank">2017</a></li> </br> 
</p>
</fieldset>
<p  class="titleCenter">Presse </p>
<fieldset>
Merci au Franc-Montagnard pour ce bel article </br>
<center>
<a href="pdf/FrancCF19.pdf" class="lightbox"><img src="images/imageArticle.jpg"  alt="" title="Cliquez pour agrandir" ></img></a>
</center>
  <li><a href="pdf/FrancCF19.pdf"target=_blank>article en pdf</a></li> </br>
</fieldset>

<center>
<img src="images/cimagine.jpg" width=50% alt="" title="Cliquez pour agrandir" ></img>

 <?php include ("sponsors.php"); ?>
 </center>
 </div>
<?php include ("footer.php"); ?>

</div>
</body>
</html>

