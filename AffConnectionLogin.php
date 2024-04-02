
<div id="menu_horizontal">
<?php if (isset($_SESSION['Login']))
{?>

	<form method="post" action="admin/membres.php">
	<p>	
	
			<button type ="submit"  onClick=""  text="login" title="login" data-toggle="tooltip" data-placement="right"  >
			
			<img src="images/login.jpg"  width="40">
			<a>Profil</a>
			</button>
		
	</p>
	</form> 
	<p>
	<?php echo $LoginLight =substr($_SESSION['Login'], 0 ,   strpos($_SESSION['Login'], "@") ) ;?>
	</p>
	<form method="post" action="deconnection.php">
	<p>
		<input  name="submit" type="submit" value="Déconnecter"  style= " width: 100px; height: 25px";> 
		
	</p>
</form>	
<form method="post" action="Pannier.php">
	<p>
		<button type ="submit"  onClick=""  title="Pannier" data-toggle="tooltip" data-placement="right"  ><img src="images/shopping-cart.png"  width="40"></button>	
	</p>
</form> 

	<?php
	
}
else
{
?>
	<form method="post" action="admin/CibleLogin.php">

<p><img src="images/ConnectMini.png"  ></p>
<p ><label for="Nom" style="font-size:10px;">Login :</label></br> <input type="text" name="login" id="login" tabindex="10" /> </p>
<p ><label for="Nom" style="font-size:10px;">Mot de passe :</label></br><input type="password" name="pass" id="pass" tabindex="15" /></p>
 <p><input  name="submit" type="submit"   value="Login"  style= " width: 100px; height: 25px";></p>
 <p>
 <li>
   <a href="PasswordForget.php"style="font-size:12px;">mot de passe oublié? </a>
   <a href="AddLogin.php"style="font-size:12px;">Créer un compte </a>
   </li>
   </p>
  </form>

<?php
} ?>
   </div>  
