<!DOCTYPE html>
<html>
	<?php
  include("Header.php"); 
  ?>
    <body>
    <script>
		function ClosePopUpAddMember()
{
	console.log("ClosePopAddMember");
	var popup = document.getElementById("PopUpAddMember");
    popup.style.display="none";
	var page = document.getElementById("PageFormulaire");
	page.style.opacity = "1";
}
// When the user clicks on <div>, open the popup
function ShowPopuAddMember() 
{
	console.log("OpenPopAddMember");
    var popup = document.getElementById("PopUpAddMember");
    popup.style.display="block";
	var page = document.getElementById("PageFormulaire");
	page.style.opacity = "0.2";
}
function checkForm2() {
	
	f1 = document.getElementById("formAddMember")
	paraInfoAdd = document.getElementById("paraInfoAdd")
	paraInfoAdd.style.display = "block";
	textInfoAdd = document.getElementById("textInfoAdd")
	if (f1.nomAdd.value.length<2) {
		textInfoAdd.value="Merci d'indiquer votre nom";
		f1.nomAdd.focus();
		return false;
	}

		if (f1.prenomAdd.value.length<2) {
		textInfoAdd.value="Merci d'indiquer votre prénom";
		f1.prenomAdd.focus();
		return false;
	}
	
		if (f1.zipAdd.value.length<4) {
		textInfoAdd.value="Merci d'indiquer votre npa";
		f1.zipAdd.focus();
		return false;
	}
			if (f1.villeAdd.value.length<3) {
		textInfoAdd.value="Merci d'indiquer votre localite";
		f1.villeAdd.focus();
		return false;
	}
			if (f1.sexeAdd.value.length<1) {
		textInfoAdd.value="Merci d'indiquer votre sexe";
		f1.sexeAdd.focus();
		return false;
	}

	if (f1.dateNaissanceAdd.value.length!=4) {
		textInfoAdd.value="Merci d'indiquer votre année de naissance correct comme par exemple : 1988";
		f1.dateNaissanceAdd.focus();
		return false;
	}

	if (!isMail2(f1.emailAdd.value)) {
		textInfoAdd.value="Merci d'indiquer un mail valide pour que nous puissions vous répondre";
		f1.emailAdd.focus();
		return false;
	
	}
	paraInfoAdd.style.display = "none";
	AddMember();
}

function isMail2(txtMail)
{
	var regMail=new RegExp("^[0-9a-z._-]+@{1}[0-9a-z. -]{2,}[.]{1}[a-z]{2,5}$", "i");
	return regMail.test(txtMail);
}

</script>
<?php include("Header2023.php");?>

<div id="corps">
<?php include("HeaderInfo2023.php"); 

if ($NOM_COURSE =='Course des Quais  - Société de Gymnastique de Grandson' && $ANNEE_COURSE == 2024 )
{
	header('Location: https://juradefichrono.ch/formulaire2023.php?NbrEtape=1&DateCourse=2025-07-04&Etape=1&NomCourse=Course+des+Quais++-+Soci%C3%A9t%C3%A9+de+Gymnastique+de+Grandson&ID=141'); 
}
else if ( $today < $val ["DateStartInscription"] && $_SESSION['Niveau'] != 2 && $_SESSION['Niveau'] != 0 )
{
	if (isset($_SESSION['Login']) || $_SESSION['Niveau'] == 1 )
	{
		header('Location: formulaireInscriptionFermerStart.php?NbrEtape='.$Nbr_etape.'&DateCourse='.$DateCourse.'&Etape=1&NomCourse='.$NOM_COURSE.''); 		
	}
}				
else if ( $today > $val ["DATE_END_INSCRIPTION"] )
{
	header('Location: formulaireEnd.php?NbrEtape='.$Nbr_etape.'&DateCourse='.$DateCourse.'&Etape=1&NomCourse='.$NOM_COURSE.''); 
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

function EquipeChang(valueText) {
	document.getElementById("NomEquipe").value =valueText;
	$('VerifEquipe').request({
		onComplete: function(transport){
			var val =transport.responseText.evalJSON();
	}
	});
}

</script>
<!----- POP -UP AJOUT MEMBRES --------->
<div class="popup" id="PopUpAddMember" >
	<span class="popuptext" id="SpanPopUpAddMembre">
		<button class="ButtonResultat" id="ExitPopUp"  type ="button" style="float:right;margin: 0px" onClick="ClosePopUpAddMember()" title="Exit" data-toggle="tooltip" data-placement="right">X</button>
		<p class="TitlePopUP"> Ajout d'un nouvel athlète </p>
		<form style="padding: 10px" id="formAddMember" name="formAddMember" method="get" action="addMembresFormulaire.php"  >
			<input type="hidden" name="LoginCompte" id="LoginCompte"   value= '<?php echo $_SESSION['Login'] ?>' />
			<div class="input">
				<label id="lblNomAdd" for="nomAdd" >Nom :</label>
				<input type="text" name="nomAdd" id="nomAdd" tabindex="10"/>
			</div>
			<div class="input" >
				<label id="lblPrenomAdd" for="prenomAdd" >Prénom :</label> 
				<input  type="text" name="prenomAdd" id="prenomAdd" tabindex="20"/>
			</div>
			<div class="input" >
				<label id="lblEmailAdd" for="emailAdd"   >Adresse e-mail :
				</label>
				<input type="text" name="emailAdd" id="emailAdd" tabindex="40" />
			</div>
			<div class="input" >
				<label id="lblAdresseAdd" for="adresseAdd"   >Adresse :</label> 
				<input type="text" name="adresseAdd" id="adresseAdd" tabindex="50" />
			</div>
			<div class="input" >
				<label id="lblzipAdd" for="zipAdd">Numéro postale (npa) :</label> 
				<input type="text" name="zipAdd" id="zipAdd" tabindex="60"/>
			</div>
			<div class="input" >
				<label id="lblVilleAdd" for="villeAdd">Localité :</label>
				<input type="text" name="villeAdd" id="villeAdd"tabindex="70"/>
			</div>
			<div class="input" >
				<label  id="lbllPaysAdd" for="paysAdd">Pays :</label>   
				<input type="text" name="paysAdd" id="paysAdd" tabindex="80"/>
			</div>
			<div class="input">
				<label  id="lbldateAdd" for="dateNaissanceAdd">Année de Naissance :</label>
				<input type="text" name="dateNaissanceAdd" 	id="dateNaissanceAdd" tabindex="90" />
			</div>
			<div class="input">
				<label  id="lblClubAdd" for="clubAdd">Club :</label>
				<input type="text" name="clubAdd" id="clubAdd"tabindex="100"/>
			</div>			
			<div class="input">
				<label  id="lblSexe" for="sexeAdd" >Genre :</label>
				<Select name="sexeAdd"   id="sexeAdd"> 
				<option style="padding : 10px" value= "">Sélectionner</option>	
				<option style="padding : 10px" value= "D">Dame</option>
				<option style="padding : 10px" value= "H">Homme</option>				
				</select>
			</div>
			<div class="input" style="display:None;" id="paraInfoAdd" >
				<label  id="lblInfoAdd" for="textInfoAdd">Informations :</label>
				<input readonly="true" style="color:red" type="textarea" name="textInfoAdd" id="textInfoAdd"/>
			</div>
			<span class="dot" onClick="checkForm2()" style="display:flex; justify-content: center;align-items: center;">
				<i class="fa fa-plus-circle" style= "font-size: 50px;margin:9px;" ></i></br>
				<a>Ajouter</a>
			</span>	
		</form>		
	</span>
</div>

<div id="PageFormulaire" style="padding: 0px 20px;" >
<?php
// Si on est connecté on affiche dans un menu avec les coureurs de la session
if ( isset($_SESSION['Login']))
{
	$_SESSION['Nbretape'] = $_GET["Nbretape"] ;
	$_SESSION['Course'] = $_GET["NomCourse"] ;
	$_SESSION['DateCourse'] = $_GET['DateCourse'];
?>
<center>
<img src="images/FilRougeInscription4.png" style="width: 80%" >
</center>

<form id="VerifEquipe" method="get" action="VerifEquipe.php">
	<input type="hidden" name="Course" id="Course"   value= '<?php echo $NOM_COURSE. $ANNEE_COURSE ?>' />
	<input type="hidden" name="NomEquipe" id="NomEquipe"   value=  />
</form>
<form method="post" action="ciblePanier.php" id="Formulaire" name="Formulaire" >
	<!-- Select coureur -->
	<div class="classTitleWithButton">
		<div class="input" style=" width: 100%;">
			<label for="Coureur">	
				<?php if ($val ["JuraDefi"] )
				{?>
					Chef d'équipe : 
					<?
				}
				else
				{
					?>
					Coureur :
					<?
				}?>
			</label>
			<Select  onchange ="ChoixCoureurs(this.form);" name="Coureur"   id="Coureur"/>
			<!-- information coureurs masqué --> 
			<input type="hidden" name="idCoureur" id="idCoureur" />
			<input type="hidden" name="DateCourse" id="DateCourse"   value= '<?php echo $_GET['DateCourse'] ?>' />
			<input type="hidden" name="NomCourse" id="NomCourse"  value= '<?php echo $_GET["NomCourse"] ?>' />
			<input type="hidden" name="NumCat" id="NumCat" />
			<input type="hidden" name="NomCat" id="NomCat" />
			<input type="hidden" name="OnLine" id="OnLine" />
			<input type="hidden" name="Option" id="Option" />
			<input type="hidden" name="Nbretape" id="Nbretape" value= '<?php echo  $_GET["NbrEtape"] ?>' />
		</div>
		<?php if ($val ["JuraDefi"] )
		{?>
		<a><img src="admin/images/addChef.jpg" width="60px" onclick="ShowPopuAddMember()" /></a>	<?
		}
		else
		{?>
			<div class="Button" onclick="ShowPopuAddMember()" id="OpenPopUpAddCoureur" >
				<i class="fa fa-plus-circle" style= "font-size: 50px;" ></i></br>
			</div>
			<?
		}?>
		<a  class="Button" href="admin/membres.php"> 
			<i  href="admin/membres.php" class="fa fa-pencil"  style= "font-size: 50px;"></i>
		</a>
	</div>
	<div id="InformationsCoureurs" style="display:none;">
		<input type="hidden" name="nom" id="nom" />
		<input type="hidden" name="prenom" id="prenom" />
		<input type="hidden" name="email" id="email" />
		<input type="hidden" name="adresse" id="adresse"  />
		<input type="hidden" name="zip" id="zip" />
		<input type="hidden" name="ville" id="ville"/>
		<input type="hidden" name="pays" id="pays"/>					
		<input type="hidden" name="sexe"   id="sexe"  /> 
		<input  type="hidden"  name="date" id="date"  />
		<div class="classPara">
			<label>Année de Naissance:</label><a  name="tddate" id="tddate"  ></a>
		</div>
		<div class="classPara">
			<label>Sexe:</label><a  name="tdsexe" id="tdsexe"  ></a>
		</div>
		<div class="classPara">
			<label>Adresse e-mail :</label><a  name="tdemail" id="tdemail"  ></a>	
		</div>
		<div class="classPara">
			<label>Adresse  :</label><a  name="tdadresse" id="tdadresse"  ></a>
		</div>
		<div class="classPara">
			<label>Localité :</label><a  name="tdzip" id="tdzip"  ></a>
		</div>	
		<div class="classPara">
			<label>Pays  :</label><a  name="tdpays" id="tdpays" ></a>
		</div>	
		<div class="classPara">
			<label>Club :</label> <input type="text" name="club" id="club" tabindex="11"/>
		</div>	

		<h2>Informations demandées pour votre inscription </h2>
		<div id="DivInformation"style="display:none" >	
			<label id="lblInformation"></label><input type="textarea" style="color:red;"name="txtInformation" id="txtInformation" value="Aucune catégorie existe sur ce parcours pour cette année de naissance"  /></p>
		</div>
		<div class="input">
			<label for="NomParcours">Parcours : </label>
			<select onchange ="liste_depart(this.form);"  id="NomParcours" name="NomParcours" ></select>
		</div>

	<div  id="lblDepart" style="display : none;" class="input">
		<label for="NomDepart">Catégorie : </label>
		<select name="NomDepart" id="NomDepart" onchange="ChoiceDepart(this.form);"  ></select>
		<Table 	id="HaveAChoiceCategorie" style="display:none;width:100%; margin-top: 20px;">
			<tr style="padding: 20px; background :#C0C0C0; width:100%">
				<td>
					<table id="TableEquipe" style="display:none;Width : 100%;">
						<tr style="Width : 100%;">
							<td  >
								<a> Challenge Cinemont équipe/Duo mixte </a>
							</td>
							<td>
								<table id="noneEquipe">
									<tr>
										<td style ="width:50px;">
											<input  type="radio" name="Equipe" style="height:30px;font-size:130%;" Checked="true" value="0"  > 
										</td>
										<td  style ="width:300px;">
											<label for="noneEquipe" style ="width:300px;">Je ne fais pas partie d'aucune équipe /Duo </label>
										</td>
									</tr>
								</table>
								<table id="RowEquipe" style="visibility:hidden; display:none;">		
									<tr>
										<td style ="width:50px;">
											<input  type="radio" name="Equipe"  style=" height:30px;font-size:130%;" value="1" >
										</td>
										<td style ="width:300px;">
											<label style ="width:300px;" for="RowEquipe"> Je fait partie d'une équipe </label>
										</td>
									</tr>
								</table>
								<table id="RowDuo" style="visibility:hidden; display:none;">
									<tr>
										<td style ="width:50px;">
											<input  type="radio" name="Equipe"  style="  height:30px;font-size:130%;" value="2"  >
										</td>
										<td style ="width:300px;">
											<label  for="RowDuo">Je cours en DUO Mixte</label>
										</td>
									</tr>
								</table>
								<table id="RowEntreprise" style="visibility:hidden; display:none;">
									<tr>
										<td style ="width:50px;">
											<input  type="radio" name="Equipe"  style="  height:30px;font-size:130%;" value="3"  >
										</td>
										<td style ="width:300px;">
											<label  for="RowEntreprise">Je cours  avec mon entreprise</label>
										</td>							
									</tr>
								</table>
							</td>
						</tr>
					</table>
				</td>
			</tr>
		</table>
		<div class="input" id="lblNomEquipe" style="display:none;">
				<label for="NomEquipe">Nom d'équipe: (Facultatif)</label>
				<input type="text" name="NomEquipe" id="NomEquipe" tabindex="201"    />
		</div>
		<div id="Paradisc1" style=" display:none" >	
			<h2 id="disc1" > </h2>
			<p  id="lblNomDisc1" ><label for="NomDisc1" >Nom *:</label> <input type="text" name="NomDisc1" id="NomDisc1" tabindex="202"   /></p>
			<p  id="lblPrenomDisc1"><label for="PrenomDisc1">Prénom *:</label>  <input type="text" name="PrenomDisc1" id="PrenomDisc1" tabindex="203"/></p>
			<p  id="lblSexeDisc1" >
				<label for="SexeDisc1">Sexe *:</label> 
				<select id="SexeDisc1"   name="SexeDisc1"  tabindex="204">
					<option style="padding : 10px" value= "">Selectionner</option>	
					<option style="padding : 10px" value= "D">Dame</option>
					<option style="padding : 10px" value= "H">Homme</option>	
				</select>
			</p>
		</div>
		<div id="Paradisc2" style="display:none" >	
			<h2 id="disc2" > </h2>
			<p  id="lblNomDisc2"><label for="NomDisc2" >Nom *:</label> <input type="text" name="NomDisc2" id="NomDisc2" tabindex="204"   /></p>
			<p  id="lblPrenomDisc2" ><label for="PrenomDisc2">Prénom *:</label>  <input type="text" name="PrenomDisc2" id="PrenomDisc2" tabindex="210"/></p>
			<p  id="lblSexeDisc2" >
				<label for="SexeDisc2">Sexe *:</label> 
				<select id="SexeDisc2"   name="SexeDisc2"  tabindex="214">
					<option style="padding : 10px" value= "">Selectionner</option>	
					<option style="padding : 10px" value= "D">Dame</option>
					<option style="padding : 10px" value= "H">Homme</option>	
				</select>
			</p>
		</div>
		<div id="Paradisc3" style="display:none" >	
			<h2 id="disc3" > </h2>		
			<p id="lblNomDisc3" ><label for="NomDisc3"  >Nom *:</label> <input type="text" name="NomDisc3" id="NomDisc3" tabindex="305"   /></p>
			<p id="lblPrenomDisc3" ><label for="PrenomDisc3" >Prénom *:</label>  <input type="text" name="PrenomDisc3" id="PrenomDisc3" tabindex="310"/></p>
			<p  id="lblSexeDisc3"><label for="SexeDisc3">Sexe *:</label> 
			<select id="SexeDisc3"  name="SexeDisc3"  tabindex="314">
				<option style="padding : 10px" value= "">Selectionner</option>	
				<option style="padding : 10px" value= "D">Dame</option>
				<option style="padding : 10px" value= "H">Homme</option>	
			</select>
			</p>
		</div>
		<div id="Paradisc4" style="display:none" >	
			<h2 id="disc4" > </h2>		
			<p id="lblNomDisc4"><label for="NomDisc4"  >Nom *:</label> <input type="text" name="NomDisc4" id="NomDisc4" tabindex="315"   /></p>
			<p id="lblPrenomDisc4" ><label for="PrenomDisc4" >Prénom *:</label>  <input type="text" name="PrenomDisc4" id="PrenomDisc4" tabindex="320"/></p>		
			<p  id="lblSexeDisc4" ><label for="SexeDisc4">Sexe *:</label> 
			<select id="SexeDisc4"   name="SexeDisc4"  tabindex="324">
				<option style="padding : 10px" value= "">Selectionner</option>	
				<option style="padding : 10px" value= "D">Dame</option>
				<option style="padding : 10px" value= "H">Homme</option>	
			</select>
			</p>
		</div>
		<div id="Paradisc5" style="display:none" >	
			<h2 id="disc5"> </h2>		
			<p id="lblNomDisc5" ><label for="NomDisc5"  >Nom *:</label> <input type="text" name="NomDisc5" id="NomDisc5" tabindex="325"   /></p>
			<p id="lblPrenomDisc5" ><label for="PrenomDisc5" >Prénom *:</label>  <input type="text" name="PrenomDisc5" id="PrenomDisc5" tabindex="330"/></p>		
			<p  id="lblSexeDisc5">
				<label for="SexeDisc5">Sexe *:</label> 
				<select id="SexeDisc5"   name="SexeDisc5"  tabindex="334">
					<option style="padding : 10px" value= "">Selectionner</option>	
					<option style="padding : 10px" value= "D">Dame</option>
					<option style="padding : 10px" value= "H">Homme</option>	
				</select>
			</p>
		</div>
		<div id="Paradisc6" style="display:none" >	
			<h2 id="disc6" > </h2>		
			<p id="lblNomDisc6"><label for="NomDisc6"  >Nom *:</label> <input type="text" name="NomDisc6" id="NomDisc6" tabindex="335"   /></p>
			<p id="lblPrenomDisc6" ><label for="PrenomDisc6" >Prénom *:</label>  <input type="text" name="PrenomDisc6" id="PrenomDisc6" tabindex="340"/></p>	
			<p  id="lblSexeDisc6" >
				<label for="SexeDisc6">Sexe *:</label> 
				<select id="SexeDisc6"   name="SexeDisc6"  tabindex="344">
					<option style="padding : 10px" value= "">Selectionner</option>	
					<option style="padding : 10px" value= "D">Dame</option>
					<option style="padding : 10px" value= "H">Homme</option>	
				</select>
			</p>
		</div>
		<div id="ParaRemarques" style="display:none" >	
			<p id="lblRemarques"><label for="NomRemarques"  >Nom et prénom des équipiers supplémentaire *:</label> <input type="textarea" name="Remarques" id="Remarques" tabindex="336"   /></p>
		</div>
		<!---------- CHOIC TARIFS _______________-->
		<div class="input" style="width:100%;display:none; margin-top: 20px;" id="lblNbrEtape">
			<label>Choix*:</label>
			<select  style="width: 90%;" name="nbrEtape" id="nbrEtapeInsc" tabindex="410"  onchange="choiceOption(this.form)" ></select>
		</div>	
		<?php if (strlen ($val["InformationInscription"])>1)
		{?>
		<p>
			<? echo $val["InformationInscription"]?>
		</p>
		<?
		}?>
		<div id="HaveAChoiceTarif"style="display:none">		
			<?php 
			if ($NOM_COURSE == "BCJ Challenge")
			// LOrs du jura challenge on va changer la taille des t-shirt 
			{
				?>
				<p id="lblInfoTShirt" style="display:none">
					Merci d'indiquer votre taille de T-Shirt (Selon stock disponible)
				</p>
				<p id="lblTShirt"  style="display:none">
					<label for="TailleTShirt">Taille T-SHIRT</label>
					<select  style="background-color:#41e063;"  id="TailleTShirt" name="TailleTShirt" >
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
					</select>
				</p>
				<p id="lblTShirt2"  style="visibility:hidden; display:none">
					<label for="TailleTShirt2">Taille T-SHIRT</label>
					<select  style="background-color:#41e063;"  id="TailleTShirt2" name="TailleTShirt2" >
						<Option value="">Sélectionner</option>
						<Option value="3-4 ans">3-4 ans</option>
						<Option value="5-7 ans">5-7 ans</option>
						<Option value="9-11 ans">9-11 ans</option>
						<Option value="12-14 ans">12-14 ans</option>
						<Option value="S">S</option>
						<Option value="M">M</option>
						<Option value="L">L</option>
						<Option value="XL">XL</option>
						<Option value="XXL">XXL</option>
					</select>
				</p>
				<p id="lblTShirt3"  style="display:none">
					<label for="TailleTShirt3">Taille T-SHIRT</label>
					<select  style="background-color:#41e063;"  id="TailleTShirt3" name="TailleTShirt3" >
						<Option value="">Sélectionner</option>
						<Option value="3-4 ans">3-4 ans</option>
						<Option value="5-7 ans">5-7 ans</option>
						<Option value="9-11 ans">9-11 ans</option>
						<Option value="12-14 ans">12-14 ans</option>
						<Option value="S">S</option>
						<Option value="M">M</option>
						<Option value="L">L</option>
						<Option value="XL">XL</option>
						<Option value="XXL">XXL</option>
					</select>
				</p>
				<p id="lblTShirt4"  style=" display:none">
					<label for="TailleTShirt4">Taille T-SHIRT</label>
					<select  style="background-color:#41e063;"  id="TailleTShirt4" name="TailleTShirt4" >
						<Option value="">Sélectionner</option>
						<Option value="3-4 ans">3-4 ans</option>
						<Option value="5-7 ans">5-7 ans</option>
						<Option value="9-11 ans">9-11 ans</option>
						<Option value="12-14 ans">12-14 ans</option>
						<Option value="S">S</option>
						<Option value="M">M</option>
						<Option value="L">L</option>
						<Option value="XL">XL</option>
						<Option value="XXL">XXL</option>
					</select>
				</p>
				<p id="lblTShirt5"  style="visibility:hidden; display:none">
					<label for="TailleTShirt5">Taille T-SHIRT</label>
					<select  style="background-color:#41e063;"  id="TailleTShirt5" name="TailleTShirt5" >
						<Option value="">Sélectionner</option>
						<Option value="3-4 ans">3-4 ans</option>
						<Option value="5-7 ans">5-7 ans</option>
						<Option value="9-11 ans">9-11 ans</option>
						<Option value="12-14 ans">12-14 ans</option>
						<Option value="S">S</option>
						<Option value="M">M</option>
						<Option value="L">L</option>
						<Option value="XL">XL</option>
						<Option value="XXL">XXL</option>
					</select>
				</p>
				<p id="lblTShirt6"  style="visibility:hidden; display:none">
					<label for="TailleTShirt6">Taille T-SHIRT</label>
					<select  style="background-color:#41e063;"  id="TailleTShirt6" name="TailleTShirt6" >
						<Option value="">Sélectionner</option>
						<Option value="3-4 ans">3-4 ans</option>
						<Option value="5-7 ans">5-7 ans</option>
						<Option value="9-11 ans">9-11 ans</option>
						<Option value="12-14 ans">12-14 ans</option>
						<Option value="S">S</option>
						<Option value="M">M</option>
						<Option value="L">L</option>
						<Option value="XL">XL</option>
						<Option value="XXL">XXL</option>
					</select>
				</p>
			<?	
			}
			else
			{?>
				<p id="lblInfoTShirt" style="display:none">
					merci d'indiquer votre taille de T-Shirt (Selon stock disponible)
				</p>
				<p id="lblTShirt"  style="visibility:hidden; display:none">
					<label for="T_Shirt">Taille T-SHIRT</label>
					<select  style="background-color:#41e063;"  id="TailleTShirt" name="TailleTShirt" >
						<Option value="">Sélectionner</option>
						<Option value="XS">XS</option>
						<Option value="S">S</option>
						<Option value="M">M</option>
						<Option value="L">L</option>
						<Option value="XL">XL</option>
						<Option value="XXL">XXL</option>
					</select>
				</p>
				<p id="lblTShirt2"  style="visibility:hidden; display:none">
					<label for="TailleTShirt2">Taille T-SHIRT</label>
					<select  style="background-color:#41e063;"  id="TailleTShirt2" name="TailleTShirt2" >
						<Option value="">Sélectionner</option>
						<Option value="XS">XS</option>
						<Option value="S">S</option>
						<Option value="M">M</option>
						<Option value="L">L</option>
						<Option value="XL">XL</option>
						<Option value="XXL">XXL</option>
					</select>
				</p>
				<p id="lblTShirt3"  style="display:none">
					<label for="TailleTShirt3">Taille T-SHIRT</label>
					<select  style="background-color:#41e063;"  id="TailleTShirt3" name="TailleTShirt3" >
						<Option value="">Sélectionner</option>
						<Option value="XS">XS</option>
						<Option value="S">S</option>
						<Option value="M">M</option>
						<Option value="L">L</option>
						<Option value="XL">XL</option>
						<Option value="XXL">XXL</option>
					</select>
				</p>
				<p id="lblTShirt4"  style="display:none">
					<label for="TailleTShirt4">Taille T-SHIRT</label>
					<select  style="background-color:#41e063;"  id="TailleTShirt4" name="TailleTShirt4" >
						<Option value="">Sélectionner</option>
						<Option value="XS">XS</option>
						<Option value="S">S</option>
						<Option value="M">M</option>
						<Option value="XL">XL</option>
						<Option value="XXL">XXL</option>
					</select>
				</p>
				<p id="lblTShirt5"  style="display:none">
					<label for="TailleTShirt5">Taille T-SHIRT</label>
					<select  style="background-color:#41e063;"  id="TailleTShirt5" name="TailleTShirt5" >
						<Option value="">Sélectionner</option>
						<Option value="XS">XS</option>
						<Option value="S">S</option>
						<Option value="M">M</option>
						<Option value="XL">XL</option>
						<Option value="XXL">XXL</option>
					</select>
				</p>
				<p id="lblTShirt6"  style="display:none">
					<label for="TailleTShirt6">Taille T-SHIRT</label>
					<select  style="background-color:#41e063;"  id="TailleTShirt6" name="TailleTShirt6" >
						<Option value="">Sélectionner</option>
						<Option value="XS">XS</option>
						<Option value="S">S</option>
						<Option value="M">M</option>
						<Option value="XL">XL</option>
						<Option value="XXL">XXL</option>
					</select>
				</p>
			<?
			}?>
		</div>
		<div id="OptionReduction">
		</div>		
		<div style="display :none;" ><label for="nom">Prix:</label> 
			<input type="text" name="PrixDepart" id="PrixDepart" tabindex="510"  readonly  />CHF
		</div>
		<?
		$pathReglement = 'courses/'.$_GET['NomCourse'].$ANNEE_COURSE.'/info/Règlement.pdf';
		if (!file_exists($pathReglement))
		{
			$pathReglement = 'Règlement.pdf';
		}
		?> 
		<!-- lit de tous les code de réduction utiliser sérialiser -->
		<input type="hidden"  name="strCodeReduction" id="strCodeReduction" value=""  />  
		</form>	
		<form id="formCode" method="get" action="VerifCodeReduction.php" style="visibility:collapse;">
				<div style="display :none;" ><input type="hidden" name="NomCode" id="NomCode" style="display :none;"  readonly  /></p>
				<input type="hidden" name="PrenomCode" id="PrenomCode"  style="display :none;" readonly /></p>
				<input type="hidden" name="CourseCode" id="CourseCode" style="display :none;"  value= '<?php echo $NOM_COURSE. $ANNEE_COURSE ?>' />
				<input type="hidden" name="NbrEtapeCode" id="NbrEtapeCode"   />
				<input type="hidden" name="PrixInscription" id="PrixInscription"  style="display :none;"  /></div>
				<div class="classTitleWithButton">
					<div class="input">
						<label for="CodeID">Code de réduction:</label> 
						<input type="text" name="Code" id="CodeID" tabindex="500"/>	
					</div>
					<span class="Button" onclick="VerifCode()"  >
						<i class="fa fa-check"></i></br>
					</span>	
					
					
				</input>
				</div>
				<p id="InformationCode" style="display:none; padding:5px; border-style: solid; border-color: black; font-size:160%;"></p>	
		</form>	
		<table 	style="width:100%; display:none; margin-top: 20px;" id="ParaReglement">
			<tr style="background:#ddd;padding:20px;" >
				<td style="width: 40%;padding: 10px;padding-left: 20px;">
					J'accepte le règlement 
					<?echo '<a href="'.$pathReglement.'"target="_blank">ci-joint</a>'?>
				</td> 
				<td>
					<input type="checkbox" style="width:40px;height:40px"  id="Reglement" >
				</td>
			</tr>
		</table>
		<table 	style="width:100%;display:none; margin-top: 20px;" id="ParaPartenaire">
			<tr style="background:#ddd;padding:20px;" >
				<td style="width: 40%;padding: 10px;padding-left: 20px;">
					J'accepte de transmettre mes données à nos partenaires
				</td> 
				<td>
					<input type="checkbox" style="width:40px;height:40px" checked="True" Name="Partenaire" id="Partenaire" >
				</td>
			</tr>
		</table>
		<table style="background-color: #FFFFFF;width: 100%; display:none" id="TableReduction">
			<tr>
				<th>
					Code de réduction
				</th>
				<th>
					Valeurs CHF
				</th>
			<tr>
		</table>
		<table 	style="width:100%;display:none; margin-top: 20px;" id="ParaTotalReduction">
			<tr style="background:#ddd;padding:20px;" >
				<td style="width: 40%;padding: 10px;padding-left: 20px;">
					Total options et réductions:
				</td> 
				<td>
				 	<input type="text" name="TotalReduction" id="TotalReduction"  readonly  />
				</td>
				<td width="40px">
					CHF
				</td>
			</tr>
		</table>
		<table 	style="width:100%;display:none; margin-top: 20px;" id="ParaTotalPayer">
			<tr style="background:#ddd;padding:20px;" >
				<td style="width: 40%;padding: 10px;padding-left: 20px;">
					Total à payer:
				</td> 
				<td>
					<input type="text" name="TotalPayer" id="TotalPayer"  readonly  />
				</td>
				<td width="40px">
					CHF
				</td>
			</tr>
		</table>
 
		 <span  class="Button" type="button" 
		  style="display:none;font-size:36px" 
		  id="ButtonSendFormulaire" 
		  onclick="check( )">je m'inscris 
		</span>
	</div>
</div>
</br>
</br>

<?php
// ****************************************************************************************
//                      LEcture de chaque membre du compte
//******************************************************************************************
	$sql = 'SELECT * FROM Membres  WHERE LoginCompte=\''.$_SESSION['Login'].'\''; 
	//echo $sql;
	$result = mysqli_query($con,$sql);
    $Aff = 0;
 	if ($result && mysqli_num_rows($result) > 0) 
	{
    // output data of each row ?>
		<?php
		if (mysqli_num_rows($result) > 0)
		{?>
			<script>
				var sel = document.getElementById("Coureur");			
				sel.options.add( new Option("Sélectionner un coureur", ""));			
				ICounterCoureurs++;			
			</script>
		<?php
		}
		// Mais dans le tableau seulement les coureurs valider 
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
					document.getElementById("date").value = Coureur.DateNaissance ;
					document.getElementById("tdemail").innerHTML = Coureur.Mail ;
					document.getElementById("tdadresse").innerHTML = Coureur.Adresse ;
					document.getElementById("tdzip").innerHTML = Coureur.NPA + " " +  Coureur.Localite  ;
					document.getElementById("tdpays").innerHTML =  Coureur.Pays ;
					document.getElementById("tddate").innerHTML = Coureur.DateNaissance ;
					if (Coureur.Sexe == "H")
					{
						document.getElementById("sexe").value = "Homme" ;
						document.getElementById("tdsexe").innerHTML = 'Homme 	<i class="fa fa-male" style= "font-size: 30px;margin:2px;"></i> ';

						document.getElementById("td_nom").style.background = "lightblue";
						document.getElementById("td_prenom").style.background = "lightblue";
						document.getElementById("td_email").style.background = "lightblue";
						document.getElementById("td_adresse").style.background ="lightblue";
						document.getElementById("td_zip").style.background = "lightblue";
						document.getElementById("td_club").style.background = "lightblue";
						document.getElementById("td_pays").style.background = "lightblue";
						document.getElementById("td_date").style.background = "lightblue";
						document.getElementById("td_sexe").style.background = "lightblue";
					}
					else
					{
						
						document.getElementById("sexe").value = "Dame" ;	
						document.getElementById("tdsexe").innerHTML = 'Dame 	<i class="fa fa-female" style= "font-size: 30px;margin:2px;"></i>';

						
						document.getElementById("td_nom").style.background = "lightpink";
						document.getElementById("td_prenom").style.background = "lightpink";
						document.getElementById("td_email").style.background = "lightpink";
						document.getElementById("td_adresse").style.background = "lightpink";
						document.getElementById("td_zip").style.background ="lightpink";
						document.getElementById("td_club").style.background = "lightpink";
						document.getElementById("td_pays").style.background = "lightpink";
						document.getElementById("td_date").style.background = "lightpink";
						document.getElementById("td_sexe").style.background = "lightpink";
					}
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
		{?>
			<script>
			ShowPopuAddMember();
			</script><?
			echo "Aucun Coureur dans ce compte";
		}
	
	?>								
</div>
 <center>
 les champs avec un * sont obligatoires</br>
 Si vous avez un problème d'inscription veuillez contacter par e-mail </br>
 info@defichrono.ch
 </center>
   </Fieldset>
<? 		
}
else
{
    $Link= "AddLoginV2.php?Nbretape=".$_GET['NbrEtape']."&DateCourse=".$_GET['DateCourse']."&NomCourse=" .$_GET['NomCourse'];
    // demande de connection pour inscription
?>
<script>
function SubmitLogin()
 {
	var f2 = document.getElementById("FormLogin");
	console.log(f2);
	if (f2.login.value.length<3) {
		alert("Merci d'indiquer votre adresse e-mail");
		f2.login.focus();
		return false;
	}
	if (f2.pass.value.length<3) {
		alert("Merci d'indiquer votre mot de passe");
		f2.pass.focus();
		return false;
	}
	f2.submit();
}
</script>
<center>
	<img src="images/FilRougeInscription1.png" style="width: 80%;" >
</center>
	
	<form method="post" id="FormLogin" action="admin/CibleLoginV2.php">
	<!--<p><img src="images/ConnectMini.png"  ></p>-->
	<input type="hidden" name="DateCourse" id="DateCourse"   value= '<?php echo $_GET['DateCourse'] ?>' />
	<input type="hidden" name="NomCourse" id="NomCourse"  value= '<?php echo $_GET["NomCourse"] ?>' />
	<input type="hidden" name="Nbretape" id="Nbretape" value= '<?php echo  $_GET["NbrEtape"] ?>' />

		<table style="width:80%;margin:auto;">
			<tr>
				<td>
					<div class="input">
						<label for="Login" style="font-size:10px;">e-mail :</label> 
						<input type="text" name="login" id="login" tabindex="10" /> 
					</div>
				</td>
				<td  rowspan="2"style="width:20%;">
					<span class="Button" style="float: right;margin:10px;"  onClick="SubmitLogin()">
						<i class="fa fa-sign-in" style= "font-size: 35px;margin: 10px;"></i>
					</span>
				</td>
			</tr>	
			<tr>
				<td>
					<div class="input">
						<label for="password" style="font-size:10px;">Mot de passe :</label>
						<input type="password" name="pass" id="pass" tabindex="15" />
					</div>
				</td>
				<td>
				</td>
			</tr>
		</table>
	</form>

	<div style="display:flex; margin:40px; flex-direction:column;">
		<span class="Button">
			 <a href="<?php echo $Link ?> ">Créer un compte   </a>
		</span >
		<span class="Button">
			<a href="PasswordForget2023.php">réinitialiser mon mot de passe </a>
		</span >
	</div>
	<?php

    if ($_GET['Login'] =="false")
	{
		session_destroy();
		?> <p style="background: red;font-weight: bold;"> Mauvais mot de passe </p>
			 <p>* Si  votre mot de passe ne fonctionne pas, veuillez le réinitialiser </p><?
		
	}?>
	<!-- <p><h2>	<a href="AddLogin.php"style="font-size:12px;">Mot de passe oublier? </a></h2></p>-->
	
	<!-- Création Compte et garde en mémoire course -->

	
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

// Vérification code de réduction 
function VerifCode()
{
    // Verifie que ce coupon n'est pas utiliser dans ce formulair
	var val = 0;
	var inCode = document.getElementById("CodeID");
	var inInfoCode = document.getElementById("InformationCode");
	inInfoCode.style.display  = "block" ;
	// Check si réduction déjà utilisé dans le formulaire
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
				console.log('Nombre Etape Choisie' +NombreEtapeTotalChoisie);
				console.log('Nombre Etape A payer' +NombreEtapeAPayer);
				var PrixEtapeAPayer = 0;
				var PrixAllEtape = 0;
				console.log(ZoneTarifsActif);
				// Recherche dans tableau tarif 
				for (j = 0; j < ZoneTarifsActif.ListTarif.length; j++) 
				{
					console.log(ZoneTarifsActif.ListTarif[j].NomOption._Value);
					if (ZoneTarifsActif.ListTarif[j].NomOption._Value.indexOf( NombreEtapeAPayer) > -1)
					{
						// Prix Total Payer des Etpae a payé
						PrixEtapeAPayer =	 	ZoneTarifsActif.ListTarif[j].tarif._Value ;
						console.log('Etape A payer' + PrixEtapeAPayer);
					}
					if (ZoneTarifsActif.ListTarif[j].NomOption._Value.indexOf( NombreEtapeTotalChoisie) > -1)
					{
						// Prix Total des Etapes sans réduction
						PrixAllEtape =	ZoneTarifsActif.ListTarif[j].tarif._Value ;
						console.log('Etape totalr' + PrixAllEtape);
						val = PrixAllEtape - PrixEtapeAPayer;			
						break;
					}
				}
			}
			else if ( val > 8000)
			{
				var PrixDepart = document.getElementById("PrixDepart");
				val = (parseFloat(PrixDepart.value) / 100 ) * (val -8000);
			}

			// Ajout réduction 
			if (val > 0)
			{
				if (val > 9990)
				{
					AddReduction(inCode.value, val, "ReductionCodeEtape" );
				}
				else if ( val > 8000)
				{
					AddReduction(inCode.value, val, "ReductionCodePourCent" );
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
function  CalculPrixTotal()
{
	var ParaTotalPayer = document.getElementById("ParaTotalPayer");
	ParaTotalPayer.style.display ="table"
	var ParaTotalReduc = document.getElementById("ParaTotalReduction");
	ParaTotalReduc.style.display ="table"
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
	document.getElementById("lblInfoTShirt").style.display = "none" ;
	document.getElementById("lblTShirt").style.visibility = "hidden" ;

	document.getElementById("lblTShirt2").style.display = "none" ;
	document.getElementById("lblTShirt2").style.visibility = "hidden" ;
	document.getElementById("lblTShirt3").style.display = "none" ;
	document.getElementById("lblTShirt3").style.visibility = "hidden" ;
	document.getElementById("lblTShirt4").style.display = "none" ;
	document.getElementById("lblTShirt4").style.visibility = "hidden" ;

		
	document.getElementById("HaveAChoiceTarif").style.display = "block" ;
	document.getElementById("formCode").style.visibility = "visible" ;
	document.getElementById("NomCode").value = document.getElementById("nom").value ;
	document.getElementById("PrenomCode").value = document.getElementById("prenom").value ;
	console.log(tabOption);
	if ( tabOption[0].indexOf("étape")>1)
	{
		document.getElementById("NbrEtapeCode").value = tabOption[0].substring(0,1); ;
		NombreEtapeTotalChoisie = tabOption[0].substring(0,1); 
	}
	else
	{
		document.getElementById("NbrEtapeCode").value = "1" ;
	}
	
	document.getElementById("PrixInscription").value = tabOption[1] ;
	console.log("log" + tabOption[3]);
	if ( parseInt(tabOption[3])> 0)
	{
		document.getElementById("lblInfoTShirt").style.display = "block" ;
		document.getElementById("lblTShirt").style.display = "block" ;
		document.getElementById("lblTShirt").style.visibility = "visible" ;
	}
	if ( parseInt(tabOption[3])> 1)
	{
		document.getElementById("lblTShirt2").style.display = "block" ;
		document.getElementById("lblTShirt2").style.visibility = "visible" ;
	}
	if ( parseInt(tabOption[3])> 2)
	{
		document.getElementById("lblTShirt3").style.display = "block" ;
		document.getElementById("lblTShirt3").style.visibility = "visible" ;
	}
	if ( parseInt(tabOption[3])> 3)
	{
		document.getElementById("lblTShirt4").style.display = "block" ;
		document.getElementById("lblTShirt4").style.visibility = "visible" ;
	}
	if ( parseInt(tabOption[3])> 4)
	{
		document.getElementById("lblTShirt5").style.display = "block" ;
		document.getElementById("lblTShirt5").style.visibility = "visible" ;
	}
	if ( parseInt(tabOption[3])> 5)
	{
		document.getElementById("lblTShirt6").style.display = "block" ;
		document.getElementById("lblTShirt6").style.visibility = "visible" ;
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
		f1.nom.style.backgroundColor = "red";
		f1.nom.focus();
		return false;
	}
	if (f1.prenom.value.length<3) {
		f1.prenom.style.backgroundColor = "red";
		f1.prenom.focus();
		return false;
	}
	if (!isMail(f1.email.value)) {
		f1.email.style.backgroundColor = "red";
		f1.email.focus();
		return false;
	}
	if (f1.zip.value.length<4) 
	{
		f1.zip.style.backgroundColor = "red";
		f1.zip.focus();
		return false;
	}

	if (f1.ville.value.length<3) {		
		f1.ville.style.backgroundColor = "red";
		f1.ville.focus();
		return false;
	}

	if (f1.NomDepart.value.length<1) {
		f1.nom_depart.style.backgroundColor = "red";
		f1.nom_depart.focus();
		return false;
	}

	if (f1.NomParcours.value.length<1) {
		f1.NomParcours.style.backgroundColor = "red";
		f1.NomParcours.focus();
		return false;
	}
	f1.NomParcours.style.backgroundColor = "white";
	if (f1.date.value.length!=4) {
		f1.date.style.backgroundColor = "red";
		f1.date.focus();
		return false;
	}
	f1.date.style.backgroundColor = "white";
	if (f1.sexe.value.length<1) {
		f1.sexe.style.backgroundColor = "red";
		f1.sexe.focus();
		return false;
	}
	f1.sexe.style.backgroundColor = "white";
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
	if (DepartObj.info.ListCategorie.ListItem[tabOption[1]].xEquipe == "True")
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
	document.getElementById("Coureur").style.backgroundColor ="#FFFFFF";

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
	document.getElementById("date").value = Coureur.DateNaissance ;
	document.getElementById("tdemail").innerHTML = Coureur.Mail ;
	document.getElementById("tdadresse").innerHTML = Coureur.Adresse ;
	document.getElementById("tdzip").innerHTML = Coureur.NPA  + " "+ Coureur.Localite;
	document.getElementById("tdpays").innerHTML =  Coureur.Pays ;
	document.getElementById("tddate").innerHTML = Coureur.DateNaissance ;

	if (Coureur.Sexe == "H")
	{
		document.getElementById("sexe").value = "Homme" ;
		document.getElementById("tdsexe").innerHTML = 'Homme 	<i class="fa fa-male" style= "font-size: 30px;margin:2px;"></i> ';
		document.getElementById("tdsexe").style.background = "lightblue";
	}
	else
	{
		document.getElementById("sexe").value = "Dame" ;	
		document.getElementById("tdsexe").innerHTML = 'Dame 	<i class="fa fa-female" style= "font-size: 30px;margin:2px;"></i>';			
		document.getElementById("tdsexe").style.background = "lightpink";
	}

	if (ArrayParcours.length ==1 || f.NomParcours.value.length>0)
	{
		liste_depart(f) 
	}
	
				
}
function ChoiceDepart(f)
{
	console.log("function ChoiceDepart");
	if (f.NomParcours.value.length>0) 
	{
		if (f.date.value.length==4)
		{
			if (f.sexe.value.length>0)
			{
				// Si il existe un seul parcour // d'office sélectionné
				if (ArrayParcours.length > 1)
				{
					var intselected = document.getElementById("NomParcours").selectedIndex-1;
				}
				else
				{
					var intselected = document.getElementById("NomParcours").selectedIndex;
				}
				
				document.getElementById("HaveAChoiceCategorie").style.display="table";
				document.getElementById("NomDepart").style.backgroundColor="#FFFFFF";
				
				var e = document.getElementById("nbrEtapeInsc");
				e.options.length = 0;
				console.log(intselected);
				var ParcoursObj = ArrayParcours[intselected];
				console.log(ParcoursObj);
				// Si parcours sélectionné
				if (typeof ParcoursObj != "undefined")
				{
					// Selon Choix possible dans liste de départ 
					var Cat =	document.getElementById("NomDepart");
					// SI aucune option égale pas de départ possible 
					console.log(Cat.value);
				
					var tabOption = Cat.value.split(';');
					console.log(tabOption[0]);
					var DepartObj = ParcoursObj.ArrayDepart[tabOption[0]];
					
					var intselectedDepart = document.getElementById("NomDepart").selectedIndex-1
					document.getElementById("lblNomEquipe");
					document.getElementById("NomCat").value = tabOption[3] ;
					document.getElementById("NumCat").value = tabOption[4] ;	
					
					//********* initialisatino des champs **********************/
					document.getElementById("lblNomEquipe").style.display = "none" ;
					document.getElementById("Paradisc1").style.display = "none" ;
					document.getElementById("Paradisc2").style.display = "none" ;
					document.getElementById("Paradisc3").style.display = "none";
					document.getElementById("Paradisc4").style.display = "none" ;
					document.getElementById("Paradisc5").style.display = "none" ;
					document.getElementById("Paradisc6").style.display = "none" ;
					document.getElementById("ParaRemarques").style.display = "none" ;

					document.getElementById("TableEquipe").style.visibility = "hidden" ;
					document.getElementById("TableEquipe").style.display  = "none" ;
						
					document.getElementById("RowEntreprise").style.visibility = "hidden" ;
					document.getElementById("RowEntreprise").style.display  = "none" ;

					document.getElementById("RowDuo").style.visibility = "hidden" ;
					document.getElementById("RowDuo").style.display  = "none" ;
			
					document.getElementById("RowEquipe").style.visibility = "hidden" ;
					document.getElementById("RowEquipe").style.display  = "none" ;							

					xEquipe = false;
				
					var CatOBj = DepartObj.info.ListCategorie.ListItem[tabOption[1]];
		
					// Si on peut s'inscrire par équipe dans la catégorie
					if ((CatOBj.Equipe != null && CatOBj.Equipe.Value == true) || (CatOBj.Relais != null && CatOBj.Relais.Value == true))
					{
					
						document.getElementById("lblNomEquipe").style.visibility = "visible" ;
						document.getElementById("lblNomEquipe").style.display  = "table" ;
						// Pour course DUO
						if (f.NomParcours.value == "TEAM")
						{
							document.getElementById("ParaRemarques").style.visibility = "visible" ;
							document.getElementById("ParaRemarques").style.display  = "table" ;
						}

				
					// Si la catégorie est en relais
						document.getElementById("lblNomEquipe").style.visibility = "visible" ;
						document.getElementById("lblNomEquipe").style.display  = "table" ;
						xEquipe = true; // Utile pour nombre de t-shirt spécial Jura défi

                        // Tableau qui regroupe toute les  discipline des étapes
                        var ArrayDiscipline = [];
                        for (var j = 0; j < DepartObj.ArrayEtape.length; j++)
		                {
							
                            var EtapeObj = DepartObj.ArrayEtape[j];
							console.log(EtapeObj);
                            if (EtapeObj.info.ListDiscipline != null)
                            {
							
                                for (var h = 0; h < EtapeObj.info.ListDiscipline.ListItem.length; h++)
                                {
									
                                    ArrayDiscipline.push(EtapeObj.info.ListDiscipline.ListItem[h]);
                                }
                            }
                        }
                        // affichage des champs au fromulaire pour inscrire chaque coureur
						for(var iDiscipline=0; iDiscipline < ArrayDiscipline.length ; ++iDiscipline) 
						{
							Disc = new Object();
							Disc =	ArrayDiscipline[iDiscipline];

							switch(iDiscipline) 
                            {
                                case 0:
                                if (ArrayDiscipline.length > 1)
                                {
                                    document.getElementById("Paradisc1").style.visibility = "visible" ;
                                    document.getElementById("Paradisc1").style.display  = "block" ;
                                    text = Disc.Nom._Value;
                                    if (Disc.Distance != null && Disc.Distance._Value.length > 0)
                                    {
                                    text	+" / "+ Disc.Distance._Value ;
                                    }
                                    if (Disc.Deniv != null && Disc.Deniv._Value.length > 0)
                                    {
                                    text	+" / "+ Disc.Deniv._Value ;
                                    }
                                    document.getElementById("disc1").innerHTML = text;
                                }
							    break;
                                case 1:
                                    document.getElementById("Paradisc2").style.visibility = "visible" ;
                                    document.getElementById("Paradisc2").style.display  = "block" ;
                                     text = Disc.Nom._Value;
                                    if (Disc.Distance != null &&  Disc.Distance._Value.length > 0)
                                    {
                                    text	+" / "+ Disc.Distance._Value ;
                                    }
                                    if (Disc.Deniv != null && Disc.Deniv._Value.length > 0)
                                    {
                                    text	+" / "+ Disc.Deniv._Value ;
                                    }
                                    document.getElementById("disc2").innerHTML = text;
                                break;
                                case 2:
                                
                                    document.getElementById("Paradisc3").style.visibility = "visible" ;
                                    document.getElementById("Paradisc3").style.display  = "block" ;
                                    text = Disc.Nom._Value;
                                    if (Disc.Distance != null &&  Disc.Distance._Value.length > 0)
                                    {
                                    text	+" / "+ Disc.Distance._Value ;
                                    }
                                    if (Disc.Deniv != null && Disc.Deniv._Value.length > 0)
                                    {
                                    text	+" / "+ Disc.Deniv._Value ;
                                    }
                                    document.getElementById("disc3").innerHTML = text;
                                    break;
                                case 3:
                                
                                    document.getElementById("Paradisc4").style.visibility = "visible" ;
                                    document.getElementById("Paradisc4").style.display  = "block" ;
                                    text = Disc.Nom._Value;
                                    if (Disc.Distance != null &&  Disc.Distance._Value.length > 0)
                                    {
                                    text	+" / "+ Disc.Distance._Value ;
                                    }
                                    if (Disc.Deniv != null && Disc.Deniv._Value.length > 0)
                                    {
                                    text	+" / "+ Disc.Deniv._Value ;
                                    }
                                    document.getElementById("disc4").innerHTML = text;
                                    break;
                                case 4:
                                    document.getElementById("Paradisc5").style.visibility = "visible" ;
                                    document.getElementById("Paradisc5").style.display  = "block" ;
                                    text = Disc.Nom._Value;
                                    if (Disc.Distance != null &&  Disc.Distance._Value.length > 0)
                                    {
                                    text	+" / "+ Disc.Distance._Value ;
                                    }
                                    if (Disc.Deniv != null && Disc.Deniv._Value.length > 0)
                                    {
                                    text	+" / "+ Disc._Value.Deniv ;
                                    }
                                    document.getElementById("disc5").innerHTML = text;
                                break;
                                case 5:
                                    document.getElementById("Paradisc6").style.visibility = "visible" ;
                                    document.getElementById("Paradisc6").style.display  = "block" ;
                                    text = Disc.Nom._Value;
                                    if (Disc.Distance != null &&  Disc.Distance._Value.length > 0)
                                    {
                                    text	+" / "+ Disc.Distance._Value ;
                                    }
                                    if (Disc.Deniv != null && Disc.Deniv._Value.length > 0)
                                    {
                                    text	+" / "+ Disc.Deniv._Value ;
                                    }
                                    document.getElementById("disc6").innerHTML = text;
                                break;
							}
							
						}		
					}
                    // Si Duo ou équipe // BCJ Challenge
					if (DepartObj.info.NombrePersonneMaxDuo._Value > 1 || DepartObj.info.NombrePersonneMaxEquipe._Value > 1)
					{
						document.getElementById("TableEquipe").style.visibility = "visible" ;
						document.getElementById("TableEquipe").style.display  = "block" ;					
						if (DepartObj.info.NombrePersonneMaxDuo._Value > 1)
						{
							document.getElementById("RowDuo").style.visibility = "visible" ;
							document.getElementById("RowDuo").style.display  = "block" ;
							document.getElementById("RowEntreprise").style.visibility = "visible" ;
							document.getElementById("RowEntreprise").style.display  = "block" ;
						}
						if (DepartObj.info.NombrePersonneMaxEquipe._Value > 1)
						{
							document.getElementById("RowEquipe").style.visibility = "visible" ;
							document.getElementById("RowEquipe").style.display  = "block" ;							
						}
					}
						
					var i;	
					var j;	

					for (i = 0; i < ParcoursObj.info.ListTariffZone.ListItem.length; i++) 
					{
                        ZoneTarifsActif =  ParcoursObj.info.ListTariffZone.ListItem[i];

						// Si la zone de tarifs est actif 
						var NombrePersonneMax = parseInt(ZoneTarifsActif.MaximumInscription._Value);
						if (isNaN(NombrePersonneMax) )
						{
							NombrePersonneMax = 0;
						}
						console.log("Personne max" +NombrePersonneMax + "  / " + ParcoursObj.NombreCoureurInscrit);

						if ( ZoneTarifsActif.dateEndZone._Value > DateToday && ( NombrePersonneMax== 0 ||  NombrePersonneMax > ParcoursObj.NombreCoureurInscrit ) )
						{
							console.log("Tarifs ");
							for (j = 0; j < ZoneTarifsActif.ListTarif.length; j++) 
							{
								 tarifsActif = ZoneTarifsActif.ListTarif[j];
								// Information pour jura défi 2021 pour ne pas avoir toute les zone de tarif
								if ( tarifsActif.NomOption._Value.includes("Equipes")  )
								{
									if (xEquipe)
									{
										e.options.add( new Option( tarifsActif.NomOption._Value + " - " + tarifsActif.tarif._Value + "CHF",tarifsActif.NomOption._Value + ";"+ tarifsActif.tarif._Value + ";"+ tarifsActif.OnLine.Value + ";" + tarifsActif.T_shirt._Value));
										console.log(tarifsActif)	;
									}
								 }
								 else if (tarifsActif.NomOption._Value.includes("Individuel"))
								 {
									if (!xEquipe)
									{
										e.options.add( new Option( tarifsActif.NomOption._Value + " - " + tarifsActif.tarif._Value + "CHF",tarifsActif.NomOption._Value + ";"+ tarifsActif.tarif._Value + ";"+ tarifsActif.OnLine.Value + ";" + tarifsActif.T_shirt._Value));
										console.log(tarifsActif)	;
									}
								 }
						/*		 else if (JuraDefi == 1)
								 {
									if (!xEquipe)
									{
										e.options.add( new Option( tarifsActif.NomOption._Value + " - " + tarifsActif.tarif._Value + "CHF",tarifsActif.NomOption._Value + ";"+ tarifsActif.tarif._Value + ";"+ tarifsActif.OnLine.Value + ";" + tarifsActif.T_shirt.Value));
										console.log(tarifsActif)	;
									}
								 }*/
								else
								{
									e.options.add( new Option( tarifsActif.NomOption._Value + " - " + tarifsActif.tarif._Value + "CHF",tarifsActif.NomOption._Value + ";"+ tarifsActif.tarif._Value + ";"+ tarifsActif.OnLine.Value + ";" + tarifsActif.T_shirt._Value));
									console.log(tarifsActif)	;
								}					
							}
							break; // Arret de l'ajout des zone après la première zone trouver // attention mettre le fichier dans l'ordre 
						}
					}

					document.getElementById("lblNbrEtape").style.display  = "block" ;
					if (j > 1)
					{
						var z = new Option("Sélectionner", "" );
						e.options.add( z,0);	
						e.selectedIndex = 0;
					}
					else
					{
						choiceOption(f);
					}
					
					document.getElementById("OptionReduction").replaceChildren();
					// Pour chaque reduction créer un élement dans la paragraphe de réduction
					for (i = 0; i <  ParcoursObj.info.ListOptionReduction.ListItem.length; i++) 
					{
						
                        var objReduction = ParcoursObj.info.ListOptionReduction.ListItem[i];
						console.log("Reduction dossard2" + objReduction.DateStartReduction._Value  + " ---"+DateToday );
						if ( objReduction.DateStartReduction._Value  < DateToday  )
						{
							
						    var pReduc = document.createElement("p");
							const list = pReduc.classList;
							list.add("classTitleWithCheckbox");

                            var text = document.createElement("label");
                            var unit = document.createElement("label");

						// Option donation
						   if ( objReduction.tarif._Value == "8888")
							{
                                	
                                var tableReduc = document.createElement("table");
                                var trReduc = document.createElement("tr");
                                tableReduc.appendChild(trReduc);

                                var tdReduc = document.createElement("td");
                                tdReduc.style.width = "50%";
                            
                                text.textContent = objReduction.Nom._Value  ;
                                tdReduc.appendChild(text);
                                trReduc.appendChild(tdReduc);

                                var tdReduc = document.createElement("td");
                                trReduc.appendChild(tdReduc);
								var InCheckbox = document.createElement("input");
                             
						  		 InCheckbox.onchange = function(){CheckDonation(this)};
								InCheckbox.setAttribute("type", "number");
                                InCheckbox.setAttribute("min", "0");
                                InCheckbox.id = "DonationIDinput";
								InCheckbox.style.width="40px";
								InCheckbox.style.height="40px";
                                tdReduc.appendChild(InCheckbox);

                                var tdReduc = document.createElement("td");
                                trReduc.appendChild(tdReduc);
                                unit.textContent ="CHF";
                                tdReduc.appendChild(unit);

                                pReduc.appendChild(tableReduc);
							}
							else
							{
								var InCheckbox = document.createElement("input");
						  		 InCheckbox.onclick = function(){CheckReduc(this)};
								InCheckbox.style.width="40px";
								InCheckbox.style.height="40px";
								InCheckbox.setAttribute("type", "checkbox");
								InCheckbox.setAttribute("value", objReduction.Nom._Value+";"+ objReduction.tarif._Value);
							                         
                                if ( objReduction.tarif._Value != "0")
                                {
                                    text.textContent = objReduction.Nom._Value + " " +objReduction.tarif._Value + "CHF" ;
                                }
                                else
                                {
                                    text.textContent = objReduction.Nom._Value  ;
                                }
                               
						    	pReduc.appendChild(text);
								 pReduc.appendChild(InCheckbox);	
							}

							document.getElementById("OptionReduction").appendChild(pReduc);
						}
					}
				}
				
			}
		}
	}
}
function CheckDonation(checkbox ) 
{
    ArrayListReductionActif = [];
    TotalReduction =  0;
	var input = document.getElementById("DonationIDinput");
	if (input.value > 0)
	{	
		
		AddReduction("Donation", input.value *-1,"Donation");
		
	}
	else
	{
		TotalReduction = TotalReduction + parseFloat( input.value);
		/** Supression de option dans le tableau ***/
		for(var iOptionReduc=0; iOptionReduc< ArrayListReductionActif.length; ++iOptionReduc) 
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
		for(var iOptionReduc=0; iOptionReduc< ArrayListReductionActif.length; ++iOptionReduc) 
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
	console.log("function liste départ")
/* Rendre invisible les différents champs lors de l'initialisation */
	document.getElementById("lblNomEquipe").style.display  = "none" ;
	document.getElementById("lblDepart").style.display  = "none" ;
	document.getElementById("Paradisc1").style.display  = "none" ;
	document.getElementById("Paradisc2").style.display  = "none" ;
	document.getElementById("Paradisc3").style.display  = "none" ;
	document.getElementById("Paradisc4").style.display  = "none" ;
	document.getElementById("lblNomEquipe").style.display  = "none" ;

	document.getElementById("Paradisc1").style.display  = "none" ;
	document.getElementById("Paradisc2").style.display  = "none" ;
	document.getElementById("Paradisc3").style.display  = "none" ;
	document.getElementById("Paradisc4").style.display  = "none" ;
	
	var lblinfo = document.getElementById("DivInformation"); 
	lblinfo.style.display = "none";
	var sel = document.getElementById("NomDepart");
	var lbl = document.getElementById("lblDepart");
	var bpSend = document.getElementById("ButtonSendFormulaire");
	var bpReglement = document.getElementById("ParaReglement");
	var bpPartenaire = document.getElementById("ParaPartenaire");
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
					
					// Tri des catégorie possible pour ce parcours
					for(var iDepart=0; iDepart<nbrDepart; ++iDepart) 
					{
						var DepartObj = ArrayParcours[intselected].ArrayDepart[iDepart];
						for(var iCategorie=0; iCategorie<DepartObj.info.ListCategorie.ListItem.length; ++iCategorie) 
						{	
							var Cat = new Object();
							Cat = DepartObj.info.ListCategorie.ListItem[iCategorie];
							var sexe = "D";		
							if (f.sexe.value == "Homme" )
							{
								 sexe = "H";
							}	
							// Si Catégorie possible pour la personne choisie
							if ((sexe== Cat.SexeCategorie._Value || Cat.SexeCategorie._Value == "M") &&  (  parseInt(f.date.value) >= Cat.debutAnnee._Value ) && (parseInt(f.date.value)<=  Cat.finAnnee._Value ))
							{
						
								sel.options.add( new Option(Cat.NomCategorie._Value+" "+Cat.debutAnnee._Value+" - "+Cat.finAnnee._Value+ " " + DepartObj.info.Distance._Value,iDepart +";"+iCategorie + ";"+ DepartObj.Nom + ";"+ Cat.NomCategorie._Value+ ";" + Cat.NumCategorie._Value));
						
								ICounterCat++;
							}
						}
					}
				}

				var lblinfo = document.getElementById("DivInformation"); 
				var txtinfo = document.getElementById("txtInformation"); 

				if (ICounterCat == 0)
				{
					// Valeurs incorect pour ce dÃ©part 
					bpReglement.style.display = "none" ;
					bpPartenaire.style.display = "none" ;
					bpSend.style.display = "none" ;
					sel.style.display = "none" ;
					document.getElementById('date').style.backgroundColor="#fa8a8a";
					document.getElementById('NomParcours').style.backgroundColor="#fa8a8a";
					lblinfo.style.display = "block" ;
					var txtinfo = document.getElementById("txtInformation");
					txtinfo.value = "Aucune catégorie d'âge pour ce départ"; 
				}
				else 
				{
					bpReglement.style.display = "table" ;
					bpPartenaire.style.display = "table" ;
					bpSend.style.display = "block" ;
					lblinfo.style.display = "none" ;
					lbl.style.display = "block" ;
					document.getElementById('date').style.backgroundColor="white";
					document.getElementById('NomParcours').style.backgroundColor="white";
				}

				// Plusieurs départ disponible ajouter un champs pour sélectionner le départ 
				if (ICounterCat >1)
				{
					var z = new Option("Sélectionner", "" );
					sel.insertBefore(z, sel.firstChild);
					sel.options[0].setAttribute("selected", "selected");
					sel.ReadOnly = false;
				}
				else if (ICounterCat ==1)
				{
					sel.style.backgroundColor = "Gray";
					sel.ReadOnly = true;
					ChoiceDepart(f);
				}
			}
			else
			{
				sel.style.style.display  = "none" ;
			}
		}
		else
		{
			sel.style.style.display  = "none" ;
			if (f.date.value.length>1)
			{
				lblinfo.style.display = "block" ;
				var txtinfo = document.getElementById("txtInformation");
				txtinfo.value = "Merci d'indiquer votre année de naissance ex: 1988"; 

				f.date.focus();
			}
		}
	}
	else
	{
		lbl.style.display  = "None" ;
	}
}
</script>
<!---*************************************************
                Liste des parcours de la course
*********************************************************!---->
<?php
// Afficher la liste des Parcours  Dossier dans la course ;
$pathfolder = 'courses/'.$_GET['NomCourse'].$ANNEE_COURSE;
// CrÃ©ation de la liste de toutes les Dossier = Parcours 
$files1 = scandir($pathfolder);
// Liste des ficbiers 
foreach ($files1  as $key => $Parcours) 
{ 

    if(is_dir($pathfolder .'/'.$Parcours))
    {
        // Affichage dans la liste des dÃ©part dans le menu 
        if (strlen($Parcours) >2 && $Parcours != "info") 
        {	
            $pathfolderParcours = $pathfolder .'/'.$Parcours;
        ?>	
        <script>
        /*********************** CREATION OBJET PARCOURS ******************************/
            var Parcours= new Object();
            Parcours.nom=<?php echo json_encode($Parcours); ?>;
            Parcours.NombreCoureurInscrit = 0;
            Parcours.info =  readJSON(<?php echo json_encode($pathfolderParcours); ?>+"/info.json");
            var ArrayDepart = [];
        </script>
        <?php
            //<!--- Liste des DÃ©part !---->
            // Afficher la liste des Parcours  Dossier dans la course ;
            $pathfolderParcours = 'courses/'.$_GET['NomCourse'].$ANNEE_COURSE. '/'.$Parcours;
            // CrÃ©ation de la liste de toutes les Dossier = Depart 
            $filesDepart = scandir($pathfolderParcours);

            foreach ($filesDepart  as $key => $depart) 
            { 
				$pathfolderDepart =   $pathfolderParcours.'/'.$depart;
                if(is_dir($pathfolderDepart ))
                {
                    if (strlen($depart) >2)
                    {
                      
                    ?>
                        <script>
                        	var ArrayEtape = [];
                            var Depart= new Object();
                            Depart.Nom = <?php echo json_encode($depart); ?>;
                        </script>
                        <?php
                        // Lecture du fichier info.txt du depart 	
                        $pathFileInfo = $pathfolderDepart.'/info.json';
                        if (file_exists($pathFileInfo))
                        {
                            ?>
                            <script>

                        	Depart.info =  readJSON(<?php echo json_encode($pathFileInfo); ?>);
                          	 console.log( <?php echo json_encode($pathFileInfo);?>);
                           </script>
                            <?
                        }
                    	/***************** Etape ********************/
						$CmptEtape = 1;
						$filesEtape = scandir($pathfolderDepart);
						foreach ($filesEtape  as $key => $Etape) 
						{
							$pathFolderEtape = $pathfolderDepart .'/'. $Etape ;
					
							if (strlen($Etape) >2 && is_dir($pathFolderEtape)&& $Etape  != "info" )
							{
								// Lecture du fichier info.txt de l'étape 	
								$pathFileInfoEtape = $pathFolderEtape.'/info.json';
								if (file_exists($pathFileInfoEtape))
								{
									?> <script>
								
								</script>
								<?
									$pathfileImageEtape = $pathFolderEtape.'/images/Etape.jpg';
									if (file_exists ( $pathfileImageEtape ) == false)
									{
										$pathfileImageEtape = "";
									}
									$pathfileGpxEtape = $pathFolderEtape.'/images/Etape.xml';
									if (file_exists ( $pathfileGpxEtape ) == false)
									{
										$pathfileGpxEtape = "";
									}
									$CmptEtape ++;
									?> <script>
									var Etape = new Object();
									Etape.info = readJSON(<?php echo json_encode($pathFileInfoEtape); ?>);
									</script>
									<?							
								}
								?>
								<script>
								ArrayEtape.push(Etape);
								</script><?php
							}
						}	
                        ?>
                <script>
                	Depart.ArrayEtape = ArrayEtape;
                    ArrayDepart.push(Depart);
                    console.log(Depart); 
                </script><?php
                    }
                }	
            }
			//********************************************************************************
			// 		 NOMBRE DE COUREUR INSCRIT DANS LE DEPART Pour zone de tarif 
			// 							Limite de coureur
			// ********************************************************************************
			// Nombre de coureur dans la base de donnée
			$sql = 'SELECT * FROM inscription  WHERE course=\''.$NOM_COURSE. $ANNEE_COURSE. '\'AND parcours = \''.$Parcours. '\'ORDER  BY NomDepart ASC,nom ASC';
			$result = mysqli_query($con,$sql);
			$NumberCoureur =mysqli_num_rows($result);?>
			<script>
				Parcours.NombreCoureurInscrit = <?php echo json_encode($NumberCoureur ); ?>;
				console.log("Nombre coureur parcours; " + Parcours.NombreCoureurInscrit);
				console.log(Parcours);
                Parcours.ArrayDepart =ArrayDepart;
                ArrayParcours.push(Parcours);
            </script><?php
        }
    }
}
?>
<script>

//******************************************************** */
// Start UP Application
//******************************************************** */
for(var Parcours=0; Parcours<ArrayParcours.length; ++Parcours) 
{
    if (typeof ArrayParcours[Parcours].ArrayDepart != "undefined")
    {
      addValue(ArrayParcours[Parcours].info.Nom._Value , ArrayParcours[Parcours].nom) ;
    }
    else
    {
        document.write("Contacter info#defichrono.ch");
    }
}

var sel = document.getElementById("NomParcours");
if (ArrayParcours.length >1)
{
		var opt = new Option('Sélectionner', '');
		//sel.setAttribute("style","background-color:#41e063");
		sel.insertBefore(opt, sel.firstChild);
		sel.options[0].setAttribute("selected", "selected");
		sel.ReadOnly = false;
}
else if (ArrayParcours.length ==1)
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
		document.getElementById("lblNomEquipe").style.display  = "table" ;
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