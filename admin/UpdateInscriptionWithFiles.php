<!DOCTYPE html>
<html>
<head>
	<meta property="og:description" content="chronométrage, chrono, jura, franches-montagnes, Jura défi, course à pied, Sport, Jura défi chrono" />  
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
					$pos = strpos($typeInscription, 'localhost');
					$IDCoureur = $data[17];
					// Inscription en local a ajouter a la base de donnée
					if($pos >-1)
					{
						// Recherche si valeur deja dans base de donnée 
						$sql = "SELECT * FROM inscription2 WHERE Payer = :type_paiement";
						$requete = $pdo->prepare($sql);
						$requete->execute(['type_paiement' => $typeInscription.$IDCoureur]);
						$findRacer = $requete->fetch(PDO::FETCH_ASSOC);
						#si le coureur est déjà trouvé
						if ($findRacer) 
						{
							echo 'Coureur déjà transférer de local '.$Nom .'_'.$Prenom.'</br>';
						}
						else
						{
				
							$sql2 = 'INSERT INTO inscription2(`NumDossard`,`Nom`, `Prenom`, `adresse`,`npa`,`localite`,`DateNaissance`,`sexe`,`club`, `NumCategorie`,`mail`,`NomCategorie`,`parcours`,`NomDepart`,`tel`,`equipe`,`course`,`NomEquipe`,`NomDisc1`,
							`PrenomDisc1`,`NomDisc2`, `PrenomDisc2`,`NomDisc3`, `PrenomDisc3`,`NomDisc4`, `PrenomDisc4`,`NomDisc5`, `PrenomDisc5`, `NomDisc6`, `PrenomDisc6`,`NbrEtape` ,
							`Login`,`Payer` ,`OrderPayement` ,`Prix` ,`Date` ,`PayementOnLine` ,`Partenaire` ,`TypeEquipe` ,`PrixSouvenir` ,`Informations` ,`NombreCreditUtilise`)
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

							"'.$data[32].'",
							"localhost'.$IDCoureur.'",
							"'.$data[34].'",

							"'.$data[35].'",
							"'.$data[36].'",
							"'.$data[37].'",
							"'.$data[38].'",
							"'.$data[39].'",
							"'.$data[40].'",
							"'.$data[41].'",
							"'.$data[42].'");';
							$result2 = mysqli_query($con,$sql2);   
							if ($result2  )
							{
								echo "Insertion personne localhost".$data[1]."_".$data[2]."</br>" ;
							}
						}
					}
					else
					{
			
						if (strlen($IDCoureur)> 1 )
						{
							$sql = "SELECT * FROM inscription2 WHERE ID = :id_coureur";
							$requete = $pdo->prepare($sql);
							$requete->execute(['id_coureur' => $IDCoureur]);
							$membre = $requete->fetch(PDO::FETCH_ASSOC);
							if ($membre) 
							{
								$title = $membre['Nom']." ".$membre['Prenom'];

								if (strlen($data[0])> 0 )
								{
									if ($membre['NumDossard'] == "0")
									{
										$sql = "UPDATE inscription2 SET NumDossard = :NumDossard WHERE ID = :id_coureur";
										$requete = $pdo->prepare($sql);
										// 3. Exécution de la mise à jour avec les données
										$requete->execute([
											'NumDossard' => $data[0],
											'id_coureur'  => $IDCoureur
										]);
										echo "Update: ".$IDCoureur."=> ".$data[0]. " ".$title."<br />";
									}
									else if ($membre['NumDossard'] == $data[0])
									{
										echo "Aucune modifcation: ".$IDCoureur ." => Dossard: ".$membre['NumDossard']. " ".$title."<br />";
									}
									else
									{
										echo "dossard existant: ".$IDCoureur." => avant: ".$membre['NumDossard']  ."fichier: ".$data[0]." ".$title."<br />";
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
            }
        }
	}    		
	
?>
</html>
