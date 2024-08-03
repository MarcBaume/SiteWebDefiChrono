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
<script src="../../js/prototype.js" ></script>
<script src="../../js/FonctionDefiChrono2.js?v=1"></script>
</script>
</head>
    <body>
        	 <!--- Couverture --->

<?php
 
 if ( strlen($_POST['DateCourse'])>0)
 {
 $DateCourse =  $_POST['DateCourse'];
 $Date =  date_parse($_POST['DateCourse']);
 $ANNEE_COURSE = $Date['year']; 
 $Month = $Date['month']; 
 $Day = $Date['day']; 
 
 //$ANNEE_COURSE = $_POST['annee_course'];
 $NOM_COURSE = $_POST["NomCourse"];
 $Nbr_etape =  $_POST["NbrEtape"] ;
 
 }
 else if  ( strlen($_GET['DateCourse'])>0)
 {
 $DateCourse =  $_GET['DateCourse'];
 $Date =  date_parse($_GET['DateCourse']);
 $ANNEE_COURSE = $Date['year']; 
 $Month = $Date['month']; 
 $Day = $Date['day']; 
 
 //$ANNEE_COURSE = $_GET['annee_course'];
 $NOM_COURSE = $_GET["NomCourse"];
 $Nbr_etape =  $_GET["NbrEtape"] ;
 
 }
?> 
    <script>

function isMail2(txtMail)
{
	var regMail=new RegExp("^[0-9a-z._-]+@{1}[0-9a-z. -]{2,}[.]{1}[a-z]{2,5}$", "i");
	return regMail.test(txtMail);
}

function AddPersonne()
{
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
		f1 =  document.getElementById("FormulaireCoureur");
		f1.action = "formulaireInscriptionSurPlace_p2.php"
		f1.submit();
	}


	ReadLocalStorage();

}

function ReadLocalStorage()
{

	TableCoureur = document.getElementById("TableCoureur");
	TableCoureur.innerHTML = "";
	TableCoureur.style.width ="100%";


	// Afichage para aucun coureur inscrit 
	var para = document.getElementById("AucuneInscription");
	if (localStorage.length > 0)
	{
		para.style.display = "none";
	}
	else
	{
		para.style.display = "";
	}

for (var i = 0; i < localStorage.length; i++)
	{
		IndexCoureur = localStorage.key(i);
		// Transfrome clé en objet 
		newObject = localStorage.getItem(IndexCoureur);
		//console.log(newObject);
		 var ReadCoureur = JSON.parse(newObject);
		//console.log(ReadCoureur);


		tr1 = document.createElement('Tr');
		tr1.style.background = "#EAEAEA";


		td1 = document.createElement('Td');

		if (ReadCoureur.sexe =="H")
		{
			td1.style.fontSize = "24px";
			td1.style.color = "#059EE2";
			td1.innerHTML ='<i class="fa fa-male" ></i>' ;
		}
		else
		{
			td1.style.fontSize = "24px";
			td1.style.color = "#DF44E4";
			td1.innerHTML ='<i class="fa fa-female" ></i>' ;
		}
		tr1.append(td1);


		td1 = document.createElement('Td');
		td1.style.fontSize = "24px";
		td1.innerHTML = ReadCoureur.nom;
		tr1.append(td1);

		td1 = document.createElement('Td');
		td1.style.fontSize = "24px";
		td1.innerHTML = ReadCoureur.prenom;
		tr1.append(td1);


		td1 = document.createElement('Td');
		td1.style.fontSize = "24px";
		td1.innerHTML = ReadCoureur.date;
		tr1.append(td1);

		td1 = document.createElement('Td');
		td1.style.fontSize = "24px";
		td1.innerHTML = ReadCoureur.NomParcours;
		tr1.append(td1);

		td1 = document.createElement('Td');
		td1.style.fontSize = "24px";
		td1.innerHTML =  ReadCoureur.NomDepart;
		tr1.append(td1);

		td1 = document.createElement('Td');
		td1.style.fontSize = "24px";
		td1.innerHTML =  ReadCoureur.NomCat;
		tr1.append(td1);




		td1 = document.createElement('Td');
		ButtonDelete = document.createElement('button');
		ButtonDelete.classList.add("ButtonResultat");
		ButtonDelete.type = "button"
		ButtonDelete.style.fontSize = "24px";
		ButtonDelete.style.color = "red";
		ButtonDelete.dataset.value = IndexCoureur;
		ButtonDelete.innerHTML = "<i class='fa fa-trash-o' ></i>" ;
		ButtonDelete.addEventListener("click", function() { DeleteCoureur(this.dataset.value); } );
		td1.append(ButtonDelete);
		tr1.append(td1);
	
		TableCoureur.append(tr1);
	}
}
function DeleteCoureur(evt)
{
	console.log('DElete'+evt );
			localStorage.removeItem(evt);
			ReadLocalStorage();
}
</script>
	<?php
	  include("Header.php");
 
	  ?>

<div id="corps">
<Fieldset>
<div id="formulaire">


<form method="get"  id="FormulaireCoureur" name="FormulaireCoureur" action = "formualireInscriptionSurPlace_p2.php";>

<!-- Tableau information de la course !-->

<input type="hidden" name="idCoureur" id="idCoureur" />
	<input type="hidden" name="DateCourse" id="DateCourse"   value= '<?php echo $_GET['DateCourse'] ?>' />
	<input type="hidden" name="NomCourse" id="NomCourse"  value= '<?php echo $_GET["NomCourse"] ?>' />
	<input type="hidden" name="NumCat" id="NumCat" />
	<input type="hidden" name="NomCat" id="NomCat" />
	<input type="hidden" name="OnLine" id="OnLine" />
	<input type="hidden" name="Option" id="Option" />
	<input type="hidden"  id="NomParcours" name="NomParcours" />
	<input type="hidden"  id="NomDepart" name="NomDepart" />
	<input type="hidden" name="Nbretape" id="Nbretape" value= '<?php echo  $_GET["NbrEtape"] ?>' />
	<input type="hidden" name="sexe" id="sexe" onchange ="liste_depart(this.form,false);"  />

<!-- Tableau information du coureurs à inscrire !-->
<div id="InformationsCoureurs">
	<h3> Formulaire d'inscription sur place : <? echo  $_GET["NomCourse"] ?>
	</h3>		
		<table width="100%">
			<tr style="background:#C0C0C0;padding:20px;">

				<td style="padding: 10px;padding-left: 20px;">Nom  * :</td><td id="td_nom" style="padding:5px; Background:lightblue;"><input type="text" name="last_name" id="last_name" /></td>
			</tr>
			<tr style="height: 10px;"> 
				<td></td><td></td>
			</tr>

			<tr style="background:#C0C0C0;">
				<td style="padding: 10px;padding-left: 20px;">Prénom *  :</td><td id="td_prenom" style="padding:5px; Background:lightblue;" ><input type="text" name="prenom" id="prenom" /></td>
			</tr>
			<tr style="height: 10px;"> 
				<td></td><td></td>
			</tr>
			<tr style="background:#C0C0C0;">
				<td style="padding: 10px;padding-left: 20px;">Année de Naissance * :</td><td id="td_date" style="padding:5px; Background:lightblue;">	<input   onchange ="liste_depart(this.form,true);" type="text"  name="date" id="date"  /><i>Exemple : 1988</i></td>
			</tr>
			<tr style="height: 10px;"> 
				<td></td><td></td>
			</tr>

            <tr>
				<!-- Emplacement des coureurs trouvé -->
                <Td colspan="2" id="TableForRunnerFind">

                </td>
            </tr>
			<tr style="background:#C0C0C0;">
			<td><label style="vertical-alignement: center"  >Sexe * :</label></td>
			<td>
			<button  id= "SexeHomme" type="button" style=" font-size :24px"  onclick="SelectSexe(true)">
				<i class='fa fa-male' ></i>
</button>
			<button  id= "SexeDame" type="button" style="color : #DB02EB; font-size :24px"  onclick="SelectSexe(false)">
				<i class='fa fa-female' ></i>	
</button>
		
				
            	
          
            </td>

            </tr>

			<tr style="height: 10px;"> 
				<td></td><td></td>
			</tr>

			<tr style="background:#C0C0C0;">
				<td style="padding: 10px;padding-left: 20px;">Adresse * :</td><td id="td_adresse" style="padding:5px; Background:lightblue;">	 <input type="text" name="adresse" id="adresse"  /></td>
			</tr>
			<tr style="height: 10px;"> 
				<td></td><td></td>
			</tr>

			<tr style="background:#C0C0C0;">
				<td style="padding: 10px;padding-left: 20px;">NPA & Localité * :</td><td  id="td_zip"  style="padding:5px; Background:lightblue;">
				 <input style="width: 70px;" type="text" name="zip" id="zip" /> <input type="text" name="ville" id="ville"/></td>
			</tr>
			<tr style="height: 10px;"> 
				<td></td><td></td>
			</tr>
			<tr>
									<!-- Emplacement des coureurs trouvé -->
									<Td colspan="2" id="TableLocaliteFind"> </td>
</tr>

			<tr style="background:#C0C0C0;">
				<td style="padding: 10px;padding-left: 20px;">Pays  * :</td><td id="td_pays"  style="padding:5px; Background:lightblue;">	<input type="text" name="pays" id="pays" value="Suisse"/>	</td>
			</tr>
			<tr style="height: 10px;"> 
				<td></td><td></td>
			</tr>

			<tr style="background:#C0C0C0;">
				<td style="padding: 10px;padding-left: 20px;">Club * :</td><td id="td_club"  style="padding:5px; Background:lightblue;">	<input type="text" name="club" id="club"/></td>
			</tr>
			<tr style="height: 10px;"> 
				<td></td><td></td>
			</tr>

			<tr style="background:#C0C0C0;">
				<td style="padding: 10px;padding-left: 20px;">Adresse e-mail * :</td><td id="td_email"  style="padding:5px; Background:lightblue;">		 <input type="text" name="email" id="email" /></td>
			</tr>
			<tr style="height: 10px;"> 
				<td></td><td></td>
			</tr>


			<tr style="background:#C0C0C0;">
				<!-- Emplacement des départs trouvé -->
                <Td colspan="2" >
<table  id="TableDepartForRunner" >
</table>
                </td>
            </tr>


		</table>

		<tr >

				

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
				<td style="width: 40%;">
					Nom Equipe:
				</td>
				<td>
					 <input type="text" name="NomEquipe" id="NomEquipe" tabindex="201"    />
				</td>
			</tr>
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
</form>
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
<center>
	<input type="button" style="visibility:hidden;height:80px;font-size:30px;padding:20px;background:#FFFFFF;margin:20px;"  
	class="ButtonResultat"  id="ButtonSendFormulaire" value="Ajouter cette inscription à mon pannier" onclick="AddPersonne()"/>  </br>
</center>
	<div id="HaveAChoiceTarif"style="display:none">

		
		<?php if ($NOM_COURSE == "BCJ Challenge" )
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
	
			<p id="lblInformation" style="visibility:hidden; display:none;padding:5px; border-style: solid; border-color: black; font-size:160%;background:#fa8a8a ">Aucune catégorie existe sur ce parcours pour cette année de naissance</p>	

	 <div style="display :none;" ><label for="nom">Prix:</label> <input type="text" name="PrixDepart" id="PrixDepart" tabindex="510"  readonly  />CHF</div>
	  <center>
	  <?
			$pathReglement = '../../courses/'.$_GET['NomCourse'].$ANNEE_COURSE.'/info/Règlement.pdf';
			if (!file_exists($pathReglement))
			{
				$pathReglement = 'Règlement.pdf';
			}
	  ?>

	  	<h2>Liste de mes inscriptions </h2>
		<a id="AucuneInscription" ><i > Aucune inscriptions </i></a>
	  <table id="TableCoureur">

		</table>

		 

	
</div>
	</div>
</div>	
</div>
 <center>
 les champs avec un * sont obligatoires</br>
 </center>
   </Fieldset>

<script>

	// Chargement page , inscription au evenement pour chagnement text
	inputNom = document.getElementById("nom");
	//inputNom.addEventListener("change", SearchDatabase);

	inputPrenom = document.getElementById("prenom");
//	inputPrenom.addEventListener("change", SearchDatabase);

	inputLocalite = document.getElementById("zip");
	inputLocalite.addEventListener("change", SearchLocalite);

	var inputSexe = document.getElementById("sexe");
	var inputDame = document.getElementById("SexeDame");
	inputDame.classList.add("ButtonResultat");
	var inputHomme = document.getElementById("SexeHomme");
	inputHomme.classList.add("ButtonResultat");
	
	

	// évenement ajout colonne dans tableau
function SelectSexe(Sexe)
{
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

function SelectCoureur(e) {
	var Coureur = new Object();
		Coureur = val[e];
		document.getElementById("nom").value = Coureur.Nom;
	document.getElementById("prenom").value = Coureur.Prenom;
	document.getElementById("date").value = Coureur.DateNaissance;
	document.getElementById("adresse").value = Coureur.adresse;
	document.getElementById("email").value = Coureur.mail ;
	document.getElementById("zip").value = Coureur.npa ;
	document.getElementById("ville").value = Coureur.localite ;
	document.getElementById("club").value = Coureur.club ;
	if (Coureur.sexe == "D")
	{
		SelectSexe(false);
	}
	else
	{
		SelectSexe(true)
	}
	ListeDepartNoForm();
}

function SelectLocalite(e) {

	var Coureur = new Object();
		Coureur = val[e];
		document.getElementById("ville").value = Coureur.Localite;

}

// Recherche des localité disponible avec la base de donnée avec npa 	
function SearchLocalite(e){

 VarFieldZip = document.getElementById("zip");
	if ( VarFieldZip.value.length > 3)
{
FormValue = document.getElementById("FormulaireCoureur");
FormValue.method="get" ;
FormValue.action="ReadLocaliteSurPlace.php"

ColCoureurFind = document.getElementById("TableLocaliteFind");
table1 = document.createElement('Table');
ColCoureurFind.innerHTML = ""
ColCoureurFind.append(table1);
if ( VarFieldZip.value.length == 4)
{
	document.getElementById("pays").value = "Suisse";
}

$('FormulaireCoureur').request({
		onComplete: function(transport){
			 val =transport.responseText.evalJSON();

	
		 if (val.length == 1)
		{
			ville = document.getElementById("ville");
			ville.value = val[0].Localite;
		}
		 else
		{
			for (var j = 0; j < val.length && j < 5;j++) 
			{
				
				var Localite = new Object();
				Localite = val[j];

				if (j == 0)
				{
					ville = document.getElementById("ville");
					ville.value = Localite.Localite;
				}
				

				RowsCoureur = document.createElement('tr');
				RowsCoureur.style.background ="#00b4ff";
				RowsCoureur.dataset.value = j ;
			
				RowsCoureur.addEventListener("click", function() { SelectLocalite(this.dataset.value); } );
			

				col1 = document.createElement('td');
				col1.style.color = "white";
				col1.style.fontSize = "24px";
				console.log("Test3");
				col1.innerHTML = Localite.Localite;
				RowsCoureur.append(col1);
			
				table1.append(RowsCoureur);

			};
		}
		
	}

});
}
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


}

function isMail(txtMail)
{
	txtMail =txtMail.trim();
	document.getElementById("email").value = txtMail;

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

function check() {
  
var coureur =  new Object();
    f1 =  document.getElementById("FormulaireCoureur");

	if (f1.last_name.value.length<3) {
		alert("Merci d'indiquer votre nom");
		f1.nom.focus();
		return false;
	}
	coureur.nom = f1.last_name.value;

		if (f1.prenom.value.length<3) {
		alert("Merci d'indiquer votre prÃ©nom");
		f1.prenom.focus();
		return false;
	}
	coureur.prenom = f1.prenom.value;

		if (!isMail(f1.email.value)) {
		alert("Merci d'indiquer un mail valide pour que nous puissions vous rÃ©pondre");
		f1.email.focus();
		return false;
	}

	coureur.email = f1.email.value;



		if (f1.zip.value.length<4) {
		alert("Merci d'indiquer votre npa");
		f1.zip.focus();
		return false;
	}
	coureur.adresse = f1.adresse.value;
	coureur.zip = f1.zip.value;

			if (f1.ville.value.length<3) {
		alert("Merci d'indiquer votre localite");
		f1.ville.focus();
		return false;
	}

	coureur.ville = f1.ville.value;


		if (f1.NomDepart.value.length<1) {
		alert("Merci d'indiquer votre dÃ©part");
		f1.nom_depart.focus();
		return false;
	}

	coureur.NomDepart = f1.NomDepart.value;

	if (f1.NomParcours.value.length<1) {
		alert("Merci d'indiquer le type de votre parcours");
		f1.NomParcours.focus();
		return false;
	}
	coureur.NomCat = f1.NomCat.value;
	coureur.NumCat = f1.NumCat.value;
	coureur.NomParcours = f1.NomParcours.value;


		if (f1.date.value.length!=4) {
		alert("Merci d'indiquer votre annÃ©e de naissance ex: 1988");
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
	coureur.club = f1.club.value;
	var Cat =	document.getElementById("NomDepart");
	var tabOption = Cat.value.split(';');
	/*var DepartObj = ArrayParcours[intselected].ArrayDepart[tabOption[0]];	

	
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
		
	}*/
	/*if ( f1.nbrEtapeInsc.value.length<1  )
		 {
		alert("Merci de choisir une Option");
		f1.nbrEtapeInsc.focus();
		return false;
	}*/

	return coureur;
	//f1.submit();
}

/*********************************************************************
 * 
 * 					Function choisir départ 
 * 
 **********************************************************************/

function  ListeDepartNoForm()
{
	console.log("funChoiceDepart");
	liste_depart(document.getElementById("FormulaireCoureur",false));
}

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

	document.getElementById("HaveAChoiceCategorie").style.display="table";
	document.getElementById("NomDepart").style.backgroundColor="#FFFFFF";
	
	var e = document.getElementById("nbrEtapeInsc");
	e.options.length = 0;

	var tabOption = evt.split(';');
	var ParcoursObj = ArrayParcours[tabOption[6] ];
	var DepartObj = ParcoursObj.ArrayDepart[tabOption[0]];
		

		document.getElementById("NomDepart").value = tabOption[2] ;
		document.getElementById("NomParcours").value = tabOption[5] ;
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
		document.getElementById("ButtonSendFormulaire").style.display = "block" ;

		document.getElementById("ButtonSendFormulaire").style.visibility = "visible" ;

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
}

function addValue(Text , Value) 
{
	var sel = document.getElementById("NomParcours");
	sel.options.add( new Option(Text, Value));
 }
	

function liste_depart(f,CheckSexe) 
{
   
/* Rendre invisible les différents champs lors de l'initialisation */
	document.getElementById("lblNomEquipe").style.display  = "none" ;
	document.getElementById("Paradisc1").style.display  = "none" ;
	document.getElementById("Paradisc2").style.display  = "none" ;
	document.getElementById("Paradisc3").style.display  = "none" ;
	document.getElementById("Paradisc4").style.display  = "none" ;
	document.getElementById("ButtonSendFormulaire").style.display  = "none" ;
	document.getElementById("lblNomEquipe").style.visibility = "hidden" ;

	document.getElementById("Paradisc1").style.visibility = "hidden" ;
	document.getElementById("Paradisc2").style.visibility = "hidden" ;
	document.getElementById("Paradisc3").style.visibility = "hidden" ;
	document.getElementById("Paradisc4").style.visibility = "hidden" ;
	
	var sel = document.getElementById("NomDepart");
	var lbl = document.getElementById("lblDepart");
	var bpSend = document.getElementById("ButtonSendFormulaire");

	var bpPartenaire = document.getElementById("Partenaire");
	var ICounterCat = 0;

	if (f.date.value.length==4)
	{
        f.date.style.background = "white";
		console.log(f);
		if (f.sexe.value.length > 0)
		{
			sexe = f.sexe.value;

			var tableDepart =	document.getElementById("TableDepartForRunner");
				tableDepart.innerHTML = "";

			var RowDepart = document.createElement("tr");
				tableDepart.append(RowDepart);
			var MemDataSet = "";
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
							buttonParcours.id = iDepart +";"+iCategorie + ";"+ DepartObj.Nom + ";"+ Cat.NomCategorie._Value+ ";" + Cat.NumCategorie._Value + ";"+ ArrayParcours[iParcours].nom  + ";"+ iParcours;
							// Text infomratif sur le bouton
							buttonParcours.innerHTML = ArrayParcours[iParcours].nom   + " " +Cat.NomCategorie._Value+" "+Cat.debutAnnee._Value+" - "+Cat.finAnnee._Value;
							MemDataSet  = iDepart +";"+iCategorie + ";"+ DepartObj.Nom + ";"+ Cat.NomCategorie._Value+ ";" + Cat.NumCategorie._Value + ";"+ ArrayParcours[iParcours].nom  + ";"+ iParcours;
							buttonParcours.dataset.value = iDepart +";"+iCategorie + ";"+ DepartObj.Nom + ";"+ Cat.NomCategorie._Value+ ";" + Cat.NumCategorie._Value + ";"+ ArrayParcours[iParcours].nom  + ";"+ iParcours;
							// Infomration du départ donnée au bouton 
							buttonParcours.dataset.value = iDepart +";"+iCategorie + ";"+ DepartObj.Nom + ";"+ Cat.NomCategorie._Value+ ";" + Cat.NumCategorie._Value + ";"+ ArrayParcours[iParcours].nom  + ";"+ iParcours;


						
							buttonParcours.addEventListener("click", function() { SelectDepart(this.dataset.value); } );
							ColDepart.append(buttonParcours);
					
							ICounterCat++;
						}
					}
				
				}

			}


			var lblinfo = document.getElementById("lblInformation"); 
			if (ICounterCat == 0)
			{
				// Valeurs incorect pour ce dÃ©part 
				
				bpSend.style.visibility = "hidden" ;
				sel.style.visibility = "hidden" ;
				document.getElementById('date').style.backgroundColor="#fa8a8a";
				document.getElementById('NomParcours').style.backgroundColor="#fa8a8a";
				lblinfo.style.visibility = "visible" ;
				lblinfo.style.display  = "block" ;
				
			// ajoute le noeud texte au nouveau div crÃ©Ã©
			//	Div.value = "Aucune catÃ©gorie existe sur ce parcours pour cette annÃ©e de naissance";
			}
			else if (ICounterCat == 1)
			{
				SelectDepart( MemDataSet);
			}
			else 
			{
				
				bpSend.style.visibility = "visible" ;
				lblinfo.style.visibility = "hidden" ;
				sel.style.visibility = "visible" ;
				lblinfo.style.display  = "none" ;
				document.getElementById('date').style.backgroundColor="white";
				document.getElementById('NomParcours').style.backgroundColor="white";
			}
		}
		else if (!CheckSexe)
		{
			sel.style.visibility = "hidden" ;
			alert("Merci de choisir votre sexe");
		}
	}
	else
	{
		sel.style.visibility = "hidden" ;

			alert("Merci d'indiquer votre année de naissance ex: 1988");
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


// LEcture au démarrage de la page web
	ReadLocalStorage() ;
</script>
    <?php include("../../sponsors.php"); ?> 
</div>

</body>
</html>