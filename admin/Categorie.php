<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="fr" lang="fr">
    <head>
        <title>liste</title>
        <meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
    <link rel="stylesheet" media="screen" type="text/css" title="Design" href="../style.css" />

	</head>
	<script type="text/javascript">
	function quitter(){
		<?php
	?>
	alert("Merci d'indiquer un num�ro de t�l�phone pour vous contacter si besoin");}
	</script>
	<BODY>
	<?php include("../onglets.php"); ?>
	<?php include("../menu_horizontal.php"); ?>
<div id="corps">
<fieldset>
<?php echo 'Course : '.  ['nom'] ?>
</br>
<legend> <?php echo '�tape 3 /cat�gorie du parcours '.  $_POST['nom_parcours'] ?> </legend>
</fieldset>
<ul id="step">
<form method="post" action="Script_Ajout_categorie.php">
<input type="hidden" name="nom" id="nom" tabindex="10"  size="60"  value= '<?php echo $_POST['nom'] ?>' />
  <p><label for="Nom">Nom:</label> <input type="text" name="distance" id="distance" tabindex="24" /></p>
  <p><label for="debut">Ann�e d�but:</label> <input type="text" name="nom" id="nom" tabindex="20" /></p>
  <p><label for="fin">Ann�e fin:</label> <input type="text" name="distance" id="distance" tabindex="24" /></p>
	<label>Sexe * :</label>	</label>Homme<input type="radio" name="sexe" value="H" id="sexe"/> </br> </br> 
	</label>Dame<input type="radio" name="sexe"value="D" id="sexe"/> </br></br>  
	</label>Homme<input type="radio" name="sexe"value="H" id="sexe"/> </br> </br> 
	</label>Mixte<input type="radio" name="sexe"value="M" id="sexe"/> </br> 
  <center>
  <input type="image" src="images/bouton_plus.png" title="previous" style="background-color:transparent"width="50" height="50">
  </center>
</form>
</fieldset>

</ul>
<?php

// ************************ afficher fichier cat�gorie  *************/
$pathFile =  $_POST['nom'] . '/'.$_POST['nom_parcours'].'/'.'cat.csv';
if (($handle = fopen($pathFile, "r")) !== FALSE) {
    while (($data = fgetcsv($handle, 1000, ";")) !== FALSE) {
        $num = count($data);
   //     echo "<p> $num champs � la ligne $row: <br /></p>\n";
   //  . "<br />\n";
        $row++; 
		
		// premi�re ligne 
		if ($data[2] == "")
		{
			// Si il y a d�j� un table sur la page 
			if  ($start_array)
		{
		?>
		</Table>
		<?php
		}
        for ($c=0; $c < $num; $c++) {
		?>
		<p>
		<?php
		echo $data[$c];?>
		</p>
		<?php
		}
	
		}
		else
		{
		?>

		<tr>
		<?php
        for ($c=0; $c < $num; $c++) {
	
		if ($data[$c] == "pos")
		{
		$start_array = true;
		$en_tete = true;?>
		<Table>	
		<?php
		}
	
		if($en_tete)
		{
		?>
       <th><?php    echo $data[$c]?> </th><?php
        }
		else
		{?>
         <td><?php    echo $data[$c]?> </td><?php
        }
		}
		
		$en_tete = false?> 
		
		</tr>
			
		
		<?php
		}
		
    }
    fclose($handle);
}

?>



 <center>

<input type="image" src="images/bouton_previous.png" title="previous" style="background-color:transparent"width="50" height="50">
<input type="image" src="images/bouton_next.png" title="next" style="background-color:transparent"width="50" height="50">
</form>
</center>
</div>
   </body>
   </html>