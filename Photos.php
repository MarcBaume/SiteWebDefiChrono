<!DOCTYPE html>
<html>
<head>
<meta http-equiv="cache-control" content="no-cache"> <!-- tells browser not to cache -->
<meta http-equiv="expires" content="0"> <!-- says that the cache expires 'now' -->
<meta http-equiv="pragma" content="no-cache"> <!-- says not to use cached stuff, if there is any -->
	<title>Défi Chrono</title>
	<meta charset="utf-8">
	<metahttp-equiv = 'cache-control' content = 'no-cache'>
<metahttp-equiv = 'expires' content = '0'>
<metahttp-equiv = 'pragma' content = 'no-cache'>
	<meta name="viewport" content="width=device-width, maximum-scale=1.0, user-scalable=yes">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css">
	<link rel="stylesheet" title="defaut" media="screen" href="styleV6.css" type="text/css"/>
<!--	<link rel="stylesheet" type="text/css" media="screen and (max-width: 480px)" href="style-mobilV2.css" /> -->
<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js">
	 </script>
<script src="../js/prototype.js" ></script>
<script src="../js/FonctionDefiChrono2.js?v=1"></script>

</script>
</head>

<body>
<?php

include("Header2023.php"); 
include("HeaderInfo2023_WithoutCouverture.php"); 

$Parcours = $_GET['Parcours'];
?>
<center>
    <h2 >Merci pour les photos  ©Alexis et Noémie Montagnat-Rentier </h2>


    <?php 
$row = 1;
$start_array = false;

// Afficher la liste des départ Dossier dans la course ;
$pathfolder = 'courses/'.$_GET['NomCourse'].$ANNEE_COURSE.'/info/Photos';

// Création de la liste de toutes les Dossier = Depart 
$files1 = scandir($pathfolder);

$arParcours = array();
$arDepart = array();
$arEtape = array();

// Calcul du nombre de parcours
foreach ($files1  as $key => $value) 
{ 

   if(is_dir($pathfolder .'/'.$value))
   {
		// Affichage dans la liste des départ dans le menu 
		if (strlen($value) >2 && $value != "info") 
		{		
			$arParcours[] =  $value;
			$ParcoursTampon = $value;
		}		
	}
}

/***************************** Parcours ************************************/
// SI il y plus que 1 parcours affichage d'un menu pour le choix du départ
if (count($arParcours) > 1)
{?>

	<? if ($Parcours == null)
	{?>
		<fieldset class="fieldsetResultat">
			<Legend  class="LegendResultat">
				Sélectionner une étape
			</Legend>

	<?	
	}?>
	
		<table  class="menu_vertical" style="margin-top : 15px;">
			<tr >
				<? 
				foreach($arParcours as $Parcours1)
				{
					$IndexParc++;
					?>
							
					<td onClick='ChangParcours(<?php echo json_encode($Parcours1)?>);'  style="cursor: pointer; background: #96C9FA;" > 
					
					<? if ($Parcours != $Parcours1)
					{ ?>
					<span class="dot">
						<p style="color : #3d6ca4;  background: transparent;">
				
							<i class="fa fa-map" style= "color : #3d6ca4;font-size: 25px;margin:5px;"></i>
						
						<? echo $Parcours1 ?>
					</p>
					</span>
				<?
					}
					else
					{  ?>
					<span class="dotDisplayed">
						<p  style=" background: transparent;">
						
									<i class="fa fa-map" style= "color :#BCDDFD;font-size: 25px;margin:5px;"></i>
						
						<? echo $Parcours1 ?>
					</p>
					</span>
				<?
					}?>

					</td><?
				}?>
			</tr>
		</table>
	<? if ($Parcours == null)
	{?>
		</fieldset>
		<?php include("sponsors2023.php"); ?> 
	<?	
	}?>
<?php
}
else
{
	// si il y a que un départ ;
	$Parcours =$ParcoursTampon;
}
?>

<div id="divPhotos">

</div>
</center>
<script>
	var ArrayPhoto = [];
    let DivPhotos = document.getElementById("divPhotos");
</script>



<form method="get" action="Photos.php" id="FormSendIndfo">
		<input type="hidden" name="DateCourse" id="DateCourse" tabindex="10"  size="60"  value= '<?php echo $_GET["DateCourse"] ?>' />
		<input type="hidden" name="NomCourse" id="FormNomCourse" tabindex="10"  size="60"  value= '<?php echo $_GET["NomCourse"] ?>' />
		<input type="hidden" name="Parcours" id="FormParcours" tabindex="10"  size="60"  value= '<?php echo $Parcours ?>' />

	</form>
<?php
$row = 1;
$start_array = false;
// Afficher la liste des départ Dossier dans la course ;
$pathfolder = 'courses/'.$_GET['NomCourse'].$ANNEE_COURSE.'/info/Photos/'.$Parcours;
// Création de la liste de toutes les Dossier = Depart 
$files1 = scandir($pathfolder);

// Lecture du dossier pour le type de photo
foreach ($files1  as $key => $value) 
{ 
    if ($value != ".." && $value != "..."  && $value != "."  )
    {
   ?>
   <script>
       var Photo= new Object();
	   Photo.Path = <?php echo json_encode($pathfolder . "/".$value ); ?>;
	   ArrayPhoto.push(Photo);
       var ImageEtape = document.createElement('img');
       ImageEtape.src =  <?php echo json_encode($pathfolder . "/".$value ); ?>;
						ImageEtape.className += "imgGalleryPhotos";
                        DivPhotos.append(ImageEtape);
</script>
   <?
    }?>
<?
}

?>
<script>
			function ChangParcours(sParcours)
		{  
			document.getElementById("FormParcours").value =sParcours;
			elmnt = document.getElementById("FormSendIndfo");
			elmnt.submit();
		}

</script>
