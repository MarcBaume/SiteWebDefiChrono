<?php 
require_once __DIR__ . "/../includes/functions.php";
require_once __DIR__ . "/../includes/MysqlConnect.php";
require_once __DIR__ . "/../includes/dataRaceSelected.php";
session_start();
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

	$partenaire = 0;
	if (isset($_POST['Partenaire']) )
	{
		$partenaire = 1;
	}

	$TailleTShirt = $_POST['TailleTShirt']."-".$_POST['TailleTShirt2']."-".$_POST['TailleTShirt3']."-".$_POST['TailleTShirt4']."-".$_POST['TailleTShirt5']."-".$_POST['TailleTShirt6'];

	$arDepart = explode(";", $_POST["NomDepart"]);

	$sql = 'INSERT INTO inscription (
    `Nom`, `Prenom`, `adresse`, `npa`, `localite`, `DateNaissance`, `sexe`,
    `club`, `NumCategorie`, `mail`, `parcours`, `course`, `NomDepart`,
    `NomCategorie`, `NomEquipe`, `NomDisc2`, `PrenomDisc2`, `NomDisc3`,
    `PrenomDisc3`, `NomDisc4`, `PrenomDisc4`, `NomDisc5`, `PrenomDisc5`,
    `NomDisc6`, `PrenomDisc6`, `Login`, `Prix`, `NomDisc1`, `PrenomDisc1`,
    `Payer`, `PayementOnLine`, `Partenaire`, `Informations`, `TypeEquipe`,
    `PrixSouvenir`, `NbrEtape`, `Remarques`) 
	VALUES (
    :nom, :prenom, :adresse, :npa, :localite, :dateNaissance, :sexe,
    :club, :numCategorie, :mail, :parcours, :course, :nomDepart,
    :nomCategorie, :nomEquipe, :nomDisc2, :prenomDisc2, :nomDisc3,
    :prenomDisc3, :nomDisc4, :prenomDisc4, :nomDisc5, :prenomDisc5,
    :nomDisc6, :prenomDisc6, :login, :prix, :nomDisc1, :prenomDisc1,
    :payer, :payementOnLine, :partenaire, :informations, :typeEquipe,
    :prixSouvenir, :nbrEtape, :remarques)';

$stmt = $pdo->prepare($sql);

$ResultAddInsc =$stmt->execute([
    'nom'             => majuscules($_POST['nom']),
    'prenom'          => majuscules($_POST['prenom']),
    'adresse'         => $_POST['adresse'],
    'npa'             => $_POST['zip'],
    'localite'        => majuscules($_POST['ville']),
    'dateNaissance'   => $_POST['date'],
    'sexe'            => $Sexe,
    'club'            => $_POST['club'],
    'numCategorie'    => $_POST['NumCat'],
    'mail'            => $_POST['email'],
    'parcours'        => $_POST['NomParcours'],
    'course'          => $_POST['NomCourse'] . $_POST['AnneeCourse'],
    'nomDepart'       => $arDepart[2],
    'nomCategorie'    => $_POST['NomCat'],
    'nomEquipe'       => $_POST['NomEquipe'],
    'nomDisc2'        => $_POST['NomDisc2'],
    'prenomDisc2'     => $_POST['PrenomDisc2'],
    'nomDisc3'        => $_POST['NomDisc3'],
    'prenomDisc3'     => $_POST['PrenomDisc3'],
    'nomDisc4'        => $_POST['NomDisc4'],
    'prenomDisc4'     => $_POST['PrenomDisc4'],
    'nomDisc5'        => $_POST['NomDisc5'],
    'prenomDisc5'     => $_POST['PrenomDisc5'],
    'nomDisc6'        => $_POST['NomDisc6'],
    'prenomDisc6'     => $_POST['PrenomDisc6'],
    'login'           => $_SESSION["user"]["login"],
    'prix'            => $_POST['TotalPayer'],
    'nomDisc1'        => $_POST['NomDisc1'],
    'prenomDisc1'     => $_POST['PrenomDisc1'],
    'payer'           => $Status,
    'payementOnLine'  => $_POST['OnLine'],
    'partenaire'      => $partenaire,
    'informations'    => $_POST['strCodeReduction'],
    'typeEquipe'      => $_POST['Equipe'],
    'prixSouvenir'    => $TailleTShirt,
    'nbrEtape'        => $_POST['Option'],
    'remarques'       => $_POST['Remarques']
]);
			
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
				
			$sql = 'SELECT * FROM CodeReduction WHERE Code = :code';

			$stmt = $pdo->prepare($sql);
			$stmt->execute([
				'code' => $ArrInfoCode[0]
			]);

			$result = $stmt->fetch(PDO::FETCH_ASSOC);
			$count = count($results);
			if ($count > 0 ) 
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
					// Mise à jour de l'entrée dans la base de données
					// Enregistrement du login qui utilise le code de réduction

					$sql = 'UPDATE CodeReduction
							SET LoginValid = :login
							WHERE ID = :id';

					$stmt = $pdo->prepare($sql);

					$stmt->execute([
						'login' => $_SESSION['user']['login'] ?? $_SESSION['Login'],
						'id'    => $IDCode
					]);
			
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

		if (strlen ($course['IBAN'])>0 && $_POST['OnLine'] == "false" )
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
					mail($_POST['email'], 'Confirmation inscription '.$NOM_COURSE." ".$ANNEE_COURSE, $Text,$headers);
			
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
					mail($_POST['email'], 'Confirmation inscription '.$NOM_COURSE." ".$ANNEE_COURSE, $Text,$headers);
				}
			
			}
			
			header('Location: ../pages/member/cart.php');
		}
		else
		{
			echo "Error insert : Ajout inscription";
		} 
			
		
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



