<?php

// Inclure un fichier de configuration
require_once '../../config.php'; 

// On se connecte à MySQL
$con = mysqli_connect(HOSTNAME_DB, USER_DB, PASSWORD_DB);

if (!$con)
{

     die('Could not connect: ' . mysql_error());
	 print(-3);
}
else
{
     try
     {
        mysqli_select_db($con ,NAME_DB );
		// recherche si l'entreprise existe
		$sql = 'SELECT * FROM Entreprises WHERE NomEntreprise= \''.$_REQUEST["entreprise"].'\'' ;
		$result = mysqli_query($con,$sql);
		if ($result && mysqli_num_rows($result) > 0)
		{
			// Si l'entreprise existe déjà upgrade champ
			$sql = 'UPDATE Entreprises SET NomEntreprise= \''.$_REQUEST["entreprise"].'\',
			NomContact=\''.$_REQUEST["nom"].'\',
			PrenomContact=\''.$_REQUEST["prenom"].'\',
			EmailContact=\''.$_REQUEST["email"].'\',
			AdresseContact=\''.$_REQUEST["adresse"].'\',
			NPAContact=\''.$_REQUEST["zip"].'\',
			LocaliteContact=\''.$_REQUEST["ville"].'\',
			PaysContact=\''.$_REQUEST["pays"].'\'
			WHERE Login=\''.$_REQUEST['login'].'\''; 
			if (mysqli_query($con,$sql))
			{
				print(1); 
			}
			else
			{ 
				print(-2);
			}
		}
		else
		{
				// Si l'entreprise existe déjà upgrade champ
			$sql = '   INSERT  INTO Entreprises (
			`NomEntreprise`, 
			`NomContact`,
			`PrenomContact`,
			`EmailContact`,
			`AdresseContact`,
			`NPAContact`,
			`LocaliteContact`,
			`PaysContact`,
			`Login`
			)
			VALUES  (
			"'.$_REQUEST["entreprise"].'", 
			"'.$_REQUEST["nom"].'",
			"'.$_REQUEST["prenom"].'",
			"'.$_REQUEST["email"].'",
			"'.$_REQUEST["adresse"].'",
			"'.$_REQUEST["zip"].'",
			"'.$_REQUEST["ville"].'",
			"'.$_REQUEST["pays"].'",
			"'.$_REQUEST['login'].'")'; 

			if (mysqli_query($con,$sql))
			{
				print(1); 
			}
			else
			{ 
				print(-4);
			}
		}
     }
     catch(Exception $e)
     {
		print(-2);
     }    

}
?>
 
