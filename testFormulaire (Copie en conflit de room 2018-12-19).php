<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="fr" >
   <head>
       <title>GSFM</title>
       <meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
	     <meta name="viewport" content="width=device-width, maximum-scale=1.0, user-scalable=yes">
	       <link rel="stylesheet" media="screen" type="text/css" title="style" href="style.css" />

     <link rel="stylesheet" title="defaut" media="screen" href="style.css" type="text/css"/>
     <link rel="stylesheet" type="text/css" media="screen and (max-width: 480px)" href="style-mobil.css" />
 </head>
 
   
  <?php include("onglets.php"); ?>
 
<div id="corps">
<?php include("menu_vertical.php"); ?>
		 <select id="examplea" onchange ="CreateValue1()" ></select>
		 <select id="examplea2"  ></select>
<script>


var ArrayParcours = [];
function addValue(Text , Value) 
{

var sel = document.getElementById("examplea");
 sel.options.add( new Option(Text, Value));
 }

function CreateValue1() {
	var intselected = document.getElementById("examplea").selectedIndex;
	var sel = document.getElementById("examplea2");
	 sel.options.length = 0;
	
	if (typeof ArrayParcours[intselected].ArrayDepart != "undefined")
	{
		var nbrDepart = ArrayParcours[intselected].ArrayDepart.length;

			for(var Depart=0; Depart<nbrDepart; ++Depart) 
			{
				 sel.options.add( new Option(ArrayParcours[intselected].ArrayDepart[Depart].Nom, ArrayParcours[intselected].ArrayDepart[Depart].Nom));		
			}	
		
		if (nbrDepart >1)
		{
			sel.style.visibility = "visible" ;
			sel.readOnly = true;
		}
		else
		{
		sel.style.visibility = "hidden" ;
			sel.readOnly = true;
		}
	}
}
</script>
			<!--- Liste des parcours !---->
		<?php
		// Afficher la liste des Parcours  Dossier dans la course ;
		$pathfolder = 'courses/'.$_GET['nom_course'].$ANNEE_COURSE;
		// Création de la liste de toutes les Dossier = Parcours 
		$files1 = scandir($pathfolder);
	// Liste des ficbier 
		foreach ($files1  as $key => $Parcours) 
		{ 
			if(is_dir($pathfolder .'/'.$Parcours))
			{
				// Affichage dans la liste des départ dans le menu 
				if (strlen($Parcours) >2 && $Parcours != "info") 
				{	

				?>	
				<script>
					var Parcours= new Object();
					Parcours.nom=<?php echo json_encode($Parcours); ?>;
					Parcours.HeureStart=<?php echo json_encode($Parcours); ?>;
					Parcours.Distance =<?php echo json_encode($Parcours); ?>;
		
					
					var ArrayCat = [1,2,3,4];
					var ArrayDepart = [];
				</script>
				<?php
					//<!--- Liste des Départ !---->
					// Afficher la liste des Parcours  Dossier dans la course ;
					$pathfolderDepart = 'courses/'.$_GET['nom_course'].$ANNEE_COURSE. '/'.$Parcours;
					// Création de la liste de toutes les Dossier = Depart 
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
									var Depart= new Object();
									Depart.Nom = <?php echo json_encode($depart); ?>;
								</script>
								<?php
									// Lecture du fichier info.txt 	
								$pathFileInfo = 'courses/'.$_GET['nom_course'].$ANNEE_COURSE.'/'.$Parcours.'/'.$depart.'/info.txt';
								if (file_exists($pathFileInfo))
								{
									if (($handle = fopen($pathFileInfo, "r")) !== FALSE) 
									{
										$cmpt =0;
										$cmptDiscipline =0;
										while (($datatxt = fgetcsv($handle, 1000, ";")) !== FALSE) 
										{
											$cmpt++; 
											if( $cmpt==1)
											{?>
											<script>
												Depart.HeureStart=<?php echo json_encode($datatxt[1]); ?>;
												Depart.PrixInternet=<?php echo json_encode($datatxt[2]); ?>;
												Depart.PrixPlace=<?php echo json_encode($datatxt[3]); ?>;
												Depart.Distance=<?php echo json_encode($datatxt[4]); ?>;
											</script>
											<?php
											}
											// Lecture Ligne 2 
											else if( $cmpt==2)
											{
												$NbrDiscipline =intval($datatxt[1]);
												?>
												<script>
													Depart.NbrDiscipline=<?php echo json_encode(intval($datatxt[1])); ?>;
												</script>
												<?php
											}
											else if( $cmpt>2)
											{	?>
											<script>
											var Discpline = new Object();
											 Discpline.Nom = <?php echo json_encode($datatxt[1]); ?>;
											 Discpline.Distance = <?php echo json_encode($datatxt[2]); ?>;
											 Discpline.Deniv = <?php echo json_encode($datatxt[3]); ?>;
											 ArrayDiscipline.push(Discpline);
											</script>
											<?php
											}
										}
									}
								}
								?>
						<script>
						
							ArrayDepart.push(Depart);
						</script><?php
						}
						}	
					}?>
					<script>
						Parcours.ArrayDepart =ArrayDepart;
					
						ArrayParcours.push(Parcours);
					</script><?php
				}
			}
		}
		?>
		<script>
		for(var Parcours=0; Parcours<ArrayParcours.length; ++Parcours) 
		{
			if (typeof ArrayParcours[Parcours].ArrayDepart != "undefined")
			{
				if ( ArrayParcours[Parcours].ArrayDepart.length > 1)
				{
					addValue(ArrayParcours[Parcours].nom , ArrayParcours[Parcours].nom) ;
				}
				else
				{
					addValue(ArrayParcours[Parcours].nom +" "+ ArrayParcours[Parcours].ArrayDepart[0].Distance , ArrayParcours[Parcours].nom) ;
				}
			}
			else
			{
			document.write("0");
			}
		}
		
		</script>