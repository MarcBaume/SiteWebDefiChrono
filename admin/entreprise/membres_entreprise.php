<!DOCTYPE html>
<html>
<head>
	<meta property="og:description" content="chronométrage, chrono, jura, franches-montagnes, Jura défi, course à pied, Sport, Jura défi chrono" />  
	<title>Défi Chrono</title>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, maximum-scale=1.0, user-scalable=yes">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css">
	<link rel="stylesheet" title="defaut" media="screen" href="../../css/style.css" type="text/css"/>
<!--	<link rel="stylesheet" type="text/css" media="screen and (max-width: 480px)" href="style-mobilV2.css" /> -->
</head>
<!-- initilisation de variable -->
<?php
/*******************************************************************************************************************
 * 
 * Formulaire d'ajout de coureur dans l'entreprise
 * 
 ********************************************************************************************************************/
?>
<div>
<img style='width:200px;margin:10px'src='../../images/LogoDefiChrono2023.png'></img>
</div>
 <p class="title" style='padding:15px;margin:10px'> Formulaire d'ajout de coureur dans mon entreprise  <?php echo   $_GET['login'];?></p>
<div id="formulaire" style='margin:10px'>

		<form method="post" action="CibleAddMembreEntreprise.php" id=FormCoureurs>
            <input type="hidden" name="login" id="login" value="<?php echo   $_GET['login'];?>"   />
            <p><label  for="nom">Nom *:</label> <input type="text" name="nom" id="nom" tabindex="10"   /></p>
            <p><label  for="prenom">Prénom *:</label>  <input type="text" name="prenom" id="prenom" tabindex="20" /></p>
            <p><label  for="mail">Adresse e-mail *:</label> <input type="text" name="email" id="email" tabindex="40" /></p>
            <p><label  for="adresse">Adresse *:</label> <input type="text" name="adresse" id="adresse" tabindex="50"/></p>
            <p><label for="npa">NPA *:</label> <input type="text" name="zip" id="zip" tabindex="60" /></p>
            <p><label  for="localite">Localité *:</label> <input type="text" name="ville" id="ville"tabindex="70" /></p>
            <p><label for="pays">Pays *:</label>  <input type="text" name="pays" id="pays"tabindex="80" /></p>	
            <p><label for="dateNaissance"> Année de Naissance * :</label> <input type="text" name="dateNaissance" id="DateNaissance"  />
          
            <table style="width:100%;background: #C0C0C0;">
				<tr>
					<td style="width:210px"><label> Sexe * :</label></td>
					<td><Select name="sexe"   id="sexe" > 
                 <option style="padding : 10px" value="">Sélectionner</option>
                <option style="padding : 10px" value="H">Homme</option>
                <option style="padding : 10px" value="D">Dame</option>		
            </select></td>
</tr>
</table>
           <p><label style="vertical-alignement: center" for="dateNaissance"> Nombre étape * :</label> <input type="text" name="NbrEtape" id="NbrEtape"  />
</p>
            <a><span> </span>
                <!-- Bouton validation information -->
                <button type ="button" class="ButtonResultat" type="button" style="float:right;padding: 20px;margin:10px; height:80px;font-size:180%;"
                        onClick="checkForm(this.form)" title="Validations Informations" 
                        data-toggle="tooltip" data-placement="right">
						<a>Validation de mon inscription</a>
                    
                </button>
            </A>
		</form>
		

</div>


    </body>
</html>

<script type="text/javascript">

function checkForm(f1) {
	if (f1.nom.value.length<3) {
		alert("Merci d'indiquer votre nom");
		f1.nom.focus();
		return false;
	}

	if (f1.prenom.value.length<3) {
		alert("Merci d'indiquer votre prénom");
		f1.prenom.focus();
		return false;
	}
	
	if (f1.zip.value.length<4) {
		alert("Merci d'indiquer votre npa");
		f1.zip.focus();
		return false;
	}
	if (f1.ville.value.length<3) {
		alert("Merci d'indiquer votre localite");
		f1.ville.focus();
		return false;
	}
	if (f1.sexe.value.length<1) {
		alert("Merci d'indiquer votre sexe");
		f1.sexe.focus();
		return false;
	}
	if (!isMail(f1.email.value)) {
		alert("Merci d'indiquer un mail valide pour que nous puissions vous répondre");
		f1.email.focus();
		return false;
	
	}
	if (f1.dateNaissance.value.length!=4) {
		alert("Merci d'indiquer votre année de naissance correct comme par exemple : 1988");
		f1.dateNaissance.focus();
		return false;
	}

	if (confirm("Etes-vous sur des informations de votre coureur?")) {
	f1.submit();
	}
}

function isMail(txtMail)
{
	var regMail=new RegExp("^[0-9a-z._-]+@{1}[0-9a-z. -]{2,}[.]{1}[a-z]{2,5}$", "i");
	return regMail.test(txtMail);
}
function addForm(f1) {

	f1.submit();
	
}
function Suppform(f1) {
if (confirm("Etes-vous supprimer ce coureur?")) {
	f1.submit();
	}
}
</script>