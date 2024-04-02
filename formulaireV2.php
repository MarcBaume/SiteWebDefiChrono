<!DOCTYPE html>
<html>
<head>
	<meta property="og:description" content="chronométrage, chrono, jura, franches-montagnes, Jura défi, course à pied, Sport, Jura défi chrono" />  
	<title>Défi Chrono</title>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, maximum-scale=1.0, user-scalable=yes">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css">
	<link rel="stylesheet" title="defaut" media="screen" href="styleV5.css" type="text/css"/>
<!--	<link rel="stylesheet" type="text/css" media="screen and (max-width: 480px)" href="style-mobilV2.css" /> -->
<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js">
	 </script>
 <script src="js/prototype.js" >

</script>
</head>
    <body>
    <script>
function checkForm2(f1) {
	if (f1.nomAdd.value.length<3) {
		alert("Merci d'indiquer votre nom");
		f1.nom.focus();
		return false;
	}

		if (f1.prenomAdd.value.length<3) {
		alert("Merci d'indiquer votre prénom");
		f1.prenom.focus();
		return false;
	}
	
		if (f1.zipAdd.value.length<4) {
		alert("Merci d'indiquer votre npa");
		f1.zip.focus();
		return false;
	}
			if (f1.villeAdd.value.length<3) {
		alert("Merci d'indiquer votre localite");
		f1.ville.focus();
		return false;
	}
			if (f1.sexeAdd.value.length<1) {
		alert("Merci d'indiquer votre sexe");
		f1.sexe.focus();
		return false;
	}

	if (f1.dateNaissance.value.length!=4) {
		alert("Merci d'indiquer votre année de naissance correct comme par exemple : 1988");
		f1.dateNaissance.focus();
		return false;
	}

			if (!isMail2(f1.emailAdd.value)) {
		alert("Merci d'indiquer un mail valide pour que nous puissions vous répondre");
		f1.email.focus();
		return false;
	
	}
	


	if (confirm("Etes-vous sur des informations de votre coureur?")) {
		AddMember();
	}
}

function isMail2(txtMail)
{
	var regMail=new RegExp("^[0-9a-z._-]+@{1}[0-9a-z. -]{2,}[.]{1}[a-z]{2,5}$", "i");
	return regMail.test(txtMail);
}
</script>
	<?php
	  include("Header.php");
 
	  ?>
<!-- ******************************************************************               
                    POP-UP ADD MEMBER


******************************************************************** !-->



<!-- ******************************************************************               
                   Formulaire inscription


******************************************************************** !-->
<div id="corps">

	<?php include("HeaderInfo2022.php"); 

	
if ( $today < $val ["DateStartInscription"]  && $_SESSION['Niveau'] != 2 && $_SESSION['Niveau'] != 0)
{
	header('Location: formulaireInscriptionFermerStart.php?NbrEtape='.$Nbr_etape.'&DateCourse='.$DateCourse.'&Etape=1&NomCourse='.$NOM_COURSE.''); 									
}
 else if ( $today > $val ["DATE_END_INSCRIPTION"] )
 {
header('Location: formulaireEnd.php?NbrEtape='.$Nbr_etape.'&DateCourse='.$DateCourse.'&Etape=1&NomCourse='.$NOM_COURSE.''); 
}
else if ($val ["InscriptionWithPayment"] )
{
//header('Location: formulaire2.php?Nbretape='. $_GET["Nbretape"].'&DateCourse='.$_GET['DateCourse'] .'&NomCourse='.$_GET["NomCourse"].'');
}
else if ($val ["InscriptionExtern"] )
{
$site = 'http://www.'. $val["Site"] ;
header('Location: ' . $site );	
}


?>
<script>
var TotalReduction = 0;
var Total = 0;
var ArrayCoureurs = [];
var ArrayReduction = [];
var ArrayListReductionActif = [];
var ArrayParcours = [];
var ICounterCoureurs = 0;
var NombreEtapeTotalChoisie = 0;
var ZoneTarifsActif;
var xEquipe = false;
var JuraDefi = <?php echo json_encode($val["JuraDefi"]); ?>;

var DateToday = <?php echo json_encode($today); ?>;
var NombreEtapeTotal =  <?php echo json_encode($val["nbr_etape"]); ?>;
console.log(DateToday);

function EquipeChang(valueText) {
	console.log("test1");
	document.getElementById("NomEquipe").value =valueText;
	$('VerifEquipe').request({
		onComplete: function(transport){
			var val =transport.responseText.evalJSON();
	}
	});
	console.log(val);
}

</script>
 <h3>
	Inscription  <?php  echo $NOM_COURSE. ' ' . $ANNEE_COURSE ?> 
</h3>
<Fieldset>
<div id="formulaire">

<?php
// Si on est connecté on affiche dans une menu les coureurs de la session
if ( isset($_SESSION['Login']))
{
	$_SESSION['Nbretape'] = $_GET["Nbretape"] ;
	$_SESSION['Course'] = $_GET["NomCourse"] ;
	$_SESSION['DateCourse'] = $_GET['DateCourse'];
?>


<div class="popup" >
  <span class="popuptext" id="myPopup">
  <button type ="button" style="float:right; width:40px; height:40px; margin-right :10px;" onClick="ShowPopuAddMember()" title="Exit" data-toggle="tooltip" data-placement="right">X</button>
      <form id="formAddMember" name="formAddMember" method="get" action="addMembresFormulaire.php"  >
		<p> Ajout d'un nouveau coureur </p>
        <table>
        		<input type="hidden" name="LoginCompte" id="LoginCompte"   value= '<?php echo $_SESSION['Login'] ?>' />
                <tr style="padding: 10px">
				<td >Nom *:</td> <td><input type="text" name="nom" id="nomAdd" tabindex="10"    /></td>
                </tr>
				<tr style="padding: 10px"><td>Prénom *:</td> <td> <input type="text" name="prenom" id="prenomAdd" tabindex="20" /></td></tr>
				<tr style="padding: 10px"><td  >Adresse e-mail *:</td>  <td> <input type="text" name="email" id="emailAdd" tabindex="40" /></td></tr>
				<tr style="padding: 10px"><td  >Adresse *:</td> <td>  <input type="text" name="adresse" id="adresseAdd" tabindex="50"/></td></tr>
				<tr style="padding: 10px"><td >NPA *:</td>  <td> <input type="text" name="zip" id="zipAdd" tabindex="60"/></td></tr>
				<tr style="padding: 10px"><td >Localité *:</td>  <td> <input type="text" name="ville" id="villeAdd"tabindex="70" /></td></tr>
				<tr style="padding: 10px"><td  >Pays *:</td>   <td> <input type="text" name="pays" id="paysAdd"tabindex="80" /></td></tr>	
				<tr style="padding: 10px"><td  >Année de Naissance * :</td> <td><input type="text" name="dateNaissance" 	id="dateNaissanceAdd" tabindex="90"  /><td></tr>

				<tr style="padding: 10px"><td  for="club">Club:</td><td> <input type="text" name="club" id="clubAdd"tabindex="100" /></td></tr>
									
				<tr style="padding: 10px"><td >Sexe * :</td><td><Select style="width:100px"   name="sexe"   id="sexeAdd" > 
			    	<option style="padding : 10px" value= "">Selectionner</option>	
					<option style="padding : 10px" value= "D">Dame</option>
					<option style="padding : 10px" value= "H">Homme</option>				
				</select></td></tr>
        </table>
				<a>
				
				<button type ="button" style="float:right; margin-right :10px;" onClick="checkForm2(this.form)" title="Validations Informations" data-toggle="tooltip" data-placement="right"><img src="/images/validation.jpg" width="50"></button></A>
		</form>			
  </span>
</div>


<form id="VerifEquipe" method="get" action="VerifEquipe.php">
	<input type="hidden" name="Course" id="Course"   value= '<?php echo $NOM_COURSE. $ANNEE_COURSE ?>' />
	<input type="hidden" name="NomEquipe" id="NomEquipe"   value=  />
</form>

	<form method="post" action="ciblePanier.php" id="Formulaire" name="Formulaire" onload="Choix1Coureur()" >

	<p><label>Coureur :</label><Select   onchange ="ChoixCoureurs(this.form);" name="Coureur"   id="Coureur"/>  	
	<input type="hidden" name="idCoureur" id="idCoureur" />
	<input type="hidden" name="DateCourse" id="DateCourse"   value= '<?php echo $_GET['DateCourse'] ?>' />
	<input type="hidden" name="NomCourse" id="NomCourse"  value= '<?php echo $_GET["NomCourse"] ?>' />
	<input type="hidden" name="NumCat" id="NumCat" />
	<input type="hidden" name="NomCat" id="NomCat" />
	<input type="hidden" name="OnLine" id="OnLine" />
	<input type="hidden" name="Option" id="Option" />
	<input type="hidden" name="Nbretape" id="Nbretape" value= '<?php echo  $_GET["NbrEtape"] ?>' />
	<a ><img src="admin/images/addCoureur.jpg" width="60px" onclick="ShowPopuAddMember()" /></a>

<div id="InformationsCoureurs" style="display:none;">
		<h3>Vérfier les informations du coureur choisi (Si celle-ci ne sont pas correct, veuillez les modifier sur <a href="admin/membres.php">votre profil </a>) </h3>
		<p><label for="nom">Nom *:</label> <input type="text" name="nom" id="nom" tabindex="10"  readonly  /></p>
		<p><label for="prenom">Prénom *:</label>  <input type="text" name="prenom" id="prenom" tabindex="20" readonly /></p>
		<p><label for="mail">Adresse e-mail *:</label> <input type="text" name="email" id="email" tabindex="40" readonly /></p>
		<p><label for="adresse">Adresse *:</label> <input type="text" name="adresse" id="adresse" tabindex="50" readonly /></p>
		<p><label for="npa">NPA *:</label> <input type="text" name="zip" id="zip" tabindex="60" readonly /></p>
		<p><label for="localite">Localité *:</label> <input type="text" name="ville" id="ville"tabindex="70" readonly /></p>
		<p><label for="club">Club:</label> <input type="text" name="club" id="club"tabindex="90" readonly /></p>
		<p><label for="pays">Pays *:</label>  <input type="text" name="pays" id="pays"tabindex="150" readonly /></p>						
		<p><label>Sexe * :</label><input  type="text" name="sexe"   id="sexe" readonly /> </p>
		<p><label for="date">Année de Naissance:</label> <input   type="number"   min="1900" max="2030"name="date" id="date" onchange ="liste_depart(this.form);" tabindex="200" readonly /></p>
		</br></br>
		<h2>Informations demandé pour votre inscription </h2>
		<p><label for="NomParcours"onClick="liste_depart();">Parcours : </label><select  onchange ="liste_depart(this.form);"  id="NomParcours" name="NomParcours" >

		</select></p>
		<p id="lblDepart"  style="visibility:hidden; display:none"> <label for="NomDepart">Catégorie :  </label>
		<select   name="NomDepart" id="NomDepart" onchange="ChoiceDepart(this.form);"  ></select></p>
	<div id="HaveAChoiceCategorie"style="display:none">
		<div id="TableEquipe" style="background: #D0D0D0; visibility:hidden; display:none">

				<p id="noneEquipe">
					<input  type="radio" name="Equipe" style="height:30px;font-size:130%;" Checked="true" value="0"  >   <label for="noneEquipe">Je ne fais pas partie d'aucune équipe /Duo </label>
				</p>
				<p id="RowEquipe" style="visibility:hidden; display:none;">		
					<input  type="radio" name="Equipe"  style=" height:30px;font-size:130%;" value="1" ><label for="RowEquipe"> Je fait partie d'une équipe </label>
				</p>
				<p id="RowDuo" style="visibility:hidden; display:none;">
					<input  type="radio" name="Equipe"  style="  height:30px;font-size:130%;" value="2"  ><label for="RowDuo">Je cours en DUO</label>
				</p>

		</div>

		<p id="lblNomEquipe" style="visibility:hidden; display:none"><label for="NomEquipe">Nom Equipe:</label> <input type="text" name="NomEquipe" id="NomEquipe" tabindex="201"    /></p>
			<table id ="TableEquipeExistante"> <!-- liste equipe existante -->
				
			</table>
			
			
			<h2 id="disc1" style="visibility:hidden; display:none"> </h2>
			<p  id="lblNomDisc1" style="visibility:hidden; display:none"><label for="NomDisc1" >Nom *:</label> <input type="text" name="NomDisc1" id="NomDisc1" tabindex="202"   /></p>
		<p  id="lblPrenomDisc1" style="visibility:hidden; display:none"><label for="PrenomDisc1">Prénom *:</label>  <input type="text" name="PrenomDisc1" id="PrenomDisc1" tabindex="203"/></p>
		
		<h2 id="disc2" style="visibility:hidden; display:none"> </h2>
		<p  id="lblNomDisc2" style="visibility:hidden; display:none"><label for="NomDisc2" >Nom *:</label> <input type="text" name="NomDisc2" id="NomDisc2" tabindex="204"   /></p>
		<p  id="lblPrenomDisc2" style="visibility:hidden; display:none"><label for="PrenomDisc2">Prénom *:</label>  <input type="text" name="PrenomDisc2" id="PrenomDisc2" tabindex="210"/></p>
		<h2 id="disc3" style="visibility:hidden; display:none"> </h2>		
		<p id="lblNomDisc3" style="visibility:hidden; display:none"><label for="NomDisc3"  >Nom *:</label> <input type="text" name="NomDisc3" id="NomDisc3" tabindex="305"   /></p>
		<p id="lblPrenomDisc3" style="visibility:hidden; display:none"><label for="PrenomDisc3" >Prénom *:</label>  <input type="text" name="PrenomDisc3" id="PrenomDisc3" tabindex="310"/></p>
		
		<h2 id="disc4" style="visibility:hidden; display:none"> </h2>		
		<p id="lblNomDisc4" style="visibility:hidden; display:none"><label for="NomDisc4"  >Nom *:</label> <input type="text" name="NomDisc4" id="NomDisc4" tabindex="315"   /></p>
		<p id="lblPrenomDisc4" style="visibility:hidden; display:none"><label for="PrenomDisc4" >Prénom *:</label>  <input type="text" name="PrenomDisc4" id="PrenomDisc4" tabindex="320"/></p>									
	<h2 id="disc5" style="visibility:hidden; display:none"> </h2>		
		<p id="lblNomDisc5" style="visibility:hidden; display:none"><label for="NomDisc5"  >Nom *:</label> <input type="text" name="NomDisc5" id="NomDisc5" tabindex="325"   /></p>
		<p id="lblPrenomDisc5" style="visibility:hidden; display:none"><label for="PrenomDisc5" >Prénom *:</label>  <input type="text" name="PrenomDisc5" id="PrenomDisc5" tabindex="330"/></p>									
	<h2 id="disc6" style="visibility:hidden; display:none"> </h2>		
		<p id="lblNomDisc6" style="visibility:hidden; display:none"><label for="NomDisc6"  >Nom *:</label> <input type="text" name="NomDisc6" id="NomDisc6" tabindex="335"   /></p>
		<p id="lblPrenomDisc6" style="visibility:hidden; display:none"><label for="PrenomDisc6" >Prénom *:</label>  <input type="text" name="PrenomDisc6" id="PrenomDisc6" tabindex="340"/></p>	

	<!---------- CHOIC TARIFS _______________-->
		
		<p id="lblNbrEtape"  style="visibility:hidden; display:none" ><label for="nbrEtape">Choix*:</label> <select  name="nbrEtape" id="nbrEtapeInsc" tabindex="410"  onchange="choiceOption(this.form)" >
			
			
			
			
			
	</select>
		<?php if (strlen ($val["InformationInscription"])>1)
		{?>
		<p>
		<? echo $val["InformationInscription"]?>
		</p>
		<?
		}			?>
		<div id="HaveAChoiceTarif"style="display:none">
		<?php if ($val ["JuraDefi"] )
		{?>
			<p id="lblTShirt"  style="visibility:hidden; display:none"><label for="TailleTShirt">Taille T-SHIRT</label><select  style="background-color:#41e063;"  id="TailleTShirt" name="TailleTShirt" >
				<Option value="">Sélectionner</option>
				<Option value="XS">XS</option>
				<Option value="S">S</option>
				<Option value="M">M</option>
				<Option value="L">L</option>
				<Option value="XL">XL</option>
				<Option value="XXL">XXL</option>

			</select></p>
			<p id="lblTShirt2"  style="visibility:hidden; display:none"><label for="TailleTShirt2">Taille T-SHIRT</label><select  style="background-color:#41e063;"  id="TailleTShirt2" name="TailleTShirt2" >
				<Option value="">Sélectionner</option>
				<Option value="XS">XS</option>
				<Option value="S">S</option>
				<Option value="M">M</option>
				<Option value="L">L</option>
				<Option value="XL">XL</option>
				<Option value="XXL">XXL</option>

			</select></p>
			<p id="lblTShirt3"  style="visibility:hidden; display:none"><label for="TailleTShirt3">Taille T-SHIRT</label><select  style="background-color:#41e063;"  id="TailleTShirt3" name="TailleTShirt3" >
				<Option value="">Sélectionner</option>
				<Option value="XS">XS</option>
				<Option value="S">S</option>
				<Option value="M">M</option>
				<Option value="L">L</option>
				<Option value="XL">XL</option>
				<Option value="XXL">XXL</option>

			</select></p>
			<p id="lblTShirt4"  style="visibility:hidden; display:none"><label for="TailleTShirt4">Taille T-SHIRT</label><select  style="background-color:#41e063;"  id="TailleTShirt4" name="TailleTShirt4" >
				<Option value="">Sélectionner</option>
				<Option value="XS">XS</option>
				<Option value="S">S</option>
				<Option value="M">M</option>
				<Option value="XL">XL</option>
				<Option value="XXL">XXL</option>

			</select></p>
	<?	}
else
{?>


			<p id="lblTShirt"  style="visibility:hidden; display:none"><label for="T_Shirt">Taille T-SHIRT</label><select  style="background-color:#41e063;"  id="TailleTShirt" name="TailleTShirt" >
				<Option value="">Sélectionner</option>
				<Option value="SW">S Femme</option>
				<Option value="MW">M Femme</option>
				<Option value="LW">L Femme</option>
				<Option value="XLW">XL Femme</option>
				<Option value="SM">S Homme</option>
				<Option value="MM">M Homme</option>
				<Option value="LM">L Homme</option>
				<Option value="XLM">XL Homme</option>
				<Option value="XXLM">XXL Homme</option>
			</select></p>
<?
}?>
</div>
			<div id="OptionReduction">
			
			
			</div>
			<p id="lblInformation" style="visibility:hidden; display:none;padding:5px; border-style: solid; border-color: black; font-size:160%;background:#fa8a8a ">Aucune catégorie existe sur ce parcours pour cette année de naissance</p>	

	 <div style="display :none;" ><label for="nom">Prix:</label> <input type="text" name="PrixDepart" id="PrixDepart" tabindex="510"  readonly  />CHF</div>
	  <center>
	  <?
			$pathReglement = 'courses/'.$_GET['NomCourse'].$ANNEE_COURSE.'/info/Réglement.pdf';
			if (!file_exists($pathReglement))
			{
				$pathReglement = 'Réglement.pdf';
			}
	  ?>
	   <p> 
	  <label> J'accepte le réglement 
		<?echo '<a href="'.$pathReglement.'"target="_blank">ci-joint</a>'?></label>
		<input type="checkbox" style="visibility:hidden;"  id="Reglement" >

		 </p>
		 
			<p>
		<label>J'accepte de transmettre mes données à nos partenaires 	</label>
		<input type="checkbox" style="visibility:hidden;" checked="True" Name="Partenaire" id="Partenaire" >
		
		 </p>
		
				<!-- lit de tous les code de réduction utiliser sérialiser -->
			<input type="hidden"  name="strCodeReduction" id="strCodeReduction" value=""  />  
		</form>	
		<form id="formCode" method="get" action="VerifCodeReduction.php" style="visibility:collapse;">
				<div style="display :none;" ><input type="hidden" name="NomCode" id="NomCode" style="display :none;"  readonly  /></p>
				<input type="hidden" name="PrenomCode" id="PrenomCode"  style="display :none;" readonly /></p>
				<input type="hidden" name="CourseCode" id="CourseCode" style="display :none;"  value= '<?php echo $NOM_COURSE. $ANNEE_COURSE ?>' />
				<input type="hidden" name="NbrEtapeCode" id="NbrEtapeCode"   />
				<input type="hidden" name="PrixInscription" id="PrixInscription"  style="display :none;"  /></div>
				<p style="background-color : #D0D0D0;" ><label for="Code">Code de réduction:</label> <input type="text" name="Code" id="CodeID" tabindex="500"   />	
			   <input type="button" style="height:30px;font-size:80%; width: 120px;"  id="ButtonSend" value="Valider votre code" onclick="VerifCode()" >  </p>
				<p id="InformationCode" style="display:none; padding:5px; border-style: solid; border-color: black; font-size:160%;"></p>	
		</form>	
	
		<Table style="background-color : #FFFFFF; visibility:hidden; display:none" id="TableReduction">
			<tr>
				<th>
					Code de réduction
				</th>
				<th>
					Valeurs CHF
				</th>
			<tr>
			
			
		</table>
		<p><label for="nom">Total Options et Réductions:</label> <input type="text" name="TotalReduction" id="TotalReduction"  readonly  />CHF</p>
			
		<p><label for="nom">Total a payé:</label> <input type="text" name="TotalPayer" id="TotalPayer"  readonly  />CHF</p>
			  
		 <input type="button" style="visibility:hidden;height:40px;font-size:160%;"  id="ButtonSendFormulaire" value="je m'inscris" onclick="check( )" style= " width: 100px; height: 50px";>  </br>
	</div>
	</div>
</div>
</br>
</br>

					<?php
	$sql = 'SELECT * FROM Membres  WHERE LoginCompte=\''.$_SESSION['Login'].'\''; 
	//echo $sql;
	$result = mysqli_query($con,$sql);
$Aff = 0;
 	if ($result && mysqli_num_rows($result) > 0) 
	{
    // output data of each row ?>
	
		<?php
		if (mysqli_num_rows($result) > 0)
		{
		
		?>
			<script>
				var sel = document.getElementById("Coureur");
				
				sel.options.add( new Option("Sélectionner un coureur", ""));
				sel.setAttribute("style","background-color:#41e063");
				
				ICounterCoureurs++;			
			</script>
			<?php
		}
	
		while($val = mysqli_fetch_assoc($result)) 
		{
			if ($val ["Valider"])
			{
				$Aff = $Aff+1 ;
		?>
		<script>

			var Coureur= new Object();
			Coureur.ID = <?php echo json_encode($val ["ID"]); ?>;
			Coureur.Nom = <?php echo json_encode($val ["Nom"]); ?>;
			Coureur.Prenom = <?php echo json_encode($val ["Prenom"]); ?>;
			Coureur.Mail = <?php echo json_encode($val ["mail"]); ?>;
			Coureur.Adresse = <?php echo json_encode($val ["adresse"]); ?>;
			Coureur.NPA = <?php echo json_encode($val ["npa"]); ?>;
			Coureur.Localite = <?php echo json_encode($val ["localite"]); ?>;
			Coureur.Sexe = <?php echo json_encode($val ["sexe"]); ?>;
			Coureur.Pays = <?php echo json_encode($val ["Pays"]); ?>;
			Coureur.DateNaissance = <?php echo json_encode( date("Y", strtotime($val ["DateNaissance"]))); ?>;
			Coureur.Club = <?php echo json_encode($val ["club"]); ?>;
			ArrayCoureurs.push(Coureur);
			
			var sel = document.getElementById("Coureur");
			sel.options.add( new Option(Coureur.Nom + " "+ Coureur.Prenom, ICounterCoureurs));
			ICounterCoureurs++;
				<?php
		
			if (mysqli_num_rows($result) == 1)
			{?>
				var Coureur= new Object();
				Coureur =	ArrayCoureurs[0];
				document.getElementById("idCoureur").value = Coureur.ID;
				document.getElementById("nom").value = Coureur.Nom;
				document.getElementById("prenom").value = Coureur.Prenom ;
				document.getElementById("email").value = Coureur.Mail ;
				document.getElementById("adresse").value = Coureur.Adresse ;
				document.getElementById("zip").value = Coureur.NPA  ;
				document.getElementById("ville").value = Coureur.Localite ;
				document.getElementById("club").value = Coureur.Club ;
				document.getElementById("pays").value =  Coureur.Pays ;
				if (Coureur.Sexe == "H")
				{
					document.getElementById("sexe").value = "Homme" ;
				}
				else
				{
					document.getElementById("sexe").value = "Dame" ;	
				}
				document.getElementById("date").value = Coureur.DateNaissance ;
				<?php
			}
		?>
		</script>
		
		<?php
				}
			}
			if ($Aff == 0)
			{
				echo "Aucun Coureur validé dans ce compte" ;
				
			}
		}
		
		else
		{
			echo "Aucun Coureur dans ce compte";
		}
	
	?>								
</div>
 <center>
 les champs avec un * sont obligatoires</br>
 Si vous avez un problème d'inscription veuillez contacter par e-mail </br>
 info@juradefichrono.ch
 </center>
   </Fieldset>
<? 
		
   }
else
{
$Link= "AddLogin.php?Nbretape=".$_GET['NbrEtape']."&DateCourse=".$_GET['DateCourse']."&NomCourse=" .$_GET['NomCourse'];
// demande de connection pour inscription
?>
	<h3><i>  Connectez-vous pour vous inscrire ! Pas encore de compte? <b> <a href="<?php echo $Link ?> ">Créer un compte   </a></b></h3>
	<form method="post" action="admin/CibleLoginV2.php">
	<!--<p><img src="images/ConnectMini.png"  ></p>-->
	<input type="hidden" name="DateCourse" id="DateCourse"   value= '<?php echo $_GET['DateCourse'] ?>' />
	<input type="hidden" name="NomCourse" id="NomCourse"  value= '<?php echo $_GET["NomCourse"] ?>' />
	<input type="hidden" name="Nbretape" id="Nbretape" value= '<?php echo  $_GET["NbrEtape"] ?>' />
	<p ><label for="Login" style="font-size:10px;">e-mail :</label></br> <input type="text" name="login" id="login" tabindex="10" /> </p>
	<p ><label for="password" style="font-size:10px;">Mot de passe :</label></br><input type="password" name="pass" id="pass" tabindex="15" /></p>
	<p><input  name="submit" type="submit"   value="Se connecter"  style= " width: 150px; height: 30px";></p>
	</form>
	<?php
if ($_GET['Login'] =="false")
	{
		session_destroy();
		?> <p style="background: red;font-weight: bold;"> Mauvais mot de passe </p><?
		
	}
	else
	{
		session_destroy();
		?> <p style="background: red;font-weight: bold;"> Aucune session est connecté</p><?
	
	}?>
	<!-- <p><h2>	<a href="AddLogin.php"style="font-size:12px;">Mot de passe oublier? </a></h2></p>-->
	
	<!-- Création Compte et garde en mémoire course -->
	<h3><a href="PasswordForget.php"style="font-size:12px;">Mot de passe oublié </a></h3>
  <?php
}

?>
<script>

function AddMember()
{
	// Appelle fonction php pour ajouter un

$('formAddMember').request({
			onComplete: function(transport){
				 val =transport.responseText.evalJSON();

				console.log(val);
				if (val == "1")
				{
					location.reload();
				}
				}
			});
}


function VerifCode()
{
// Verifie que ce coupon n'est pas utiliser dans ce formulair
var val = 0;
 var inCode = document.getElementById("CodeID");
 var inInfoCode = document.getElementById("InformationCode");
inInfoCode.style.display  = "block" ;
	// Check si réduction déjà utilisé
	for(var id=0; id<ArrayListReductionActif.length; ++id) 
	{
			
		if (inCode.value == ArrayListReductionActif[id].Code)
		{
			val = -20;
		}
	}

	if (val== 0)
	{
		
		// Appelle fonction php pour vérifier que le coupon existe
		$('formCode').request({
		onComplete: function(transport){
			 val =transport.responseText.evalJSON();
			console.log(val);
			// Ajout réduction Etape
			 if (val > 9990)
			 {
				document.getElementById("nbrEtapeInsc").disabled = true;
				
				console.log('Nombre ' +val);
				// Recherche réduction 
				// Nombre Etape total - Nombre etape Réduction = Nombre ötape Paye
				var NombreEtapeReduction =  val- 9990;
				
				console.log('Nombre Etape Reuc' +NombreEtapeReduction);
				var NombreEtapeAPayer = NombreEtapeTotalChoisie - NombreEtapeReduction;
				console.log('Nombre Etape payer' +NombreEtapeTotal);

				console.log('Nombre Etape A payer' +NombreEtapeAPayer);
				var PrixEtapeAPayer = 0;
				var PrixAllEtape = 0;
				
				// Recherche dans tableau tarif 
				for (j = 0; j < ZoneTarifsActif.ArrayTarifs.length; j++) 
				{
					console.log(ZoneTarifsActif.ArrayTarifs[j].Nom);
					if (ZoneTarifsActif.ArrayTarifs[j].Nom.indexOf( NombreEtapeAPayer) > -1)
					{
						// Prix Total Payer des Etpae a payé
						PrixEtapeAPayer =	 	ZoneTarifsActif.ArrayTarifs[j].Option ;
						console.log('Etape A payer' +PrixEtapeAPayer);
					}
					if (ZoneTarifsActif.ArrayTarifs[j].Nom.indexOf( NombreEtapeTotalChoisie) > -1)
					{
						// Prix Total des Etapes sans réduction
						PrixAllEtape =	ZoneTarifsActif.ArrayTarifs[j].Option ;
						console.log('Etape totalr' +PrixAllEtape);
						val = PrixAllEtape - PrixEtapeAPayer;
						
						console.log(val);
						break;
					}
				
				}
				
				
			 }
			// Ajout réduction 
			 if (val > 0)
			 {
				 if (val > 9990)
				 {
					AddReduction(inCode.value, val, "ReductionCodeEtape" );
				 }
				 else
				 {
					AddReduction(inCode.value, val, "ReductionCodeCHF" ); 
				 }

			
				
			 // Ajout du coupon de réduction 
				var Table = document.getElementById("TableReduction");
				Table.style.visibility = "visible";
				Table.style.display  = "block" ;
				
				row =	Table.insertRow(-1); // ajout d'une ligne en fin de tableau
				
				var cell0 = row.insertCell(0);
				var cell1 = row.insertCell(1);
				cell0.innerHTML = inCode.value;
				cell1.innerHTML = val; 
				
		    	inInfoCode.style.backgroundColor = "#4df44d";
			 	inInfoCode.innerHTML = "Code ajouté correctement";
				
				CalculPrixTotal();
				
			 }
			 else if(val == -8 )
			 {
				inInfoCode.style.backgroundColor  = "#ebb64e";
			 		inInfoCode.innerHTML = "ce code n'est plus valide";
			 }
			  else if(val == -16 )
			 {
				inInfoCode.style.backgroundColor  = "#ebb64e";
			 	inInfoCode.innerHTML = "Code de réduction non valide pour cette personnes";
			 }
			 else if (val == -7)
			 {
			 inInfoCode.style.backgroundColor  = "#fa8a8a";
			 		inInfoCode.innerHTML = "Code de réduction échue";
			 }
			 else if (val == -5)
			 {
			 inInfoCode.style.backgroundColor = "#fa8a8a";
			 		inInfoCode.innerHTML = "Aucune réduction trouvéë";
			 }
			  else if (val == -6)
			 {
			 inInfoCode.style.backgroundColor = "#fa8a8a";
			 		inInfoCode.innerHTML = "Ce code n'est pas valide pour les courses choisies";
			 }
			 else if (val == -15)
			 {
			 inInfoCode.style.backgroundColor = "#fa8a8a";
			 		inInfoCode.innerHTML = "Erreur site web, annoncé cette erreur à info@defichrono,ch";
			 }
			  else if (val == -10)
			 {
			 	 inInfoCode.style.backgroundColor = "#fa8a8a";
			 		inInfoCode.innerHTML = "Aucun code saisi";
			 }
			}
		});
	}
	else
	{
		inInfoCode.style.backgroundColor  = "#ebb64e";
		inInfoCode.innerHTML = "Code déjà utilisé";
	}
}

function  	CalculPrixTotal()
{
	var TotalReduc = document.getElementById("TotalReduction");
	TotalReduc.value = TotalReduction;
	
	var PrixDepart = document.getElementById("PrixDepart");
	
	var TotalPayer = document.getElementById("TotalPayer");
	var Tot = parseFloat(PrixDepart.value)- TotalReduction;
	 if (Tot>0)
	 {
		 TotalPayer.value =Tot;
	 }
	 else
	 {
		 TotalPayer.value =0;
	 }
	 
	
}

function AddReduction(Code,Val, Type)
{
		var reduction = new Object();
		reduction.Code =  Code ;
		reduction.Type = Type;
		reduction.Value = Val;
		ArrayListReductionActif.push(reduction);
			console.log(ArrayListReductionActif);
			CalculateTotalReduction();
			CalculPrixTotal();
}
function choiceOption(f)
{
	var e = document.getElementById("nbrEtapeInsc");
		e.setAttribute("style","background-color:#FFFFFF");

	var tabOption =  e.options[e.selectedIndex].value.split(';');
	document.getElementById("Option").value = tabOption[0];
	document.getElementById("PrixDepart").value = tabOption[1];
	document.getElementById("OnLine").value = tabOption[2];
	document.getElementById("lblTShirt").style.display = "none" ;
	document.getElementById("lblTShirt").style.visibility = "hidden" ;
	 if (JuraDefi =="1")
		{
	document.getElementById("lblTShirt2").style.display = "none" ;
	document.getElementById("lblTShirt2").style.visibility = "hidden" ;
	document.getElementById("lblTShirt3").style.display = "none" ;
	document.getElementById("lblTShirt3").style.visibility = "hidden" ;
	document.getElementById("lblTShirt4").style.display = "none" ;
	document.getElementById("lblTShirt4").style.visibility = "hidden" ;

		}
		
	document.getElementById("HaveAChoiceTarif").style.display = "block" ;

	
	document.getElementById("formCode").style.visibility = "visible" ;
	document.getElementById("NomCode").value = document.getElementById("nom").value ;
	document.getElementById("PrenomCode").value = document.getElementById("prenom").value ;
	if ( tabOption[0].indexOf("Etape")>1)
	{
		document.getElementById("NbrEtapeCode").value = tabOption[0].substring(0,1); ;
		NombreEtapeTotalChoisie = tabOption[0].substring(0,1); 
	}
	else
	{
		document.getElementById("NbrEtapeCode").value = "1" ;
	}
	
	document.getElementById("PrixInscription").value = tabOption[1] ;
	if ( tabOption[3]== "True")
	{
		document.getElementById("lblTShirt").style.display = "block" ;
		document.getElementById("lblTShirt").style.visibility = "visible" ;

		 if (JuraDefi=="1" && xEquipe)
		{

		document.getElementById("lblTShirt2").style.display = "block" ;
		document.getElementById("lblTShirt2").style.visibility = "visible" ;
		document.getElementById("lblTShirt3").style.display = "block" ;
		document.getElementById("lblTShirt3").style.visibility = "visible" ;
		document.getElementById("lblTShirt4").style.display = "block" ;
		document.getElementById("lblTShirt4").style.visibility = "visible" ;
		
		}
		
	}
	
	CalculPrixTotal();

}

function isMail(txtMail)
{
	var regMail=new RegExp("^[0-9a-z._-]+@{1}[0-9a-z. -]{2,}[.]{1}[a-z]{2,5}$", "i");
	return regMail.test(txtMail);
}
function CalculateTotalReduction()
{
	TotalReduction = 0;
	/******** INFormation des Option choisie **************/
if (ArrayListReductionActif.length > 0)
{

	for(var iOptionReduc=0; iOptionReduc<ArrayListReductionActif.length; ++iOptionReduc) 
	{
		if (ArrayListReductionActif[iOptionReduc].Code.length > 1)
		{
			
				TotalReduction = TotalReduction+ parseFloat(ArrayListReductionActif[iOptionReduc].Value);
			
		}
	}
	
}
	
}
function check() {


/******** INFormation des Option choisie **************/
if (ArrayListReductionActif.length > 0)
{

	for(var iOptionReduc=0; iOptionReduc<ArrayListReductionActif.length; ++iOptionReduc) 
	{
		if (ArrayListReductionActif[iOptionReduc].Code.length > 1)
		{
			// Concaténation Reduction
			document.getElementById("strCodeReduction").value = document.getElementById("strCodeReduction").value + ArrayListReductionActif[iOptionReduc].Code +";"+ ArrayListReductionActif[iOptionReduc].Value+";"+ArrayListReductionActif[iOptionReduc].Type +"\n";
		}
	}
	
}


f1 =  document.getElementById("Formulaire");

	if (f1.nom.value.length<3) {
		alert("Merci d'indiquer votre nom");
		f1.nom.focus();
		return false;
	}

		if (f1.prenom.value.length<3) {
		alert("Merci d'indiquer votre prÃ©nom");
		f1.prenom.focus();
		return false;
	}
		if (!isMail(f1.email.value)) {
		alert("Merci d'indiquer un mail valide pour que nous puissions vous rÃ©pondre");
		f1.email.focus();
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
		if (f1.NomDepart.value.length<1) {
		alert("Merci d'indiquer votre dÃ©part");
		f1.nom_depart.focus();
		return false;
	}

	if (f1.NomParcours.value.length<1) {
		alert("Merci d'indiquer le type de votre parcours");
		f1.NomParcours.focus();
		return false;
	}
		if (f1.date.value.length!=4) {
		alert("Merci d'indiquer votre annÃ©e de naissance ex: 1988");
		f1.date.focus();
		return false;
	}
		if (f1.sexe.value.length<1) {
		alert("Merci d'indiquer votre sexe");
		f1.sexe.focus();
		return false;
	}
	if ( f1.Reglement.checked == 0) {
		alert("Merci d'accepter le réglement");
		f1.Reglement.focus();
		return false;
	}
	
	// SI Equipe
	if (ArrayParcours.length > 1)
	{
	var intselected = document.getElementById("NomParcours").selectedIndex-1;
	}
	else
	{
		var intselected = document.getElementById("NomParcours").selectedIndex;
	}
	var Cat =	document.getElementById("NomDepart");
	var tabOption = Cat.value.split(';');
	var DepartObj = ArrayParcours[intselected].ArrayDepart[tabOption[0]];	

	/// Int cat selected 
	if (DepartObj.ArrayCat[tabOption[1]].xEquipe == "True")
	{
		// SI Nombre discpline > 1 
		var NbrDiscipline = DepartObj.ArrayDiscipline.length;
	
		if (NbrDiscipline > 1 ) 
		{
				
				if ( f1.NomEquipe.value.length <1) {
				alert("Merci d'inqdiquer le Nom de votre équipe");
				f1.NomEquipe.focus();
				return false;
			}
			if ( f1.NomDisc1.value.length <1) {
				alert("Merci d'inqdiquer le Nom du coureur du premier relais");
				f1.NomDisc1.focus();
				return false;
			}
			if ( f1.PrenomDisc1.value.length <1) {
				alert("Merci d'inqdiquer le Prénom du coureur du premier relais");
				f1.PrenomDisc1.focus();
				return false;
			}
			
				
			if ( f1.NomDisc2.value.length <1) {
				alert("Merci d'inqdiquer le Nom du coureur du deuxième relais");
				f1.NomDisc2.focus();
				return false;
			}
			if ( f1.PrenomDisc2.value.length <1) {
				alert("Merci d'inqdiquer le Prénom du coureur du deuxième relais");
				f1.PrenomDisc2.focus();
				return false;
			}
		}
		// SI Nombre discpline > 2
		if ( NbrDiscipline > 2) 
		{
			if ( f1.NomDisc3.value.length<1) {
				alert("Merci d'inqdiquer le Nom du coureur du troisième relais");
				f1.NomDisc3.focus();
				return false;
			}
			if ( f1.PrenomDisc3.value.length<1) {
				alert("Merci d'inqdiquer le Prénom du coureur du troisième relais");
				f1.PrenomDisc3.focus();
				return false;
			}
		}
		// SI Nombre discpline > 3
		if (NbrDiscipline > 3 ) 
		{
			if ( f1.NomDisc4.value.length<1) {
				alert("Merci d'inqdiquer le Nom du coureur du quatrième relais");
				f1.NomDisc4.focus();
				return false;
			}
			if ( f1.PrenomDisc4.value.length<1) {
				alert("Merci d'inqdiquer le Prénom du coureur du quatrième relais");
				f1.PrenomDisc4.focus();
				return false;
			}
		}
		// SI Nombre discpline > 4
		if (NbrDiscipline > 4 ) 
		{
			if ( f1.NomDisc5.value.length<1) {
				alert("Merci d'inqdiquer le Nom du coureur du cinquième relais");
				f1.NomDisc5.focus();
				return false;
			}
			if ( f1.PrenomDisc5.value.length<1) {
				alert("Merci d'inqdiquer le Prénom du coureur du cinquième relais");
				f1.PrenomDisc5.focus();
				return false;
			}
		}
		// SI Nombre discpline > 5
		if (NbrDiscipline > 5 ) 
		{
			if ( f1.NomDisc6.value.length<1) {
				alert("Merci d'indiquer le Nom du coureur du sixième relais");
				f1.NomDisc6.focus();
				return false;
			}
			if ( f1.PrenomDisc6.value.length<1) {
				alert("Merci d'inqdiquer le Prénom du coureur du sixième relais");
				f1.PrenomDisc6.focus();
				return false;
			}
		}
		
	}
	if ( f1.nbrEtapeInsc.value.length<1  )
		 {
		alert("Merci de choisir une Option");
		f1.nbrEtapeInsc.focus();
		return false;
	}
	f1.submit();
}

function ChoixCoureurs(f)
{
	document.getElementById("InformationsCoureurs").style.display="block";
	
	document.getElementById("Coureur").setAttribute("style","background-color:#FFFFFF");
	
	var Coureur= new Object();
	Coureur = ArrayCoureurs[f.Coureur.value - 1];
	document.getElementById("idCoureur").value = Coureur.ID;
	document.getElementById("nom").value = Coureur.Nom;
	document.getElementById("prenom").value = Coureur.Prenom ;
	document.getElementById("email").value = Coureur.Mail ;
	document.getElementById("adresse").value = Coureur.Adresse ;
	document.getElementById("zip").value = Coureur.NPA  ;
	document.getElementById("ville").value = Coureur.Localite ;
	document.getElementById("club").value = Coureur.Club ;
	document.getElementById("pays").value =  Coureur.Pays ;
	if (Coureur.Sexe == "H")
	{
		document.getElementById("sexe").value = "Homme" ;
	}
	else
	{
		document.getElementById("sexe").value = "Dame" ;	
	}
	
	document.getElementById("date").value = Coureur.DateNaissance ;

	
	if (ArrayParcours.length ==1 || f.NomParcours.value.length>0)
	{
		liste_depart(f) 
	}
	
				
}




function ChoiceDepart(f)
{
	
	if (f.NomParcours.value.length>0) 
	{
		if (f.date.value.length==4)
		{
			if (f.sexe.value.length>0)
			{
				if (ArrayParcours.length > 1)
				{
					var intselected = document.getElementById("NomParcours").selectedIndex-1;
				}
				else
				{
					var intselected = document.getElementById("NomParcours").selectedIndex;
				}
				
				document.getElementById("HaveAChoiceCategorie").style.display="block";
				
				document.getElementById("NomDepart").setAttribute("style","background-color:#FFFFFF");
				
				var e = document.getElementById("nbrEtapeInsc");
				e.options.length = 0;
				if (typeof ArrayParcours[intselected].ArrayDepart != "undefined")
				{
					var nbrDepart = ArrayParcours[intselected].ArrayDepart.length;
					var ParcoursObj = ArrayParcours[intselected];
					var intselectedDepart = document.getElementById("NomDepart").selectedIndex-1
					document.getElementById("lblNomEquipe");
					var Cat =	document.getElementById("NomDepart");
					var tabOption = Cat.value.split(';');
					var DepartObj = ArrayParcours[intselected].ArrayDepart[tabOption[0]];
			
					document.getElementById("NomCat").value = tabOption[3] ;
					document.getElementById("NumCat").value = tabOption[4] ;	
					
					//********* initialisatino des champs **********************/
					document.getElementById("lblNomEquipe").style.display = "none" ;
					document.getElementById("disc1").style.display = "none" ;
					document.getElementById("lblNomDisc1").display = "none" ;
					document.getElementById("lblPrenomDisc1").display = "none" ;
					document.getElementById("disc2").style.display = "none" ;
					document.getElementById("lblNomDisc2").display = "none" ;
					document.getElementById("lblPrenomDisc2").display = "none" ;
					document.getElementById("disc3").style.display = "none";
					document.getElementById("lblNomDisc3").style.display = "none" ;
					document.getElementById("lblPrenomDisc3").style.display = "none" ;
					document.getElementById("disc4").style.display = "none" ;
					document.getElementById("lblNomDisc4").style.display = "none" ;
					document.getElementById("lblPrenomDisc4").style.display = "none" ;
					document.getElementById("disc5").style.display = "none" ;
					document.getElementById("lblNomDisc5").style.display = "none" ;
					document.getElementById("lblPrenomDisc5").style.display = "none" ;
					document.getElementById("disc6").style.display = "none" ;
					document.getElementById("lblNomDisc6").style.display = "none" ;
					document.getElementById("lblPrenomDisc6").style.display = "none" ;
					

						document.getElementById("lblNomEquipe").style.visibility = "hidden" ; ;
					document.getElementById("disc1").style.visibility = "hidden" ; ;
					document.getElementById("lblNomDisc1").style.visibility = "hidden" ; ;
					document.getElementById("lblPrenomDisc1").style.visibility = "hidden" ;;
					document.getElementById("disc2").style.visibility = "hidden" ;;
					document.getElementById("lblNomDisc2").style.visibility = "hidden" ;;
					document.getElementById("lblPrenomDisc2").style.visibility = "hidden" ;;
					document.getElementById("disc3").style.visibility = "hidden" ;;
					document.getElementById("lblNomDisc3").style.visibility = "hidden" ;;
					document.getElementById("lblPrenomDisc3").style.visibility = "hidden" ; ;
					document.getElementById("disc4").style.visibility = "hidden" ;;
					document.getElementById("lblNomDisc4").style.visibility = "hidden" ; ;
					document.getElementById("lblPrenomDisc4").style.visibility = "hidden" ; ;
					document.getElementById("disc5").style.visibility = "hidden" ;
					document.getElementById("lblNomDisc5").style.visibility = "hidden" ;
					document.getElementById("lblPrenomDisc5").style.visibility = "hidden" ;
					document.getElementById("disc6").style.visibility = "hidden" ;
					document.getElementById("lblNomDisc6").style.visibility = "hidden" ;
					document.getElementById("lblPrenomDisc6").style.visibility = "hidden" ;
					
					document.getElementById("TableEquipe").style.visibility = "hidden" ;
					document.getElementById("TableEquipe").style.display  = "none" ;
						
					document.getElementById("RowDuo").style.visibility = "hidden" ;
					document.getElementById("RowDuo").style.display  = "none" ;
			
					document.getElementById("RowEquipe").style.visibility = "hidden" ;
					document.getElementById("RowEquipe").style.display  = "none" ;							
					
		
					xEquipe = false;
					if (DepartObj.ArrayCat[tabOption[1]].xEquipe == "True")
					{
						document.getElementById("lblNomEquipe").style.visibility = "visible" ;
						document.getElementById("lblNomEquipe").style.display  = "block" ;
					//	document.getElementById("lblNomEquipe").style.visibility = "visible" ;
					//	document.getElementById("lblNomEquipe").style.display  = "block" ;
						xEquipe = true; // Utile pour nombre de t-shirt spécial Jura défi
						var NbrDiscipline = DepartObj.ArrayDiscipline.length;
						for(var iDiscipline=0; iDiscipline<NbrDiscipline ; ++iDiscipline) 
						{
							
							Disc = new Object();
							Disc =	DepartObj.ArrayDiscipline[iDiscipline];
							
							
							switch(iDiscipline) {
							case 0:
							if (NbrDiscipline > 1)
							{
							
							
								document.getElementById("disc1").style.visibility = "visible" ;
								document.getElementById("lblNomDisc1").style.visibility = "visible" ;
								document.getElementById("lblPrenomDisc1").style.visibility = "visible" ;
							
								document.getElementById("disc1").style.display  = "block" ;
								document.getElementById("lblNomDisc1").style.display  = "block" ;
								document.getElementById("lblPrenomDisc1").style.display  = "block" ;
								text = Disc.Nom;
								if (Disc.Distance != null && Disc.Distance.length > 0)
								{
								text	+" / "+ Disc.Distance ;
								}
								if (Disc.Deniv != null && Disc.Deniv.length > 0)
								{
								text	+" / "+ Disc.Deniv ;
								}
								document.getElementById("disc1").innerHTML = text;
							}
							break;
							case 1:
								document.getElementById("disc2").style.visibility = "visible" ;
								document.getElementById("lblNomDisc2").style.visibility = "visible" ;
								document.getElementById("lblPrenomDisc2").style.visibility = "visible" ;
								
								document.getElementById("disc2").style.display  = "block" ;
								document.getElementById("lblNomDisc2").style.display  = "block" ;
								document.getElementById("lblPrenomDisc2").style.display  = "block" ;
								
													text = Disc.Nom;
								if (Disc.Distance != null &&  Disc.Distance.length > 0)
								{
								text	+" / "+ Disc.Distance ;
								}
								if (Disc.Deniv != null && Disc.Deniv.length > 0)
								{
								text	+" / "+ Disc.Deniv ;
								}
								document.getElementById("disc2").innerHTML = text;
							break;
							case 2:
							
								document.getElementById("disc3").style.visibility = "visible" ;
								document.getElementById("lblNomDisc3").style.visibility = "visible" ;
								document.getElementById("lblPrenomDisc3").style.visibility = "visible" ;
				
								document.getElementById("disc3").style.display  = "block" ;
								document.getElementById("lblNomDisc3").style.display  = "block" ;
								document.getElementById("lblPrenomDisc3").style.display  = "block" ;
								
										text = Disc.Nom;
								if (Disc.Distance != null &&  Disc.Distance.length > 0)
								{
								text	+" / "+ Disc.Distance ;
								}
								if (Disc.Deniv != null && Disc.Deniv.length > 0)
								{
								text	+" / "+ Disc.Deniv ;
								}
								document.getElementById("disc3").innerHTML = text;
								break;
							case 3:
							
								document.getElementById("disc4").style.visibility = "visible" ;
								document.getElementById("lblNomDisc4").style.visibility = "visible" ;
								document.getElementById("lblPrenomDisc4").style.visibility = "visible" ;
								document.getElementById("disc4").style.display  = "block" ;
								document.getElementById("lblNomDisc4").style.display  = "block" ;
								document.getElementById("lblPrenomDisc4").style.display  = "block" ;
															text = Disc.Nom;
								if (Disc.Distance != null &&  Disc.Distance.length > 0)
								{
								text	+" / "+ Disc.Distance ;
								}
								if (Disc.Deniv != null && Disc.Deniv.length > 0)
								{
								text	+" / "+ Disc.Deniv ;
								}
								document.getElementById("disc4").innerHTML = text;
								break;
							case 4:
								document.getElementById("disc5").style.visibility = "visible" ;
								document.getElementById("lblNomDisc5").style.visibility = "visible" ;
								document.getElementById("lblPrenomDisc5").style.visibility = "visible" ;
								document.getElementById("disc5").style.display  = "block" ;
								document.getElementById("lblNomDisc5").style.display  = "block" ;
								document.getElementById("lblPrenomDisc5").style.display  = "block" ;
								text = Disc.Nom;
								if (Disc.Distance != null &&  Disc.Distance.length > 0)
								{
								text	+" / "+ Disc.Distance ;
								}
								if (Disc.Deniv.length > 0)
								{
								text	+" / "+ Disc.Deniv ;
								}
								document.getElementById("disc5").innerHTML = text;
							break;
							case 5:
								document.getElementById("disc6").style.visibility = "visible" ;
								document.getElementById("lblNomDisc6").style.visibility = "visible" ;
								document.getElementById("lblPrenomDisc6").style.visibility = "visible" ;
								document.getElementById("disc6").style.display  = "block" ;
								document.getElementById("lblNomDisc6").style.display  = "block" ;
								document.getElementById("lblPrenomDisc6").style.display  = "block" ;
								text = Disc.Nom;
								if (Disc.Distance != null &&  Disc.Distance.length > 0)
								{
								text	+" / "+ Disc.Distance ;
								}
								if (Disc.Deniv != null && Disc.Deniv.length > 0)
								{
								text	+" / "+ Disc.Deniv ;
								}
								document.getElementById("disc6").innerHTML = text;
							break;
							}
							
						}		
					}
					if (DepartObj.NombrePersonneDuo || DepartObj.NombrePersonneEquipe)
					{
		
						document.getElementById("TableEquipe").style.visibility = "visible" ;
						document.getElementById("TableEquipe").style.display  = "block" ;					
						if (DepartObj.NombrePersonneDuo)
						{
							document.getElementById("RowDuo").style.visibility = "visible" ;
							document.getElementById("RowDuo").style.display  = "block" ;
						}
						if (DepartObj.NombrePersonneEquipe)
						{
							document.getElementById("RowEquipe").style.visibility = "visible" ;
							document.getElementById("RowEquipe").style.display  = "block" ;							
						}
					}
						
		
					var i;	
					var j;	
					console.log(ParcoursObj);
					for (i = 0; i < ParcoursObj.ArrayZoneTarifs.length; i++) 
					{
						
						// Si la zone de tarifs est actif 
						var NombrePersonneMax = parseInt(ParcoursObj.ArrayZoneTarifs[i].NombreMaxInscription);
						if (isNaN(NombrePersonneMax) )
						{
							NombrePersonneMax = 0;
						}
							console.log("Personne max" +NombrePersonneMax + "  / " + ParcoursObj.NombreCoureurInscrit);
						if ( ParcoursObj.ArrayZoneTarifs[i].DateEnd > DateToday && ( NombrePersonneMax== 0 ||  NombrePersonneMax > ParcoursObj.NombreCoureurInscrit ) )
						{
										
						 ZoneTarifsActif = ParcoursObj.ArrayZoneTarifs[i];
							for (j = 0; j < ParcoursObj.ArrayZoneTarifs[i].ArrayTarifs.length; j++) 
							{
								var tarifsActif = ParcoursObj.ArrayZoneTarifs[i].ArrayTarifs[j];
								// Information pour jura défi 2021 pour ne pas avoir toute les zone de tarif
								if ( tarifsActif.Nom.includes("Equipes")  )
								{
									if (xEquipe)
									{
										e.options.add( new Option( tarifsActif.Nom + " - " + tarifsActif.Option + "CHF",tarifsActif.Nom + ";"+ tarifsActif.Option + ";"+ tarifsActif.OnLine + ";" + tarifsActif.T_Shirt));
										console.log(tarifsActif)	;
									}
								 }
								 else if (tarifsActif.Nom.includes("Individuel"))
								 {
									if (!xEquipe)
									{
										e.options.add( new Option( tarifsActif.Nom + " - " + tarifsActif.Option + "CHF",tarifsActif.Nom + ";"+ tarifsActif.Option + ";"+ tarifsActif.OnLine + ";" + tarifsActif.T_Shirt));
										console.log(tarifsActif)	;
									}
								 }
								 else if (JuraDefi == 1)
								 {
									if (!xEquipe)
									{
										e.options.add( new Option( tarifsActif.Nom + " - " + tarifsActif.Option + "CHF",tarifsActif.Nom + ";"+ tarifsActif.Option + ";"+ tarifsActif.OnLine + ";" + tarifsActif.T_Shirt));
										console.log(tarifsActif)	;
									}
								 }
								else
								{
									e.options.add( new Option( tarifsActif.Nom + " - " + tarifsActif.Option + "CHF",tarifsActif.Nom + ";"+ tarifsActif.Option + ";"+ tarifsActif.OnLine + ";" + tarifsActif.T_Shirt));
									console.log(tarifsActif)	;
								}					
							}
							break; // Arret de l'ajout des zone après la première zone trouver // attention mettre le fichier dans l'ordre 
						}
					}
				
					if (j > 1)
					{
						document.getElementById("lblNbrEtape").style.display  = "block" ;
						document.getElementById("lblNbrEtape").style.visibility = "visible" ;
						var z = new Option("Sélectionner", "" );
						e.setAttribute("style","background-color:#41e063");
						e.options.add( z,0);	
						e.selectedIndex = 0;
					}
					else
					{
						document.getElementById("lblNbrEtape").style.display  = "block" ;
						document.getElementById("lblNbrEtape").style.visibility = "visible" ;
						choiceOption(f);
					}
					
					// Pour chaque reduction créer un élement dans la paragraphe de réduction
					for (i = 0; i < DepartObj.ArrayReduction.length; i++) 
					{
					
						if ( DepartObj.ArrayReduction[i].DateStart  < DateToday  )
						{
						
						var pReduc = document.createElement("p");
						   var InCheckbox = document.createElement("input");
						   InCheckbox.onclick = function(){CheckReduc(this)};

						   InCheckbox.setAttribute("type", "checkbox");
							InCheckbox.setAttribute("value", DepartObj.ArrayReduction[i].Nom+";"+ DepartObj.ArrayReduction[i].Valeur);
							var text = document.createElement("label");
							text.textContent = DepartObj.ArrayReduction[i].Nom + " " +DepartObj.ArrayReduction[i].Valeur + "CHF" ;
							
							pReduc.appendChild(InCheckbox);
							pReduc.appendChild(text);
							
							document.getElementById("OptionReduction").appendChild(pReduc);
						}
					}
				}
				
			}
		}
	}
}

function CheckReduc(checkbox ) 
{
var words = checkbox.value.split(';');
	if (checkbox.checked)
	{
		
		
		AddReduction(checkbox.value,parseFloat(words[1])*-1,"OptionReduction");
		
		
	}
	else
	{
		TotalReduction = TotalReduction + parseFloat(words[1]);
		/** Supression de option dans le tableau ***/
		for(var iOptionReduc=0; iOptionReduc<ArrayListReductionActif.length; ++iOptionReduc) 
		{
			if ("OptionReduction" == ArrayListReductionActif[iOptionReduc].Type && checkbox.value == ArrayListReductionActif[iOptionReduc].Code)
			{
			
				ArrayListReductionActif[iOptionReduc].Code= "";
			}
		}
	}
	console.log(ArrayListReductionActif);
		CalculPrixTotal();
}
function addValue(Text , Value) 
{
	var sel = document.getElementById("NomParcours");
	sel.options.add( new Option(Text, Value));
 }
	
function liste_depart(f) 
{
/* Rendre invisible les différents champs lors de l'initialisation */
	document.getElementById("lblNomEquipe").style.display  = "none" ;
	document.getElementById("lblNomDisc1").style.display  = "none" ;
	document.getElementById("lblPrenomDisc1").style.display  = "none" ;
	document.getElementById("lblNomDisc2").style.display  = "none" ;
	document.getElementById("lblPrenomDisc2").style.display  = "none" ;
	document.getElementById("lblNomDisc3").style.display  = "none" ;
	document.getElementById("lblPrenomDisc3").style.display  = "none" ;
	document.getElementById("disc1").style.display  = "none" ;
	document.getElementById("disc2").style.display  = "none" ;
	document.getElementById("disc3").style.display  = "none" ;
	document.getElementById("disc4").style.display  = "none" ;
	document.getElementById("lblNomEquipe").style.visibility = "hidden" ;
	document.getElementById("lblNomDisc2").style.visibility = "hidden" ;
	document.getElementById("lblPrenomDisc2").style.visibility = "hidden" ;
	document.getElementById("lblNomDisc1").style.visibility = "hidden" ;
	document.getElementById("lblPrenomDisc1").style.visibility = "hidden" ;
	document.getElementById("lblNomDisc3").style.visibility = "hidden" ;
	document.getElementById("lblPrenomDisc3").style.visibility = "hidden" ;
	document.getElementById("lblNomDisc4").style.visibility = "hidden" ;
	document.getElementById("lblPrenomDisc4").style.visibility = "hidden" ;
	document.getElementById("disc1").style.visibility = "hidden" ;
	document.getElementById("disc2").style.visibility = "hidden" ;
	document.getElementById("disc3").style.visibility = "hidden" ;
	document.getElementById("disc4").style.visibility = "hidden" ;
	
	var sel = document.getElementById("NomDepart");
	var lbl = document.getElementById("lblDepart");
	var bpSend = document.getElementById("ButtonSendFormulaire");
	var bpReglement = document.getElementById("Reglement");
		var bpPartenaire = document.getElementById("Partenaire");
	var ICounterCat = 0;
	
	if (f.NomParcours.value.length>0) 
	{
		document.getElementById("NomParcours").setAttribute("style","background-color:#FFFFFF");
				
		if (f.date.value.length==4)
		{
			
			if (f.sexe.value.length>0)
			{

				if (ArrayParcours.length > 1)
				{
				var intselected = document.getElementById("NomParcours").selectedIndex-1;
				}
				else
				{
					var intselected = document.getElementById("NomParcours").selectedIndex;
				}
				sel.options.length = 0;
				
				if (typeof ArrayParcours[intselected].ArrayDepart != "undefined")
				{
					var nbrDepart = ArrayParcours[intselected].ArrayDepart.length;
					
					for(var iDepart=0; iDepart<nbrDepart; ++iDepart) 
					{
						
						var DepartObj = ArrayParcours[intselected].ArrayDepart[iDepart];
						var NbrCat = DepartObj.ArrayCat.length;
			
						for(var iCategorie=0; iCategorie<NbrCat; ++iCategorie) 
						{	

							var Cat = new Object();
							Cat = DepartObj.ArrayCat[iCategorie];
							var sexe = "D";
													
							if (f.sexe.value == "Homme" )
							{
								 sexe = "H";
							}	
							if ((Cat.sexe == "M" ||sexe== Cat.sexe ) &&  (  parseInt(f.date.value) >= Cat.AnneeStart ) && (parseInt(f.date.value)<=  Cat.AnneeEnd ))
							{
								sel.options.add( new Option(Cat.nom_cat+" "+Cat.AnneeStart+" - "+Cat.AnneeEnd+ " " + DepartObj.DistanceTotal,iDepart +";"+iCategorie + ";"+ DepartObj.Nom + ";"+ Cat.nom_cat+ ";" + Cat.num_cat));
							console.log("Cat"+Cat.nom_cat);
								ICounterCat++;
							}
						}
					
					}
				}
				var lblinfo = document.getElementById("lblInformation"); 
				if (ICounterCat == 0)
				{

					// Valeurs incorect pour ce dÃ©part 
					bpReglement.style.visibility = "hidden" ;
					bpPartenaire.style.visibility = "hidden" ;
					bpSend.style.visibility = "hidden" ;
					sel.style.visibility = "hidden" ;
					document.getElementById('date').style.backgroundColor="#fa8a8a";
					document.getElementById('NomParcours').style.backgroundColor="#fa8a8a";
					lblinfo.style.visibility = "visible" ;
					lblinfo.style.display  = "block" ;
				 
				// ajoute le noeud texte au nouveau div crÃ©Ã©
				//	Div.value = "Aucune catÃ©gorie existe sur ce parcours pour cette annÃ©e de naissance";
				}
				else 
				{
					bpReglement.style.visibility = "visible" ;
					bpPartenaire.style.visibility = "visible" ;
					bpSend.style.visibility = "visible" ;
					lblinfo.style.visibility = "hidden" ;
					sel.style.visibility = "visible" ;
					lblinfo.style.display  = "none" ;
					document.getElementById('date').style.backgroundColor="white";
					document.getElementById('NomParcours').style.backgroundColor="white";
				}
				
				if (ICounterCat >1)
				{
					
				
					var z = new Option("Sélectionner", "" );
		
					sel.insertBefore(z, sel.firstChild);
			
					sel.options[0].setAttribute("selected", "selected");
					sel.ReadOnly = false;
				}
				else
				{
					sel.ReadOnly = true;
					ChoiceDepart(f);
				}
			}
			else
			{
				sel.style.visibility = "hidden" ;
			}
		}
		else
		{
			sel.style.visibility = "hidden" ;
			if (f.date.value.length>1)
			{
				alert("Merci d'indiquer votre annÃ©e de naissance ex: 1988");
				f.date.focus();
			}
		}
	}
	else
	{
		sel.style.visibility = "hidden" ;
	}

	if (sel.style.visibility == "visible")
	{
		//sel.style.display  = "block" ;
		lbl.style.display  = "block" ;
	}
	lbl.style.visibility =	sel.style.visibility;
}
</script>
		<!---***************** Liste des parcours****************


*****************************************************************		!---->
		<?php
		// Afficher la liste des Parcours  Dossier dans la course ;
		$pathfolder = 'courses/'.$_GET['NomCourse'].$ANNEE_COURSE;
		// CrÃ©ation de la liste de toutes les Dossier = Parcours 
		$files1 = scandir($pathfolder);
				?>
		<script>
					console.log(	<?php echo json_encode($pathfolder)?>); 
				</script><?
		// Liste des ficbier 
		foreach ($files1  as $key => $Parcours) 
		{ 

			if(is_dir($pathfolder .'/'.$Parcours))
			{
				// Affichage dans la liste des dÃ©part dans le menu 
				if (strlen($Parcours) >2 && $Parcours != "info") 
				{	

				?>	
				<script>
				/*********************** CREATION OBJET PARCOURS ******************************/
					var Parcours= new Object();
					
					Parcours.nom=<?php echo json_encode($Parcours); ?>;
					Parcours.NombreCoureurInscrit = 0;
					var ArrayZoneTarifs = [];
					var ArrayDepart = [];
				</script>
				<?php
					//<!--- Liste des DÃ©part !---->
					// Afficher la liste des Parcours  Dossier dans la course ;
					$pathfolderDepart = 'courses/'.$_GET['NomCourse'].$ANNEE_COURSE. '/'.$Parcours;
					// CrÃ©ation de la liste de toutes les Dossier = Depart 
					$filesDepart = scandir($pathfolderDepart);

					foreach ($filesDepart  as $key => $depart) 
					{ 
						if(is_dir($pathfolderDepart .'/'.$depart) )
						{
							if (strlen($depart) >2)
							{
							?>
								<script>
									var ArrayDiscipline = [];
									var ArrayReduction = [];
									var Depart= new Object();
									
									Depart.Nom = <?php echo json_encode($depart); ?>;
									
								</script>
								<?php
								// Lecture du fichier info.txt du depart 	
								$pathFileInfo = 'courses/'.$_GET['NomCourse'].$ANNEE_COURSE.'/'.$Parcours.'/'.$depart.'/info.txt';
								if (file_exists($pathFileInfo))
								{
									if (($handle = fopen($pathFileInfo, "r")) !== FALSE) 
									{
										$cmpt =0;
								
								
										while (($datatxt = fgetcsv($handle, 1000, ";")) !== FALSE) 
										{
											$cmpt++; ?>
											<script>
												console.log(	<?php echo json_encode($cmpt)?>); 
											</script>
											<?php			
											if( $datatxt[0] != 'Discipline' &&  $datatxt[0] != 'Reduction'&&  $datatxt[0] != 'Point')
											{?>
											<script>
												
												Depart.HeureStart=<?php echo json_encode($datatxt[0]); ?>;
												Depart.DistanceTotal = <?php echo json_encode($datatxt[3]); ?>;
												<? if (count($datatxt) > 5)
												{?>
												Depart.NombrePersonneDuo = <?php echo json_encode($datatxt[5])?>;
												Depart.NombrePersonneEquipe = <?php echo json_encode($datatxt[6])?>;										
												<?
												}
												?>
	
											</script>

											<?php
											}
											// Lecture Ligne 2 et +
											
											else	if ($datatxt[0] == 'Discipline')
											{
												?>
												<script>
												var Discpline = new Object();
													Discpline.Nom = <?php echo json_encode($datatxt[1]); ?>;
													Discpline.Distance = <?php echo json_encode($datatxt[2]); ?>;
													Discpline.Deniv = <?php echo json_encode($datatxt[3]); ?>;
													ArrayDiscipline.push(Discpline);
												</script>
												<?php
											}
											else if ($datatxt[0] == 'Reduction')
											{	?>
												<script>											
												var Reduction = new Object();
												Reduction.Nom = <?php echo json_encode($datatxt[1]); ?>;
												Reduction.Valeur = <?php echo json_encode($datatxt[2]); ?>;
												Reduction.DateStart = <?php echo json_encode($datatxt[3]); ?>;
												ArrayReduction.push(Reduction);
											
												</script>	<?php
											}
											
										}
									}
								}
							
								/******************* CATEGORIE *************************/
								// Lecture du fichier CAT.csv 	
								$pathFileCat = 'courses/'.$_GET['NomCourse'].$ANNEE_COURSE.'/'.$Parcours.'/'.$depart.'/cat.csv';?>
								<Script>
									var ArrayCat = [];
								</script><?php
								if (($handle = fopen($pathFileCat, "r")) !== FALSE) 
								{
									while (($data = fgetcsv($handle, 1000, ";")) !== FALSE) 
									{ ?>
										<script>
											var Categorie= new Object();								
											Categorie.num_cat =	<?php echo json_encode($data[0]); ?>;				
											Categorie.nom_cat = <?php echo json_encode($data[1]); ?>;
											Categorie.sexe = <?php echo json_encode($data[4]); ?>;
											Categorie.AnneeStart = <?php echo json_encode(intval($data[5])); ?>;
											Categorie.AnneeEnd = <?php echo json_encode(intval($data[6])); ?>;
											Categorie.xEquipe = <?php echo json_encode($data[10]); ?>;
											
											ArrayCat.push(Categorie);							
										</script>
									<?php
									}
									?>
									<script>
										Depart.ArrayCat = ArrayCat;
										Depart.ArrayDiscipline = ArrayDiscipline;
										Depart.ArrayReduction = ArrayReduction;   
										
										
									</script>
									<?php
								}	
								?>
						<script>
						
							ArrayDepart.push(Depart);
							console.log(Depart); 
						</script><?php
						}
						}	
					}
						/********************* Tarifs *************************/
						$pathFileTarif = 'courses/'.$_GET['NomCourse'].$ANNEE_COURSE.'/'.$Parcours.'/tarif.csv';
							if (file_exists($pathFileTarif))
							{
								if (($handle = fopen($pathFileTarif, "r")) !== FALSE) 
								{
									$cmpt =0;
									
							
									while (($datatxt = fgetcsv($handle, 1000, ";")) !== FALSE) 
									{
										$cmpt++; ?>
										<script>
										var i;
										var find = -1;
																		 
									
										for (i = 0; i < ArrayZoneTarifs.length; i++) 
										{
											 if (ArrayZoneTarifs[i].Nom == <?php echo json_encode($datatxt[0]); ?> )
											 {
												 find = i;
										
												
											 }
										
										}
										var Tarifs = new Object();
										Tarifs.Nom = <?php echo json_encode($datatxt[2]); ?>;
										Tarifs.Option = <?php echo json_encode($datatxt[3]); ?>;
										Tarifs.OnLine = <?php echo json_encode($datatxt[4]); ?>;
										Tarifs.T_Shirt = <?php echo json_encode($datatxt[6]); ?>;
									
										
										if (find == -1)
										{
											var ZoneTarifs = new Object();
											ZoneTarifs.Nom = <?php echo json_encode($datatxt[0]); ?>;
											ZoneTarifs.DateEnd = <?php echo json_encode($datatxt[1]); ?>;
											ZoneTarifs.NombreMaxInscription = <?php echo json_encode($datatxt[5]); ?>;
											ZoneTarifs.T_Shirt = <?php echo json_encode($datatxt[6]); ?>;
											ZoneTarifs.ArrayTarifs = [];
											ZoneTarifs.ArrayTarifs.push(Tarifs);
											ArrayZoneTarifs.push(ZoneTarifs);
										}
										else
										{
											ArrayZoneTarifs[find].ArrayTarifs.push(Tarifs);
										}
										</script>
									<?	
									}?>
										<script>
											Parcours.ArrayZoneTarifs = ArrayZoneTarifs;

										</script>
									<?
								}
							}
							//***************** NOMBRE DE COUREUR INSCRIT DANS LE DEPART **********

							// Nombre de coureur dans la base de donnée
							$sql = 'SELECT * FROM inscription  WHERE course=\''.$NOM_COURSE. $ANNEE_COURSE. '\'AND parcours = \''.$Parcours. '\'ORDER  BY NomDepart ASC,nom ASC';

							$result = mysqli_query($con,$sql);
							$NumberCoureur =mysqli_num_rows($result);
						?>
						<script>
							Parcours.NombreCoureurInscrit = <?php echo json_encode($NumberCoureur ); ?>;
							console.log("Nombre coureur parcours; " + Parcours.NombreCoureurInscrit);
							console.log(Parcours);
						</script>
									
							
					<script>
						Parcours.ArrayDepart =ArrayDepart;
						ArrayParcours.push(Parcours);
						
					</script><?php
				}
			}
		}
		?>
		<script>
	
// When the user clicks on <div>, open the popup
function ShowPopuAddMember() {

    

  
  var popup = document.getElementById("myPopup");
  popup.classList.toggle("show");
}



			
		for(var Parcours=0; Parcours<ArrayParcours.length; ++Parcours) 
		{
			if (typeof ArrayParcours[Parcours].ArrayDepart != "undefined")
			{
				addValue(ArrayParcours[Parcours].nom , ArrayParcours[Parcours].nom) ;
			}
			else
			{
				document.write("Contacter marcbaume12@gmail.com");
			}
		}
		var sel = document.getElementById("NomParcours");
			

			if (ArrayParcours.length >1)
				{
					var opt = new Option('Sélectionner', '');
					sel.setAttribute("style","background-color:#41e063");
					sel.insertBefore(opt, sel.firstChild);
					sel.options[0].setAttribute("selected", "selected");
					sel.ReadOnly = false;
					
		
			}
			else
			{
					sel.ReadOnly = true;
					var f = document.getElementById("Formulaire");
					
					liste_depart(f) 
				
			}
// Quand on change la valeur des buttons radios du choix Equipe
    var radios = document.querySelectorAll('input[type=radio][name="Equipe"]');
    radios.forEach(radio => radio.addEventListener('change', () =>
	{


		if (radio.value> 0)
		{
			document.getElementById("lblNomEquipe").style.visibility = "visible" ;
			document.getElementById("lblNomEquipe").style.display  = "block" ;
		}
		else
		{
			document.getElementById("lblNomEquipe").style.visibility = "hidden" ;
			document.getElementById("lblNomEquipe").style.display  = "none" ;
		}
	}));

 
		</script>
		 <?php include("sponsors.php"); ?> 
		</div>

</body>
</html>