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
<body>
	
	<?php //cr�ation d'une base de donn�e au nom de la course
	include("../MysqlConnect.php");
session_start();

$sql = 'INSERT INTO Membres (`LoginCompte`)
 VALUES
("'.$_SESSION['Login'].'");';

if (mysqli_query($con,$sql))
  {
	header('Location: membres.php'); 
  }
else
  {
	
  echo "Error insert : Informations" . mysql_error();
  }  
mysqli_close($con);

?>

   </body>
   </html>