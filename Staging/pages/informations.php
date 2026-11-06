<?php
	require_once __DIR__ . "/../includes/Header.php";	
	require_once __DIR__ . "/../includes/HeaderRace.php";
?>
	<script src="/../js/maps.js"></script>
<div id="Top1"></div>
        <a href="#Top1" id="GoToTop" class="GoToTop" style ="visibility :hidden ;z-index:3000;" >
    <i class="fa fa-arrow-up" style= "font-size: 50px;margin:2px;"></i>
</a>
<?php
	require_once __DIR__ . "/../includes/menuPages.php"; 
?>

<?php
if ($course["InformationsComingSoon"])
{
?>
</br>
	<p> les informations arrivent bientôt sur cette événement 
	</p>
<?php
}
else
{?>
<table style="width:90%; margin-Top:120px">

	<?php $Nbr_etape = intval ($course ["nbr_etape"]);		
	// ******************** POUR COURSE 1 ETAPE **********************************/		
if ($Nbr_etape < 2)
{?>

	<tr  >
		<td   style= "width:50%;background:#BCDDFD; padding: 10px;">
			<table   style= "width:100%;">
				<tr>
					<td style= "width:50px;">
					
					<i class="fa fa-calendar" style= "font-size: 35px;"></i>
					
					</td>
					<td style= "background:#BCDDFD;padding: 10px;">
				<?php echo  formatMysqlDate($course ["Date"]);?>
					</td>
				</tr>
			</table>
		</td>
		<td style= "width:20px;">
		</td>
		<td style= "width:50%;background:#BCDDFD; padding: 10px;">
			<table style= "width:100%;">
				<tr>	
	
					<td style= "width:50px;">
						
						<i class="fa fa-map-marker" style= "font-size: 35px;"></i>
						
					</td>
					<td style= "background:#BCDDFD;padding: 10px;">
						<?php echo $course ["Lieu"] ;
						if ( strlen($course ["Emplacement"] ) > 1)     
						{ ?>
							</br></br>
							<?php echo $course ["Emplacement"] ;
							
						}?>
					</td>
				</tr>
			</table>
		</td>
	</tr>
	<tr style= "Height:20px;">
	</tr>

 <?php 
 } 
 // ******************** POUR COURSE PLUSIEURS ETAPES **********************************/		
 ?>
 <tr>
	<td style= "width:50%;background:#BCDDFD; padding: 10px;">
		<table    style= "width:100%;">
			<tr>
				<td style= "width:50px;">
					
					<i class="fa fa-users" style= "font-size: 35px;"></i>
					
				</td>
				<td style= "background:#BCDDFD;padding: 10px;">
					<?php echo $course ["Organisateur"] ?> 
				</td>
			</tr>
		</table>
	</td>
	<td style= "width:10px;">
	</td>
	<?php if (strlen($course ["Site"]) > 0)
	{?>

    <td   style= "width:50%;background:#BCDDFD; padding: 10px;" >
		<table  style= "width:100%;">
			<tr>
				<td  style= "width:50px;">
					
						<i class="fa fa-globe" style= "font-size: 35px;"></i>
					
				</td>
				<td style= "background:#BCDDFD;padding:10px;">
					<?php
					if(strpos($course ["Site"] , "http") >-1)
					{?>
						<a target="_blank" href=<?php echo $course ["Site"] ?>><?php echo $course ["Site"] ?> </a><?php
					}
					else
					{?>
					<a target="_blank" href=<?php echo "http://www.". $course ["Site"] ?>><?php echo "www.". $course ["Site"] ?> </a><?php
					}?>
				</td>
			</tr>
		</table>
	</td>
	<?php
	}
	?>
</tr>
<tr style= "Height:20px;">
 </tr>
<tr>
	<td  style= "width:50%;background:#BCDDFD; padding: 10px;">
		<table    style= "width:100%;">
			<tr>
				<td style= "width:50px;">
   				 
   			      <i class="fa fa-wpforms" style= "font-size: 35px;"></i>
   				 
    			</td>
				<td style= "background:#BCDDFD;padding:10px;">
					<!--********* ETATS DES INSCRIPTIONS *****-->
					<?php $today = date("Y-m-d H:i:s");  
					if ($course ["InscriptionExtern"] )
					{
						?> Les inscriptions s'effectue sur le site de l'organisateur
					<?php
					}
					else if ($today >$course ["Date"] )
					{
						echo 'Course Terminé';
					}
					else if ( $today < $course ["DateStartInscription"]  )
					{?>
						les inscriptions pour cette course ne sont pas encore ouverte, elles ouvrent le       <?php echo  strftime('%A %d %B %Y ',strtotime($course ["DateStartInscription"]));

					}
					else if ( $today > $course ["DATE_END_INSCRIPTION"] )
					{
						?> Inscriptions fermée ,  il est toujours possible de s'inscrire sur place
					<?php
					}
					else
					{
						$Dateend =  date_parse($course ["DATE_END_INSCRIPTION"]);?> 	
						<b>	Inscriptions : </b> </br></br>
						Les inscriptions en ligne sont ouvertes jusqu'au : 
						<?php
							echo formatMysqlDate($course ["DATE_END_INSCRIPTION"],true) ;

						?>

						<?php 

						if (  $course ["NO_INSCRIPTIONS_SUR_PLACE"])
						{
						?>
						Il est impossible de s'inscrire sur place</br>
						<?php
						}
						else
						{
						?>
						Les inscriptions sur place sont aussi possibles mais peuvent entraîner une majoration de prix</br>
						<?php	
						}
						
						if ( strlen(  $course ["FichierInscription"])> 2)
						{
						?><br>
						<?php echo $course ["FichierInscription"]?></br>
						<?php
						}
					}
					if (! strlen($course ["InscriptionExtern"] ))
					{ ?>
					<div class="title" id="Paiement"> Paiement :</div>
						<Fieldset>

							Le paiement de votre inscription s'effectue sur place </br>
						</Fieldset>


				
					<?php
					}?>
				</td>
			</tr>
		</table>
	</td>
    <?php
    if ( strlen($course ["Email"] ) > 1)     
    { ?>
      <td style= "width:10px;">
	  </td>
	  <td style= "width:50%;background:#BCDDFD; padding: 10px;">
			<table>
				<tr>
					<td>
						
						<i class="fa fa-envelope-o" style= "font-size: 35px;"></i>
						
					</td>
					<td style= "background:#BCDDFD;padding: 10px;">
						<?php echo $course ["Email"] ?>  
					</td>
				</tr>
			</table>
		</td>
        <?php
    } 

    $FileReglement = 'courses/'.$NOM_COURSE.$ANNEE_COURSE."/info/Règlement.pdf";
    if (file_exists($FileReglement)) 
    { ?>
       <tr style= "Height:20px;">
        </tr>
  	  <tr>
		<td style= "width:50%;background:#BCDDFD; padding: 10px;">
			<table  style= "width:100%;">
				<tr >
					<td style= "width:50px;">
						
						<i class="fa fa-shield" style= "font-size: 35px;"></i>
						
					</td>
					<td style= "background:#BCDDFD;padding:10px;">
			
						<?php
						echo '<a href="' . $FileReglement . '" target="_blank" rel="noopener noreferrer">Règlement, cliquer ici</a>';
						?>

					</td>
				</tr>
			</table>
		</td>
    <?php
    } 

   $FileReglement = 'courses/'.$NOM_COURSE.$ANNEE_COURSE."/info/Programme.pdf";
    if (file_exists($FileReglement)) 
    { ?>
   <td style= "width:10px;">
	  </td>
		<td style= "width:50%;background:#BCDDFD; padding: 10px;">
			<table  style= "width:100%;">
				<tr >
					<td style= "width:50px;">
					
						<i class="fa fa-file-o" style= "font-size: 35px;"></i>
						
					</td>
					<td style= "background:#BCDDFD;padding:10px;">
					<?php echo '<a href="'.$FileReglement.'"target="_blank">Programme , Cliquer ici</a>'?>
					</td>
				</tr>
			</table>
		</td>
    <?php
    } 
?>
</tr>
</table>

<!-- Programme de la journée -->
<div class="title" style="   margin-top: 20px; ">Programme</div>
<table id="TableProgramme"  style="   margin-top: 20px;  margin-bottom: 20px; width :90%;">
</table>
<?php
if ( strlen($course["Description"] ) > 2)
{ ?>
<div class="title">Description</div>
<table style="width:90%;">
<tr>
    <td style= "background:#BCDDFD;padding: 10px;">
         <?php echo $course["Description"] ?>
    </td>
</tr>
    <?php
    /* Affichage des photos de l'évenement */
    $PathFolderPhoto = 'courses/'.$NOM_COURSE.$ANNEE_COURSE."/info/Photos";
    if (file_exists($PathFolderPhoto)) 
    { 
        $arfilesPhoto1= scandir($PathFolderPhoto);
        $arfilesPhoto  = array();
        for ($x = 2; $x < count($arfilesPhoto1); $x++)
        {
            array_push($arfilesPhoto, $arfilesPhoto1[$x]);
        }
    ?>
    <tr style= "Height:20px;">
    </tr>
    <tr>
    <td>
    <a>
    <img id="Photos"></img> 
    </a>
</td>
</tr>
    <?php
    } ?>
</table>

<?php
}
?>

<?php
if ( strlen($course ["Informations"] ) > 1)
{ ?>
  <div class="title"> Informations </Div>
  <Fieldset>

	<?php echo $course ["Informations"] ?> 
  </Fieldset>
	<?php
}
if ( strlen($course ["Video"] ) > 1)
{ 
?>
  <div class="title"> Vidéo tutoriel :</div>
 <Fieldset>


<iframe width="75%" height="400"
src="<?php echo 'https://www.youtube.com/embed/'.  $course ["Video"]?>">
</iframe>
</Fieldset>

<?php
}

?>
<script>

/*_____________________________________________________________________

			Enregistrement sur le "coordonnée"	des valeur de position du text sur le graphique de dénivellé 
_____________________________________________________________________*/

function ChangOffsetText()
{
	$('formOffset').request({
		onComplete: function(transport){
		console.log('1');
			var errors = transport.responseText.evalJSON();
			var message = "";
			
			for (var id in errors)
			{
				console.log("id" + errors[id]);
				message = message+ "\n - "+ errors[id];
			}
					console.log(message);
			if (message = "")
			{
				alert("Félicitations !");
			}
			else
			{
				alert("Veuillez vérifier les champs suivants : "+ message);
			}
		
		}
	});
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

function downloadSvg( ) {
	var svg = document.getElementById("image1");
	var fileName = "image1.png";
  var copy = svg.cloneNode(true);
  copyStylesInline(copy, svg);
  var canvas = document.createElement("canvas");
  var bbox = svg.getBBox();
  canvas.width = bbox.width;
  canvas.height = bbox.height;
  var ctx = canvas.getContext("2d");
  ctx.clearRect(0, 0, bbox.width, bbox.height);
  var data = (new XMLSerializer()).serializeToString(copy);
  var DOMURL = window.URL || window.webkitURL || window;
  var img = new Image();
  var svgBlob = new Blob([data], {type: "image/svg+xml;charset=utf-8"});
  var url = DOMURL.createObjectURL(svgBlob);
  img.onload = function () {
    ctx.drawImage(img, 0, 0);
    DOMURL.revokeObjectURL(url);
    if (typeof navigator !== "undefined" && navigator.msSaveOrOpenBlob)
    {
        var blob = canvas.msToBlob();         
        navigator.msSaveOrOpenBlob(blob, fileName);
    } 
    else {
        var imgURI = canvas
            .toDataURL("image/png")
            .replace("image/png", "image/octet-stream");
        triggerDownload(imgURI, fileName);
    }
    document.removeChild(canvas);
  };
  img.src = url;
}

</script> 

<!---  ********************************************************
			Affichage de la liste des dossiers  
***************************************************************** --->

 <div  id="TableauResulat">
	<!--- Liste des parcours !---->
	<?php
// Afficher la liste des Parcours  Dossier dans la course ;
$pathfolder = '../courses/'.$NOM_COURSE.$ANNEE_COURSE;
// CrÃ©ation de la liste de toutes les Dossier = Parcours 
$files1 = scandir($pathfolder);

// Liste des fichier 
foreach ($files1  as $key => $Parcours) 
{ 
	if(is_dir($pathfolder .'/'.$Parcours))
	{
		// Affichage dans la liste des depart dans le menu 
		if (strlen($Parcours) >2 && $Parcours != "info") 
		{	
			//<!--- Liste des Départ du parcours !---->
			// Afficher la liste des Parcours  Dossier dans la course ;
			$pathfolderParcours = $pathfolder .'/'.$Parcours;
		?>	
		<script>
			// Création d'un parcours
			var Parcours= new Object();	
			Parcours.nom=<?php echo json_encode($Parcours); ?>;

			<?php

			// Image du parcours
			$pathFileImageParcours = $pathfolderParcours.'/parcours.jpg';
			if (file_exists($pathFileImageParcours))
			{?>
			
				Parcours.image= <?php echo json_encode($pathFileImageParcours); ?>;
			<?php
			}
			// GPX du parcours
			$pathFileImageParcours = $pathfolderParcours.'/parcours.xml';
			if (file_exists($pathFileImageParcours))
			{?>
			
				Parcours.GPX= <?php echo json_encode($pathFileImageParcours); ?>;
			<?php
			}?>
			Parcours.info =  readJSON(<?php echo json_encode($pathfolderParcours); ?>+"/info.json");
			// Ajout d'un tableau de départ au parcours
			var ArrayDepart = [];
		</script>
		<?php

			// CrÃ©ation de la liste de toutes les Dossier = Depart 
			$filesDepart = scandir($pathfolderParcours);
			foreach ($filesDepart  as $key => $depart) 
			{ 
				$posInfo = strpos($depart, 'info.json');
				$pathfolderDepart = $pathfolderParcours .'/'.$depart;

				if(is_dir($pathfolderDepart) && $posInfo == false )
				{?>
				<script>
			
					</script>
					<?php
					if (strlen($depart) >2)
					{
					?>
						<script>
							console.log(<?php echo json_encode($pathfolderDepart); ?>);
							var ArrayEtape = [];
							var Depart= new Object();
							Depart.Nom = <?php echo json_encode($depart); ?>;
						
						</script>
						<?php
							// Lecture du fichier info.json 	du départ
							$pathFileInfo = $pathfolderDepart.'/info.json';
							if (file_exists($pathFileInfo))
							{?>
								<script>
								Depart.info =  readJSON(<?php echo json_encode($pathFileInfo); ?>);
							//	console.log(Depart.info );
								</script><?php
							}
				
						// CrÃ©ation de la liste de toutes les Dossier = Etape 
						$filesEtape = scandir($pathfolderDepart);

						/***************** Etape ********************/
						$CmptEtape = 1;
						foreach ($filesEtape  as $key => $Etape) 
						{
							$pathFolderEtape = $pathfolderDepart .'/'. $Etape ;
							
							if (strlen($Etape) >2 && is_dir($pathFolderEtape ) && $Etape != "images" && $Etape != "General")
							{
									
								// Lecture du fichier info.txt de l'étape 	
								$pathFileInfoEtape = $pathFolderEtape.'/info.json';
								if (file_exists($pathFileInfoEtape))
								{
									?> <script>
								
								</script>
								<?php
									$pathfileImageEtape = $pathFolderEtape.'/images/Etape.jpg';
									if (file_exists ( $pathfileImageEtape ) == false)
									{
										$pathfileImageEtape = "";
									}
									$pathfileGraphEtape = $pathFolderEtape.'/images/Graph.jpg';
									if (file_exists ( $pathfileGraphEtape ) == false)
									{
										$pathfileGraphEtape = "";
									}
									$pathfileGpxEtape = $pathFolderEtape.'/images/Etape.xml';
									if (file_exists ( $pathfileGpxEtape ) == false)
									{
										$pathfileGpxEtape = "";
									}
									$CmptEtape ++;
									?> <script>
									var Etape = new Object();
									Etape.Graph = <?php echo json_encode($pathfileGraphEtape); ?>;
									Etape.Image = <?php echo json_encode($pathfileImageEtape); ?>;
									Etape.GPX = <?php echo json_encode($pathfileGpxEtape); ?>;
									Etape.Nom = <?php echo json_encode($Etape); ?>;
									Etape.info = readJSON(<?php echo json_encode($pathFileInfoEtape); ?>);
									console.log(Etape.info.ListDiscipline.ListItem);
									<?php
									$CmptDisc = 1;
									?>
									for (var j = 0; j < Etape.info.ListDiscipline.ListItem.length; j++)
									{
										var path = <?php echo json_encode($pathFolderEtape. "/images/Disc". $CmptDisc.".jpg"); ?>;
										Etape.info.ListDiscipline.ListItem[j].Image = path;
										<?php
										$CmptDisc = $CmptDisc + 1;
										
					
										if (file_exists($pathFolderEtape ."/images/Disc". $CmptDisc.".jpg") == false)
										{	?>
											Etape.info.ListDiscipline.ListItem[j].Image =  "";
						<?php
										}?>
									}
									</script>
									<?php							
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
						</script><?php					
					}	
		
				}
				
			}?>
			<script>
			Parcours.ArrayDepart =ArrayDepart;
			/********** AJout du parcours au tableau de parcours *********/
			ArrayParcours.push(Parcours);
			console.log(Parcours);
			</script><?php
		}
	}
}
?>
<script>
 // crée un nouvel élément div
let b = document.body;
// Si un depart à au moins plus que 1 étapes pour bcj challenge kids
xEtape = false;
let newDiv = document.createElement("div");
TableProgramme = document.getElementById("TableProgramme");
TableProgramme.style.maxWidth = "800px";
  // ********** POUR CHAQUE PARCOURS ***************/
for (var i = 0; i < ArrayParcours.length; i++) 
{

	var ParcoursObj = new Object();
	ParcoursObj = ArrayParcours[i];
	let ParcoursPara  = null ;

	// Si il existe plusieurs parcours

	// Programme Manifestation
        for (var j = 0; j < ParcoursObj.ArrayDepart.length;j++) 
{
         var DepartObj = new Object();
         DepartObj = ParcoursObj.ArrayDepart[j];

		ParcoursPara = document.createElement('fieldset');
        LineProgramme = document.createElement('tr');
        LineProgramme.style.background = '#BCDDFD';
        LineProgramme.style.margin = '5px';

        ColIcone = document.createElement('td');
        ColIcone.style.textAlign ='center';
		ColIcone.style.background = '#3D6CA4';
        Icone = document.createElement('a');
        Icone.style.fontSize="30px" ;
		Icone.setAttribute('href', "#div"+ParcoursObj.nom);
		Icone.innerHTML = "<img src='/Icones/IconeDepartBlanc.png'  style='width:30px;margin:5px;'/>";
	
        ColIcone.append(Icone);
        LineProgramme.append(ColIcone);

        
        ColHoure = document.createElement('td');
        Hour = document.createElement('a');
		console.log(DepartObj);
		Hour.innerHTML = '<i class="fa fa-clock-o" ></i>    ' + DepartObj.ArrayEtape[0].info.HeureDepart._Value;
        Hour.style.marginLeft = "10px";
        ColHoure.append(Hour);
		
        LineProgramme.append(ColHoure);

		ColMenu = document.createElement('td');
	
		ParcoursMenu = document.createElement('a');
		ParcoursMenu.innerHTML = DepartObj.info.Nom._Value;
        ParcoursMenu.style.marginLeft = "10px";
		ParcoursMenu.style.width = "80%";

        ColMenu.append(ParcoursMenu);

		LineProgramme.append(ColMenu);

        ColInfo = document.createElement('td');
        ColInfo.style.textAlign ='center';

		IconeInfo= document.createElement('a');
		IconeInfo.setAttribute('href', "#div"+ParcoursObj.nom);
		IconeInfo.innerHTML = '<i class="fa fa-info-circle" style= "font-size: 28px;margin:8px; margin-top: 6px; color: #3d6cA4;"></i>';
		IconeInfo.id =  DepartObj.Nom;
		IconeInfo.style.width = "80%";
        ColInfo.append(IconeInfo);

		LineProgramme.append(ColInfo);

		TableProgramme.append(LineProgramme);
	}
	
    ParcoursPara = document.createElement('div');
	ParcoursPara.className='FieldParcours'
	ParcoursPara.classList.add('Anchor');
	ParcoursPara.id = "div"+ParcoursObj.nom;
	let NomParcoursPara =	document.createElement('div');	
		
	// Affichage du titre du parcours si il y a plusieurs départ
	if (ParcoursObj.nom.length > 0 &&  ArrayParcours.length>1)// && ParcoursObj.ArrayDepart.length> 1) Correction graphique
	{
		NomParcoursPara.className += "titleParcours";
		TableTitleParcours= document.createElement('table');
		RowsTitleParcours = document.createElement('tr');
		RowsTitleParcours.style.border ="0px";
		TableTitleParcours.style.width = "100%";

		ColumnTitleParcours  = document.createElement('td'); 
		ColumnTitleParcours.style.borderRadius ="border-radius: 10px 0px 0px 0px"
		ColumnTitleParcours.style.background ="#3D6CA4"
		ColumnTitleParcours.style.padding ="5px"
		ColumnTitleParcours.style.width ="60px"
		ColumnTitleParcours.innerHTML = "<img src='/Icones/IconeParcoursBlanc.png'  style='width:50px;margin:5px;'/>";
		RowsTitleParcours.append(ColumnTitleParcours)
		
		ColumnTitleParcours  = document.createElement('td'); 
		ColumnTitleParcours.innerHTML = ParcoursObj.info.Nom._Value;
		RowsTitleParcours.append(ColumnTitleParcours)
	
		TableTitleParcours.append(RowsTitleParcours);
		NomParcoursPara.append(TableTitleParcours);
	}

	ParcoursPara.append(NomParcoursPara);

// Image propre au parcours (Valable pour 1 etape )
	if ( ParcoursObj.image != null && ParcoursObj.image.length > 0)
	{
			let ImageParcours = document.createElement('img');
			ImageParcours.src =  ParcoursObj.image;
			ImageParcours.className += "imgCenter";
			ImageParcours.style.width = "80%";
			ImageParcours.style.margin = "20px";
			ImageParcours.style.marginLeft= "auto";
			ImageParcours.style.marginRight= "auto";
			ImageParcours.style.maxWidth = "600px";
			ImageParcours.style.borderRadius =  "10px";
			ImageParcours.style.textAlign  ="center";
			ParcoursPara.append(ImageParcours);
	}

	// Image propre au parcours (Valable pour 1 etape )
	if ( ParcoursObj.GPX != null && ParcoursObj.GPX.length > 0)
	{

		let TableGpxParcours =	document.createElement('table');
		let RowsTableEtape1 =	document.createElement('tr');
		let ColimgEtapePara1 =	document.createElement('td');
		let DivimgEtapePara =	document.createElement('div');

		ColimgEtapePara1.width = "80%";
		ColimgEtapePara1.append(DivimgEtapePara);
		RowsTableEtape1.append(ColimgEtapePara1);
		TableGpxParcours.append(RowsTableEtape1);
			
		console.log("Parcours");
		console.log(ParcoursObj);
		funAddSvg(ParcoursObj.nom, ParcoursObj.GPX, DivimgEtapePara);

		TableGpxParcours.style.width = "80%";
		TableGpxParcours.style.margin = "20px";
		TableGpxParcours.style.marginLeft= "auto";
		TableGpxParcours.style.marginRight= "auto";
		TableGpxParcours.style.maxWidth = "600px";
		TableGpxParcours.style.borderRadius =  "10px";
		TableGpxParcours.style.textAlign  ="center";
		ParcoursPara.append(TableGpxParcours);
	}
	// ************************Pour chaque départ ***********************
	for (var h = 0; h < ParcoursObj.ArrayDepart.length; h++)
	{
			
		var DepartObj = new Object();
		// Reprise de l'objet départ dans le tableau
		DepartObj = ParcoursObj.ArrayDepart[h];
		
		// Créer un Div par Depart
		let  DepartPara = document.createElement('div');
		DepartPara.style.background =  "#BCDDFD";
		DepartPara.style.margin = "20px";
		DepartPara.style.borderRadius = "10px";

		// Title
		let NomStartPara =	document.createElement('p');	
		NomStartPara.className += "titleParcours";
		NomStartPara.style.margin = "0px";
		NomStartPara.style.padding = "0px";

		let TableTitleDepart = document.createElement('table');	
		TableTitleDepart.style.width = "100%";
		TableTitleDepart.style.color  = "black";
		TableTitleDepart.style.borderRadius  = "10px";

		let RowsTitleDepart = document.createElement('tr');
		let ColumnTitleDepart = document.createElement('td');
			
		NomDepart = "";
		RowsTitleDepart.append(ColumnTitleDepart);
		if (DepartObj.info.Nom._Value != ParcoursObj.info.Nom._Value )
		{
			NomDepart = DepartObj.info.Nom._Value ;
		}
		ColumnTitleDepart.innerHTML = "<table style='margin:0px;'><tr><td style='border-radius: 10px 0px 0px 0px;background:#3D6CA4;padding:5px;'><img src='/Icones/IconeDepartBlanc.png'  style='width:50px;margin:5px;'/></td><td style='padding: 5px'>"+
		
		NomDepart+"</td></tr></table>"
	
	//	ColumnTitleDepart.innerHTML = "<i class='fa fa-flag'></i> "+" "+ DepartObj.Nom;
		RowsTitleDepart.append(ColumnTitleDepart);
		TableTitleDepart.append(RowsTitleDepart);

		NomStartPara.append(TableTitleDepart);

	
		EtapeObj1 = DepartObj.ArrayEtape[0];
		// SI le départ contient 1 étape on va reprendre sont heure de départ
		if (DepartObj.ArrayEtape.length == 1 )
		{
			// affichage dans titre parcours pour BCJ challenge kids 
			if (xEtape && EtapeObj1.info.Date != null && EtapeObj1.info.Date._Value.length > 0)
			{
				let date = new Date( EtapeObj1.info.Date._Value);
				ColTitle1Etape= document.createElement('td');
				const options = { weekday: 'long', year: 'numeric', month: 'long', day: 'numeric' };
				ColTitle1Etape.innerHTML ='<i class="fa fa-calendar" ></i>' +" "+  date.toLocaleString('fr-FR', options);
				ColTitle1Etape.style.width = "50%";
				ColTitle1Etape.style.borderBottom ="0px";
				RowsTitleParcours.append(ColTitle1Etape);
			}
			if (xEtape &&  EtapeObj1.info.Lieu != null && EtapeObj1.info.Lieu._Value.length > 0)
			{
				ColTitle1Etape = document.createElement('td');
				ColTitle1Etape.innerHTML ='<i class="fa fa-map-marker" ></i>' +" "+EtapeObj1.info.Lieu._Value;
				ColTitle1Etape.style.width = "20%";
				ColTitle1Etape.style.borderBottom ="0px";
				RowsTitleParcours.append(ColTitle1Etape);
			}
			xEtape = false;
			//*************************************************** */
			ColumnTitleDepart = document.createElement('td');
			ColumnTitleDepart.style.width = "20%";
			if (DepartObj.ArrayEtape[0].info.HeureDepart._Value.length > 0)
			{	
			
				ColumnTitleDepart.innerHTML ='<i class="fa fa-clock-o" ></i>' +" " +DepartObj.ArrayEtape[0].info.HeureDepart._Value ;
				ColumnTitleDepart.style.borderBottom ="0px";
			
			}
			RowsTitleDepart.append(ColumnTitleDepart);
	
			ColumnTitleDepart = document.createElement('td');
			ColumnTitleDepart.style.width = "20%";
			if (DepartObj.ArrayEtape[0].info.Distance._Value.length > 0)
			{	
			
				ColumnTitleDepart.innerHTML = DepartObj.ArrayEtape[0].info.Distance._Value ;
				ColumnTitleDepart.style.borderBottom ="0px";
			
			}
			RowsTitleDepart.append(ColumnTitleDepart);

			ColumnTitleDepart = document.createElement('td');
			ColumnTitleDepart.style.width = "20%";
			if (DepartObj.ArrayEtape[0].info.Denivelle._Value.length > 0)
			{	
				ColumnTitleDepart.innerHTML = DepartObj.ArrayEtape[0].info.Denivelle._Value ;
				ColumnTitleDepart.style.borderBottom ="0px";
			}
			RowsTitleDepart.append(ColumnTitleDepart);

			ColTitleEtape =	document.createElement('td');
			ColumnTitleDepart.style.width = "10%";
			// Ajout ligne download fichier gpx présent 
			if ( DepartObj.ArrayEtape[0].GPX.length > 0)
			{
				ColTitleEtape.innerHTML ='<a href="'+DepartObj.ArrayEtape[0].GPX+'" download="'+DepartObj.Nom+'.gpx"  ><i class="fa fa-download"  > .gpx</i></a>';
				ColTitleEtape.style.borderBottom ="0px";
			}
			RowsTitleDepart.append(ColTitleEtape);
		}
		// Affichage information départ
		if(DepartObj.info.ListCategorie != null )
		{
			// Si une seul catégorie
			if (DepartObj.info.ListCategorie.ListItem.length==1)
			{
				Categorie = DepartObj.info.ListCategorie.ListItem[0];
				SexeCat = Categorie.SexeCategorie._Value ;
				
					
				if (Categorie.debutAnneeInternet._Value.length > 0)
				{
					AnneeDebutCat = Categorie.debutAnneeInternet._Value;
				}
				else
				{
					AnneeDebutCat =Categorie.debutAnnee._Value ;	
				}

				
				if (Categorie.finAnneeInternet._Value.length > 0)
				{
					AnneeFinCat =  Categorie.finAnneeInternet._Value;
				}
				else
				{
					AnneeFinCat=  Categorie.finAnnee._Value;	
				}

			}
			else // Si plusieurs categorie 
			{
				SexeCat = "";
				// Valeur par défault
				AnneeDebutCat = new Date().getFullYear();
				AnneeFinCat = 0;
				for (var j = 0; j < DepartObj.info.ListCategorie.ListItem.length; j++)
				{
					// Regarde si le départ est mixte
					if (DepartObj.info.ListCategorie.ListItem[j].SexeCategorie._Value  == "H")
					{
						if (SexeCat == "")
						{
							SexeCat = "H";
						}
						else if (SexeCat == "D")
						{
							SexeCat = "M";
						}
					}
					if (DepartObj.info.ListCategorie.ListItem[j].SexeCategorie._Value  == "D")
					{
						if (SexeCat == "")
						{
							SexeCat = "D";
						}
						else if (SexeCat == "H")
						{
							SexeCat = "M";
						}
					}

					// SI l'année noter sur internet ne correspond pas a l'année noté afin de "tricher" les catégories sans le noter
					if (DepartObj.info.ListCategorie.ListItem[j].debutAnneeInternet._Value.length > 0)
					{
						if ( DepartObj.info.ListCategorie.ListItem[j].debutAnneeInternet._Value < AnneeDebutCat)
						{
							AnneeDebutCat  = DepartObj.info.ListCategorie.ListItem[j].debutAnneeInternet._Value ;
						}
					}
					else
					{
						if ( DepartObj.info.ListCategorie.ListItem[j].debutAnnee._Value < AnneeDebutCat)
						{
							AnneeDebutCat  = DepartObj.info.ListCategorie.ListItem[j].debutAnnee._Value ;
						}
					}
		
					// SI l'année noter sur internet ne correspond pas a l'année noté afin de "tricher" les catégories sans le noter
					if (DepartObj.info.ListCategorie.ListItem[j].finAnneeInternet._Value.length > 0)
					{
						if ( DepartObj.info.ListCategorie.ListItem[j].finAnneeInternet._Value > AnneeFinCat)
						{
							AnneeFinCat  = DepartObj.info.ListCategorie.ListItem[j].finAnneeInternet._Value ;
						}
					}
					else
					{
						if ( DepartObj.info.ListCategorie.ListItem[j].finAnnee._Value > AnneeFinCat)
						{
							AnneeFinCat  = DepartObj.info.ListCategorie.ListItem[j].finAnnee._Value ;
						}
					}
				}
			}
			// Sexe
			ColumnTitleDepart = document.createElement('td');
			ColumnTitleDepart.style.width = "5%";

			if ( SexeCat=="H")
			{
				ColumnTitleDepart.style.fontSize ="25px";
				ColumnTitleDepart.innerHTML = '<i class="fa fa-male" ></i>';
			}
			else if (SexeCat =="D")
			{
				ColumnTitleDepart.style.fontSize ="25px";
				ColumnTitleDepart.innerHTML = '<i class="fa fa-female" ></i>' ;
			}
			else
			{
				ColumnTitleDepart.style.fontSize ="25px";
				ColumnTitleDepart.innerHTML ='<i class="fa fa-female" >' + '<i class="fa fa-male" ></i>' ;
			}

			
			RowsTitleDepart.append(ColumnTitleDepart);

			ColumnTitleDepart = document.createElement('td');
			ColumnTitleDepart.style.width = "25%";
			// AnneeStart
			ColumnTitleDepart.innerHTML =AnneeDebutCat+ " - " + AnneeFinCat;	
			

			ColumnTitleDepart.style.borderBottom ="0px";
			RowsTitleDepart.append(ColumnTitleDepart);

		}
		TableTitleDepart.append(RowsTitleDepart);
			NomStartPara.append(TableTitleDepart);
			DepartPara.append(NomStartPara);

		for (var j = 0; j < DepartObj.ArrayEtape.length; j++)
		{
			
			EtapeObj1 = DepartObj.ArrayEtape[j];

		 
			let Etapepara = document.createElement('fieldset');
			
			if ((DepartObj.ArrayEtape.length > 1 ) && EtapeObj1.info != null)
			{
				// Si le départ a plusieur pour afficher le lieu du bcj challenge
				xEtape = true
				let TableTitleEtape = document.createElement('table');			
				TableTitleEtape.style.width = "100%";
				TableTitleEtape.style.borderStyle = "none";
				TableTitleEtape.style.borderSpacing  = "0px";
				TableTitleEtape.style.marginTop  = "15px";
				TableTitleEtape.style.marginBottom  = "15px";
				TableTitleEtape.style.padding  = "10px";

				let RowsTitleEtape =	document.createElement('tr');
				TableTitleEtape.style.background  = "#58b8e7";
				RowsTitleEtape.style.margin  = "10px";
			
				let ColTitleEtape =	document.createElement('td');
				ColTitleEtape.innerHTML ="Etape " +(j +1);
				ColTitleEtape.style.borderBottom ="0px";
				ColTitleEtape.style.width = "15%";
				RowsTitleEtape.append(ColTitleEtape);
			
				ColTitleEtape =	document.createElement('td');
				
				if (EtapeObj1.info.Date != null && EtapeObj1.info.Date._Value.length > 0)
				{
					let date = new Date( EtapeObj1.info.Date._Value);
			
					const options = { weekday: 'long', year: 'numeric', month: 'long', day: 'numeric' };
					ColTitleEtape.innerHTML ='<i class="fa fa-calendar-o" ></i>' +" "+  date.toLocaleString('fr-FR', options);
					ColTitleEtape.style.width = "40%";
					ColTitleEtape.style.borderBottom ="0px";
				}
				RowsTitleEtape.append(ColTitleEtape);

				ColTitleEtape =	document.createElement('td');
				if (EtapeObj1.info.Lieu != null && EtapeObj1.info.Lieu._Value.length > 0)
				{
					ColTitleEtape.innerHTML ='<i class="fa fa-map-marker" ></i>' +" "+EtapeObj1.info.Lieu._Value;
					ColTitleEtape.style.width = "20%";
					ColTitleEtape.style.borderBottom ="0px";
				}
				RowsTitleEtape.append(ColTitleEtape);

				ColTitleEtape =	document.createElement('td');
				if (EtapeObj1.info.HeureDepart != null &&  EtapeObj1.info.HeureDepart._Value.length > 0)
				{
					ColTitleEtape.innerHTML ='<i class="fa fa-clock-o" ></i>' +" " +EtapeObj1.info.HeureDepart._Value ;
					ColTitleEtape.style.width = "15%";
					ColTitleEtape.style.borderBottom ="0px";
				}
				RowsTitleEtape.append(ColTitleEtape);

				ColTitleEtape =	document.createElement('td');
				// Ajout ligne download fichier gpx présent 
				if ( EtapeObj1.GPX != null && EtapeObj1.GPX.length > 0)
				{
					ColTitleEtape.innerHTML ='<a href="'+EtapeObj1.GPX+'" download="'+EtapeObj1.Nom+'.gpx"  ><i class="fa fa-download"  > .gpx</i></a>';
					ColTitleEtape.style.width = "20%";
					ColTitleEtape.style.borderBottom ="0px";
				}
				RowsTitleEtape.append(ColTitleEtape);

				TableTitleEtape.append(RowsTitleEtape);
				DepartPara.append(TableTitleEtape);	
				
				if (EtapeObj1.info.Distance._Value.length > 0 ||   EtapeObj1.Image.length > 0||   EtapeObj1.GPX.length > 0 ||   EtapeObj1.Graph.length > 0) 
				{
					
					/* AFFICHAGE INFORMATION PARCOURS ETAPE *************/
					let TableEtape = document.createElement('table');			
					TableEtape.width = "100%";
					let RowsTableEtape =	document.createElement('tr');
					let TableDistance = document.createElement('table');
					let ColInfoEtape =	document.createElement('td');
					if (EtapeObj1.info.Distance._Value.length > 0)
					{
					
						
						ColInfoEtape.style.width = "15%";
						
						ColInfoEtape.style.verticalAlign ="Top";
						
						TableDistance.style.borderSpacing  = "10px";
						TableDistance.style.width = "100%";					
						let RowsDistance =	document.createElement('tr');
						RowsDistance.style.background  = "#58b8e7"
						
						let ColDistance =	document.createElement('td');
						ColDistance.innerHTML = EtapeObj1.info.Distance._Value  ;
						ColDistance.style.padding ="10px";
						ColDistance.style.borderRadius ="10px";
						
						RowsDistance.append(ColDistance);
						TableDistance.append(RowsDistance);
					}
					if (EtapeObj1.info.Denivelle._Value.length > 0)
					{
						RowsDistance =	document.createElement('tr');
						RowsDistance.style.background  = "#58b8e7"
						
						ColDistance =	document.createElement('td');
						RowsDistance.style.width = "100%";	
						ColDistance.style.width = "100%";	
						ColDistance.innerHTML =  EtapeObj1.info.Denivelle._Value ;
						ColDistance.style.padding ="10px";
						ColDistance.style.borderRadius ="10px";

						RowsDistance.append(ColDistance);
						TableDistance.append(RowsDistance);
				
					
					}
					ColInfoEtape.append(TableDistance);
						RowsTableEtape.append(ColInfoEtape);
					if ( EtapeObj1.Image != null && EtapeObj1.Image.length > 0)
					{
			
						let ColimgEtapePara =	document.createElement('td');
						ColimgEtapePara.width = "80%";
						let ImageEtape = document.createElement('img');
						ImageEtape.src =  EtapeObj1.Image;
						ImageEtape.className += "imgCenter";
						ImageEtape.style.width = "80%"
						ImageEtape.style.textAlign  ="center";
						ImageEtape.style.borderRadius  ="10px";
						ColimgEtapePara.append(ImageEtape);
						RowsTableEtape.append(ColimgEtapePara);
						TableEtape.append(RowsTableEtape);	
					}
				
					if ( EtapeObj1.GPX.length > 0)
					{

						let ColimgEtapePara =	document.createElement('div');
						

						ColimgEtapePara.width = "80%";
					/*	let ImageEtape = document.createElement('img');
						ImageEtape.src =  EtapeObj.Image;
						ImageEtape.className += "imgCenter";
						ImageEtape.style.width = "80%"
						ImageEtape.style.textAlign  ="center";
						ColimgEtapePara.append(ImageEtape);*/
						RowsTableEtape.append(ColimgEtapePara);
						//mapSvg("Etape " +(j +1)+DepartObj.Nom, EtapeObj.GPX, ColimgEtapePara);

						funAddSvg(DepartObj.Nom + EtapeObj1.Nom, EtapeObj1.GPX, ColimgEtapePara);
						TableEtape.append(RowsTableEtape);	
					}								
					if ( EtapeObj1.Graph != null && EtapeObj1.Graph.length > 0)
					{
						let ColimgEtapePara1 =	document.createElement('td');
						ColimgEtapePara1.width = "80%";
						let ImageEtape1 = document.createElement('img');
						ImageEtape1.src =  EtapeObj1.Graph;
						ImageEtape1.className += "imgCenter";
						ImageEtape1.style.width = "80%"
						ImageEtape1.style.textAlign  ="center";
						ImageEtape1.style.borderRadius  ="10px";
						ColimgEtapePara.append(ImageEtape1);
						RowsTableEtape1.append(ColimgEtapePara1);
						TableEtape.append(RowsTableEtape1);	
					}
				DepartPara.append(TableEtape);
				}
			
			}
			else // Affichage imges si il y a une seul étape
			{
				if (EtapeObj1.Image != null &&  EtapeObj1.Image.length > 0 || EtapeObj1.GPX != null && EtapeObj1.GPX.length > 0 || EtapeObj1.Graph != null && EtapeObj1.Graph.length > 0)
				{
					let TableEtape = document.createElement('table');			
					TableEtape.width = "100%";
					DepartPara.append(TableEtape);
					DepartPara.style.background  = "#BCDDFD"
					
					if (EtapeObj1.Image != null &&  EtapeObj1.Image.length > 0)
					{
					
						let RowsTableEtape =	document.createElement('tr');
						let ColimgEtapePara =	document.createElement('td');
						ColimgEtapePara.width = "80%";
						let ImageEtape = document.createElement('img');
						ImageEtape.src =  EtapeObj1.Image;
						ImageEtape.className += "imgCenter";
						ImageEtape.style.margin = "20px";
						ImageEtape.style.marginLeft= "auto";
						ImageEtape.style.marginRight= "auto";
						ImageEtape.style.maxWidth = "500px";
						ImageEtape.style.borderRadius =  "10px";
						ImageEtape.style.textAlign  ="center";
						ColimgEtapePara.append(ImageEtape);
						RowsTableEtape.append(ColimgEtapePara);
						TableEtape.append(RowsTableEtape);			
					}

					if ( EtapeObj1.Graph != null && EtapeObj1.Graph.length > 0)
					{
						let RowsTableEtape1 =	document.createElement('tr');
						let ColimgEtapePara1 =	document.createElement('td');
						ColimgEtapePara1.width = "80%";
						let ImageEtape1 = document.createElement('img');
						ImageEtape1.src =  EtapeObj1.Graph;
						ImageEtape1.className += "imgCenter";
						ImageEtape1.style.width = "80%"
						ImageEtape1.style.textAlign  ="center";
						ImageEtape1.style.borderRadius  ="10px";
						ColimgEtapePara1.append(ImageEtape1);
						RowsTableEtape1.append(ColimgEtapePara1);
						TableEtape.append(RowsTableEtape1);	
					}

					if ( EtapeObj1.GPX != null && EtapeObj1.GPX.length > 0)
					{

						let RowsTableEtape1 =	document.createElement('tr');
						let ColimgEtapePara1 =	document.createElement('td');
						let DivimgEtapePara =	document.createElement('div');

						ColimgEtapePara1.width = "80%";
						ColimgEtapePara1.append(DivimgEtapePara);
						RowsTableEtape1.append(ColimgEtapePara1);
						TableEtape.append(RowsTableEtape1);
					//	mapSvg("Etape " +(j +1)+EtapeObj1.info.Nom._Value, EtapeObj1.GPX, DivimgEtapePara);
						funAddSvg(DepartObj.Nom + EtapeObj1.Nom, EtapeObj1.GPX, DivimgEtapePara);
					}	
				}
			}						
			
		
			//********************* Discpline *****************/
			if (EtapeObj1.info != null && EtapeObj1.info.ListDiscipline != null && EtapeObj1.info.ListDiscipline.ListItem.length > 1)
			{
				
				for (var d = 0; d < EtapeObj1.info.ListDiscipline.ListItem.length; d++)
				{
					var	DisciplineObj =  new Object();
					DisciplineObj = EtapeObj1.info.ListDiscipline.ListItem[d];
					// Si plus de 1 discipline afficher celle-ci en en tête
					if (DisciplineObj.Nom._Value.length > 0 )
					{
						let NomPara =	document.createElement('div');
						
						NomPara.textContent =  DisciplineObj.Nom._Value;
						NomPara.className += "title";
						DepartPara.append(NomPara);

					
			
					// ************  AFFICHAGE INFORMATION Discipline  ************

						let TableDisc = document.createElement('table');			
						TableDisc.width = "100%";
						
						let TableInfoDisc = document.createElement('table');
							TableInfoDisc.style.borderSpacing  = "10px";
							TableInfoDisc.style.width = "100%";	
						let ColInfoDisc =	document.createElement('td');
						ColInfoDisc.style.width = "20%";
						if (DisciplineObj.Distance._Value.length > 0)
						{
							ColInfoDisc.style.verticalAlign ="Top";
							let RowsDiscDistance =	document.createElement('tr');
							RowsDiscDistance.style.background  = "#58b8e7"
							
							let ColInfoDistance =	document.createElement('td');
							ColInfoDistance.innerHTML = DisciplineObj.Distance._Value  ;
							ColInfoDistance.style.padding ="10px";
							
							RowsDiscDistance.append(ColInfoDistance);
							TableInfoDisc.append(RowsDiscDistance);
						}
						if (DisciplineObj.Denivelle._Value.length > 0)
						{
							RowsDiscDistance =	document.createElement('tr');
							RowsDiscDistance.style.background  = "#58b8e7"
							
							ColInfoDistance =	document.createElement('td');
							RowsDiscDistance.style.width = "100%";	
							ColInfoDistance.style.width = "100%";	
							ColInfoDistance.innerHTML =  DisciplineObj.Denivelle._Value ;
							ColInfoDistance.style.padding ="10px";
							RowsDiscDistance.append(ColInfoDistance);
							
							TableInfoDisc.append(RowsDiscDistance);
						}

							ColInfoDisc.append(TableInfoDisc);
							//RowsTableDisc.append(ColInfoDisc);

						if ( DisciplineObj.Image != null && DisciplineObj.Image.length > 0)
						{
							let RowsTableDisc =	document.createElement('tr');
							let ColimgDiscPara =	document.createElement('td');
							ColimgDiscPara.width = "80%";
							let ImageDisc = document.createElement('img');
							ImageDisc.src =  DisciplineObj.Image;
							ImageDisc.className += "imgCenter";
							ImageDisc.style.width = "80%"
							ImageDisc.style.textAlign  ="center";
							ColimgDiscPara.append(ImageDisc);
							RowsTableDisc.append(ColimgDiscPara);
							TableDisc.append(RowsTableDisc);	
						}

						if (DisciplineObj.GPX != null &&   DisciplineObj.GPX.length > 0)
						{
							let RowsTableDisc1 =	document.createElement('tr');
							let ColimgDiscPara1 =	document.createElement('td');
							ColimgDiscPara1.width = "80%";
							let DivDisc = document.createElement('div');
							DivDisc.style.width = "80%"
							DivDisc.style.textAlign  ="center";
							funAddSvg("Disc" +(d +1)+DepartObj.info.Nom._Value, EtapeObj.GPX, DivDisc);
							ColimgDiscPara1.append(DivDisc);
							RowsTableDisc1.append(ColimgDiscPara1);
							TableDisc.append(RowsTableDisc1);	
						}	

						DepartPara.append(TableDisc);
					}			
				}
		
			}
		}
			/*************** Catégorie *********************/
			if (DepartObj.info.ListCategorie != null && DepartObj.info.ListCategorie.ListItem.length > 1) 	
			{
						//***************** Titre du tableau de catégorie  ****************
				let ZoneTaifStartPara1 =	document.createElement('p');	

				let TableCat =	document.createElement('table');
				TableCat.id = "TableauCat";
				TableCat.width = "100%";
				TableCat.style.maxWidth = "600px";

				TableCat.style.margin = "auto";
				TableCat.style.margintop = "10px";
				TableCat.style.marginbottom = "10px";
				let RowsTableCat =	document.createElement('tr');
				RowsTableCat.style.background = "rgba(36, 174,232, 0.25)";
				let HeaderTableCat =	document.createElement('th');
				
				HeaderTableCat.textContent = "N°";	
				RowsTableCat.append(HeaderTableCat);
				HeaderTableCat =	document.createElement('th');
				HeaderTableCat.textContent = "Nom Catégorie";	
		
				RowsTableCat.append(HeaderTableCat);
				HeaderTableCat =	document.createElement('th');
				HeaderTableCat.textContent = "Sexe";	
				
				RowsTableCat.append(HeaderTableCat);
		
				HeaderTableCat =	document.createElement('th');
				HeaderTableCat.textContent = "Année de naissance";	
				RowsTableCat.append(HeaderTableCat);
			
				TableCat.append(RowsTableCat);
				for (var d = 0; d < DepartObj.info.ListCategorie.ListItem.length; d++)
				{
					var CatObj = DepartObj.info.ListCategorie.ListItem[d];
					let RowsTableCat =	document.createElement('tr');
				
					HeaderTableCat =	document.createElement('td');
					HeaderTableCat.textContent = CatObj.NumCategorie._Value ;	
					RowsTableCat.append(HeaderTableCat);
					HeaderTableCat =	document.createElement('td');
					HeaderTableCat.textContent = CatObj.NomCategorie._Value ;	
					RowsTableCat.append(HeaderTableCat);
					HeaderTableCat =	document.createElement('td');
					HeaderTableCat.style.textAlign= "center";
					if (CatObj.SexeCategorie._Value=="H")
					{
						HeaderTableCat.style.fontSize ="25px";
						HeaderTableCat.innerHTML = '<i class="fa fa-male" ></i>';
					}
					else if (CatObj.SexeCategorie._Value =="D")
					{
						HeaderTableCat.style.fontSize ="25px";
						HeaderTableCat.innerHTML = '<i class="fa fa-female" ></i>' ;
					}
					else
					{
						HeaderTableCat.style.fontSize ="25px";
						HeaderTableCat.innerHTML ='<i class="fa fa-female" >' + '<i class="fa fa-male" ></i>' ;
					}
				
					RowsTableCat.append(HeaderTableCat);


					HeaderTableCat =	document.createElement('td');
					HeaderTableCat.style.textAlign= "center";
					if (CatObj.debutAnneeInternet._Value.length > 1)
					{
						HeaderTableCat.textContent = CatObj.debutAnneeInternet._Value ;	
					}
					else
					{
						HeaderTableCat.textContent = CatObj.debutAnnee._Value ;	
					}
			
					if (CatObj.finAnneeInternet._Value.length > 1)
					{
						HeaderTableCat.textContent =  HeaderTableCat.textContent  + " - " +CatObj.finAnneeInternet._Value ;	
					}
					else
					{
						HeaderTableCat.textContent = HeaderTableCat.textContent  + " - " + CatObj.finAnnee._Value ;	
					}	
					RowsTableCat.append(HeaderTableCat);
					TableCat.append(RowsTableCat);
				}

				//ZoneTaifStartPara1.textContent = "Catégories : ";
				//DepartPara.append(ZoneTaifStartPara1);
				DepartPara.append(TableCat);

			
			}
			ParcoursPara.append(DepartPara);
		
		
		
	}

	// ************* ARRAY TARIFS ************************
	if (ParcoursObj.info.ListTariffZone != null && ParcoursObj.info.ListTariffZone.ListItem.length > 0 )
	{
		// Créer un Div Traif
		let  DivTarifPara = document.createElement('div');
		DivTarifPara.style.background =  "#BCDDFD";
		DivTarifPara.style.margin = "20px";
		DivTarifPara.style.borderRadius = "10px";
	
	
		//***************** Titre de la zone de tarif ****************
		let ZoneTaifStartPara =	document.createElement('p');	
		ZoneTaifStartPara.style.padding = "0px"
		ZoneTaifStartPara.className += "titleParcours";
		ZoneTaifStartPara.style.margin = "0px";
		ZoneTaifStartPara.innerHTML = "<table style='margin:0px;'><tr><td style='border-radius: 10px 0px 0px 0px;background:#3D6CA4;padding:5px;'><img src='/Icones/IconeMoneyBlanc.png'  style='width:50px;margin:5px;'/></td><td style='padding: 5px'>"+
			
		ParcoursObj.info.Nom._Value+"</td></tr></table>"

		DivTarifPara.append(ZoneTaifStartPara);
		ParcoursPara.append(DivTarifPara);
	
		var	ZoneTarifsObj =  new Object();
		ZoneTarifsObj = ParcoursObj.info.ListTariffZone.ListItem[0];
		let TableZoneTarif = document.createElement('table');			
		TableZoneTarif.id = "TableauCat";
		TableZoneTarif.style.margin = "auto";
		TableZoneTarif.style.width = "90%";

		let RowsTableTarif =	document.createElement('tr');
		let HeaderTableTarif =	document.createElement('th');
	
	
			HeaderTableTarif.textContent = "Type de paiement";
			RowsTableTarif.append(HeaderTableTarif);
		
			if (ZoneTarifsObj.dateEndZone != null && ZoneTarifsObj.dateEndZone._Value.length > 0)
			{
				HeaderTableTarif =	document.createElement('th');
				HeaderTableTarif.textContent = "Limite zone";	
				RowsTableTarif.append(HeaderTableTarif);
			}
			// Affichage des options de paiement dans l en tete
			if (ZoneTarifsObj.ListTarif != null && ZoneTarifsObj.ListTarif.length > 1 && ZoneTarifsObj.ListTarif.length < 6 )
			{
				for (var f = 0; f < ZoneTarifsObj.ListTarif.length; f++)
				{
					var	TarifsObj =  new Object();
					TarifsObj = ZoneTarifsObj.ListTarif[f];
					
					if (TarifsObj != undefined && TarifsObj.NomOption._Value != null && TarifsObj.NomOption._Value.length > 0)
					{
						HeaderTableTarif =	document.createElement('th');
						HeaderTableTarif.textContent = TarifsObj.NomOption._Value ;
						RowsTableTarif.append(HeaderTableTarif);
					}
				}
			}
		
		//*********** CONTENU DU TABLEAU TARIFS****************************
			
		for (var p= 0; p < ParcoursObj.info.ListTariffZone.ListItem.length; p++)
		{
			ZoneTarifsObj = ParcoursObj.info.ListTariffZone.ListItem[p];
			TableZoneTarif.append(RowsTableTarif);
			RowsTableTarif =	document.createElement('tr');
			if ( ZoneTarifsObj.NomZone != null && ZoneTarifsObj.NomZone._Value.length > 0)
			{
				HeaderTableTarif =	document.createElement('td');
				HeaderTableTarif.textContent = ZoneTarifsObj.NomZone._Value;	
				RowsTableTarif.append(HeaderTableTarif);
			}
			
			if ( ZoneTarifsObj.dateEndZone != null &&  ZoneTarifsObj.dateEndZone._Value.length > 0)
			{
				HeaderTableTarif =	document.createElement('td');

				if ( !isNaN(ZoneTarifsObj.MaximumInscription._Value) &&  ZoneTarifsObj.MaximumInscription._Value > 0 )
				{
					HeaderTableTarif.textContent ="< "+ ZoneTarifsObj.MaximumInscription._Value+ " athlètes";							
				}
				else
				{
				

					let date = new Date( ZoneTarifsObj.dateEndZone._Value);
					const options = { weekday: 'long', year: 'numeric', month: 'long', day: 'numeric' };
					HeaderTableTarif.textContent = date.toLocaleTimeString('fr-FR', options);
				}						
				RowsTableTarif.append(HeaderTableTarif);
			}
			// Affichage des options de paiement dans l en tete

			if (ZoneTarifsObj.ListTarif.length > 0 && ZoneTarifsObj.ListTarif.length < 6 )
			{
				for (var e = 0; e < ZoneTarifsObj.ListTarif.length; e++)
				{
					var	TarifsObj =  new Object();
					TarifsObj = ZoneTarifsObj.ListTarif[e];
					
					if ( TarifsObj != null && TarifsObj.NomOption._Value.length > 0)
					{
						HeaderTableTarif =	document.createElement('td');
						HeaderTableTarif.textContent = TarifsObj.tarif._Value + " CHF";
						RowsTableTarif.append(HeaderTableTarif);
					
					
					}
					
				}
			}
			TableZoneTarif.append(RowsTableTarif);
		
		}
		DivTarifPara.append(TableZoneTarif);
	}
		newDiv.append(ParcoursPara);
		//	ParcoursPara.append(TableCat);
	
		
	
}
	
	
newDiv.id = "Information";
b.append(newDiv);

/************************** Apres crétion du DOm obligatoire pour fichier gpx*/

for (var i = 0; i < ArrayParcours.length; i++) 
{
	if (ArrayParcours[i].GPX != null && ArrayParcours[i].GPX.length > 0)
	{
		funCreateDrawerMap(ArrayParcours[i].nom , ArrayParcours[i].GPX);
	}
	else
	{
		for (var h = 0; h < ArrayParcours[i].ArrayDepart.length; h++)
		{
			if ( ArrayParcours[i].ArrayDepart[h].ArrayEtape!= null)
			{
				for (var j = 0; j < ArrayParcours[i].ArrayDepart[h].ArrayEtape.length; j++)
				{
					if ( ArrayParcours[i].ArrayDepart[h].ArrayEtape[j].GPX != null && ArrayParcours[i].ArrayDepart[h].ArrayEtape[j].GPX.length > 0)
					{
					
						funCreateDrawerMap(ArrayParcours[i].ArrayDepart[h].Nom +  ArrayParcours[i].ArrayDepart[h].ArrayEtape[j].Nom, ArrayParcours[i].ArrayDepart[h].ArrayEtape[j].GPX);
					}
				}
				if ( ArrayParcours[i].ArrayDepart[h].ArrayDiscipline != null)
				{
					for (var z = 0; z < ArrayParcours[i].ArrayDepart[h].ArrayDiscipline.ListItem.length; z++)
					{
						if ( ArrayParcours[i].ArrayDepart[h].ArrayDiscipline[z].GPX.length > 0)
						{
							funCreateDrawerMap("Disc" +(z +1)+ArrayParcours[i].ArrayDepart[h].Nom, ArrayParcours[i].ArrayDepart[h].ArrayDiscipline[z].GPX);
						}
					}
				}
			}	
		}
	}
}

/*** Obtenir position de base des élément */

	for (var i = 0; i < ArrayParcours.length; i++) 
	{
		// Obtenir la position de chaque element 
		var mon_element = document.getElementById("div"+ArrayParcours[i].nom);
		console.log(ArrayParcours[i].nom);
		var positions = mon_element.getBoundingClientRect();
		console.log(positions.top);
		ArrayParcours[i].PositionTop = positions.top-300;
		// selon sa position definir la couleur
		if ( document.documentElement.scrollTop >= positions.top ) {
			mon_element.classList.add("nav-colored");
			mon_element.classList.remove("nav-transparent");
		} 
		else {
			mon_element.classList.add("nav-transparent");
			mon_element.classList.remove("nav-colored");
		}
	}
</script>
</div>
							
</div>

 <?php 
}
 include("../includes/sponsorsPagesInfo.php"); ?> 
</div>

</body>
</html>

<script>

var myNav = document.getElementById('Menu1');
window.onscroll = function () { 

	 if (document.body.scrollTop > 50 || document.documentElement.scrollTop > 50) {
   
    document.getElementById("GoToTop").style.visibility = "visible";
  } else {
    document.getElementById("GoToTop").style.visibility = "hidden";
 
  }
 
};





	function copyStylesInline(destinationNode, sourceNode) {
	var containerElements = ["svg","g"];
	for (var cd = 0; cd < destinationNode.childNodes.length; cd++) {
		var child = destinationNode.childNodes[cd];
		if (containerElements.indexOf(child.tagName) != -1) {
				copyStylesInline(child, sourceNode.childNodes[cd]);
				continue;
		}
		var style = sourceNode.childNodes[cd].currentStyle || window.getComputedStyle(sourceNode.childNodes[cd]);
		if (style == "undefined" || style == null) continue;
		for (var st = 0; st < style.length; st++){
				child.style.setProperty(style[st], style.getPropertyValue(style[st]));
		}
	}
	}

	function triggerDownload (imgURI, fileName) {
		var evt = new MouseEvent("click", {
			view: window,
			bubbles: false,
			cancelable: true
	})};
</script>
