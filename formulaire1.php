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
 
   
  <?php include("onglets.php"); ?>
 
<div id="corps">
<?php include("menu_vertical.php"); 

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
		<form method="post" action="cible.php" name="Formulaire">
	<input type="hidden" name="date_course" id="date_course"   value= '<?php echo $_GET['date_course'] ?>' />
	<input type="hidden" name="nom_course" id="nom_course"  value= '<?php echo $_GET["nom_course"] ?>' />
	<input type="hidden" name="Nbretape" id="Nbretape" value= '<?php echo  $_GET["Nbretape"] ?>' />
<h2 id="disc1"> </h2>
	<p><label for="nom">Nom *:</label> <input type="text" name="nom" id="nom" tabindex="10"   /></p>
	<p><label for="prenom">Prénom *:</label>  <input type="text" name="prenom" id="prenom" tabindex="20"/></p>
	<p><label for="mail">Adresse e-mail *:</label> <input type="text" name="email" id="email" tabindex="40"/></p>
	<p><label for="adresse">adresse *:</label> <input type="text" name="adresse" id="adresse" tabindex="50"/></p>
	<p><label for="npa">NPA *:</label> <input type="text" name="zip" id="zip" tabindex="60"/></p>
	<p><label for="localite">Localité *:</label> <input type="text" name="ville" id="ville"tabindex="70"/></p>
	<p><label for="club">Club:</label> <input type="text" name="club" id="club"tabindex="90"/></p>
	<p><label for="pays">Pays *:</label>  <input type="text" name="pays" id="pays"tabindex="150"/></p>						
	<p><label>Sexe * :</label><Select    onchange ="liste_depart(this.form);" name="sexe"   id="sexe"/> 
	    <option value=''>Sélectionner</option>
		<option value='H'>Homme</option>
		<option value='D'>Dame</option>
		
	</select></p>
	<p><label for="date">Année de Naissance:</label> <input   type="number"   min="1900" max="2030"name="date" id="date" onchange ="liste_depart(this.form);" tabindex="200" /></p>
	<p><label for="nom_parcours"onClick="liste_depart();">Parcours : </label><select  onchange ="liste_depart(this.form);"  id="nom_parcours" name="nom_parcours" >
		 <option value=''>Sélectionner</option>
	</select></p>
		<p id="lblDepart"  style="visibility:hidden"> <label for="nom_depart">Départ :  </label><select   name="nom_depart" id="nom_depart" onchange ="liste_depart(this.form);" ></select></p>
	<h2 id="disc2" style="visibility:hidden"> </h2>
	<p  id="lblNomDisc2" style="visibility:hidden"><label for="NomDisc2" >Nom *:</label> <input type="text" name="NomDisc2" id="NomDisc2" tabindex="200"   /></p>
	<p  id="lblPrenomDisc2" style="visibility:hidden"><label for="PrenomDisc2">Prénom *:</label>  <input type="text" name="PrenomDisc2" id="PrenomDisc2" tabindex="210"/></p>
	<h2 id="disc3" style="visibility:hidden"> </h2>		
	<p id="lblNomDisc3" style="visibility:hidden"><label for="NomDisc3"  >Nom *:</label> <input type="text" name="NomDisc3" id="NomDisc3" tabindex="200"   /></p>
	<p id="lblPrenomDisc3" style="visibility:hidden"><label for="PrenomDisc3" >Prénom *:</label>  <input type="text" name="PrenomDisc3" id="PrenomDisc3" tabindex="210"/></p>
											



<?php $Nbr_etape = intval ($val ["nbr_etape"]); 
											
	if ( $Nbr_etape > 1 )
	{
			?>
	<p><label for="nbrEtape">Nombre étape *:</label> <select  name="nbrEtape" id="nbrEtape" tabindex="10"   >
		 <option value=''>Sélectionner</option>
		</select></p>
		<?php
	}
											
?>
	
		<p id="lblInformation" style="visibility:hidden;padding:5px; border-style: solid; border-color: black; font-size:160%;background:#fa8a8a ">Aucune catégorie existe sur ce parcours pour cette année de naissance</p>	
   <center>
   <input type="button" style="visibility:hidden;height:40px;font-size:160%;"  id="ButtonSend" value="je m'inscris" onclick="check(this.form)" style= " width: 100px; height: 50px";>  </br>
	</br>	</center>	
			</form>						
											
</div>
 <center>
 les champs avec un * sont obligatoires</br>
  le paiement s'éffecture lors du retrait du dossard</br>
 Si vous avez un problème d'inscriptions veuillez contacter par e-mail </br>
 info@juradefichrono.ch
 </center>
   </Fieldset>
<script>
function isMail(txtMail)
{
	var regMail=new RegExp("^[0-9a-z._-]+@{1}[0-9a-z. -]{2,}[.]{1}[a-z]{2,5}$", "i");
	return regMail.test(txtMail);
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

var ArrayParcours = [];
function addValue(Text , Value) 
{
	var sel = document.getElementById("nom_parcours");
	sel.options.add( new Option(Text, Value));
 }

function NbrEtape1() {
	var sel = document.getElementById("nbrEtape");
	
	for(var iEtape=1; iEtape<=parseInt(<?php echo json_encode($Nbr_etape); ?>); ++iEtape) 
	{
		 sel.options.add( new Option(iEtape,iEtape));	
	}

	}
	
function liste_depart(f) {
	document.getElementById("lblNomDisc2").style.visibility = "hidden" ;
	document.getElementById("lblPrenomDisc2").style.visibility = "hidden" ;
	document.getElementById("lblNomDisc3").style.visibility = "hidden" ;
	document.getElementById("lblPrenomDisc3").style.visibility = "hidden" ;
	document.getElementById("disc1").style.visibility = "hidden" ;
	document.getElementById("disc2").style.visibility = "hidden" ;
	document.getElementById("disc3").style.visibility = "hidden" ;
	var sel = document.getElementById("nom_depart");
		var lbl = document.getElementById("lblDepart");
		var bpSend = document.getElementById("ButtonSend");
			var ICounterCat = 0;
	if (f.nom_parcours.value.length>0) 
	{
		if (f.date.value.length==4)
		{
			if (f.sexe.value.length>0)
			{
				var intselected = document.getElementById("nom_parcours").selectedIndex-1;
				sel.options.length = 0;
				if (typeof ArrayParcours[intselected].ArrayDepart != "undefined")
				{
					var nbrDepart = ArrayParcours[intselected].ArrayDepart.length;

					for(var Depart=0; Depart<nbrDepart; ++Depart) 
					{
						var NbrCat = ArrayParcours[intselected].ArrayDepart[Depart].ArrayCat.length;
			
						for(var iCategorie=0; iCategorie<NbrCat; ++iCategorie) 
						{	
							var Cat = new Object();
							Cat = ArrayParcours[intselected].ArrayDepart[Depart].ArrayCat[iCategorie];
							if ((Cat.sexe == "M" ||f.sexe.value == Cat.sexe ) &&  (  parseInt(f.date.value) >= Cat.AnneeStart ) && (parseInt(f.date.value)<=  Cat.AnneeEnd ))
							{
								// sel.options.add( new Option(Cat.nom_cat+" "+Cat.AnneeStart+" - "+Cat.AnneeEnd, Cat.nom_cat+" "+Cat.AnneeStart+" - "+Cat.AnneeEnd);
							 sel.options.add( new Option(Cat.nom_cat+" "+Cat.AnneeStart+" - "+Cat.AnneeEnd, Cat.nom_cat+" "+Cat.AnneeStart+" - "+Cat.AnneeEnd));		
								ICounterCat++;
							}

						}
						var NbrDiscipline = ArrayParcours[intselected].ArrayDepart[Depart].NbrDiscipline;

						for(var iDiscipline=0; iDiscipline<NbrDiscipline; ++iDiscipline) 
						{
							Disc = new Object();
							Disc =	ArrayParcours[intselected].ArrayDepart[Depart].ArrayDiscipline[iDiscipline];
							switch(iDiscipline) {
							case 0:
							if (NbrDiscipline > 1)
							{
								document.getElementById("disc1").style.visibility = "visible" ;
								document.getElementById("disc1").innerHTML = Disc.Nom +" / "+ Disc.Distance +" / "+ Disc.Deniv;
							}
							break;
							case 1:
								document.getElementById("disc2").style.visibility = "visible" ;
								document.getElementById("lblNomDisc2").style.visibility = "visible" ;
								document.getElementById("lblPrenomDisc2").style.visibility = "visible" ;
								document.getElementById("disc2").innerHTML = Disc.Nom +" / "+ Disc.Distance +" / "+ Disc.Deniv;
							break;
							case 2:
								document.getElementById("disc3").style.visibility = "visible" ;
								document.getElementById("lblNomDisc3").style.visibility = "visible" ;
								document.getElementById("lblPrenomDisc3").style.visibility = "visible" ;
								document.getElementById("disc3").innerHTML = Disc.Nom +" / "+ Disc.Distance +" / "+ Disc.Deniv;
							break;
							}
							
						}				
					}
				}
				var lblinfo = document.getElementById("lblInformation"); 
				if (ICounterCat == 0)
				{

				// Valeurs incorect pour ce départ 
				bpSend.style.visibility = "hidden" ;
					sel.style.visibility = "hidden" ;
					document.getElementById('date').style.backgroundColor="#fa8a8a";
					document.getElementById('nom_parcours').style.backgroundColor="#fa8a8a";
					lblinfo.style.visibility = "visible" ;

				 
				// ajoute le noeud texte au nouveau div créé
				//	Div.value = "Aucune catégorie existe sur ce parcours pour cette année de naissance";
				}
				else 
				{
				bpSend.style.visibility = "visible" ;
					lblinfo.style.visibility = "hidden" ;
					sel.style.visibility = "visible" ;
					
					document.getElementById('date').style.backgroundColor="white";
					document.getElementById('nom_parcours').style.backgroundColor="white";
				}
				
				if (ICounterCat >1)
				{
					sel.ReadOnly = false;
				}
				else
				{
					sel.ReadOnly = true;
				}
			}
			else
			{
				sel.style.visibility = "hidden" ;
			}
		}
		else
		{
			sel.style.visibility = "hidden" ;
			if (f.date.value.length>1)
			{
				alert("Merci d'indiquer votre année de naissance ex: 1988");
				f.date.focus();
			}
		}
	}
	else
	{
		sel.style.visibility = "hidden" ;
	}


	lbl.style.visibility =	sel.style.visibility;
}
</script>
		<!--- Liste des parcours !---->
		<?php

		// Afficher la liste des Parcours  Dossier dans la course ;
		$pathfolder = 'courses/'.$_GET['nom_course'].$ANNEE_COURSE;
		// Création de la liste de toutes les Dossier = Parcours 
		$files1 = scandir($pathfolder);
	// Liste des ficbier 
		foreach ($files1  as $key => $Parcours) 
		{ 
			if(is_dir($pathfolder .'/'.$Parcours))
			{
				// Affichage dans la liste des départ dans le menu 
				if (strlen($Parcours) >2 && $Parcours != "info") 
				{	

				?>	
				<script>
					var Parcours= new Object();
					Parcours.nom=<?php echo json_encode($Parcours); ?>;

					var ArrayCat = [];
					var ArrayDepart = [];
				</script>
				<?php
					//<!--- Liste des Départ !---->
					// Afficher la liste des Parcours  Dossier dans la course ;
					$pathfolderDepart = 'courses/'.$_GET['nom_course'].$ANNEE_COURSE. '/'.$Parcours;
					// Création de la liste de toutes les Dossier = Depart 
					$filesDepart = scandir($pathfolderDepart);

					foreach ($filesDepart  as $key => $depart) 
					{ 
						if(is_dir($pathfolderDepart .'/'.$depart) )
						{
							if (strlen($depart) >2)
							{
							?>
								<script>
									var ArrayDiscipline = [];
									var Depart= new Object();
									Depart.Nom = <?php echo json_encode($depart); ?>;
								</script>
								<?php
									// Lecture du fichier info.txt 	
								$pathFileInfo = 'courses/'.$_GET['nom_course'].$ANNEE_COURSE.'/'.$Parcours.'/'.$depart.'/info.txt';
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
											{?>
											<script>
												Depart.HeureStart=<?php echo json_encode($datatxt[1]); ?>;
												Depart.PrixInternet=<?php echo json_encode($datatxt[2]); ?>;
												Depart.PrixPlace=<?php echo json_encode($datatxt[3]); ?>;
												Depart.Distance=<?php echo json_encode($datatxt[4]); ?>;
											</script>
											<?php
											}
											// Lecture Ligne 2 
											else if( $cmpt==2)
											{
												$NbrDiscipline =intval($datatxt[1]);
												?>
												<script>
													Depart.NbrDiscipline=<?php echo json_encode(intval($datatxt[1])); ?>;
												</script>
												<?php
											}
											else if( $cmpt>2)
											{	?>
											<script>
											var Discpline = new Object();
											 Discpline.Nom = <?php echo json_encode($datatxt[1]); ?>;
											 Discpline.Distance = <?php echo json_encode($datatxt[2]); ?>;
											 Discpline.Deniv = <?php echo json_encode($datatxt[3]); ?>;
											 ArrayDiscipline.push(Discpline);
											</script>
											<?php
											}
										}
									}
								}
								/******************* CATEGORIE *************************/
								// Lecture du fichier CAT.csv 	
								$pathFileCat = 'courses/'.$_GET['nom_course'].$ANNEE_COURSE.'/'.$Parcours.'/'.$depart.'/cat.csv';
								if (($handle = fopen($pathFileCat, "r")) !== FALSE) 
								{
									while (($data = fgetcsv($handle, 1000, ";")) !== FALSE) 
									{ ?>
										<script>
											var Categorie= new Object();
											Categorie.num = <?php echo json_encode(count($data)); ?>;
											Categorie.num_cat =	<?php echo json_encode($data[0]); ?>;				
											Categorie.nom_cat = <?php echo json_encode($data[1]); ?>;
											Categorie.sexe = <?php echo json_encode($data[4]); ?>;
											Categorie.AnneeStart = <?php echo json_encode(intval($data[5])); ?>;
											Categorie.AnneeEnd = <?php echo json_encode(intval($data[6])); ?>;
											ArrayCat.push(Categorie);
											
										</script>
									<?php
									}
									?>
									<script>
										Depart.ArrayCat = ArrayCat;
										Depart.ArrayDiscipline = ArrayDiscipline;
									</script>
									<?php
								}	
								?>
						<script>
						
							ArrayDepart.push(Depart);
						</script><?php
						}
						}	
					}?>
					<script>
						Parcours.ArrayDepart =ArrayDepart;
					
						ArrayParcours.push(Parcours);
					</script><?php
				}
			}
		}
		?>
		<script>
		for(var Parcours=0; Parcours<ArrayParcours.length; ++Parcours) 
		{
			if (typeof ArrayParcours[Parcours].ArrayDepart != "undefined")
			{
				addValue(ArrayParcours[Parcours].nom +" "+ ArrayParcours[Parcours].ArrayDepart[0].Distance, ArrayParcours[Parcours].nom) ;
			}
			else
			{
				document.write("Contacter marcbaume12@gmail.com");
			}
		}
		NbrEtape1();
		</script>
		
		