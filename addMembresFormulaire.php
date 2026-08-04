


<?php
	function majuscules($inChaine)
{
	$inChaine =ltrim($inChaine);
	$inChaine =rtrim($inChaine);
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

 include("MysqlConnect.php");
try
{
     $date = $_REQUEST["dateNaissanceAdd"].'-01-01 00:00:00';
     $add = $_REQUEST["adresseAdd"];
     $sql = 'INSERT INTO Membres ( `adresse`, `Nom`, `Prenom`, `npa`, `localite`, `DateNaissance`, `Sexe`, `club`, `mail`, `Pays`, `Valider` , `LoginCompte` )
     VALUES("'.$add.'",
     "'.majuscules($_REQUEST["nomAdd"]).'",
     "'.majuscules($_REQUEST["prenomAdd"]).'",
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
