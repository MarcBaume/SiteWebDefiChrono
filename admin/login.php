<!DOCTYPE html>
<html>
<head>
	<meta property="og:description" content="chronométrage, chrono, jura, franches-montagnes, Jura défi, course à pied, Sport, Jura défi chrono" />  
	<title>Défi Chrono</title>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, maximum-scale=1.0, user-scalable=yes">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css">
	<link rel="stylesheet" title="defaut" media="screen" href="../css/style.css" type="text/css"/>
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
<h3>
<?php 
session_start();
if (isset($_SESSION['Login']) &&$_GET['Login'] !="false")
{
	if ($_SESSION['Niveau'] == 2 || $_SESSION['Niveau'] ==0)
	{
		echo 'Course de '. $_SESSION['Login'];
	}
	else if ($_SESSION['Niveau'] > 3)
	{
		echo 'Administrateur du site';
	}
	else
	{
		header('Location: membres.php'); 
		
	}?>
</h3>
  
   <?php	include("../MysqlConnect.php");
	?>
	<table border="0">
	<th width="10%"> Date</th>
	<th width="30%"> Evénements</th>
	<th width="30%"> Lieu</th>
	<th width="30%"> Actions</th>
	<?php
	// Create table de donnée du nom de parcours
	mysqli_select_db($con,$row['Database']);
	if ($_SESSION['Niveau'] == 2)
	{
		$sql = 'SELECT * FROM Course   ORDER BY Date DESC'; 
	}
	else
	{
		$sql = 'SELECT * FROM Course  WHERE Login=\''.$_SESSION['Login'].'\' ORDER BY Date ASC'; 
	}
	//echo $sql;
	$result = mysqli_query($con,$sql);
	 
	 if ($result && mysqli_num_rows($result) > 0) 
	 {
		// output data of each row
		$Background = 0;
		while($val = mysqli_fetch_assoc($result)) 
		{
			if ($Background == 1)
			{
				$Background = 0;?>
					<tr style="background: #ededed;"   >
				<?
			}
			else
			{
				$Background = 1;?>
				<tr style="background: #ffffff;"   >
				<?
			}
				
	  ?>
	  
	
		
			<td><?php  echo  $val ["Date"]?></td>
			<td><?PHP echo  $val ["Nom_Course"];?> </td>
			<td><?PHP echo  $val ["Lieu"];?> </td>
	<?PHP   $date = date_parse($val ["Date"]);
			$annee = $date['year'];?>
			<td>

				<!--<form method="get" action ="modif_informations.php">
					 <input type="hidden" name="idRace" id="idRace" tabindex="10"  size="60"  value= '<?php echo $val ["ID"] ?>' />
					<button type ="button" style="float:right;margin-right :10px;" onClick="checkForm(this.form)"title="inscription" data-toggle="tooltip" data-placement="top">
					<span class="dot">
							<i class="fa fa-info"  style= "font-size: 24px;margin:8px;margin-left:10px;color: #4095f5;"></i>
							<a> Informations </a>
					</span>
					</button></a>
				</form>
				<form method="get" action ="../formulaireV3.php">
					 <input type="hidden" name="DateCourse" id="DateCourse" tabindex="10"  size="60"  value= '<?php echo $val ["Date"] ?>' />
					<input type="hidden" name="login" id="login" tabindex="10"  size="60"  value= '<?php echo $_POST['login'] ?>' />
					<input type="hidden" name="NomCourse" id="NomCourse" tabindex="10"  size="60"  value= '<?php echo $val ["Nom_Course"] ?>' />
					<a>
					<button type ="button" style="float:right;margin-right :10px;" onClick="checkForm(this.form)"title="inscription" data-toggle="tooltip" data-placement="top">
					<span class="dot">
							<i class="fa fa-wpforms"  style= "font-size: 24px;margin:8px;margin-left:10px;color: #4095f5;"></i>
					</span></button></a>
				</form>-->
				<form method="get" action ="inscriptions/formulaireInscriptionSurPlace.php">
					 <input type="hidden" name="DateCourse" id="DateCourse" tabindex="10"  size="60"  value= '<?php echo $val ["Date"] ?>' />
					<input type="hidden" name="login" id="login" tabindex="10"  size="60"  value= '<?php echo $_POST['login'] ?>' />
					<input type="hidden" name="NomCourse" id="NomCourse" tabindex="10"  size="60"  value= '<?php echo $val ["Nom_Course"] ?>' />
					<a>
					<button type ="button" style="float:right;margin-right :10px;" onClick="checkForm(this.form)"title="inscription" data-toggle="tooltip" data-placement="top">
					<span class="dot">
							<i class="fa fa-wpforms"  style= "font-size: 24px;margin:8px;margin-left:10px;color: #4095f5;"></i>
					</span></button></a>
				</form>
				<form method="get" action ="inscriptions/listeInscriptionOrganisateur.php">
					 <input type="hidden" name="DateCourse" id="DateCourse" tabindex="10"  size="60"  value= '<?php echo $val ["Date"] ?>' />
					<input type="hidden" name="login" id="login" tabindex="10"  size="60"  value= '<?php echo $_POST['login'] ?>' />
					<input type="hidden" name="NomCourse" id="NomCourse" tabindex="10"  size="60"  value= '<?php echo $val ["Nom_Course"] ?>' />
					<button type ="button" style="float:right;margin-right :10px;" onClick="checkForm(this.form)"title="Gestion Liste départ" data-toggle="tooltip" data-placement="top">
					<span class="dot">
						<i class="fa fa-list" style= "font-size: 22px;margin:9px;color: #4095f5;"></i>
					</span>
					</button></a>
				</form>
			<?php // Seulement pour jura defi 2021
			if ( $val ["Date"] == "2021-08-14" && $val ["Nom_Course"] == "JuraDéfi" )
			{
			?>
				<form method="get" action ="ResultatJuraDefi2021.php">
					 <input type="hidden" name="DateCourse" id="DateCourse" tabindex="10"  size="60"  value= '<?php echo $val ["Date"] ?>' />
					<input type="hidden" name="login" id="login" tabindex="10"  size="60"  value= '<?php echo $_POST['login'] ?>' />
					<input type="hidden" name="NomCourse" id="NomCourse" tabindex="10"  size="60"  value= '<?php echo $val ["Nom_Course"] ?>' />
					<button type ="button" style="float:right;margin-right :10px;" onClick="checkForm(this.form)"title="Gestion Liste départ" data-toggle="tooltip" data-placement="top">
					<span class="dot">
					<i class="fa fa-trophy" style= "font-size: 20px;margin:9px;color: #4095f5;"></i>
									</span>
					</button></a>
			<?}?>	
				<!--
				 <form  method="post" action ="Parcours.php">
				  <input type="hidden" name="DateCourse" id="DateCourse" tabindex="10"  size="60"  value= '<?php echo $val ["Date"] ?>' />
				 <input type="hidden" name="login" id="login" tabindex="10"  size="60"  value= '<?php echo $_POST['login'] ?>' />
				<input type="hidden" name="NomCourse" id="NomCourse" tabindex="10"  size="60"  value= '<?php echo $val ["Nom_Course"] ?>' />
				<button type ="button"style="float:right;margin-right :10px;"  onClick="checkForm(this.form)" title="Gestion parcours" data-toggle="tooltip" data-placement="right" >Parcours</button> 
				</form>
				-->
				<!----
				<a href="images/inscriptions.php"  class="lightbox"><img src="images/inscriptions.png"  width="25"></img></a>   
				<a href="images/liste.php"  class="lightbox"><img src="images/liste.png"  width="25"></img></a>        
				<a href="images/resultat.php"  class="lightbox"><img src="images/resultat.png"  width="25"></img></a>
				!--->

			</td>
			</tr>
<?php

		}
	}
	else
	{
		echo 'Pas de course';
	}
	?>
	 </table>
	
	<?
    }

else
{?>
	<form method="post" name="FormConnect1" id ="FormConnect1" action="CibleLoginV2b.php">
				<div class="input">
				<label for="Login" style="font-size:15px;">e-mail :</label>
				<input type="text" name="login1" id="login1" tabindex="10" style= "padding:10px; font-size: 15px;" style="max-width: 250px;"/> 
			</div>
			<div class="input">
				<label for="password" style="font-size:15px;">Mot de passe :</label>
				<input type="password" name="pass1" id="pass1" tabindex="15" style= " font-size: 20px;" style="max-width: 250px;"/>
			<div>
			<span class="dot" onclick=" SendForm1()"   >
				<i  class="fa fa-sign-in" style= " font-size: 40px;" ></i>
			</span >
		<table style="margin-top:100px;">
		<tr>
			
				<td onClick= "GoNewCompt()" >
				<span class="dot">
					<p style="margin:10px;background:transparent;">
						Créer un compte 
					</p>
				</span >
				</td>
			
		
				<td onClick= "GoForgetPassword()">
				<span class="dot">
					<p style="margin:10px;background:transparent;">
						Réinitialiser mon mot de passe
					</p>
					</span >
				</td>
			
		</tr>
			
		</table>
	</form>
	<?
	if ($_GET['Login'] =="false")
	{
		session_destroy();
		?> <p style="background-color : Red;"> Mauvais mot de passe </p>
		 <p>* Si  votre mot de passe ne fonctionne pas, veuillez le réinitialiser </p><?
		
	}
	else
	{
		session_destroy();
	
	
	}

}
   ?>
  
	</div>
</div>
    </body>
</html>
<script>
function checkForm(f) {
	f.submit();
	}
function SendForm1() {
  var popup = document.getElementById("FormConnect1");
  popup.submit();
}
function GoNewCompt()
{
		 window.location.href = "../AddLoginV2.php";
}
function GoForgetPassword()
{
		 window.location.href = "../PasswordForget2023.php";
}
</script>