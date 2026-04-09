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
	include("Header.php"); 
	include("MysqlConnectLocal.php"); 
?>
</br>
	<div id="corps">
		<div id="index">
	<table>
		<tr>
			<th width="10%"> Date</th>
			<th width="30%"> Evénements</th>
			<th width="30%"> Lieu</th>
			<th width="30%"> Actions</th>
		</tr>
	<?php
	// Create table de donnée du nom de parcours
	// Test sans mis en commentaire je ne comprend pourquoi il y a ce code 
	// mysqli_select_db($con,$row['Database']);
	$sql = 'SELECT * FROM Course   ORDER BY Date DESC'; 
	$result = mysqli_query($con,$sql);
	if (mysqli_num_rows($result) > 0) 
	{
		// output data of each row
		$Background = 0;
		while($val = mysqli_fetch_assoc($result)) 
		{
			if ($Background == 1)
			{
				$Background = 0;?>
				<tr style="background: #ededed;">
				<?
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
				<form method="get" action ="inscriptions/formulaireInscriptionSurPlace.php">
					<input type="hidden" name="IdCourse" id="IdCourse" tabindex="10"  size="60"  value= '<?php echo $val ["ID"] ?>' />
					<a>
					<button type ="button" style="float:right;margin-right :10px;" onClick="checkForm(this.form)"title="inscription" data-toggle="tooltip" data-placement="top">
					<span class="dot">
							<i class="fa fa-wpforms"  style= "font-size: 24px;margin:8px;margin-left:10px;color: #4095f5;"></i>
					</span></button></a>
				</form>
				<form method="get" action ="inscriptions/listeInscriptionOrganisateur.php">
					 <input type="hidden" name="IdCourse" id="IdCourse" tabindex="10"  size="60"  value= '<?php echo $val ["ID"] ?>' />
					<button type ="button" style="float:right;margin-right :10px;" onClick="checkForm(this.form)"title="Gestion Liste départ" data-toggle="tooltip" data-placement="top">
					<span class="dot">
						<i class="fa fa-list" style= "font-size: 22px;margin:9px;color: #4095f5;"></i>
					</span>
					</button></a>
				</form>
				<form method="get" action ="inscriptions/FormulaireCodeReduction.php">
					 <input type="hidden" name="IdCourse" id="IdCourse" tabindex="10"  size="60"  value= '<?php echo $val ["ID"] ?>' />
					<a>
					<button type ="button" style="float:right;margin-right :10px;" onClick="checkForm(this.form)"title="inscription" data-toggle="tooltip" data-placement="top">
					<span class="dot">
							<i class="fa fa-gift"  style= "font-size: 24px;margin:8px;margin-left:10px;color: #4095f5;"></i>
					</span></button></a>
				</form>

			</td>
			</tr>
<?php
		}
	}
	
	?>
	 </table>
	<?
   ?>
  
	</div>
</div>
</body>
</html>
<script>
function checkForm(f) 
{
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