<!DOCTYPE html>
<html>
<head>
	<meta property="og:description" content="chronométrage, chrono, jura, franches-montagnes, Jura défi, course à pied, Sport, Jura défi chrono" />  
	<title>Défi Chrono</title>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, maximum-scale=1.0, user-scalable=yes">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css">
	<link rel="stylesheet" title="defaut" media="screen" href="../styleV4.css" type="text/css"/>
	 <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js">
	 </script>
	 <script type="text/javascript" src="https://media.payrexx.com/modal/v1/modal.min.js"></script>
 <script src="../js/prototype.js" >

</script>
<script>

var LoginLight = "";
var OrderId = "";
var Login = "";	
var linkAccept = "";
function ValidationTemps(f1)
{
	if ( f1.Discipline.value.length<1) {
		alert("Merci d'inqdiquer la discipline éffectuée");
		f1.PrenomDisc6.focus();
		return false;
	}
		
	if ( f1.Link.value.length<1  ) {
		alert("Merci d'inscrire le liens internet de votre activité");
		f1.Link.focus();
		return false;
	}

	if ( f1.Temps.value.length<3  ) {
		alert("Merci d'indiquer un temps valable à votre activité");
		f1.nbrEtapeInsc.focus();
		return false;
	}	
	f1.submit();
}
function ClickRows(event, id)
{  
	if (	document.getElementById("Infos"+id).style.visibility == "visible")
	{
		//	document.getElementById("RowRace"+id).style.backgroundColor = "#ffffff" ;
		document.getElementById("Infos"+id).style.visibility = "collapse" ;
		document.getElementById("IconsMinus"+id).style.visibility = "collapse" ;
		document.getElementById("Icons"+id).style.visibility = "visible" ;
	}
	else
	{
		//	document.getElementById("RowRace"+id).style.backgroundColor = "#c9efff" ;
		document.getElementById("Infos"+id).style.visibility = "visible" ;
		document.getElementById("IconsMinus"+id).style.visibility = "visible" ;
		document.getElementById("Icons"+id).style.visibility = "collapse" ;
	}
	event.stopPropagation(); 	
}


	</script>
 </head>
 <body>

<?php
   include("HeaderAdmin.php"); 
?>
</br>
<?	include("MenuMember.php"); ?>
<div id="corps">


<?php 
	$name = "2019ChronoMarc$_Test2$";


if ( isset($_SESSION['Login']))
{
	$con = mysqli_connect('dxvv.myd.infomaniak.com', 'dxvv_christopheJ', 'er3z4aet1234');
	mysqli_select_db($con ,'dxvv_jurachrono' );
// CODE ORDER ID
$LoginLight =substr($_SESSION['Login'], 0 ,   strpos($_SESSION['Login'], "@") ) ;
/************************* POUR TEST *****************************/
$OrderID = $LoginLight. date("YmdHis");
$RaceJD = 'JuraDéfi2021';



$sql2 = 'SELECT * FROM inscription  WHERE Login=\''.$_SESSION['Login'].'\' AND course=\''.$RaceJD.'\''; 
	
	//echo $sql;
	$result2 = mysqli_query($con,$sql2);

 	if ($result2 && mysqli_num_rows($result2) > 0) 
	{
		while($val2 = mysqli_fetch_assoc($result2)) 
		{
			if (strlen($val2['NomEquipe'] )> 0)
			{
				$NomEquipe = $val2['NomEquipe'] ;
				$TitleEquipe = "JuraDéfi 2021 Saisie votre résultat pour l'équipe : ".$val2['NomEquipe'] ;
			}
			else
			{
				$NomEquipe =$val2['Nom']. ' '. $val2['Prenom'];
				$TitleEquipe = "JuraDéfi 2021 Saisie votre résultat indivuduel pour : " .$val2['Nom']. ' '. $val2['Prenom'];
			}
?>
	<h3  class="title1"> <?php  echo $TitleEquipe ?> </h3>
	<div id="formulaire">
<form method="post" action="cibleAddResultatJD.php">
<input type="hidden" name="NomEquipe" style="display :none;"  value= '<?php echo $NomEquipe ?>' />
<input type="hidden" name="IDEquipe"  style="display :none;"  value= '<?php echo $val2['ID'] ?>' />
<input type="hidden" name="LoginCompte" id="LoginCompte" style="display :none;"   value= '<?php echo $_SESSION['Login'] ?>' />
<p >

<label for="lblDiscipline">Discipline *:</label><select  id="Discipline" name="Discipline" >
				<Option value="">Sélectionner</option>
				<Option value="Roller">Roller</option>
				<Option value="Course">Course</option>
				<Option value="VéloDeRoute">Vélo de route</option>
				<Option value="VTT">VTT</option>
			</select></p>
			<p><label for="Temps">Chrono (HH:MM:SS)*:</label> <input type="text" name="Temps" id="Temps"tabindex="70" 	style="width:400px"  /></p>
		<p><label for="club">Liens activité*:</label> <input type="text" name="Link" id="Link"tabindex="90" 	style="width:400px"  /></p>
		<p><label for="Lblcommentaire">Commentaire:</label><textarea name="Commentaire" id="Commentaire"tabindex="120" 	style="width:400px"></textarea></p>
	<center>
		<input type="button" style="height:30px;font-size:80%; width: 200px;"  id="ButtonSend" value="Envoyer votre chrono" onclick="ValidationTemps(this.form)" > 
		</center>
	</form>

		</div>
		<H3> Vos chrono qui ont été enregistré pour JuraDéfi 2021 </h3>
		<div  id="TableauResulat">
<?
			$sql3 = 'SELECT * FROM TempsJuraDefi2021  WHERE NomEquipe=\''.$NomEquipe.'\''; 
				
			//echo $sql;
			$result3 = mysqli_query($con,$sql3);

			if ($result3 && mysqli_num_rows($result3) > 0) 
			{
				?>
				<Table>
				<tr>
				<th> discipline </th>
				<th> chrono </th>
				<th> statuts </th>
				</tr>
				<?
				while($val3 = mysqli_fetch_assoc($result3)) 
				{?>
					<tr>
					<td> <?php echo $val3['Discipline'] ?> </td>
					<td> <?php echo $val3['Chrono'] ?> </td>
					<td> <?php echo $val3['Status'] ?> </td>
					</tr><?
				}?>
				</table><?
			}
		}
	}?>

<script>
	Login = 	<?php echo json_encode($_SESSION["Login"]); ?>;
	</script>
	<h3  class="title1"> <?php  echo"Vos Résultats : ". $_SESSION['Login'] ?> </h3>
	</br> 
	

	
	<?php
	$sql = 'SELECT * FROM Membres  WHERE LoginCompte=\''.$_SESSION['Login'].'\''; 
	//echo $sql;
	$result = mysqli_query($con,$sql);
	$Aff = 0;
 	if ($result && mysqli_num_rows($result) > 0) 
	{
    // output data of each row 
	?>
		<Script>
				var ArrayCoureurs = [];
		</script>
		<?

		while($val = mysqli_fetch_assoc($result)) 
		{
			if ($val ["Valider"])
			{
				?>
				<Script>
				 var Coureur = new Object();
				 Coureur.Nom = <?php echo json_encode($val["Nom"]); ?>;
				 Coureur.Prenom = <?php echo json_encode($val["Prenom"]); ?>;
				 var ArrayCourse = [];
				 Coureur.ArrayCourse = ArrayCourse;
				</script>
				<?
				$Aff = $Aff+1 ;
				
				$sql = 'SELECT * FROM Resultat  WHERE Nom=\''.$val["Nom"].'\' 
				AND Prenom=\''. $val ["Prenom"].'\'
				AND Annee=\''. date("Y", strtotime($val ["DateNaissance"])).'\'';
			
				$result2 = mysqli_query($con,$sql);
				
				// Si résultat pour cette personne trouvé
				if ($result2 && mysqli_num_rows($result2) > 0) 
				{
					$Background = 0;
					// Affiches Chaque donnée de résultat Trouvé
					while($donnees = mysqli_fetch_assoc($result2)) 
					{?>
						<script>
						var Course = new Object();
						var	Resultat = new Object();
						var	CourseAnnee = new Object();
						var Etape = new Object();
						var ArrayAnnee = [];
						var ArrayResultat = [];
						var ArrayEtape = [];
						
						var NomCourse = <?php echo json_encode($donnees['Course']); ?>;
						var NomEtape =<?php echo json_encode($donnees['Etape']); ?>;
						var ValueAnnee =  NomCourse.slice(NomCourse.length-4);
						NomCourse = NomCourse.slice(0,NomCourse.length-4);
							
						// Ajout résultat a la course					
						Resultat.Nom = <?php echo json_encode($donnees['Nom']); ?>;
						Resultat.Prenom =  <?php echo json_encode($donnees['Prenom']); ?>;
						Resultat.Place = <?php echo json_encode($donnees['Place']); ?>;
						Resultat.Temps =<?php echo json_encode($donnees['Temps']); ?>;
						Resultat.Ecart =<?php echo json_encode($donnees['Ecart']); ?>;
						Resultat.Type =<?php echo json_encode($donnees['Type']); ?>;
						
						// Verification si Course existe déjà dans tableau
						var FindCourse = false;
						for (i = 0; i < ArrayCourse.length; i++) 
						{
							if (ArrayCourse[i].Nom ==  NomCourse)
							{
								Course = ArrayCourse[i];
								FindCourse = true;
								break;
							}
						}
						
						// Si course pas trouver création d'une nouvelle.
						if (!FindCourse)
						{
							Course.Nom = NomCourse;
				
							// Création d'une nouvelle année de la course
							CourseAnnee.ArrayEtape = ArrayEtape;
						
							// Création d'une étape de base
							Etape.ArrayResultat = ArrayResultat;
							Etape.Nom = NomEtape;
							
							
							CourseAnnee.Nom = ValueAnnee;
							CourseAnnee.ArrayEtape.push(Etape);
			
							ArrayAnnee.push(CourseAnnee);
							
							// Creation tableau année pour une course
							Course.ArrayAnnee = ArrayAnnee;
							// Ajout de la course à la lsit des courses
							ArrayCourse.push(Course);
						}
						else
						{
							// Recherche si année déjà existante pour cette course
						
							var FindAnnee = false;
							for (h = 0; h < Course.ArrayAnnee.length; h++) 
							{
								if (Course.ArrayAnnee[h].Nom ==  ValueAnnee)
								{
									CourseAnnee = Course.ArrayAnnee[h];
									// Recherche si Etape déjà existante pour cette course
									var FindEtape = false;
									for (z = 0; z < Course.ArrayAnnee[h].ArrayEtape.length; z++) 
									{
										if (Course.ArrayAnnee[h].ArrayEtape[z].Nom ==  NomEtape)
										{
											FindEtape = true;
											Etape = Course.ArrayAnnee[h].ArrayEtape[z];
											break;
										}
									}
									FindAnnee = true;
									break;
								}
							}
							// Si Résultats n'est dans aucune année existante , création de l'année
							if (!FindAnnee)
							{

								// Création d'une nouvelle année de la course
								Etape.ArrayResultat = ArrayResultat;
								Etape.Nom = NomEtape;
					
								CourseAnnee.Nom = ValueAnnee;
								CourseAnnee.ArrayEtape.push(Etape);
								
								Course.ArrayAnnee.push(CourseAnnee);
								
							}
							// Si Résultats n'est dans aucune étape existante , ajout de l'étape
							else if (!FindEtape)
							{
								Etape.ArrayResultat = ArrayResultat;
								Etape.Nom =NomEtape;
								CourseAnnee.ArrayEtape.push(Etape);
								
							}
						}
						
						// Ajout du résultat a l'année
						Etape.ArrayResultat.push(Resultat);
						
						</script>
							<?php		
					}
		

					?>
					<Script>
				
					ArrayCoureurs.push(Coureur);
					</script>
					<?php
						
				}

			}
		}
		?>
		<script>
		console.log(ArrayCoureurs);
		let b = document.body;
		for (i = 0; i < ArrayCoureurs.length; i++) 
		{
			/* Div Coureur */
			let CoureurPara  = document.createElement('div');
			
			/* Titre Para */
			let TitlePara  = document.createElement('h3');
			TitlePara.innerHTML = "Résultats de " + ArrayCoureurs[i].Nom + " " + ArrayCoureurs[i].Prenom; 
			CoureurPara.append(TitlePara);
	
			for (m = 0; m < ArrayCoureurs[i].ArrayCourse.length; m++) 
			{

				/* Paragraphe Course */
				let ParaCourse  = document.createElement('p');
				ParaCourse.innerHTML ="Course : "+ ArrayCoureurs[i].ArrayCourse[m].Nom;
				CoureurPara.append(ParaCourse);

				let TableCourse  = document.createElement('table');
				TableCourse.style.width = "70%"; 				
											
				for (l = 0; l < ArrayCoureurs[i].ArrayCourse[m].ArrayAnnee.length; l++) 
				{
					let RowTitleTableCourse  = document.createElement('tr');
					
					let ColAnnee = document.createElement('td');
					ColAnnee.innerHTML = ArrayCoureurs[i].ArrayCourse[m].ArrayAnnee[l].Nom;					
					RowTitleTableCourse.append(ColAnnee );
					TableCourse.append(RowTitleTableCourse);
					
					// Colonne étape
					let ColEtape = document.createElement('td');
					let TableEtape  = document.createElement('table');
					ColEtape.append(TableEtape);
					RowTitleTableCourse.append(ColEtape);
					
					for (y = 0; y < ArrayCoureurs[i].ArrayCourse[m].ArrayAnnee[l].ArrayEtape.length; y++) 
					{
				
						
						// Première étape de la l'édition 
						if (y==0)
						{
							let RowTitleEtape  = document.createElement('tr');
							let ColTitleEtape = document.createElement('th');
								ColTitleEtape.innerHTML = "Etape";
								RowTitleEtape.append(ColTitleEtape);
								
							let ColTitleTableResultat = document.createElement('th');
								ColTitleTableResultat.innerHTML = "";
								RowTitleEtape.append(ColTitleTableResultat);
								TableEtape.append(RowTitleEtape);
						}
						
						// Nouvelle ligne par étape
						let RowEtape  = document.createElement('tr');
						TableEtape.append(RowEtape);
						
						// Colonne Titre etape 
						let ColEtape = document.createElement('td');
						ColEtape.innerHTML = ArrayCoureurs[i].ArrayCourse[m].ArrayAnnee[l].ArrayEtape[y].Nom;					
						RowEtape.append(ColEtape );
					
						// Colonne tableau Résultat
						let ColResultat = document.createElement('td');
						RowEtape.append(ColResultat);
						
						let TableResultat  = document.createElement('table');
						ColResultat.append(TableResultat);
						
						
						for (j = 0; j < ArrayCoureurs[i].ArrayCourse[m].ArrayAnnee[l].ArrayEtape[y].ArrayResultat.length; j++) 
						{
							
							let RowResultat  = document.createElement('tr');
							/* Si premier résultat*/
							if (j==0)
							{
								ColTable = document.createElement('th');
								ColTable.innerHTML = "Place";
								RowResultat.append(ColTable);
								
								ColTable = document.createElement('th');
								ColTable.innerHTML = "Catégorie";
								RowResultat.append(ColTable);
							
								
								ColTable = document.createElement('th');
								ColTable.innerHTML = "Temps";
								RowResultat.append(ColTable);
						
								
								ColTable = document.createElement('th');
								ColTable.innerHTML = "Ecart";
								RowResultat.append(ColTable);
								
								TableResultat.append(RowResultat);
								
							}
							/* Resultat de la course */
							let RowResultat1  = document.createElement('tr');
							
							ColTableResultat1 = document.createElement('td');
							ColTableResultat1.innerHTML = ArrayCoureurs[i].ArrayCourse[m].ArrayAnnee[l].ArrayEtape[y].ArrayResultat[j].Place;
							RowResultat1.append(ColTableResultat1);
							
							ColTableResultat1 = document.createElement('td');
							ColTableResultat1.innerHTML = ArrayCoureurs[i].ArrayCourse[m].ArrayAnnee[l].ArrayEtape[y].ArrayResultat[j].Type;
							RowResultat1.append(ColTableResultat1);
							
							ColTableResultat1 = document.createElement('td');
							ColTableResultat1.innerHTML = ArrayCoureurs[i].ArrayCourse[m].ArrayAnnee[l].ArrayEtape[y].ArrayResultat[j].Temps;
							RowResultat1.append(ColTableResultat1);
							
							ColTableResultat1 = document.createElement('td');
							ColTableResultat1.innerHTML = ArrayCoureurs[i].ArrayCourse[m].ArrayAnnee[l].ArrayEtape[y].ArrayResultat[j].Ecart;
							RowResultat1.append(ColTableResultat1);

							TableResultat.append(RowResultat1);
						}
					}
				}
				CoureurPara.append(TableCourse);
			}
			
			b.append(CoureurPara);
		}


		</script>
<?
	}
}
else
{?>
	<i>Veuillez vous connecter </i>  </br></br>
<?php
}
?>

</div>
 
</div>

</body>
</html>
