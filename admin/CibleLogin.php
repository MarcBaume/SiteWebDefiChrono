<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="fr" lang="fr">
    <head>
        <title>Jura défi chrono</title>
        <meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
    <link rel="stylesheet" media="screen" type="text/css" title="Design" href="../style.css" />

	</head>

  <body>
	  <?php  include("../onglets.php"); ?>
</br>
   <div id="menu_vertical">
	<li>
		<a href="../index.php">Accueil</a>
   </li>
</div>
 <?php
	include("../MysqlConnect.php");
	//  Récupération de l'utilisateur et de son pass hashé
	$sql ='SELECT * FROM Login  WHERE Login=\''.$_POST["login"].'\''; 
	//'SELECT ID, pass FROM Login WHERE Login=\''.$_POST["login"].'\''; 
	$result = mysqli_query($con,$sql);
 
	if ($result && mysqli_num_rows($result) > 0) 
	{
	  while($val = mysqli_fetch_assoc($result)) {
  
		// Comparaison du pass envoyé via le formulaire avec la base
		$isPasswordCorrect = password_verify($_POST['pass'], $val['Password']);

			if ($isPasswordCorrect) {
				session_start();
				$_SESSION['id'] = $val['ID'];
				$_SESSION['Login'] = $_POST['login'];
				$_SESSION['Niveau'] = $val['Niveau'];
	
				$_SESSION['Course'] = $_POST['nom_course'];
				$_SESSION['DateCourse'] = $_POST['date_course'];
				$_SESSION['Nbretape'] =  $_POST['Nbretape'];
				echo 'Vous êtes connecté !';
			//		    echo 'Bonjour ' . $_SESSION['Login'];
				header('Location: login.php'); 
			}
			else {
				echo 'Mauvais mot de passe !';
			}
		}
	}
	else
	
	{
		echo 'Mauvais identifiant ou mot de passe !'. $_POST["login"];
	}

?>
  </body>