<!DOCTYPE html>
<html>

<head>
	<meta property="og:description" content="chronométrage, chrono, jura, franches-montagnes, Jura défi, course à pied, Sport, Jura défi chrono" />  
	<title>Défi Chrono</title>
	<meta charset="utf-8">
		<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Rubik">
	<meta name="viewport" content="width=device-width, maximum-scale=1.0, user-scalable=yes">
	<metahttp-equiv = 'cache-control' content = 'no-cache'>
	<metahttp-equiv = 'expires' content = '0'>
	<metahttp-equiv = 'pragma' content = 'no-cache'>
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css">
	<link rel="stylesheet" title="defaut" media="screen" href="css/style.css" type="text/css"/>
	<!-- Import Leaflet CSS Style Sheet -->
<link rel="stylesheet" href="https://unpkg.com/leaflet@1.0.3/dist/leaflet.css" />

<!-- Import Leaflet JS Library -->
<script src="https://unpkg.com/leaflet@1.0.3/dist/leaflet.js"></script>
<script src="../js/prototype.js" ></script>
<script src="../js/FonctionDefiChrono2.js?version = 1.0.0"></script>
<script>
	var DecalageStartWidth = 50; // Valeur de décalage du commencement du graphique en horizontal
	var DecalageStartHeight = 50; // Valeur de décalage du commencement du graphique en vertical
	var Width  = screen.width -200; // 1300
	if (Width > 800)
	{
		Width = 800
	}
	var Height = (Width /100) *18;

	function LogoEtape(IDButton, Etape)
	{
		IconeEtape = document.getElementById(IDButton);
		IconeEtape.style.fontSize = "25px";
		IconeEtape.style.margin = "5px";
		// Seulemetn le jour de l'étape
		var DateEtape= new Date(Etape.Date._Value);
		// Heure et live
		var DateHeureEtape= new Date(Etape.Date._Value + " "+ Etape.HeureDepart._Value);
		// Date en cours
		var DateNow = new Date(Date.now());

		console.log("etape" +DateEtape.getTime().toString() );
		console.log("étape heure" +DateHeureEtape.getTime().toString() );
		console.log("now" +DateNow.getTime().toString()); 
		// Jour après l'étape
		if (DateNow.getTime() > (DateEtape.getTime()+ (60*60*24) * 1000 ))
		{
			IconeEtape.classList.add("fa","fa-trophy");
		
	
		}
		// Live en cours
		else if (DateNow.getTime() > DateHeureEtape.getTime() && Etape.HeureEnd._Value.length <1 )
		{
			IconeEtape.classList.add("fa", "fa-spinner" ,"fa-spin");
			
			

		}
		// Next étape
		else
		{
			IconeEtape.classList.add("fa" ,"fa-forward");
	
		
		}
						
	}
	</script>
<Body>
<div id="Top1"></div>
        <a href="#Top1" id="GoToTop" class="GoToTop" style ="visibility :hidden ;z-index:3000;" >
    <i class="fa fa-arrow-up" style= "font-size: 50px;margin:2px;"></i>
</a>

<?php


	  include("Header2023.php"); 
	  include("HeaderInfo2023_WithoutCouverture.php"); 
	

	$indexParcoursSelected= $_GET['Parcours'];
	$indexDepartSelected = $_GET['Depart'];
	$Etape = $_GET['Etape'];
	$Classement = $_GET['Classement'];
	if ($Etape ==0)
	{
		$Etape =1 ;
	}
	
	  if ($NOM_COURSE =='Jura Défi'  )
	{
		header('Location: Resultat2023GeneralJuraDefi.php?NbrEtape='.$Nbr_etape.'&Etape='.$_GET['Etape'].'&DateCourse='.$DateCourse.'&NomCourse='.$NOM_COURSE.'&Parcours='.$_GET['Parcours'].''.'&Depart='.$_GET['Depart'].''); 
	
	}
	  ?>

	<form method="get" action="Resultat2023.php" id="FormSendIndfo">
		<input type="hidden" name="DateCourse" id="DateCourse" tabindex="10"  size="60"  value= '<?php echo $_GET["DateCourse"] ?>' />
		<input type="hidden" name="NomCourse" id="FormNomCourse" tabindex="10"  size="60"  value= '<?php echo $_GET["NomCourse"] ?>' />
		<input type="hidden" name="NbrEtape" id="FormNbrEtape" tabindex="10"  size="60"  value= '<?php echo $_GET["NbrEtape"] ?>' />
		<input type="hidden" name="Depart" id="FormDepart" tabindex="10"  size="60"  value= '<?php echo $indexDepartSelected ?>' />
		<input type="hidden" name="Parcours" id="FormParcours" tabindex="10"  size="60" value= '<?php echo $indexParcoursSelected ?>'/>
		<input type="hidden" name="PointPassage" id="FormPointPassage" tabindex="10"  size="60"  value= '<?php echo $_GET["PointPassage"]?>' />
		<input type="hidden" name="TypeClassement" id="FormTypeClassement" tabindex="10"  size="60"  value= '<?php echo $_GET["TypeClassement"]?>'/>
		<input type="hidden" name="NomClassement" id="FormNomClassement" tabindex="10"  size="60"  value= '<?php echo $_GET["NomClassement"]?>' />
		<input type="hidden" name="Etape" id="FormEtape" tabindex="10"  size="60"  value= '<?php echo $Etape ?>' />
	</form>
<?php 
$row = 1;
$start_array = false;
$numetape = intval($_GET['Etape']);
// Afficher la liste des départ Dossier dans la course ;
$pathfolder = 'courses/'.$_GET['NomCourse'].$ANNEE_COURSE;

// Création de la liste de toutes les Dossier = Depart 
$files1 = scandir($pathfolder);

$arParcours = array();
$arDepart = array();
$arEtape = array();

// Calcul du nombre de parcours
foreach ($files1  as $key => $value) 
{ 
   if(is_dir($pathfolder .'/'.$value))
   {
		// Affichage dans la liste des départ dans le menu 
		if (strlen($value) >2 && $value != "info") 
		{		
			$arParcours[] =  $value;
			$ParcoursTampon = $value;
		}		
	}
}

/***************************** Parcours ************************************/
// SI il y plus que 1 parcours affichage d'un menu pour le choix du départ
if (count($arParcours) > 1)
{?>
	<fieldset class="fieldsetResultat">
		<Legend  class="LegendResultat">
			Parcours
		</Legend>
		<select  onchange='ChangParcours(this);' id="SelectParcours" >
			<option value="0" >Sélectionne un parcours</option><?
			foreach($arParcours as $Parcours1)
			{
				$IndexParcours++;
				if ($indexParcoursSelected != $IndexParcours)
				{ ?>		
					<option value=<?php echo $IndexParcours?>><? echo $Parcours1 ?></option>
				<?
				}
				else
				{
					?>
					<script>
						console.log("Parcours Find")
					</script><?
					$Parcours =  $Parcours1?>
					<option selected value=<?php echo $IndexParcours?>><? echo $Parcours1 ?></option>
				<?
				}
			}?>
		</select>
	</fieldset>
	<? 
	// Acun parcours sélectionné
	if ($indexParcoursSelected == 0)
	{?>
		
		<?php include("sponsors2023.php"); ?> 
	<?	
	}
}
else
{
	$Parcours =  $arParcours[0];
	$indexParcoursSelected = 1;
}

/***************************** Depart ************************************/
/* Actualiser lors de chaque changement de parcours
/* DEPART avec Parcours sélectionné ************************************/

if ($indexParcoursSelected > 0)
{?>
	<script>
		console.log("Parcours")
	</script>
	<?
	// Afficher la liste des départ Dossier dans la course ;
	$pathfolder = 'courses/'.$_GET['NomCourse'].$ANNEE_COURSE.'/'.$arParcours[$indexParcoursSelected-1];
	// Création de la liste de toutes les Dossier = Depart 
	$files1 = scandir($pathfolder);
	
	foreach ($files1  as $key => $value) 
	{ 
	   if(is_dir($pathfolder .'/'.$value))
	   { 
			// Affichage dans la liste des départ dans le menu 
			if (strlen($value) >2 && $value != "info") 
			{
				$arDepart[] =  $value;
			}		
		}
	}
	// SI il y plus que 1 départ affichage d'un menu pour le choix du départ
	if (count($arDepart) > 1)
	{?>
		<script>
			console.log("Departs");
		</script>
		<fieldset class="fieldsetResultat">
			<Legend  class="LegendResultat">
				Départ
			</Legend>

			<select onchange='ChangDepart(this);'  id="SelectDepart"   style="cursor: pointer;" > 
			<option value="0" >Sélectionne un départs</option><?
			
			foreach($arDepart as $Depart1)
			{
				$IndexDep++;
				if ($indexDepartSelected != $IndexDep)
				{ ?>
					<option  value=<?php echo $IndexDep?> >	<? echo $Depart1 ?></option>
				<?
				}
				else
				{ 
					$Depart =  $Depart1
				?>
					<option selected value=<?php echo $IndexDep?> >	<? echo $Depart1 ?></option>
				<?
				}
				
			}?>
			</select>	
			<? if ($indexDepartSelected == 0)
			{?>
				<?php include("sponsors2023.php"); ?> 
			<?	
			}?>
		</fieldset>
	<?php
	}
	else
	{
		$Depart =  $arDepart[0];
		// si il y a que un départ ;
		$indexDepartSelected  = 1;
	}
}

/***************************** Etape ************************************/
/* Actualiser lors de chaque changement de départ
/* Etape avec Parcours sélectionné ************************************/

if ($indexParcoursSelected != null && $indexDepartSelected != null && $indexDepartSelected > 0 && $indexParcoursSelected  > 0 )
{
	// Afficher la liste des départ Dossier dans la course ;
	$pathfolder = 'courses/'.$_GET['NomCourse'].$ANNEE_COURSE.'/'.$arParcours[$indexParcoursSelected-1].'/'.$arDepart[$indexDepartSelected-1];
	// Création de la liste de toutes les Dossier = Depart 
	$files1 = scandir($pathfolder);
	foreach ($files1  as $key => $value) 
	{ 
	   if(is_dir($pathfolder .'/'.$value))
	   { 
			// Affichage dans la liste des départ dans le menu 
			if (strlen($value) >2 && $value != "info" && $value != "images") 
			{
				$arEtape[] =  $value;
				$EtapeTampon = $value;
			}		
		}
	}
	// SI il y plus que 1 étape affichage d'un menu pour le choix du départ
	if (count($arEtape) > 1)
	{?>							
		<fieldset class="fieldsetResultat">
			<Legend  class="LegendResultat">
				<i class="fa fa-trophy" style= "fontSize: 25px;margin:5px;"></i>étape
			</Legend>
			<select  onchange='ChangEtape(this);' id="SelectEtape"   style="cursor: pointer;">
			<? 
			$IndexDep = 0;
			// Affichage du bouton de la liste des étapes
			foreach($arEtape as $Etape1)
			{
			// Obtention des informations de chaque étape
				if ($Etape1 == "General")
				{
					$IndexDep=99;
					if ($Etape == 99)
					{
							?>
					<option selected value=99> <? 	echo 'Général'?>
					</option><?
					}
					else
					{?>
					<option value=99> <? 	echo 'Général'?>
					</option><?
					}
				}
				else
				{?>
					
					<script>
						console.log("Read info" + <?php echo json_encode($pathfolder.'//'.$Etape1)?>);
						Etape =  readJSON(<?php  echo json_encode($pathfolder.'//'.$Etape1)?>+ "//info.json");
					</script><?
					$IndexDep++;
					if ($Etape != $IndexDep)
					{?>
						<option  value=<?php echo $IndexDep?>> <? 	echo 'Etape '. $IndexDep .' '?><script> document.write(Etape.Lieu._Value)</script>
						</option>
					<?
					}
					else
					{  ?>
						<option selected value=<?php echo $IndexDep?>> <? 	echo 'Etape '. $IndexDep .' '?><script> document.write(Etape.Lieu._Value)</script>
						</option>
					<?
					}?>
					<?
				}
			}
			?>
		</select>
		</fieldset><?
	}
	else
	{
		// si il y a que un départ ;
		$Etape ="1";
	}
}?>
<div id="ViewAllEtapes">
</div>
</div>
<div id="ViewGraphique">
</div>
<!--<div   class="menu_vertical" style="margin-bottom:5px;" id="Allpointpassage">
</div>-->
<!--  Scratch , sexe , catégorie -->
<div   class="menu_vertical" style="margin-bottom:5px;" id="TypeClassement">
</div>
<!--  Home femme , Nom Catergorie  -->
<div   class="menu_vertical" style="margin-bottom:5px;" id="NomClassement">
</div>
<form>
	<Table style="margin:10px ;width:100%">
		<tr>
			<td>
			<i style='font-size:24px;margin-right:5px' class='fa fa-search'></i>
		<input type="text" id="InputSearch" style="font-size:24px;padding:5px;width:50%" onkeyup="valider()" placeholder="Nom / prénom / dossard recherché..."\>
	</td>
	
	</tr>
	</table>
	</form>
	<p id="Informations" style="display:none"></p>

<div id="ViewLiveCoureur">
</div>
<script>	

	function AddButtonTypeResultatGeneral()
	{
		console.log("Add Button type resultat General");
		DivTypeClassement= document.getElementById('TypeClassement');
		console.log(DivTypeClassement);
		// Affichage du bouton de chaque type de classement proposé par ce point de passage 
		const buttonTypeClassement = document.createElement('button');
		if (FormTypeClassement.value == "Categorie" )
		{
			buttonTypeClassement.classList.add("ButtonResultatSelected");
		}
		else
		{
			buttonTypeClassement.classList.add("ButtonResultat");
		}
		
		buttonTypeClassement.innerHTML = "<b>Catégorie</b>" ;
		DivTypeClassement.appendChild(buttonTypeClassement);

		// évenement ajout colonne dans tableau
		buttonTypeClassement.addEventListener("click", function()
		{
		// Quand on sélectionne la point de passage on signal au formulaire que le point est sélectionné
		var FormSendIndfo= document.getElementById('FormSendIndfo');
			FormTypeClassement.value = "Categorie";
			FormSendIndfo.submit();
		}, false);



		buttonTypeClassement2 = document.createElement('button');
		if (FormTypeClassement.value == "Sexe" )
		{
			buttonTypeClassement2.classList.add("ButtonResultatSelected");
		}
		else
		{
			buttonTypeClassement2.classList.add("ButtonResultat");
		}
		buttonTypeClassement2.style.fontSize= "20px";
		buttonTypeClassement2.innerHTML = "<i class='fa fa-male' ></i><i class='fa fa-female'></i>" ;
		DivTypeClassement.appendChild(buttonTypeClassement2);
		// évenement ajout colonne dans tableau
		buttonTypeClassement2.addEventListener("click", function()
		{
		// Quand on sélectionne la point de passage on signal au formulaire que le point est sélectionné
		var FormSendIndfo= document.getElementById('FormSendIndfo');
			FormTypeClassement.value = "Sexe";
			FormSendIndfo.submit();
		}, false);

		buttonTypeClassement3 = document.createElement('button');
		if (FormTypeClassement.value == "Scratch"  )
		{
			buttonTypeClassement3.classList.add("ButtonResultatSelected");
		}
		else
		{
			buttonTypeClassement3.classList.add("ButtonResultat");
		}
		buttonTypeClassement3.innerHTML = "<b>Scratch</b>" ;
		DivTypeClassement.appendChild(buttonTypeClassement3);
		// évenement ajout colonne dans tableau
		buttonTypeClassement3.addEventListener("click", function()
		{
		// Quand on sélectionne la point de passage on signal au formulaire que le point est sélectionné
		var FormSendIndfo= document.getElementById('FormSendIndfo');
			FormTypeClassement.value = "Scratch";
			FormSendIndfo.submit();
		}, false);

		// Si aucun type de classement est détectée, scratch = valeur par défaut
		if (FormTypeClassement.value == null ||  FormTypeClassement.value == "")
		{
			var FormSendIndfo= document.getElementById('FormSendIndfo');
			FormTypeClassement.value = "Scratch";
		//	FormSendIndfo.submit();
		}
	}

		function ListCoureurLiveToTableGeneral( ListCoureurs)
		{
			// Trie selon le type de classement ( Scratch , Categorie , Sexe)
			var FormTypeClassement= document.getElementById('FormTypeClassement');
			console.log("Type");
			var DivViewLiveCoureur= document.getElementById('ViewLiveCoureur');
	
			// SI le fichier est de type classement extern 
			if (FormTypeClassement.value.includes("File") )
			{
				console.log("File");
			
			}
			else
			{
				console.log("json");
				// Affichage Titre point de passage et  nombre de coureur arrivée au point de passage
				const Title = document.createElement("p");


				DivViewLiveCoureur.appendChild(Title);

				
				if (ListCoureurs.length < 1)
				{
			
					const a = document.createElement("a");
					a.innerHTML = "aucun coureur arrivée" ;
					DivViewLiveCoureur.appendChild(a);
				}
				else
				{

					var FormNomClassement= document.getElementById('FormNomClassement');
				
					if (FormTypeClassement.value == "Sexe" )
					{
						ListCoureurs.sort((a,b) => a.Coureur.Sexe._Value < b.Coureur.Sexe._Value  ? -1 : 1);
					}
					else 	if (FormTypeClassement.value == "Categorie" )
					{
						ListCoureurs.sort((a,b) => a.Coureur.Categorie.NumCategorie._Value < b.Coureur.Categorie.NumCategorie._Value  ? -1 : 1);
					}

				

					// Affichage du classement seulement si il est de type scratch ou si on a choisie un nom de classement

					// Table du classement sélectionné 
					const TableResult = document.createElement("Table");
					TableResult.id = "TableResult";
					TableResult.style.width = "100%";
					TableResult.classList.add("TableauResulat");
					DivViewLiveCoureur.appendChild(TableResult);
                    CountCoureur = 0;
					for (let i = 0; i < ListCoureurs.length; i++) 
					{
					
				
						// Si détection contient un coureur 
						if (ListCoureurs[i].Coureur != null)
						{
								// Ajout du coureur sur la page
							AddCoureur = false;
							// Si le coureur est dans la catégorie afficher
							if (FormTypeClassement.value == "Categorie" )
							{
								if( ListCoureurs[i].Coureur.Categorie.NumCategorie._Value == FormNomClassement.value )
								{
									AddCoureur = true;
								}
								else
								{
									console.log(ListCoureurs[i].Coureur.Categorie.NumCategorie._Value);
								}
							}
							// Si le coureur dans le même sexe que afficher 
							else if (FormTypeClassement.value == "Sexe" && ListCoureurs[i].Coureur.Sexe._Value == FormNomClassement.value)
							{
								AddCoureur = true;
							}
							// Afficher tous les coureurs dans le scratch
							else if (FormTypeClassement.value == "Scratch" || FormTypeClassement.value == "")
							{
								AddCoureur = true;
							}

							// Si le coureur est autorisé pour l'affichage 
							if (AddCoureur)
							{
                                // Ajout ligne de coureur
								rows = document.createElement('tr');
								TableResult.appendChild(rows);
                                if (CountCoureur % 2 > 0)
                                {
                                    rows.style.background = "#FFFFFF";
                                }
                                else
                                {
                                    rows.style.background = "#E6E6E6"; 
                                }
                                                            
                                CountCoureur ++;

								rows.addEventListener("click", function() {
									ViewDetailCoureur(i);
									}, false);

							
                                // Position
								colonne = document.createElement('td');
								colonne.style.paddingLeft = "10px";
								colonne.style.paddingRight = "10px";
								colonne.style.fontWeight = "bold";
								colonne.style.fontSize = "18px";

								if (FormTypeClassement.value == "Categorie" )
								{
									colonne.innerText =ListCoureurs[i].CLassementScratch.PositionCategorie;
								}

								// Si le coureur dans le même sexe que afficher 
								else if (FormTypeClassement.value == "Sexe" )
								{
									colonne.innerText =ListCoureurs[i].CLassementScratch.PositionSexe;
								}
								// Afficher tous les coureurs dans le scratch
								else if (FormTypeClassement.value == "Scratch" ||FormTypeClassement.value == ""  )
								{
									colonne.innerText =ListCoureurs[i].CLassementScratch.Position;
								}
							
								rows.appendChild(colonne);

								colonne = document.createElement('td');
								colonne.style.paddingLeft = "10px";
								colonne.style.paddingRight = "10px";
								colonne.style.fontSize = "16px";
								// Affichage du Nom d'équipe et le nom du coureur
								if ( ListCoureurs[i].Coureur.NomEquipe._Value.length > 0 && ListCoureurs[i].Coureur.NomCoureur2._Value.length > 0  )
								{
									colonne.innerText =  ListCoureurs[i].Coureur.NomEquipe._Value;
								}
								else
								{
									colonne.innerText = ListCoureurs[i].Coureur.Nom._Value + " " + ListCoureurs[i].Coureur.Prenom._Value;
								}
								rows.appendChild(colonne);

								colonne = document.createElement('td');
								colonne.style.paddingLeft = "10px";
								colonne.style.paddingRight = "10px";
								colonne.style.fontSize = "12px";
								colonne.style.fontWeight = "italic";
								// Affichage du Nom d'équipe et le nom du coureur
								if ( ListCoureurs[i].Coureur.NomEquipe._Value.length > 0 && ListCoureurs[i].Coureur.NomCoureur2._Value.length > 0  )
								{
									tableCoureur = document.createElement('table'); 
							
									// Coureur 1
									RowCoureurCoureur = document.createElement('tr'); 
									RowCoureurCoureur.style.height = "auto";
									RowCoureurCoureur.style.background = "transparent";
									RowCoureurCoureur.style.padding = "2px";

									colonneC = document.createElement('td');
									colonneC.style.fontSize = "12px";
						
									colonneC.style.fontWeight = "italic";
									colonneC.innerText = ListCoureurs[i].Coureur.NomCoureur1._Value + " " + ListCoureurs[i].Coureur.PrenomCoureur1._Value;
									RowCoureurCoureur.appendChild(colonneC);
									tableCoureur.appendChild(RowCoureurCoureur);

							
									// Coureur 2
									RowCoureurCoureur = document.createElement('tr'); 
									RowCoureurCoureur.style.height = "auto";
									RowCoureurCoureur.style.background = "transparent";
									RowCoureurCoureur.style.padding = "2px";

									colonneC = document.createElement('td');
									colonneC.style.fontSize = "12px";
									colonneC.style.fontWeight = "italic";
									colonneC.innerText = ListCoureurs[i].Coureur.NomCoureur2._Value + " " + ListCoureurs[i].Coureur.PrenomCoureur2._Value;
									RowCoureurCoureur.appendChild(colonneC);
									tableCoureur.appendChild(RowCoureurCoureur);

									// Coureur 3
									if (ListCoureurs[i].Coureur.NomCoureur3._Value.length > 0)
									{
										RowCoureurCoureur = document.createElement('tr'); 
										RowCoureurCoureur.style.height = "auto";
										RowCoureurCoureur.style.background = "transparent";
										RowCoureurCoureur.style.padding = "2px";

										colonneC = document.createElement('td');
										colonneC.style.fontSize = "12px";
										colonneC.style.fontWeight = "italic";
										colonneC.innerText = ListCoureurs[i].Coureur.NomCoureur3._Value + " " + ListCoureurs[i].Coureur.PrenomCoureur3._Value;
										RowCoureurCoureur.appendChild(colonneC);
										tableCoureur.appendChild(RowCoureurCoureur);
									}

									// Coureur 4
									if (ListCoureurs[i].Coureur.NomCoureur4._Value.length > 0)
									{
										RowCoureurCoureur = document.createElement('tr'); 
										RowCoureurCoureur.style.height = "auto";
										RowCoureurCoureur.style.background = "transparent";
										RowCoureurCoureur.style.padding = "2px";

										colonneC = document.createElement('td');
										colonneC.style.fontSize = "12px";
										colonneC.style.fontWeight = "italic";
										colonneC.innerText = ListCoureurs[i].Coureur.NomCoureur4._Value + " " + ListCoureurs[i].Coureur.PrenomCoureur4._Value;
										RowCoureurCoureur.appendChild(colonneC);
										tableCoureur.appendChild(RowCoureurCoureur);
									}
									// Coureur 5
									if (ListCoureurs[i].Coureur.NomCoureur5._Value.length > 0)
									{
										RowCoureurCoureur = document.createElement('tr'); 
										RowCoureurCoureur.style.height = "auto";
										RowCoureurCoureur.style.background = "transparent";
										RowCoureurCoureur.style.padding = "2px";

										colonneC = document.createElement('td');
										colonneC.style.fontSize = "12px";
										colonneC.style.fontWeight = "italic";
										colonneC.innerText = ListCoureurs[i].Coureur.NomCoureur5._Value + " " + ListCoureurs[i].Coureur.PrenomCoureur5._Value;
										RowCoureurCoureur.appendChild(colonneC);
										tableCoureur.appendChild(RowCoureurCoureur);
									}
									// Coureur 6
									if (ListCoureurs[i].Coureur.NomCoureur6._Value.length > 0)
									{
										RowCoureurCoureur = document.createElement('tr'); 
										RowCoureurCoureur.style.height = "auto";
										RowCoureurCoureur.style.background = "transparent";
										RowCoureurCoureur.style.padding = "2px";
										colonneC = document.createElement('td');
										colonneC.style.fontSize = "12px";
							
										colonneC.style.fontWeight = "italic";
										colonneC.innerText = ListCoureurs[i].Coureur.NomCoureur6._Value + " " + ListCoureurs[i].Coureur.PrenomCoureur6._Value;
										RowCoureurCoureur.appendChild(colonneC);
										tableCoureur.appendChild(RowCoureurCoureur);
									}

									colonne.appendChild(tableCoureur);
								}
								else
								{
									colonne.innerText = ListCoureurs[i].Coureur.AnneeNaissance._Value;
								}
								rows.appendChild(colonne);

								colonne = document.createElement('td');
								tableLoc = document.createElement('Table');
								
								RowLoc = document.createElement('tr');
								RowLoc.style.height = "30px";
								tableLoc.appendChild(RowLoc);

								colLoc = document.createElement('td');
								colLoc.style.margin ="1px";
								colonne.style.fontSize = "12px";
								colLoc.style.fontWeight = "bold";
								colLoc.innerText = ListCoureurs[i].Coureur.localite._Value;
								RowLoc.appendChild(colLoc);

								RowLoc = document.createElement('tr');
								RowLoc.style.height = "30px";
								RowLoc.style.background = "transparent";
								tableLoc.appendChild(RowLoc);
								colLoc = document.createElement('td');
							
								colLoc.style.margin ="1px";
								colLoc.style.fontStyle = "italic";
								colLoc.innerText = ListCoureurs[i].Coureur.Club._Value;
								RowLoc.appendChild(colLoc);
								colonne.appendChild(tableLoc);
								
								rows.appendChild(colonne);

								if (FormTypeClassement.value == "Scratch" ||FormTypeClassement.value == "")
								{
									colonne = document.createElement('td');
									colonne.style.paddingLeft = "10px";
									colonne.style.paddingRight = "10px";
									colonne.style.width = "120px";
									tableLoc = document.createElement('Table');

									RowLoc = document.createElement('tr');
									RowLoc.style.height = "30px";
									tableLoc.appendChild(RowLoc);
									colLoc = document.createElement('td');
									colLoc.style.margin ="1px";
									colLoc.style.fontSize = "14px";
									colLoc.innerText = ListCoureurs[i].CLassementScratch.PositionCategorie +" ( cat. " +ListCoureurs[i].Coureur.Categorie.NumCategorie._Value +" ) " ;
									RowLoc.appendChild(colLoc);

									RowLoc = document.createElement('tr');
									RowLoc.style.height = "30px";
									RowLoc.style.background = "transparent";
									tableLoc.appendChild(RowLoc);
									colLoc = document.createElement('td');
								
									colLoc.style.margin ="1px";
									colLoc.style.fontSize= "14px";
									if (ListCoureurs[i].Coureur.Sexe._Value == "H")
									{
										
										colLoc.innerHTML = ListCoureurs[i].CLassementScratch.PositionSexe +" <i style='font-size:20px; color:blue;' class='fa fa-male' ></i> " ;
									}
									else
									{
										
										colLoc.innerHTML = ListCoureurs[i].CLassementScratch.PositionSexe +"  <i  style='font-size:20px; color:#FF34FE;' class='fa fa-female' ></i> " ;
									}
									RowLoc.appendChild(colLoc);
									colonne.appendChild(tableLoc);
									
									rows.appendChild(colonne);
								}


								colonne = document.createElement('td');
								colonne.style.paddingLeft = "10px";
								colonne.style.paddingRight = "10px";
								if (FormTypeClassement.value == "Categorie" )
								{
									if (ListCoureurs[i].CLassementScratch.Temps.indexOf(".")>1)
									{
										var Temps = ListCoureurs[i].CLassementScratch.TempsCat.substring(0,ListCoureurs[i].CLassementScratch.TempsCat.indexOf("."));
									}
									else
									{
										var Temps = ListCoureurs[i].CLassementScratch.TempsCat;
									}
									
								}
								else
								{
									if (ListCoureurs[i].CLassementScratch.Temps.indexOf(".")>1)
									{
										var Temps = ListCoureurs[i].CLassementScratch.Temps.substring(0,ListCoureurs[i].CLassementScratch.Temps.indexOf("."));
									}
									else
									{
										var Temps = ListCoureurs[i].CLassementScratch.Temps;
									}
								}
								
							
								if (Temps.indexOf('00:') == 0)
								{
									colonne.innerText = Temps.slice(3,25);
								}
								else
								{
									colonne.innerText = Temps;
								}
								
								rows.appendChild(colonne);

								colonne = document.createElement('td');
								colonne.style.paddingLeft = "10px";
								colonne.style.paddingRight = "10px";
								var ecart = '';
								if (FormTypeClassement.value == "Categorie" )
								{
									if (ListCoureurs[i].CLassementScratch.EcartCategorie.indexOf(".") > -1)
									{
										ecart = ListCoureurs[i].CLassementScratch.EcartCategorie.substring(0,ListCoureurs[i].CLassementScratch.EcartCategorie.indexOf("."));
									}
									else
									{
										ecart = ListCoureurs[i].CLassementScratch.EcartCategorie;
									}
								}
								// Si le coureur dans le même sexe que afficher 
								else if (FormTypeClassement.value == "Sexe" )
								{
									if (ListCoureurs[i].CLassementScratch.EcartSexe.indexOf(".") > -1)
									{
										ecart = ListCoureurs[i].CLassementScratch.EcartSexe.substring(0,ListCoureurs[i].CLassementScratch.EcartSexe.indexOf("."));
									}
									else
									{
										ecart = ListCoureurs[i].CLassementScratch.EcartSexe;
									}
								}
								// Afficher tous les coureurs dans le scratch
								else if (FormTypeClassement.value == "Scratch" ||FormTypeClassement.value == "")
								{
									if (ListCoureurs[i].CLassementScratch.Ecart.indexOf(".") > -1)
									{
										ecart = ListCoureurs[i].CLassementScratch.Ecart.substring(0,ListCoureurs[i].CLassementScratch.Ecart.indexOf("."));
									}
									else
									{
										ecart = ListCoureurs[i].CLassementScratch.Ecart;
									}
								}
								if (ecart.indexOf('00:') == 0)
								{
									colonne.innerText =  ecart.slice(3,25);
								}
								else
								{
									colonne.innerText = ecart;
								}
								
								rows.appendChild(colonne);


                                // Classement Point de passage
                                // Ajout point de passage du coureur 
                                if (  ListCoureurs[i].ListResultatEtape != undefined )
                                {
                                    if ( ListCoureurs[i].ListResultatEtape.length > 1 )
                                    {
                                        // Ajout bouton plus 
                                        colonne = document.createElement('td');
				
                                        colonne.innerHTML =" <span class='dot' style='width:20px'> <i style='margin-left :5px'  class='fa fa-plus'></i></span>"
                                        rows.appendChild(colonne);
                                        // Ajout tableau point de passage 
                                        rows = document.createElement('tr');
                                        rows.style.background = "white";
                                        rows.style.display = "none";
                                        rows.id = "TableauPointPassage"+ i;
                                        TableResult.appendChild(rows);
                                        // Décalage avec position
                                        colonne = document.createElement('td');
                                        rows.appendChild(colonne);

                                        colonne = document.createElement('td');
                                        colonne.colSpan = 10;
                                        rows.appendChild(colonne);

                                        // Tableau point de passage
                                        tablePassage = document.createElement('table');
                                        tablePassage.style.width = "100%"
                                        colonne.appendChild(tablePassage);

                                        // Ajout tableau point de passage 
                                        rows = document.createElement('tr');
                                        rows.style.background = "white";
                                        tablePassage.appendChild(rows);

                                        // Décalage avec position
                                        colonne = document.createElement('td');
                                        colonne.colSpan = 10;
                                        rows.appendChild(colonne);

                                        //Ligne En tête 
                                        para = document.createElement('p');
                                        para.innerHTML = "<i style='font-size:20px; color:blue;' class='fa fa-trophy' ></i>"+ " étapes"
                                        colonne.appendChild(para);

										h= 0;
                                        for (let j = 0; j < ListCoureurs[i].ListResultatEtape.length; j++) 
                                        {
											h = h+1;
											//Ligne passage
											rowsPassage = document.createElement('tr');
											tablePassage.appendChild(rowsPassage);


											colonne = document.createElement('td');
											colonne.style.paddingLeft = "10px";
											colonne.style.paddingRight = "10px";
											colonne.style.fontWeight = "bold";
											colonne.style.fontSize = "18px";

											if (FormTypeClassement.value == "Categorie" )
											{
												colonne.innerText = ListCoureurs[i].ListResultatEtape[j].CLassementScratch.PositionCategorie;
											}
											// Si le coureur dans le même sexe que afficher 
											else if (FormTypeClassement.value == "Sexe" )
											{
												colonne.innerText = ListCoureurs[i].ListResultatEtape[j].CLassementScratch.PositionSexe;
											}
										
											else if (FormTypeClassement.value == "Scratch" ||FormTypeClassement.value == ""  )
											{
												colonne.innerText = ListCoureurs[i].ListResultatEtape[j].CLassementScratch.Position;
											}
										
											rowsPassage.appendChild(colonne);

											colonne = document.createElement('td');
											colonne.style.width = "50px";
											if (h >  1)
											{

												if ((FormTypeClassement.value == "Scratch" ||FormTypeClassement.value == "") && ListCoureurs[i].ListResultatEtape[j].CLassementScratch.Position - ListCoureurs[i].ListResultatEtape[j-1].CLassementScratch.Position < 0)
												{
													colonne.innerHTML = " <i style='font-size:20px; color:green;' class='fa fa-arrow-up' ></i> ";
												}
												else if ((FormTypeClassement.value == "Scratch" ||FormTypeClassement.value == "") && ListCoureurs[i].ListResultatEtape[j].CLassementScratch.Position - ListCoureurs[i].ListResultatEtape[j-1].CLassementScratch.Position > 0)
												{
													colonne.innerHTML  = " <i style='font-size:20px; color:orange;' class='fa fa-arrow-down' ></i> ";
												}
												else if ((FormTypeClassement.value == "Sexe") && ListCoureurs[i].ListResultatEtape[j].CLassementScratch.PositionSexe - ListCoureurs[i].ListResultatEtape[j-1].CLassementScratch.PositionSexe < 0)
												{
														colonne.innerHTML = " <i style='font-size:20px; color:green;' class='fa fa-arrow-up' ></i> ";
												}
												else if ((FormTypeClassement.value == "Sexe" ) && ListCoureurs[i].ListResultatEtape[j].CLassementScratch.PositionSexe - ListCoureurs[i].ListResultatEtape[j-1].CLassementScratch.PositionSexe > 0)
												{
														colonne.innerHTML  = " <i style='font-size:20px; color:orange;' class='fa fa-arrow-down' ></i> ";
												}
												else if ((FormTypeClassement.value == "Categorie") && ListCoureurs[i].ListResultatEtape[j].CLassementScratch.PositionCategorie - ListCoureurs[i].ListResultatEtape[j-1].CLassementScratch.PositionCategorie < 0)
												{
														colonne.innerHTML = " <i style='font-size:20px; color:green;' class='fa fa-arrow-up' ></i> ";
												}
												else if ((FormTypeClassement.value == "Categorie" ) && ListCoureurs[i].ListResultatEtape[j].CLassementScratch.PositionCategorie- ListCoureurs[i].ListResultatEtape[j-1].CLassementScratch.PositionCategorie > 0)
												{
														colonne.innerHTML  = " <i style='font-size:20px; color:orange;' class='fa fa-arrow-down' ></i> ";
												}
												else 
												{
													colonne.innerHTML  = " <i style='font-size:20px; color:blue;' class='fa fa-arrow-right' ></i> ";
												}
											}
											rowsPassage.appendChild(colonne);

											colonne = document.createElement('td');
											colonne.innerText = ListCoureurs[i].ListResultatEtape[j].EtapeNom;
											rowsPassage.appendChild(colonne);

											// Type d'affichage selon catégorie , sexe ,scratch
											if (FormTypeClassement.value == "Scratch" ||FormTypeClassement.value == "")
											{

												colonne = document.createElement('td');
												colonne.style.paddingLeft = "10px";
												colonne.style.paddingRight = "10px";
												colonne.style.width = "120px";
												tableLoc = document.createElement('Table');

												RowLoc = document.createElement('tr');
												RowLoc.style.height = "30px";
												tableLoc.appendChild(RowLoc);
												colLoc = document.createElement('td');
												colLoc.style.margin ="1px";
												colLoc.style.fontSize = "14px";
												colLoc.innerText = ListCoureurs[i].ListResultatEtape[j].CLassementScratch.PositionCategorie +" ( cat. " +ListCoureurs[i].Coureur.Categorie.NumCategorie._Value +" ) " ;
												RowLoc.appendChild(colLoc);

												RowLoc = document.createElement('tr');
												RowLoc.style.height = "30px";
												RowLoc.style.background = "transparent";
												tableLoc.appendChild(RowLoc);
												colLoc = document.createElement('td');
											
												colLoc.style.margin ="1px";
												colLoc.style.fontSize= "14px";
												if (ListCoureurs[i].Coureur.Sexe._Value == "H")
												{
													
													colLoc.innerHTML = ListCoureurs[i].ListResultatEtape[j].CLassementScratch.PositionSexe +" <i style='font-size:20px; color:blue;' class='fa fa-male' ></i> " ;
												}
												else
												{
													
													colLoc.innerHTML = ListCoureurs[i].ListResultatEtape[j].CLassementScratch.PositionSexe +"  <i  style='font-size:20px; color:#FF34FE;' class='fa fa-female' ></i> " ;
												}
												RowLoc.appendChild(colLoc);
												colonne.appendChild(tableLoc);
												
												rowsPassage.appendChild(colonne);
											}

	
											// Affichage temps et écart 
											colonne = document.createElement('td');
											colonne.style.paddingLeft = "10px";
											colonne.style.paddingRight = "10px";
											if (FormTypeClassement.value == "Categorie" )
											{
												if (ListCoureurs[i].ListResultatEtape[j].CLassementScratch.TempsCat.indexOf(".")>1)
												{
													var Temps = ListCoureurs[i].ListResultatEtape[j].CLassementScratch.TempsCat.substring(0,ListCoureurs[i].ListResultatEtape[j].CLassementScratch.TempsCat.indexOf("."));
												}
												else
												{
													var Temps = ListCoureurs[i].ListResultatEtape[j].CLassementScratch.TempsCat;
												}
												
											}
											else
											{
												if (ListCoureurs[i].ListResultatEtape[j].CLassementScratch.Temps.indexOf(".")>1)
												{
													var Temps = ListCoureurs[i].ListResultatEtape[j].CLassementScratch.Temps.substring(0,ListCoureurs[i].ListResultatEtape[j].CLassementScratch.Temps.indexOf("."));
												}
												else
												{
													var Temps = ListCoureurs[i].ListResultatEtape[j].CLassementScratch.Temps;
												}
											}
											
										
											if (Temps.indexOf('00:') == 0)
											{
												colonne.innerText = Temps.slice(3,25);
											}
											else
											{
												colonne.innerText = Temps;
											}
											
											rowsPassage.appendChild(colonne);

											
											colonne = document.createElement('td');
											colonne.style.paddingLeft = "10px";
											colonne.style.paddingRight = "10px";
											var ecart = '';
											if (FormTypeClassement.value == "Categorie" )
											{
												if (ListCoureurs[i].ListResultatEtape[j].CLassementScratch.EcartCategorie.indexOf(".") > -1)
												{
													ecart = ListCoureurs[i].ListResultatEtape[j].CLassementScratch.EcartCategorie.substring(0,ListCoureurs[i].ListResultatEtape[j].CLassementScratch.EcartCategorie.indexOf("."));
												}
												else
												{
													ecart = ListCoureurs[i].ListResultatEtape[j].CLassementScratch.EcartCategorie;
												}
											}
											// Si le coureur dans le même sexe que afficher 
											else if (FormTypeClassement.value == "Sexe" )
											{
												if (ListCoureurs[i].ListResultatEtape[j].CLassementScratch.EcartSexe.indexOf(".") > -1)
												{
													ecart = ListCoureurs[i].ListResultatEtape[j].CLassementScratch.EcartSexe.substring(0,ListCoureurs[i].ListResultatEtape[j].CLassementScratch.EcartSexe.indexOf("."));
												}
												else
												{
													ecart = ListCoureurs[i].ListResultatEtape[j].CLassementScratch.EcartSexe;
												}
											}
											// Afficher tous les coureurs dans le scratch
											else if (FormTypeClassement.value == "Scratch" ||FormTypeClassement.value == "")
											{
												if (ListCoureurs[i].ListResultatEtape[j].CLassementScratch.Ecart.indexOf(".") > -1)
												{
													ecart = ListCoureurs[i].ListResultatEtape[j].CLassementScratch.Ecart.substring(0,ListCoureurs[i].ListResultatEtape[j].CLassementScratch.Ecart.indexOf("."));
												}
												else
												{
													ecart = ListCoureurs[i].ListResultatEtape[j].CLassementScratch.Ecart;
												}
											}
											if (ecart.indexOf('00:') == 0)
											{
												colonne.innerText =  ecart.slice(3,25);
											}
											else
											{
												colonne.innerText = ecart;
											}
											rowsPassage.appendChild(colonne);
										}
                                  	}
                            	}
                            }

						}
					}
				}
			}
		}


	var ListNomClassement = [];
	function readFileResultat(NbrEtape , PathFolderDepart, NumEtape )	
	{
		console.log("Function Read File Resultat");
		console.log(NumEtape);
		var Parcours = new Object();
		var Etape= new Object();	
		// Lecture du fichier " info étape "
		if (NumEtape != 99)
		{
			Etape =  readJSON(PathFolderDepart + "/Etape"+NumEtape+"/info.json");
			console.log("Read File Json Etape");
			console.log(Etape);
			// lecture fichier JSON des résultats de la coursse
			Parcours.info =  readJSON(PathFolderDepart +"/Etape"+ NumEtape+ "/ResultatsV2.json");
			console.log("ResultatsV2.json");
		}	
		else
		{
			Parcours.info =  readJSON(PathFolderDepart +"/General/ResultatWeb/ResultatsGeneral.json");
			console.log("ResultatsGeneral.json");
		}
		console.log("Parcours");
		console.log(Parcours);
		var ListPointPassage  = [];
		if (Etape != undefined  )
		{
			console.log("Etape");
			console.log(Etape);
			// Graphique Vertical avec point de passage noter dans le graphique 
			var ArrayCoureurs = [];
			var ArrayParcours = [];
			var ICounterCoureurs = 0;
			var TotalDiminution = 0;
			var TotalELevation = 0;
			var StartElevation = 0;
			var ElevationMin = 10000;
			var ElevationMax = 0;
			var TotalKM = 0;

			
			var indexPassage = 1;

			// Ajout du graphique dans tableau ViewDetailCoureur
			let RowsTableEtape1 =	document.createElement('tr');
			let ColimgEtapePara1 =	document.createElement('td');
			let DivimgEtapePara =	document.createElement('div');

			ColimgEtapePara1.width = "80%";
			ColimgEtapePara1.append(DivimgEtapePara);
			RowsTableEtape1.append(ColimgEtapePara1);
			ViewGraphique.append(RowsTableEtape1);

			var LastPoint = true;
			var DivAllPoint= document.getElementById('Allpointpassage');
			CountCoureurTotal = 0;

			if (Parcours.info != undefined)
			{
				if (NumEtape != 99)
				{
					AddButtonTypeResultat(Etape.ListPointPassage.ListItem[0]);

					// Affichage du live des coureurs de chaque point de passage 
					for (let i = Parcours.info.ListLivePointDePassage.length-1; i >-1; i--) 
					{

						if (Parcours.info.ListLivePointDePassage[i].NameDepart == <?php echo json_encode($Depart)?>)
						{
							// Affichage des personnes du dernier point de passage de la course exemple : arrivée 
							if (LastPoint)
							{
								var ListCoureurs = Parcours.info.ListLivePointDePassage[i].ListCoureursArrivee;

							}
							else
							{

								var ListCoureurs = Parcours.info.ListLivePointDePassage[i+1].ListCoureursRestant;

							}
							funMenuNomClassement(ListCoureurs, false);
							ListCoureurLiveToTable(Parcours.info.ListLivePointDePassage[i],ListCoureurs, LastPoint, i);
							LastPoint = false;
						}
					}
				}
				else
				{
					AddButtonTypeResultatGeneral();
					funMenuNomClassement(Parcours.info,true);
					ListCoureurLiveToTableGeneral(Parcours.info);
				}
				
			
			}
			else
			{
				document.getElementById("Informations").style.display = "";
				document.getElementById("Informations").innerHTML = "Les résultats ne sont pas encore disponible pour ce départ";
			}
		

			// Affichage du graphique de déniveller pour ce départ si le fichier gpx existe
			// Open a log file
			// Affichage du graphique de déniveller pour ce départ si le fichier gpx existe
			<?php
			$chemin= $pathfolder."//Etape". $Etape."//images/Etape.xml";

			if (file_exists($chemin)) {
			?>
				mapSvg('Test', PathFolderDepart +"//Etape"+ NumEtape+ "//images/Etape.xml", DivimgEtapePara,Etape,Parcours);
				<?
			}?>
		}
	}


	function AddButtonTypeResultat(PointDePassageInfo)
	{
		console.log("Add Button type resultat");
		DivTypeClassement= document.getElementById('TypeClassement');
		// Affichage du bouton de chaque type de classement proposé par ce point de passage 
		const buttonTypeClassement = document.createElement('button');
		if (FormTypeClassement.value == "Categorie" )
		{
			buttonTypeClassement.classList.add("ButtonResultatSelected");
		}
		else
		{
			buttonTypeClassement.classList.add("ButtonResultat");
		}
		
		buttonTypeClassement.innerHTML = "<b>Catégorie</b>" ;
		DivTypeClassement.appendChild(buttonTypeClassement);

		// évenement ajout colonne dans tableau
		buttonTypeClassement.addEventListener("click", function()
		{
		// Quand on sélectionne la point de passage on signal au formulaire que le point est sélectionné
		var FormSendIndfo= document.getElementById('FormSendIndfo');
			FormTypeClassement.value = "Categorie";
			FormSendIndfo.submit();
		}, false);

		buttonTypeClassement2 = document.createElement('button');
		if (FormTypeClassement.value == "Sexe" )
		{
			buttonTypeClassement2.classList.add("ButtonResultatSelected");
		}
		else
		{
			buttonTypeClassement2.classList.add("ButtonResultat");
		}

		buttonTypeClassement2.style.fontSize= "20px";
		buttonTypeClassement2.innerHTML = "<i class='fa fa-male' ></i><i class='fa fa-female'></i>" ;
		DivTypeClassement.appendChild(buttonTypeClassement2);
		// évenement ajout colonne dans tableau
		buttonTypeClassement2.addEventListener("click", function()
		{
		// Quand on sélectionne la point de passage on signal au formulaire que le point est sélectionné
		var FormSendIndfo= document.getElementById('FormSendIndfo');
			FormTypeClassement.value = "Sexe";
			FormSendIndfo.submit();
		}, false);

		buttonTypeClassement3 = document.createElement('button');
		if (FormTypeClassement.value == "Scratch"  )
		{
			buttonTypeClassement3.classList.add("ButtonResultatSelected");
		}
		else
		{
			buttonTypeClassement3.classList.add("ButtonResultat");
		}
		buttonTypeClassement3.innerHTML = "<b>Scratch</b>" ;
		DivTypeClassement.appendChild(buttonTypeClassement3);
		// évenement ajout colonne dans tableau
		buttonTypeClassement3.addEventListener("click", function()
		{
		// Quand on sélectionne la point de passage on signal au formulaire que le point est sélectionné
		var FormSendIndfo= document.getElementById('FormSendIndfo');
			FormTypeClassement.value = "Scratch";
			FormSendIndfo.submit();
		}, false);

		// Si aucun type de classement est détectée, scratch = valeur par défaut
		if (FormTypeClassement.value == null ||  FormTypeClassement.value == "")
		{
			var FormSendIndfo= document.getElementById('FormSendIndfo');
			FormTypeClassement.value = "Scratch";
			buttonTypeClassement3.classList.add("ButtonResultatSelected");
			//FormSendIndfo.submit();
		}
<?
		/**************************************************
		 * 
		 * 			Liste fichier résultat de type spéciaux "équipe , Duo "
		 * 
		 ***************************************************/
		if (strlen($Parcours) > 0 &&  strlen($Parcours) > 0 && strlen($Depart) > 0  )
		{
			if ($numetape >0 && $numetape <99)
			{
				$pathfolderStep = $pathfolder   .'/Etape'.$numetape;
			}
			elseif ($numetape == 99)
			{
			
				$pathfolderStep = $pathfolder .'/General' ;
			}
			else
			{
				$pathfolderStep = $pathfolder   .'/Etape1';
			}
			$pathfolderStep = $pathfolderStep   .'/ResultatWeb';
			// Création de la liste de toutes les Dossier = Depart 
			$files1 = scandir($pathfolderStep);
			// Lecture de chaques dossier Pacours Exemple Adultes / Enfants 
			foreach ($files1  as $key => $value) 
			{ 
				$pos2 = strpos($value, 'classement_');
				if ($pos2 !== false) 
				{
					$ClassementTampon = $value;	
					?>

					buttonTypeClassement3 = document.createElement('button');
					if (FormTypeClassement.value == "File"+<?echo json_encode($value) ?> )
					{
						buttonTypeClassement3.classList.add("ButtonResultatSelected");
					}
					else
					{
						buttonTypeClassement3.classList.add("ButtonResultat");
					}
					buttonTypeClassement3.innerHTML =  <?echo json_encode($value) ?> ;
				buttonTypeClassement3.innerHTML = 	buttonTypeClassement3.innerHTML.replace("classement_", "");
				buttonTypeClassement3.innerHTML = 	buttonTypeClassement3.innerHTML.replace(".csv", "");
					DivTypeClassement.appendChild(buttonTypeClassement3);
					// évenement ajout colonne dans tableau
					buttonTypeClassement3.addEventListener("click", function()
					{
					// Quand on sélectionne la point de passage on signal au formulaire que le point est sélectionné
					var FormSendIndfo= document.getElementById('FormSendIndfo');
						FormTypeClassement.value =  "File"+<?echo json_encode($value) ?> ;
						FormSendIndfo.submit();
					}, false);

	<?			}
			}
		}?>
	}
		
		function AddButtonPointdePassage(PointDePassageInfo)
		{
				// Création bouton par nouveau point de passage 
				const button = document.createElement('button');
				var FormPointPassage= document.getElementById('FormPointPassage');
				var FormTypeClassement= document.getElementById('FormTypeClassement');

				// Si on a choisie le point de passage 
				if (FormPointPassage.value == PointDePassageInfo.Nom._Value)
				{
					button.classList.add("ButtonResultatSelected");
					AddButtonTypeResultat(PointDePassageInfo);
				}
				
				// Set the button text to 'Can you click me?'
				// Point de passage
				if (PointDePassageInfo.EType == 0)
				{
					button.innerHTML = "<i style='margin-right:5px' class='fa fa-circle'></i>" + PointDePassageInfo.Nom._Value;
				}
				// Depart
				else if (PointDePassageInfo.EType == 1)
				{
					button.innerHTML = "<i style='margin-right:5px' class='fa fa-flag'></i>" + PointDePassageInfo.Nom._Value;
				}
				// Arrivée
				else  if (PointDePassageInfo.EType == 2)
				{
					button.innerHTML = "<i style='margin-right:5px' class='fa fa-flag-checkered'></i>" + PointDePassageInfo.Nom._Value;
				}
				button.classList.add("ButtonResultat");
				var PointPassage= new Object();	
				var ListCoureur = new Array();
				PointPassage.Info = PointDePassageInfo;
				PointPassage.ListCoureur = ListCoureur;
				ListPointPassage.push(PointPassage);

			/*	DivAllPoint= document.getElementById('Allpointpassage');
				DivAllPoint.appendChild(button);*/

				// évenemnt ajout colonne dans tableau
				button.addEventListener("click", function()
				{
					// Quand on sélectionne la point de passage on signal au formulaire que le point est sélectionné
					var FormSendIndfo= document.getElementById('FormSendIndfo');
					FormPointPassage.value = PointDePassageInfo.Nom._Value;
					FormSendIndfo.submit();
				}, false);
		}
	
		function funMenuNomClassement(ListCoureurs,general)
		{
			// Trie selon le type de classement ( Scratch , Categorie , Sexe)
			var FormTypeClassement= document.getElementById('FormTypeClassement');
			var NomClassement = "";
			console.log(FormTypeClassement.value);

			if (FormTypeClassement.value == "Sexe" )
			{
				for (let i = 0; i < ListCoureurs.length; i++) 
				{
					// Si détection contient un coureur 
					if (ListCoureurs[i].Coureur != null)
					{
						if (general)
						{
							NomClassement = ListCoureurs[i].Coureur.Sexe._Value;
						}
						else
						{
							NomClassement = ListCoureurs[i].Coureur.Sexe;
						}
						console.log("NomClassement")
						console.log(NomClassement)
						funAddAndVerifClassement(NomClassement ,ListCoureurs[i].Coureur ,general);	
					}
				}
			}
			else if (FormTypeClassement.value == "Categorie" )
			{
				for (let i = 0; i < ListCoureurs.length; i++) 
				{
					// Si détection contient un coureur 
					if (ListCoureurs[i].Coureur != null)
					{
						if (general)
						{
							NomClassement = ListCoureurs[i].Coureur.Categorie.NumCategorie._Value;	
						
						}
						else
						{
							NomClassement = ListCoureurs[i].Coureur.NumCategorie;	
						}
						console.log("NomClassement")
						console.log(NomClassement)
						funAddAndVerifClassement(NomClassement ,ListCoureurs[i].Coureur ,general);
					}
				}
			}

			var find = false;
			
		}

		// Fonction ajout de la valeur et du bouton du nom de classement
		function funAddAndVerifClassement(NomClassement, Coureur, general)
		{
			find = false;
			//Vérification si existe dans la liste 
			for (let j= 0; j < ListNomClassement.length; j++) 
			{
				if (NomClassement == ListNomClassement[j] )
				{
				
					find = true;
					break;
				}
			}
			// Ajout du nom de classement il n0est pas existant
			if(find == false)
			{
				ListNomClassement.push(NomClassement);
				buttonNomClassement = document.createElement('button');
				var FormNomClassement= document.getElementById('FormNomClassement');
				
				if (FormNomClassement.value == NomClassement )
				{
					buttonNomClassement.classList.add("ButtonResultatSelected");
				}
				else
				{
					buttonNomClassement.classList.add("ButtonResultat");
				}
				
				if (NomClassement == "H")
				{
					buttonNomClassement.style.fontSize = "24px";
					buttonNomClassement.innerHTML = "<i class='fa fa-male' ></i>" ;
				}
				else if  (NomClassement == "D")
				{
					buttonNomClassement.style.fontSize = "24px";
					buttonNomClassement.style.color= "#FF34FE";
					buttonNomClassement.innerHTML = "<i class='fa fa-female'></i>" ;
				}
				else
				{
					if (general)
					{
					buttonNomClassement.innerHTML =  Coureur.Categorie.NomCategorie._Value + " " +Coureur.Categorie.debutAnnee._Value +" - "+ Coureur.Categorie.finAnnee._Value ;
					}
					else
					{
					buttonNomClassement.innerHTML =  Coureur.NomCategorie + " " +Coureur.debutAnnee +" - "+ Coureur.finAnnee ;
					}

				}
				DivNomClassement= document.getElementById('NomClassement');
				DivNomClassement.appendChild(buttonNomClassement);
				// évenement ajout colonne dans tableau
				buttonNomClassement.addEventListener("click", function()
				{
				// Quand on sélectionne la point de passage on signal au formulaire que le point est sélectionné
				var FormSendIndfo= document.getElementById('FormSendIndfo');
					FormNomClassement.value = NomClassement;
					FormSendIndfo.submit();
				}, false);
			}				
		}
		
		function ListCoureurLiveToTable(LivePointPassage, ListCoureurs, LastPointDePassage , idPointPassage)
		{
        		console.log("ListCoureurLiveToTable");
			// Trie selon le type de classement ( Scratch , Categorie , Sexe)
			var FormTypeClassement= document.getElementById('FormTypeClassement');
			var DivViewLiveCoureur= document.getElementById('ViewLiveCoureur');
			// SI le fichier est de type classement extern 
			if (FormTypeClassement.value.includes("File") )
			{
				console.log("File");
			
			}
			else
			{

				// Affichage Titre point de passage et  nombre de coureur arrivée au point de passage
				const Title = document.createElement("p");

				if ( LivePointPassage.EType == 2 &&  LastPointDePassage)
				{
					var TotalCoureur = LivePointPassage.ListCoureursArrivee.length +  LivePointPassage.ListCoureursRestant.length ;
					Title.innerHTML = "<i class='fa fa-flag' style= 'color :black;font-size: 25px;margin:2px 20px;'> </i>" + LivePointPassage.Name + "( Finisher : "+ LivePointPassage.ListCoureursArrivee.length +")";//+ " / " + TotalCoureur + " )" ;
									
				}
				else if (LivePointPassage.EType == 0) 
				{
					Title.innerHTML = "<i class='fa  fa-spinner' style= 'color :black;font-size: 25px;margin:2px 20px;'> </i>Vu au point de passage : " +LivePointPassage.Name ;//+ "( Coureur restant : "+ ListCoureurs.length+ " )" ;
				}
				else if (LivePointPassage.EType == 1) 
				{
					Title.innerHTML = "<i class='fa  fa-play' style= 'color :black;font-size: 25px;margin:2px 20px;'> </i>Vu au point de passage : " +LivePointPassage.Name ;//+ "( Coureur restant : "+ ListCoureurs.length+ " )" ;
				}

				DivViewLiveCoureur.appendChild(Title);

				
				// Contenu
				if (LivePointPassage.ListCoureursArrivee.length < 1)
				{
			
					const a = document.createElement("a");
					a.innerHTML = "aucun coureur arrivée" ;
					DivViewLiveCoureur.appendChild(a);
				}
				else
				{

					var FormNomClassement= document.getElementById('FormNomClassement');

					if (FormTypeClassement.value == "Sexe" )
					{
						LivePointPassage.ListCoureursArrivee.sort((a,b) => a.Coureur.Sexe < b.Coureur.Sexe  ? -1 : 1);

					}
					else 	if (FormTypeClassement.value == "Categorie" )
					{
						
						LivePointPassage.ListCoureursArrivee.sort((a,b) => a.Coureur.NumCategorie < b.Coureur.NumCategorie  ? -1 : 1);
						console.log(LivePointPassage.ListCoureursArrivee);
					}
					// Affichage du classement seulement si il est de type scratch ou si on a choisie un nom de classement
					// Table du classement sélectionné 
					const TableResult = document.createElement("Table");
					TableResult.id = "TableResult";
					TableResult.style.width = "100%";
					TableResult.classList.add("TableauResulat");
					DivViewLiveCoureur.appendChild(TableResult);
                    CountCoureur = 0;
					for (let i = 0; i < ListCoureurs.length; i++) 
					{
					
                        idCoureur = (idPointPassage *100) + i;
						// Si détection contient un coureur 
						if (ListCoureurs[i].Coureur != null)
						{
								// Ajout du coureur sur la page
							AddCoureur = false;
							// Si le coureur est dans la catégorie afficher
							if (FormTypeClassement.value == "Categorie" )
							{
								if( ListCoureurs[i].Coureur.NumCategorie == FormNomClassement.value )
								{
									AddCoureur = true;
								}
							}
							// Si le coureur dans le même sexe que afficher 
							else if (FormTypeClassement.value == "Sexe" && ListCoureurs[i].Coureur.Sexe == FormNomClassement.value)
							{
								AddCoureur = true;
							}
							// Afficher tous les coureurs dans le scratch
							else if (FormTypeClassement.value == "Scratch" || FormTypeClassement.value == "")
							{
								AddCoureur = true;
							}

							// Si le coureur est autorisé pour l'affichage 
							if (AddCoureur)
							{
                                // Ajout ligne de coureur
								rows = document.createElement('tr');
								TableResult.appendChild(rows);
                                if (CountCoureur % 2 > 0)
                                {
                                    rows.style.background = "#FFFFFF";
                                }
                                else
                                {
                                    rows.style.background = "#E6E6E6"; 
                                }
                                                            
                                CountCoureur ++;
                                rows.id =idCoureur;
								rows.addEventListener("click", function() {
									ViewDetailCoureur(this.id);
									}, false);

							/*	if ( LivePointPassage.EType == 2 &&  LastPointDePassage)
								{
									colonne = document.createElement('td');
									colonne.innerHTML = "<i class='fa fa-flag' style= 'color :black;font-size: 25px;margin:5px;'> </i>"
									rows.appendChild(colonne);
								}
								else if (LivePointPassage.EType == 0) 
								{
									colonne = document.createElement('td');
									colonne.innerHTML = "<i class='fa  fa-check-spinner' style= 'color :black;font-size: 25px;margin:5px;'> </i>"
									rows.appendChild(colonne);
								}*/
                                // Position
								colonne = document.createElement('td');
								colonne.style.paddingLeft = "20px";
								colonne.style.paddingRight = "10px";
								colonne.style.fontWeight = "bold";
								colonne.style.fontSize = "18px";


								if (FormTypeClassement.value == "Categorie" )
								{
									colonne.innerText =ListCoureurs[i].CLassementScratch.PositionCategorie;
								}
								// Si le coureur dans le même sexe que afficher 
								else if (FormTypeClassement.value == "Sexe" )
								{
									colonne.innerText =ListCoureurs[i].CLassementScratch.PositionSexe;
								}
								// Afficher tous les coureurs dans le scratch
								else if (FormTypeClassement.value == "Scratch" ||FormTypeClassement.value == ""  )
								{
									colonne.innerText =ListCoureurs[i].CLassementScratch.Position;
								}
							
								rows.appendChild(colonne);
								// Numéro dossard
								colonne = document.createElement('td');
								colonne.style.paddingLeft = "10px";
								colonne.style.paddingRight = "10px";
								colonne.style.fontWeight = "italic";
								colonne.style.fontSize = "10px";
								colonne.innerText =ListCoureurs[i].NumeroDossard;
								rows.appendChild(colonne);

								colonne = document.createElement('td');
								colonne.style.paddingLeft = "10px";
								colonne.style.paddingRight = "10px";
								colonne.style.fontSize = "16px";
								// Affichage du Nom d'équipe ou  le nom du coureur si c'est un relais
								if ( ListCoureurs[i].Coureur.NomEquipe.length > 0 && ListCoureurs[i].Coureur.Coureur2.length > 1 )
								{
									colonne.innerText =  ListCoureurs[i].Coureur.NomEquipe;
								}
								else
								{
									colonne.innerText = ListCoureurs[i].Coureur.Nom + " " + ListCoureurs[i].Coureur.Prenom;
								}
								
								rows.appendChild(colonne);

								colonne = document.createElement('td');
								colonne.style.paddingLeft = "10px";
								colonne.style.paddingRight = "10px";
								colonne.style.fontSize = "12px";
								colonne.style.fontWeight = "italic";

								// Affichage du Nom d'équipe et le nom du coureur
								if ( ListCoureurs[i].Coureur.NomEquipe.length > 0 && ListCoureurs[i].Coureur.Coureur2.length > 1 )
								{
									tableCoureur = document.createElement('table'); 
							
									// Coureur 1
									RowCoureurCoureur = document.createElement('tr'); 
									RowCoureurCoureur.style.height = "auto";
									RowCoureurCoureur.style.background = "transparent";
									RowCoureurCoureur.style.padding = "2px";

									colonneC = document.createElement('td');
									colonneC.style.fontSize = "12px";
						
									colonneC.style.fontWeight = "italic";
									colonneC.innerText = ListCoureurs[i].Coureur.Coureur1;
									RowCoureurCoureur.appendChild(colonneC);
									tableCoureur.appendChild(RowCoureurCoureur);

							
									// Coureur 2
									RowCoureurCoureur = document.createElement('tr'); 
									RowCoureurCoureur.style.height = "auto";
									RowCoureurCoureur.style.background = "transparent";
									RowCoureurCoureur.style.padding = "2px";

									colonneC = document.createElement('td');
									colonneC.style.fontSize = "12px";
									colonneC.style.fontWeight = "italic";
									colonneC.innerText = ListCoureurs[i].Coureur.Coureur2 ;
									RowCoureurCoureur.appendChild(colonneC);
									tableCoureur.appendChild(RowCoureurCoureur);

									// Coureur 3
									if (ListCoureurs[i].Coureur.Coureur3.length > 0)
									{
										RowCoureurCoureur = document.createElement('tr'); 
										RowCoureurCoureur.style.height = "auto";
										RowCoureurCoureur.style.background = "transparent";
										RowCoureurCoureur.style.padding = "2px";

										colonneC = document.createElement('td');
										colonneC.style.fontSize = "12px";
										colonneC.style.fontWeight = "italic";
										colonneC.innerText = ListCoureurs[i].Coureur.Coureur3;
										RowCoureurCoureur.appendChild(colonneC);
										tableCoureur.appendChild(RowCoureurCoureur);
									}

									// Coureur 4
									if (ListCoureurs[i].Coureur.Coureur4.length > 0)
									{
										RowCoureurCoureur = document.createElement('tr'); 
										RowCoureurCoureur.style.height = "auto";
										RowCoureurCoureur.style.background = "transparent";
										RowCoureurCoureur.style.padding = "2px";

										colonneC = document.createElement('td');
										colonneC.style.fontSize = "12px";
										colonneC.style.fontWeight = "italic";
										colonneC.innerText = ListCoureurs[i].Coureur.Coureur4 ;
										RowCoureurCoureur.appendChild(colonneC);
										tableCoureur.appendChild(RowCoureurCoureur);
									}
									// Coureur 5
									if (ListCoureurs[i].Coureur.Coureur5.length > 0)
									{
										RowCoureurCoureur = document.createElement('tr'); 
										RowCoureurCoureur.style.height = "auto";
										RowCoureurCoureur.style.background = "transparent";
										RowCoureurCoureur.style.padding = "2px";

										colonneC = document.createElement('td');
										colonneC.style.fontSize = "12px";
										colonneC.style.fontWeight = "italic";
										colonneC.innerText = ListCoureurs[i].Coureur.Coureur5;
										RowCoureurCoureur.appendChild(colonneC);
										tableCoureur.appendChild(RowCoureurCoureur);
									}
									// Coureur 6
									if (ListCoureurs[i].Coureur.Coureur6.length > 0)
									{
										RowCoureurCoureur = document.createElement('tr'); 
										RowCoureurCoureur.style.height = "auto";
										RowCoureurCoureur.style.background = "transparent";
										RowCoureurCoureur.style.padding = "2px";
										colonneC = document.createElement('td');
										colonneC.style.fontSize = "12px";
							
										colonneC.style.fontWeight = "italic";
										colonneC.innerText = ListCoureurs[i].Coureur.Coureur6 ;
										RowCoureurCoureur.appendChild(colonneC);
										tableCoureur.appendChild(RowCoureurCoureur);
									}

									colonne.appendChild(tableCoureur);
								}
								else
								{
									colonne.innerText = ListCoureurs[i].Coureur.AnneeNaissance;
								}
								
								rows.appendChild(colonne);

								colonne = document.createElement('td');
								tableLoc = document.createElement('Table');
								
								RowLoc = document.createElement('tr');
								RowLoc.style.height = "30px";
								tableLoc.appendChild(RowLoc);

								colLoc = document.createElement('td');
								colLoc.style.margin ="1px";
								colonne.style.fontSize = "12px";
								colLoc.style.fontWeight = "bold";
								colLoc.innerText = ListCoureurs[i].Coureur.localite;
								RowLoc.appendChild(colLoc);

								RowLoc = document.createElement('tr');
								RowLoc.style.height = "30px";
								RowLoc.style.background = "transparent";
								tableLoc.appendChild(RowLoc);
								colLoc = document.createElement('td');
							
								colLoc.style.margin ="1px";
								colLoc.style.fontStyle = "italic";
								colLoc.innerText = ListCoureurs[i].Coureur.Club;
								RowLoc.appendChild(colLoc);
								colonne.appendChild(tableLoc);
								
								rows.appendChild(colonne);

								if (FormTypeClassement.value == "Scratch" ||FormTypeClassement.value == "")
								{
									colonne = document.createElement('td');
									colonne.style.paddingLeft = "10px";
									colonne.style.paddingRight = "10px";
									colonne.style.width = "140px";
									tableLoc = document.createElement('Table');

									RowLoc = document.createElement('tr');
									RowLoc.style.height = "30px";
									tableLoc.appendChild(RowLoc);
									colLoc = document.createElement('td');
									colLoc.style.margin ="1px";
									colLoc.style.fontSize = "14px";
									colLoc.innerText = ListCoureurs[i].CLassementScratch.PositionCategorie +" ( cat. " +ListCoureurs[i].Coureur.NumCategorie +" ) " ;
									RowLoc.appendChild(colLoc);

									RowLoc = document.createElement('tr');
									RowLoc.style.height = "30px";
									RowLoc.style.background = "transparent";
									tableLoc.appendChild(RowLoc);
									colLoc = document.createElement('td');
								
									colLoc.style.margin ="1px";
									colLoc.style.fontSize= "14px";
									if (ListCoureurs[i].Coureur.Sexe == "H")
									{
										
										colLoc.innerHTML = ListCoureurs[i].CLassementScratch.PositionSexe +" <i style='font-size:20px; color:blue;' class='fa fa-male' ></i> " ;
									}
									else
									{
										
										colLoc.innerHTML = ListCoureurs[i].CLassementScratch.PositionSexe +"  <i  style='font-size:20px; color:#FF34FE;' class='fa fa-female' ></i> " ;
									}
									RowLoc.appendChild(colLoc);
									colonne.appendChild(tableLoc);
									
									rows.appendChild(colonne);
								}


								colonne = document.createElement('td');
								colonne.style.paddingLeft = "10px";
								colonne.style.paddingRight = "10px";
								if (FormTypeClassement.value == "Categorie" )
								{
									if (ListCoureurs[i].CLassementScratch.Temps.indexOf(".")>1)
									{
										var Temps = ListCoureurs[i].CLassementScratch.TempsCat.substring(0,ListCoureurs[i].CLassementScratch.TempsCat.indexOf("."));
									}
									else
									{
										var Temps = ListCoureurs[i].CLassementScratch.TempsCat;
									}
									
								}
								else
								{
									if (ListCoureurs[i].CLassementScratch.Temps.indexOf(".")>1)
									{
										var Temps = ListCoureurs[i].CLassementScratch.Temps.substring(0,ListCoureurs[i].CLassementScratch.Temps.indexOf("."));
									}
									else
									{
										var Temps = ListCoureurs[i].CLassementScratch.Temps;
									}
								}
								
							
								if (Temps.indexOf('00:') == 0)
								{
									colonne.innerText = Temps.slice(3,25);
								}
								else
								{
									colonne.innerText = Temps;
								}
								rows.appendChild(colonne);
								colonne = document.createElement('td');
								colonne.style.paddingLeft = "10px";
								colonne.style.paddingRight = "10px";
								var ecart = '';
								if (FormTypeClassement.value == "Categorie" )
								{
									if (ListCoureurs[i].CLassementScratch.EcartCategorie.indexOf(".") > -1)
									{
										ecart = ListCoureurs[i].CLassementScratch.EcartCategorie.substring(0,ListCoureurs[i].CLassementScratch.EcartCategorie.indexOf("."));
									}
									else
									{
										ecart = ListCoureurs[i].CLassementScratch.EcartCategorie;
									}
								}
								// Si le coureur dans le même sexe que afficher 
								else if (FormTypeClassement.value == "Sexe" )
								{
									if (ListCoureurs[i].CLassementScratch.EcartSexe.indexOf(".") > -1)
									{
										ecart = ListCoureurs[i].CLassementScratch.EcartSexe.substring(0,ListCoureurs[i].CLassementScratch.EcartSexe.indexOf("."));
									}
									else
									{
										ecart = ListCoureurs[i].CLassementScratch.EcartSexe;
									}
								}
								// Afficher tous les coureurs dans le scratch
								else if (FormTypeClassement.value == "Scratch" ||FormTypeClassement.value == "")
								{
									if (ListCoureurs[i].CLassementScratch.Ecart.indexOf(".") > -1)
									{
										ecart = ListCoureurs[i].CLassementScratch.Ecart.substring(0,ListCoureurs[i].CLassementScratch.Ecart.indexOf("."));
									}
									else
									{
										ecart = ListCoureurs[i].CLassementScratch.Ecart;
									}
								}
								if (ecart.indexOf('00:') == 0)
								{
									colonne.innerText =  ecart.slice(3,25);
								}
								else
								{
									colonne.innerText = ecart;
								}
								
								rows.appendChild(colonne);
								if (document.getElementById("FormEtape").value.length > 0)
								{
									numEtape = document.getElementById("FormEtape").value ;
								}
								else
								{
									numEtape = 1;
								}
		
                                // Classement Point de passage
                                // Ajout point de passage du coureur 
                                if (  ListCoureurs[i].Coureur.ListTempsPointPassage != undefined )
                                {
									nbrPointPassage = 0;
									for (let z = 0; z < ListCoureurs[i].Coureur.ListTempsPointPassage.length; z++) 
                                    {
										if (ListCoureurs[i].Coureur.ListTempsPointPassage[z].IDEtape == numEtape
										|| ListCoureurs[i].Coureur.ListTempsPointPassage[z].IDEtape == 0  
										|| ListCoureurs[i].Coureur.ListTempsPointPassage[z].NomPointPassage != "Arrivée")
										{
											nbrPointPassage++;
										}
									}

									// affichage des temps de point de passage seulement si il y a plus que un point
                                    if ( nbrPointPassage > 1)
                                    {
                                        // Ajout bouton plus 
                                        colonnePlus = document.createElement('td');
                                        colonnePlus.innerHTML =" <span class='dot' style='width:20px'> <i style='margin-left :5px'  class='fa fa-plus'></i></span>"
                                        rows.appendChild(colonnePlus);

                                        // Ajout tableau point de passage 
                                        rows = document.createElement('tr');
                                        rows.style.background = "white";
                                        rows.style.display = "none";
                                        rows.id = "TableauPointPassage"+ idCoureur;
                                        TableResult.appendChild(rows);
										
                                        // Décalage avec position
                                        colonne = document.createElement('td');
                                        rows.appendChild(colonne);

                                        colonne = document.createElement('td');
                                        colonne.colSpan = 10;
                                        rows.appendChild(colonne);

                                        // Tableau point de passage
                                        tablePassage = document.createElement('table');
                                        tablePassage.style.width = "100%"
										tablePassage.style.background = "#E1E1E1";
										tablePassage.style.padding = "10px";
                                        colonne.appendChild(tablePassage);

										// Ajout heure de départ
                                        rows1 = document.createElement('tr');
										rows1.style.background = "white";
										rows1.style.height = "0px";
                                        // Décalage avec position
                                        colonne2 = document.createElement('td');
                                        colonne2.colSpan = 10;
										
                                        rows1.appendChild(colonne2);
										tablePassage.appendChild(rows1);

                                        // Ajout tableau point de passage 
                                        rows = document.createElement('tr');
										rows.style.background = "white";
                                        tablePassage.appendChild(rows);

                                        // Décalage avec position
                                        colonne1 = document.createElement('td');
                                        colonne1.colSpan = 10;
                                        rows.appendChild(colonne1);

										createTitlePointPassage = false;
										h= 0;
                                        for (let j = 0; j < ListCoureurs[i].Coureur.ListTempsPointPassage.length; j++) 
                                        {
											// Si point de passage départ et de la même étape
											if (ListCoureurs[i].Coureur.ListTempsPointPassage[j].IDEtape == numEtape &&
											
											(ListCoureurs[i].Coureur.ListTempsPointPassage[j].NomPointPassage == "Départ" 
											|| (ListCoureurs[i].Coureur.ListTempsPointPassage[j].TypePointPassage != undefined
											&& ListCoureurs[i].Coureur.ListTempsPointPassage[j].TypePointPassage == "1")))
											{
												var Temps = ListCoureurs[i].Coureur.ListTempsPointPassage[j].HeurePassage;
												para = document.createElement('p');
												para.innerHTML = "<i style='font-size:20px; color:blue;' class='fa fa-clock-o' ></i>"+ " Heure de départ : " + Temps
												rows1.style.height = "20px";
												colonne2.appendChild(para);
											
											}
											// Si point de passage départ d'une autre étape ne pas afficher
											else if ((ListCoureurs[i].Coureur.ListTempsPointPassage[j].NomPointPassage == "Départ" 
											&& ListCoureurs[i].Coureur.ListTempsPointPassage[j].IDEtape != numEtape)
											|| ListCoureurs[i].Coureur.ListTempsPointPassage[j].TypePointPassage != undefined
											&& ListCoureurs[i].Coureur.ListTempsPointPassage[j].TypePointPassage == "1")
											{

											}
											// point de passage 
											else if ((ListCoureurs[i].Coureur.ListTempsPointPassage[j].IDEtape == numEtape || 
											ListCoureurs[i].Coureur.ListTempsPointPassage[j].IDEtape == 0  )
											||( ListCoureurs[i].Coureur.ListTempsPointPassage[j].NomPointPassage == "Arrivée" && ListCoureurs[i].Coureur.ListTempsPointPassage[j].IDEtape != numEtape))
											{
												//Ligne En tête heure de départ
												if (!createTitlePointPassage)
												{
													createTitlePointPassage = true;
													//Ligne En tête point de passage ou étaèe
													para = document.createElement('p');
													para.innerHTML = "<i style='font-size:20px; color:blue;' class='fa fa-clock-o' ></i>"+ " Temps de passage"
													colonne1.appendChild(para);
												}
				
												h = h+1;
												//Ligne passage
												rowsPassage = document.createElement('tr');
												tablePassage.appendChild(rowsPassage);
									
												colonne = document.createElement('td');
												colonne.style.paddingLeft = "10px";
												colonne.style.paddingRight = "10px";
												colonne.style.fontWeight = "bold";
												colonne.style.fontSize = "18px";

												if (FormTypeClassement.value == "Categorie" )
												{
													colonne.innerText = ListCoureurs[i].Coureur.ListTempsPointPassage[j].PositionCategorie;
												}
												// Si le coureur dans le même sexe que afficher 
												else if (FormTypeClassement.value == "Sexe" )
												{
													colonne.innerText = ListCoureurs[i].Coureur.ListTempsPointPassage[j].PositionSexe;
												}
												else if (FormTypeClassement.value == "Scratch" ||FormTypeClassement.value == ""  )
												{
													colonne.innerText = ListCoureurs[i].Coureur.ListTempsPointPassage[j].Position;
												}
											
												rowsPassage.appendChild(colonne);
												colonne = document.createElement('td');
												colonne.style.width = "50px";
												// Si deuxième point de passage afficher progression
												if (h >  1)
												{
													lastPosPointPassage = 0;
													for (let m = j-1; m >0; m--) 
													{
														if ( ListCoureurs[i].Coureur.ListTempsPointPassage[m].TypePointPassage == undefined ||
														(ListCoureurs[i].Coureur.ListTempsPointPassage[m].TypePointPassage != 1 ))
														{
															if (FormTypeClassement.value == "Scratch" ||FormTypeClassement.value == "")
															{
																lastPosPointPassage = ListCoureurs[i].Coureur.ListTempsPointPassage[m].Position;
															}
															else if (FormTypeClassement.value == "Sexe")
															{
																lastPosPointPassage = ListCoureurs[i].Coureur.ListTempsPointPassage[m].PositionsSexe;
															}
															else if (FormTypeClassement.value == "Categorie")
															{
																lastPosPointPassage = ListCoureurs[i].Coureur.ListTempsPointPassage[m].PositionCategorie;
															}
															break;
														}
													}
													if (lastPosPointPassage > 0)
													{
														if ((FormTypeClassement.value == "Scratch" ||FormTypeClassement.value == "") && ListCoureurs[i].Coureur.ListTempsPointPassage[j].Position - lastPosPointPassage < 0)
														{
															colonne.innerHTML = " <i style='font-size:20px; color:green;' class='fa fa-arrow-up' ></i> ";
														}
														else if ((FormTypeClassement.value == "Scratch" ||FormTypeClassement.value == "") && ListCoureurs[i].Coureur.ListTempsPointPassage[j].Position - lastPosPointPassage > 0)
														{
															colonne.innerHTML  = " <i style='font-size:20px; color:orange;' class='fa fa-arrow-down' ></i> ";
														}
														else if ((FormTypeClassement.value == "Sexe") && ListCoureurs[i].Coureur.ListTempsPointPassage[j].PositionSexe - lastPosPointPassage< 0)
														{
															colonne.innerHTML = " <i style='font-size:20px; color:green;' class='fa fa-arrow-up' ></i> ";
														}
														else if ((FormTypeClassement.value == "Sexe" ) && ListCoureurs[i].Coureur.ListTempsPointPassage[j].PositionSexe - lastPosPointPassage> 0)
														{
															colonne.innerHTML  = " <i style='font-size:20px; color:orange;' class='fa fa-arrow-down' ></i> ";
														}
														else if ((FormTypeClassement.value == "Categorie") && ListCoureurs[i].Coureur.ListTempsPointPassage[j].PositionCategorie - lastPosPointPassage< 0)
														{
															colonne.innerHTML = " <i style='font-size:20px; color:green;' class='fa fa-arrow-up' ></i> ";
														}
														else if ((FormTypeClassement.value == "Categorie" ) && ListCoureurs[i].Coureur.ListTempsPointPassage[j].PositionCategorie- lastPosPointPassage> 0)
														{
															colonne.innerHTML  = " <i style='font-size:20px; color:orange;' class='fa fa-arrow-down' ></i> ";
														}
														else 
														{
															colonne.innerHTML  = " <i style='font-size:20px; color:blue;' class='fa fa-arrow-right' ></i> ";
														}
													}
												}
												rowsPassage.appendChild(colonne);

												colonne = document.createElement('td');
												if ( ListCoureurs[i].Coureur.ListTempsPointPassage[j].NomPointPassage == "Arrivée" && ListCoureurs[i].Coureur.ListTempsPointPassage[j].IDEtape != numEtape && document.getElementById("FormEtape").value.length > 0)
												{
													colonne.innerText = "étape " + ListCoureurs[i].Coureur.ListTempsPointPassage[j].IDEtape ;
												}
												else
												{
													colonne.innerText = ListCoureurs[i].Coureur.ListTempsPointPassage[j].NomPointPassage;
												}
											
												rowsPassage.appendChild(colonne);

												// Affichage heure de passage
												colonne = document.createElement('td');
												colonne.style.paddingLeft = "10px";
												colonne.style.paddingRight = "10px";
												colonne.style.width = "120px"
												colonne.innerHTML  = " <i style='font-size:20px; color:blue;' class='fa fa-clock-o' ></i> "+ListCoureurs[i].Coureur.ListTempsPointPassage[j].HeurePassage;
												rowsPassage.appendChild(colonne);


												// Type d'affichage selon catégorie , sexe ,scratch
												if (FormTypeClassement.value == "Scratch" ||FormTypeClassement.value == "")
												{

													colonne = document.createElement('td');
													colonne.style.paddingLeft = "10px";
													colonne.style.paddingRight = "10px";
													colonne.style.width = "120px";
													tableLoc = document.createElement('Table');
												
													RowLoc = document.createElement('tr');
													RowLoc.style.height = "30px";
													tableLoc.appendChild(RowLoc);
													colLoc = document.createElement('td');
													colLoc.style.margin ="1px";
													colLoc.style.fontSize = "14px";
													colLoc.innerText = ListCoureurs[i].Coureur.ListTempsPointPassage[j].PositionCategorie +" ( cat. " +ListCoureurs[i].Coureur.NumCategorie +" ) " ;
													RowLoc.appendChild(colLoc);

													RowLoc = document.createElement('tr');
													RowLoc.style.height = "30px";
													RowLoc.style.background = "transparent";
													tableLoc.appendChild(RowLoc);
													colLoc = document.createElement('td');
												
													colLoc.style.margin ="1px";
													colLoc.style.fontSize= "14px";
													if (ListCoureurs[i].Coureur.Sexe == "H")
													{
														
														colLoc.innerHTML = ListCoureurs[i].Coureur.ListTempsPointPassage[j].PositionSexe +" <i style='font-size:20px; color:blue;' class='fa fa-male' ></i> " ;
													}
													else
													{
														
														colLoc.innerHTML = ListCoureurs[i].Coureur.ListTempsPointPassage[j].PositionSexe +"  <i  style='font-size:20px; color:#FF34FE;' class='fa fa-female' ></i> " ;
													}
													RowLoc.appendChild(colLoc);
													colonne.appendChild(tableLoc);
													
													rowsPassage.appendChild(colonne);
												}

	
												// Affichage temps et écart 
												colonne = document.createElement('td');
												colonne.style.paddingLeft = "10px";
												colonne.style.paddingRight = "10px";
												if (FormTypeClassement.value == "Categorie" )
												{
													if (ListCoureurs[i].Coureur.ListTempsPointPassage[j].TempsCat.indexOf(".")>1)
													{
														var Temps = ListCoureurs[i].Coureur.ListTempsPointPassage[j].TempsCat.substring(0,ListCoureurs[i].Coureur.ListTempsPointPassage[j].TempsCat.indexOf("."));
													}
													else
													{
														var Temps = ListCoureurs[i].Coureur.ListTempsPointPassage[j].TempsCat;
													}
													
												}
												else
												{
													if (ListCoureurs[i].Coureur.ListTempsPointPassage[j].Temps.indexOf(".")>1)
													{
														var Temps = ListCoureurs[i].Coureur.ListTempsPointPassage[j].Temps.substring(0,ListCoureurs[i].Coureur.ListTempsPointPassage[j].Temps.indexOf("."));
													}
													else
													{
														var Temps = ListCoureurs[i].Coureur.ListTempsPointPassage[j].Temps;
													}
												}
											
										
												if (Temps.indexOf('00:') == 0)
												{
													colonne.innerText = Temps.slice(3,25);
												}
												else
												{
													colonne.innerText = Temps;
												}
												
												rowsPassage.appendChild(colonne);

												
												colonne = document.createElement('td');
												colonne.style.paddingLeft = "10px";
												colonne.style.paddingRight = "10px";
												var ecart = '';
												if (FormTypeClassement.value == "Categorie" )
												{
													if (ListCoureurs[i].Coureur.ListTempsPointPassage[j].EcartCategorie.indexOf(".") > -1)
													{
														ecart = ListCoureurs[i].Coureur.ListTempsPointPassage[j].EcartCategorie.substring(0,ListCoureurs[i].Coureur.ListTempsPointPassage[j].EcartCategorie.indexOf("."));
													}
													else
													{
														ecart = ListCoureurs[i].Coureur.ListTempsPointPassage[j].EcartCategorie;
													}
												}
												// Si le coureur dans le même sexe que afficher 
												else if (FormTypeClassement.value == "Sexe" )
												{
													if (ListCoureurs[i].Coureur.ListTempsPointPassage[j].EcartSexe.indexOf(".") > -1)
													{
														ecart = ListCoureurs[i].Coureur.ListTempsPointPassage[j].EcartSexe.substring(0,ListCoureurs[i].Coureur.ListTempsPointPassage[j].EcartSexe.indexOf("."));
													}
													else
													{
														ecart = ListCoureurs[i].Coureur.ListTempsPointPassage[j].EcartSexe;
													}
												}
												// Afficher tous les coureurs dans le scratch
											else if (FormTypeClassement.value == "Scratch" ||FormTypeClassement.value == "")
											{
												if (ListCoureurs[i].Coureur.ListTempsPointPassage[j].Ecart.indexOf(".") > -1)
												{
													ecart = ListCoureurs[i].Coureur.ListTempsPointPassage[j].Ecart.substring(0,ListCoureurs[i].Coureur.ListTempsPointPassage[j].Ecart.indexOf("."));
												}
												else
												{
													ecart = ListCoureurs[i].Coureur.ListTempsPointPassage[j].Ecart;
												}
											}
											if (ecart.indexOf('00:') == 0)
											{
												colonne.innerText =  ecart.slice(3,25);
											}
											else
											{
												colonne.innerText = ecart;
											}
											rowsPassage.appendChild(colonne);
											}
										}
									}	
                                    
                                }
                                // Classement Point de passage
                                // Ajout point de passage du coureur 
                                if (  ListCoureurs[i].Coureur.ListClassementPointPassage != undefined  )
                                {
									nbrClassementPassage = 0;
									
									//ne pas afficher les  points  de passage départ
									for (let z = 0;z < ListCoureurs[i].Coureur.ListClassementPointPassage.length; z++) 
									{
										if ( ListCoureurs[i].Coureur.ListClassementPointPassage[z].TypePointPassage == undefined ||
										(ListCoureurs[i].Coureur.ListClassementPointPassage[z].TypePointPassage != 1 &&
										 ListCoureurs[i].Coureur.ListClassementPointPassage[z].IDEtape == numEtape))
										{
											nbrClassementPassage++;
										}
									}
								
                                    if  ( nbrClassementPassage > 1 )
                                    {
										if (nbrPointPassage < 2 )
										{
											// Ajout bouton plus 
											colonnePlus = document.createElement('td');
											colonnePlus.innerHTML =" <span class='dot' style='width:20px'> <i style='margin-left :5px'  class='fa fa-plus'></i></span>"
											rows.appendChild(colonnePlus);
											// Ajout tableau point de passage 
											rows = document.createElement('tr');
											rows.style.background = "white";
											rows.style.display = "none";
											rows.id = "TableauPointPassage"+ idCoureur;
											TableResult.appendChild(rows);
											// Décalage avec position
											colonne = document.createElement('td');
											rows.appendChild(colonne);

											colonne = document.createElement('td');
											colonne.colSpan = 10;
											rows.appendChild(colonne);

											// Tableau point de passage
											tablePassage = document.createElement('table');
											tablePassage.style.width = "100%"
											tablePassage.style.background = "#E1E1E1";
											tablePassage.style.padding = "10px";
											colonne.appendChild(tablePassage);
										}
                                     // Ajout tableau point de passage 
                                         rows = document.createElement('tr');
                                        rows.style.background = "white";
                                        tablePassage.appendChild(rows);

                                        // Décalage avec position
                                        colonne = document.createElement('td');
                                        colonne.colSpan = 10;
                                        rows.appendChild(colonne);

                                        //Ligne En tête 
                                        para = document.createElement('p');
                                        para.innerHTML = "<i style='font-size:20px; color:blue;' class='fa fa-trophy' ></i>"+" Classement des points de passage"
                                        colonne.appendChild(para);

                                        // Tableau point de passage
                                        tablePassage = document.createElement('table');
                                        tablePassage.style.width = "100%"
                                        colonne.appendChild(tablePassage);

                                        for (let j = 0; j < ListCoureurs[i].Coureur.ListClassementPointPassage.length; j++) 
                                        {
											if ((ListCoureurs[i].Coureur.ListClassementPointPassage[j].TypePointPassage == undefined 
											|| ListCoureurs[i].Coureur.ListClassementPointPassage[j].TypePointPassage != 1)
											&& ListCoureurs[i].Coureur.ListClassementPointPassage[j].IDEtape == numEtape )
											{
												//Ligne passage
												rowsPassage = document.createElement('tr');
												tablePassage.appendChild(rowsPassage);

												colonne = document.createElement('td');
												colonne.style.paddingLeft = "10px";
												colonne.style.paddingRight = "10px";
												colonne.style.fontWeight = "bold";
												colonne.style.fontSize = "18px";

												if (FormTypeClassement.value == "Categorie" )
												{
													colonne.innerText = ListCoureurs[i].Coureur.ListClassementPointPassage[j].PositionCategorie;
												}
												// Si le coureur dans le même sexe que afficher 
												else if (FormTypeClassement.value == "Sexe" )
												{
													colonne.innerText = ListCoureurs[i].Coureur.ListClassementPointPassage[j].PositionSexe;
												}
											
												else if (FormTypeClassement.value == "Scratch" ||FormTypeClassement.value == ""  )
												{
													colonne.innerText = ListCoureurs[i].Coureur.ListClassementPointPassage[j].Position;
												}
											
												rowsPassage.appendChild(colonne);

												// Colonne vide
												colonne = document.createElement('td');
												colonne.style.width = "50px";
												rowsPassage.appendChild(colonne);

												// Nom du point de passage 
												colonne = document.createElement('td');
												colonne.innerText = ListCoureurs[i].Coureur.ListClassementPointPassage[j].NomPointPassage;
												rowsPassage.appendChild(colonne);


												//Colonne vide
												colonne = document.createElement('td');
												colonne.style.paddingLeft = "10px";
												colonne.style.paddingRight = "10px";
												colonne.style.width = "120px"
												rowsPassage.appendChild(colonne);

												// Type d'affichage selon catégorie , sexe ,scratch
												if (FormTypeClassement.value == "Scratch" ||FormTypeClassement.value == "")
												{
													colonne = document.createElement('td');
													colonne.style.paddingLeft = "10px";
													colonne.style.paddingRight = "10px";
													colonne.style.width = "120px";
													tableLoc = document.createElement('Table');

													RowLoc = document.createElement('tr');
													RowLoc.style.height = "30px";
													tableLoc.appendChild(RowLoc);
													colLoc = document.createElement('td');
													colLoc.style.margin ="1px";
													colLoc.style.fontSize = "14px";
													colLoc.innerText = ListCoureurs[i].Coureur.ListClassementPointPassage[j].PositionCategorie +" ( cat. " +ListCoureurs[i].Coureur.NumCategorie +" ) " ;
													RowLoc.appendChild(colLoc);

													RowLoc = document.createElement('tr');
													RowLoc.style.height = "30px";
													RowLoc.style.background = "transparent";
													tableLoc.appendChild(RowLoc);
													colLoc = document.createElement('td');
												
													colLoc.style.margin ="1px";
													colLoc.style.fontSize= "14px";
													if (ListCoureurs[i].Coureur.Sexe == "H")
													{
														
														colLoc.innerHTML = ListCoureurs[i].Coureur.ListClassementPointPassage[j].PositionSexe +" <i style='font-size:20px; color:blue;' class='fa fa-male' ></i> " ;
													}
													else
													{
														
														colLoc.innerHTML = ListCoureurs[i].Coureur.ListClassementPointPassage[j].PositionSexe +"  <i  style='font-size:20px; color:#FF34FE;' class='fa fa-female' ></i> " ;
													}
													RowLoc.appendChild(colLoc);
													colonne.appendChild(tableLoc);
													
													rowsPassage.appendChild(colonne);
												}
												colonne = document.createElement('td');
												colonne.style.paddingLeft = "10px";
												colonne.style.paddingRight = "10px";
												if (FormTypeClassement.value == "Categorie" )
												{
													if (ListCoureurs[i].Coureur.ListClassementPointPassage[j].TempsCat.indexOf(".")>1)
													{
														var Temps = ListCoureurs[i].Coureur.ListClassementPointPassage[j].TempsCat.substring(0,ListCoureurs[i].Coureur.ListClassementPointPassage[j].TempsCat.indexOf("."));
													}
													else
													{
														var Temps = ListCoureurs[i].Coureur.ListClassementPointPassage[j].TempsCat;
													}
													
												}
												else
												{
													if (ListCoureurs[i].Coureur.ListClassementPointPassage[j].Temps.indexOf(".")>1)
													{
														var Temps = ListCoureurs[i].Coureur.ListClassementPointPassage[j].Temps.substring(0,ListCoureurs[i].Coureur.ListClassementPointPassage[j].Temps.indexOf("."));
													}
													else
													{
														var Temps = ListCoureurs[i].Coureur.ListClassementPointPassage[j].Temps;
													}
												}
												
											
												if (Temps.indexOf('00:') == 0)
												{
													colonne.innerText = Temps.slice(3,25);
												}
												else
												{
													colonne.innerText = Temps;
												}
												
												rowsPassage.appendChild(colonne);

												
												colonne = document.createElement('td');
												colonne.style.paddingLeft = "10px";
												colonne.style.paddingRight = "10px";
												var ecart = '';
												if (FormTypeClassement.value == "Categorie" )
												{
													if (ListCoureurs[i].Coureur.ListClassementPointPassage[j].EcartCategorie.indexOf(".") > -1)
													{
														ecart = ListCoureurs[i].Coureur.ListClassementPointPassage[j].EcartCategorie.substring(0,ListCoureurs[i].Coureur.ListClassementPointPassage[j].EcartCategorie.indexOf("."));
													}
													else
													{
														ecart = ListCoureurs[i].Coureur.ListClassementPointPassage[j].EcartCategorie;
													}
												}
												// Si le coureur dans le même sexe que afficher 
												else if (FormTypeClassement.value == "Sexe" )
												{
													if (ListCoureurs[i].Coureur.ListClassementPointPassage[j].EcartSexe.indexOf(".") > -1)
													{
														ecart = ListCoureurs[i].Coureur.ListClassementPointPassage[j].EcartSexe.substring(0,ListCoureurs[i].Coureur.ListClassementPointPassage[j].EcartSexe.indexOf("."));
													}
													else
													{
														ecart = ListCoureurs[i].Coureur.ListClassementPointPassage[j].EcartSexe;
													}
												}
												// Afficher tous les coureurs dans le scratch
												else if (FormTypeClassement.value == "Scratch" ||FormTypeClassement.value == "")
												{
													if (ListCoureurs[i].Coureur.ListClassementPointPassage[j].Ecart.indexOf(".") > -1)
													{
														ecart = ListCoureurs[i].Coureur.ListClassementPointPassage[j].Ecart.substring(0,ListCoureurs[i].Coureur.ListClassementPointPassage[j].Ecart.indexOf("."));
													}
													else
													{
														ecart = ListCoureurs[i].Coureur.ListClassementPointPassage[j].Ecart;
													}
												}
												if (ecart.indexOf('00:') == 0)
												{
													colonne.innerText =  ecart.slice(3,25);
												}
												else
												{
													colonne.innerText = ecart;
												}
												rowsPassage.appendChild(colonne);
											}
										}
									}
                             	}
							}
						}
					}
				}
			}
		}

		function AddFavoris(i)
		{
			var IconFavori= document.getElementById('Star'+i);
			IconFavori.style.color = 'Yellow';
		}

		function ChangParcours(selectObject)
		{  
			console.log("Fonction changParcours");
			document.getElementById("FormParcours").value =selectObject.value;
			document.getElementById("FormDepart").value ="0";
			document.getElementById("FormEtape").value ="0";
			elmnt = document.getElementById("FormSendIndfo");
			elmnt.submit();
		}

		function ChangDepart(selectObject)
		{  

			console.log("Fonction changDepart");
			document.getElementById("FormEtape").value ="0";
			document.getElementById("FormDepart").value = selectObject.value;
			elmnt = document.getElementById("FormSendIndfo");
			elmnt.submit();
		}

		function ChangEtape(selectObject)
		{  
			document.getElementById("FormEtape").value =selectObject.value;
			
			if (document.getElementById("TypeClassement").length = 0)
			{
				document.getElementById("TypeClassement").value ="Scratch";
			}
			elmnt = document.getElementById("FormSendIndfo");
			elmnt.submit();
		}
		var DivViewLiveCoureur= document.getElementById('ViewLiveCoureur');
		function ViewDetailCoureur(Coureur)
		{
			var TableDetailCoureur= document.getElementById("TableauPointPassage"+ Coureur);
			if (TableDetailCoureur.style.display == "none")
            {
                TableDetailCoureur.style.display = "";
            }
            else
            {
                TableDetailCoureur.style.display = "none";
            }
 
		}

		function TableResume(IDSVG, ColimgEtapePara)
		{
			
			TableTotal2 = document.createElement('Table');
			TableTotal2.style.width ="100%";
			tr1 = document.createElement('Tr');
			
			td1 = document.createElement('Td');
			td1.style.width = "20%";
			td1.innerHTML = "Total distance : ";
			tr1.append(td1);
			
			td2 = document.createElement('Td');
			td2.style.width = "15%";
			td2.setAttribute("id", IDSVG+"TotalKM");
			tr1.append(td2);
			
			td3 = document.createElement('Td');
			td3.style.width = "20%";
			td3.innerHTML = "Total D+ : ";
			tr1.append(td3);
			
			td4 = document.createElement('Td');
			td4.style.width = "15%";
			td4.setAttribute("id", IDSVG+"ELevationTotal");
			tr1.append(td4);
			
			td5 = document.createElement('Td');
			td5.style.width = "20%";
			td5.innerHTML = "Total D- : ";
			tr1.append(td5);
			
			td6 = document.createElement('Td');
			td6.style.width = "15%";
			td6.setAttribute("id", IDSVG+"DiminutionTotal");
			tr1.append(td6);
			TableTotal2.append(tr1);
			
			tr2 = document.createElement('Tr');
			
			td11 = document.createElement('Td');
			td11.style.width = "20%";
			td11.innerHTML = "altitude Min : ";
			tr2.append(td11);
			
			td12 = document.createElement('Td');
			td12.style.width = "15%";
			td12.setAttribute("id", IDSVG+"ElevationMin");
			tr2.append(td12);
			
			td13 = document.createElement('Td');
			td13.style.width = "20%";
			td13.innerHTML = "altitude Max :";
			tr2.append(td13);
			
			td14 = document.createElement('Td');
			td14.style.width = "15%";
			td14.setAttribute("id", IDSVG+"ElevationMax");
			tr2.append(td14);
			TableTotal2.append(tr2);
			
			//ColimgEtapePara.append(TableTotal2);
			
		}

		function mapSvg(IDSVG, FileName, ColimgEtapePara,Etape,Parcours)
		{
            console.log("Functionmapsvg")
			indexPassage = 1;
			TableTotal = document.createElement('Table');
			TableTotal.style.width ="80%";
			TableTotal.setAttribute("id", IDSVG+"ImageMap");

			let box = document.querySelector('div');
			Width = box.offsetWidth - 200;

			tr2 = document.createElement('Tr');
			td2 = document.createElement('Td');
			
			divGraph = document.createElement('div');
			divGraph.style.height ="300px";
			divGraph.setAttribute("id", IDSVG+"conteneurSVG");
			
			td2.append(divGraph);
			tr2.append(td2);
			TableTotal.append(tr2);
			
			ColimgEtapePara.append(TableTotal);
			TableResume(IDSVG, ColimgEtapePara);
			AddSvg(IDSVG, FileName,Etape, Parcours);
		}

		// Ajout Graphique dénivellé verticale
		function AddSvg(IDSVG, FileName,Etape, Parcours)
		{
			//Création  ZONE DE DESSIN 

			var GraphiqueSVG = document.createElementNS("http://www.w3.org/2000/svg",'svg');

			GraphiqueSVG.style.width = (Width + (DecalageStartWidth*2) ) +'px';
			GraphiqueSVG.style.height = (Height + (DecalageStartHeight*2))+'px';
			svgWidth =Width + (DecalageStartWidth*2) ;
			svgHeight = Height + (DecalageStartHeight*2);
			GraphiqueSVG.setAttribute("viewBox", "0 0 "+ svgWidth+" "+svgHeight); 
			GraphiqueSVG.id = IDSVG+'image1';
			
			var conteneur = document.getElementById(IDSVG+"conteneurSVG");
			console.log(IDSVG+"conteneurSVG");
			conteneur.style.height = (Height + (DecalageStartHeight*2))+'px';
			conteneur.appendChild(GraphiqueSVG);


			//Lecture FCIHIER GPX 

			var CountPassage = 0;
			// Create a connection to the file.

			var Connect = new XMLHttpRequest();
			Connect.open("GET", FileName, false);
			Connect.setRequestHeader("Content-Type", "text/xml");
			Connect.send(null);
		
			// Place the response in an XML document.
			var TheDocument = Connect.responseXML;

			// Place the root node in an element.
			var Customers = TheDocument.childNodes[0];

			var LastPoint = null;
			TotalKM = 0;
			TotalDiminution = 0;
			TotalELevation = 0;
			StartElevation = 0;
			ElevationMin = 10000;
			ElevationMax = 0;
			var ArrayPoint = [];
			var NombreKMH = 9.2;
			var HeureDepart = 5;
			var JourDepart = 4;
			var MoisDepart = 'Juillet';

			// transforme le fichier GPX lu selon les balises xml

			for (var i = 0; i < Customers.children.length; i++)
			{
				var Trk = Customers.children[i];
				// Balise TRK 
				if (Trk.tagName == "trk" )
				{
					for (var j = 0; j < Trk.children.length; j++)
					{
						var TrkSeg = Trk.children[j];
	
						for (var m = 0; m < TrkSeg.children.length; m++)
						{
							// ** Modifier comparer a read gpx du tour du jura
					
							var x = TrkSeg.children[m].getElementsByTagName("ele")[0];
								if (x!= undefined)
								{
								var y = x.childNodes[0];
								var elevation = y.nodeValue;
							
								//****** CALCUL ELEVATION MINIMUM ******/
								if (parseFloat(elevation) < ElevationMin)
								{
									ElevationMin = elevation;							
								}
								// ****** CALCUL ELEVATION MAX *******/
								
								if (parseFloat(elevation) > ElevationMax)
								{
									ElevationMax = elevation;
								}
					
								var lat =  TrkSeg.children[m].attributes.getNamedItem("lat").value ;
								var lon =  TrkSeg.children[m].attributes.getNamedItem("lon").value ;

								/*** CALCUL DISTANCE ENTRE DEUX POINT SANS DENIVELATION **/
								var point = new Object();
								if (LastPoint != null)
								{
									var KM =	distance(LastPoint.Lat , LastPoint.Lon,lat,lon);
									point.elevation = elevation;
									
									TotalKM = TotalKM+ KM;
									DiffElevation = 0;
									DiffDiminution = 0;
									if (parseFloat(point.elevation) > parseFloat(LastPoint.elevation))
									{
										DiffElevation = parseFloat(point.elevation) - parseFloat(LastPoint.elevation);
									}
									else
									{
										DiffDiminution = (parseFloat(LastPoint.elevation) - parseFloat(point.elevation))*-1;
									}
									point.TotalDiminution = parseFloat(LastPoint.TotalDiminution) + parseFloat(DiffDiminution);
									point.TotalELevation = parseFloat(LastPoint.TotalELevation) + parseFloat(DiffElevation);
									TotalELevation = point.TotalELevation;
									TotalDiminution =  point.TotalDiminution;
									point.Lat = lat;
									point.Lon = lon;
									point.KM = TotalKM;

								}
								else // ****** KM 0 ********
								{
									point.elevation = elevation;
									point.TotalELevation = 0;
									point.TotalDiminution = 0;
									point.Lat = lat;
									point.Lon = lon;
									point.KM = 0;
									StartElevation = elevation;
									
								}
								// AJout du ponit au tableau
								point.index = ArrayPoint.length;
								ArrayPoint.push(point);
								
								///* Mise en mémoire de la position pour le prochaine calcul **)
								LastPoint = point;
							}
						}
					}

					FeneterElevation = (ElevationMax - ElevationMin);
				}
			}
			LastPoint = null;
			//____________________________________________________________________________________________
			//																															*
			//	CREATION AFFICHAGE SELON LE TABLEAU DE POINT LU DANS LE FICHIER GPX 
			//
		
			// 			Lecture de chaque point sur le fichier et transformation 
			//			en valeur en Pourcent pour affichage
			//			au meme format de chaque fichier GPX
			
			for (var i = 0; i < ArrayPoint.length; i++)
			{
				var Point = ArrayPoint[i];
				if ( LastPoint != null )
				{
					// Premier point
					if (i ==1)
					{
						AddPoint ( LastPoint, Point, GraphiqueSVG, true,false );
					}
					// Point finish
					else if (i == ArrayPoint.length-1 )
					{
						AddPoint ( LastPoint, Point, GraphiqueSVG, false,true );
					}
					else 
					{
						AddPoint ( LastPoint, Point, GraphiqueSVG, false,false );
					}
				}
				LastPoint = Point;
			}	

			// AJOUT LIGNE Vertical Coordonnée Y DENIVELATION 

			intElevation = parseInt(ElevationMin / 100)
			// Ligne tous les 100 mètres
			ValueElevationArrondi = intElevation * 100;

			while (ValueElevationArrondi < ElevationMax )
			{
				AddLigneElevation(ValueElevationArrondi, GraphiqueSVG );	
				
				ValueElevationArrondi = ValueElevationArrondi +100;
			}

			// AJOUT LIGNE Horizontal Coordonnée X KM 

			if (TotalKM >50)
			{
				//Ajout Thick ligne tous les 10 km 
				NbrPart = parseInt(TotalKM/10);
				partKM = TotalKM / (TotalKM/10);
			}
			else if (TotalKM >25)
			{
				// Ajout Thick ligne tous les 5 km
				NbrPart = parseInt(TotalKM/5);
				partKM = TotalKM / (TotalKM/5);
			}
			else 
			{
				// Ajout Thick ligne tous les km 
				NbrPart = parseInt(TotalKM/1);
				partKM = TotalKM / (TotalKM/1);
			}

			// Ajout des ligne vertical du km
			for (var i = 0; i < NbrPart +1; i++)
			{
				AddLigneVertical(partKM * i,  GraphiqueSVG );	
			}

			console.log(Etape)
			// Ajout des ligne vertical des point passage
			for (var i = 0; i < Etape.ListPointPassage.ListItem.length ; i++)
			{
				AddLigneVerticalPointDePassage(Etape.ListPointPassage.ListItem[i].Distance._Value,  GraphiqueSVG ,Etape.ListPointPassage.ListItem[i].Nom._Value ) ;	
			}

			// Ajout nombre de coureur restant a passer dans le point de passage sur le graphique
			// Reprise du dernier point de passage moins le point de passage avant dernier
			if (Parcours != undefined &&   Parcours.info != undefined && Parcours.info.ListLivePointDePassage != undefined )
			{
				for (var i = 1; i < Parcours.info.ListLivePointDePassage.length ; i++)
				{
				

					// afin de mettre le texte au mileux du texte on va calculer le mileux selon la catégorie

					var DistanceEndPoint = (Parcours.info.ListLivePointDePassage[i].Distance ) ;

					AddTextCoureurRestantPointDePassage( parseFloat(Parcours.info.ListLivePointDePassage[i-1].Distance), parseFloat(DistanceEndPoint) ,  GraphiqueSVG , Parcours.info.ListLivePointDePassage[i].ListCoureursRestant.length,Parcours);	


				}
			}
		}

		var TextSelected; 
		var LastPassage = new Object();
		// Numéro du passage trouver pour ce point
		var IDPassageFind = 0;
		var uiCountKM = 0;
		var posXMax = -100000000000000;
		var posXMin = 100000000000000;
		var posYMax = -100000000000000;
		var posYMin = 100000000000000;
	/***** FUNCTION AJOUT DE POINT SUR LES DESSINS ****/
	function AddPoint(LastPoint, Point  , GraphiqueSVG, xStart, xFinish)
	{
		// Position de la ligne déniveller 
		posX1 = TransformDistanceEnPxl(LastPoint.KM) + DecalageStartWidth;
		posY1 =	TransformElevationEnPxl(LastPoint.elevation) + DecalageStartHeight;
		posX2 =	TransformDistanceEnPxl(Point.KM) + DecalageStartWidth;
		Posy2 =	TransformElevationEnPxl(Point.elevation) + DecalageStartHeight;
		

		/****** AJOUT LIGNE DU GRAPHIQUE ELEVATION****/
		var maLigne1 = document.createElementNS("http://www.w3.org/2000/svg",'line');

		// POsition Maximal et minimum
		if (posX1 > posXMax)
		{
			posXMax = posX1;
		}
		if (posX1 < posXMin)
		{
			posXMin = posX1;
		}

		if (posY1 > posYMax)
		{
			posYMax = posY1;
		}
		if (posY1 < posYMin)
		{
			posYMin = posY1;
		}

		maLigne1.setAttribute('id', 'LineElevation'+ Point.index );
		maLigne1.setAttribute('x1', posX1+ 'px');
		maLigne1.setAttribute('y1', posY1 + 'px');
		maLigne1.setAttribute('x2', posX2 +'px');
		maLigne1.setAttribute('y2', Posy2 +'px');
		maLigne1.setAttribute('stroke','#2680fb');
		maLigne1.setAttribute('stroke-width',3);
		maLigne1.setAttribute('stroke-linecap','round');
		
		GraphiqueSVG.appendChild(maLigne1);

		/* Evénement ligne elevation */
		document.getElementById('LineElevation'+ Point.index).addEventListener('click', function(e) 
		{
			e.currentTarget.setAttribute('stroke', '#ff00cc');
			e.currentTarget.setAttribute('stroke-width', 10);
			document.getElementById("Lat").value = LastPoint.Lat ;
			document.getElementById("Len").value = LastPoint.Lon;
			document.getElementById("ele").value = LastPoint.elevation;
			document.getElementById("dist").value = LastPoint.KM;
		});
		
		
	}

	/** FUNCTION DESSINER LA LIGNE DE DISTANCE *************/
	function AddLigneVertical( value, GraphiqueSVG )
	{
			
		var DistancenPxl = TransformDistanceEnPxl(value) + DecalageStartWidth;
		/*** AFFICHAGE TEXT AU DöBUT DE LA LIGNE *****/
		var HeightLine = Height + DecalageStartHeight;
		var newText = document.createElementNS("http://www.w3.org/2000/svg",'text');
		newText.setAttributeNS(null,"x", (DistancenPxl -10) +'px');     
		newText.setAttributeNS(null,"y", (HeightLine+20) +'px'); 
		newText.setAttributeNS(null,"font-size","12");
		
		var textNode = document.createTextNode(Math.round(value));
		newText.appendChild(textNode);
		GraphiqueSVG.appendChild(newText);


		var maLigne1 = document.createElementNS("http://www.w3.org/2000/svg",'line');
		maLigne1.setAttribute('x1', DistancenPxl + 'px');
		maLigne1.setAttribute('y1', (HeightLine -10) + 'px');
		maLigne1.setAttribute('x2', DistancenPxl + 'px');
		maLigne1.setAttribute('y2',  (HeightLine+10) +'px');
		maLigne1.setAttribute('stroke','#000000');
		maLigne1.setAttribute("style","opacity:0.2");
		maLigne1.setAttribute('stroke-width',1);
		maLigne1.setAttribute('stroke-linecap','round');
		GraphiqueSVG.appendChild(maLigne1);
	}

	/** FUNCTION DESSINER LA LIGNE DE DISTANCE *************/
	function AddLigneVerticalPointDePassage( value, GraphiqueSVG ,Text)
	{
		var DistancenPxl = TransformDistanceEnPxl(value) + DecalageStartWidth;

			/*** AFFICHAGE TEXT AU DöBUT DE LA LIGNE *****/
		var HeightLine = Height + DecalageStartHeight;
		var newText = document.createElementNS("http://www.w3.org/2000/svg",'text');
		newText.setAttributeNS(null,"x", (DistancenPxl-20 ) +'px');     
		newText.setAttributeNS(null,"y", (Height-100) +'px'); 
		newText.setAttributeNS(null,"font-size","12");
		
		var textNode = document.createTextNode(Text);
		newText.appendChild(textNode);
		GraphiqueSVG.appendChild(newText);
	
		var HeightLine = Height + DecalageStartHeight;
		var maLigne1 = document.createElementNS("http://www.w3.org/2000/svg",'line');
		maLigne1.setAttribute('x1', DistancenPxl + 'px');
		maLigne1.setAttribute('y1', (HeightLine) + 'px');
		maLigne1.setAttribute('x2', DistancenPxl + 'px');
		maLigne1.setAttribute('y2',  (Height -90) +'px');
		maLigne1.setAttribute('stroke','#000000');
		maLigne1.setAttribute("style","opacity:1");
		maLigne1.setAttribute('stroke-width',1);
		maLigne1.setAttribute('stroke-linecap','round');
		GraphiqueSVG.appendChild(maLigne1);

	}

	// Ajout texte entre chaque point passage
	function AddTextCoureurRestantPointDePassage( valueStart, valueEnd, GraphiqueSVG ,Text, Parcours)
	{
		if (Text > 0)
		{
			console.log("funAddTextCoureurRestantPointDePassage");

			var StartPxl = TransformDistanceEnPxl(valueStart) + DecalageStartWidth;
			var EndPxl = TransformDistanceEnPxl(valueEnd) + DecalageStartWidth;
			console.log(StartPxl);
			console.log(EndPxl);
			
			var HeightLine = Height + DecalageStartHeight;
			var newText = document.createElementNS("http://www.w3.org/2000/svg",'text');

			// 100 % des coureurs = Height-100;
			// 
			HeightPourCent =100 /( Parcours.info.ListLivePointDePassage[0].ListCoureursArrivee.length / Text)
			console.log(HeightPourCent)
			var Rectangle1 = document.createElementNS("http://www.w3.org/2000/svg",'rect');
			Rectangle1.setAttribute('x', (StartPxl +10)+ 'px');
			Rectangle1.setAttribute('y', (HeightLine - HeightPourCent)+ 'px');
			Rectangle1.setAttribute('width', EndPxl - StartPxl-20+ 'px');
			Rectangle1.setAttribute('height',  (HeightPourCent) +'px');
			Rectangle1.setAttribute('fill','#3D6CA4');
			Rectangle1.setAttribute("style","opacity:0.3");
			Rectangle1.setAttribute('stroke-width',1);
			Rectangle1.setAttribute('stroke-linecap','round');
			GraphiqueSVG.appendChild(Rectangle1);

			DistancenPxl = StartPxl + ((EndPxl -StartPxl) /2)

			var RectangleText = document.createElementNS("http://www.w3.org/2000/svg",'svg');
			RectangleText.setAttribute('x', (DistancenPxl-15)+ 'px');
			RectangleText.setAttribute('y', ((HeightLine - HeightPourCent)-30 )+'px');
			RectangleText.setAttribute('width',  '40px');
			RectangleText.setAttribute('height', '30px');
			RectangleText.setAttribute('fill','#3D6CA4');

			var useSVG = document.createElementNS('http://www.w3.org/2000/svg', 'image');
			useSVG.setAttribute('href','Coureurs.png');
			useSVG.setAttribute('fill','#3D6CA4');
			useSVG.setAttribute('x','10');
			useSVG.setAttribute('y','0');
			useSVG.setAttribute('width','30');
			useSVG.setAttribute('height','30');

			var RectangleNbrCoureur = document.createElementNS("http://www.w3.org/2000/svg",'rect');
			Rectangle1.setAttribute('x', (StartPxl +10)+ 'px');
			Rectangle1.setAttribute('y', (HeightLine - HeightPourCent)+ 'px');
			Rectangle1.setAttribute('width', EndPxl - StartPxl-20+ 'px');
			Rectangle1.setAttribute('height',  (HeightPourCent) +'px');
			Rectangle1.setAttribute('fill','#3D6CA4');
			Rectangle1.setAttribute("style","opacity:0.3");
			Rectangle1.setAttribute('stroke-width',1);
			Rectangle1.setAttribute('stroke-linecap','round');
			GraphiqueSVG.appendChild(Rectangle1);

			newText.setAttributeNS(null,"x", (DistancenPxl-13)+ 'px');    
			newText.setAttributeNS(null,"y", ((HeightLine - HeightPourCent)-30 )+'px');
			newText.setAttributeNS(null,"font-size","14");
	
			var textNode = document.createTextNode(Text);
			newText.appendChild(textNode);

			GraphiqueSVG.appendChild(newText);

			RectangleText.appendChild(useSVG);	
			GraphiqueSVG.appendChild(RectangleText);
		
		}
	}

	/** FUNCTION DESSINER LA LIGNE   ELEVATION D+ *************/
	function AddLigneElevation( value, GraphiqueSVG )
	{
		var ELevationPxl = TransformElevationEnPxl(value) + DecalageStartHeight;
			/*** AFFICHAGE TEXT AU DöBUT DE LA LIGNE *****/
		var newText = document.createElementNS("http://www.w3.org/2000/svg",'text');
		newText.setAttributeNS(null,"x",'10px');     
		newText.setAttributeNS(null,"y",(ELevationPxl) +'px'); 
		newText.setAttributeNS(null,"font-size","12");
		
		var textNode = document.createTextNode(Math.round(value));
		newText.appendChild(textNode);
		GraphiqueSVG.appendChild(newText);

		var maLigne1 = document.createElementNS("http://www.w3.org/2000/svg",'line');
		maLigne1.setAttribute('x1',  (DecalageStartWidth - 50) +'px');
		maLigne1.setAttribute('y1', ELevationPxl+ 'px');
		maLigne1.setAttribute('x2', (Width + DecalageStartWidth)+'px');
		maLigne1.setAttribute('y2',  ELevationPxl +'px');

		maLigne1.setAttribute('stroke','#000000');
		maLigne1.setAttribute("style","opacity:0.2");
		maLigne1.setAttribute('stroke-width',1);

		maLigne1.setAttribute('stroke-linecap','round');
		GraphiqueSVG.appendChild(maLigne1);
	}


	function valider()
	{
		var table = document.getElementsByClassName("TableauResulat");
		input = document.getElementById("InputSearch");
		
		inputPrenom = document.getElementById("InputSearch");
		
		filter = input.value.toUpperCase();
		filterPrenom = inputPrenom.value.toUpperCase();
		var i;
		console.log(table);
		for (i = 0; i < table.length; i++) 
		{
			var tr = table[i].getElementsByTagName("tr");
			var j;
			var NbrTr = 0 ;
			for (j = 0; j < tr.length; j++) 
			{
				var td = tr[j].getElementsByTagName("td");
				var y;
				mainloop:
				for (y = 0; y < td.length; y++) 
				{
					if ( td[y].innerHTML.toUpperCase().indexOf(filter)>-1 )
					{
						var z;
						for (z = 0; z < td.length; z++) 
						{
							if ( td[z].innerHTML.toUpperCase().indexOf(filterPrenom)>-1 )
							{
								tr[j].style.display = "";
								NbrTr++;
								break mainloop;
							}
						
						}
					
					}
					else
					{
						tr[j].style.display = "none";					
					
					}
				
				}
				
			}
					console.log(NbrTr);
			// Masquer tableau si aucune ligne
			if (NbrTr==0)
			{
		
				table[i].style.display = "none";	
			}
			else
			{
				table[i].style.display = "";	
			}
		
		}
	}

	
function AddMember()
{
	// Appelle fonction php pour ajouter un

$('formChoiceMember').request({
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

    </script>


	<?php
	if (strpos($_GET["TypeClassement"],'File')>-1)
	{
		$TypeClass = str_replace('File','',$_GET["TypeClassement"]);
		$pathfolder = 'courses/'.$_GET['NomCourse'].$ANNEE_COURSE.'/'.$Parcours.'/'.$Depart;
		if ($numetape >0 && $numetape <99)
		{
			$pathfolder = $pathfolder   .'/Etape'.$numetape;
		}
		elseif ($numetape == 99)
		{
		
			$pathfolder = $pathfolder .'/General/ResultatWeb' ;
		}
		else
		{
			$pathfolder = $pathfolder   .'/Etape1';
		}
		$pathfolder = $pathfolder   .'/ResultatWeb/'.$TypeClass;
		if (file_exists($pathfolder))
		{
		
			if (($handle = fopen($pathfolder, "r")) !== FALSE) 
			{
				?>
				<script>
		
			</script>
				<script>
					// Table du classement sélectionné 
					const TablePointPassage = document.createElement("Table");
					TablePointPassage.style.width = "100%";
					TablePointPassage.id = "TableResult";
					TablePointPassage.classList.add("TableauResulat");
					DivViewLiveCoureur.appendChild(TablePointPassage);
				</script>
				<?
				while (($data = fgetcsv($handle, 1000, ";")) !== FALSE) 
				{
					$en_tete = false;?>
				<script>
					ligneTab = document.createElement("tr");
							
					TablePointPassage.appendChild(ligneTab);
					</script>
					<?
								$num = count($data);
					// Lecture fichier CSV 
					for ($c=0; $c < $num; $c++)
					{

						if ($data[$c] == "pos"   ||$data[$c] == "Rang" )
						{
							$start_array = true;
							$en_tete = true;
						}

						if ($start_array)
						{
							if($en_tete)
							{?>
								<script>
									//En tête tableau athlète
								TitleCol = document.createElement("th");
								TitleCol.style.backgroundColor  = "#1e8ac2";
								TitleCol.style.fontWeight  = "Bold";
								TitleCol.style.color  = "white";
								TitleCol.style.paddingLeft = "10px";
								TitleCol.innerText =<?echo json_encode($data[$c]) ?>;
								ligneTab.appendChild(TitleCol);
								</script>
								<?
								
							}
							else if (strlen($data[0])>0) //Tableau athlète avec position 
							{
								?>
								<script>
						
								col = document.createElement("td");
								col.style.backgroundColor  = "transparent";
								col.innerText =<?echo json_encode($data[$c]) ?>;
								col.style.fontSize  = "20px";
								col.style.fontWeight  = "Bold";
								col.style.paddingLeft = "10px";
								ligneTab.appendChild(col);
								</script>
								<?
							}
							else  //Tableau athlète sans position
							{
								?>
								<script>
								
								col2 = document.createElement("td");
								col2.innerText =<?echo json_encode($data[$c]) ?>;
								col2.style.fontSize  = "12px";
								col2.style.fontWeight  = "Normal";
								col2.style.paddingLeft = "10px";
								ligneTab.appendChild(col2);
								</script>
								<?
							}
						}
						else if (strlen($data[$c])> 0) // SI on a pas commencer le tableau
						{
							?>
								<script>
							TitleCol = document.createElement("p");
							TitleCol.innerText =<?echo json_encode($data[$c]) ?>;
							ligneTab.appendChild(TitleCol);
							</script>
							<?
						}
					}
				}
			}
		}
	}?>

<script>
			window.onscroll = function () { 

//ColorMenuParcours();

 if (document.body.scrollTop > 50 || document.documentElement.scrollTop > 50) {

document.getElementById("GoToTop").style.visibility = "visible";
} else {
document.getElementById("GoToTop").style.visibility = "hidden";

}

};

</script>
<?php
if ($indexDepartSelected > 0  && $Etape > 0 )
{
	if ($indexParcoursSelected < 99  && $Etape < 99 ) 
	{?>
		<script>
		console.log("Call Function Read File Resultat");
		readFileResultat(parseInt( <?php echo json_encode($_GET['NbrEtape']); ?>),<?php echo json_encode($pathfolder); ?>,<?php echo json_encode($Etape); ?> )
		</script>
		<?php
	}
	else
	{?>
		<script>
		console.log("Call Function Read File Resultat General");
		readFileResultat(parseInt( <?php echo json_encode($_GET['NbrEtape']); ?>),<?php echo json_encode($pathfolder); ?>,99 )
		</script>
	<?
	}
}?>
<script>