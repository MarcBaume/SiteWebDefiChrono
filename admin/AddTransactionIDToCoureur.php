

<?php

    // On se connecte à MySQL
 $con = mysqli_connect('dxvv.myd.infomaniak.com', 'dxvv_christopheJ', 'er3z4aet1234');
if (!$con)
  {
  die('Could not connect: ' . mysql_error());
  }
  else
  {
	mysqli_select_db($con ,'dxvv_jurachrono' );
	// Create table de donnée du nom de parcours
	mysqli_select_db($con,$row['Database']);

	// Modificaiton Nom
	$sql = 'UPDATE inscription SET IdTransaction = \''.$_REQUEST["IdTransaction"].'\'  WHERE OrderPayement=\''.$_GET["ID"].'\''; 
	if (!mysqli_query($con,$sql))
	{

	}
  }
?>
