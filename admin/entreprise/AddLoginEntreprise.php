<!DOCTYPE html>
<html>
  <script src="https://www.google.com/recaptcha/enterprise.js?render=6LcAOHEsAAAAAByjYGR-WuK7fHzB164hyVoC-EPq"></script>

<!-- initilisation de variable -->
 <?php
 // Inclure un fichier de configuration
require_once '../../config.php'; 

include("HeaderEntreprise.php"); 
  ?>

<div id="corps"> 
	<div class="para">
	<div class="title"> Créer un compte entreprise : </div>
		<form id="formConnect" method="post" action="CibleAddLoginEntreprise.php">
			<input type="hidden" name="recaptchaToken" id="recaptchaToken" />
	  		<input type="hidden" name="date_course" id="date_course"   value= '<?php echo $_GET['DateCourse'] ?>' />
			<input type="hidden" name="nom_course" id="nom_course"  value= '<?php echo $_GET['NomCourse'] ?>' />
			<input type="hidden" name="Nbretape" id="Nbretape" value= '<?php echo  $_GET['Nbretape'] ?>' />
			<label for="login">Votre adresse e-mail :</label> <input type="text" name="login" id="login" tabindex="10" /> 
			<label for="pass">Votre mot de passe :</label> <input type="password"  name="pass" id="pass" tabindex="15" /> 
			<label for="pass2">Répétez  votre mot de passe :</label> <input type="password"  name="pass2" id="pass2" tabindex="15" /> 
		<div >
			<label for="info">Informations:</label> <input type="textarea"  name="txtInfo" id="txtInfo" readonly /> 
		</div>
			<a name="captcha" id="captcha" > </a>
		<button class="g-recaptcha"
    data-sitekey="6LcAOHEsAAAAAByjYGR-WuK7fHzB164hyVoC-EPq"
    data-callback='onSubmit'
    data-action='submit'>
  Submit
</button>
	 </form>
	</div>
</div>
      <form method="post" id="FormResponseCaptcha" action="captcha.php">
	<input type="hidden" name="inputToken" id="inputToken" />	
</form>
 </body>
</html>
<script>


function isMail(txtMail)
{
	var regMail=new RegExp("^[0-9a-z._-]+@{1}[0-9a-z. -]{2,}[.]{1}[a-z]{2,5}$", "i");
	return regMail.test(txtMail);
}
function onSubmit(token)
 {
	
	console.log("funcheck v2:");
	console.log(token);
	inputToken = document.getElementById("inputoken");
	console.log("Wait Response");
	// Envoi des données via jQuery AJAX
	$.ajax({
		url: 'captcha.php',
		type: 'POST',
		data: $form.serialize(), // Sérialise tous les champs dont le token
		dataType: 'json',
		success: function(response) {
			if(response.success && response.score >= 0.5) {
				alert('Succès ! Message envoyé.');
			} else {
				alert('Échec : possible robot (Score: ' + response.score + ')');
			}
		}
	});

	
}
</script>