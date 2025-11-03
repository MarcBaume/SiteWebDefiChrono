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


<?
// Establishing Connection with Server by passing server_name, user_id and password as a parameter
	$con = mysqli_connect('dxvv.myd.infomaniak.com', 'dxvv_christopheJ', 'er3z4aet1234');
	if (!$con)
	{
		die('Could not connect: ' . mysql_error());
	}
	// Selecting Database
	mysqli_select_db($con ,'dxvv_jurachrono' );
	
	// Recolte des information transmise par l'application WPF
	$NomCourse =   $_GET["NomCourse"];
	$Etape =  $_GET["NbrEtape"];
	
	$Parcours =  $_GET["Parcours"];
	$Depart =  $_GET["Depart"];
	//$pathfolder = 'courses/'.$_GET['NomCourse'].'/'.$Parcours.'/'.$Depart.'/Etape'.$Etape;
	$pathfolder = 'FilesTemp';
	if (is_dir  (  $pathfolder ))
	{
		// Supression de toutes les données de cette course dans la base de donnée$
		
		$sql = 'DELETE FROM Resultat WHERE Course =\''.$_GET['NomCourse'].'\'AND Depart = \''.$_GET["Depart"].'\'AND Etape = \''.$_GET["NbrEtape"].'\'';
		try
		{
			$result = mysqli_query($con,$sql);
			if ($result)
			{
				echo "Donnée supprimé" . $sql;
			}
			else
			{
				echo "Erreur supression" . $sql ;					
			}
		}
		catch(Exception $e)
		{
			die('Erreur : '.$e->getMessage());
		}
			
		// Ajout des Données de résultat
		// Création de la liste de toutes les Dossier = Depart 
		$files1 = scandir($pathfolder);
		// Lecture de chaques dossier Pacours Exemple Adultes / Enfants 
		foreach ($files1  as $key => $nameFile) 
		{ 
			$pathFile = $pathfolder."/".$nameFile;
			if (file_exists($pathFile)) 
			{
				if (($handle = fopen( $pathFile, "r")) !== FALSE) 
				{
					$xResultatWithPOintdePassage = false;
					echo " title file :" . $nameFile."<br/>";		
					$TypeClassement1 =str_replace("classement_", "",$nameFile);
					echo "supp title classement_ :" . $TypeClassement1 ."<br/>";;		
					$TypeClassement =str_replace(".csv", "",$TypeClassement1);
					echo "Ajouts données :" . $TypeClassement ."<br/>";;		
					while (($data = fgetcsv($handle, 1000, ";")) !== FALSE) 
					{
						
	 					// Insertion dans la base de donnée résultats AVEC BOINT DE PASSAGE
						if ($data[0] == 'Header')
						{
							$xResultatWithPOintdePassage = true;
						}
							
							if ($xResultatWithPOintdePassage )
							{
								if (strlen($data[10]) > 0 && ! strstr($data[10] , 'Ecart'))
								{
									$TypeClassement =str_replace("classement_", "",$value);
									$TypeClassement =str_replace(".csv", "",$TypeClassement);
								}
								if (strlen($data[3]) > 0 && $data[0]=='Position')
								{
									// Insertion dans la base de donnée résultats avec point de passage
									$sql = 'INSERT INTO Resultat (`Nom`, `Prenom`,`Annee`,`Temps`,`Place`,`Ecart`,`Type`,`Course`,`Parcours`,`Depart`,`Etape`,`Lieu`,`Distance`,`Denivele`)
									VALUES
									("'.$data[3].'", 
									"'.$data[4].'",
									"'.$data[6].'",
									"'.$data[10].'",
									"'.$data[1].'",
									"'.$data[11].'",
									"'.$TypeClassement.'",
									"'.$_GET['NomCourse'].'",
									"'.$Parcours.'",
									"'.$Depart.'",
									"'.$Etape.'",
									"'.$_GET["Lieu"].'",
									"'.$_GET["Distance"].'",
									"'.$_GET["Denivele"].'");';
											echo "no" . $sql;

									try
									{
					
										$result = mysqli_query($con,$sql);
										if ($result)
										{
											echo "no" . $value;
										}
										else
										{
																		
										}
									}
									catch(Exception $e)
									{
										die('Erreur : '.$e->getMessage());
									}
								}
							}
							else
							{
								if (strlen($data[2]) >0 )
								{
							// Insertion dans la base de donnée résultats sans point de passage
								$sql = 'INSERT INTO Resultat (`Nom`, `Prenom`,`Annee`,`Temps`,`Place`,`Ecart`,`Type`,`Course`,`Parcours`,`Depart`,`Etape`,`Lieu`,`Distance`,`Denivele`)
								VALUES
								("'.$data[2].'", 
								"'.$data[3].'",
								"'.$data[5].'",
								"'.$data[9].'",
								"'.$data[0].'",
								"'.$data[10].'",
								"'.$TypeClassement.'",
								"'.$_GET['NomCourse'].'",
								"'.$Parcours.'",
								"'.$Depart.'",
								"'.$Etape.'",
								"'.$_GET["Lieu"].'",
								"'.$_GET["Distance"].'",
								"'.$_GET["Denivele"].'");';
								try
								{
				
									$result = mysqli_query($con,$sql);
									if ($result)
									{
										echo "INSERT OK " . $sql ."<br/>";
									}
									else
									{
																	
									}
								}
								catch(Exception $e)
								{
									die('Erreur : '.$e->getMessage())  ."<br/>";
								}
							}
						}
							
					}
					unlink($pathFile);
				}
			}
		}
	}
	else
	
	{
		if (is_dir  (  'courses/'.$_GET['NomCourse']))
		{

			if (is_dir  (  'courses/'.$_GET['NomCourse'].'/'.$Parcours))
			{
				echo "Dossier n'existe pas :;; ";
			}
			else
			{
				echo "Dossier n'existe pas : /".$Parcours."/" ;
			}
		}
		else
		{

			echo "Dossier n'existe pas : ".$_GET['NomCourse'];
		}

	}
/*	
		// Afficher la liste des fichier dans le dossier résultat
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
		if ($pos !== false) 
		{
			
			$nbrFileClassement++;
			$ClassementTampon = $value;	
		}
	}
	
<?*/
/************************************** AFFICHAGE FICHIER CLASSEMENT *****************************************/

/*
			$pathFile = $pathfolder .'/Etape1/'.$value;
			

			
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

						if ($data[0] == "Etape"   )
						{
						
				
							// Création détail Etape Si premiere etape
							if (!$Etape) // Si on a fini les point
							{
						
								$Etape = true;
							?>
								<tr  style="visibility: collapse" id="<?php echo "InfoPosition".$IDPosition  ?>"> <!--  style="visibility: collapse" -->
								<td colspan =<?php echo $NbrColumn; ?>>
										<table class="TableEtapeResultat" ><!--style="visibility: collapse"--> 
											<tr>
												<!-- Header Etape -->
												<th>Nom Etape</th>
												<th>Scratch</th>
												<th>Catégorie</th>
												<th>Sexe</th>
												<th>Temps </th>
												
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
					else	if ($data[0] == "Header" )
						{
						
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
					else	if ($data[0] == "$"   ||$data[0] == "LF" ) // Fin de tableau
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
								 <span style=" visibility: collapse;"  class="dot2" id="<?php echo "IconsMinus".$IDPosition  ?>">
									  <i  style="  margin:3.2px; margin-left:5px;"  class="fa fa-minus" ></i>
								</span>
								</td>
								
							</tr> <!-- fin ligne en position -->
						<?
					
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
	
	
		if (	document.getElementById("InfoPosition"+id).style.visibility == "visible")
		{
		
		document.getElementById("IconsMinus"+id).style.visibility = "collapse" ;
		document.getElementById("Icons"+id).style.visibility = "visible" ;
		document.getElementById("InfoPosition"+id).style.visibility = "collapse" ;
		}
		else
		{
			
			document.getElementById("IconsMinus"+id).style.visibility = "visible" ;
		document.getElementById("Icons"+id).style.visibility = "collapse" ;
			document.getElementById("InfoPosition"+id).style.visibility = "visible" ;
		}
	event.stopPropagation(); 
		
    }

</script>
*/?>
</html>
