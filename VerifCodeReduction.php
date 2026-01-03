<?php
/*____________________________________________________________________

		Connection a la base  de donnée CodeReduction

			All -> Reprise des bon de réductions Valide pour la course
			
			-> si bon trouvé 
			
			-> Date limite du bon
			
			-> Si Nom et Prénom concorde au bon 
			
			-> Bon valide pour nombre Etape // Valeur = 9992 = 2 Etapes
			
______________________________________________________________________*/

function string2url($chaine) { 
	$chaine = trim($chaine); 
	$chaine = strtr($chaine, 
   "ÀÁÂÃÄÅàáâãäåÒÓÔÕÖØòóôõöøÈÉÊËèéêëÇçÌÍÎÏìíîïÙÚÛÜùúûüÿÑñ", 
   "aaaaaaaaaaaaooooooooooooeeeeeeeecciiiiiiiiuuuuuuuuynn"); 
	$chaine = strtr($chaine,"ABCDEFGHIJKLMNOPQRSTUVWXYZ","abcdefghijklmnopqrstuvwxyz"); 
	$chaine = preg_replace('#([^.a-z0-9]+)#i', '-', $chaine); 
		   $chaine = preg_replace('#-{2,}#','-',$chaine); 
		   $chaine = preg_replace('#-$#','',$chaine); 
		   $chaine = preg_replace('#^-#','',$chaine); 
	return $chaine; 
   }


if ( strlen ($_REQUEST['Code'])>2)
{
	// Déserialization de la liste des courses
	$ArrCourse = explode(';',$_REQUEST['strListCourse']);
	include("MysqlConnect.php");
	
	$sql = 'SELECT * FROM CodeReduction  WHERE   Code = \''. $_REQUEST['Code']. '\'';

	$result = mysqli_query($con,$sql);
	
	if ($result ) 
	{
		$index = 0;
		if (mysqli_num_rows($result) > 0)
		{
			// Affichage de chaque donnée trouver
			while($val = mysqli_fetch_assoc($result)) 
			{
				$index = $index + 1;	
				// date du jour 
				$today = date("Y-m-d H:i:s"); 
				if ($today < $val["DateLimit"]  || $val["DateLimit"]  == '0000-00-00 00:00:00'  )
				{
					
					if (strlen ( $val["LoginValid"])>0)
					{
						
					}
					else
					{
						if ($_REQUEST['CourseCode'] == 	$val["Course"] or $val['Course'] == 'All')
						{
							$NOM = string2url($val['Nom']);
							$PRENOM = string2url($val['Prenom']);
							$NOMREQUEST = string2url($_REQUEST['NomCode']);
							$PRENOMREQUEST = string2url($_REQUEST['PrenomCode']);

							if (( $NOM  == $NOMREQUEST And  $PRENOM == $PRENOMREQUEST ) OR (strlen($val['Nom']) == 0 and strlen($val['Prenom']) ==0))
							{			
								// Reduction par etape et non en franc 
					
									print(json_encode(	$val["ReductionCHF"] ));
							
									goto a;	
							}

						}
						else
						{
							print( -3);
						goto a;	
						}				
					}
				}
				else
				{
					print( -8);
					goto a;	
				}

			
			}
		print( -16); // Aucun bon n'est encore libre	
			
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
a:
?>