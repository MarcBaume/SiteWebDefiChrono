<!DOCTYPE html>
<html>
<head>
	<meta property="og:description" content="chronométrage, chrono, jura, franches-montagnes, Jura défi, course à pied, Sport, Jura défi chrono" />  
	<title>Défi Chrono</title>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, maximum-scale=1.0, user-scalable=yes">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css">
	<link rel="stylesheet" title="defaut" media="screen" href="../styleV6.css" type="text/css"/>
<!--	<link rel="stylesheet" type="text/css" media="screen and (max-width: 480px)" href="style-mobilV2.css" /> -->
</head>
<body>


<?php
  include("../Header2023.php"); 
  ?>
  </br>
<div id="corps">
<a>
 <?php
$con = mysqli_connect('dxvv.myd.infomaniak.com', 'dxvv_christopheJ', 'er3z4aet1234');
if (!$con)
  {
  die('Could not connect: ' . mysql_error());
  }
  else
  {
	  mysqli_select_db($con ,'dxvv_jurachrono' );

	//  Récupération de l'utilisateur et de son pass hashé
	$sql ='SELECT * FROM Login  WHERE Login=\''.$_POST["login1"].'\''; 
	//'SELECT ID, pass FROM Login WHERE Login=\''.$_POST["login"].'\''; 
	$result = mysqli_query($con,$sql);
 
	if ($result && mysqli_num_rows($result) > 0) 
	{
	  while($val = mysqli_fetch_assoc($result)) 
	  {
  
		// Comparaison du pass envoyé via le formulaire avec la base
		$isPasswordCorrect = password_verify($_POST['pass1'], $val['Password']);

			if ($isPasswordCorrect) {
				session_start();
				$_SESSION['id'] = $val['ID'];
				$_SESSION['Login'] = $_POST['login1'];
				$_SESSION['Niveau'] = $val['Niveau'];
	
				$_SESSION['Course'] = $_POST['NomCourse'];
				$_SESSION['DateCourse'] = $_POST['DateCourse'];
				$_SESSION['Nbretape'] =  $_POST['Nbretape'];
		
				echo 'Vous êtes connecté !';
					    echo 'Bonjour ' . $_SESSION['Login'];
		
				$url = "login.php";
			
			}
			else {
	
				$url = "login.php?Login=false";
				echo 'Mot de passe incorrect';
			
			}
			header("Location: ".$url);
			
		}
	}
	else
	
	{
		$url = "login.php?Login=false";

		echo 'Login non existant';
			
			header("Location: ".$url);
	}
}
?>
</a>
  </body>