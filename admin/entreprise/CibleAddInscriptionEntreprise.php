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
	include("../../MysqlConnect.php");

     try
     {
		/**************************************************************************
		 * 
		 * AJOUT Dans les inscriptions
		 * 
		 *************************************************************************/
          
          $sql = 'INSERT INTO inscription (`Nom`, `Prenom`, `adresse`,`npa`,`localite`,`DateNaissance`,`sexe`,
		`club`, `NumCategorie`,`mail`,`parcours`,`course`,`NomDepart`,
		`NomCategorie`,`NomEquipe`,
		`Payer`,`NbrEtape`)
		 VALUES
			("'.majuscules($_POST['nom']).'",
			"'.majuscules($_POST['prenom']).'",
			"'.$_POST['adresse'].'", 
			"'.$_POST['zip'].'", 	
			"'.majuscules($_POST['ville']).'", 
			"'.$_POST['dateNaissance'].'",
			"'.$_POST['sexe'].'",	
			"'.$_POST['club'].'", 
			"'.$_POST['NumCat'].'",
			"'.$_POST['email'].'", 
			"'.$_POST['NomParcours'].'", 
			"'.$_POST['NomCourse'].'",
			"'.$_POST['NomDepart'].'",
			"'.$_POST['NomCat'].'",
			"'.$_POST['NomEquipe'].'",
			"Entreprise",
			"'.$_POST['NbrEtape'].'");';
			$ResultAddInsc = mysqli_query($con,$sql);	
			if ( $ResultAddInsc == 1)
			{
				$last_id = $con->insert_id;

				$sqldelete = 'DELETE FROM Membres  WHERE ID  = "'.$_POST['IDCoureur'].'"';
				$ResultDelInsc = mysqli_query($con,$sqldelete);	
				if ( $ResultDelInsc == 1)
				{
					header('Location: equipes_entreprise.php'); 
				}
				else
				{
					echo "Erreur Delete";
				}
			}
			echo $sql;
			/*****************************************************************
			 * 
			 *  Delete des les membre entreprise
			 * 
			 *******************************************************************/

     }
     catch(Exception $e)
     {
		
     }    

?>
