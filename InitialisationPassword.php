<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html>
<?php
  include("Header.php"); 
  ?>
 <body>
 
<?php  include("Header2023.php"); ?>
<script type="text/javascript">

function check(f1)
{
	if (f1.pass.value.length<1)
	{
		document.getElementById("DivInformation").style.visibility = "visible";
		document.getElementById("TextInformation").style.color ="#DD8888";
		document.getElementById("TextInformation").value = "Veuillez écrire un mot de passe";
	
		f1.pass.focus();
		return false;
	}
	if (f1.pass.value != f1.pass2.value ) {
		document.getElementById("DivInformation").style.visibility = "visible";
		document.getElementById("TextInformation").style.color = "#DD8888";
		document.getElementById("TextInformation").value = "votre mot de passe n'est pas identique";
		return false;
	}
	f1.submit();
}
</script>
<div id="corps">

	<div class="formulaire">
	
	<H2> Réinitialisation de votre mot de passe </h2>

	  <form method="post" action="CibleModificationPassword.php">
		<div class="input">
			<label for="Nom">Adresse e-mail :</label> <input type="text" name="login" readonly="True" value="<? echo $_GET["Login"]?>" id="login"  tabindex="10" />
		</div>
		<div class="input">
			<label for="Nom">Mot de passe :</label> <input type="password"  name="pass" id="pass" tabindex="15" /> 
		</div>
		<div class="input">
			<label for="Nom">Répéter le mot de passe :</label> <input type="password"  name="pass2" id="pass2" tabindex="15" />
		</div>
		<center>
		<input type="button" onClick="check(this.form)" value="Réinitialiser mon mot de passe" class="ButtonResultat"   style= " width: 300px; height: 50px; Background:white";>  
</center>
	 </form>
	<div class="input" style="visibility:collapse" id="DivInformation">
	 	<label for="Nom">Informations :</label> <input id="TextInformation" type="TextArea"  name="pass" id="pass" tabindex="15" /> 
	</div>
	</div>
</div>
     
 </body>
</html>