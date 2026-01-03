<!DOCTYPE html>
<html>
<head>
	<meta property="og:description" content="chronométrage, chrono, jura, franches-montagnes, Jura défi, course à pied, Sport, Jura défi chrono" />  
	<title>Défi Chrono</title>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, maximum-scale=1.0, user-scalable=yes">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css">
	<link rel="stylesheet" title="defaut" media="screen" href="../../css/style.css" type="text/css"/>
	<script src="../../../js/prototype.js" ></script>
<script src="../../../js/FonctionDefiChrono2.js?version = 1.0.0"></script>
<!--	<link rel="stylesheet" type="text/css" media="screen and (max-width: 480px)" href="style-mobilV2.css" /> -->
</head>

    <body>
 <?php
// Inclure un fichier de configuration
require_once '../../config.php'; 

include("HeaderEntreprise.php"); 
echo("Test1");
echo (KEY_CAPTCHA);
  ?>
<div id="corps">
<script>
function ResultCaptcha()
{
	console.log("Captcha Result fonction")
    $('FormResponseCaptcha').request({
            onComplete: function(transport){

                val =transport.responseText.evalJSON();
                console.log(val);
            }
        });
}

	
</script>
<form method="post" id="FormResponseCaptcha" action="https://www.google.com/recaptcha/api/siteverify">
	<input type="hidden" name="secret" id="secret"   value= '6LfTKiosAAAAAFVr_Cko0pyL2H1Nus8-MtSwPQcC' />
	<input type="hidden" name="response" id="response"  value= '<?php echo $_POST['g-recaptcha-response'] ?>' />	
</form>

<script>
	console.log("Start");
	ResultCaptcha()
</script>   
<?php



if (isset($_POST['login']) AND isset($_POST['pass']))
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
	"1");';
	

	$result = mysqli_query($con,$sql);

	
	$message = 
	'<html>
	<head>
	<title>Nouveau compte défi chrono</title>
	<style>
table, td, th {
  border: 1px solid;
  padding : 5px;
}

table {
  border-collapse: collapse;
}
		
	</style>
	</head>
  
	<h2 style="background-color: #3D6CA4;padding : 10px ;color :#fff"  > Création d\'un nouveau compte</h2>

	<p>Bonjour '.$_POST['login'].'</p>
<p>
	Bienvenue dans l\'univers Entreprise de défi chrono </br></br>
	
	Voici les avantages de la création de ce compte entreprise:</p>
	<ul>
  <li>Enregistrer ses athlètes pour facilier l\'inscription des prochaines courses</li>
</ul>
<p>
</p>  
<p> Défi Chrono te souhaite d\'excellentes courses</p> </br></br>


	<img style="width:200px;"src="https://defichrono.ch/images/LogoDefiChrono2023.png"></img>
	</html>';
	
 
	$from = "webmaster@defichrono.ch";
	$headers = array(
		'From' => 'Defi chrono<webmaster@defichrono.ch>',
		'Reply-To' => 'Defi chrono<webmaster@defichrono.ch>',
		'Content-Type' => 'text/html; charset=utf-8'
	);

	$to = $_POST['login'];
	$subject = "Nouveau compte defi chrono";

    mail($to,$subject,$message, $headers);
	
	session_start();

				$_SESSION['Course'] = $_POST["nom_course"];
				$_SESSION['DateCourse'] = $_POST['date_course'];
				$_SESSION['Login'] = $login;
				$_SESSION['Niveau'] = "1";
				$_SESSION['Nbretape'] =  $_POST['Nbretape'];
				echo 'Vous êtes connecté !'.$_POST['nom_course'];
				    echo 'Bonjour ' . $_SESSION['Login'];
				  header('Location: admin/login.php'); 
	
   /*echo $ton_contenu  ;
	file_put_contents('admin/.htpasswd', $ton_contenu, FILE_APPEND);*/
	
	}


 ?> 
 
 </div>
    </body>
</html>
