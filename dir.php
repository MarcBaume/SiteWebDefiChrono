	<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="fr" lang="fr">
    <head>
        <title>liste</title>
        <meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
    <link rel="stylesheet" media="screen" type="text/css" title="Design" href="style.css" />

	</head>
<?php
 $chemin = $_SERVER["DOCUMENT_ROOT"]; 
echo $chemin;
if (!mkdir("var/services/test")) {
    die('lors de la création des répertoires...');
}
?>
