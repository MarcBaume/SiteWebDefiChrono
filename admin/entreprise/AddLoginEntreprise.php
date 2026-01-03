<!DOCTYPE html>
<html>


<!-- initilisation de variable -->
 <?php
 // Inclure un fichier de configuration
require_once '../../config.php'; 

include("HeaderEntreprise.php"); 
  ?>

<div id="corps"> <?
   $_SESSION['Nbretape'] =  $_GET['Nbretape'];
 	$_SESSION['Course'] =  $_GET['NomCourse']  ;
$_SESSION['DateCourse'] = $_GET['DateCourse'];?>

	<div class="para">
	<div class="title"> Créer un compte entreprise : </div>
		<form id="formConnect" method="post" action="CibleAddLoginEntreprise.php">
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
        data-sitekey=KEY_CAPTCHA 
        data-callback='check' 
        data-action='submit'>Création compte</button>

	 </form>
	</div>
</div>
       <script src='https://www.google.com/recaptcha/api.js'></script> 
 </body>
</html>
<script>

function isMail(txtMail)
{
	var regMail=new RegExp("^[0-9a-z._-]+@{1}[0-9a-z. -]{2,}[.]{1}[a-z]{2,5}$", "i");
	return regMail.test(txtMail);
}
function check(token)
 {
	f1 = document.getElementById("formConnect")
	if (!isMail(f1.login.value)) {
		f1.txtInfo.value = "Merci d'indiquer une adresse email valide";
		f1.login.focus();
		return false;
	}
	if (f1.pass.value.length<6)
	{
		f1.txtInfo.value = "Veuillez écrire un mot de passe composer de aux moins 6 caractères avec aux moins 1 caractère spécial et aux moins 1 chiffre";
		f1.pass.focus();
		return false;
	}
	if (f1.pass.value != f1.pass2.value ) {
		f1.txtInfo.value ="votre mot de passe n'est pas identique";
		f1.pass2.focus();
		return false;
	}
	f1.submit();
	
}
</script>