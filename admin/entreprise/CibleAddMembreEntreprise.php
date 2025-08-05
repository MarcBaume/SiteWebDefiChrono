
<?php
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
		$Status=1;
          mysqli_select_db($con ,'dxvv_jurachrono' );
 		$date = $_POST["dateNaissance"].'-01-01 00:00:00';
          $sql = 'INSERT INTO Membres (`LoginCompte`,`Nom`, `Prenom`, `adresse`,`npa`,`localite`,`DateNaissance`,`sexe`,
		`club`, `mail`,`Pays`,`Valider`,`NbrEtape`)
		 VALUES
			("'.$_POST['login'].'", 
			"'.majuscules($_POST['nom']).'",
			"'.majuscules($_POST['prenom']).'",
			"'.$_POST['adresse'].'", 
			"'.$_POST['zip'].'", 	
			"'.majuscules($_POST['ville']).'", 
			"'.$date.'",
			"'.$_POST['sexe'].'",	
			"'.$_POST['club'].'", 
			"'.$_POST['email'].'", 
			"'.$_POST['pays'].'",
			"'.$Status.'",
			"'.$_POST['NbrEtape'].'");';
			echo  $sql;

			$ResultAddInsc = mysqli_query($con,$sql);	

			if ( $ResultAddInsc == 1)
			{
				$last_id = $con->insert_id;

				$message = "<head>
					<title>Votre profil à été transmis à votre administrateur</title>
					</head>
					<h2 style='background-color: #3D6CA4;padding : 10px ;color :#fff'>Votre profil à été transmis à votre administrateur </h2></br></br>

							Quand Celui-ci t'auras ajoué à une équipe, tu vas recevoir un e-mail qui va te confirmer que tu seras inscrit à ta course
							</br></br>
							Meilleures salutations et rendez-vous à notre évenement en grande forme ! </br></br>
							Team Defi Chrono
						<p>
						<img style='width:200px;'src='https://defichrono.ch/images/LogoDefiChrono2023.png'></img>
						</p></br></br></body></html>";

				$headers = array(
				'From' => 'Défi chrono<webmaster@defichrono.ch>',
				'Reply-To' => 'Défi chrono<webmaster@defichrono.ch>',
				'Content-Type' => 'text/html; charset=utf-8');
				if ( mail( $_POST['email'] , 'Confirmation inscription(s) Défi chrono',$message ,$headers))
				{

				}


				
				$message = "<head>
					<title>'Profil ajoué à votre entreprise de ".$_POST['nom']." ". $_POST['prenom']."</title>
					</head>
					<h2 style='background-color: #3D6CA4;padding : 10px ;color :#fff'>Profil créé de ".$_POST['nom']." ". $_POST['prenom']."</h2></br></br>

							<a href='https://defichrono.ch/admin/login.php'>Créer mes équipes ici </a>
							</br></br>
							Meilleures salutations et rendez-vous à notre évenement en grande forme ! </br></br>
							Team Defi Chrono
						<p>
						<img style='width:200px;'src='https://defichrono.ch/images/LogoDefiChrono2023.png'></img>
						</p></br></br></body></html>";

				$headers = array(
				'From' => 'Défi chrono<webmaster@defichrono.ch>',
				'Reply-To' => 'Défi chrono<webmaster@defichrono.ch>',
				'Content-Type' => 'text/html; charset=utf-8');
				if ( mail( $_POST['login'] , 'Profil créé de '.$_POST['nom'].' '. $_POST['prenom'],$message ,$headers))
				{
						header('Location: SucessAddMembreEntreprise.php');
				}
			}
			echo  $ResultAddInsc;

     }
     catch(Exception $e)
     {
		
     }    

}?>
