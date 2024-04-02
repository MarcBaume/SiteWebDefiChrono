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

<Body>
<div id="Top1"></div>
        <a href="#Top1" id="GoToTop" class="GoToTop" style ="display :none ;z-index:3000;" >
    <i class="fa fa-arrow-up" style= "font-size: 50px;margin:2px;"></i>
</a>

<center>
	  

 <?php
	  include("Header2023.php"); 
	  ?>
 </center>
<?

include("HeaderInfo2023_WithoutCouverture.php"); 
	

	$Parcours = $_GET['Parcours'];
	$Classement = $_GET['Classement'];
	$Depart = $_GET['Depart'];
	$Etape = $_GET['Etape'];
// Tableau des fichiers

	  ?>

	<form method="get" action="Resultat2023GeneralJuraDefi.php" id="FormSendIndfo">
		<input type="hidden" name="DateCourse" id="DateCourse" tabindex="10"  size="60"  value= '<?php echo $_GET["DateCourse"] ?>' />
		<input type="hidden" name="NomCourse" id="FormNomCourse" tabindex="10"  size="60"  value= '<?php echo $_GET["NomCourse"] ?>' />
		<input type="hidden" name="NbrEtape" id="FormNbrEtape" tabindex="10"  size="60"  value= '<?php echo $_GET["NbrEtape"] ?>' />
		<input type="hidden" name="Depart" id="FormDepart" tabindex="10"  size="60"  value= '<?php echo $Depart ?>' />
		<input type="hidden" name="Parcours" id="FormParcours" tabindex="10"  size="60"  value= '<?php echo $Parcours ?>' />
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
	<? if ($Parcours == null)
	{?>
		<fieldset class="fieldsetResultat">
			<Legend  class="LegendResultat">
				Sélectionner un parcours
			</Legend>

	<?	
	}?>
	<table id="TableParcours" class="menu_vertical">
	<tr>
		<? 
		foreach($arParcours as $Parcours1)
		{
			$IndexParc++;
			?>
			<td onClick='ChangParcours(<?php echo json_encode($Parcours1)?>);'  style="cursor: pointer;" > 
			
			<? if ($Parcours != $Parcours1)
			{ ?>
					<p style="color : #3d6ca4;  background: transparent;">
					<span class="dot">
						<i class="fa fa-map" style= "color : #3d6ca4;font-size: 25px;margin:5px;"></i>
				
					<? echo $Parcours1 ?>
					</span>
				</p>
			<?
			}
			else
			{  ?>
				<p style="color : #3d6ca4; background: transparent;">
				<span class="dotDisplayed">
							<i class="fa fa-map" style= "color :#BCDDFD;font-size: 25px;margin:5px;"></i>
				
				<? echo $Parcours1 ?>
				</span>
			</p>
		<?
			}?>

			</td><?
		}?>
	</tr>
	</table>
	<? if ($Parcours == null)
	{?>
		</fieldset>
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
			<td onClick='ChangeDepart(<?php echo json_encode($Depart1)?>);'  style="cursor: pointer; " > 

			<? if ($Depart == $Depart1)
			{ ?>
				<p style="color : #3d6ca4;  background: transparent;">
				<span class="dot">
							<i class="fa fa-flag" style= "font-size: 25px;margin:5px;"></i>
				
					<? echo $Depart1 ?>
					</span>
				</p>
			<?
			}
			else
			{  ?>
				<p style=" color : #3d6ca4;  background: transparent;">
				<span class="dotDisplayed">
							<i class="fa fa-flag" style= "color :#BCDDFD;font-size: 25px;margin:5px; "></i>
				
					<? echo $Depart1 ?>
					</span>
				</p>
			<?
			}?>
			
			</td><?
		}?>
		</tr>
		</table>	
		<? if ($Depart == null)
			{?>
				</fieldset>
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
?>
<script>
console.log("Depart");
	</script>
<?
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
	// SI il y plus que 1 départ affichage d'un menu pour le choix du départ
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

		foreach($arEtape as $Etape1)
		{
			if ($Etape1 == 'General')
			{
				$IndexDep= 99;
			}
			else
			{
				$IndexDep++;
			}?>
			<script>
				console.log(<?php echo json_encode($numetape)?>);
			</script>
		
		
			<td onClick='ChangEtape(<?php echo json_encode($IndexDep)?>);'  style="cursor: pointer; " > 
			<? 
			if ($numetape!= $IndexDep )
			{ ?>
				<p style="color : #3d6ca4;  background: transparent;">
				<span class="dot">
							<i class="fa fa-trophy" style= "font-size: 25px;margin:5px;"></i>
				
					<? echo $Etape1 ?>
					</span>
				</p>
			<?
			}
			else
			{  ?>
				<p style=" color : #3d6ca4; background: transparent;">
				<span class="dotDisplayed">
							<i class="fa fa-trophy" style= "color :#BCDDFD;  font-size: 25px;margin:5px;"></i>
				
					<? echo $Etape1 ?>
					</span>
				</p>
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
		$Etape =$EtapeTampon;


	}
}?>

<table class="menu_vertical" style="margin-top : 20px; padding :10px">

<?

	
$nbrFileClassement = 0;
/************************************* CLASSEMENTS ********************************/
// Afficher le classement du départ choisi
if ($Parcours!=("") && $Depart!=("")&& $Etape!=(""))
{
	// Afficher la liste des départ Dossier dans la course ;
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
		
	// Création de la liste de toutes les Dossier = Depart 
	$files1 = scandir($pathfolder);
	// Lecture de chaques dossier Pacours Exemple Adultes / Enfants 
	foreach ($files1  as $key => $value) 
	{ 
		
		// SI LE FICHIER EST DE TYPE CLASSEMENT 
		$pos = strpos($value, 'classement');
		$pos2 = strpos($value, 'Classement');
		if ($pos !== false || $pos2 !== false) 
		{
			
			$nbrFileClassement++;
			$ClassementTampon = $value;	
		}
	}
	?>
	<script>
		console.log(<?php echo json_encode($pathfolder)?>);
		</script>
	<?
	// SI il y plus que 1 départ affichage d'un menu pour le choix du départ
	if ($nbrFileClassement> 0)							
	{?>
	
		<tr>
		<form method="get" action="Resultat2023General.php">
			<input type="hidden" name="DateCourse" id="DateCourse" tabindex="10"  size="60"  value= '<?php echo $_GET["DateCourse"] ?>' />
			<input type="hidden" name="NomCourse" id="FormNomCourse" tabindex="10"  size="60"  value= '<?php echo $_GET["NomCourse"] ?>' />
			<input type="hidden" name="NbrEtape" id="FormNbrEtape" tabindex="10"  size="60"  value= '<?php echo $_GET["NbrEtape"] ?>' />
			<input type="hidden" name="Depart" id="FormDepart" tabindex="10"  size="60"  value= '<?php echo $Depart ?>' />
			<input type="hidden" name="Parcours" id="FormParcours" tabindex="10"  size="60"  value= '<?php echo $Parcours ?>' />
			<input type="hidden" name="Etape" id="FormEtape" tabindex="10"  size="60"  value= '<?php echo $Etape ?>' />
		
		<td> <label for="Classement">Classements :</label></td>
			<td>
			<select name="Classement" onchange="this.form.submit()" >
	
		<?php
		if ($_GET['Classement'] != null)
		{
			
			$NameDisplayClassement = str_replace("classement_", "",$_GET['Classement']); 
			$NameDisplayClassement = str_replace(".csv", "",$NameDisplayClassement ); 

			echo "<option value=\"".$_GET['Classement']."\">$NameDisplayClassement</option>";
								
		}
		else
		{
			if ($nbrFileParcours == 1)
			{?>
			<option value="">Sélectionné un classements</option>	
			<?Php
			}	
			else
			{
				
				$Classement  = "Tous les classements";
			}
		}
		if ($nbrFileParcours > 1 && $_GET['Classement'] != "Tous les classements")
		{
?>
			<option value="Tous les classements">Tous les classements</option>		
<?php	
		}
	   foreach ($files1  as $key => $value) 
	   { 
			// SI LE FICHIER EST DE TYPE CLASSEMENT 
			$pos = strpos($value, 'Classement');
			$pos2 = strpos($value, 'classement');
			if ($pos !== false || $pos2 !== false) 
			{
				if ($value !== $_GET['Classement'])
				{

					if ($value == 'Classement.csv')
					{
						echo "<option value=\"".$value."\">\"".rtrim($value, '.csv')."\"</option>";
					}
					else
					{			
						$NameDisplayClassement = str_replace("classement_", "",$value); 
						$NameDisplayClassement = str_replace(".csv", "",$NameDisplayClassement); 					
						echo "<option value=\"".$value."\">$NameDisplayClassement </option>";
					}
				}
			}
		}
		?>
		
		</select>
		</td>
		</form>	
		</tr>
	
	<?php
	}
	else
	{
		// si il y a que un classement ;
		$Classement =$ClassementTampon;
	}
}
?>

</table>
<?
	if ( $Classement!= null && $Classement != "")
	{
		?>
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
		<?php
	}?>
	</br>
	</br>
<div  id="TableauResulat">
	
<?

/************************************** AFFICHAGE FICHIER CLASSEMENT *****************************************/

if ($Parcours!=("")  && $Depart!=("") && $Etape!=(""))
{
	foreach ($files1  as $key => $value) 
	{

		$pos = strpos(strtoupper($value), 'CLASSEMENT');
	
		if (($value == $_GET['Classement']  || $Classement == "Tous les classements" )&& $pos !== false)
		{   
			
			$pathfolder = 'courses/'.$_GET['NomCourse'].$ANNEE_COURSE.'/'.$Parcours.'/'.$Depart;
			// AFFICHAGE DES RESULTAT PAR ETAPE
			if ($Etape >0 && $Etape <99 )
			{
			
				$pathFile = $pathfolder   .'/Etape'.$_GET['Etape'].'/'. $value;
				
			}
			// Classement General
			elseif ($Etape == 99)
			{
				
				$pathFile = $pathfolder  .'/General/ResultatWeb/'.$value;
			//	echo("Folder".$pathFile);
			}
			else
			{
				$pathFile = $pathfolder .'/Etape1/'.$value;
			}
			if (file_exists($pathFile)) 
			{
				if (($handle = fopen($pathFile, "r")) !== FALSE) 
				{
					?>
					<div class ="TableResult" ><?
					while (($data = fgetcsv($handle, 1000, ";")) !== FALSE) 
					{
						$num = count($data);
						// Lecture de chaque ligne du fichier fichier CSV 
						if ($data[0] == "Title"   )
						{
							?>
							<Table class="TitleResultat">
								<tr>
								<? 
									
									for ($c=1; $c < $num; $c++)
									{?>
	
										<th><?php  echo $data[$c]?> </th><?php
									}
								?>
								</tr>
							</Table>
							<?
						}

						else if ($data[0] == "Etape"   )
						{
							if ($Discipline)
							{
								$Discipline = false;
								?>
									</table>
									</td>
									</tr>
		
								<?
							}
							// Création détail Etape Si premiere etape
							if (!$Etape) // Si on a fini les point
							{
								
								$Etape = true;
							?>
								<tr  style="display: none" id="<?php echo "InfoPosition".$IDPosition  ?>"> <!--  style="visibility: collapse" -->
								<td colspan =<?php echo $NbrColumn; ?>>
										<table class="TableEtapeResultat" ><!--style="visibility: collapse"--> 
											<tr>
												<!-- Header Etape -->
												<th>Nom Etape</th>
												<th>Scratch</th>
												<th>Temps</th>
												<th>écart</th>
												
											</tr>
							<?php
							}
							?>
							<!-- AFFICHAGE DE L ETAPE -->
								<tr><?
									// Valeur Etape 
									for ($c=1; $c < $num; $c++)
									{
										if ($_GET["NomCourse"] =='Jura Défi' &&  $c==1)
										{
											$iEtape = $iEtape+1;
												if ($iEtape == 1)
												{?>
													<td style="background :#AEE5FD"> Matin</td>
<?
												}
												else if ($iEtape == 2)
												{
													?>
													<td style="background :#AEE5FD"> Après-midi</td>
<?
												}
												else if ($iEtape == 3)
												{
													?>
													<td style="background :#AEE5FD"> Surprise</td>
<?
												}
										}
										else
										{?>
											<td style="background :#AEE5FD"> <?php  echo $data[$c]?> </td><?php
										}
									}?>
								</tr>
							<?
						}
						else if ($data[0] == "Point"   )
						{
							// Création détail Etape Si premiere etape
							if (!$Discipline) // Si on a fini les point
							{
						
								$Discipline = true;
							?>
								<tr> <!--  style="visibility: collapse" -->
								<td colspan =<?php echo $NbrColumn; ?>>
										<table class="TableEtapeResultat" ><!--style="visibility: collapse"--> 
											<tr>
												<!-- Header Etape -->
												<th>Discipline</th>
												<th>Nom</th>
												<th>Prénom</th>
												<th>pos</th>
												<th>temps</th>
												<th>écart</th>
											</tr>
							<?php
							}
							?>
							<!-- AFFICHAGE DE L ETAPE -->
								<tr><?
									// Valeur Etape 
									for ($c=1; $c < $num; $c++)
									{?>
										<td style="background :#DADBDB"> <?php  echo $data[$c]?> </td><?php
									}?>
								</tr>
							<?
						}
						else if ($data[0] == "Header" )
						{
							if ($Discipline)
							{
								$Discipline = false;
								?>
									</table>
									</td>
									</tr>
		
								<?
							}
							if ($Etape)
							{
								
								$Etape = false;
							?>
								</table>
								</td>
								</tr>
	
							<?
							}
							if ($ArrayPosition) // Fermeture du tableau de la dernière position
							{
								?>
								
								</Table>
							<?php
							}
							if ($Position) // Fermeture du tableau de la dernière position
							{
								$Position = false;
								?>
								</tr>
								</Table>
							<?php
							}

							$ArrayPosition = true;
							?>
							<DIV  class="DivListeResultat">
							<Table class="TableauListeResultat">
								<tr><?
									$NbrColumn = 1;
									// Valeur Etape 
									for ($c=1; $c < $num; $c++)
									{
										$NbrColumn++?>
										<th><?php  echo $data[$c]?> </th><?php
									}?>
									<th> </th> <!-- Column vide pour symbol + -->
								</tr>
									
							<?php
						}
						else if ($data[0] == "$"   ||$data[0] == "LF" ) // Fin de tableau
						{
							
							if ($Etape ) // Si on a fini les point
							{
								$Etape = false;?>
								</table>
								</td>
								</tr>
								<?
							}
							
							$Position = false;
							$start_array = false;
							$en_tete = false;
							if ($ArrayPosition)
							{
								$ArrayPosition = false;?>
								
								</Table>
								</div>
							<?php
							}
							if ($Position)
							{
								$Position = false;?>
								</tr>
								</Table>
							<?php
							}
							?>
							</td>
							</tr>
							</Table>	
							<?php
						}
					
						else	if ($data[0] == "Position") // Nouvelle ligne position
						{
							if ( $Etape ) // Si on a fini les point
							{
								$iEtape = 0;
								$Etape = false;?>
								</table>
								</td>
								</tr>
								<?
							}
							
							if (!$Position) // Fermeture du tableau de la dernière position 
							{
								$Position = true;
							}
								$IDPosition ++;
							?>
							<tr class="LinePosition"   style="cursor: pointer;"  onClick="ClickRows( event, <?php echo $IDPosition ?>)"> <!-- onClick !-->
								<?
								// Valeur Etape 
								for ($c=1; $c < $num; $c++)
								{?>
									<td><?php  echo $data[$c]?> </td><?php
								}?>
								<td>
								<span class="dot2" id="<?php echo "Icons".$IDPosition  ?>">
									 <i  style="  margin:3.2px; margin-left:5px;"  class="fa fa-plus"></i>
								 </span>
								 <span style=" display: none;"  class="dot2" id="<?php echo "IconsMinus".$IDPosition  ?>">
									  <i  style="  margin:3.2px; margin-left:5px;"  class="fa fa-minus" ></i>
								</span>
								</td>
								
							</tr> <!-- fin ligne en position -->
						<?
					}
					else
					{
						?>

						<tr>
						<?php
						// Lecture fichier CSV 
						for ($c=0; $c < $num; $c++)
						{

							if ($data[$c] == "pos"   ||$data[$c] == "Rang" )
							{
								$start_array = true;
								$en_tete = true;?>
								<Table>	
								<?php
							}

							if($en_tete)
							{
								if ($val ["ListeDepartGacond"]== 1 )
								{
			
									if (($c != 8 && $c != 9 && $c != 10 && $c != 7))
									{
									?>
									<th><?php    echo $data[$c]?> </th><?php
									}
								}
								elseif  ($val ["JuraDefi"]== 1)
								{?>
									<th><?php    echo $data[$c]?> </th><?php
								}
								else
								{
									//AFfichage général pour trophée du doubs 
									if ($numetape == 99 && $c != 10 && $c != 11 && $c != 4 && $c != 5 && $c != 11 && $c != 12 && $c != 13)
									{
					?>
										<th><?php    echo $data[$c]?> </th><?php
									}
									elseif (($numetape != 99 && $c != 4 && $c != 5 && $c != 11 ) || $ANNEE_COURSE > 2018)
									{
									?>
										<th><?php    echo $data[$c]?> </th><?php
									}
								}
							}
							else
							{
								if ($val ["ListeDepartGacond"]== 1 )
								{
									if ($c != 8 && $c != 9&& $c != 10 && $c != 7)
									{
									?>
									<td><?php    echo $data[$c]?> </td><?php
									}
		
								}
								elseif  ($val ["JuraDefi"]== 1)
								{
										?>
									<td><?php    echo $data[$c]?> </td><?php
								}
								else
								{
									//AFfichage général pour trophée du doubs 
									if ($numetape == 99 && $c != 10 && $c != 11 && $c != 4 && $c != 5 && $c != 11 && $c != 12&& $c != 13)
									{
									?>
									<td><?php    echo $data[$c]?> </td><?php
									}
									elseif (($numetape != 99 && $c != 4 && $c != 5 && $c != 11 ) || $ANNEE_COURSE > 2018)
									{
									?>
									<td><?php    echo $data[$c]?> </td><?php
									}
								}
							}
						}
						$en_tete = false?> 
						</tr>
					<?php
					}
	
				}
				?>
				</table>
				</div>
				</table>
				</table>
				<script>
					
console.log("csdfsd");
			</script>
				<?
				fclose($handle);
				}
			}
		}
	}

}

?>
</table>
</div>

</div>
 <?php include("sponsors2023.php"); ?> 
</body>

	<script type="text/javascript">
function valider()
{
	var table = document.getElementsByClassName("TableResult");
	console.log(table);
	
	input = document.getElementById("InputSearch");
	
		inputPrenom = document.getElementById("InputSearchPrenom");
	
	filter = input.value.toUpperCase();
	filterPrenom = inputPrenom.value.toUpperCase();
	var i;
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
//document.formulaire.submit();
}

	function ClickRows(event, id)
    {  
	
	
		if (	document.getElementById("InfoPosition"+id).style.display == "")
		{
		
		document.getElementById("IconsMinus"+id).style.display = "none" ;
		document.getElementById("Icons"+id).style.display = "" ;
		document.getElementById("InfoPosition"+id).style.display = "none" ;
		}
		else
		{
			
			document.getElementById("IconsMinus"+id).style.display = "" ;
		document.getElementById("Icons"+id).style.display = "none" ;
			document.getElementById("InfoPosition"+id).style.display = "" ;
		}
	event.stopPropagation(); 
		
    }

	function ChangParcours(sParcours)
		{  
			document.getElementById("FormParcours").value =sParcours;
			document.getElementById("FormEtape").value =0;
			elmnt = document.getElementById("FormSendIndfo");
			elmnt.submit();
		}

		function ChangDepart(sDepart)
		{  
			document.getElementById("FormDepart").value =sDepart;
			document.getElementById("FormEtape").value =0;
			elmnt = document.getElementById("FormSendIndfo");
			elmnt.submit();
		}

		function ChangEtape(sEtape)
		{  
			document.getElementById("FormEtape").value =sEtape;
			elmnt = document.getElementById("FormSendIndfo");
			elmnt.submit();
		}

		window.onscroll = function () { 

//ColorMenuParcours();

 if (document.body.scrollTop > 50 || document.documentElement.scrollTop > 50) {

document.getElementById("GoToTop").style.display = "";
} else {
document.getElementById("GoToTop").style.display = "none";

}

};
</script>

</html>




  
