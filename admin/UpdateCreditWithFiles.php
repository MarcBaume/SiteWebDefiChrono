<!DOCTYPE html>
<html>
<head>
	<title>Défi Chrono update files</title>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, maximum-scale=1.0, user-scalable=yes">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css">
	<link rel="stylesheet" title="defaut" media="screen" href="styleV3.css" type="text/css"/>
<!--	<link rel="stylesheet" type="text/css" media="screen and (max-width: 480px)" href="style-mobilV2.css" /> -->
</head>

    <body>

<?php

  include("HeaderAdmin.php"); 
 include("../MysqlConnect2025.php"); 

  ?>
<div id="corps">


<?
	include("HeaderInfo.php"); 
	//$pathfolder = '../courses/'.$NOM_COURSE.$ANNEE_COURSE.'/info';
	$pathfolder = '../FilesTemp';
	echo "Vérification si le dossier existe?". $pathfolder."<br />" ;
	if (is_dir  (  $pathfolder ))
	{
		echo "Il existe<br />";
		// Supression de toutes les données de cette course dans la base de donnée$
        $pathFile = $pathfolder."//listeDepart.csv";
        if (file_exists($pathFile)) 
        {
			echo "Le fichier existe<br />";
            if (($handle = fopen( $pathFile, "r")) !== FALSE) 
	            {
				echo "Il est ouvert<br />";
				// Lecture de chaque ligne du fichier de la liste de départ 
                while (($data = fgetcsv($handle, 1000, ";")) !== FALSE) 
                {
					$Nom = $data[1];
					$Prenom = $data[2];
					echo $data[17];
					$typeInscription= $data[33];
					
					$IDCoureur = $data[17];
					
					if (strlen($IDCoureur)> 1 )
					{
						$sql = "SELECT * FROM inscription WHERE ID = :id_coureur";
						$requete = $pdo->prepare($sql);
						$requete->execute(['id_coureur' => $IDCoureur]);
						$membre = $requete->fetch(PDO::FETCH_ASSOC);
						if ($membre) 
						{
							$title = $membre['Nom']." ".$membre['Prenom'];

							if (strlen($data[0])> 0 )
							{
								if ($membre['NumDossard'] == $data[0])
								{
									if ($membre['NombreCreditUtilise'] == $data[42])
									{
									;//	echo "Aucune modifcation: ".$IDCoureur ." =>Crédit: ".$data[31]." Dossard: ".$membre['NumDossard']. " ".$title."<br />";
									}
									else
									{
																				
											$sql = "UPDATE inscription SET NombreCreditUtilise = :NombreCreditUtilise WHERE ID = :id_coureur";
										$requete = $pdo->prepare($sql);
										// 3. Exécution de la mise à jour avec les données
										$requete->execute([
											'NombreCreditUtilise' => $data[42],
											'id_coureur'  => $IDCoureur
										]);
										if ($requete)
										{
											echo "update nombre de crédit: ".$IDCoureur ." => Dossard: ".$membre['NumDossard']. " ".$title."crédit utilisé: ".$data[42]."<br />";
										}
										else
										{
											$erreur = $requete->errorInfo();
											echo "Erreur update crédit : " . $erreur[2]; // L'index 2 contient le message texte
										}
									}
								}								
							}
							else
							{
								echo "aucun dossard dans fichier".$IDCoureur."<br />";
							}
						}
						else
						{
								echo "Aucun coureur trouvé.".$IDCoureur."<br />";
						}
					}
					
                }
            }
			unlink($pathFile);
        }

	}    		
	
?>
</html>
