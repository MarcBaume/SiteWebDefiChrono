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
  include("HeaderAdmin.php"); 
  ?>
</br>
<?	include("MenuMember.php"); ?>
    <body >
<div id="corps">
<h3>

	Liste de résultat a valider pour Jura Défi 2021
</h3>
<div  id="TableauResulat">


	
<?PHP
$con = mysqli_connect('dxvv.myd.infomaniak.com', 'dxvv_christopheJ', 'er3z4aet1234');
if (!$con)
  {
  die('Could not connect: ' . mysql_error());
  }
  else
  {
  
  mysqli_select_db($con ,'dxvv_jurachrono' );
  

   
    // On récupère tout le contenu de la table temps jura defi 2021

 $sql = 'SELECT * FROM TempsJuraDefi2021 WHERE Status="Validation en cours"';

$result = mysqli_query($con,$sql);
    ?>


	<!---<th width="25%"> Catégorie</th> --->
	 <?php
	 $c=0;
    // On affiche chaque entrée une à une
  
 if ($result && mysqli_num_rows($result) > 0) {?>
  
	<table>
	<tr>
	<th width="5"> N°</th>
	<th width="20"> Nom équipe</th>
	<th width="40"> Discipline</th>
	<th width="40"> Chrono (HH:MM:SS)</th>
	<th> Link</th>
	<th> Commentaire</th>
 	</tr>
   <?php
     // output data of each row
    while($donnees = mysqli_fetch_assoc($result)) {
  
	$c=$c+1;
	?>
	<tr>

		<form method="post" action="cibleValidationJD2021.php" name = '<?php echo "form".$donnees ["ID"] ?>'  id="<?php echo "Modification".$donnees['ID']  ?>" >		

					<td>
						<? echo $donnees ["IDEquipe"] ?>
						<input type="hidden" name="ID" id="ID"   value= '<?php echo $donnees ["ID"] ?>' />
						<input type="hidden" name="IDEquipe" id="IDEquipe"   value= '<?php echo $donnees ["IDEquipe"] ?>' />
					</td>
		
					<td > <input style="width:90px" type="text" name="NomEquipe" id="NomEquipe" tabindex="10" value=  '<?php echo $donnees['NomEquipe']; ?>' /> </td>
					<td>
						
				<select  id="Discipline" name="Discipline"  style="width:90px"  >
				<Option value='<?php echo $donnees['Discipline']; ?>' ><?php echo $donnees['Discipline']; ?> </option>
				<Option value="Roller">Roller</option>
				<Option value="Course">Course</option>
				<Option value="VéloDeRoute">Vélo de route</option>
				<Option value="VTT">VTT</option>
			</select>
					   </td>
					<td><input  style="width:90px" type="text" name="Chrono" id="Chrono" tabindex="11" value = '<?php echo $donnees['Chrono']; ?>' />    </td>
			
					<td >  <a target="_blank" href="<?php echo $donnees['Link']; ?>"><?php echo $donnees['Link']; ?> </a> </td>
					<td> <a><?php echo $donnees['Commentaire']; ?></a></td>
					<td  onClick="funModification( <?php echo $donnees['ID'] ?>)" >
						<span class="dot2" >
							 <i  style="  margin:5px;"  class="fa fa-check"></i>
						 </span>							
					</td>
			<!--		<td  onClick="funDelete(  <?php echo $donnees['ID'] ?>)" > 
						<span class="dot2" >
							 <i  style="  margin:5px;"  class="fa fa-trash"></i>
						 </span>					
					</td>-->
	

			</form>
			
			<form method="post" action="delete.php"  id="<?php echo "Delete".$donnees['ID']  ?>">
				<input type="hidden" name="ID" id="ID"   value= '<?php echo $donnees ["ID"] ?>' />
			</form>
		</tr>
	  <?php
	}

}?>
<?
	$sql = 'SELECT * FROM TempsJuraDefi2021 WHERE Status="Validé"';

	$result = mysqli_query($con,$sql);
		?>
	
		</br>
		 <table width="100%" > 
	
		<!---<th width="25%"> Catégorie</th> --->
		 <?php
		 $c=0;
		// On affiche chaque entrée une à une
	  
	 if ($result && mysqli_num_rows($result) > 0) {?>
	  <h3>

Liste de résultat valider pour Jura Défi 2021
</h3>
		<table>
		<tr>
		<th width="5"> N°</th>
		<th width="20"> Nom équipe</th>
		<th width="40"> Discipline</th>
		<th width="40"> Chrono  (HH:MM:SS)</th>
		<th> Link</th>
		<th> Commentaire</th>
		 </tr>
	   <?php
		 // output data of each row
		while($donnees = mysqli_fetch_assoc($result)) {
	  
		$c=$c+1;
		?>
		<tr>
				<td>
				<td >  <?php echo $donnees['NomEquipe']; ?> </td>
				<td><?php echo $donnees['Discipline']; ?>   </td>
				<td><?php echo $donnees['Chrono']; ?>   </td>
				<td ><a target="_blank" href="<?php echo $donnees['Link']; ?>"><?php echo $donnees['Link']; ?> </a> </td>
				<td> <a><?php echo $donnees['Commentaire']; ?></a></td>
		</tr>
		  <?php
		}

	}
  
  }
   

?>

</table>
 </center>
 </div>

 </div>
	


 </body>

</html>
<script type="text/javascript">

function funModification(id)
	{

		elmnt = document.getElementById("Modification"+id);
		if (elmnt.Chrono.value.length!=8) {
		alert("Merci le chrono au format correct hh:mm:ss ");
		elmnt.Chrono.focus();
		return false;
		}
		elmnt.submit();
	}
	
	function funDelete(id)
	{
		elmnt = document.getElementById("Delete"+id);
		elmnt.submit();
	}
	
		function ClickRows(event, id)
    {  
	
	
		if (	document.getElementById("Infos"+id).style.visibility == "visible")
		{
		//	document.getElementById("RowRace"+id).style.backgroundColor = "#ffffff" ;
		document.getElementById("Infos"+id).style.visibility = "collapse" ;
			document.getElementById("IconsMinus"+id).style.visibility = "collapse" ;
		document.getElementById("Icons"+id).style.visibility = "visible" ;
		}
		else
		{
		//	document.getElementById("RowRace"+id).style.backgroundColor = "#c9efff" ;
			document.getElementById("Infos"+id).style.visibility = "visible" ;
					document.getElementById("IconsMinus"+id).style.visibility = "visible" ;
		document.getElementById("Icons"+id).style.visibility = "collapse" ;
		}
	event.stopPropagation(); 
		
    }
</script>

 



