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
$Discipline = $_GET['Discipline'];
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

if ($nbrFile> 1)
{
?>
	<form method="get" action="resultat.php">
	<input type="hidden" name="date_course" id="date_course" tabindex="10"  size="60"  value= '<?php echo $_GET["date_course"] ?>' />
	<input type="hidden" name="etape" id="etape" value= '<?php echo $_GET["etape"] ?>' />
	<input type="hidden" name="nom_course" id="nom_course" tabindex="10"  size="60"  value= '<?php echo $_GET["nom_course"] ?>' />
	<p> <label for="Parcours">Parcours :    </label><select name="Parcours">
	<?php
	if ($_GET['Parcours'] != null)
	{
			   echo "<option value=\"".$_GET['Parcours']."\">\"".$_GET['Parcours']."\"</option>";
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
	<input type="submit" value="Afficher">
</form>
	
<?php
}
else
{
	// si il y a que une course ;
	$Parcours =$ParcoursTampon;
}
// Afficher le classement du départ choisi
if ($Parcours!=(""))
{
	// Afficher la liste des départ Dossier dans la course ;
	$pathfolder = 'courses/'.$_GET['nom_course'].$ANNEE_COURSE.'/'.$Parcours;
	// Création de la liste de toutes les Parcours
	$files1 = scandir($pathfolder);
	// COUNT nombre départ 
	foreach ($files1  as $key => $value) 
	{ 
	   if(is_dir($pathfolder .'/'.$value))
	   {
			// Affichage dans la liste des départ dans le menu 
			if (strlen($value) >2&& $value != "info") 
			{
			$nbrDepart++;
			}
		}
	}
	// affichage des départ en forme de tableau
	foreach ($files1  as $key => $value) 
	{ 
	   if(is_dir($pathfolder .'/'.$value))
	   {
			// Affichage dans la liste des départ dans le menu 
			if (strlen($value) >2 && $value != "info") 
			{
				$pathFile = 'courses/'.$_GET['nom_course'].$ANNEE_COURSE.'/'.$Parcours.'/'.$value;
				//if   ($val ["JuraDefi"]== 1)
				//{
				if ($numetape >0 && $numetape <99)
				{
					$pathFileDisc = $pathFile   .'/Etape'.$_GET['etape'];
			//		$test = 'classement.csv';
				}
				elseif ($numetape == 99)
				{
					$pathFileDisc = $pathFile  ;
				}
				else
				{
					$pathFileDisc = $pathFile   .'/Etape1';
				}
				// scan de chaque fichier de résultats
				$filesDisc = scandir($pathFileDisc);
				// Comptage Nombre de fichier de classement 
				foreach ($filesDisc  as $key => $value) 
				{ 
					
					if(!is_dir($pathFile .'/'.$value))
					{
					
						// Si le fichier est de nom classement 
						$pos = strpos($value, 'classement');
						if ($pos !== false) 
						{

							// Si il y a plus de résultat affichage du menu déroulant
							$Affmenu = $Affmenu + 1;
						}
					}
				}

				if ($Affmenu > 1)
				{
					foreach ($filesDisc  as $key => $value) 
					{ 
						if(!is_dir($pathFile .'/'.$value))
						{
							// Si le fichier est de nom classement 
							$pos = strpos($value, 'classement');
							if ($pos !== false) 
							{
								if($NbrDiscfind == 0)
								{?>
									<form method="get" action="resultat.php">
									<input type="hidden" name="date_course" id="date_course" tabindex="10"  size="60"  value= '<?php echo $_GET["date_course"] ?>' />
									<input type="hidden" name="etape" id="etape" value= '<?php echo $_GET["etape"] ?>' />
									<input type="hidden" name="nom_course" id="nom_course" tabindex="10"  size="60"  value= '<?php echo $_GET["nom_course"] ?>' />
									<input type="hidden" name="Parcours" id="Parcours" tabindex="10"  size="60"  value= '<?php echo $_GET['Parcours'] ?>' />
									<p> <label for="Discipline">Classements :    </label><select name="Discipline">
									<?php
									if ($_GET['Discipline'] != null)
									{
										echo "<option value=\"".$_GET['Discipline']."\">\"".ltrim(rtrim( $_GET['Discipline'], '.csv'),'classement_')."\"</option>";
									}
										//			echo "<option value=\"".$test."\">\"".rtrim($value, '.csv')."\"</option>";
								}
								$NbrDiscfind = $NbrDiscfind + 1 ;
								if ($value !== $_GET['Discipline'])
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
					}?>
					 </p>
					</select>
					<input type="submit" value="Afficher">	
					</form>
					<?php
				}

				//}
				
				// AFFICHAGE DES RESULTAT PAR ETAPE
				if ($numetape >0 && $numetape <99 )
				{
					if ($Discipline == "")
					{
						$pathFile = $pathFile   .'/Etape'.$_GET['etape'].'/classement.csv';
					}
					else
					{
						$pathFile = $pathFile   .'/Etape'.$_GET['etape'].'/'.$Discipline;
					}
				}
				elseif ($numetape == 99)
				{
					if ($Discipline == "" )//&& $Affmenu  == 1)
					{
						$pathFile = $pathFile. '/classement_general.csv';
					}
					else
					{
						$pathFile = $pathFile  .'/'.$Discipline;
					}
					
				}
				else
				{
					if ($Discipline == "")
					{
					$pathFile = $pathFile .'/Etape1/classement.csv';
					}
					else
					{
					$pathFile = $pathFile .'/Etape1/'.$Discipline;
					}
				}

				if ( $nbrDepart > 1)
				{
					?>
					<!--- affichage du nom du départ
					<Fieldset > <?php //echo $value ?> </fieldset></br>----> <?php
				}
				if (file_exists($pathFile)) 
				{
					if (($handle = fopen($pathFile, "r")) !== FALSE) 
					{
						while (($data = fgetcsv($handle, 1000, ";")) !== FALSE) {
        $num = count($data);
   //     echo "<p> $num champs à la ligne $row: <br /></p>\n";
   //  . "<br />\n";
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
        for ($c=0; $c < $num; $c++) {
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
        for ($c=0; $c < $num; $c++) {
	
			if ($data[$c] == "pos"   ||$data[$c] == "Rang" )
			{
			$start_array = true;
			$en_tete = true;?>
			<Table>	
			<?php
			}
	
			if($en_tete)
			{
				if ($val ["ListeDepartGacond"]== 1)
				{
					if ($c != 8 && $c != 9 && $c != 10 && $c != 7)
					{
					?>
					<th><?php    echo $data[$c]?> </th><?php
					}
				}
				elseif  ($val ["JuraDefi"]== 1)
				{
				?>
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
					elseif ($numetape != 99 && $c != 4 && $c != 5 && $c != 11)
					{
					?>
					<th><?php    echo $data[$c]?> </th><?php
					}
				}
			}
			else
			{
				if ($val ["ListeDepartGacond"]== 1)
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
					elseif ($numetape != 99 && $c != 4 && $c != 5 && $c != 11)
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
	?> <i> Les résultats ne sont pas encore publiés pour ce départ</i>  </br></br>
	<?php
	}
	}
	}
	}
	
}

?>
 <?php include("sponsors.php"); ?> 
</div>

</div>
</body>
</html>
