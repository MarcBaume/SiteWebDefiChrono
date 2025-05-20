<!DOCTYPE html>
<html>
<head>
<meta http-equiv="cache-control" content="no-cache"> <!-- tells browser not to cache -->
<meta http-equiv="expires" content="0"> <!-- says that the cache expires 'now' -->
<meta http-equiv="pragma" content="no-cache"> <!-- says not to use cached stuff, if there is any -->

	<title>Défi Chrono</title>
	<meta charset="utf-8">
	<metahttp-equiv = 'cache-control' content = 'no-cache'>
<metahttp-equiv = 'expires' content = '0'>
<metahttp-equiv = 'pragma' content = 'no-cache'>
	<meta name="viewport" content="width=device-width, maximum-scale=1.0, user-scalable=yes">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css">
	<link rel="stylesheet" title="defaut" media="screen" href="../../styleV6.css" type="text/css"/>
<!--	<link rel="stylesheet" type="text/css" media="screen and (max-width: 480px)" href="style-mobilV2.css" /> -->
<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js">
 </script>
 <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined" rel="stylesheet">
 <link rel="stylesheet"   href="https://fonts.googleapis.com/css?family=Open Sans">
<script src="../../js/prototype.js" ></script>
<script src="../../js/FonctionDefiChrono2.js?v=1"></script>
</script>
<!--	<link rel="stylesheet" type="text/css" media="screen and (max-width: 480px)" href="style-mobilV2.css" /> -->
</head>
    <body>
<?	include("MenuInscriptions.php");
?>

    <script>
	var CoureurFind = new Object();

function isMail2(txtMail)
{
	var regMail=new RegExp("^[0-9a-z._-]+@{1}[0-9a-z. -]{2,}[.]{1}[a-z]{2,5}$", "i");
	return regMail.test(txtMail);
}

function updateValue()
{
	document.getElementById("IDCoureur").value =document.getElementById("FindValue").value ;
	ReadMysqlCoureur();
}
// Obsolete
function AddPersonne()
{
	FormValue = document.GetElementById("ValueCourse");
	FormValue.action="formulaireInscriptionSurPlace_p2.php"
	// Ajout élément au local storage 
	var coureur = check();
	if (coureur != false)
	{
		console.log(localStorage.key(localStorage.length-1));
		var  KeyLastCoureur = 0;
		if (localStorage.length> 0)
		{
			// Cherche la plus grand clé
			for (var i = 0; i < localStorage.length; i++)
			{
				if  (KeyLastCoureur < parseInt(localStorage.key(i)))
				{
					KeyLastCoureur = parseInt(localStorage.key(i));
				}
	
			}
		}


		
		var NewKey = (KeyLastCoureur+1).toString();
		console.log(NewKey);
		localStorage.setItem(NewKey, JSON.stringify(coureur));
		// Changement de page  
		f1 =  document.getElementById("ValueCourse");
		f1.submit();
	}


}

</script>

<div id="corps">
<table>
	<tr>
		<td>
			<h3><span class="material-symbols-outlined">install_mobile</span>
				Liste de départ  <?php  echo $NOM_COURSE. ' ' . $ANNEE_COURSE ?>
			</h3>
			<p id="lblInformation" style="visibility:hidden; display:none;padding:5px; border-style: solid; border-color: black; font-size:160%;background:#fa8a8a "></p>	

		</td>
		<td>
			<Form  method="post" action="ExportMysql.php">
				<input type="hidden" name="DateCourse" id="DateCourse" tabindex="10"  size="60"  value= '<?php echo $DateCourse ?>' />
				<input type="hidden" name="etape" id="etape" value= '<?php echo $_POST["etape"] ?>' />
				<input type="hidden" name="NomCourse" id="NomCourse" tabindex="10"  size="60"  value= '<?php echo $NOM_COURSE ?>' />		
				<center>
					<input type="submit" class="ButtonResultat" value="Export Excel">
				</center>
			</form>
		</td>
	</tr>
</table>
<Fieldset>
<div id="formulaire">

<form method="get"  id="FormulaireCoureur" name="FormulaireCoureur" style="display : none;" >

	<input type="hidden" name="DateCourse" id="DateCourse"   value= '<?php echo $_GET['DateCourse'] ?>' />
	<input type="hidden" name="NomCourse" id="NomCourse"  value= '<?php echo $_GET["NomCourse"] ?>' />
	<input type="hidden" name="NumCat" id="NumCat" />
	<input type="hidden" name="NomCat" id="NomCat" />
	<input type="hidden" name="OnLine" id="OnLine" />
	<input type="hidden" name="Option" id="Option" />
	<input type="hidden" name="Find" id="Find" />
	<input type="hidden"  id="NomParcours" name="NomParcours" />
	<input type="hidden"  id="NomDepart" name="NomDepart" />
	<input type="hidden"  id="TypelocalStorage" name="TypelocalStorage"  value= '<?php echo $val["TypeAttributionDossardAuto"] ?>'/>
	<input type="hidden" name="IDCoureur" id="IDCoureur"  value= '<?php echo $_GET["IDCoureur"] ?>'  />
	

	<!-- Tableau information du coureurs à inscrire !-->
	<div id="InformationsCoureurs">
		<table width="100%">
			<tr style="background:#C0C0C0;padding:20px;">
				<td style="padding: 10px;padding-left: 20px;">Numéro dossard :</td><td id="td_num_dossard" style="padding:5px; Background:lightblue;"><input type="text" name="num_dossard" id="num_dossard" /></td>
				<td style="padding: 10px;padding-left: 20px;">Nom & prénom :</td><td id="td_nom" style="padding:5px; Background:lightblue;"><input type="text" name="nom" id="nom" /> <input type="text" name="prenom" id="prenom" /></td>
			</tr>
			<tr style="height: 10px;"> 
				<td></td><td></td>
			</tr>
			<tr style="background:#C0C0C0;">
				<td style="padding: 10px;padding-left: 20px;">Année de Naissance :</td><td id="td_date"  style="padding:5px; Background:lightblue;">	<input  style="width: 70px;" onchange ="liste_depart(this.form,true);" type="text"  name="date" id="date"  /><i>Exemple : 1988</i>
				<td style="padding: 10px;padding-left: 20px;">Genre :</td>
				<td id="td_sexe" style="padding:5px; Background:lightblue;">
					<input type="hidden" name="sexe" id="sexe"  />
					<button  id= "SexeHomme" type="button" style=" font-size :24px" >
						<i class='fa fa-male' ></i>
					</button>
					<button  id= "SexeDame" type="button" style="color : #DB02EB; font-size :24px" >
						<i class='fa fa-female' ></i>	
					</button>
					<input type="hidden" name="adresse" id="adresse"  />
					<input type="hidden" name="zip" id="zip" /> 
					<input type="hidden" name="ville" id="ville"/>
					<input type="hidden" name="pays" id="pays"/>	
					<input type="hidden" name="email" id="email" />
					<input type="hidden" name="club" id="club"/>
				</td>
			</tr>
			<tr style="height: 10px;"> 
				<td></td><td></td>
			</tr>
			<tr style="background:#C0C0C0;">
				<!-- Emplacement des départs trouvé -->
                <Td colspan="4" >
					<table  id="TableDepartForRunner" >
					</table>
                </td>
            </tr>
			<tr style="height: 10px;"> 
				<td></td><td></td>
			</tr>
			<tr  id="RowEquipe" style="background:#C0C0C0;">
				<td colspan="4" >
					<table  id="TableEquipe" style="background:#C0C0C0;">
						<tr>
							<td style="padding: 10px;padding-left: 20px;">
								Nom Equipe:
							</td>
							<td style="padding:5px; Background:lightblue;">
								<input type="text"  name="NomEquipe" id="NomEquipe" tabindex="201"    />
							</td>
							<td style="padding: 10px;padding-left: 20px; font-size:10px;">
								Type _> 1:Equipe, 2:Duo , 3:entreprise
							</td>
							<td style="padding:5px; Background:lightblue; width :50px" >
								<input style="width :40px" type="text" name="TypeEquipe" id="TypeEquipe" tabindex="202"    />
							<td>
						 </tr>
					</table>
				</td>
			</tr>
		</table>
		</tr>
		<tr>


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
				Etapes:
			</td> 
			<td>
				<input type="text" name="NbrEtape" id="NbrEtape" tabindex="410"    />
			</td>
		</tr>
	</table>
</form>


	
	<center>
	<table style="width:80%">
		<tr>
			<td>
				<input type="button" style="visibility:hidden;height:40px;font-size:160%;"  id="ButtonSendFormulaire"   class="ButtonResultat"  value="Ajouter cette inscription à mon pannier" onclick="check()" style= " width: 100px; height: 50px";>  </br>
			</td>
			<td>
				<input type="button" style="visibility:hidden;height:40px;font-size:160%;"   id="ButtonDeleteFormulaire"   class="ButtonResultat"  value="Supression du coureur" onclick="funConfirmResetCoureur()" style= " width: 100px; height: 50px";>  </br>
			</td>
			<td>
				<button  id= "ButtonReset" type="button" style=" font-size :24px"  class="ButtonResultat" onclick="ResetCoureur()">
						Reset
				</button>
			</td>
		</tr>
	</table>

		<!----------Information Delete coureur _______________-->
		<table 	style="width:100%;visibility:hidden; display:none; margin-top: 20px;" id="lblInfoDeleteCoureur">
		<tr>
			<td>
			<input type="button" style="height:40px;font-size:160%;"  id="ButtonConfirmDeleteFormulaire"   class="ButtonResultat"  value="Confirmer vous la Supression du coureur" onclick="funDeleteCoureur()" style= " width: 100px; height: 50px";>  </br>
				</td>
		</tr>
	</table>
	</center>
	
	<p id="lblInformation" style="visibility:hidden; display:none;padding:5px; border-style: solid; border-color: black; font-size:160%;background:#fa8a8a "></p>	

	 <div style="display :none;" ><label for="nom">Prix:</label> <input type="text" name="PrixDepart" id="PrixDepart" tabindex="510"  readonly  />CHF</div>
	  <center>

</div>
	</div>
</div>	
</div>
<center>
	<div id="DivListeCoureurInscrits">
<h2>Liste des  personnes inscrites </h2>
<p>
  <input Type="text"  style="font-size:24px" name="FindValue" id="FindValue" />
  <button type="button" class="ButtonResultat" onclick="ReadMysqlCoureur()">	<i class='fa fa-search' ></i></button>
</p>
<Table  style="width: 80%" id ="TableListCoureurs">
</table>
		</center>
</div>
<script>

	// Inscription à l'événement de recherche
	const textInputValue = document.getElementById('FindValue');
	textInputValue.addEventListener("input", updateValue);

	var inputSexe = document.getElementById("sexe");
	var inputDame = document.getElementById("SexeDame");
	
	inputDame.classList.add("ButtonResultat");
	var inputHomme = document.getElementById("SexeHomme");
	inputHomme.classList.add("ButtonResultat");


	// évenement ajout colonne dans tableau
function SelectSexe(Sexe)
{
	var inputSexe = document.getElementById("sexe");
	var inputDame = document.getElementById("SexeDame");
	var inputHomme = document.getElementById("SexeHomme");

	if (Sexe)
	{
		inputHomme.classList.remove("ButtonResultat");
		inputHomme.classList.add("ButtonResultatSelected");	

		inputDame.classList.remove("ButtonResultatSelected");
		inputDame.classList.add("ButtonResultat");	

		inputSexe.value = "H";
	}
	else
	{
		inputDame.classList.remove("ButtonResultat");
		inputDame.classList.add("ButtonResultatSelected");	

		inputHomme.classList.remove("ButtonResultatSelected");
		inputHomme.classList.add("ButtonResultat");	

		inputSexe.value = "D";
	}
	ListeDepartNoForm();
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

	document.getElementById("lblNbrEtape").style.visibility = "hidden" ;
	document.getElementById("lblNbrEtape").style.display  = "none" 

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

	if (  DepartObj.ArrayEtape.length > 1 )
	{
		document.getElementById("lblNbrEtape").style.visibility = "visible" ;
		document.getElementById("lblNbrEtape").style.display  = "table" 
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


}
// Fonction de vérification que c'est un e-mail
function isMail(txtMail)
{
	var regMail=new RegExp("^[0-9a-z._-]+@{1}[0-9a-z. -]{2,}[.]{1}[a-z]{2,5}$", "i");
	return regMail.test(txtMail);
}

// SI l'on a choisie la même adresse dans la page 2 
function funSameAdresseWithLastID()
{
	
		if (localStorage.length> 0)
		{
			var KeyLastCoureur =0 ;
			// Cherche la plus grand clé
			for (var i = 0; i < localStorage.length; i++)
			{
				if  (KeyLastCoureur < parseInt(localStorage.key(i)))
				{
					KeyLastCoureur = parseInt(localStorage.key(i));
					
				}
	
			}
			// Transfrome clé en objet 
			newObject = localStorage.getItem(KeyLastCoureur);
			//console.log(newObject);
			f1 =  document.getElementById("FormulaireCoureur");
			 var LastCoureur = JSON.parse(newObject);
			 console.log(LastCoureur);
			 f1.email.value = 	LastCoureur.email ;
			 f1.zip.value = LastCoureur.zip;
			 f1.adresse.value = LastCoureur.adresse;
			f1.ville.value = LastCoureur.ville;
		}


}


// Si on a sélecter la même adresse que l'ancien coureur 
</script>
<?
 if ($_GET["LastAdresse"]== "True")
 {
	?>
		<script>
		funSameAdresseWithLastID();
		</script>
	<?
 }

?>
<script>
// Contrôle que le formulaire est remplie correctement
function check() 
{
	var coureur =  new Object();
    f1 =  document.getElementById("FormulaireCoureur");
	
	if (f1.nom.value.length<3) {
		f1.nom.style.background = "red";
		f1.nom.focus();
		return false;
	}
	else
	{
		f1.nom.style.background = "white";
	}

	coureur.nom = f1.nom.value;

	if (f1.prenom.value.length<3)
	{
		f1.prenom.style.background = "red";
		f1.prenom.focus();
		return false;
	}
	else
	{
		f1.prenom.style.background = "white";
	}

	coureur.prenom = f1.prenom.value;


	coureur.email = f1.email.value;
	coureur.adresse = f1.adresse.value;
	coureur.zip = f1.zip.value;
	coureur.ville = f1.ville.value;
	coureur.NomDepart = f1.NomDepart.value;

	if (f1.NomParcours.value.length<1) {
		alert("Merci d'indiquer le type de votre parcours");
		f1.NomParcours.focus();
		return false;
	}

	coureur.NomParcours = f1.NomParcours.value;


		if (f1.date.value.length!=4) {
			alert("Merci d'indiquer votre date de naissane ex: 1988");
		f1.date.focus();
		return false;
	}

	coureur.date = f1.date.value;


		if (f1.sexe.value.length<1) {
		alert("Merci d'indiquer votre sexe");
		f1.sexe.focus();
		return false;
	}
	
	coureur.sexe = f1.sexe.value;
	var FormCoureur =document.getElementById("FormulaireCoureur");

	AddInscriptionOrModify();
	

}

// Ajout inscriptiuon ou modifie inscription existante
function AddInscriptionOrModify()
{
	var FormCoureur =document.getElementById("FormulaireCoureur");
	// modification inscription
	FormCoureur.action="CibleUpdateAdmin.php";
		

	$('FormulaireCoureur').request({
			onComplete: function(transport){

				 val =transport.responseText.evalJSON();
				 console.log(val);
				 console.log("val6");

				if (val == -9999)
				{
					var lblinfo = document.getElementById("lblInformation");
						lblinfo.style.visibility = "visible" ;
						lblinfo.style.display  = "block" ;
						lblinfo.innerHTML = "Numéro déjà existant";
				
				}
				else
				{
					 // Ecriture numéro de dossard sur mémoire chache du navigateur afin de deviner le numéro suivant a enregistrer
	
					//!! Todo selon paramètrage si numéro de dossard est par départ / Parcours ou global
					if ( document.getElementById("TypelocalStorage").value   == "")
					{
						console.log("local storage disable");
					}
					else if (  document.getElementById("TypelocalStorage").value   == "DEPART")
					{
						localStorage .setItem(document.getElementById("NomDepart").value ,document.getElementById("num_dossard").value);
						console.log("local storage départ");
					}
					else if ( document.getElementById("TypelocalStorage").value   == "PARCOURS")
					{
						localStorage.setItem(document.getElementById("NomParcours").value ,document.getElementById("num_dossard").value);		
						console.log("local storage parcours");
					}
					else
					{
						console.log("local storage global");
						localStorage.setItem( <?php echo json_encode($NOM_COURSE. $ANNEE_COURSE ); ?>  ,document.getElementById("num_dossard").value);
					}

					// Lecture base de donnée mysql 
					ReadMysqlCoureur();
					// Remise à zéro formulaire
					ResetCoureur();
				}
			}
		});
}


// Remettre vierge formulaire coureur
function  ResetCoureur()
{
	console.log("fun Reset Coureur");
	document.getElementById("IDCoureur").value ="";
	document.getElementById("num_dossard").value ="";
	document.getElementById("nom").value ="";
	document.getElementById("prenom").value ="";
	document.getElementById("date").value  ="";
	document.getElementById("NomDepart").value = "" ;
	document.getElementById("NomParcours").value = "" ;
	document.getElementById("NomCat").value = "" ;
	document.getElementById("NumCat").value = "" ;	
	
	document.getElementById("NomEquipe").value = "" ;

	document.getElementById("Paradisc1").value = "" ;
	document.getElementById("Paradisc2").value = "" ;
	document.getElementById("Paradisc3").value = "" ;
	document.getElementById("Paradisc4").value = "" ;
	document.getElementById("Paradisc5").value = "" ;
	document.getElementById("Paradisc6").value = "" ;

	document.getElementById("ParaRemarques").value = "" ;

	inputHomme.classList.remove("ButtonResultatSelected");
	inputHomme.classList.add("ButtonResultat");	

	inputDame.classList.remove("ButtonResultatSelected");
	inputDame.classList.add("ButtonResultat");	

	
	var lblinfo = document.getElementById("lblInformation"); 
	lblinfo.style.visibility = "hidden" ;
					lblinfo.style.display  = "none" ;
					lblinfo.innerHTML = "";
	document.getElementById("ButtonSendFormulaire").style.display  = "none" ;
		document.getElementById("ButtonSendFormulaire").style.visibility = "hidden" ;
		document.getElementById("ButtonDeleteFormulaire").style.display  = "none" ;
		document.getElementById("ButtonDeleteFormulaire").style.visibility = "hidden" ;
		document.getElementById("lblInfoDeleteCoureur").style.display  = "none" ;
		document.getElementById("lblInfoDeleteCoureur").style.visibility = "hidden" ;
		document.getElementById("FormulaireCoureur").style.display  = "none" ;
		document.getElementById("DivListeCoureurInscrits").style.display  = "block" ;
		
}

// Selon coordonnée du corueur départ disponible sans vérificatino que le champs sexe est bien remplie
function  ListeDepartNoForm()
{
	console.log("function ListeDepartNoForm")
	liste_depart(document.getElementById("FormulaireCoureur",false));
}

// Sélection départ dans le formulaire
function  SelectDepart(evt)
{	

	var ButtonParcours	= document.getElementsByName("buttonParcours");
	for(var i = 0; i < ButtonParcours.length; i++) 
	{
	
		ButtonParcours[i].classList.add("ButtonResultat");
 		ButtonParcours[i].classList.remove("ButtonResultatSelected");

	}
	

	document.getElementById(evt).classList.remove("ButtonResultat");
	document.getElementById(evt).classList.add("ButtonResultatSelected");
	
	document.getElementById("NomDepart").style.backgroundColor="#FFFFFF";
	

	var tabOption = evt.split(';');
	var ParcoursObj = ArrayParcours[tabOption[6] ];
	var DepartObj = ParcoursObj.ArrayDepart[tabOption[0]];
		

		document.getElementById("NomDepart").value = tabOption[2] ;
		document.getElementById("NomParcours").value = tabOption[5] ;
		document.getElementById("NomCat").value = tabOption[3] ;
		document.getElementById("NumCat").value = tabOption[4] ;	
		
		//********* initialisatino des champs **********************/
		document.getElementById("Paradisc1").style.display = "none" ;
		document.getElementById("Paradisc2").style.display = "none" ;
		document.getElementById("Paradisc3").style.display = "none";
		document.getElementById("Paradisc4").style.display = "none" ;
		document.getElementById("Paradisc5").style.display = "none" ;
		document.getElementById("Paradisc6").style.display = "none" ;
		document.getElementById("ParaRemarques").style.display = "none" ;

		document.getElementById("Paradisc1").style.visibility = "hidden" ;
		document.getElementById("Paradisc2").style.visibility = "hidden" ;
		document.getElementById("Paradisc3").style.visibility = "hidden" ;
		document.getElementById("Paradisc4").style.visibility = "hidden" ;
		document.getElementById("Paradisc5").style.visibility = "hidden" ;
		document.getElementById("Paradisc6").style.visibility = "hidden" ;
		document.getElementById("ParaRemarques").style.display = "none" ;

		document.getElementById("TableEquipe").style.visibility = "hidden" ;
		document.getElementById("TableEquipe").style.display  = "none" ;
	
		xEquipe = false;

		var CatOBj = DepartObj.info.ListCategorie.ListItem[tabOption[1]];
	

		// Si on peut s'inscrire par équipe dans la catégorie
		if ((CatOBj.Equipe != null && CatOBj.Equipe.Value == true) || (CatOBj.Relais != null && CatOBj.Relais.Value == true))
		{
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
			document.getElementById("TableEquipe").style.display  = "table" ;					
		}
		// Affichage bouton envoie formulaire
		document.getElementById("ButtonSendFormulaire").style.display  = "block" ;
		document.getElementById("ButtonSendFormulaire").style.visibility = "visible" ;
		document.getElementById("ButtonDeleteFormulaire").style.display  = "block" ;
		document.getElementById("ButtonDeleteFormulaire").style.visibility = "visible" ;
}


function addValue(Text , Value) 
{
	var sel = document.getElementById("NomParcours");
	sel.options.add( new Option(Text, Value));
 }

	
// Recherche les départ compatible pour la personnne inscrite
function liste_depart(f,CheckSexe) 
{

	console.log(" fonction Liste Depart");
	// Rendre invisible les différents champs lors de l'initialisation 
	document.getElementById("Paradisc1").style.display  = "none" ;
	document.getElementById("Paradisc2").style.display  = "none" ;
	document.getElementById("Paradisc3").style.display  = "none" ;
	document.getElementById("Paradisc4").style.display  = "none" ;

	document.getElementById("Paradisc1").style.visibility = "hidden" ;
	document.getElementById("Paradisc2").style.visibility = "hidden" ;
	document.getElementById("Paradisc3").style.visibility = "hidden" ;
	document.getElementById("Paradisc4").style.visibility = "hidden" ;


	var sel = document.getElementById("NomDepart");
	var lbl = document.getElementById("lblDepart");
	var bpSend = document.getElementById("ButtonSendFormulaire");

	var bpPartenaire = document.getElementById("Partenaire");
	var ICounterCat = 0;

	var MemDataSet = "";
	// Obtention année en cours
	var dateNow = new Date().getFullYear();
	console.log("Liste Depart 44");
	// Vérification que le champs de date est dans la plage possible
	if (f.date.value.length==4 && parseInt(f.date.value ) > 1900  && parseInt(f.date.value) <=dateNow) 
	{
        f.date.style.background = "white";
		console.log("Liste Depart 45");
		console.log(f);
		if (f.sexe.value.length > 0 && f.sexe.value == "D" || f.sexe.value == "H")
		{
			sexe = f.sexe.value;
			// Tableau depart possible pour ces indication
			var tableDepart =	document.getElementById("TableDepartForRunner");
				tableDepart.innerHTML = "";

			var RowDepart = document.createElement("tr");
				tableDepart.append(RowDepart);

			// Scan chaque départ
			for(var iParcours=0; iParcours<ArrayParcours.length; ++iParcours) 
			{
		
				var nbrDepart = ArrayParcours[iParcours].ArrayDepart.length;
				
				//Scan de chaque départ
				for(var iDepart=0; iDepart<nbrDepart; ++iDepart) 
				{
					
					var DepartObj = ArrayParcours[iParcours].ArrayDepart[iDepart];

					// Scan de chaque catégorie du départ 
					for(var iCategorie=0; iCategorie<DepartObj.info.ListCategorie.ListItem.length; ++iCategorie) 
					{	

						var Cat = new Object();
						Cat = DepartObj.info.ListCategorie.ListItem[iCategorie];

						// Si Catégorie possible pour la personne choisie
						if ((sexe== Cat.SexeCategorie._Value || Cat.SexeCategorie._Value == "M") &&  (  parseInt(f.date.value) >= Cat.debutAnnee._Value ) && (parseInt(f.date.value)<=  Cat.finAnnee._Value ))
						{

							var ColDepart = document.createElement("td");
							RowDepart.append(ColDepart);

							var buttonParcours = document.createElement("button");
							buttonParcours.type = "button";
							buttonParcours.classList.add("ButtonResultat");
							buttonParcours.name = "buttonParcours"; 
							MemDataSet =  iDepart +";"+iCategorie + ";"+ DepartObj.Nom + ";"+ Cat.NomCategorie._Value+ ";" + Cat.NumCategorie._Value + ";"+ ArrayParcours[iParcours].nom  + ";"+ iParcours;
							buttonParcours.id = iDepart +";"+iCategorie + ";"+ DepartObj.Nom + ";"+ Cat.NomCategorie._Value+ ";" + Cat.NumCategorie._Value + ";"+ ArrayParcours[iParcours].nom  + ";"+ iParcours;
							// Text infomratif sur le bouton
							buttonParcours.innerHTML = ArrayParcours[iParcours].nom   + " " +Cat.NomCategorie._Value+" "+Cat.debutAnnee._Value+" - "+Cat.finAnnee._Value;
							// Infomration du départ donnée au bouton 
							buttonParcours.dataset.value = iDepart +";"+iCategorie + ";"+ DepartObj.Nom + ";"+ Cat.NomCategorie._Value+ ";" + Cat.NumCategorie._Value + ";"+ ArrayParcours[iParcours].nom  + ";"+ iParcours;


							// Comparaison si le coureur à modifié est déjà sur ce départ 
							var sDepartCoureurFind =  CoureurFind.parcours +";" + CoureurFind.NomDepart;
				
							var sDepartRead =  ArrayParcours[iParcours].nom +";" + DepartObj.Nom;
						
							
							if (sDepartCoureurFind == sDepartRead)
							{
								buttonParcours.classList.add("ButtonResultatSelected");
							}
							else
							{
								buttonParcours.classList.add("ButtonResultat");
							}

							buttonParcours.addEventListener("click", function() { SelectDepart(this.dataset.value); } );
							ColDepart.append(buttonParcours);
							ICounterCat++;

						}
					}
				
				}

			}
			
			// SI il existe aucune catégorie
			var lblinfo = document.getElementById("lblInformation"); 
			if (ICounterCat == 0)
			{
				console.log("Liste Depart 3");
				// Valeurs incorect pour ce dÃ©part 
				bpSend.style.visibility = "hidden" ;
				sel.style.visibility = "hidden" ;
				document.getElementById('date').style.backgroundColor="#fa8a8a";
				document.getElementById('NomParcours').style.backgroundColor="#fa8a8a";
				lblinfo.style.visibility = "visible" ;
				lblinfo.style.display  = "block" ;
				lblinfo.value= "";
				
			// ajoute le noeud texte au nouveau div crÃ©Ã©
			//	Div.value = "Aucune catÃ©gorie existe sur ce parcours pour cette annÃ©e de naissance";
			}
			else if (ICounterCat == 1)
			{
				console.log("Liste Depart4");
				SelectDepart( MemDataSet);
			}
			else 
			{
			
			//	ChoiceDepart(f);
			}
		}
		
	}
	else
	{
		f.date.style.background = "red";
		f.date.focus();
	
	}
}

 </script>

<!---*************************************************
                Liste des parcours de la course
*********************************************************!---->
<script>
	var ArrayParcours = [];
</script>

<?php
// Afficher la liste des Parcours  Dossier dans la course ;
$pathfolder = '../../courses/'.$_GET['NomCourse'].$ANNEE_COURSE;
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
            $pathfolderParcours = '../../courses/'.$_GET['NomCourse'].$ANNEE_COURSE. '/'.$Parcours;
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
              
                ?>
              

            <script>
                Parcours.ArrayDepart =ArrayDepart;
                ArrayParcours.push(Parcours);
                
            </script><?php
        }
    }
}
 
?>
 <script>



// Fait apparait bouton de confirmation de supression
function funConfirmResetCoureur()
{
	document.getElementById("lblInfoDeleteCoureur").style.display  = "block" ;
		document.getElementById("lblInfoDeleteCoureur").style.visibility = "visible" ;
}	
// Supression coureur dans la base de donnée de la liste de départ
function funDeleteCoureur()
{
	FormValue = document.getElementById("FormulaireCoureur");
	FormValue.action="DeleteIDCoureur.php";
	document.getElementById("lblInfoDeleteCoureur").style.display  = "none" ;
		document.getElementById("lblInfoDeleteCoureur").style.visibility = "hidden" ;
	$('FormulaireCoureur').request({
			onComplete: function(transport){

				val =transport.responseText.evalJSON();

				console.log(val);

				if (val == 1)
				{

					ResetCoureur();
					ReadMysqlCoureur();
				}

			}
	});
}

// Recherche coureur sélectionné dans la lsite des coureurs inscrits
 function FindCoureurID()
 {
	console.log("Function Find Coureur ID");
	document.getElementById("ButtonSendFormulaire").value = "Ajout inscription" ;
	if (document.getElementById("IDCoureur").value.length > 0)
	{
		FormValue = document.getElementById("FormulaireCoureur");
		FormValue.action="ReadIDCoureur.php";

		$('FormulaireCoureur').request({
			onComplete: function(transport){

				 val =transport.responseText.evalJSON();
				 console.log("Function Find Coureur ID Find");
				 console.log(val);

		        for (var j = 0; j < val.length && j < 5;j++) 
				{		
					CoureurFind = val[0];
					console.log(val[0]);
					document.getElementById("TableEquipe").style.visibility = "visible" ;
					document.getElementById("TableEquipe").style.display  = "table" ;
					if (CoureurFind.NumDossard == "0")
					{
						document.getElementById("num_dossard").style.backgroundColor = "orange";
					}
					else
					{
						document.getElementById("num_dossard").style.backgroundColor = "lightgreen";
					}
					document.getElementById("nom").value = CoureurFind.Nom;
					document.getElementById("prenom").value = CoureurFind.Prenom;
					document.getElementById("date").value = CoureurFind.DateNaissance;
					document.getElementById("adresse").value = CoureurFind.adresse;
					document.getElementById("email").value = CoureurFind.mail ;
					document.getElementById("zip").value = CoureurFind.npa ;
					document.getElementById("ville").value = CoureurFind.localite ;
					document.getElementById("club").value = CoureurFind.club ;
					document.getElementById("NomParcours").value = CoureurFind.parcours ;
					document.getElementById("NomDepart").value = CoureurFind.NomDepart ;
					document.getElementById("NumCat").value = CoureurFind.NumCategorie ;
					document.getElementById("NomCat").value = CoureurFind.NomCategorie ;
					document.getElementById("NbrEtape").value = CoureurFind.NbrEtape ;
					document.getElementById("NomEquipe").value = CoureurFind.NomEquipe ;
					document.getElementById("TypeEquipe").value = CoureurFind.TypeEquipe ;

					document.getElementById("FindValue").value = "" ;	

					document.getElementById("ButtonSendFormulaire").value = "Valider dossard" ;
					document.getElementById("ButtonSendFormulaire").style.display  = "block" ;
					document.getElementById("ButtonSendFormulaire").style.visibility = "visible" ;
					document.getElementById("FormulaireCoureur").style.display  = "block" ;	
					document.getElementById("ButtonDeleteFormulaire").style.display  = "block" ;
					document.getElementById("ButtonDeleteFormulaire").style.visibility = "visible" ;
					document.getElementById("TableDepartForRunner").style.display  = "block" ;	
					document.getElementById("TableDepartForRunner").style.visibility = "visible" ;
					document.getElementById("sexe").value = CoureurFind.sexe;	

					if (  CoureurFind.NbrEtape.length > 0 )
					{
						document.getElementById("lblNbrEtape").style.visibility = "visible" ;
						document.getElementById("lblNbrEtape").style.display  = "table" 
					}	
					 

					if (CoureurFind.sexe == "D")
					{
						SelectSexe(false);
					}
					else
					{
						SelectSexe(true)
					}

					// Si le coureur à déjà un dossard attribué
					if (parseInt(CoureurFind.NumDossard )>0)
					{
						document.getElementById("num_dossard").value = CoureurFind.NumDossard;
					}
					else
					{
						console.log("local storage find");
						if (localStorage.length> 0)
						{
							console.log("local storage find 2");
							// Transfrome clé en objet 
							if (  document.getElementById("TypelocalStorage").value  == "")
							{
								// Fonction désactivée
							}
							else if (  document.getElementById("TypelocalStorage").value  == "DEPART")
							{
								console.log("LOCALSTORAGE DEPART");
								var NumDossard = localStorage.getItem(document.getElementById("NomDepart").value);
							}
							else if (  document.getElementById("TypelocalStorage").value == "PARCOURS")
							{
								console.log("LOCALSTORAGE Parcours");
								var NumDossard = localStorage.getItem(document.getElementById("NomParcours").value);
							}
							else
							{
								console.log("LOCALSTORAGE global");
								var NumDossard = localStorage.getItem(<?php echo json_encode($NOM_COURSE. $ANNEE_COURSE ); ?>);
							}

							// Si la clé existe 
							if (NumDossard != null)
							{
								console.log(NumDossard);
								document.getElementById("num_dossard").value = parseInt(NumDossard) + 1;
							}
						}
					}
				}
			}
		});
	}

 }

 // Lecture de liste d'inscription des dix dernière personne inscrite
function ReadMysqlCoureur()
{
	console.log("fonction ReadMysqlCoureur");
	table1 = document.getElementById("TableListCoureurs");

	table1.innerHTML = ""
	RowHeader = document.createElement('tr');
	table1.append(RowHeader);

	ColHeader = document.createElement('th');
	ColHeader.innerHTML = "N°"
	RowHeader.append(ColHeader);

	ColHeader = document.createElement('th');
	ColHeader.innerHTML = "Nom"
	RowHeader.append(ColHeader);

	ColHeader = document.createElement('th');
	ColHeader.innerHTML = "Prénom"
	RowHeader.append(ColHeader);

	ColHeader = document.createElement('th');
	ColHeader.innerHTML = "Année"
	RowHeader.append(ColHeader);

	ColHeader = document.createElement('th');
	ColHeader.innerHTML = "Localité"
	RowHeader.append(ColHeader);

	ColHeader = document.createElement('th');
	ColHeader.innerHTML = "Parcours"
	RowHeader.append(ColHeader);

	ColHeader = document.createElement('th');
	ColHeader.innerHTML = "Depart"
	RowHeader.append(ColHeader);

	ColHeader = document.createElement('th');
	ColHeader.innerHTML = "Paiement"
	RowHeader.append(ColHeader);

	// Transmets au champs la valeur rechercher
	document.getElementById("Find").value = document.getElementById("FindValue").value;

	FormValue = document.getElementById("FormulaireCoureur");
	FormValue.action="ReadInscriptionMysql.php"
	
	console.log(FormValue);
	$('FormulaireCoureur').request({
			onComplete: function(transport){
				 val =transport.responseText.evalJSON();
				 console.log(val);
		        for (var j = 0; j < val.length && j < 10 ;j++) 
				{
				
					var Coureur = new Object();
					 Coureur = val[j];

					RowsCoureur = document.createElement('tr');
					RowsCoureur.style.background ="Lightblue";
					RowsCoureur.style.height ="80px";
					RowsCoureur.dataset.value = Coureur.ID ;
					RowsCoureur.addEventListener("click", function() { SelectCoureurInscrit(this.dataset.value); } );
					table1.append(RowsCoureur);

					col1 = document.createElement('td');
					col1.style.color = "black";
					col1.style.fontSize = "24px";
					col1.style.padding = "5px";
					col1.innerHTML = Coureur.NumDossard;
					if (Coureur.NumDossard == "0")
					{
						col1.style.backgroundColor = "orange";
					}
					else
					 {
						col1.style.backgroundColor = "lightgreen";
					 }
					RowsCoureur.append(col1);
					col1 = document.createElement('td');
					col1.style.color = "black";
					col1.style.fontSize = "24px";
					col1.style.padding = "5px";
					col1.innerHTML = Coureur.Nom;
					RowsCoureur.append(col1);

					col1 = document.createElement('td');
					col1.style.color = "black";
					col1.style.fontSize = "24px";
					col1.style.padding = "5px";
					col1.innerHTML = Coureur.Prenom;
					RowsCoureur.append(col1);

					col1 = document.createElement('td');
					col1.style.color = "black";
					col1.style.fontSize = "12px";
					col1.style.padding = "5px";
					col1.innerHTML = Coureur.DateNaissance;
					RowsCoureur.append(col1);
					
					col1 = document.createElement('td');
					col1.style.color = "black";
					col1.style.fontSize = "12px";
					col1.style.padding = "5px";
					col1.innerHTML = Coureur.localite;
					RowsCoureur.append(col1);

					col1 = document.createElement('td');
					col1.style.color = "black";
					col1.style.fontSize = "12px";
					col1.style.padding = "5px";
					col1.innerHTML = Coureur.parcours;
					RowsCoureur.append(col1);

					col1 = document.createElement('td');
					col1.style.color = "black";
					col1.style.fontSize = "12px";
					col1.style.padding = "5px";;
					col1.innerHTML = Coureur.NomDepart;
					RowsCoureur.append(col1);

					col1 = document.createElement('td');
					col1.style.color = "black";
					col1.style.fontSize = "12px";
					col1.style.padding = "5px";
					col1.innerHTML = Coureur.Payer;
					RowsCoureur.append(col1);
			

					col1 = document.createElement('td');
					col1.style.color = "black";
					col1.style.fontSize = "12px";
					col1.style.padding = "5px";;
					col1.innerHTML = Coureur.NbrEtape;
					RowsCoureur.append(col1);
					
					col1 = document.createElement('td');
					col1.style.color = "black";
					col1.style.fontSize = "12px";
					col1.style.padding = "5px";
					col1.dataset.value = Coureur.ID ;
					col1.innerHTML ='	<i  style="font-size:24px;  margin:0px;"  class="fa fa-edit"></i>	';
				//	col1.addEventListener("click", function() { SelectCoureurInscrit(this.dataset.value); } );
					RowsCoureur.append(col1);
				};		
			}
	});
}
function SelectCoureurInscrit(e) {
	
	document.getElementById("DivListeCoureurInscrits").style.display  = "none" ;
	document.getElementById("IDCoureur").value = e;
	FindCoureurID();

}
	ReadMysqlCoureur();


// LEcture au démarrage de la page web
	//ReadLocalStorage() ;
</script>
   
</div>

</body>
</html>