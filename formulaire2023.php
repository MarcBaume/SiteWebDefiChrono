<!DOCTYPE html>
<html>
<head>
<meta http-equiv="cache-control" content="no-cache"> <!-- tells browser not to cache -->
<meta http-equiv="expires" content="0"> <!-- says that the cache expires 'now' -->
<meta http-equiv="pragma" content="no-cache"> <!-- says not to use cached stuff, if there is any -->
	<meta property="og:description" content="chronométrage, chrono, jura, franches-montagnes, Jura défi, course à pied, Sport, Jura défi chrono" />  
	<title>Défi Chrono</title>
	<meta charset="utf-8">
	<metahttp-equiv = 'cache-control' content = 'no-cache'>
<metahttp-equiv = 'expires' content = '0'>
<metahttp-equiv = 'pragma' content = 'no-cache'>
	<meta name="viewport" content="width=device-width, maximum-scale=1.0, user-scalable=yes">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css">
	<link rel="stylesheet" title="defaut" media="screen" href="styleV6.css" type="text/css"/>
<!--	<link rel="stylesheet" type="text/css" media="screen and (max-width: 480px)" href="style-mobilV2.css" /> -->
<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js">
	 </script>
<script src="../js/prototype.js" ></script>
<script src="../js/FonctionDefiChrono2.js?v=1"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>

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

$(function() {
  $("#OpenPopUpAddCoureur").click(function() {
    $(".fullscreen-container").fadeTo(200, 1);
  });
  $("#ExitPopUp").click(function() {
    $(".fullscreen-container").fadeOut(200);
  });
});
</script>
	<?php
	  include("Header2023.php");
 
	  ?>

<div id="corps">

	<?php include("HeaderInfo2023.php"); 

	
if ( $today < $val ["DateStartInscription"] && $_SESSION['Niveau'] != 2 && $_SESSION['Niveau'] != 0 )
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
	
	document.getElementById("NomEquipe").value =valueText;
	$('VerifEquipe').request({
		onComplete: function(transport){
			var val =transport.responseText.evalJSON();
	}
	});
}


</script>
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
<center>
<img src="images/FilRougeInscription4.png" style="width: 80%" >
</center>
<!----- POP -UP AJOUT MEMBRES --------->
<div class="popup" >
  <span class="popuptext" id="myPopup">
  		<button class="ButtonResultat" id="ExitPopUp"  type ="button" style="float:right;min-width:40px; width:40px; height:40px; margin-right :10px;" onClick="ShowPopuAddMember()" title="Exit" data-toggle="tooltip" data-placement="right">X</button>
		  <p Style="margin-left:10px;margin-right:10px; color:black; font-size:18px"> Ajout d'un nouveau coureur </p>
    	  <form id="formAddMember" name="formAddMember" method="get" action="addMembresFormulaire.php"  >
		  <table >
			<tr>
				<td>
       				 <table  >
						<input type="hidden" name="LoginCompte" id="LoginCompte"   value= '<?php echo $_SESSION['Login'] ?>' />
						<tr  style="padding: 10px; "><td >Nom</td> <td><input type="text" name="nom" id="nomAdd" tabindex="10" style="width:80%;margin:10px"/></td></tr>
						<tr  style="padding: 10px; "><td >Prénom</td> <td> <input  type="text" name="prenom" id="prenomAdd" tabindex="20" style="width:80%;margin:10px"/></td></tr>
						<tr  style="padding: 10px; "><td  >Adresse e-mail</td>  <td> <input type="text" name="email" id="emailAdd" tabindex="40" style="width:80%;margin:10px"/></td></tr>
						<tr  style="padding: 10px; "><td  >Adresse</td> <td>  <input type="text" name="adresse" id="adresseAdd" tabindex="50" style="width:80%;margin:10px"/></td></tr>
						<tr style="padding: 10px; "><td >NPA</td>  <td> <input type="text" name="zip" id="zipAdd" tabindex="60" style="width:80%;margin:10px"/></td></tr>
						<tr style="padding: 10px; "><td >Localité</td>  <td> <input type="text" name="ville" id="villeAdd"tabindex="70" style="width:80%;margin:10px" /></td></tr>
						<tr style="padding: 10px; "><td  >Pays</td>   <td> <input type="text" name="pays" id="paysAdd"tabindex="80" style="width:80%;margin:10px"/></td></tr>	
						<tr style="padding: 10px; "><td  >Année de Naissance</td> <td><input type="text" name="dateNaissance" 	id="dateNaissanceAdd" tabindex="90" style="width:80%;margin:10px"  /><td></tr>

						<tr style="padding: 10px; "><td  for="club">Club</td><td> <input type="text" name="club" id="clubAdd"tabindex="100" style="width:80%;margin:10px"/></td></tr>
											
						<tr style="padding: 10px; "><td >Sexe</td><td><Select name="sexe"   id="sexeAdd" style="width:80%;margin:10px"> 
							<option style="padding : 10px" value= "">Selectionner</option>	
							<option style="padding : 10px" value= "D">Dame</option>
							<option style="padding : 10px" value= "H">Homme</option>				
						</select></td></tr>
						
					</table>
				</td>
			</tr>
			<tr>
				<td>
					<button class="ButtonResultat"  type ="button" style="float:right; height:80px; margin-right :10px;" onClick="checkForm2(this.form)" title="Validations Informations" data-toggle="tooltip" data-placement="right"><img src="/images/validation.jpg" width="50"></button>
				</td>
			</tr>
		</table>

		</form>		
  </span>
</div>


<form id="VerifEquipe" method="get" action="VerifEquipe.php">
	<input type="hidden" name="Course" id="Course"   value= '<?php echo $NOM_COURSE. $ANNEE_COURSE ?>' />
	<input type="hidden" name="NomEquipe" id="NomEquipe"   value=  />
</form>

<form method="post" action="ciblePanier.php" id="Formulaire" name="Formulaire" onload="Choix1Coureur()" >
<table width="100%"  style="padding: 10px; background :#C0C0C0;">
	<tr>
		<td style="width: 30%;padding: 10px;padding-left: 20px;">
<?php if ($val ["JuraDefi"] )
{?>
	Chef d'équipe : 
	</td>
	<td  style="width: 60%;"> 
	<Select  style="width: 90%;"  onchange ="ChoixCoureurs(this.form);" name="Coureur"   id="Coureur"/>  	<?
}
else
{
	?>
		Coureur :
		</td>
		<td style="width: 60%;"> 
		 <Select style="width: 90%;"   onchange ="ChoixCoureurs(this.form);" name="Coureur"   id="Coureur"/>  	
	<?
}?>
	</td>
	<td style="width: 10%;"> 
	<input type="hidden" name="idCoureur" id="idCoureur" />
	<input type="hidden" name="DateCourse" id="DateCourse"   value= '<?php echo $_GET['DateCourse'] ?>' />
	<input type="hidden" name="NomCourse" id="NomCourse"  value= '<?php echo $_GET["NomCourse"] ?>' />
	<input type="hidden" name="NumCat" id="NumCat" />
	<input type="hidden" name="NomCat" id="NomCat" />
	<input type="hidden" name="OnLine" id="OnLine" />
	<input type="hidden" name="Option" id="Option" />
	<input type="hidden" name="Nbretape" id="Nbretape" value= '<?php echo  $_GET["NbrEtape"] ?>' />
	<?php if ($val ["JuraDefi"] )
	{?>
	<a ><img src="admin/images/addChef.jpg" width="60px" onclick="ShowPopuAddMember()" /></a>	<?
	}
	else
	{?>
		<a class="ButtonResultat"  style= "Height:60px" onclick="ShowPopuAddMember()" id="OpenPopUpAddCoureur" >
		<i class="fa fa-plus-circle"  style= "font-size: 50px;margin:9px;color: #4095f5;"></i>
		
		
		
	</a>
		<?
	}?>
	</td>
</tr>
</table>

<div id="InformationsCoureurs" style="display:none;">
</br>
		<h3>Vérfier les informations du coureur choisi, elles peuvent être modifiées ici <a  class="ButtonResultat" style="height:60px" href="admin/membres.php"> 
		
		<i  href="admin/membres.php" class="fa fa-pencil"  style= "font-size: 40px;margin:9px;color: #4095f5;"></i></a>
	
	</h3>
		<input type="hidden" name="nom" id="nom" />
		<input type="hidden" name="prenom" id="prenom" />
		 <input type="hidden" name="email" id="email" />
		 <input type="hidden" name="adresse" id="adresse"  />
		 <input type="hidden" name="zip" id="zip" />
		<input type="hidden" name="ville" id="ville"/>
		<input type="hidden" name="club" id="club"/>
		<input type="hidden" name="pays" id="pays"/>					
		<input  type="hidden" name="sexe"   id="sexe"  /> 
		<input   type="hidden"  name="date" id="date"  />
		
		<table width="100%">
			<tr style="background:#C0C0C0;padding:20px;">

				<td style="padding: 10px;padding-left: 20px;">Nom :</td><td id="td_nom" style="padding:5px; Background:lightblue;"><a name="tdnom" id="tdnom" ></a></td>
			</tr>
			<tr style="height: 10px;"> 
				<td></td><td></td>
			</tr>

			<tr style="background:#C0C0C0;">
				<td style="padding: 10px;padding-left: 20px;">Prénom :</td><td id="td_prenom" style="padding:5px; Background:lightblue;" ><a  name="tdprenom" id="tdprenom" ></a></td>
			</tr>
			<tr style="height: 10px;"> 
				<td></td><td></td>
			</tr>

			<tr style="background:#C0C0C0;">
				<td style="padding: 10px;padding-left: 20px;">Année de Naissance:</td><td id="td_date" style="padding:5px; Background:lightblue;"><a  name="tddate" id="tddate"  ></a></td>
			</tr>
			<tr style="height: 10px;"> 
				<td></td><td></td>
			</tr>

			<tr style="background:#C0C0C0;">
				<td style="padding: 10px;padding-left: 20px;">Sexe:</td><td  id="td_sexe" style="padding:5px; Background:lightblue;"><a  name="tdsexe" id="tdsexe"  ></a></td>
			</tr>
			<tr style="height: 10px;"> 
				<td></td><td></td>
			</tr>

			<tr style="background:#C0C0C0;">
				<td style="padding: 10px;padding-left: 20px;">Adresse e-mail :</td><td id="td_email"  style="padding:5px; Background:lightblue;"><a  name="tdemail" id="tdemail"  ></a></td>
			</tr>
			<tr style="height: 10px;"> 
				<td></td><td></td>
			</tr>

			<tr style="background:#C0C0C0;">
				<td style="padding: 10px;padding-left: 20px;">Adresse  :</td><td id="td_adresse" style="padding:5px; Background:lightblue;"><a  name="tdadresse" id="tdadresse"  ></a></td>
			</tr>
			<tr style="height: 10px;"> 
				<td></td><td></td>
			</tr>

			<tr style="background:#C0C0C0;">
				<td style="padding: 10px;padding-left: 20px;">Localité :</td><td  id="td_zip"  style="padding:5px; Background:lightblue;"><a  name="tdzip" id="tdzip"  ></a> <a name="tdville" id="tdville" ></a></td>
			</tr>
			<tr style="height: 10px;"> 
				<td></td><td></td>
			</tr>

			<tr style="background:#C0C0C0;">
				<td style="padding: 10px;padding-left: 20px;">Pays  :</td><td id="td_pays"  style="padding:5px; Background:lightblue;"><a  name="tdpays" id="tdpays" ></a></td>
			</tr>
			<tr style="height: 10px;"> 
				<td></td><td></td>
			</tr>

			<tr style="background:#C0C0C0;">
				<td style="padding: 10px;padding-left: 20px;">Club :</td><td id="td_club"  style="padding:5px; Background:lightblue;"><a  name="tdclub" id="tdclub"  ></a></td>
			</tr>
		</table>
		</br></br>
		<h2>Informations demandées pour votre inscription </h2>

		<Table 	style="width:100%" >
			<tr style="padding: 20px; background :#C0C0C0; width:100%">
				<td  style="width: 40%;padding: 10px;padding-left: 20px;">
					Parcours : 
				</td>
				<td>
					<select  style="width: 90%;" onchange ="liste_depart(this.form);"  id="NomParcours" name="NomParcours" ></select>
				</td>		
			</tr>
		</table>

		<Table  id="lblDepart"style="width: 100%;visibility:hidden; display:none; margin-top: 20px;"   >
			<tr style="padding: 20px; background :#C0C0C0; width:100%">
				<td style="width: 40%;padding: 10px;padding-left: 20px;">
					Catégorie : 
				</td>
				<td>
					<select   style="width: 90%;" name="NomDepart" id="NomDepart" onchange="ChoiceDepart(this.form);"  ></select>
				</td>
			</tr>
		</table>

		<Table 	id="HaveAChoiceCategorie" style="visibility:hidden; display:none;width:100%; margin-top: 20px;">
			<tr style="padding: 20px; background :#C0C0C0; width:100%">
				<td  >
					<table id="TableEquipe" style="visibility:hidden; display:none;Width : 100%;">
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
							</td>
						</tr>
					</table>
				</td>
			</tr>
		</table>	
		<table id="lblNomEquipe" style="visibility:hidden; display:none; width:100%; margin-top: 20px;">
			<tr style="padding: 20px; background :#C0C0C0; width:100%">
				<td style="width: 40%;padding: 10px;padding-left: 20px;">
					Nom d'équipe: (Facultatif)
				</td>
				<td>
					 <input type="text" name="NomEquipe" id="NomEquipe" tabindex="201"    />
				</td>
			</tr>
		<!--	<tr>
				<td>
					<table id ="TableEquipeExistante">  liste equipe existante
						
					</table>
				</td>
			</tr> -->
		</table>

		<div id="Paradisc1" style="visibility:hidden; display:none" >	
            <h2 id="disc1" > </h2>
            <p  id="lblNomDisc1" ><label for="NomDisc1" >Nom *:</label> <input type="text" name="NomDisc1" id="NomDisc1" tabindex="202"   /></p>
            <p  id="lblPrenomDisc1"><label for="PrenomDisc1">Prénom *:</label>  <input type="text" name="PrenomDisc1" id="PrenomDisc1" tabindex="203"/></p>
            <p  id="lblSexeDisc1" ><label for="SexeDisc1">Sexe *:</label> 
            <select id="SexeDisc1"   name="SexeDisc1"  tabindex="204">
                <option style="padding : 10px" value= "">Selectionner</option>	
                <option style="padding : 10px" value= "D">Dame</option>
                <option style="padding : 10px" value= "H">Homme</option>	
            </select>
            </p>
        </div>

        <div id="Paradisc2" style="visibility:hidden; display:none" >	
            <h2 id="disc2" > </h2>
            <p  id="lblNomDisc2"><label for="NomDisc2" >Nom *:</label> <input type="text" name="NomDisc2" id="NomDisc2" tabindex="204"   /></p>
            <p  id="lblPrenomDisc2" ><label for="PrenomDisc2">Prénom *:</label>  <input type="text" name="PrenomDisc2" id="PrenomDisc2" tabindex="210"/></p>
            <p  id="lblSexeDisc2" ><label for="SexeDisc2">Sexe *:</label> 
            <select id="SexeDisc2"   name="SexeDisc2"  tabindex="214">
                <option style="padding : 10px" value= "">Selectionner</option>	
                <option style="padding : 10px" value= "D">Dame</option>
                <option style="padding : 10px" value= "H">Homme</option>	
            </select>
            </p>
        </div>

        <div id="Paradisc3" style="visibility:hidden; display:none" >	
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

        <div id="Paradisc4" style="visibility:hidden; display:none" >	
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

        <div id="Paradisc5" style="visibility:hidden; display:none" >	
            <h2 id="disc5"> </h2>		
            <p id="lblNomDisc5" ><label for="NomDisc5"  >Nom *:</label> <input type="text" name="NomDisc5" id="NomDisc5" tabindex="325"   /></p>
            <p id="lblPrenomDisc5" ><label for="PrenomDisc5" >Prénom *:</label>  <input type="text" name="PrenomDisc5" id="PrenomDisc5" tabindex="330"/></p>		
            <p  id="lblSexeDisc5"><label for="SexeDisc5">Sexe *:</label> 
            <select id="SexeDisc5"   name="SexeDisc5"  tabindex="334">
                <option style="padding : 10px" value= "">Selectionner</option>	
                <option style="padding : 10px" value= "D">Dame</option>
                <option style="padding : 10px" value= "H">Homme</option>	
            </select>
            </p>
        </div>
  
        <div id="Paradisc6" style="visibility:hidden; display:none" >	
            <h2 id="disc6" > </h2>		
            <p id="lblNomDisc6"><label for="NomDisc6"  >Nom *:</label> <input type="text" name="NomDisc6" id="NomDisc6" tabindex="335"   /></p>
            <p id="lblPrenomDisc6" ><label for="PrenomDisc6" >Prénom *:</label>  <input type="text" name="PrenomDisc6" id="PrenomDisc6" tabindex="340"/></p>	
            <p  id="lblSexeDisc6" ><label for="SexeDisc6">Sexe *:</label> 
            <select id="SexeDisc6"   name="SexeDisc6"  tabindex="344">
                <option style="padding : 10px" value= "">Selectionner</option>	
                <option style="padding : 10px" value= "D">Dame</option>
                <option style="padding : 10px" value= "H">Homme</option>	
            </select>
            </p>
        </div>

		<div id="ParaRemarques" style="visibility:hidden; display:none" >	
            <p id="lblRemarques"><label for="NomRemarques"  >Nom et prénom des équipiers supplémentaire *:</label> <input type="textarea" name="Remarques" id="Remarques" tabindex="336"   /></p>
		</div>
	<!---------- CHOIC TARIFS _______________-->
	<table 	style="width:100%;visibility:hidden; display:none; margin-top: 20px;" id="lblNbrEtape">
		<tr style="background:#C0C0C0;padding:20px;" >
			<td style="width: 40%;padding: 10px;padding-left: 20px;">
				Choix*:
			</td> 
			<td>
				<select  style="width: 90%;" name="nbrEtape" id="nbrEtapeInsc" tabindex="410"  onchange="choiceOption(this.form)" ></select>
			</td>
		</tr>
	</table>
	<?php if (strlen ($val["InformationInscription"])>1)
	{?>
	<p>
	<? echo $val["InformationInscription"]?>
	</p>
	<?
	}			?>
	<div id="HaveAChoiceTarif"style="display:none">

		
		<?php if ($NOM_COURSE == "BCJ Challenge"  )
		// LOrs du jura challenge on va changer la taille des t-shirt 
		{
		
			?>
			<p id="lblInfoTShirt" style="display:none">
			Merci d'indiquer votre taille de T-Shirt (Selon stock disponible)
		</p>
			<p id="lblTShirt"  style="visibility:hidden; display:none"><label for="TailleTShirt">Taille T-SHIRT</label><select  style="background-color:#41e063;"  id="TailleTShirt" name="TailleTShirt" >
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
			
		<p id="lblTShirt2"  style="visibility:hidden; display:none"><label for="TailleTShirt2">Taille T-SHIRT</label><select  style="background-color:#41e063;"  id="TailleTShirt2" name="TailleTShirt2" >
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
		</select></p>

		<p id="lblTShirt3"  style="visibility:hidden; display:none"><label for="TailleTShirt3">Taille T-SHIRT</label><select  style="background-color:#41e063;"  id="TailleTShirt3" name="TailleTShirt3" >
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
		</select></p>

		<p id="lblTShirt4"  style="visibility:hidden; display:none"><label for="TailleTShirt4">Taille T-SHIRT</label><select  style="background-color:#41e063;"  id="TailleTShirt4" name="TailleTShirt4" >
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
		</select></p>

		<p id="lblTShirt5"  style="visibility:hidden; display:none"><label for="TailleTShirt5">Taille T-SHIRT</label><select  style="background-color:#41e063;"  id="TailleTShirt5" name="TailleTShirt5" >
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
		</select></p>

		<p id="lblTShirt6"  style="visibility:hidden; display:none"><label for="TailleTShirt6">Taille T-SHIRT</label><select  style="background-color:#41e063;"  id="TailleTShirt6" name="TailleTShirt6" >
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
		</select></p>
	<?	}
		else if ($NOM_COURSE == "Course DUO" )
		// LOrs du jura challenge on va changer la taille des t-shirt 
		{?>
			<p id="lblInfoTShirt" style="display:none">
			merci d'indiquer votre taille de T-Shirt (Selon stock disponible)
		</p>
			<p id="lblTShirt"  style="visibility:hidden; display:none"><label for="T_Shirt">Taille T-SHIRT</label><select  style="background-color:#41e063;"  id="TailleTShirt" name="TailleTShirt" >
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
			</select></p>
	

		<p id="lblTShirt2"  style="visibility:hidden; display:none"><label for="TailleTShirt2">Taille T-SHIRT</label><select  style="background-color:#41e063;"  id="TailleTShirt2" name="TailleTShirt2" >
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
		</select></p>

		<p id="lblTShirt3"  style="visibility:hidden; display:none"><label for="TailleTShirt3">Taille T-SHIRT</label><select  style="background-color:#41e063;"  id="TailleTShirt3" name="TailleTShirt3" >
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
		</select></p>

		<p id="lblTShirt4"  style="visibility:hidden; display:none"><label for="TailleTShirt4">Taille T-SHIRT</label><select  style="background-color:#41e063;"  id="TailleTShirt4" name="TailleTShirt4" >
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
		</select></p>

		<p id="lblTShirt5"  style="visibility:hidden; display:none"><label for="TailleTShirt5">Taille T-SHIRT</label><select  style="background-color:#41e063;"  id="TailleTShirt5" name="TailleTShirt5" >
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
		</select></p>

		<p id="lblTShirt6"  style="visibility:hidden; display:none"><label for="TailleTShirt6">Taille T-SHIRT</label><select  style="background-color:#41e063;"  id="TailleTShirt6" name="TailleTShirt6" >
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
		</select></p><?
		}
		else
		{?>
				<p id="lblInfoTShirt" style="display:none">
			merci d'indiquer votre taille de T-Shirt (Selon stock disponible)
		</p>
			<p id="lblTShirt"  style="visibility:hidden; display:none"><label for="T_Shirt">Taille T-SHIRT</label><select  style="background-color:#41e063;"  id="TailleTShirt" name="TailleTShirt" >
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

		<p id="lblTShirt5"  style="visibility:hidden; display:none"><label for="TailleTShirt5">Taille T-SHIRT</label><select  style="background-color:#41e063;"  id="TailleTShirt5" name="TailleTShirt5" >
			<Option value="">Sélectionner</option>
			<Option value="XS">XS</option>
			<Option value="S">S</option>
			<Option value="M">M</option>
			<Option value="XL">XL</option>
			<Option value="XXL">XXL</option>
		</select></p>

		<p id="lblTShirt6"  style="visibility:hidden; display:none"><label for="TailleTShirt6">Taille T-SHIRT</label><select  style="background-color:#41e063;"  id="TailleTShirt6" name="TailleTShirt6" >
			<Option value="">Sélectionner</option>
			<Option value="XS">XS</option>
			<Option value="S">S</option>
			<Option value="M">M</option>
			<Option value="XL">XL</option>
			<Option value="XXL">XXL</option>
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
			$pathReglement = 'courses/'.$_GET['NomCourse'].$ANNEE_COURSE.'/info/Règlement.pdf';
			if (!file_exists($pathReglement))
			{
				$pathReglement = 'Règlement.pdf';
			}
	  ?>
	   <p> 
	  <label> J'accepte le réglement 
		<?echo '<a href="'.$pathReglement.'"target="_blank">ci-joint</a>'?></label>
		<input type="checkbox" style="visibility:hidden;width:40px;height:40px"  id="Reglement" >

		 </p>
		 
			<p>
		<label>J'accepte de transmettre mes données à nos partenaires 	</label>
		<input type="checkbox" style="visibility:hidden;width:40px;height:40px" checked="True" Name="Partenaire" id="Partenaire" >
		
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
			   <input class="ButtonResultat" type="button" style="cursor: pointer;  height:40px;font-size:100%; width: 160px;"  id="ButtonSend" value="Valider votre code" onclick="VerifCode()" >  </p>
				<p id="InformationCode" style="display:none; padding:5px; border-style: solid; border-color: black; font-size:160%;"></p>	
		</form>	
	
		<Table style="background-color: #FFFFFF;width: 100%; visibility:hidden; display:none" id="TableReduction">
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
			
		<p><label for="nom">Total a payer:</label> <input type="text" name="TotalPayer" id="TotalPayer"  readonly  />CHF</p>
			  
		 <input  class="ButtonResultat" type="button" style="padding: 20px; visibility:hidden;height:80px;font-size:180%;"  id="ButtonSendFormulaire" value="je m'inscris" onclick="check( )" style= " width: 100px; height: 50px";>  </br>
	</div>
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

				document.getElementById("tdnom").innerHTML = Coureur.Nom;
				document.getElementById("tdprenom").innerHTML = Coureur.Prenom ;
				document.getElementById("tdemail").innerHTML = Coureur.Mail ;
				document.getElementById("tdadresse").innerHTML = Coureur.Adresse ;
				document.getElementById("tdzip").innerHTML = Coureur.NPA  ;
				document.getElementById("tdville").innerHTML = Coureur.Localite ;
				document.getElementById("tdclub").innerHTML = Coureur.Club ;
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
<img src="images/FilRougeInscription1.png" style="width: 100%" >
	<h3><i>  Connectez-vous pour vous inscrire ! Pas encore de compte? <b> <a href="<?php echo $Link ?> ">Créer un compte   </a></b></h3>
	<form method="post" id="FormLogin" action="admin/CibleLoginV2.php">
	<!--<p><img src="images/ConnectMini.png"  ></p>-->
	<input type="hidden" name="DateCourse" id="DateCourse"   value= '<?php echo $_GET['DateCourse'] ?>' />
	<input type="hidden" name="NomCourse" id="NomCourse"  value= '<?php echo $_GET["NomCourse"] ?>' />
	<input type="hidden" name="Nbretape" id="Nbretape" value= '<?php echo  $_GET["NbrEtape"] ?>' />
	<p ><label for="Login" style="font-size:10px;">e-mail :</label></br> <input type="text" name="login" id="login" tabindex="10" /> </p>
	<p ><label for="password" style="font-size:10px;">Mot de passe :</label></br><input type="password" name="pass" id="pass" tabindex="15" /></p>

	<span class="dot" style="cursor: pointer;"  onClick="SubmitLogin()">
		<table>
			<tr  >
				<td style="width:30px">
					<i class="fa fa-sign-in" style= "font-size: 35px;margin:0px;margin-left: 9px;"></i>
				</td>
				<td style="padding-left: 10px;">
					Se connecter
				</td>
			</tr>
		</table>
	</span>

	</form>
	<?php
    if ($_GET['Login'] =="false")
	{
		session_destroy();
		?> <p style="background: red;font-weight: bold;"> Mauvais mot de passe </p>
			 <p>* Si  votre mot de passe ne fonctionne pas, veuillez le réinitialiser </p><?
		
	}
	else
	{
		session_destroy();
		?> <p style="background: red;font-weight: bold;"> Aucune session est connecté</p><?
	
	}?>
	<!-- <p><h2>	<a href="AddLogin.php"style="font-size:12px;">Mot de passe oublier? </a></h2></p>-->
	
	<!-- Création Compte et garde en mémoire course -->
	<span class="dot">
					<p style="margin:10px;background:transparent;">
					<a href="PasswordForget2023.php"style="font-size:12px;">réinitialiser mon mot de passe </a>
					</p>
				</span >
	
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

	document.getElementById("tdnom").innerHTML = Coureur.Nom;
	document.getElementById("tdprenom").innerHTML = Coureur.Prenom ;
	document.getElementById("tdemail").innerHTML = Coureur.Mail ;
	document.getElementById("tdadresse").innerHTML = Coureur.Adresse ;
	document.getElementById("tdzip").innerHTML = Coureur.NPA  ;
	document.getElementById("tdville").innerHTML = Coureur.Localite ;
	document.getElementById("tdclub").innerHTML = Coureur.Club ;
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
				// Si il existe un seul parcours // d'office sélectionné
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
				
				var ParcoursObj = ArrayParcours[intselected];
			
				// Si parcours sélectionné
				if (typeof ParcoursObj != "undefined")
				{
					// Selon Choix possible dans liste de départ 

					var Cat =	document.getElementById("NomDepart");

					// SI aucune option égale pas de départ possible 
					console.log(Cat);
				
					var tabOption = Cat.value.split(';');
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

                    document.getElementById("lblNomEquipe").style.visibility = "hidden" ;
					document.getElementById("Paradisc1").style.visibility = "hidden" ;
					document.getElementById("Paradisc2").style.visibility = "hidden" ;
					document.getElementById("Paradisc3").style.visibility = "hidden" ;
					document.getElementById("Paradisc4").style.visibility = "hidden" ;
					document.getElementById("Paradisc5").style.visibility = "hidden" ;
					document.getElementById("Paradisc6").style.visibility = "hidden" ;
					document.getElementById("ParaRemarques").style.display = "none" ;

					document.getElementById("TableEquipe").style.visibility = "hidden" ;
					document.getElementById("TableEquipe").style.display  = "none" ;
						
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
				
					if (j > 1)
					{
						document.getElementById("lblNbrEtape").style.display  = "table" ;
						document.getElementById("lblNbrEtape").style.visibility = "visible" ;
						var z = new Option("Sélectionner", "" );
						e.setAttribute("style","background-color:#41e063");
						e.options.add( z,0);	
						e.selectedIndex = 0;
					}
					else
					{
						document.getElementById("lblNbrEtape").style.display  = "table" ;
						document.getElementById("lblNbrEtape").style.visibility = "visible" ;
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
                                pReduc.appendChild(InCheckbox);
						    	pReduc.appendChild(text);	
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
//input.setAttribute("value", "Donation;"+ input.value);
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
/* Rendre invisible les différents champs lors de l'initialisation */
	document.getElementById("lblNomEquipe").style.display  = "none" ;
	document.getElementById("Paradisc1").style.display  = "none" ;
	document.getElementById("Paradisc2").style.display  = "none" ;
	document.getElementById("Paradisc3").style.display  = "none" ;
	document.getElementById("Paradisc4").style.display  = "none" ;
	document.getElementById("lblNomEquipe").style.visibility = "hidden" ;

	document.getElementById("Paradisc1").style.visibility = "hidden" ;
	document.getElementById("Paradisc2").style.visibility = "hidden" ;
	document.getElementById("Paradisc3").style.visibility = "hidden" ;
	document.getElementById("Paradisc4").style.visibility = "hidden" ;
	
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

				// Plusieurs départ disponible ajouter un champs pour sélectionner le départ 
				if (ICounterCat >1)
				{
					var z = new Option("Sélectionner", "" );
					sel.insertBefore(z, sel.firstChild);
					sel.options[0].setAttribute("selected", "selected");
					sel.ReadOnly = false;
				}
				else
				{
					sel.style.backgroundColor = "Gray";
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
		lbl.style.display  = "table" ;
	}
	lbl.style.visibility =	sel.style.visibility;
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
              
                    //***************** NOMBRE DE COUREUR INSCRIT DANS LE DEPART Pour zone de tarif **********

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
function ShowPopuAddMember() 
{
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