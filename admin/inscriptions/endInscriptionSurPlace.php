<!DOCTYPE html>
<html>
<head>
<meta http-equiv="cache-control" content="no-cache"> <!-- tells browser not to cache -->
<meta http-equiv="expires" content="0"> <!-- says that the cache expires 'now' -->
<meta http-equiv="pragma" content="no-cache"> <!-- says not to use cached stuff, if there is any -->
	<title>Défi Chrono</title>
	<meta charset="utf-8">
	<metahttp-equiv = 'cache-control' content = 'no-cache'>
<metahttp-equiv = 'expires' content = '0'>
<metahttp-equiv = 'pragma' content = 'no-cache'>
	<meta name="viewport" content="width=device-width, maximum-scale=1.0, user-scalable=yes">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css">
	<link rel="stylesheet" title="defaut" media="screen" href="../../styleV6.css" type="text/css"/>
<!--	<link rel="stylesheet" type="text/css" media="screen and (max-width: 480px)" href="style-mobilV2.css" /> -->
<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js">
	 </script>
<script src="../../js/prototype.js" ></script>
<script src="../../js/FonctionDefiChrono2.js?v=1"></script>
<script>
function chargement()
{
    secondes=5;
   // setTimeout(redirect,secondes*1000);
  //  change_valeur();
  //  timer=setInterval(change_valeur, 1000);
 
}
 
function redirect()
{
    window.location='../../';
}
 
function change_valeur()
{
    if(secondes>1)
    {
        document.getElementById('compteur').innerHTML=secondes + ' secondes';
    }
     
    else if(secondes>=0)
    {
        document.getElementById('compteur').innerHTML=secondes + ' seconde';   
    }
     
    else
    {
        clearTimeout(timer);   
    }
    secondes--;
}

function AddNewInscriptionWithoutSameAdresse()
{
	TableCoureur = document.getElementById("LastAdresse");
	TableCoureur.value = "False";
	f1 = document.getElementById("ValueCourse");
	f1.submit();
}

function Informations()
{
	f1 = document.getElementById("ValueCourse");
	f1.action="../../informations2023.php";
	f1.submit();
}
</script>
</head>
    <body onload="chargement();">
	<?php
	  include("Header.php");
 
	  ?>

<div id="corps">
		<h2> <i class="fa fa-check-circle" style="color:LightGreen; font-size:48px;" ></i> Maintenant vous pouvez aller à la caisse pour payer et récupérer votre dossard </h2>
        	 <!--- Couverture --->
<form method="get" action="formulaireInscriptionSurPlace.php" id="ValueCourse" name="ValueCourse" >
<!-- Tableau information de la course !-->

	<input type="hidden" name="idCoureur" id="idCoureur" />
	<input type="hidden" name="DateCourse" id="DateCourse"   value= '<?php echo $_GET['DateCourse'] ?>' />
	<input type="hidden" name="NomCourse" id="NomCourse"  value= '<?php echo $_GET["NomCourse"] ?>' />
	<input type="hidden" name="NumCat" id="NumCat" />
	<input type="hidden" name="NomCat" id="NomCat" />
	<input type="hidden" name="OnLine" id="OnLine" />
	<input type="hidden" name="Option" id="Option" />
	<input type="hidden" name="LastAdresse" id="LastAdresse" />
	<input type="hidden" name="Nbretape" id="Nbretape" value= '<?php echo  $_GET["NbrEtape"] ?>' />

	<Button class="ButtonResultat"  style="width: 30% ;Height : 80px ; font-size:24px; margin :20px; padding :20px;" onclick="AddNewInscriptionWithoutSameAdresse()">
	Nouvelle Inscription
		</Button>
		<Button class="ButtonResultat"  style="width: 30% ;Height : 80px ; font-size:24px; margin :20px; padding :20px;" onclick="Informations()">
		Informations événement
		</Button>

</form>
</div>
</body>
</html>