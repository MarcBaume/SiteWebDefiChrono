
 <!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="fr" >
   <head>
       <title>Zone admin GSFM</title>
       <meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
	       <link rel="stylesheet" media="screen" type="text/css" title="style" href="style_admin.css" />
   </head>
   <body>

  <?php  include("onglets.php"); ?>
</br>
<?php
if (isset($_POST['Login']))
{

    $login = $_POST['Login'];
	$OrderID = $_POST['Login']. date("YmdHis");
	
	include("MysqlConnect.php");
	// Modifier les Informations en ajoutant Le Order ID dans la Colonne de la table Login Password En changement
	$sql = 'UPDATE Login SET Status = \''.$OrderID.'\'  WHERE Login=\''.$login.'\''; 
	if (!mysqli_query($con,$sql))
	{
		echo "Erreur compte ".$login."non trouvé";
	}  
$message = '<html>
<head>
<title></title>
</head>
<body>
Bonjour '.$login.'</br></br>
Veuillez suivre ce lien pour réinitialiser votre mot de passe </br></br>
<a style="color:blue" href="https://juradefichrono.ch/InitialisationPassword.php?Login='. $login.'&ID='.$OrderID.'">lien pour réinitialiser votre mot de passe</a>"
</body>
</html>';

$headers = "Content-Type: text/html; charset=ISO-8859-1\r\n";

    mail($_POST['Login'], 'mot de passe oublié',$message ,$headers);
	 
	header('Location: index.php');
	
	
   /*echo $ton_contenu  ;
	file_put_contents('admin/.htpasswd', $ton_contenu, FILE_APPEND);*/
	
	}


 ?>    ;
    </body>
</html>