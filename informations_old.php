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
 <body>
 
<?php 

include("onglets.php"); ?>

<div id="corps">
	<?php include("menu_vertical.php"); ?>
	
	 <h3>
Informations  <?php  echo $NOM_COURSE. ' ' . $ANNEE_COURSE ?>
   </h3>
	
	<div id="Information">
  <p> Date: <?php echo  strftime('%A %d %B %Y ',strtotime($val ["Date"]));?> </P>
  <p> Lieu: <?php echo $val ["Lieu"] ?> </P>
 <p> Emplacement: <?php echo $val ["Emplacement"] ?> </P>
  <p> Organisateur: <?php echo $val ["Organisateur"] ?> </P>
 <p> Site Web: <?php echo $val ["Site"] ?> </P>
  <p> Contact: <?php echo $val ["Coordonnee"] ?> </P>
<p>
  <?php $today = date("Y-m-d H:i:s");  


if ($today >$val ["Date"] )
{
echo 'Course Terminé';
}
else if ( $today > $val ["DATE_END_INSCRIPTION"] )
{
echo 'Inscriptions fermée';
}
else
{
 $Dateend =  date_parse($val ["DATE_END_INSCRIPTION"]);
?> Inscriptions en ligne ouverte jusqu'au : 
<?php
echo strftime('%A %d %B %Y ',strtotime($val ["DATE_END_INSCRIPTION"])) ;
} ?>
, il est toujours possible de s'inscrire sur place
</p>

 <Fieldset>
 <legend> Description </legend>
 <?php echo $val ["Description"] ?>
  </Fieldset>
  <Fieldset>
 <legend> Nouveauté </legend>
 <?php echo $val ["Informations"] ?> 
    </Fieldset>
 <?php
 $Nbr_etape = intval ($val ["nbr_etape"]);
 
 if ($Nbr_etape < 2)
 {
 ?>
  <?php
  }
  else
  {
 
 ?>
 <fieldset>
 <Legend> Etape 1 </legend>
   <p> Date : <?php echo $val ["Date"] ?> </P>
 <p> Lieu : <?php echo $val ["Lieu"] ?> </P>
 <p> Emplacement: <?php echo $val ["Emplacement"] ?> </P>
  
  </fieldset>
  
   <fieldset>
 <Legend> Etape 2 </legend>
   <p> Date : <?php echo $val ["DateEtape2"] ?> </P>
 <p> Lieu : <?php echo $val ["LieuEtape2"] ?> </P>
 <p> Emplacement: <?php echo $val ["EmplacementEtape2"] ?> </P>
  
  </fieldset>
  <?php
   if ($Nbr_etape >2)
 {
 ?>
     <fieldset>
 <Legend> Etape 3</legend>
   <p> Date : <?php echo $val ["DateEtape3"] ?> </P>
 <p> Lieu : <?php echo $val ["LieuEtape3"] ?> </P>
 <p> Emplacement: <?php echo $val ["EmplacementEtape3"] ?> </P>
  
  </fieldset>
  <?php
     if ($Nbr_etape >3)
 {
 ?>
     <fieldset>
 <Legend> Etape 5</legend>
   <p> Date : <?php echo $val ["DateEtape4"] ?> </P>
 <p> Lieu : <?php echo $val ["LieuEtape4"] ?> </P>
 <p> Emplacement: <?php echo $val ["EmplacementEtape4"] ?> </P>
  
  </fieldset>
  <?php
			  if ($Nbr_etape >4)
		 {
		 ?>
			 <fieldset>
		 <Legend> Etape 5</legend>
		   <p> Date : <?php echo $val ["DateEtape5"] ?> </P>
		 <p> Lieu : <?php echo $val ["LieuEtape5"] ?> </P>
		 <p> Emplacement: <?php echo $val ["EmplacementEtape5"] ?> </P>
		  
		  </fieldset>
		  <?php
		  }
  }
  }
  }


 
  ?>
  
<!---  ***************************** Affichage des catégorie  *************************** ------->
 
  <div  id="TableauResulat">


<?php
		// Afficher la liste des Parcours  Dossier dans la course ;
		$pathfolderParcours = 'courses/'.$_GET['nom_course'].$ANNEE_COURSE;
		// Création de la liste de toutes les Dossier = Parcours 
		$files1 = scandir($pathfolderParcours);
// ***************************** LISTE DES PARCOURS ***************************/
		foreach ($files1  as $key => $Parcours) 
		{ 
			if(is_dir($pathfolderParcours .'/'.$Parcours))
			{
				// Affichage dans la liste des départ dans le menu 
				if (strlen($Parcours) >2 && $Parcours != "info") 
				{//<!--- Liste des Départ !---->

					// Afficher la liste des Parcours  Dossier dans la course ;
					$pathfolder = 'courses/'.$_GET['nom_course'].$ANNEE_COURSE. '/'.$Parcours;
					// Création de la liste de toutes les Dossier = Depart 
					$filesDepart = scandir($pathfolder);
					?>
					<Fieldset>
						<legend><?php echo   $Parcours ?></Legend>	
					
					<?php
					
					
					foreach ($filesDepart  as $key => $depart) 
					{ 
						if(is_dir($pathfolder .'/'.$depart))
						{
							// Affichage dans la liste des départ dans le menu 
							if (strlen($depart) >2) 
							{
							?>
								 <!--- Photo départ --->
								<?php
								$chemin= 'courses/'.$_GET['nom_course'].$ANNEE_COURSE."/".$Parcours."/".$depart."/images/parcours.jpg";
								if (file_exists($chemin)) {
									echo '<center><img src="'.$chemin.'" alt=""  WIDTH=60% /></center></a>'; 
							 }

 ?>
							<h2><?php echo  $depart ?></h2>

					<?php		// Lecture du fichier info.txt 	
								$pathFileInfo = 'courses/'.$_GET['nom_course'].$ANNEE_COURSE.'/'.$_GET['nom_parcours'].'/'.$Parcours.'/'.$depart.'/info.txt';
								if (file_exists($pathFileInfo)) {
									if (($handle = fopen($pathFileInfo, "r")) !== FALSE) {
									$cmpt =0;
									$cmptDiscipline =0;
									while (($datatxt = fgetcsv($handle, 1000, ";")) !== FALSE) {
										$cmpt++; 
										 if( $cmpt==1)
											{?>
										<p><?php echo  '	Heure  : ' .$datatxt[1] ?></p>
									
										<p><?php echo  '	Prix Internet : ' .$datatxt[2]?></p> 
									<?php	if (strlen($datatxt[3]) >0) 
										{?>
										<p><?php echo  '	Prix Sur Place : ' .$datatxt[3]?></p> 
										
										<?php 
										}
										else
										{
										?><p>Pas d'inscription sur place</p> <?php
										}
										}
										 // Lecture Ligne 2 
										else if( $cmpt==2)
										{
										
										$NbrDiscipline = intval($datatxt[1]);
										}
										
										else if( $cmpt>2)
										{	
										if ($NbrDiscipline > 1 && $cmptDiscipline < $NbrDiscipline )
										{
										$cmptDiscipline ++;
													?>
										
										<p><?php echo '	Distance : ' .$datatxt[1] .' : ' .$datatxt[2]?>
										<?php if( strlen($datatxt[3]) >1)
											{
										?>
											<?php echo  '	Dénivellé :' .$datatxt[3]?>
						<?php 				}
						?> </p> <?php
										}
										else
										{
										// SI on est a pas a une course multi discpline
											if( $cmpt==3)
											{
												?>
												
												<p><?php echo  '	Distance : ' .$datatxt[2]?></p> 
												<?php if( strlen($datatxt[3]) >1)
													{
												?>
												<p><?php echo  '	Dénivellé : ' .$datatxt[3]?> </p> 
								<?php 				}
							
											}
										}
										
											
											
											
										}
										}
									}
								}
						?>

							 <table >
														 
								<tr>
								<th width="5%"> N°</th>
								<th width="15%"> Nom Catégorie</th>
								<th width="5%"> Sexe</th>
								<th width="15%"> Date</th>		
								
								</tr>
					<?php		// Lecture du fichier CAT.csv 	
								$pathFile = 'courses/'.$_GET['nom_course'].$ANNEE_COURSE.'/'.$_GET['nom_parcours'].'/'.$Parcours.'/'.$depart.'/cat.csv';
								if (($handle = fopen($pathFile, "r")) !== FALSE) {
									while (($data = fgetcsv($handle, 1000, ";")) !== FALSE) {
										$num = count($data);
										$num_cat =	$data[0];						
										$nom_cat = $data[1];
										$sexe = $data[4];
										$annee_start = intval($data[5]);
										$annee_end = intval($data[6]);
										$HeureStart = intval($data[7]);
 
										?>
										<tr>
										<td> <?php echo $num_cat  ?> </td>
										<td> <?php echo $nom_cat  ?> </td>
										<td> <?php echo $sexe  ?> </td>
										<td> <?php echo $annee_start .'-'. $annee_end ?> </td>
										
										</tr>
										<?php
									 }
										 
									}
									?>
								 </table>
								 <?php
							}
						}
					}
					?>
										</Fieldset>
<?php
				}
			}
		}

		?>
</div>
</div>
 <?php include("sponsors.php"); ?> 
</div>

</body>
</html>
