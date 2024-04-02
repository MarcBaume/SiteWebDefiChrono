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
			<?php $Nbr_etape = intval ($val ["nbr_etape"]);
							
								if ($Nbr_etape < 2)
								 {?>
  <p> Date: <?php echo  strftime('%A %d %B %Y ',strtotime($val ["Date"]));?> </P>
  <p> Lieu: <?php echo $val ["Lieu"] ?> </P>
 <p> Emplacement: <?php echo $val ["Emplacement"] ?> </P>
 
 <?php } ?>
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
echo strftime('%A %d %B %Y       %H:%M',strtotime($val ["DATE_END_INSCRIPTION"])) ;
} ?>
, il est toujours possible de s'inscrire sur place
</p>
  <?php if ( strlen($val ["Description"] ) > 1)
  { ?>
 <Fieldset>
 <legend> Description </legend>
 <?php echo $val ["Description"] ?>
  </Fieldset>
  
  <?php
}
  if ( strlen($val ["Informations"] ) > 1)
  { ?>
  <Fieldset>
 <legend> Nouveauté </legend>
 <?php echo $val ["Informations"] ?> 
    </Fieldset>
 <?php
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
					</br>
					<Fieldset>
					<h2><?php echo   $Parcours ?></h2>	
					
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
								if ($Nbr_etape < 2)
								{
								 	
									$chemin= 'courses/'.$_GET['nom_course'].$ANNEE_COURSE."/".$Parcours."/".$depart."/images/parcours.jpg";
									if (file_exists($chemin)) 
									{
										echo '<center><img src="'.$chemin.'" alt=""  WIDTH=60% /></center>'; 
						
									}
									
									// ***************************** LEcture Fichier INFO  ***************************/			
									if (sizeof($filesDepart)>3)
									{
										?>
									<p><b><?php echo       $depart ?></b></p>
									<?php
									}
									// Lecture du fichier info.txt 	
									$pathFileInfo = 'courses/'.$_GET['nom_course'].$ANNEE_COURSE.'/'.$_GET['nom_parcours'].'/'.$Parcours.'/'.$depart.'/info.txt';
									if (file_exists($pathFileInfo))
									{
										if (($handle = fopen($pathFileInfo, "r")) !== FALSE) 
										{
											$cmpt =0;
											$cmptDiscipline =0;
											while (($datatxt = fgetcsv($handle, 1000, ";")) !== FALSE) 
											{
												$cmpt++; 
												if( $cmpt==1)
												{
												$HeureStart = $datatxt[1];
												$PrixInternet = $datatxt[2];
												$PrixPlace = $datatxt[3];
												?>
													<p><?php echo  '	Heure  : ' .$HeureStart  ?></p>
													<Table>
													<tr>
													<?php	
													if( strlen($PrixInternet) >1)
													{
													?>
														<td><?php echo  '	Prix Internet : ' .$PrixInternet?></td> 
										
													<?php
													}
												
													if (strlen($PrixPlace) >0) 
													{?>
															<td><?php echo  '	Prix Sur Place : ' .$PrixPlace?></td>
											
														<?php 
													}
													else
													{
														?>	<td>Pas d'inscription sur place </td><?php
													}?>
														
													
													</tr>
													</table> 
													<?php
												}
												// Lecture Ligne 2 
												else if( $cmpt==2)
												{
													$NbrDiscipline = intval($datatxt[1]);
												}
												else if( $cmpt>2)
												{	
													// Nombre de discipline > 1
													if ($NbrDiscipline > 1 && $cmptDiscipline < $NbrDiscipline )
													{?>
														<?php
													
														$cmptDiscipline ++;
														?>
														<!---- ajout d'une discipline  ---->
														<fieldset>
														<H4> <?php echo  $cmptDiscipline .'	: '  ?>  <?php echo $datatxt[1] ?> </h4> 
														
													
														  <?php echo '	Distance : ' .$datatxt[2]?> </br>
														
														<?php 
														if( strlen($datatxt[3]) >1)
														{
															?>
														
																<?php echo  '	Dénivellé : ' .$datatxt[3]?>   </br>
															
															<?php 	
															
														}
														
														?>
														
														<?php
														

													// affichage image discipline 
													$chemin= 'courses/'.$_GET['nom_course'].$ANNEE_COURSE."/".$Parcours."/".$depart."/images/".$datatxt[1] .".jpg";
														if (file_exists($chemin)) 
														{
															?>
															
															<?php
															echo '<center><img src="'.$chemin.'" alt=""  WIDTH=60% /></center>'; 
															?>
															 </br>
															<?php
														}
														?>
														
														
														</fieldset>
														</br>
																</br>
														<?php
											
													}
													else
													{
														// SI on est a pas a une course multi discpline
														if( $cmpt==3)
														{	?>
															<table>
															<tr> <td><?php echo  '	Distance : ' .$datatxt[2]?></td> 
															<?php if( strlen($datatxt[3]) >1)
															{
																?>
																<td><?php echo  '	Dénivellé : ' .$datatxt[3]?> </td> </table>
													<?php 	}
									
																?>
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
									}
								}
								else
								{
									// Course par étape 
									// ***************************** LEcture Fichier INFO  ***************************/			
									if (sizeof($filesDepart)>3)
									{
										?>

									<p><h3><?php echo       $depart ?></h3></p>
									<?php
									}
									// Lecture du fichier info.txt 	
									$pathFileInfo = 'courses/'.$_GET['nom_course'].$ANNEE_COURSE.'/'.$_GET['nom_parcours'].'/'.$Parcours.'/'.$depart.'/info.txt';
									if (file_exists($pathFileInfo))
									{
										if (($handle = fopen($pathFileInfo, "r")) !== FALSE) 
										{
											$cmpt =0;
											$cmptDiscipline =0;
											while (($datatxt = fgetcsv($handle, 1000, ";")) !== FALSE) 
											{
												$cmpt++; 
												if( $cmpt==1)
												{
												$HeureStart = $datatxt[1];
												$PrixInternet = $datatxt[2];
												$PrixPlace = $datatxt[3];
												?>
													<p><?php echo  '	Heure  : ' .$HeureStart  ?></p>
													
													<?php			
													if (strlen($PrixInternet) >0) 
													{?>
													<Table><tr><td><?php echo  '	Prix Internet : ' .$PrixInternet?></td> <td>
													<?php
													if (strlen($PrixPlace) >0) 
													{?>
														<?php echo  '	Prix Sur Place : ' .$PrixPlace?>
											
														<?php 
													}
													else
													{
														?>Pas d'inscription sur place <?php
													}
													}?>
														
													</td>
													</tr>
													</table> 
													<?php
												}
												// Lecture Ligne 2 
												else if( $cmpt==2)
												{
													$NbrDiscipline = intval($datatxt[1]);
												}
												else if( $cmpt>2)
												{	
													// Nombre de Etapoe > 1

													if ( $cmptDiscipline < $Nbr_etape )
													{
														$cmptDiscipline ++;
														switch ($cmptDiscipline) {
														case 1:
															$Distance1 = $datatxt[2];
															$Deni1 = $datatxt[3];
															break;
														case 2:
															$Distance2 = $datatxt[2];
															$Deni2 = $datatxt[3];
															break;
														case 3:
															$Distance3 = $datatxt[2];
															$Deni3 = $datatxt[3];
															break;
														case 4:
															$Distance4 = $datatxt[2];
															$Deni4 = $datatxt[3];
															break;
														case 5:
															$Distance5 = $datatxt[2];
															$Deni5 = $datatxt[3];
															break;
														}
													

													}
													?>
													</table>
													<?php												
												}
											}
										}
									}
								
								
								?>
								
								
								
									<fieldset>
									<Legend><b> Etape 1 </b> </legend>
									<p> Date : <?php echo $val ["Date"] ?> </P>
									<p> Lieu : <?php echo $val ["Lieu"] ?> </P>
									
									<?php if( strlen($val ["Emplacement"] ) >1)
									{?> 
									<p> Emplacement: <?php echo $val ["Emplacement"] ?> </P>
									<?php } ?>
									<?php 
										$chemin= 'courses/'.$_GET['nom_course'].$ANNEE_COURSE."/".$Parcours."/".$depart."/images/Etape1.jpg";
										if (file_exists($chemin)) 
										{
											echo '<center><img src="'.$chemin.'" alt=""  WIDTH=60% /></center>'; 
										}
										
										$chemin= 'courses/'.$_GET['nom_course'].$ANNEE_COURSE."/".$Parcours."/".$depart."/images/profil_etape1.jpg";
										if (file_exists($chemin)) 
										{
											echo '<center><img src="'.$chemin.'" alt=""  WIDTH=60% /></center>'; 
							
										}
										
										
										?>
										
											<table> 
											<!---- ajout d'une ligne  ---->
											<tr>  <td>  <?php echo '	Distance : ' .$Distance1 ?> </td>
											<?php 
											if( strlen($Deni1 ) >1)
											{
											?>
												<td>	<?php echo  '	Dénivellé :' .$Deni1 ?>  </td></tr><?php 	
											}
											?> </table> 
										
									</fieldset>
								  
									<fieldset>
									<Legend><b>  Etape 2 </b> </legend>
									<p> Date : <?php echo $val ["DateEtape2"] ?> </P>
									<p> Lieu : <?php echo $val ["LieuEtape2"] ?> </P>
										<?php if( strlen($val ["EmplacementEtape2"] ) >1)
										{?> 
										<p> Emplacement: <?php echo $val ["EmplacementEtape2"] ?> </P>
										<?php } ?>
										<?php 
										$chemin= 'courses/'.$_GET['nom_course'].$ANNEE_COURSE."/".$Parcours."/".$depart."/images/Etape2.jpg";
										if (file_exists($chemin)) 
										{
											echo '<center><img src="'.$chemin.'" alt=""  WIDTH=60% /></center>'; 
										}
										$chemin= 'courses/'.$_GET['nom_course'].$ANNEE_COURSE."/".$Parcours."/".$depart."/images/profil_etape2.jpg";
										if (file_exists($chemin)) 
										{
											echo '<center><img src="'.$chemin.'" alt=""  WIDTH=60% /></center>'; 
							
										}
										?>
											<table> 
											<!---- ajout d'une ligne  ---->
											<tr>  <td>  <?php echo '	Distance : ' .$Distance2 ?> </td>
											<?php 
											if( strlen($Deni1 ) >1)
											{
											?>
												<td>	<?php echo  '	Dénivellé :' .$Deni2 ?>  </td></tr><?php 	
											}
											?> </table> 
									</fieldset>
									<?php
									if ($Nbr_etape >2)
									{
										?>
										<fieldset>
										<Legend><b>  Etape 3</b> </legend>
										<p> Date : <?php echo $val ["DateEtape3"] ?> </P>
										<p> Lieu : <?php echo $val ["LieuEtape3"] ?> </P>
										<?php if( strlen($val ["EmplacementEtape3"] ) >1)
										{?> 
										<p> Emplacement: <?php echo $val ["EmplacementEtape3"] ?> </P>
										<?php } ?>
										<?php 
											$chemin= 'courses/'.$_GET['nom_course'].$ANNEE_COURSE."/".$Parcours."/".$depart."/images/Etape3.jpg";
											if (file_exists($chemin))
											{
												echo '<center><img src="'.$chemin.'" alt=""  WIDTH=60% /></center>'; 
											}
										$chemin= 'courses/'.$_GET['nom_course'].$ANNEE_COURSE."/".$Parcours."/".$depart."/images/profil_etape3.jpg";
										if (file_exists($chemin)) 
										{
											echo '<center><img src="'.$chemin.'" alt=""  WIDTH=60% /></center>'; 
							
										}
										?>
											<table> 
											
											<!---- ajout d'une ligne  ---->
											<tr>  <td>  <?php echo '	Distance : ' .$Distance3 ?> </td>
											<?php 
											if( strlen($Deni1 ) >1)
											{
											?>
												<td>	<?php echo  '	Dénivellé :' .$Deni3 ?>  </td></tr><?php 	
											}
											?> </table> 
										</fieldset>
										<?php
										if ($Nbr_etape >3)
										{
											?>
											<fieldset>
											<Legend><b>  Etape 4</b> </legend>
											<p> Date : <?php echo $val ["DateEtape4"] ?> </P>
											<p> Lieu : <?php echo $val ["LieuEtape4"] ?> </P>
											<?php if( strlen($val ["EmplacementEtape4"] ) >1)
											{?> 
											<p> Emplacement: <?php echo $val ["EmplacementEtape4"] ?> </P>
											<?php } ?>
											<?php 
											$chemin= 'courses/'.$_GET['nom_course'].$ANNEE_COURSE."/".$Parcours."/".$depart."/images/Etape4.jpg";
											if (file_exists($chemin)) 
											{
												echo '<center><img src="'.$chemin.'" alt=""  WIDTH=60% /></center>'; 
											}
											$chemin= 'courses/'.$_GET['nom_course'].$ANNEE_COURSE."/".$Parcours."/".$depart."/images/profil_etape4.jpg";
											if (file_exists($chemin)) 
											{
												echo '<center><img src="'.$chemin.'" alt=""  WIDTH=60% /></center>'; 
								
											}
											?>
											<table> 
											<!---- ajout d'une ligne  ---->
											<tr>  <td>  <?php echo '	Distance : ' .$Distance4 ?> </td>
											<?php 
											if( strlen($Deni1 ) >1)
											{
											?>
												<td>	<?php echo  '	Dénivellé :' .$Deni4 ?>  </td></tr><?php 	
											}
											?> </table> 
											</fieldset>
											<?php
											if ($Nbr_etape >4)
											{
											?>
												<fieldset>
												<Legend><b>  Etape 5</b> </legend>
												<p> Date : <?php echo $val ["DateEtape5"] ?> </P>
												<p> Lieu : <?php echo $val ["LieuEtape5"] ?> </P>
												<?php if( strlen($val ["EmplacementEtape5"] ) >1)
												{?> 
												<p> Emplacement: <?php echo $val ["EmplacementEtape5"] ?> </P>
												<?php } ?>
												<?php 
												$chemin= 'courses/'.$_GET['nom_course'].$ANNEE_COURSE."/".$Parcours."/".$depart."/images/Etape5.jpg";
												if (file_exists($chemin)) 
												{
													echo '<center><img src="'.$chemin.'" alt=""  WIDTH=60% /></center>'; 
												}
												$chemin= 'courses/'.$_GET['nom_course'].$ANNEE_COURSE."/".$Parcours."/".$depart."/images/profil_etape5.jpg";
												if (file_exists($chemin)) 
												{
													echo '<center><img src="'.$chemin.'" alt=""  WIDTH=60% /></center>'; 
									
												}
												?>
												<table> 
												<!---- ajout d'une ligne  ---->
												<tr>  <td>  <?php echo '	Distance : ' .$Distance5 ?> </td>
												<?php 
												if( strlen($Deni1 ) >1)
												{
													?>
													<td>	<?php echo  '	Dénivellé :' .$Deni5 ?>  </td></tr><?php 	
												}
												?> </table> 
												</fieldset>
												<?php
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
								<th width="15%"> Année de Naissance</th>	
								<th width="5%"> </th>								
								</tr>
								<?php		// Lecture du fichier CAT.csv 	
								$pathFile = 'courses/'.$_GET['nom_course'].$ANNEE_COURSE.'/'.$_GET['nom_parcours'].'/'.$Parcours.'/'.$depart.'/cat.csv';
								if (($handle = fopen($pathFile, "r")) !== FALSE) 
								{
									while (($data = fgetcsv($handle, 1000, ";")) !== FALSE) 
									{
										$num = count($data);
										$num_cat =	$data[0];						
										$nom_cat = $data[1];
										$sexe = $data[4];
										$annee_start = intval($data[5]);
										$annee_end = intval($data[6]);
										$Distance = $data[7];
									
										?>
										<tr>
										<td> <?php echo $num_cat  ?> </td>
										<td> <?php echo $nom_cat  ?> </td>
										<td> <?php echo $sexe  ?> </td>
										<td> <?php echo $annee_start .'-'. $annee_end ?> </td>
						
												<td> <?php echo $Distance ?> </td>
							
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
