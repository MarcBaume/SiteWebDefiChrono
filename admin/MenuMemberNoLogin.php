  <div id="menu_vertical">
  <table style="Width : 100%">
  <tr>
  
	<li>

<td style="Width : 25%" onClick="ClickColProfil()" >
	<table>
			<tr id="<?php echo "RowRace3".$IdRace ?>"  style="Width : 100%">
			<td>
				<span class="dot">
					<i class="fa fa-user-circle" style= "font-size: 25px;margin:8px;color: #4095f5;"></i>
				</span>
			
			</td>
			<td>
				<p >Profil </p>
			</td>
		</tr>
	</table>
</td>
	<TD style="Width : 25%" onClick="ClickColResultat()">
				<table>
						<tr id="<?php echo "RowRace3".$IdRace ?>"  style="Width : 100%">
						<td>
							<span class="dot">
								<i class="fa fa-trophy" style= "font-size: 20px;margin:9px;color: #4095f5;"></i>
							</span>
						</td>
						<td>
							<p >Mes Resultats </p>
						</td>
					</tr>
				</table>
		
	</TD>


	<TD style="Width : 25%" onClick="ClickColPannier()">
				<table>
						<tr id="<?php echo "RowRace3".$IdRace ?>"  style="Width : 100%">
						<td>
							<span class="dot">
								<i class="fa fa-shopping-cart" style= "font-size: 25px;margin:8px;color: #4095f5;"></i>
							</span>
						
						</td>
						<td>
							<p >Mes Inscriptions </p>
						</td>
					</tr>
				</table>
		
	</TD>
	



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