<!DOCTYPE html>
<html>
<head>
	<title>Défi Chrono</title>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, maximum-scale=1.0, user-scalable=yes">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css">
	<link rel="stylesheet" title="defaut" media="screen" href="styleV3.css" type="text/css"/>
<!--	<link rel="stylesheet" type="text/css" media="screen and (max-width: 480px)" href="style-mobilV2.css" /> -->
</head>

    <body>

<?php

  include("Header.php"); 

  ?>
<div id="corps">


<?

function majuscules($inChaine)
{
    $inChaine = strtolower($inChaine);
    // index du nom changer
    $tiretIndex = strpos($inChaine, '-');
    // Remplace le minus par un espace 
    $inChaine = str_replace("-"," ",$inChaine);
    // Mets en majuscule ddébut de chaque nom
    $inChaine = ucwords($inChaine);
    if ( $tiretIndex  > 0)
    {
    // Remets le tiret d'union 
    $inChaine = substr_replace($inChaine,"-",$tiretIndex,1);

    }
	return $inChaine;
}



	include("HeaderInfo.php"); 
// Establishing Connection with Server by passing server_name, user_id and password as a parameter
	$con = mysqli_connect('dxvv.myd.infomaniak.com', 'dxvv_christopheJ', 'er3z4aet1234');
	if (!$con)
	{
		die('Could not connect: ' . mysql_error());
	}
	// Selecting Database
	mysqli_select_db($con ,'dxvv_jurachrono' );
	
	// Recolte des information transmise par l'application WPF
	$NomCourse =   $_GET["NomCourse"];
	$Etape =  $_GET["NbrEtape"];
	
	$Parcours =  $_GET["Parcours"];
	$Depart =  $_GET["Depart"];
	$pathfolder = 'courses/'.$_GET['NomCourse'].$ANNEE_COURSE.'/info';
	
	echo "Dossier existe???". $pathfolder ;
	if (is_dir  (  $pathfolder ))
	{
		echo "Il existe";
		// Supression de toutes les données de cette course dans la base de donnée$
        $pathFile = $pathfolder."/listeDepart.csv";
        if (file_exists($pathFile)) 
        {
			echo "Le fichier existe";
            if (($handle = fopen( $pathFile, "r")) !== FALSE) 
	            {
				echo "Il est ouvert";
				// Lecture de chaque ligne du fichier de la liste de départ 
                while (($data = fgetcsv($handle, 1000, ";")) !== FALSE) 
                {
					$Nom = $data[1];
					$Prenom = $data[2];

					// Recherche si le numéro d'id existe
					$IDCoureur = $data[17];
				
                    $sql = 'SELECT * FROM inscription WHERE course =\''.$_GET["NomCourse"].$ANNEE_COURSE.'\'AND Nom = \''.$data[1].'\'AND Prenom = \''.$data[2].'\'';
					
					$result4 = mysqli_query($con,$sql);	

					if ($result4 ) 
					{				
						if (  mysqli_num_rows($result4) > 0)
						{
							// SI un dossard est déjà attribué a cette personne
							if (intval($data[0]) > 0)
							{
								// Si la donnée existe déjà la supprimer
								$sql1 = 'DELETE FROM inscription   WHERE  Nom = \''.$Nom.'\'AND Prenom = \''.$Prenom.'\'AND DateNaissance = \''.$data[6].'\'';
												
							}
							else
							{
								// Si la donnée existe déjà la supprimer
								$sql1 = 'DELETE FROM inscription   WHERE NumDossard = \''.$data[0].'\' AND  Nom = \''.$Nom.'\'AND Prenom = \''.$Prenom.'\'AND DateNaissance = \''.$data[6].'\'';
												
							}

							$result1 = mysqli_query($con,$sql1);   

                            if ($result1)
                            {
                                echo "Delete _";
                            }
                            else
                            {
                                echo "Error Delete Delete _";
                                echo $result1;
                            }
					/*		// Mise a jour entrée base de donnée Nombre crédit restant dans l'application
							$sql1 = 'UPDATE inscription SET NombreCreditUtilise=\''.  $data[42]. '\'   WHERE   Nom = \''.$data[1].'\'AND Prenom = \''.$data[2].'\'';
							$result1 = mysqli_query($con,$sql1);   
							if ($result1)
							{
								echo "Crédit Modifier_".$data[42]."_".$data[1]."_".$data[2]."</br>";
							}

							// Mise a jour Nombre étape
							$sql1 = 'UPDATE inscription SET NbrEtape=\''.  $data[31]. '\'   WHERE  Nom = \''.$data[1].'\'AND Prenom = \''.$data[2].'\'';
							$result1 = mysqli_query($con,$sql1);   
							if ($result1)
							{
								echo "Nbr etape Modifier_".$data[31]."_".$data[1]."_".$data[2]."</br>";
							}*/
						}
						
						
						$sql2 = 'INSERT INTO inscription (`NumDossard`,`Nom`, `Prenom`, `adresse`,`npa`,`localite`,`DateNaissance`,`sexe`,`club`, `NumCategorie`,`mail`,`NomCategorie`,`parcours`,`NomDepart`,`tel`,`equipe`,`course`,`NomEquipe`,`NomDisc1`,
							`PrenomDisc1`,`NomDisc2`, `PrenomDisc2`,`NomDisc3`, `PrenomDisc3`,`NomDisc4`, `PrenomDisc4`,`NomDisc5`, `PrenomDisc5`, `NomDisc6`, `PrenomDisc6`,`NbrEtape`,`NombreCreditUtilise`)
						VALUES
						("'.$data[0].'", 
						"'.$Nom.'",
						"'.$Prenom.'",
						"'.$data[3].'", 
						"'.$data[4].'", 	
						"'.$data[5].'", 
						"'.$data[6].'", 
						"'.$data[7].'", 	
						"'.$data[8].'", 
						"'.$data[9].'", 
						"'.$data[10].'", 
						"'.$data[11].'", 
						"'.$data[12].'", 
						"'.$data[13].'", 
						"'.$data[14].'", 
						"'.$data[15].'", 
						"'.$data[16].'", 
						"'.$data[18].'", 
						"'.$data[19].'", 
						"'.$data[20].'", 
						"'.$data[21].'", 
						"'.$data[22].'", 
						"'.$data[23].'", 
						"'.$data[24].'", 
						"'.$data[25].'", 
						"'.$data[26].'", 
						"'.$data[27].'", 
						"'.$data[28].'", 
						"'.$data[29].'", 
						"'.$data[30].'", 
						"'.$data[31].'", 
						"'.$data[42].'");';
						$result2 = mysqli_query($con,$sql2);   
						if ($result2  )
						{
							echo "Insertion personne".$data[1]."_".$data[2]."</br>" ;
							
						}
						
                    }	
                }
            }
        }
    }					
	
?>
</html>
