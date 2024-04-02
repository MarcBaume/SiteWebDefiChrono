

<?php
  // On se connecte à MySQL
$con = mysqli_connect('dxvv.myd.infomaniak.com', 'dxvv_christopheJ', 'er3z4aet1234');

if (!$con)
{

     die('Could not connect: ' . mysql_error());
     print(-3);

}
else
{
     try
     {
          mysqli_select_db($con ,'dxvv_jurachrono' );
          $date = $_REQUEST["dateNaissance"].'-01-01 00:00:00';
          $add = $_REQUEST["adresse"];
          $sql = 'INSERT INTO Membres ( `adresse`, `Nom`, `Prenom`, `npa`, `localite`, `DateNaissance`, `Sexe`, `club`, `mail`, `Pays`, `Valider` , `LoginCompte` )
          VALUES("'.$add.'",
          "'.$_REQUEST["nom"].'",
          "'.$_REQUEST["prenom"].'",
          "'.$_REQUEST["zip"].'",
          "'.$_REQUEST["ville"].'",
          "'.$date.'",
          "'.$_REQUEST["sexe"].'",
          "'.$_REQUEST["club"].'",
          "'.$_REQUEST["email"].'",
          "'.$_REQUEST["pays"].'",
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

}
?>
