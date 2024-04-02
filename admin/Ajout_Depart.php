<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="fr" lang="fr">
    <head>
        <title>liste</title>
        <meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
    <link rel="stylesheet" media="screen" type="text/css" title="Design" href="../style.css" />

	</head>
	<script type="text/javascript">
		function valider()
{

document.formulaire.submit();

}

</script>
</head>
<body onload="document.formulaire.submit();">

	<?php //création d'une base de donnée au nom de la course
$con = mysqli_connect('dxvv.myd.infomaniak.com', 'dxvv_christopheJ', 'er3z4aet1234');
if (!$con)
  {
  die('Could not connect: ' . mysql_error());
  }

mysqli_select_db($con ,'dxvv_jurachrono' );
$date = DateTime::createFromFormat('d/m/Y', $_POST['date']);


$sql = 'SELECT * FROM Course  WHERE Nom_course=\''.$_POST["nom"].'\'' ; 
$result = mysqli_query($con,$sql);

 if ($result && mysqli_num_rows($result) > 0) {
    // output data of each row
    while($val = mysqli_fetch_assoc($result)) {
    $nbr_etape = $val["nbr_etape"];
	}
}
if (mysqli_query($con,$sql))
  {
  echo "line insert info";
  }
else
  {
  echo "Error insert : Informations" . mysql_error();
  }  
mysqli_close($con);

$folder = $_POST['nom'].$_POST['year'].'/'.$_POST['nom_parcours'];
//ajout d'un dossier avec le nom de la course
if (!mkdir("courses/".$folder."/", 0777, true)) {
    die('Echec lors de la création des répertoires...');
}
else
{
// Ajout d'un dossier par étapes 
if (!mkdir("courses/".$folder."/Etape1", 0777, true)) {
    die('Echec lors de la création des Etapes 1...');
}
// Ajout d'un dossier par étapes 
if (!mkdir("courses/".$folder."/Etape1/Resultats", 0777, true)) {
    die('Echec lors de la création des Etapes 1 Resultats...');
}
// Ajout d'un dossier par étapes  2
if (intval($nbr_etape)>1)
{
	if (!mkdir("courses/".$folder."/Etape2", 0777, true)) {
		die('Echec lors de la création des Etapes 2...');
	}
	// Ajout d'un dossier par étapes 
if (!mkdir("courses/".$folder."/Etape2/Resultats", 0777, true)) {
    die('Echec lors de la création des Etapes 2 Resultats...');
}
}
// Ajout d'un dossier par étapes 3
if (intval($nbr_etape)>2)
{
	if (!mkdir("courses/".$folder."/Etape3", 0777, true)) {
		die('Echec lors de la création des Etapes 3...');
	}
		// Ajout d'un dossier par étapes 
	if (!mkdir("courses/".$folder."/Etape3/Resultats", 0777, true)) {
		die('Echec lors de la création des Etapes 3 Resultats...');
	}
}
// Ajout d'un dossier par étapes 4
if (intval($nbr_etape)>3)
{
	if (!mkdir("courses/".$folder."/Etape4", 0777, true)) {
		die('Echec lors de la création des Etapes 4...');
	}
			// Ajout d'un dossier par étapes 
	if (!mkdir("courses/".$folder."/Etape4/Resultats", 0777, true)) {
		die('Echec lors de la création des Etapes 4 Resultats...');
	}
}
// Ajout d'un dossier par étapes 5
if (intval($nbr_etape)>4)
{
	if (!mkdir("courses/".$folder."/Etape5", 0777, true)) {
		die('Echec lors de la création des Etapes 5..');
	}
			// Ajout d'un dossier par étapes 
	if (!mkdir("courses/".$folder."/Etape5/Resultats", 0777, true)) {
		die('Echec lors de la création des Etapes 5 Resultats...');
	}
}



}
?>
<form method="post" action="nouvel_course_step3.php"  name="formulaire">
<input type="hidden" name="nom" id="nom" tabindex="10"  size="60"  value= '<?php echo $_POST['nom'] ?>' />
<input type="hidden" name="nom_parcours" id="nom_parcours" tabindex="10"  size="60"  value= '<?php echo $_POST['nom_parcours'] ?>' />

</form>

   </body>
   </html>