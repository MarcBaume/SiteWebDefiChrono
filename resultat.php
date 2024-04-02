<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="fr" >
   <head>
       <title>Jura défi chrono</title>
       <meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
	     <meta name="viewport" content="width=device-width, maximum-scale=1.0, user-scalable=yes">
	       <link rel="stylesheet" media="screen" type="text/css" title="style" href="style.css" />

     <link rel="stylesheet" title="defaut" media="screen" href="style.css" type="text/css"/>
     <link rel="stylesheet" type="text/css" media="screen and (max-width: 480px)" href="style-mobil.css" />
 </head>
	<script type="text/javascript">
function valider()
{
document.formulaire.submit();
}

</script>
   <body>
<?php include("onglets.php"); ?>

<div id="corps">
	<?php include("menu_vertical.php"); ?>
	<h3>Résultats  <?php  echo $NOM_COURSE. ' ' . $ANNEE_COURSE ?></h3>
   
<div  id="TableauResulat">
 <?php
 $row = 1;
$start_array = false;
$numetape = intval($_GET['etape']);
// Afficher la liste des départ Dossier dans la course ;
$pathfolder = 'courses/'.$_GET['nom_course'].$ANNEE_COURSE;
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
			$nbrFile++;
			$ParcoursTampon = $value;
		}		
	}
}
// SI il y plus que 1 départ affichage d'un menu pour le choix du départ
if ($nbrFile> 1)
{?>
	<form method="get" action="resultat.php">
	<input type="hidden" name="date_course" id="date_course" tabindex="10"  size="60"  value= '<?php echo $_GET["date_course"] ?>' />
	<input type="hidden" name="etape" id="etape" value= '<?php echo $_GET["etape"] ?>' />
	<input type="hidden" name="nom_course" id="nom_course" tabindex="10"  size="60"  value= '<?php echo $_GET["nom_course"] ?>' />
	<p> <label for="Parcours">Parcours :    </label><select name="Parcours" onchange="this.form.submit()" style="width: 400px;">
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
	</p>
	</select>
	<!--<input type="submit" value="Afficher">-->
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
	$pathfolder = 'courses/'.$_GET['nom_course'].$ANNEE_COURSE.'/'.$Parcours;
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
		<form method="get" action="resultat.php">
		<input type="hidden" name="date_course" id="date_course" tabindex="10"  size="60"  value= '<?php echo $_GET["date_course"] ?>' />
		<input type="hidden" name="etape" id="etape" value= '<?php echo $_GET["etape"] ?>' />
		<input type="hidden" name="nom_course" id="nom_course" tabindex="10"  size="60"  value= '<?php echo $_GET["nom_course"] ?>' />
		<input type="hidden" name="Parcours" id="Parcours" tabindex="10"  size="60"  value= '<?php echo $Parcours ?>' />
		<p> <label for="Depart">Départ :    </label><select name="Depart" onchange="this.form.submit()" style="width: 400px;">
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
		</p>
		</select>
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
	$pathfolder = 'courses/'.$_GET['nom_course'].$ANNEE_COURSE.'/'.$Parcours.'/'.$Depart;
	if ($numetape >0 && $numetape <99)
	{
		$pathfolder = $pathfolder   .'/Etape'.$_GET['etape'];
	}
	elseif ($numetape == 99)
	{
		$pathfolder = $pathfolder  ;
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
		if ($pos !== false) 
		{
			$nbrFileClassement++;
			$ClassementTampon = $value;	
		}
	}
	// SI il y plus que 1 départ affichage d'un menu pour le choix du départ
	if ($nbrFileClassement> 1)
	{?>
			<form method="get" action="resultat.php">
			<input type="hidden" name="date_course" id="date_course" tabindex="10"  size="60"  value= '<?php echo $_GET["date_course"] ?>' />
			<input type="hidden" name="etape" id="etape" value= '<?php echo $_GET["etape"] ?>' />
			<input type="hidden" name="nom_course" id="nom_course" tabindex="10"  size="60"  value= '<?php echo $_GET["nom_course"] ?>' />
			<input type="hidden" name="Depart" id="Depart" tabindex="10"  size="60"  value= '<?php echo $Depart ?>' />
			<input type="hidden" name="Parcours" id="Parcours" tabindex="10"  size="60"  value= '<?php echo $Parcours ?>' />
			<p> <label for="Classement">Classements :</label><select name="Classement" onchange="this.form.submit()" style="width: 400px;">
	
		<?php
		if ($_GET['Classement'] != null)
		{
			echo "<option value=\"".$_GET['Classement']."\">\"".ltrim(rtrim( $_GET['Classement'], '.csv'),'classement_')."\"</option>";
								
		}
		else
		{?>
					<option value="">Sélectionner un classement</option>
<?php	}
	   foreach ($files1  as $key => $value) 
	   { 
			// SI LE FICHIER EST DE TYPE CLASSEMENT 
			$pos = strpos($value, 'classement');
			if ($pos !== false) 
			{
				if ($value !== $_GET['Classement'])
				{
					if ($value == 'classement.csv')
					{
						echo "<option value=\"".$value."\">\"".rtrim($value, '.csv')."\"</option>";
					}
					else
					{								
						echo "<option value=\"".$value."\">\"".ltrim(rtrim($value, '.csv'),'classement_')."\"</option>";
					}
				}
			}
		}
		?>
		</p>
		</select>

	</form>	
	<?php
	}
	else
	{
		// si il y a que un classement ;
		$Classement =$ClassementTampon;
	}
}
/************************************** AFFICHAGE FICHIER CLASSEMENT *****************************************/
if ($Parcours!=("") && $Depart!=("") && $Classement !=(""))
{
	$pathfolder = 'courses/'.$_GET['nom_course'].$ANNEE_COURSE.'/'.$Parcours.'/'.$Depart;
	// AFFICHAGE DES RESULTAT PAR ETAPE
	if ($numetape >0 && $numetape <99 )
	{
		if ($Classement == "")
		{
			$pathFile = $pathfolder   .'/Etape'.$_GET['etape'].'/classement.csv';
		}
		else
		{
			$pathFile = $pathfolder   .'/Etape'.$_GET['etape'].'/'.$Classement;
		}
	}
	elseif ($numetape == 99)
	{
		if ($Classement == "" )//&& $Affmenu  == 1)
		{
			$pathFile = $pathfolder. '/classement_general.csv';
		}
		else
		{
			$pathFile = $pathfolder  .'/'.$Classement;
		}
		
	}
	else
	{
		if ($Classement == "")
		{
		$pathFile = $pathfolder .'/Etape1/classement.csv';
		}
		else
		{
		$pathFile = $pathfolder .'/Etape1/'.$Classement;
		}
	}
	if (file_exists($pathFile)) 
	{
		if (($handle = fopen($pathFile, "r")) !== FALSE) 
		{
			while (($data = fgetcsv($handle, 1000, ";")) !== FALSE) 
			{
				$num = count($data);
				$row++; 
				// première ligne 
				if ($data[2] == "" && $data[4] == "")
				{
					// Si il y a déjà un table sur la page 
					if  ($start_array)
					{
					?>
					</Table>
					<?php
					}
					for ($c=0; $c < $num; $c++) 
					{
						?>
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
			fclose($handle);
		}
	}
	else
	{
		// SI AUCUN  RESULTAT PUBLIER AFFICHAGE DE CE MESSAGE
		if ($Affmenu == 0)
		{
		?> <i> Les résultats ne sont pas encore publiés pour ce départ</i>  </br></br>
		<?php
		}
	}
}

?>
 <?php include("sponsors.php"); ?> 
</div>

</div>
</body>
</html>
