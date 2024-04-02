<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="fr" >
   <head>
       <title>Jura Défi Chrono</title>
     <meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
	 <meta name="viewport" content="width=device-width, maximum-scale=1.0, user-scalable=yes">
	 <link rel="stylesheet" media="screen" type="text/css" title="style" href="style.css" />
     <link rel="stylesheet" title="defaut" media="screen" href="style.css" type="text/css"/>
     <link rel="stylesheet" type="text/css" media="screen and (max-width: 480px)" href="style-mobil.css" />
 </head>
<?php include("onglets.php"); ?>
<div id="corps">
<?php include("menu_vertical.php"); 
if ($val ["InscriptionExtern"] )
{
header('Location: formulaireExtern.php');	
}
else if ($today >$val ["Date"] )
{
	header('Location: formulaireEnd.php');
}
else if ( $today > $val ["DATE_END_INSCRIPTION"] )
{
	header('Location: formulaireEnd.php'); 
}?>
<script>
var ArrayCoureurs = [];
var ICounterCoureurs = 0;
	console.log('sdfsdf'); 
</script>
 <h3>
	Inscription  <?php  echo $NOM_COURSE. ' ' . $ANNEE_COURSE ?> 
</h3>
<Fieldset>
<div id="formulaire">

<?php
// Si on est connecté on affiche dans une menu les coureurs de la session
if ( isset($_SESSION['Login']))
{
	$_SESSION['Nbretape'] = $_GET["Nbretape"] ;
	$_SESSION['Course'] = $_GET["nom_course"] ;
	$_SESSION['DateCourse'] = $_GET['date_course'];
?>
	<form method="post" action="ciblePanier.php" name="Formulaire" onload="Choix1Coureur()" >

	<p><label>Coureur :</label><Select   onchange ="ChoixCoureurs(this.form);" name="Coureur"   id="Coureur"/>  	
	<input type="hidden" name="idCoureur" id="idCoureur" />
	<input type="hidden" name="date_course" id="date_course"   value= '<?php echo $_GET['date_course'] ?>' />
	<input type="hidden" name="nom_course" id="nom_course"  value= '<?php echo $_GET["nom_course"] ?>' />
	<input type="hidden" name="Nbretape" id="Nbretape" value= '<?php echo  $_GET["Nbretape"] ?>' />
	<input type="hidden" name="NumCat" id="NumCat" />
	
	<input type="hidden" name="NomCat" id="NomCat" />
	<input type="hidden" name="Nbretape" id="Nbretape" value= '<?php echo  $_GET["Nbretape"] ?>' />
	<a href="admin/membres.php"><img src="admin/images/addCoureur.jpg" width="60px" /></a>
	<h2 id="disc1"> </h2>
		<h2>Vérfier les informations du coureur choisi (Si celle-ci ne sont pas correct veuillez les modifier sur <a href="admin/membres.php">votre profil </a>) </h2>
		<p><label for="nom">Nom *:</label> <input type="text" name="nom" id="nom" tabindex="10"  readonly  /></p>
		<p><label for="prenom">Prénom *:</label>  <input type="text" name="prenom" id="prenom" tabindex="20" readonly /></p>
		<p><label for="mail">Adresse e-mail *:</label> <input type="text" name="email" id="email" tabindex="40" readonly /></p>
		<p><label for="adresse">Adresse *:</label> <input type="text" name="adresse" id="adresse" tabindex="50" readonly /></p>
		<p><label for="npa">NPA *:</label> <input type="text" name="zip" id="zip" tabindex="60" readonly /></p>
		<p><label for="localite">Localité *:</label> <input type="text" name="ville" id="ville"tabindex="70" readonly /></p>
		<p><label for="club">Club:</label> <input type="text" name="club" id="club"tabindex="90" readonly /></p>
		<p><label for="pays">Pays *:</label>  <input type="text" name="pays" id="pays"tabindex="150" readonly /></p>						
		<p><label>Sexe * :</label><Select    onchange ="liste_depart(this.form);" name="sexe"   id="sexe" disabled="true" /> 
			<option value=''>Sélectionner</option>
			<option value='H'>Homme</option>
			<option value='D'>Dame</option>
			
		</select></p>
		<p><label for="date">Année de Naissance:</label> <input   type="number"   min="1900" max="2030"name="date" id="date" onchange ="liste_depart(this.form);" tabindex="200" readonly /></p>
		</br></br>
		<h2>Informations demandé pour votre inscription </h2>
		<p><label for="nom_parcours"onClick="liste_depart();">Parcours : </label><select  onchange ="liste_depart(this.form);"  id="nom_parcours" name="nom_parcours" >
			 <option value=''>Sélectionner</option>
		</select></p>
		<p id="lblDepart"  style="visibility:hidden; display:none"> <label for="nom_depart">Départ :  </label><select   name="nom_depart" id="nom_depart"  ></select></p>
	<p id="lblNomEquipe" style="visibility:hidden; display:none"><label for="NomEquipe">Nom Equipe*:</label> <input type="text" name="NomEquipe" id="NomEquipe" tabindex="10"   /></p>
	<h2 id="disc2" style="visibility:hidden; display:none"> </h2>
	<p  id="lblNomDisc2" style="visibility:hidden; display:none"><label for="NomDisc2" >Nom *:</label> <input type="text" name="NomDisc2" id="NomDisc2" tabindex="200"   /></p>
	<p  id="lblPrenomDisc2" style="visibility:hidden; display:none"><label for="PrenomDisc2">Prénom *:</label>  <input type="text" name="PrenomDisc2" id="PrenomDisc2" tabindex="210"/></p>
	<h2 id="disc3" style="visibility:hidden; display:none"> </h2>		
	<p id="lblNomDisc3" style="visibility:hidden; display:none"><label for="NomDisc3"  >Nom *:</label> <input type="text" name="NomDisc3" id="NomDisc3" tabindex="300"   /></p>
	<p id="lblPrenomDisc3" style="visibility:hidden; display:none"><label for="PrenomDisc3" >Prénom *:</label>  <input type="text" name="PrenomDisc3" id="PrenomDisc3" tabindex="310"/></p>
											
	<p id="lblNbrEtape"  style="visibility:hidden; display:none" ><label for="nbrEtape">Nombre étape *:</label> <select  name="nbrEtape" id="nbrEtapeInsc" tabindex="410"   >
		 <option value=''>Sélectionner</option>
		</select></p>

	
		<p id="lblInformation" style="visibility:hidden; display:none;padding:5px; border-style: solid; border-color: black; font-size:160%;background:#fa8a8a ">Aucune catégorie existe sur ce parcours pour cette année de naissance</p>	
  <p><label for="nom">Prix:</label> <input type="text" name="PrixDepart" id="PrixDepart" tabindex="10"  readonly  /></p>
  <center>
   <input type="button" style="visibility:hidden;height:40px;font-size:160%;"  id="ButtonSend" value="je m'inscris" onclick="check(this.form )" style= " width: 100px; height: 50px";>  </br>
	</br>	</center>	

			</form>						
					<?php
	$sql = 'SELECT * FROM Membres  WHERE LoginCompte=\''.$_SESSION['Login'].'\''; 
	//echo $sql;
	$result = mysqli_query($con,$sql);
$Aff = 0;
 	if ($result && mysqli_num_rows($result) > 0) 
	{
    // output data of each row ?>
	
		<?php
		if (mysqli_num_rows($result) > 1)
		{
		
		?>
			<script>
				var sel = document.getElementById("Coureur");
				sel.options.add( new Option("Sélectionner un coureur", ""));
				ICounterCoureurs++;			
			</script>
			<?php
		}


		while($val = mysqli_fetch_assoc($result)) 
		{
			if ($val ["Valider"])
			{
				$Aff = $Aff+1 ;
		?>
		<script>
		
			var Coureur= new Object();
			Coureur.ID = <?php echo json_encode($val ["ID"]); ?>;
			Coureur.Nom = <?php echo json_encode($val ["Nom"]); ?>;
			Coureur.Prenom = <?php echo json_encode($val ["Prenom"]); ?>;
			Coureur.Mail = <?php echo json_encode($val ["mail"]); ?>;
			Coureur.Adresse = <?php echo json_encode($val ["adresse"]); ?>;
			Coureur.NPA = <?php echo json_encode($val ["npa"]); ?>;
			Coureur.Localite = <?php echo json_encode($val ["localite"]); ?>;
			Coureur.Sexe = <?php echo json_encode($val ["sexe"]); ?>;
			Coureur.Pays = <?php echo json_encode($val ["Pays"]); ?>;
			Coureur.DateNaissance = <?php echo json_encode( date("Y", strtotime($val ["DateNaissance"]))); ?>;
			Coureur.Club = <?php echo json_encode($val ["club"]); ?>;
			ArrayCoureurs.push(Coureur);
			
			var sel = document.getElementById("Coureur");
			sel.options.add( new Option(Coureur.Nom + " "+ Coureur.Prenom, ICounterCoureurs));
			ICounterCoureurs++;
				<?php
		
			if (mysqli_num_rows($result) == 1)
			{?>
				var Coureur= new Object();
				Coureur =	ArrayCoureurs[0];
				document.getElementById("idCoureur").value = Coureur.ID;
				document.getElementById("nom").value = Coureur.Nom;
				document.getElementById("prenom").value = Coureur.Prenom ;
				document.getElementById("email").value = Coureur.Mail ;
				document.getElementById("adresse").value = Coureur.Adresse ;
				document.getElementById("zip").value = Coureur.NPA  ;
				document.getElementById("ville").value = Coureur.Localite ;
				document.getElementById("club").value = Coureur.Club ;
				document.getElementById("pays").value =  Coureur.Pays ;
				document.getElementById("sexe").value = Coureur.Sexe ;
				document.getElementById("date").value = Coureur.DateNaissance ;
				<?php
			}
		?>
			
			
		</script>
		
	
		<?php
				}
			}
			if ($Aff > 0)
			{
				echo "Aucun Coureur validé dans ce compte";
				
			}
		}
		
		else
		{
			echo "Aucun Coureur dans ce compte";
		}
	
	?>								
</div>
 <center>
 les champs avec un * sont obligatoires</br>
 Si vous avez un problème d'inscription veuillez contacter par e-mail </br>
 info@juradefichrono.ch
 </center>
   </Fieldset>
<? 
		
   }
else
{
$Link= "AddLogin.php?Nbretape=".$_GET['Nbretape']."&date_course=".$_GET['date_course']."&nom_course=" .$_GET['nom_course'];
// demande de connection pour inscription
?>
	<h3><i>  Connectez-vous pour vous inscrire ! Pas encore de compte? <b> <a href="<?php echo $Link ?> ">Créer un compte   </a></b></h3>
	<form method="post" action="admin/CibleLogin.php">
	<p><img src="images/ConnectMini.png"  ></p>
	<input type="hidden" name="date_course" id="date_course"   value= '<?php echo $_GET['date_course'] ?>' />
	<input type="hidden" name="nom_course" id="nom_course"  value= '<?php echo $_GET["nom_course"] ?>' />
	<input type="hidden" name="Nbretape" id="Nbretape" value= '<?php echo  $_GET["Nbretape"] ?>' />
	<p ><label for="Login" style="font-size:10px;">e-mail :</label></br> <input type="text" name="login" id="login" tabindex="10" /> </p>
	<p ><label for="password" style="font-size:10px;">Mot de passe :</label></br><input type="password" name="pass" id="pass" tabindex="15" /></p>
	<p><input  name="submit" type="submit"   value="Se connecter"  style= " width: 150px; height: 30px";></p>
	</form>

	<!-- <p><h2>	<a href="AddLogin.php"style="font-size:12px;">Mot de passe oublier? </a></h2></p>-->
	
	<!-- Création Compte et garde en mémoire course -->

	<h3><a href="PasswordForget.php"style="font-size:12px;">Mot de passe oublié </a></h3>

 

  <?php
}

?>
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
		alert("Merci d'indiquer votre prÃ©nom");
		f1.prenom.focus();
		return false;
	}
		if (!isMail(f1.email.value)) {
		alert("Merci d'indiquer un mail valide pour que nous puissions vous rÃ©pondre");
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
		alert("Merci d'indiquer votre dÃ©part");
		f1.nom_depart.focus();
		return false;
	}

	if (f1.nom_parcours.value.length<1) {
		alert("Merci d'indiquer le type de votre parcours");
		f1.nom_parcours.focus();
		return false;
	}
		if (f1.date.value.length!=4) {
		alert("Merci d'indiquer votre annÃ©e de naissance ex: 1988");
		f1.date.focus();
		return false;
	}
		if (f1.sexe.value.length<1) {
		alert("Merci d'indiquer votre sexe");
		f1.sexe.focus();
		return false;
	}
	if (parseInt(f1.Nbretape.value) > 1 && f1.nbrEtapeInsc.value.length<1  ) {
		alert("Merci de choisir une Ã©tape");
		f1.nbrEtapeInsc.focus();
		return false;
	}
	
	f1.submit();
}

function ChoixCoureurs(f)
{
	var Coureur= new Object();
	Coureur =	ArrayCoureurs[f.Coureur.value - 1];
	document.getElementById("idCoureur").value = Coureur.ID;
	document.getElementById("nom").value = Coureur.Nom;
	document.getElementById("prenom").value = Coureur.Prenom ;
	document.getElementById("email").value = Coureur.Mail ;
	document.getElementById("adresse").value = Coureur.Adresse ;
	document.getElementById("zip").value = Coureur.NPA  ;
	document.getElementById("ville").value = Coureur.Localite ;
	document.getElementById("club").value = Coureur.Club ;
	document.getElementById("pays").value =  Coureur.Pays ;
	document.getElementById("sexe").value = Coureur.Sexe ;
	document.getElementById("date").value = Coureur.DateNaissance ;
}

var ArrayParcours = [];

function addValue(Text , Value) 
{
	var sel = document.getElementById("nom_parcours");
	sel.options.add( new Option(Text, Value));
 }

function NbrEtape1() 
{
	var NbrEtape =	parseInt(<?php echo json_encode($Nbr_etape); ?>);
	if (NbrEtape > 1)
	{
		document.getElementById("lblNbrEtape").style.display  = "block" ;
		document.getElementById("lblNbrEtape").style.visibility = "visible" ;
	}
	else
	{
		document.getElementById("lblNbrEtape").style.display  = "none" ;
		document.getElementById("lblNbrEtape").style.visibility = "hidden" ;
	}

	var sel = document.getElementById("nbrEtapeInsc");
	
	for(var iEtape=1; iEtape<=parseInt(<?php echo json_encode($Nbr_etape); ?>); ++iEtape) 
	{
		if (iEtape == 1)
		{
			sel.options.add( new Option(iEtape + " étape", iEtape ));	
		}
		else
		{
			sel.options.add( new Option(iEtape + " étapes",iEtape ));	
		}
	}
}



	
function liste_depart(f) 
{

		document.getElementById("lblNomEquipe").style.display  = "none" ;
	document.getElementById("lblNomDisc2").style.display  = "none" ;
	document.getElementById("lblPrenomDisc2").style.display  = "none" ;
	document.getElementById("lblNomDisc3").style.display  = "none" ;
	document.getElementById("lblPrenomDisc3").style.display  = "none" ;
	document.getElementById("disc1").style.display  = "none" ;
	document.getElementById("disc2").style.display  = "none" ;
	document.getElementById("disc3").style.display  = "none" ;

	document.getElementById("lblNomEquipe").style.visibility = "hidden" ;
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
								sel.options.add( new Option(Cat.nom_cat+" "+Cat.AnneeStart+" - "+Cat.AnneeEnd,  ArrayParcours[intselected].ArrayDepart[Depart].Nom));
								document.getElementById("NomCat").value = Cat.nom_cat ;
								document.getElementById("NumCat").value = Cat.num_cat ;	
								document.getElementById("PrixDepart").value =  ArrayParcours[intselected].ArrayDepart[Depart].PrixInternet ;	
								
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
						
								document.getElementById("lblNomEquipe").style.visibility = "visible" ;
								document.getElementById("disc1").style.visibility = "visible" ;
								
								document.getElementById("lblNomEquipe").style.display  = "block" ;
								document.getElementById("disc1").style.display  = "block" ;
								document.getElementById("disc1").innerHTML = Disc.Nom +" / "+ Disc.Distance +" / "+ Disc.Deniv;
							}
							break;
							case 1:
								document.getElementById("disc2").style.visibility = "visible" ;
								document.getElementById("lblNomDisc2").style.visibility = "visible" ;
								document.getElementById("lblPrenomDisc2").style.visibility = "visible" ;
								
								document.getElementById("disc2").style.display  = "block" ;
								document.getElementById("lblNomDisc2").style.display  = "block" ;
								document.getElementById("lblPrenomDisc2").style.display  = "block" ;
								
								document.getElementById("disc2").innerHTML = Disc.Nom +" / "+ Disc.Distance +" / "+ Disc.Deniv;
							break;
							case 2:
								document.getElementById("disc3").style.visibility = "visible" ;
								document.getElementById("lblNomDisc3").style.visibility = "visible" ;
								document.getElementById("lblPrenomDisc3").style.visibility = "visible" ;
				
								document.getElementById("disc3").style.display  = "block" ;
								document.getElementById("lblNomDisc3").style.display  = "block" ;
								document.getElementById("lblPrenomDisc3").style.display  = "block" ;
								
								document.getElementById("disc3").innerHTML = Disc.Nom +" / "+ Disc.Distance +" / "+ Disc.Deniv;
							break;
							}
							
						}				
					}
				}
				var lblinfo = document.getElementById("lblInformation"); 
				if (ICounterCat == 0)
				{

					// Valeurs incorect pour ce dÃ©part 
					bpSend.style.visibility = "hidden" ;
					sel.style.visibility = "hidden" ;
					document.getElementById('date').style.backgroundColor="#fa8a8a";
					document.getElementById('nom_parcours').style.backgroundColor="#fa8a8a";
					lblinfo.style.visibility = "visible" ;
					lblinfo.style.display  = "block" ;
				 
				// ajoute le noeud texte au nouveau div crÃ©Ã©
				//	Div.value = "Aucune catÃ©gorie existe sur ce parcours pour cette annÃ©e de naissance";
				}
				else 
				{
				bpSend.style.visibility = "visible" ;
					lblinfo.style.visibility = "hidden" ;
					sel.style.visibility = "visible" ;
					lblinfo.style.display  = "none" ;
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
				alert("Merci d'indiquer votre annÃ©e de naissance ex: 1988");
				f.date.focus();
			}
		}
	}
	else
	{
		sel.style.visibility = "hidden" ;
	}

	if (sel.style.visibility == "visible")
	{
		sel.style.display  = "block" ;
		lbl.style.display  = "block" ;
	}
	lbl.style.visibility =	sel.style.visibility;
}
</script>
		<!--- Liste des parcours !---->
		<?php

		// Afficher la liste des Parcours  Dossier dans la course ;
		$pathfolder = 'courses/'.$_GET['nom_course'].$ANNEE_COURSE;
		// CrÃ©ation de la liste de toutes les Dossier = Parcours 
		$files1 = scandir($pathfolder);
		
		// Liste des ficbier 
		foreach ($files1  as $key => $Parcours) 
		{ 
			if(is_dir($pathfolder .'/'.$Parcours))
			{
				// Affichage dans la liste des dÃ©part dans le menu 
				if (strlen($Parcours) >2 && $Parcours != "info") 
				{	

				?>	
				<script>
					var Parcours= new Object();
					
					Parcours.nom=<?php echo json_encode($Parcours); ?>;

					var ArrayDepart = [];
				</script>
				<?php
					//<!--- Liste des DÃ©part !---->
					// Afficher la liste des Parcours  Dossier dans la course ;
					$pathfolderDepart = 'courses/'.$_GET['nom_course'].$ANNEE_COURSE. '/'.$Parcours;
					// CrÃ©ation de la liste de toutes les Dossier = Depart 
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
												Depart.PrixInternet= parseInt(<?php echo json_encode($datatxt[2]); ?>);
												Depart.PrixPlace= parseInt(<?php echo json_encode($datatxt[3]); ?>);
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
								$pathFileCat = 'courses/'.$_GET['nom_course'].$ANNEE_COURSE.'/'.$Parcours.'/'.$depart.'/cat.csv';?>
								<Script>
									var ArrayCat = [];
								</script><?php
								if (($handle = fopen($pathFileCat, "r")) !== FALSE) 
								{
									while (($data = fgetcsv($handle, 1000, ";")) !== FALSE) 
									{ ?>
										<script>
											var Categorie= new Object();
									
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
								console.log(Depart); 
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
		 <?php include("sponsors.php"); ?> 
		</div>

</body>
</html>