

<?php

$DateCourse =  $_REQUEST['DateCourse'];
$Date =  date_parse($_REQUEST['DateCourse']);
$ANNEE_COURSE = $Date['year']; 
$Month = $Date['month']; 
$Day = $Date['day']; 

function majuscules($inChaine)
{
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

  // On se connecte à MySQL
	include("../../MysqlConnect.php");
     try
     {
          mysqli_select_db($con ,'dxvv_jurachrono' );
          $sql = 'INSERT INTO inscription (`NumDossard`,`Nom`, `Prenom`, `adresse`,`npa`,`localite`,`DateNaissance`,`sexe`,
		`club`, `NumCategorie`,`mail`,`parcours`,`course`,`NomDepart`,
		`NomCategorie`,`NomEquipe`,`NomDisc2`, `PrenomDisc2`,`NomDisc3`,
		`PrenomDisc3`,`NomDisc4`, `PrenomDisc4`,`NomDisc5`, `PrenomDisc5`,
		`NomDisc6`, `PrenomDisc6`,  `Login`, `Prix`,`NomDisc1`, `PrenomDisc1`,
		`Payer`,`PayementOnLine` ,`Partenaire`,`Informations`, `TypeEquipe`,`PrixSouvenir`,  `NbrEtape`,  `Remarques`)
		 VALUES
			("'.$_REQUEST['num_dossard'].'", 
			"'.majuscules($_REQUEST['nom']).'",
			"'.majuscules($_REQUEST['prenom']).'",
			"'.$_REQUEST['adresse'].'", 
			"'.$_REQUEST['zip'].'", 	
			"'.majuscules($_REQUEST['ville']).'", 
			"'.$_REQUEST['date'].'",
			"'.$_REQUEST['sexe'].'",	
			"'.$_REQUEST['club'].'", 
			"'.$_REQUEST['NumCat'].'",
			"'.$_REQUEST['email'].'", 
			"'.$_REQUEST['NomParcours'].'", 
			"'.$_REQUEST['NomCourse'].$ANNEE_COURSE.'",
			"'.$_REQUEST['NomDepart'].'",
			"'.$_REQUEST['NomCat'].'",
			"'.$_REQUEST['NomEquipe'].'",
			"'.$_REQUEST['NomDisc2'].'",
			"'.$_REQUEST['PrenomDisc2'].'",
			"'.$_REQUEST['NomDisc3'].'",
			"'.$_REQUEST['PrenomDisc3'].'",
			"'.$_REQUEST['NomDisc4'].'",
			"'.$_REQUEST['PrenomDisc4'].'",
			"'.$_REQUEST['NomDisc5'].'",
			"'.$_REQUEST['PrenomDisc5'].'",
			"'.$_REQUEST['NomDisc6'].'",
			"'.$_REQUEST['PrenomDisc6'].'",
			"'.$_REQUEST["Login"].'",
			"'.$_REQUEST["TotalPayer"].'",
			"'.$_REQUEST['NomDisc1'].'",
			"'.$_REQUEST['PrenomDisc1'].'",
			"'.$Status.'",
			"'.$_REQUEST['OnLine'].'",
			"'.$_REQUEST['Partenaire'].'",
			"'.$_REQUEST['strCodeReduction'].'",
			"'.$_REQUEST['Equipe'].'",
			"'.$TailleTShirt.'",
			"'.$_REQUEST['NbrEtape'].'",
			"'.$_REQUEST['Remarques'].'");';
			$ResultAddInsc = mysqli_query($con,$sql);	
			if ( $ResultAddInsc == 1)
			{
				print(1);
			}

     }
     catch(Exception $e)
     {
		print(-2);
     }    

?>
