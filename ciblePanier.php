<!DOCTYPE html>
<html>
<head>
	<meta property="og:description" content="chronométrage, chrono, jura, franches-montagnes, Jura défi, course à pied, Sport, Jura défi chrono" />  
	<title>Défi Chrono</title>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, maximum-scale=1.0, user-scalable=yes">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css">
	<link rel="stylesheet" title="defaut" media="screen" href="styleV2.css" type="text/css"/>
<!--	<link rel="stylesheet" type="text/css" media="screen and (max-width: 480px)" href="style-mobilV2.css" /> -->
</head>
    <body>

	<?php
	  include("Header.php");
	echo $today;  
	  ?>
<div id="corps">
	<?php include("HeaderInfo.php"); ?>
<script type="text/javascript">

function checkForm(f) {
	f.submit();
	
}


</script>
</head>

<?php 
	session_start();
	
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
  }
  else
  {
  
  mysqli_select_db($con ,'dxvv_jurachrono' );
}
  
//ajout inscription
try
{
	if (strlen($_POST['prenom']) > 0 ) 
	{
		$nom=ucwords(strtolower($_POST['nom']));
		$localite= ucwords( strtolower($_POST['ville']));
if( $_POST['sexe'] == "Homme")
{
	$Sexe = "H";
}
else
{
	$Sexe = "D";
}

if ($_POST["TotalPayer"] > 0)
{
	$Status = "En Attente";
}
else
{
	$Status = "Bon";
}




$TailleTShirt = $_POST['TailleTShirt']."-".$_POST['TailleTShirt2']."-".$_POST['TailleTShirt3']."-".$_POST['TailleTShirt4']."-".$_POST['TailleTShirt5']."-".$_POST['TailleTShirt6'];

$arDepart = explode(";", $_POST["NomDepart"]); 
		$sql = 'INSERT INTO inscription (`Nom`, `Prenom`, `adresse`,`npa`,`localite`,`DateNaissance`,`sexe`,
		`club`, `NumCategorie`,`mail`,`parcours`,`course`,`NomDepart`,
		`NomCategorie`,`NomEquipe`,`NomDisc2`, `PrenomDisc2`,`NomDisc3`,
		`PrenomDisc3`,`NomDisc4`, `PrenomDisc4`,`NomDisc5`, `PrenomDisc5`,
		`NomDisc6`, `PrenomDisc6`,  `Login`, `Prix`,`NomDisc1`, `PrenomDisc1`,
		`Payer`,`PayementOnLine` ,`Partenaire`,`Informations`, `TypeEquipe`,`PrixSouvenir`,  `NbrEtape`,  `Remarques`)
		 VALUES
			("'.majuscules($_POST['nom']).'", 
			"'.majuscules($_POST['prenom']).'",
			"'.$_POST['adresse'].'", 
			"'.$_POST['zip'].'", 	
			"'.majuscules($_POST['ville']).'", 
			"'.$_POST['date'].'",
			"'.$Sexe.'",	
			"'.$_POST['club'].'", 
			"'.$_POST['NumCat'].'",
			"'.$_POST['email'].'", 
			"'.$_POST['NomParcours'].'", 
			"'.$_POST['NomCourse'].$ANNEE_COURSE.'",
			"'.$arDepart[2].'",
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
			"'.$_SESSION["Login"].'",
			"'.$_POST["TotalPayer"].'",
			"'.$_POST['NomDisc1'].'",
			"'.$_POST['PrenomDisc1'].'",
			"'.$Status.'",
			"'.$_POST['OnLine'].'",
			"'.$_POST['Partenaire'].'",
			"'.$_POST['strCodeReduction'].'",
			"'.$_POST['Equipe'].'",
			"'.$TailleTShirt.'",
			"'.$_POST['Option'].'",
			"'.$_POST['Remarques'].'");';
			
			
		$ResultAddInsc = mysqli_query($con,$sql);	
		
			
		// Validation  Code Utiliser 
		  $ArrCode = explode('\n',$_POST['strCodeReduction']);
		  
		  $i = 0;
		  $j = 0;
		  
		 
		  
		  // Dernier cellule du tableau vide 
		while ( count($ArrCode)> $i)
		{

			$ArrInfoCode = explode(';',$ArrCode[$i]);

			// Si Code a valider dans la  base de donnée
			if (strpos($ArrInfoCode[2], "ReductionCodeCHF") >  -1)
			{
				
				$sql = 'SELECT * FROM CodeReduction  WHERE  Code = \''. $ArrInfoCode[0]. '\'';

				$result = mysqli_query($con,$sql);
				if ($result ) 
				{
				
					if (mysqli_num_rows($result) > 0)
					{
							
						// Affichage de chaque donnée trouver et nombre restant actuel
						while($val = mysqli_fetch_assoc($result)) 
						{
							
							// Rechercher ID code libre 
							if (strlen ( $val ["LoginValid"])>0)
							{
								
							}
							else
							{
								$IDCode = $val['ID'];
								echo $IDCode;
								break;
							}
						}

						if  (strlen ( $IDCode)>0)
						{
							// Mise a jour entrée base de donnée Nombre restant moins 1
							$sql = 'UPDATE CodeReduction SET LoginValid=\''. $_SESSION['Login']. '\'   WHERE  ID = \''. $IDCode. '\'';
							$result = mysqli_query($con,$sql);
					
						}
						else
						{
							// aucun code de réduction valide trouvé
						
						}
					}
				}
				
			}
			$i++;
		}
		
		
		
		if ($_POST['OnLine'] == "False" )
		{	
			$Text = "<html><head><title>Inscription</title>
		</head><body>	<img src='Images/logo  defi chrono.png' alt=''  style='max-width:220px;' /></br><p><h3>Bonjour ".$_POST['prenom']." ".$_POST['nom'] .","."</h3><p>";
		}
		else
		{
			 if ($_POST["TotalPayer"] > 0)
			{
			$Text = "<html><head><title>Pré-inscription</title>
	</head><body>		<img src='logobetaDefiChrono.jpg' alt=''  style='max-width:220px;' /> </br><p><h3>Bonjour ".$_POST['prenom']." ".$_POST['nom'] .","."</h3></p>";
			}
			else
			{
				$Text = "<html><head><title>Inscription</title>
				</head><body>		<img src='logobetaDefiChrono.jpg' alt=''  style='max-width:220px;' /> </br><p><h3>Bonjour ".$_POST['prenom']." ".$_POST['nom'] .","."</h3></p>";
			
			}
		}
		
		if ($_POST['OnLine'] == "False" )
		{
			
			if (strlen ($_POST['NomEquipe']) > 0)
			{
				$Text = $Text .	"<p>Nous avons le plaisir de vous confirmer votre inscription de votre équipe ".$_POST['NomEquipe']." à la prochaine édition ". $_POST['nom_course']."</p></br></br>";
			}
			else
			{
				$Text = $Text .	"<p>Nous avons le plaisir de vous confirmer votre inscription à la prochaine édition de ". $_POST['NomCourse']."</p></br>";
			}
			$Text = $Text .	"<p>Option choisie : ". $_POST['Option']."</p></br>";
		}
		else
		{
			if (strlen ($_POST['NomEquipe']) > 0)
			{
				$Text = $Text .	"<p>Nous avons le plaisir de vous confirmer votre <b>pré-inscription</b> de votre équipe ".$_POST['NomEquipe']." à la prochaine édition de ". $_POST['nom_course']."</p></br></br>";	
			}
			else if ($_POST["TotalPayer"]== 0)
			{
				$Text = $Text .	"<p>Nous avons le plaisir de vous confirmer votre <b>inscription</b> à la prochaine édition de ". $_POST['NomCourse']."</p></br></br>";
			}
			else
			{
				$Text = $Text .	"<p>Nous avons le plaisir de vous confirmer votre <b>pré-inscription</b> à la prochaine édition de ". $_POST['NomCourse']."</p></br></br>";
			}
			$Text = $Text .	"<p>Option choisie : ". $_POST['Option']."</p></br>";
			$Text = $Text .	"</br></br><p>Total : <b>".$_POST["TotalPayer"]."</b>CHF</p>";
			if ($_POST["TotalPayer"] > 0)
			{
			
				$Text = $Text .	"<P>Veuillez effectuer le paiement via notre passerelle de paiement pour valider votre inscription. </p></br>";
	
			}
	}
	
		if ( count($ArrCode)>0)
		{
		
			  // Dernier cellule du tableau vide 
			  $m = 0;
			
			while ( count($ArrCode)> $m)
			{
				$ArrExpCode = explode(';',$ArrCode[$m]);
				if (count($ArrExpCode)>1)
				{
					if ( $m ==0)
					{
						$Text = $Text ."Voici la liste des codes utilisée</br><table>";
						$Text = $Text ."<tr><th>N°</th><th>Code</th><th>Valeur</th></tr>";
					}						
			
					$Text = $Text ."<tr><td>".$m."</td>";
				
						$Text = $Text ."<td>".$ArrExpCode[0]."</Td>";
						$Text = $Text ."<td>".$ArrExpCode[1]." CHF</Td>";
						$h++;
					
					
					$Text = $Text ."</tr>";
				}
				$m++;
			}
			$Text = $Text ."</table></br></br>";
		}

		if (strlen ($val ['IBAN'])>0 && $_POST['OnLine'] == "false" )
		{
			$Text = $Text .	 "Veuillez effectuer le paiement sur l'IBAN suivant \n".$val ['IBAN']."</br></br>";
		}
		$Text = $Text .	"Meilleures salutations et rendez-vous à notre évenement en grande forme ! </br></br>
		Team Defi Chrono</body></html>";
		
	
		
		
	
		if ($ResultAddInsc )
		{
			echo ($_POST['email']);
			$headers = 'Content-type: text/html; charset=utf-8' . "\r\n";
		
			if ( $_POST['OnLine'] == "false" )
			{
					mail($_POST['email'], 'Confirmation inscription '.$_POST['NomCourse']." ".$ANNEE_COURSE, $Text,$headers);
			
			}
			else
			{
				if ($_POST["TotalPayer"] > 0)
				{
					// NE pas envoyer de mail parce qu'il faut que l'inscription soit valider par le paiement // Modification 2022
				//	mail($_POST['email'], 'Confirmation pré-inscription '.$_POST['NomCourse']." ".$ANNEE_COURSE, $Text,$headers);
				}
				else
				{
					mail($_POST['email'], 'Confirmation inscription '.$_POST['NomCourse']." ".$ANNEE_COURSE, $Text,$headers);
				}
			
			}
			
			header('Location: admin/Pannier.php');
		}
		else
		{
			echo "Error insert : Ajout inscription" . mysql_error();
		} 
				
	mysqli_close($con);
		
	}
}
catch(Exception $e)
{
    die('Erreur : '.$e->getMessage());
}

?>



</div>
</body>
</html>



