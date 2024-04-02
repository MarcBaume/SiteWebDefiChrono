<!DOCTYPE html>
<html>
<head>
	<meta property="og:description" content="chronométrage, chrono, jura, franches-montagnes, Jura défi, course à pied, Sport, Jura défi chrono" />  
	<title>Défi Chrono</title>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, maximum-scale=1.0, user-scalable=yes">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css">
	<link rel="stylesheet" title="defaut" media="screen" href="styleV2.css" type="text/css"/>
<!--	<link rel="stylesheet" type="text/css" media="screen and (max-width: 480px)" href="style-mobilV2.css" /> -->
</head>

    <body>

<?php
  include("Header.php"); 
  ?>
<div id="corps">

	<?php include("HeaderInfo.php"); ?>
	<h3>Résultats  <?php  echo $NOM_COURSE. ' ' . $ANNEE_COURSE ?></h3>
	<input type="text" id="InputSearch" onkeyup="valider()" placeholder="Personne recherché..."\>
	
<Table>

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
			$nbrFile++;
			$ParcoursTampon = $value;
		}		
	}
}
// SI il y plus que 1 départ affichage d'un menu pour le choix du départ
if ($nbrFile> 1)
{?>
<tr>
	<form method="get" action="ResultatV2.php">
	<input type="hidden" name="DateCourse" id="DateCourse" tabindex="10"  size="60"  value= '<?php echo $_GET["DateCourse"] ?>' />
	<input type="hidden" name="Etape" id="Etape" value= '<?php echo $_GET["Etape"] ?>' />
	<input type="hidden" name="NomCourse" id="NomCourse" tabindex="10"  size="60"  value= '<?php echo $_GET["NomCourse"] ?>' />
	<td> <label for="Parcours">Parcours :    </label></td>
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
		<form method="get" action="ResultatV2.php">
		<input type="hidden" name="DateCourse" id="date_course" tabindex="10"  size="60"  value= '<?php echo $_GET["DateCourse"] ?>' />
		<input type="hidden" name="Etape" id="etape" value= '<?php echo $_GET["Etape"] ?>' />
		<input type="hidden" name="NomCourse" id="NomCourse" tabindex="10"  size="60"  value= '<?php echo $_GET["NomCourse"] ?>' />
		<input type="hidden" name="Parcours" id="Parcours" tabindex="10"  size="60"  value= '<?php echo $Parcours ?>' />
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
?>

<?
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
		<tr>
			<form method="get" action="ResultatV2.php">
			<input type="hidden" name="DateCourse" id="DateCourse" tabindex="10"  size="60"  value= '<?php echo $_GET["DateCourse"] ?>' />
			<input type="hidden" name="Etape" id="Etape" value= '<?php echo $_GET["Etape"] ?>' />
			<input type="hidden" name="NomCourse" id="NomCourse" tabindex="10"  size="60"  value= '<?php echo $_GET["NomCourse"] ?>' />
			<input type="hidden" name="Depart" id="Depart" tabindex="10"  size="60"  value= '<?php echo $Depart ?>' />
			<input type="hidden" name="Parcours" id="Parcours" tabindex="10"  size="60"  value= '<?php echo $Parcours ?>' />
			<td> <label for="Classement">Classements :</label></td>
			<td>
			<select name="Classement" onchange="this.form.submit()" style="width: 300px;">
	
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
		// si il y a que un classement ;
		$Classement =$ClassementTampon;
	}
}
?>
</table>
<div  id="TableauResulat">
<?
/************************************** AFFICHAGE FICHIER CLASSEMENT *****************************************/
if ($Parcours!=("") && $Depart!=("") && $Classement !=(""))
{
	$pathfolder = 'courses/'.$_GET['NomCourse'].$ANNEE_COURSE.'/'.$Parcours.'/'.$Depart;
	// AFFICHAGE DES RESULTAT PAR ETAPE
	if ($numetape >0 && $numetape <99 )
	{
		if ($Classement == "")
		{
			$pathFile = $pathfolder   .'/Etape'.$_GET['Etape'].'/classement.csv';
		}
		else
		{
			$pathFile = $pathfolder   .'/Etape'.$_GET['Etape'].'/'.$Classement;
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

	<script type="text/javascript">
function valider()
{
	var table = document.getElementsByTagName("table");
	console.log(table);
	input = document.getElementById("InputSearch");
	filter = input.value.toUpperCase();
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
		
			for (y = 0; y < td.length; y++) 
			{
				if ( td[y].innerHTML.toUpperCase().indexOf(filter)>-1)
				{
					tr[j].style.display = "";
					NbrTr++;
					break;
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

</script>

</html>
