
<!DOCTYPE html>
<html>
	<head>
	   <meta property="og:description" content="chronométrage, chrono, jura, franches-montagnes, Jura défi, course à pied, Sport, Jura défi chrono" />  
	   <title>Jura Défi Chrono</title>
		<meta charset="utf-8">
	    <link rel="stylesheet" title="defaut" media="screen" href="../style.css" type="text/css"/>
		<link rel="stylesheet" type="text/css" media="screen and (max-width: 480px)" href="../style-mobil.css" /> 
	</head>
<body>
	<?php include("../onglets.php"); ?>
	<div id="corps">
	<?php include("../menu_vertical.php"); ?>
	<h3>
		Résultat <?php  echo $NOM_COURSE. ' ' . $ANNEE_COURSE ?>
	</h3>
    </br> 

	<div  id="TableauResulat">
		<form method="post" action="ReadFileResultat.php" enctype= "multipart/form-data">
		<input type="hidden" name="date_course" id="date_course" tabindex="10"  size="60"  value= '<?php echo $_GET["date_course"] ?>' />
		<input type="hidden" name="etape" id="etape" value= '<?php echo $_GET["etape"] ?>' />
		<input type="hidden" name="nom_course" id="nom_course" tabindex="10"  size="60"  value= '<?php echo $_GET["nom_course"] ?>' />
		<label for="FileResult">File Result:</label> :<input type="file"  name='FileResult' />
		<input TYPE="image" src="images/mod.JPG"title="modifier" />
		 <?php
		$row = 1;
		$start_array = false;
		$numetape = intval($_GET['etape']);
		// Afficher la liste des départ Dossier dans la course ;
		$pathfolder = '../courses/'.$_GET['nom_course'].$ANNEE_COURSE;
		// Création de la liste de toutes les Parcours
		$files1 = scandir($pathfolder);
		$Parcours = $_GET['Parcours'];
	   foreach ($files1  as $key => $value) 
	   { 
		   if(is_dir($pathfolder .'/'.$value))
		   {
				// Affichage dans la liste des départ dans le menu 
				if (strlen($value) >2 && $value != "info") 
				{
				$nbrFile++;
				}
				
			}
				
		}

	if ($nbrFile> 0)
	{
		?>
			<p> <label for="Parcours">Parcours :    </label><select name="Parcours">
			<?php if (strlen($_GET["Parcours"]) ==0)
			{ ?>
				<option value=''>Tous  Les Parcours</option>
			<?php
			}
			else
			{?>
				<option value='<?php echo $_GET["Parcours"] ?>'><?php echo $_GET["Parcours"] ?></option>
				<option value=''>Tous  Les Parcours</option>
			<?php
			}
		   foreach ($files1  as $key => $value) 
		   { 
			   if(is_dir($pathfolder .'/'.$value))
			   {
					// Affichage dans la liste des départ dans le menu 
					if (strlen($value) >2 && $value != "info") 
					{
				   echo "<option value=\"".$value."\">\"".$value."\"</option>";
				   }
				}
			}
			?>
			 </p>
			</select>
			<input type="submit" value="trier">
	</form>
	<?php
	
    // On récupère tout le contenu de la table camp
	if ($_GET['Parcours']==(""))
	{
     $sql = 'SELECT * FROM Resultats WHERE course=\''.$NOM_COURSE. $ANNEE_COURSE .'\'ORDER BY parcours ASC,  NomDepart ASC,nom ASC';
	}
	else
	{

	 $sql = 'SELECT * FROM classement  WHERE course=\''.$NOM_COURSE. $ANNEE_COURSE. '\'AND parcours = \''.$_GET["Parcours"]. '\'ORDER  BY NomDepart ASC,nom ASC';
	}
	 
	 $result = mysqli_query($con,$sql);
 
	 $c=0;
	  // On affiche chaque entrée une à une
  
		if ($result && mysqli_num_rows($result) > 0) 
		{
			// output data of each row
			while($donnees = mysqli_fetch_assoc($result)) 
			{
				$c=$c+1;
				// ******************* CREATION D'un tableau différent a chaque départ 
				if ( $donnees['NomDepart']  != $NomDepartTampon)
				{
					if ($NomDepartTampon!=(""))
					{
					?></table> <?php
					}
					$NomDepartTampon =  $donnees['NomDepart'];
					?>
					<h2> <?php echo $donnees['NomDepart'] ?> </h2>
					<table> 
					<!-- Détection si le départ est un relais -->	
					<?php if (strlen($donnees['NomEquipe']) > 1)
					{
			 
						$relais = 1 ?>
						<tr>
						<th width="5%"> N°</th>
						<th width="15%"> Nom équipe</th>

						<th width="15%"> Coureur 1 </th>
						<?php if (strlen($donnees['PrenomDisc2']) > 1)
						{
						$relais = 2 ?>
						<th width="15%"> Coureur 2</th>	
						<?php
						}?>
						<?php if (strlen($donnees['PrenomDisc3']) > 1)
						{
						$relais = 3 ?>
						<th width="15%"> Coureur 3</th>	
						<?php
						}?>
						<?php if (strlen($donnees['PrenomDisc4']) > 1)
						{
						$relais = 4 ?>
						<th width="15%"> Coureur 4</th>	
						<?php
						}?>
						<?php if (strlen($donnees['PrenomDisc5']) > 1)
						{
						$relais = 5 ?>
						<th width="15%"> Coureur 5</th>	
						<?php
						}?>
						<?php if (strlen($donnees['PrenomDisc6']) > 1)
						{
						$relais = 6 ?>
						<th width="15%"> Coureur 6</th>	
						<?php
						}?>
						</tr>
					<?php 
					}
					else
					{
						$relais = 0?>
						<tr>
						<th width="5%"> Pos</th>
						<th width="5%"> N°</th>
						<th width="15%"> Nom</th>
						<th width="15%"> Prénom</th>
						<th width="15%"> Localité</th>		
						<th width="5%"> Année</th>
						<th width="5%"> Sexe</th>
						<th width="15%"> Club</th>
						<th width="5%"> Cat.</th>
						<th width="5%"> Temps</th>
						<th width="5%"> Ecart</th>
						</tr>
					}
				<?php
					}
				}
				else
				{ // Affichage des valeurs de chaque cellule
					if ($relais >0)
					{
						?>
						<tr>
						<td  > <?php echo $c; ?></td>
						<td > <?php echo $donnees['NomEquipe']; ?></td>
						<td><?php echo $donnees['Nom'] . ' ' .$donnees['Prenom'] ; ?>    </td>
						<?php if ($relais >1)
						{?>
						<td><?php echo $donnees['NomDisc2'] . ' ' .$donnees['PrenomDisc2']; ?>  </td>
						<?php 
						}
						if ($relais >2)
						{?>
						
						<td > <?php echo $donnees['NomDisc3'] . ' ' .$donnees['PrenomDisc3']; ?> </td>
						<?php 
						}
						if ($relais >3)
						{?>
						 <td > <?php echo $donnees['NomDisc4'] . ' ' .$donnees['PrenomDisc4']; ?> </td>
						 <?php 
						}
						if ($relais >4)
						{
						 ?>
						 <td > <?php echo $donnees['NomDisc5'] . ' ' .$donnees['PrenomDisc5']; ?> </td>
						 <?php 
						}
						if ($relais >5)
						{
						 ?>
						 <td > <?php echo $donnees['NomDisc6'] . ' ' .$donnees['PrenomDisc6']; ?> </td>
						 <?php
						}?>
						</tr>			
					<?php
					}
					else
					{?> <!-- aFFICHAGE SI CE N'EST PAS UN RELAIS -->
						<tr>						
							<td> <?php echo  $donnees['PosCourse']; ?></td>
							<td> <?php echo $donnees['Dossard']; ?></td>
							<td> <?php echo $donnees['Nom']; ?></td>
							<td><?php echo $donnees['Prenom']; ?>    </td>
							<td><?php echo $donnees['localite']; ?>  </td>
							<td> <?php echo $donnees['DateNaissance']; ?> </td>
							<td> <?php echo $donnees['sexe']; ?> </td>
							<td> <?php echo $donnees['club']; ?> </td>
							<td> <?php echo $donnees['NumCategorie']; ?> </td>
							<td> <?php echo $donnees['TempsCourse']; ?> </td>
						</tr>
					<?php
					}?>
			

				<?php
				
				}
			}
			?>
			</table>
			<?php
		}
		else
		{
			?><i> Encore aucune résultat pour cettte course</i>  </br></br>
			<?php
		}
	}
	else
	{
		?><i>Pas de parcours pour cette course</i>  </br></br>
			<?php
	}
	?>
		</div>
		 <?php include("../sponsors.php"); ?> 
		</div>
    </body>            
</html>