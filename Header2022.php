<?php $today = date("Y-m-d H:i:s"); 
date_default_timezone_set('Europe/Paris');
  session_start();
// --- La setlocale() fonctionnne pour strftime mais pas pour DateTime->format()
setlocale(LC_TIME, 'fr_FR.utf8','fra');// OK 
 session_start();?>

<Div id= "Header" style="position: fixed ; Height: 100px; background: #FFF; z-index:1035;">
<table style= "width: 100%;">
<tr>
<td>
<Div id = "logo">
<a href="index.php">
<img src="logobetaDefiChrono.jpg" alt=""  style="max-width:220px;" />
</a>
</div>
</td>
<td>
<Div id = "User">
<table>	
	<tr>	
		<td> 	
			<a href="index.php">
				<span class="dot" >
					<i class="fa fa-home" style= "font-size: 28px;margin:7px;margin-top:5px ; color: #4095f5;"></i>
				</span>
			</a>
		</td> 		
		<td> 
		<a href="admin/login.php">
			<table>
				<tr>
					<td>
						<span class="dot">
							<i class="fa fa-user-circle" style= "font-size: 25px;margin:8px; margin-top: 8px; color: #4095f5;"></i>
						</span>
					</td>
				</tr>
					
				<?
				if (  isset($_SESSION['Login']))
				{
					?>
					<tr>
						<td>
							<? echo  $_SESSION['Login'];?> 
						</td>
					</tr>
				<? 
				}
				?>
			</table>
		</a>
		</td> 
		<td> 	
			<a href="Contact.php">
				<span class="dot" >
					<i class="fa fa-info-circle" style= "font-size: 28px;margin:8px; margin-top: 6px; color: #4095f5;"></i>
				</span>
			</a>
		</td> 

		<td>
		
		</td>
	</tr>

</table >

</div>
</td>
</table>
<span class="popupUser" id="PopUpUSer">
 
	<form method="post" name="FormConnect" id ="FormConnect" action="admin/CibleLoginV2.php">
		<table>
			<tr style= "Height : 10px">
				<span class="dot" onclick="ClosePopUp()" onmouseover="" style="cursor: pointer;" style="float : right; margin :0px">
					<i class="fa fa-times" style= "font-size: 20px;margin:5px;color: #4095f5"></i>
				</span>
			</tr>
			<tr>
			
				<td>
					<label for="Login" style="font-size:8px;">e-mail :</label>
				</td>
				<td>
					<label for="password" style="font-size:8px;">Mot de passe :</label>
				</td>
				<td>
				
				</td>
				<td>
				
					<a href="AddLogin.php"style="font-size:12px;">Créer un compte </a>
					
				</td>
			</tr>
			<tr>
				<td>
					<input type="text" name="login" id="login" tabindex="10" style="max-width: 120px;"/> 
				</td>
				<td>
					<input type="password" name="pass" id="pass" tabindex="15" style="max-width: 100px;"/>
				</td>
					<td onclick=" SendForm()" onmouseover="" style="cursor: pointer;">
						<i  class="fa fa-sign-in" style= " font-size: 20px;" ></i>
					</td>
				<td>
					<a href="PasswordForget.php"style="font-size:12px;">mot de passe oublié? </a>
				</td>
			</tr>
		</table>
	</form>
 </span>
 
</div>
<script>
// When the user clicks on div, open the popup
function ShowPopUp() {
	 
	var popup = document.getElementById("PopUpUSer");
	popup.style.visibility = "visible" ;
	 
 // popup.classList.toggle("show");
}
function ShowDeconnect()
{
		 window.location.href = "admin/login.php";
}
function ClosePopUp() {
  var popup = document.getElementById("PopUpUSer");
  popup.style.visibility = "hidden" ;
}
function SendForm() {
  var popup = document.getElementById("FormConnect");
  popup.submit();
}
</script>