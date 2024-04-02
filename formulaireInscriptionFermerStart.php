<!DOCTYPE html>
<html>
<head>
	<meta property="og:description" content="chronométrage, chrono, jura, franches-montagnes, Jura défi, course à pied, Sport, Jura défi chrono" />  
	<title>Défi Chrono</title>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, maximum-scale=1.0, user-scalable=yes">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css">
	<link rel="stylesheet" title="defaut" media="screen" href="styleV6.css" type="text/css"/>
<!--	<link rel="stylesheet" type="text/css" media="screen and (max-width: 480px)" href="style-mobilV2.css" /> -->
<script src="/js/prototype.js" >

</script>

</head>
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
