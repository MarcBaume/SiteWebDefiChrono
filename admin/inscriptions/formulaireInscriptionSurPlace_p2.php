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
<form method="get" action="formulaireInscriptionSurPlace.php" id="ValueCourse" name="ValueCourse" >
<!-- Tableau information de la course !-->

	<input type="hidden" name="idCoureur" id="idCoureur" />
	<input type="hidden" name="DateCourse" id="DateCourse"   value= '<?php echo $_GET['DateCourse'] ?>' />
	<input type="hidden" name="NomCourse" id="NomCourse"  value= '<?php echo $_GET["NomCourse"] ?>' />
	<input type="hidden" name="NumCat" id="NumCat" />
	<input type="hidden" name="NomCat" id="NomCat" />
	<input type="hidden" name="OnLine" id="OnLine" />
	<input type="hidden" name="Option" id="Option" />
	<input type="hidden" name="LastAdresse" id="LastAdresse" />
	<input type="hidden" name="Nbretape" id="Nbretape" value= '<?php echo  $_GET["NbrEtape"] ?>' />

</form>
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



function AddNewInscriptionWithSameAdresse()
{
	TableCoureur = document.getElementById("LastAdresse");
	TableCoureur.value = "True";
	f1 = document.getElementById("ValueCourse");
	f1.submit();
}

function AddNewInscriptionWithoutSameAdresse()
{
	TableCoureur = document.getElementById("LastAdresse");
	TableCoureur.value = "False";
	f1 = document.getElementById("ValueCourse");
	f1.submit();
}

function ValideInscription()
{

	f1 = document.getElementById("ValueCourse");
	f1.action = "CibleInscriptionSurPlace.php";
	f1.submit();
}

function ReadLocalStorage()
{

	TableCoureur = document.getElementById("TableCoureur");
	TableCoureur.innerHTML = "";
	TableCoureur.style.width ="100%";


	// Afichage para aucun coureur inscrit 
	var para = document.getElementById("AucuneInscription");
	var para2 = document.getElementById("ValiderMesInscriptions");
	
	if (localStorage.length > 0)
	{
		para2.style.display = "";
		para.style.display = "none";
	}
	else
	{
		para2.style.display = "none";
		para.style.display = "";
	}

for (var i = 0; i < localStorage.length; i++)
	{
		IndexCoureur = localStorage.key(i);
		// Transfrome clé en objet 
		newObject = localStorage.getItem(IndexCoureur);
		//console.log(newObject);
		 var ReadCoureur = JSON.parse(newObject);
		console.log(ReadCoureur);


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
		td1.innerHTML =   ReadCoureur.NomDepart;
		tr1.append(td1);

		td1 = document.createElement('Td');
		td1.style.fontSize = "24px";
		td1.innerHTML =   ReadCoureur.NomCat;
		tr1.append(td1);

		td1 = document.createElement('Td');
		td1.style.fontSize = "16px";
		td1.innerHTML =   ReadCoureur.club;
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
	  include("../../Header2023.php");
 
	  ?>

<div id="corps">
<Fieldset>

	
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

	  	<h2>Liste de mes inscriptions </h2>
		<a id="AucuneInscription" ><i > Aucune inscription </i></a>
	<table id="TableCoureur"  >

	</table>
	
	
		<table >
		<tr style="width: 50%" >
			<td  id="ValiderMesInscriptions">
				<Button class="ButtonResultat"  style="width: 80%; Height : 160px ; font-size:24px; margin :20px; padding :20px;" onclick="ValideInscription()">
					<table>
						<tr>
							<td>
							<i class="fa fa-check-circle" style=" font-size:48px;" ></i>
							</td>
							<td>
							Valider mes inscriptions
							</td>
						</tr>
					</table>
				</Button>
			</td>
			<td>
			<table>
				<tr>
					<td>
						<Button class="ButtonResultat"  style="width: 80% ;Height : 120px ;font-size:24px; margin :20px; padding :20px;" onclick="AddNewInscriptionWithSameAdresse()">
						<table>
							<tr>
								<td>
								<i class="fa fa-plus-circle" style=" font-size:48px;" ></i>
								</td>
					
								<td>
									Ajout inscription avec la même adresse
								</td>
							</tr>
						</table>
						</Button>
					</td>
				</tr>
				<tr>
					<td>
						<Button class="ButtonResultat" style="width: 80% ;Height : 120px ; font-size:24px; margin :20px; padding :20px;" onclick="AddNewInscriptionWithoutSameAdresse()">
						<table>
							<tr>
								<td>
								<i class="fa fa-plus-circle" style=" font-size:48px;" ></i>
								</td>
								<td>
									Ajout inscription avec une adresse différente
								</td>
							</tr>
						</table>
						</Button>
					</td>
				</tr>
				</table>
			</td>
		</tr>
		</table>
		
	
		</form>	


   </Fieldset>

<script>
// LEcture au démarrage de la page web
	ReadLocalStorage() ;
</script>
 
</div>

</body>
</html>