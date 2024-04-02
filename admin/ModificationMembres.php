

<?php

$add = $_POST["adresse"];
	
try
{

     $date = $_POST["dateNaissance"].'-01-01 00:00:00';
     $bdd = new PDO('mysql:host=dxvv.myd.infomaniak.com;dbname=dxvv_jurachrono','dxvv_christopheJ','er3z4aet1234');
$req = $bdd->prepare("UPDATE Membres SET adresse = :adresse , Nom =:Nom, Prenom=:Prenom, npa =:npa, localite=:localite, DateNaissance=:DateNaissance, Sexe=:Sexe, club=:club, mail=:mail, Pays=:Pays, Valider=:Valider WHERE id = :id ");
$req->execute(array(
"adresse" => $add ,
"Nom" => $_POST["nom"],
"Prenom" => $_POST["prenom"],
"npa" => $_POST["zip"],
"localite" => $_POST["ville"],
"DateNaissance" =>$date,
"Sexe" => $_POST["sexe"],
"club" => $_POST["club"],
"mail" => $_POST["email"],
"Pays" => $_POST["pays"],
"Valider" => true,
"id" => $_POST["ID"]
));
header('Location: membres.php'); 
}
catch(Exception $e)
{
     die('Erreur :'.$e->getMessage());
}



	
  
?>
