

<?php
	include("../MysqlConnect.php");
	// Si on ne modifie pas une dsiciple
	if (strlen($_REQUEST["ChampModification"])>0)
	{
		// Modificaiton Nom
		$sql = 'UPDATE inscription SET '.$_REQUEST["ChampModification"].' = \''.$_REQUEST["ValueModification"].'\'  WHERE ID=\''.$_REQUEST["IDModification"].'\''; 
		if (!mysqli_query($con,$sql))
		{
			echo "Error update : inscription " . mysql_error();
			print(-1);
		} 
		else
		{
			print(1);
		}

	  }
	  else
	  {
		  print(99999);
	  }
	
  
?>
