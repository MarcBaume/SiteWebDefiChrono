

<?php

    // On se connecte à MySQL
 $con = mysqli_connect('dxvv.myd.infomaniak.com', 'dxvv_christopheJ', 'er3z4aet1234');
if (!$con)
  {
  die('Could not connect: ' . mysql_error());
  print(-9999);
  }
  else
  {
	mysqli_select_db($con ,'dxvv_jurachrono' );

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
	
  }
?>
