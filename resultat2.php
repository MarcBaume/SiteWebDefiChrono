<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="fr" >
   <head>
       <title>GSFM</title>
       <meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
	     <meta name="viewport" content="width=device-width, maximum-scale=1.0, user-scalable=yes">
	       <link rel="stylesheet" media="screen" type="text/css" title="style" href="style.css" />

     <link rel="stylesheet" title="defaut" media="screen" href="style.css" type="text/css"/>
     <link rel="stylesheet" type="text/css" media="screen and (max-width: 480px)" href="style-mobil.css" />
 </head>

   <body>
   
  <?php include("onglets.php"); ?>
<?php include("menu_vertical.php"); ?>
<?php include("menu_horizontal.php"); ?>

<div id="corps">

  <ul id="TableauResulat">

<?php

$row = 1;
if (($handle = fopen("test.csv", "r")) !== FALSE) {
    while (($data = fgetcsv($handle, 1000, ";")) !== FALSE) {
        $num = count($data);
   //     echo "<p> $num champs à la ligne $row: <br /></p>\n";
   //  . "<br />\n";
        $row++; ?>
		<Table>	
		<?php if ($data[$c] == "pos")
		{?>
	
		<?php
        for ($c=0; $c < $num; $c++) {
	
        ?> <th><?php    echo $data[$c]?> </th><?php
        }?> 
	
		<?php
		}
		else
		{
		?>
		<tr><?php
        for ($c=0; $c < $num; $c++) {
	
        ?> <td><?php    echo $data[$c]?> </td><?php
        }
		}?> 
		
		</tr>
				<?php if ($data[2] == "")
		{?>
		
		
		<?php
		}
    }
    fclose($handle);
}
?>
</table>
</ul>
</div>
</body>
</html>
