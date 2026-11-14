<?php
	require_once __DIR__ . "/../includes/Header.php";	
		require_once __DIR__ . "/../includes/dataRaceSelected.php";	
	require_once __DIR__ . "/../includes/menuPages.php";
	// initialisation des variables
	$nbrFile = 0;
	$c = -1;
	$m = -1;
	$NomDepartTampon = '';
	$relais = 0;
?>
  <div id="Top1"></div>
        <a href="#Top1" id="GoToTop" class="GoToTop" style ="visibility :hidden ;z-index:3000;" >
    <i class="fa fa-arrow-up" style= "font-size: 50px;margin:2px;"></i>
</a>
  <div  id="TableauResulat">
 <?php
$row = 1;
$start_array = false;
$numetape = isset($_GET['Etape']) ? (int) $_GET['Etape'] : 0;
$Parcours = $_GET['Parcours'] ?? '';
$NbrEtape = isset($_GET['NbrEtape']) ? (int) $_GET['NbrEtape'] : 1;
// Afficher la liste des départ Dossier dans la course ;
$pathfolder = "../courses/".$NOM_COURSE.$ANNEE_COURSE;
// Création de la liste de toutes les Parcours
$files1 = scandir($pathfolder);
   foreach ($files1  as $key => $value) 
   { 
	   if(is_dir($pathfolder ."/".$value))
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



<!--                            ******* */
            Affichage de la lsite de départ selon le tri sélectionné

-->
	<?php
if (empty($_GET['Parcours'])) {

    $sql = 'SELECT *
            FROM inscription
            WHERE course = :course
            ORDER BY parcours ASC, NomDepart ASC, Nom ASC';

    $stmt = $pdo->prepare($sql);
    $stmt->execute([
        'course' => $NOM_COURSE . $ANNEE_COURSE
    ]);

} else {

    $sql = 'SELECT *
            FROM inscription
            WHERE course = :course
            AND parcours = :parcours
            ORDER BY Nom ASC';

    $stmt = $pdo->prepare($sql);
    $stmt->execute([
        'course' => $NOM_COURSE . $ANNEE_COURSE,
        'parcours' => $_GET['Parcours']
    ]);
}
	 $c=-1;
	 $m = -1;
    // On affiche chaque entrée une à une
	
	  // On affiche chaque entrée une à une
$resultats = $stmt->fetchAll(PDO::FETCH_ASSOC);

if (count($resultats) > 0) {
    foreach ($resultats as $donnees) {
        // Ton code d'affichage

 
	$ArrayDepart =explode(";",$donnees['NomDepart']);
	if ("En Attente"<>  $donnees['Payer']  || $course ["AllPeopleOnStartList"])
	{
		$c= $c +1;
		$m= $m +1;
	}
	
// Nouveau départ affichage du total
	if ( $donnees['NomDepart'] != $NomDepartTampon && "En Attente"<>  $donnees['Payer'] )
	{
		if ($NomDepartTampon!=("")){
		?></table> 
        </center><?php
		echo "</br><i style ='font-size: 14px;margin-left :5%'>Nombres concurrents inscrits pour ce départ : <b>". $m."</b></i>";
		$m = 0;
		}
		$NomDepartTampon = $donnees['NomDepart'] ;
	?>
	<h2 style ='margin-left :5%'> 
        <?php echo substr($donnees['parcours'],2)   ?> 
    </h2>
    <?php
    if ( $donnees['NomDepart'] != $donnees['parcours']   )
    {?>
	<h2 style ='margin-left :5%'> 
        <?php echo $donnees['NomDepart']   ?> 
    </h2>
    <?php
    }
?>
    <center>
    <table style= "width:95%"> 
 
 <?php

 if (strlen($donnees['PrenomDisc2']) > 1 )
 {
 
 $relais = 1 ?>
 		<tr>
		
		<th width="15%"> Nom équipe</th>
		<?php 		
		if ($val ["JuraDefi"]  && $ANNEE_COURSE == 2021  )
		{?>
			<th width="15%"> Roller</th>
		<?php
		}
		else if ($val ["JuraDefi"])
		{?>
			<th width="15%"> Roller</th>
		<?php
		}
		else
		{?>
			<th width="15%"> Coureur 1 </th>
		<?php	
		}?>
		<?php if (strlen($donnees['PrenomDisc2']) > 1)
		{
		$relais = 2 ?>
			<?php 		if ($val ["JuraDefi"]  )
			{?>
				<th width="15%"> Course</th>
			<?php
			}
			else
			{?>
				<th width="15%"> Coureur 2 </th>
			<?php	
			}?>
		<?php
		}?>
		<?php if (strlen($donnees['PrenomDisc3']) > 1)
		{
		$relais = 4 ?>
	<?php		if ($val ["JuraDefi"]   && $ANNEE_COURSE == 2021 )
			{?>
				<th width="15%"> VTT</th>
			<?php
			}
			else if ($val ["JuraDefi"] )
			{?>
					<th width="15%">Natation</th>
			<?php
			}
			else
			{?>
				<th width="15%"> Coureur 3 </th>
			<?php	
			}?>
		<?php
		}?>
		<?php if (strlen($donnees['PrenomDisc4']) > 1)
		{
		$relais = 4 ?>
	<?php 		if ($val ["JuraDefi"]   && $ANNEE_COURSE == 2021 )
			{?>
				<th width="15%"> Vélo ce route</th>
			<?php
			}
			else if ($val ["JuraDefi"] )
			{?>
					<th width="15%">Course Montagne</th>
			<?php
			}
			else
			{?>
				<th width="15%"> Coureur 4 </th>
			<?php	
			}?>
		<?php
		}?>
		<?php 
		if (strlen($donnees['PrenomDisc5']) > 1)
		{
		$relais = 5 ?>
	<?php 		if ($val ["JuraDefi"] )
			{?>
					<th width="15%">Vélo de route</th>
			<?php
			}
			else
			{?>
				<th width="15%"> Coureur 5 </th>
			<?php	
			}?>
		<?php
		}?>
			<?php if (strlen($donnees['PrenomDisc6']) > 1)
		{
		$relais = 6 ?>
	<?php 		if ($val ["JuraDefi"] )
			{?>
					<th width="15%">VTT</th>
			<?php
			}
			else
			{?>
				<th width="15%"> Coureur 6 </th>
			<?php	
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
          <th width="2%"> </th>
		<th width="15%"> Nom</th>
		<th width="15%"> Prénom</th>
		<th width="15%"> Localité / Club</th>		
		<th width="5%"> Année</th>
		
			<?php	// SPécial BCJ Challenge
		if ($NOM_COURSE =="BCJ Challenge")
		{?>
			<th width="15%"> Nom équipe</th>
		<?php
		}?>
		<th width="5%"> Cat.</th><?php
if ( $course ["InscriptionWithPayment"] )
{?>
<th width="10%"> </th>
<?php
}
else if ($_GET["NbrEtape"]>1  )
{?>
<th width="10%">Nbr Etape</th>
<?php
}?>
		</tr>

<?php 
}
}

if ("En Attente"<>  $donnees['Payer']  || "Refusé"==  $donnees['Payer'] || $course ["AllPeopleOnStartList"] )
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
		<tr  style="padding:5px">
            <td>
            <?php
                if ($donnees['sexe'] =="H")
                {?>
              
                    <i class="fa fa-male" style="color:#00b4ff;Font-size:16px" ></i>
                    <?php
                }
                else if ($donnees['sexe']  =="D")
                {?>
       
                    <i class="fa fa-female" style="color:pink;Font-size:16px" ></i>
              <?php
                }
            ?>
            </td>
			<td style="Font-size:18px"> <?php echo $donnees['Nom']; ?></td>
			<td  style="Font-size:18px"><?php echo $donnees['Prenom']; ?>    </td>
			<td style="Font-size:12px">
                <?php echo $donnees['localite']; ?> </br>
              <b>  <?php echo $donnees['club']; ?> </b>
            </td>
			<td  style="Font-size:12px"> <?php echo $donnees['DateNaissance']; ?> </td>
			
	
			
		<?php	// SPécial BCJ Challenge
		if ($NOM_COURSE =="BCJ Challenge")
		{?>
			<td > <?php echo $donnees['NomEquipe']; ?></td><?php
		}?>
					<td style="Font-size:12px"> <?php echo $donnees['NumCategorie']; ?> </td>
		<?php	if ($course ["InscriptionWithPayment"] )
		{
		
            if ("En Attente"==  $donnees['Payer'] || "Refusé"==  $donnees['Payer'] )
            {?>
                <td >
                <i class="fa  fa-hourglass-o" style="color:red;Font-size:16px"></i>
                </td>
            <?php	
            }
            else
            {
                if (isset($_GET["NbrEtape"] ) && $_GET["NbrEtape"] > 1  )
                {?>
                <td ><?php

				$NbrEtape = isset($donnees['NbrEtape'])
    ? (int) substr((string) $donnees['NbrEtape'], 0, 1)
    : 1;
                
                    $NbrCreditUtilise = intval($donnees['NombreCreditUtilise']);
                    // A faire avec boucle while
                    $i = 0;
                    while ($i <= ($NbrEtape -$NbrCreditUtilise)-1) 
                    {
                        ?>
                            <i class="fa  fa-check-circle " style="color:green;Font-size:16px"></i> 
                 
                        <?php
                        $i = $i + 1;
                    }
                    $j = 0;
                    // A faire avec boucle while
                    while ($j <= ($NbrCreditUtilise-1)) 
                    {
                        ?>
                     <i class="fa fa-flag" ></i>
                        <?php
                        $j = $j + 1;
                    }
                
                }
                else
                {
                    ?>
                    <td >
                    <i class="fa  fa-check-circle " style="color:green;Font-size:16px"></i> 
                    </td>
                     <?php	
                }
            }
		
	}
}?>
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
</center>
<?php
		$m = $m +1;
		$c = $c +1;
		echo "</br><i style ='font-size: 14px;margin-left :5%'>Nombres concurrents inscrits pour ce départ :  <b>". $m."</b></br></br>"."</i>";
echo "<i style ='font-size: 14px;margin-left :5%'>Nombres total de concurrents inscrits : <b>". $c."</b></i>";
}
?>

</div>
 <?php include("sponsors2023.php"); ?> 
</div>

</body>
<script>
window.onscroll = function () { 

//ColorMenuParcours();

 if (document.body.scrollTop > 50 || document.documentElement.scrollTop > 50) {

document.getElementById("GoToTop").style.visibility = "visible";
} else {
document.getElementById("GoToTop").style.visibility = "hidden";

}

};
	</script>
</html>
