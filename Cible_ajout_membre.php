
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
if (isset($_POST['login']) AND isset($_POST['pass']))
{

    $login = $_POST['login'];
    $pass_crypte = password_hash($_POST['pass'], PASSWORD_DEFAULT); // On crypte le mot de passe

	
	// Establishing Connection with Server by passing server_name, user_id and password as a parameter
	$con = mysqli_connect('dxvv.myd.infomaniak.com', 'dxvv_christopheJ', 'er3z4aet1234');
	if (!$con)
	{
		die('Could not connect: ' . mysql_error());
	}
	// Selecting Database
	mysqli_select_db($con ,'dxvv_jurachrono' );
	$sql = 'INSERT INTO Login (`Login`, `Password`,`Niveau`)
	VALUES
	("'.$login.'", 
	"'.$pass_crypte.'",
	"3");';
	

	$result = mysqli_query($con,$sql);
 
	
   /*echo $ton_contenu  ;
	file_put_contents('admin/.htpasswd', $ton_contenu, FILE_APPEND);*/
	
	}


 ?>    
    </body>
</html>