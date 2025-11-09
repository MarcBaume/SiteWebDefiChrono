
 <?php
 if (strlen($_REQUEST["OrderIDPayrexx"]) <3)
{
	print(-3);
}
else
{
	$con = mysqli_connect('dxvv.myd.infomaniak.com', 'dxvv_christopheJ', 'er3z4aet1234');

	if (!$con)
	{
		print( -2);	
	die('Could not connect: ' . mysql_error());
	}
	else
	{
		if (strlen($_REQUEST["LoginUpdateRegister"])> 4)
		{
			mysqli_select_db($con ,'dxvv_jurachrono' );
			$Value = 'True';
			$sql = 'SELECT * FROM inscription  WHERE Login=\''.$_REQUEST["LoginUpdateRegister"].'\'AND Payer !=\'Payé\'AND Payer !=\'Bon\' AND PayementOnLine =\''.$Value.'\'';
			$result = mysqli_query($con,$sql);
			if ($result)
			{
					$index = 0;
				while($donnees = mysqli_fetch_assoc($result)) 
				{
									$index =$index +1;
					if ($donnees['Payer'] == "En Attente" || $donnees['Payer'] == "cancelled"  || $donnees['Payer'] == "declined" || $donnees['Payer'] == "refunded")
					{
		
						// Modifier les Informations en ajoutant Le Order ID dans la Colonne de la table inscription OrderPayement
						$sql = 'UPDATE inscription SET OrderPayement = \''.$_REQUEST["OrderIDPayrexx"].'\'  WHERE ID=\''.$donnees["ID"].'\''; 
						if (!mysqli_query($con,$sql))
						{
							print( -1);	
						}  
					}
				}
					print($index );
			}
			else
			{
				print(-5);;
			}
		}
		else
		{
			print(-4);
		}
	

	}
}
?>