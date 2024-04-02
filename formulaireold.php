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
function isMail(txtMail) {
	var regMail=new RegExp("^[0-9a-z._-]+@{1}[0-9a-z. -]{2,}[.]{1}[a-z]{2,5}$", "i");
	return regMail.test(txtMail);
}
function liste_depart() {
var x = document.getElementById("categorie");
var option = document.createElement("option");
location.reload(true)
}
function reload(f) {
	if (f.nom_parcours.value.length>0) 
	{
		if (f.date.value.length==4)
		{
			  if (f.sexe.value.length>0)
			 {
		
				f.submit();
	
			}
		
		}
		else
		{
			if (f.date.value.length>1)
			{
				alert("Merci d'indiquer votre année de naissance ex: 1988");
				f.date.focus();
				return false;
			}
		}
	}

}


function check(f1) {

	if (f1.nom.value.length<3) {
		alert("Merci d'indiquer votre nom");
		f1.nom.focus();
		return false;
	}

		if (f1.prenom.value.length<3) {
		alert("Merci d'indiquer votre prénom");
		f1.prenom.focus();
		return false;
	}
		if (!isMail(f1.email.value)) {
		alert("Merci d'indiquer un mail valide pour que nous puissions vous répondre");
		f1.email.focus();
		return false;
	}
		if (f1.zip.value.length<4) {
		alert("Merci d'indiquer votre npa");
		f1.zip.focus();
		return false;
	}
			if (f1.ville.value.length<3) {
		alert("Merci d'indiquer votre localite");
		f1.ville.focus();
		return false;
	}


		if (f1.nom_depart.value.length<1) {
		alert("Merci d'indiquer votre départ");
		f1.nom_depart.focus();
		return false;
	}


	if (f1.nom_parcours.value.length<1) {
		alert("Merci d'indiquer le type de votre parcours");
		f1.nom_parcours.focus();
		return false;
	}
		if (f1.date.value.length!=4) {
		alert("Merci d'indiquer votre année de naissance ex: 1988");
		f1.date.focus();
		return false;
	}

		if (f1.sexe.value.length<1) {
		alert("Merci d'indiquer votre sexe");
		f1.sexe.focus();
		return false;
	}

	
	
	
	if (confirm("Etes-vous sur des informations de votre inscriptions?")) {
	f1.submit();
	}
	
	
	
}
</script>
   <body>
   
  <?php include("onglets.php"); ?>
 
<div id="corps">
<?php include("menu_vertical.php"); ?>

 <?php
 if ($today >$val ["Date"] )
{
header('Location: formulaireEnd.php');
 }
else if ( $today > $val ["DATE_END_INSCRIPTION"] )
{
header('Location: formulaireEnd.php'); 
}
?>
 


	 <h3>
Inscriptions  <?php  echo $NOM_COURSE. ' ' . $ANNEE_COURSE ?>
   </h3>
   <Fieldset>
   <div id="formulaire">
   <form method="get" action="formulaire.php">
		<input type="hidden" name="date_course" id="date_course"   value= '<?php echo $_GET['date_course'] ?>' />
		<input type="hidden" name="etape" id="etape" value= '<?php echo $_GET["etape"] ?>' />
		<input type="hidden" name="nom_course" id="nom_course"  value= '<?php echo $_GET["nom_course"] ?>' />
		<input type="hidden" name="Nbretape" id="Nbretape" value= '<?php echo  $_GET["Nbretape"] ?>' />
		<?php if ($_GET["sexe"] == 'D')
		{
		$Sexe = 'Dame';
		}
		else if ($_GET["sexe"] == 'H')
		{
		$Sexe = 'Homme';
		}
	
		
		?>
		
		<p><label>Sexe * :</label><Select    onchange ="reload(this.form);" name="sexe"   id="sexe"/> 
		<?php if (strlen($_GET["sexe"]) ==0)
		{?>
		<option value=''>Sélectionner</option>
		<?php
		}
		else
		{ ?>
			<option value='<?php echo $_GET["sexe"] ?>'><?php  echo $Sexe ?></option>
		<?php
		}
		?>
      <option value='H'>Homme</option>
	  <option value='D'>Dame</option>
	  </select></p>
	  
	  <p><label for="date">Année de Naissance:</label> <input   type="number"   min="1900" max="2030"  name="date" id="date"  onchange ="reload(this.form);" tabindex="2"value='<?php echo $_GET["date"] ?>' /></p>
   		<!--- Liste des parcours !---->
		<?php
		// Afficher la liste des Parcours  Dossier dans la course ;
		$pathfolder = 'courses/'.$_GET['nom_course'].$ANNEE_COURSE;
		// Création de la liste de toutes les Dossier = Parcours 
		$files1 = scandir($pathfolder);
		?>
		<p> <label for="nom_parcours"onClick="liste_depart();">Parcours :   		</label><select  onchange ="reload(this.form);"  name="nom_parcours" >
		<?php if (strlen($_GET["nom_parcours"]) ==0)
		{ ?>
		<option value=''>Sélectionner</option>
		<?php
		}
		else
		{?>
		<option value='<?php echo $_GET["nom_parcours"] ?>'><?php echo $_GET["nom_parcours"] ?></option>
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
		</select>
		</form>
	
      	<!--- Liste des Départ !---->
		<?php
		 if (strlen($_GET["nom_parcours"]) >0 &&strlen($_GET["date"]) >0  )
		{
			// Afficher la liste des Parcours  Dossier dans la course ;
			$pathfolder = 'courses/'.$_GET['nom_course'].$ANNEE_COURSE. '/'.$_GET["nom_parcours"];
			// Création de la liste de toutes les Dossier = Depart 
			$files1 = scandir($pathfolder);
			?>
			 <form method="get" action="formulaire.php">
			
			<p> <label for="nom_depart">Départ :  </label><select   name="nom_depart"  onchange ="reload(this.form);" >
			<?php if (strlen($_GET["nom_depart"]) ==0)
		{ ?>
		<option value=''>Choisir un départ</option>
		<?php
		}
		else
		{

								
		// Nom Départ  -1
		$num_depart =  strpos($_GET["nom_depart"], ';');
		$Nom_depart = substr($_GET["nom_depart"],0, $num_depart);  // retourne "cde"

		// Numéro de la catégorie 0
		$str_tampon = substr($_GET["nom_depart"], $num_depart+1, strlen($_GET["nom_depart"]) );
		$num_depart =  strpos($str_tampon , ';');
		$Num_cat = substr($str_tampon,0, $num_depart);
		
		// Nom de la catégorie 1
		$str_tampon = substr($str_tampon, $num_depart+1, strlen($str_tampon) );
		$num_depart =  strpos($str_tampon , ';');
		$Nom_cat = substr($str_tampon,0, $num_depart);
		  
		
		// 5 Annee annee
		$str_tampon = substr($str_tampon, $num_depart+1, strlen($str_tampon) );
 		$num_depart =  strpos($str_tampon , ';');
		$Annee_start = substr($str_tampon,0, $num_depart);
		
		// 5 Annee end
		$str_tampon = substr($str_tampon, $num_depart+1, strlen($str_tampon) );
 		$num_depart =  strpos($str_tampon , ';');
		$Annee_end = substr($str_tampon,0, $num_depart);

								?>
		<option value='<?php echo $_GET["nom_depart"] ?>'><?php echo  $Nom_cat.' '.$Annee_start.' - '.$Annee_end  ?></option>
		<?php
		}
			
			foreach ($files1  as $key => $value) 
			{ 
				if(is_dir($pathfolder .'/'.$value))
				{
					// Affichage dans la liste des départ dans le menu 
					if (strlen($value) >2) 
					{
					// Lecture du fichier CAT.csv 	
						$pathFile = 'courses/'.$_GET['nom_course'].$ANNEE_COURSE.'/'.$_GET['nom_parcours'].'/'.$_GET['nom_depart'].'/'.$value.'/cat.csv';
						if (($handle = fopen($pathFile, "r")) !== FALSE) {
							while (($data = fgetcsv($handle, 1000, ";")) !== FALSE) {
								$num = count($data);
								$num_cat =	$data[0];						
								$nom_cat = $data[1];
								$sexe = $data[4];
								$annee_start = intval($data[5]);
								$annee_end = intval($data[6]);

								if (($sexe == 'M' ||$sexe == $_GET["sexe"] ) &&  (  intval($_GET["date"] >= $annee_start )) && (intval($_GET["date"])<=  $annee_end ))
								{ ?> 
									<option value='<?php echo $value .';'.$data[0].';'. $data[1].';' .$data[5].';'.$data[6].';'?>'/><?php echo $data[1].' '.$data[5].' - '.$data[6]?></option>;
								<?php }
								 
							}
						}
					}
				}
			}
					?>
						</select>
		</p>
						<input type="hidden" name="date_course" id="date_course"    value= '<?php echo $_GET["date_course"] ?>' />
						<input type="hidden" name="etape" id="etape" value= '<?php echo $_GET["etape"] ?>' />
						<input type="hidden" name="sexe" id="sexe"     value= '<?php echo $_GET["sexe"] ?>' />
						<input type="hidden" name="date" id="date"  size="60"  value= '<?php echo $_GET["date"] ?>' />
						<input type="hidden" name="nom_course" id="nom_course"    value= '<?php echo $_GET["nom_course"] ?>' />
						<input type="hidden" name="nom_parcours" id="nom_parcours"  value= '<?php echo $_GET["nom_parcours"] ?>' />
						<input type="hidden" name="Nbretape" id="Nbretape" value= '<?php echo  $_GET["Nbretape"] ?>' />
					</form>
					
					<?php
		}
		 if (strlen($_GET["nom_depart"]) >0 &&strlen($_GET["date"]) >0  )
		{?>
				<form method="post" action="cible.php" name="Formulaire">
				<input type="hidden" name="date_course" id="date_course"    value= '<?php echo $_GET["date_course"] ?>' />
				<input type="hidden" name="etape" id="etape" value= '<?php echo $_GET["etape"] ?>' />
				<input type="hidden" name="sexe" id="sexe"     value= '<?php echo $_GET["sexe"] ?>' />
				<input type="hidden" name="date" id="date"  size="60"  value= '<?php echo $_GET["date"] ?>' />
				<input type="hidden" name="nom_course" id="nom_course"    value= '<?php echo $_GET["nom_course"] ?>' />
				<input type="hidden" name="nom_parcours" id="nom_parcours"  value= '<?php echo $_GET["nom_parcours"] ?>' />
				<input type="hidden" name="Nbretape" id="Nbretape" value= '<?php echo  $_GET["Nbretape"] ?>' />				
				<input type="hidden" name="nom_depart" id="nom_depart" value= '<?php echo  $_GET["nom_depart"] ?>' />				
					<?php
					
				// Lecture du fichier info.txt 	 
						$pathFileInfo = 'courses/'.$_GET['nom_course'].$ANNEE_COURSE.'/'.$_GET['nom_parcours'].'/'.$Nom_depart.'/info.txt';
						if (file_exists($pathFileInfo)) {
								if (($handle = fopen($pathFileInfo, "r")) !== FALSE) {
								$cmpt =0;
								
								while (($datatxt = fgetcsv($handle, 1000, ";")) !== FALSE) {
								$cmptDiscipline =0;
										$cmpt++; 
										// Lecture Ligne 1
										 if( $cmpt==1)
											{
												$HeureStart = $datatxt[1] ;
												$PrixInternet = $datatxt[2];
										}
										 // Lecture Ligne 2 
										else if( $cmpt==2)
										{
											$NbrDiscipline = intval($datatxt[1]);
										}
										// ligne Suivante
										else if( $cmpt>2)
										{
											if ($CmptDiscipline == 0)
											{
												if ($NbrDiscipline > 1 && $cmptDiscipline < $NbrDiscipline )
												{
												?>
												<p><label for="NomEquipe">Nom Equipe*:</label> <input type="text" name="NomEquipe" id="NomEquipe" tabindex="10"   /></p>
												<h2>   <?php echo $datatxt[1]?> </h2>
											<?php } ?>
											  
										
											<p><label for="nom">Nom *:</label> <input type="text" name="nom" id="nom" tabindex="10"   /></p>
											<p><label for="prenom">Prénom *:</label>  <input type="text" name="prenom" id="prenom" tabindex="20"/></p>
										   <p><label for="mail">Adresse e-mail *:</label> <input type="text" name="email" id="email" tabindex="40"/></p>
										   <p><label for="adresse">adresse *:</label> <input type="text" name="adresse" id="adresse" tabindex="50"/></p>
											<p><label for="npa">NPA *:</label> <input type="text" name="zip" id="zip" tabindex="60"/></p>
											<p><label for="localite">Localité *:</label> <input type="text" name="ville" id="ville"tabindex="70"/></p>
											<p><label for="club">Club:</label> <input type="text" name="club" id="club"tabindex="90"/></p>
											<p><label for="pays">Pays *:</label>  <input type="text" name="pays" id="pays"tabindex="150"/></p>
											
											<?php $Nbr_etape = intval ($val ["nbr_etape"]); 
											
											if ( $Nbr_etape > 1 )
											{
											?>
											<p><label for="nbrEtape">Nombre étape *:</label> <input type="text" name="nbrEtape" id="nbrEtape" tabindex="10"   /></p>
											<?php
											}
											
											?>
											
								

											<?php
											}
											if ($NbrDiscipline > 1 && $cmptDiscipline < $NbrDiscipline )
											{
												if ($CmptDiscipline == 1)
												{?>
												<h2>   <?php echo $datatxt[1]?> </h2>
												<p><label for="NomDisc2">Nom *:</label> <input type="text" name="NomDisc2" id="NomDisc2" tabindex="200"   /></p>
												<p><label for="PrenomDisc2">Prénom *:</label>  <input type="text" name="PrenomDisc2" id="PrenomDisc2" tabindex="210"/></p>
											
											<?php }
											
												else if ($CmptDiscipline == 2)
												{?>
												<h2>   <?php echo $datatxt[1]?> </h2>
												<p><label for="NomDisc3">Nom *:</label> <input type="text" name="NomDisc3" id="NomDisc3" tabindex="200"   /></p>
												<p><label for="PrenomDisc3">Prénom *:</label>  <input type="text" name="PrenomDisc3" id="PrenomDisc3" tabindex="210"/></p>
											
											<?php }
											
											}
											$CmptDiscipline++ ;
										}
								
									}
									
								}
				
			}
			else
			{
				
				echo 'Error File info'. $pathFileInfo ;
			}
		
		?>
    <input type="button" value="Envoyer" onclick="check(this.form)" style= " width: 100px; height: 50px";>  </br>
			</form>						
											

	   <?php } ?>
</div>
 les champs avec un * sont obligatoires</br>
 Si vous avez un problème d'inscriptions veuillez contacter par e-mail </br>
 info@juradefichrono.ch
 </center>
   </Fieldset>

 <?php include("sponsors.php"); ?>
</div>
  
    </body>
</html>


 





