<!DOCTYPE html>
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
	 session_start();
$_SESSION['Login'] =$_GET["Login"];
	 
  include("HeaderAdmin.php"); 
  ?>
</br>
<?	include("MenuMember.php"); ?>
<div id="corps">

<?php 
// Selon l'état du paiement
if ($_GET["StatusPaiement"] == "waiting" || $_GET["StatusPaiement"] == "reserved" )
{
	?>
	<h3> Votre demande de  paiement d'inscriptions : <?php echo $_GET["Login"] ?>  à été pris en compte</h3>
	</br> 
    <p> Lorsque nous aurions validé votre paiement celui-ci va être mis à jour </p>
<?php
}
else
{ 
	?>
	<h3> Mal Heureusement votre paiement a été refusé : <?php echo $_GET["Login"] ?> </h3>
<?
}
?>

	</br> 
	<?php
	
	$con = mysqli_connect('dxvv.myd.infomaniak.com', 'dxvv_christopheJ', 'er3z4aet1234');
	mysqli_select_db($con ,'dxvv_jurachrono' );
  	$Value = 'True';
	$sql = 'SELECT * FROM inscription  WHERE OrderPayement=\''.$_GET["ID"].'\'AND PayementOnLine =\''.$Value.'\'';

	$result = mysqli_query($con,$sql);
	$c=0;
	$PrixTotal = 0;
    // On affiche chaque entrée une à une
	if ($result && mysqli_num_rows($result) > 0) 
	{
    // output data of each row
	?>
		<table> 
			<tr>
				<th width="20%"> Course</th>
				<th width="15%"> Nom</th>
				<th width="15%"> Prénom</th>
				<th width="15%"> Parcours </th>
				<th width="15%">  Catégorie</th>
				<th width="15%">  Etape</th>
				<th width="15%">  Prix</th>
			</tr>
			
		<?php

		$sql = 'UPDATE inscription SET Payer = \''.$_GET["StatusPaiement"].'\' WHERE OrderPayement=\''.$_GET["ID"].'\''; 
				if (!mysqli_query($con,$sql))
				{
					echo "Error update : Membres Nom" . mysql_error();
				}  
		while($donnees = mysqli_fetch_assoc($result)) 
		{
						// Modifier les Informations en ajoutant Le Order ID dans la Colonne de la table inscription OrderPayement
				
				
		$PrixTotal = $PrixTotal + $donnees['Prix'];
			?>

			<tr>
				<td> <?php echo $donnees['course']; ?></td>
				<td> <?php echo $donnees['Nom']; ?></td>
				<td> <?php echo $donnees['Prenom']; ?></td>
				<td><?php echo $donnees['parcours']; ?></td>
				<td><?php echo $donnees['NomCategorie']; ?></td>
				<td><?php echo $donnees['NbrEtape']; ?></td>
				<td><?php echo $donnees['Prix']; ?></td>
			</tr>
			
			<?php
		}
?>
</table>
<?
	}
?>


</body>
</html>
