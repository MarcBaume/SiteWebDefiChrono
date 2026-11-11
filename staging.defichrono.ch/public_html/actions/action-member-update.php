<?php
require_once __DIR__ . "/../includes/MysqlConnect.php";	
require_once __DIR__ . "/../includes/functions.php";
try
{
    $date = $_POST["dateNaissance"] . '-01-01 00:00:00';

    $sql = "UPDATE Membres SET
        adresse = :adresse,
        Nom = :Nom,
        Prenom = :Prenom,
        npa = :npa,
        localite = :localite,
        DateNaissance = :DateNaissance,
        Sexe = :Sexe,
        club = :club,
        mail = :mail,
        Pays = :Pays,
        Valider = :Valider
        WHERE id = :id";

    $req = $pdo->prepare($sql);

    if($req->execute([
        "adresse"       => $_REQUEST["adresse"],
        "Nom"           => majuscules($_REQUEST["nom"]),
        "Prenom"        => majuscules($_REQUEST["prenom"]),
        "npa"           => $_REQUEST["zip"],
        "localite"      => $_REQUEST["ville"],
        "DateNaissance" => $date,
        "Sexe"          => $_REQUEST["sexe"],
        "club"          => $_REQUEST["club"],
        "mail"          => $_REQUEST["email"],
        "Pays"          => $_REQUEST["pays"],
        "Valider"       => 1,
        "id"            => $_REQUEST["ID"]
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
catch (PDOException $e)
{
    die('Erreur : ' . $e->getMessage());
}
?>