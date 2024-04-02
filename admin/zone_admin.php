<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="fr" lang="fr">
    <head>
        <title>liste</title>
        <meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
    <link rel="stylesheet" media="screen" type="text/css" title="Design" href="style.css" />

	</head>

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
	
  <?php include("onglets.php"); ?>
<?php include("menu_horizontal.php"); ?>	
</br>
<div id="corps">

<ul id="step">
<fieldset>
<!---  Recherche infomration selon la course !---->
   <Fieldset>
<?php echo $_POST['login']?>
   </Fieldset>
   <div id="menu_vertical">
<li>
   <a href="index.php">Accueil</a>
   </li>
     <li>
	 <a href="nouvel_course_step1.php">Créer une course</a>
   </li>
        <li>
		
		<form method="post"action ="Liste_course.php">
<input type="hidden" name="nom" id="nom" tabindex="10"  size="60"  value= '<?php echo $_POST['login'] ?>' />
<button type ="button" style="float:right; margin-right :10px;" onClick="checkForm(this.form)" >Liste des Course</button>
</form>
	
   </li>
</div>
   
   
   
   
   
   
 <p><label for="nom">Nom de la course</label> <input type="text" name="nom" id="nom" tabindex="10"  size="60" /></p>

  <p><label for="emplacement">Emplacement</label> <input type="text" name="emplacement" id="emplacement" tabindex="30"  size="60" /></p>
   <p><label for="organisateur">Organisateur</label> <input type="text" name="organisateur" id="organisateur" tabindex="40"  size="60" /></p>
    <p><label for="contact">Nom & Prénom </label> <input type="text" name="contact" id="contact" tabindex="50"  size="60" />(personne de contact)</p>
    <p><label for="telephone">N° téléphone</label> <input type="text" name="telephone" id="telephone" tabindex="30"  size="60" /></p>
	<p><label for="mail">e-mail</label> <input type="text" name="mail" id="mail" tabindex="30"  size="60" /></p>
	<p><label for="description">Description</label> <textarea  name="description" id="description" tabindex="65" rows="4" cols="80"  size="60" /></textarea></p>
	<p><label for="Site">Site</label> www.<input type="text" name="Site" id="Site" tabindex="70"  size="60" /></p>
	<p> <label for="Nbr_etape">Nombre étape</label><input type="text" name="etape" id="Etape" tabindex="70"  size="60"  onchange='couleur(this.form)' /></p>
		</br>
	  <p><label for="lieu">Lieu</label> <input type="text" name="lieu" id="lieu" tabindex="20"  size="60" /></p>
	<p><label for="date">date</label><input type="date" name="date" id="date" tabindex="20"  size="60" /></p>

	
	</br>
		<p> <label for="NomEtape2" style="visibility:hidden;" id="TxtNomEtape2">Lieu Etape 2</label><input type="text" name="NomEtape2" id="NomEtape2" tabindex="70"  size="60" style="visibility:hidden;"  /></p>
			<p> <label for="DateEtape2" style="visibility:hidden;"id="TxtDateEtape2">Date Etape 2</label><input type="date" name="DateEtape2" id="DateEtape2" tabindex="70"  size="60"  style="visibility:hidden;"  /></p>
				</br>
		<p> <label for="NomEtape3" style="visibility:hidden;"id="TxtNomEtape3">Lieu Etape 3</label><input type="text" name="NomEtape3" id="NomEtape3" tabindex="70"  size="60"  style="visibility:hidden;"    /></p>
			<p> <label for="DateEtape3" style="visibility:hidden;"id="TxtDateEtape3">Date Etape 3</label><input type="date" name="DateEtape3" id="DateEtape3" tabindex="70"  size="60"  style="visibility:hidden;"  /></p>
				</br>
		<p> <label for="NomEtape4" style="visibility:hidden;"id="TxtNomEtape4">Lieu Etape 4</label><input type="text" name="NomEtape4" id="NomEtape4" tabindex="70"  size="60"  style="visibility:hidden;"   /></p>
			<p> <label for="DateEtape4" style="visibility:hidden;"id="TxtDateEtape4">Date Etape 4</label><input type="date" name="DateEtape4" id="DateEtape4" tabindex="70"  size="60"  style="visibility:hidden;"  /></p>
				</br>
		<p> <label for="NomEtape5" style="visibility:hidden;"id="TxtNomEtape5">Lieu Etape 5</label><input type="text" name="NomEtape5" id="NomEtape5" tabindex="70"  size="60"   style="visibility:hidden;"  /></p>
			<p> <label for="DateEtape5" style="visibility:hidden;"id="TxtDateEtape5">Date Etape 5</label><input type="date" name="DateEtape5" id="DateEtape5" tabindex="70"  size="60"   style="visibility:hidden;"   /></p>
 

 <p><label for="canton">Canton</label><select name="canton"> 
 <?php
 $canton = Array("choix du canton","AG : Argovie - Aargau", "AI : Appenzell Rhodes intérieures - Inner-Rhoden", "AR : Appenzell Rhodes extérieures - Ausser-Rhoden",
 "BE : Berne - Bern", "BL : Bâle Campagne - Basel Land",  "BS : Bâle Ville - Basel Stadt", "FR : Fribourg - Freiburg", "GE : Genève - Genf", "GL : Glaris - Glarus", "GR : Grisons - Graubuenden",
 "JU : Jura", "LU : Lucerne -Luzern","NE : Neuchâtel - Neuenburg", "NW : Nidwald - Nidwalden ","OW : Obwald - Obwalden", "SG : Saint-Gall - Sankt Gallen",
 "SH : Schaffhouse - Schaffausen ","SO : Soleure - Solothurn", "SZ : Schwyz","SO : Soleure - Solothurn", "SZ : Schwyz","TG : Thurgovie - Thurgau",
 "TI : Ticino - Tessin","UR : Uri", "VD : Vaud - Waadt","VS : Valais - Vallis","ZG : Zug", "ZH : Zurich - Zürich");
 for ($x=1; $x <= count($canton); $x++) {
	echo"<option value=\"$x\"";
	if ($x == $canton) {
		echo " selected";
	}
	echo ">".$canton[$x-1]."</option>";
}
?>
</select>
</p> 

</fieldset>
</ul>

<center>
<button type="button" onClick="checkForm(this.form)"><img src="images/bouton_next.png"style="background-color:transparent"width="50" height="50"></button> 

</form>
</center>
</div>

     
    </body>
</html>