<!DOCTYPE html>
<html>
<head>
	<meta property="og:description" content="chronométrage, chrono, jura, franches-montagnes, Jura défi, course à pied, Sport, Jura défi chrono" />  
	<title>Défi Chrono</title>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, maximum-scale=1.0, user-scalable=yes">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css">
	<link rel="stylesheet" title="defaut" media="screen" href="css/style.css" type="text/css"/>
<!--	<link rel="stylesheet" type="text/css" media="screen and (max-width: 480px)" href="style-mobilV2.css" /> -->
</head>

    <body>

<?php
  include("Header2023.php"); 
  ?>
<div id="corps"> <?
   $_SESSION['Nbretape'] =  $_GET['Nbretape'];
 	$_SESSION['Course'] =  $_GET['NomCourse']  ;
$_SESSION['DateCourse'] = $_GET['DateCourse'];?>
<img src="images/FilRougeInscription2.png" style="width: 100%"  >
	<div id="formulaire">
	<div class="title"> Créer un compte : </div>
	  <form method="post" action="CibleAddLoginV2.php">
	  	<input type="hidden" name="date_course" id="date_course"   value= '<?php echo $_GET['DateCourse'] ?>' />
		<input type="hidden" name="nom_course" id="nom_course"  value= '<?php echo $_GET['NomCourse'] ?>' />
		<input type="hidden" name="Nbretape" id="Nbretape" value= '<?php echo  $_GET['Nbretape'] ?>' />
		<input type="hidden" name="idRace" id="idRace" value= '<?php echo  $_GET['ID'] ?>' />
		<p><a> <label for="login">Votre adresse e-mail :</label> <input type="text" name="login" id="login" tabindex="10" /> </a></p>
		<p><a> <label for="pass">Votre mot de passe :</label> <input type="password"  name="pass" id="pass" tabindex="15" /> </a></p>
	<p><a> <label for="pass2">Répétez  votre mot de passe :</label> <input type="password"  name="pass2" id="pass2" tabindex="15" /> </a></p>
		<p id="paraInformation" style="display:none"><a> <label for="txtInformation">Informations</label> 
		<input style="color:red"type="textarea" value="test" readOnly name="txtInformation" id="txtInformation" /> </a></p>
		<input class="Button" type="button" onClick="check(this.form)" value="Créer mon compte"  > 
	 </form>
	</div>
</div>
<script src='https://www.google.com/recaptcha/api.js'></script> 
<script> function get_action(form) 
{ 
	var v = grecaptcha.getResponse();
	if(v.length == 0) 
	{ 
		document.getElementById('captcha').innerHTML="You can't leave Captcha Code empty";
			return false; 
	} else 
	{ 
		document.getElementById('captcha').innerHTML="Captcha completed"; 
		return true;
	} 
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
function alertDefi(Text)
{
	lblInfo =document.getElementById("paraInformation");
	txtInfo = document.getElementById("txtInformation");
	lblInfo.style.display = "block";
	txtInfo.value= Text;
}
function RazAlertDefi()
{
	lblInfo =document.getElementById("paraInformation");
	txtInfo = document.getElementById("txtInformation");
	lblInfo.style.display = "none";
	txtInfo.value= "";
}
function check(f1) 
{
	if (!isMail(f1.login.value)) 
	{
		alertDefi("Merci d'indiquer un mail valide");
		f1.login.focus();
		return false;
	}

	if (f1.pass.value.length>20)
	{
		alertDefi("Votre mot de passe est trop long");
		f1.pass.focus();
		return false;
	}

	if (f1.pass.value.length<6)
	{
		alertDefi("Veuillez écrire un mot de passe d'au moins 6 caractères");
		f1.pass.focus();
		return false;
	}

	if (f1.pass.value != f1.pass2.value ) {
		alertDefi("votre mot de passe n'est pas identique");
		return false;
	}
	RazAlertDefi();
	f1.submit();
}
</script>