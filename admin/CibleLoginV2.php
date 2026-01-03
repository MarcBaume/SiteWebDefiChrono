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
  include("../Header.php"); 
  ?>
<div id="corps">

 <?php
	include("../MysqlConnect.php");
	//  Récupération de l'utilisateur et de son pass hashé
	$sql ='SELECT * FROM Login  WHERE Login=\''.$_POST["login"].'\''; 
	//'SELECT ID, pass FROM Login WHERE Login=\''.$_POST["login"].'\''; 
	$result = mysqli_query($con,$sql);
 
	if ($result && mysqli_num_rows($result) > 0) 
	{
	  while($val = mysqli_fetch_assoc($result)) 
	  {
  
		// Comparaison du pass envoyé via le formulaire avec la base
		$isPasswordCorrect = password_verify($_POST['pass'], $val['Password']);

			if ($isPasswordCorrect) {
				session_start();
				$_SESSION['id'] = $val['ID'];
				$_SESSION['Login'] = $_POST['login'];
				$_SESSION['Niveau'] = $val['Niveau'];
	
				$_SESSION['Course'] = $_POST['NomCourse'];
				$_SESSION['DateCourse'] = $_POST['DateCourse'];
				$_SESSION['Nbretape'] =  $_POST['Nbretape'];
		
				echo 'Vous êtes connecté !';
					    echo 'Bonjour ' . $_SESSION['Login'];
						if ($val['Niveau'] <3)
						{
							$url = "login.php";
						}
						else
						{
							$url = $_SERVER['HTTP_REFERER'];
						}
			}
			else {
				if (strpos($_SERVER['HTTP_REFERER'], 'NomCourse')== false   )
				{
					if  (strpos($_SERVER['HTTP_REFERER'], 'Login=false')== false)
					{
						$url = $_SERVER['HTTP_REFERER'] ."?Login=false";
					}
					else
					{
						$url = $_SERVER['HTTP_REFERER'];
					}
				}
				else
				{
					if  (strpos($_SERVER['HTTP_REFERER'], 'Login=false')== false)
					{
						$url = $_SERVER['HTTP_REFERER'] ."&Login=false";
					}
					else
					{
						$url = $_SERVER['HTTP_REFERER'];
					}
				}

			
			
			}
			header("Location: ".$url);
		}
	}
	else
	
	{
			if  (strpos($_SERVER['HTTP_REFERER'], 'Login=false')== false)
					{
						$url = $_SERVER['HTTP_REFERER'] ."&Login=false";
					}
					else
					{
						$url = $_SERVER['HTTP_REFERER'];
					}
					header("Location: ".$url);
	}

?>
  </body>