<?php
/*____________________________________________________________________

		Connection a la base  de donnée CodeReduction

			All -> Reprise des bon de réductions Valide pour la course
			
			-> si bon trouvé 
			
			-> Date limite du bon
			

______________________________________________________________________*/
if ( strlen ($_REQUEST['strCodeReduction'])>2)
{
  $con = mysqli_connect('dxvv.myd.infomaniak.com', 'dxvv_christopheJ', 'er3z4aet1234');
 
 // Deserialization de chaque code de réduction 
  $ArrCode = explode(';',$_REQUEST['strCodeReduction']);
  $i = 0;
 
// Dernier cellule du tableau vide 
 while ( count($ArrCode)-1> $i)
 {
	  print(3);
	$IDCode = 0;
	// Nombre de coureur dans la base de donnée
	mysqli_select_db($con ,'dxvv_jurachrono' );
	
	$sql = 'SELECT * FROM CodeReduction  WHERE  Code = \''. $ArrCode[$i]. '\'';
	
	$result = mysqli_query($con,$sql);
	if ($result ) 
	{
		if (mysqli_num_rows($result) > 0)
		{
			// Affichage de chaque donnée trouver et nombre restant actuel
			while($val = mysqli_fetch_assoc($result)) 
			{
				// Rechercher ID code libre 
				if (strlen ( $val ["LoginValid"])>0)
				{
					
				}
				else
				{
					$IDCode = $val['ID'];
					break;
				}
			}

			if  (strlen ( $IDCode)>0)
			{
				// Mise a jour entrée base de donnée Nombre restant moins 1
				$sql = 'UPDATE CodeReduction SET LoginValid=\''. $_REQUEST['Login']. '\'   WHERE  ID = \''. $IDCode. '\'';
				$result = mysqli_query($con,$sql);
		
			}
			else
			{
				// aucun code de réduction valide trouvé
			
			}
		}
	
	}
	$i = $i + 1;
 }
 print(1);

}


?>