<!DOCTYPE html>
<html>

<head>
	<meta property="og:description" content="chronométrage, chrono, jura, franches-montagnes, Jura défi, course à pied, Sport, Jura défi chrono" />  
	<title>Défi Chrono</title>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, maximum-scale=1.0, user-scalable=yes">
	<metahttp-equiv = 'cache-control' content = 'no-cache'>
	<metahttp-equiv = 'expires' content = '0'>
	<metahttp-equiv = 'pragma' content = 'no-cache'>
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css">
	<link rel="stylesheet" title="defaut" media="screen" href="styleV6.css" type="text/css"/>
	<!-- Import Leaflet CSS Style Sheet -->
<link rel="stylesheet" href="https://unpkg.com/leaflet@1.0.3/dist/leaflet.css" />

<!-- Import Leaflet JS Library -->
<script src="https://unpkg.com/leaflet@1.0.3/dist/leaflet.js"></script>
<script src="../js/prototype.js" ></script>
<script src="../js/FonctionDefiChrono2.js?version = 1.0.0"></script>
<script>

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
	

	$Parcours = $_GET['Parcours'];
	$Classement = $_GET['Classement'];
	$Depart = $_GET['Depart'];
	$Etape = $_GET['Etape'];

	if ($NOM_COURSE =='Jura Défi'  || (($NOM_COURSE =='Trophée du Doubs DMT Microtechnique' || $NOM_COURSE =='Critérium Le Noirmont' )&& $Etape == 99 ))
	{
		header('Location: Resultat2023GeneralJuraDefi.php?NbrEtape='.$Nbr_etape.'&Etape='.$Etape.'&DateCourse='.$DateCourse.'&NomCourse='.$NOM_COURSE.'&Parcours='.$_GET['Parcours'].''.'&Depart='.$_GET['Depart'].''); 
	
	}
	 
	else if ($Etape <> '99')
	{
		
		header('Location: Resultat2023.php?NbrEtape='.$Nbr_etape.'&DateCourse='.$DateCourse.'&Etape='.$Etape.'&Depart='.$_GET['Depart'].'&NomCourse='.$NOM_COURSE.'&Parcours='.$_GET['Parcours'].''); 
	
	}

	  ?>

	<form method="get" action="Resultat2023General.php" id="FormSendIndfo">
		<input type="hidden" name="DateCourse" id="DateCourse" tabindex="10"  size="60"  value= '<?php echo $_GET["DateCourse"] ?>' />
		<input type="hidden" name="NomCourse" id="FormNomCourse" tabindex="10"  size="60"  value= '<?php echo $_GET["NomCourse"] ?>' />
		<input type="hidden" name="NbrEtape" id="FormNbrEtape" tabindex="10"  size="60"  value= '<?php echo $_GET["NbrEtape"] ?>' />
		<input type="hidden" name="Depart" id="FormDepart" tabindex="10"  size="60"  value= '<?php echo $Depart ?>' />
		<input type="hidden" name="Parcours" id="FormParcours" tabindex="10"  size="60"  value= '<?php echo $Parcours ?>' />
		<input type="hidden" name="PointPassage" id="FormPointPassage" tabindex="10"  size="60"  value= '<?php echo $_GET["PointPassage"]?>' />
		<input type="hidden" name="TypeClassement" id="FormTypeClassement" tabindex="10"  size="60"  value= '<?php echo $_GET["TypeClassement"]?>'/>
		<input type="hidden" name="NomClassement" id="FormNomClassement" tabindex="10"  size="60"  value= '<?php echo $_GET["NomClassement"]?>' />
		<input type="hidden" name="Etape" id="FormEtape" tabindex="10"  size="60"  value= '<?php echo $Etape ?>' />
	</form>
	<p>

</p>


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

	<? if ($Parcours == null)
	{?>
		<fieldset class="fieldsetResultat">
			<Legend  class="LegendResultat">
				Sélectionner un parcours
			</Legend>

	<?	
	}?>
	
		<table  class="menu_vertical" style="margin-top : 15px;">
			<tr >
				<? 
				foreach($arParcours as $Parcours1)
				{
					$IndexParc++;
					?>
							
					<td onClick='ChangParcours(<?php echo json_encode($Parcours1)?>);'  style="cursor: pointer; background: #96C9FA;" > 
					
					<? if ($Parcours != $Parcours1)
					{ ?>
					<span class="dot">
						<p style="color : #3d6ca4;  background: transparent;">
				
							<i class="fa fa-map" style= "color : #3d6ca4;font-size: 25px;margin:5px;"></i>
						
						<? echo $Parcours1 ?>
					</p>
					</span>
				<?
					}
					else
					{  ?>
					<span class="dotDisplayed">
						<p  style=" background: transparent;">
						
									<i class="fa fa-map" style= "color :#BCDDFD;font-size: 25px;margin:5px;"></i>
						
						<? echo $Parcours1 ?>
					</p>
					</span>
				<?
					}?>

					</td><?
				}?>
			</tr>
		</table>
	<? if ($Parcours == null)
	{?>
		</fieldset>
		<?php include("sponsors2023.php"); ?> 
	<?	
	}?>
<?php
}
else
{
	// si il y a que un départ ;
	$Parcours =$ParcoursTampon;
}

/***************************** Depart ************************************/
/* Actualiser lors de chaque changement de parcours
/* DEPART avec Parcours sélectionné ************************************/

if ($Parcours != null)
{

	// Afficher la liste des départ Dossier dans la course ;
	$pathfolder = 'courses/'.$_GET['NomCourse'].$ANNEE_COURSE.'/'.$Parcours;
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
				$DepartTampon = $value;
			}		
		}
	}
	// SI il y plus que 1 départ affichage d'un menu pour le choix du départ
	if (count($arDepart) > 1)
	{?>
	<script>
		console.log("Depart1");
		</script>
		<? if ($Depart == null)
		{?>
			<fieldset class="fieldsetResultat">
				<Legend  class="LegendResultat">
					Sélectionner un départ
				</Legend>
		<?	
		}?>
		<table class="menu_vertical">
		<tr>
		<? 
		foreach($arDepart as $Depart1)
		{
			$IndexDep++;
			?>
			<td onClick='ChangDepart(<?php echo json_encode($Depart1)?>);'  style="cursor: pointer; background: #96C9FA;" > 

			<? if ($Depart == $Depart1)
			{ ?>
			<span class="dotDisplayed">
				<p style="color : #BCDDFD;  background: transparent;">
				
							<i class="fa fa-flag" style= "color :#BCDDFD;font-size: 25px;margin:5px;"> </i>
			
					<? echo $Depart1 ?>
				</p>
				</span>
			<?
			}
			else
			{  ?>
			<span class="dot">
				<p style="  background: transparent;">
				
							<i class="fa fa-flag" style= "color : #3d6ca4;font-size: 25px;margin:5px;"></i>
				
					<? echo $Depart1 ?>
				</p>
				</span>
			<?
			}?>
			
			</td><?
		}?>
		</tr>
		</table>	
		<? if ($Depart == null)
			{?>
				</fieldset>
				<?php include("sponsors2023.php"); ?> 
			<?	
			}?>
	<?php
	}
	else
	{
	
		// si il y a que un départ ;
		$Depart =$DepartTampon;
	}
}

/***************************** Etape ************************************/
/* Actualiser lors de chaque changement de départ
/* Etape avec Parcours sélectionné ************************************/

if ($Depart != null)
{

	// Afficher la liste des départ Dossier dans la course ;
	$pathfolder = 'courses/'.$_GET['NomCourse'].$ANNEE_COURSE.'/'.$Parcours.'/'.$Depart;
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
					<? if ($Etape == null || $Etape == 0)
				{?>
								
					<fieldset class="fieldsetResultat">
						<Legend  class="LegendResultat">
							Sélectionner une étape
						</Legend>
				<?	
				}?>
		<table class="menu_vertical">
		<tr>
		<? 
		$IndexDep = 0;
		// Affichage du bouton de la liste des étapes
		foreach($arEtape as $Etape1)
		{
				if ($Etape1 == "General")
				{
					$IndexDep=99;
				}
				else
				{	
					// Obtention des informations de chaque étape
					?>
					<script>
						Etape =  readJSON(<?php echo json_encode($pathfolder.'//'.$Etape1)?>+ "//info.json");
						console.log(Etape);
						</script>		<?
					$IndexDep++;
				}

			?>
			<td onClick='ChangEtape(<?php echo json_encode($IndexDep)?>);'  style="cursor: pointer; background: #96C9FA;" > 
			<? if ($Etape != $IndexDep)
			{ ?>
				<span  class="dot">
				
				<Table style="color : #3d6ca4;  background: transparent;">
					<tr>
					<td>
					<? if ($Etape1 == 'General'|| $Etape1 == 'Général')
						{?>
							<i class="fa fa-trophy" style= "fontSize: 25px;margin:5px;"></i><?
						}
						else
						{?>
							<i  id="<?php echo "ButtonEtape".$IndexDep ?>"> </i>
							<script>
								LogoEtape(<?php echo json_encode( "ButtonEtape".$IndexDep); ?>,Etape);
							</script><?
						}?>
					
					</td>
					<td>
						<table>
							<tr>
								<td>
								<? if ($Etape1 == 'General')
									{
									echo 'Général';
									}
									else
									{
									echo 'Etape '. $IndexDep ;
									}?>
								</td>
							</tr>
							<tr>
								<td>
								<? if ($Etape1 == 'General')
									{
									}
									else {?>
										<script>
									if (Etape != null )
									{
									document.write(Etape.Lieu._Value);
									}
									</script>
									<?
								
									}?>
								
							
								</td>
							</tr>
						</table>
					</td>
					</tr>
				</table>
			
			</span>
			<?
			}
			else
			{  ?>
				<span class="dotDisplayed">
				<Table>
					<tr>
					<td>
					<? if ($Etape1 == 'General')
						{?>
							<i class="fa fa-trophy" style= "fontSize: 25px;margin:5px;"></i><?
						}
						else
						{?>
							<i  id="<?php echo "ButtonEtape".$IndexDep ?>"> </i>
							<script>
								LogoEtape(<?php echo json_encode( "ButtonEtape".$IndexDep); ?>,Etape);
							</script><?
						}?>
					</td>
					<td>
						<table>
							<tr>
								<td>
								<? if ($Etape1 == 'General')
									{
									echo 'Général';
									}
									else
									{
									echo 'Etape '. $IndexDep ;
									}?>
								</td>
							</tr>
							<tr>
								<td>
								<? if ($Etape1 == 'General')
									{
								
									}
									else
									{?>
										<script>
									if (Etape != null)
									{
									document.write(Etape.Lieu._Value);
									}
								</script><?
									}?>
							
								</td>
							</tr>
						</table>
					</td>
					</tr>
				</table>
				</span>
			<?
			}?>
			</td><?
		}?>
		</tr>
		</table>
		<? if ($Etape == null || $Etape == 0)
			{?>
							
			</fieldset>
		
			<?	
			}?>
	<?php
	}
	else
	{
	
		// si il y a que un départ ;
		$Etape ="1";
	}
}

	?>

<div id="ViewAllEtapes">

</div>
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
	<Table style="margin:10px ;width:50%">
		<tr>
			<td>
		<input type="text" id="InputSearch" style="font-size:18px;padding:5px" onkeyup="valider()" placeholder="Nom recherché..."\>
	</td>
	<td>
		<input type="text" id="InputSearchPrenom"  style="font-size:18px;padding:5px" onkeyup="valider()" placeholder="Prénom recherché..."\>
	</td>
	</tr>
	</table>
	</form>
	<p id="Informations" style="display:none"></p>

<div id="ViewLiveCoureur">
</div>

<script>
		var ListNomClassement = [];

		var PathFolder=<?php echo json_encode($pathfolder); ?> ;
		console.log(PathFolder);
		var PathEtape=<?php echo json_encode($Etape); ?> ;
		console.log("PathEtape");
		console.log(PathEtape);
		

		var DivAllPoint= document.getElementById('Allpointpassage');

		var Parcours= new Object();	
       

		// lecture fichier JSON des résultats de la course
		General =  readJSON(PathFolder +"//General//ResultatWeb//ResultatsGeneral.json");
		console.log(General);
		funMenuNomClassement(General);
		if (General != undefined)
		{
	AddButtonTypeResultat();
			ListCoureurLiveToTable(General);
			
		}
		else
		{
			document.getElementById("Informations").style.display = "";
			document.getElementById("Informations").innerHTML = "Les résultats ne sont pas encore disponible pour ce départ";
		}
	


	function AddButtonTypeResultat()
	{
		console.log("Add Button type resultat");
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
<?
		/**************************************************
		 * 
		 * 			Liste fichier résultat de type spéciaux "équipe , Duo "
		 * 
		 ***************************************************/
		if (strlen($Parcours) > 0 &&  strlen($Parcours) > 0 && strlen($Depart) > 0  )
		{
			// Afficher la liste des résultats spéciaux 
			$pathfolder = 'courses/'.$_GET['NomCourse'].$ANNEE_COURSE.'/'.$Parcours.'/'.$Depart;
			if ($numetape >0 && $numetape <99)
			{
				$pathfolder = $pathfolder   .'/Etape'.$numetape;
			}
			elseif ($numetape == 99)
			{
			
				$pathfolder = $pathfolder .'/General' ;
			}
			else
			{
				$pathfolder = $pathfolder   .'/Etape1';
			}
			$pathfolder = $pathfolder   .'/ResultatWeb';
			// Création de la liste de toutes les Dossier = Depart 
			$files1 = scandir($pathfolder);
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
				console.log("Add button point de passage");
				console.log(PointDePassageInfo);
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
	
		function funMenuNomClassement(ListCoureurs)
		{
			// Trie selon le type de classement ( Scratch , Categorie , Sexe)
			var FormTypeClassement= document.getElementById('FormTypeClassement');
			var NomClassement = "";
			console.log(ListCoureurs);
			if (FormTypeClassement.value == "Sexe" )
			{
				for (let i = 0; i < ListCoureurs.length; i++) 
				{
					// Si détection contient un coureur 
					if (ListCoureurs[i].Coureur != null)
					{
						NomClassement = ListCoureurs[i].Coureur.Sexe._Value;
						funAddAndVerifClassement(NomClassement );	
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
						NomClassement = ListCoureurs[i].Coureur.Categorie.NumCategorie._Value;	
						funAddAndVerifClassement(NomClassement ,ListCoureurs[i].Coureur );
					}
				}
			}

			var find = false;
			
		}

		// Fonction ajout de la valeur et du bouton du nom de classement
		function funAddAndVerifClassement(NomClassement, Coureur)
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
				console.log("push" +NomClassement)
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
					buttonNomClassement.innerHTML =  Coureur.Categorie.NomCategorie._Value + " " +Coureur.Categorie.debutAnnee._Value +" - "+ Coureur.Categorie.finAnnee._Value ;;
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
		
		function ListCoureurLiveToTable( ListCoureurs)
		{
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
		

		function AddFavoris(i)
		{
			var IconFavori= document.getElementById('Star'+i);
			IconFavori.style.color = 'Yellow';
		}

		function ChangParcours(sParcours)
		{  
			document.getElementById("FormParcours").value =sParcours;
			elmnt = document.getElementById("FormSendIndfo");
			elmnt.submit();
		}

		function ChangDepart(sDepart)
		{  
			document.getElementById("FormDepart").value =sDepart;
			elmnt = document.getElementById("FormSendIndfo");
			elmnt.submit();
		}

		function ChangEtape(sEtape)
		{  
			document.getElementById("FormEtape").value =sEtape;

			if (document.getElementById("TypeClassement").length = 0)
			{
				document.getElementById("TypeClassement").value ="Scratch";
			}

			elmnt = document.getElementById("FormSendIndfo");
			console.log(elmnt);
			elmnt.submit();
		}
		var DivViewLiveCoureur= document.getElementById('ViewLiveCoureur');
		function ListCoureurLive(PointPassage)
		{
		
			var NombreDeCoureur= document.getElementById('NombreDeCoureur');
			NombreDeCoureur.innerHTML = PointPassage.ListCoureur.length;

			var TablePointPassage= document.getElementById('TableListeCoureur');
			TablePointPassage.innerHTML = "";
			
			for (let i = 0; i < PointPassage.ListCoureur.length; i++) 
			{
			
				// Si détection contient un coureur 
				if (PointPassage.ListCoureur[i].LineClass.Coureur != null)
				{
					rows = document.createElement('tr');
					TablePointPassage.appendChild(rows);
					rows.addEventListener("click", function() {
						ViewDetailCoureur(i);
						}, false);
					
					colonne = document.createElement('td');
					colonne.innerText = PointPassage.ListCoureur[i].LineClass.CLassementScratch.Position;
					rows.appendChild(colonne);

					colonne = document.createElement('td');
					colonne.innerText = PointPassage.ListCoureur[i].LineClass.Coureur.Nom._Value;
					rows.appendChild(colonne);
					
					colonne = document.createElement('td');
					colonne.innerText = PointPassage.ListCoureur[i].LineClass.Coureur.Prenom._Value;
					rows.appendChild(colonne);

					colonne = document.createElement('td');
					colonne.innerText = PointPassage.ListCoureur[i].LineClass.CLassementScratch.Temps;
					rows.appendChild(colonne);
				}
			}
		}


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


		var TextSelected; 
		var LastPassage = new Object();
		// Numéro du passage trouver pour ce point
		var IDPassageFind = 0;
		var uiCountKM = 0;


	function valider()
	{
		var table = document.getElementsByClassName("TableauResulat");
		console.log(table);
		
		input = document.getElementById("InputSearch");
		
		inputPrenom = document.getElementById("InputSearchPrenom");
		
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


    </script>


	
	<script>
	
	console.log( <?php echo json_encode($_GET["TypeClassement"]); ?>);</script><?
	if (strpos($_GET["TypeClassement"],'File')>-1)
	{
		$TypeClass = str_replace('File','',$_GET["TypeClassement"]);
		$pathfolder = 'courses/'.$_GET['NomCourse'].$ANNEE_COURSE.'/'.$Parcours.'/'.$Depart;
		if ($numetape == 99)
		{
		
			$pathfolder = $pathfolder .'/General' ;
			?>
			<SCRIPT>
				console.log( <?php echo json_encode($pathfileImageEtape); ?>);</script><?
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