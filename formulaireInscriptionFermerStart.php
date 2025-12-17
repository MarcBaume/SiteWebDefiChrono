<!DOCTYPE html>
<html>
<?php include("Header.php")?>


    <body>

	<?php
	  include("Header2023.php");
 
	  ?>
<div id="corps">
	<?php include("HeaderInfo2023.php"); ?>
	
 <h3>
	Inscription  <?php  echo $NOM_COURSE. ' ' . $ANNEE_COURSE ?> 
</h3>
<Fieldset>
<div id="formulaire">

les inscriptions pour cette course ne sont pas encore ouverte, elles ouvrent le           <?php echo  strftime('%A %d %B %Y ',strtotime($val ["DateStartInscription"]));?>

   </div>
   </fieldset>
    <?php include("sponsors.php"); ?>
    </body>
</html>
