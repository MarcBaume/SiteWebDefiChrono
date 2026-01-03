

<?php

    include("../MysqlConnect.php");
	// Create table de donnée du nom de parcours
	mysqli_select_db($con,$row['Database']);

	// Modificaiton Nom
	$sql = 'UPDATE inscription SET IdTransaction = \''.$_REQUEST["IdTransaction"].'\'  WHERE OrderPayement=\''.$_GET["ID"].'\''; 
	if (!mysqli_query($con,$sql))
	{

	}
  
?>
