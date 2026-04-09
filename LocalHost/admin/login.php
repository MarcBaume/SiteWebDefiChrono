
<?php
	include("Header.php"); 
?>
</br>
<?php	
	include("../HeaderIndex.php"); 
?>
	<div id="corps">
		<div id="index">

<?php 
if (isset($_SESSION['Login']) &&$_GET['Login'] !="false")
{?>
	<h3>
	<?php
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
    <?php include("../MysqlConnect.php");
	?>
	<table>
	<th width="10%"> Date</th>
	<th width="30%"> Evénements</th>
	<th width="30%"> Lieu</th>
	<th width="30%"> Actions</th>
	<?php
	// Create table de donnée du nom de parcours
	// Test sans mis en commentaire je ne comprend pourquoi il y a ce code 
	// mysqli_select_db($con,$row['Database']);
	if ($_SESSION['Niveau'] == 2)
	{
		$sql = 'SELECT * FROM Course   ORDER BY Date DESC'; 
	}
	else
	{
		$sql = 'SELECT * FROM Course  WHERE Login=\''.$_SESSION['Login'].'\' ORDER BY Date ASC'; 
	}
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
				<tr style="background: #ededed;">
				<?php
			}
			else
			{
				$Background = 1;?>
				<tr style="background: #ffffff;">
				<?php
			}	
	  		?>
			<td><?php  echo  $val ["Date"]?></td>
			<td><?php echo  $val ["Nom_Course"];?> </td>
			<td><?php echo  $val ["Lieu"];?> </td>
				<?php $date = date_parse($val ["Date"]);
				$annee = $date['year'];?>
			<td>
				<form id="FormRace" method="get">
					 <input type="hidden" name="IdRace" id="IdRace" tabindex="10"  size="60"  value= '<?php echo $val ["ID"] ?>' />
				
		
				<button type ="button" style="float:right;margin-right :10px;" onClick="checkForm(this.form,'FormulaireCoureurInscriptionSurPlace.php')"title="inscription" data-toggle="tooltip" data-placement="top">
					<span class="dot">
						<i class="fa fa-wpforms"  style= "font-size: 24px;margin:8px;margin-left:10px;color: #4095f5;"></i>
					</span>
				</button>
				<button type ="button" style="float:right;margin-right :10px;" onClick="checkForm(this.form,'ListeInscriptionsOrganisateur.php')"title="Gestion Liste départ" data-toggle="tooltip" data-placement="top">
					<span class="dot">
						<i class="fa fa-list" style= "font-size: 22px;margin:9px;color: #4095f5;"></i>
					</span>
				</button>
				<button type ="button" style="float:right;margin-right :10px;" onClick="checkForm(this.form,'FormulaireCodeReduction.php')"title="inscription" data-toggle="tooltip" data-placement="top">
					<span class="dot">
							<i class="fa fa-gift"  style= "font-size: 24px;margin:8px;margin-left:10px;color: #4095f5;"></i>
					</span>
				</button>
			</form>

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
	<?php
}
else
{?>
	<form method="post" name="FormConnect1" id ="FormConnect1" action="CibleLogin.php">
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
		</span>
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
	<?php
	if (isset($_GET['Login']) &&  $_GET['Login']=="false")
	{
		session_destroy();
		?> <p style="background-color : Red;"> Mauvais mot de passe </p>
		 <p>* Si  votre mot de passe ne fonctionne pas, veuillez le réinitialiser </p>
	<?php	
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
function checkForm(f, url) 
{
	f.action = "inscriptionSurPlace/"+url;
	f.submit();
}
function SendForm1()
{
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