<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
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
 
<?php  include("Header2023.php"); 
setlocale (LC_TIME, 'fr_FR.utf8','fra');?>
<script type="text/javascript">

function check(f1) {
	

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
<div id="corps">
<H2> Réinitialisation mot de passe </h2>
	<div id="formulaire">
	  <form method="post" action="CibleModificationPassword.php">
		<p><a> <label for="Nom">Adresse e-mail :</label> <input type="text" name="login" readonly="True" value="<? echo $_GET["Login"]?>" id="login"  tabindex="10" /> </a></p>
		<p><a> <label for="Nom">Mot de passe :</label> <input type="password"  name="pass" id="pass" tabindex="15" /> </a></p>
		<p><a> <label for="Nom">Répéter le mot de passe :</label> <input type="password"  name="pass2" id="pass2" tabindex="15" /> </a></p>
		
		<center>
		<input type="button" onClick="check(this.form)" value="Réinitialiser mon mot de passe" class="ButtonResultat"   style= " width: 300px; height: 50px; Background:white";>  
</center>
	 </form>
	</div>
</div>
     
 </body>
</html>