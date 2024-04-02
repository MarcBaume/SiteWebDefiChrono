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
  include("Header.php"); 
  ?>
<div id="corps">

<?php
session_start();?>
<script type="text/javascript">

function checkForm(f) {

	if (confirm("Etes-vous sur des informations de votre inscriptions?")) {
	f.submit();
	}
}
</script>
	 <h3>
	Mot de passe oublié :
	</h3>
	<div id="formulaire">
	  <form method="post" action="CiblePasswordSend.php">
		<p><a> <label for="Nom">Adresse e-mail :</label> <input type="text" name="Login" id="Login" tabindex="10" /> </a></p>
		<p><input type="submit" value="Envoyer"  style= " width: 100px; height: 25px";>  </p>
	
	 </form>
	</div>
	<p> Vous allez reçevoir un e-mail avec un lien pour réinitialiser votre mot de passse </p>
</div>
     
 </body>
</html>