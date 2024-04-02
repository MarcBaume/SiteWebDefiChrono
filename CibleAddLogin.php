<!DOCTYPE html>
<html>
<head>
	<meta property="og:description" content="chronométrage, chrono, jura, franches-montagnes, Jura défi, course à pied, Sport, Jura défi chrono" />  
	<title>Défi Chrono</title>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, maximum-scale=1.0, user-scalable=yes">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css">
	<link rel="stylesheet" title="defaut" media="screen" href="styleV6.css" type="text/css"/>
<!--	<link rel="stylesheet" type="text/css" media="screen and (max-width: 480px)" href="style-mobilV2.css" /> -->
</head>

    <body>

<?php
  include("Header2023.php"); 
  ?>
<div id="corps">


<?php
if (isset($_POST['login']) AND isset($_POST['pass']))
{
// Establishing Connection with Server by passing server_name, user_id and password as a parameter
	$con = mysqli_connect('dxvv.myd.infomaniak.com', 'dxvv_christopheJ', 'er3z4aet1234');
	// Selecting Database
	mysqli_select_db($con ,'dxvv_jurachrono' );
$login = $_POST["login"];
// Verifier si login pas existant
	$sql = 'SELECT * FROM Login WHERE Login=\''.$login.'\'';
	$result = mysqli_query($con,$sql);

    // On affiche chaque entrée une à une
	if ( !$result || mysqli_num_rows($result) > 0) 
	{
	?>Cette adresse e-mail est déjà utilisé par un compte<?php
	}
	else
	{

    $login = $_POST['login'];
    $pass_crypte = password_hash($_POST['pass'], PASSWORD_DEFAULT); // On crypte le mot de passe

	
	
	if (!$con)
	{
		die('Could not connect: ' . mysql_error());
	}

	$sql = 'INSERT INTO Login (`Login`, `Password`,`Niveau`)
	VALUES
	("'.$login.'", 
	"'.$pass_crypte.'",
	"3");';
	

	$result = mysqli_query($con,$sql);

    mail($_POST['login'], 'Confirmation création de compte jura défi chrono',
	"Bonjour ".$_POST['login']."\n".
	"Vous pouvez dès à présent enregistrer vos coureurs en vous connectant sur la page d'accueil\n
	Quand vos coureurs seront enregistrés, il est possible de les inscrire à la course que vous désirez\n \n 
	Jura Défi chrono vous souhaite de bonnes courses à nos divers évènements." );
	 
	
	session_start();

				$_SESSION['Course'] = $_POST["nom_course"];
				$_SESSION['DateCourse'] = $_POST['date_course'];
				$_SESSION['Login'] = $login;
				$_SESSION['Niveau'] = "3";
				$_SESSION['Nbretape'] =  $_POST['Nbretape'];
				echo 'Vous êtes connecté !'.$_POST['nom_course'];
				    echo 'Bonjour ' . $_SESSION['Login'];
				  header('Location: admin/login.php'); 
	
   /*echo $ton_contenu  ;
	file_put_contents('admin/.htpasswd', $ton_contenu, FILE_APPEND);*/
	
	}

}

 ?>    
 </div>
    </body>
</html>