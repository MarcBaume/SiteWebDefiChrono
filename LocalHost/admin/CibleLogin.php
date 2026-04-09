<?php
  include("../Header.php"); 
  ?>
  </br>
<div id="corps">
<a>
 <?php
	//  Récupération de l'utilisateur et de son pass hashé
	$sql ='SELECT * FROM Login  WHERE Login=\''.$_POST["login1"].'\''; 
	//'SELECT ID, pass FROM Login WHERE Login=\''.$_POST["login"].'\''; 
	$result = mysqli_query($con,$sql);
 
	if ($result && mysqli_num_rows($result) > 0) 
	{
	  while($val = mysqli_fetch_assoc($result)) 
	  {
			// Comparaison du pass envoyé via le formulaire avec la base
			$isPasswordCorrect = password_verify($_POST['pass1'], $val['Password']);
			if ($isPasswordCorrect) 
			{
				session_start();
				$_SESSION['id'] = $val['ID'];
				$_SESSION['Login'] = $_POST['login1'];
				$_SESSION['Niveau'] = $val['Niveau'];
				echo 'Vous êtes connecté !';
				echo 'Bonjour ' . $_SESSION['Login'];
				$url = "login.php";
			}
			else 
			{
				$url = "login.php?Login=false";
				echo 'Mot de passe incorrect';
			}
			header("Location: ".$url);
		}
	}
	else
	{
		$url = "login.php?Login=false";
		echo 'Login non existant';
		header("Location: ".$url);
	}

?>
</a>
  </body>