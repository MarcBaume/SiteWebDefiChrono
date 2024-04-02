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
	
	<?php //création d'une base de donnée au nom de la course
$con = mysqli_connect('dxvv.myd.infomaniak.com', 'dxvv_christopheJ', 'er3z4aet1234');
if (!$con)
  {
  die('Could not connect: ' . mysql_error());
  }
session_start();
mysqli_select_db($con ,'dxvv_jurachrono' );

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