
<div id="menu_vertical">
<li>

   </li>
   <script type="text/javascript">

function checkForm(f) {
	f.submit();
	
}
</script>
<?


  session_start();
 
	if(isset($_SESSION['screen_width']) AND isset($_SESSION['screen_height']))
	{
		if  ($_SESSION['screen_width'] > 480 )
		{	
?>

			<form method="get" action ="index.php">
				<button type ="button" style="float:right;margin-right :10px;" onClick="checkForm(this.form)"  title="Inscriptions" data-toggle="tooltip" data-placement="right"  > Accueil<img src="images/accueil.png"  width="25"></button>
			</form>

			<?php
		}
		 else 
		{

		?>

			<form method="get" action ="index.php">
				<button type ="button" style="float:right;margin-right :10px;" onClick="checkForm(this.form)"  title="Inscriptions" data-toggle="tooltip" data-placement="right"  > <img src="images/accueil.png"  width="25"></button>
			</form>
		
		<?php
		}	
	}


   
?>

</div>


