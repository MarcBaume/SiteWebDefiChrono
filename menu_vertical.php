
<div id="menu_vertical">
<li>

   </li>
   <script type="text/javascript">

function checkForm(f) {
	f.submit();
	
}
</script>
<?php
 
if ( strlen($_POST['date_course'])>0)
{
$DateCourse =  $_POST['date_course'];
$Date =  date_parse($_POST['date_course']);
$ANNEE_COURSE = $Date['year']; 
$Month = $Date['month']; 
$Day = $Date['day']; 

//$ANNEE_COURSE = $_POST['annee_course'];
$NOM_COURSE = $_POST["nom_course"];
$Nbr_etape =  $_POST["Nbretape"] ;

}
else if  ( strlen($_GET['date_course'])>0)
{
$DateCourse =  $_GET['date_course'];
$Date =  date_parse($_GET['date_course']);
$ANNEE_COURSE = $Date['year']; 
$Month = $Date['month']; 
$Day = $Date['day']; 

//$ANNEE_COURSE = $_GET['annee_course'];
$NOM_COURSE = $_GET["nom_course"];
$Nbr_etape =  $_GET["Nbretape"] ;

}

if (strlen($ANNEE_COURSE ) > 0 )
{

/*************************** CONNECTION AVEC LA BASE DE DONNEES ***********************************/
  $con = mysqli_connect('dxvv.myd.infomaniak.com', 'dxvv_christopheJ', 'er3z4aet1234');
   if (!$con)
  {
		die('Could not connect: ' . mysql_error());
  }
  else
  {
		mysqli_select_db($con ,'dxvv_jurachrono' );
		// ***************************************** AFFICHAGE BASE de Donnée ***************************************
		$sql = 'SELECT * FROM Course  WHERE Nom_course=\''.$_GET["nom_course"].'\'AND Date=\''.$DateCourse.'\'OR DateEtape2=\''.$DateCourse.'\'OR DateEtape3=\''.$DateCourse.'\'OR DateEtape4=\''.$DateCourse.'\'OR DateEtape5=\''.$DateCourse.'\'' ; 
		$result = mysqli_query($con,$sql);
		if ($result && mysqli_num_rows($result) > 0) 
		{
			
			// output data of each row
			while($val1 = mysqli_fetch_assoc($result)) 
			{
				$Site = $val1['Site'];
				$val = $val1;
			}
		}
	}

 session_start();
 
	if(isset($_SESSION['screen_width']) AND isset($_SESSION['screen_height']))
	{
		if  ($_SESSION['screen_width'] > 480 )
		{	
			if (strlen($Site ) > 0 )
			{
			?>
			<form action ='<?php echo 'http://www.'. $Site ?>' >
				<button type ="button" 
				style="float:right; margin-right :10px;"
				 onClick="checkForm(this.form)" 
				  title="Information" 
				  data-toggle="tooltip" data-placement="right"  >Site Organisateur<img src="images/Siteweb.png" width="25"   ></button>
			</form> 
			<?php
			}
			?>
			<form method="get"action ="informations.php">
				<input type="hidden" name="Nbretape" id="Nbretape" value= '<?php echo  $Nbr_etape ?>' />
				<input type="hidden" name="date_course" id="date_course" tabindex="10"  size="60"  value= '<?php echo $DateCourse ?>' />
				<input type="hidden" name="nom_course" id="nom_course" tabindex="10"  size="60"  value= '<?php echo $NOM_COURSE ?>' />
				<button type ="button" style="float:right; margin-right :10px;" onClick="checkForm(this.form)"  title="Information" data-toggle="tooltip" data-placement="right"  >Information<img src="images/informations.png" width="25"   ></button>
			</form> 
			<form method="get" action ="index.php">
				<button type ="button" style="float:right;margin-right :10px;" onClick="checkForm(this.form)"  title="Inscriptions" data-toggle="tooltip" data-placement="right"  > Accueil<img src="images/accueil.png"  width="25"></button>
			</form>
			<form method="get" action ="formulaire.php">
				<input type="hidden" name="Nbretape" id="Nbretape" value= '<?php echo  $Nbr_etape ?>' />
				<input type="hidden" name="date_course" id="date_course" tabindex="10"  size="60"  value= '<?php echo $DateCourse ?>' />
				<input type="hidden" name="nom_course" id="nom_course" tabindex="10"  size="60"  value= '<?php echo $NOM_COURSE ?>' />
				<button type ="button" style="float:right;margin-right :10px;" onClick="checkForm(this.form)"  title="Inscriptions" data-toggle="tooltip" data-placement="right"  > Inscription<img src="images/inscriptions.png"  width="25"></button>
			</form>
			<form method="get" action ="liste.php">
				<input type="hidden" name="Nbretape" id="Nbretape" value= '<?php echo  $Nbr_etape ?>' />
				<input type="hidden" name="date_course" id="date_course" tabindex="10"  size="60"  value= '<?php echo $DateCourse ?>' />
				<input type="hidden" name="nom_course" id="nom_course" tabindex="10"  size="60"  value= '<?php echo $NOM_COURSE ?>' />
				<button type ="button" style="float:right;margin-right :10px;" onClick="checkForm(this.form)" title="Liste de départ" data-toggle="tooltip" data-placement="right" >Liste départ<img src="images/liste.png"  width="25"></button>
			</form>
			<?php
		}
		 else 
		{

			if (strlen($Site ) > 0 )
			{
			?>
				<form action ='<?php echo $Site ?>' >
				<button type ="button" style="float:right; margin-right :10px;" onClick="checkForm(this.form)"  title="Information" data-toggle="tooltip" data-placement="right"  ><img src="images/Siteweb.png" width="25"   ></button>
				</form> 
			<?php
			}
			?>	
			<form method="get"action ="informations.php">
				<input type="hidden" name="Nbretape" id="Nbretape" value= '<?php echo  $Nbr_etape ?>' />
				<input type="hidden" name="date_course" id="date_course" tabindex="10"  size="60"  value= '<?php echo $DateCourse ?>' />
				<input type="hidden" name="nom_course" id="nom_course" tabindex="10"  size="60"  value= '<?php echo $NOM_COURSE ?>' />
				<button type ="button" style="float:right; margin-right :10px;" onClick="checkForm(this.form)"  title="Information" data-toggle="tooltip" data-placement="right"  ><img src="images/informations.png" width="25"   ></button>
			</form> 

			<form method="get" action ="index.php">
				<button type ="button" style="float:right;margin-right :10px;" onClick="checkForm(this.form)"  title="Inscriptions" data-toggle="tooltip" data-placement="right"  > <img src="images/accueil.png"  width="25"></button>
			</form>
			<form method="get" action ="formulaire.php">
				<input type="hidden" name="Nbretape" id="Nbretape" value= '<?php echo  $Nbr_etape ?>' />
				<input type="hidden" name="date_course" id="date_course" tabindex="10"  size="60"  value= '<?php echo $DateCourse ?>' />
				<input type="hidden" name="nom_course" id="nom_course" tabindex="10"  size="60"  value= '<?php echo $NOM_COURSE ?>' />
				<button type ="button" style="float:right;margin-right :10px;" onClick="checkForm(this.form)"  title="Inscriptions" data-toggle="tooltip" data-placement="right"  > <img src="images/inscriptions.png"  width="25"></button>
			</form>
			<form method="get" action ="liste.php">
				<input type="hidden" name="Nbretape" id="Nbretape" value= '<?php echo  $Nbr_etape ?>' />
				<input type="hidden" name="date_course" id="date_course" tabindex="10"  size="60"  value= '<?php echo $DateCourse ?>' />
				<input type="hidden" name="nom_course" id="nom_course" tabindex="10"  size="60"  value= '<?php echo $NOM_COURSE ?>' />
				<button type ="button" style="float:right;margin-right :10px;" onClick="checkForm(this.form)" title="Liste de départ" data-toggle="tooltip" data-placement="right" ><img src="images/liste.png"  width="25"></button>
			</form>
		<?php
		}	
	}
}

   
?>

</div>

 <!--- Couverture --->
	<?php
	$chemin= 'courses/'.$NOM_COURSE.$ANNEE_COURSE."/info/images/couverture.jpg";
	if (file_exists($chemin)) {
		echo '<img src="'.$chemin.'" alt=""  WIDTH=100% /></a>'; 
 }
 
?>

