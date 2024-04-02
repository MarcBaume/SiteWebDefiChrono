<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="fr" lang="fr">
    <head>
        <title>liste</title>
        <meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
    <link rel="stylesheet" media="screen" type="text/css" title="Design" href="style.css" />

	</head>
	<script type="text/javascript">
	function quitter(){
		<?php

    $pdo_options[PDO::ATTR_ERRMODE] = PDO::ERRMODE_EXCEPTION;

	//$bdd =	new PDO('mysql:host=servermarc;port=3307;dbname=Chrono', 'root', ''); 
    // On récupère tout le contenu de la table jeux_video
  //  $reponse = $bdd->query('DROP DATABASE'.$_POST['nom']);
	
 //	$con = mysql_connect('mysql:host=servermarc;dbname=gsfranchesmontagnesch1', 'christopheJunker', 'er3z4aet', $pdo_options);
//	$query=mysql_query('DROP DATABASE'.$_POST['nom'],$con);
//	mysql_query($con);
  //  mysql_close($con);
	?>
	alert("Merci d'indiquer un numéro de téléphone pour vous contacter si besoin");}
	</script>
    <body onbeforeunload="quitter();">>
	
	<?php //création d'une base de donnée au nom de la course
//	$con = mysql_connect('mysql:host=mysql.gsfranches-montagnes.ch;dbname=gsfranchesmontagnesch1', 'christopheJunker', 'er3z4aet', $pdo_options);
$con = mysqli_connect('dxvv.myd.infomaniak.com', 'dxvv_christopheJ', 'er3z4aet1234');
if (!$con)
  {
  die('Could not connect: ' . mysql_error());
  }
/*
// Create database
if (mysqli_query($con,"CREATE DATABASE ".$_POST['nom']))
  {
  echo "Database created";
  }
else
  {
  echo "Error creating database: " .$_POST['nom']. mysqli_error();
  }

// Create table de donnée du nom de parcours
mysqli_select_db($con ,$_POST['nom'] );

$sql = "CREATE TABLE Informations
(
nom_course varchar(15),
Lieu varchar(15),
Emplacement varchar(15),
Organisateur varchar(15),
Coordonnee_organisateur varchar(15),
Telephone varchar(15),
email varchar(15),
Canton  varchar(10),
Date varchar(10)
)";
if (mysqli_query($con,$sql))
  {
  echo "Informations is created";
  }
else
  {
  echo "Error creating database: Informations" . mysql_error();
  }
// Execute query

$sql = "CREATE TABLE depart
(
ID int,
nom_categorie varchar(15),
debut_dossard int(7),
fin_dossard int(7),
debut_annee int(7),
fin_annee int(7),
sexe varchar(1),
heure_depart varchar(10),
Nombredepassage int(7),
Nom_passage1 varchar(10),
Nom_passage2 varchar(10),
Nom_passage3 varchar(10),
Nom_passage4 varchar(10),
Nom_passage5 varchar(10),
Nom_passage6 varchar(10)
)";

if (mysqli_query($con,$sql))
  {
  echo "Depart is created";
  }
else
  {
  echo "Error creating database: Depart " . mysql_error();
  }
$sql = "CREATE TABLE liste_depart
(
ID int(7),
Nom varchar(15),
Prenom varchar(15),
adresse varchar(15),
 npa varchar(15),
localite varchar(15),
Annee int(7),
sexe varchar(1),
club varchar(20),
Nombredepassage int,
Categorie varchar(10),
Mail varchar(10),
tel varchar(10),
parcours varchar(10),
Equipe varchar(10)
)";

// Execute query
if (mysqli_query($con,$sql))
  {
  echo "liste is created";
  }
else
  {
  echo "Error creating liste: " . mysql_error();
  }
echo 'nom'. $_POST['nom'];
*/
// Create table de donnée du nom de parcours
mysqli_select_db($con ,'dxvv_jurachrono' );

$date = DateTime::createFromFormat('d/m/Y', $_POST['date']);
echo 'sale';
echo $_POST['date'];
echo $date;
$sql = 'INSERT INTO Course (`Nom_Course`, `Lieu`, `Emplacement`, `Organisateur`,`Coordonnee`,`Telephone`,`Email`,`Canton`,`Date`,`Description`,`Site`,`nbr_etape`,`LieuEtape2`,`DateEtape2`,`LieuEtape3`,`DateEtape3`,`LieuEtape4`,`DateEtape4`,`LieuEtape5`,`DateEtape5`)
 VALUES
("'.$_POST['nom'].'", 
	"'.$_POST['lieu'].'",  
	"'.$_POST['emplacement'].'", 
	"'.$_POST['organisateur'].'", 
	"'.$_POST['contact'].'", 
	"'.$_POST['telephone'].'", 
	"'.$_POST['mail'].'", 
	"'.$_POST['canton'].'", 
	"'.$_POST['date'].'", 
	"'.$_POST['description'].'", 
	"'.$_POST['Site'].'", 
	"'.$_POST['etape'].'", 
	"'.$_POST['NomEtape2'].'", 
	"'.$_POST['DateEtape2'].'", 
	"'.$_POST['NomEtape3'].'", 
	"'.$_POST['DateEtape3'].'", 
	"'.$_POST['NomEtape4'].'", 
	"'.$_POST['DateEtape4'].'", 
	"'.$_POST['NomEtape5'].'", 
	"'.$_POST['DateEtape5'].'");';

if (mysqli_query($con,$sql))
  {
  echo "line insert info";
  }
else
  {
  echo "Error insert : Informations" . mysql_error();
  }  
mysqli_close($con);

$folder = $_POST['nom'].$_POST['year'];

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
// Ajout d'un dossier par étapes  2
if (intval($_POST['etape'])>1)
{
	if (!mkdir("courses/".$folder."/Etape2", 0777, true)) {
		die('Echec lors de la création des Etapes 2...');
	}
}
// Ajout d'un dossier par étapes 3
if (intval($_POST['etape'])>2)
{
	if (!mkdir("courses/".$folder."/Etape3", 0777, true)) {
		die('Echec lors de la création des Etapes 3...');
	}
}
// Ajout d'un dossier par étapes 4
if (intval($_POST['etape'])>3)
{
	if (!mkdir("courses/".$folder."/Etape4", 0777, true)) {
		die('Echec lors de la création des Etapes 4...');
	}
}
// Ajout d'un dossier par étapes 5
if (intval($_POST['etape'])>4)
{
	if (!mkdir("courses/".$folder."/Etape5", 0777, true)) {
		die('Echec lors de la création des Etapes 5..');
	}
}
}
?>

	
	
  <?php include("onglets.php"); ?>
<?php include("menu_vertical.php"); ?>
<?php include("menu_horizontal.php"); ?>
<div id="corps">
<ul id="step">
<fieldset>

<legend> étape 2 /les départs </legend>

<form method="post" action="<?php echo $_SERVER["PHP_SELF"]; ?>">
  <p><label for="Nom">Nom:</label> <input type="text" name="nom" id="nom" tabindex="20" /></p>
  <p><label for="Nom">Distance:</label> <input type="text" name="distance" id="distance" tabindex="24" /></p>
  <p><label for="nom">Informations:</label> <textarea name="information" id="information"tabindex="25" rows="4" cols="80"   ></textarea></p>
  <p><label for="photo">Carte du parcours:</label><input type="file"  name='image_1' /></p>
  <p><label for="photo">Profil de dénivellation:</label><input type="file"  name='image_2' /></p>
  <center>
  <input type="image" src="images/bouton_plus.png" title="previous" style="background-color:transparent"width="50" height="50">
  </center>
</form>

</fieldset>

</ul>
 <center>

<input type="image" src="images/bouton_previous.png" title="previous" style="background-color:transparent"width="50" height="50">
<input type="image" src="images/bouton_next.png" title="next" style="background-color:transparent"width="50" height="50">
</form>
</center>
</div>
   </body>
   </html>