<?php
require_once __DIR__ . "/../includes/MysqlConnect.php";	
 require_once __DIR__ . "/../includes/functions.php";
try
{
     $date = $_REQUEST["dateNaissanceAdd"] . '-01-01 00:00:00';


     $sql = 'INSERT INTO Membres (
     adresse, Nom, Prenom, npa, localite, DateNaissance,
     Sexe, club, mail, Pays, Valider, LoginCompte
     ) VALUES (
     :adresse, :nom, :prenom, :npa, :localite, :dateNaissance,
     :sexe, :club, :mail, :pays, :valider, :loginCompte
     )';

     $stmt = $pdo->prepare($sql);

     if ($stmt->execute([
     ':adresse'       => $_REQUEST["adresseAdd"],
     ':nom'           => majuscules($_REQUEST["nomAdd"]),
     ':prenom'        => majuscules($_REQUEST["prenomAdd"]),
     ':npa'           => $_REQUEST["zipAdd"],
     ':localite'      => $_REQUEST["villeAdd"],
     ':dateNaissance' => $date,
     ':sexe'          => $_REQUEST["sexeAdd"],
     ':club'          => $_REQUEST["clubAdd"],
     ':mail'          => $_REQUEST["emailAdd"],
     ':pays'          => $_REQUEST["paysAdd"],
     ':valider'       => 1,
     ':loginCompte'   => $_REQUEST["LoginCompte"]
     ])) 
     {
    // Ton code de succès ici
          print(1); 
     }
     else
     { 
          print(-2);
     }
}
catch(Exception $e)
{
     print(-1);
}    


?>
