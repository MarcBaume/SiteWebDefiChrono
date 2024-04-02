<?php $today = date("Y-m-d H:i:s"); 
date_default_timezone_set('Europe/Paris');
  session_start();
// --- La setlocale() fonctionnne pour strftime mais pas pour DateTime->format()
setlocale(LC_TIME, 'fr_FR.utf8','fra');// OK 
?>
<script type="text/javascript">
function getURLHeader( ValueFind, IDElement) {

	
		if (window.location.href.search(ValueFind)>-1)
		{
		//	document.getElementById(IDElement).style.backgroundColor = "#1e8ac2";
			//document.getElementById(IDElement).style.color = "white";
			document.getElementById(IDElement).classList.add("dotDisplayedHeader");
			document.getElementById(IDElement).classList.remove("dotHeader");

		}
		else
		{
		//	document.getElementById(IDElement).style.backgroundColor = "transparent";
			//document.getElementById(IDElement).style.color = " #3d6ca4";
			document.getElementById(IDElement).classList.add("dotHeader");
			document.getElementById(IDElement).classList.remove("dotDisplayedHeader");
		}
		
    }

	function getURLHeader4( ValueFind,  ValueFind2,ValueFind3,ValueFind4,IDElement) {

if (window.location.href.search(ValueFind)>-1 || window.location.href.search(ValueFind2)>-1|| window.location.href.search(ValueFind3)>-1|| window.location.href.search(ValueFind4)>-1)
{
//	document.getElementById(IDElement).style.backgroundColor = "#1e8ac2";
	//document.getElementById(IDElement).style.color = "white";
	document.getElementById(IDElement).classList.add("dotDisplayedHeader");
	document.getElementById(IDElement).classList.remove("dotHeader");

}
else
{
//	document.getElementById(IDElement).style.backgroundColor = "transparent";
	//document.getElementById(IDElement).style.color = " #3d6ca4";
	document.getElementById(IDElement).classList.add("dotHeader");
	document.getElementById(IDElement).classList.remove("dotDisplayedHeader");
}

}
	</script>
<Div id= "Header" style="  z-index:1035;">
<table style= "width: 100%;">
<tr>
<td>
<Div id = "logo">
<a href="index.php">
<img src="images/LogoDefiChrono2023.svg" style="height:90px;" alt="" />
</a>
</div>
</td>
<td>
<Div id = "User">
<table>	
	<tr>	
		<td> 	
			<a href="index.php">
				<span class="dotHeader"  id="ButtonIndex" >
					<i class="fa fa-home" style= "font-size: 28px;margin:7px;margin-top:5px ; "></i>
				</span>
				<script>
							getURLHeader( "index", "ButtonIndex" ) ;
				</script>
			</a>
		</td> 		
		<td> 
		<a href="admin/login.php">
			<table>
				<tr>
					<td>
						<span class="dotHeader"  id="ButtonUser">
							<i class="fa fa-user-circle" style= "font-size: 25px;margin:8px; margin-top: 8px; "></i>
							<a style="vertical-align :center;">
							<?
								if (  isset($_SESSION['Login']))
								{
									$pos = strpos($_SESSION['Login'],'@');
									$login = substr($_SESSION['Login'], 0, $pos) ;
									 echo  	$login ;
								
								}
								?>
								</A>
						</span>
						<script>
							getURLHeader4( "login","membres","ListResultat","Pannier", "ButtonUser" ) ;
						</script>
					</td>
				</tr>
					
			
			</table>
		</a>
		</td> 
		<td> 	
			<a href="Contact.php">
				<span class="dotHeader" id="ButtonContact">
					<i class="fa fa-info-circle" style= "font-size: 28px;margin:8px; margin-top: 6px; "></i>
				</span>
			</a>
			<script>
							getURLHeader( "contact", "ButtonContact" ) ;
				</script>
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
					<i class="fa fa-times" style= "font-size: 20px;margin:5px;color: #3d6cA4"></i>
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