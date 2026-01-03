

<?php
 include("MysqlConnect.php");
try
{
     $date = $_REQUEST["dateNaissanceAdd"].'-01-01 00:00:00';
     $add = $_REQUEST["adresseAdd"];
     $sql = 'INSERT INTO Membres ( `adresse`, `Nom`, `Prenom`, `npa`, `localite`, `DateNaissance`, `Sexe`, `club`, `mail`, `Pays`, `Valider` , `LoginCompte` )
     VALUES("'.$add.'",
     "'.$_REQUEST["nomAdd"].'",
     "'.$_REQUEST["prenomAdd"].'",
     "'.$_REQUEST["zipAdd"].'",
     "'.$_REQUEST["villeAdd"].'",
     "'.$date.'",
     "'.$_REQUEST["sexeAdd"].'",
     "'.$_REQUEST["clubAdd"].'",
     "'.$_REQUEST["emailAdd"].'",
     "'.$_REQUEST["paysAdd"].'",
     "1",
     "'.$_REQUEST["LoginCompte"].'");';

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
     print(-1);
}    


?>
