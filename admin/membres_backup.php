﻿<!DOCTYPE html>
<html>
<head>
	<meta property="og:description" content="chronométrage, chrono, jura, franches-montagnes, Jura défi, course à pied, Sport, Jura défi chrono" />  
	<title>Défi Chrono</title>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, maximum-scale=1.0, user-scalable=yes">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css">
	<link rel="stylesheet" title="defaut" media="screen" href="../styleV2.css" type="text/css"/>
<!--	<link rel="stylesheet" type="text/css" media="screen and (max-width: 480px)" href="style-mobilV2.css" /> -->
</head>

    <body>

<?php
  include("HeaderAdmin.php"); 
  ?>
</br>
<?	include("MenuMember.php"); ?>
<div id="corps">
<div id="index">
<img src="../images/FilRougeInscription3.png" style="width: 100%" >
	<table  style="float:left;width:80%;">
	<tr>
	<td><H2> Profil de : <?php echo $_SESSION['Login']; 	?> </h2> </td>
	</tr>
	<?php
	if ( strlen($_SESSION['DateCourse'])> 0  && strlen($_SESSION['Course'])>0)
	{
	?>
	<tr name="PCoureurValid" id="PCoureurValid" style="visibility:hidden;">
		<td>
		<i style="font-size:120%" > Maintenant que votre profil est terminé, vous pouvez inscrire  les coureurs validés aux différentes courses.</i>
		</br>
		</br>
		<form method="get" action="../formulaireV3.php">
			<input type="hidden" name="DateCourse" id="DateCourse"   value= '<?php echo $_SESSION['DateCourse'] ?>' />
			<input type="hidden" name="NomCourse" id="NomCourse"  value= '<?php echo $_SESSION['Course']?>' />
			<input type="hidden" name="Nbretape" id="Nbretape" value= '<?php echo  $_SESSION['Nbretape'] ?>' />
			<input type="submit" value="Retourné au inscription de  <?php echo $_SESSION['Course'] ?>"  style= "padding: 10px ;height: 60px; font-size:120%"> 
		 </form>
		 </br>
		</br>
		</td>
	</tr>
	<?php
	}
	?>
	</table>
	<form method="get" action ="AddMembres.php">
		
			<button style="float:right; margin-right :10px;"  type ="button"  onClick="addForm(this.form)"  title="AJoutMembre" data-toggle="tooltip" data-placement="right"  ><img src="images/addCoureur.jpg"  width="80"></button>
		
	</form>
 </Br>
 </Br>
   <?php
	$con = mysqli_connect('dxvv.myd.infomaniak.com', 'dxvv_christopheJ', 'er3z4aet1234');
	if (!$con)
	{
		die('Could not connect: ' . mysql_error());
	}
	else
	{
		mysqli_select_db($con ,'dxvv_jurachrono' );
		// Create table de donnée du nom de parcours
		mysqli_select_db($con,$row['Database']);

		$sql = 'SELECT * FROM Membres  WHERE LoginCompte=\''.$_SESSION['Login'].'\''; 

		//echo $sql;
		$result = mysqli_query($con,$sql);
 
		if ($result && mysqli_num_rows($result) > 0) 
		{
			// output data of each row
			while($val = mysqli_fetch_assoc($result)) 
			{
				$c++?> 
				<div id="formulaire">
				<Fieldset>
				<h2>Coureur <?php echo $c ?>
				
				<?php 
				if ($val['Valider'])
				{
				$CmptValider++?>
				
		<p id="lblInformation" style=" display:block;padding:5px; border-style: solid; border-color: black; font-size:100%;background:#00fa8c ">Le profil de votre coureur est validé</p>	
				
				<?}
				else
				{?>
					<p id="lblInformation" style="display:block;padding:5px; border-style: solid; border-color: black; font-size:100%;background:#fa8a8a ">les informations du coureur n'ont pas encore été validées</p>	
				
			<?php	}
?>

				</h2>
				<form method="post" action="ModificationMembres.php" name = '<?php echo "form".$val ['ID'] ?>' >
				<input type="hidden" name="ID" id="ID"   value= '<?php echo $val ['ID'] ?>' />
				<p><label style="vertical-alignement: center" for="nom">Nom *:</label> <input type="text" name="nom" id="nom" tabindex="10"  value= "<?php echo   $val ['Nom'] ?>"  /></p>
				<p><label style="vertical-alignement: center" for="prenom">Prénom *:</label>  <input type="text" name="prenom" id="prenom" tabindex="20" value= "<?php echo   $val ['Prenom'] ?>"/></p>
				<p><label style="vertical-alignement: center" for="mail">Adresse e-mail *:</label> <input type="text" name="email" id="email" tabindex="40" value= "<?php echo   $val ['mail'] ?>"/></p>
				<p><label style="vertical-alignement: center" for="adresse">Adresse *:</label> <input type="text" name="adresse" id="adresse" tabindex="50" value= "<?php echo   $val ['adresse'] ?>"/></p>
				<p><label style="vertical-alignement: center" for="npa">NPA *:</label> <input type="text" name="zip" id="zip" tabindex="60" value= "<?php echo   $val ["npa"] ?>"/></p>
				<p><label style="vertical-alignement: center" for="localite">Localité *:</label> <input type="text" name="ville" id="ville"tabindex="70" value= "<?php echo   $val ['localite'] ?>"/></p>
				<p><label style="vertical-alignement: center" for="pays">Pays *:</label>  <input type="text" name="pays" id="pays"tabindex="80" value= "<?php echo   $val ['Pays'] ?>"/></p>	
				<p><label style="vertical-alignement: center" for="dateNaissance"> Année de Naissance * :</label> 
				<input type="text" name="dateNaissance"  value= "<?php echo  date("Y", strtotime($val ["DateNaissance"]))?>" />
				<p><label style="vertical-alignement: center" for="club">Club:</label> <input type="text" name="club" id="club"tabindex="100" value= "<?php echo   $val ['club'] ?>"/></p>
									
				<p><label style="vertical-alignement: center">Sexe * :</label><Select    onchange ="liste_depart(this.form);" name="sexe"   id="sexe" value= "<?php echo   $val ['sexe'] ?>"/> 
				<? if (strlen ( $val ['sexe'] ) > 0)
				
				{
					if ( $val ['sexe'] == "D")
				{?>
					<option style="padding : 10px" value= "<?php echo   $val ['sexe'] ?>">Dame</option>
				<?	
				}
				else
				{?>
					<option style="padding : 10px" value= "<?php echo   $val ['sexe'] ?>">Homme</option>				
				<?}
				}
				else
				{?>
					<option style="padding : 10px" value= "">Selectionner</option>				
				<?	
				}?>
				
					
					<option style="padding : 10px" value="H">Homme</option>
					<option style="padding : 10px" value="D">Dame</option>		
				</select></p>
				<a><span> </span><button type ="button" style="float:right; margin-right :10px;"
				 onClick="checkForm(this.form)" title="Validations Informations" 
				 data-toggle="tooltip" data-placement="right">
			
				 <i class="fa fa-check" style= "font-size: 50px;margin:9px;color: #4095f5;"></i>
			
			
				
				</button></A>
				</form>
				
						<form method="post" action="DeleteMembre.php">
						<input type="hidden" name="ID" id="ID"   value= "<?php echo $val ['ID'] ?>" />
						<a><span> </span><button type ="button" style="float:left; margin-right :100px;" 
						onClick="Suppform(this.form)" 
						title="Modifications Informations" 
						data-toggle="tooltip" data-placement="right">
						<i class="fa fa-trash" style= "font-size: 50px;margin:9px;color: #FF0000;"></i>
					</button></A>
			
						</form>
				
				</fieldset>
				</div>
			<?php
			}
		}
		else
		{
		?>
			</br>Il n'existe aucun coureur pour ce compte, ajouter un coureur afin de pouvoir l'inscrire à une course</br>
		<?php
		}
    }
   ?>
<Center>
	
	<?php
	if (isset($_SESSION['Course']) and $CmptValider > 0)
{
	?>
	<script>
		
	document.getElementById("PCoureurValid").style.visibility = "visible" ;
	</script>
	<?
	}
	?>
		</center>
	
	</div>
</div>
    </body>
</html>

<script type="text/javascript">

function checkForm(f1) {
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
			if (f1.sexe.value.length<1) {
		alert("Merci d'indiquer votre sexe");
		f1.sexe.focus();
		return false;
	}
			if (!isMail(f1.email.value)) {
		alert("Merci d'indiquer un mail valide pour que nous puissions vous répondre");
		f1.email.focus();
		return false;
	
	}
	if (f1.dateNaissance.value.length!=4) {
		alert("Merci d'indiquer votre année de naissance correct comme par exemple : 1988");
		f1.dateNaissance.focus();
		return false;
	}


	if (confirm("Etes-vous sur des informations de votre coureur?")) {
	f1.submit();
	}
}

function isMail(txtMail)
{
	var regMail=new RegExp("^[0-9a-z._-]+@{1}[0-9a-z. -]{2,}[.]{1}[a-z]{2,5}$", "i");
	return regMail.test(txtMail);
}
function addForm(f1) {

	f1.submit();
	
}
function Suppform(f1) {
if (confirm("Etes-vous supprimer ce coureur?")) {
	f1.submit();
	}
}
</script>