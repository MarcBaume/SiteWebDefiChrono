<!DOCTYPE html>
<html>
	  <script src="https://www.google.com/recaptcha/api.js" async defer></script>
 <!-- <script src="https://www.google.com/recaptcha/enterprise.js?render=6LcAOHEsAAAAAByjYGR-WuK7fHzB164hyVoC-EPq"></script>
-->
<!-- initilisation de variable -->
 <?php
 // Inclure un fichier de configuration

include("HeaderEntreprise.php"); 
  ?>
<?php
require_once 'autoload.php';
if (isset($_POST['sendForm']))
{
	$recaptcha = new \ReCaptcha\ReCaptcha(
    '6LdrZnIsAAAAABwlvrpKQr4iYBc5Va5uBBDtrV2X',
    new \ReCaptcha\RequestMethod\CurlPost()
);
	$gRecaptchaResponse = $_POST['g-recaptcha-response'];

	$resp = $recaptcha->setExpectedHostname('defichrono.ch')
					->verify($gRecaptchaResponse, $remoteIp);
	if ($resp->isSuccess()) {
		if (isset($_POST['login']) AND isset($_POST['pass']))
		{
			$login = $_POST['login'];
			$pass_crypte = password_hash($_POST['pass'], PASSWORD_DEFAULT); // On crypte le mot de passe
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
					header('Location: ../login.php'); 
	
	}

	} else {
		var_dump($errors);
	}
}
?>
<div id="corps"> 
    
	<div class="para">
	<div class="title"> Créer un compte entreprise : </div>
		<form id="formConnect" method="post">
			<input type="hidden" name="recaptchaToken" id="recaptchaToken" />
	  		<input type="hidden" name="date_course" id="date_course"   value= '<?php echo $_GET['DateCourse'] ?>' />
			<input type="hidden" name="nom_course" id="nom_course"  value= '<?php echo $_GET['NomCourse'] ?>' />
			<input type="hidden" name="Nbretape" id="Nbretape" value= '<?php echo  $_GET['Nbretape'] ?>' />
			<label for="login">Votre adresse e-mail :</label> <input type="text" name="login" id="login" tabindex="10" /> 
			<label for="pass">Votre mot de passe :</label> <input type="password"  name="pass" id="pass" tabindex="15" /> 
			<label for="pass2">Répétez  votre mot de passe :</label> <input type="password"  name="pass2" id="pass2" tabindex="15" /> 
		  	<div class="g-recaptcha" data-sitekey="6LdrZnIsAAAAABv00M_s6RbXotgPuvq6rVl4HuLh"></div>
			<input type="submit" name="sendForm" value="Submit">
	 	</form>
	</div>
</div>
 </body>
</html>
<script>

  var onloadCallback = function() {
    alert("grecaptcha is ready!");
  };

function isMail(txtMail)
{
	var regMail=new RegExp("^[0-9a-z._-]+@{1}[0-9a-z. -]{2,}[.]{1}[a-z]{2,5}$", "i");
	return regMail.test(txtMail);
}
</script>