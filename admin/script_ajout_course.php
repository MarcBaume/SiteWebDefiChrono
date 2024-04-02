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

$sql = 'INSERT INTO Course (`Nom_Course`, `Lieu`, `Emplacement`, `Organisateur`,`Coordonnee`,`Telephone`,`Email`,`Canton`,`Date`,`Description`,`Site`,`nbr_etape`,`LieuEtape2`,`DateEtape2`,`LieuEtape3`,`DateEtape3`,`LieuEtape4`,`DateEtape4`,`LieuEtape5`,`DateEtape5`,`Login` )
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
	"'.$_POST['DateEtape5'].'",
	"'.$_POST['login'].'");';

if (mysqli_query($con,$sql))
  {
  echo "line insert info";
  }
else
  {
	
  echo "Error insert : Informations" . mysql_error();
  }  
mysqli_close($con);

$date = date_parse($_POST['date']);
$annee = $date['year'];
$folder = $_POST['nom'].$annee;
//ajout d'un dossier avec le nom de la course
if (!mkdir("../courses/".$folder."/", 0777, true)) {
    die('Echec lors de la création des répertoires...');
}

?>
<div id="corps">
<fieldset>
	 <form  method="post" action ="login.php">
	 <input type="hidden" name="login" id="login" tabindex="10"  size="60"  value= '<?php echo $_POST['login'] ?>' />
	 <input type="hidden" name="Nom_Course" id="Nom_Course" tabindex="10"  size="60"  value= '<?php echo $_POST ["Nom_Course"] ?>' />
	 </form>
	 </tr>
</fieldset>

</div>
   </body>
   </html>