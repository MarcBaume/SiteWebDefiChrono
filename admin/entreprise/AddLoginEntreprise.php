<!DOCTYPE html>
<html>

<!-- initilisation de variable -->
 <?php
include("HeaderEntreprise.php"); 
  ?>
<div id="corps"> <?
   $_SESSION['Nbretape'] =  $_GET['Nbretape'];
 	$_SESSION['Course'] =  $_GET['NomCourse']  ;
$_SESSION['DateCourse'] = $_GET['DateCourse'];?>

	<div class="para">
	<div class="title"> Créer un compte entreprise : </div>
		<form id="formConnect" method="post" action="CibleAddLoginEntreprise">
	  	<input type="hidden" name="date_course" id="date_course"   value= '<?php echo $_GET['DateCourse'] ?>' />
		<input type="hidden" name="nom_course" id="nom_course"  value= '<?php echo $_GET['NomCourse'] ?>' />
		<input type="hidden" name="Nbretape" id="Nbretape" value= '<?php echo  $_GET['Nbretape'] ?>' />
		<p><a> <label for="login">Votre adresse e-mail :</label> <input type="text" name="login" id="login" tabindex="10" /> </a></p>
		<p><a> <label for="pass">Votre mot de passe :</label> <input type="password"  name="pass" id="pass" tabindex="15" /> </a></p>
		<p><a> <label for="pass2">Répétez  votre mot de passe :</label> <input type="password"  name="pass2" id="pass2" tabindex="15" /> </a></p>
		<p><a name="captcha" id="captcha" > </a></p>
		<button class="g-recaptcha" 
        data-sitekey="6LfTKiosAAAAAFVr_Cko0pyL2H1Nus8-MtSwPQcC" 
        data-callback='onSubmit' 
        data-action='submit'>Submit</button>

	 </form>
	</div>
</div>

     <script src='https://www.google.com/recaptcha/api.js'></script> 
		<script> 
   function onSubmit(token) {
     document.getElementById("formConnect").submit();
   }
 </script>
 </body>
</html>
<script>

function isMail(txtMail)
{
	var regMail=new RegExp("^[0-9a-z._-]+@{1}[0-9a-z. -]{2,}[.]{1}[a-z]{2,5}$", "i");
	return regMail.test(txtMail);
}
function check(f1) {
	

		if (!isMail(f1.login.value)) {
			alert("Merci d'indiquer un mail valide");
			f1.login.focus();
			return false;
		}
		if (f1.pass.value.length<1)
		{
			alert("Veuillez écrire un mot de passe");
			f1.pass.focus();
			return false;
		}
		if (f1.pass.value != f1.pass2.value ) {
			alert("votre mot de passe n'est pas identique");
			return false;
		}

f1.submit();
	
}
</script>