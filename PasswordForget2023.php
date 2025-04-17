<!DOCTYPE html>
<html>
<head>
<meta http-equiv="cache-control" content="no-cache"> <!-- tells browser not to cache -->
<meta http-equiv="expires" content="0"> <!-- says that the cache expires 'now' -->
<meta http-equiv="pragma" content="no-cache"> <!-- says not to use cached stuff, if there is any -->
	<meta property="og:description" content="chronométrage, chrono, jura, franches-montagnes, Jura défi, course à pied, Sport, Jura défi chrono" />  
	<title>Défi Chrono</title>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, maximum-scale=1.0, user-scalable=yes">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css">
	<link rel="stylesheet" title="defaut" media="screen" href="styleV6.css" type="text/css"/>
<!--	<link rel="stylesheet" type="text/css" media="screen and (max-width: 480px)" href="style-mobilV2.css" /> -->
    <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js">
	 </script>
<script src="../js/prototype.js" ></script>
<script src="../js/FonctionDefiChrono2.js?v=1"></script>
</script>
</head>

    <body>

<?php
  include("Header2023.php"); 
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
	<div >
	  <form   id="formulaire" name="formulaire"  method="get" action="CiblePasswordSend2023.php">
		<p><a> <label for="Nom">Adresse e-mail :</label> <input type="text" name="Login" id="Login" tabindex="10" /> </a></p>
        
			<Center><input type="button" style="height:50px;font-size:80%;Background:white; width: 300px;"  class="ButtonResultat" id="ButtonSend" value="Recevoir mon mot de passe" onclick="SendPassword()" >  </input>
</center>
		
	
	 </form>
	</div>
	<p  id="CheckLogin"> ce login n'existe pas</p>

	<p id="OkLOgin" style="visibility:collapse;"> Vous allez recevoir un e-mail avec un lien pour réinitialiser votre mot de passse, vérifier vos "SPAM", si vous n'avez rien reçu contacter info@defichrono.ch</p>
</div>
     
 </body>
</html>

<script>
    document.getElementById("CheckLogin").style.display = "none" ;
    document.getElementById("CheckLogin").style.visibility = "hidden" ;
    document.getElementById("OkLOgin").style.visibility = "none" ;
    document.getElementById("OkLOgin").style.display  = "hidden" ;

function SendPassword()
{
	// Appelle fonction php pour ajouter un
 
    
$('formulaire').request({
			onComplete: function(transport){
					val =transport.responseText.evalJSON();

					console.log(val);
					if (val == "1")
					{
						document.getElementById("formulaire").style.visibility = "hidden" ;
						document.getElementById("CheckLogin").style.display = "none" ;
						document.getElementById("CheckLogin").style.visibility = "hidden" ;
						document.getElementById("OkLOgin").style.visibility = "visible" ;
						document.getElementById("OkLOgin").style.display  = "block" ;
					}
					else
					{
						document.getElementById("CheckLogin").style.visibility = "visible" ;
						document.getElementById("CheckLogin").style.display  = "block" ;
						document.getElementById("OkLOgin").style.display = "none" ;
						document.getElementById("OkLOgin").style.visibility = "hidden" ;

						
					}
				}
			});
}

    </script>