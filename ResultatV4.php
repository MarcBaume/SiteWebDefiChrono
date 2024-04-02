<!DOCTYPE html>
<html>
<head>
	<meta property="og:description" content="chronométrage, chrono, jura, franches-montagnes, Jura défi, course à pied, Sport, Jura défi chrono" />  
	<title>Défi Chrono</title>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, maximum-scale=1.0, user-scalable=yes">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css">
	<link rel="stylesheet" title="defaut" media="screen" href="styleV3.css" type="text/css"/>
<!--	<link rel="stylesheet" type="text/css" media="screen and (max-width: 480px)" href="style-mobilV2.css" /> -->
</head>

    <body>

<?php

  include("Header.php"); 
  ?>
<div id="corps">

	<?php include("HeaderInfo.php"); ?>


	<div class="popup" style="float:right;" >

	  <?php
$sqlResult = 'SELECT * FROM Course  WHERE KeyNomCourse=\''.$val ["KeyNomCourse"].'\'' ; 
	$resultResult = mysqli_query($con,$sqlResult);
	if ($resultResult && mysqli_num_rows($resultResult) > 0) 
	{?>
		
			<table>
		<?php
/**************************************************************************************************************33
 * 
 * 					HIstorique des courses
 * 
 *******************************************************************************************************************/

			// output data of each row
		while($valResult = mysqli_fetch_assoc($resultResult)) 
		{?>
			
			<? $DateResult =  date_parse($valResult['Date']);	
			$NomCourse = $valResult['Nom_Course'];
			// si année différentes de l'année en cours
			if ($DateResult['year']<> $ANNEE_COURSE)
			{
				?>
				<tr  >
				<td>
					<div style= "margin:5px;background: #00b4ff;padding:5px">
					<i class="fa fa-trophy" style= "font-size: 24px;margin:5px;color: white;"></i>
				<?php
				// Multi étape 
				if (intval($valResult['nbr_etape'])>1)
				{
					if ($DateResult['year']> 2022)
					{
						
						?>
						<a href="<? echo "informations2023.php?Etape=0&NbrEtape=".$valResult['nbr_etape']."&DateCourse=".$valResult['Date']."&NomCourse=".$NomCourse?>" style= "font-size: 16px;margin:5px;color: black;"><?	echo $DateResult['year'];?></a>
						<?
					}
					else if ($DateResult['year']> 2021)
					{
						
						?>
						<a href="<? echo "informations2022.php?&NbrEtape=".$valResult['nbr_etape']."&DateCourse=".$valResult['Date']."&NomCourse=".$NomCourse?>" style= "font-size: 16px;margin:5px;color: black;" ><? echo $DateResult['year'];?></a>
						<?
					}
				
					else
					{
						?>
						<a href="<? echo "informations.php?&NbrEtape=".$valResult['nbr_etape']."&DateCourse=".$valResult['Date']."&NomCourse=".$NomCourse?>" style= "font-size: 16px;margin:5px;color: black;" ><? echo $DateResult['year'];?></a>
							<?
					}
				}
				else if ($DateResult['year']> 2022)
				{
					
					?>
					<a href="<? echo "Resultat2023.php?Etape=0&NbrEtape=".$valResult['nbr_etape']."&DateCourse=".$valResult['Date']."&NomCourse=".$NomCourse?>" style= "font-size: 16px;margin:5px;color: black;"><?	echo $DateResult['year'];?></a>
					<?
				}
				// Selon l'année affichage des résultats
				else if ($DateResult['year']> 2021)
				{
					
					?>
					<a href="<? echo "ResultatV4.php?Etape=0&NbrEtape=".$valResult['nbr_etape']."&DateCourse=".$valResult['Date']."&NomCourse=".$NomCourse?>" style= "font-size: 16px;margin:5px;color: black;"><?	echo $DateResult['year'];?></a>
					<?
				}
				
				else
				{
					?>
					<a href="<? echo "ResultatV3.php?Etape=0&NbrEtape=".$valResult['nbr_etape']."&DateCourse=".$valResult['Date']."&NomCourse=".$NomCourse?>" style= "font-size: 16px;margin:5px;color: black;"><?	echo  $DateResult['year'];?></a>
						<?
				}
				?>
				</div>
				</td>
				</tr><?
			}
		}
		?>
		</table>

<?php
	}
/**************************************************************************************************************33
 * 
 * 					Résultats de la course en cours
 * 
 *******************************************************************************************************************/
?>

</div>
	<h3>Résultats  <?php  echo $NOM_COURSE. ' ' . $ANNEE_COURSE ?></h3>


<?php 
$row = 1;
$start_array = false;
$numetape = intval($_GET['Etape']);
// Afficher la liste des départ Dossier dans la course ;
$pathfolder = 'courses/'.$_GET['NomCourse'].$ANNEE_COURSE;

// Création de la liste de toutes les Dossier = Depart 
$files1 = scandir($pathfolder);
$Parcours = $_GET['Parcours'];
$Classement = $_GET['Classement'];
$Depart = $_GET['Depart'];

// Lecture de chaques dossier Pacours Exemple Adultes / Enfants 
foreach ($files1  as $key => $value) 
{ 

   if(is_dir($pathfolder .'/'.$value))
   {
		// Affichage dans la liste des départ dans le menu 
		if (strlen($value) >2 && $value != "info") 
		{		
			$nbrFileParcours++;
			$ParcoursTampon = $value;
		}		
	}
}


/***************************** Parcours ************************************/

// SI il y plus que 1 parcours affichage d'un menu pour le choix du départ
if ($nbrFileParcours> 1)
{?>
	<tr>
		<form method="get" action="ResultatV4.php">
		<input type="hidden" name="DateCourse" id="DateCourse" tabindex="10"  size="60"  value= '<?php echo $_GET["DateCourse"] ?>' />
		<input type="hidden" name="Etape" id="Etape" value= '<?php echo $_GET["Etape"] ?>' />
		<input type="hidden" name="NomCourse" id="NomCourse" tabindex="10"  size="60"  value= '<?php echo $_GET["NomCourse"] ?>' />
		<input type="hidden" name="NbrEtape" id="NbrEtape" tabindex="10"  size="60"  value= '<?php echo $_GET["NbrEtape"] ?>' />
		<td> 
			<label for="Parcours">Parcours :    </label>
		</td>
		<td>
			<select name="Parcours" onchange="this.form.submit()" style="width: 300px;">
			<?php
				if ($_GET['Parcours'] != null)
				{
					echo "<option value=\"".$_GET['Parcours']."\">\"".$_GET['Parcours']."\"</option>";
				}
				else
				{
				?>
					<option value="">Sélectionner un Parcours</option> 
				<?php
				}

   foreach ($files1  as $key => $value) 
   { 
	
	   if(is_dir($pathfolder .'/'.$value))
	   {
			// Affichage dans la liste des départ dans le menu 
			if (strlen($value) >2 && $value != "info") 
			{
				if ($_GET['Parcours'] !== $value)
				{
					echo "<option value=\"".$value."\">\"".$value."\"</option>";
				}
			}
		}
	}
	?>
	
	</select>
	</td>
	</tr>
			<tr style="Height:10px">
	</tr>
</form>	
<?php
}
else
{
	// si il y a que un départ ;
	$Parcours =$ParcoursTampon;
}

/***************************** DEPART ************************************/
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
			
				$nbrFileDepart++;
				$DepartTampon = $value;
			}		
		}
	}
	// SI il y plus que 1 départ affichage d'un menu pour le choix du départ
	if ($nbrFileDepart> 1)
	{?>
		<tr>
		<form method="get" action="ResultatV4.php">
		<input type="hidden" name="DateCourse" id="date_course" tabindex="10"  size="60"  value= '<?php echo $_GET["DateCourse"] ?>' />
		<input type="hidden" name="Etape" id="etape" value= '<?php echo $_GET["Etape"] ?>' />
		<input type="hidden" name="NomCourse" id="NomCourse" tabindex="10"  size="60"  value= '<?php echo $_GET["NomCourse"] ?>' />
		<input type="hidden" name="Parcours" id="Parcours" tabindex="10"  size="60"  value= '<?php echo $Parcours ?>' />
			<input type="hidden" name="NbrEtape" id="NbrEtape" tabindex="10"  size="60"  value= '<?php echo $_GET["NbrEtape"] ?>' />
	<td> <label for="Depart">Départ :    </label></td>
		<td>
		<select name="Depart" onchange="this.form.submit()" style="width: 300px;">
		<?php
	
		if ($_GET['Depart'] != null)
		{
			echo "<option value=\"".$_GET['Depart']."\">\"".$_GET['Depart']."\"</option>";
		}
     else
     {
        ?>
            <option value="">Sélectionner un départ</option>
            <?php
 
     }
	   foreach ($files1  as $key => $value) 
	   { 
		   if(is_dir($pathfolder .'/'.$value))
		   {
				// Affichage dans la liste des départ dans le menu 
				if (strlen($value) >2 && $value != "info") 
				{
					if ($_GET['Depart'] !== $value)
					{
						echo "<option value=\"".$value."\">\"".$value."\"</option>";
					}
				}
			}
		}
		?>
	
		</select>
		</td>
		</tr>
			<tr style="Height:10px">
		</tr>
	<!--	<input type="submit" value="Afficher">-->
	</form>	
	<?php
	}
	else
	{
	
		// si il y a que un départ ;
		$Depart =$DepartTampon;
	}
}


	
	
/************************************* CLASSEMENTS ********************************/
// Afficher le classement du départ choisi
if ($Parcours!=("") && $Depart!=(""))
{
	// Afficher la liste des départ Dossier dans la course ;
	$pathfolder = 'courses/'.$_GET['NomCourse'].$ANNEE_COURSE.'/'.$Parcours.'/'.$Depart;
	if ($numetape >0 && $numetape <99)
	{
		$pathfolder = $pathfolder   .'/Etape'.$_GET['Etape'];
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
		$pos = strpos($value, 'Classement');
		if ($pos == false)
		{
			$pos = strpos($value, 'classement');
		}
		if ($pos !== false) 
		{
			$nbrFileClassement++;
			$ClassementTampon = $value;	
		}
	}

	// SI il y plus que 1 départ affichage d'un menu pour le choix du départ
	if ($nbrFileClassement> 0)							
	{?>
		<tr>
			<form method="get" action="ResultatV4.php">
			<input type="hidden" name="DateCourse" id="DateCourse" tabindex="10"  size="60"  value= '<?php echo $_GET["DateCourse"] ?>' />
			<input type="hidden" name="Etape" id="Etape" value= '<?php echo $_GET["Etape"] ?>' />
			<input type="hidden" name="NomCourse" id="NomCourse" tabindex="10"  size="60"  value= '<?php echo $_GET["NomCourse"] ?>' />
			<input type="hidden" name="Depart" id="Depart" tabindex="10"  size="60"  value= '<?php echo $Depart ?>' />
			<input type="hidden" name="Parcours" id="Parcours" tabindex="10"  size="60"  value= '<?php echo $Parcours ?>' />
			<input type="hidden" name="NbrEtape" id="NbrEtape" tabindex="10"  size="60"  value= '<?php echo $_GET["NbrEtape"] ?>' />
		
		<td> <label for="Classement">Classements :</label></td>
		
			<td>
			<select name="Classement" onchange="this.form.submit()" style="width: 300px;">
	
		<?php
		// Si classement sélectionné
		if ($_GET['Classement'] != null)
		{
			?>
			
				<?
				// mISE EN FORME DE L'AFFICHAGE DU TITRE DU rESULTATS
				if (strpos($_GET['Classement'], 'Tous les classements')=== false)
				{
					$NomClassmentTamon  = str_replace("Classement", "", $_GET['Classement']);
					$NomClassmentTamon  = str_replace("classement", "", $NomClassmentTamon);
					$NomClassmentTamon  = str_replace("_", "", $NomClassmentTamon);
					$NomClassmentTamon  = str_replace(".csv", "", $NomClassmentTamon);
				}
				else
				{
					$NomClassmentTamon  =$_GET['Classement'];
				}

				echo "<option value=\"".$_GET['Classement']."\">\"".$NomClassmentTamon ."\"</option>";
								
		}
		else // Pas de classement sélectionner
		{
			if ($nbrFileClassement > 1)
			{?>
			<option value="">Sélectionné un classement</option>	
			<?Php
			}	
			else
			{
				$Classement  = "Tous les classements";
			}
		}
		if ($nbrFileClassement > 1 && $_GET['Classement'] != "Tous les classements")
		{
?>
			<option value="Tous les classements">Tous les classements</option>		
<?php	
		}
	   foreach ($files1  as $key => $value) 
	   { 
			// SI LE FICHIER EST DE TYPE CLASSEMENT 
			$pos = strpos($value, 'classement');
		
			if ($pos !== false) 
			{
				if ($value !== $_GET['Classement'])
				{
					// mISE EN FORME DE L'AFFICHAGE DU TITRE DU rESULTATS
					if (strpos($value, 'Tous les classements')=== false)
					{
						$NomClassmentTamon  = str_replace("Classement", "", $value);
						$NomClassmentTamon  = str_replace("classement", "", $NomClassmentTamon);
						$NomClassmentTamon  = str_replace("_", "", $NomClassmentTamon);
						$NomClassmentTamon  = str_replace(".csv", "", $NomClassmentTamon);
					}
					else
					{
						$NomClassmentTamon  =$value;
					}

					if ($value == 'classement.csv')
					{
				
						echo "<option value=\"".$value."\">\"".$NomClassmentTamon ."\"</option>";
					}
					else
					{								
						echo "<option value=\"".$value."\">\"".$NomClassmentTamon."\"</option>";
					}
				}
			}
		}
		?>
		
		</select>
		</td>
		</tr>
		<tr style="Height:10px">
		</tr>
	</form>	
	<?php
	}
	else
	{
		echo "Résultats pas encore publié...";
		// si il y a que un classement ;
		$Classement =$ClassementTampon;
	}
}
?>
</table>
</BR>
<?
	if ( $Classement!= null && $Classement != "")
	{
		?>
		<input type="text" id="InputSearch" onkeyup="valider()" placeholder="Nom recherché..."\>
		<input type="text" id="InputSearchPrenom" onkeyup="valider()" placeholder="Prénom recherché..."\>
		<?php
	}?>
	</br>
	</br>
<div  id="TableauResulat">
<?
/************************************** AFFICHAGE FICHIER CLASSEMENT *****************************************/
if ($Parcours!=("")  && $Depart!=(""))
{
	foreach ($files1  as $key => $value) 
	{

$pos = strpos($value, 'classement_');
	
		if (($value == $_GET['Classement']  || $Classement == "Tous les classements" )&& $pos !== false)
		{   
			
			$pathfolder = 'courses/'.$_GET['NomCourse'].$ANNEE_COURSE.'/'.$Parcours.'/'.$Depart;
			// AFFICHAGE DES RESULTAT PAR ETAPE
			if ($numetape >0 && $numetape <99 )
			{
			
				$pathFile = $pathfolder   .'/Etape'.$_GET['Etape'].'/'. $value;
				
			}
			// Classement General
			elseif ($numetape == 99)
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
						elseif ($data[0] == "Etape"  )
						{
		
							// Si on as un point précedement
							if ( $Point)
							{
								$Point = false;
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
								<tr  style="display :none ;colspan:100%;background-color:lightblue;" id="<?php echo "InfoPosition".$IDPosition  ?>"> <!--  style="visibility: collapse" -->
								<td colspan =<?php echo $NbrColumn; ?>>
										<table class="TableEtapeResultat" ><!--style="visibility: collapse"--> 
											<tr>
												<!-- Header Etape -->
												<th>Nom Etape</th>
												<th>Position</th>
						
												<th>Temps </th>
												<th>Ecart </th>
											</tr>
							<?php
							}
							?>
							<!-- AFFICHAGE DE L ETAPE -->
								<tr><?
									// Valeur Etape 
									for ($c=1; $c < $num; $c++)
									{?>
										<td><?php  echo $data[$c]?> </td><?php
									}?>
								</tr>
							<?
						}
						elseif ($data[0] == "Point"  )
						{
		
							// Création détail Etape Si premiere etape
							if (!$Point) // Si on a fini les point
							{
								$Point = true;
							?>
								<tr  style="colspan:100%" > <!--  style="visibility: collapse" -->
								<td colspan =<?php echo $NbrColumn; ?>>
										<table class="TableEtapeResultat" style="margin-left:50px;" ><!--style="visibility: collapse"--> 
											<tr>
												<!-- Header Etape -->
												<th>Passage</th>
												<th>Nom</th>
												<th>Prenom</th>
												<th>Position</th>
												<th>Temps </th>
												<th>Ecart </th>
											</tr>
							<?php
							}
							?>
							<!-- AFFICHAGE DE L ETAPE -->
								<tr><?
									// Valeur Etape 
									for ($c=1; $c < $num; $c++)
									{?>
										<td><?php  echo $data[$c]?> </td><?php
									}?>
								</tr>
							<?
						}
						elseif ($data[0] == "Header" )
						{
						
							if ($Etape || $Point)
							{
								$Point = false;
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
						elseif ($data[0] == "$"   ||$data[0] == "LF" ) // Fin de tableau
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
					
						elseif ($data[0] == "Position" || $data[0] == "Position2") // Nouvelle ligne position
						{
							if ( $Point)
							{
								$Point = false;
							?>
								</table>
								</td>
								</tr>
	
							<?
							}
							if ( $Etape ) // Si on a fini les point
							{
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
								}
								// si résultat général ou plusieur pour de passage
								if ($data[0] == "Position" )
								{?>
									<td>
									<span class="dot2" id="<?php echo "Icons".$IDPosition  ?>">
										<i  style="  margin:3.2px; margin-left:5px;"  class="fa fa-plus"></i>
									</span>
									<span style=" visibility: collapse;"  class="dot2" id="<?php echo "IconsMinus".$IDPosition  ?>">
										<i  style="  margin:3.2px; margin-left:5px;"  class="fa fa-minus" ></i>
									</span>
									</td>
								<?}?>
							</tr> <!-- fin ligne en position -->
						<?
					
						}
						// première ligne résultat version light
						elseif ($data[2] == "" && $data[4] == "")
						{
							// Si il y a déjà un table sur la page 
							if  ($start_array)
							{
							?>
							</Table>
							</div>
							<?php
							}
							for ($c=0; $c < $num; $c++) 
							{
								?>
								<div class ="TableResult" id =<?php echo  $data[$c] ?>>
								<p>
								<?php
								echo $data[$c];?>
								</p>
								<?php
							}

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
					?> </div><?
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
 <?php include("sponsors.php"); ?> 
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
	
	
		if (document.getElementById("InfoPosition"+id).style.display  == "none")
		{
		
			document.getElementById("IconsMinus"+id).style.visibility = "visible" ;
		document.getElementById("Icons"+id).style.visibility = "collapse" ;

			document.getElementById("InfoPosition"+id).style.display = null;
		}
		else
		{
			document.getElementById("IconsMinus"+id).style.visibility = "collapse" ;
		document.getElementById("Icons"+id).style.visibility = "visible" ;

		document.getElementById("InfoPosition"+id).style.display = "none" ;
			
	
		}
	event.stopPropagation(); 
		
    }

</script>

</html>
