<!DOCTYPE html>
<html>
<head>
	<meta property="og:description" content="chronométrage, chrono, jura, franches-montagnes, Jura défi, course à pied, Sport, Jura défi chrono" />  
	<title>Défi Chrono</title>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, maximum-scale=1.0, user-scalable=yes">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css">
	<link rel="stylesheet" title="defaut" media="screen" href="../styleV2.css" type="text/css"/>
<!--	<link rel="stylesheet" type="text/css" media="screen and (max-width: 480px)" href="style-mobilV2.css" /> -->
</head>

    <body>

<?php
  include("HeaderAdmin.php"); 
  ?>
</br>
<?	include("MenuMember.php"); ?>
    <body >
<div id="corps">
	<?php
	include("../MysqlConnect.php");
//ajout inscription
try
{

// Affichage de l'étape choisi 
$Status = "Validation en cours";
$sql = 'INSERT INTO TempsJuraDefi2021 (`Discipline`,`Commentaire`, `NomEquipe`, `IDEquipe`, `Chrono`,`Status`,`Login`,`Link`)
 VALUES
	("'.$_POST['Discipline'].'", 
	"'.$_POST['Commentaire'].'", 
	"'.$_POST['NomEquipe'].'", 
	"'.$_POST['IDEquipe'].'", 	
	"'.$_POST['Temps'].'", 
	"'.$Status.'",
	"'.$_POST['LoginCompte'].'", 
	"'.$_POST['Link'].'");';

	if (mysqli_query($con,$sql))
  {
;
  }
else
  {
  echo "Error insert : Informations" . mysql_error();
  }  
mysqli_close($con);

     mail('inscription@juradefichrono.ch;', 'Confirmation ajout chronométrage Jura Défi 2021', "Bonjour ".$_POST['NomEquipe'] .","."\n".
	 "Merci d'avoir saisie votre chronomètre, celui-ci sera valider par administrateur aussi vite que possible".  "\n". "\n".
	 "Disicpline : ". $_POST['Discipline']. "\n".
	 "Temps : ". $_POST['Temps']. "\n".
	 "Liens activité : ". $_POST['Link']. "\n".
	 "\n"."Vous pouvez consulter le status de votre chronométrage sur votre liste de résultat dans votre profil" ."\n"."\n".
	"Le Comité de Jura défi");

     mail($_POST['email'], 'Confirmation ajout chronométrage Jura Défi 2021', "Bonjour ".$_POST['NomEquipe'] .","."\n".
	 "Merci d'avoir saisie votre chronomètre, celui-ci sera valider par administrateur aussi vite que possible".  "\n". "\n".
	 "Disicpline : ". $_POST['Discipline']. "\n".
	 "Temps : ". $_POST['Temps']. "\n".
	 "Liens activité : ". $_POST['Link']. "\n".
	 "\n"."Vous pouvez consulter le status de votre chronométrage sur votre liste de résultat dans votre profil" ."\n"."\n".
	"Le Comité de Jura défi");
	 ?> 

</br>
</br>

Votre Résultat a été ajouté dans la liste des résultat a validé. </br>


</br>
<?php
}
catch(Exception $e)
{
    die('Erreur : '.$e->getMessage());
}
?>

</br>


</div>
</body>
</html>



