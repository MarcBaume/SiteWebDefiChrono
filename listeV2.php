<!DOCTYPE html>
<html>
<head>
	<meta property="og:description" content="chronométrage, chrono, jura, franches-montagnes, Jura défi, course à pied, Sport, Jura défi chrono" />  
	<title>Défi Chrono</title>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, maximum-scale=1.0, user-scalable=yes">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css">
	<link rel="stylesheet" title="defaut" media="screen" href="styleV4.css" type="text/css"/>
<!--	<link rel="stylesheet" type="text/css" media="screen and (max-width: 480px)" href="style-mobilV2.css" /> -->
</head>

    <body>

<?php
  include("Header.php"); 
  ?>
<div id="corps">
	<?php include("HeaderInfo.php"); ?>
	 <h3>
Liste de départ  <?php  echo $NOM_COURSE. ' ' . $ANNEE_COURSE ?>
   </h3>

 </br> 
  <div  id="TableauResulat">
 <form method="get" action="listeV2.php">
 <input type="hidden" name="DateCourse" id="DateCourse" tabindex="10"  size="60"  value= '<?php echo $_GET["DateCourse"] ?>' />
<input type="hidden" name="Etape" id="Etape" value= '<?php echo $_GET["Etape"] ?>' />
<input type="hidden" name="NomCourse" id="NomCourse" tabindex="10"  size="60"  value= '<?php echo $_GET["NomCourse"] ?>' />
 <?php
$row = 1;
$start_array = false;
$numetape = intval($_GET['Etape']);
// Afficher la liste des départ Dossier dans la course ;
$pathfolder = 'courses/'.$_GET['NomCourse'].$ANNEE_COURSE;
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
	if ($_GET['Parcours']==("")){
  //   $sql = 'SELECT * FROM inscription WHERE course=\''.$NOM_COURSE. $ANNEE_COURSE .'\'ORDER BY parcours ASC,  NomDepart ASC,ID ASC';
$sql = 'SELECT * FROM inscription WHERE course=\''.$NOM_COURSE. $ANNEE_COURSE .'\'ORDER BY parcours ASC, NomDepart ASC,  Nom ASC';

}
	else{

//	 $sql = 'SELECT * FROM inscription  WHERE course=\''.$NOM_COURSE. $ANNEE_COURSE. '\'AND parcours = \''.$_GET["Parcours"]. '\'ORDER  BY NomDepart ASC,Nom ASC';
$sql = 'SELECT * FROM inscription  WHERE course=\''.$NOM_COURSE. $ANNEE_COURSE. '\'AND parcours = \''.$_GET["Parcours"]. '\'ORDER  BY Nom ASC';
	
}
	 
	 $result = mysqli_query($con,$sql);
    ?>
	 <?php
	 $c=0;
    // On affiche chaque entrée une à une
	
	  // On affiche chaque entrée une à une
  
 if ($result && mysqli_num_rows($result) > 0) {
    // output data of each row
    while($donnees = mysqli_fetch_assoc($result)) {

	$ArrayDepart =explode(";",$donnees['NomDepart']);
	if ("En Attente"<>  $donnees['Payer'] || "Refusé"==  $donnees['Payer'] || $val ["AllPeopleOnStartList"])
	{
		$c= $c +1;
		$m= $m +1;
	}
	
		
/*	if ( $ArrayDepart[2] != $NomDepartTampon)
	{
	if ($NomDepartTampon!=("")){
	?></table> <?php
	}
	$NomDepartTampon =  $ArrayDepart[2] ;
	?>
	<h2> <?php echo $ArrayDepart[2]  ?> </h2>

	if ( $donnees['parcours'] != $NomParcoursTampon)
	{
		$NomParcoursTampon = $donnees['parcours'] ;?>
		<h2> <?php echo $NomParcoursTampon ?> </h2>
		<?
	}*/

	if ( $donnees['NomDepart'] != $NomDepartTampon && "En Attente"<>  $donnees['Payer'] )
	{
		if ($NomDepartTampon!=("")){
		?></table> <?php
		echo "</br>Nombres concurrents inscrits pour ce départ : ". $m;
		$m = 1;
		}
		$NomDepartTampon = $donnees['NomDepart'] ;
	?>
	<h2> <?php echo $donnees['parcours']   ?> </h2>
	<h2> <?php echo $donnees['NomDepart']   ?> </h2>
 <table> 
 
 <?php

 if (strlen($donnees['PrenomDisc2']) > 1 )
 {
 
 $relais = 1 ?>
 		<tr>
		
		<th width="15%"> Nom équipe</th>
<? 		if ($val ["JuraDefi"]  && $ANNEE_COURSE == 2021  )
		{?>
			<th width="15%"> Roller</th>
		<?}
		else if ($val ["JuraDefi"])
		{?>
			<th width="15%"> Roller</th>
		<?}
		else
		{?>
			<th width="15%"> Coureur 1 </th>
		<?	
		}?>
		<?php if (strlen($donnees['PrenomDisc2']) > 1)
		{
		$relais = 2 ?>
			<? 		if ($val ["JuraDefi"]  )
			{?>
				<th width="15%"> Course</th>
			<?}
			else
			{?>
				<th width="15%"> Coureur 2 </th>
			<?	
			}?>
		<?php
		}?>
		<?php if (strlen($donnees['PrenomDisc3']) > 1)
		{
		$relais = 4 ?>
	<? 		if ($val ["JuraDefi"]   && $ANNEE_COURSE == 2021 )
			{?>
				<th width="15%"> VTT</th>
			<?}
			else if ($val ["JuraDefi"] )
			{?>
					<th width="15%">Natation</th>
			<?}
			else
			{?>
				<th width="15%"> Coureur 3 </th>
			<?	
			}?>
		<?php
		}?>
		<?php if (strlen($donnees['PrenomDisc4']) > 1)
		{
		$relais = 4 ?>
	<? 		if ($val ["JuraDefi"]   && $ANNEE_COURSE == 2021 )
			{?>
				<th width="15%"> Vélo ce route</th>
			<?}
			else if ($val ["JuraDefi"] )
			{?>
					<th width="15%">Course Montagne</th>
			<?}
			else
			{?>
				<th width="15%"> Coureur 4 </th>
			<?	
			}?>
		<?php
		}?>
		<?php if (strlen($donnees['PrenomDisc5']) > 1)
		{
		$relais = 5 ?>
	<? 		if ($val ["JuraDefi"] )
			{?>
					<th width="15%">Vélo de route</th>
			<?}
			else
			{?>
				<th width="15%"> Coureur 5 </th>
			<?	
			}?>
		<?php
		}?>
			<?php if (strlen($donnees['PrenomDisc6']) > 1)
		{
		$relais = 6 ?>
	<? 		if ($val ["JuraDefi"] )
			{?>
					<th width="15%">VTT</th>
			<?}
			else
			{?>
				<th width="15%"> Coureur 6 </th>
			<?	
			}?>
		<?php
		}?>
		</tr>
 
<?php 
}
else
{
$relais = 0?>
 		<tr>
	<!--	<th width="5%"> N°</th>-->
		<th width="15%"> Nom</th>
		<th width="15%"> Prénom</th>
		<th width="15%"> Localité</th>		
		<th width="5%"> Année</th>
		<th width="5%"> Sexe</th>
		<th width="15%"> Club</th>

			<?	// SPécial BCJ Challenge
		if ($NOM_COURSE =="BCJ Challenge" && strpos($donnees['NomDepart'],"Course")>-1)
		{?>
			<th width="15%"> Nom équipe</th>
		<?
		}?>
		<th width="5%"> Cat.</th><?php
if ($val ["InscriptionWithPayment"]  )
{?>
<th width="5%"> </th>
<?php
}
if ($_GET["NbrEtape"]>1  )
{?>
<th width="15%">Nbr Etape</th>
<?php
}?>
		</tr>

<?php 
}
}

if ("En Attente"<>  $donnees['Payer']  || "Refusé"==  $donnees['Payer'] || $val ["AllPeopleOnStartList"] )
{

	if ($relais >0)
	{

	?>
			<tr>
			
				<!--<td  > <?php // echo $c; ?></td>-->
				<td > <?php echo $donnees['NomEquipe']; ?></td>
				<td><?php echo $donnees['NomDisc1'] . ' ' .$donnees['PrenomDisc1'] ; ?>    </td>
				<?php if ($relais >1)
				{
				?>
				<td><?php echo $donnees['NomDisc2'] . ' ' .$donnees['PrenomDisc2']; ?>  </td>
				<?php 
				}
				if ($relais >2)
				{
				?>
				
				<td > <?php echo $donnees['NomDisc3'] . ' ' .$donnees['PrenomDisc3']; ?> </td>
				<?php 
				}
				if ($relais >3)
				{
				?>
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
				}
				?>
			</tr>
	<?php
	}
	else
	{

	?>
		<tr>
			<!--<td  > <?php// echo $c; ?></td>-->
			<td > <?php echo $donnees['Nom']; ?></td>
			<td><?php echo $donnees['Prenom']; ?>    </td>
			<td><?php echo $donnees['localite']; ?>  </td>
			<td > <?php echo $donnees['DateNaissance']; ?> </td>
			<td > <?php echo $donnees['sexe']; ?> </td>
			<td > <?php echo $donnees['club']; ?> </td>
			
		<?	// SPécial BCJ Challenge
		if ($NOM_COURSE =="BCJ Challenge" && strpos($donnees['NomDepart'],"Course")>-1)
		{?>
			<td > <?php echo $donnees['NomEquipe']; ?></td><?
		}?>
					<td > <?php echo $donnees['NumCategorie']; ?> </td>
				<?php	if ($val ["InscriptionWithPayment"] )
		{
		if ("En Attente"==  $donnees['Payer'] || "Refusé"==  $donnees['Payer'] )
		{?>
		<td > <?php echo "En attente" ?> </td>
		<?php	
		}
		else
		{
			?>
		<td > <?php echo "Payé"; ?> </td>
		<?php	
		}
		if ($_GET["NbrEtape"] > 1  )
		{?>
		<td ><?
		$NbrEtape = intval(substr($donnees['NbrEtape'], 0, 1));
		$NbrCreditRestant = intval($donnees['NombreCreditRestant']);
			// A faire avec boucle while
			$i = 0;
			while ($i <= ($NbrEtape -$NbrCreditRestant)-1) 
			{
				?>
				<i class="fa fa-circle"style="color:green" ></i>
				<?
				$i = $i + 1;
			}
			$j = 0;
			// A faire avec boucle while
			while ($j <= ($NbrCreditRestant-1)) 
			{
				?>
				<i class="fa fa-flag" ></i>
				<?
				$j = $j + 1;
			}
		?>
		<!-- <?php  //echo $donnees['NbrEtape'];  ?> </td>-->
		<?php	
		}
		?>

<?php
	}
}?>
			<!---		<td > <?php //echo $donnees['parcours']; ?> </td>--->
		</tr>

<?php
}
		}
		
	}
	else
	{
	?><i> Encore personne est inscrit à ce départ</i>  </br></br>
	<?php
	}
	?>


</table>
<?php
		echo "</br>Nombres concurrents inscrits pour ce départ : ". $m."</br></br>";
echo "Nombres total de concurrents inscrits : ". $c;
}
?>
</div>
 <?php include("sponsors.php"); ?> 
</div>

</body>
</html>
