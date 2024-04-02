<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="fr" lang="fr">
    <head>
        <title>liste</title>
        <meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
    <link rel="stylesheet" media="screen" type="text/css" title="Design" href="../style.css" />

	</head>
	<script type="text/javascript">
		function valider()
{
document.formulaire.submit();
}

</script>

<?php 

// Ecriture fichier categorie liste de départ 

$fd = fopen("tonfichier.txt", "wb");
fwrite($fd, "ton texte");
fclose($fd);

?>
<body onload="document.formulaire.submit();">

	<form method="post" action="Categorie.php"  name="formulaire">
<input type="hidden" name="nom" id="nom" tabindex="10"  size="60"  value= '<?php echo $_POST['nom'] ?>' />
<input type="hidden" name="nom_parcours" id="nom_parcours" tabindex="10"  size="60"  value= '<?php echo $_POST['nom_parcours'] ?>' />

</form>
   </body>
   </html>