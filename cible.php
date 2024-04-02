<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="fr" >
   <head>
       <title>GSFM</title>
       <meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
	     <meta name="viewport" content="width=device-width, maximum-scale=1.0, user-scalable=yes">
	       <link rel="stylesheet" media="screen" type="text/css" title="style" href="style.css" />

     <link rel="stylesheet" title="defaut" media="screen" href="style.css" type="text/css"/>
     <link rel="stylesheet" type="text/css" media="screen and (max-width: 480px)" href="style-mobil.css" />
 </head>
<script type="text/javascript">

function checkForm(f) {
	f.submit();
	
}


</script>
</head>
<!-- End Preload Script -->
   <body>
   
  <?php include("onglets.php"); ?>
  	
	<div id="corps">
	<?php include("menu_vertical.php"); ?>
<?php 
$numetape = intval($_POST['etape']);


		$pathFile = 'courses/'.$_POST['nom_course'].$ANNEE_COURSE.'/'.$_POST['nom_parcours'].'/'.$Nom_depart.'/liste.csv';


if (strlen($_POST['prenom']) > 0 ) 
{
$nom=ucwords(strtolower($_POST['nom']));
$localite= ucwords( strtolower($_POST['ville']));

// 1 : on ouvre le fichier
//$monfichier = fopen($pathFile, 'w+');
 $ligne = ';'.$nom.';'. $_POST['prenom'].';'. $_POST['adresse'].';'. $_POST['zip'].';'.$localite.';'.$_POST['date'].';'.$_POST['sexe'].';'.$_POST['club'].';'. $Num_cat .';'.$_POST['email']."\n";
// 2 : on lit la première ligne du fichier
$ligne1 =  file_put_contents($pathFile, $ligne,FILE_APPEND);

// 3 : quand on a fini de l'utiliser, on ferme le fichier
//fclose($monfichier);
}


    // On se connecte à MySQL
 $con = mysqli_connect('dxvv.myd.infomaniak.com', 'dxvv_christopheJ', 'er3z4aet1234');
if (!$con)
  {
  die('Could not connect: ' . mysql_error());
  }
  else
  {
  
  mysqli_select_db($con ,'dxvv_jurachrono' );
}
  
//ajout inscription
try
{
if (strlen($_POST['prenom']) > 0 ) 
{
$nom=ucwords(strtolower($_POST['nom']));
$localite= ucwords( strtolower($_POST['ville']));
// Affichage de l'étape choisi 

// Nom Départ  
$num_depart =  strpos($_POST["nom_depart"], ';');
$Nom_depart = substr($_POST["nom_depart"],0, $num_depart);  // retourne "cde"

// Numéro de la catégorie 
  $str_tampon = substr($_POST["nom_depart"], $num_depart+1, strlen($_POST["nom_depart"]) );
  $num_depart =  strpos($str_tampon , ';');
  $Num_cat = substr($str_tampon,0, $num_depart);
 
 $str_tampon = substr($str_tampon, $num_depart+1, strlen($str_tampon) );
// Nom  de la catégorie 
$Nom_cat = $str_tampon;  // retourne "cde"

$sql = 'INSERT INTO inscription (`Nom`, `Prenom`, `adresse`,`npa`,`localite`,`DateNaissance`,`sexe`,`club`, `NumCategorie`,`mail`,`parcours`,`course`,`NomDepart`,`NomCategorie`,`NomEquipe`,`NomDisc2`, `PrenomDisc2`,`NomDisc3`, `PrenomDisc3`,`NomDisc4`, `PrenomDisc4`,`NomDisc5`, `PrenomDisc5`, `NomDisc6`, `PrenomDisc6`,`NbrEtape`,`Remarques`)
 VALUES
	("'.$nom.'", 
	"'.$_POST['prenom'].'",
	"'.$_POST['adresse'].'", 
	"'.$_POST['zip'].'", 	
	"'.$localite.'", 
	"'.$_POST['date'].'",
	"'.$_POST['sexe'].'",	
	"'.$_POST['club'].'", 
	"'.$Num_cat.'",
	"'.$_POST['email'].'", 
	"'.$_POST['nom_parcours'].'", 
	"'.$_POST['nom_course'].$ANNEE_COURSE.'",
	"'.$Nom_depart.'",
	"'.$Nom_cat.'",
	"'.$_POST['NomEquipe'].'",
	"'.$_POST['NomDisc2'].'",
	"'.$_POST['PrenomDisc2'].'",
	"'.$_POST['NomDisc3'].'",
	"'.$_POST['PrenomDisc3'].'",
	"'.$_POST['NomDisc4'].'",
	"'.$_POST['PrenomDisc4'].'",
	"'.$_POST['NomDisc5'].'",
	"'.$_POST['PrenomDisc5'].'",
	"'.$_POST['NomDisc6'].'",
	"'.$_POST['PrenomDisc6'].'",
	"'.$_POST['nbrEtape'].'",
	"'.$_POST['Remarques'].'");';

	if (mysqli_query($con,$sql))
  {
;
  }
else
  {
  echo "Error insert : Informations" . mysql_error();
  }  
mysqli_close($con);

	
     mail('inscription@juradefichrono.ch', "inscription".$post['ID'], 	$_POST['nom']."\n".$_POST['prenom']."\n"
	 .$_POST['date']."\n".$_POST['email']."\n".$_POST['adresse']."\n". $_POST['zip']."\n". $_POST['ville']."\n".$_POST['tel']."\n".$_POST['sexe']."\n".$_POST['remarque'] );


     mail($_POST['email'], 'Confirmation site web', "Bonjour ".$_POST['prenom']." ".$_POST['nom'] .","."\n".
	 "Votre inscription est enregistrée, le Jura défi Chrono vous souhaite une bonne Course ".$_POST['nom_course'].  
	 "\n"."Vous pouvez consulter votre inscription sur notre site internet dans la liste des athlètes" );
$DATE = $ANNEE_COURSE;
$NOM_COURSE = $_POST["nom_course"];
$Nbr_etape =  $_POST["Nbretape"] ;
	 ?> 

</br>
</br>

Votre inscription a été validée, veuillez vérifier si votre nom est inscrit. </br>
dans la liste des athlètes inscrits si il ne se trouve pas dans l'heure qui suis, envoyez un mail à l'adresse suivante: marcbaume12@gmail.com
</br>
</br>
<?php
}
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



