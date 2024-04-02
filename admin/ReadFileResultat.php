<?php
  $con = mysqli_connect('dxvv.myd.infomaniak.com', 'dxvv_christopheJ', 'er3z4aet1234');
   if (!$con)
  {
		die('Could not connect: ' . mysql_error());
  }
  else
  {
		mysqli_select_db($con ,'dxvv_jurachrono' );
		// ***************************************** AFFICHAGE BASE de Donnée ***************************************
			
		$sql = 'DELETE * FROM classement  WHERE course=\''.$NOM_COURSE. $ANNEE_COURSE. '\'AND parcours = \''.$_GET["Parcours"]. '\AND Etape =\''.$_GET["etape"] ; 
		$result = mysqli_query($con,$sql);
		if ($result) 
		{
			// Copie du fichier reçu par le formulaire
			if (isset($_FILES['FileResult'])) 
			{
				$source = $_FILES['FileResult']['tmp_name'];
				$destination = 'fileTampon/'.$_FILES['FileResult']['name'];
				if($_FILES['FileResult']['name']>0) {
					die("erreur lors de la transmission du fichier");
				}
				if (!move_uploaded_file($source,$destination)) {
					die("erreur lors du déplacement du fichier");

				}
				$photo = $_FILES['FileResult']['name'];

	
			//$req = $bdd->prepare('UPDATE `accueil` SET `photo`=? WHERE page=\''.$_POST["page"].'\'');
			
	
			// Suppression de chaque ligne qui utilise le depart et la course Selectionné
			
			
			// Lecture Fichier Tampon Résultat
			
				// 1 : on ouvre le fichier
				$monfichier = fopen($destination, 'r+');

				// 2 : on lit chaque ligne du fichier 
				while( $ligne = fgets($monfichier) != NULL )
				{
					list($Position, $NumeroDossard, $Nom, $Prenom, $Localite, $Annee, $Sexe,$Club,$Cat,$Temps) = split(";", $ligne,10 );

					$sql = 'INSERT INTO classement (`Dossard`, `PosCourse`,`Nom`, `Prenom`,`localite`,`DateNaissance`,`sexe`,`club`, `NumCategorie`, `TempsCourse`,`course`,`NomDepart`,`parcours`,`Etape`)
					 VALUES
						("'.$NumeroDossard.'", 
						"'.$Position.'",
						"'.$Nom.'", 
						"'.$Prenom.'", 	
						"'.$localite.'", 
						"'.$Annee.'",
						"'.$Sexe.'",	
						"'.$Club.'", 
						"'.$Cat.'",
						"'.$Temps.'", 
						"'.$NOM_COURSE. $ANNEE_COURSE.'", 
						"'.$_GET["Parcours"].'",
						"'.$_GET["etape"].'");';

						if (!mysqli_query($con,$sql))
					  {
					 ;
					  }
				}

				// 3 : quand on a fini de l'utiliser, on ferme le fichier
				fclose($monfichier);
				
			
					header("Location: ModificationResultat.php") ;
			}
			
			else
			{
					echo "Aucun fichier choisi";
			}
			
		}
		else
		{
			
				echo "Erreur Mysql Delete";
		}
  }
  
?>
