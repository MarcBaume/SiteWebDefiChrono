<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="fr" lang="fr">
    <head>
        <title>liste</title>
        <meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
    <link rel="stylesheet" media="screen" type="text/css" title="Design" href="style.css" />

	</head>
<?php



$con = mysql_connect('servermarc:3307', 'root', '');
if (!$con)
  {
  die('Could not connect: ' . mysql_error());
  }
  echo '1   ';
echo $_POST['nom'];

 echo '2   ';
mysql_select_db($_POST['nom'], $con);
$sql = 'INSERT INTO Informations (`nom_course`, `Lieu`, `Emplacement`, `Organisateur`,`Coordonnee_organisateur`,`Telephone`,`email`,`heure_depart`,`canton`,`Date`)
 VALUES
("'.$_POST['nom'].'", 
	"'.$_POST['lieu'].'",  
	"'.$_POST['emplacement'].'", 
	"'.$_POST['organisateur'].'", 
	"'.$_POST['contact'].'", 
	"'.$_POST['telephone'].'", 
	"'.$_POST['day'].'/'.$_POST['month'].'/.'$_POST['year'].'", 
	"'.$_POST['canton'].'");';

if (mysql_query($sql,$con))
  {
  echo "line insert info";
  }
else
  {
  echo "Error insert database: Informations" . mysql_error();
  }  
?>

   </body>
   </html>