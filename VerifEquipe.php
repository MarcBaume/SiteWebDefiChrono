<?php
/*____________________________________________________________________

		Connection a la base  de donnée inscription
		
		Créeation Class Equipe

		Tableau de classequipe

		Verif si nom equipe existante 
		
		si Oui Combien d'occurence

______________________________________________________________________*/
class ClassEquipe
{
	public $NombrePersonne;
	public $NomEquipe;

}
if ( strlen ($_REQUEST['NomEquipe'])>2)
{
  $con = mysqli_connect('dxvv.myd.infomaniak.com', 'dxvv_christopheJ', 'er3z4aet1234');
 
	// Nombre de coureur dans la base de donnée
	mysqli_select_db($con ,'dxvv_jurachrono' );
	
	$sql = 'SELECT * FROM inscription  WHERE course=\''.$_REQUEST['Course'].  '\'  AND NomEquipe LIKE \''. $_REQUEST['NomEquipe']. '\'';
	$a = array();
	$result = mysqli_query($con,$sql);
	 	if ($result ) 
	{
		if (mysqli_num_rows($result) > 0)
		{
			// Affichage de chaque donnée trouver
			while($val = mysqli_fetch_assoc($result)) 
			{
				
				//Verification Si equipe  Deja Existante dans le tableau 
				for ($i = 0; $i <= count($a); $i++)
				{ 
					if ($a[$i]->NomEquipe ==	$val['NomEquipe'])
					{
						$a[$i]->NombrePersonne := $a[$i]->NombrePersonne +1;
						goto a;
					}
				}
				// Si Equipe n'existe pas la créer et l'ajouter au classement equipe
				$ObjEquipe = new ClassEquipe();
				$ObjEquipe->NomEquipe = $val['NomEquipe'];
				$ObjEquipe->NombrePersonne = 1;
				 array_push($a, $ObjEquipe);
				a:
			}
			print ($a);
		}
		else
		{
			print( -5); // Aucun bon trouvé
		}
	}
	else
	{
		print( -15); // Erreur site web annoncé cette erreur à info@defichrono,ch
	}

}
else
{
	print( -10); // Aucun numéro de bon saisie
}
?>