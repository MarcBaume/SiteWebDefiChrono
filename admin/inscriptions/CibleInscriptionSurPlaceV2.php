

<?php

$DateCourse =  $_POST['DateCourse'];
$Date =  date_parse($_POST['DateCourse']);
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
          $sql = 'INSERT INTO inscription (`NumDossard`,`Nom`, `Prenom`, `adresse`,`npa`,`localite`,`DateNaissance`,`sexe`,
		`club`, `NumCategorie`,`mail`,`parcours`,`course`,`NomDepart`,
		`NomCategorie`,`NomEquipe`,`NomDisc2`, `PrenomDisc2`,`NomDisc3`,
		`PrenomDisc3`,`NomDisc4`, `PrenomDisc4`,`NomDisc5`, `PrenomDisc5`,
		`NomDisc6`, `PrenomDisc6`,  `Login`, `Prix`,`NomDisc1`, `PrenomDisc1`,
		`Payer`,`PayementOnLine` ,`Partenaire`,`Informations`, `TypeEquipe`,`PrixSouvenir`,  `NbrEtape`,  `Remarques`)
		 VALUES
			("'.$_POST['num_dossard'].'", 
			"'.majuscules($_POST['nom']).'",
			"'.majuscules($_POST['prenom']).'",
			"'.$_POST['adresse'].'", 
			"'.$_POST['zip'].'", 	
			"'.majuscules($_POST['ville']).'", 
			"'.$_POST['date'].'",
			"'.$_POST['sexe'].'",	
			"'.$_POST['club'].'", 
			"'.$_POST['NumCat'].'",
			"'.$_POST['email'].'", 
			"'.$_POST['NomParcours'].'", 
			"'.$_POST['NomCourse'].$ANNEE_COURSE.'",
			"'.$_POST['NomDepart'].'",
			"'.$_POST['NomCat'].'",
			"'.$_POST['NomEquipe'].'",
			"'.$_POST['NomDisc2'].'",
			"'.$_POST['PrenomDisc2'].'",
			"'.$_POST['NomDisc3'].'",
			"'.$_POST['PrenomDisc3'].'",
			"'.$_POST['NomDisc4'].'",
			"'.$_POST['PrenomDisc4'].'",
			"'.$_POST['NomDisc5'].'",
			"'.$_POST['PrenomDisc5'].'",
			"'.$_POST['NomDisc6'].'",
			"'.$_POST['PrenomDisc6'].'",
			"'.$_POST["Login"].'",
			"'.$_POST["TotalPayer"].'",
			"'.$_POST['NomDisc1'].'",
			"'.$_POST['PrenomDisc1'].'",
			"'.$Status.'",
			"'.$_POST['OnLine'].'",
			"'.$_POST['Partenaire'].'",
			"'.$_POST['strCodeReduction'].'",
			"'.$_POST['Equipe'].'",
			"'.$TailleTShirt.'",
			"'.$_POST['NbrEtape'].'",
			"'.$_POST['Remarques'].'");';
			$ResultAddInsc = mysqli_query($con,$sql);	
			if ( $ResultAddInsc == 1)
			{
				$last_id = $con->insert_id;
				header('Location: endInscriptionSurPlace.php?NbrEtape='.$_POST['NbrEtape'].'&DateCourse='.$_POST['DateCourse'].'&Etape=1&NomCourse='.$_POST['NomCourse'].'&LastAdresseID='.$last_id.''); 
			}

     }
     catch(Exception $e)
     {
		
     }    

}?>
