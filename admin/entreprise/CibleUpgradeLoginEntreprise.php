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
     catch(Exception $e)
     {
		print(-2);
     }    

}
?>
 
