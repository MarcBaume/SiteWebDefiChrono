<!DOCTYPE html>
<html>

<?php
include("Header.php"); 
include("Header2023.php"); 
?> 
</br>
</br>

<p>
<?

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
	$sql = 'UPDATE Login SET Password = \''.$pass_crypte .'\'  WHERE Login=\''.$_POST['login'].'\''; 
	if (!mysqli_query($con,$sql))
	{
		echo "Erreur Order Login pas trouvé";
	}  
	else
	{
	$sql = 'UPDATE Login SET Status =\'\'    WHERE Login=\''.$_POST['login'].'\''; 
	if (!mysqli_query($con,$sql))
	{
		echo "Erreur compte non trouvé";
	} 
	
	else
	{
		echo "Votre mot de passe a bien été réinitialisé";
	
		if ( strlen($_POST['DateCourse'])> 0  && strlen($_POST['Course'])>0)
		{
		?>
		</br>
		<p>
		<span class="dot" >
			<form method="get" action="formulaire2023.php">
				<input type="hidden" name="DateCourse" id="DateCourse"   value= '<?php echo $_POST['DateCourse'] ?>' />
				<input type="hidden" name="NomCourse" id="NomCourse"  value= '<?php echo $_POST['Course']?>' />
				<input type="hidden" name="Nbretape" id="Nbretape" value= '<?php echo  $_POST['Nbretape'] ?>' />
				<input type="submit" value="Retour à la page d'inscription de  <?php echo $_POST['Course'] ?>"  style= "padding: 10px ;height: 60px; font-size:120%"> 
			</form>
		</span>
		</p>

		<?php
		}
	
	}
	}
}
	 /*header('Location: admin/login.php');
	
	
  echo $ton_contenu  ;
	file_put_contents('admin/.htpasswd', $ton_contenu, FILE_APPEND);*/
	
	


 ?>    
 </p>
    </body>
</html>