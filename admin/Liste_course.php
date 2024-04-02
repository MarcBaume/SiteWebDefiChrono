<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="fr" >
   <head>
       <title>GSFM</title>
       <meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
	       <link rel="stylesheet" media="screen" type="text/css" title="style" href="style.css" />

</head>
   <body>
  <?php include("onglets.php"); ?>
<?php include("menu_vertical.php"); ?>
<div id="corps">
<?php
$sql = 'SELECT * FROM Course ORDER BY Date ASC WHERE login=\''.$_POST["login"].'\'';
$result = mysqli_query($con,$sql);
 
 if ($result && mysqli_num_rows($result) > 0) {
 
 }
 ?>
</div>
   </body>
   </html>
   