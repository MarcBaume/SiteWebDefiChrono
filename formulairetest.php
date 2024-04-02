<!DOCTYPE html >
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="fr" >
   <body>
 
<Div id="corps">
<script type="text/javascript">

function isMail(txtMail) {
	var regMail=new RegExp("^[0-9a-z._-]+@{1}[0-9a-z. -]{2,}[.]{1}[a-z]{2,5}$", "i");
	return regMail.test(txtMail);
}
function checkForm(f) {

	if (confirm("Etes-vous sur des informations de votre inscriptions?")) {
	f.submit();
	}
}
</script>
<Div id="main">
<H3> Formulaire d'inscription pour la Course des Franches</h3>
<div id="formulaire">
   

   <Fieldset>
   <form method="post" action="testmysql.php">
	   <p><label for="Nom">Nom *:</label> <input type="text" name="nom" id="nom" tabindex="10" size="35"  /></p>
	   <p><label for="prenom">Prénom *:</label>  <input type="text" name="prenom" id="prenom" tabindex="20" size="35"/></p>
	   <p><label for="date">Année de Naissance *:</label> <input type="text" name="date" id="date" tabindex="30"size="35"/></p>
	   <p><label for="mail">Adresse e-mail *:</label> <input type="text" name="email" id="email" tabindex="40"size="35"/></p>
	   <p><label for="adresse">adresse *:</label> <input type="text" name="adresse" id="adresse" tabindex="50"size="35"/></p>
		<p><label for="npa">NPA *:</label> <input type="text" name="zip" id="zip" tabindex="60"size="35"/></p>
		<p><label for="localite">Localité *:</label> <input type="text" name="ville" id="ville"tabindex="70"size="35"/></p>
		<p><label for="tel">N° Téléphone: </label> <input type="text" name="tel" id="tel"tabindex="80"size="35"/></p>
		<p><label for="club">Club:</label> <input type="text" name="club" id="club"tabindex="90"size="35"/></p>
		<p><label for="pays">Pays *:</label>  <input type="text" name="pays" id="pays"tabindex="150"size="35"/></p>
  <p>
       <label>Sexe * :</label>
       Homme<input type="radio" name="sexe" value="H" id="sexe"  /> </br> </br> 
        <label style="color:#C0C0C0" >t     t </label>Dame<input type="radio" name="sexe" value="D" id="sexe"  /> 

	 </p>
	 </select>
   <p>

	 Informations complémentaires ou problème d'inscription : Joly Michel 079 276 42 19 ou Patrick Jeanbourquin 078 629 55 74

     
	     <CENTER>
		 </br>
       <input type="button" value="Envoyer" onclick="checkForm(this.form)" style= " width: 100px; height: 50px";>  </br>
 

 les champs avec un * sont obligatoires
 </center>
   </Fieldset>
   </Fieldset>
      </Fieldset>
</form>
</div>
    </body>
</html>


 





