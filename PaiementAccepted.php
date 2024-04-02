<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="fr" >
   <head>
       <title>Jura défi chrono</title>
       <meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
	     <meta name="viewport" content="width=device-width, maximum-scale=1.0, user-scalable=yes">
	       <link rel="stylesheet" media="screen" type="text/css" title="style" href="style.css" />

     <link rel="stylesheet" title="defaut" media="screen" href="style.css" type="text/css"/>
     <link rel="stylesheet" type="text/css" media="screen and (max-width: 480px)" href="style-mobil.css" />
 </head>
 <body>
<?php include("onglets.php"); ?>

<div id="corps">
<?php include("menuAccueil.php");?>
	<h3> Merci pour les paiement des inscriptions : <?php echo $_GET["Login"] ?> </h3>
	</br> 
	<?php
	
	$con = mysqli_connect('dxvv.myd.infomaniak.com', 'dxvv_christopheJ', 'er3z4aet1234');
	mysqli_select_db($con ,'dxvv_jurachrono' );
 
	$sql = 'SELECT * FROM inscription  WHERE OrderPayement=\''.$_GET["ID"].'\'';
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

		$sql = 'UPDATE inscription SET Payer = \'Payé\'  WHERE OrderPayement=\''.$_GET["ID"].'\''; 
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
			</table>
			<?php
		}

	}
?>

</div>
 <?php include("sponsors.php"); ?> 
</div>

</body>
</html>
