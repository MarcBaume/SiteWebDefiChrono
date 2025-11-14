<script type="text/javascript">
function getURL( ValueFind, IDElement) {

	if (window.location.href.search(ValueFind)>-1)
		{
		//	document.getElementById(IDElement).style.backgroundColor = "#1e8ac2";
			//document.getElementById(IDElement).style.color = "white";
			document.getElementById(IDElement).classList.add("dotDisplayed");
			document.getElementById(IDElement).classList.remove("dot");

		}
		else
		{
		//	document.getElementById(IDElement).style.backgroundColor = "transparent";
			//document.getElementById(IDElement).style.color = " #3d6ca4";
			document.getElementById(IDElement).classList.add("dot");
			document.getElementById(IDElement).classList.remove("dotDisplayed");
		}
		
       
    }
 </script>
 
 <div id="menu_vertical" class="menu_vertical">
  <table style="Width : 100%">
  <tr>
  
	<li>
	<?php 
	 session_start();
	if (isset($_SESSION['Login']) && strlen($_SESSION['Login']) > 1)
{?>
<td style="Width : 25%" onClick="ClickColProfil()"  >
<span class="dot" id="<?php echo "RowProfil".$IdRace ?>">
	<table style="Width : 100%">
		<tr   style="Width : 100%">
			<td style="text-align: center;" >
				
					<i class="fa fa-user-circle" style= "font-size: 32px;margin:auto;"></i>
				
			
			</td>
		</tr>
		<tr>
			<td style="font-size:10px; text-align: center;">
				Profil 
			</td>
		</tr>
	</table>
	</span>
</td>
<script>
		getURL( "membres","<?php echo "RowProfil".$IdRace ?>" ) ;
	</script>
	<TD style="Width : 25%" onClick="ClickColResultat()" >
	<a class="dot"  id="<?php echo "RowResult".$IdRace ?>">
		<span >
				<table  style="Width : 100%">
					<tr   style="Width : 100%">
						<td  style="text-align: center;">
							
								<i class="fa fa-trophy" style= "font-size: 32px;margin:auto;"></i>
						</td>
					</tr>
					<tr>
						<td style="font-size:10px; text-align: center;" >
				
							Mes Resultats 
						</td>
					</tr>
				</table>
		</span>
</a>
	</TD>
	<script>
		getURL( "ListResultat","<?php echo "RowResult".$IdRace ?>" ) ;
	</script>
<?}

	if (isset($_SESSION['Course']))
	{
		$Link= "../formulaire2.php?Nbretape=".$_SESSION['Nbretape']."&date_course=".$_SESSION['DateCourse']."&nom_course=" .$_SESSION['Course'];
		
	}
	if (isset($_SESSION['Login']) && strlen($_SESSION['Login']) > 1)
	{
	?>
	<TD  style="Width : 25%" onClick="ClickColPannier()">
		<span class="dot"  id="<?php echo "Rowinsc".$IdRace ?>" >
				<table style="Width : 100%">
					<tr style="Width : 100%">
						<td style="text-align: center;">
							<i class="fa fa-shopping-cart"  style= "font-size: 32px;margin:auto;"></i>
						</td>
					</tr>
					<tr>
						<td style="font-size:10px; text-align: center;">
							Mes Inscriptions 
						</td>
					</tr>
				</table>
			</span>
	</TD>
	<script>
		getURL( "Pannier","<?php echo "Rowinsc".$IdRace ?>" ) ;
	</script>

<? 

	}
if  (isset($_SESSION['Login']))
	{?>
	<td style="Width : 25% " onClick="ClickColDeconnect()">
		<span class="dot"  id="<?php echo "RowRace3".$IdRace ?>">
			<table style="Width : 100%">
					<tr  style="Width : 100%">
						<td style="text-align: center;">
							<i class="fa fa-sign-in" style= "font-size: 32px;margin:auto;"></i>
						</td>
					</tr>
					<tr>
						<td style="font-size:10px; text-align: center;">
							Déconnexion
						</td>
					</tr>
				</table>
		</span>

	</td>
<?	}
?>


   </li>
   </tr>
   </table>
</div>
<script>
function ClickColPannier()
{
	 window.location.href = "Pannier.php";
}
function ClickColResultat()
{
	 window.location.href = "ListResultat.php";
}
function ClickColDeconnect()
{
	 window.location.href = "../Deconnect.php";
}
function ClickColProfil()
{
	 window.location.href = "membres.php";
}
</script>