<div id="menu_vertical">
<div class="topnav">
  <a href="#home" class="active"></a>
  <div id="myLinks">
  
  <?php if (isset($_SESSION['Login']))
{?>
	 <a> <img src="images/profil.png" width="60"> </br>
	 <?php echo $_SESSION['Login']?>
	 </a>
	<a href="admin/membres.php">Votre Profil</a>
    <a href="Pannier.php">Vos inscriptions</a>
	<a href="deconnection.php">Déconnection</a>
 
  <?php
}
else
{?> 
<a>	<form method="post" action="admin/CibleLogin.php">
	<p><img src="images/ConnectMini.png"  ></p>
	<p ><label for="Nom" style="font-size:10px;">Login :</label></br> <input type="text" name="login" id="login" tabindex="10" /> </p>
	<p ><label for="Nom" style="font-size:10px;">Mot de passe :</label></br><input type="password" name="pass" id="pass" tabindex="15" /></p>
	<p><input  name="submit" type="submit"   value="Login"  style= " width: 100px; height: 25px";></p>
	<p>
	 <li>
	   <a href="PasswordForget.php"style="font-size:12px;">Mot de passe oublier? </a>
	   <a href="AddLogin.php"style="font-size:12px;">Créer un compte </a>
	</li>
	</p>
  </form></a>
<?php
}
?>
 </div>
  <a style="height:30px" href="javascript:void(0);" class="icon" onclick="myFunction()">
    <i class="fa fa-bars"></i>
  </a>
</div>
</div>

<script>
function myFunction() {
  var x = document.getElementById("myLinks");
  if (x.style.display === "block") {
    x.style.display = "none";
  } else {
    x.style.display = "block";
  }
}
</script>



