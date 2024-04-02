<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="fr" lang="fr">
    <head>
        <title>liste</title>
        <meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
    <link rel="stylesheet" media="screen" type="text/css" title="Design" href="../style.css" />

	</head>
	<script type="text/javascript">
	function checkForm(f) {
	f.submit();
}
	</script>
    <body >
	<?php include("../onglets.php"); ?>
	<?php include("../menu_horizontal.php"); ?>
<div id="corps">

   <Fieldset>
<?php echo 'Course : ' .$_POST['nom_course'] ?>
   </Fieldset>
   
<fieldset>
<legend> les Parcours </legend>

<!--- affiche les départ ---->

<?
 $date = date_parse($_POST['date_course']);
$annee = $date['year'];
$pathfolder = '../courses/'.$_POST['nom_course'].$annee ;
// Création de la liste de toutes les fichiers
//$files1 = scandir($pathfolder);
$files1 = scandir($pathfolder);

   foreach ($files1  as $key => $value) 
   { 
	   if(is_dir($pathfolder .'/'.$value))
	   {
			// Affichage dans la liste des classements 
			if (strlen($value) >2 && $value !="info" ) 
			{
			
			$filesParcours = scandir($pathfolder.'/'.$value);

				foreach ($filesParcours  as $key => $valueParcours) 
				{ 
					if (strlen($valueParcours) >2 && $valueParcours !="info" ) 
					{	?>
						<?php 	echo $valueParcours ?>  </br>
						<form method="post" action="modification_catégorie.php" name = '<?php echo "ModifCat" ?>' >												
							<input type="hidden" name="login" id="login" tabindex="10"  size="60"  value= '<?php echo $_POST['login'] ?>' />
							<input type="hidden" name="date_course" id="date_course" tabindex="10"  size="60"  value= '<?php echo $_POST["date_course"] ?>' />
							<input type="hidden" name="etape" id="etape" value= '<?php echo $_POST["etape"] ?>' />
							<input type="hidden" name="nom_course" id="nom_course" tabindex="10"  size="60"  value= '<?php echo $_POST["nom_course"] ?>' />
							<input type="hidden" name="ID" id="ID"   value= '<?php echo $donnees ["ID"] ?>' />
			
			
							<table>
							<tr>
							<th width="5%"> N°</th>
							<th width="15%"> Nom Catégorie</th>
							<th width="15%"> Dossard Start</th>
							<th width="15%"> Dossard end</th>
							<th width="5%"> Sexe</th>	
							<th width="15%"> Année start</th>	
							<th width="15%"> Année end</th>	
							<th width="15%"> Heure départ</th>								
				
							</tr>
							<?php		// Lecture du fichier CAT.csv 	
										$pathFile = '../courses/'.$_POST['nom_course'].$annee.'/'.$value.'/'.$valueParcours.'/cat.csv';
										if (($handle = fopen($pathFile, "r")) !== FALSE) {
											while (($data = fgetcsv($handle, 1000, ";")) !== FALSE) {
												$num = count($data);
												$num_cat =	$data[0];						
												$nom_cat = $data[1];
												$NumDossardStart = $data[2];
												$NumDossardEnd = $data[3];
												$sexe = $data[4];
												$annee_start = intval($data[5]);
												$annee_end = intval($data[6]);
												$HeureStart = intval($data[7]);
		 					?>
				<tr>		
				<td > <input type="text" name="num_cat" id="num_cat" tabindex="10" value=  '<?php echo $num_cat ; ?>' /> </td>
				<td > <input type="text" name="nom_cat" id="nom_cat" tabindex="10" value=  '<?php echo $nom_cat ; ?>' /> </td>
				<td > <input type="text" name="NumDossardStart" id="NumDossardStart" tabindex="10" value=  '<?php echo $NumDossardStart ; ?>' /> </td>
				<td > <input type="text" name="NumDossardEnd" id="NumDossardEnd" tabindex="10" value=  '<?php echo $NumDossardEnd ; ?>' /> </td>
				<td > <input type="text" name="sexe" id="sexe" tabindex="10" value=  '<?php echo $sexe ; ?>' /> </td>
				<td > <input type="text" name="annee_start" id="annee_start" tabindex="10" value=  '<?php echo $annee_start ; ?>' /> </td>
				<td > <input type="text" name="annee_end" id="annee_end" tabindex="10" value=  '<?php echo $annee_end ; ?>' /> </td>
				<td> <input type="text" name="HeureStart" id="HeureStart" tabindex="10" value=  '<?php echo $HeureStart ; ?>' /> </td>
				</tr>
			<?php
											}
										}
			}
				}
			?>
			</table>
				<?php echo "<input type=\"image\" src=\"images/modification.png\" title=\"modif\"width=\"50\" >";?>
			</form>
		<?php										 
			}
		}
	}
	?>


</fieldset>

<ul id="step">

<!---<form method="post" action="<?php// echo $_SERVER["PHP_SELF"];
//echo $_POST["Nom_parcours"] ;

 ?>">--->
<form method="post" action="Script_Ajout_parcours.php">

	 <input type="hidden" name="date_course" id="date_course" tabindex="10"  size="60"  value= '<?php echo $_POST['date_course'] ?>' />
	<input type="hidden" name="login" id="login" tabindex="10"  size="60"  value= '<?php echo $_POST['login'] ?>' />
	<input type="hidden" name="nom_course" id="nom_course" tabindex="10"  size="60"  value= '<?php echo $_POST['nom_course']?>' />
  <p><label for="nom_parcours">Nom:</label> <input type="text" name="nom_parcours" id="nom_parcours" tabindex="20" /></p>
  <p><label for="Nom">Distance:</label> <input type="text" name="distance" id="distance" tabindex="24" /></p>
  <p><label for="nom">Informations:</label> <textarea name="information" id="information"tabindex="25" rows="4" cols="80"   ></textarea></p>
  <p><label for="photo">Carte du parcours:</label><input type="file"  name='image_1' /></p>
  <p><label for="photo">Profil de dénivellation:</label><input type="file"  name='image_2' /></p>
  <center>
  <input type="image" src="images/bouton_plus.png" title="previous" style="background-color:transparent"width="50" height="50">
  </center>
</form>
</fieldset>
<?php



?>
</ul>
 <center>

<input type="image" src="images/bouton_previous.png" title="previous" style="background-color:transparent"width="50" height="50">
<input type="image" src="images/bouton_next.png" title="next" style="background-color:transparent"width="50" height="50">
</form>
</center>
</div>
   </body>
   </html>